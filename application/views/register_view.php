<html>
<head>
<link rel="stylesheet" type="text/css" href="googlemap.css" />
</head>
<body>
	<center>
	<div class="main">
		<?=form_open('home/registration_process'); ?>
		<h5>Username</h5>
		<?php echo form_error('username');?>
		<input type="text" name="username" value="" size="50" /><br />
		<h5>Password</h5>
		<?php echo form_error('password'); ?>
		<input type="password" name="password" value="" size="50" /><br />
		<h5>Firstname</h5>
		<?php echo form_error('firstname'); ?>
		<input type="text" name="firstname" value="" size="50" /><br />
		<h5>Lastname</h5>
		<?php echo form_error('lastname'); ?>
		<input type="text" name="lastname" value="" size="50" /><br />

		<input type="submit" value="SignUp" />
	</div></center>

	</body>
</html>
