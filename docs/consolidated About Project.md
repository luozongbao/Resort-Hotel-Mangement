# Consolidated About Project: Resort Hotel Management System

## 1. Project Overview

This project is a **Software-as-a-Service (SaaS)** platform designed for resort management. It allows customers (resort owners) to manage one or more properties through a centralized system. The platform will be accessible via web, desktop, and mobile/tablet devices, with a focus on a touch-friendly interface for operational tasks.

## 2. Core Modules & Features

### 2.1. Multi-Resort Management
-   A single customer account can manage multiple resorts.
-   Centralized dashboard for business administrators to oversee all customer accounts and provide support.

### 2.2. Accommodation Management
-   **Hierarchical Structure**: Manage a nested structure of `Accommodation Location` > `Accommodation Type` > `Room`.
-   **Room Configuration**: Define `Room Types` (e.g., Deluxe, Standard) with specific properties like guest capacity.
-   **Room Status**: Real-time tracking of room status (e.g., Ready, Checked-in, Needs Cleaning, Under Maintenance).
-   **Full CRUD**: Complete control to add, edit, and delete all accommodation elements.

### 2.3. Guest & Customer Management
-   **Guest Profiles**: Maintain a database of guests with contact information, group affiliations, and personal details.
-   **Customer History**: Track guest visit history, including stay dates, accommodation details, duration, and total spending, to identify repeat customers and analyze preferences.

### 2.4. Booking, Check-in & Check-out
-   **Reservation System**: An intuitive interface for booking rooms, possibly with a calendar view.
-   **Streamlined Operations**: Easy processes for guest check-in and check-out.
-   **ID Capture**: Ability to capture a photo of a guest's ID card during registration.

### 2.5. Billing & Invoicing
-   **Integrated Billing**: Automatically generate invoices upon check-out.
-   **Flexible Invoicing**:
    -   Option to include or exclude taxes (e.g., VAT 7%).
    -   Apply promotional discounts via coupon codes.
    -   Manually add or remove discounts (by percentage or fixed amount).
-   **Printing**: Support for printing receipts directly from a POS printer.

### 2.6. Activities & Services Management
-   **Custom Activities**: Each resort can define and manage its unique activities or services.
-   **Flexible Pricing**: Set prices per person, per room, or as part of a package.
-   **Booking**: Allow guests to book activities, with costs added to their final bill at checkout.

### 2.7. Housekeeping Module
-   **Mobile/Tablet Interface**: Optimized for housekeepers on the go.
-   **Cleaning Workflow**: Housekeepers can view rooms needing cleaning (e.g., after checkout) and update the room status to "Ready" when done.
-   **Damage Reporting**: Ability to mark a room as "Repair Needed" and automatically notify the maintenance team.

### 2.8. Maintenance Module
-   **Automated Notifications**: Technicians receive instant alerts for maintenance requests from the housekeeping module.
-   **Task Management**: Prioritize and track repair tasks.
-   **Status Updates**: Technicians can mark a repair as complete, which updates the room's status accordingly.

### 2.9. User & Role Management
-   **Resort-Level Roles**: Pre-defined user levels such as Admin, Manager, and Staff.
-   **Role-Based Access Control (RBAC)**: Resort admins can create custom roles and configure granular permissions for accessing specific features and pages.
-   **System Administrator**: A top-level admin role to manage the entire SaaS platform and its customers.

### 2.10. Dashboards & Reporting
-   **Management Dashboard**: Provides a high-level overview of resort performance, including occupancy rates, revenue, and other KPIs.
-   **Operational Dashboards**:
    -   **Housekeeping**: A summary of room statuses for cleaning staff.
    -   **Maintenance**: A dashboard to view and manage all maintenance tasks and track related expenses.
-   **Comprehensive Reporting**:
    -   **Daily Reports**: Number of guests, occupied rooms, and total income.
    -   **Reservation Analytics**: Look up future reservations and analyze booking trends.
    -   **Financial Reports**: Generate daily, weekly, monthly, or yearly reports on revenue and expenses, with breakdowns for tax.
-   **Data Export**: Ability to export reports for external analysis.

## 3. SaaS Provider Platform & Features

This section outlines the features and modules available to the SaaS service provider for managing the entire platform and its customers.

### 3.1. Business Admin Module
-   **Centralized Admin Portal**: A dedicated web/desktop module for the service provider's administrators to manage the entire SaaS ecosystem.
-   **Customer Account Management**: Full CRUD (Create, Read, Update, Delete) capabilities for customer (tenant) accounts.
-   **Support & Troubleshooting**: Ability for business admins to view customer overviews and assist them in resolving issues, potentially through features like user impersonation.

### 3.2. Subscription & Pricing Management
-   **Subscription Tiers**: Define and manage different subscription plans (e.g., Basic, Multi-Resort, Enterprise).
-   **Flexible Pricing Models**: Configure pricing based on various metrics:
    -   Per customer account.
    -   Per resort.
    -   Per total room capacity.
-   **Billing & Invoicing**: Manage billing cycles and generate invoices for customers based on their subscription plan.

### 3.3. System-Wide Monitoring & Analytics
-   **Platform Dashboard**: A main dashboard for the provider to monitor the overall health, performance, and usage of the platform.
-   **Customer Analytics**: View aggregated data and analytics across all customers to identify trends and insights.

### 3.4. Easy Installation & Onboarding
-   **WordPress-Style Installer**: A simple, web-based installation wizard for deploying new instances of the application.
-   **Automated Setup**: The installer should handle environment checks, database configuration, and initial admin account creation.
-   **License Management**: System for validating customer license keys tied to their subscription.
