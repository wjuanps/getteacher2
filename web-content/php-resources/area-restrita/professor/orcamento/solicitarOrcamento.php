<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set("America/Belem");

require_once '../../../factory/conexao.php';
require_once '../../../dao/cadastrar.php';

if (isset($_POST)) {

    $especialidade = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'especialidade', FILTER_SANITIZE_STRING))));
    $nivel         = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_STRING))));
    $tipo_aula     = strip_tags(trim(filter_input(INPUT_POST, 'tipo_aula', FILTER_SANITIZE_STRING)));
    $necessidade   = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'necessidade', FILTER_SANITIZE_STRING))));
    $nome          = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING))));
    $email         = strip_tags(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
    $cep           = strip_tags(trim(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING)));
    $telefone      = strip_tags(trim(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING)));
    $tipo_endereco = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'tipo_endereco', FILTER_SANITIZE_STRING))));

    $id_professor  = strip_tags(trim(filter_input(INPUT_POST, 'id_professor'))); 

    if (isset($_SESSION['usuario']) && $_SESSION['id_usuario'] != $id_professor) { 
        
        $coluna = array("id_aluno", "id_professor", "mensagem", "status", "data", "remetente", "destinatario", "time");
        $valor = array($_SESSION['id_usuario'], $id_professor, $necessidade, '0', date("Y-m-d H:i:s"), $_SESSION['id_usuario'], $id_professor, time());

        inserir($coluna, $valor, "mensagens");
    }

    die(json_encode(array('res' => 'Ok')));    
}