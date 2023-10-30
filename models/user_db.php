<?php
require_once("models/connexion.php");

function save_user_data($nom_user, $password_user, $email_user, $photo_user)
{
    $pdo_data = Connexion::connect();

    if (!is_null($pdo_data)) {
        $stmt = $pdo_data->prepare("INSERT INTO user VALUES(
        DEFAULT,
        :nom_user,
        :email_user,
        :password_user,
        :photo_user
    )");
        $stmt->bindValue(":nom_user", $nom_user);
        $stmt->bindValue(":password_user", $password_user);
        $stmt->bindValue(":email_user", $email_user);
        $stmt->bindValue(":photo_user", $photo_user);
        $stmt->execute();
    } else {
        echo "connexion echoué";
    }
}

function getOneUser($email_user)
{
    $pdo = Connexion::connect();

    if (!is_null($pdo)) {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email_user = :email_user");
        $stmt->bindValue(":email_user", $email_user);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }
}
