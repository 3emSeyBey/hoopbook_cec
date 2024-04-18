<?php if($_settings->chk_flashdata('success')): ?>
<?php
    // Check if court_id is provided in the GET parameters
    if (isset($_GET['court_id'])) {
        echo "asd";
        $court_id = $_GET['court_id'];

        // Run the query
        $stmt = $db->prepare('SELECT * FROM court_rentals WHERE court_id = ?');
        $stmt->execute([$court_id]);

        // Fetch all the reservations
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convert the reservations to a JSON string
        $reservations_json = json_encode($reservations);
    }
?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary" style="background-color: #0080ff;">
    <div class="card-header">
        <h3 class="card-title" style = "color: white">Book Reservation</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <!-- Start Content Here -->
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
                    $reservations = $stmt->get_result()->fetch_assoc();
                }

            ?>
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
            <!-- End Content -->
        </div>
    </div>
</div>
<script>
</script>