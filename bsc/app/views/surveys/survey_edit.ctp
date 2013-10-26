<?php
$company_info= $company_info[0]['companies'];

//echo  '<pre style="text-align:left">';
//print_r($ans_list) ;	
//print_r($company_info) ;	
//echo '</pre>';
?>

<div class="breadcrumb"><!--breadcrumb start-->
	<div class="welcome_text"><!--welcome_text start-->
          <font size="2">
			 <?php echo $this->Html->link("Home","/") ?> >>
             <?php echo $this->Html->link($company_info['name'], array('controller'=>'surveys','action' => 'showans',$company_info['company_id'],$survey_date)); ?> >>
                
             Survey Date:  <b><?php echo strftime("%B,%Y", strtotime($survey_date)); ?> >> </b>  <br />
                
             Edit survey information
                
          </font>
     </div><!--welcome_text end -->
        
        <div class="clear"></div>   
</div><!--breadcrumb end-->


<br /><br />


<div class="company" style="text-align:left"><!--company start-->

<?php 
//echo  '<pre style="text-align:left">';
//print_r($ans_list) ;	
//print_r($company_info) ;	
//echo '</pre>';



echo $form->create('Survey', array('action' => 'process','name'=>'test')); // crating form
?>
<table width="100%">
	<tr>
		<th width=3% >S/N</th>
		<th width=50% style="text-align:center">Compliance Issues</th>
		<th width="5%">Status</th>
		<th width="14%" style="text-align:center">Irregularities</th>
		<th width="14%" style="text-align:center">Suggestions</th>
		<th width="14%" style="text-align:center">Remarks</th>
	</tr>

	<?php
	$i=1;
	foreach($ans_list as $key=>$ans){?>
	
    <tr>
    	<td width=3% ><?php echo $i; ?></td>
		<td width=50% style="text-align:center"><?php echo $ans['questions']['question']; ?></td>
		<td width="5%">
        <?php 
			if( $ans['company_ans_lists']['status'] == 1 ){
				$value_1 = '';
				$value_5 = '';
				$value_0 = '';
				$NA ='';
				if( $ans['company_ans_lists']['point'] == 1 ) $value_1 = ' selected="selected" ';
				elseif( $ans['company_ans_lists']['point'] == "0.5" ) $value_5 = ' selected="selected" ';
				if( $ans['company_ans_lists']['point'] == 0 ) $value_0 = ' selected="selected" ';
			}
			else{
				$value_1 = '';
				$value_5 = '';
				$value_0 = '';
				$NA =' selected="selected" ';
			}
		?>
        
		<?php 
			if( $ans['questions']['status'] == 1 ){
				?>    
				<select name="data[][point]">
					<option <?php echo $value_1 ?> value="1">YES</option>
					<option <?php echo $value_0 ?> value="0">NO</option>
				</select>                        
				<?php
			}
			elseif($ans['questions']['status'] == 2){
				?>
				<select name="data[<?php echo $id ?>][point]">
					<option <?php echo $value_1 ?> value="1">YES</option>
					<option <?php echo $value_0 ?> value="0">NO</option>
					<option <?php echo $NA ?> value="NA">NA</option>
				</select>
				<?php
			}
			elseif($ans['questions']['status'] == 3){
				?>
				<select name="data[<?php echo $id ?>][point]">
					<option <?php echo $value_1 ?> value="1">Excellent</option>
					<option <?php echo $value_5 ?> value="0.5">Good</option>
					<option <?php echo $value_0 ?> value="0">Bad</option>
				</select>
				<?php
			}
			
			
			// added for 1st question (100%,90%,80%.....type ans) start
				else if($ans['questions']['status'] == 4)
				{ ?>	
					 <select name="data[<?php echo $id ?>][point]">
					 <?php for($i=1;$i>=0;$i=$i-0.05) { ?>
                                	<option value="<?php echo $i;?>"><?php echo $i*100?>%</option>
                     <?php }  ?>
                     </select>
					
				<?php } 
			// added for 1st question (100%,90%,80%.....type ans) end
			
		?>
        </td>
		<td width="14%" style="text-align:center"></td>
		<td width="14%" style="text-align:center"></td>
		<td width="14%" style="text-align:center"></td>
     </tr>   
		
	<?php $i++; } ?>
    
    
    
    
   	<tr>
		<td colspan="6"><input type="button" name="save_edit_survey" id="save_edit_survey" 
        onclick="window.location.href='<?php //echo $link ?>'"  value="Save" /></td>
	</tr>
    
    
    
   
</table>
</form>

</div><!--company end-->
