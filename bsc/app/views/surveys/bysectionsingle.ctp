<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.jqplot.min.js'); ?>
<?php  echo $javascript->link('jqplot.canvasTextRenderer.min.js'); ?>
<?php  echo $javascript->link('jqplot.canvasAxisTickRenderer.min.js'); ?>
<?php  echo $javascript->link('jqplot.dateAxisRenderer.min.js'); 
//echo '<pre style="text-align:left">';
//print_r($all_sections);
//print_r($company_ans_list);
//print_r($_POST);
//echo '</pre>';

$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>


<script type="text/javascript" language="javascript">
$(document).ready(function(){


//line1 = [['1/1/2006', 5], ['2/1/2006', 1], ['3/1/2006', 3], ['4/1/2006', 8], ['5/1/2006', 12], ['6/1/2006', 13], ['7/1/2006', 5.9],['8/1/2006', 8], ['9/1/2006', 12], ['10/1/2006', 13], ['11/1/2006', 5.9]];

<?php  
$line = "[";
$tricks ="[";
$i = 0;
foreach($company_ans_list as $key=>$survey){
	
	$survey_date = $survey['company_ans_lists']['survey_date'];
    $total_point = floatval($survey[0]['rating']);
    
    $percent = round($total_point , 2) ;
    //$percent_r=round($percent,2);
	if($i == 0){
		$line.= "['".$survey_date."',". $percent ."]";
		$tricks.= "'".$survey_date."' ";
	}
	else {
		$line.= ", ['".$survey_date."',". $percent ."]";
		$tricks.= " ,'".$survey_date."'";
	}
	$i++;
}
$line.="]";
$tricks.="]";
?>
line1 = <?php echo $line ?>;



<?php  
$line = "[";
$tricks ="[";
$i = 0;
foreach($overall_company_ans_list as $key=>$survey){
	
	$survey_date = $survey['company_ans_lists']['survey_date'];
    $total_point = floatval($survey[0]['rating']);
    
    $percent = round($total_point , 2) ;
    //$percent_r=round($percent,2);
	if($i == 0){
		$line.= "['".$survey_date."',". $percent ."]";
		$tricks.= "'".$survey_date."' ";
	}
	else {
		$line.= ", ['".$survey_date."',". $percent ."]";
		$tricks.= " ,'".$survey_date."'";
	}
	$i++;
}
$line.="]";
$tricks.="]";
?>
line2 = <?php echo $line ?>;


plot1 = $.jqplot('chart1',[line1, line2], {
	title: 'series1: selected | series2: Overall',
	//seriesTitles: [ "m", "h"],
		
  legend: {show:true, location: 'nw', yoffset: 6},
  axes:{
    xaxis:{
      renderer:$.jqplot.DateAxisRenderer, min:'August 1, 2010', tickInterval: "1 months",
	  rendererOptions:{tickRenderer:$.jqplot.CanvasAxisTickRenderer},
      tickOptions:{formatString:'%b,%Y', fontSize:'10pt', fontFamily:'Tahoma', angle:-40, fontWeight:'normal', fontStretch:1}, 
      //ticks:['12/1/2005', '1/1/2006', '2/1/2006', '3/1/2006', '4/1/2006', '5/1/2006', '6/1/2006', '7/1/2006', '8/1/2006', '9/1/2006', '10/1/2006']
	  ticks:<?php echo $tricks ?>
    },
	yaxis:{
      renderer: $.jqplot.LogAxisRenderer, 
	  min:'0',
	  max:'100',
	  tickInterval: '25',
	  tickOptions:{formatString:'$%'} 
    }
  }
});

  });
</script>

<style  type="text/css">
 .jqplot-legend{
	
	width:200px;
	top:180px !important;
 }
</style>

<script type="text/javascript">

function aaaa(id){
	var linkk = '<?php echo $this->Html->url("/counselors/facility/"); ?>';
	linkk += id;
	location.href=linkk ;
}
</script>
<div class="top_menu">
	<ul>
    	<li><?php echo $this->Html->link('Home', array('controller'=>'counselors','action' => 'home')); ?></li>
    	<li>
        	<select name="" onchange="aaaa(this.value)" >
            <option>Assigned Factories</option>
            <?php
			$topmenu = $session->read('session_company');
            foreach($topmenu as $key=> $val) {
               $company_name = $val['t1']['name'];
               $company_id = $val['t1']['id']; 
                $link =  $this->Html->url("/counselors/factory/entry");
				?>
              	<option value="<?php	echo $company_id; ?>"><?php	echo $company_name; ?></option>
            	<?php
            }
            ?>
            </select>
        </li>
          <li><?php echo $this->Html->link('Notice Board', array('controller'=>'notice_boards')); ?> </li>
        <li><?php echo $this->Html->link('Reference Documents', array('controller'=>'counselors','action' => 'home')); ?> </li>
        
        
        <!--<li><?php //echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?> </li>-->
    </ul>

</div>

<br />

<form action="" method="post" name="section_list" >

<h2>By Section Single Facility Analysis</h2>



<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	<div class="welcome_text" style="float:left ; width:400px" ><!--date_combo start-->
		<b><?php echo $all_companies[0]['companies']['name']; ?></b>
         </div>
         <div class="welcome_text" style="float:right ; width:400px" >
        	 From:
            <select name="range[fmonth]">
            <option value="0">Select</option>
            	
            	<?php
				
				//print_r($list_month);
				foreach( $list_month as $num => $mon) {
					//$num = intval($num)+1;
					if (!empty($_POST['range']['fmonth']) & ($_POST['range']['fmonth'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$mon. '</option>';
				}
				?>
            </select>
            
            <select name="range[fyear]">
            	<option value="0">Select</option>
				<?php
                	for($num=2008;$num<=2015;$num++ ){
						if (!empty($_POST['range']['fyear']) & ($_POST['range']['fyear'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$num. '</option>';
					}
				?>
            	
                
            </select>
            To:
            <select name="range[tmonth]">
            <option value="0">Select</option>
            	
            	<?php
				
				//print_r($list_month);
				foreach( $list_month as $num => $mon) {
					//$num = intval($num)+1;
					if (!empty($_POST['range']['tmonth']) & ($_POST['range']['tmonth'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$mon. '</option>';
				}
				?>
            </select>
            
            <select name="range[tyear]">
            	<option value="0">Select</option>
				<?php
                	for($num=2008;$num<=2015;$num++ ){
						if (!empty($_POST['range']['tyear']) & ($_POST['range']['tyear'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$num. '</option>';
					}
				?>                
            </select>
            
        </div>   
        
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div><!--welcome end-->
<br /><br />

<div>


	<input name="company" type="hidden" value="<?php echo $all_companies[0]['companies']['id']; ?>"  />
<center>
<table width="50%">
    <tr>
        <th>Select</th>
        <th>Section name</th>
    </tr>

<?php

foreach($all_sections as $key=>$sec){
	$sec_id = $sec['sections']['id'];
	if( $sec_id == 3) continue;
	if( !empty($_POST['data'][$sec_id] )) 
		$chk='checked="checked"';
	else $chk='';
	?>
	
	<tr>
        <td><input  <?php echo $chk ?> type="checkbox" name="data[<?php echo $sec_id ?>]"  /></td>
        <td><?php echo $sec['sections']['name'] ?></td>
    </tr>
	<?php
}
?>
</table>
</center>

<input type="submit" value="Go"  />
</form>



<center>
<?php
if(!empty($company_ans_list)){
	?>
	<table width="80%" id="myTable" class="tablesorter" >
		<thead>
        <tr>
			<th>Survey Date</th>
			<th>rating(%)</th>
			<th>Details</th>
		</tr>
		</thead>
        <tbody>
		<?php
		foreach($company_ans_list as $key=>$val){
			$company_id= $val["company_ans_lists"]["company_id"];
			$date = $val['company_ans_lists']['survey_date'];
			$display_date = strftime("%B,%Y", strtotime($date));
			$rating =$val[0]['rating'];
			$rating = round($rating,2);
			?>
		<tr>
			
			<td><?php echo $display_date ?></td>
            <td><?php echo $rating ?>%</td>
			<td><?php echo $this->Html->link('Details', array('action' => 'facilitysectionans',$company_id,$date)); ?></td>
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