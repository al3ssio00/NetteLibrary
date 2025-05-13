<?php

namespace App\Models;
use Nette;
use Nette\Database\Explorer;
use Nette\Database\Row;

class BibliotecaModel {
    use Nette\SmartObject;

    private $database;
    public function __construct(Explorer $database) {
        //la variabile in input dichiara che questa classe prende in input l'ORM del db
        $this->database = $database;
    }

    // Function to get all books from the database
    public function getAllBooks(): array {
        return $this->database->table('libri')->fetchAll();
    }

    public function prenotaLibro(int $id_libro, $id_filiale, $id_utente): void
    {
    
    // decrement the count of the book in the availability table
    $this->database->table('disponibilita')
        ->where('ref_libro', $id_libro)
        ->update(['count' => new Nette\Database\SqlLiteral('count - 1')]);
        
    // add a new record to the history table
    $this->database->table('storico_prenotazioni')
        ->insert([
            'id_libro' => $id_libro,
            'id_filiale' => $id_filiale,
            'id_utente' => $id_utente,
            'data_ora' => new Nette\Utils\DateTime(),
        ]); 
    }


    // funcion with the query to get the books
    public function getLibri($search_term = null, $records_per_page = 10, $start_from = 1): array {
        $query = "SELECT l.id, l.titolo, l.autore, l.anno, 
            SUM(d.count) AS disponibilita,
            CASE 
              WHEN SUM(d.count) = 0 THEN NULL 
              ELSE GROUP_CONCAT(DISTINCT 
                CASE WHEN d.count > 0 THEN b.filiale END SEPARATOR ', ') 
            END AS filiale,
            CASE 
              WHEN SUM(d.count) = 0 THEN NULL 
              ELSE GROUP_CONCAT(DISTINCT 
                  CASE WHEN d.count > 0 THEN b.id END SEPARATOR ', ') 
            END AS id_filiale
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
    }
}