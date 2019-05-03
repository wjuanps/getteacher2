<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/cadastrar.php';
require_once '../../dao/atualizar.php';
require_once '../../dao/selecionar.php';
require_once '../app/avaliacoes.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty(filter_input(INPUT_POST, 'enviar-avaliacao'))) {
        
        $id_professor = (int) strip_tags(trim(filter_input(INPUT_POST, 'id_professor', FILTER_SANITIZE_NUMBER_INT)));
        $id_aula = (int) strip_tags(trim(filter_input(INPUT_POST, 'id_aula', FILTER_SANITIZE_NUMBER_INT))); 
        $id_aluno = $_SESSION['id_usuario'];
        
        $didatica = strip_tags(trim(filter_input(INPUT_POST, 'cDid', FILTER_SANITIZE_STRING)));
        $conhecimento = strip_tags(trim(filter_input(INPUT_POST, 'cCon', FILTER_SANITIZE_STRING)));
        $simpatia = strip_tags(trim(filter_input(INPUT_POST, 'cSim', FILTER_SANITIZE_STRING)));
        $comentario = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'cCom', FILTER_SANITIZE_STRING))));
        
        $coluna = array(
            "id_professor", "id_aluno", "didatica", "conhecimento",
            "simpatia", "comentario", "data", "status", "id_aula"
        );
        
        $valor = array(
            $id_professor, $id_aluno, $didatica, $conhecimento,
            $simpatia, $comentario, date("Y/m/d H:i:s"), "0", $id_aula
        );
        
        if (inserir($coluna, $valor, "avaliacoes")) {
            
            update("status", "3", "agendamento", "WHERE id_agendamento = $id_aula");
            
            foreach (mediaTotal($id_professor) as $media) {
                update("avaliacao", $media->total, "professor", "WHERE id_professor = $id_professor");
            }
            
            header("location: ./aulas.php");
            exit();
        }
        
        echo "Falha";
        
    }
}
