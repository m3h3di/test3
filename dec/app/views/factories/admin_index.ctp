<div class="factories index">
	<h2><?php __('Factories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('factory_name');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('contact_person');?></th>
			<th><?php echo $this->Paginator->sort('area');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('telephone');?></th>
			<th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($factories as $factory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $factory['Factory']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($factory['User']['name'], array('controller' => 'users', 'action' => 'view', $factory['User']['id'])); ?>
		</td>
		<td><?php echo $factory['Factory']['factory_name']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['address']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['contact_person']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['area']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['city']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['telephone']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['fax']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['email']; ?>&nbsp;</td>
		<td><?php echo $factory['Factory']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $factory['Factory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $factory['Factory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $factory['Factory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $factory['Factory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Factory', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ratings', true), array('controller' => 'ratings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rating', true), array('controller' => 'ratings', 'action' => 'add')); ?> </li>
	</ul>
</div>