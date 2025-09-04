# Component Diagram

This document provides a high-level overview of the major software components of the Resort Hotel Management System and how they interact.

## High-Level Component Architecture

```mermaid
graph TD
    subgraph "Client Tier"
        WebApp[Web Application <br> (Vue.js/React + Inertia.js)]
        MobileApp[Mobile Applications <br> (Flutter/React Native)]
    end

    subgraph "Application Tier (Backend)"
        API[RESTful API <br> (Laravel)]
        Auth[Authentication Service <br> (JWT, RBAC)]
        Realtime[Real-time Service <br> (WebSockets)]
        Queue[Job Queue]
    end

    subgraph "Data Tier"
        DB[(MariaDB Database <br> Multi-Tenant Schemas)]
        Cache[(Redis <br> Cache / Session)]
        FileStorage[(File Storage <br> S3 / Local)]
    end

    subgraph "External Services"
        Email[Email Service <br> (SMTP/API)]
        SMS[SMS Gateway]
        Payment[Payment Gateway]
    end

    WebApp -- "HTTP/S Requests" --> API
    MobileApp -- "HTTP/S Requests" --> API

    API -- "Authenticates/Authorizes" --> Auth
    API -- "Reads/Writes Data" --> DB
    API -- "Caches Data" --> Cache
    API -- "Stores Files (e.g., IDs)" --> FileStorage
    API -- "Dispatches Jobs" --> Queue
    API -- "Sends Real-time Events" --> Realtime

    Realtime -- "Pushes Updates" --> WebApp
    Realtime -- "Pushes Notifications" --> MobileApp

    Queue -- "Processes Jobs (e.g., sending emails)" --> Email
    Queue -- "Processes Jobs (e.g., sending SMS)" --> SMS

    API -- "Integrates With" --> Payment

    linkStyle 0,1 stroke-width:2px,fill:none,stroke:green;
    linkStyle 2,3,4,5,6,7 stroke-width:2px,fill:none,stroke:blue;
    linkStyle 8,9 stroke-width:2px,fill:none,stroke:orange,stroke-dasharray: 5 5;
    linkStyle 10,11 stroke-width:2px,fill:none,stroke:purple,stroke-dasharray: 5 5;
    linkStyle 12 stroke-width:2px,fill:none,stroke:red,stroke-dasharray: 5 5;
```

## Component Descriptions

-   **Web Application**: The primary interface for resort management staff (Admins, Managers, Front Desk) and SaaS provider admins. It's a Single Page Application (SPA) built with a modern JavaScript framework.
-   **Mobile Applications**: Task-specific native apps for operational staff (Housekeeping, Maintenance). They communicate with the backend via the same REST API.
-   **RESTful API (Laravel)**: The central component that contains all the business logic. It handles requests from all clients, processes data, and interacts with the data tier and external services.
-   **Authentication Service**: A core part of the API responsible for handling user login, issuing JWTs, and enforcing Role-Based Access Control (RBAC) on every request.
-   **Real-time Service**: Manages WebSocket connections to provide real-time updates to clients for features like live dashboards and notifications.
-   **Job Queue**: Handles background tasks like sending emails or processing bulk data imports, preventing long-running tasks from blocking the API response.
-   **MariaDB Database**: The primary data store, using a multi-tenant architecture with a separate schema for each customer to ensure data isolation.
-   **Redis**: An in-memory data store used for caching, managing user sessions, and as a broker for the job queue.
-   **File Storage**: A system for storing binary files, such as guest ID photos or exported reports. This could be a local file system or a cloud-based object storage service like Amazon S3.
-   **External Services**: Third-party integrations for essential services like sending emails, SMS notifications, and processing payments.
