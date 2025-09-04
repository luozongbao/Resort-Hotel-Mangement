# Deployment Diagram

This document illustrates the high-level deployment strategy for the Resort Hotel Management System, showing how the software components are mapped to the underlying infrastructure. This model assumes a containerized deployment on a cloud provider.

## Deployment Architecture

```mermaid
graph TD
    subgraph "User's Device"
        Browser
        MobileApp[Mobile App]
    end

    subgraph "Cloud Provider Infrastructure"
        LB[Load Balancer]

        subgraph "Container Platform (e.g., Kubernetes, Docker Swarm)"
            subgraph "App Server 1"
                Container_Nginx1[Nginx Container]
                Container_App1[App Container <br> (PHP-FPM)]
            end
            subgraph "App Server 2"
                Container_Nginx2[Nginx Container]
                Container_App2[App Container <br> (PHP-FPM)]
            end
            subgraph "App Server N"
                Container_NginxN[Nginx Container]
                Container_AppN[App Container <br> (PHP-FPM)]
            end
        end

        subgraph "Managed Services"
            ManagedDB[(Managed Database <br> MariaDB)]
            ManagedCache[(Managed Cache <br> Redis)]
            ManagedStorage[(Object Storage <br> S3 / Equivalent)]
        end
    end

    Browser -- "HTTPS" --> LB
    MobileApp -- "HTTPS" --> LB

    LB -- "Distributes Traffic" --> Container_Nginx1
    LB -- "Distributes Traffic" --> Container_Nginx2
    LB -- "Distributes Traffic" --> Container_NginxN

    Container_Nginx1 --> Container_App1
    Container_Nginx2 --> Container_App2
    Container_NginxN --> Container_AppN

    Container_App1 -- "DB Connection" --> ManagedDB
    Container_App2 -- "DB Connection" --> ManagedDB
    Container_AppN -- "DB Connection" --> ManagedDB

    Container_App1 -- "Reads/Writes" --> ManagedCache
    Container_App2 -- "Reads/Writes" --> ManagedCache
    Container_AppN -- "Reads/Writes" --> ManagedCache

    Container_App1 -- "Reads/Writes Files" --> ManagedStorage
    Container_App2 -- "Reads/Writes Files" --> ManagedStorage
    Container_AppN -- "Reads/Writes Files" --> ManagedStorage
```

## Deployment Strategy Description

1.  **Entry Point**: All incoming traffic from clients (web browsers or mobile apps) first hits a **Load Balancer**. The load balancer is responsible for terminating SSL (HTTPS) and distributing requests evenly across the available application servers.

2.  **Application Servers**: The core application runs on one or more identical application servers. This design allows for **horizontal scalability**—if traffic increases, more servers can be added to the pool to handle the load.

3.  **Containerization**: Each application server runs a set of **Docker containers**.
    -   **Nginx Container**: Acts as a reverse proxy, serving static files and forwarding dynamic requests to the application container.
    -   **App Container (PHP-FPM)**: Contains the Laravel application code and runs the PHP-FPM process to execute the application logic.

4.  **Managed Services**: To reduce operational overhead and improve reliability, the stateful parts of the system are offloaded to managed services provided by the cloud host.
    -   **Managed Database**: A highly available and automatically backed-up database service (e.g., Amazon RDS, DigitalOcean Managed Database). The application containers connect to this central database.
    -   **Managed Cache**: A managed Redis instance for caching, sessions, and queues.
    -   **Object Storage**: A service like Amazon S3 for storing user-uploaded files (e.g., ID photos), separate from the application servers.

This architecture separates the stateless application logic (which can be easily scaled) from the stateful data stores, which is a standard and robust pattern for building scalable web applications.
