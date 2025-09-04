# 1. System Architecture

## 1.1. Architectural Model
-   **Software-as-a-Service (SaaS)**: The system will be a multi-tenant application, where a single instance of the software serves multiple customer organizations (tenants).
-   **Monolithic-Modular Architecture**: The application will be built as a single, unified codebase but will be internally structured into distinct, loosely-coupled modules (e.g., Accommodation, Billing, Housekeeping). This approach, often called a "modern monolith," allows for clear separation of concerns and easier maintenance.
-   **API-Centric Design**: A primary RESTful API will serve as the backbone for all client applications (Web, Desktop, Mobile), ensuring consistent business logic and data access across all platforms.

## 1.2. Tenancy Model
-   **Multi-tenancy with Schema Separation**: Each tenant (customer) will have their data isolated in a separate database schema. This provides a strong level of data security and isolation while still allowing for efficient management of a single database instance. A central `landlord` or `public` schema will manage tenant information, subscriptions, and global settings.

## 1.3. Platform Tiers
The architecture must support three main application tiers:
1.  **SaaS Provider Platform**: A centralized administrative interface for the service provider to manage tenants, subscriptions, and monitor the overall system health.
2.  **Resort Management Platform (Tenant)**: The core web/desktop application for resort staff (admins, managers, front desk) to manage their operations.
3.  **Mobile/Operational Applications**: Lightweight, task-focused applications for operational staff like housekeepers and maintenance technicians, available on iOS and Android.

## 1.4. Key Architectural Principles
-   **Scalability**: The system must be designed to scale horizontally. This can be achieved by adding more web server instances behind a load balancer.
-   **Real-time Communication**: The architecture will incorporate WebSockets to facilitate real-time updates for features like room status changes, new bookings, and notifications between modules.
-   **Security**: Security will be a core consideration, with measures like Role-Based Access Control (RBAC), data encryption, and secure authentication mechanisms.
-   **Extensibility**: The modular design should allow for future integrations with third-party systems like Channel Managers (Booking.com, Airbnb), Property Management Systems (PMS), and accounting software.
