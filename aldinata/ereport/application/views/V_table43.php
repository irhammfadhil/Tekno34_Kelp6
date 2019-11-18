<!-- Visitor Log -->

<!-- <h4>Visitor Log Lobby</h4> -->
<div>
	<?php
	if ($loglobby->code != 404 ) {
		?>
		<table class="table border fixed" id="visitlobby">
			<thead class="thead-light">
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama Pengunjung</th>
					<th scope="col">Perusahaan Asal</th>
					<th scope="col">Perusahaan Tujuan</th>
					<th scope="col">Tujuan</th>
					<th scope="col">Lokasi</th>
					<th scope="col">Waktu Checkin</th>
					<th scope="col">Waktu Checkout</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($loglobby->data as $i) {
					?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $i->visit_name ?></td>
						<td><?php echo $i->visit_company ?></td>
						<td><?php echo $i->visit_to ?></td>
						<td><?php echo $i->visit_purpose ?></td>
						<td><?php echo $i->visit_room ?></td>
						<td><?php echo $i->visit_checkindate ?></td>
						<td><?php echo $i->visit_checkoutdate ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else{
		echo "";
	} ?>
</div>
<br>


<!-- <h4>Visitor Log Dacen</h4> -->
<div>
	<?php
	if ($logdacen->code != 404 ) {
		?>
		<table class="table border fixed" id="visitdacen">
			<thead class="thead-light">
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama Pengunjung</th>
					<th scope="col">Perusahaan Asal</th>
					<th scope="col">Perusahaan Tujuan</th>
					<th scope="col">Tujuan</th>
					<th scope="col">Lokasi</th>
					<th scope="col">Waktu Checkin</th>
					<th scope="col">Waktu Checkout</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($logdacen->data as $d) {
					?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $d->visit_name ?></td>
						<td><?php echo $d->visit_company ?></td>
						<td><?php echo $d->visit_to ?></td>
						<td><?php echo $d->visit_purpose ?></td>
						<td><?php echo $d->visit_room ?></td>
						<td><?php echo $d->visit_checkindate ?></td>
						<td><?php echo $d->visit_checkoutdate ?></td>
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
		$('#visitlobby').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});

	$(document).ready(function() {
		$('#visitdacen').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});
</script>


