 <!-- Page Head -->
<h2>Course List</h2><hr />

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
					<?php $i=0; ?>
					   <th>Name</th>
					   <th>Category</th>
					   
					   <?php if($this->user_model->currentUserHasAuthority("VIEW_LECTURE_UPDATE") || $courses[$i]["course_instructor"] == $this->session->userdata('faculty_id')) {?>
					   <th>Details</th>
					  <?php }?>					   
					   <?php if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")) {?>
					   <th>Update Marks</th>
					   <?php }?>
					   <?php if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")) {?>
					   <th>Edit Marks</th>
					   	<?php }?>
					   <?php if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")) {?>
					   <th>List Marks</th>
					   <?php }?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="6">
							<div class="bulk-actions align-left">
							</div>
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($courses as $course) { ?>
					<tr>
						<?php if($course["course_instructor"] == $this->session->userdata('faculty_id') || $course["course_examiner"] == $this->session->userdata('faculty_id')) {?>
						<td><?=$course["course_code"]?></td>
						<td><?=$course["course_name"]?></td>
						<?php if($this->user_model->currentUserHasAuthority("VIEW_LECTURE_UPDATE") || $course["course_instructor"] == $this->session->userdata('faculty_id')) {?>
						<td>
							<!-- Icons -->
							 <a href="<?=base_url('index.php/admin/view_course_detail')."/".$course["course_id"]?>" title="View">View Details</a>
						</td>
						<?php }?>
						<?php if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")) {?>
						<td>
							 <a href="<?=base_url('index.php/admin/update_course_marks')."/".$course["course_id"]?>" title="View">Update Marks</a>
						</td>
						<?php }?>
						<?php if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")) {?>
						<td>
							 <a href="<?=base_url('index.php/admin/edit_course_marks')."/".$course["course_id"]?>" title="View">Edit Marks</a>
						</td>
						<?php }?>
						<?php if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")) {?>
						<td>
							 <a href="<?=base_url('index.php/admin/view_course_marks')."/".$course["course_id"]?>" title="View">View Marks</a>
						</td>
						<?php }?>
					</tr>
					<?php }?>
					<?php }?>
				</tbody>
			</table>
	</div> <!-- End .content-box-content -->
	
</div>