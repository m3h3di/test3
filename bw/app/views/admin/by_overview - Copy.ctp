<div style="padding:20px">
<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Survey Management - Enterprise information
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />

<div>
<?php
if(!empty($result)){
	?>
	<table width="100%">
    <tr>
    	<td>Section</td>
        <td>Overview</td>
        <td title="Total number of facilities with Full Baseline survey">Number Of factories</td>
        <td title="Total number of facilities satisfy this criteria">Yes</td>
        <td title="">percentage(%)</td>
        
    </tr>
    
    </table>
	<?php
}
?>
</div>
<br /><br />

<span style="text-align:left; padding-left:20px"><h3>Select a Criteria</h3></span>
<br />
<div class="company" style="text-align:left;"><!--company start-->
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


	
	
    <?php
	foreach($all_rules as $key=>$group){
		$op_name = "op_".$group['WeightFactor']['id'];
		$id_name = "q_".$group['WeightFactor']['id'];
		
		echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
		echo $group['WeightFactor']['id'].". &nbsp;&nbsp;<b>".$group['WeightFactor']['section_name'];
		echo "</b></span><br/><br/>";	
		
		
		if( !empty($group['RatingRules']) ){?>
			<div id="<?php echo $id_name; ?>" style=" display:none;" >
			<table   width="100%" >
				<tr>
                    <th width=10% style="text-align:center">Select</th>
                    <th width=10% style="text-align:center">Section No</th>
                    <th width=60% style="text-align:center">Section Name</th>
                    
                    
                </tr>
				<?php
				foreach($group['RatingRules'] as $key1=>$rule){
					//$value = [""][$rule['point']]
					?>
					
					<tr>
						<td width=10% style="text-align:center"><input type="radio" name="overview" value="overview[<?= $rule['section']?>][<?= $rule['point']?>]" /></td>
                        <td width=10%>0</td>
						<td width=60%><?php echo $rule['rule']; ?></td>

					</tr>
					
					
					<?php 
				}?>
			</table>
            <br />
			</div>
            
			<?php	
		}
	}
	
	?>
    
    
</div>

</div><!--company end-->
</div>