<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 26/12/2016
 * Time: 20:11
 */
class Totais_Controller
{
    public function getTotais(){
        require_once 'model/Totais_DAO.class.php';
        $td = new Totais_DAO();
        $total = $td->getTotais();
        return $total;
    }
}