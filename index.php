<?php
require_once("./controllers/todo.php");

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

//$tache;
//$sanatizeTache;
//$error = "";
//$filename = __DIR__ . "/data/todo.json";
//$todos = [];

//if (isset($_POST["tache"])) {
//    $tache = new Todo($_POST["tache"], false, time());
//    $sanatizeTache = $tache->sanitize();
//    if ($tache->getError($sanatizeTache)) {
//        $error = $tache->getError($sanatizeTache);
//   } else {
//       $tache->saveTodo($filename);
 //   }
//}
//$todos = Todo::getAlltodo($filename);
