<?php
// file name for download  
$filename = "enterprise.xls"; 
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel"); 

?>


<?php echo $content_for_layout ?> 
