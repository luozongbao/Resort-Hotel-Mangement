# Issue #4: Core Accommodation Management

-   **Phase**: 1
-   **Priority**: High
-   **Module**: Accommodation

---

## Description

This issue involves creating the foundational CRUD (Create, Read, Update, Delete) functionality for the core accommodation entities: Locations, Accommodation Types, Room Types, and Rooms.

## Acceptance Criteria

-   Full CRUD API endpoints are available for `AccommodationLocations`.
-   Full CRUD API endpoints are available for `AccommodationTypes`.
-   Full CRUD API endpoints are available for `RoomTypes` (including defining capacity).
-   Full CRUD API endpoints are available for `Rooms`, including associating them with a location, accommodation type, and room type.
-   All endpoints are protected by the appropriate permissions (e.g., `manage-rooms`).
-   The database schema from `LLD: Database Table Schema` is implemented for these entities.
-   Unit and feature tests are written to ensure the endpoints work as expected.

## Technical Details / Tasks

1.  **Create Models and Migrations**:
    -   Create the following models with their corresponding migrations for the tenant database:
        -   `AccommodationLocation`
        -   `AccommodationType`
        -   `RoomType` (`name`, `capacity`)
        -   `Room` (`name`, `status`, foreign keys to the above)
    -   Define the Eloquent relationships between these models (e.g., a `Room` `belongsTo` a `RoomType`).

2.  **Create API Resources**:
    -   Create Laravel API Resources for each model to standardize the JSON output.

3.  **Implement `AccommodationLocation` Endpoints**:
    -   `GET /api/v1/locations`
    -   `POST /api/v1/locations`
    -   `GET /api/v1/locations/{id}`
    -   `PUT/PATCH /api/v1/locations/{id}`
    -   `DELETE /api/v1/locations/{id}`

4.  **Implement `AccommodationType` Endpoints**:
    -   Implement corresponding CRUD endpoints for `AccommodationTypes`.

5.  **Implement `RoomType` Endpoints**:
    -   Implement corresponding CRUD endpoints for `RoomTypes`.

6.  **Implement `Room` Endpoints**:
    -   Implement corresponding CRUD endpoints for `Rooms`.
    -   The `GET /api/v1/rooms` endpoint should support filtering by status, location, and room type as specified in the LLD.

7.  **Add Permissions**:
    -   Define permissions like `manage-locations`, `manage-room-types`, and `manage-rooms` in the `RolesAndPermissionsSeeder`.
    -   Protect all new endpoints with the appropriate permission middleware.

8.  **Write Tests**:
    -   Create feature tests that make requests to the new endpoints and assert the expected responses and database state.

## Depends On

-   [Issue #3: User Authentication & RBAC](03_Authentication_RBAC.md)
