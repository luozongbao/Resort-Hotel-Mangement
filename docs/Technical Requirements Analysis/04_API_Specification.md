# 4. API Specification

This document defines the structure and conventions for the RESTful API of the Resort Hotel Management System.

## 4.1. General Principles
-   **Stateless**: Every API request must contain all the information needed for the server to process it. The server will not store any client session state.
-   **JSON**: All data exchange between the client and server will be in JSON format.
-   **Standard HTTP Verbs**: The API will use standard HTTP methods for operations:
    -   `GET`: Retrieve resources.
    -   `POST`: Create new resources.
    -   `PUT` / `PATCH`: Update existing resources.
    -   `DELETE`: Remove resources.
-   **Versioning**: The API will be versioned via the URL (e.g., `/api/v1/...`) to ensure backward compatibility as the API evolves.

## 4.2. Authentication
-   **JWT (JSON Web Tokens)**: Authentication will be handled using JWT.
-   **Login Endpoint**: A `POST /api/v1/auth/login` endpoint will accept user credentials and return a JWT upon successful authentication.
-   **Authorization Header**: All subsequent requests to protected endpoints must include the JWT in the `Authorization` header as a Bearer token: `Authorization: Bearer <token>`.

## 4.3. API Endpoints (Examples)

The following are examples of key API endpoints. All endpoints are prefixed with `/api/v1`.

### Accommodation Management
-   `GET /rooms`: List all rooms, with filtering by status, location, etc.
-   `GET /rooms/{id}`: Get details of a specific room.
-   `PATCH /rooms/{id}/status`: Update the status of a room (e.g., from 'cleaning' to 'ready').
-   `GET /room-types`: List all room types.
-   `POST /room-types`: Create a new room type.

### Booking Management
-   `POST /bookings`: Create a new booking.
-   `GET /bookings`: List all bookings, with filtering by date.
-   `POST /bookings/{id}/check-in`: Perform the check-in process for a booking.
-   `POST /bookings/{id}/check-out`: Perform the check-out process and trigger invoice generation.

### Guest Management
-   `GET /guests`: Search for guests.
-   `POST /guests`: Create a new guest profile.
-   `GET /guests/{id}`: Get a guest's details and their stay history.

### Housekeeping & Maintenance
-   `GET /housekeeping/tasks`: Get a list of rooms that need cleaning.
-   `POST /maintenance/requests`: Create a new maintenance request (report damage).
-   `GET /maintenance/requests`: List all active maintenance requests.
-   `PATCH /maintenance/requests/{id}/complete`: Mark a maintenance task as complete.

### SaaS Provider Admin
-   `GET /admin/tenants`: List all customer accounts.
-   `POST /admin/tenants`: Create a new tenant.
-   `GET /admin/tenants/{id}`: Get details for a specific tenant.

## 4.4. Standard Response Format

### Success (2xx)
```json
{
    "data": {
        "id": 1,
        "name": "Deluxe Room",
        "capacity": 2
        // ... other fields
    }
}
```

### Error (4xx / 5xx)
```json
{
    "error": {
        "code": 422,
        "message": "Validation Failed",
        "errors": {
            "email": ["The email field is required."]
        }
    }
}
```
