<?php
function save_todo_data($tache)
{
    $filename = "models/todo.json";
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        $todos = json_decode($data, true) ?? [];
        $todos = [...$todos, [
            "tache" => $tache,
            "done" => false,
            "id" => time()
        ]];
        file_put_contents($filename, json_encode($todos));
    }
    return getAlltodo_data($filename);
}

function getAlltodo_data()
{
    $filename = "models/todo.json";
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];
    return $todos;
}
function deleteTodo_data(int $id)
{
    $filename = "models/todo.json";
    $todos = getAlltodo_data($filename);
    $indice = array_search($id, array_column($todos, "id"));
    unset($todos[$indice]);
    updateTodo($filename, $todos);
    return getAlltodo_data($filename);
}
function editTodo_data(int $id)
{
    $filename = "models/todo.json";
    $todos = getAlltodo_data($filename);
    $indice = array_search($id, array_column($todos, "id"));
    $todos[$indice]["done"] = !$todos[$indice]["done"];
    updateTodo($filename, $todos);
    return getAlltodo_data($filename);
}

function updateTodo(string $filename, array $allTodos)
{
    file_put_contents($filename, json_encode($allTodos));
}
