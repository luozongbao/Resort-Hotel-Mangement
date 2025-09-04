# Issue #14: Deployment & CI/CD Pipeline

-   **Phase**: 4
-   **Priority**: Critical
-   **Module**: DevOps

---

## Description

Establish an automated Continuous Integration and Continuous Deployment (CI/CD) pipeline. This will automate testing and deployment, improving reliability and development speed.

## Acceptance Criteria

-   A CI pipeline is configured using a tool like GitHub Actions.
-   The CI pipeline is triggered on every push to a feature branch or pull request to `develop`.
-   The pipeline automatically runs all tests (unit and feature) and the linter. A failed test or linting error must fail the pipeline.
-   A CD pipeline is configured.
-   When a pull request is merged into the `main` (or `release`) branch, the CD pipeline automatically deploys the application to a staging environment.
-   The deployment to the production environment is a manual step triggered after the staging deployment is verified.
-   The deployment process uses the Docker images built by the pipeline.

## Technical Details / Tasks

1.  **Configure GitHub Actions (or similar)**:
    -   Create a `.github/workflows/ci.yml` file.
    -   Define the workflow steps:
        -   Check out the code.
        -   Set up PHP and Node.js environments.
        -   Install Composer and NPM dependencies.
        -   Copy `.env.example` to `.env.testing`.
        -   Run the linter (`composer lint`).
        -   Run the tests (`php artisan test`).

2.  **Dockerize for Production**:
    -   Create a `Dockerfile` for the PHP application that is optimized for production (e.g., multi-stage build, non-root user).
    -   Create a `Dockerfile` for the Nginx web server.

3.  **Set up Container Registry**:
    -   Create a repository in a container registry like Docker Hub or GitHub Container Registry.

4.  **Configure CD Pipeline**:
    -   Create a `.github/workflows/cd.yml` file.
    -   This workflow will be triggered on pushes to the `main` branch.
    -   **Build & Push Step**:
        -   Log in to the container registry.
        -   Build the production Docker images.
        -   Tag the images with the Git commit SHA.
        -   Push the images to the registry.
    -   **Deploy Step**:
        -   This step will connect to the hosting server (e.g., via SSH).
        -   It will pull the new Docker images from the registry.
        -   It will then run a script on the server to restart the application containers with the new images (`docker-compose up -d` or similar).
        -   It should also run any necessary deployment commands like `php artisan migrate`.

5.  **Set up Environments**:
    -   Provision a staging server and a production server on a cloud provider.
    -   Securely store the necessary secrets (SSH keys, server IPs, etc.) in the GitHub repository's secrets configuration.

## Depends On

-   All previous development issues. This should be set up once the application has a stable base.
