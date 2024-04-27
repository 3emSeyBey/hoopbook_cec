<?php if ($_settings->chk_flashdata('success')) : ?>
    <?php
    // Check if court_id is provided in the GET parameters
    if (isset($_GET['court_id'])) {
        $court_id = $_GET['court_id'];
        // Prepare the query
        $stmt = $conn->prepare('SELECT * FROM court_rentals WHERE court_id = ?');
        $stmt->bind_param('i', $court_id);

        // Execute the query
        $stmt->execute();

        // Get the results
        $reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // Convert the reservations to a JSON string
        $reservations_json = json_encode($reservations);
    } else {
        echo "<script>console.log('court_id is not set');</script>";
    }
    ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary" style="background-color: #0080ff;">
    <div class="card-header">
        <h3 class="card-title" style="color: white">Book Reservation</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid d-flex">
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
            <div class="time-slots">
                <div id="table-container">
                    <table id="time-slot-table"></table>
                </div>
                <button id="book-button">Book</button>
            </div>
        </div>
    </div>
</div>
<script>
    var startDate = new Date();
    var numOfHours = 0;
    var endDate = new Date();
    window.onload = async function() {
        var table = document.getElementById('time-slot-table');

        var headerRow = document.createElement('tr');

        var header1 = document.createElement('th');
        header1.textContent = 'Time Slot';
        headerRow.appendChild(header1);

        var header2 = document.createElement('th');
        header2.textContent = 'Book';
        headerRow.appendChild(header2);

        table.appendChild(headerRow);

        for (var i = 12; i < 24; i++) {
            var row = document.createElement('tr');
            var cell1 = document.createElement('td');
            cell1.textContent = (i < 10 ? '0' : '') + i + ':00 - ' + ((i + 1) < 10 ? '0' : '') + ((i + 1) % 24) + ':00';
            row.appendChild(cell1);

            var cell2 = document.createElement('td');
            var checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'time_slot_' + i;
            checkbox.id = i; // Set the id of the checkbox
            cell2.appendChild(checkbox);
            row.appendChild(cell2);
            table.appendChild(row);
        }
        var button = document.getElementById('book-button');
        button.textContent = 'Book';
        document.querySelector('.time-slots').style.visibility = 'hidden';
        await renderCalendar();
    }

    function proceedToBooking() {
        if(verifyBooking()) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checked = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            checked.sort((a, b) => parseInt(a.id) - parseInt(b.id));
            var earliestTimeSlot = checked[0].id;
            var time = new Date();
            time.setHours(earliestTimeSlot, 0, 0, 0);
            var date_ = new Date(date);
            startDate = new Date(date_.getTime());
            startDate.setHours(time.getHours(), time.getMinutes(), time.getSeconds(), time.getMilliseconds());
            numOfHours = checked.length;
            endDate = new Date(startDate.getTime());
            endDate.setHours(endDate.getHours() + numOfHours);
            return true;
        }
    }

    function verifyBooking() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isAnyChecked) {
            alert('Please select at least one time slot.');
            return false
        }
        var table = document.getElementById('time-slot-table');
        var checkboxes = table.getElementsByTagName('input');
        var checked = [];

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checked.push(checkboxes[i]);
            }
        }

        checked.sort(function(a, b) {
            return parseInt(a.id) - parseInt(b.id);
        });

        for (var i = 1; i < checked.length; i++) {
            if (parseInt(checked[i].id) - parseInt(checked[i - 1].id) !== 1) {
                alert('Selected time slots must be consecutive. To book non-consecutive time slots, please make separate reservations.');
                return false;
            }
        }
        return true;
    }

    $(document).ready(function() {
        $('#book-button').click(function() {
            if(proceedToBooking()){
                var url = window.location.href;
                var court_id = url[url.length - 1];
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = "<?php echo base_url ?>user/?page=add/preconfirmation";

                var courtIdInput = document.createElement('input');
                courtIdInput.type = 'hidden';
                courtIdInput.name = 'court_id';
                courtIdInput.value = court_id;
                form.appendChild(courtIdInput);

                var startInput = document.createElement('input');
                startInput.type = 'hidden';
                startInput.name = 'datetime_start';
                startInput.value = startDate.toISOString();
                form.appendChild(startInput);

                var endInput = document.createElement('input');
                endInput.type = 'hidden';
                endInput.name = 'datetime_end';
                endInput.value = endDate.toISOString();
                form.appendChild(endInput);

                var hoursInput = document.createElement('input');
                hoursInput.type = 'hidden';
                hoursInput.name = 'hours';
                hoursInput.value = numOfHours;
                form.appendChild(hoursInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });
</script>

<style>
    .container-fluid.d-flex {
        display: flex;
        justify-content: space-between;
    }

    .calendar,
    .time-slots {
        flex: 1;
    }

    #table-container {
        height: 400px;
        overflow: auto;
        margin: 10px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }

    #time-slot-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background-color: #f8f8f8;
        border-radius: 10px;
    }

    #time-slot-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    #time-slot-table tr:nth-child(even) td:nth-child(odd) {
        background-color: #e8e8e8;
    }

    #time-slot-table tr:nth-child(even) td:nth-child(even) {
        background-color: #e8e8e8;
    }

    #time-slot-table tr:hover {
        background-color: #ddd;
    }

    #book-button {
        display: block;
        width: 100%;
        padding: 10px;
        margin: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    #book-button:hover {
        background-color: #45a049;
    }
</style>