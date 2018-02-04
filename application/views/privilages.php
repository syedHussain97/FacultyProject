<html>
<head>
</head>
<body>
	<center>
	<div class="main">
		<?php
		echo form_open('home/privilages');
			foreach ($categories as $cat) {
		?>
		<h2><?=$cat["role_category_name"]?></h2>
		<?php
			foreach ($cat["roles"] as $role) {
				echo "<p>" . $role["role_name"] . " (" . $role["role_id"] . ")</p>" . 
				form_checkbox('newsletter', $role["role_id"], TRUE);
			}
		?>
		<?php } 
			echo form_submit('submit', 'submit')?>
		</form>
	</div></center>

	</body>
</html>