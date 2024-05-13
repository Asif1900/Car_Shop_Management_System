<?php


//include_once '../../Navigation_Links.php';
global $routes, $backend_routes;
require '../../routes.php';



session_start();

$login_page =$routes['login'];

$seller_signupController_file = $backend_routes['seller_signup_controller'];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car - Dealers - Signup</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/error_css.css">

    <style>

        body {
            transform: scale(0.70); /* Scale the entire body */
            transform-origin: top center; /* Set the scaling origin to the top center */
            overflow-y: hidden;
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }
        .card-registration .select-arrow {
            top: 13px;
        }

        .bg-indigo {
            background-color: #424242;
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
            var name = document.getElementById("seller_signup_name").value;
            var email = document.getElementById("seller_signup_email").value;
            var password = document.getElementById("seller_signup_password").value;
            var phone = document.getElementById("seller_signup_phone").value;
            var termsAccepted = document.getElementById("terms").checked;

            // Validate name
            if (name === "" || name === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Name is Required");
                return false;
            }

            if (email === "" || email === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Email is Required");
                return false;
            }

            if(!validateEmail(email)){
                showModal("Provide email in a proper format");
                return false;
            }

            if (password === "" || password === null) {
                // Display error message
                showModal("Password is Required");
                return false;
            }

            if (phone === "" || phone === null) {
                // Display error message
                showModal("Phone is Required");
                return false;
            }

            if (!/^\d+$/.test(phone)) {
                showModal("Phone must contain only numbers");
                return false;
            }
            if (!termsAccepted) {
                showModal("Please accept the terms and conditions");
                return false;
            }

            return true; // Return true if all validations pass
        }

        // Attach the validation function to the form's onsubmit event
        document.getElementById("seller_signup_form").onsubmit = function () {
            return validateForm();
        };

    </script>



</head>
<body>



<!-- Validation Modal -->
<div id="validationModal" style="display: none; position: fixed; top: 10px; right: 10px; width: 40%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <span id="close_button" aria-hidden="true" onclick="close_modal();">&times;</span>
    <div style="position: absolute; top: 0; right: 0;">
        <p style="cursor: pointer; font-size: 30px;" class="close" data-dismiss="alert" aria-label="Close" >
        </p>
    </div>
    <p id="validationMessage"></p>
</div>



<section class="vh-100" >
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black mt-5" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form action="<?php echo $seller_signupController_file; ?>" class="mx-1 mx-md-4" id="seller_signup_form" method="post" onsubmit="return validateForm();">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <input type="text" name="seller_signup_name" id="seller_signup_name" class="form-control" />
                                            <label class="form-label" for="seller_signup_name">Your Name</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <input type="email" id="seller_signup_email" name="seller_signup_email" class="form-control" />
                                            <label class="form-label" for="seller_signup_email">Your Email</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <input type="password" id="seller_signup_password" name="seller_signup_password" class="form-control" />
                                            <label class="form-label" for="seller_signup_password">Password</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <input type="text" id="seller_signup_phone" name="seller_signup_phone" class="form-control" />
                                            <label class="form-label" for="seller_signup_phone">Phone</label>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="terms" />
                                        <label class="form-check-label" for="form2Example3c">
                                            I agree all statements in
                                            <a href="/Car_Shop_Management_System/view/static/pdf/Online_Car_Shop_Management_System__Terms___Conditions.pdf"
                                               target="_blank">Terms of service</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="/Car_Shop_Management_System/view/static/image/seller.jpg"
                                     class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>