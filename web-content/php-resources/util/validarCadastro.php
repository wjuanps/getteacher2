<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validarCampo($valor, $campo, $tabela) {
    $validar = select($tabela, "*", "WHERE $campo='$valor'");
    if ($validar == 0) {
        return true;
    }
    return false;
}

function validarEmail($email) {
	$validar = select("professor", "*", "WHERE email='$email'");
	if ($validar == 0) {
		return true;
	}
	return false;	
}

function validarCpf($cpf) {
	$validar = select("professor", "*", "WHERE cpf = '$cpf'");
	if ($validar == 0) {
		return true;
	}
	return false;
}

function validarNomeUsuario($nome) {
	$validar = select("usuarios", "*", "WHERE usuario_professor = '$nome'");
	if ($validar == 0) {
		return true;
	}
	return false;
}