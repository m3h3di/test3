<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management -
            
            <?php echo $this->Html->link('Enterprise Information', array('controller'=>'companies','action'=>'index')); ?> >><br />
            View Product category
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<div class="product categories view">
<h2><?php  __('Product categories');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productCategory['ProductCategory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productCategory['ProductCategory']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productCategory['ProductCategory']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productCategory['ProductCategory']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product Category', true), 
		array('action' => 'edit', $productCategory['ProductCategory']['id'])); ?> </li>
		
		<li><?php echo $this->Html->link(__('Delete Product Category', true), 
		array('action' => 'delete', $productCategory['ProductCategory']['id']), null, 
		sprintf(__('Are you sure you want to delete # %s?', true), $productCategory['ProductCategory']['id'])); ?> </li>
		
		
		<li><?php echo $this->Html->link(__('List Product Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Category', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Enterprises');?></h3>
	<?php if (!empty($productCategory['Company'])):?>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Address'); ?></th>
		<th><?php __('Plot no'); ?></th>
		<th><?php __('Zone'); ?></th>
		<th><?php __('Contact person'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Phone fax'); ?></th>
		<th><?php __('Country'); ?></th>
		<th><?php __('Product'); ?></th>
		<th class="actions" align="center"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($productCategory['Company'] as $company):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $company['id'];?></td>
			<td><?php echo $company['group_id'];?></td>
			<td><?php echo $company['name'];?></td>
			<td><?php echo $company['address'];?></td>
			<td><?php echo $company['plot_no'];?></td>
			<td><?php echo $company['zone'];?></td>
			<td><?php echo $company['contact_persons'];?></td>
			<td><?php echo $company['email_list'];?></td>
			<td><?php echo $company['phone_fax'];?></td>
			<td><?php echo $company['country'];?></td>
			<td><?php echo $company['product'];?></td>
			
			
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), 
				array('controller' => 'companies', 'action' => 'view', $company['id'])); ?>
				
				<?php echo $this->Html->link(__('Edit', true), 
				array('controller' => 'companies', 'action' => 'edit', $company['id'])); ?>
				
				<?php echo $this->Html->link(__('Delete', true), 
				array('controller' => 'companies', 'action' => 'delete', $company['id']), null, 
				sprintf(__('Are you sure you want to delete # %s?', true), $company['id'])); ?>
				
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


	<!--<div class="actions">
		<ul>
		<li><?php //echo $this->Html->link(__('New Enterprise', true), array('controller' => 'companies', 'action' => 'add'));?> </li>
		</ul>
	</div>-->
	
	
</div>


</div><!--company end-->
