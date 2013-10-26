<?php
/* 
echo '<pre style="text-align:left">';
print_r($factories);
echo "</pre>";
*/
?>
<h2>Assigned Facility</h2>
<!--
<p>
<button onclick="location.href='/Cluster/Create'">Create New</button>
</p>
-->
<div id="grid" class="k-widget k-grid" data-role="grid">
<table cellspacing="0" role="grid">
	<colgroup>
		<col>
		<col>
		<col>
	</colgroup>
	<thead class="k-grid-header">
		<tr>
			<th class="k-header k-filterable" data-role="sortable" scope="col" data-title="Name" data-field="ClusterNameEnglish" data-dir="asc">
				Facility Name
			</th>
			<th class="k-header k-filterable" data-role="sortable" scope="col" data-title="Name" data-field="ClusterNameEnglish" data-dir="asc">
				Brand
			</th>
			<th class="k-header k-filterable" data-role="sortable" scope="col" data-title="Name" data-field="ClusterNameEnglish" data-dir="asc">
				Last Survey Date
			</th>
	
	</tr>
	</thead>
	<tbody>
		<?php
			$i=0;
			foreach($factories[0]['Factory']  as $factory){
				$name= $factory['factory_name'];
				$address = $factory['brand'];
				$factory_id = $factory['id'];
				
				if($i++ %2 ==0)
					echo '<tr ><td>';
				else echo '<tr class="k-alt" ><td>';
				echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));
				echo '</td><td >'.$address.'</td><td>---</td></tr>';
				
			}
		?>
	</tbody>
</table>

			<div class="body_footer">
				<div class="clr"></div>
			</div>