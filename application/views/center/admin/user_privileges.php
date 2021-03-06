<!-- Page Head -->
<h2>User Privileges</h2>
<p id="page-intro">Roles, Access and Authorization.</p>

<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->

	<div class="content-box-header">
		<h3>Edit Privileges - <?=$user["faculty_firstname"] . " " . $user["faculty_lastname"]?></h3>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->

	<div class="content-box-content">

		<div class="tab-content default-tab">
			<? if ($this->session->flashdata('success')) { ?>
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="<?=base_url()?>images/admin/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<?=$this->session->flashdata('success')?>
				</div>
			</div>
			<? } ?>

			<?=form_open('admin/set_privileges_process/' . $id)?>

				<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
					<?php foreach ($categories as $cat) { ?>
					<p>
						<label><?=$cat["category_name"]?></label>
						<?php foreach ($cat["roles"] as $role) { ?>
							<?=form_checkbox('privileges[]', $role["role_id"], $role["has_role"])?> <?=$role["role_name"]?><br />
						<?php } ?>
					</p>
					<?php } ?>
					<p>
						<input class="button" type="submit" value="Save Privileges" />
					</p>
				</fieldset>

				<div class="clear"></div><!-- End .clear -->

			</form>

		</div> <!-- End #tab2 -->

	</div> <!-- End .content-box-content -->
	
</div> <!-- End .content-box -->