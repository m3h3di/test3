<?php
// file name for download  
$filename = "test.xls"; 
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel"); 

?>

<table cellspacing="0" rules="all" border="1" style="border-collapse:collapse;">
	<tr>
    	<th>nacompliance me</th>
        <th>percentage</th>
    </tr>
    <tr>
    	<th>X Limided</th>
        <th>50%</th>
    </tr>

</table>

