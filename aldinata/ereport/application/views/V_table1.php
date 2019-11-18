<!-- Executive Summary -->
<p>Environment</p>
<div>
	<?php
	if ($summary->code != 404 ) {
		?>
		<table class="table border fixed" id="Executive">
			<thead class="thead-light">
				<tr>

					<th scope="col">Service Item</th>
					<th scope="col">Standart</th>
					<th scope="col">This Month Performance</th>

				</tr>
			</thead>
			<tbody>

				<?php
				$no = 1; 
				foreach ($summary->Environment as $i) {
					?>
					<tr>
						<td><?php echo $i->Menu ?></td>
						<td><?php echo $i->Data_Standard ?></td>
						<td><?php echo $i->Performance ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else{
		echo "";
	} ?>
</div>
<br>

<p>Security Device Availability</p>
<div>
	<?php
	if ($summary->code != 404 ) {
		?>
		<table class="table border fixed" id="securitt">
			<thead class="thead-light">
				<tr>

					<th scope="col">Service Item</th>
					<th scope="col">Standart</th>
					<th scope="col">This Month Performance</th>

				</tr>
			</thead>
			<tbody>
				
				<?php
				$no = 1; 
				foreach ($summary->Security_Device_Availability as $s) {
					?>
					<tr>

						<td><?php echo $s->Menu ?></td>
						<td><?php echo $s->Data_Standard ?></td>
						<td><?php echo $s->Performance ?></td>
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
		$('#Executive').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});

</script>

<script type="text/javascript">

	$(document).ready(function() {
		$('#securitt').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});

</script>