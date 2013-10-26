<?php  //echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>
<pre>
<?php 
//print_r($cities); 
//print_r($factories);
//print_r($rating_rules);
//print_r($_POST);
?>
</pre>

<?php
$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

$buyer_list = array("C&A","Golden Penny","GmbH","Chibo","Aldi","Lidl","Wal-Mart","H&M","Sears-K-Mart","JC Penny","Target","Kwintet","Esprit","Gymboree","Carrefour","Lindex","KIK","Tesco","Next","George");



?>


		
<div style=" background-color:#EBEBEC;margin:5px;padding:40px; width:889px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
    <div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Please Select a Buyer</b></div>
            
    <div style="border:1px solid #FFFFFF; width:870px; padding:0px 0px 13px 10px; background:#FFF;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; ">
        
        <form action="" method="post" name="facility_info" style="padding:20px;" >
        <select name="buyer" size="6" style="width:700px">
        	        	
                        <?php
						foreach($buyer_list as $buyer){
							echo '<option value="'.$buyer.'">'.$buyer.'</option>';
						}
						?>
        
        </select>
        
        <br /><br />
        <input type="submit" value="Generate Report"  />
        </form>
                
    </div>
    
    
</div>


<div id="target_div"  name="target_div">
	
	<?php 
	if(!empty($result)){
		
		?>
		<center>
        <br />
		<div style="text-align:left; padding-left:20px">Facilities of <b><?= $_POST['buyer'] ?></b> ( found <b><?= sizeof($result) ?></b> facilities )  </div>
        <br />
		<table id="myTable" class="tablesorter" style=" width:97%" >
			<thead>
			<tr>
				<td style=" border:0; padding: 10px;  text-align:center"><b>number</b></td>
                <td style=" border:0; padding: 10px;  text-align:center"><b>Name</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Rating(%)</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Catagory</b></td>
                <td style=" border:0; padding: 10px;  text-align:center"><b>Buyer(s)</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Details</b></td>
			</tr>
			</thead>
			<tbody>
			<?php 
			$factory_num = 1;
			$actual_factory_num = 1;
			$actual_total_point = 0;
			$temp_total_point = 0;
			foreach($result as $factory){
				
				
				$name = $factory['factories']['factory_name'];
				$id = $factory['factories']['id'];
				$res = round($factory[0]['rating'],2);
				$buyer = $factory['fat']['text'];
				if( $res<=50) $img='highrisk.png';
				elseif($res>80) $img='lowrisk.png';
				else $img='medrisk.png';
				//echo $name;
				
				echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
				echo $factory_num.'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';	
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id));
				
				echo'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $res."%";
				
				echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
				echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				
				echo'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $buyer;
				
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo '</td></tr>';
			
				$temp_total_point+=$res;
				$factory_num++;
			}
			$temp_avarage= round($temp_total_point/($factory_num-1),2);
			?>
			</tbody>
		</table>
		
		</center>
		<?php
	}
	?>
</div>
