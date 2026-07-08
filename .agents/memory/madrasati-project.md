---
name: madrasati / school-management-system project state
description: Status of the almrysh84-cmd/madrasati GitHub repo and its Railway deployment setup.
---

The user's Replit workspace is a Laravel 9 "school management system" (originally forked from khaleddoosama/school-management-system). Their GitHub repo `https://github.com/almrysh84-cmd/madrasati.git`, `main` branch, already contains:
- The clean, unmodified original application code (verified via file-by-file diff against the upstream zip — no leftover custom features like Excel import / PDF export).
- A `Dockerfile` + `entrypoint.sh` (+ `.dockerignore`) added specifically for Railway deployment: builds PHP 8.1 + Apache, maps Railway's auto-injected `MYSQLHOST/MYSQLPORT/MYSQLUSER/MYSQLPASSWORD/MYSQLDATABASE` to Laravel's `DB_*` vars, generates `APP_KEY` if missing, runs migrations on boot, binds Apache to Railway's `$PORT`.
- A production-tuned `.env.example` (APP_ENV=production, APP_URL=the Railway domain, LOG_LEVEL=warning).

**Why this matters:** This work already satisfies the "restore original + make Railway-deployable" goal from an earlier session. Don't re-clone/force-push over this repo — it would destroy the working Dockerfile/entrypoint.sh. Always `git fetch`/diff against `origin/main` first before assuming the repo needs a from-scratch reset.

**How to apply:** For local Replit testing only, use SQLite (`DB_CONNECTION=sqlite` + `env -u DATABASE_URL`, see the DATABASE_URL override memory) since Replit has no MySQL — this mirrors app behavior closely enough for smoke tests, but never commit that local `.env`. The real Railway deploy will use MySQL via entrypoint.sh's mapping.
