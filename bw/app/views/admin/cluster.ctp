<?php
 
echo '<pre style="text-align:left">';
//print_r($clusters);
echo "</pre>";

?>
<div class="k-widget k-grid" id="grid" data-role="grid">
<table cellpadding="0" cellspacing="0" role="grid">
	<thead class="k-grid-header">
	<tr>
		<th class="k-header k-filterable"><?php echo $this->Paginator->sort('name');?></th>
		<th class="k-header k-filterable"><?php echo $this->Paginator->sort('description');?></th>		
		<th  class="k-header k-filterable"><?php echo $this->Paginator->sort('isFundamentalPrinciple');?></th>
	</tr>
	</thead>
	<tbody>
<?php
	$i=1;
	foreach($clusters as $key => $cluster){
	?>
	<tr <?php if($i++%2==0) echo 'class="k-alt"'; ?>   >
		<td width="40%"><?php //echo $cluster['Cluster']['name'] ;?>
			<ul id="menu123">
			  <li>
				<a href="#">Delphi</a>
				<ul>
				  <li><a href="#">Saarland</a></li>
				  <li><a href="#">Salzburg</a></li>
				</ul>
			  </li>
			</ul>
			<script>
			  $(function() {
				$( "#menu123" ).menu();
			  });
			</script>		
		</td>
		<td><?php echo $cluster['Cluster']['description'] ;?></td>
		<td><?php 
			if($cluster['Cluster']['isFundamentalPrinciple']==0)
				echo '<input class="check-box" disabled="disabled" type="checkbox">';
			else
				echo '<input checked="checked" class="check-box" disabled="disabled" type="checkbox">';
			?>
		</td>	
	</tr>
	<? break;
	}
?>	</tbody>
</table>
</div>
