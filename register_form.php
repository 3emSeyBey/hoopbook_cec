<?php require_once('./config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Basketball Reservation System</title>
    <link rel="stylesheet" href="register_style.css">
    <!-- Modal -->

</head>

<body>
    <div class="wrapper" id="wrapper-register">
        <div class="form-box register">
            <form id="register-form" action="./classes/Login.php?f=register" method="post">
                <div class="banner">
                    <h1>HOOP<span>BOOK</h1>
                </div>
                <div class="input-box animation">
                    <input type="text" name="firstname" id="firstname" autocomplete="off" required>
                    <label>First Name</label>
                </div>

                <div class="input-box animation">
                    <input type="text" name="lastname" id="lastname" autocomplete="off" required>
                    <label>Last Name</label>
                </div>

                <div class="input-box animation">
                    <input type="text" name="contact" id="contact" min="0" max="999999999999" required>
                    <label>Contact #</label>
                </div>

                <div class="input-box animation" style="display: none;">
                    <input type="text" name="address" id="address" required>
                    <label>Address</label>
                </div>

                <div class="input-box animation">
                    <input type="email" name="email" id="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box animation">
                    <input type="password" name="password" id="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box animation">
                    <input type="password" name="cpassword" id="cpassword" required>
                    <label>Confirm Password</label>
                </div>

                <button type="submit" class="btn animation" name="submit-btn" id="myBtn">Sign Up</button>
                <div class="logreg-link animation">
                    <p>Already have an account? <a href="<?php echo base_url . 'login_form.php' ?>" class="">Login</a>
                    </p>
                </div>
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Enter OTP</h2>
                        </div>
                        <div class="modal-body">
                            <p>We have sent a 6-digit OTP to your email. Please enter it below:<br>Note: If the email is
                                not in your inbox, please check it on the spam<br>Email may take up to 5 minutes to
                                arrive.</p>
                            <input class="modalInput" type="text" id="otp" name="otp" placeholder="Enter OTP" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submit-btn" class="btn btn-primary modalBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
document.getElementById('myBtn').addEventListener('click', function(event) {
    event.preventDefault();
    generateAndSendCode();
});

document.getElementById('submit-btn').addEventListener('click', function(event) {
    event.preventDefault();
    submit();
});
async function submit() {
    const enteredOtp = document.getElementById('otp').value;
    const savedOtp = localStorage.getItem('code');

    if (enteredOtp !== savedOtp) {
        alert('Incorrect OTP. Please try again.');
    } else {
        // Submit the form
        document.getElementById('register-form').submit();
    }
}
async function generateAndSendCode() {
    const email = document.getElementById('email').value;
    // Generate a random 6-digit number
    const code = Math.floor(100000 + Math.random() * 900000);

    // Save the code to local storage
    localStorage.setItem('code', code);

    // Send the code to the email
    await sendCodeToEmail(code, email);

    // Show the modal
    document.getElementById('modal').style.display = 'block';
}

async function sendCodeToEmail(code, email) {
    // const url = 'https://rapidmail.p.rapidapi.com/';
    // const options = {
    //     method: 'POST',
    //     headers: {
    //         'content-type': 'application/json',
    //         'X-RapidAPI-Key': '3e7b41810dmsh36643b0730bb46fp1ab16bjsnf465416451bc',
    //         'X-RapidAPI-Host': 'rapidmail.p.rapidapi.com'
    //     },
    //     body: JSON.stringify({
    //         ishtml: 'false',
    //         sendto: email,
    //         name: 'HoopBook Reservation System - Dev',
    //         replyTo: 'cechoopbookreservation24@gmail.com',
    //         title: 'Here is your verification code!',
    //         body: `Your verification code is: ${code}`
    //     })
    // };

    // try {
    //     const response = await fetch(url, options);
    //     const result = await response.text();
    //     console.log(result);
    // } catch (error) {
    //     console.error(error);
    // }

    // For now, we'll just log the code to the console
    // Uncomment above to test sending the email
    console.log(`Your verification code is: ${code}`);
}
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<Style>
@import url('https://fonts.googleapis.com/css2?family=Poppons:wght@300;400;500;600;700;800;900&display=swap');

.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
}

/* Modal Body */
.modal-body {
    padding: 2px 16px;
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    transform: translateY(-50%);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    animation-name: animatetop;
    animation-duration: 0.4s;
}

.modalInput {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
}

.modalBtn {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

.modalBtn:hover {
    background-color: #45a049;
}

/* Add Animation */
@keyframes animatetop {
    from {
        top: -300px;
        opacity: 0
    }

    to {
        top: 0;
        opacity: 1
    }
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #0080FF;
}

.wrapper {
    position: relative;
    width: 450px;
    height: 25rem;
    background: #fff;
    border: 1px solid #191b1d;
    box-shadow: 0 0 10px #191b1d;
    border-radius: 5px;

}


.close {
    position: absolute;
    top: 5px;
    float: right;
    right: 5px;
    text-decoration: none;
    font-size: 20px;
    background: #000;
    height: 30px;
    width: 30px;
    border-radius: 50%;
    z-index: 10;
    cursor: pointer;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.3s ease;
    opacity: 0.5;
}

.close:hover {
    opacity: 1;
}

.banner {
    position: relative;
    height: 100px;
    background: red;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.banner::after {
    content: "";
    background-color: rgba(0, 0, 0, 0.2);
    position: absolute;
    width: 100%;
    height: 100%;
}

.form-box h1 {
    font-size: 50px;
    color: #0D1847;
    font-family: sans-serif;


}

.form-box span {
    background: #0D1847;
    color: #F5AF43;
    padding: 10px 20px;
    font-family: sans-serif;

}

#wrapper-register {
    position: relative;
    width: 470px;
    height: 40rem;
    background: #fff;
    border: 1px solid #191b1d;
    box-shadow: 0 0 10px #191b1d;
    border-radius: 5px;

}

.wrapper .form-box {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.wrapper .form-box.login {
    left: 0;
    padding: 0 50px 0 50px;
}

.wrapper .form-box.login .animation {
    transform: translateX(0);
    opacity: 1;
    filter: blur(0);
    transition: .9s ease;

}

.wrapper .form-box.register {
    left: 0;
    padding: 0 50px 0 50px;
}


.wrapper .form-box.register .animation {
    transform: translateX(0);
    opacity: 1;
    filter: blur(0);
    transition: .9s ease;

}

.form-box .input-box {
    position: relative;
    width: 100%;
    height: 40px;
    margin: 20px 0;
}

.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border-bottom: 2px solid #000;
    padding-right: 23px;
    font-size: 16px;
    color: #000;
    font-weight: 500;
    transition: .5s;
}

.input-box input:focus,
.input-box input:valid {
    border-bottom-color: #0080FF;
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    font-size: 16px;
    color: #000;
    pointer-events: none;
    transition: .5s;
}

.input-box input:focus~label,
.input-box input:valid~label {
    top: -5px;
    color: #000;
    margin-left: 5px;
    font-size: 13px;

}


.btn {
    position: relative;
    width: 100%;
    height: 45px;
    background: transparent;
    border: 2px solid #052840;
    outline: none;
    border-radius: 40px;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    font-weight: 600;
    z-index: 1;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: -100%;
    left: 0;
    width: 100%;
    height: 300%;
    background: linear-gradient(#081b29, #0080FF, #081b29, #000);
    z-index: -1;
    transition: .5s;
}

.btn:hover::before {
    top: 0;
}

.form-box .logreg-link {
    font-size: 14.5px;
    color: #000;
    text-align: center;
    margin: 20px 0 10px;
}

.logreg-link p a {
    color: #6495ed;
    text-decoration: none;
    font-weight: 800;
    margin-left: 10px;
    letter-spacing: 1px;

}


.logreg-link p a:hover {
    text-decoration: underline;
}
</Style>

</html>