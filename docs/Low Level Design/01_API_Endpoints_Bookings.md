# LLD: API Endpoints - Bookings

This document provides a low-level design for the API endpoints related to the `Bookings` resource.

---

## 1. Create a New Booking

-   **Endpoint**: `POST /api/v1/bookings`
-   **Permission**: `create-booking`
-   **Description**: Creates a new booking for a guest.

### Request Body

```json
{
    "guest_id": 123, // Optional: ID of an existing guest
    "guest_info": { // Required if guest_id is not provided
        "name": "John Doe",
        "email": "john.doe@example.com",
        "phone": "123-456-7890"
    },
    "room_ids": [1, 5, 6], // Array of Room IDs to be booked
    "check_in_date": "2025-12-20",
    "check_out_date": "2025-12-25"
}
```

### Success Response (201 Created)

```json
{
    "data": {
        "id": 45,
        "guest_id": 123,
        "check_in_date": "2025-12-20",
        "check_out_date": "2025-12-25",
        "status": "confirmed",
        "rooms": [
            {"id": 1, "name": "Raft 01"},
            {"id": 5, "name": "Villa 02"},
            {"id": 6, "name": "Villa 03"}
        ]
    }
}
```

### Error Responses
-   `422 Unprocessable Entity`: If validation fails (e.g., dates are invalid, a room is not available).
-   `403 Forbidden`: If the user does not have the `create-booking` permission.

---

## 2. Check-In a Booking

-   **Endpoint**: `POST /api/v1/bookings/{id}/check-in`
-   **Permission**: `process-check-in`
-   **Description**: Marks a booking and its associated rooms as 'Checked-in'.

### Request Body
(Empty)

### Success Response (200 OK)

```json
{
    "data": {
        "id": 45,
        "status": "checked-in",
        "message": "Booking checked in successfully."
    }
}
```

### Error Responses
-   `404 Not Found`: If the booking with the given `{id}` does not exist.
-   `409 Conflict`: If the booking is not in a state that can be checked in (e.g., already checked-in or cancelled).

---

## 3. Check-Out a Booking

-   **Endpoint**: `POST /api/v1/bookings/{id}/check-out`
-   **Permission**: `process-check-out`
-   **Description**: Marks a booking as 'Checked-out', its rooms as 'Awaiting Cleaning', and generates the final invoice.

### Request Body
(Empty)

### Success Response (200 OK)

```json
{
    "data": {
        "booking_id": 45,
        "booking_status": "checked-out",
        "invoice": {
            "id": 1024,
            "total_amount": "1500.00",
            "tax_amount": "105.00",
            "payable_amount": "1605.00"
        },
        "message": "Booking checked out successfully. Invoice generated."
    }
}
```

### Error Responses
-   `404 Not Found`: If the booking does not exist.
-   `409 Conflict`: If the booking is not in a 'Checked-in' state.
