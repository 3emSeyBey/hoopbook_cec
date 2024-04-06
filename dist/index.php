<?php require_once('./config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Basketball Court Reservation System</title>
    <link rel="stylesheet" href="css/style.css">
<Style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;    
}
body{
    background: darkred;
}
.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

}

.blink {
    animation: blinker 1.5s linear infinite;
    color: red;
    font-size: 1.5em;
    /* Larger, responsive font size */
    margin-bottom: 20px;
}

@keyframes blinker {
    50% {
        opacity: 0;
    }
}


/* .container a,h1{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
} */
.container h1{
    font-size: 100px;
    color: #0D1847;
    font-family: sans-serif;
}
.container span{
    background: #0D1847;
    color: #F5AF43;
    padding: 10px 20px;
    font-family: sans-serif;
}
.container a{
    font-size: 50px;
    text-decoration: none;
    background: #F5AF43;
    height: 50px;
    width: 100px;
    padding: 5px 20px;
    border-radius: 5px;
}



</Style>
</head>
<body>

    <div class="container">
            <h1>HOOP<span>BOOK</span><h1>
            <a class="blink" href="<?php echo base_url.'login_form.php' ?>">Reserved Now!</a>
    </div>
 
</body>
</html>
