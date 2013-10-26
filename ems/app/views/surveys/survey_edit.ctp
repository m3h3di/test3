<?php 
$section_list =  array("","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");

	//echo  '<pre style="text-align:left">';
	//print_r($questions) ;		
	//print_r($factory_answers) ;
	//print_r($rating_rules) ;
	//print_r($rating) ;
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
		echo "BaseLine Survey Edit Section - ". ($section);
	?>
</div>


<!-- start of the entry page -->

<center>
<?php echo "<h3>". $section_list[$section] ."</h3>"; ?>

<script type="text/javascript">
	
	function showfield(ths){
		
		var ref= ths.id+"1";
		if( ths.checked ){
			//alert("cheked");
			if( document.getElementById(ref) )
				document.getElementById(ref).style.display = "block";
		}
		else{
			//alert("Not Check");
			if( document.getElementById(ref) )
			document.getElementById(ref).style.display = "none";
			//document.getElementById(ref).value = "";
		}
	}
	function showType2(dest , ref){
		document.getElementById(ref).style.display = "block";
	}
	
	/*function showType2(dest , ref){
		
		if( dest.value == "yes"  ){
			document.getElementById(ref).style.display = "block";
			//alert(dest.value);
		}
		else{
			//alert(dest.value);
			document.getElementById(ref).style.display = "none";
			document.getElementById(ref).value = "";
		}
	}*/
	
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
	
</script>
<?php echo $form->create('Survey', array('action' => 'process','name'=>'test')); ?>

<input type="hidden" value="<?php echo $section; ?>" name="section"  />
<input type="hidden" value="<?php echo $factory_id; ?>" name="factory_id"  />

<table style="background:#fffFF7; width:817px;" class="tablesorter">
<?php
// Object is to place the factory answer information to the the question-answer lists
foreach($questions as $question ){?>
	
	<tr>
	<td width="10%" style=" border:0;   padding: 10px;">
        <b>
        <?php 
        
        //This portion is for generate the number of the question
        
        $new_num = $question['Survey']['section'].".".intval($question['Survey']['order']);
        if( $new_num != $old_num )
            echo $new_num;
        
        $old_num = $new_num;
        
        ?>
        </b>
	</td>

    <td width="40%" style=" border:0;   padding: 10px;"><b>
        <?php echo $question['Survey']['question']; ?></b>
    </td>
	<td style="  text-align:center; vertical-align:middle;" >
	<table width="100%">
	<?php
		$name = "radio_".$question['Survey']['id'];
		$chk_radio_yes = "";
		$chk_radio_no = "";
		$chk_radio_na = "";
		$value= "";
		$text_value ="";		
		//start checking( with value retrieve) this question is in the factory answer list
		foreach($factory_answers as $factory_answer ){
			if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] ){
				$value =  substr( trim($factory_answer['FactoryAnsTable']['text']) , 0, 2);
				//echo $value;						
				if($value == "ye")	$chk_radio_yes = 'checked="checked"';
				elseif($value == "no")	$chk_radio_no = 'checked="checked"';
				elseif($value == "na")	$chk_radio_na = 'checked="checked"';
				
				if( $factory_answer['FactoryAnsTable']['type'] =="radio" ){
					//$tmptmp= strlen($factory_answer['FactoryAnsTable']['text']) - 1;
					$tmp_f = strpos($factory_answer['FactoryAnsTable']['text'],"(");
					if(!empty($tmp_f)){
						$tmp_f++;
						$tmp_l = strrpos($factory_answer['FactoryAnsTable']['text'],")") - $tmp_f;
						$text_value = substr($factory_answer['FactoryAnsTable']['text'],$tmp_f,$tmp_l);
					}
				}
				elseif( $factory_answer['FactoryAnsTable']['type'] =="text" )
					$text_value = trim($factory_answer['FactoryAnsTable']['text']);
			}
		}
		//End checking( with value retrieve) this question is in the factory answer list
						
					
		if($question['Survey']['type'] == "1" | $question['Survey']['type'] == "2"){
			//$detect_id = $question['Survey']['id'];
			//$name = "radio_".$question['Survey']['id'];
			
			$detect_id = $question['Survey']['id'];
			$name = "ansdata[".$question['Survey']['id']."][radio][value]";
			$sub_tr_onlick_id = "sub_".$question['Survey']['id'];
			?>
            <tr>
                <td></td>
                <td>
                    <div style="float:left; padding:0px 40px 0px 20px;">
                        <input <?php echo $chk_radio_yes; ?> onclick="javascript: showType2(this,<?php echo $detect_id ;?>);" name="<?php echo $name; ?>" type="radio" value="yes" /> Yes 
                    </div>
                    <div  style="float:left; padding-right:40px;" >
                        <input  <?php echo $chk_radio_no; ?> onclick="javascript: showType2(this,<?php echo $detect_id ;?>);" name="<?php echo $name; ?>" type="radio" value="no" /> No 
                    </div>
                    <div  style="float:left;" >
                        <input <?php echo $chk_radio_na; ?> onclick="javascript: showType2(this,<?php echo $detect_id ;?>);" name="<?php echo $name; ?>" type="radio" value="na" /> N/A 
                    </div>
                </td>
            </tr>
						
            <tr>
                <td></td>
                <td style="text-align:center">
                    <?php 	
                    //$name = "text_".$question['Survey']['id'];
                    $name = "ansdata[".$question['Survey']['id']."][radio][text]";
                    
                    ?>
                    <div >
                    <textarea id="<?php echo $detect_id ;?>" style="display:block;width:90%; height:50px" name="<?php echo $name; ?>"><?php echo trim($text_value); ?></textarea>
                    </div>
                </td>
            </tr>
			<?php
		}
				
				
		if( is_array( $question['Answer']) & !empty($question['Answer']) ){
			
			foreach( $question['Answer'] as $ans){
				//$ans_id = $question['Survey']['id']."_".$ans['id'];
				//$name = "chk_".$ans_id;
				
				$detect_id = "ansdata[".$question['Survey']['id']."][chk][".$ans['id']."]" ;
				//$name = "chk_".$detect_id;
				$name = "ansdata[".$question['Survey']['id']."][chk][".$ans['id']."]";
				
				$text_value="";
				$chk_checkbox = "";
				$display = "none";
				//start checking( with value retrieve) this answer is in the factory answer list						
				foreach($factory_answers as $factory_answer ){
					if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] ){
						$chk_checkbox = 'checked="checked"';
						$display = "block";
						if($factory_answer['FactoryAnsTable']['type'] =="chk")
							$text_value = trim($factory_answer['FactoryAnsTable']['text']);
						break;
					}
				}
				//start checking( with value retrieve) this question is in the factory answer list						
				?>
					
                <tr>
                    <td width="10%"> <input  <?php echo $chk_checkbox; ?> name="<?php echo $name ;?>[value]" id="<?php echo $detect_id ;?>" style="padding:0;width: 50%;" type="checkbox" onclick="javascript: showfield(this);"/> </td>
                    <td >
                        <?php 
                            echo $ans['answer']; 
                            if( trim( strtolower($ans['type']) ) == 1 ){
                                //$name="text_".$ans_id;
                                $name = "ansdata[".$question['Survey']['id']."][chk][".$ans['id']."][text]";
                                echo '<br/><span id="'.$detect_id.'1" style="block"><input value="'.$text_value.'" name="'.$name.'" style="padding:0; width: 90%;" type="text"  /></span>';
                            }
                            elseif( trim( strtolower($ans['type']) ) == 2 ){
                                $name = "ansdata[".$question['Survey']['id']."][chk][".$ans['id']."][text]"; 
								$amount_val = "";
								$where_val = "";
								$msds_val = "";
								echo $text_value;
								if(!empty($text_value) ){
								
									$splitted_chk_value = explode("|",$text_value);
									$amount_val = $splitted_chk_value[1];
									$where_val = $splitted_chk_value[2];
									if( $splitted_chk_value[3] == "1") $msds_val= 'checked="checked"';
								}
								?>
                                
                                <table id="<?php echo $detect_id ?>1" style=" display:<?php echo $display ?>; width:340px">
                                <tr>
                                    <td>Amount</td>
                                    <td>Where stored</td>
                                    <td>MSDS</td>
                                </tr>
                                <tr>
                                    <td><input value="<?php echo $amount_val; ?>" name="<?php echo $name; ?>[amount]" style="padding:0; width:120px" type="text"  /></td>
                                    <td><input value="<?php echo $where_val; ?>" name="<?php echo $name; ?>[where]" style="padding:0; " type="text"  /></td>
                                    <td><input <?php echo $msds_val; ?> name="<?php echo $name; ?>[msds]" style="padding:0;"  type="checkbox"  /></td>
                                </tr>
                                </table><?php
                            }
                        ?>						
                    </td>
                </tr><?php 
			}
		}
		?>
                <tr>		
                    <td colspan="2" style="text-align:center">
                    <?php
                    $name = "ansdata[".$question['Survey']['id']."][text]";
                    $value="";
                    foreach($factory_answers as $factory_answer ){
                        if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] ){
                            $value =  trim($factory_answer['FactoryAnsTable']['text']);
                            break;
                        }
                    }
                    if($question['Survey']['type'] == "3" & empty($question['Answer']))
                        echo '<textarea style="width:90%; height:100px" name="'.$name.'">'.$value.'</textarea>';
                    elseif( $question['Survey']['type'] == "0" & empty($question['Answer']) )					
                        echo '<textarea style="width:90%; height:40px" name="'.$name.'">'.$value.'</textarea>';
                    elseif($question['Survey']['type'] == "8" & empty($question['Answer']) ){ ?>
                        <table >
                        <tr>
                            <td style="text-align:center">Name of Chemical</td>
                            <td style="text-align:center">Ave. Monthly Con</td>
                        </tr>
                        <?php 
						$msm_all_values = explode("|",$value);
						
                        for($msm=1;$msm<=15;$msm++){
							
							$msm_name='';
							$msm_val='';
							if (!empty($msm_all_values[$msm]) ){
								$msm_single_value = explode("-",$msm_all_values[$msm]);
								$msm_name=$msm_single_value[0];
								$msm_val=$msm_single_value[1];
							}
                            echo '<tr>';
                            echo '<td style="text-align:center"><input value="'.$msm_name.'" style="padding:0;width: 70%;" type="text" name="'.$name.'['.$msm.'][name]" /></td>';
                            echo '<td style="text-align:center"><input value="'.$msm_val.'" style="padding:0;width: 70%;" type="text" name="'.$name.'['.$msm.'][value]" /></td>';
                            echo '</tr>';
                        }
                        ?>
                        </table>
                    	<?php
                    }
                    ?>
                    </td>
                </tr>
		
	</table>
	</td>
	</tr><?php
}
?>
</table>




<h3>Rating</h3>
<table style="background:#fffFF7; width:817px;" class="tablesorter">
	<tr>
	
	<td style="text-align:center; border:0;   padding: 10px;">
	<b>	Rules </b>
	</td>
	<td width="" style=" border:0;   padding: 10px; text-align:center; ">
    <b> select point </b>
	</td>
    
    
	</tr>
<?php 



foreach($rating_rules as $rule ){ ?>
	
	<tr>
	
        
	<td style="border:0;   padding: 10px;"><?php echo $rule['RatingRule']['rule'];	?>
	</td>
	
    <td width="" style=" border:0;   padding: 10px; text-align:center; ">
	<?php 
		$criteria_point = intval($rule['RatingRule']['point']);
		if( !empty($criteria_point) ){ 
			$rating_rule_id = intval($rule['RatingRule']['id']) ;
			?>
			<select name="data[<?php echo $rating_rule_id; ?>]">
				<?php
				$gggg =0;
				foreach($rating as $rr => $vv){
					if( intval($vv['Rating']['rating_rule_id']) == $rating_rule_id ){
						 $gggg = & intval($vv['Rating']['points']) ;
						break;	
					}
				}
				
				
				for($loop=0; $loop <= $criteria_point ; $loop++){
						if($loop == $gggg) $chk='selected="selected"';
						else $chk = '';
								
            		echo '<option '.$chk.' value="'.$loop.'">'.$loop.'</option>';
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

<table style="background:#fffFF7; width:817px;" class="tablesorter">
	
	<tr> <td style="text-align:right"><input type="submit" value="Save" /> </td></tr>
</table>

</form>
</center>