# Issue #5: Booking Engine Implementation

-   **Phase**: 2
-   **Priority**: Critical
-   **Module**: Bookings

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 2: Core Operations** and focuses on developing the core booking engine, a central piece of the resort's operational workflow.

---

## Description

Implement the core logic for creating and managing bookings. This includes checking for room availability, handling guest information, and creating the booking record.

## Acceptance Criteria

-   The `POST /api/v1/bookings` endpoint is fully functional as per the LLD.
-   The system can create a booking for a new guest or an existing guest.
-   The system correctly checks for room availability and prevents double-booking. An appropriate error (`422 Unprocessable Entity`) is returned if any selected room is unavailable for the given date range.
-   All booking creation logic is encapsulated within a `BookingService` class.
-   The booking process is wrapped in a database transaction to ensure data integrity.
-   Unit tests are created for the `BookingService`, including the availability check.
-   Feature tests are created for the API endpoint.

## Technical Details / Tasks

1.  **Create Booking Models and Migrations**:
    -   Create the `Booking` model and migration.
    -   Create the `Guest` model and migration.
    -   Create the `booking_room` pivot table and its migration.
    -   Define the Eloquent relationships: `Booking` belongs to `Guest`, `Booking` has many `Rooms` (through the pivot table).

2.  **Develop `BookingService`**:
    -   Create the `app/Services/BookingService.php` class.
    -   Implement the `createBooking` method.
    -   **Availability Logic**: Inside the service, implement a method `areRoomsAvailable(array $roomIds, $checkInDate, $checkOutDate)`. This method will query the `booking_room` table to see if any of the given room IDs exist in a booking that overlaps with the requested date range.
    -   **Guest Logic**: Implement a `findOrCreateGuest` method.
    -   Wrap the creation of the `Booking`, `Guest` (if new), and `booking_room` attachments in `DB::transaction()`.

3.  **Implement `BookingController`**:
    -   Create the `BookingController`.
    -   Inject `BookingService` into the controller's constructor.
    -   The `store` method will call `bookingService->createBooking()` and return the appropriate API resource.

4.  **Create Request Validation**:
    -   Create a `StoreBookingRequest` form request class.
    -   Add validation rules for all input fields as specified in the LLD.

5.  **Write Tests**:
    -   **Unit Test**: Test the `BookingService` in isolation. Mock the database and test the availability logic specifically.
    -   **Feature Test**: Test the `POST /api/v1/bookings` endpoint.
        -   Test the success case.
        -   Test the failure case where a room is not available.
        -   Test the validation failure case.

## Depends On

-   [Issue #4: Core Accommodation Management](04_Accommodation_CRUD.md)
