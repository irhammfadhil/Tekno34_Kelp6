<!-- Change Management -->
<!-- <h4>Change Management</h4> -->
<div>
	<?php
	if ($cm->code != 404 ) {
		?>
		<table class="table border fixed" id="change">
			<thead class="thead-light">
				<tr>
					<th scope="col">Change ID</th>
					<th scope="col">Summary</th>
					<th scope="col">Class</th>
					<th scope="col">Priority</th>
					<th scope="col">Request Start</th>
					<th scope="col">Request End Date</th>
					<th scope="col">Risk Level</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($cm->data as $i) {
					?>
					<tr>
						<td><?php echo $i->cm_id ?></td>
						<td><?php echo $i->cm_summary ?></td>
						<td><?php echo $i->cm_class ?></td>
						<td><?php echo $i->cm_priority ?></td>
						<td><?php echo $i->cm_startdate ?></td>
						<td><?php echo $i->cm_enddate ?></td>
						<td><?php echo $i->cm_risklevel ?></td>
						<td><?php echo $i->cm_status ?></td>
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
		$('#change').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});


</script>
