<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CMS | Sign In</title>
<link rel="stylesheet" href="<?=base_url().STYLES_FOLDER?>admin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url().STYLES_FOLDER?>admin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url().STYLES_FOLDER?>admin/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="<?=base_url().JS_FOLDER;?>jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url().JS_FOLDER;?>simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="<?=base_url().JS_FOLDER;?>facebox.js"></script>
<script type="text/javascript" src="<?=base_url().JS_FOLDER;?>jquery.wysiwyg.js"></script>
</head>
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>CMS Admin</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="<?=base_url()?>/images/admin/logo.png" alt="Simpla Admin logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<?=form_open('admin/authenticate'); ?>
				<?php
					if ($this->session->flashdata('error')) {
				?>
					<div class="notification error png_bg">
						<div>
							<?=$this->session->flashdata('error')?>
						</div>
					</div>
				<?php } else { ?>
					<div class="notification information png_bg">
						<div>
							Please enter your credentials.
						</div>
					</div>
				<?php } ?>
					<p>
						<label>Username</label>
						<input class="text-input" type="text" name="username" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password" name="password" />
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" value="Sign In" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
  </body>
</html>
