<?php


?>

<head>
    <base href="/dyma/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;700&family=Open+Sans:wght@400;700&family=Roboto:wght@400;700&family=Russo+One&display=swap" rel="stylesheet">
    <title>Todo</title>
    <script defer src="public/index.js"></script>
</head>

<body>
    <div class="container">
        <?php require_once('includes/header.php') ?>
        <div class="content">
            <form action="user/signup_user" class="form-signup" method="POST">
                <div class="form-group">
                    <label for="nom_user">Nom d'utilisateur :</label>
                    <input type="text" name="nom_user" id="nom_user">
                </div>
                <div class="form-group">
                    <label for="email_user">Email :</label>
                    <input type="text" name="email_user" id="email_user">
                </div>
                <div class="form-group">
                    <label for="password_user">Mot de passe :</label>
                    <input type="password" name="password_user" id="password_user">
                </div>
                <div class="form-group">
                    <label for="photo_user">Photo de profil :</label>
                    <input type="file" name="photo_user" id="photo_user">
                </div>
                <button type="submit" class="btn-sign btn-send btn-primary ">Enregistrer</button>
                <P class="text-danger" style="text-align: center;"><?= (isset($error) && isset($_POST["nom_user"])) ? $error : "" ?></P>
            </form>
        </div>
        <?php require_once('includes/footer.php') ?>
    </div>
</body>

</html>