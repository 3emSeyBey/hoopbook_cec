<?php 
if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM accounts where id ='{$_GET['id']}' ");
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
	$id = $meta['id'];
	$firstname = $meta['firstname'];
	$lastname = $meta['lastname'];
	$contact = $meta['contact'];
	$address = $meta['address'];
	$email = $meta['email'];
	$account_type = $meta['account_type'];
	$status = $meta['status'];
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="client-form">
				<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="form-group">
					<label for="firstname" class="control-label">First Name</label>
					<input name="firstname" id="firstname" type="text" class="form-control rounded-0" value="<?php echo isset($firstname) ? $firstname : ''; ?>" required>
				</div>
				<div class="form-group">
					<label for="lastname" class="control-label">Last Name</label>
					<input name="lastname" id="lastname" type="text" class="form-control rounded-0" value="<?php echo isset($lastname) ? $lastname : ''; ?>" required>
				</div>
				<div class="form-group">
					<label for="email" class="control-label">Email</label>
					<input name="email" id="email" type="email" class="form-control rounded-0" value="<?php echo isset($email) ? $email : ''; ?>" required>
				</div>
				<div class="form-group">
					<label for="password" class="control-label">Password</label>
					<div class="input-group">
						<input type="password" name="password" id="password" placeholder="" class="form-control">
						<div class="input-group-append border">
							<span class="input-group-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
						</div>
					</div>
					<small><em class="text-muted">If on update - fill only to update Staff's Password</em></small>
				</div>
				<?php if(isset($_GET['id'])): ?>
					<div class="form-group">
						<label for="status" class="control-label">Status</label>
						<select name="status" id="status" class="custom-select selevt">
							<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
							<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
						</select>
					</div>
				<?php endif; ?>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary rounded-0 mr-3" form="client-form">Save User Details</button>
					<a href="./?page=user/list" class="btn btn-sm btn-default border rounded-0" form="client-form"><i class="fa fa-angle-left"></i> Cancel</a>
				</div>
			</div>
		</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    
		}
	}
	$('#client-form').submit(function(e){
		e.preventDefault();
		start_loader()
		$.ajax({
				url:_base_url_+"classes/Users.php?f=save_user",
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
						location.href = "./?page=user/list";
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
	})

</script>