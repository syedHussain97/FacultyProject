<?=form_open('admin/authenticate'); ?>
<?php
	if ($this->session->flashdata('error')) {
?>
	<div class="error"><?=$this->session->flashdata('error')?></div>
<?php } ?>
<h5>Username</h5>
<?php echo form_error('username');?>
<input type="text" name="username" value="" size="50" /><br />
<h5>Password</h5>
<?php echo form_error('password'); ?>
<input type="password" name="password" value="" size="50" /><br /><br />
<input type="submit" value="Submit" />