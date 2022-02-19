<?php
if(!isset($_POST['iup']))
{
    exit();
}

require_once("../classes/user.class.php");

$date_time = time();

$monthly_income = $_POST['monthly_income'];
$monthly_debt = $_POST['monthly_debt'];
$credit_score = $_POST['credit_score'];

$simple_trader_user_id = $_POST['simple_trader_user_id'];
$simple_trader_session_id = $_POST['simple_trader_session_id'];

$customer_obj = new User();

$add = $customer_obj->add_user_prelimary($simple_trader_user_id, $monthly_income, $monthly_debt, $credit_score);

if($add == "success")
{
    echo "success";
}
