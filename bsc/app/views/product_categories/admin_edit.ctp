<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management -
            
            <?php echo $this->Html->link('Enterprise Information', array('controller'=>'companies','action'=>'index')); ?> >><br />
            Edit Product category
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<div class="product_category form">
<?php echo $this->Form->create('ProductCategory');?>
	<fieldset>
 		<legend><?php __('Admin Edit Product category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Group.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Product categories', true), array('action' => 'index'));?></li>
		
		
		
		<li><?php echo $this->Html->link(__('New Product category', true), array('controller' => 'product_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>

</div><!--company end-->
