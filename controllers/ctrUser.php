<?php
	require_once 'conecta.php';

	class ctrUser{
		public function buscaEmail($email){
			$db = new conecta();
			$res = $db->buscaEmail($email);
			return $res;
		}
	}

?>