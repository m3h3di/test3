<div class="surveyors index">
	<h2><?php __('Surveyors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('full_name');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('password');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($surveyors as $surveyor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $surveyor['Surveyor']['id']; ?>&nbsp;</td>
		<td><?php echo $surveyor['Surveyor']['full_name']; ?>&nbsp;</td>
		<td><?php echo $surveyor['Surveyor']['username']; ?>&nbsp;</td>
		<td><?php echo $surveyor['Surveyor']['password']; ?>&nbsp;</td>
		<td><?php echo $surveyor['Surveyor']['address']; ?>&nbsp;</td>
		<td><?php echo $surveyor['Surveyor']['status']; ?>&nbsp;</td>
		<td><?php echo $surveyor['Surveyor']['created']; ?>&nbsp;</td>
		<td><?php echo $surveyor['Surveyor']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $surveyor['Surveyor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $surveyor['Surveyor']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $surveyor['Surveyor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $surveyor['Surveyor']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Surveyor', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Facilities', true), array('controller' => 'facilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facility', true), array('controller' => 'facilities', 'action' => 'add')); ?> </li>
	</ul>
</div>