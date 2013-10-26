
<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management - Counselor Information
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<?php echo $this->Session->flash(); ?>

<div class="users index">
<?php  echo $javascript->link('jquery.min.js'); 
	//echo "<pre>";
	//print_r($all_groups);
	//echo "</pre>";
?>
	
	
<script type="text/javascript">
		$(document).ready(function(){
			$("#q_1").slideToggle("slow");
			$("#q_2").slideToggle("slow");
		});
	
		function my_toggle(qq)
		{
			var r="#"+qq;
			$(r).slideToggle("fast");
		}
</script>



	<div>
	<table width="100%">
		<tr>
			<th width="60%" style="text-align:center">Groups And Users</th>
			<th width="" style="text-align:center">Action</th>
			
		</tr>
	</table>
	</div>
	
    <?php
	foreach($all_groups as $key=>$group){
		$op_name = "op_".$group['Group']['id'];
		$id_name = "q_".$group['Group']['id'];
		
		echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
		echo "&nbsp;<b>".$group['Group']['name'];
		echo "</b></span><br/><br/>";	
		
		
		if( !empty($group['User']) ){?>
			<div id="<?php echo $id_name; ?>" >
			<table width="100%">
				<?php
				foreach($group['User'] as $key1=>$user){
					if($user['status'] == 2) continue;
					?>
					
					<tr>
						
						<td width=60%><?php echo $user['name']; ?></td>
						<td class="action_buttons">
							<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['id'])); ?>
							<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['id'])); ?>
							<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['id']), 
							null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
                            
                            <!--<br /><br />-->
                            
                            <?php //echo $this->Html->link(__('Change Password', true), array('action' => 'change_password', $user['id'])); ?>
                            
						</td>
					</tr>
					
					
					<?php 
				}?>
			</table>
			</div>
			<?php	
		}
	}
	
	?>
    
    
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>


</div><!--company end-->

