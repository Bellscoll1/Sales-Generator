# LeadConnect

LeadConnect is a production-oriented, multi-tenant SaaS platform for LinkedIn lead generation, outreach automation, unified messaging, CRM pipeline, reporting, billing, and AI sales assistance.

## Implemented Foundation
- Laravel 12 backend with UUID-first schema and tenant scoping
- Organization-based tenancy with role hierarchy: Owner, Admin, Manager, Sales Rep, Viewer
- Sanctum token auth APIs and onboarding endpoints
- Core modules: leads, campaigns, messaging, deals, tasks, billing skeleton
- Inertia + Vue 3 + TypeScript dashboard shell with SaaS sidebar layout
- Redis queue architecture (high/default/low) and Horizon config
- Reverb websocket config and Meilisearch/Scout integration points
- Dockerized local stack: app, nginx, mysql, redis, meilisearch, horizon, reverb
- GitHub Actions CI pipeline for lint/typecheck/test/migrate

## Key Paths
- API routes: routes/api.php
- Web routes: routes/web.php
- Tenancy middleware: app/Http/Middleware/SetCurrentOrganization.php
- RBAC middleware: app/Http/Middleware/CheckOrganizationRole.php
- Core schema: database/migrations
- Domain architecture: app/Domain
- Frontend app shell: resources/js
- OpenAPI stub: docs/api/openapi.yaml

## Local Setup
1. Copy environment and set secrets:
   - cp .env.example .env
2. Install dependencies:
   - composer install
   - npm install
3. Generate key and migrate:
   - php artisan key:generate
   - php artisan migrate
4. Run app stack:
   - composer run dev

## Docker Setup
- docker compose up --build

## Notes
- This repository contains a production-ready scaffold with clean architecture patterns (DTOs, repositories, services, events, listeners) and module boundaries.
- Additional implementation work remains for complete UI screens, external provider wiring (Google/LinkedIn OAuth, Paddle), and full test coverage.
