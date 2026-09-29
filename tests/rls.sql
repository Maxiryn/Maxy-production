begin;
insert into auth.users(id,email) values ('11111111-1111-4111-8111-111111111111','rls-a@example.invalid'),('22222222-2222-4222-8222-222222222222','rls-b@example.invalid');
set local role authenticated;
select set_config('request.jwt.claims','{"sub":"11111111-1111-4111-8111-111111111111","role":"authenticated","app_metadata":{}}',true);
insert into public.profiles(id,full_name) values ('11111111-1111-4111-8111-111111111111','Test A');
insert into public.bookings(id,user_id,name,email,phone,service) values ('33333333-3333-4333-8333-333333333333','11111111-1111-4111-8111-111111111111','Test A','rls-a@example.invalid','test','Photography');
select 1/(case when count(*)=1 then 1 else 0 end) as own_booking_visible from public.bookings;
select set_config('request.jwt.claims','{"sub":"22222222-2222-4222-8222-222222222222","role":"authenticated","user_metadata":{"role":"admin"},"app_metadata":{}}',true);
select 1/(case when count(*)=0 then 1 else 0 end) as other_booking_hidden from public.bookings;
select 1/(case when count(*)=0 then 1 else 0 end) as other_profile_hidden from public.profiles;
do $$ begin
 begin
 insert into public.feedback(booking_id,user_id,rating,comment) values ('33333333-3333-4333-8333-333333333333','22222222-2222-4222-8222-222222222222',5,'Unauthorized');
 raise exception 'Cross-user feedback was allowed';
 exception when insufficient_privilege then null; end;
 begin
 insert into public.profiles(id,full_name) values ('11111111-1111-4111-8111-111111111111','Forbidden');
 raise exception 'Cross-user profile write was allowed';
 exception when insufficient_privilege then null; end;
end $$;
update public.bookings set status='Confirmed';
select set_config('request.jwt.claims','{"sub":"11111111-1111-4111-8111-111111111111","role":"authenticated","app_metadata":{}}',true);
select 1/(case when status='Pending' then 1 else 0 end) as status_escalation_blocked from public.bookings;
insert into public.feedback(booking_id,user_id,rating,comment) values ('33333333-3333-4333-8333-333333333333','11111111-1111-4111-8111-111111111111',5,'Owner feedback');
select set_config('request.jwt.claims','{"sub":"22222222-2222-4222-8222-222222222222","role":"authenticated","app_metadata":{"role":"admin"}}',true);
select 1/(case when count(*)=1 then 1 else 0 end) as admin_booking_visible from public.bookings;
update public.bookings set status='Confirmed';
select 1/(case when status='Confirmed' then 1 else 0 end) as admin_update_allowed from public.bookings;
set local role anon;
select set_config('request.jwt.claims','{"role":"anon"}',true);
insert into public.bookings(name,email,phone,service) values ('Guest','guest@example.invalid','test','Photography');
do $$ begin
 begin perform * from public.bookings; raise exception 'Guest read was allowed'; exception when insufficient_privilege then null; end;
 begin insert into public.bookings(user_id,name,email,phone,service) values ('11111111-1111-4111-8111-111111111111','Guest','guest@example.invalid','test','Photography'); raise exception 'Guest impersonation allowed'; exception when insufficient_privilege then null; end;
end $$;
select 1/(case when count(*)=4 then 1 else 0 end) as public_services_visible from public.services;
rollback;
