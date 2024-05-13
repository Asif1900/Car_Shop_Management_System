<?php
//include_once '../../Navigation_Links.php';

session_start();

require_once __DIR__ . '/../../../model/CarRepo.php';
global $routes;
require '../../../routes.php';

$login_page = $routes['login'];


$Add_cars_page = $routes['seller_add_cars'];
$All_cars_page = $routes['seller_all_cars'];


// Validate Seller ID

$user_id = $_SESSION['user_id'];
$car_id = $_POST['car_id'];

$everythingOK = FALSE;
$everythingOKCounter = 0;



// Validate Brand
$brand = $_POST['brand'];
if (empty($brand)) {
    echo "<br>Brand is required.<br>";
    $everythingOK = FALSE;
    $everythingOKCounter += 1;
} else {
    echo "Brand Name = " . $brand . "<br>";
    $everythingOK = TRUE;
}

// Validate Model
$model = $_POST['model'];
if (empty($model)) {
    echo "Model Time is required.<br>";
    $everythingOK = FALSE;
    $everythingOKCounter += 1;
} else {
    echo "Model Name = " . $model . "<br>";
    $everythingOK = TRUE;
}

// Validate Price
$price = $_POST['price'];
if (empty($price)) {
    echo "Price is required.<br>";
    $everythingOK = FALSE;
    $everythingOKCounter += 1;
} else {
    echo "Price = " . $price . "<br>";
    $everythingOK = TRUE;
}


if ($everythingOK && $everythingOKCounter === 0){

    echo "<br>all ok<br>";
    $data = updateCar($brand, $model, $price, $car_id);

    if($data > 0){
        echo "<br>All Clear to Car List<br>";
        header("Location: {$All_cars_page}");
        exit;
    }else{
        echo "<br>Could not be updated <br>";
        header("Location: {$Add_cars_page}");
        exit;
    }

}else{
    header("Location: {$Add_cars_page}");
    exit;
}




