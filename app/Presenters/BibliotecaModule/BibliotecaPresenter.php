<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Models\BibliotecaModel;
use Nette;


class BibliotecaPresenter extends Backend
{
    

    public $bibliotecaModel;

    public function __construct(BibliotecaModel $biblioteca) { 
        $this->bibliotecaModel = $biblioteca;
    }
    
    protected function startup(): void {
        parent::startup();
        #$this->template->appName = APPNAME;
        //$this->hashids = new MyHashids();
    }


    // Function to display the library books
    public function renderDefault(int $current = 1, int $limit = 10, ?string $search = null): void {
        $this->template->title = 'Biblioteca';
        $this->template->message = 'Biblioteca';
        $dataset_example = $this->bibliotecaModel->getLibri();
        $this->template->books = $dataset_example;
        bdump($this->template->books);
        

        // Application of the filter only if the search parameter is present  
        if ($search !== null && trim($search) !== '') {
            $searchLower = mb_strtolower(trim($search));

            $dataset_example = array_filter($dataset_example, function ($row) use ($searchLower) {
                foreach ($row as $value) {
                    if (stripos((string)$value, $searchLower) !== false) {
                        return true;
                    }
                }
                return false;
            });

            $dataset_example = array_values($dataset_example); // Re-index the array to avoid errors index 0
        }

        $totalRecords = count($dataset_example);
        $offset = ($current - 1) * $limit;
        $pageData = array_slice($dataset_example, $offset, $limit);
        $columns = ($totalRecords>0) ? array_keys((array)$dataset_example[0] ?? []) : [];

        
        $this->template->records = $pageData;
        $this->template->columns = $columns;
        $this->template->totalRecords = $totalRecords;
        $this->template->current = $current;
        $this->template->limit = $limit;
        $this->template->search = $search;
    }


    // Function for reserving library books
    public function handlePrenota(int $id_libro, int $id_filiale): void
{   
    $user_id = $this->getUser()->getId();
    bdump($user_id);
    $this->bibliotecaModel->prenotaLibro($id_libro, $id_filiale,$user_id);
    $this->flashMessage('Libro prenotato con successo!', 'success');
    $this->redirect('this'); // aggiorna la pagina dopo la prenotazione
}




}
