<?php
/*
echo '<pre style="text-align:left">';
print_r($factories);
echo "</pre>";
*/
?>

<div class="factories index">
	<h2>Assignment</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo "Assigned Person";?></th>
			<th><?php echo $this->Paginator->sort('factory_name');?></th>
			
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
				<?php echo $this->Html->link($factory['User']['full_name'], array('controller' => 'users', 'action' => 'view', $factory['User']['id'])); ?>
		</td>
		<td><?php echo $factory['Factory']['factory_name']; ?>&nbsp;</td>
		
		<!--<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $factory['Factory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $factory['Factory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $factory['Factory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $factory['Factory']['id'])); ?>
		</td>-->
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