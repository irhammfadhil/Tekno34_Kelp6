<!-- Power UPS Load
	<h4>UPS Load</h4> -->
	<div>
		<span>UPS Load</span>
		<?php
		if ($ups_load->code != 404 ) {
			?>
			<table class="table border fixed" id="ups">
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
					foreach ($ups_load->ups as $i) {
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

	<!-- KVA
		<h4>UPS Load</h4> -->
		<div>
			<span></span>
			<?php
			if ($ups_load->code != 404 ) {
				?>
				<table class="table border fixed" id="kva">
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
						foreach ($ups_load->kva as $k) {
							?>
							<tr>
								<td><?php echo $k->data_name ?></td>
								<td><?php echo $k->data_date ?></td>
								<td><?php echo $k->data_value ?></td>
								<td><?php echo $k->data_remark ?></td>
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
				$('#ups').dataTable({
					"bPaginate": true,
					"bLengthChange": false,
					"bFilter": false,
					"bInfo": false,
					"bAutoWidth": false });
			});


			$(document).ready(function() {
				$('#kva').dataTable({
					"bPaginate": true,
					"bLengthChange": false,
					"bFilter": false,
					"bInfo": false,
					"bAutoWidth": false });
			});


		</script>

