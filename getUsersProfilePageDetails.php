<?php
if(!isset($_POST['sessionID']))
{
 exit();
}

require_once("classes/user.class.php");

$date_time = time();
$userID = $_POST['userID'];
$sessionID = $_POST['sessionID'];



$userObj = new User();

$profileDetails = $userObj->getUserProfileDetails($userID);

if($profileDetails == "")
{
    exit();
}

$json = array(

    "email"=>$profileDetails['email'],
    "creditScore"=>$profileDetails['creditScore'],
    "monthlyIncome"=>$profileDetails['monthlyIncome'],
    "monthlyDebt"=>$profileDetails['monthlyDebt']

);

echo json_encode($json);




