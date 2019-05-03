<?php 
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/cadastrar.php';
require_once '../../dao/atualizar.php';
require_once '../../dao/selecionar.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (filter_input(INPUT_POST, 'cancelar-aula')) {

		$id_aula = (int) strip_tags(trim(filter_input(INPUT_POST, 'id_aula', FILTER_SANITIZE_NUMBER_INT))); 

		$motivo = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_STRING))));

		if (update("status", "2", "agendamento", "WHERE id_agendamento = '$id_aula'")) {

			$getProfessor = select("professor p INNER JOIN agendamento a", "p.id_professor", "WHERE p.id_professor = a.id_professor AND a.id_agendamento = '$id_aula'");
            $getAluno = select("aluno a INNER JOIN agendamento aa", "a.id_aluno", "WHERE a.id_aluno = aa.id_aluno AND aa.id_agendamento = '$id_aula'");
            
            if ($getProfessor) {
                foreach ($getProfessor as $professor) {
                    $id_professor = $professor->id_professor;
                }
            }
            
            if ($getAluno) {
                foreach ($getAluno as $aluno) {
                    $id_aluno = $aluno->id_aluno;
                }
            }

            $remetente = ($_SESSION['tipo_usuario'] == "Professor") ? $id_professor : $id_aluno;
            $destinatario = ($_SESSION['tipo_usuario'] == "Professor") ? $id_aluno : $id_professor;

            $coluna = array(
                "id_professor", "id_aluno", "time", "data", "mensagem", "status", "remetente", "destinatario"
            );
                        
            $valor = array(
                $id_professor, $id_aluno, time(), date("Y/m/d H:i:s"), $motivo, "0", $remetente, $destinatario
            );

            if (inserir($coluna, $valor, "mensagens")) {
            	header("Location: ./aulas.php");
            	exit();
            }

		}


	}
}