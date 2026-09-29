# Maxy-production

Keep the existing PHP portfolio design and assets. Vercel serves PHP through api/index.php using the pinned community runtime in vercel.json.

All account and database requests go through lib/supabase.php. Use the publishable key and the signed-in user's JWT; never use a service-role key for user requests. Supabase RLS is the authorization boundary. Admin authorization comes only from app_metadata.role, never user_metadata.

All writes use POST and CSRF checks. Escape user content with esc(). Keep credentials out of Git. Run PHP lint and tests before pushing. Preserve the main branch until migration checks pass.
