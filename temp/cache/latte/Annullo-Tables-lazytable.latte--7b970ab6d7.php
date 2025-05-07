<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/alessio/sviluppo/nette-blog/app/Presenters/AnnulloModule/templates/Annullo/Tables/lazytable.latte */
final class Template_7b970ab6d7 extends Latte\Runtime\Template
{
	public const Source = '/home/alessio/sviluppo/nette-blog/app/Presenters/AnnulloModule/templates/Annullo/Tables/lazytable.latte';


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
		foreach ($limitOptions as $opt) /* line 14 */ {
			echo '                <option value="';
			echo LR\Filters::escapeHtmlAttr($opt) /* line 15 */;
			echo '" ';
			if ($opt === $limit) /* line 15 */ {
				echo 'selected';
			}
			echo '>';
			echo LR\Filters::escapeHtmlText($opt) /* line 15 */;
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
		echo LR\Filters::escapeHtmlAttr($search) /* line 26 */;
		echo '"
            class="form-control w-auto"
            placeholder="Filtra risultati..."
            onkeydown="if(event.key === \'Enter\') this.form.submit();"
        >
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
';
		foreach ($columns as $column) /* line 38 */ {
			echo '                    <th>';
			echo LR\Filters::escapeHtmlText($column) /* line 39 */;
			echo '</th> 
';

		}

		echo '                <th>Azione</th>
            </tr>
        </thead>
        <tbody>
';
		foreach ($records as $row) /* line 45 */ {
			echo '                <tr>
';
			foreach ($row as $key => $cell) /* line 47 */ {
				echo '                        <td>';
				echo LR\Filters::escapeHtmlText($cell) /* line 48 */;
				echo '</td>
';

			}

			echo '                    <td>
';
			if (isset($row['restituito'])) /* line 51 */ {
				if ($row['restituito'] == 0) /* line 52 */ {
					echo '                                <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('annullo!', ['id_libro' => $row['id_libro'], 'id_biblioteca' => $row['id_filiale'], 'ordine_id' => $row['ordine_id']])) /* line 53 */;
					echo '" class="btn btn-danger btn-sm">
                                    Annulla
                                </a>
';
				} else /* line 58 */ {
					echo '                                Azione non disponibile
';
				}
			} else /* line 61 */ {
				echo '                            -
';
			}
			echo '                    </td>
                </tr>
';

		}

		echo '        </tbody>
    </table>
</div>

<nav aria-label="Pagination">
    <ul class="pagination justify-content-center mt-4">
        <li class="page-item ';
		if ($current <= 1) /* line 73 */ {
			echo 'disabled';
		}
		echo '">
            <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => max($current - 1, 1), 'limit' => $limit])) /* line 74 */;
		echo '" class="page-link">&laquo;</a>
        </li>

';
		if ($totalPages <= 10) /* line 77 */ {
			for ($i = 1;
			$i <= $totalPages;
			$i++) /* line 78 */ {
				echo '                <li class="page-item ';
				if ($i === $current) /* line 79 */ {
					echo 'active';
				}
				echo '">
                    <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 80 */;
				echo '" class="page-link">';
				echo LR\Filters::escapeHtmlText($i) /* line 80 */;
				echo '</a>
                </li>
';

			}
		} else /* line 83 */ {
			if ($current <= 4) /* line 84 */ {
				for ($i = 1;
				$i <= 5;
				$i++) /* line 85 */ {
					echo '                    <li class="page-item ';
					if ($i === $current) /* line 86 */ {
						echo 'active';
					}
					echo '">
                        <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 87 */;
					echo '" class="page-link">';
					echo LR\Filters::escapeHtmlText($i) /* line 87 */;
					echo '</a>
                    </li>
';

				}
				echo '                <li class="page-item disabled"><span class="page-link">…</span></li>
                <li class="page-item">
                    <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $totalPages, 'limit' => $limit])) /* line 92 */;
				echo '" class="page-link">';
				echo LR\Filters::escapeHtmlText($totalPages) /* line 92 */;
				echo '</a>
                </li>
';
			} elseif ($current >= $totalPages - 4) /* line 94 */ {
				echo '                <li class="page-item">
                    <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => 1, 'limit' => $limit])) /* line 96 */;
				echo '" class="page-link">1</a>
                </li>
                <li class="page-item disabled"><span class="page-link">…</span></li>
';
				for ($i = max($totalPages - 5, $current - 2);
				$i <= $totalPages;
				$i++) /* line 99 */ {
					echo '                    <li class="page-item ';
					if ($i == $current) /* line 100 */ {
						echo 'active';
					}
					echo '">
                        <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 101 */;
					echo '" class="page-link">';
					echo LR\Filters::escapeHtmlText($i) /* line 101 */;
					echo '</a>
                    </li>
';

				}
			} else /* line 104 */ {
				echo '                <li class="page-item">
                    <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => 1, 'limit' => $limit])) /* line 106 */;
				echo '" class="page-link">1</a>
                </li>
                <li class="page-item disabled"><span class="page-link">…</span></li>
';
				for ($i = $current - 1;
				$i <= $current + 1;
				$i++) /* line 109 */ {
					echo '                    <li class="page-item ';
					if ($i === $current) /* line 110 */ {
						echo 'active';
					}
					echo '">
                        <a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $i, 'limit' => $limit])) /* line 111 */;
					echo '" class="page-link">';
					echo LR\Filters::escapeHtmlText($i) /* line 111 */;
					echo '</a>
                    </li>
';

				}
				echo '                <li class="page-item disabled"><span class="page-link">…</span></li>
                <li class="page-item">
                    <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => $totalPages, 'limit' => $limit])) /* line 116 */;
				echo '" class="page-link">';
				echo LR\Filters::escapeHtmlText($totalPages) /* line 116 */;
				echo '</a>
                </li>
';
			}

		}
		echo '
        <li class="page-item ';
		if ($current >= $totalPages) /* line 121 */ {
			echo 'disabled';
		}
		echo '">
            <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('this', ['current' => min($current + 1, $totalPages), 'limit' => $limit])) /* line 122 */;
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
			foreach (array_intersect_key(['opt' => '14', 'column' => '38', 'row' => '45', 'key' => '47', 'cell' => '47'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		$limitOptions = [5, 10, 25, 50, 100] /* line 1 */;
		$totalRecords ??= array_key_exists('totalRecords', get_defined_vars()) ? null : 0 /* line 2 */;
		$limit ??= array_key_exists('limit', get_defined_vars()) ? null : 10 /* line 3 */;
		$current ??= array_key_exists('current', get_defined_vars()) ? null : 1 /* line 4 */;
		$safeLimit = $limit > 0 ? $limit : 1 /* line 6 */;
		$totalPages = ceil($totalRecords / $safeLimit) /* line 7 */;
		$size = min(10, $totalPages) /* line 8 */;
		return get_defined_vars();
	}
}
