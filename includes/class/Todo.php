<?php

class Todo
{
    private const errors = [
        "lenTache" => "La tache doit contenir au minimum 3 lettre",
        "empty" => "Vous devez saisir une tâche"
    ];

    public function __construct(private string $tache, private bool $done, private int $id)
    {
        $this->tache = $tache;
        $this->done = $done;
        $this->id = $id;
    }
    public function __get($name)
    {
        return $this->$name;
    }
    public function sanitize()
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return $data["tache"];
    }
    public function getError($tache)
    {
        $error = '';
        if (empty($tache)) {
            $error = self::errors["empty"];
            return $error;
        }
        if (mb_strlen($tache) < 4) {
            $error = self::errors["lenTache"];
            return $error;
        }
        return false;
    }
}
