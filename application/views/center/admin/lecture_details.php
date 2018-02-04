 <!-- Page Head -->
<?php foreach($details as $detail) { ?>
<h2><b>Course:</b><?php echo "   " . $detail["course_code"]?><?php echo " " . "(" . $detail["course_name"] . ")"?></h2><hr /><br /><br /><br />
<?php }?>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>Lecture Details</h3>
		<ul class="content-box-tabs">
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="clear"></div> <!-- End .clear -->
		<div class="content-box-content">
			<p><b>Lecture Number:</b><?php echo "   " . $lectures["lecture_number"]?></p>
			<p><b>Description:</b><?php echo "   " . $lectures["lecture_updates"]?></p>
			<p><b>Date:</b><?php echo "   " . $lectures["lecture_date"]?></p>
			<p><b>Duration:</b><?php echo "   " . $lectures["lecture_duration"]?></p>
		</div>
	<table>
	<tfoot>
		<tr>
			<td colspan="6">
				<div class="bulk-actions align-right">
					<?php if($this->user_model->currentUserHasAuthority("VIEW_LECTURE_UPDATE") || $this->user_model->currentUserHasAuthority("UPDATE_ATTENDENCE")) {?>
					<a href="<?=base_url('index.php/admin/view_attendence')."/". $lectures["lecture_id"] . "/" . $cId?>"><input class="button" type="button" value="View Attendence" /></a>
					<?php }?>
					<?php if($this->user_model->currentUserHasAuthority("UPDATE_ATTENDENCE")) {?>
					<a href="<?=base_url('index.php/admin/change_attendence')."/". $lectures["lecture_id"] . "/" . $cId?>"><input class="button" type="button" value="Update Attendence"/></a>
					<?php }?>
				</div>
				<div class="clear"></div>
			</td>
		</tr>
	</tfoot>
	</table>
	</div>


