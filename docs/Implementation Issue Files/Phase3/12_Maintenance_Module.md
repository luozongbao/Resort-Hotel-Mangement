# Issue #12: Maintenance Module

-   **Phase**: 3
-   **Priority**: High
-   **Module**: Maintenance, Mobile

---

## Description

Develop the core features for the Maintenance module. This includes API endpoints and a UI for technicians to view and manage repair tasks.

## Acceptance Criteria

-   An API endpoint `GET /api/v1/maintenance/requests` is created that lists all active maintenance tasks.
-   The endpoint supports filtering by status (`reported`, `in-progress`) and sorting by priority.
-   An API endpoint `PATCH /api/v1/maintenance/requests/{id}` is created to update a task's status (e.g., to `in-progress` or `completed`).
-   When a task is marked as `completed`, the associated room's status is updated back to `ready`.
-   A dedicated UI is created for maintenance staff. This UI will:
    -   Display a list/board of maintenance tasks.
    -   Allow a technician to view task details, including the description and photo.
    -   Allow a technician to update the task status.
-   The Maintenance UI receives real-time notifications when a new task is created.

## Technical Details / Tasks

1.  **Backend (API)**:
    -   In `MaintenanceRequestController`, implement the `index` method to list tasks.
    -   Implement the `update` method to handle status changes.
        -   The logic for updating the room status upon completion should be here or in a service.
        -   This should fire a `RoomStatusChanged` event.
    -   Ensure the 'Maintenance' role has the necessary permissions (`view-maintenance-tasks`, `update-maintenance-task`).

2.  **Frontend (Web or Mobile)**:
    -   As with the Housekeeping module, this can be a dedicated section of the web app or part of the mobile app.
    -   **Task Board View**:
        -   Fetches data from `GET /api/v1/maintenance/requests`.
        -   Consider displaying tasks in columns by status (e.g., "Reported", "In Progress").
    -   **Task Detail View**:
        -   Shows all information about the request, including the photo of the damage.
        -   Provides buttons or a dropdown to change the task status.
    -   **Real-time Notifications**:
        -   The main layout for the maintenance UI should listen for the `NewMaintenanceRequest` event on the WebSocket channel.
        -   Upon receiving the event, it should either show a notification and/or automatically add the new task to the list.

## Depends On

-   [Issue #11: Housekeeping Module](11_Housekeeping_Module.md) (as it generates the maintenance requests)
