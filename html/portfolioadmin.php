<?php
require_once __DIR__ . '/../lib/supabase.php'; require_user(true); $csrf=csrf(); $message='';
try {
 if($_SERVER['REQUEST_METHOD']==='POST') { check_post(); $data=['name'=>field('name',200),'tag'=>field('tag',100),'price'=>field('price',100),'points'=>array_values(array_filter(array_map('trim',explode("\n",field('points',3000))))),'active'=>isset($_POST['active'])]; if(!$data['name']) throw new RuntimeException('Service name is required.'); $id=field('id',36); db('services'.($id?'?id=eq.'.rawurlencode($id):''),$id?'PATCH':'POST',$data,'return=minimal'); $message='Service saved.'; }
 $rows=db('services?order=created_at');
} catch(RuntimeException $e) { $message=$e->getMessage(); $rows=[]; }
page_start('Manage Services'); if($message) notice($message); ?><p><a href="indexxadmin.php">Booking Report</a> · <a href="feedbackadmin.php">Feedback</a></p>
<?php $rows[]=['id'=>'','name'=>'','tag'=>'','price'=>'','points'=>[],'active'=>true]; foreach($rows as $r): ?><form method="post" class="card card-body"><?= $csrf ?><h2><?= $r['id']?'Edit service':'Add service' ?></h2><input type="hidden" name="id" value="<?= esc($r['id']) ?>"><?php foreach(['name'=>'Service name','tag'=>'Category','price'=>'Price description'] as $key=>$label) input($key,$label,$r[$key]); ?><label>Features (one per line)<textarea name="points"><?= esc(implode("\n",$r['points'])) ?></textarea></label><label><input type="checkbox" name="active" <?= $r['active']?'checked':'' ?>> Visible on services page</label><button class="btn">Save service</button></form><?php endforeach; page_end(); ?>
