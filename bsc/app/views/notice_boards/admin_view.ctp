<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            
            <?php echo $this->Html->link('Notice Board', array('controller'=>'notice_boards','action'=>'index')); ?> >>
            View Notice
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />



<div class="company" style="text-align:left" ><!--company start-->

<div class="noticeBoards view">
<h2><?php  __('Notice Board');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notice Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['notice_title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notice'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['notice']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Published Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $noticeBoard['NoticeBoard']['published_date']; 
				echo strftime("%d %B,%Y", strtotime($noticeBoard['NoticeBoard']['published_date']));
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valid Until'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $noticeBoard['NoticeBoard']['valid_until']; 
				echo strftime("%d %B,%Y", strtotime($noticeBoard['NoticeBoard']['valid_until']));
			?>
			&nbsp;
		</dd>
        
        <!--edited by nandinee start-->
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['zone']; ?>
			&nbsp;
		</dd>
        
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['product_category']; ?>
			&nbsp;
		</dd>
        <!--edited by nandinee end-->
        
        
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Notice Board', true), array('action' => 'edit', $noticeBoard['NoticeBoard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Notice Board', true), array('action' => 'delete', $noticeBoard['NoticeBoard']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $noticeBoard['NoticeBoard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notice Boards', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notice Board', true), array('action' => 'add')); ?> </li>
	</ul>
</div>




</div><!--company end--><br /><br /><br /><br />

