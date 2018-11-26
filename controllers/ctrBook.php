<?php
require_once 'conecta.php';

class ctrBook{
    public function buscaCategoria(){
        $db = new conecta();
        $res = $db->buscaCategoria();
        return $res;
    }

    public function buscaLivroCategoria($id){
        $db = new conecta();
        $res = $db->buscaLivroCategoria($id);
        return $res;
    }
}

?>