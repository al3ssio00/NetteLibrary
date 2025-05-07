<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/alessio/sviluppo/nette-blog/app/Presenters/AnnulloModule/templates/Annullo/default.latte */
final class Template_c6d2fc518d extends Latte\Runtime\Template
{
	public const Source = '/home/alessio/sviluppo/nette-blog/app/Presenters/AnnulloModule/templates/Annullo/default.latte';

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

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<div class="container table-container">
  <h1 class="mb-4 text-center">Prenotazioni Attive</h1>

  <!-- Messaggio di conferma o errore -->
  <div id="alert" class="alert alert-success text-center" style="display: none;">
    <!-- Messaggio -->
    Prenotazione annullata con successo!
  </div>

';
		$this->createTemplate('Tables/lazytable.latte', $this->params, 'include')->renderToContentType('html') /* line 12 */;
		echo '
  <script>
  // Nasconde il messaggio dopo 2.5 secondi
  setTimeout(() => {
    const alertBox = document.getElementById("alert");
    if (alertBox) alertBox.style.display = "none";
  }, 2500);
</script>
</div>
';
	}
}
