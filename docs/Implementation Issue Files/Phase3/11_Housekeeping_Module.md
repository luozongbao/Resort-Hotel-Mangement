# Issue #11: Housekeeping Module

-   **Phase**: 3
-   **Priority**: High
-   **Module**: Housekeeping, Mobile

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 3: Frontend & User Interfaces** and focuses on developing the user interface and backend logic for the housekeeping staff.

---

## Description

Develop the core features for the Housekeeping module. This includes the API endpoints and a dedicated frontend interface (which could be a mobile app or a responsive web view) for housekeepers.

## Acceptance Criteria

-   An API endpoint `GET /api/v1/housekeeping/tasks` is created that returns a list of rooms with the status `awaiting-cleaning`.
-   The `PATCH /api/v1/rooms/{id}/status` endpoint can be successfully used by a user with the 'Housekeeper' role to change a room's status from `awaiting-cleaning` to `ready`.
-   An API endpoint `POST /api/v1/maintenance/requests` is created for reporting damage.
-   A dedicated UI is created for housekeepers. This UI will:
    -   Display a simple list of rooms to be cleaned.
    -   Allow a housekeeper to mark a room as 'Ready'.
    -   Provide a form to report damage in a room, including uploading a photo.
-   The `NewMaintenanceRequest` event is fired when damage is reported.

## Technical Details / Tasks

1.  **Backend (API)**:
    -   Create a `HousekeepingController` for the task list endpoint.
    -   Create a `MaintenanceRequestController` with a `store` method.
        -   This method should handle file uploads for the damage photo, storing it securely.
        -   It should create the `MaintenanceRequest` record.
        -   It must update the associated room's status to `maintenance`.
        -   It must fire the `NewMaintenanceRequest` event.
    -   Create the `MaintenanceRequest` model and migration.
    -   Ensure the 'Housekeeper' role has the necessary permissions (`view-cleaning-tasks`, `update-room-status`, `create-maintenance-request`).

2.  **Frontend (Web or Mobile)**:
    -   This can be approached in two ways:
        -   **Web**: Create a new set of pages in the Inertia app under a `/housekeeping` route group, designed with a mobile-first, simplified layout.
        -   **Mobile**: Begin scaffolding a separate mobile application project (e.g., using Flutter or React Native) that will consume the API.
    -   **Task List View**:
        -   Fetches data from `GET /api/v1/housekeeping/tasks`.
        -   Displays a list of room names.
    -   **Task Detail View**:
        -   Shows buttons for "Mark as Ready" and "Report Damage".
        -   "Mark as Ready" calls `PATCH /api/v1/rooms/{id}/status`.
    -   **Damage Report Form**:
        -   A simple form with a description field and a file input for the photo.
        -   Submitting the form calls `POST /api/v1/maintenance/requests`.

## Depends On

-   [Issue #6: Check-in & Check-out Flow](06_Checkin_Checkout.md) (for generating cleaning tasks)
-   [Issue #8: Real-time Service Setup](08_Realtime_Setup.md)
