Project Requirement: Reservation and Billing System for Banrimkwae Paerimnam Resort

1. Overview
A touchscreen-based mobile Point-of-Sale (POS) application to manage resort reservations, billing, and internal operations for Banrimkwae Paerimnam activity resort. The application must run on iOS and Android POS tablets and be optimized for intuitive, modular use similar to restaurant POS systems like Ocha or Wongnai.

2. Platforms
- iOS (iPad)
- Android (Tablet POS devices)

3. Core Features

3.1 Reservation Module
- Calendar-based date picker for booking rooms
- Add/delete room types dynamically
- Store customer information:
  - First Name, Last Name
  - Phone Number
  - Photo of ID Card
- Track customer history:
  - Stay history (room, date, number of stays)
  - Past occupancy details (number of guests, duration)

3.2 Room Management Dashboard
- Touchscreen interface with color-coded room status:
  - White = Ready
  - Orange = Customer checked out, awaiting cleaning
  - Red = Room under repair
- Room status changes:
  - On checkout: turns Orange, notifies housekeeping
  - After cleaning: housekeeping marks room as White
  - If damaged: mark as Red, notify maintenance

3.3 Cleaning & Maintenance Workflow
- Mobile notifications to:
  - Housekeepers
  - Housekeeping supervisors
  - Maintenance technicians
  - Front desk/reservation
- Housekeeper responsibilities:
  - Update room status after cleaning
  - Enter staff name, photo
- Maintenance responsibilities:
  - Receive alerts for damaged rooms
  - View problem descriptions or select from a dropdown (e.g., AC, shower, faucet)
  - Mark as White after repair
  - Record repair history with technician name, phone, task description, date

3.4 Customer Check-In/Out
- Auto-registration form:
  - Take photo via device camera
  - Save customer data to server
- Searchable customer database
- Recognize returning customers and store new visits as history
- Support for creating and managing membership data
- Data used for promotions and loyalty programs

3.5 Billing System
- Automatic calculation of room charges
- Include VAT 7%
- Optional manual discounts (+/-)
- Print receipt directly from connected POS printer

3.6 Role-Based Access Control
- Manager: Full system access
- Reservation Staff:
  - Register customers
  - Make/cancel bookings
  - Process payments and print receipts
  - Change room status
- Housekeeping:
  - View checked-out rooms
  - Change room status after cleaning
  - Report damages
- Maintenance:
  - View reported damages
  - Update repair status
- Owner/Admin:
  - Full data visibility
  - View analytics and reports

4. Reporting & Dashboard

4.1 Daily Summary
- Total number of customers
- Number of rooms occupied
- Total income

4.2 Reservation Analytics
- Future reservation lookup
- Daily revenue breakdown (via calendar)

4.3 Financial Reports
- Revenue/Expense reports:
  - Daily
  - Weekly
  - Monthly
  - Yearly
- Tax-inclusive and tax-exclusive breakdowns

5. Technical Specifications

5.1 Server & Storage
- Cloud/server-based customer data storage
- Real-time search and retrieval of customer profiles
- Reservation data history and logs

5.2 Integration
- POS printer support
- Camera integration for ID capture

5.3 User Interface
- Modular touch-screen interface
- Clean, intuitive layout
- Color-coded room modules