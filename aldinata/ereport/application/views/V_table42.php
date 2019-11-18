<!-- Security Device Availability -->

<div>
	<?php
	if ($security->code != 404 ) {
		?>
		<table class="table border fixed" id="secur">
			<thead class="thead-light">
				<tr>
					<th scope="col">Device</th>
					<th scope="col">Value</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($security->data as $i) {
					?>
					<tr>
						<td><?php echo $i->data_name ?></td>
						<td><?php echo $i->data_value ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else{
		echo "";
	} ?>
</div>
<br>


<script type="text/javascript">

	$(document).ready(function() {
		$('#secur').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});


</script>
