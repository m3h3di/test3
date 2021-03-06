<div class="reports index">
	<h2><?php __('Reports');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('section');?></th>
			<th><?php echo $this->Paginator->sort('criteria');?></th>
			<th><?php echo $this->Paginator->sort('answer_id');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('order');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($reports as $report):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $report['Report']['id']; ?>&nbsp;</td>
		<td><?php echo $report['Report']['section']; ?>&nbsp;</td>
		<td><?php echo $report['Report']['criteria']; ?>&nbsp;</td>
		<td><?php echo $report['Report']['answer_id']; ?>&nbsp;</td>
		<td><?php echo $report['Report']['status']; ?>&nbsp;</td>
		<td><?php echo $report['Report']['order']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $report['Report']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $report['Report']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $report['Report']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $report['Report']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Report', true), array('action' => 'add')); ?></li>
	</ul>
</div>