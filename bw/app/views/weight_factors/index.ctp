<div class="weightFactors index">
	<h2><?php __('Weight Factors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo $this->Paginator->sort('section_no');?></th>
			<th><?php echo $this->Paginator->sort('section_name');?></th>
			<th><?php echo $this->Paginator->sort('weight_factor');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($weightFactors as $weightFactor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td><?php echo $weightFactor['WeightFactor']['section_no']; ?>&nbsp;</td>
		<td><?php echo $weightFactor['WeightFactor']['section_name']; ?>&nbsp;</td>
		<td><?php echo $weightFactor['WeightFactor']['weight_factor']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $weightFactor['WeightFactor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $weightFactor['WeightFactor']['id'])); ?>
			<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $weightFactor['WeightFactor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $weightFactor['WeightFactor']['id'])); ?>
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
