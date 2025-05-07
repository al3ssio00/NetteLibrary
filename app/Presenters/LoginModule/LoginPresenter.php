<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Models\LoginModel;
use App\Models\PrenotazioneModel;
use Nette\Application\UI\Form;
use Nette\Security\Authenticator;
use Nette\Security\MyAuthorizator;
use stdClass;

class LoginPresenter extends Frontend
{
	public $parameters;
	public $model;
	private Authenticator $authenticator;

	public function __construct(LoginModel $biblioteca, Authenticator $authenticator)
	{ 
		$this->model = $biblioteca;
		$this->authenticator = $authenticator;
	}
	
	protected function startup(): void {
		parent::startup();
	}

	/*public function renderDefault(): void {
		$this->template->title = 'Biblioteca';
		$this->template->message = 'Biblioteca';
		$this->template->books = $this->model->getLibri();
		bdump($this->template->books);
	}

	public function renderPaginap(): void {
		$this->template->title = 'Paginap';
		$this->template->message = 'Biblioteca';
		$r = $this->model->getLibri();
		bdump($r);
		$this->template->data = $r;
	}*/

	public function renderDefault(): void {
		$this->redirect('Login:default');

		
	}
	public function renderRegistrazione(): void {
		$this->template->title = 'Sign-Up';
	}

	public function renderLogin(): void {
		$this->template->title = 'Login';
	}

	protected function createComponentLoginc(): Form {
		$this->parameters = $this->getParameters();

		$form = new Form;   
		$form->addText('utente', 'Username')->setRequired('Please enter your username'); 
		$form->addPassword('password', 'Password:')->setRequired('Inserisci la password.');
		$form->addSubmit('submit', 'Login');
		$form->onSuccess[] = [$this, 'loginSucceeded'];
		return $form;
	}

	public function loginSucceeded(Form $form, stdClass $data)
	{
		bdump('LoginSucceeded called');
		try {
			$user = $this->getUser();
			$user->setAuthenticator($this->authenticator);
			$user->login($data->utente, $data->password);
	
			$authorizator = new MyAuthorizator();
			$this->getUser()->setAuthorizator($authorizator);
	
			$permessi = $this->getUser()->identity->permessi;
			bdump($permessi, 'Permessi utente');
	
			if ($permessi == 2) { // admin
				$this->redirect('Annullo:default');
			} else {
				$this->redirect('Biblioteca:default');
			}
	
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError('Nome utente o password errati.');
		}
	}

	public function renderLogout(){

        $x = $this->getUser()->logout(true);
		bdump($x, 'Logout');
        $this->redirect("Login:login");
    }	
}
