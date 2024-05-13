<?php
//include_once '../../Navigation_Links.php';

session_start();

require_once __DIR__ . '/../../../model/CarRepo.php';
global $routes;
require '../../../routes.php';

$login_page = $routes['login'];
$All_cars_List_page = $routes['seller_all_cars'];
$error_page_500 = $routes['500_error'];

$user_id = $_SESSION['user_id'];

$everythingOK = FALSE;
$everythingOKCounter = 0;

$car_id = $_POST['delete_id'];

$decision = false;

echo '<br><h1> Received Car ID = '.$car_id.'</h1><br>';

try {
    $decision = deleteCar( $car_id);
    if ($decision) {
        echo '<br><h1> Decision Update = '.$decision.'</h1><br>';
        header("Location: {$All_cars_List_page}");
        exit;
    } else {
        header("Location: {$error_page_500}");
        exit;
    }
} catch (Exception $e) {
    header("Location: {$error_page_500}");
    exit;
}
