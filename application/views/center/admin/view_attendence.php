 <!-- Page Head -->
<h2>View Attendence</h2>
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
			<table>
				<thead>
					<tr>
					   <th>Student Id</th>
					   <th>Student Name</th>
					   <th>Status</th>
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
						<td><?=$student["status"]?></td>
						<td>
							<!-- Icons -->
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
	</div> <!-- End .content-box-content -->
	
</div>