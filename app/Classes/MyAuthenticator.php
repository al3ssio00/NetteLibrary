<?php

declare(strict_types=1);

namespace Nette\Security;

use Nette;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\SimpleIdentity;
use Nette\Security\AuthenticationException;

class MyAuthenticator implements Authenticator
{
    private $database;

    public function __construct(\Nette\Database\Explorer $database)
    {
        $this->database = $database;
    }

    public function authenticate(string $username, string $password): IIdentity
    {
        $row = $this->database->table('utenti')
            ->select('id, username, password, permessi')
            ->where('username', $username)
            ->fetch();

        if (!$row) {
            throw new AuthenticationException('Username o password errati.');
        }

        if ($row->password !== ($password)) {
            throw new AuthenticationException('Username o password errati.');
        }

        return new SimpleIdentity(
            $row->id,
            $row->permessi,
            [
                'username' => $row->username,
                'permessi' => $row->permessi,
            ]
        );
    }
}
