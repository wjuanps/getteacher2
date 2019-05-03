<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function selecionarUsuario() {
    
    if ($_SESSION['tipo_usuario'] == "Professor") {
        $getUsuario = select("professor", "nome_professor AS nome", "WHERE id_professor = '".$_SESSION['id_usuario']."'");
    } else if ($_SESSION['tipo_usuario'] == "Aluno") {
        $getUsuario = select("aluno", "nome_aluno AS nome", "WHERE id_aluno = ".$_SESSION['id_usuario']);
    } else {
        return "Administrador";
    }
    
    foreach ($getUsuario as $usuario) {
        $nome = utf8_encode($usuario->nome);
    }
    
    return $nome;
}