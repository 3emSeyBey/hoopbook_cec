<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<style>
    .blue-card {
    background-color: blue; /* Or any other color you want */
}
</style>

<?php endif;?>
<div class="card card-outline card-primary" style="background-color: #0080ff;">
    <div class="card-header" style="border-bottom: 1px solid white; margin-left: 20px; margin-right: 20px; ">
        <h3 class="card-title" style = "color: white">Select Courts</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid" style ="cursor: pointer;">
            <!-- Start Content Here -->
            <div class="row">
            <?php 
            $qry = $conn->query("SELECT * FROM `court_list`");
            while($row = $qry->fetch_assoc()):
            ?>
                <div class="col-md-4">
                    <div class="card court-card" data-id = "<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-price="<?php echo $row['price'] ?>" data-img="<?php echo $row['img_src'] ?>">
                        <img src="<?php echo $row['img_src'] ?>" class="card-img-top" alt="Court Image" onerror="this.onerror=null; this.src='../image/comp-logo.PNG';" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name'] ?></h5>
                            <p class="card-text"><?php echo $row['price'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
            <!-- End Content -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.court-card').click(function() {
            var court_id = $(this).data('id');
            window.location.href = "<?php echo base_url ?>user/?page=add/selectDate&court_id=" + court_id;
        });
    });
</script>