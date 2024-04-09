<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/headerr.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
<div class="wrapper">
        <a class="close" href="<?php echo base_url.'index.php' ?>">X</a>
        <div class="form-box login">
            <div class="banners">
                <h1>HOOP<span>BOOK</h1>
            </div> 
            <form id="login-frm" action="#" method="post">
                <div class="input-box animation">
                    <input type="text" name="username"autocomplete="off" required>
                    <label>Username</label>
                </div>
                <div class="input-box animation">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn animation">Login</button>
                <div class="logreg-link animation">
              
              <a href="<?php echo base_url.'index.php' ?>">Go to Website</a>
            </div>
            </form>
           
        </div>

    </div>

<!-- jQuery -->
<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url ?>dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>