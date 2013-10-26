
<?php  echo $javascript->link('jquery.min.js'); 
	//echo "<pre>";
	//print_r($company);
	//print_r($all_questions);
//echo "</pre>";
?>
<script type="text/javascript">
	function Validate(){
		var tt = document.getElementById('month').value ;
		//alert(tt);
		var mon = tt-1;
		var year = document.getElementById('year').value;
		
		var d=new Date();
		var month=new Array(12);
		month[0]="January";
		month[1]="February";
		month[2]="March";
		month[3]="April";
		month[4]="May";
		month[5]="June";
		month[6]="July";
		month[7]="August";
		month[8]="September";
		month[9]="October";
		month[10]="November";
		month[11]="December";
		
		var tmp = month[mon] +","+year+". Are you sure about the date?";
		
		var answer = confirm (tmp);
		
		if(answer) return true;
		else return false;
	}

	$(document).ready(function(){
		
		/*$("#test").click(function () {
			$("#q_4").slideToggle("slow");
		});*/
		
	});

	function my_toggle(qq){
		var r="#"+qq;
		
			$(r).slideToggle("fast");
		
	}
</script>

<?php echo $form->create('Survey', array('action' => 'process','name'=>'test')); // creating form
?>





<div class="breadcrumb"><!--breadcrumb start-->
    
    	<div class="welcome_text"><!--welcome_text start-->
        	 <font size="2">
				<?php echo $this->Html->link("Home","/") ?> >>
                <?php echo $company_info[0]['companies']['name']; ?>
           </font>
        	
        </div><!--welcome_text end -->
        <div class="date_combo"><!--date_combo start-->
        	<input type="hidden" name="date[day]" value="15" />
            
            <font size="2">Month</font>
        	<select id="month" name="date[month]">
            	<option value="01">January</option>
                <option  value="02">February</option>
                <option  value="03">March</option>
                <option  value="04">April</option>
                <option  value="05">May</option>
                <option  value="06">June</option>
                <option  value="07">July</option>
                <option  value="08" >August</option>
                <option  value="09" >September</option>
                <option  value="10">October</option>
                <option  value="11">November</option>
                <option  value="12">December</option>
            </select>
            
            <font size="2">Year</font>
            <select id="year" name="date[year]">
            	<option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
            </select>
        	<input type="submit" name="go" id="go" onclick="return Validate();" value="Go" /><!--class="go_button"-->
        </div><!--date_combo end -->
     	<div class="clear"></div>  
         
</div><!--breadcrumb end-->




<br/><br/>

<div class="company" style="text-align:left;"><!--company start-->

<h2>Enterprise Information</h2>

<div class="company_box"><!--company_box start-->
    <?php
    	//echo  '<pre style="text-align:left">';
		//print_r($company_info) ;
		//echo '</pre>';
	?>
    
<div class="company_box_body"><!--company_box_body start-->
    
    <div class="company_box_info"><!--company_entry_info start-->
		
            <div class="entry_field_name"><font size="2">Name of the enterprise:</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[name]" type="text" value="<?php echo $company_info[0]['companies']['name']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Zone :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[zone]" type="text" value="<?php echo $company_info[0]['companies']['zone']; ?>" class="entry_text" />
            </div><!--entry_field end-->
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Country :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[country]" type="text" value="<?php echo $company_info[0]['companies']['country']; ?>" class="entry_text" />
            </div><!--entry_field end-->
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Plot No :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[plot_no]" type="text" value="<?php echo $company_info[0]['companies']['plot_no']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Proposed Investment(Million US$) :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[proposed_investment]" type="text" value="<?php echo $company_info[0]['companies']['proposed_investment']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Local Employee-proposed :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[proposed_employee]" type="text" value="<?php echo $company_info[0]['companies']['proposed_employee']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>            
            
            <div class="entry_field_name"><font size="2">Local Employee-actual :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[actual_employee]" type="text" value="<?php echo $company_info[0]['companies']['actual_employee']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Expatriate-proposed :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[proposed_expatriate]" type="text" value="<?php echo $company_info[0]['companies']['proposed_expatriate']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
            
    </div><!--company_entry_info end-->
    
    <div class="company_box_info"><!--company_entry_info start-->
    		<div class="entry_field_name"><font size="2">Group:</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[group_no]" type="text" value="<?php echo $company_info[0]['companies']['group_no']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
    
			<div class="entry_field_name"><font size="2">Type of investment :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[type_of_investment]" type="text" value="<?php echo $company_info[0]['companies']['type_of_investment']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
        
        	<div class="entry_field_name"><font size="2">Product(s) :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[product]" type="text" value="<?php echo $company_info[0]['companies']['product']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Actual Investment(Million US$) :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[actual_investment]" type="text" value="<?php echo $company_info[0]['companies']['actual_investment']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Date of Commercial Operation :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[commercial_operation]" type="text" value="<?php echo $company_info[0]['companies']['commercial_operation']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
        
        	<div class="entry_field_name"><font size="2">Male :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[male]" type="text" value="<?php echo $company_info[0]['companies']['male']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Female :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[female]" type="text" value="<?php echo $company_info[0]['companies']['female']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
        	<div class="line"></div>
            
            <div class="entry_field_name"><font size="2">Expatriate-Actual :</font></div>
            <div class="entry_field"><!--entry_field start-->
            	<input name="company[actual_expatriate]" type="text" value="<?php echo $company_info[0]['companies']['actual_expatriate']; ?>" class="entry_text" />
                
                <input name="company[address]" type="hidden" value="<?php echo $company_info[0]['companies']['address']; ?>" class="entry_text" />
                <input name="company[contact_persons]" type="hidden" value="<?php echo $company_info[0]['companies']['contact_persons']; ?>" class="entry_text" />
                <input name="company[email_list]" type="hidden" value="<?php echo $company_info[0]['companies']['email_list']; ?>" class="entry_text" />
                <input name="company[phone_fax]" type="hidden" value="<?php echo $company_info[0]['companies']['phone_fax']; ?>" class="entry_text" />
            </div><!--entry_field end-->    
                    
    </div><!--company_entry_info end-->
 <div class="clear"></div>  
 
 

 
</div><!--company_box_body end-->

<div class="clear"></div>
</div><!--company_box end-->


<br/>

<div style="text-align:left">
<table width="100%">
	<tr>
		<th>S/N</th>
		<th>Compliance Issues</th>
		<th>Status</th>
		<th>Irregularities</th>
		<th>Suggestions</th>
		<th>Remarks</th>
	</tr>
</table>

	<input name="company_id" type="hidden" value="<?php echo $company['Company']['id'] ?>" />
<?php
$number = 0;
foreach($all_questions as $key=>$section){
	
	$op_name = "op_".$section['Survey']['id'];
	$id_name = "q_".$section['Survey']['id'];
	if($section['Survey']['type']  != 1){
		//echo "&nbsp; <b>".$section['Survey']['type'].". &nbsp;".$section['Survey']['name']."</b><br/><br/>";
		if($section['Survey']['id'] == 3)
			echo '<span id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
		else
			echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
			
		echo "&nbsp; <b>".$section['Survey']['type'].". &nbsp;&nbsp;".$section['Survey']['name'];
		echo "</b></span><br/><br/>";	
	}
	else{
		echo '<span style="padding-left:40px;cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" ><b>';
		echo $section['Survey']['name'];
		echo "</b></span><br/><br/>";
	}
	
	if( !empty($section['Question']) ){?>
		<div id="<?php echo $id_name; ?>" style="" >
		<table   width="100%">
			<?php
			
			foreach($section['Question'] as $key1=>$question){
				$number++;
				$id = $question['id'];?>
				<tr>
					<td width="3%"><?php echo $question['id']; ?></td>
					<td width=50%><?php echo $question['question']; ?></td>
                    
					<td width="12%">
                        <input name="data[<?php echo $id ?>][section_id]" type="hidden" value="<?php echo $question['section_id']; ?>" />
                        <?php 
                        if( $question['status'] == 1 ){
                            ?>    
                            <select name="data[<?php echo $id ?>][point]">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                                
                                <!--<option value="1">100%</option>
                                <option value="0">0%</option>
                                <option value="NA">NA</option>-->
                                
                            </select>                        
                            <?php
                        }
                        elseif($question['status'] == 2){
                            ?>
                            <select name="data[<?php echo $id ?>][point]">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                                <option value="NA">NA</option>
                                
                                <!--<option value="1">100%</option>
                                <option value="0">0%</option>
                                <option value="NA">NA</option>-->
                            </select>
                            <?php
                        }
                        elseif($question['status'] == 3){
                            ?>
                            <select name="data[<?php echo $id ?>][point]">
                            
                                <option value="1">Excellent</option>
                                <option value="0.5">Good</option>
                                <option value="0">Bad</option>
                                
                                <!--<option value="1">100%</option>
                                <option value="0.9">90%</option>
                                <option value="0.8">80%</option>
                                <option value="0.75">75%</option>
                                <option value="0.5">50%</option>
                                <option value="0.3">30%</option>
                                <option value="0.25">25%</option>
                                <option value="0.1">10%</option>
                                <option value="0">0%</option>-->
                                
                            </select>
                            <?php
                        }
                        
						
						// added for 1st question (100%,90%,80%.....type ans)
                        elseif($question['status'] == 4){
                            ?>
                            <select name="data[<?php echo $id ?>][point]">
                            
                                <!--<option value="1">100%</option>
                                <option value="0.9">90%</option>
                                <option value="0.8">80%</option>
                                <option value="0.75">75%</option>
                                <option value="0.5">50%</option>
                                <option value="0.3">30%</option>
                                <option value="0.25">25%</option>
                                <option value="0.1">10%</option>
                                <option value="0">0%</option>-->
                                
                                
                                <?php for($i=1;$i>=0;$i=$i-0.05) { ?>
                                	<option value="<?php echo $i;?>"><?php echo $i*100?>%</option>
                                <?php } ?>
                                
                            </select>
                            <?php
                        }?>
					</td>
					<td  width="12%"><input name="data[<?php echo $id ?>][irregularity]" type="text" /></td>
					<td  width="12%"><input name="data[<?php echo $id ?>][suggestion]" type="text" /></td>
					<td  width="12%"><input name="data[<?php echo $id ?>][remark]" type="text" /></td>
				</tr>
				
				
				<?php 
			}?>
		</table>
		</div>
		<?php	
	}
}
?>
<input type="submit" name="go" id="go" onclick="return Validate();"  value="Go" /> <!--class="go_button"-->
</form>
</div>

</div><!--company end-->


<br /><br />