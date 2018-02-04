 <!-- Page Head -->
 <?php foreach($details as $detail) {?>
<h2><b>Course:</b><?php echo "   " . $detail["course_code"]?><?php echo " " . "(" . $detail["course_name"] . ")"?></h2><hr /><br /><br /><br />


<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<ul class="content-box-tabs">
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
<p><b>Outline:</b><?php echo "   " . $detail["course_outline"]?></p>

</div>
<table>
<tfoot>
					<tr>
						<td colspan="6">
							<div class="bulk-actions align-right">
								<?php if($this->user_model->currentUserHasAuthority("MARK_ATTENDENCE")) {?>
								<a href="<?=base_url('index.php/admin/lecture_update/' . $detail["course_id"])?>"><input class="button" type="button" value="Mark Attendence" /></a>
								<?php }?>
								<?php if($this->user_model->currentUserHasAuthority("VIEW_STUDENT_MARKS")) {?>
								<a href="<?=base_url('index.php/admin/view_course_marks/' . $detail["course_id"])?>"><input class="button" type="button" value="View Marks" /></a>
								<?php }?>
								<?php if($detail["course_instructor"] == $this->session->userdata('faculty_id') || $this->user_model->currentUserHasAuthority("VIEW_LECTURE_UPDATE")) {?>
								<a href="<?=base_url('index.php/admin/view_lectures/' . $detail["course_id"])?>"><input class="button" type="button" value="View Lectures" /></a>
								<?php }?>
							</div>
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				</table>
</div>
<?php }?>
