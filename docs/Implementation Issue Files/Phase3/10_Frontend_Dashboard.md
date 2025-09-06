# Issue #10: Room Status Dashboard

-   **Phase**: 3
-   **Priority**: Critical
-   **Module**: Frontend, Operations

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 3: Frontend & User Interfaces** and focuses on creating the main operational dashboard, which provides a real-time view of the resort's status.

---

## Description

Develop the `RoomStatusGrid.vue` component as specified in the Low-Level Design. This component is the primary visual tool for front desk and management to see the current state of the resort at a glance.

## Acceptance Criteria

-   A `RoomStatusGrid.vue` component is created.
-   The component fetches and displays rooms from the `GET /api/v1/rooms` endpoint on mount.
-   Each room is displayed as a card with its name and status.
-   The cards are color-coded based on their status (`ready`, `checked-in`, `cleaning`, `maintenance`).
-   The component connects to the WebSocket server and listens for the `RoomStatusChanged` event.
-   When a `RoomStatusChanged` event is received, the status and color of the corresponding room card update instantly without a page refresh.
-   The component is displayed on the main dashboard page.
-   Clicking a room card emits a `room-selected` event.

## Technical Details / Tasks

1.  **Create the Vue Component**:
    -   Create the `resources/js/Components/RoomStatusGrid.vue` file.
    -   Implement the template and styles as described in the LLD.

2.  **API Integration**:
    -   In the component's `onMounted` hook, call the API service (Axios instance) to fetch the list of rooms.
    -   Populate the `rooms` reactive state with the response.
    -   Handle loading and error states.

3.  **WebSocket Integration**:
    -   Create a service or plugin (`resources/js/services/websockets.js`) to initialize and export a single Laravel Echo instance. This ensures only one connection is made.
    -   In the `onMounted` hook of the component, use the Echo instance to subscribe to the private tenant channel: `echo.private('tenant.{id}')`.
    -   Listen for the `.RoomStatusChanged` event.
    -   The event handler should find the matching room in the `rooms` array and update its `status` property. Vue's reactivity will automatically re-render the card.

4.  **Component Placement**:
    -   Import and use the `RoomStatusGrid.vue` component within the `DashboardPage.vue`.

5.  **Parent Interaction**:
    -   On the `DashboardPage.vue`, listen for the `@room-selected` event from the grid.
    -   For now, the handler can simply log the selected room ID to the console. This will be used later to open a details modal.

## Depends On

-   [Issue #8: Real-time Service Setup](08_Realtime_Setup.md)
-   [Issue #9: Frontend Scaffolding & Authentication](09_Frontend_Scaffolding.md)
