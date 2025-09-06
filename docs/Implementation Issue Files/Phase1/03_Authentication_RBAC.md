# Issue #3: User Authentication & RBAC

-   **Phase**: 1
-   **Priority**: Critical
-   **Module**: Security, Core System

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 1: Core Foundation** and focuses on implementing a secure authentication and authorization system, which is critical for protecting tenant data.

---

## Description

Implement a secure authentication system using JWT and a flexible Role-Based Access Control (RBAC) system for authorization. This will govern what actions users are allowed to perform throughout the application.

## Acceptance Criteria

-   Users can register and log in via API endpoints.
-   Successful login returns a JWT.
-   API routes are protected, requiring a valid JWT in the `Authorization` header.
-   A `roles` and `permissions` system is in place.
-   API routes are protected by permission-based middleware (e.g., `middleware('can:create-booking')`).
-   A database seeder is created to populate the database with default roles ('Resort Admin', 'Manager', 'Front Desk', 'Housekeeper', 'Maintenance') and their associated permissions.
-   The system correctly scopes all queries and actions to the currently authenticated user's tenant.

## Technical Details / Tasks

1.  **Install and Configure JWT Package**:
    -   Install a JWT package like `tymon/jwt-auth`.
    -   Publish and configure the package.
    -   Implement the `User` model to be JWT-compatible.

2.  **Create Authentication Endpoints**:
    -   `POST /api/v1/auth/login`: Authenticates a user and returns a JWT.
    -   `POST /api/v1/auth/register`: Creates a new user within the current tenant.
    -   `POST /api/v1/auth/logout`: Invalidates the user's JWT.
    -   `POST /api/v1/auth/me`: Returns the currently authenticated user's information.

3.  **Implement RBAC Package**:
    -   Install and configure the `spatie/laravel-permission` package. This package works well with multi-tenancy.
    -   Use the package's migrations to create `roles`, `permissions`, and pivot tables within the tenant schemas.

4.  **Define Roles and Permissions**:
    -   Create a seeder (`RolesAndPermissionsSeeder`) to be run for each new tenant.
    -   In the seeder, define all the granular permissions required (e.g., `view-dashboard`, `create-booking`, `update-room-status`, `manage-users`).
    -   Create the default roles and assign the appropriate permissions to each.

5.  **Secure Routes**:
    -   Group API routes under the `auth:api` middleware.
    -   Apply the permission-based middleware from the Spatie package to specific routes or controller methods.
    -   Example: `Route::post('/bookings', ...)->middleware('can:create-booking');`

## Depends On

-   [Issue #2: Database Schema & Multi-Tenancy Setup](02_Database_Multitenancy.md)
