<?php
	require_once 'conecta.php';
    require_once '../modals/usuario.php';
	class ctrUser{
		public function buscaEmail($email){
			$db = new conecta();
			$res = $db->buscaEmail($email);
			return $res;
		}

		public function historico($idU){
            $db = new conecta();
            $res = $db->historico($idU);
            return $res;
        }

		public function cadastrar($email, $name, $sobrenome, $street, $city, $state, $zip){
		    $db = new conecta();
		    $usuario = new usuario($email, $name, $sobrenome, $street, $city, $state, $zip);
		    $res = $db->cadastra($usuario);
		    return $res;
        }

        public function atualizaUser($email, $name, $sobrenome, $street, $city, $state, $zip){
		    $db = new conecta();
		    $user = new usuario($email, $name, $sobrenome, $street, $city, $state, $zip);
		    $res = $db->atualizaUser($user);
		    return $res;
        }
	}

?>