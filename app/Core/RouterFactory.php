<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList;

        // GENERALE: gestisce anche LoginModule, BibliotecaModule ecc.
        $router->addRoute('<module>/<presenter>/<action>[/<id>]');

        // FALLBACK: se non viene indicato il modulo
        $router->addRoute('<presenter>/<action>[/<id>]', 'Biblioteca:default');

        return $router;
    }
}
