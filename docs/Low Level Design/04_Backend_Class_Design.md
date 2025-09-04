# LLD: Backend Class Design

This document outlines the low-level design of key PHP classes in the Laravel backend.

---

## `BookingService` Class

-   **Location**: `app/Services/BookingService.php`
-   **Responsibility**: To encapsulate the business logic for creating and managing bookings, keeping the controller thin. It will be injected into `BookingController`.

```php
<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Collection;

class BookingService
{
    /**
     * Create a new booking.
     *
     * @param array $guestData Information for a new or existing guest.
     * @param array $roomIds The IDs of the rooms to book.
     * @param string $checkInDate The check-in date.
     * @param string $checkOutDate The check-out date.
     * @return Booking The newly created booking model.
     * @throws \App\Exceptions\RoomNotAvailableException
     */
    public function createBooking(array $guestData, array $roomIds, string $checkInDate, string $checkOutDate): Booking
    {
        // 1. Find or create the guest.
        // 2. Check for room availability for the given date range.
        //    - If a room is not available, throw a custom exception.
        // 3. Calculate the total price.
        // 4. Create the Booking record in a database transaction.
        // 5. Attach the rooms to the booking.
        // 6. Return the Booking model.
    }

    /**
     * Process the check-in for a booking.
     *
     * @param Booking $booking The booking to check in.
     * @return Booking The updated booking model.
     * @throws \App\Exceptions\InvalidBookingStatusException
     */
    public function checkIn(Booking $booking): Booking
    {
        // 1. Validate that the booking status is 'confirmed'.
        // 2. Update the booking status to 'checked-in'.
        // 3. Update the status of all associated rooms to 'checked-in'.
        // 4. Fire a 'BookingCheckedIn' event.
        // 5. Return the updated Booking model.
    }

    /**
     * Process the check-out for a booking.
     *
     * @param Booking $booking The booking to check out.
     * @return \App\Models\Invoice The generated invoice.
     */
    public function checkOut(Booking $booking): \App\Models\Invoice
    {
        // 1. Validate that the booking status is 'checked-in'.
        // 2. Update the booking status to 'checked-out'.
        // 3. Update the status of all associated rooms to 'awaiting-cleaning'.
        // 4. Call an InvoiceService to generate the final invoice.
        // 5. Fire a 'BookingCheckedOut' event.
        // 6. Return the generated Invoice model.
    }
}
```

---

## `RoomStatusController` Class

-   **Location**: `app/Http/Controllers/Api/V1/RoomStatusController.php`
-   **Responsibility**: To handle the single action of updating a room's status. This follows the Single Action Controller pattern.

```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRoomStatusRequest;
use App\Models\Room;
use App\Events\RoomStatusChanged;

class RoomStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRoomStatusRequest $request The validated request.
     * @param Room $room The room model resolved from the route parameter.
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UpdateRoomStatusRequest $request, Room $room)
    {
        // The request is already validated by UpdateRoomStatusRequest
        $newStatus = $request->validated()['status'];

        // Optional: Use a service or policy to check if the status transition is valid.
        // e.g., can't go from 'maintenance' to 'checked-in'.

        $room->status = $newStatus;
        $room->save();

        // Broadcast the event to all listening clients.
        broadcast(new RoomStatusChanged($room))->toOthers();

        return response()->json([
            'data' => [
                'id' => $room->id,
                'status' => $room->status,
                'message' => 'Room status updated successfully.'
            ]
        ]);
    }
}
```
-   **Associated Request Class**: `app/Http/Requests/UpdateRoomStatusRequest.php`
    -   This class will contain the authorization logic (e.g., `return $this->user()->can('update-room-status');`) and the validation rules (e.g., `'status' => ['required', 'string', Rule::in(['ready', 'cleaning', 'maintenance'])]`).
