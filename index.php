<?php
require_once("./controllers/todo.php");
require_once("middleware/auth.php");
createSession();
$isLogged = authQuerry();
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER["SCRIPT_NAME"];
$script_name = str_replace("index.php", "", $script_name);
$signinUrl = "http://" . $host . $script_name . "user/signin_user";

$filename = str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]);
if (isset($_GET["action"]) && $_GET["action"] != "") {
    $params = explode("/", $_GET["action"]);
    $controller = $params[0];
    $action = $params[1];
    require_once($filename . "controllers/" . $controller . ".php");
    if (count($params) == 4) {
        $action($params[2], $params[3]);
    } elseif (count($params) == 3) {
        $action($params[2]);
    } else {
        $action();
    }
} else {
    require_once($filename . "controllers/todo.php");
    getAlltodo();
}
