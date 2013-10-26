<div class="questions form">
<?php echo $this->Form->create('Question');?>
	<fieldset>
 		<legend><?php __('Add Question'); ?></legend>
	<?php
		echo $this->Form->input('section_id');
		echo $this->Form->input('question');
		echo $this->Form->input('order');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Questions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sections', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>