# TiketKu Nine Page UI Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build nine navigable, responsive TiketKu pages that share one Blade layout and visual system, using sample content for pages whose backend is not implemented yet.

**Architecture:** Add a main Blade layout and small reusable partials, then route each page to a focused Blade view. Keep current auth actions and database behavior intact; use sample data only for catalog, event detail, checkout preview, buyer tickets, organizer dashboard, and scanner preview. Deliver the UI on a branch separate from the auth backend branch.

**Tech Stack:** Laravel 13.17, Blade, existing Tailwind CSS build, Pest. No new dependencies.

**Spec:** `docs/plans/ui-9-pages-design.md`, `docs/DESIGN.md`, `docs/PRD.md`

## Global Constraints

- Keep Laravel 13 and PHP 8.3; do not change dependencies.
- Use Indonesian interface copy and existing design tokens from `docs/DESIGN.md` / `resources/css/app.css`.
- No database writes or pretend payment, QR validation, camera scan, or real sales data in the view-only pages.
- Preserve working register, login, email verification, and profile behavior already implemented in the auth branch.
- Keep migrations and Eloquent models in the backend/auth workstream; this UI branch must not add organizer or later-stage tables.
- Follow responsive targets 375px, 768px, and 1280px; preserve keyboard focus and adequate contrast.

## Files and Responsibilities

- `routes/web.php`: named GET routes for event and preview pages, retaining existing auth routes.
- `resources/views/layouts/app.blade.php`: shared header, navigation, content slot, footer, and document metadata.
- `resources/views/components/`: reusable event card, status badge, button/link, and sample KPI fragments where repetition warrants it.
- `resources/views/pages/`: home, catalog, event detail, checkout preview, ticket list, organizer dashboard, and scanner preview.
- `resources/views/auth/*.blade.php`, `resources/views/profile/edit.blade.php`: use the shared visual shell while preserving form actions and validation states.
- `resources/css/app.css`: add token-based layout and page styles; no inline styles or new arbitrary palette.
- `tests/Feature/Pages/`: route render, navigation, sample content, and preview-only behavior.

## Review Focus

- Unknown event slugs should return 404 rather than render unrelated sample details; test a missing slug.
- Checkout and scanner preview must not create orders, payments, or check-ins; test request side effects remain absent.
- Guest navigation should not expose profile/logout routes; test guest and authenticated variants.
- Long event titles and narrow viewports must not overflow the layout; cover representative long copy in page tests and inspect target widths in the browser if available.
- Existing auth validation and redirect behavior must survive shared-layout adoption; retain existing auth feature tests.

---

### Task 1: Shared layout and navigation

**Files:**
- Create: `resources/views/layouts/app.blade.php`
- Create: `resources/views/components/navigation.blade.php`
- Create: `resources/views/components/footer.blade.php`
- Modify: `resources/css/app.css`
- Test: `tests/Feature/Pages/SharedLayoutTest.php`

**Interfaces:**
- Produces: layout sections `title`, `content`, and optional `eyebrow`; navigation links resolve only to named existing routes.

- [x] Write tests asserting document title, primary navigation labels, active-link state, and guest/auth navigation variants.
- [x] Run `php artisan test --compact tests/Feature/Pages/SharedLayoutTest.php`; confirmed failures before adding the layout.
- [x] Implement the token-based shared shell and navigation with visible keyboard focus and wrapping navigation for mobile.
- [x] Re-run the focused test and confirm it passes.
- [x] Run Pint on changed PHP/Blade-adjacent PHP files and build CSS with `npm run build`.

### Task 2: Public event discovery pages

**Files:**
- Create: `resources/views/pages/home.blade.php`
- Create: `resources/views/pages/events/index.blade.php`
- Create: `resources/views/pages/events/show.blade.php`
- Create: reusable event card component if needed
- Modify: `routes/web.php`
- Test: `tests/Feature/Pages/EventPagesTest.php`

**Interfaces:**
- Produces: `home`, `events.index`, and `events.show` named GET routes; `events.show` receives a known slug and returns 404 for unknown slugs.
- Sample event values live in a small route/controller data provider and are passed to views; do not query nonexistent models.

- [x] Write tests for all three page routes, key sample content, catalog filter controls, detail-to-checkout navigation, and unknown event slug 404.
- [x] Run the focused Pest file and confirm failures correspond to missing pages/routes.
- [x] Implement sample event data and the three Blade pages using the shared layout and token-based styles.
- [x] Re-run focused tests and confirm they pass.

### Task 3: Checkout preview and buyer ticket page

**Files:**
- Create: `resources/views/pages/checkout-preview.blade.php`
- Create: `resources/views/pages/my-tickets.blade.php`
- Modify: `routes/web.php`
- Test: `tests/Feature/Pages/BuyerPreviewPagesTest.php`

**Interfaces:**
- Produces: `checkout.demo` and `my-tickets` GET routes. Sample order/ticket display is read-only and explicitly marked as preview content.

- [x] Write tests asserting preview labels, links between checkout and ticket preview, and no database writes are issued.
- [x] Run the focused Pest file and confirm expected failures.
- [x] Implement the read-only pages with sample values and clear preview labeling; do not add a POST checkout/payment action.
- [x] Re-run focused tests and confirm they pass.

### Task 4: Organizer and scanner preview pages

**Files:**
- Create: `resources/views/pages/organizer/dashboard.blade.php`
- Create: `resources/views/pages/scanner.blade.php`
- Modify: `routes/web.php`
- Test: `tests/Feature/Pages/OperationsPreviewPagesTest.php`

**Interfaces:**
- Produces: `organizer.dashboard` and `scanner.preview` GET routes. Their copy identifies sample figures and preview-only scanner status.

- [x] Write tests for page rendering, sample-data labels, navigation links, and absence of order/check-in writes.
- [x] Run the focused Pest file and confirm expected failures.
- [x] Implement both preview pages without camera access or real ticket validation.
- [x] Re-run focused tests and confirm they pass.

### Task 5: Apply shared shell to auth/profile and verify the nine-page set

**Files:**
- Modify: `resources/views/auth/login.blade.php`
- Modify: `resources/views/auth/register.blade.php`
- Modify: `resources/views/auth/verify-email.blade.php`
- Modify: `resources/views/profile/edit.blade.php`
- Test: existing `tests/Feature/Auth/` plus all `tests/Feature/Pages/`

- [x] Add/adjust tests confirming auth forms retain field errors, old input, and their current named POST routes after adopting the shared shell.
- [x] Re-run focused tests and verify the auth flows remain intact.
- [x] Apply the shared layout to login, register, verification, and profile views while keeping controller/action behavior unchanged.
- [x] Run all Pest tests, Pint, PHPStan, and `npm run build`.
- [ ] Inspect the nine routes at 375px, 768px, and 1280px, including keyboard navigation and visible focus; fix any overflow or dead navigation link. (Source/CSS review and route tests done; interactive browser click-through not run because the project instructions prohibit starting a long-lived server unless requested.)
- [ ] Commit UI work on its separate branch and create/prepare its separate PR after the auth base branch is reviewable.

### Task 6: Write user manual and demo guide after the pages are complete

**Files:**
- Create: `docs/USER-MANUAL.md`
- Create: `docs/DEMO-GUIDE.md`

- [x] Inspect the implemented named routes, seeders, and auth flow; record the exact available steps and any external setup required.
- [x] Write the Indonesian user manual covering navigation, account access, the buyer pages, and organizer/scanner preview limitations.
- [x] Write a local demo sequence that opens all nine pages and clearly distinguishes working auth from sample-only checkout, ticket, dashboard, and scanner content.
- [x] Verify every URL, command, and account instruction in the guides against the implementation; do not invent demo credentials or claim sample interactions persist.

## Branch and Backend Sequence

1. Finish and review the already requested auth/database-model branch (a), then keep organizer membership (b) for its separately approved turn.
2. Create the UI branch from the auth branch tip so login/register render correctly, with a separate PR targeting that auth branch.
3. After the UI preview, continue backend work by wiring the approved pages to migrations and Eloquent models in the appropriate project stages. Do not invent later-stage schemas in this UI plan.
