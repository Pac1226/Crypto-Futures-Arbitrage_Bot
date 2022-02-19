<?php
if(!isset($_POST['op']))
{
 exit();
}

$date_time = time();
$userID = $_POST['userID'];
$loanRequest = $_POST['amount_requested'];

$data = $userID.",".$loanRequest;

$command= escapeshellcmd('userLoanApproval.py ' .$data);
$output = exec($command);

echo $output;