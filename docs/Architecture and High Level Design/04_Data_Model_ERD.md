# Data Model (Entity-Relationship Diagram)

This document provides a high-level Entity-Relationship Diagram (ERD) illustrating the core entities of the Resort Hotel Management System and their relationships. This is a simplified model focusing on the main operational data within a single tenant's schema.

## ERD

```mermaid
erDiagram
    GUESTS {
        int id PK
        string name
        string email
        string phone
    }

    BOOKINGS {
        int id PK
        int guest_id FK
        date check_in_date
        date check_out_date
        string status
    }

    ROOMS {
        int id PK
        int room_type_id FK
        string name
        string status
    }

    ROOM_TYPES {
        int id PK
        string name
        int capacity
    }

    BOOKING_ROOMS {
        int booking_id PK, FK
        int room_id PK, FK
    }

    INVOICES {
        int id PK
        int booking_id FK
        decimal total_amount
        decimal tax_amount
    }

    MAINTENANCE_REQUESTS {
        int id PK
        int room_id FK
        int reported_by_id FK
        string description
        string status
    }

    USERS {
        int id PK
        string name
        string role
    }

    GUESTS ||--o{ BOOKINGS : "has"
    BOOKINGS ||--|{ BOOKING_ROOMS : "books"
    ROOMS ||--|{ BOOKING_ROOMS : "is booked in"
    ROOMS ||--|{ ROOM_TYPES : "is of type"
    BOOKINGS ||--o{ INVOICES : "generates"
    ROOMS ||--o{ MAINTENANCE_REQUESTS : "can have"
    USERS ||--o{ MAINTENANCE_REQUESTS : "reports"

```

## Key Relationships

-   **Guests and Bookings**: A `GUEST` can have one or more `BOOKINGS`. Each `BOOKING` belongs to exactly one `GUEST`.
-   **Bookings and Rooms**: A `BOOKING` can include one or more `ROOMS`, and a `ROOM` can be part of many `BOOKINGS` over time (but not at the same time). This many-to-many relationship is resolved by the `BOOKING_ROOMS` pivot table.
-   **Rooms and Room Types**: Each `ROOM` is of a specific `ROOM_TYPE`, which defines its characteristics like name ('Deluxe') and capacity.
-   **Bookings and Invoices**: A `BOOKING` typically results in one `INVOICE` upon check-out.
-   **Rooms and Maintenance**: A `ROOM` can have multiple `MAINTENANCE_REQUESTS` over its lifetime. Each request is linked to the specific room that needs attention.
-   **Users and Maintenance**: A `USER` (like a housekeeper) can report a `MAINTENANCE_REQUEST`. This helps track who reported the issue.
