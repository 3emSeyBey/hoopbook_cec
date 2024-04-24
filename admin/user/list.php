<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Users</h3>
		<div class="card-tools">
			<a href="./?page=user/manage_user" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `accounts` where id != '{$_settings->userdata('id')}' and account_type = 1 order by concat(firstname,' ', lastname) asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['firstname'] ?></td>
							<td><?php echo $row['lastname'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td class="text-center">
								<?php if($row['status'] == 1): ?>
									<span class="badge badge-success">Active</span>
								<?php else: ?>
									<span class="badge badge-danger">Inactive</span>
								<?php endif; ?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
								  	<button class="dropdown-item toggle-status" type="button" data-id="<?= $row['id'] ?>">Toggle Status</button>
									<div class="dropdown-divider"></div>
									<button class="dropdown-item toggle-user-type" type="button" data-id="<?= $row['id'] ?>">Toggle User Type</button>
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	function toggle(url, id) {
		$.ajax({
			url: url,
			type: 'POST',
			data: { id: id },
			error: err => {
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success: resp => {
				if(resp == 1){
					location.reload();
				}else{
					alert_toast("An error occured",'error');
					end_loader();
				}
			}
		});
	}

	$('.toggle-status').click(function() {
		var id = $(this).data('id');
		toggle(_base_url_+'classes/Users.php?f=toggle_status', id);
	});

	$('.toggle-user-type').click(function() {
		var id = $(this).data('id');
		toggle(_base_url_+'classes/Users.php?f=toggle_type', id);
	});
		
</script>