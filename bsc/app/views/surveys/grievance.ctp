
<?php  echo $javascript->link('jquery.min.js'); 
echo "<pre>";
//print_r($company);
//print_r($all_grievances);
//print_r($_POST);
echo "</pre>";

$gr_sec_lists = array("","Working Condition","Payment related","Work Environment","Working hour","Supervision","Physical Violence","Psychological/Mental Violence", "Grievances related to Benefits","Medical facilities","Rights to talk/ Dialogue(Maternal benefits)");
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
			
			$("#q_1").slideToggle("slow");
			
			
		});

	function my_toggle(qq){
		var r="#"+qq;
		
			$(r).slideToggle("fast");
		
	}
</script>

<form method="post" action="" >
	<input name="company_id" type="hidden" value="<?php echo $company_id; ?>" />
<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	<div class="welcome_text"><!--welcome_text start-->
        	Grievance </b>
        </div><!--welcome_text end -->
        <div class="date_combo"><!--date_combo start-->
        	<input type="hidden" name="date[day]" value="15" />
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
            
            <select id="year" name="date[year]">
            	<option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
            </select>
        	<input type="submit" name="go" id="go" onclick="return Validate();" class="go_button" value="" />
        </div><!--date_combo end -->
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div>

<br/><br/>




<br/>

<div style="text-align:left;margin-left: -36px;">


	
<?php
foreach($gr_sec_lists as $sec => $sec_name){
	if($sec == 0)	continue;
	
	$op_name = "op_".$sec;
	$id_name = "q_".$sec;
	echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
	echo "&nbsp;&nbsp;<b>".$sec_name;
	echo "</b></span><br/><br/>";
	?>
    
	<div id="<?php echo $id_name; ?>" style=" display:none" >
    <table style="width:1000px">
    
	<?php
	$number = 0;
    foreach($all_grievances as $key=>$grievance){ 
		if ($grievance['grievances']['section'] == $sec){
			$gr_id = $grievance['grievances']['id'];
			?>
            <tr><td colspan="31" ><?php echo $grievance['grievances']['id']." . ". $grievance['grievances']['grievance']; ?></td></tr>
            <tr>
			<?php
			for($day=1;$day<=31;$day++){?>
				<td title="Grievance found on Date <?php echo $day; ?>">
					<input name="gr[<?php echo $gr_id ; ?>][<?php echo $day ; ?>][found]" type="text" value="0"  style="width:15px"/>
				</td>
                <?php 
			} ?>
            </tr>
            <tr>
            <?php
			for($day=1;$day<=31;$day++){?>
				<td >
					<input name="gr[<?php echo $gr_id ; ?>][<?php echo $day ; ?>][solved]" type="text" value="0"  style="width:15px"/>
				</td>
                <?php 
			} ?>
			</tr>
	        <tr><td colspan="31"></td></tr>
            <?php
		}
    } ?>
                
    </table>
    </div>
    
    
    <?php
} ?>

	

<input type="submit" name="go" id="go" onclick="return Validate();" class="go_button" value="" />

</form>
</div>
<br /><br />