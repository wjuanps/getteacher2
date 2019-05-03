<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function select($tabela, $coluna = "*", $where = NULL, $order = NULL, $limit = NULL) {

    try {

        $pdo = Conection::connect();
        $sql = $pdo->prepare("SELECT {$coluna} FROM {$tabela} {$where} {$order} {$limit}");
        $sql->execute();
        
        if ($pdo) {
            $query = $sql->fetchAll(PDO::FETCH_OBJ);
            if ($query) {
                return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
}
