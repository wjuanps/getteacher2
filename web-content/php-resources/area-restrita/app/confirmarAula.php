<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/cadastrar.php';
require_once '../../dao/atualizar.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $confirmar = strip_tags(trim(filter_input(INPUT_POST, 'confirmar', FILTER_SANITIZE_STRING)));
    $recusar = strip_tags(trim(filter_input(INPUT_POST, 'recusar', FILTER_SANITIZE_STRING)));
    $id_aluno = strip_tags(trim(filter_input(INPUT_POST, 'id_aluno', FILTER_SANITIZE_STRING)));
    $id_aula = strip_tags(trim(filter_input(INPUT_POST, 'id_aula', FILTER_SANITIZE_STRING)));
    $mensagem = strip_tags(trim(filter_input(INPUT_POST, 'agen-mensagem', FILTER_SANITIZE_STRING)));
     
    $aux = false;
    if (!empty($confirmar)) {
        $aux = true;
        if (update("status", "1", "agendamento", "WHERE id_professor = '".$_SESSION['id_usuario']."' AND id_aluno = $id_aluno AND status = 0 AND id_agendamento = $id_aula")) {
            $msg = "Aula marcada com sucesso!";
        } else {
            $msg = "Falha ao marcar a aula, tente novamente mais tarde.";
        }
    } else if (!empty($recusar)) {
        $aux = true;
        if (update("status", "2", "agendamento", "WHERE id_professor = '".$_SESSION['id_usuario']."' AND id_aluno = $id_aluno AND status = 0 AND id_agendamento = $id_aula")) {
            $msg = "Aula recusada!";
        } else {
            $msg = "Falha ao recusar a aula, tente novamente mais tarde!";
        }
    }
    
    if ($mensagem != '' && $aux) {
        
        $coluna = array(
            "id_professor", "id_aluno", "time", "data", "mensagem",
            "status", "remetente", "destinatario"
        );
        $valor = array(
            $_SESSION['id_usuario'], $id_aluno, time(), date("Y/m/d H:i:s"),
            utf8_decode($mensagem), "0", $_SESSION['id_usuario'], $id_aluno
        );
        
        inserir($coluna, $valor, "mensagens");
        
    }
    
    header("Location: ../professor/index.php?mensagem=$msg");
    
}