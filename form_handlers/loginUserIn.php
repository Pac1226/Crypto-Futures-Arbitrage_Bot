<?php
if(!isset($_POST['li']))
{
    exit();
}

require_once("../classes/user.class.php");

$date_time = time();

$email = $_POST['email'];
$pass = $_POST['pass'];

$customer_obj = new User();

//Check if email exist
$user = $customer_obj->getUser($email);
if($user == "")
{
    echo "udne";
    exit();

}

$passwordToMatch = $user['password'];

if($passwordToMatch == $pass)
{



    $session_id = uniqid();
    $session_id_hashed = password_hash($session_id, PASSWORD_DEFAULT);


    $json = array(


        "simple_trader_user_id"=>$user['userID'],
        "simple_trader_session_id"=>$session_id_hashed
    
    
    
    );


    echo json_encode($json);


}
else
{
    echo "Incorrect E-mail or password";
}