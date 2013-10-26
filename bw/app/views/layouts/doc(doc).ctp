<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=document_name.doc");
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<body>
<style>
tr{border:0}
td{padding:5px 10px;border: 1px solid black;vertical-align: top;}
.boldText{font-weight:bold}
/*
.verticalText{-moz-transform:rotate(270deg);}
*/
</style>
	
	<?php echo $content_for_layout; ?>
</body>
</html>