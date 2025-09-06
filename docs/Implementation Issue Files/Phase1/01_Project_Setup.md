# Issue #1: Project Setup & Environment Configuration

-   **Phase**: 1
-   **Priority**: Critical
-   **Module**: Core System

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This initial phase focuses on establishing a robust and scalable foundation for the entire application.

---

## Description

This issue covers the initial setup of the Laravel project, configuration of the development environment using Docker, and establishing coding standards. This is the foundational step for the entire project.

## Acceptance Criteria

-   A new Laravel 11+ project is created.
-   A `docker-compose.yml` file is configured to run the entire development stack (Nginx, PHP-FPM, MariaDB, Redis).
-   The application is accessible via a local domain (e.g., `http://resort-manager.test`) on the host machine.
-   PHP CodeSniffer (or similar) is configured to enforce PSR-12 coding standards.
-   A Git repository is initialized, with a clear branching strategy defined (e.g., GitFlow).
-   A basic README.md file is created with instructions on how to set up and run the development environment.

## Technical Details / Tasks

1.  **Initialize Laravel Project**:
    -   Use Composer to create a new Laravel project: `composer create-project laravel/laravel resort-hotel-management`.

2.  **Configure Docker Environment**:
    -   Create a `docker-compose.yml` file at the project root.
    -   Define services for:
        -   `app` (PHP-FPM 8.2+)
        -   `web` (Nginx)
        -   `db` (MariaDB 10.6+)
        -   `cache` (Redis)
    -   Configure volumes to mount the application code into the `app` container.
    -   Configure the Nginx service to proxy requests to the PHP-FPM container.
    -   Set up a shared Docker network for the services to communicate.

3.  **Environment Configuration**:
    -   Create a `.env.example` file with all necessary environment variables for database, cache, and application settings.
    -   Ensure the `.env` file is in `.gitignore`.

4.  **Coding Standards**:
    -   Add `squizlabs/php_codesniffer` as a dev dependency.
    -   Create a `phpcs.xml` file in the root to configure PSR-12 standards.
    -   Add a script to `composer.json` for running the linter (e.g., `composer lint`).

5.  **Version Control**:
    -   Initialize a Git repository: `git init`.
    -   Create an initial commit with the base Laravel project.
    -   Define and document the branching strategy (e.g., `main`, `develop`, `feature/*`, `release/*`, `hotfix/*`).

## Depends On

-   None. This is the first issue.
