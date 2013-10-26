<?php
/* 
echo '<pre style="text-align:left">';
print_r($factories);
echo "</pre>";
*/
?>
	
			
			<div class="header_title">
				Home
			</div>

			
			<div >
								
				<div style=" background-color:#EBEBEC;float:left;margin:5px;padding:40px; width:890px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
					<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>To Be Surveyed</b></div>
					<table width="100%">
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
				</div>

				<div class="header_title"></div>
				<div style=" background-color:#EBEBEC;float:left;margin:5px;padding:40px; width:890px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
					<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Follow Up</b></div>
					<table width="100%">
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
									echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));
									echo '</td><td style="text-align:center ">'.$address.'</td></tr>';
								}
							}
						?>
						
					</table>
				</div>
				
				<div class="header_title"></div>
				<div style=" background-color:#EBEBEC;float:left;margin:5px;padding:40px; width:890px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
					<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Completed</b></div>
					<table width="100%">
						<tr>
							<td style="text-align:center "><b>Company Name</b></td>
							<td style="text-align:center "><b>Address</b></td>							
						</tr>
						<?php
							foreach($factories[0]['Factory']  as $factory){
								$name= $factory['factory_name'];
								$address = $factory['address'];
								$factory_id = $factory['id'];
								
								if( !empty($factory['status']) & $factory['status'] == 2){
									echo '<tr><td style="text-align:center ">';
									echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));
									echo '</td><td style="text-align:center ">'.$address.'</td></tr>';
								}
							}
						?>
						
					</table>
				</div>
				
				
				
				<div class="clr"></div>
				
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>