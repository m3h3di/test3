<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=ifc-bw.doc");
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<body style="padding:0;margin:0 auto;font-family:Calibri,bold;font-size:11pt">
<style>
.reportTitle{font-weight:bold;margin-left:20px;color:rgb(193, 0, 0)}
table{font-family:Calibri;font-size:10pt}
tr{border:0}
td{padding:7px 10px;vertical-align: top;border: 1px solid #000;margin:0}
.FG td{border: 1px solid #c1c1c1;font-size:10pt}
.boldText{font-weight:bold}
.boldBg{font-weight:bold;background:rgb(57, 40, 100);color:#fff;text-align:center;height:calc();vertical-align:middle;}
.verticalText{font-weight:bold;height:70px; }
</style>
	
	<?php echo $content_for_layout; ?>
</body>
</html>