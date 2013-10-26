
<html >
<head>
	<title>SEDF</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php echo $this->Html->css('style'); ?>
	<?php echo $this->Html->css('cake.generic'); ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15070209-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div class="main-box">
    	<div class="main-box-bot">
            <div class="main-box-content">

                <div class="main index">
                    <div class="container_24">
                        <div class="grid_24">
                            <h1><a class="logo" href="#">connex</a></h1>
                            <nav>
                               <?php echo $this->element("menu"); ?>
                            </nav>
                            <div class="clear-wrap"></div>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="content" style="min-height:300px;">
                	
                    <?php //echo $html->image('slider-bg.jpg', array('alt' => '','border'=>'0') )?>
                    <?php echo $content_for_layout; ?>
                </div>

                

                
            </div>
        </div>
        <div style="text-align:center">
        	<span class="footer-text"><span>CopyRight &copy; IFC & BGMEA 2011 . All Rights Reserved </span> 
            <!--
            <a class="link" href="#">Privacy Policy</a> 
            -->
            </span>
        </div>
</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
    