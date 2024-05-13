<?php


//include_once '../../Navigation_Links.php';

global $routes, $backend_routes, $image_routes;
require '../../routes.php';
require_once __DIR__ . '/../../model/CalculationRepo.php';

//echo '<h1>'.login_page().'</h1>'
session_start();

$loginController_file = $backend_routes['login_controller'];
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



if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}


$carSold = 0;
$carAvailable = 0;
$Income = 0;
$profit = 0;
$revenue = 0;
$Pending_Requests = 0;

$x_axis_array = [];
$y_axis_array = [];

$user_id = 0;
$user_id = $_SESSION['user_id'];

$carSold = getSoldCarQuantity($user_id);
$carAvailable = getAvailableCarQuantity($user_id);
$profit = getProfit($user_id);
$Income = getCurrentMonthIncome($user_id);
$revenue = getRevenue($user_id);
//$Pending_Requests = getTotalPendingRequests($user_id);
$x_axis_array = getYearsInArray($user_id);
$y_axis_array = getRevenuesPerYearInArray($user_id);


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

        .division_a {
            grid-area: a;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Align items to the start of the container */
            align-items: stretch; /* Stretch items to fill the container horizontally */
        }

        .division_a .cards-container {
            display: flex;
            flex-direction: column; /* Display cards in a single column */
            align-items: stretch; /* Stretch items to fill the container horizontally */
            margin-bottom: 20px; /* Add some space between cards and line graph */
        }

        .card {
            margin-bottom: 20px; /* Add some space between cards */
        }

        .card-title {
            font-size: 24px; /* Set font size */
            font-weight: bold; /* Set font weight */
            margin-bottom: 10px; /* Add space below title */
        }

        .card-line {
            border-top: 2px solid black; /* Add horizontal line */
            margin-bottom: 10px; /* Add space below line */
        }

        .card-content {
            font-size: 36px; /* Set font size */
            font-weight: bold; /* Set font weight */
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
            <a class="bg-white" href="<?php echo $Dashboard_page; ?>"><span class="fas fa-tachometer-alt"></span> Dashboard</a>
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



    <div class="division_a">

        <div class="line-graph-container">
            <canvas id="lineGraph" width="400" height="200"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Sample data arrays (replace these with actual data from backend)
                var x_axis = <?php echo json_encode($x_axis_array); ?>;
                var y_axis = <?php echo json_encode($y_axis_array); ?>;

                var ctx = document.getElementById('lineGraph').getContext('2d');

                var lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: x_axis,
                        datasets: [{
                            label: 'Revenue',
                            data: y_axis,
                            backgroundColor: 'rgba(105, 0, 132, .2)',
                            borderColor: 'rgba(255, 99, 132, 0.8)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            </script>

            <div id="x_1" class="card" style="background-color: #5b7371; margin-left: 40px; width: 250px; display: inline-block;">
                <h2 class="" style="text-align: center;">Total Revenue</h2>
                <hr class="">
                <div class="card-content" style="text-align: center;">৳ <?php echo $revenue; ?>/- </div>
            </div>

            <div id="x_2" class="card" style="background-color: #1a8730; margin-left: 30px; width: 250px; display: inline-block;">
                <h2 class="" style="text-align: center;">Total Profit</h2>
                <hr class="">
                <div class="card-content" style="text-align: center;">৳ <?php echo $profit; ?>/-</div>
            </div>
        </div>


        <div class="cards-container" style="margin-left: 30px;">
            <!-- Card 1 -->
            <div class="card" style="background-color: #f1c40f; width: 250px;">
                <h2 class="card-title" style="text-align: center;">Car Sold</h2>
                <hr class="card-line">
                <div class="card-content" style="text-align: center;"><?php echo $carSold; ?></div>
            </div>
            <!-- Card 2 -->
            <div class="card" style="background-color: #3498db; width: 250px;">
                <h2 class="card-title" style="text-align: center;">Car Available</h2>
                <hr class="card-line">
                <div class="card-content" style="text-align: center;"><?php echo $carAvailable; ?></div>
            </div>
            <!-- Card 3 -->
            <div class="card" style="background-color: #e74c3c; width: 250px;">
                <h2 class="card-title" style="text-align: center;">Income</span></h2>
                <hr class="card-line">
                <div class="card-content" style="text-align: center;">৳ <?php echo $Income; ?>/-</div>
            </div>
        </div>



    </div>



</body>
</html>