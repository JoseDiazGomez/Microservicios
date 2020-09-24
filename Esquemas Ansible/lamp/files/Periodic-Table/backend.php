<?php
require_once "classes/MySQL.php";

$data = json_decode(file_get_contents('php://input'),true);
if (isset($data["action"]))
{
    switch ($data["action"])
    {
        case "get_tools":
        {
            getTools();
            break;
        }
        default:
        {
            //Error
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(array("success" => false));
            break;
        }
    }
}

function getTools()
{
    $mysql = new MySQL();
    $tools = $mysql->getTools();
    $response = array(
        "success" => true,
        "array" => $tools
    );
    if($tools === false)
        $response["success"] = false;
    echo json_encode($response);
}
