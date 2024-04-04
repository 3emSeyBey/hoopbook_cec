
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-th-list"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Courts</span>
          <span class="info-box-number text-right">
            <?php 
              $court = $conn->query("SELECT * FROM court_list where `delete_flag` = 0 and `status` = 1")->num_rows;
              echo format_num($court);
            ?>
            <?php ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>


    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Clients</span>
                <span class="info-box-number text-right">
                  <?php 
                    $mechanics = $conn->query("SELECT sum(id) as total FROM `client_list` where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($mechanics);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
    </div>



  
    <!-- /.col -->
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-coins"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Today's Total Rentals</span>
          <span class="info-box-number text-right">
            <?php 
              $court = $conn->query("SELECT COALESCE(SUM(total),0) FROM court_rentals where date(date_created) = '".(date("Y-m-d"))."' ")->fetch_array()[0];
              echo format_num($court);
            ?>
            <?php ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="info-box">
              <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-tasks"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Bookings</span>
                <span class="info-box-number text-right">
                <?php 
                    echo              2
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
    </div>



</div>
