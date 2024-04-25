<?php if ($_settings->chk_flashdata('success')) : ?>
    <?php
    // Check if court_id is provided in the GET parameters
    if (isset($_GET['court_id'])) {
        echo "<script>console.log('court_id is set');</script>";
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
    window.onload = function() {
        var table = document.getElementById('time-slot-table');

        var headerRow = document.createElement('tr');

        var header1 = document.createElement('th');
        header1.textContent = 'Time Slot';
        headerRow.appendChild(header1);

        var header2 = document.createElement('th');
        header2.textContent = 'Book';
        headerRow.appendChild(header2);

        table.appendChild(headerRow);

        for (var i = 0; i < 24; i++) {
            var row = document.createElement('tr');

            var cell1 = document.createElement('td');
            cell1.textContent = (i < 10 ? '0' : '') + i + ':00 - ' + ((i + 1) < 10 ? '0' : '') + ((i + 1) % 24) + ':00';
            row.appendChild(cell1);

            var cell2 = document.createElement('td');
            var checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'time_slot_' + i;
            cell2.appendChild(checkbox);
            row.appendChild(cell2);

            table.appendChild(row);
        }

        var button = document.getElementById('book-button');
        button.textContent = 'Book';
    }
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