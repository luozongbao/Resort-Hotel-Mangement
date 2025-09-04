# 9. Installation and Onboarding

This document outlines the requirements for the installation process and the initial onboarding of new customers (tenants). The goal is to make the setup process as simple and automated as possible, similar to the famous WordPress "5-minute install".

## 9.1. Web-Based Installer
-   **Setup Wizard**: A user-friendly, web-based wizard will guide the system administrator or technical team through the installation process.
-   **Entry Point**: The installer will run automatically if the system detects that it hasn't been installed yet (e.g., by checking for the presence of a specific configuration or lock file).

## 9.2. Installation Steps

### Step 1: System Requirements Check
-   The installer will first perform a series of checks to ensure the server environment meets the minimum requirements:
    -   **PHP Version** (e.g., 8.2+).
    -   Required **PHP Extensions** (e.g., PDO, OpenSSL, Mbstring).
    -   **File Permissions**: Check if the necessary directories (e.g., `storage`, `bootstrap/cache`) are writable.
    -   **Server Capacity**: Basic checks for available memory and storage (optional but recommended).

### Step 2: Database Configuration
-   The user will be prompted to enter the database connection details:
    -   Database Host
    -   Database Port
    -   Database Name
    -   Database Username
    -   Database Password
-   The installer will test the connection before proceeding.

### Step 3: Initial Data Seeding
-   Upon successful database connection, the installer will:
    -   Run the main database migrations to create the `public` schema and all necessary tables for the SaaS provider platform.
    -   Seed any initial required data, such as default subscription plans or system settings.

### Step 4: SaaS Admin Account Setup
-   The user will be prompted to create the first system administrator account for the SaaS provider platform:
    -   Username
    -   Email
    -   Password

### Step 5: Finalization
-   The installer will write the final configuration files (e.g., `.env`).
-   It will create a lock file (e.g., `storage/installed`) to prevent the installer from being run again.
-   The user will then be redirected to the login page of the Business Admin Module.

## 9.3. Tenant Onboarding
-   **Admin Interface**: New tenants (customers) will be created through the Business Admin Module by the SaaS provider.
-   **Automated Tenant Setup**: When a new tenant is created, the system will automatically:
    -   Create a new, dedicated schema for the tenant in the database.
    -   Run all necessary database migrations within that new schema.
    -   Create the first "Resort Admin" user for that tenant.
-   **License Key Validation**: The system will include a mechanism for managing and validating license keys, which are tied to a tenant's subscription plan.
