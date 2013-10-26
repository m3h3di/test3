<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Chemical and Hazardous</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php echo $this->Html->css('html_style'); ?>

</head>
<body>
<center>
<div class="main"><!--main start-->
	<div class="header"><!--header start-->
	<div class="logo"><!--logo start-->       
        <?php echo $this->Html->link($this->Html->image("logo.gif", array("alt" => "logo")),"#",array('escape' => false));?>
    </div><!--logo end-->
    
    <div class="menu"><!--menu start-->
    	<ul>
        	<?php echo $this->element("menu"); ?>
        </ul>
    </div><!--menu end-->
</div><!--header end-->

<div class="header_bottom"><?php echo $html->image('header_bottom.gif');?></div>
             
    	<div class="content">
        	
        
        
			<?php echo $content_for_layout; ?>
        </div>
            
	<br /><br /><br /><br />


<div class="footer"><!--footer start-->
 <div class="footer_text"><!--footer_text start-->
 	<font >Privacy Policy : Terms &amp; Conditions | </font>
    <font >copyright © BEPZA </font>
 </div><!--footer_text end-->
</div><!--footer end-->




</div><!--main end-->
</center>

<?php echo $this->element('sql_dump'); ?>	
</body>


</html>
