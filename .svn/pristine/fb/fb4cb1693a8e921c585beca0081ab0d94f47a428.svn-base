<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$header_data["title"]?> - CMS</title>
<!-- styles -->
<?php
    if ( ! empty($header_data["css_load"]))
    {
        for($i = 0; $i < count($header_data["css_load"]); $i++)
        {
            echo "\r\n    <link href=\"".base_url().STYLES_FOLDER.$header_data["css_type"][$i].$header_data["css_load"][$i].".css\" rel=\"stylesheet\" type=\"text/css\" />";
        }
    }
?>


<!-- scripts -->
<?php    
    if ( ! empty($header_data["js_load"]))
    {
        for($i = 0; $i < count($header_data["js_load"]); $i++)
        {
            echo "    <script type=\"text/javascript\" src=\"".base_url().JS_FOLDER.$header_data["js_type"][$i].$header_data["js_load"][$i].".js\"></script>\r\n";
        }
    }
?>
</head>
	<body>
		<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
			<div id="sidebar">
				<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
		            <?php
		                if ( ! empty($left_data["view_name"]))
		                {
		                    for ($i=0; $i<count($left_data["view_name"]); $i++)
		                    {
		                        $this->load->view("left/".$left_data["view_name"][$i], $left_data["view_data"][$i]);
		                    }
		                }
		            ?>
				</div>
			</div> <!-- End #sidebar -->
		
			<div id="main-content"> <!-- Main Content Section with everything -->
			
				<noscript> <!-- Show a notification if the user has disabled javascript -->
					<div class="notification error png_bg">
						<div>Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.</div>
					</div>
				</noscript>
	            <?php
	                if ( ! empty($center_data["view_name"]))
	                {
	                    for ($i=0; $i<count($center_data["view_name"]); $i++)
	                    {
	                        $this->load->view("center/".$center_data["view_name"][$i], $center_data["view_data"][$i]);
	                    }
	                }
	            ?>
				<div id="footer">
					<small> <!-- Remove this notice or replace it with whatever you want -->
							&#169; Copyright 2012 Coding Hazard | <a href="#">Top</a>
					</small>
				</div><!-- End #footer -->
			</div> <!-- End #main-content -->
		</div>
	</body>
</html>