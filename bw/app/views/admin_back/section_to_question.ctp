<?php echo $this->Session->read('ans_id_list'); ?>
<script type="text/javascript" src="/seba/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8">
/*
$(function(){
	
  $("select#section").change(function(){
   
	$.getJSON("/seba/admins/ajaxquestion",{id: $(this).val(), ajax: 'true'}, function(j){
		
      	var options = '';
      	for (var i = 0; i < j.length; i++) {
        options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
      	}
      $("select#question").html(options);
	  $("select#answer").html("");
	  document.body.style.cursor="default";
    })
  })
})

$(function(){
  $("select#question").change(function(){
  	 document.body.style.cursor="wait";
    $.getJSON("/seba/admins/ajaxanswer",{id: $(this).val(), ajax: 'true'}, function(j){
      var options = '';
      for (var i = 0; i < j.length; i++) {
        options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
      }
      $("select#answer").html(options);
    })
  })
})
*/
	function showfield(ref){
		
		var dest= ref.value;
		//alert(ref.value);
		document.getElementById(dest).style.display = "block";

		/*if( document.getElementById(dest).checked ){
			//alert("cheked");
			document.getElementById(ref).style.display = "block";
		}
		else{
			//alert("Not Check");
			document.getElementById(ref).style.display = "none";
		}*/
	}

</script>

<?php
echo "<pre>";
//print_r($questions);
//print_r($factory_answers);
echo "</pre>";

$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");
?>

					

<div class="header_title"></div>
		
<div style=" background-color:#D8D2C3;margin:5px;padding:40px; width:889px;">
	<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>By Specific Question</b></div>
				
	<div style=" background:#FFFFF8;border:1px solid #FFFFFF; width:868px; padding:0px 0px 13px 10px ">
	<p>
	<form action="" method="post" name="facility_info" >
		 			
		Select First Section and Point<br>
		<select name="section" id="section" style=" font-size:16px" onchange="submit()">
			<option>Please select ...</option>
		<?php 
			foreach($section_list as $section_id => $section_name){
				$disable = "";
				$select ="";
				if( !empty($section_name) ){
					if( !empty($_POST['section']) & $_POST['section']== $section_id)
						$select= 'selected="selected"';
					echo '<option '.$select.' value="'.$section_id.'" title="'.$section_name.'" >'.$section_id.' : '.$section_name.'</option>' ;
				}
			}
		?>								
		</select>
		<br /><br /><br />
		<?php
		if( !empty($_POST['section']) & empty($_POST['q_ans_id']) & !empty($questions) ){
			?>
			<table style="width:99%" >
				<tr >
					<td ></td>
					<td ></td>
					<td style=" text-align:center;padding:10px"><b>Questions</b></td>
				</tr>
				
					<?php
					echo 'Please Select a Question<br />';
					
					foreach($questions as $question){
						if( !empty($question['Answer']) & is_array($question['Answer']) ){
							
							$q = $question['Survey']['question'];
							$q_id = $question['Survey']['id'];
							$number = $question['Survey']['section'].".".$question['Survey']['order'];
							
							echo '<tr><td><input type="radio" name="q_id" value="'.$q_id.'" onclick="javascript: showfield(this)" /></td>';
							echo '<td>'.$number.'</td>';
							echo '<td style="padding:10px">'.$q;
							echo '<div style="padding:5px 0px 5px 40px;  display:none" id="'.$q_id.'">';
							foreach($question['Answer'] as $ans ){
								$q_ans = $ans['answer'];
								$q_ans_id = $ans['id'];
								echo '<input type="radio" name="q_ans_id" value='.$q_ans_id.'  />'.$q_ans."<br/>";
							}
							echo '</div>';
							echo '</td></tr>';
								
						}
					}

				
				
				?>
								
			</table>
			<br /><br /><br />
			<input type="submit" value="Generate Report"  />
		<?php
		}
		else{
			if(!empty($ans) ){
				foreach($ans as $m_ans){
					$number = $m_ans['Question']['section'].".".$m_ans['Question']['order'];
					echo "<b>QUESTION (".$number."): </b> ".$m_ans['Question']['question']."<br/>";
					echo "<b>ANSWER : </b> ".$m_ans['Answer']['answer']."<br/><br/>";
				}
				/*$number = $ans[0]['Question']['section'].".".$ans[0]['Question']['order'];
				echo "<b>QUESTION (".$number."): </b> ".$ans[0]['Question']['question']."<br/>";
				echo "<b>ANSWER : </b> ".$ans[0]['Answer']['answer'];*/
			}
		}
		?>
			
			
			
			</form>
			</p>			
		</div>
		
	</div>

<div class="header_title"></div>
<div id="target_div" name="target_div">
	
	<?php 
	if(!empty($factories)){
		
		?>
		<center>
		<h3>Reports</h3>
		<table style=" width:97%" >
			<tr>
				<td style=" text-align:center"><b>Name</b></td>
				<td style="  text-align:center"><b>Rating(%)</b></td>
				<td style=" text-align:center"><b>City</b></td>
				<td style="  text-align:center"><b>Area</b></td>
				<td style=" text-align:center"><b>Details</b></td>
			</tr>
			<?php 
			foreach($factories as $factory){
				
				if( empty($factory['FactoryAnsTable']) ) continue;
				
				$session_ans_id = $this->Session->read('ans_id_list');
				$session_splitted_ans_id = explode(",", $session_ans_id);
				foreach($session_splitted_ans_id as $key => $val){
					$i=0;
					foreach($factory['FactoryAnsTable'] as $factoryanstable){
						if($val == $factoryanstable['ans_id'] ) $i=1;
					}
					if($i == 0) break;
				}
				if( $i==0 ) continue;
				
				echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
				$name = $factory['AdminFactory']['factory_name'];
				$id = $factory['AdminFactory']['id'];
				//echo $name;
				
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo'</td><td style=" border:0; padding: 10px; text-align:center">';

				if(!empty($factory['Rating']) ){
					
					$sum = 0;
					foreach($factory['Rating'] as $pnt){
						$sum += intval($pnt['points']);
					}
					$res=$sum/70*100;
					$res = number_format($res, 2, '.', '');
					echo $res."%";
				}
										
				echo '</td><td style=" border:0; padding: 10px; text-align:center">';
				echo $factory['AdminFactory']['city'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center">';
				echo $factory['AdminFactory']['area'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center">';
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo '</td></tr>';
					
			}
			
		?>
		</table>
		<table style=" width:99%;">
	
		<tr> 
			<td style="text-align:right; background:#FFFFFF">
			<form action="" method="post" name="facility_info" >
				<input type="hidden" value="clear_one" name="clear" />
				<input type="submit" value="Back One Step" /> 
			</form>
			</td>
			
			<td style="text-align:right; background:#FFFFFF"  width="9%">
			<form action="" method="post" name="facility_info" >
				
				<input type="submit" value="Clear All" /> 
			</form>
			</td>
		</tr>
		</table>
		</center>
	<?php
	}
	
	?>
</div>
