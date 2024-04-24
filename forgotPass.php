<?php require_once('./config.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $id = '';

    // Check if reCAPTCHA response is set and not empty
    if (!empty($_POST['g-recaptcha-response'])) {
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        $secretKey = '6LdCJ8YpAAAAAEaXnvr5RBfIikQcATIsP-C7D7-Z';
        $response = verifyRecaptcha($recaptchaResponse, $secretKey);

        // Decode JSON data
        if ($response && $response->success) {
            // Recaptcha validated successfully
            $stmt = $conn->prepare("SELECT * FROM `accounts` WHERE `email` = ? AND `status` = 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $id = $result->fetch_assoc()['id'] ?? '';
            if ($result->num_rows > 0) {
                // Email exists
                echo json_encode(['message' => 'Email exists.', 'id' => $id]);
            } else {
                // Email does not exist
                echo json_encode(['message' => 'Email does not exist.']);
            }
        } else {
            // Recaptcha validation failed
            echo 'Robot verification failed, please try again.';
        }
    } else {
        // Recaptcha response not set
        echo 'Please check the reCAPTCHA box.';
    }
    exit();
}

function verifyRecaptcha($recaptchaResponse, $secretKey)
{
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaResponse
    ];

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $verifyResponse = curl_exec($ch);
    curl_close($ch);
    return json_decode($verifyResponse);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Basketball Reservation System</title>
    <link rel="stylesheet" href="register_style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper" id="wrapper-register">
        <div class="form-box register">
            <form id="register-form" action="" method="post" onsubmit="return validateForm()">
                <div class="banner">
                    <h1>HOOP<span>BOOK</span></h1>
                </div>
                <p>We will send a verification code on your email to verify your identity. Please enter your email
                    and answer the captcha to proceed with the password recovery process. </p>
                <div class="input-box animation">
                    <input type="email" name="email" id="email" required>
                    <label>Email:</label>
                </div>

                <div class="form-group">
                    <!-- Google reCAPTCHA block -->
                    <div class="g-recaptcha" data-sitekey="6LdCJ8YpAAAAAL9v_j8BVvYzt9PeITKequ5J4Wo9"></div>
                </div>
                <br>
                <button type="submit" class="btn animation" name="submit-btn" id="myBtn">Send Verification</button>
            </form>
        </div>
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
    <div id="myModal2" class="modal2" style="display: none;">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close2">&times;</span>
                <h2>Reset Password</h2>
            </div>
            <form id="reset-form">
                <div class="modal-body">
                    <p>Please enter your new password and confirm it:</p>

                    <input class="submitId" type="hidden" id="id" name="id" value="">
                    <input class="modalInput" type="password" id="password" name="password"
                        placeholder="Enter new password" required>
                    <input class="modalInput" type="password" id="confirm_password" name="confirm_password"
                        placeholder="Confirm new password" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit-btn2" class="btn btn-primary modalBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {
    $("#register-form").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            url: 'forgotPass.php',
            type: 'post',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                if (data.message.includes('Email exists.')) {
                    localStorage.setItem('id', data.id);
                    generateAndSendCode();
                    document.getElementById("myModal").style.display = "block";
                } else {
                    alert(data.message);
                }
            }
        });
    });

    $("#reset-form").on("submit", function(e) {
        $('.submitId').val(localStorage.getItem('id'));
        e.preventDefault();
        $.ajax({
            url: 'ChangePassword.php',
            type: 'post',
            data: $(this).serialize(),
            success: function(response) {
                if (response == 1) {
                    alert(response);
                } else {
                    alert(response);
                    location.reload();
                }
            }
        });
    });
});

function validateForm() {
    var email = document.getElementById('email').value;
    if (email == "") {
        alert("Email must be filled out");
        return false;
    }
    var response = grecaptcha.getResponse();
    if (response.length == 0) {
        return false;
    }
    return true;
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

document.getElementById('submit-btn').addEventListener('click', function(event) {
    next();
});

async function next() {
    const enteredOtp = document.getElementById('otp').value;
    const savedOtp = localStorage.getItem('code');

    if (enteredOtp !== savedOtp) {
        alert('Incorrect OTP. Please try again.');
    } else {
        // Submit the form
        document.getElementById('myModal').style.display = 'none';
        document.getElementById('myModal2').style.display = 'block';
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
    // method: 'POST',
    // headers: {
    // 'content-type': 'application/json',
    // 'X-RapidAPI-Key': '3e7b41810dmsh36643b0730bb46fp1ab16bjsnf465416451bc',
    // 'X-RapidAPI-Host': 'rapidmail.p.rapidapi.com'
    // },
    // body: JSON.stringify({
    // ishtml: 'false',
    // sendto: email,
    // name: 'HoopBook Reservation System - Dev',
    // replyTo: 'cechoopbookreservation24@gmail.com',
    // title: 'Here is your verification code!',
    // body: `Your verification code is: ${code}`
    // })
    // };

    // try {
    // const response = await fetch(url, options);
    // const result = await response.text();
    // console.log(result);
    // } catch (error) {
    // console.error(error);
    // }

    // For now, we'll just log the code to the console
    // Uncomment above to test sending the email
    console.log(`Your verification code is: ${code}`);
}
// Get the modal
var modal = document.getElementById("myModal");
var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

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

.modal2 {
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
    height: 30rem;
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