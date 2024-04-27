<?php if ($_settings->chk_flashdata('success')) : ?>

    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary shadow-lg p-3 mb-5 bg-white rounded" style="background-color: #007BFF;">
    <div class="card-header" style="background-color: #0056b3;">
        <h3 class="card-title text-white">Confirm Reservation</h3>
    </div>
    <div class="card bg-light shadow-inner" style="background-color: #e1f5fe;">        
        <h2 class="card-title text-center mb-4 pt-4" style="color: #01579b;">Booking Confirmation</h2>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-primary">Client Name:</h5>
                    <p id="client_fullname"></p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-primary">Court Name:</h5>
                    <p id="court_name"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-primary">Start Time:</h5>
                    <p id="datetime_start"></p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-primary">Hours:</h5>
                    <p id="hours"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-primary">Total:</h5>
                    <p id="total"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-danger btn-block">Cancel</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success btn-block" onclick = "bookReservation()">Book</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var court_id = null;
var court_name = null
var datetime_start = null;
var datetime_end = null;
var hours = null;
var client_id = null;
var client_fullname = null;
var ref_number = null;
var court_price = null;
var total = null;
var status = 1;
var data = [];

window.onload = function() {
    if('<?php echo $_POST['court_id'] ?>' != ''){
        court_id = <?php echo $_POST['court_id'] ?>;
        datetime_start = '<?php echo $_POST['datetime_start'] ?>';
        datetime_end = '<?php echo $_POST['datetime_end'] ?>';
        hours = <?php echo $_POST['hours'] ?>;
        client_id = <?php echo $_POST['client_id'] ?>;
        court_price = <?php echo $_POST['court_price'] ?>;
        total = <?php echo $_POST['total'] ?>;
        ref_number = '<?php echo $_POST['ref_number'] ?>';
        status = <?php echo $_POST['status'] ?>;
    }
    <?php
    $client_id = $_POST['client_id'];
    $client_qry = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as name FROM `clients_list` WHERE id = $client_id");
    if ($client_qry->num_rows > 0) {
        $client_name = $client_qry->fetch_assoc()['name'];
    }
    ?>
    client_fullname = '<?php echo $client_name ?>';
    <?php
    $court_id = $_POST['court_id'];
    $qry = $conn->query("SELECT name FROM `court_list` WHERE id = $court_id");    
    if ($qry->num_rows > 0) {
        $court_name = $qry->fetch_assoc()['name'];
    }
    ?>
    court_name = '<?php echo $court_name ?>';
    $('#client_fullname').html(client_fullname);
    $('#court_name').html(court_name);
    $('#datetime_start').html(datetime_start);
    $('#hours').html(hours);
    $('#total').html(total);

}

function bookReservation() {
    var url = "<?php echo base_url ?>classes/Master.php?f=save_court_rental";
    var data = {
        'court_id': court_id,
        'client_id': client_id,
        'datetime_start': datetime_start,
        'datetime_end': datetime_end,
        'hours': hours,
        'ref_number': ref_number,
        'court_price': court_price,
        'total': total,
        'status': status
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Booking successful!');
            location.href = "./?page=court_rentals/view_court_rental&id=" + resp
                        .crid
        } else {
            alert('Booking failed: ' + data.message);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('An error occurred while booking.');
    });
}
</script>

<style>

</style>
