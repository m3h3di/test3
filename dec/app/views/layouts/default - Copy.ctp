<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SEDF</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php echo $this->Html->css('style'); ?>
<style type="text/css">
#slider { margin:0 auto; list-style:none; padding:1px; border:1px solid #dad5c9; width:896px; height:235px; }
#slider ul,
#slider li { padding:0; margin:0; list-style:none; }
/* 
    define width and height of list item (slide)
    entire slider area will adjust according to the parameters provided here
*/
#slider li { width:896px; height:235px; overflow:hidden; }
p#controls { margin:0; padding:0; position:relative; }
#prevBtn,
#nextBtn { display:block; margin:0; overflow:hidden; width:40px; height:40px; position:absolute; left:0px; top:-140px; }
#nextBtn { left:940px; }
#prevBtn a { display:block; width:40px; height:40px; background:url(../img/arrow_l.gif) no-repeat 0 0; }
#nextBtn a { display:block; width:40px; height:40px; background:url(../img/arrow_r.gif) no-repeat 0 0; }
</style>
</head>
<body>
<div class="main">
	<div class="header_full">
    	<div class="header">
      		<div class="twitter">
			<!-- <a href="#"><?php echo $html->image('twitter.gif', array('alt' => 'logo', 'width'=>'38','height'=>'35','border'=>'0') )?> </a>-->
			<span></span></div>
      		
      		<div class="clr"></div>
      		<div class="logo"><a href="/sedf-ecp"><?php echo $html->image('logo.png', array('alt' => 'logo', 'width'=>'739','height'=>'72','border'=>'0') )?></a></div>
  		    <div class="menu">
        		<ul>
					<?php echo $this->element("menu"); ?>
		        </ul>
	        </div>
			<div class="clr"></div>
			<!--<div class="simply_text">
		        <h2>welcome to my web portfolio!</h2>
        		<p>Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. <br />
		         Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Where does it come from?
				 </p>
			</div>-->
		</div>
	</div>
	<!--<div class="header_title">
	</div>-->
	<div class="body">
		<div class="block_box">
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<div class="footer">
    	<div class="footer_resize">
      		<!--<p class="leftt"><a href="index.html"><img src="/sedf-ecp/img/logo.png" alt="picture" width="739" height="71" border="0" /></a></p>
			<p class="rightt">� Copyright MNHsTech.com. <a href="http://mnhstech.com/" class="no_border">MNHstech.com</a>. All Rights Reserved</p>-->
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>
</div>
</body>
</html>
