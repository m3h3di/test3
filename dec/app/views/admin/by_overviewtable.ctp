<?php
//echo "<pre>";
//print_r($tables);
//echo "</pre>";

if(!empty($tables)){
	?>
    <table>
    <tr>
    	<td>S/N</td>
    	<td>Facility Name</td>
    </tr>
    <?php
	$i=1;
	
	foreach($tables as $table){
		$id=$table['factories']['id'];
		$name = $table['factories']['factory_name'];
		?>
		<tr>
            <td><?=  $i++;?></td>
            <td><?= $html->link($name, array('controller' => 'admins','action' => 'FacilityReport',$id )); ?></td>
        </tr>
       <?php
	}?>
	</table>
    <?php
}
?>


