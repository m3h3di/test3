<pre>
<?php
print_r($company_ans_list);
?>
</pre>


<?php
	/*$total_possible_point=0;
	$total_point=0;
	foreach($company_ans_list as $key=> $val){
		if( strtoupper($val['CompanyAnsList']['status']) == "NA"  ) continue;	//ignoring NA field
		$total_possible_point += 1;
		$total_point += floatval($val['CompanyAnsList']['status']) ;
	}
	echo $total_possible_point." ".$total_point;*/
	
	
?>



<style>
.middle{
width:564px;
padding:25px;
}
.top{
clear:both;
width:564px;
height:39px;
}
.mid{
clear:both;
width:564px;
}
.mid table{
margin:0px;	
}
.bottom{
clear:both;
width:564px;
height:39px;
}
.top #l {
	background:url('<?php echo $html->url('/img/survey_table_left_bg.png');?>');
	float:left;
	width:13px;
	height:39px;
	
}
.top #m {
	background:url('<?php echo $html->url('/img/survey_table_middle_bg.png');?>');
	float:left;
	width:538px;
	height:39px;
}
.top #r {
	background:url('<?php echo $html->url('/img/survey_table_right_bg.png');?>');
	float:left;
	width:13px;
	height:39px;
}

.bottom #b_l {
	background:url('<?php echo $html->url('/img/survey_table_lef_bottom_bg.png');?>');
	float:left;
	width:15px;
	height:33px;
	
}
.bottom #b_m {
	background:url('<?php echo $html->url('/img/survey_table_lef_middle_bg.png');?>');
	float:left;
	width:534px;
	height:33px;
}
.bottom #b_r {
	background:url('<?php echo $html->url('/img/survey_table_right_bottom_bg.png');?>');
	float:left;
	width:15px;
	height:33px;
}

#customers
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
}
#customers td
{
font-size:1em;
padding:3px 7px 2px 7px;
border:1px solid #89DAF9;
}
#customers table{
border-collapse:collapse;
}
#customers th{
background-color:#89DAF9;
font-size:1.4em;
} 

#customers tr td {
	background: #C7DAE9;
	text-align:center;
	
}
#customers tr td:hover{
background:#35C1E1;
color:#FFFFFF;
	 
}
#customers tr:nth-child(2n) td {
	background: #DBDBDB;
}

#customers tr:nth-child(2n) td:hover {
	background: #35C1E1;
	color:#FFFFFF;
}

 </style>

<div class="middle">
	<div class="top">
    	<div id="l">&nbsp;
        </div>
        <div id="m">&nbsp;
        </div>
        <div id="r">&nbsp;
        </div>
    </div>
    <div class="mid">
  
        
	<table width="564" id="customers" cellspacing="0" cellpadding="2">
		<tr>
			<th>Survey Date</font></th>
			<th>Rating</th>
			<th>Status</th>
			<th>View</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
                      
<?php   
	foreach($company_ans_list as $key=>$survey){
		
		$date = $survey['company_ans_lists']['created'];
		$total_point = $survey[0]['SUM( `status` )'];
		$get_point = $survey[0]['SUM(`point`)'];
		$percent = $get_point / $total_point * 100.00 ;
		$percent_r=round($percent,2);
		
		?> 
		<tr>
		<td ><?php echo $date;?></td>
        <td ><?php echo $percent_r;?>%</td>
        <td  width="110"> 
        	<!-- The css of this div should be inline otherwise it will not get the value of $percent_r-->
            <div style="background:url('<?php echo $html->url('/img/status.png');?>');width:<?php echo $percent_r;?>px; height:15px;">
                    
            </div>
            
        </td>
        <td ></td>
        <td ></td>
        <td ></td>
      </tr>
    <?php }?>    
      
    </table>		

    </div>
    <div class="bottom">
	
		<div id="b_l">&nbsp;
        </div>
        <div id="b_m">&nbsp;
			<div style="border:none;float:right;"> <a href="#"><?php echo $html->image('add_survey_btn_normal.png', array('alt' => 'bottom','border'=>'0') );?></a> </div>
			</div>
        <div id="b_r">&nbsp;
        </div>
			
    </div>

</div>		