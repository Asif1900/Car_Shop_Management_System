<?php
//include_once '../../Navigation_Links.php';

session_start();

require_once __DIR__ . '/../../../model/Car_RequestRepo.php';
global $routes;
require '../../../routes.php';

$login_page = $routes['login'];
$Customer_Requests_List_page = $routes['seller_car_requests'];
$error_page_500 = $routes['500_error'];

$user_id = $_SESSION['user_id'];

$everythingOK = FALSE;
$everythingOKCounter = 0;

$request_id = $_POST['accept_id'];

$decision = false;

echo '<br><h1> Received Request ID = '.$request_id.'</h1><br>';

try {

    $saved_request = findCarRequestByID($request_id);

    if($saved_request['status'] === 'Pending'){
        $currentDateTime = date("Y-m-d H:i:s");
        $current_Date_Time_As_String = (string) $currentDateTime;
        $decision = updateCarRequestStatusWithDate( $current_Date_Time_As_String, 'Rejected', $request_id);
        if ($decision) {
            echo '<br><h1> Decision Update = '.$decision.'</h1><br>';
            header("Location: {$Customer_Requests_List_page}");
            exit;
        } else {
            header("Location: {$error_page_500}");
            exit;
        }
    }else{
//        redirect to a page for hackers
    }


} catch (Exception $e) {
    header("Location: {$error_page_500}");
    exit;
}
