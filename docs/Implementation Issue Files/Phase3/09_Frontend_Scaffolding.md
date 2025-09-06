# Issue #9: Frontend Scaffolding & Authentication

-   **Phase**: 3
-   **Priority**: Critical
-   **Module**: Frontend

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 3: Frontend & User Interfaces** and focuses on building the frontend foundation, including the user interface framework and authentication flow.

---

## Description

Set up the frontend application using Vue.js (or React) and Inertia.js. This includes creating the basic layout, setting up API communication, and implementing the login flow.

## Acceptance Criteria

-   Vue.js 3 and Inertia.js are installed and configured in the Laravel project.
-   A main application layout is created (e.g., with a sidebar and top navigation).
-   A login page is created that allows users to authenticate via the API.
-   Upon successful login, the JWT is securely stored in the client (e.g., in a cookie or local storage).
-   An Axios instance (or similar) is configured to automatically include the JWT in the `Authorization` header for all subsequent API requests.
-   A "logout" feature is implemented that clears the JWT and redirects to the login page.
-   The frontend correctly handles expired tokens by redirecting the user to the login page.

## Technical Details / Tasks

1.  **Install Frontend Dependencies**:
    -   Install the required NPM packages: `vue`, `@inertiajs/vue3`, etc.
    -   Configure Vite to compile the frontend assets.

2.  **Configure Inertia.js**:
    -   Set up the root Blade template (`app.blade.php`) that will host the Inertia app.
    -   Configure the Inertia middleware in Laravel.
    -   Create the main `app.js` file to initialize the Vue/Inertia app.

3.  **Create API Service**:
    -   Create a service file (e.g., `resources/js/services/api.js`) that exports a configured Axios instance.
    -   Use an interceptor to add the `Authorization: Bearer <token>` header to every outgoing request.
    -   Add another interceptor to handle `401 Unauthorized` responses globally by clearing the user session and redirecting to the login page.

4.  **Implement State Management (for Auth)**:
    -   Use a simple store (like Pinia for Vue) or a global state management solution to store the user's authentication status and token.
    -   Create actions for `login` and `logout`.
    -   The `login` action will call the API, and on success, store the token and user data, then redirect to the dashboard.
    -   The `logout` action will clear the token and user data from the store and redirect.

5.  **Create Core Pages/Components**:
    -   `LoginPage.vue`: A public page with a form to handle user login.
    -   `AppLayout.vue`: A persistent layout for authenticated pages, containing the main navigation structure.
    -   `DashboardPage.vue`: A placeholder page for the main dashboard, protected by authentication.

6.  **Update Laravel Routes**:
    -   Modify `routes/web.php` to render Inertia pages.
    -   The `/login` route will render the `LoginPage`.
    -   The `/` (dashboard) route will be protected by Laravel's `auth` middleware, which will now redirect to the Inertia login page if the user is not authenticated.

## Depends On

-   [Issue #3: User Authentication & RBAC](03_Authentication_RBAC.md)
