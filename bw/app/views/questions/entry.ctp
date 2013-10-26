<?php 
	// <pre>
	//print_r($questions) 
	//</pre>
?>

<table style=" width:817px;">
<?php

foreach($questions as $question ){
	
	//echo $question['Question']['question']."<br/>";
	/*if( is_array( $question['Answer']) & !empty($question['Answer']) ){
		foreach( $question['Answer'] as $ans){
			echo "  =>".$ans['answer']."<br />";
		}
	
	}*/
?>		



	<tr>
		<td width="40%" style=" border:0; background:#CADBE3; padding: 10px;"><b><?php echo $question['Question']['question']; ?></b></td>
		<td style="background:#CFE0E8; text-align:center; vertical-align:middle;" >
			<table width="100px">
			<?php
			if( is_array( $question['Answer']) & !empty($question['Answer']) ){
				foreach( $question['Answer'] as $ans){			
				?>
					
				
					<tr>
						<td width="10%"> <input style="padding:0;width: 50%;" type="checkbox"  /> </td>
						<td ><?php echo $ans['answer']; ?> </td>
						
					</tr>
				
				<?php 
				} 
			}
			else{
				echo '<input style="padding:0;width: 50%;" type="text"  />';
			}
			?>
			</table>
		</td>
	</tr>
	

	
<?php
}
?>
</table>