<?php
/* 
echo '<pre style="text-align:left">';
print_r($factories);
echo "</pre>";
*/
?>
	

			
<div class="reports">
	
    <br/><br/>							
<div class="report_title">
    <font size="2" color="#333">
       <b>To Be Surveyed</b>
    </font>
</div>
<br/><br/>

		<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
						<tr>
							<td style="text-align:center "><b>Company Name</b></td>
							<td style="text-align:center "><b>Address</b></td>							
						</tr>
						<?php
							foreach($factories[0]['Factory']  as $factory){
								$name= $factory['factory_name'];
								$address = $factory['address'];
								$factory_id = $factory['id'];
								
								if( empty($factory['status']) ){
									echo '<tr><td style="text-align:center ">';
									echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));
									echo '</td><td style="text-align:center ">'.$address.'</td></tr>';
								}
							}
						?>
						
					</table>
				
                
                
                 <br/><br/>							
<div class="report_title">
    <font size="2" color="#333">
       <b>Follow Up</b>
    </font>
</div>
<br/><br/>

					
					<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
						<tr>
							<td style="text-align:center "><b>Company Name</b></td>
							<td style="text-align:center "><b>Address</b></td>							
						</tr>
						<?php
							foreach($factories[0]['Factory']  as $factory){
								$name= $factory['factory_name'];
								$address = $factory['address'];
								$factory_id = $factory['id'];
								
								if( !empty($factory['status']) & $factory['status'] == 1){
									echo '<tr><td style="text-align:center ">';
									echo $html->link($name, array('controller' => 'users','action' => 'ffactory', $factory_id));
									echo '</td><td style="text-align:center ">'.$address.'</td></tr>';
								}
							}
						?>
						
					</table>
				
				
                
                 <br/><br/>							
<div class="report_title">
    <font size="2" color="#333">
       <b>Completed</b>
    </font>
</div>
<br/><br/>

					
					<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
                
				
						<tr>
							<td style="text-align:center "><b>Company Name</b></td>
							<td style="text-align:center "><b>Address</b></td>							
						</tr>
						<?php
							foreach($factories[0]['Factory']  as $factory){
								$name= $factory['factory_name'];
								$address = $factory['address'];
								$factory_id = $factory['id'];
								
								if( !empty($factory['status']) & $factory['status'] > 1){
									echo '<tr><td style="text-align:center ">';
									echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));
									echo '</td><td style="text-align:center ">'.$address.'</td></tr>';
								}
							}
						?>
						
					</table>
				
				<br/><br/>
				
				
				
	</div>
			