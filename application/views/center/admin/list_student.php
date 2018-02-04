 <!-- Page Head -->
<h2>Faculty List</h2>
<p id="page-intro">You can edit, delete and update faculty information from here.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>FACULTY LIST</h3>
		<ul class="content-box-tabs">
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
			<?=form_open('admin/delete_student_bulk_process/'); ?>
			<table>
				<thead>
					<tr>
					   <th>Name</th>
					   <th>Category</th>
					   <th>Profile</th>
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
					<?php foreach ($students as $student) { ?>
					<tr>
						<td><?=$student["student_roll_number"]?></td>
						<td><?=$student["student_name"]?></td>
						<td>
							<!-- Icons -->
							 <?php if($this->user_model->currentUserHasAuthority("VIEW_STUDENT_PROFILE")) {?>
							 <a href="<?=base_url('index.php/admin/student_profile')."/".$student["student_id"]?>" title="Profile">View Profile</a>
							 <?php }?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</form><!-- End #tab1 -->
	</div> <!-- End .content-box-content -->
	
</div>