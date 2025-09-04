# LLD: Real-time Events Specification

This document provides a low-level design for the WebSocket events used for real-time communication.

---

## 1. General Setup

-   **Technology**: WebSockets, implemented via Laravel WebSockets and Laravel Echo on the frontend.
-   **Channels**: Communication will be scoped to private tenant channels to ensure data is not broadcast to the wrong customer.
    -   **Channel Naming Convention**: `private-tenant.{tenantId}`
    -   **Example**: `private-tenant.123`

---

## 2. Event: `RoomStatusChanged`

-   **Event Class**: `App\Events\RoomStatusChanged`
-   **Description**: Fired whenever a room's operational status changes. This is the most critical real-time event for keeping all clients in sync.
-   **When Triggered**:
    -   After a guest checks in (`confirmed` -> `checked-in`).
    -   After a guest checks out (`checked-in` -> `awaiting-cleaning`).
    -   After a housekeeper finishes cleaning (`awaiting-cleaning` -> `ready`).
    -   When a housekeeper reports damage (`ready` -> `maintenance`).
    -   When a technician completes a repair (`maintenance` -> `ready`).
-   **Broadcast Name**: The event will be broadcast with the name `RoomStatusChanged`.
    ```php
    // In the event class
    public function broadcastAs()
    {
        return 'RoomStatusChanged';
    }
    ```

### Payload

The event payload will contain the minimal data required for the frontend to update its state.

```json
{
    "room": {
        "id": 42,
        "name": "Villa 101",
        "status": "awaiting-cleaning"
    }
}
```

### Frontend Listener (Laravel Echo)

```javascript
echo.private('tenant.123')
    .listen('.RoomStatusChanged', (event) => {
        console.log('Room status was updated:', event.room);
        // Logic to find the room in the local state and update its status.
        // e.g., update the color of the room card in the RoomStatusGrid component.
    });
```

---

## 2. Event: `NewMaintenanceRequest`

-   **Event Class**: `App\Events\NewMaintenanceRequest`
-   **Description**: Fired when a new maintenance request is created, typically by a housekeeper. Its primary purpose is to send a push notification to the maintenance team.
-   **When Triggered**:
    -   After a `POST` request to `/api/v1/maintenance/requests` is successfully processed.
-   **Broadcast Name**: `NewMaintenanceRequest`

### Payload

The payload includes enough information to display a useful notification.

```json
{
    "request": {
        "id": 101,
        "room_name": "Villa 101",
        "description": "Leaking faucet in the bathroom.",
        "priority": "medium"
    }
}
```

### Frontend Listener (Laravel Echo)

This would typically be in the main layout of the Maintenance mobile app.

```javascript
echo.private('tenant.123')
    .listen('.NewMaintenanceRequest', (event) => {
        console.log('New maintenance request:', event.request);
        // Logic to display a native push notification.
        // Tapping the notification should navigate the user to the task details.
        showNotification({
            title: `New Task in ${event.request.room_name}`,
            body: event.request.description
        });
    });
```
