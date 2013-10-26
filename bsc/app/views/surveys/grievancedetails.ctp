

<h2>Grievances</h2>
<br/>
<div>




<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	      
       <div class="welcome_text" style="float:none ; width:500px" >
        Details report
        </div>
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div><!--welcome end-->
<br /><br />



<center>
<?php
if(!empty($gr)){
	?>
	<table width="80%" id="myTable" class="tablesorter" >
		<thead>
        <tr>
			<th>Grievance</th>
            <th>Month</th>
            <th>Day</th>
			<th>Grievance (Found)</th>
            <th>Grievance (Solved)</th>
			
		</tr>
		</thead>
        <tbody>
		<?php
		foreach($gr as $key=>$v){
			$company_id= $v['gr_ans_lists']["company_id"];
			$date = $v['gr_ans_lists']['survey_date'];
			$f =$v['gr_ans_lists']['found'];
			$s =$v['gr_ans_lists']['solved'];
			
			?>
		<tr>
			<td><?php echo $v['grievances']['grievance']; ?></td>
			<td><?php echo strftime("%B,%Y", strtotime($date)); ?></td>
            <td><?php echo $v['gr_ans_lists']['day']; ?></td>
            <td><?php echo $f ?></td>
            <td><?php echo $s ?></td>
			
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
<br/><br/><br/>
<div id="chart1" style=" width:586px; height:343px;">  </div>
<br />