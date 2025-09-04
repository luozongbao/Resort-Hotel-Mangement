# 3. Database Design

This document outlines the high-level database design and schema structure for the Resort Hotel Management System.

## 3.1. Tenancy Model
-   **Multi-Tenant with Schema Separation**: The system will use a multi-tenant architecture where each tenant (customer) has its own dedicated database schema. This ensures strong data isolation.
-   **`public` Schema**: A central schema will store global information, including:
    -   `tenants`: Information about each customer/tenant.
    -   `users`: System-level users (SaaS provider admins).
    -   `subscriptions`: Subscription plans and tenant subscription status.
-   **Tenant Schemas**: Each tenant schema (e.g., `tenant_123`) will contain all the operational tables for that specific resort business.

## 3.2. Key Tables (within each Tenant Schema)

### Accommodation
-   `accommodation_locations`: Stores areas or sections of a resort (e.g., 'Beachfront', 'Garden Wing').
-   `accommodation_types`: Stores types of properties (e.g., 'Raft', 'Villa', 'Bungalow').
-   `room_types`: Defines categories of rooms (e.g., 'Deluxe', 'Standard', 'Suite') with properties like `name`, `capacity`.
-   `rooms`: Represents individual rooms, linked to a location, accommodation type, and room type. Contains the current `room_status` (e.g., 'ready', 'cleaning', 'maintenance').

### Guest & Booking
-   `guests`: Stores profiles of all guests, including `name`, `email`, `phone`, `address`, and a reference to their ID card photo.
-   `bookings`: The central table for reservations, linking a `guest` to one or more `rooms` for a specific date range (`check_in_date`, `check_out_date`).
-   `booking_rooms`: A pivot table to handle bookings with multiple rooms.

### Billing & Invoicing
-   `invoices`: Generated upon checkout, linked to a `booking`. Stores total amount, tax, and discount information.
-   `invoice_items`: Line items for an invoice, including room charges, activity fees, and other services.
-   `discounts` / `coupons`: Tables to manage applicable promotions.

### Activities
-   `activities`: A list of manageable activities offered by the resort.
-   `activity_pricing`: Defines the pricing models for activities (per person, per room, package).
-   `booked_activities`: Links guests/bookings to activities they have purchased.

### Staff & Security
-   `users`: Tenant-level users (resort staff).
-   `roles`: Defines user roles (e.g., 'Admin', 'Manager', 'Housekeeper').
-   `permissions`: Defines granular permissions for actions within the system.
-   `role_permissions`: A pivot table linking roles to permissions.

### Operations
-   `maintenance_requests`: Logs all damage reports and maintenance tasks, including `room_id`, `description`, `status`, and assigned `technician_id`.
-   `housekeeping_logs`: Tracks cleaning tasks, linking `room_id`, `housekeeper_id`, and timestamps.

## 3.3. Relationships (Examples)
-   A `Room` belongs to an `AccommodationLocation`, `AccommodationType`, and `RoomType`.
-   A `Booking` belongs to a `Guest` and has many `Rooms`.
-   An `Invoice` is generated from a `Booking`.
-   A `MaintenanceRequest` belongs to a `Room`.
