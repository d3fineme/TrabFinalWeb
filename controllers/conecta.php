<?php
	require_once 'C:/xampp/htdocs/TrabFinalWeb/vendor/idiorm.php';
	ORM::configure('mysql:host=localhost;dbname=sandvigbookstore');
	ORM::configure('username', 'root');
	ORM::configure('password', '');
    ORM::configure('id_column_overrides', array(
        'bookcustomers' => 'custID'
    ));
	require_once 'C:/xampp/htdocs/TrabFinalWeb/modals/usuario.php';

	class conecta{
		public function buscaEmail($email){
		    $usuario = ORM::forTable('bookcustomers')->where('email', $email)->findOne();
		    return $usuario;
        }

        public function search($busca){
		    $resultados = ORM::forTable('bookcategories')
                ->join('bookcategoriesbooks', array('bookcategoriesbooks.CategoryID', '=', 'bookcategories.CategoryID'))
                ->join('bookdescriptions', array('bookdescriptions.ISBN', '=', 'bookcategoriesbooks.ISBN'))
                ->join('bookauthorsbooks', array('bookauthorsbooks.ISBN', '=', 'bookdescriptions.ISBN'))
                ->join('bookauthors', array('bookauthors.AuthorID', '=', 'bookauthorsbooks.AuthorID'))
                ->whereAnyIs(array(
                    array('title' => '%'.$busca.'%'),
                    array('description' => '%'.$busca.'%'),
                    array('nameF' => $busca),
                    array('nameL' => $busca)
                ), 'like')
                ->findMany();
		    return $resultados;

        }

        public function buscaLivroCategoria($id){
		    $book = ORM::forTable('bookcategoriesbooks')
                ->join('bookdescriptions',array('bookcategoriesbooks.ISBN','=','bookdescriptions.ISBN'))
                ->where('CategoryID', $id)
                ->findMany();
		    return $book;
        }

        public function livros(){
		    $book = ORM::forTable('bookdescriptions')
                ->select('ISBN')
                ->findMany();
		    return $book;
        }

        public function retornaLivro($ISBN){
		    $book = ORM::forTable('bookdescriptions')
                ->where('ISBN',$ISBN)
                ->findOne();
		    return $book;
        }

        public function historico($idU){
		    $his = ORM::forTable('bookorders')
            ->join('bookorderitems', array('bookorders.orderID', '=', 'bookorderitems.orderID'))
            ->join('bookdescriptions', array('bookdescriptions.ISBN', '=', 'bookorderitems.ISBN'))
            ->where('custID', $idU)
            ->findMany();
		    return $his;
        }

        public function autores($ISBN){
		    $authors = ORM::forTable('bookauthorsbooks')
                ->join('bookauthors', array('bookauthorsbooks.AuthorID', '=', 'bookauthors.AuthorID'))
                ->where('ISBN', $ISBN)
                ->findMany();
		    return $authors;
        }

        public function itensPedido($orderID, $ISBN, $qty, $price){
            $nf = ORM::forTable('bookorderitems')->create();
            $nf->orderID = $orderID;
            $nf->ISBN = $ISBN;
            $nf->qty = $qty;
            $nf->price = ($price*0.8);

            $nf->save();

        }

        public function pedido($custID, $data){
		    $pedido = ORM::forTable('bookorders')->create();
		    $pedido->custID = $custID;
		    $pedido->orderdate = $data;
		    $pedido->save();
		    return $pedido->id();
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
            return $userbd;
        }

        public function atualizaUser(usuario $user, $oldemail){
		    $user1 = ORM::forTable('bookcustomers')
                ->where('email', $oldemail)
                ->findOne();
            $userbd = ORM::forTable('bookcustomers')
                ->findOne($user1['custID']);
		    $userbd->set('fname', $user->getName());
		    $userbd->set('lname', $user->getSobrenome());
            $userbd->set('email', $user->getEmail());
            $userbd->set('street', $user->getStreet());
            $userbd->set('city', $user->getCity());
            $userbd->set('state', $user->getState());
            $userbd->set('zip', $user->getZip());

            $userbd->save();

        }

        public function buscaCategoria(){
		    $bookcat = ORM::forTable('bookcategories')->findMany();
		    return $bookcat;
        }
	}

?>