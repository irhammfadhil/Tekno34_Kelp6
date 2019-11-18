<div class="container mt-4">
	<div class="card">
		<div class="card-body">

			<h4 class="text-body pb-4">Role List</h4>
			<div class="table-reponsive">
				<table class="table" id="mytable1">
					<thead>
						<tr>
							<th>User Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>S29938</td>
							<td>Fuadi Ahmad</td>
							<td>fuadi.ahmad@sigma.co.id</td>
							<td>0819283888</td>
							<td>Active</td>
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