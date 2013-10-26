<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management -
            
            <?php echo $this->Html->link('Enterprise Information', array('controller'=>'companies','action'=>'index')); ?> >>
            Add Enterprise
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<div class="companies form">
<?php echo $this->Form->create('Company');?>
	<fieldset>
 		<legend><?php __('Admin Add Enterprise'); ?></legend>
	<?php
		echo $this->Form->input('group_id');
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('contact_persons');
		echo $this->Form->input('email_list');
		echo $this->Form->input('phone_fax');
		echo $this->Form->input('product_category');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Enterprises', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>


</div><!--company end-->
