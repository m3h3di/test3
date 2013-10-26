
<html>
<head>
	<title>BetterWork</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<?php 
		echo $this->Html->css('Site'); 
		echo $this->Html->css('telerik.common'); 
		echo $this->Html->css('telerik.office2010silver'); 
		echo $this->Html->css('Kendo.override');
		//echo $this->Html->css('menu');  
		
		//echo $javascript->link('jquery.min.js');

		//echo $javascript->link('modernizr.2.6.2.min.js'); 
		//echo $javascript->link('m3h3di.common.js'); 
		
		//echo $javascript->link('kendo.all.min.js'); 
		//echo $javascript->link('kendo.aspnetmvc.min.js'); 

	?>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>
<body>
	<div id="logindisplay" class="k-header">
		&nbsp;&lt;&lt; <a href="<?= $html->url('/') ?>">home</a>
		<div style="float: right">
			Welcome
			<a href="#"></a>!&nbsp;
		</div>
	</div>
	<div id="logo"></div>
	<div class="navigator">
		<?php echo $this->element("leftMenu"); ?>		
	</div>
	<div class="page">
		<div style="display: block;">
                <div class="k-widget k-tabstrip k-header" id="TabStrip" data-role="tabstrip" tabindex="0" role="tablist">
		<ul class="k-reset k-tabstrip-items">
			<li class="k-item k-state-default k-state-active k-tab-on-top k-first" role="tab" aria-selected="true" aria-controls="TabStrip-1"><a class="k-link" href="http://star3-test.betterwork.org/Home/Administrator">Administrator</a></li>
			
		</ul>
		</div>

        </div>
		<div id="main">
			<?php echo $content_for_layout; ?>
			<div style="clear:both"></div>
		</div>
	</div>
	<div style="clear:both"></div>	

<?php echo $this->element('sql_dump'); ?>
</body>
</html>
