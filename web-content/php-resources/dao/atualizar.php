<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function update($coluna, $valor, $tabela, $where) {
    
    try {
        
        $pdo = Conection::connect();
    
        if ((is_array($coluna)) && (is_array($valor))) {
            if (count($coluna) == count($valor)) {
                
                $valorColuna = \NULL;
                
                for ($i = 0; $i < count($coluna); $i++) {
                    $valorColuna .= "{$coluna[$i]} = '{$valor[$i]}',";
                }
                
                $valorColuna = substr($valorColuna, 0, -1);
                
                $atualizar = $pdo->prepare("UPDATE {$tabela} SET {$valorColuna} {$where}");
                
            } else {
                return false;
            }
        } else {
            $atualizar = $pdo->prepare("UPDATE {$tabela} SET {$coluna} = '{$valor}' {$where}");
        }

        if ($pdo) {
            if ($atualizar->execute()) {
                return true;
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
