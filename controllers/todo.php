<?php
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER["SCRIPT_NAME"];
$script_name = str_replace("index.php", "", $script_name);
$urlname = "http://" . $host . $script_name;
$errors = [
    "lenTache" => "Vous devez saisir au minimum 3 caractères",
    "empty" => "Veuillez remplir le champs",
];

function getAlltodo()
{
    require("models/todo_data.php");
    $allTodo = getAlltodo_data();
    require_once("views/accueil.php");
}


function save_todo()
{
    global $urlname;
    global $errors;
    if (isset($_POST["tache"])) {
        if (empty($_POST["tache"])) {
            require("models/todo_data.php");
            $allTodo = getAlltodo_data();
            $error = $errors["empty"];
            require_once("views/accueil.php");
        } elseif (mb_strlen($_POST["tache"]) < 3) {
            require("models/todo_data.php");
            $allTodo = getAlltodo_data();
            $error = $errors["lenTache"];
            require_once("views/accueil.php");
        } else {
            require_once("models/todo_data.php");
            $allTodo = save_todo_data($_POST["tache"]);
            header("Location: $urlname");
        }
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
