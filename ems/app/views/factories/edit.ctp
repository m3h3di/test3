<div class="factories form">
<?php echo $this->Form->create('Factory');?>
	<fieldset>
 		<legend><?php __('Edit Facility'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('factory_name');
		echo $this->Form->input('address');
		echo $this->Form->input('contact_person');
		echo $this->Form->input('Zone');
		echo $this->Form->input('area');
		echo $this->Form->input('city');
		echo $this->Form->input('telephone');
		echo $this->Form->input('fax');
		echo $this->Form->input('email');
		//echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Factory.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Factory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Facilities', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Surveyors', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Surveyor', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		
	</ul>
</div>