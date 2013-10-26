<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management -
            
            <?php echo $this->Html->link('Enterprise Information', array('controller'=>'companies','action'=>'index')); ?> >>
            View Enterprise
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->
<div class="companies view">
<h3><?php  __('Company');?></h3>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($company['Group']['name'], array('controller' => 'groups', 'action' => 'view', $company['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $company['Company']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $company['Company']['address']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact Persons'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $company['Company']['contact_persons']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email List'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $company['Company']['email_list']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone Fax'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $company['Company']['phone_fax']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $company['Company']['product_category']; ?>
			
			<?php echo $this->Html->link($company['ProductCategory']['name'], array('controller' => 'product_categories', 
			'action' => 'view',$company['ProductCategory']['id'])); ?>
			
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Update'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $company['Company']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Enterprise', true), array('action' => 'edit', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Enterprise', true), array('action' => 'delete', $company['Company']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Enterprises', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enterprise', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>

</div><!--company end-->