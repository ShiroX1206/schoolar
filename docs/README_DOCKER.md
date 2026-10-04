# SCHOOlar — Docker setup

The UI now lives under `public/` (see `docs/FILE_ORGANIZATION.md`).
The web server's document root is `public/`, so the app is served from `/`.

## Run with Docker

```bash
docker compose up --build
```

- App: http://localhost:8080 (serves `public/`, e.g. `http://localhost:8080/login.html`)
- phpMyAdmin: http://localhost:8081 (server `db`, user `schoolar` / `schoolarpass`,
  or root / `rootpass`)

First start imports `database/schoolar_schema.sql` then
`database/phase3_seed_scholarships.sql` automatically.
To reseed from scratch:

```bash
docker compose down -v   # deletes db_data volume
docker compose up --build
```

## Default accounts

| Role    | Email                  | Password |
|---------|------------------------|----------|
| Admin   | admin@schoolar.local   | admin123 |
| Student | student@schoolar.local | User123! |

Change these before any demo/defense.

## XAMPP still works

`api/config/database.php` reads `DB_HOST` / `DB_NAME` / `DB_USER` / `DB_PASS`
from the environment and falls back to XAMPP defaults
(`localhost` / `schoolar_db` / `root` / empty password) when the vars are unset.

With the new layout the XAMPP URL is:

- XAMPP: http://localhost/SCHOOlar/public/ (e.g. `http://localhost/SCHOOlar/public/login.html`)

No code changes are needed to switch between XAMPP and Docker —
only the base path differs (`/` in Docker vs `/SCHOOlar/public/` in XAMPP).
