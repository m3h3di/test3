<?php  echo $javascript->link('jquery.min.js'); ?>
<?php 
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}


$section_list =  array("","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");

	//echo  '<pre style="text-align:left">';
	//print_r($questions) ;
	//print_r($factory_name);
	//sort($questions);
	//print_r($r);
	//print_r($answers) ;
	//print_r($rating_rules) ;
	//echo '</pre>';
	//echo $factory_id;
	
//	echo array_search("61",$question);

$new_num = "";
$old_num = "";
//$section = intval($section) - 1 ;

?>

<div class="header_title">
	<?php
	
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		$factory_name = trim($factory_name);
		echo $this->Html->link($factory_name, array('controller'=>'users' ,'action' => 'factory' , $factory_id)) . " >> ";
		echo "Section - ". ($section);
	?>
</div>


<!-- start of the entry page -->

<center>
<?php echo "<h3>". $section_list[$section] ."</h3>"; ?>

<script type="text/javascript">
	
	function showfield(ref){
		
		var dest= "chk_"+ref;
		if( document.getElementById(dest).checked ){
			//alert("cheked");
			if( document.getElementById(ref) )
				document.getElementById(ref).style.display = "block";
		}
		else{
			//alert("Not Check");
			if( document.getElementById(ref) )
			document.getElementById(ref).style.display = "none";
		}
	}
	
	function showType2(dest , ref){
		
		if( dest.value == "yes"  ){
			document.getElementById(ref).style.display = "block";
			//alert(dest.value);
		}
		else{
			//alert(dest.value);
			document.getElementById(ref).style.display = "none";
			document.getElementById(ref).value = "";
		}
	}
	
	function check_rating(){
		var elem = document.getElementById('point');
		if( dest.value == "yes"  ){
			
		}
		else{
			//alert(dest.value);
			document.getElementById(ref).style.display = "none";
			document.getElementById(ref).value = "";
		}
	}
	
	function hide_tr(src){
		var ref="";
		for( var i=2; i<=10; i++){
			ref = src.id+"_"+i;
			//alert(ref);
			if( document.getElementById(ref) )
				document.getElementById(ref).style.display = "none";
			else break;
		}
		
		/*for( var i=1; i<=10; i++){
			ref = "sub_"+src.id+"_"+i;
			//alert(ref);
			if( document.getElementById(ref) )
				document.getElementById(ref).style.display = "none";
			else break;
		}*/
	}
	function show_tr(src){
		var ref="";
		for( var i=2; i<=10; i++){
			ref = src.id+"_"+i;
			//alert(ref);
			if( document.getElementById(ref) )
				document.getElementById(ref).style.display = "table-row";
			else break;
		}
		/*
		for( var i=1; i<=10; i++){
			ref = "sub_"+src.id+"_"+i;
			//alert(ref);
			if( document.getElementById(ref) )
				document.getElementById(ref).style.display = "table-row";
			else break;
		}*/
	}
	
/*$(document).ready(function(){
	//Example of preserving a JavaScript event for inline calls.
	$("#9_1").click(function () {
		$("#9_2_1").slideToggle("slow");
	});
});
*/
</script>

<?php echo $form->create('Survey', array('action' => 'process','name'=>'test')); ?>


<input type="hidden" value="<?php echo $section; ?>" name="section"   />
<input type="hidden" value="<?php echo $factory_id; ?>" name="factory_id"  />

<table style=" width:817px;">

<?php
$i=1;
$new_num1 = "";
$old_num1 = "";

foreach($questions as $question ){
	if($question['Survey']['type'] == 6)
		continue;
	
	//tr id generation edited by m3h3di
	$new_num1 = $question['Survey']['section']."_".intval($question['Survey']['order']);
	if( $new_num1 != $old_num1 ){
			$i=1;
			$tr_id = $question['Survey']['section']."_".intval($question['Survey']['order'])."_".$i;
				
	}
	else {
		$i++;
		$tr_id = $question['Survey']['section']."_".intval($question['Survey']['order'])."_".$i;
	}
	$old_num1 = $new_num1;
	

?>		
	<tr id="<?php echo  $tr_id;?>">
		
		<td width="10%" style=" border:0; background:#CFE0E8; padding: 10px;">
			<b>
			<?php 
			
			//This portion is for generate the number of the question
			$new_num = $question['Survey']['section'].".".intval($question['Survey']['order']);
			if( $new_num != $old_num ){
				echo $new_num;
				//$i=1;
			}
			//else $i++;
			$old_num = $new_num;
			
			?>
			</b>
		</td>


<?php
	if($question['Survey']['type'] == 5){ ?>
		<td colspan="2">
			<?php echo $question['Survey']['question']; ?>
		</td>
	</tr>
	<tr>
		<td width="10%" style=" border:0; background:#CFE0E8; padding: 10px;">
		</td>
		<td colspan="2">
			<table>
				<tr>
					<td  style="text-align:center" width="50%"><b>Parameter (Unit)</b></td>
					<td  style="text-align:center"><b>Supplied</b></td>
					<td  style="text-align:center" width="25%"><b>Standard</b></td>
				</tr>
				<?php
				//$questions= sort($questions);
				foreach($questions as $inside_ques ){
					if($inside_ques['Survey']['type'] != 6 || $inside_ques['Survey']['status'] != $question['Survey']['status'] )
						continue;
					
					//$name = "";
					$ques2split = $inside_ques['Survey']['question'] ;
					$splitted_text = explode(":", $ques2split) ;
					$name = "text_".$inside_ques['Survey']['id'];
					?>
				
				<tr>
					<td style="text-align:center" ><?php echo $splitted_text[0]; ?></td>
					<td  style="text-align:center"><input style="padding:0;width: 50%;" type="text" name="<?php echo $name; ?>" /></td>
					<td  style="text-align:center"><?php echo $splitted_text[1]; ?></td>
				</tr>
				
					<?php 
				}
				?>
			</table>
		</td>
	</tr>
	<?php 
	}
	
	else{  // Above this portion is the table for the inner data AND below this is the other things
	?>
			

		<td width="40%" style=" border:0; background:#CADBE3; padding: 10px;"><b>
			<?php echo $question['Survey']['question']; ?></b>
		</td>
		
		<td style="background:#CFE0E8; text-align:center; vertical-align:middle;" >
			<table width="100px">
			<?php
				
				if($question['Survey']['type'] == "1"){
					$name = "radio_".$question['Survey']['id'];
					?>
					<tr >
						<td></td>
						<td>
							<div style="float:left; padding:0px 40px 0px 20px;"><input id="<?php echo $new_num1; ?>" name="<?php echo $name; ?>" type="radio" value="yes" /> Yes </div>   
							<div  style="float:left; padding-right:40px;" ><input id="<?php echo $new_num1; ?>" name="<?php echo $name; ?>"   type="radio" value="no" /> No </div>
							<div  style="float:left;" ><input id="<?php echo $new_num1; ?>" name="<?php echo $name; ?>"  type="radio" value="na" /> N/A </div>
						</td>
					</tr>
					<?php
				}
				
				
				
				if($question['Survey']['type'] == "2"){
					$detect_id = $question['Survey']['id'];
					$name = "radio_".$question['Survey']['id'];
					
					$sub_tr_onlick_id = "sub_".$question['Survey']['id'];
					
					?>
					<tr >
						<td></td>
						<td>
							<div style="float:left; padding:0px 40px 0px 20px;"><input  id="<?php echo $new_num1; ?>"  onclick="javascript: showType2(this,<?php echo $detect_id ;?>);show_tr(this);" name="<?php echo $name; ?>" type="radio" value="yes" /> Yes </div>   
							<div  style="float:left; padding-right:40px;" ><input  id="<?php echo $new_num1; ?>"  onclick="javascript: showType2(this,<?php echo $detect_id ;?>);hide_tr(this)" name="<?php echo $name; ?>" type="radio" value="no" /> No </div>
							<div  style="float:left;" ><input  id="<?php echo $new_num1; ?>"  onclick="javascript: showType2(this,<?php echo $detect_id ;?>);hide_tr(this)" name="<?php echo $name; ?>" type="radio" value="na" /> N/A </div>
						</td>
					</tr>
						
					<tr>
						<td></td>
						<td style="text-align:center">
							<?php 	
								$name = "text_".$question['Survey']['id'];
							?>
							<div ><textarea id="<?php echo $detect_id ;?>" style="display:none;width:90%; height:50px" name="<?php echo $name; ?>"></textarea></div>
						</td>
					</tr>
					<?php
				}
			
			
				if( is_array( $question['Answer']) & !empty($question['Answer']) ){
					//$irregual_arr = $question['Answer'] ;
					//$regual_arr =  array_sort($irregual_arr, 'order', SORT_ASC);
					
					$j=1;
					foreach( $question['Answer'] as $ans){
						
						$detect_id = $question['Survey']['id']."_".$ans['id'];
						$name = "chk_".$detect_id;
						
						//$sub_td_id = "sub_".$question['Survey']['id']."_".$j;
						?>
							
						<tr id="<?php //echo $sub_td_id; ?>">
							<td width="10%"> <input name="<?php echo $name ;?>" id="<?php echo $name ;?>" style="padding:0;width: 50%;" type="checkbox" onclick="javascript: showfield('<?php echo $detect_id ;?>');"/> </td>
							<td >
								<?php 
									echo $ans['answer']; 
									if( trim( strtolower($ans['type']) ) == 1 ){
										$name="text_".$detect_id;
										echo '<br/><span id="'.$detect_id.'" style=" display:none;"><input name="'.$name.'" style="padding:0; width: 90%;" type="text"  /></span>';
									}
									elseif( trim( strtolower($ans['type']) ) == 2 ){
										$name="text_".$detect_id; ?>
										
                                        <table id="<?php echo $detect_id ?>" style=" display:none; width:340px">
                                        <tr>
                                        	<td>Amount</td>
                                            <td>Where stored</td>
                                            <td>MSDS</td>
                                        </tr>
                                        <tr>
                                        	<td><input name="'.$name.'" style="padding:0; width:120px" type="text"  /></td>
                                            <td><input name="'.$name.'" style="padding:0; " type="text"  /></td>
                                            <td><input name="'.$name.'" style="padding:0; " type="checkbox"  /></td>
                                        </tr>
                                        </table>
                                   
                                        <?php
									}
									
								?>						
							</td>
							
						</tr>
						<?php 
						$j++;
					}
					
				}
						
			

				$name = "text_".$question['Survey']['id'];
				if($question['Survey']['type'] == "3")
					echo '<textarea style="width:90%; height:100px" name="'.$name.'"></textarea>';
				elseif($question['Survey']['type'] == "0" & empty($question['Answer']) )
					echo '<input style="padding:0;width: 50%;" type="text" name="'.$name.'" />';

			
			?>
			</table>
		</td>
	<?php 
	} 
	?>
	</tr>
	

	
<?php
}
?>
</table>

<h3>Rating</h3>
<table style=" width:817px; ">
	<tr>
	
	<td style="text-align:center; border:0; background:#CADBE3; padding: 10px;">
	<b>	Rules </b>
	</td>
	<td width="" style=" border:0; background:#CFE0E8; padding: 10px; text-align:center; ">
    <b> Options </b>
	</td>
    
    
	</tr>
<?php 


foreach($rating_rules as $rule ){ ?>
	
	<tr>
	
        
	<td style="border:0; background:#CADBE3; padding: 10px;"><?php echo $rule['RatingRule']['rule'];	?>
	</td>
	
    <td width="" style=" border:0; background:#CFE0E8; padding: 10px; text-align:center; ">
	<?php 
		$criteria_point = intval($rule['RatingRule']['point']);
		if( !empty($criteria_point) ){ 
			$rating_rule_id = $rule['RatingRule']['id'] ;
			?>
			<select name="data[<?php echo $rating_rule_id; ?>]">
				<?php
				for($loop=0; $loop <= $criteria_point ; $loop++){
            		echo '<option value="'.$loop.'">'.$loop.'</option>';
				}
			?>
			</select>
            
		<?php
        }
		else{
			$rating_rule_id = $rule['RatingRule']['id'] ;
			?>
			<select name="data[<?php echo $rating_rule_id; ?>]">
				<option value="1">Yes</option>
                <option value="0">No</option>
                <option value="2">NA</option>
			</select>
            <?php
		}
	?>
	</td>
    
	</tr>

<?php } ?>


</table>

<table style=" width:817px;">
	
	<tr> <td style="text-align:right; background:"><input type="submit" value="Save" /> </td></tr>
</table>

</form>
</center>