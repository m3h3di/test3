<div class="ratingRules form">
<?php echo $this->Form->create('RatingRule');?>
	<fieldset>
 		<legend><?php __('Edit Rating Rule'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('rule');
		echo $this->Form->input('section');
		echo $this->Form->input('point');
		echo $this->Form->input('Weight_factor');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('RatingRule.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('RatingRule.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rating Rules', true), array('action' => 'index'));?></li>
	</ul>
</div>