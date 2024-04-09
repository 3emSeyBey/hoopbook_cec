<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `court_rentals` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
$gtotal = 0;
?>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-primary">
	<h3><b><?= isset($id) ? "Update Court Rental Details" : "Create New Court Rental" ?></b></h3>
</div>
<div class="row justify-content-center" style="margin-top:-2em;">
	<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<div class="container-fluid">
						<form action="" id="court_rental-form">
							<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="client_id" class="control-label">Client Name</label>
									<!-- <input type="text" class="form-control form-control-sm rounded-0" id="client_name" name="client_name" value="<?= isset($client_name) ? $client_name : '' ?>" required="required"> -->
									<select name="client_id" id="client_id" class="form-control form-control-sm rounded-0" required="required">
										<?php 
										$court_qry = $conn->query("SELECT * FROM `accounts` where `status` = 1 and account_type=1 order by `id` asc");
										while($row = $court_qry->fetch_assoc()):
											$selected = '';
											if(isset($id) && $client_id == $row['id']) {
												$selected = 'selected';
											}
										?>
										<option value=<?= $row['id'] ?> <?= $selected ?>><?= $row['firstname'] . ' ' .$row['lastname'] ?></option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="contact" class="control-label">Contact</label>
									<input type="text" class="form-control form-control-sm rounded-0" id="contact" name="contact" value="<?= isset($contact) ? $contact : '' ?>" required="required">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="court_id" class="control-label">Court</label>
									<select name="court_id" id="court_id" class="form-control form-control-sm rounded-0" required="required">
										<option value="" disabled <?= !isset($id) ? "selected" : "" ?>></option>
										<?php 
										$court_qry = $conn->query("SELECT * FROM `court_list` where delete_flag = 0 and `status` = 1 order by `name` asc");
										while($row = $court_qry->fetch_assoc()):
										?>
										<option value="<?= $row['id'] ?>" data-price="<?= $row['price'] ?>" <?= isset($court_id) && $court_id == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="court_price" class="control-label">Rate per Hour</label>
									<input type="text" class="form-control form-control-sm rounded-0 text-right" id="court_price" name="court_price" value="<?= isset($court_price) ? $court_price : 0 ?>" readonly>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="datetime_start" class="control-label">Date From</label>
									<input type="datetime-local" class="form-control form-control-sm rounded-0" id="datetime_start" name="datetime_start" value="<?= isset($datetime_start) ? date("Y-m-d\TH:i", strtotime($datetime_start)) : '' ?>" min = "<?= date("Y-m-d\TH:i") ?>" required="required">
								</div>
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="hours" class="control-label">Hours</label>
									<input type="number" min="1" class="form-control form-control-sm rounded-0" id="hours" name="hours" value="<?= isset($hours) ? $hours : 1 ?>" required="required">
								</div>
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="datetime_end" class="control-label">Date To</label>
									<input type="datetime-local" class="form-control form-control-sm rounded-0" id="datetime_end" name="datetime_end" value="<?= isset($datetime_end) ? date("Y-m-d\TH:i", strtotime($datetime_end)) : '' ?>" max = "<?= date("Y-m-d\TH:i") ?>"  readonly>
								</div>
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
									<label for="total" class="control-label">Total</label>
									<input type="text" class="form-control form-control-sm rounded-0 text-right" id="total" name="total" value="<?= isset($total) ? $total : 0 ?>" readonly>
									<?php $gtotal += (isset($total) ? ($total) : 0) ?>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-primary btn-sm bg-gradient-primary rounded-0" form="court_rental-form"><i class="fa fa-save"></i> Save</button>
				<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?page=court_rentals"><i class="fa fa-angle-left"></i> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
	function get_dt_end(){
		var dt_start = $('#datetime_start').val()
		var hrs = $('#hours').val()
		if(dt_start == ''  || hrs == '' || hrs <= 0)
		return false;
		dt_start = new Date(dt_start)
		var dt_end = new Date(dt_start.getTime() + hrs * 60 *60 *1000)
		dt_end = dt_end.getFullYear() + "-" + ((dt_end.getMonth() + 1).toString().padStart(2, 0)) + "-" + ((dt_end.getDate()).toString().padStart(2, 0)) + "\T" + ((dt_end.getHours()).toString().padStart(2, 0)) + ":" + ((dt_end.getMinutes()).toString().padStart(2, 0)) ;
		$('#datetime_end').val(dt_end)
		calc_total()
	}
	function get_hour_total(){
		var hrs = $('#hours').val()
		var price = $('#court_price').val()
		hrs = hrs > 0 ? hrs : 0 ;
		price = price > 0 ? price : 0 ;
		var total = parseFloat(hrs) * parseFloat(price);
		$('#total').val(total)
		calc_total()

	}
	function calc_total(){
		var gtotal = 0;
		var ptotal = 0;
		var stotal = 0;
		var court_price = $('#court_price').val();
			court_price = court_price > 0 ? parseFloat(court_price) : 0; 
			gtotal += court_price
		$('#gtotal').text(parseFloat(gtotal).toLocaleString('en-US',{ style:'decimal', minimumFractionDigits:2, maximumFractionDigits:2}))

	}
	$(document).ready(function(){
		$('#court_id').select2({
			placeholder:"Please Select Court Here",
			width:"100%",
			containerCssClass:'form-control form-control-sm rounded-0'
		})
		
		$('#datetime_start, #hours').on('input change',function(){
			get_dt_end()
			get_hour_total()
		})
		$('#court_id').change(function(){
			var id = $(this).val()
			var price = $('#court_id option[value="'+id+'"]').attr('data-price')
			$('#court_price').val(price)
			get_hour_total()
		})
		$('#court_rental-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_court_rental<?php echo isset($id) ? '&id='.$id : '' ?>",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=court_rentals/view_court_rental&id="+resp.crid
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body, .modal").scrollTop(0)
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

	})
</script>