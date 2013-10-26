<?php
    $status = $session->read('Auth.User.status');
    if( $status == 1 ){?>
		<ul class="k-widget k-panelbar k-reset k-header" id="nav" style="width: 200px;">
			<li class="k-item k-state-active" >
				<span class="k-link k-header">Surveyor<span class="k-icon k-i-arrow-n k-panelbar-collapse"></span></span>
				<ul class="k-group k-panel" role="group">
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/users/index') ?>">Add/Edit/Revise</a>						
					</li>					
				</ul>
			</li>
			<li class="k-item k-state-active" >
				<span class="k-link k-header">Factory<span class="k-icon k-i-arrow-n k-panelbar-collapse"></span></span>
				<ul class="k-group k-panel" role="group">
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/factories/index') ?>">Add/Edit/Revise</a>						
					</li>					
				</ul>
			</li>
			<li class="k-item k-state-active" >
				<span class="k-link k-header">Question<span class="k-icon k-i-arrow-n k-panelbar-collapse"></span></span>
				<ul class="k-group k-panel" role="group">
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/questions/index') ?>">Add/Edit/Revise</a>						
					</li>					
				</ul>
			</li>
			<li class="k-item k-state-active" >
				<span class="k-link k-header">Country<span class="k-icon k-i-arrow-n k-panelbar-collapse"></span></span>
				<ul class="k-group k-panel" role="group">
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/') ?>">Add/Edit/Revise</a>						
					</li>					
				</ul>
			</li>
			<li class="k-item k-state-active k-first" >
				<span class="k-link k-header">Assessments<span class="k-icon k-i-arrow-n k-panelbar-collapse"></span></span>
				<ul class="k-group k-panel" role="group">
					<!--
					<li class="k-item k-state-default k-first">
						<a class="k-link k-state-selected"	href="#">Download Questionnaire</a>
					</li>
					-->
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/users/download') ?>">Download Questionnaire</a>
					</li>
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/users/upload') ?>">Upload Questionnaire</a>
					</li>
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/users/logout') ?>">Logout</a>
					</li>
				</ul>
			</li>
			
			
		</ul>
<? }
	else{
	?>
		<ul class="k-widget k-panelbar k-reset k-header" id="nav" style="width: 200px;">
			<li class="k-item k-state-active" >
				<span class="k-link k-header">Questions<span class="k-icon k-i-arrow-n k-panelbar-collapse"></span></span>
				<ul class="k-group k-panel" role="group">
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/admins/cluster') ?>">Add/Edit/Revise</a>
					</li>					
				</ul>
			</li>
			<li class="k-item k-state-active k-first" >
				<span class="k-link k-header">Assessments<span class="k-icon k-i-arrow-n k-panelbar-collapse"></span></span>
				<ul class="k-group k-panel" role="group">
					<!--
					<li class="k-item k-state-default k-first">
						<a class="k-link k-state-selected"	href="#">Download Questionnaire</a>
					</li>
					-->
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/users/download') ?>">Download Questionnaire</a>
					</li>
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/users/upload') ?>">Upload Questionnaire</a>
					</li>
					<li class="k-item k-state-default k-first">
						<a class="k-link"	href="<?= $html->url('/users/logout') ?>">Logout</a>
					</li>
				</ul>
			</li>
			
		</ul>
<?php
	}
?>