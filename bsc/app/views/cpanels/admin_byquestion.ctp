<?php
$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

?>



<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            By Multiple Enterprise - By Question
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<div class="welcome"><!--welcome start-->
        
        <div class="welcome_text"><!--date_combo start-->
       <form action="" method="post" name="section_list" >
        	<font size="2">Zone: </font>
            <select name="zone" id="" rel="">
            <option value="0" >All zones</option>
            <?php 
            foreach($all_zone as $k=>$zone){
                $val = $zone['companies']['zone'];
                $select="";
                if( !empty($_POST) & $_POST['zone'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
            }
            ?>
        
            </select>
            | <font size="1">Month: </font>
            <select name="month">
            <option value="0">Select</option>
            	<opt
            	<?php
				
				//print_r($list_month);
				foreach( $list_month as $num => $mon) {
					//$num = intval($num)+1;
					if (!empty($_POST['month']) & ($_POST['month'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$mon. '</option>';
				}
				?>
            </select>
            
            <font size="1">Year: </font>
            <select name="year">
            	<option value="0">Select</option>
				<?php
                	for($num=2008;$num<=2015;$num++ ){
						if (!empty($_POST['year']) & ($_POST['year'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$num. '</option>';
					}
				?>
            	
                
            </select>
        	<input type="submit" name="go" id="go" onclick="" value="Go" /><!--class="go_button"--> 
		
        </div><!--date_combo end -->
        
     	<div class="clear"></div>   
</div><!--welcome end-->
<br /><br />



     <?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>
	<?php  echo $javascript->link('jquery.min.js'); 
	//echo "<pre>";
	//print_r($all_questions);
	//print_r($_POST);
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
			echo "</b></span><br/><br/>";
		}
		
		if( !empty($section['Section']) ){?>
			<div id="<?php echo $id_name; ?>" style=" display:none; padding-left:100px" >
           
			<table   width="100%">
				<?php
				foreach($section['Question'] as $key1=>$question){?>
					
					<tr>
						<td width="3%"><?php echo $question['id']; ?></td>
						<td width=60%><?php echo $question['question']; ?></td>
						<td class="actions">
						<?php
							$id = $question['id'];
							$yes ='';
							$no ='';
							$g5='';
							
							/*$g9='';
							$g8='';
							$g75='';
							$g3='';
							$g25='';
							$g10='';*/
							
if(!empty($_POST)){ //if(!empty($_POST)){ start
								
		foreach($_POST['data'] as $post_q_id => $post_val) //foreach($_POST['data'] as $post_q_id => $post_val) start
		{
			if($post_val == "SELECT") continue;
									
			if( $post_q_id == $id & $post_val==1)
			{
				$yes = 'selected="selected"';
				$no= '';
				$g5='';
				break;
			}
			elseif( $post_q_id == $id & $post_val == '0.5')
			{
				$no = '';
				$yes= '';
				$g5='selected="selected"';
				break;
			}
			elseif( $post_q_id == $id & $post_val == 0)
			{
				$g5 = '';
				$yes= '';
				$no='selected="selected"';
				break;
			}
			
			
			
			else
			{
				
				break;
			}
						
									
		} //foreach($_POST['data'] as $post_q_id => $post_val) end
								
}//if(!empty($_POST)){ end
		
                            if( $question['status'] == 1 ){
								
								?>    
								<select name="data[<?php echo $id ?>]">
									<option  value="SELECT" selected="selected">Please Select</option>
                                        <option <?php echo $yes; ?> value="1">YES</option>
                                        <option <?php echo $no; ?> value="0">NO</option>
                                        
								</select>                        
								<?php
							}
							elseif($question['status'] == 2){
								?>
								<select name="data[<?php echo $id ?>]">
									<option value="SELECT" selected="selected">Please Select</option>
                                        <option <?php echo $yes; ?> value="1">YES</option>
                                        <option <?php echo $no; ?> value="0">NO</option>	
                                       							
								</select>
								<?php
							}
							else if($question['status'] == 3){
								?>
								<select name="data[<?php echo $id ?>]">
                                	<option value="SELECT" selected="selected">Please Select</option>
                                    
                                    <option  <?php echo $yes; ?> value="1">Excellent</option>
									<option <?php echo $g5; ?> value="0.5">Good</option>
									<option <?php echo $no; ?> value="0">Bad</option>
                                    
                                    
								</select>
								<?php
							}
                            
                            else if($question['status'] == 4){
								?>
								<select name="data[<?php echo $id ?>]">
                                	<option value="SELECT" selected="selected">Please Select</option>
                                    
                                    <?php for($i=1;$i>=0;$i=$i-0.05) { ?>
                                		<option value="<?php echo $i;?>"><?php echo $i*100?>%</option>
                                	<?php } ?>
                                    
								</select>
								<?php
							}?>
							
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
    <input type="submit" value="Submit"  />
    </form>



<br /><br />
<center>
<?php
if(!empty($company_ans_list)){ ?>



<br /><br />

<fieldset>
<div align="left">
Survey Result for <b>
<?php 
	
	if(!empty($_POST['month']) && !empty($_POST['year']))
		//echo $_POST['month']." ".$_POST['year']; 
	{
		foreach( $list_month as $num => $mon) 
		{
			if (($_POST['month'] == $num) )
					echo $mon;
		}	echo ",".$_POST['year']; 
	}
		
		
	else 
		echo "available latest data";
		

?></b>
</div>
<div style="padding: 20px">
	<b><?php echo sizeof($company_ans_list);  ?></b> Enterprise(s) found
</div>
 </fieldset>

<br /><br />




<!--to export table start-->
<?php
	
	 
?>
<!--<div align="right">Please 
	<?php //echo $this->Html->link('Click', array('controller'=>'cpanels','action' => 'by_question_export',
	//$zone,$year,$month,$question));	
	?>
	to export
</div>-->
<!--to export table end-->



	<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
		<thead>
        <tr>
			<th>Name</th>
            <th>Survey Date</th>
            <th>Country</th>
            <th>Zone</th>
            <th>Details</th>
		</tr>
		</thead>
        <tbody>
		<?php
		foreach($company_ans_list as $key=>$val){
			$name = $val['company']['name'];
			$company_id= $val["RESULT"]["company_id"];
			$date = $val['RESULT']['survey_date'];
			?>
		<tr>
			<td><?php echo $this->Html->link($name, array('controller'=>'cpanels','action' => 'facilitystatus',$val["RESULT"]["company_id"]))	?></td>
            <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
            <td><?php echo $val['company']['country'] ?></td>
            <td><?php echo $val['company']['zone'] ?></td>
            <td><?php echo $this->Html->link('Details', array('controller'=>'cpanels','action' => 'facilityans',$company_id,$date)); ?></td>
		</tr>	
		
		<?php }
		?>
        </tbody>
	</table>
	<?php
}
?>
</center>

</div>


</div><!--company end-->


<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
<br />