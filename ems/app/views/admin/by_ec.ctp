<?php echo $this->Html->css('accordion'); ?>
<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.hoveraccordion.js'); ?>

<?php
$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

//echo $this->Html->script('function');
/*
echo '<pre>';
print_r($factories);
echo '</pre>';
*/
?>

					
<div class="admin_home"><!--admin_home start-->
	<div class="reports" style="  background:url(img/env.jpg) no-repeat; background-position:600px 20px"><!--reports start--><br/>
    	<div class="report_title">
        	<font size="4" color="#333333"><b>By Different Parameter</b></font>
    	</div>
        
        
    
    
    
    
    <div class="reports"><!--reports start--><br/>
    	<div class="report_title">
        	<font size="4" color="#333333"><b>Chemical and Hazardous Materials Management Performance – At a Glance</b></font>
    	</div>
        
        <div id="overall"></div><br />     
       	<div id="msds"></div><br />
        <div id="ppe"></div><br />
        <div id="storage"></div><br />      
        <div id="spill"></div><br />
        
			
     <div class="clear"></div>
    <br /><br />
    </div><!--reports end-->

    
    
</div><!--admin_home end-->
	 <script type="text/javascript">
        $(document).ready( function() {
           

            // Setup HoverAccordion for Example 2 with some custom options
            $('#example2').hoverAccordion({
                keepHeight:true,
                activateItem: 1,
                speed: 400
            });
            $('#example2').children('li:first').addClass('firstitem');
            $('#example2').children('li:last').addClass('lastitem');
        });
    </script>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
		
		//start Overall edited by m3h3di==============
        var data = google.visualization.arrayToDataTable([
			   ['Name', 'Rating','Mid Risk Line','Low Risk Line'],
			<?php
				$i=0;
				foreach($overall as $val){
					$num = $val[0]['num'];
					$perc = round($val[0]['sum']/($num),2);
					
					if($i == 0) $name="Baseline Survey";
					else $name = "Follow Up ".$i;
					
					echo "['".$name."', ".$perc.",50,80 ],
							";
					$i++;					
				}
				
			?>
        
        ]);
        var comboChart = new google.visualization.ComboChart(document.getElementById('overall'));
			 comboChart.draw(data, {width: 700, height: 400,
			   title : 'Overall Performance of DEPZ Enterprises',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 100},
			   hAxis: {title: "Time",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "bars",
			   series: {0: {color: 'blue'},1: {type: "line", color: 'yellow'},2: {type: "line",color: 'green'},3: {type: "line",color: 'green'}}
			   
			 });
		//end overall  
		  
		
		//start MSDS edited by m3h3di
        var data = google.visualization.arrayToDataTable([
			   ['Name', 'Rating','Mid Risk Line','Low Risk Line'],
			<?php
				$i=0;
				foreach($msds as $val){
					$num = $val[0]['num'];
					$perc = round($val[0]['sum']*100/($num*5),2);
					
					if($i == 0) $name="Baseline Survey";
					else $name = "Follow Up ".$i;
					
					echo "['".$name."', ".$perc.",50,80 ],
							";
					$i++;					
				}
				
			?>
        
        ]);
        var comboChart = new google.visualization.ComboChart(document.getElementById('msds'));
			 comboChart.draw(data, {width: 700, height: 400,
			   title : 'MSDS use performance of DEPZ enterprises',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 100},
			   hAxis: {title: "Time",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "line",
			   series: {0: {color: 'blue'},1: {type: "line", color: 'yellow'},2: {type: "line",color: 'green'},3: {type: "line",color: 'green'}}
			   
			 });
		//end MSDS	   
		
		
		//start PPE edited by m3h3di
        var data = google.visualization.arrayToDataTable([
			   ['Name', 'Bar Rating','Rating','Mid Risk Line','Low Risk Line'],
			<?php
				$i=0;
				foreach($ppe as $val){
					$num = $val[0]['num'];
					$perc = round($val[0]['sum']*100/($num*5),2);
					
					if($i == 0) $name="Baseline Survey";
					else $name = "Follow Up ".$i;
					
					echo "['".$name."', ".$perc.", ".$perc." ,50,80 ],
							";
					$i++;					
				}
			
			?>
        
        ]);
        var comboChart = new google.visualization.ComboChart(document.getElementById('ppe'));
			 comboChart.draw(data, {width: 700, height: 400,
			   title : 'PPE Use Rating of DEPZ enterprises',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 100},
			   hAxis: {title: "Time",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "bars",
			   series: {0: {color: 'blue'},1: {type: "line", color: '#000'},2: {type: "line",color: 'yellow'},3: {type: "line",color: 'green'}}
			   
			 });
		//end PPE
		
		
		//start storage edited by m3h3di
        var data = google.visualization.arrayToDataTable([
			   ['Name', 'Rating','Mid Risk Line','Low Risk Line'],
			<?php
				$i=0;
				foreach($storage as $val){
					$num = $val[0]['num'];
					$perc = round($val[0]['sum']*100/($num*5),2);
					
					if($i == 0) $name="Baseline Survey";
					else $name = "Follow Up ".$i;
					
					echo "['".$name."',  ".$perc." ,50,80 ],
							";
					$i++;					
				}
			
			?>
        
        ]);
        var comboChart = new google.visualization.ComboChart(document.getElementById('storage'));
			 comboChart.draw(data, {width: 700, height: 400,
			   title : 'Performance in Proper Storage of Chemicals and Hazardous Materials ',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 100},
			   hAxis: {title: "Time",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "line",
			   series: {0: {color: 'blue'},1: {type: "line", color: 'yellow'},2: {type: "line",color: 'green'},3: {type: "line",color: 'green'}}
			   
			 });
		//end storage
		
		
      }
    </script>
	
    
   
