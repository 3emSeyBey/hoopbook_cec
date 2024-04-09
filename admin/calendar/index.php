<div class = "wrap_body">
    <div class="wrapperx">
      <header>
        <p class="current-date"></p>
        <div class="icons">
          <span id="prev" class="material-symbols-rounded">chevron_left</span>
          <span id="next" class="material-symbols-rounded">chevron_right</span>
        </div>
      </header>
      <div class="calendar">
        <ul class="weeks">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>
        <ul class="days"></ul>
      </div>
    </div>
    <div class="card-body">
        <div class="container-fluid" >
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="20%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>Client</th>
						<th>Court</th>
						<th>Start</th>
						<th>End</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php 
                    $i = 1;

                    if (isset($_GET['fetch_reservations'])) {
                        $date = $_GET['date'];
                    } else {
                        $date = date('Y-m-d');
                    }   
                    $qry = $conn->query("SELECT cr.*, c.name as 'court' FROM `court_rentals` cr INNER JOIN `court_list` c ON cr.court_id = c.id ORDER BY datetime_start ASC");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
						<?php
							$client_id = isset($client_id) ? $client_id : '';
							$client_name = '';
							$client_id = $row['client_id'];
							if ($client_id != '') {
								$client_qry = $conn->query("SELECT CONCAT(firstname, ' ', lastname) AS fullname FROM `accounts` WHERE id = $client_id ");
								if ($client_qry->num_rows > 0) {
									$client_name = $client_qry->fetch_assoc()['fullname'];
								}
							}
							?>
							<td><?php echo $client_name ?></td>
							<td><?php echo $row['court'] ?></td>
							<td class=""><?= date("M d, Y h:i A", strtotime($row['datetime_start'])) ?></td>
							<td class=""><?= date("M d, Y h:i A", strtotime($row['datetime_end'])) ?></td>
							<td align="center">
								 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="./?page=court_rentals/view_court_rental&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this court_rental permanently?","delete_court_rental",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [7] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_court_rental($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_court_rental",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
