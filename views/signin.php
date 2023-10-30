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
            <form action="user/signin_user" class="form-signup" method="POST">
                <h1>Connectez-vous</h1>
                <div class="form-group">
                    <label for="email_user">Email :</label>
                    <input type="text" name="email_user" id="email_user">
                </div>
                <div class="form-group">
                    <label for="password_user">Mot de passe :</label>
                    <input type="password" name="password_user" id="password_user">
                </div>
                <button type="submit" class="btn-sign btn-send btn-primary ">Enregistrer</button>
                <P class="text-danger" style="text-align: center;"><?= (isset($error) && isset($_POST)) ? $error : "" ?></P>
            </form>
        </div>
        <?php require_once('includes/footer.php') ?>
    </div>
</body>

</html>