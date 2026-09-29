const assert=require('node:assert/strict');
const base=process.env.TEST_BASE_URL||'http://127.0.0.1:18765';
(async()=>{
 for(const page of ['index','about','portfolio','artwork','services','booking','login','admin_login','sign-up','history','faq']){
  const r=await fetch(base+'/html/'+page+'.php'); assert.equal(r.status,200,page); const t=await r.text(); assert(!t.includes('<?php'),page+' exposed source'); assert(!/Fatal error|Warning:|could not complete this request/.test(t),page+' PHP error');
 }
 for(const page of ['profile','indexxadmin','feedbackadmin','portfolioadmin']){const r=await fetch(base+'/html/'+page+'.php',{redirect:'manual'});assert.equal(r.status,303,page+' auth');}
 for(const path of ['/lib/supabase.php','/html/partials/data.php','/.env','/supabase/schema.sql','/html/config.php']){assert.equal((await fetch(base+path)).status,404,path+' hidden');}
 assert.equal((await fetch(base+'/html/submit_booking.php')).status,405);
 assert.equal((await fetch(base+'/html/submit_booking.php',{method:'POST'})).status,403);
 const form=await fetch(base+'/html/booking.php'); const cookie=form.headers.getSetCookie().map(v=>v.split(';')[0]).join('; ');const html=await form.text();const csrf=html.match(/name="csrf" value="([^"]+)"/)[1];
 const invalid=await fetch(base+'/html/submit_booking.php',{method:'POST',headers:{cookie,'Content-Type':'application/x-www-form-urlencoded'},body:new URLSearchParams({csrf,name:'Test',email:'bad'})});assert.equal(invalid.status,400);
 assert.equal((await fetch(base+'/img/logo.png')).status,200);
 console.log('HTTP checks passed: public pages, protected routes, source protection, CSRF, validation, assets.');
})().catch(e=>{console.error(e);process.exit(1)});
