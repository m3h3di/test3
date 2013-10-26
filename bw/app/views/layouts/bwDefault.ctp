
<html>
<head>
	<title>BetterWork</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php 
		echo $this->Html->css('Site'); 
		echo $this->Html->css('telerik.common'); 
		echo $this->Html->css('telerik.office2010silver'); 
		echo $this->Html->css('Kendo.override'); 
		
		echo $javascript->link('jquery.min.js');
		/*
		echo $javascript->link('modernizr.2.6.2.min.js'); 
		echo $javascript->link('m3h3di.common.js'); 
		
		echo $javascript->link('kendo.all.min.js'); 
		echo $javascript->link('kendo.aspnetmvc.min.js'); 
		*/
	?>
</head>
<body>
	<div id="logo"></div>
	
	<div class="page" style="margin-left:0px">
		<div style="display: block;">
                <div class="k-widget k-tabstrip k-header" id="TabStrip" data-role="tabstrip" tabindex="0" role="tablist">
				</div>
        </div>
		<div id="main">
			<?php echo $content_for_layout; ?>
			<div style="clear:both"></div>
		</div>
	</div>
	<div style="clear:both"></div>	
	
	
	
	
	<div class="bot-wrapper">
    </div>
	<!-- start Footer -->
	<footer>
    <div class="footer-wrapper">
    <div class="inner">
    <div class="footer-content">
        <div class="copyright">
			<ul id="menu-footer-menus" class="menu"><li id="menu-item-483" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-483"><a target="_blank" href="http://betterwork.org/global/?page_id=441" >Disclaimer</a> - </li>
			<li id="menu-item-485" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-485"><a target="_blank" href="http://betterwork.org/global/?page_id=440" >Privacy Notice</a> - </li>
			<li id="menu-item-486" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-486"><a target="_blank" href="http://betterwork.org/global/?page_id=438" >Terms and Conditions</a> - </li>
			<li id="menu-item-487" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-487"><a target="_blank" href="http://betterwork.org/global/?page_id=437" >Sitemap</a> - </li>
			<li id="menu-item-488" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-488"><a target="_blank" href="http://betterwork.org/global/?page_id=112" >Contact us</a> - </li>
			</ul>
			<div>© 2012 Betterwork. All rights reserved.	</div>
		</div>
        <!--End Footer Menu and Copyright-->
		
		<div class="social-network">
			<span>Join us on: </span>
						<a  href="https://www.facebook.com/betterworkprogramme" target="_blank" title="Facebook"><img src="http://betterwork.org/global/wp-content/themes/betterwork/images/common-images/facebook-icon.png" width="32" height="32" /></a>
						<a href="http://www.youtube.com/betterworkprogramme" target="_blank" title="Youtube"><img src="http://betterwork.org/global/wp-content/themes/betterwork/images/common-images/you-tube-icon.png" width="32" height="32" /></a>
						<a href="http://twitter.com/better_work" target="_blank" title="Twitter"><img src="http://betterwork.org/global/wp-content/themes/betterwork/images/common-images/twitter-icon.png" width="32" height="32" /></a>
						<a href="http://www.linkedin.com/company/better-work" target="_blank" title="Linkedin"><img src="http://betterwork.org/global/wp-content/themes/betterwork/images/common-images/linkedin-icon.png" width="32" height="32" /></a>
						<a href="http://betterwork.org/global/?feed=rss2" target="_blank" title="RSS Feed"><img src="http://betterwork.org/global/wp-content/themes/betterwork/images/common-images/rss-icon.png" width="32" height="32" /></a>
		</div>
		<!--End Social network-->
    </div>
    <!--End sub footer-->
    
    <div class="poweredby">
    <a target="_blank"  href="http://www.ilo.org" target="_blank">
        	<img src="http://betterwork.org/global/wp-content/themes/betterwork/images/ilo-logo.png" />
      
    </a>
    <a target="_blank" href="http://www.ifc.org" target="_blank">
        	<img src="http://betterwork.org/global/wp-content/themes/betterwork/images/ifc-logo.png" />
      
    </a>  
    </div>
    <!--End Powered by-->
    
    </div>
    <!--End inner-->
    </div>
    <!--End wrapper footer-->
    </footer>
	
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
