<?php
	require_once 'conecta.php';
    require_once 'modals/usuario.php';
	class ctrUser{
		public function buscaEmail($email){
			$db = new conecta();
			$res = $db->buscaEmail($email);
			return $res;
		}

		public function cadastrar($email, $name, $sobrenome, $street, $city, $state, $zip){
		    $db = new conecta();
		    $usuario = new usuario($email, $name, $sobrenome, $street, $city, $state, $zip);
		    $res = $db->cadastra($usuario);
		    return $res;
        }
	}

?>