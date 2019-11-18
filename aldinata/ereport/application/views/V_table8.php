<!-- Incident Log -->

<!-- <h4>Incident Log</h4> -->

<div>
	<?php
	if ($incident->code != 404 ) {
		?>
		<table class="table border fixed" id="incident">
			<thead class="thead-light">
				<tr>
					<th scope="col">Incident No.</th>
					<th scope="col">Subject</th>
					<th scope="col">Reported Date</th>
					<th scope="col">Resolutin Date</th>
					<th scope="col">PIC</th>
					<th scope="col">Resolution</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($incident->data as $i) {
					?>
					<tr>
						<td><?php echo $i->associated_request_id ?></td>
						<td><?php echo $i->log_summary ?></td>
						<td><?php echo $i->submit_date ?></td>
						<td><?php echo $i->resolved_date ?></td>
						<td><?php echo $i->log_pic ?></td>
						<td><?php echo $i->log_resolution ?></td>
						<td><?php echo $i->log_status ?></td>

					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else{
		echo "";
	} ?>
</div>
<br>


<!-- Request Log -->
<!-- <h4>Request Log</h4> -->
<div>
	<?php
	if ($request->code != 404 ) {
		?>
		<table class="table border fixed" id="request">
			<thead class="thead-light">
				<tr>
					<th scope="col">Request No.</th>
					<th scope="col">Subject</th>
					<th scope="col">Reported Date</th>
					<th scope="col">Resolutin Date</th>
					<th scope="col">PIC</th>
					<th scope="col">Resolution</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($request->data as $i) {
					?>
					<tr>
						<td><?php echo $i->associated_request_id ?></td>
						<td><?php echo $i->log_summary ?></td>
						<td><?php echo $i->submit_date ?></td>
						<td><?php echo $i->resolved_date ?></td>
						<td><?php echo $i->log_pic ?></td>
						<td><?php echo $i->log_resolution ?></td>
						<td><?php echo $i->log_status ?></td>

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
		$('#incident').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});

	$(document).ready(function() {
		$('#request').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});
</script>
