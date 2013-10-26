<div class="weightFactors form">
<?php echo $this->Form->create('WeightFactor');?>
	<fieldset>
 		<legend><?php __('Edit Weight Factor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('section_no');
		echo $this->Form->input('section_name');
		echo $this->Form->input('weight_factor');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('WeightFactor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('WeightFactor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Weight Factors', true), array('action' => 'index'));?></li>
	</ul>
</div>