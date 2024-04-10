<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Clients</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <!-- Start Content Here -->
            <p>Content for Booking Reservations</p>
            <!-- End Content -->
        </div>
    </div>
</div>