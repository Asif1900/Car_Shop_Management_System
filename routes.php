<?php

// Define routes
$routes = [
    'INDEX' => '/Car_Shop_Management_System/index.php',
    '500_error' => '/Car_Shop_Management_System/500.php',
    'login' => '/Car_Shop_Management_System/view/Login.php',
    'signup_decider' => '/Car_Shop_Management_System/view/Signup_Decider.php',
    'seller_signup' => '/Car_Shop_Management_System/view/seller/Seller_Signup.php',
    'seller_dashboard' => '/Car_Shop_Management_System/view/seller/Seller_Dashboard.php',
    'seller_add_cars' => '/Car_Shop_Management_System/view/seller/Add_Car.php',
    'seller_new_cars' => '/Car_Shop_Management_System/view/seller/New_Car.php',
    'seller_used_cars' => '/Car_Shop_Management_System/view/seller/Used_Car.php',
    'seller_rented_cars' => '/Car_Shop_Management_System/view/seller/Rented_Car.php',
    'seller_all_cars' => '/Car_Shop_Management_System/view/seller/All_Cars.php',
    'seller_car_requests' => '/Car_Shop_Management_System/view/seller/Customer_Requests.php',
    'seller_view_car' => '/Car_Shop_Management_System/view/seller/View_Car.php',
    'seller_edit_car' => '/Car_Shop_Management_System/view/seller/Edit_Car.php',
];

$backend_routes = [
    'login_controller' => '/Car_Shop_Management_System/controller/LoginController.php',
    'logout_controller' => '/Car_Shop_Management_System/controller/LogoutController.php',
    'seller_signup_controller' => '/Car_Shop_Management_System/controller/seller/Seller_SignupController.php',
    'seller_add_car_controller' => '/Car_Shop_Management_System/controller/seller/Add_CarController.php',
    'seller_new_cars_used_controller' => '/Car_Shop_Management_System/controller/seller/New_CarController/New_Car_UsedController.php',
    'seller_rented_cars_available_controller' => '/Car_Shop_Management_System/controller/seller/Rented_CarController/Rented_Car_AvailableController.php',
    'seller_all_cars_delete_controller' => '/Car_Shop_Management_System/controller/seller/All_CarsController/All_Cars_DeleteController.php',
    'seller_edit_car_controller' => '/Car_Shop_Management_System/controller/seller/All_CarsController/All_Cars_EditController.php',
    'seller_car_request_accept_controller' => '/Car_Shop_Management_System/controller/seller/Customer_RequestsController/Customer_Requests_AcceptController.php',
    'seller_car_request_reject_controller' => '/Car_Shop_Management_System/controller/seller/Customer_RequestsController/Customer_Requests_RejectController.php',
];


$image_routes = [
    'contact' => '/Car_Shop_Management_System/view/static/image/contact.jpg',
    'seller_image' => '/Car_Shop_Management_System/view/static/image/seller.jpg',
    'user_icon' => '/Car_Shop_Management_System/view/static/image/user.png',
];

?>
