<a href="<?=base_url('index.php/admin/profile/' . $faculty['id'])?>">
<?php if($faculty['image']) {?>

<img src="<?php echo base_url() . "/images/uploads/" . $faculty['image']?>" width="100px" height="100px" alt="profile picture" />
<?php } else {?>
<img src="<?php echo base_url() . "/images/uploads/logo.png"?>" width="100px" height="100px" alt="profile picture" />
<?php }?></a>
<?php if($faculty['id'] == $this->session->userdata('faculty_id')) {?>
<a href="<?=base_url('index.php/admin/edit_profile')."/".$this->session->userdata('faculty_id')?>"  style=margin-left:830px >Edit Profile</a><?php }?>
<hr />
<div style=margin-left:60px>
<p><b>Name:</b><?php echo "   " . $faculty["name"]?><?php echo " " . "(" . $faculty["cat_name"] . ")"?></p>
<p><b>Institute:</b><?php echo "   " . $faculty["institute"]?></p>
<p><b>Qualification:</b><?php echo "   " . $faculty["education"]?></p>
<p><b>NIC:</b><?php echo "   " . $faculty["nic"]?></p>
<p><b>Email:</b><?php echo "   " . $faculty["email"]?></p>
<?php if($faculty["address"]) {?>
<p><b>Address:</b><?php echo "   " . $faculty["address"]?></p><?php }?>

<?php if($faculty["phone"]) {?>
<p><b>Contact Phone:</b><?php echo "   " . $faculty["phone"]?></p><?php }?>
<?php if($faculty["mobile"]) {?>
<p><b>Contact Mobile:</b><?php echo "   " . $faculty["mobile"]?></p><?php }?>
<br />
<ul>
<?php if($courses) {
	$i=0;
	foreach($courses as $course) { ?>
	<?php if($i==0) { ?>
<b style=font-size:15px>Course:</b><?php $i++; }?>
<p style=margin-left:50px><a href="<?=base_url('index.php/admin/view_course_detail/' . $course["course_id"])?>">
<?php
		echo "<li>" . $course["course_code"] . "-" .$course["course_name"] . "<br />" . "<br />" . "</li>";
	}
}?>
</a></p>
</ul>
</div>