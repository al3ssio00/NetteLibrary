<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/alessio/sviluppo/nette-blog/app/Presenters/BibliotecaModule/templates/Biblioteca/paginap.latte */
final class Template_91006f33ec extends Latte\Runtime\Template
{
	public const Source = '/home/alessio/sviluppo/nette-blog/app/Presenters/BibliotecaModule/templates/Biblioteca/paginap.latte';

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


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['key' => '12, 19, 28', 'value' => '12, 19, 28', 'record' => '26'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<div class="card-body">
	<div class="row">
		<div class="col-xl-6 sidebar">
			<table id="datatablesSimple">
';
		if ($data) /* line 8 */ {
			echo '				<thead>
					<tr>
					<!-- FOREACH SUI TH -->
';
			foreach ($data[2] as $key => $value) /* line 12 */ {
				echo '						<th>';
				echo LR\Filters::escapeHtmlText($key) /* line 13 */;
				echo '</th>
';

			}

			echo '					</tr>
				</thead>
				<tfoot>
					<tr>
';
			foreach ($data[2] as $key => $value) /* line 19 */ {
				echo '						<th>';
				echo LR\Filters::escapeHtmlText($key) /* line 20 */;
				echo '</th>
';

			}

			echo '					</tr>
				</tfoot>
				<tbody>
				<!-- FOREACH SUI TD -->
';
			foreach ($data as $record) /* line 26 */ {
				echo '					<tr>
';
				foreach ($record as $key => $value) /* line 28 */ {
					echo '						<th>';
					echo LR\Filters::escapeHtmlText($value) /* line 29 */;
					echo '</th>
';

				}

				echo '					</tr>
';

			}

			echo '				</tbody>
';
		}
		echo '			</table>
		</div>
		<div class="col-xl-6 sidebar">
			<table id="prova">
				<div class="card-body">
					<canvas id="prova" style="width:100%"></canvas>
				</div>
			</table>                    
		</div>
	</div>
</div>
';
	}
}
