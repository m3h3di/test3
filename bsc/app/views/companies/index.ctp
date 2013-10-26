<div class="companies index">
	<h2><?php __('Companies');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('group_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('plot_no');?></th>
			<th><?php echo $this->Paginator->sort('zone');?></th>
			<th><?php echo $this->Paginator->sort('contact_persons');?></th>
			<th><?php echo $this->Paginator->sort('email_list');?></th>
			<th><?php echo $this->Paginator->sort('phone_fax');?></th>
			<th><?php echo $this->Paginator->sort('country');?></th>
			<th><?php echo $this->Paginator->sort('product');?></th>
			<th><?php echo $this->Paginator->sort('group_no');?></th>
			<th><?php echo $this->Paginator->sort('type_of_investment');?></th>
			<th><?php echo $this->Paginator->sort('actual_investment');?></th>
			<th><?php echo $this->Paginator->sort('proposed_investment');?></th>
			<th><?php echo $this->Paginator->sort('actual_employee');?></th>
			<th><?php echo $this->Paginator->sort('proposed_employee');?></th>
			<th><?php echo $this->Paginator->sort('male');?></th>
			<th><?php echo $this->Paginator->sort('female');?></th>
			<th><?php echo $this->Paginator->sort('actual_expatriate');?></th>
			<th><?php echo $this->Paginator->sort('proposed_expatriate');?></th>
			<th><?php echo $this->Paginator->sort('commercial_operation');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($companies as $company):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $company['Company']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($company['Group']['name'], array('controller' => 'groups', 'action' => 'view', $company['Group']['id'])); ?>
		</td>
		<td><?php echo $company['Company']['name']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['plot_no']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['zone']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['contact_persons']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['email_list']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['phone_fax']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['country']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['product']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['group_no']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['type_of_investment']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['actual_investment']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['proposed_investment']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['actual_employee']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['proposed_employee']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['male']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['female']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['actual_expatriate']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['proposed_expatriate']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['commercial_operation']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['status']; ?>&nbsp;</td>
		<td><?php echo $company['Company']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $company['Company']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $company['Company']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $company['Company']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $company['Company']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Company', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>