<?php


//include_once '../../Navigation_Links.php';

global $routes, $backend_routes, $image_routes;
require '../../routes.php';
require '../../model/CarRepo.php';

//echo '<h1>'.login_page().'</h1>'
session_start();

$Dashboard_page = $routes['seller_dashboard'];
$logout_controller = $backend_routes['logout_controller'];
$Login_page = $routes['login'];
$user_icon = $image_routes['user_icon'];

$Add_cars_page = $routes['seller_add_cars'];
$New_cars_List_page = $routes['seller_new_cars'];
$Used_cars_List_page = $routes['seller_used_cars'];
$Rented_cars_List_page = $routes['seller_rented_cars'];
$All_cars_List_page =  $routes['seller_all_cars'];
$Customer_Requests_List_page = $routes['seller_car_requests'];

$Edit_cars_controller_file = $backend_routes['seller_edit_car_controller'];




if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit_id'])) {
        $car_id = $_POST['edit_id'];
        $car = findCarByID($car_id);
        if ($car['brand'] != null) {
            $car_model = $car['model'];
            $car_brand = $car['brand'];
            $car_price = $car['original_price'];
        }
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car - Dealers -> Add Cars</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/dashboard_dropdown.css">
    <link rel="stylesheet" href="../css/health_card.css">

    <style>

        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
            background: #eeeded;
        }

        /* Custom CSS for responsiveness */
        .custom-container {
            padding: 0 15px; /* Adjust horizontal padding as needed */
            overflow-y: hidden;
        }

        /* Style for the drawer */
        .drawer {
            height: 100%;
            width: 250px; /* Adjust the width as needed */
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #e6ebe4; /* Change the background color as needed */
            padding-top: 60px; /* Adjust padding to avoid overlapping with the navbar */
            transition: 0.5s;
            margin-top: 59px;
        }

        .drawer a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #000; /* Change the text color as needed */
            display: block;
            transition: 0.3s;
        }

        .drawer a:hover {
            background-color: #ddd; /* Change the background color on hover */
        }

        :root, [data-bs-theme="light"] {
            @media (min-width: 768px) {
                .offset-md-3 {
                    margin-left: 22%;
                }
            }
        }

        .rotate-text {
            display: inline-block;
            transform: rotate(60deg);
            color: red;
        }
        :root,
        [data-bs-theme="light"] {
            .mb-4 {
                margin-bottom: 0.5rem !important;
            }
        }




    </style>


    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("avatarDropdown");
            dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
        }

        function toggleDrawer() {
            var drawer = document.getElementById("myDrawer");
            drawer.style.width = drawer.style.width === "250px" ? "0" : "250px";
            var content = document.getElementById("mainContent");
            content.style.marginLeft = content.style.marginLeft === "250px" ? "0" : "250px";
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
            var brand = document.getElementById("brand").value;
            var model = document.getElementById("model").value;
            var statusElement = document.getElementById("status");
            var status = statusElement.options[statusElement.selectedIndex].value;
            var price = document.getElementById("price").value;

            // Validate Brand
            if (brand === "" || brand === null) {
                showModal("Brand is Required");
                return false;
            }

            // Validate Model
            if (model === "" || model === null) {
                // Display error message
                showModal("Medicine name is Required");
                return false;
            }

            // Validate status
            if (status === "" || status === null || status === "null") {
                // Display error message
                showModal("Status is Required");
                return false;
            }

            // Validate status
            if (price === "" || price === null) {
                // Display error message
                showModal("Price is Required");
                return false;
            }

            if (!/^\d+$/.test(price)) {
                // Display error message if price is not a number
                showModal("Price must contain numbers only");
                return false;
            }

            return true; // Return true if all validations pass
        }

        // Attach the validation function to the form's onsubmit event
        document.getElementById("car_info_form").onsubmit = function () {
            return validateForm();
        };


    </script>


</head>
<body>


<div class="main_container">

    <div id="navbar" class="division_b">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button
                    data-mdb-collapse-init
                    class="navbar-toggler"
                    type="button"
                    data-mdb-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0" href="#">
                        <img
                            src=""
                            height="15"
                            alt="Car - Dealers"
                            loading="lazy"
                        />
                    </a>
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">
                    <!-- Icon -->

                    <!-- Avatar -->
                    <div class="dropdown">
                        <a
                            data-mdb-dropdown-init
                            class="dropdown-toggle d-flex align-items-center hidden-arrow"
                            href="#"
                            id="navbarDropdownMenuAvatar"
                            role="button"
                            aria-expanded="false"
                            onclick="toggleDropdown()"
                        >
                            <img
                                src="<?php echo $user_icon; ?>"
                                class="rounded-circle"
                                height="25"
                                alt="Black and White Portrait of a Man"
                                loading="lazy"
                            />
                        </a>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            style="margin-right: 10px; left: -117px;"
                            aria-labelledby="navbarDropdownMenuAvatar"
                            id="avatarDropdown"
                        >
                            <li>
                                <a class="dropdown-item" href="<?php echo $logout_controller; ?>">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </div>

    <div class="division_d">
        <!-- Drawer -->
        <div id="myDrawer" class="drawer">
            <a href="<?php echo $Dashboard_page; ?>"><span class="fas fa-tachometer-alt"></span> Dashboard</a>
            <a href="<?php echo $Add_cars_page; ?>"><span class="fas fa-plus"></span><span class="fas fa-car"></span> Add Cars</a>
            <a href="<?php echo $New_cars_List_page; ?>"><span class="fas fa-car"></span><span class="fas fa-tags"></span> New Cars
                <!--                <span class="badge badge-danger"><span class="rotate-text">New</span></span>-->
            </a>
            <a href="<?php echo $Used_cars_List_page; ?>"><span class="fas fa-wrench"></span><span class="fas fa-car"></span> Used Cars</a>
            <a href="<?php echo $Rented_cars_List_page; ?>"><span class="fas fa-user"></span><span class="fas fa-car"></span> Rented Cars</a>
            <a href="<?php echo $All_cars_List_page; ?>"><span class="fas fa-table"></span> All Cars</a>
            <a href="<?php echo $Customer_Requests_List_page; ?>"><span class="fas fa-users"></span> Customer Requests</a>
        </div>


    </div>



    <div class="division_a" style="overflow-x: auto; width: 955px; height: 476px;">
        <!--    <h1>Hello Seller</h1>-->

        <div class="container custom-container">
            <div class="row"">
            <div class="col-md-6 offset-md-3 border p-4 shadow bg-light mb-5" style="height: 93%">
                <div class="col-12">
                    <h3 class="fw-normal text-secondary fs-4 text-uppercase mb-4">Car Information Update Form</h3>
                </div>
                <form action="<?php echo $Edit_cars_controller_file; ?>" id="car_info_form" method="post" onsubmit="return validateForm();">
                    <div class="row g-3">
                        <div class="col-12">
                            <input hidden="" id="car_id" name="car_id" class="form-control" value="<?php echo $car_id; ?>" >
                            <label for="brand" class="form-label">Brand</label>
                            <input id="brand" name="brand" class="form-control" value="<?php echo $car_brand; ?>" placeholder="Enter car brand name" >
                        </div>
                        <div class="col-12">
                            <label for="model" class="form-label">Model</label>
                            <input id="model" name="model" class="form-control" value="<?php echo $car_model; ?>" placeholder="Enter car model name" required>
                        </div>
                        <div class="col-12">
                            <label for="price" class="form-label">Price</label>
                            <input id="price" name="price" class="form-control" value="<?php echo $car_price; ?>" placeholder="৳" required>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success float-end">Update Details</button>
                            <a href="<?php echo $Dashboard_page; ?>" class="btn btn-outline-secondary float-end me-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</div>

</body>
</html>