<div class="reports form">
<?php echo $this->Form->create('Report');?>
	<fieldset>
 		<legend><?php __('Admin Add Report'); ?></legend>
	<?php
		echo $this->Form->input('section');
		echo $this->Form->input('criteria');
		echo $this->Form->input('answer_id');
		echo $this->Form->input('status');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reports', true), array('action' => 'index'));?></li>
	</ul>
</div>