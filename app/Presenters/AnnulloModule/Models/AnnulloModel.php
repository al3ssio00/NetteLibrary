<?php

namespace App\Models;
use Nette;
use Nette\Database\Explorer;
use Nette\Database\Row;

class AnnulloModel {
    use Nette\SmartObject;

    private Explorer $database;

    public function __construct(Explorer $database) {
        $this->database = $database;
    }

    // Function to cancel a reservation
    public function annullaPrenotazione(int $id_libro, int $id_biblioteca, $ordine_id): void
    {
    
        $this->database->table('disponibilita')
            ->where('ref_libro', $id_libro)
            ->where('ref_biblioteca', $id_biblioteca)
            ->where('count > 0')
            ->update([
                'count' => new Nette\Database\SqlLiteral('count + 1')
            ]);
        $this->database->table('storico_prenotazioni')
            ->where('id', $ordine_id)
            ->update([
                'restituito' => 1
            ]);
    }

    public function disponibilitaLibro(int $refL)
    {
        return $this->database->table('disponibilita')
            ->where('ref_libro', $refL)
            ->fetch(); // ritorna la prima riga trovata
    }

    public function aggiunta_libri(int $refL, int $refB): bool
{
    $disponibilita = $this->database->table('disponibilita')
        ->where('ref_libro', $refL)
        ->where('ref_biblioteca', $refB)
        ->fetch();

    if ($disponibilita) {
        $this->database->table('disponibilita')
            ->where('ref_libro', $refL)
            ->where('ref_biblioteca', $refB)
            ->update([
                'count' => new \Nette\Database\SqlLiteral('count + 1')
            ]);
        return true;
    }

    // Nessuna riga trovata → errore
    return false;
}

    

    // Function to get all active reservations for today
    public function getPrenotazioniAttive()
{
    $query = "SELECT 
        s.id AS ordine_id, 
        s.id_libro,
        s.id_filiale, 
        l.titolo, 
        l.autore, 
        b.filiale, 
        u.username AS utente, 
        s.data_ora, 
        s.restituito
    FROM storico_prenotazioni s
    JOIN libri l ON s.id_libro = l.id
    JOIN bibliotecaL b ON s.id_filiale = b.id
    JOIN utenti u ON s.id_utente = u.id
    WHERE DATE(s.data_ora) = CURDATE()
    ORDER BY s.data_ora DESC
   ";
    $result = $this->database->query($query);
    return $result->fetchAll();
}

    
}
