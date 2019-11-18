<!-- UPS Backup Time -->

<!-- <h4>UPS Backup Time</h4> -->
<div>
	<?php
	if ($upstime->code != 404 ) {
		?>
		<table class="table border fixed" id="backup">
			<thead class="thead-light">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Date</th>
					<th scope="col">Value</th>
					<th scope="col">Remark</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($upstime->data as $i) {
					?>
					<tr>
						<td><?php echo $i->data_name ?></td>
						<td><?php echo $i->data_date ?></td>
						<td><?php echo $i->data_value ?></td>
						<td><?php echo $i->data_remark ?></td>
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
		$('#backup').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});


</script>
