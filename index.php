<?php require_once('./config.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Basketball Court Reservation System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="js/animate.min.css">
</head>

<body>
    <div class="main-con">
        <div class="wrapper">
            <div class="main-holder">
                <section>
                    <img src="images/comp-logo.png" alt="Hoop Book">
                    <!-- <a href="javascript:;">RESERVED NOW!</a> -->
                    <a class="blink" href="<?php echo base_url.'login_form.php' ?>">RESERVED NOW!</a>
                    <!-- <a class="blink" href="">Reserved Now!</a> -->
                </section>
                <section>
                    <p>Welcome to <span class="comp-name">Hoop Book</span> Reservation platform! Here, we provide a
                        seamless and
                        convenient
                        way
                        for
                        basketball enthusiasts to book their preferred court time slots. Our user-friendly website
                        ensures a
                        hassle-free experience, allowing you to easily find and reserve courts near you. Whether you're
                        a
                        professional player, an amateur, or just looking to have fun with friends, we've got you
                        covered.
                        Join
                        our community today and enjoy the thrill of the game on your preferred court!</p>
                    <img src="images/thumb-image1.png" alt="Thumbnail">
                </section>
            </div>
        </div>
    </div>
</body>

</html>