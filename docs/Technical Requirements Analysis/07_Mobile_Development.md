# 7. Mobile Development

This document specifies the requirements for the mobile applications for the Housekeeping and Maintenance modules.

## 7.1. Target Platforms
-   **iOS**: The application must run on iPhones and iPads.
-   **Android**: The application must run on a wide range of Android phones and tablets, including ruggedized POS or operational devices.

## 7.2. Technology Choice
-   **Cross-Platform Framework**: To ensure consistency and development efficiency, a cross-platform framework like **Flutter** or **React Native** is required. This allows for a single codebase to target both iOS and Android.

## 7.3. Core Features - Housekeeping App
-   **Secure Login**: Housekeepers will log in with their credentials.
-   **Task Dashboard**: Upon login, the user will see a list of rooms assigned to them that require cleaning (e.g., status is 'Awaiting Cleaning').
-   **Room Status Update**: A simple interface to change a room's status. For example, a "Cleaning Complete" button that updates the room status to "Ready".
-   **Damage Reporting**:
    -   An option within a room's view to report damage.
    -   Ability to select the type of damage from a predefined list (e.g., 'Broken TV', 'Leaking Faucet').
    -   Ability to take and upload a photo of the damage.
    -   Submitting a damage report should automatically create a task in the Maintenance module and notify the maintenance team.
-   **Push Notifications**: Receive real-time notifications for new cleaning assignments.

## 7.4. Core Features - Maintenance App
-   **Secure Login**: Maintenance technicians will log in with their credentials.
-   **Task Dashboard**: A list of active maintenance requests, which can be sorted by priority, room number, or date reported.
-   **Task Details**: Tapping on a task shows detailed information, including the reported issue, photos, and room location.
-   **Task Status Update**: Ability to update the status of a task (e.g., 'In Progress', 'Awaiting Parts', 'Completed').
-   **Completion Workflow**: Marking a task as "Completed" should update the room's status (e.g., to "Ready" if it was previously "Under Maintenance") and notify management or the front desk.
-   **Push Notifications**: Receive real-time notifications for new or high-priority maintenance requests.

## 7.5. General Requirements
-   **Offline Capabilities**: The apps should have basic offline support. If a user performs an action while disconnected, the app should queue the action and sync with the server once connectivity is restored.
-   **UI/UX**: The user interface must be simple, intuitive, and optimized for touch on various screen sizes. Large buttons and clear text are essential for an operational environment.
-   **API Communication**: The mobile apps will communicate with the backend via the same RESTful API used by the web application.
