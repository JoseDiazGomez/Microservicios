<?php
require_once "classes/MySQL.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["symbol"]) && isset($_POST["tool"]) && isset($_POST["license"]) && isset($_POST["number"]))
    {
        $symbol = filter_var($_POST['symbol'], FILTER_SANITIZE_STRING);
        $tool = filter_var($_POST['tool'], FILTER_SANITIZE_STRING);
        $license = filter_var($_POST['license'], FILTER_SANITIZE_STRING);
        $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
        $logo = addslashes (file_get_contents($_FILES['logo']['tmp_name']));
        //$logo = base64_encode(addslashes (file_get_contents($_FILES['logo']['tmp_name'])));
    }
    else
        exit("Incomplete input");
}
else
    exit("Incorrect request method");

$mysql = new MySQL();
$mysql->addTool($symbol,$tool,$license,$number,$logo);

