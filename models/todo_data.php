<?php
require_once("./models/connexion.php");
$pdo = Connexion::$getConnexion();

function save_todo_data($tache)
{
    global $pdo;
    $date_tache = date(DateTime::ATOM, time());
    if (!is_null($pdo)) {
        $stmt = $pdo->prepare("INSERT INTO tache VALUES(
            DEFAULT,
            :nom_tache,
            :done_tache,
            :date_tache,
            :id_user
        )");
        $stmt->bindValue(":nom_tache", $tache);
        $stmt->bindValue(":done_tache", false);
        $stmt->bindValue(":date_tache", $date_tache);
        $stmt->bindValue(":done_tache", $_SESSION['id_user']);
    } else {
        echo "connexion non établie";
    }
}

function getAlltodo_data()
{
    global $pdo;
    $date_tache = date(DateTime::ATOM, time());
    if (!is_null($pdo)) {
        $stmt = $pdo->prepare("SELECT * FROM tache WHERE id_user=:id_user");
        $stmt->bindValue(":id_user", $_SESSION['id_user']);
        $data = $stmt->fetchAll();
        return $data;
    } else {
        echo "connexion non établie";
    }
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
