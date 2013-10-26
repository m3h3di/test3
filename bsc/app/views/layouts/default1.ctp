<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MNHs Office management </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php echo $this->Html->css('style'); ?>

</style>
</head>
<body>
<center>
<div class="main"><!--main start-->
	<div class="header"><!--header start-->
	<div class="logo"><!--logo start-->
		
    </div><!--logo end-->
   
    <div class="menu"><!--menu start-->
    	
        		<ul>
					<?php echo $this->element("menu"); ?>
		        </ul>
	        
    </div><!--menu end-->
</div><!--header end-->
             
    	<div class="content">
			<?php echo $content_for_layout; ?>
        </div>
            
            
	<br /><br /><br /><br /><br /><br /><br /><br />


<div class="footer"><!--footer start-->
<br /><br /><br /><br /><br /><br />
 <div class="footer_text"><!--footer_text start-->
 	Privacy Policy : Terms &amp; Conditions  <br />
    © <font color="#607C18">MNHs</font>. All rights reserved.
 </div><!--footer_text end-->
</div><!--footer end-->

	
</div><!--main end-->
</center>
</body>
</html>
