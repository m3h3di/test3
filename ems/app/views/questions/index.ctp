<div class="questions index">
	<h2><?php __('Questions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th style=" width:10%">Number</th>
			<th><?php echo $this->Paginator->sort('question');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($questions as $question):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
		<?php 
		    if($question['Question']['section']==1)
				echo $question['Question']['section'].".".$i; ///for now i guess 2011-07-14
			else
				echo $question['Question']['section'].".".$question['Question']['order']; 
			
		?>&nbsp;
        </td>
        
        
        
		<td style="text-align:left"><?php echo $question['Question']['question']; ?>&nbsp;</td>
		<td><?php echo $question['Question']['section']; ?>&nbsp;</td>
		
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $question['Question']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $question['Question']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $question['Question']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $question['Question']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Question', true), array('action' => 'add')); ?></li>
	</ul>
</div>