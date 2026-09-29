# Maxy Production / Maxy Fusion

PHP portfolio hosted on Vercel, with Supabase Auth and PostgreSQL for profiles, bookings, services, and feedback. The galleries and image assets are retained.

## Layout and content

Navigation is grouped into four sections — Work, About, Services and Contact — defined once in `site_sections()` in `html/partials/data.php`. The header, the tabs under each page title (`page_header()`), and the footer columns are all generated from it, so adding or renaming a page happens there. Portfolio items, artwork groups, packages, awards and films also live in `data.php`; contact details and social links are in `site_brand()` (a social link only appears on the contact page once it has a URL). All pages share `css/premium.css` and `js/premium.js`; the older `styles*.css` and `script*.js` files are no longer referenced.

## Deployment

Import `Maxiryn/Maxy-production` in Vercel. Use the repository root (`./`), the **Other** preset, and no build or install command. `vercel.json` pins the community PHP runtime to `vercel-php@0.9.0` and routes PHP through an allowlisted entry point. Only asset directories are served directly; PHP source and database files are not public downloads.

Set `SUPABASE_URL` and `SUPABASE_PUBLISHABLE_KEY` in Vercel for Production and Preview. Use the publishable key, never a secret/service-role key. The server sends the user's access token to the Data API so row-level security applies to every request. Access/refresh cookies are HttpOnly, SameSite=Lax and Secure on Vercel. There is no local session or CSV dependency.

Database definitions are saved in `supabase/schema.sql`. They were applied to project `amnfmvznnmijlfiqckyd` as migration `maxy_production_supabase`; do not reapply to an initialized database. `supabase/restrict-auto-rls.sql` records a separate hardening migration for an existing internal event trigger.

Configure the deployed URL under Supabase Authentication → URL Configuration so confirmation emails return to the website. Configure production SMTP before opening registration to external customers; Supabase's default email provider is intended for testing. Email confirmation remains enabled.

## Accounts and access

Customers create accounts at `/html/sign-up.php`, confirm their email, and sign in. Profiles and feedback are private. Signed-in bookings belong to the user's immutable Supabase user ID. Guest bookings are insert-only and visible to administrators; they are not matched to accounts merely by an unverified email address.

An administrator must have `app_metadata.role` set to `admin` by the Supabase project owner after verifying the account. Never use user-editable `user_metadata` for authorization. Admin login is `/html/admin_login.php`. Admins can view inquiries, change booking status, review feedback, and manage service packages. Customers can cancel only their own pending bookings. All mutations require POST and a CSRF token.

The new database starts without historical customers/bookings. Existing MySQL data and the old `data/bookings.csv` must be exported and migrated separately; this repository contains neither. Existing users need new Supabase accounts unless a separate verified user migration is performed. No historical data has been deleted.

## Development and checks

Requires PHP 8.2+ with cURL. Set the two environment variables, then run:

```sh
php -S 127.0.0.1:18765 api/index.php
node tests/http.cjs
```

Lint all PHP files with `php -l`. `tests/rls.sql` runs database access tests inside a transaction and rolls back its fixtures. It checks customer isolation, guest read denial, forged role denial, feedback ownership, and admin status updates. `TEST_BASE_URL` can point the HTTP checks at a deployed site.

The original repository references video files absent from Git; posters render but those videos require the original media to be uploaded separately.
