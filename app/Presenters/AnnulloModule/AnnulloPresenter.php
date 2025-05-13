<?php

namespace App\Presenters;

use App\Models\AnnulloModel;
use Nette;

class AnnulloPresenter extends Backend
{
    private AnnulloModel $annulloModel;

    public function __construct(AnnulloModel $annulloModel)
    {
        parent::__construct();
        $this->annulloModel = $annulloModel;
    }

    protected function startup(): void
    {
        parent::startup();
    }

    public function renderDefault(int $current = 1, int $limit = 10, ?string $search = null): void
    {
        $this->template->title = 'Biblioteca - Annulla Prenotazioni';
        $dataset_example = $this->annulloModel->getPrenotazioniAttive();

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

    // Function to handle the cancellation of a reservation
    public function handleAnnullo(int $id_libro, int $id_biblioteca, int $ordine_id): void
    {
        $this->annulloModel->annullaPrenotazione($id_libro, $id_biblioteca, $ordine_id);
        $this->flashMessage("Prenotazione annullata con successo!", 'success');
        $this->redirect('this');
    }


    public function handleAggiunta(int $refL): void
{
    $disponibilita = $this->annulloModel->disponibilitaLibro($refL);

    if ($disponibilita) {
        $refB = $disponibilita->ref_biblioteca;

        $success = $this->annulloModel->aggiunta_libri($refL, $refB);

        if ($success) {
            $this->flashMessage('Libro aggiunto con successo!', 'success');
        } else {
            $this->flashMessage('Errore: disponibilità non trovata per il libro selezionato.', 'error');
        }

    } else {
        $this->flashMessage('Errore: disponibilità non trovata per questo libro.', 'error');
    }

    $this->redirect('this');
}

    


}
