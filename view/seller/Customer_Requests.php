<?php


//include_once '../../Navigation_Links.php';

global $routes, $backend_routes, $image_routes;
require '../../routes.php';

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


$Car_request_accept_controller_file = $backend_routes['seller_car_request_accept_controller'];
$Car_request_reject_controller_file = $backend_routes['seller_car_request_reject_controller'];
$Cars_View_page = $routes['seller_view_car'];
$user_id = $_SESSION['user_id'];



if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car - Dealers -> Customer Requests</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        /* Custom styling for the table container */

        #car-table  {
            position: sticky;
            top: 40px; /* Height of the h2 element */
            background-color: #fff; /* Background color to match the container */
            z-index: 1; /* Ensure the header stays above the content */
        }
        thead {
            /*position: sticky;*/
            top: -3px;
        }
        .table-container {
            max-height: 400px; /* Set a maximum height for the table container */
            overflow-y: auto; /* Enable vertical scrolling */
            border: 0px solid #ddd; /* Add border for a nice look */
            border-radius: 10px; /* Add border radius for rounded corners */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        .table-container::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari, and Opera */
        }
        #table_name{
            position: sticky;
            margin-top: 46px;
            top: -8px;

        }

        .locked-row {
            pointer-events: none; /* Disable pointer events */
            opacity: 0.3; /* Reduce opacity */
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
            <a class="bg-white" href="<?php echo $Customer_Requests_List_page; ?>"><span class="fas fa-users"></span> Customer Requests</a>
        </div>


    </div>



    <div class="division_a" style="overflow-x: auto; width: 955px; height: 476px;">
        <!--    <h1>Hello Seller</h1>-->

        <div class="container table-container">
            <h2 id="table_name" style="">Customer Requests</h2>
            <table id="car-table" class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Request Type</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Status</th>
                    <th style="text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody id="car-list">
                <?php
                // Include CarRepo.php and call the function to fetch data
                include '../../model/Car_RequestRepo.php';
                include '../../model/CarRepo.php';
                include './ColorGenerator.php';
                include './ActionLock.php';
                $rows = findCarRequestsBySellerID($user_id); // assuming $id is already defined
                if($rows !== null){
                    foreach ($rows as $row) {
                        if(true){

                            $car = findCarByID($row['car_id']);

//                        The Status colors is getting from ColorGenerator.php file
                            $availabilityColor = '';
                            $availabilityColor = Availability_Badge_Color($car['availability']);
                            $statusColor = '';
                            $statusColor = car_request_Status_Badge_Color($row['status']);
                            $lock = '';
                            $lock = lock_decider($row['status']);

                            // Generate table row
                            echo "<tr class='{$lock}'>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['request_type']}</td>";
                            echo "<td>{$car['model']}</td>";
                            echo "<td>{$car['original_price']}</td>";
                            echo "<td><span class='badge {$availabilityColor}'>{$car['availability']}</span></td>";
                            echo "<td><span class='badge {$statusColor}'>{$row['status']}</span></td>";
                            echo "<td>";
                            echo "<form action='$Car_request_accept_controller_file' method='post' style='display: inline-block;'>
                                <input hidden type='number' id='view_id' name='accept_id' value='{$row['id']}' />
                                <input hidden type='number' id='car_sold_id' name='car_sold_id' value='{$car['id']}' />
                                <button type='submit' class='btn btn-success edit-btn' data-id='{$row['id']}'>Accept</button>
                              </form>
                              ";
                            echo "&nbsp;&nbsp;"; // Inserting a space for gap
                            echo "<form action='$Car_request_reject_controller_file' method='post' style='display: inline-block;'>
                                <input hidden type='number' id='used_id' name='reject_id' value='{$row['id']}' />
                                <button class='btn btn-danger used-btn' data-id='{$row['id']}'>Reject</button>
                              </form>
                              ";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>



    </div>

</div>

</body>
</html>