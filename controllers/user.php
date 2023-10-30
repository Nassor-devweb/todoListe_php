<?php
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER["SCRIPT_NAME"];
$script_name = str_replace("index.php", "", $script_name);
$indexUrl = "http://" . $host . $script_name;
$signinUrl = "http://" . $host . $script_name . "user/signin_user";

$errors = [
    "length" => "Vous devez saisir au minimum 3 caractères",
    "empty" => "Veuillez remplir tout les champs",
    "email" => "Email est incorrect"
];

function signup_user()
{
    global $errors;
    global $signinUrl;

    if (isset($_POST["email_user"])) {
        $nom_user = $_POST["nom_user"];
        $password_user = $_POST["password_user"];
        $email_user = $_POST["email_user"];
        $photo_user = $_POST["photo_user"];

        $error = match (true) {
            (empty(trim($nom_user)) || empty(trim($password_user)) || empty(trim($email_user)) == true) => $errors["empty"],
            (mb_strlen($nom_user) < 3 || mb_strlen($password_user) < 3) === true => $errors['length'],
            default => ''
        };
        if (!$error) {
            $data = filter_input_array(INPUT_POST, [
                "nom_user" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                "password_user" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                "email_user" => FILTER_SANITIZE_EMAIL,
                "photo_user" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            ]);
            $data["password_user"] = password_hash($data["password_user"], PASSWORD_BCRYPT);
            require_once("models/user_db.php");
            save_user_data($data["nom_user"], $data["password_user"], $data["email_user"], $data["photo_user"]);
            header("Location: $signinUrl");
        } else {
            http_response_code(401);
            require_once("views/signup.php");
        }
    } else {
        require_once("views/signup.php");
    }
}

function signin_user()
{
    global $errors;
    global $indexUrl;

    if (isset($_POST["email_user"])) {
        $password_user = $_POST["password_user"];
        $email_user = $_POST["email_user"];

        $error = match (true) {
            (empty(trim($password_user)) || empty(trim($email_user)) == true) => $errors["empty"],
            (mb_strlen($password_user) < 3) === true => $errors['length'],
            filter_var($email_user, FILTER_VALIDATE_EMAIL) === false => $errors['email'],
            default => ''
        };
        if (!$error) {
            $data = filter_input_array(INPUT_POST, [
                "password_user" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                "email_user" => FILTER_SANITIZE_EMAIL,
            ]);
            require_once("models/user_db.php");
            $dataUser = getOneUser($data["email_user"]);
            if (isset($dataUser["email_user"])) {
                if (password_verify($data["password_user"], $dataUser["password_user"])) {
                    require_once("middleware/auth.php");
                    createSession();
                    $_SESSION["id_user"] = $dataUser["id_user"];
                    header("Location: $indexUrl");
                } else {
                    $error = "Vos identifiants de connexion sont incorrect";
                    require_once("views/signin.php");
                }
            } else {
                $error = "Vos identifiants de connexion sont incorrect";
                require_once("views/signin.php");
            }
        } else {
            http_response_code(401);
            require_once("views/signin.php");
        }
    } else {
        require_once("views/signin.php");
    }
}

function disconnected_user()
{
    require_once("middleware/auth.php");
    desconnected();
}
