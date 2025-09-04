# LLD: API Endpoints - Rooms & Status

This document provides a low-level design for API endpoints related to managing `Rooms` and their statuses.

---

## 1. List and Filter Rooms

-   **Endpoint**: `GET /api/v1/rooms`
-   **Permission**: `view-rooms`
-   **Description**: Retrieves a list of all rooms, with support for filtering.

### Query Parameters

-   `status` (string): Filter by room status (e.g., `ready`, `checked-in`, `cleaning`, `maintenance`).
-   `room_type_id` (int): Filter by a specific room type.
-   `location_id` (int): Filter by a specific accommodation location.
-   `paginate` (int): Number of results per page (e.g., `25`). Defaults to all.

**Example**: `GET /api/v1/rooms?status=ready&room_type_id=3`

### Success Response (200 OK)

```json
{
    "data": [
        {
            "id": 1,
            "name": "Raft 01",
            "status": "ready",
            "room_type": {
                "id": 3,
                "name": "Deluxe"
            },
            "location": {
                "id": 1,
                "name": "Riverfront"
            }
        },
        {
            "id": 2,
            "name": "Raft 02",
            "status": "ready",
            "room_type": {
                "id": 3,
                "name": "Deluxe"
            },
            "location": {
                "id": 1,
                "name": "Riverfront"
            }
        }
    ]
}
```

---

## 2. Update Room Status

-   **Endpoint**: `PATCH /api/v1/rooms/{id}/status`
-   **Permission**: `update-room-status` (This permission would be assigned to Housekeepers, Maintenance, and Front Desk roles).
-   **Description**: Updates the status of a single room. This is a critical endpoint for operational workflows.

### Request Body

```json
{
    "status": "cleaning"
}
```
*Valid status values: `ready`, `cleaning`, `maintenance`, `checked-in`.*

### Success Response (200 OK)

```json
{
    "data": {
        "id": 1,
        "name": "Raft 01",
        "status": "cleaning",
        "message": "Room status updated successfully."
    }
}
```

### Error Responses
-   `404 Not Found`: If the room with the given `{id}` does not exist.
-   `422 Unprocessable Entity`: If the provided `status` is not a valid or permissible next status.
-   `403 Forbidden`: If the user's role is not allowed to perform this status change.
