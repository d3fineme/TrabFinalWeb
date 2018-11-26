<?php
	require_once '../vendor/idiorm.php';
	ORM::configure('mysql:host=localhost;dbname=sandvigbookstore');
	ORM::configure('username', 'root');
	ORM::configure('password', '');
	require_once '../modals/usuario.php';

	class conecta{
		public function buscaEmail($email){
		    $usuario = ORM::forTable('bookcustomers')->where('email', $email)->findOne();
		    return $usuario;
        }

        public function buscaLivroCategoria($id){
		    $book = ORM::forTable('bookcategoriesbooks')
                ->join('bookdescriptions',array('bookcategoriesbooks.ISBN','=','bookdescriptions.ISBN'))
                ->where('CategoryID', $id)
                ->findMany();
		    return $book;
        }

        public function cadastra(usuario $usuario){
            $userbd = ORM::forTable('bookcustomers')->create();
            $userbd->fname = $usuario->getName();
            $userbd->lname = $usuario->getSobrenome();
            $userbd->email = $usuario->getEmail();
            $userbd->street = $usuario->getStreet();
            $userbd->city = $usuario->getCity();
            $userbd->state = $usuario->getState();
            $userbd->zip = $usuario->getZip();

            $userbd->save();
            return true;
        }

        public function buscaCategoria(){
		    $bookcat = ORM::forTable('bookcategories')->findMany();
		    return $bookcat;
        }
	}

?>