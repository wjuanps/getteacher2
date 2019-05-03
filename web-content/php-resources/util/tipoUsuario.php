<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_SESSION['usuario'])) {
    function tipoUsuario($id_usuario) {
        $pegaUsuario = select("usuarios", "tipo_usuario", "WHERE $id_usuario IN (id_professor, id_aluno)");
        
        if ($pegaUsuario) {
            foreach ($pegaUsuario as $usuario) {
                $tipo = $usuario->tipo_usuario;
            }
            return $tipo;
        }
        
        return false;
        
    }
        
}