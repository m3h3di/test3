<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management -
            
            <?php echo $this->Html->link('Counselor Information', array('controller'=>'users','action'=>'index')); ?> >>
            Edit User
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<div class="users form">



<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Admin Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('name');
		echo $this->Form->input('username');
		
		echo $this->Form->input('password'); ?>
		
        
        <!--Old Password<br />
        <input type="password" name="data[User][old_password]" value=""/><br /><br />
        New Password<br />
        <input type="password" name="data[User][new_password]" value=""/>-->
        
        
	
    <?php	
		echo $this->Form->input('contact_number');
		echo $this->Form->input('email');
		echo $this->Form->input('joining_date');
		echo $this->Form->input('address');
		
		//echo $this->Form->input('status'); echo "1 for admin and 0 for counselor";
	?>
    
    	
    
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>

</div>



<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>




<div class="actions">
	<h4><?php __('Change Password'); ?></h4>
    <ul>
        <li>
            <?php echo $this->Html->link(__('Change Password', true), array('action' => 'change_password',$this->Form->value('User.id') )); ?>
        </li>
    </ul>
</div>







</div><!--company end-->
