
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
	<div id="logindisplay" class="k-header">
		&nbsp;&lt;&lt; <a href="<?= $html->url('/') ?>">home</a>
		<div style="float: right">
			Welcome
			<a href="http://star3-test.betterwork.org/User/Settings"></a>!&nbsp;
		</div>
	</div>
	<div id="logo"></div>
	
	<div class="page" style="margin-left:0px">
		<div style="display: block;">
                <div class="k-widget k-tabstrip k-header" id="TabStrip" data-role="tabstrip" tabindex="0" role="tablist">
		<ul class="k-reset k-tabstrip-items">
			<li class="k-item k-state-default k-state-active k-tab-on-top k-first" >
				<a class="k-link" href="#">BetterWork</a>
			</li>
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
