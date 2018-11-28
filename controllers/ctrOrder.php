<?php

require_once 'conecta.php';

class ctrOrder{

    public function pedido($custID, $data){
        $db = new conecta();
        $res = $db->pedido($custID, $data);
        return $res;
    }

    public function itensPedido($orderID, $ISBN, $qty, $price){
        $db = new conecta();
        $db->itensPedido($orderID, $ISBN, $qty, $price);
    }
}

?>