-- New Supabase schema. Existing MySQL/CSV records require a separate data import.
create table public.profiles (
 id uuid primary key references auth.users(id) on delete cascade,
 full_name text not null default '' check(length(full_name)<=500),
 nickname text not null default '' check(length(nickname)<=500),
 ic_number text not null default '' check(length(ic_number)<=500),
 address text not null default '' check(length(address)<=500),
 age integer check(age between 0 and 130), dob date,
 created_at timestamptz not null default now()
);
create table public.bookings (
 id uuid primary key default gen_random_uuid(),
 user_id uuid references auth.users(id) on delete set null,
 name text not null check(length(name) between 1 and 200),
 email text not null check(length(email) between 3 and 254),
 phone text not null check(length(phone) between 1 and 50),
 service text not null check(service in ('Photography','Videography','Model Portfolio','Event Coverage','Cinematic Production','Creative Direction')),
 preferred_date date, budget text not null default '' check(length(budget)<=100),
 message text not null default '' check(length(message)<=5000),
 status text not null default 'Pending' check(status in ('Pending','Confirmed','Completed','Cancelled')),
 created_at timestamptz not null default now()
);
create index bookings_user_id_idx on public.bookings(user_id);
create table public.feedback (
 id uuid primary key default gen_random_uuid(),
 booking_id uuid not null references public.bookings(id) on delete cascade,
 user_id uuid not null references auth.users(id) on delete cascade,
 rating integer not null check(rating between 1 and 5),
 comment text not null check(length(comment) between 1 and 5000),
 created_at timestamptz not null default now(), unique(booking_id,user_id)
);
create index feedback_user_id_idx on public.feedback(user_id);
create table public.services (
 id uuid primary key default gen_random_uuid(),
 name text not null check(length(name) between 1 and 200),
 tag text not null default '' check(length(tag)<=100),
 price text not null default '' check(length(price)<=100),
 points jsonb not null default '[]' check(jsonb_typeof(points)='array'),
 active boolean not null default true, created_at timestamptz not null default now()
);
alter table public.profiles enable row level security;
alter table public.bookings enable row level security;
alter table public.feedback enable row level security;
alter table public.services enable row level security;
revoke all on public.profiles,public.bookings,public.feedback,public.services from anon, authenticated;
grant select,insert,update on public.profiles to authenticated;
grant insert on public.bookings to anon;
grant select,insert,update,delete on public.bookings to authenticated;
grant select,insert on public.feedback to authenticated;
grant select on public.services to anon;
grant select,insert,update on public.services to authenticated;
create policy profiles_read on public.profiles for select to authenticated using(id=(select auth.uid()));
create policy profiles_insert on public.profiles for insert to authenticated with check(id=(select auth.uid()));
create policy profiles_update on public.profiles for update to authenticated using(id=(select auth.uid())) with check(id=(select auth.uid()));
create policy bookings_guest_insert on public.bookings for insert to anon with check(user_id is null and status='Pending');
create policy bookings_user_insert on public.bookings for insert to authenticated with check(user_id=(select auth.uid()) and status='Pending');
create policy bookings_read on public.bookings for select to authenticated using(user_id=(select auth.uid()) or (select auth.jwt()->'app_metadata'->>'role')='admin');
create policy bookings_cancel on public.bookings for delete to authenticated using(user_id=(select auth.uid()) and status='Pending');
create policy bookings_admin_update on public.bookings for update to authenticated using((select auth.jwt()->'app_metadata'->>'role')='admin') with check((select auth.jwt()->'app_metadata'->>'role')='admin');
create policy feedback_read on public.feedback for select to authenticated using(user_id=(select auth.uid()) or (select auth.jwt()->'app_metadata'->>'role')='admin');
create policy feedback_insert on public.feedback for insert to authenticated with check(user_id=(select auth.uid()) and exists(select 1 from public.bookings b where b.id=booking_id and b.user_id=(select auth.uid())));
create policy services_read on public.services for select to anon,authenticated using(active or (select auth.jwt()->'app_metadata'->>'role')='admin');
create policy services_insert on public.services for insert to authenticated with check((select auth.jwt()->'app_metadata'->>'role')='admin');
create policy services_update on public.services for update to authenticated using((select auth.jwt()->'app_metadata'->>'role')='admin') with check((select auth.jwt()->'app_metadata'->>'role')='admin');
insert into public.services(name,tag,price,points) values
('Signature Portrait Session','Photography','From RM350','["Creative direction","Edited premium gallery","Indoor / outdoor concept","Usage-ready digital delivery"]'),
('Cinematic Event Coverage','Videography','From RM900','["Highlight film","Event storytelling","Professional camera movement","Social media cutdown"]'),
('Model Portfolio Build','Portfolio','From RM550','["Pose direction","Editorial portraits","Lookbook selection","Online portfolio-ready output"]'),
('Full Creative Production','Production','Custom Quote','["Concept development","Shoot planning","Camera work","Post-production direction"]');
