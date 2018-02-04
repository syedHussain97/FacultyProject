<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <script src="<?=base_url().JS_FOLDER?>jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="<?=base_url().JS_FOLDER?>jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>

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
<body bgcolor="#EDF0E6">
	<center>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
	    <td height="100" align="center" valign="top" bgcolor="#F28700"><table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
	      <tr>
	        <td width="25" height="100">&nbsp;</td>
	        <td width="150" align="left" valign="top"><img src="<?=base_url()?>images/logoTop.png" width="150" height="100" /></td>
	        <td align="left" valign="top"><table width="849" border="0" cellspacing="0" cellpadding="0">
	          <tr>
	            <td height="15"></td>
	          </tr>
	          <tr>
	            <td height="25"><table width="849" border="0" cellspacing="0" cellpadding="0">
	              <tr>
	                <td width="20">&nbsp;</td>
	                <td width="749" class="cen16bold">Welcome, Administrator!</td>
	                <td width="80" class="cen16bold"><a href="<?=base_url()?>index.php/admin/logout">Logout</a></td>
	              </tr>
	            </table></td>
	          </tr>
	          <tr>
	            <td height="25"></td>
	          </tr>
	          <tr>
	            <td height="25"><table width="849" border="0" align="left" cellpadding="0" cellspacing="0">
	              <tr>
	                <td width="20">&nbsp;</td>
	                <td width="748" class="cen16bold"><a href="<?=base_url()?>index.php/admin/language_identifiers">Language Identifiers</a> | <a href="<?=base_url()?>index.php/admin/product_type_add">Product Types </a>| <a href="<?=base_url()?>index.php/admin/product_series_add">Product Series</a> | <a href="<?=base_url()?>index.php/admin/add_features">Features</a> | <a href="<?=base_url()?>index.php/admin/all_product">Products</a></td>
	                <td width="81">&nbsp;</td>
	              </tr>
	            </table></td>
	          </tr>
	          <tr>
	            <td height="10"></td>
	          </tr>
	        </table></td>
	      </tr>
	    </table></td>
	  </tr>
	  <tr>
	    <td height="20" align="center" valign="top"><table width="1024" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td width="25" height="20">&nbsp;</td>
	        <td width="150" align="left" valign="top"><img src="<?=base_url()?>images/logoBot.png" width="150" height="20" /></td>
	        <td>&nbsp;</td>
	      </tr>
	    </table></td>
	  </tr>
	  <tr>
	    <td align="center" valign="middle">&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="center" valign="top">
            <?php
                if ( ! empty($center_data["view_name"]))
                {
                    for ($i=0; $i<count($center_data["view_name"]); $i++)
                    {
                        $this->load->view("center/".$center_data["view_name"][$i], $center_data["view_data"][$i]);
                    }
                }
            ?>
		</td>
		  </tr>
		  <tr>
		    <td align="center" valign="middle">&nbsp;</td>
		  </tr>
		  <tr>
		    <td height="40" align="center" valign="middle" bgcolor="#69666D"><table width="984" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td align="left" valign="middle" class="cen12">Al Hafidh @ 2012. All Rights Reserved</td>
		        <td align="right" valign="middle" class="cen12">Powered by <a href="http://destinationw3.com">DestinationW3</a></td>
		      </tr>
		    </table></td>
		  </tr>
		</table>
		</body>
		</html>