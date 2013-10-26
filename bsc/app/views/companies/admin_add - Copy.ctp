<div class="companies form">
<?php echo $this->Form->create('Company');?>
	<fieldset>
 		<legend><?php __('Admin Add Company'); ?></legend>
	<?php
		echo $this->Form->input('group_id');
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('contact_persons');
		echo $this->Form->input('email_list');
		echo $this->Form->input('phone_fax');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Companies', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>