<?php
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER["SCRIPT_NAME"];
$script_name = str_replace("index.php", "", $script_name);
$urlname = "http://" . $host . $script_name;


function getAlltodo()
{
    require("models/todo_data.php");
    $allTodo = getAlltodo_data();
    require_once("views/accueil.php");
}


function save_todo()
{
    global $urlname;
    if ($_POST["tache"]) {
        require_once("models/todo_data.php");
        $allTodo = save_todo_data($_POST["tache"]);
        require_once("views/accueil.php");
        // header("Location: $urlname");
    }
}
function editTodo(int $id)
{
    global $urlname;
    require_once("models/todo_data.php");
    $allTodo = editTodo_data($id);
    require_once("views/accueil.php");
    header("Location: $urlname");
}

function deleteTodo(int $id)
{
    global $urlname;
    require_once("models/todo_data.php");
    $allTodo = deleteTodo_data($id);
    http_response_code(200);
    require_once("views/accueil.php");
    header("Location: $urlname");
}
