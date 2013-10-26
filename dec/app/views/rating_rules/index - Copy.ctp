<div class="ratingRules index">
	<h2><?php __('Rating Rules');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('rule');?></th>
			<th><?php echo $this->Paginator->sort('section');?></th>
			<th><?php echo $this->Paginator->sort('point');?></th>
			<th><?php echo $this->Paginator->sort('point_hnm');?></th>
			<th><?php echo $this->Paginator->sort('point_wrap');?></th>
			<th><?php echo $this->Paginator->sort('Weight_factor');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ratingRules as $ratingRule):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $ratingRule['RatingRule']['id']; ?>&nbsp;</td>
		<td><?php echo $ratingRule['RatingRule']['rule']; ?>&nbsp;</td>
		<td><?php echo $ratingRule['RatingRule']['section']; ?>&nbsp;</td>
		<td><?php echo $ratingRule['RatingRule']['point']; ?>&nbsp;</td>
		<td><?php echo $ratingRule['RatingRule']['point_hnm']; ?>&nbsp;</td>
		<td><?php echo $ratingRule['RatingRule']['point_wrap']; ?>&nbsp;</td>
		<td><?php echo $ratingRule['RatingRule']['Weight_factor']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $ratingRule['RatingRule']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $ratingRule['RatingRule']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ratingRule['RatingRule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ratingRule['RatingRule']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Rating Rule', true), array('action' => 'add')); ?></li>
	</ul>
</div>