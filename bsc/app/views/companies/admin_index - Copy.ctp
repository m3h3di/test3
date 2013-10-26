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
	
		function my_toggle(qq){
			var r="#"+qq;
			
				$(r).slideToggle("fast");
			
		}
	</script>


	<div style="padding-left:100px" >
	<table width="100%">
		<tr>
			
			<th width=60% style="text-align:center">Facility Name</th>
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
		
		
		if( !empty($group['Company']) ){?>
			<div id="<?php echo $id_name; ?>" style=" display:none; padding-left:100px" >
			<table   width="100%">
				<?php
				foreach($group['Company'] as $key1=>$user){?>
					
					<tr>
						
						<td width=60%><?php echo $user['name']; ?></td>
						<td class="actions">
                        	<?php echo $this->Html->link(__('details', true), array('controller'=>'cpanels','action' => 'facilitystatus', $user['id'])); ?>
							<?php echo $this->Html->link(__('Info', true), array('action' => 'view', $user['id'])); ?>
							<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['id'])); ?>
							<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Facility', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>