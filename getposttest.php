<?php
if(!isset($_POST['test']))
{
    exit();
}


$data = "testing";
$command = "getposttest.py ".$data;
$result = exec($command);

    echo $result;