  <!-- Page Head -->
<?php foreach($details as $detail) { ?>
<h2><b>Course:</b><?php echo "   " . $detail["course_code"]?><?php echo " " . "(" . $detail["course_name"] . ")"?></h2><hr /><br /><br /><br />
<?php }?>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box column-left">

	<div class="content-box-header">
	<h2>Add Lecutre Updates</h2>
		<ul class="content-box-tabs">
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->

	<div class="content-box-content">
<?=form_open('admin/update_lecture/' . $lId . "/" . $cId); ?>
<? if ($this->session->flashdata('error')) { ?>
<div class="notification error png_bg">
	<a href="#" class="close"><img src="<?=base_url()?>images/admin/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
	<div>
		<?=$this->session->flashdata('error')?>
	</div>
</div>
<? } ?>	
	<div class="tab-content_create">
				<fieldset>
					<p>
						<label>Lecture Number</label>
						<input type="text" class="text-input medium-input" name="number" value="<?=set_value('number',$lectures["lecture_number"])?>" />
						<? if (form_error('number')) { ?>
						<?=form_error('number','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Lecture Updates</label>
						<input type="text" class="text-input medium-input" name="description" value="<?=set_value('description',$lectures["lecture_updates"])?>" />
						<? if (form_error('description')) { ?>
						<?=form_error('description','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Date</label>
						<input type="text" class="text-input medium-input" name="date" value="<?=set_value('date',$lectures["lecture_date"])?>" />
						<? if (form_error('date')) { ?>
						<?=form_error('date','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Duration</label>
						<input type="text" class="text-input medium-input" name="duration" value="<?=set_value('model',$lectures["lecture_duration"])?>" />
						<? if (form_error('duration')) { ?>
						<?=form_error('duration','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>	
					<p>
						<input type="submit" class="button" name="add" value="Update" />
					</p>
				</fieldset>


			

		</div> <!-- End #tab2 -->
</form>
	</div> <!-- End .content-box-content -->
	
</div> <!-- End .content-box -->


				<div class="clear"></div><!-- End .clear -->