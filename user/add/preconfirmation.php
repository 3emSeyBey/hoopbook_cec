<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary" style="background-color: #0080ff;">
    <div class="card-header">
        <h3 class="card-title" style="color: white">Confirm Reservation</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid mx-auto d-block">
            <div class="tab-pane fade show active d-flex flex-column justify-content-center align-items-center" id="tab1" style="height: 100%;">
                <h4 class="mb-4">Choose Payment Method</h4>
                <form class="w-50 mx-auto d-block">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentOption" id="cash" value="cash">
                        <label class="form-check-label" for="cash">
                            Cash
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentOption" id="gcash" value="gcash">
                        <label class="form-check-label" for="gcash">
                            GCash
                        </label>
                    </div>
                </form>
                <button class="btn btn-primary next-tab mt-auto mx-auto d-block">Next</button>
            </div>
            <div class="tab-pane fade d-flex flex-column justify-content-center align-items-center" id="tab2">
                <h4 class="mb-4">Pay With GCash</h4>
                <img src="<?php echo base_url ?>user/add/gcash.png" alt="Payment Image" class="img-fluid rounded mb-4" style="max-width: 80%;">
                <div class="w-50">
                    <label for="referenceNumber" class="form-label">Reference Number</label>
                    <input type="text" class="form-control mb-3" id="referenceNumber" placeholder="Enter your reference number here">
                    <button class="btn btn-primary w-100">Proceed</button>
                </div>
                <div class="mt-auto">
                    <button class="btn btn-primary prev-tab">Previous</button>
                    <button class="btn btn-primary next-tab">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var court_id = null;
var datetime_start = null;
var datetime_end = null;
var hours = null;
var client_id = null;
var ref_number = null;
var court_price = null;
var total = null;
var status = 1;
var data = [];

window.onload = function() {
    court_id = <?php echo $_POST['court_id'] ?>;
    datetime_start = '<?php echo $_POST['datetime_start'] ?>';
    datetime_end = '<?php echo $_POST['datetime_end'] ?>';
    hours = <?php echo $_POST['hours'] ?>;
    <?php
    $account_id = $_settings->userdata('id');
    $client_qry = $conn->query("SELECT id FROM `clients_list` WHERE account_id = $account_id");
    if ($client_qry->num_rows > 0) {
        $client_id = $client_qry->fetch_assoc()['id'];
    }
    ?>
    client_id = <?php echo $client_id ?>;
    ref_number = generateReferenceNumber(client_id, datetime_start, hours);
    <?php
    $court_id = $_POST['court_id'];
    $court_qry = $conn->query("SELECT price FROM `court_list` WHERE id = $court_id");
    if ($court_qry->num_rows > 0) {
        $court_price = $court_qry->fetch_assoc()['price'];
    }
    ?>
    court_price = <?php echo $court_price ?>;
    total = court_price * hours;
    data = {
        court_id: court_id,
        datetime_start: datetime_start,
        datetime_end: datetime_end,
        hours: hours,
        client_id: client_id,
        ref_number: ref_number,
        court_price: court_price,
        total: total,
        status: status
    };
    var tabs = ['#tab1', '#tab2', '#tab3'];
    var currentTab = 0;
    var previousTab = 0;

    $('.next-tab').click(function() {
        if (currentTab === 0) {
            if ($('#gcash').is(':checked')) {
                $(tabs[currentTab]).css('marginTop', '-200px').removeClass('show active');
                previousTab = currentTab;
                currentTab = 1;
            }
            else{
                confirmBooking();
                return;
            }
        } else {
            confirmBooking();
            return;
        }
        $(tabs[currentTab]).slideDown().addClass('show active');
    });

    $('.prev-tab').click(function() {
        $(tabs[currentTab]).slideUp().removeClass('show active');
        currentTab = previousTab;
        $(tabs[currentTab]).slideDown().css('marginTop', '200px').addClass('show active');
    });
}

function confirmBooking(){
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = "<?php echo base_url ?>user/?page=add/confirmBooking"

    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            var hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = key;
            hiddenField.value = data[key];

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

function generateReferenceNumber(id, startDate, hours) {
    // generate reference in this format HB{client_id}-{startMonth}{startDay}{hours}_{randomString}
    var date = new Date(startDate);
    var startMonth = String(date.getMonth() + 1).padStart(2, '0');
    var startDay = String(date.getDate()).padStart(2, '0');
    hours = String(hours).padStart(2, '0');
    var randomString = Math.random().toString(36).substring(2, 6).toUpperCase();
    return "HB" + id + "-" + startMonth + startDay + hours + "_" + randomString;
}
</script>

<style>
.payment-option {
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-option.selected {
    border: 2px solid green;
    box-shadow: 0 0 10px rgba(0, 128, 0, 0.5);
}

#tab1 {
    background-color: #f8f9fa;
    border-radius: 5px;
    padding: 20px;
}

#tab1 .form-check-input {
    height: 25px;
    width: 25px;
}

#tab1 .form-check-label {
    font-size: 18px;
    margin-left: 10px;
}

#tab1 .next-tab {
    width: 100%;
    font-size: 18px;
    padding: 10px;
}
</style>
