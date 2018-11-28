<?php
require_once 'conecta.php';

class ctrBook{
    public function buscaCategoria(){
        $db = new conecta();
        $res = $db->buscaCategoria();
        return $res;
    }

    public function livros(){
        $db = new conecta();
        $res = $db->livros();
        return $res;
    }

    public function search($busca){
        $db = new conecta();
        $res = $db->search($busca);
        return $res;
    }

    public function buscaLivroCategoria($id){
        $db = new conecta();
        $res = $db->buscaLivroCategoria($id);
        return $res;
    }

    public function autores($ISBN){
        $db = new conecta();
        $res = $db->autores($ISBN);
        return $res;
    }

    public function retornaLivro($ISBN){
        $db = new conecta();
        $res = $db->retornaLivro($ISBN);
        return $res;
    }
}

?>