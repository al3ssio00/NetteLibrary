<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Classes\MyHashids;

class Backend extends Nette\Application\UI\Presenter {

    public function __construct( ) { }
    
    // Funcion to check if the user is logged in
    protected function startup(): void {
        parent::startup();
        $this->template->appName = $this->getParameter('appName');
        if(!$this->getUser()->isLoggedIn()) {
            $this->redirect('Login:login');
        }

    }

    protected function beforeRender(): void {
        $permessi = $this->getUser()->identity->permessi;
		
        $navbar = [
            ['link' => 'Biblioteca:default', 'label' => 'Home', 'title_control' => 1],
        ];

        if($permessi == 1) {
            $navbar[] = ['link' => 'Login:logout', 'label' => 'Logout', 'title_control' => 0];
        } else if ($permessi == 2) {
            $navbar[] = ['link' => 'Annullo:default', 'label' => 'Prenotazioni', 'title_control' => 0];
            $navbar[] = ['link' => 'Login:logout', 'label' => 'Logout', 'title_control' => 0];

        }

        $this->template->navbar = $navbar;
        $this->template->appName = $this->getParameter('appName');
        $this->setLayout(__DIR__.'/templates/@backend.latte');
    }

}
