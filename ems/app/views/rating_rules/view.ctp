<div class="ratingRules view">
<h2><?php  __('Rating Rule');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ratingRule['RatingRule']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rule'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ratingRule['RatingRule']['rule']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Section'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ratingRule['RatingRule']['section']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Point'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ratingRule['RatingRule']['point']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight Factor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ratingRule['RatingRule']['Weight_factor']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rating Rule', true), array('action' => 'edit', $ratingRule['RatingRule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Rating Rule', true), array('action' => 'delete', $ratingRule['RatingRule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ratingRule['RatingRule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rating Rules', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rating Rule', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
