<?php


//include_once '../../Navigation_Links.php';

global $routes, $backend_routes, $image_routes;
require '../../routes.php';

//echo '<h1>'.login_page().'</h1>'
session_start();

$loginController_file = $backend_routes['login_controller'];
$Dashboard_page = $routes['seller_dashboard'];
$logout_controller = $backend_routes['logout_controller'];
$Login_page = $routes['login'];
$user_icon = $image_routes['user_icon'];

$seller_Dashboard_page = $routes['seller_dashboard'];
$Add_cars_page = $routes['seller_add_cars'];
$New_cars_List_page = $routes['seller_new_cars'];
$Used_cars_List_page = $routes['seller_used_cars'];
$Rented_cars_List_page = $routes['seller_rented_cars'];
$All_cars_List_page =  $routes['seller_all_cars'];
$Customer_Requests_List_page = $routes['seller_car_requests'];



if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}



// PHP variables for logo and product image
$productImageSrc = "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/3.webp"; // You can dynamically set this based on your PHP logic
$modelName = "Model Name Here"; // You can dynamically set this based on your PHP logic
$brandName = "Brand Name Here"; // You can dynamically set this based on your PHP logic

// Include CarRepo.php and call the function to fetch data
include '../../model/CarRepo.php';
include './ColorGenerator.php';
include './BrandLogoURLGenerator.php';

$car_id = -1;
$car_image = '';
$car_model = '';
$car_brand = '';
$car_price = '';
$car_status = '';
$car_availability = '';

$availabilityColor = '';
$statusColor = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['view_id'])) {
        $car_id = $_POST['view_id'];
        $car = findCarByID($car_id);
        if ($car['brand'] != null) {
            $car_image = getBrandLogoUrl($car['brand']);
            $car_model = $car['model'];
            $car_brand = $car['brand'];
            $car_price = $car['original_price'];
            $car_status = $car['status'];
            $car_availability = $car['availability'];


            $availabilityColor = Availability_Badge_Color($car['availability']);

            $statusColor = Status_Badge_Color($car['status']);

        }
    }
}else{
    header("Location: {$seller_Dashboard_page}");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car - Dealers -> Dashboard</title>
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

        .rotate-text {
            display: inline-block;
            transform: rotate(60deg);
            color: red;
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


        <!--<span class="badge badge-danger"><span class="rotate-text">New</span></span>-->


    </div>



    <div class="division_a" style="overflow-x: auto; width: 955px; height: 476px;">
        <!--    <h1>Hello Seller</h1>-->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card text-black">
<!--                        <i id="logo" class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>-->
                        <img id="product_image" src="<?php echo $car_image; ?>" class="card-img-top" alt="<?php echo $car_model; ?>" />
                        <div class="card-body">
                            <div class="text-center">
                                <h5 class="card-title"><?php echo $car_model; ?></h5>
                                <p class="text-muted mb-4"><?php echo $car_brand; ?></p>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>Price</span><span>BDT - <?php echo $car_price; ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Status</span><span class='badge <?php echo $statusColor; ?>'><?php echo $car_status; ?></span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>Availability</span><span class='badge <?php echo $availabilityColor; ?>'><?php echo $car_availability; ?></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
<!--                                <span>Total</span><span>$7,197.00</span>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>

</body>
</html>