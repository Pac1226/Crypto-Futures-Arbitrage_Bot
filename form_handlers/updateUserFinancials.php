<?php
if(!isset($_POST['sessionID']))
{
 exit();
}

require_once("../classes/user.class.php");

$date_time = time();

$userID = $_POST['userID'];
$sessionID = $_POST['sessionID'];
$creditScore = $_POST['creditScore'];
$monthlyIncome = $_POST['monthlyIncome'];
$monthlyDebt = $_POST['monthlyDebt'];

$userObj = new User();

$update = $userObj->updateUserFinancials($userID, $creditScore, $monthlyIncome, $monthlyDebt);

echo $update;