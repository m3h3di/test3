
<?php  echo $javascript->link('jquery.min.js'); 
echo "<pre>";
//print_r($company);
print_r($all_grievances);
echo "</pre>";

$gr_sec_lists = array("","Working Condition","Payment related");
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
		<th width=1% >S/N</th>
		<th style="text-align:center">Compliance Issues</th>
		<th colspan="31">Days of the months</th>
	</tr>
    <tr>
		<td width="1%" ></td>
		<td  style="text-align:center"></td>
        <?php
		for($i=1;$i <=31;$i++){
				echo '<td width="">'.$i.'</td>';
		} ?>
    </tr>
</table>

	
<?php
foreach($gr_sec_lists as $sec => $sec_name){
	if($sec == 0)	continue;
	
	$op_name = "op_".$sec;
	$id_name = "q_".$sec;
	echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
	echo "&nbsp;&nbsp;<b>".$sec_name;
	echo "</b></span><br/><br/>";
	?>
    
	<div id="<?php echo $id_name; ?>" style="" >
    <table style="width:1000px">
    
	<?php
	$number = 0;
    foreach($all_grievances as $key=>$grievance){ 
		if ($grievance['grievances']['section'] == $sec){
			?>
            <tr>
                <td width="3%"><?php echo $grievance['grievances']['id']; ?></td>
                <td style="width:100px"><?php echo $grievance['grievances']['grievance']; ?></td>
                
                
                    <?php
                    for($day=1;$day<=31;$day++){
						echo '<td style="">';
                        echo "0/0" ;
						echo '</td>';
                    }
                    ?>
                    
                </td>
            </tr>
            <?php
		}
    } ?>
                
    </table>
    </div>
    
    
    <?php
} ?>

	

<input type="submit" name="go" id="go" onclick="" class="go_button" value="" />
</form>
</div>
<br /><br />