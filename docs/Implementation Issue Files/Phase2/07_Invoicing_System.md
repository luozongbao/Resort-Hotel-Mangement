# Issue #7: Billing and Invoicing System

-   **Phase**: 2
-   **Priority**: High
-   **Module**: Billing

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 2: Core Operations** and focuses on creating the billing and invoicing system, a key component for revenue management.

---

## Description

Develop the system for generating invoices upon check-out. This includes calculating the total cost based on room rates, duration, and any additional services. The initial version will focus on the core calculation and invoice creation.

## Acceptance Criteria

-   An `invoices` table and corresponding `Invoice` model are created.
-   An `invoice_items` table and `InvoiceItem` model are created.
-   An `InvoiceService` is created to handle the logic of generating an invoice from a booking.
-   The `checkOut` method in `BookingService` is updated to call `InvoiceService` and create the invoice record.
-   The invoice calculation correctly determines the cost based on the room types and number of nights.
-   The `POST /api/v1/bookings/{id}/check-out` endpoint returns the generated invoice details.
-   The system supports adding a flat tax rate (e.g., 7% VAT) to the invoice total.

## Technical Details / Tasks

1.  **Create Database Schema**:
    -   Create migrations for the `invoices` and `invoice_items` tables as per the LLD.
    -   Define the `Invoice` and `InvoiceItem` models and their relationships (`Invoice` has many `InvoiceItems`, `Invoice` belongs to `Booking`).

2.  **Store Pricing Information**:
    -   Add a `price_per_night` column to the `room_types` table. This will be the basis for cost calculation.

3.  **Develop `InvoiceService`**:
    -   Create `app/Services/InvoiceService.php`.
    -   Implement a `generateFromBooking(Booking $booking)` method.
    -   **Calculation Logic**:
        -   Calculate the number of nights for the booking.
        -   Iterate through the booking's rooms. For each room, get its room type's `price_per_night`.
        -   Create an `InvoiceItem` for each room for each night.
        -   Sum the totals to get the subtotal.
        -   Calculate the tax based on a percentage defined in a config file (e.g., `config/billing.php`).
        -   Create the `Invoice` record with the final amounts.
    -   The entire process should be in a database transaction.

4.  **Integrate with `BookingService`**:
    -   In `BookingService@checkOut`, after successfully updating the room statuses, call `invoiceService->generateFromBooking($booking)`.
    -   Return the generated `Invoice` object.

5.  **Update API Response**:
    -   Modify the response of the check-out endpoint to include the serialized invoice data. Create an `InvoiceResource`.

6.  **Write Tests**:
    -   Write unit tests for the `InvoiceService`, focusing on the accuracy of the calculation logic.
    -   Update the feature test for the check-out endpoint to assert that a correct invoice is generated and returned in the response.

## Depends On

-   [Issue #6: Check-in & Check-out Flow](06_Checkin_Checkout.md)
