
<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
             Notice Board
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />



<div class="company" style="text-align:left" ><!--company start-->


<!--<div class="noticeBoards index">-->
	<h2><?php __('Notice Board');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('notice_title');?></th>
			<th><?php echo $this->Paginator->sort('notice');?></th>
			<th><?php echo $this->Paginator->sort('published_date');?></th>
			<th><?php echo $this->Paginator->sort('valid_until');?></th>
            
            <!--edited by nandinee start-->
            <th><?php echo $this->Paginator->sort('zone');?></th>
            <th><?php echo $this->Paginator->sort('product_category');?></th>
            <!--edited by nandinee end-->
            
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($noticeBoards as $noticeBoard):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $noticeBoard['NoticeBoard']['id']; ?>&nbsp;</td>
		<td><?php echo $noticeBoard['NoticeBoard']['notice_title']; ?>&nbsp;</td>
		<td><?php echo $noticeBoard['NoticeBoard']['notice']; ?>&nbsp;</td>
        
        
		<td>
			<?php //echo $noticeBoard['NoticeBoard']['published_date']; 
				echo strftime("%d %B,%Y", strtotime($noticeBoard['NoticeBoard']['published_date']));
			?>&nbsp;
        </td>
		<td>
		<?php //echo $noticeBoard['NoticeBoard']['valid_until']; 
				echo strftime("%d %B,%Y", strtotime($noticeBoard['NoticeBoard']['valid_until']));
		?>&nbsp;
        </td>
        
        
        <!--edited by nandinee start-->
        <td><?php echo $noticeBoard['NoticeBoard']['zone']; ?>&nbsp;</td>
        <td><?php echo $noticeBoard['NoticeBoard']['product_category']; ?>&nbsp;</td>
        <!--edited by nandinee end-->
        
        
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $noticeBoard['NoticeBoard']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $noticeBoard['NoticeBoard']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $noticeBoard['NoticeBoard']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $noticeBoard['NoticeBoard']['id'])); ?>
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
<!--</div>-->


<!--<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Notice', true), array('action' => 'add')); ?></li>
	</ul>
</div>-->


</div><!--company end-->

