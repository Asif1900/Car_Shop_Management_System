<?php

global $routes, $backend_routes;
//include_once '../Navigation_Links.php';
require '../routes.php';

//echo '<h1>'.login_page().'</h1>'

$loginController_file = $backend_routes['login_controller'];
$signup_decider = $routes['signup_decider'];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car - Dealers -> Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/error_css.css">

    <style>

        body {
            transform: scale(0.71); /* Scale the entire body */
            transform-origin: top center; /* Set the scaling origin to the top center */
        }

    </style>

    <script>

        // Function to validate email format
        function validateEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Function to show modal with validation message
        function showModal(message) {
            document.getElementById("validationMessage").innerHTML = message;
            document.getElementById("validationModal").style.display = "block";
        }

        close_modal = () => {
            document.getElementById("validationModal").style.display = "none";
            // location.reload(true);
        }



        function validateForm() {
            var email = document.getElementById("login_email").value;
            var password = document.getElementById("login_password").value;
            // var emailErrorLabel = document.getElementById("loginEmailError");

            // Reset previous error messages
            // emailErrorLabel.innerHTML = "";

            // Validate email
            if (email === "" || email === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Email is Required");
                return false;
            }
            // You can add more email validation logic here if needed

            // Validate password

            if (password === "" || password === null) {
                // Display error message
                showModal("Password is Required");
                return false;
            }

            return true; // Return true if all validations pass
        }

        // Attach the validation function to the form's onsubmit event
        document.getElementById("login_form").onsubmit = function () {
            return validateForm();
        };

    </script>



</head>
<body>


<!-- Validation Modal -->
<div id="validationModal" style="display: none; position: fixed; top: 0; right: 0; width: 40%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <span id="close_button" aria-hidden="true" onclick="close_modal();">&times;</span>
    <div style="position: absolute; top: 0; right: 0;">
        <p style="cursor: pointer; font-size: 30px;" class="close" data-dismiss="alert" aria-label="Close" >
        </p>
    </div>
    <p id="validationMessage"></p>
</div>


<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your login and password!</p>

                            <form action="<?php echo $loginController_file; ?>" method="post" id="login_form" onsubmit="return validateForm();">
                                <div class="form-outline form-white mb-4" style="color: black;">
                                    <input type="email" name="email" id="login_email" class="form-control form-control-lg" style="background-color: white;"/>
                                    <label class="form-label " style="color: white;" for="login_email">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" id="login_password" class="form-control form-control-lg" style="color:#000;"/>
                                    <label class="form-label" for="login_password">Password</label>
                                </div>

<!--                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>-->

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                            </form>


                        </div>

                        <div>
                            <p class="mb-0">Don't have an account? <a href="<?php echo $signup_decider; ?>" class="text-white-50 fw-bold">Sign Up</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script src="js/index.js"></script>
</body>
</html>