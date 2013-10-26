
<?php  echo $javascript->link('jquery.min.js'); 
echo "<pre>";
//print_r($company);
//print_r($all_questions);
echo "</pre>";
?>
<script type="text/javascript">
	$(document).ready(function(){
		
		/*$("#test").click(function () {
			$("#q_4").slideToggle("slow");
		});*/
		
	});

	function my_toggle(qq){
		var r="#"+qq;
		
			$(r).slideToggle("fast");
		
	}
</script>

<form action="">

<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	<div class="welcome_text"><!--welcome_text start-->
        	Grievance </b>
        </div><!--welcome_text end -->
        
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div>

<br/><br/>




<br/>

<div style="text-align:left">
<table width="100%">
	<tr>
		<th width=3% >S/N</th>
		<th width=50% style="text-align:center">Compliance Issues</th>
		<th width="47%">Days of the months/th>
	</tr>
</table>

	
<?php
$number = 0;
foreach($all_questions as $key=>$section){
	
	$op_name = "op_".$section['Survey']['id'];
	$id_name = "q_".$section['Survey']['id'];
	if($section['Survey']['type']  != 1){
		//echo "&nbsp; <b>".$section['Survey']['type'].". &nbsp;".$section['Survey']['name']."</b><br/><br/>";
		if($section['Survey']['id'] == 3)
			echo '<span id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
		else
			echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
			
		echo "&nbsp; <b>".$section['Survey']['type'].". &nbsp;&nbsp;".$section['Survey']['name'];
		echo "</b></span><br/><br/>";	
	}
	else{
		echo '<span style="padding-left:40px;cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" ><b>';
		echo $section['Survey']['name'];
		echo "</b></span><br/><br/>";
	}
	
	if( !empty($section['Question']) ){?>
		<div id="<?php echo $id_name; ?>" style="" >
		<table   width="100%">
			<?php
			
			foreach($section['Question'] as $key1=>$question){
				$number++;
				$id = $question['id'];?>
				<tr>
					<td width="3%"><?php echo $question['id']; ?></td>
					<td width=20%><?php echo $question['question']; ?></td>
                    
					<td width="70%">
                        <?php
						for($day=1;$day<=31;$day++){
							echo ' <input type="checkbox" name=""  />'.$day ;
						}
						?>
                        
                    </td>
				</tr>
				
				
				<?php 
			}?>
		</table>
		</div>
		<?php	
	}
}
?>
<input type="submit" name="go" id="go" onclick="" class="go_button" value="" />
</form>
</div>
<br /><br />