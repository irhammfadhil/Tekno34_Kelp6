
<!-- Maintenance Schedule of DCFC   -->

<!-- <h4>Maintenance Schedule of DCFC</h4> -->
<div>
	<?php
	if ($maintenance->code != 404 ) {
		?>
		<table class="table border fixed" id="maintenan">
			<thead class="thead-light">
				<tr style="text-align: center;">
					<th scope="col">Vendor</th>
					<th scope="col">Perangkat</th>
					
					<!-- 						<th scope="col">Remark</th> -->
					<th scope="col" class="month_yesterday"></th>
					<th scope="col" class="month_now"></th>
					<th scope="col" class="month_tomorrow"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1; 
				foreach ($maintenance->data as $i) {
					?>
					<tr style="text-align: center;">
						<td><?php echo $i->maintenance_vendor ?></td>
						<td><?php echo $i->maintenance_device ?></td>
						<td><?php echo $i->monthsprev ?></td>
						<td><?php echo $i->months ?></td>
						<td><?php echo $i->monthsnext ?></td>
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
		$('#maintenan').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false });
	});

</script>
