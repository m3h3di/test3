<?php  echo $javascript->link('jquery.min.js'); ?>

<pre style="text-align:left">
<?php
//print_r($company_ans_list);
$company_info = $company_info[0]['companies'];
//print_r($company_info);
?>
</pre>




<?php
$line = "[";
$tricks ="[";
$i = 0;
$date=array();
$percentage=array();
$index=0;
foreach($company_ans_list as $key=>$survey){

	$survey_date = $survey['company_ans_lists']['survey_date'];
    $total_point = floatval($survey[0]['SUM( `status` )']);
    $get_point = floatval($survey[0]['SUM(`point`)']);
    $percent = round($get_point / $total_point * 100.00, 2) ;
    //$percent_r=round($percent,2);
	if($i == 0){
		$line.= "['".$survey_date."',". $percent ."]";
		$tricks.= "'".$survey_date."' ";

                $survey_date_human_readable=strftime("%b %Y", strtotime($survey_date));
                $date[$index]=$survey_date_human_readable;
                $percentage[$index]=$percent;
                $index++;
	}
	else {
		$line.= ", ['".$survey_date."',". $percent ."]";
		$tricks.= " ,'".$survey_date."'";
                $survey_date_human_readable=strftime("%b %Y", strtotime($survey_date));
                $date[$index]=$survey_date_human_readable;
                $percentage[$index]=$percent;
                $index++;
	}
	$i++;
}
$line.="]";
$tricks.="]";
?>


<!--code added by rabi-->

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'x');
          data.addColumn('number', 'Compliance percentage');


       <?php
       $array_len=count($date);

       for($j=0;$j<$array_len;$j++){
       ?>
         data.addRow(["<?php echo $date[$j];?>", <?php echo $percentage[$j];?>]);

        <?php }?>



        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
                        width: 600, height: 400,
                        backgroundColor:'#FBFBFB',
                        colors:['#1E90FF','#004411'],
                        gridlineColor:'#829595',
                        vAxis: {maxValue: 10},
                        pointSize:8
                    }
                );
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
<!--end code added by rabi-->

<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text"><!--date_combo start-->
		<font size="2">
			<?php echo $this->Html->link('Home', array('controller'=>'counselors','action'=>'home')); ?> >>
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action'=>'enterprise_analysis')); ?> >>
            By Multiple Enterprise
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />



<div class="company"><!--company start-->
	<div class="company_info"><!--company_info start-->
		
        <div class="company_description">
			    	<div class="company_title"><strong>Enterprise Information</strong></div>

        	<font color="#58595b"><strong>Name</strong></font> of the Company: <font color="#58595b">
            	<strong><?php echo $company_info['name'] ?></strong>
            </font> <br />
         
            
            Plot No : <font color="#58595b"><strong><?php echo $company_info['plot_no'] ?></strong></font><br />
             
            
            Zone : <font color="#58595b"><strong><?php echo $company_info['zone'] ?></strong></font><br />
             
            
            Country : <font color="#58595b"><strong><?php echo $company_info['country'] ?></strong></font><br />
             
            
            Product(s) : <font color="#58595b"><strong><?php echo $company_info['product'] ?></strong></font><br />
                    
            
            Proposed Investment (Million US$): 
            <font color="#58595b">
			<strong><?php echo number_format($company_info['proposed_investment']);//echo $company_info['proposed_investment'] ?>	
			</strong></font><br />
             
            
            Actual Investment (Million US$): 
            <font color="#58595b">
			<strong><?php echo number_format($company_info['actual_investment']);//echo $company_info['actual_investment'] ?>
			</strong></font><br />
             
            
            Proposed Employee: 
            <font color="#58595b">
			<strong><?php echo number_format($company_info['proposed_employee']);//echo $company_info['proposed_employee'] ?>
			</strong></font><br />
             
			 
            Actual Employee: 
            <font color="#58595b">
			<strong><?php echo number_format($company_info['actual_employee']);//echo $company_info['actual_employee'] ?></strong>
			</font><br />
             
            
            Male: 
            <font color="#58595b">
			<strong><?php echo number_format($company_info['male']);//echo $company_info['male'] ?></strong></font><br />
             
            
            Female: 
            <font color="#58595b"><strong><?php echo number_format($company_info['female']);//echo $company_info['female'] ?></strong></font><br />
             
            
            Proposed Expatriate: 
            <font color="#58595b"><strong><?php echo number_format($company_info['proposed_expatriate']);//echo $company_info['proposed_expatriate'] ?></strong></font><br />
             
            
            Actual Expatriate: 
            <font color="#58595b"><strong><?php echo number_format($company_info['actual_expatriate']);//echo $company_info['actual_expatriate'] ?></strong></font><br />
             
            
            Commercial Operation Date: <br />
                <font color="#58595b">
                    <strong>
                        <?php //echo $company_info['commercial_operation'] ?>
                        <?php echo strftime("%b %d, %Y", strtotime($company_info['commercial_operation'])); ?>
                    </strong>
                </font>
                
                
        </div><!--company_description end-->
        
    	
    </div><!--company_info end-->
	    	
    <div class="company_table"><!--company_table start-->     
    	<div class="company_table_title"><!--company_table_title start--><strong>Survey Details</strong></div><!--company_table_title end-->

		
        <div class="survey_detail"><!--survey_detail start-->
		
        <table class="survey_table2">    
			  
			  <tr>
					<th width="181">Survey Date</th>
					<th width="102">Rating</th>
					<th width="171">Status</th>
					<th>View Details</th>
				</tr>
				   	   
              <?php   
                    foreach($company_ans_list as $key=>$survey){
                        $company_id = $survey['company_ans_lists']['company_id'];
                        
						$date = $survey['company_ans_lists']['survey_date'];
                        $total_point = $survey[0]['SUM( `status` )'];
                        $get_point = $survey[0]['SUM(`point`)'];
                        $percent = $get_point / $total_point * 100.00 ;
                        $percent_r=round($percent,2);
                        
                        ?> 
                        <tr>
                        <td width="181"><?php echo strftime("%B,%Y", strtotime($date)); ?></td>
                        <td width="102"><?php echo $percent_r;?>%</td>
                        <td  width="171"> 
                            <!-- The css of this div should be inline otherwise it will not get the value of $percent_r-->
                            
                <!-- <div style=" background: no-repeat url('<?php //echo $html->url('/img/percentage_bar.gif');?>');width:<?php //echo $percent_r;?>%; height:15px;">
                                    
                </div>-->
                		
                         <div style="width:160px; height:15px; border:1px solid #3e78ac;">
                                <div style=" background-color:#3e78ac; width:<?php echo $percent_r;?>%;height:15px;" align="left"></div>        
                         </div>
                            
                        </td>
                   <td >
				<?php echo $this->Html->link('Details', array('controller'=>'counselors','action' => 'mul_ent_by_ent_enterprise_ans',$company_id,$date)); ?>
                </td>
                        </tr>
                        
                    <?php }
					
					$link =  $this->Html->url("/surveys/entry/$company_id");
					?>  
                    
                    
                    
        </table>
        </div><!--survey_detail end-->
        
		
        


    </div><!--company_table end-->
<div class="clear"></div> 	
</div><!--company end-->
  
<br />



<div class="company"><!--company start-->
	<div class="company_info"><!--company_info start-->
    	
       <!--show specific map for specific zone -->
       <?php 
	   	if(  $company_info['zone'] == "ComEPZ")
			echo $html->image('map_comilla.gif', array('alt' => 'map','border'=>'0') );
		else
			echo $html->image('map_dhaka.gif', array('alt' => 'map','border'=>'0') );
		?> 
    	
    </div><!--company_info end-->
	    	
			
    <div class="company_table">    
    	<div class="company_table_title"><!--company_table_title start--><strong>Enterprise Compliance Graph</strong></div>

        
        <div id="visualization" style="width: 600px; height: 400px;"></div>
        </div>
      
    </div><!--company_table end-->
<div class="clear"></div> 	
</div><!--company end-->





<br /><br />

