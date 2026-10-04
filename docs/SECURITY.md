# SCHOOlar Security Notes

> Layout: web root is `public/`. Everything outside it (`api/config/`,
> `database/`, `docs/`, `_old_backend_unused/`) is never served.

## 1. Why the JS-only auth check is not enough

`public/js/auth-check.js` runs **in the browser, after the page already loaded**.
An attacker can bypass it by:

- disabling JavaScript / using `curl` / View-Source,
- opening the page directly (e.g. `/user/user-dashboard.html`),
- replaying a logged-out page from the back-button cache.

Client-side checks are UX only. They never enforce access.

## 2. How `guard.php` + `session.php` fix it

- `api/config/session.php` → `schoolar_session_start()` is the **single** session entry point:
  - `HttpOnly` + `SameSite=Lax` cookies (`Secure` when on HTTPS),
  - `use_only_cookies` + `use_strict_mode`, no URL session IDs,
  - **2-hour idle timeout** (`last_activity` check, session destroyed on expiry),
  - **fingerprint** = `md5(user-agent + first /24 of IP)`; mismatch wipes the session,
  - login/register endpoints call `session_regenerate_id(true)` on success
    (see `api/auth/login.php`, `api/auth/register.php`).
- `api/config/guard.php` → `require_page_auth("user" | "admin")` must be the
  **first lines of every protected `*.php` page, before ANY HTML output**:
  - sends `Cache-Control: no-store, no-cache, must-revalidate` + `Pragma: no-cache`
    so a logged-out back-button shows nothing,
  - sends `X-Content-Type-Options: nosniff` + `X-Frame-Options: SAMEORIGIN`,
  - checks `$_SESSION["user_id"]` + `$_SESSION["role"]`; on failure issues a
    **server-side 302 redirect** to the correct login page **before any
    protected HTML is emitted**.

`public/user/.htaccess` and `public/admin/.htaccess` redirect `*.html` → `*.php` so the
guarded copy always wins and the unguarded static copy is unreachable.

> **PHP gotcha (caught live in Docker testing):** a `?>` sequence *anywhere* —
> even inside a `//` comment — closes PHP mode, because the closing tag ends a
> line comment. A guard example written as a comment once silently turned the
> whole guard into output text (HTTP 200 with the "protected" page visible, no
> session needed). Rule: **never write `?>` inside a PHP comment**, and keep
> exactly one `<?php` open tag per guarded page with its matching `?>` only at
> the end of line 1.

## 3. Public vs protected (new `public/` paths)

**PUBLIC (no session needed):**

- `public/index.html`, `public/login.html`, `public/register.html`,
  `public/admin/admin-login.html`
- static assets: `public/css/*`, `public/js/*`, `public/images/*`, `public/ui-icons/*`
- entry-point APIs: `api/auth/login.php`, `api/auth/register.php`,
  `api/auth/logout.php`, `api/auth/me.php` (returns session state), public
  scholarship reads (`GET api/scholarships/*.php`, `GET api/reference.php`)

**PROTECTED (session required):**

- every `*.php` page under `public/user/` (`require_page_auth("user")`) and
  `public/admin/` except `admin-login.html` (`require_page_auth("admin")`)
- state-changing / personal APIs: `api/user/*`, `api/admin/*`, and any
  non-GET `api/scholarships/*` endpoint — each must call `schoolar_session_start()`
  (directly or via `api/config/auth.php`) + enforce the role check
  (`requireUser()` / `requireAdmin()`)

**NEVER SERVED (outside web root by construction):**

- `api/config/*` (database credentials, session bootstrap, guards),
  `database/*.sql`, `docs/*`, `_old_backend_unused/*`, `.env`

## 4. Docker vs XAMPP base path

- **Docker:** web root is `public/`, app lives at `http://localhost:8080/...`
  (e.g. `http://localhost:8080/login.html`).
- **XAMPP:** app lives at `http://localhost/SCHOOlar/public/...`
  (e.g. `http://localhost/SCHOOlar/public/login.html`).
- `guard.php` detects the base dynamically from `REQUEST_URI` so its
  server-side 302 redirects land on the correct login page in both
  environments. Keep frontend links base-relative; only server-side
  redirects need the dynamic base.
