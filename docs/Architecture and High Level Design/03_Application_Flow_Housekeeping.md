# Application Flow: Housekeeping and Maintenance

This document illustrates the sequence of events for a common operational workflow: a housekeeper cleaning a room and reporting damage, which then triggers a maintenance task.

## Sequence Diagram

```mermaid
sequenceDiagram
    participant HK_App as Housekeeper (Mobile App)
    participant API as Backend API (Laravel)
    participant DB as Database
    participant Realtime as WebSocket Service
    participant Maint_App as Maintenance (Mobile App)

    Note over HK_App, API: A guest checks out, room status becomes 'Awaiting Cleaning'.

    HK_App->>API: GET /api/v1/housekeeping/tasks
    API->>DB: Query for rooms with status 'Awaiting Cleaning'
    DB-->>API: Returns list of rooms
    API-->>HK_App: List of cleaning tasks

    Note over HK_App, API: Housekeeper cleans the room.

    HK_App->>API: PATCH /api/v1/rooms/{id}/status (status: 'Ready')
    API->>DB: Update room status to 'Ready'
    DB-->>API: Success
    API-->>HK_App: 200 OK
    API->>Realtime: Publish event: "room-status-changed"

    Note over HK_App, API: In another room, housekeeper finds damage.

    HK_App->>API: POST /api/v1/maintenance/requests (Room ID, Photo, Description)
    API->>API: Validate request
    API->>DB: 1. Create MaintenanceRequest record<br>2. Update Room status to 'Under Maintenance'
    DB-->>API: Records created/updated
    API-->>HK_App: 201 Created

    API->>Realtime: Publish event: "room-status-changed"
    API->>Realtime: Publish event: "new-maintenance-request"
    Realtime-->>Maint_App: Push notification to Maintenance team
```

## Flow Description

### 1. Cleaning a Room
-   A guest checks out, and the system automatically sets the room status to 'Awaiting Cleaning'.
-   The housekeeper opens their mobile app and requests their list of tasks. The app calls the `GET /housekeeping/tasks` endpoint.
-   The API queries the database for rooms assigned to that housekeeper (or all available cleaning tasks) with the status 'Awaiting Cleaning'.
-   After cleaning a room, the housekeeper taps a "Cleaning Complete" button in the app.
-   The app sends a `PATCH` request to update the room's status to 'Ready'.
-   The API updates the database and triggers a real-time event to notify other parts of the system (like the front desk dashboard) that the room is now available.

### 2. Reporting Damage
-   While cleaning a room, the housekeeper discovers a broken item.
-   They use the "Report Damage" feature in their app, filling in details and optionally taking a photo.
-   The app sends a `POST` request to the `/maintenance/requests` endpoint.
-   The API validates the data, creates a new `MaintenanceRequest` record in the database, and crucially, updates the `Room` status to 'Under Maintenance' to prevent it from being booked.
-   The API then fires two real-time events:
    1.  A `room-status-changed` event, so the front desk immediately sees the room is out of service.
    2.  A `new-maintenance-request` event, which sends a push notification directly to the mobile apps of the maintenance team, alerting them to the new task.
