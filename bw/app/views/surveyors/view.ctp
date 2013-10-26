<div class="surveyors view">
<h2><?php  __('Surveyor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Full Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['full_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyor['Surveyor']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Surveyor', true), array('action' => 'edit', $surveyor['Surveyor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Surveyor', true), array('action' => 'delete', $surveyor['Surveyor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $surveyor['Surveyor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveyors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Surveyor', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Facilities', true), array('controller' => 'facilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facility', true), array('controller' => 'facilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Facilities');?></h3>
	<?php if (!empty($surveyor['Facility'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Surveyor Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($surveyor['Facility'] as $facility):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $facility['id'];?></td>
			<td><?php echo $facility['surveyor_id'];?></td>
			<td><?php echo $facility['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'facilities', 'action' => 'view', $facility['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'facilities', 'action' => 'edit', $facility['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'facilities', 'action' => 'delete', $facility['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $facility['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Facility', true), array('controller' => 'facilities', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
