<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Bepza</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php echo $this->Html->css('style'); ?>
<?php  echo $this->Html->css('jquery.jqplot'); ?>

</head>
<body>
<center>
<div class="main"><!--main start-->
	<div class="header"><!--header start-->
		<div class="logo"><!--logo start-->
			<a href="<?= $html->url('/') ?>"><?php echo $html->image('logo.png', array('alt' => 'bottom','border'=>'0') );?></a>
		</div><!--logo end-->
		
        <br />
		
        
   <div class="clear"></div>
	</div><!--header end-->
             

<div class="main_blue"><!--main_blue start-->   <br />               
			 
    	<div class="content">
        	<?php echo $content_for_layout; ?>
        </div>

<br />
</div><!--main_blue end-->            


            
	<br /><br /><br /><br />


	
</div><!--main end-->


<div class="footer_top"></div>

<div class="footer"><!--footer start-->
 <div class="footer_text"><!--footer_text start-->
 	<font >Privacy Policy : Terms &amp; Conditions | </font>
    <font >copyright © BEPZA </font>
 </div><!--footer_text end-->
</div><!--footer end-->

<?php //echo $this->element('sql_dump'); ?>
</center>
</body>
</html>
