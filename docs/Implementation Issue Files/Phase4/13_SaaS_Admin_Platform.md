# Issue #13: SaaS Admin Platform - Tenant Management

-   **Phase**: 4
-   **Priority**: High
-   **Module**: SaaS Platform

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 4: Administration & Deployment** and focuses on building the central administration platform for the SaaS provider to manage tenants.

---

## Description

Create a basic administrative interface for the SaaS provider to manage customer (tenant) accounts. This is a separate "god-mode" interface from the main resort management application.

## Acceptance Criteria

-   A new web route group and middleware are created for the SaaS admin panel (e.g., accessible via `admin.resort-manager.test`).
-   Authentication for this panel is separate and uses a `users` table in the `public` (landlord) database.
-   A UI is created to list all tenants in the system.
-   A UI is created to provision a new tenant. The form should accept the tenant's name and domain, and trigger the `tenant:create` command or an equivalent service.
-   A UI is created to view basic details of a tenant and their subscription plan.
-   Access to this entire section is strictly limited to users authenticated against the landlord guard.

## Technical Details / Tasks

1.  **Create Landlord User Guard**:
    -   Define a new authentication guard (e.g., `admin`) in `config/auth.php` that uses the `users` table in the `public` database.
    -   Create a separate login form and logic for this guard.

2.  **Create Admin Routes and Controllers**:
    -   In `routes/web.php`, define a route group for the admin panel, protected by the new `auth:admin` middleware.
    -   Create controllers for the admin panel, such as `Admin\TenantController`. These controllers will NOT use the multi-tenancy middleware.

3.  **Implement Tenant Listing**:
    -   The `TenantController@index` method will query the `Tenant` model directly from the landlord database and pass the data to an Inertia view.
    -   Create the `TenantListPage.vue` component to display the tenants in a table.

4.  **Implement Tenant Creation UI**:
    -   Create a `TenantCreatePage.vue` with a form for the new tenant's details.
    -   Submitting the form will call a new endpoint, e.g., `POST /admin/tenants`.
    -   The `TenantController@store` method will execute the tenant provisioning logic (either by calling the Artisan command programmatically or by using a dedicated service).

5.  **Build the UI**:
    -   The admin panel can have a simpler UI than the main application.
    -   Create a separate layout file, `AdminLayout.vue`, for this section.

## Depends On

-   [Issue #2: Database Schema & Multi-Tenancy Setup](02_Database_Multitenancy.md)
