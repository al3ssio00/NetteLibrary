<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/alessio/sviluppo/nette-blog/app/Presenters/BibliotecaModule/templates/Biblioteca/Tables/lazytable.latte */
final class Template_058cfd65d3 extends Latte\Runtime\Template
{
	public const Source = '/home/alessio/sviluppo/nette-blog/app/Presenters/BibliotecaModule/templates/Biblioteca/Tables/lazytable.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '
<form method="get" class="mb-3 d-flex align-items-center gap-3 flex-wrap">
    <div class="d-flex align-items-center gap-2">
        <label for="limit" class="form-label mb-0">Mostra:</label>
        <select name="limit" class="form-select w-auto" onchange="this.form.submit()">
';
		foreach ($limitOptions as $opt) /* line 13 */ {
			echo '                <option value="';
			echo LR\Filters::escapeHtmlAttr($opt) /* line 14 */;
			echo '" ';
			if ($opt === $limit) /* line 14 */ {
				echo 'selected';
			}
			echo '>';
			echo LR\Filters::escapeHtmlText($opt) /* line 14 */;
			echo '</option>
';

		}

		echo '        </select>
        <span class="ms-2">per pagina</span>
    </div>

    <div class="d-flex align-items-center gap-2 ms-auto">
        <label for="search" class="form-label mb-0">Cerca:</label>
        <input
            type="text"
            name="search"
            value="';
		echo LR\Filters::escapeHtmlAttr($search) /* line 25 */;
		echo '"
            class="form-control w-auto"
            placeholder="Filtra risultati..."
            onkeydown="if(event.key === \'Enter\') this.form.submit();"
        >
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
';
		if ($records) /* line 35 */ {
			echo '            <thead class="table-dark">
                <tr>
';
			foreach ($records[0] as $key => $value) /* line 38 */ {
				echo '                        <th>';
				echo LR\Filters::escapeHtmlText($key) /* line 39 */;
				echo '</th>
';

			}

			echo '                    <th>Azione</th>
                </tr>
            </thead>
            <tbody>
';
			foreach ($records as $row) /* line 45 */ {
				echo '                    <tr>
';
				foreach ($row as $key => $value) /* line 47 */ {
					if ($key === 'disponibilita') /* line 48 */ {
						echo '                                <td>
';
						if ($value > 1) /* line 50 */ {
							echo '                                        <span class="badge bg-success">';
							echo LR\Filters::escapeHtmlText($value) /* line 51 */;
							echo ' Disponibili</span>
';
						} elseif ($value == 1) /* line 52 */ {
							echo '                                        <span class="badge bg-success">1 Disponibile</span>
';
						} else /* line 54 */ {
							echo '                                        <span class="badge bg-danger">Non disponibile</span>
';
						}

						echo '                                </td>
';
					} else /* line 58 */ {
						echo '                                <td>';
						echo LR\Filters::escapeHtmlText($value) /* line 59 */;
						echo '</td>
';
					}

				}

				echo '                        <td>
';
				if (isset($row['restituito'])) /* line 63 */ {
					if ($row['restituito'] == 0) /* line 64 */ {
						echo '                                    <a href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('annullo!', ['id_libro' => $row['id_libro'], 'id_biblioteca' => $row['id_filiale'], 'ordine_id' => $row['ordine_id']])) /* line 65 */;
						echo '" class="btn btn-danger btn-sm">
                                        Annulla
                                    </a>
';
					} else /* line 68 */ {
						echo '                                    Azione non disponibile
';
					}
				} elseif ($row['disponibilita'] > 0) /* line 71 */ {
					echo '                                <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('prenota!', ['id_libro' => $row['id'], 'id_filiale' => $row['id_filiale']])) /* line 72 */;
					echo '" class="btn btn-primary btn-sm">Prenota</a>
';
				} else /* line 73 */ {
					echo '                                <button class="btn btn-secondary btn-sm" disabled>Nessuna azione</button>
';
				}

				echo '                        </td>
                    </tr>
';

			}

			echo '            </tbody>
';
		}
		echo '    </table>
</div>

<nav aria-label="Pagination">
    <ul class="pagination justify-content-center mt-4">
        <li class="page-item ';
		if ($current <= 1) /* line 86 */ {
			echo 'disabled';
		}
		echo '">
            <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => max($current - 1, 1), 'limit' => $limit])) /* line 87 */;
		echo '" class="page-link">&laquo;</a>
        </li>

';
		if ($totalPages <= 10) /* line 90 */ {
			for ($i = 1;
			$i <= $totalPages;
			$i++) /* line 91 */ {
				echo '                <li class="page-item ';
				if ($i === $current) /* line 92 */ {
					echo 'active';
				}
				echo '">
                    <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 93 */;
				echo '" class="page-link">';
				echo LR\Filters::escapeHtmlText($i) /* line 93 */;
				echo '</a>
                </li>
';

			}
		} else /* line 96 */ {
			if ($current <= 4) /* line 97 */ {
				for ($i = 1;
				$i <= 5;
				$i++) /* line 98 */ {
					echo '                    <li class="page-item ';
					if ($i === $current) /* line 99 */ {
						echo 'active';
					}
					echo '">
                        <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 100 */;
					echo '" class="page-link">';
					echo LR\Filters::escapeHtmlText($i) /* line 100 */;
					echo '</a>
                    </li>
';

				}
				echo '                <li class="page-item disabled"><span class="page-link">…</span></li>
                <li class="page-item"><a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $totalPages, 'limit' => $limit])) /* line 104 */;
				echo '" class="page-link">';
				echo LR\Filters::escapeHtmlText($totalPages) /* line 104 */;
				echo '</a></li>
';
			} elseif ($current >= $totalPages - 4) /* line 105 */ {
				echo '                <li class="page-item"><a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => 1, 'limit' => $limit])) /* line 106 */;
				echo '" class="page-link">1</a></li>
                <li class="page-item disabled"><span class="page-link">…</span></li>
';
				for ($i = max($totalPages - 5, $current - 2);
				$i <= $totalPages;
				$i++) /* line 108 */ {
					echo '                    <li class="page-item ';
					if ($i === $current) /* line 109 */ {
						echo 'active';
					}
					echo '">
                        <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 110 */;
					echo '" class="page-link">';
					echo LR\Filters::escapeHtmlText($i) /* line 110 */;
					echo '</a>
                    </li>
';

				}
			} else /* line 113 */ {
				echo '                <li class="page-item"><a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => 1, 'limit' => $limit])) /* line 114 */;
				echo '" class="page-link">1</a></li>
                <li class="page-item disabled"><span class="page-link">…</span></li>
';
				for ($i = $current - 1;
				$i <= $current + 1;
				$i++) /* line 116 */ {
					echo '                    <li class="page-item ';
					if ($i === $current) /* line 117 */ {
						echo 'active';
					}
					echo '">
                        <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 118 */;
					echo '" class="page-link">';
					echo LR\Filters::escapeHtmlText($i) /* line 118 */;
					echo '</a>
                    </li>
';

				}
				echo '                <li class="page-item disabled"><span class="page-link">…</span></li>
                <li class="page-item"><a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $totalPages, 'limit' => $limit])) /* line 122 */;
				echo '" class="page-link">';
				echo LR\Filters::escapeHtmlText($totalPages) /* line 122 */;
				echo '</a></li>
';
			}

		}
		echo '
        <li class="page-item ';
		if ($current >= $totalPages) /* line 126 */ {
			echo 'disabled';
		}
		echo '">
            <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => min($current + 1, $totalPages), 'limit' => $limit])) /* line 127 */;
		echo '" class="page-link">&raquo;</a>
        </li>
    </ul>
</nav>
';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['opt' => '13', 'key' => '38, 47', 'value' => '38, 47', 'row' => '45'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		$limitOptions = [5, 10, 25, 50, 100] /* line 1 */;
		$totalRecords ??= array_key_exists('totalRecords', get_defined_vars()) ? null : 0 /* line 2 */;
		$limit ??= array_key_exists('limit', get_defined_vars()) ? null : 10 /* line 3 */;
		$current ??= array_key_exists('current', get_defined_vars()) ? null : 1 /* line 4 */;
		$safeLimit = $limit > 0 ? $limit : 1 /* line 6 */;
		$totalPages = ceil($totalRecords / $safeLimit) /* line 7 */;
		return get_defined_vars();
	}
}
