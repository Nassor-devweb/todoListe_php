<?php

function getAlltodo()
{
    require("models/todo_data.php");
    $allTodo = getAlltodo_data();
    require_once("views/accueil.php");
}


function save_todo()
{
    if ($_POST["tache"]) {
        echo "dedans";
        require_once("models/todo_data.php");
        echo "dedans";
        $allTodo = save_todo_data($_POST["tache"]);
        require_once("views/accueil.php");
        header("Location: http://localhost/projet_1_todo/");
    }
}
function editTodo(int $id)
{
    require_once("models/todo_data.php");
    $allTodo = editTodo_data($id);
    require_once("views/accueil.php");
    header("Location: http://localhost/projet_1_todo/");
}

function deleteTodo(int $id)
{
    require_once("models/todo_data.php");
    $allTodo = deleteTodo_data($id);
    http_response_code(200);
    require_once("views/accueil.php");
    header("Location: http://localhost/projet_1_todo/");
}
