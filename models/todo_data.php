<?php
require_once("models/connexion.php");

function getAlltodo_data()
{

    $pdo = Connexion::connect();
    if (!is_null($pdo)) {
        $stmt = $pdo->prepare("SELECT * FROM tache WHERE id_user=:id_user");
        $stmt->bindValue(":id_user", $_SESSION['id_user']);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    } else {
        echo "connexion non établie";
    }
    return null;
}

function save_todo_data($tache)
{
    $pdo = Connexion::connect();
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
        $stmt->bindValue(":id_user", $_SESSION['id_user']);
        $stmt->execute();
    } else {
        echo "connexion non établie";
    }
    return getAlltodo_data();
}

function deleteTodo_data(int $id)
{
    $pdo = Connexion::connect();
    if (!is_null($pdo)) {
        $stmt = $pdo->prepare("DELETE FROM tache WHERE id_tache = :id_tache");
        $stmt->bindValue(":id_tache", $id);
        $stmt->execute();
    }
    return getAlltodo_data();
}
function getOneTodo_data(int $id_tache)
{
}
function updateTache_data(int $id_tache)
{
    $pdo = Connexion::connect();

    $date_tache = date(DateTime::ATOM, time());
    if (!is_null($pdo)) {
        $stmt = $pdo->prepare("SELECT * FROM tache WHERE id_tache=:id_tache");
        $stmt->bindValue(":id_tache", $id_tache);
        $stmt->execute();
        $data = $stmt->fetch();
        $data['done_tache'] = !$data['done_tache'];

        $udapte = $pdo->prepare("UPDATE tache SET done_tache = :done_tache WHERE id_tache = :id_tache");
        $udapte->bindValue(":done_tache", $data["done_tache"]);
        $udapte->bindValue(":id_tache", $data["id_tache"]);
        $udapte->execute();
    } else {
        echo "connexion non établie";
    }
    return getAlltodo_data();
}
