---
name: Laravel DATABASE_URL override on Replit
description: Replit's auto-injected Postgres DATABASE_URL silently hijacks Laravel's DB connection regardless of DB_CONNECTION.
---

Replit injects a real process-level `DATABASE_URL` env var pointing at the workspace's built-in Postgres (`postgresql://postgres:...@helium/heliumdb...`). Laravel's default `config/database.php` sets `'url' => env('DATABASE_URL')` inside **every** connection array (mysql, pgsql, sqlite, sqlsrv). Laravel's connector parses that URL and overrides the driver/host/db from it whenever it's non-null — even if `DB_CONNECTION` in `.env` says `sqlite` or `mysql`.

**Why:** This caused a Laravel app configured for `DB_CONNECTION=sqlite` to silently connect to Replit's Postgres instead, producing confusing errors (e.g. Postgres-specific SQLSTATE codes, case-sensitive identifier failures like `relation "Classrooms" does not exist` from a MySQL-authored migration) when the intent was to test against MySQL/SQLite.

**How to apply:** When smoke-testing a non-Postgres Laravel app locally in a Replit workspace, run artisan commands (and the dev server) with `DATABASE_URL` unset for that process, e.g. `env -u DATABASE_URL php artisan migrate`. Do not edit `config/database.php` (that's app code / may need to stay unmodified for parity with an upstream repo) — just strip the env var per-invocation. Since `.env` is normally gitignored, none of this affects what gets committed/pushed.
