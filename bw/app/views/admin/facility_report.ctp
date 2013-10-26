<?php
$sections = array("General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

echo '<pre style="text-align:left">';
//print_r($factory);
//print_r($sections);
//print_r($followups);
echo "</pre>";

?>
<h2>
	<?php
		
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		//echo $factory[0]['Factory']['factory_name'];
		
		$fId = $factory[0]['Factory']['id'] ;
		echo $factory[0]['Factory']['factory_name'];
	?>
</h2>



<div >
					
	<div style=";float:left;margin:5px;padding:30px; width:700px;">
		<div style="padding:0 0 20px;"><b>Survey Sections</b></div>
			<table width="100%">
				<tr>
					<td style="text-align:center "><b>Survey Date</b></td>
					<td style="text-align:center "><b>Rating</b></td>	
					<td style="text-align:center"><b>Bar Graph</b></td>
												
				</tr>
				<?php
				for($i=70;$i<=90;$i+=5){
					echo '<tr>';
					echo '<td>14th November, 2012</td>';
					echo '<td>'.$i.'%</td>';
					echo '<td></td>';
					echo '</tr>';
				}
				?>
						
			</table>
			</div>

			  <div style=" background-color:#EBEBEC;float:left;margin:5px;padding:30px; width:350px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
					<div style="padding:0 0 20px;"><b>Facility Information</b></div>
					<p style="border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; background:#FFF; padding:20px; font-size:12px">
					
						
						<?php 
						echo "<b>".$factory[0]['Factory']['factory_name']."</b><br/>";
						echo $factory[0]['Factory']['address']."<br/>";
						echo "Phone: ".$factory[0]['Factory']['telephone']."<br/>";
						echo "Fax: ".$factory[0]['Factory']['fax']."<br/>";
						echo "Contact Person: ".$factory[0]['Factory']['contact_person']."<br/>";
						echo "Email: ".$factory[0]['Factory']['email']."<br/>";
						?>
					
					</p>
                   
				</div>
				
				
				
				<div class="clr"></div>
				
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>
			
		<div style="clear:both"></div>	
	<span style="text-align:left; padding-left:20px"><h3>Rating Change in Graph</h3></span>
	<br />
	<div id="chart_div" ></div>
	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Date', 'rating(%)']
		,['Jan 1, 2013',  70]
		,['Feb 2, 2013',  90]
		,['Mar 3, 2013',  80]
		,['Apr 4, 2013',  85]
        ]);

        var options = {
          title: 'Report',
          hAxis: {title: "Date",textPosition:'none' },
          vAxis: {title: "rating(%)"},
          //curveType:'none'
          curveType:'function'
        
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }


      
    </script>