<?php
 
namespace Nette\Security;
 
use Nette;
 
class MyAuthorizator implements Authorizator {
 
    public function __construct() { }

	public function isAllowed($role, $resource, $operation): bool {
		return $role == 2; // solo admin (2) ha i permessi completi
	}
}
