# SCHOOlar File Organization

> Clean layout: all browser-facing UI is isolated under `public/`.
> The backend (`api/`), schema/seeds (`database/`), containers (`docker/`),
> and documentation (`docs/`) sit **outside** the web root and are never
> served directly. The project root holds only runtime files
> (`Dockerfile`, `docker-compose.yml`, `.env` / `.env.example`).

## Layout

```text
SCHOOlar/
├── public/                                      # WEB ROOT — the only publicly served tree
│   ├── index.html / login.html / register.html   # public pages
│   ├── css/ / js/                                # static styles + scripts (public)
│   ├── images/ / ui-icons/                          # static assets (public)
│   ├── user/                                     # protected pages (user role)
│   │   └── *.php  (each starts with require_page_auth("user") via api/config/guard.php)
│   └── admin/                                    # admin pages
│       ├── admin-login.html                      # PUBLIC — login page, no guard
│       └── *.php  (each starts with require_page_auth("admin"))
│
├── api/                                         # backend (NOT in web root; routed by server)
│   ├── auth/        # login.php, register.php, logout.php, me.php (public entry points)
│   ├── user/        # personal endpoints (require user session)
│   ├── scholarships/# read (public GET) + write (protected) endpoints + helpers.php
│   ├── admin/       # require admin session
│   ├── reference.php# public schools/courses lookup
│   └── config/      # NEVER served: database.php, session.php, guard.php, auth.php, response.php
│
├── database/                                    # *.sql schema + seeds (never served)
│   ├── schoolar_schema.sql                      # full schema + admin/student seed accounts
│   ├── phase3_seed_scholarships.sql             # optional sample scholarships
│   └── phase3_fix_gwa_scale.sql                 # one-off GWA scale fix
│
├── docker/                                      # apache/php container config
├── docs/                                        # all documentation (never served)
│   ├── README_DOCKER.md
│   ├── SECURITY.md
│   ├── FILE_ORGANIZATION.md                     # this file
│   ├── FRONTEND_UPDATE_README.txt               # historical frontend-only notes
│   └── PHASE3_README.txt                        # historical Phase 3 backend notes
│
├── Dockerfile / docker-compose.yml / .env       # runtime only (root)
│
└── _old_backend_unused/                         # QUARANTINED legacy code — NOT loaded anywhere
    ├── api/  database/  admin-dashboard.js
```

## Lockdown (web-root = `public/`)

- Only `public/` is document-rooted, so `api/config/*`, `database/*.sql`,
  `_old_backend_unused/*`, and `.env` are unreachable by construction.
- Defence in depth: `.htaccess` rules additionally 403
  `api/config/*`, `_old_backend_unused/*`, `*.sql`, `.env`, and send
  `Cache-Control: no-store` + `X-Content-Type-Options: nosniff` +
  `X-Frame-Options: SAMEORIGIN` on guarded pages.
- `public/user/.htaccess` and `public/admin/.htaccess` redirect `*.html` → `*.php`
  (302) so the `guard.php`-protected copy always wins
  (except `admin-login.html`, which stays public).

## `_old_backend_unused/` — safe to delete before submission

- Not referenced by any live HTML/JS/PHP (grep for the dirname returns nothing
  outside these docs).
- Unreachable: outside the `public/` web root AND blocked by `.htaccess`.
- Kept for now only as a reference; deleting the whole folder changes zero
  runtime behaviour.

## Public vs protected split (summary)

- **Public:** `public/index.html`, `public/login.html`, `public/register.html`,
  `public/admin/admin-login.html`, `public/css/*`, `public/js/*`,
  `public/images/*`, `public/ui-icons/*`, auth entry-point APIs
  (`api/auth/*`), public scholarship reads (`GET api/scholarships/*`,
  `GET api/reference.php`).
- **Protected:** `public/user/*.php` (role `user`), `public/admin/*.php`
  (role `admin`) via `guard.php`; `api/user/*`, `api/admin/*`, and non-GET
  `api/scholarships/*` (session + role check via `api/config/auth.php`).
