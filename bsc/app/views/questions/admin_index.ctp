<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management - Question Management
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<div class="questions index">
	<?php  echo $javascript->link('jquery.min.js'); 
	//echo "<pre>";
	//print_r($all_questions);
	//echo "</pre>";
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#q_4").slideToggle("slow");
			
			
		});
	
		function my_toggle(qq){
			var r="#"+qq;
			
				$(r).slideToggle("fast");
			
		}
	</script>
	<div>
	<table width="100%">
		<tr>
			<th width=3% >S/N</th>
			<th width=60% style="text-align:center">Compliance Issues</th>
			<th width="" style="text-align:center">Action</th>
			
		</tr>
	</table>
	</div>
	<?php
	foreach($questions as $key=>$section){
		$op_name = "op_".$section['Section']['id'];
		$id_name = "q_".$section['Section']['id'];
		if($section['Section']['type']  != 1){
			//echo "&nbsp; <b>".$section['Section']['type'].". &nbsp;".$section['Section']['name']."</b><br/><br/>";
			if($section['Section']['id'] == 3)
				echo '<span id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
			else
				echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
				
			echo "&nbsp; <b>".$section['Section']['type'].". &nbsp;&nbsp;".$section['Section']['name'];
			echo "</b></span><br/><br/>";	
		}
		else{
			echo '<span style="padding-left:40px;cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" ><b>';
			echo $section['Section']['name'];
			
			echo "</b></span>";
			
			echo '<span style="text-align:right; float:right">';
			echo $this->Html->link(__('View', true), array('controller'=>'sections','action' => 'view', $section['Section']['id']));
			echo " ";
			echo $this->Html->link(__('Edit', true), array('controller'=>'sections','action' => 'edit', $section['Section']['id']));
			echo "</span>";
			//echo $this->Html->link(__('Delete', true), array('action' => 'Delete', $section['Section']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $section['Section']['id']));
			
			echo"<br/><br/>";
		}
		
		if( !empty($section['Section']) ){?>
			<div id="<?php echo $id_name; ?>" style=" display:none;" >
			<table   width="100%">
				<?php
				foreach($section['Question'] as $key1=>$question){?>
					
					<tr>
						<td width="3%"><?php echo $question['id']; ?></td>
						<td width=60%><?php echo $question['question']; ?></td>
						<td class="action_buttons">
							<?php echo $this->Html->link(__('View', true), array('action' => 'view', $question['id'])); ?>
							<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $question['id'])); ?>
							<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $question['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $question['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Question', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sections', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>

</div><!--company end-->
