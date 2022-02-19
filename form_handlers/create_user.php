<?php
if(!isset($_POST['cu']))
{
    exit();
}

require_once("../classes/user.class.php");

$date_time = time();

$uniqueID = uniqid();
$session_id = uniqid();
$session_id_hashed = password_hash($session_id, PASSWORD_DEFAULT);

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$customer_obj = new User();

$if_user_exist = $customer_obj->check_if_user_exist($email);

if(count($if_user_exist) > 0)
{
    echo "Uae";
exit();
}


$insert = $customer_obj->create_customer($email, $pass, $first, $last, $uniqueID, $date_time, $session_id, $date_time);

if($insert == "error")
{
    echo "error";
    exit();
}




$json = array(


    "simple_trader_user_id"=>$uniqueID,
    "simple_trader_session_id"=>$session_id_hashed



);


echo json_encode($json);
