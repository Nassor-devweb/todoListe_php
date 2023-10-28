<?php
require_once('./includes/class/Todo.php');

$id = (int) $_GET["id"];
$indice;
$filename = __DIR__ . "/data/todo.json";
$todos = Todo::getAlltodo($filename);
var_dump($todos);
foreach ($todos as $key => $todo) {
    if ($todo["id"] === $id) {
        $indice = $key;
    }
}

$todos[$indice]["done"] = !$todos[$indice]["done"];
Todo::updateTodo($filename, $todos);

header("Location: http://localhost:3000");
