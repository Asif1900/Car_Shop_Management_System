<?php

//include_once '../../Navigation_Links.php';

global $routes;
require '../../routes.php';

session_start();

require_once __DIR__ . '/../../model/UserRepo.php';
require_once __DIR__ . '/../../model/SellerRepo.php';


session_start();

$Login_page =  $routes['login'];
$signup_page =$routes['seller_signup'];
$INDEX_page = $routes['INDEX'];

//echo $_SERVER['REQUEST_METHOD'];
$everythingOKCounter = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Got Req";

//    Name Validations
    $name = $_POST['seller_signup_name'];;
    if (empty($name)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo "Name error 1";
    } else {
        $everythingOK = TRUE;
    }


//* Email Validation
    $email = $_POST['seller_signup_email'];
    if (empty($email)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;

        echo "Mail error 1";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo "Mail error 2";
    } else {
        $everythingOK = TRUE;
    }

//* Password Validation
    $password = $_POST['seller_signup_password'];
    if (empty($password) || strlen($password) < 8) {
        // check if password size in 8 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo "Pass error 1";
    } else {
        $everythingOK = TRUE;
    }

//    Phone Validation
    $phone = $_POST['seller_signup_phone'];
    if (empty($phone)) {
        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo "Phone error 1";
    }elseif (strlen($phone)  < 9){
        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo "Phone error 2";
    } else {
        $everythingOK = TRUE;
    }


    if ($everythingOK && $everythingOKCounter === 0) {

        echo "all ok";
        $data = createUser($email, $password, "Seller");
        echo '<br>Data id = '.$data["id"].'<br>';
        $_SESSION["data"] = $data;
        $_SESSION["user_id"] = $data;

        if($data > 0){



            $inserted_id = createSeller($name, $phone, $data);
            if($inserted_id > 0){
                echo 'Redirecting to Login file';
                header("Location: {$Login_page}");
                exit;
            }else{
                echo 'Redirecting to Signup file because seller not created';
                header("Location: {$signup_page}");
                exit;
            }

        }else{
            echo 'Redirecting to Signup file because user not created';
            header("Location: {$signup_page}");
            exit;
        }




    } else {

        header("Location: {$signup_page}");
        exit;
    }

}else{
    echo '<h1>SORRY! GOT GET REQUEST</h1>';
    header("Location: {$INDEX_page}");
    exit;
}