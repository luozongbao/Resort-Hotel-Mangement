# Issue #8: Real-time Service Setup

-   **Phase**: 2
-   **Priority**: High
-   **Module**: Core System, Real-time

---

## Project Overview

This project aims to build a comprehensive, multi-tenant SaaS platform for Resort Hotel Management. It will cover all major operations from booking and guest management to housekeeping and invoicing. This issue is a part of **Phase 2: Core Operations** and focuses on enabling real-time features, which will provide a dynamic and responsive user experience for operational dashboards.

---

## Description

Set up and configure the WebSocket server to enable real-time communication between the backend and frontend clients. This is essential for live dashboards and notifications.

## Acceptance Criteria

-   A WebSocket server is integrated into the project and runs as part of the Docker environment.
-   The Laravel backend is configured to broadcast events to the WebSocket server.
-   The frontend (even a placeholder) can connect to the WebSocket server and subscribe to channels.
-   Authentication is implemented for private channels, ensuring tenants can only receive their own data.
-   The `RoomStatusChanged` event is successfully broadcast and received by a test client when a room's status is updated.

## Technical Details / Tasks

1.  **Install WebSocket Server**:
    -   Install a package like `beyondcode/laravel-websockets`. This provides a Pusher-compatible WebSocket server written in PHP.
    -   Publish the package's configuration and migration files.
    -   Add a new service to the `docker-compose.yml` file to run the WebSocket server via the `websockets:serve` Artisan command.

2.  **Configure Broadcasting**:
    -   In `.env`, set the `BROADCAST_DRIVER` to `pusher`.
    -   Configure the `config/broadcasting.php` file to point to the local WebSocket server.
    -   Uncomment the `BroadcastServiceProvider` in `config/app.php`.

3.  **Implement Channel Authorization**:
    -   Define the private channel route in `routes/channels.php`.
    -   The authorization callback for the `private-tenant.{tenantId}` channel must verify that the authenticated user belongs to the specified tenant.
    -   Example:
        ```php
        Broadcast::channel('private-tenant.{tenantId}', function ($user, $tenantId) {
            return $user->tenant_id === (int) $tenantId;
        });
        ```

4.  **Make Events Broadcastable**:
    -   Implement the `ShouldBroadcast` interface on the `RoomStatusChanged` event class.
    -   Define the `broadcastOn()` method to specify the private tenant channel.
    -   Define the `broadcastAs()` method to specify the event name as per the LLD.
    -   Define the `broadcastWith()` method to control the payload data.

5.  **Create a Test Client**:
    -   For now, a simple HTML file with JavaScript using Laravel Echo can be used to test the connection.
    -   Install Laravel Echo and the Pusher JS client via NPM.
    -   Write a simple script to instantiate Echo, connect to the server, and listen on the `private-tenant.{id}` channel for the `RoomStatusChanged` event, logging the payload to the console.

## Depends On

-   [Issue #3: User Authentication & RBAC](03_Authentication_RBAC.md)
