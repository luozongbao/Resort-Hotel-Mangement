# LLD: Frontend Component Design

This document outlines the low-level design of a key frontend component, `RoomStatusGrid.vue`, using the Vue.js framework.

---

## `RoomStatusGrid.vue` Component

-   **Responsibility**: To display a grid of rooms, showing their current status with color-coding. It should update in real-time as statuses change. It will be used on the main management dashboard and the housekeeping dashboard.

### 1. Component Structure (`<template>`)

```html
<template>
  <div class="room-grid-container">
    <div v-if="isLoading" class="loading-spinner">Loading...</div>
    <div v-else class="grid">
      <div
        v-for="room in rooms"
        :key="room.id"
        class="room-card"
        :class="getStatusClass(room.status)"
        @click="handleRoomClick(room)"
      >
        <div class="room-name">{{ room.name }}</div>
        <div class="room-status">{{ room.status }}</div>
      </div>
    </div>
  </div>
</template>
```

### 2. Component Properties (`props`)

```javascript
props: {
  // If provided, the component will fetch rooms with this status.
  // If not, it fetches all rooms.
  initialStatusFilter: {
    type: String,
    required: false,
    default: null
  }
}
```

### 3. Component State (`data` / `ref`)

```javascript
import { ref, onMounted } from 'vue';
import api from '@/services/api'; // Axios instance
import echo from '@/services/websockets'; // Laravel Echo instance

// Reactive state
const rooms = ref([]);
const isLoading = ref(true);
```

### 4. Component Logic (`<script setup>`)

```javascript
onMounted(async () => {
  // 1. Fetch initial room data from the API
  await fetchRooms();

  // 2. Listen for real-time updates
  listenForUpdates();
});

// --- Methods ---

// Fetches rooms from the backend API
async function fetchRooms() {
  isLoading.value = true;
  try {
    const params = { status: props.initialStatusFilter };
    const response = await api.get('/rooms', { params });
    rooms.value = response.data.data;
  } catch (error) {
    console.error("Failed to fetch rooms:", error);
  } finally {
    isLoading.value = false;
  }
}

// Subscribes to the WebSocket channel for real-time updates
function listenForUpdates() {
  // Replace 'YOUR_TENANT_ID' with the actual tenant ID, e.g. from props or store
  echo.channel(`private-tenant.${YOUR_TENANT_ID}`) // Consistent channel naming
    .listen('.RoomStatusChanged', (event) => {
      const updatedRoom = event.room;
      const roomIndex = rooms.value.findIndex(r => r.id === updatedRoom.id);
      if (roomIndex !== -1) {
        // Update the status of the specific room in the array
        rooms.value[roomIndex].status = updatedRoom.status;
      }
    });
}

// Returns a CSS class based on the room's status for color-coding
function getStatusClass(status) {
  return `status-${status}`; // e.g., 'status-ready', 'status-cleaning'
}

// Emits an event when a room card is clicked
const emit = defineEmits(['room-selected']);
function handleRoomClick(room) {
  emit('room-selected', room.id);
}
```

### 5. Emitted Events

-   **`room-selected`**: Emits the `id` of the room when a user clicks on a room card. The parent component can then use this to show more details in a modal or sidebar.

### 6. CSS Styling (`<style scoped>`)

```css
.room-card {
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 16px;
  text-align: center;
  cursor: pointer;
  transition: transform 0.2s;
}
.room-card:hover {
  transform: translateY(-5px);
}
.room-name {
  font-weight: bold;
  font-size: 1.2em;
}
.room-status {
  font-size: 0.9em;
  margin-top: 8px;
}

/* Color-coding classes */
.status-ready { background-color: #d4edda; } /* Green */
.status-checked-in { background-color: #cce5ff; } /* Blue */
.status-cleaning { background-color: #fff3cd; } /* Yellow */
.status-maintenance { background-color: #f8d7da; } /* Red */
```
