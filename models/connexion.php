<?php

class Connexion
{
    private const dns = "mysql:host=localhost;dbname=dyma_todo_php";
    private const user = 'root';
    private const password = "";
    public static $getConnexion = null;

    function __construct()
    {
    }
    public static function connect()
    {
        if (is_null(self::$getConnexion)) {
            try {
                self::$getConnexion = new PDO(self::dns, self::user, self::password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $err) {
                echo "La connexion a echouée " . $err->getMessage();
            }
        }
        return self::$getConnexion;
    }
}
