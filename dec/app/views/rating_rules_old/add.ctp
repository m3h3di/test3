<div class="ratingRules form">
<?php echo $this->Form->create('RatingRule');?>
	<fieldset>
 		<legend><?php __('Add Rating Rule'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Rating Rules', true), array('action' => 'index'));?></li>
	</ul>
</div>