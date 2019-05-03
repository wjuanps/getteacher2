<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/cadastrar.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $btnAgendar = strip_tags(trim(filter_input(INPUT_POST, 'btnAgendar')));
    if (!empty($btnAgendar)) {
        if ($_SESSION['tipo_usuario'] == "Aluno") {
            
            $data = strip_tags(trim(filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING)));
            $hora_inicio = strip_tags(trim(filter_input(INPUT_POST, 'inicio-aula', FILTER_SANITIZE_STRING)));
            $tempo_aula = strip_tags(trim(filter_input(INPUT_POST, 'tempo-aula', FILTER_SANITIZE_STRING)));
            $necessidade = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'aNecessidade', FILTER_SANITIZE_STRING))));
            $id_professor = strip_tags(trim(filter_input(INPUT_POST, 'id_professor')));
                        
            $coluna = array(
                "id_aluno", "id_professor", "data", "duracao", "status", "necessidade"
            );
            $valor = array(
                $_SESSION['id_usuario'], $id_professor, date("Y/m/d H:i", strtotime(implode(" ", array($data, $hora_inicio)))),
                $tempo_aula, "0", $necessidade
            );
            
            $enviarSolicitacao = inserir($coluna, $valor, "agendamento");
            
            if ($enviarSolicitacao) {
                header("Location: ../../domain/perfil-professor.php?professor=$id_professor&msg=Sucesso!, aguarde uma resposta do professor.#banner");
            }
            
        } else {
            header("Location: javascript:history.go(-1)");
        }
    } else {
        header("Location: javascript:history.go(-1)");
    }
} else {
    header("Location: javascript:history.go(-1)");
}


