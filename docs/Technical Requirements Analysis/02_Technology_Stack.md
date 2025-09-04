# 2. Technology Stack

This document outlines the proposed technology stack for the Resort Hotel Management System.

## 2.1. Backend
-   **Programming Language**: **PHP 8.2+**
-   **Framework**: **Laravel 11+** - A robust and mature MVC framework with excellent support for SaaS features like multi-tenancy, authentication, and API development.
-   **API Architecture**: **RESTful API** to provide a standardized interface for all client applications.

## 2.2. Frontend
-   **JavaScript Framework**: **Vue.js 3** or **React.js** - For building a modern, reactive, and interactive user interface for the main web/desktop application.
-   **CSS Framework**: **Tailwind CSS** - A utility-first CSS framework that allows for rapid and consistent UI development.
-   **SPA Bridge**: **Inertia.js** - To connect the Laravel backend with the Vue.js/React frontend, creating a seamless single-page application (SPA) experience without the complexity of managing a separate API client.

## 2.3. Database & Caching
-   **Primary Database**: **MariaDB 10.6+** - A reliable, high-performance, and open-source relational database.
-   **In-Memory Cache / Broker**: **Redis** - To be used for session storage, caching frequently accessed data, and as a message broker for real-time features and job queues.

## 2.4. Web Server & Infrastructure
-   **Web Server**: **Nginx** - A high-performance web server, reverse proxy, and load balancer.
-   **PHP Processor**: **PHP-FPM** (FastCGI Process Manager) for efficient PHP handling.
-   **Encryption**: **SSL/TLS** (e.g., via Let's Encrypt) to ensure all communication is encrypted over HTTPS.

## 2.5. Mobile Development
-   **Cross-Platform Framework**: **Flutter** or **React Native** - To develop native-like mobile applications for both iOS and Android from a single codebase. This is ideal for the task-oriented Housekeeping and Maintenance modules.
-   **Alternative**: **Progressive Web App (PWA)** - As a fallback or complementary solution, the web application will be designed to be mobile-responsive and installable on home screens.

## 2.6. Real-time Communication
-   **Technology**: **WebSockets** (e.g., using Laravel WebSockets or a service like Pusher) to enable real-time features.
