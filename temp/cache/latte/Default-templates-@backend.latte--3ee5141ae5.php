<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/alessio/sviluppo/nette-blog/app/Presenters/Default/templates/@backend.latte */
final class Template_3ee5141ae5 extends Latte\Runtime\Template
{
	public const Source = '/home/alessio/sviluppo/nette-blog/app/Presenters/Default/templates/@backend.latte';

	public const Blocks = [
		['scripts' => 'blockScripts'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '
<!DOCTYPE html>
<html lang="it">
	<!--begin::Head-->
	<head>
		<meta charset="UTF-8">
		<title>';
		echo LR\Filters::escapeHtmlText($title) /* line 7 */;
		echo '</title>
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body class="bg-light">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Biblioteca:default')) /* line 16 */;
		echo '" class="navbar-brand">Home</a>
				<div class="collapse navbar-collapse">
				<ul class="navbar-nav">
					<!-- Link sempre visibile per gli admin -->
';
		foreach ($navbar as $link) /* line 20 */ {
			if ($link['title_control'] === 1) /* line 21 */ {
				echo '						
';
			} else /* line 23 */ {
				echo '							<li class="nav-item">
								<a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link($link['link'])) /* line 25 */;
				echo '" class="nav-link">';
				echo LR\Filters::escapeHtmlText($link['label']) /* line 25 */;
				echo '</a>
							</li>
';
			}

		}

		echo '					
					
				</ul>
				</div>
			</div>
		</nav>
			
';
		$this->renderBlock('content', [], 'html') /* line 36 */;
		echo '


';
		$this->renderBlock('scripts', get_defined_vars()) /* line 40 */;
		echo '
	</body>
	<!--end::Body-->
</html>';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['link' => '20'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block scripts} on line 40 */
	public function blockScripts(array $ʟ_args): void
	{
	}
}
