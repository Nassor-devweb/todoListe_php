<?php
require_once('./includes/class/Todo.php');
$filename = __DIR__ . "/data/todo.json";

Todo::deleteTodo($filename, (int) $_GET["id"]);

header("Location: http://localhost:3000");
