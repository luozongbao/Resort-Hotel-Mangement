# Issue #6: Check-in & Check-out Flow

-   **Phase**: 2
-   **Priority**: Critical
-   **Module**: Bookings, Operations

---

## Description

Implement the API endpoints and business logic for the guest check-in and check-out processes. This is a critical operational workflow.

## Acceptance Criteria

-   A `POST /api/v1/bookings/{id}/check-in` endpoint is created.
-   Successfully calling the check-in endpoint updates the booking status to `checked-in` and the status of all associated rooms to `checked-in`.
-   A `POST /api/v1/bookings/{id}/check-out` endpoint is created.
-   Successfully calling the check-out endpoint updates the booking status to `checked-out` and the status of all associated rooms to `awaiting-cleaning`.
-   The endpoints return appropriate error responses (`409 Conflict`) if the booking is not in a valid state for the action.
-   The logic is added to the `BookingService`.
-   The check-in and check-out processes fire real-time events (`BookingCheckedIn`, `BookingCheckedOut`, `RoomStatusChanged`).

## Technical Details / Tasks

1.  **Extend `BookingService`**:
    -   Add the `checkIn(Booking $booking)` method as defined in the LLD.
        -   Include validation to ensure the booking status is `confirmed`.
        -   Loop through `$booking->rooms` and update their statuses.
        -   Fire a `BookingCheckedIn` event.
    -   Add the `checkOut(Booking $booking)` method.
        -   Include validation to ensure the booking status is `checked-in`.
        -   Loop through `$booking->rooms` and update their statuses.
        -   Fire a `BookingCheckedOut` event.

2.  **Create Events**:
    -   Create the `App\Events\BookingCheckedIn` event class.
    -   Create the `App\Events\BookingCheckedOut` event class.
    -   Create the `App\Events\RoomStatusChanged` event class. This event will be broadcastable.

3.  **Create Event Listeners (for `RoomStatusChanged`)**:
    -   Create a listener for `BookingCheckedIn` that fires a `RoomStatusChanged` event for each affected room.
    -   Create a listener for `BookingCheckedOut` that fires a `RoomStatusChanged` event for each affected room. This decouples the booking process from the room status notification.

4.  **Implement Controller Methods**:
    -   In `BookingController`, add a `checkIn(Booking $booking)` method that calls the service and returns a response.
    -   Add a `checkOut(Booking $booking)` method that calls the service.

5.  **Define Routes**:
    -   Add the `POST` routes for `/bookings/{id}/check-in` and `/bookings/{id}/check-out` to `routes/api.php`.
    -   Protect them with the appropriate permissions (`process-check-in`, `process-check-out`).

6.  **Write Tests**:
    -   Add feature tests for the check-in endpoint, including success and failure (wrong status) cases.
    -   Add feature tests for the check-out endpoint.
    -   Ensure that the tests assert that the correct events were fired. Use `Event::fake()`.

## Depends On

-   [Issue #5: Booking Engine Implementation](05_Booking_Engine.md)
-   [Issue #8: Real-time Service Setup](08_Realtime_Setup.md) (can be developed concurrently)
