# Issue #2: Database Schema & Multi-Tenancy Setup

-   **Phase**: 1
-   **Priority**: Critical
-   **Module**: Core System, Database

---

## Description

This issue involves implementing the multi-tenant database architecture. This includes creating the central `public` schema for managing tenants and the mechanism to automatically create and migrate tenant-specific schemas.

## Acceptance Criteria

-   A database migration is created for the `public` schema, including `tenants` and `subscriptions` tables.
-   A mechanism is in place to switch the database connection to the correct tenant schema based on the current request (e.g., using middleware that identifies the tenant from the domain or a header).
-   A command or service is created to provision a new tenant. This command must:
    -   Create a new database schema for the tenant.
    -   Run all tenant-specific migrations within that new schema.
    -   Seed any necessary default data for the new tenant.
-   Tenant-specific migrations for core tables (`users`, `roles`, `permissions`) are created.

## Technical Details / Tasks

1.  **Use a Multi-Tenancy Package**:
    -   Evaluate and install a well-supported multi-tenancy package for Laravel, such as `spatie/laravel-multitenancy` or a similar alternative. This will provide most of the underlying logic for tenant identification and database switching.

2.  **Create Landlord Migrations**:
    -   Create migrations for the tables that will live in the central `public` schema.
    -   `tenants` table: `id`, `name`, `domain`, `database_schema_name`, etc.
    -   `subscriptions` table: `id`, `tenant_id`, `plan`, `expires_at`, etc.

3.  **Create Tenant Migrations**:
    -   Place all migrations that should run for each tenant in a separate directory (e.g., `database/migrations/tenant`).
    -   Create initial tenant migrations for:
        -   `users` (tenant-specific users)
        -   `roles`
        -   `permissions`
        -   `role_permission` pivot table

4.  **Implement Tenant Provisioning**:
    -   Create an Artisan command `tenant:create {name} {domain}`.
    -   This command will use the multi-tenancy package's features to:
        -   Create a new record in the `tenants` table.
        -   Create the corresponding new schema in the database.
        -   Run the migrations from the `database/migrations/tenant` directory against the new schema.

5.  **Implement Tenant Identification Middleware**:
    -   Configure the multi-tenancy package's middleware to identify the current tenant for each incoming HTTP request. The initial strategy will be to identify the tenant by domain/subdomain.

## Depends On

-   [Issue #1: Project Setup & Environment Configuration](01_Project_Setup.md)
