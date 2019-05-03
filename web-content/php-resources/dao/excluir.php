<?php

function delete($tabela, $where=NULL) {
    
    try {
    
        $pdo = Conection::connect();
        $delete = $pdo->prepare("DELETE FROM {$tabela} {$where}");

        if ($pdo) {
             if ($delete->execute()) {
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

