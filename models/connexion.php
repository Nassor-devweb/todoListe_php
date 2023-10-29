<?php

class Connexion
{
    private $dns = "mysql:host=localhost;dbname=dyma_todo_php";
    private $user = 'root';
    private $passeword = "";
    public static $getConnexion = null;

    function __construct()
    {
    }
    public static function connect()
    {
        if (is_null(self::$getConnexion)) {
            try {
                $pdo = new PDO(self::$dns, self::$user, self::$passeword, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
                return self::$getConnexion;
            } catch (PDOException $err) {
                echo "La connexion a echouée " . $err->getMessage();
                return self::$getConnexion;
            }
        }
        return self::$getConnexion;
    }
}
