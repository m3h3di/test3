<div class="weightFactors form">
<?php echo $this->Form->create('WeightFactor');?>
	<fieldset>
 		<legend><?php __('Add Weight Factor'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Weight Factors', true), array('action' => 'index'));?></li>
	</ul>
</div>