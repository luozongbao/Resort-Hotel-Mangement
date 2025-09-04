# 8. Real-time Features

This document describes the requirements for real-time functionality within the Resort Hotel Management System, which is crucial for operational efficiency.

## 8.1. Core Technology
-   **WebSockets**: The primary technology for enabling real-time, bi-directional communication between the server and clients (web and mobile).
-   **Implementation**: This can be achieved using a library like **Laravel WebSockets** or a third-party service such as **Pusher**.

## 8.2. Key Real-time Events

### Room Status Updates
-   **Event**: When a room's status changes.
-   **Trigger**:
    -   A guest checks in or out.
    -   A housekeeper marks a room as "Ready".
    -   A housekeeper reports damage, changing the status to "Under Maintenance".
    -   A technician completes a repair.
-   **Action**: The room's status should be updated instantly on all relevant dashboards across all connected clients (e.g., Front Desk dashboard, Housekeeping app, Management overview).

### Notifications
-   **Event**: A new task or alert is generated for a user or role.
-   **Triggers & Actions**:
    -   **Housekeeping**: When a guest checks out, a push notification is sent to the Housekeeping app with the new cleaning task.
    -   **Maintenance**: When a housekeeper reports damage, a push notification is sent to the Maintenance app with the new repair task.
    -   **Bookings**: The front desk or management could receive a live notification on their dashboard when a new online booking is made.

### Live Dashboard Updates
-   **Event**: Data that contributes to key performance indicators (KPIs) changes.
-   **Trigger**: A new booking is made, a guest checks in, or an invoice is paid.
-   **Action**: Widgets on the main management dashboard (e.g., 'Occupancy Rate', 'Today's Revenue') should update in real-time without requiring a page refresh.

## 8.3. Implementation Considerations
-   **Channels**: WebSocket communication will be organized into channels.
    -   **Public Channels**: For system-wide announcements.
    -   **Private/Presence Channels**: For tenant-specific and user-specific information to ensure data privacy. For example, a channel for `tenant-123-maintenance` would only broadcast events to authorized users within that tenant.
-   **Authentication**: All connections to private WebSocket channels must be authenticated to ensure that only authorized users can subscribe and receive data.
-   **Scalability**: The WebSocket server must be able to handle a large number of concurrent connections, especially as the number of tenants and users grows.
