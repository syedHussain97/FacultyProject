 <!-- Page Head -->
<h2>Update Marks</h2>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>Course Marks</h3>
		<ul class="content-box-tabs">
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
			
			<?=form_open('admin/update_course_marks_process/' . $cId); ?>
			<table>
				<thead>
					<tr>
					   <th>Student Id</th>
					   <th>Student Name</th>
					   <th>Marks</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="6">
							<div class="bulk-actions align-left">
								<input class="button" type="submit" onClick="return confirm('Are you sure?')" value="Done" />
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
						<td><input type="hidden" value="<?=$student["student_id"]?>" name="stdId[]" /></td>
						<td><input type="text" value="0" class="text-input medium-input" name="stdMarks[]" /></td>
						<td>
							<!-- Icons -->
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</form><!-- End #tab1 -->
	</div> <!-- End .content-box-content -->
	
</div>