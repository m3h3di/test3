<div class="companies form">
<?php echo $this->Form->create('Company');?>
	<fieldset>
 		<legend><?php __('Add Company'); ?></legend>
	<?php
		echo $this->Form->input('group_id');
		echo $this->Form->input('name');
		echo $this->Form->input('plot_no');
		echo $this->Form->input('zone');
		echo $this->Form->input('contact_persons');
		echo $this->Form->input('email_list');
		echo $this->Form->input('phone_fax');
		echo $this->Form->input('country');
		echo $this->Form->input('product');
		echo $this->Form->input('group_no');
		echo $this->Form->input('type_of_investment');
		echo $this->Form->input('actual_investment');
		echo $this->Form->input('proposed_investment');
		echo $this->Form->input('actual_employee');
		echo $this->Form->input('proposed_employee');
		echo $this->Form->input('male');
		echo $this->Form->input('female');
		echo $this->Form->input('actual_expatriate');
		echo $this->Form->input('proposed_expatriate');
		echo $this->Form->input('commercial_operation');
		echo $this->Form->input('status');
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