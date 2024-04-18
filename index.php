<?php require_once('./config.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scroll Website</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
  </head>
  <body>
    <!-- Navbar Section -->
    <nav class="navbar">
      <div class="navbar__container">
        <figure id="navbar__logo">
          <a href="#home" id="navbar__logo"
            ><img src="image/comp-logo.png" alt="logo"
          /></a>
        </figure>
        <div class="navbar__toggle" id="mobile-menu">
          <span class="bar"></span> <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <ul class="navbar__menu">
          <li class="navbar__item">
            <a href="#home" class="navbar__links" id="home-page">Home</a>
          </li>
          <li class="navbar__item">
            <a href="#about" class="navbar__links" id="about-page">About</a>
          </li>
          <li class="navbar__item">
            <a href="#services" class="navbar__links" id="services-page"
              >Services</a
            >
          </li>
          <li class="navbar__btn">
            <a href="<?php echo base_url.'login_form.php' ?>" class="button" id="signup">Sign In</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero" id="home">
      <div class="hero__container">
        <div class="anim animate__bounceInRight">
          <h1 class="hero__heading">
            Basketball Bliss <span>Begins Here</span>
          </h1>
          <p class="hero__description">Book Your Court Today!</p>
        </div>
        <button class="main__btn"><a href="<?php echo base_url.'login_form.php' ?>">Reserved Now!</a></button>
      </div>
    </div>

    <div class="main" id="about">
      <div class="main__container">
        <div class="main__img--container">
          <div class="main__img--card"><img src="images/thumb-image1.png" alt="Thumbnail"></div>
        </div>
        <div class="main__content">
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
          </section>
        </div>
      </div>
    </div>

    <div class="services" id="services">
      <h1>Our Facilities</h1>
      <div class="services__wrapper">
        <div class="services__card">
          <h2>Indoor Courts</h2>
          <p>Play basketball indoors on our high-quality courts</p>
        </div>
        <div class="services__card">
          <h2>Outdoor Courts</h2>
          <p>Enjoy the fresh air and play basketball outdoors</p>
        </div>
      </div>
    </div>

    <!-- Footer Section -->
    <div class="footer__container">
      <section class="social__media">
        <div class="social__media--wrap">
          <div class="footer__logo">
            <a href="/" id="footer__logo"
              ><img src="image/comp-logo.PNG" alt="logo" srcset=""
            /></a>
          </div>
          <p class="website__rights">© COLOR 2020. All rights reserved</p>
          <div class="social__icons">
            <a href="/" class="social__icon--link" target="_blank"
              ><i class="fab fa-facebook"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-instagram"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-youtube"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-linkedin"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-twitter"></i
            ></a>
          </div>
        </div>
      </section>
    </div>

    <script src="app.js"></script>
  </body>
</html>
