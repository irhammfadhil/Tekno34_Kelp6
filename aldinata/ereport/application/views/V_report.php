<div class="container mt-4">
	<div class="card">
		<div class="card-body">
			
			<h4 class="text-body pb-4">Report List</h4>
			<div class="table-reponsive">
				<table class="table" id="mytable1">
					<thead>
						<tr>
							<th>No</th>
							<th>Customer Name</th>
							<th>User</th>
							<th>Due Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Bank DKI</td>
							<td>Somad</td>
							<td>17 Juli 2019</td>
							<td>act</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#mytable1').DataTable({
        
        });
    })
</script>