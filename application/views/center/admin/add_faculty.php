<h2>Add Faculty</h2>
<p id="page-intro">You can add a faculty using the form below.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box column-left">

	<div class="content-box-header">
		<h3>Add Faculty</h3>
		<ul class="content-box-tabs">
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->

	<div class="content-box-content">
<?=form_open('admin/create_faculty_process'); ?>
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
						<label>FirstName</label>
						<input type="text" class="text-input medium-input" name="firstname" value="<?=set_value('model','')?>" />
						<? if (form_error('firstname')) { ?>
						<?=form_error('firstname','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>LastName</label>
						<input type="text" class="text-input medium-input" name="lastname" value="<?=set_value('model','')?>" />
						<? if (form_error('lastname')) { ?>
						<?=form_error('lastname','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Username</label>
						<input type="text" class="text-input medium-input" name="username" value="<?=set_value('model','')?>" />
						<? if (form_error('username')) { ?>
						<?=form_error('username','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Email</label>
						<input type="text" class="text-input medium-input" name="email" value="<?=set_value('model','')?>" />
						<? if (form_error('email')) { ?>
						<?=form_error('email','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Password</label>
						<input type="text" class="text-input medium-input" name="password" value="<?=set_value('model','')?>" />
						<? if (form_error('password')) { ?>
						<?=form_error('password','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Qualification</label>
						<input type="text" class="text-input medium-input" name="qualification" value="<?=set_value('model','')?>" />
						<? if (form_error('qualification')) { ?>
						<?=form_error('qualification','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>			
					<p>
						<label>NIC Number</label>
						<input type="text" class="text-input medium-input" name="nic" value="<?=set_value('model','')?>" />
						<? if (form_error('nic')) { ?>
						<?=form_error('nic','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>			
					<p>
						<label>Address</label>
						<input type="text" class="text-input medium-input" name="address" value="<?=set_value('model','')?>" />
						<? if (form_error('address')) { ?>
						<?=form_error('address','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>			
					<p>
						<label>Contact Phone</label>
						<input type="text" class="text-input medium-input" name="phone" value="<?=set_value('model','')?>" />
						<? if (form_error('phone')) { ?>
						<?=form_error('phone','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>			
					<p>
						<label>Contact Mobile</label>
						<input type="text" class="text-input medium-input" name="mobile" value="<?=set_value('model','')?>" />
						<? if (form_error('mobile')) { ?>
						<?=form_error('mobile','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>
					<p>
						<label>Category</label>
						<?=form_dropdown('category', $categories, '', 'class="medium-input" id="category"')?>
						<? if (form_error('category')) { ?>
						<?=form_error('category','<span class="input-notification error png_bg">','</span>')?>
						<? } ?>
					</p>	
					<p>
						<input type="submit" class="button" name="add" value="Add Faculty" />
					</p>
				</fieldset>


			

		</div> <!-- End #tab2 -->
</form>
	</div> <!-- End .content-box-content -->
	
</div> <!-- End .content-box -->


				<div class="clear"></div><!-- End .clear -->