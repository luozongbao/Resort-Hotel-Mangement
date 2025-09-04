# LLD: Database Table Schema

This document provides a detailed schema for key tables in a tenant's database.

---

## `rooms` table

Stores individual rooms in the resort.

| Column Name    | Data Type     | Constraints & Properties                               | Description                               |
| :------------- | :------------ | :----------------------------------------------------- | :---------------------------------------- |
| `id`           | `BIGINT`      | `UNSIGNED`, `PRIMARY KEY`, `AUTO_INCREMENT`            | Unique identifier for the room.           |
| `room_type_id` | `BIGINT`      | `UNSIGNED`, `NOT NULL`, `FOREIGN KEY` (to `room_types.id`) | Links to the room's category.             |
| `location_id`  | `BIGINT`      | `UNSIGNED`, `NOT NULL`, `FOREIGN KEY` (to `locations.id`)  | Links to the room's physical location.    |
| `name`         | `VARCHAR(255)`| `NOT NULL`                                             | The display name of the room (e.g., "Villa 101"). |
| `status`       | `VARCHAR(50)` | `NOT NULL`, `INDEX`                                    | The current operational status of the room. |
| `created_at`   | `TIMESTAMP`   | `NULLABLE`                                             | Timestamp of creation.                    |
| `updated_at`   | `TIMESTAMP`   | `NULLABLE`                                             | Timestamp of last update.                 |

**Indexes**:
-   `PRIMARY` on `id`
-   `INDEX` on `status` for fast filtering.
-   `FOREIGN KEY` indexes on `room_type_id` and `location_id`.

---

## `bookings` table

Stores reservation information.

| Column Name      | Data Type     | Constraints & Properties                               | Description                               |
| :--------------- | :------------ | :----------------------------------------------------- | :---------------------------------------- |
| `id`             | `BIGINT`      | `UNSIGNED`, `PRIMARY KEY`, `AUTO_INCREMENT`            | Unique identifier for the booking.        |
| `guest_id`       | `BIGINT`      | `UNSIGNED`, `NOT NULL`, `FOREIGN KEY` (to `guests.id`)   | The guest who made the booking.           |
| `check_in_date`  | `DATE`        | `NOT NULL`, `INDEX`                                    | The scheduled check-in date.              |
| `check_out_date` | `DATE`        | `NOT NULL`                                             | The scheduled check-out date.             |
| `status`         | `VARCHAR(50)` | `NOT NULL`, `INDEX`                                    | The current status of the booking.        |
| `total_amount`   | `DECIMAL(10,2)`| `NULLABLE`                                             | The calculated total cost of the booking. |
| `created_at`     | `TIMESTAMP`   | `NULLABLE`                                             | Timestamp of creation.                    |
| `updated_at`     | `TIMESTAMP`   | `NULLABLE`                                             | Timestamp of last update.                 |

**Indexes**:
-   `PRIMARY` on `id`
-   `INDEX` on `check_in_date` for calendar/date-range queries.
-   `INDEX` on `status`.

---

## `maintenance_requests` table

Stores information about damages and repair tasks.

| Column Name        | Data Type      | Constraints & Properties                               | Description                               |
| :----------------- | :------------- | :----------------------------------------------------- | :---------------------------------------- |
| `id`               | `BIGINT`       | `UNSIGNED`, `PRIMARY KEY`, `AUTO_INCREMENT`            | Unique identifier for the request.        |
| `room_id`          | `BIGINT`       | `UNSIGNED`, `NOT NULL`, `FOREIGN KEY` (to `rooms.id`)    | The room that requires maintenance.       |
| `reported_by_id`   | `BIGINT`       | `UNSIGNED`, `NOT NULL`, `FOREIGN KEY` (to `users.id`)    | The user who reported the issue.          |
| `assigned_to_id`   | `BIGINT`       | `UNSIGNED`, `NULLABLE`, `FOREIGN KEY` (to `users.id`)    | The technician assigned to the task.      |
| `description`      | `TEXT`         | `NOT NULL`                                             | A description of the problem.             |
| `photo_path`       | `VARCHAR(255)` | `NULLABLE`                                             | Path to an uploaded photo of the damage.  |
| `status`           | `VARCHAR(50)`  | `NOT NULL`, `INDEX`, `DEFAULT 'reported'`              | The current status of the repair task.    |
| `priority`         | `VARCHAR(50)`  | `NOT NULL`, `DEFAULT 'medium'`                         | The priority of the task (low, medium, high). |
| `created_at`       | `TIMESTAMP`    | `NULLABLE`                                             | Timestamp of creation.                    |
| `updated_at`       | `TIMESTAMP`    | `NULLABLE`                                             | Timestamp of last update.                 |

**Indexes**:
-   `PRIMARY` on `id`
-   `INDEX` on `status` and `priority` for task board queries.
-   `FOREIGN KEY` indexes on `room_id`, `reported_by_id`, `assigned_to_id`.
