
<!-- Room Temperature  -->
<!-- <h4>Room Temperature</h4> -->
<div>
	<?php
	if ($realtemp->code != 404 ) {
		?>
		<table class="table border fixed" id="roomtemp">
			<thead class="thead-light">
				<tr>
					<th scope="col">Periode</th>
					<th scope="col">Min</th>
					<th scope="col">Max</th>
					<th scope="col">Remarks</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($realtemp->table as $i) {
					?>
					<tr>
						<td><?php echo $i->Periode ?></td>
						<td><?php echo $i->min ?></td>
						<td><?php echo $i->max?></td>
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


<!-- Room Humidity  -->
<!-- <h4>Room Humidity</h4> -->
<div>
	<?php
	if ($realhuman->code != 404 ) {
		?>
		<table class="table border fixed" id="roomhumi">
			<thead class="thead-light">
				<tr>
					<th scope="col">Periode</th>
					<th scope="col">Min</th>
					<th scope="col">Max</th>
					<th scope="col">Remarks</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($realhuman->table as $h) {
					?>
					<tr>
						<td><?php echo $h->Periode ?></td>
						<td><?php echo $h->min ?></td>
						<td><?php echo $h->max ?></td>
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
		$('#roomtemp').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});

	$(document).ready(function() {
		$('#roomhumi').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});
</script>
