<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/dyma/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;700&family=Open+Sans:wght@400;700&family=Roboto:wght@400;700&family=Russo+One&display=swap" rel="stylesheet">
    <title>Todo</title>
    <script defer src="./public/index.js"></script>
</head>

<body>
    <div class="container">
        <?php require_once('includes/header.php') ?>
        <div class="content">
            <div class="todo-contenair">
                <h1>Ma todo</h1>
                <form action="todo/save_todo" method="POST" class="todo-form">
                    <input type="text" name="tache" placeholder="Entrez une tâche" value=<?= (isset($_POST["tache"]) && isset($error)) ? $_POST["tache"] : "" ?>>
                    <button type="submit" class="btn">Ajouter</button>
                </form>
                <?= isset($error) ? "<p class='text-danger'>$error</p>" : "" ?>
                <ul class="todo-liste">
                    <?php foreach ($allTodo as $todo) {
                        $affichageTodo = "";
                        $affichageTodo .= "<li class='todo-item'>";
                        $affichageTodo .= ($todo["done"]) ? "<span class='todo-name tacheValider'>" . $todo["tache"] . "</span>" : "<span class='todo-name'>" . $todo["tache"] . "</span>";
                        $affichageTodo .= "<a href='./todo/editTodo/" . $todo["id"] . "' data-id='" . $todo["id"] . "'>";
                        if ($todo["done"]) {
                            $affichageTodo .=  "<button class='btn btn-primary btn-small btn-edit'>Annuler</button>";
                        } else {
                            $affichageTodo .=  "<button class='btn btn-primary btn-small'>Valider</button>";
                        };
                        $affichageTodo .= "</a>";
                        $affichageTodo .= "<a href='./todo/deleteTodo/" . $todo["id"] . "' data-id='" . $todo["id"] . "'>";
                        $affichageTodo .= "<button class='btn btn-danger btn-small'>Supprimer</button>";
                        $affichageTodo .= "</a>";
                        $affichageTodo .= "</li>";
                        echo $affichageTodo;
                    }; ?>
                </ul>
            </div>
        </div>
        <?php require_once('includes/footer.php') ?>
    </div>
</body>

</html>