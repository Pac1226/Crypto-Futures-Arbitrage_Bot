<?php
if(!isset($_POST['op']))
{
    exit();
}

require_once("classes/user.class.php");

$date_time = time();

$userID = $_POST['userID'];
$sessionID = $_POST['sessionID'];

$userObj = new User();

$userTrades = $userObj->getUserTrades($userID);

if(count($userTrades) == 0)
{
    echo "no trades yet";
    exit();
}



$json = array(); //EACH TRADE NEEDS TO BE PUSHED IN HERE

foreach($userTrades as $trade)
{
    $json[] = array(

        "txDate"=>$trade['txDate'],
        "userID"=>$trade['userID'],
        "exchange"=>$trade['exchange'],
        "symbol"=>$trade['symbol'],
        "buySellFlag"=>$trade['buySellFlag'],
        "lots"=>$trade['lots'],
        "price"=>$trade['price']

    );
}



echo json_encode($json);