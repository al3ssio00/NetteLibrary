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

    /*public function getLibri($search_term = null, $records_per_page = 10, $start_from = 1): array {
        $query = "SELECT l.id, l.titolo, l.autore, l.anno, SUM(d.count) AS disponibilita, 
            CASE 
              WHEN SUM(d.count) = 0 THEN NULL 
              ELSE GROUP_CONCAT(DISTINCT 
                CASE WHEN d.count > 0 THEN b.filiale END SEPARATOR ', ') 
            END AS filiale,
            CASE 
              WHEN SUM(d.count) = 0 THEN NULL 
              ELSE GROUP_CONCAT(DISTINCT 
                  CASE WHEN d.count > 0 THEN b.id END SEPARATOR ', ') 
            END AS id_filiali
          FROM libri l
            LEFT JOIN disponibilita d ON l.id = d.ref_libro
            LEFT OUTER JOIN bibliotecaL b on d.ref_biblioteca = b.id";
        
        if ($search_term) {
            $query .= " WHERE l.titolo LIKE '%$search_term%' 
                OR l.autore LIKE '%$search_term%' 
                OR l.anno LIKE '%$search_term%' ";
        }

        $query .= " GROUP BY l.id
            LIMIT $start_from, $records_per_page";
        $result = $this->database->query($query);
        return $result->fetchAll();
    }*/

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
