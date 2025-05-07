<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Classes\MyHashids;

class Frontend extends Nette\Application\UI\Presenter {

    public function __construct( ) { }
    
    protected function startup(): void {
        parent::startup();
        $this->template->appName = $this->getParameter('appName');

    }

    protected function beforeRender(): void {
        $this->template->appName = $this->getParameter('appName');
        $this->setLayout(__DIR__.'/templates/@frontend.latte');
    }

}