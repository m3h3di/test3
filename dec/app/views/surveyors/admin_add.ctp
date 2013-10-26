<div class="surveyors form">
<?php echo $this->Form->create('Surveyor');?>
	<fieldset>
 		<legend><?php __('Admin Add Surveyor'); ?></legend>
	<?php
		echo $this->Form->input('full_name');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('address');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Surveyors', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Facilities', true), array('controller' => 'facilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facility', true), array('controller' => 'facilities', 'action' => 'add')); ?> </li>
	</ul>
</div>