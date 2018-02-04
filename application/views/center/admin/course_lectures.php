 <!-- Page Head -->
<?php foreach($details as $detail) { ?>
<h2><b>Course:</b><?php echo "   " . $detail["course_code"]?><?php echo " " . "(" . $detail["course_name"] . ")"?></h2><hr /><br /><br /><br />
<?php }?>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<ul class="content-box-tabs">
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
			<table>
				<thead>
					<tr>
					   <th>Number</th>
					   <th>Date</th>
					   <th>Duration</th>
					   <th> Details</th>
					   <?php if($this->user_model->currentUserHasAuthority("LECTURE_UPDATE")) {?>
					   <th> Action</th>
					   <?php }?>
					</tr>
				</thead>
				<tfoot>
				
					<tr>
						<td colspan="6">
							
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($lectures as $lecture) { ?>
					<tr>
						<td><?=$lecture["lecture_number"]?></td>
						<td><?=$lecture["lecture_date"]?></td>
						<td><?=$lecture["lecture_duration"]?></td>
						<td>
							<a href="<?=base_url('index.php/admin/view_lecture_details')."/".$lecture["lecture_id"] . "/" . $cId?>"><input class="button" type="button" value="Lecture Details" /></a>
						</td>
						<td>
							<!--Icon-->
							<?php if($this->user_model->currentUserHasAuthority("LECTURE_UPDATE")) {?>
							<a href="<?=base_url('index.php/admin/edit_lecture_updates')."/".$lecture["lecture_id"] . "/" . $cId?>" title="Edit Lecture"><img src="<?=base_url()?>images/admin/icons/pencil.png" alt="Edit" /></a>
							<?php }?>
							<?php if($this->user_model->currentUserHasAuthority("LECTURE_UPDATE")) {?>
							<a href="<?=base_url('index.php/admin/delete_lecture_updates')."/".$lecture["lecture_id"] . "/" . $cId?>" title="Delete Lecture"><img src="<?=base_url()?>images/admin/icons/cross.png" onClick="return confirm('Are you sure you want to delete this faculty?')" alt="Delete" /></a>
							<?php }?>
						</td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
	</div> <!-- End .content-box-content -->
	
</div>