<?php
	require_once 'vendor/idiorm.php';
	ORM::configure('mysql:host=localhost;dbname=sandvigbookstore');
	ORM::configure('username', 'root');
	ORM::configure('password', '');

	class conecta{
		public function buscaEmail($email){
		    $usuario = ORM::forTable('bookcustomers')->where('email', $email)->findOne();
		    return $usuario;
        }
	}

?>