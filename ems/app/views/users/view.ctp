<div class="reports">

<div class="users view">
<h2><?php  __('Surveyor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
        
		<!--<dt<?php /*if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password'];*/ ?>
			&nbsp;
		</dd>-->
        
        
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Surveyor', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Surveyor', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveyors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Surveyor', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Facilities', true), array('controller' => 'factories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facility', true), array('controller' => 'factories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<br/><br/><br/><br/>
<div class="related">
	<h3><?php __('Related Factories');?></h3>
	<?php if (!empty($user['Factory'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		
		
		<th><?php __('Facility Name'); ?></th>
		<th><?php __('Address'); ?></th>
		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Factory'] as $factory):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			
			<td><?php echo $factory['factory_name'];?></td>
			<td><?php echo $factory['address'];?></td>
			
			
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'factories', 'action' => 'view', $factory['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'factories', 'action' => 'edit', $factory['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'factories', 'action' => 'delete', $factory['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $factory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Facility', true), array('controller' => 'factories', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>


</div>