<?php

namespace App\Models;
use Nette;
use Nette\Database\Explorer;
use Nette\Database\Row;

class LoginModel {
    use Nette\SmartObject;

    private $database;
    public function __construct(Explorer $database) {
        $this->database = $database;
    }

    // Funzione per recuperare utente dal DB tramite ID
    public function getUserById($id): ?Row {
        return $this->database->table('utenti')->get($id);
    }
}
