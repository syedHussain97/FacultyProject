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
			<?=form_open('admin/delete_faculty_bulk_process/'); ?>
			<table>
				<thead>
					<tr>
					   <th><input class="check-all" type="checkbox" /></th>
					   <th>Name</th>
					   <th>Category</th>
					   <?php if($this->user_model->currentUserHasAuthority("ADD_FACULTY")) {?>
					   <th>Actions</th>
					   <?php }?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="6">
							<div class="bulk-actions align-left">
								<select name="action">
									<option value="none">Choose an action...</option>
									<option value="delete">Delete</option>
								</select>
								<input class="button" type="submit" onClick="return confirm('Are you sure?')" value="Apply to selected" />
							</div>
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($faculty as $fac) { ?>
					<tr>
						<td><input type="checkbox" value="<?=$fac["faculty_id"]?>" name="faculty[]" /></td>
						<td><?=$fac["name"]?></td>
						<td><?=$fac["category"]?></td>
						<td>
							<!-- Icons -->
							 <?php if($this->user_model->currentUserHasAuthority("ADD_FACULTY")) {?>
							 <a href="<?=base_url('index.php/admin/edit_profile')."/".$fac["faculty_id"]?>" title="Edit"><img src="<?=base_url()?>images/admin/icons/pencil.png" alt="Edit" /></a>
							 <?php }?>
							 <?php if($this->user_model->currentUserHasAuthority("ADD_FACULTY")) {?>
							 <a href="<?=base_url('index.php/admin/delete_faculty')."/".$fac["faculty_id"]?>" title="Delete"><img src="<?=base_url()?>images/admin/icons/cross.png" onClick="return confirm('Are you sure you want to delete this faculty?')" alt="Delete" /></a>
							 <?php }?>
							 <?php if($this->user_model->currentUserHasAuthority("ADD_FACULTY")) {?>
							 <a href="<?=base_url('index.php/admin/set_privileges')."/".$fac["faculty_id"]?>" title="Edit Privileges"><img src="<?=base_url()?>images/admin/icons/hammer_screwdriver.png" alt="Edit Privileges" /></a>
							 <?php }?>
						</td>
						<td>
							 <?php if($this->user_model->currentUserHasAuthority("VIEW_FACULTY_PROFILE")) {?>
							 <a href="<?=base_url('index.php/admin/profile')."/".$fac["faculty_id"]?>" title="Profile">View Profile</a>
							 <?php }?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</form><!-- End #tab1 -->
	</div> <!-- End .content-box-content -->
	
</div>