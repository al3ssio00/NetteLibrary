<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/alessio/sviluppo/nette-blog/app/Presenters/LoginModule/templates/Login/registrazione.latte */
final class Template_a8ef7526ae extends Latte\Runtime\Template
{
	public const Source = '/home/alessio/sviluppo/nette-blog/app/Presenters/LoginModule/templates/Login/registrazione.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
    
    <p class="text-white-50 mb-5">Please enter your username and password!</p>

';
		$form = $this->global->formsStack[] = $this->global->uiControl['loginc'] /* line 8 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo '    <form';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), ['method' => null, 'action' => null], false) /* line 8 */;
		echo ' method="POST" action="">
        <div data-mdb-input-init class="form-outline form-white mb-4">
            <input';
		echo ($ʟ_elem = Nette\Bridges\FormsLatte\Runtime::item('utente', $this->global)->getControlPart())->addAttributes(['type' => null, 'id' => null, 'class' => null])->attributes() /* line 10 */;
		echo ' type="text" id="utente" class="form-control form-control-lg" />
            <label class="form-label" for="utente">Username</label>
        </div>
        
          <div data-mdb-input-init class="form-outline form-white mb-5">
            <input';
		echo ($ʟ_elem = Nette\Bridges\FormsLatte\Runtime::item('password', $this->global)->getControlPart())->addAttributes(['type' => null, 'id' => null, 'class' => null])->attributes() /* line 15 */;
		echo ' type="password" id="password" class="form-control form-control-lg" />
            <label class="form-label" for="password">Password</label>
          </div>
                
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                
              ';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(end($this->global->formsStack), false) /* line 8 */;
		echo '</form>
';
		array_pop($this->global->formsStack);
		echo '
              <div>
                <p class="mb-0">Already have an account?</p>
                <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('login')) /* line 37 */;
		echo '" class="text-white-50 fw-bold">Login</a>
              </div>
';
	}
}
