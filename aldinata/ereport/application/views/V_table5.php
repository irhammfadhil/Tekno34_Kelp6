<!-- Hardware Movement -->
<!-- <h4>Hardware Movement</h4> -->
<div>
	<?php
	if ($movement->code != 404 ) {
		?>
		<table class="table border fixed" id="movement">
			<thead class="thead-light">
				<tr>
					<th scope="col">No</th>
					<th scope="col">Tanggal</th>
					<th scope="col">Description</th>
					<th scope="col">S/N</th>
					<th scope="col">QTY</th>
					<th scope="col">No.Rack</th>
					<th scope="col">Power</th>
					<th scope="col">PIC</th>
					<th scope="col">Time</th>
					<th scope="col">Remark</th>
					<th scope="col">Room</th>
					<th scope="col">No. Ticket</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($movement->data as $i) {
					?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $i->data_date ?></td>
						<td><?php echo $i->data_name ?></td>
						<td><?php echo $i->movement_serialnumber ?></td>
						<td><?php echo $i->movement_qty ?></td>
						<td><?php echo $i->movement_rack ?></td>
						<td><?php echo $i->movement_power ?></td>
						<td><?php echo $i->movement_pic ?></td>
						<td><?php echo $i->movement_time ?></td>
						<td><?php echo $i->data_remark ?></td>
						<td><?php echo $i->movement_room ?></td>
						<td><?php echo $i->movement_tiket ?></td>

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
		$('#movement').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": true });
	});


</script>
