# Vibe Resort Management System

## Project Overview

Vibe Resort Management System is a comprehensive **Software-as-a-Service (SaaS)** platform designed to help resort owners efficiently manage their properties and operations. The system allows customers to manage multiple resorts under a single account, providing a centralized solution for resort management needs.

## Core Features & Requirements

### 1. Multi-Resort Customer Management
- Each customer account can manage multiple resorts
- Centralized account management with resort-specific configurations
- Individual resort customization and branding capabilities

### 2. Accommodation Management

#### 2.1 Accommodation Structure
The system supports a hierarchical accommodation structure:

```
Resort
├── Accommodation Locations (Area1, Area2, etc.)
│   ├── Accommodation Types (Raft, House, etc.)
│   │   └── Rooms
│   │       └── Room Types (Deluxe, Standard, Suite, etc.)
|   |       └── Room Room Status (Ready, Cleaning, Maintenance, Checked-in etc.)
```

#### 2.2 Accommodation Features
- **Accommodation Locations**: Customizable area management (Area1, Area2, etc.)
- **Accommodation Types**: Flexible property types (Raft, House, Villa, etc.)
- **Room Management**: Individual room configuration within locations
- **Room Types**: Configurable room categories with specific properties
- **Room Status**: Room Status Management
- **Capacity Management**: Set maximum guest capacity per room type
- **CRUD Operations**: Full Create, Read, Update, Delete functionality for all accommodation elements

### 3. Guest Management System

#### 3.1 Guest Profile Management
- Complete guest information database
- Contact management (name, email, phone, address)
- Contact person designation
- Group name/display name configuration
- Full CRUD operations for guest profiles

#### 3.2 Guest Relationship Management
- Guest history tracking
- Preference management
- Group booking capabilities

### 4. Booking & Reservation System

#### 4.1 Room Booking
- Easy room booking interface for guests
- Real-time availability checking
- Booking confirmation and management

#### 4.2 Check-in/Check-out Process
- Streamlined check-in procedures
- Efficient check-out processing 
- Guest status tracking

#### 4.3 Invoicing & Billing System
- Comprehensive invoicing system integrated with check-in/check-out
- Flexible billing options:
  - Tax inclusion/exclusion options
  - Coupon code support for promotions
  - Manual discount application (percentage or fixed amount)
- Automated billing calculation
- Payment processing integration

### 5. Customer Management Module

#### 5.1 Customer History Tracking
- Complete guest visit history
- Track frequency of visits and dates
- Detailed accommodation history
- Guest count and night count tracking
- Historical spending analysis

#### 5.2 Customer Analytics
- Guest preference analysis
- Repeat customer identification
- Customer lifetime value tracking
- Personalized service recommendations

### 6. Activities & Services Management

#### 6.1 Activity Configuration
- Custom activity creation and management
- Flexible pricing structures:
  - Price per person
  - Price per room
  - Package per night rates

#### 6.2 Activity Booking
- Guest activity booking system
- Integrated payment processing with check-out
- Cost calculation and addition to final bill
- Activity scheduling and availability management

### 7. User Management & Access Control

#### 7.1 Resort-Level User Roles
- **Admin**: Full resort management access
- **Manager**: Operational management capabilities
- **Staff**: Limited operational access
- Custom role creation capabilities

#### 7.2 Role-Based Access Control (RBAC)
- Granular permission management
- Page-level access control
- Feature-specific restrictions
- Role hierarchy management
- Resort admin can manage user levels and roles
- Configure role accessibility to specific features and pages

#### 7.3 System-Level Administration
- **Main Administrator Role**: System-wide management capabilities
- Customer account management
- Technical support and problem resolution
- System maintenance and updates
- Help resort admins resolve operational problems

### 8. Dashboard & Analytics System

#### 8.1 Resort Management Dashboard
- Real-time resort performance metrics
- Occupancy rates and trends
- Revenue analytics
- Operational KPIs
- Full data visibility for management decisions
- Export capabilities for external analysis

#### 8.2 Housekeeping Dashboard
- Room status summary for all rooms
- Cleaning task assignments and progress
- Damage reports and maintenance requests
- Cleaning schedule optimization
- Performance metrics for housekeeping staff

#### 8.3 Maintenance Dashboard
- Summary and status of all rooms requiring maintenance
- Maintenance expense tracking and analysis
- Technician task assignment and progress
- Priority-based task management
- Equipment and supply management

#### 8.4 Daily Operational Reports
- **Daily Reports**:
  - Number of customers checked in/out
  - Number of rooms occupied
  - Total daily income
  - Daily revenue breakdown by category
- **Reservation Analytics**:
  - Reservation lookup and search
  - Booking patterns and trends
  - Occupancy forecasting
- **Financial Reports**:
  - Daily/Weekly/Monthly/Yearly revenue reports
  - Expense reports with detailed breakdowns
  - Tax included/excluded calculations
  - Profit and loss statements
  - Revenue vs. expense analysis

### 9. Housekeeping Management Module

#### 9.1 Cleaning Operations
- Post-checkout cleaning workflows
- Room status tracking and updates
- Cleaning task assignment and scheduling
- Mobile/tablet optimized interface

#### 9.2 Damage Reporting
- Mobile/tablet-friendly damage reporting interface
- Photo documentation capabilities
- Automatic maintenance team notifications
- Damage assessment and tracking
- Real-time notification system to maintenance team

#### 9.3 Integration with Maintenance
- Seamless handoff to maintenance team
- Automated workflow triggers
- Status tracking from cleaning to repair completion

### 10. Maintenance Management Module

#### 10.1 Maintenance Workflow
- Automated technician notifications
- Priority-based task management
- Work order generation and tracking
- Real-time status updates

#### 10.2 Repair Management
- Repair status tracking
- Technician assignment and scheduling
- Completion verification
- Room status updates (repair completed)
- Quality assurance checkpoints

#### 10.3 Integration Features
- Seamless integration with housekeeping module
- Automated workflow triggers from damage reports
- Real-time status updates across departments
- Maintenance expense tracking and reporting

## Technical Requirements

### System Architecture
- **SaaS Model**: Multi-tenant architecture supporting multiple customers
- **Scalability**: Support for multiple resorts per customer account
- **Security**: Role-based access control and data isolation
- **Mobile Compatibility**: Responsive design for mobile/tablet access
- **Real-time Updates**: Live status updates across all modules

### Key Integrations
- Housekeeping ↔ Maintenance modules (automated damage reporting)
- Booking ↔ Guest management systems
- Activities ↔ Payment processing and billing
- Reporting ↔ All operational modules
- Customer management ↔ Reservation system
- Financial system ↔ All revenue-generating modules

### Performance Requirements
- Real-time dashboard updates
- Mobile-optimized interface for field operations
- Automated notification system
- Comprehensive audit trails
- Data export and reporting capabilities

## User Personas

1. **System Administrator**: Manages the entire SaaS platform and customer accounts
2. **Resort Owner/Admin**: Manages resort operations, staff, and user roles/permissions
3. **Resort Manager**: Handles day-to-day operations and decision-making
4. **Front Desk Staff**: Manages bookings, guest services, check-in/check-out
5. **Housekeeping Staff**: Handles room cleaning, damage reporting via mobile/tablet
6. **Maintenance Technicians**: Manages repair and maintenance tasks with priority system
7. **Financial Manager**: Handles billing, invoicing, and financial reporting

## Success Metrics

- Efficient multi-resort operations management
- Streamlined guest experience with comprehensive history tracking
- Reduced operational overhead through automation
- Improved maintenance response times with priority system
- Enhanced reporting and analytics capabilities with role-specific dashboards
- Scalable multi-resort management under single customer accounts
- Integrated billing and financial management with tax handling
- Mobile-optimized operations for housekeeping and maintenance teams

---

*This document serves as the foundational requirements specification for the Vibe Resort Management System development project.*