<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    function inserir($coluna, $valor, $tabela) {
        try {
            
            $pdo = Conection::connect();
            if ((is_array($coluna)) && (is_array($valor))) {
                if (count($coluna) == count($valor)) {
                    $inserir = $pdo->prepare("INSERT INTO {$tabela} (" . implode(', ', $coluna) . ") VALUES ('" . implode('\', \'', $valor) . "')");
                } else {
                    return false;
                }
            } else {
                $inserir = $pdo->prepare("INSERT INTO {$tabela} ({$coluna}) VALUES ('{$valor}'");
            }

            if ($pdo) {
                if ($inserir->execute()) {
                    return $pdo;
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

?>