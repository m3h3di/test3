<?php
/* 
echo '<pre style="text-align:left">';
print_r($factories);
echo "</pre>";
*/
?>
	
			<!--<div class="block_box_t" >
				<div class="block_box_b">
					<h1 class="latest">Login Panel</h1>
					<div style="padding-left:312px">
						<div style="border:1px solid #D8D2C3;float:left;margin:5px;padding:3px;">
							<form style="background-color:#E6E3DB; padding:20px" action="/seba/users/login" target="_parent" method="post">
							
								<div style="margin:0; padding: 10px"> <span style="margin:0; padding: 10px 40px 10px 10px"> Login</span>: <input type="text" name="data[User][username]"  /> </div>
								<div style="margin:0; padding: 10px"> <span style="margin:0; padding: 10px 16px 10px 10px">Password</span>: <input type="password" name="data[User][password]"  /></div>
								<div style="margin:0; padding: 10px; text-align:right"><input type="submit" value="Login"/></div>
							</form>
						</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<div class="header_title"></div>-->
			<div class="header_title">
				Home
			</div>

			
			<div >
								
				<div style=" background-color:#c8d2d8;float:left;margin:5px;padding:40px; width:890px">
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
				<div style=" background-color:#c8d2d8;float:left;margin:5px;padding:40px; width:890px">
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
				<div style=" background-color:#c8d2d8;float:left;margin:5px;padding:40px; width:890px">
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
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>