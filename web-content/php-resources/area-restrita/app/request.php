<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $acao = strip_tags(trim(filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING)));
    $id_usuario = $_SESSION['id_usuario'];
    
    if (!empty($acao)) {
        
        switch ($acao) {
        case "agendamentos":
            
            $getAgendamentos = select("agendamento AS ag INNER JOIN aluno AS a", "*", "WHERE ag.id_aluno = a.id_aluno AND ag.id_professor = '$id_usuario' AND ag.status = 0");
            if ($getAgendamentos) {
                $agendamentos = array();
                foreach ($getAgendamentos as $agendamento) {
                    $agendamentos[] = array(
                        'nome' => utf8_encode($agendamento->nome_aluno),
                        'data' => date("d/m/Y H:i", strtotime($agendamento->data)),
                        'duracao' => $agendamento->duracao,
                        'necessidade' => utf8_encode($agendamento->necessidade),
                        'id_aluno' => $agendamento->id_aluno,
                        'id_aula' => $agendamento->id_agendamento
                    );
                }
                die(json_encode(array('res' => $agendamentos)));
            } else {
                die(json_encode(array('res' => false)));
            }
            break;
            
        case "avaliacoes":
            
            break;
        
        case "blog":
            
            $getComentario = select("blog b, comentario_blog c, aluno a", "*", "WHERE b.id_blog = c.id_blog AND a.id_aluno = c.id_usuario AND b.id_professor = '$id_usuario' AND c.status = 0");
            $getLikes = select("like_blog l, aluno a, blog b", "*", "WHERE b.id_blog = l.id_post AND a.id_aluno = l.id_usuario AND b.id_professor = '$id_usuario'");
            
            $comentarios = array();
            if ($getComentario) {
                foreach ($getComentario as $comentario) {
                    $comentarios[] = array( 
                        'id_blog' => $comentario->id_blog,
                        'data_comentario' => date("d/m/Y H:i", strtotime($comentario->data_comentario)),
                        'titulo' => utf8_encode($comentario->titulo),
                        'nome' => utf8_encode($comentario->nome_aluno),
                        'id_professor' => $comentario->id_professor
                    );
                }
            } else {
                $comentarios = false;
            }
            
            $likes = array();
            if ($getLikes) {
                foreach ($getLikes as $like) {
                    $likes[] = array(
                        'id_blog' => $like->id_blog,
                        'data_like' => date("d/m/Y H:i", strtotime($like->data_like)),
                        'titulo' => utf8_encode($like->titulo),
                        'nome' => utf8_encode($like->nome_aluno),
                        'id_professor' => $like->id_professor
                    );
                }
            } else {
                $likes = false;
            }            
            
            die(json_encode(array('comentario' => $comentarios, 'like' => $likes)));
            break;
        
        case "cancelamentos":
            
            break;
        
        case "notificacoes":
            
            $total = 0;
            
            $pegaAvaliacoes = select("avaliacoes a INNER JOIN aluno al", "*", "WHERE a.id_aluno = al.id_aluno AND a.id_professor = '$id_usuario' AND a.status = 0");
            $pegaAgendamentos = select("agendamento a INNER JOIN aluno al", "*", "WHERE a.id_aluno = al.id_aluno AND a.id_professor = '$id_usuario' AND a.status = 0");
            $pegaComentarios = select("comentario_blog c, aluno a, blog b", "*", "WHERE a.id_aluno = c.id_usuario AND c.id_blog = b.id_blog AND b.id_professor = '$id_usuario' AND status = 0");
            $pegaLikes = select("like_blog l, aluno a, blog b", "*", "WHERE a.id_aluno = l.id_usuario AND l.id_post = b.id_blog AND b.id_professor = '$id_usuario' AND l.status = 0");
            
            $avaliacoes = array();
            $agendamentos = array();
            $comentarios = array();
            $likes = array();
            
            if ($pegaAvaliacoes) {
                foreach ($pegaAvaliacoes as $avaliacao) {
                    $avaliacoes[] = array(
                        'nome' => utf8_encode($avaliacao->nome_aluno),
                        'data' => date("d/m/Y", strtotime($avaliacao->data))
                    );
                    $total++;
                }
            } else {
                $avaliacoes = false;
            }        
            
            if ($pegaAgendamentos) {
                foreach ($pegaAgendamentos as $agendamento) {
                    $agendamentos[] = array(
                        'nome' => utf8_encode($agendamento->nome_aluno),
                        'data' => date("d/m/Y H:i", strtotime($agendamento->data))
                    );
                    $total++;
                }
            } else {
                $agendamentos = false;
            }
            
            if ($pegaComentarios) {
                foreach ($pegaComentarios as $comentario) {
                    $comentarios[] = array(
                        'nome' => utf8_encode($comentario->nome_aluno),
                        'data' => date("d/m/Y", strtotime($comentario->data_comentario)),
                        'titulo' => utf8_encode($comentario->titulo),
                        'artigo' => $comentario->id_blog,
                        'professor' => $comentario->id_professor
                    );
                    $total++;
                }
            } else {
                $comentarios = false;
            }
            
            if ($pegaLikes) {
                foreach ($pegaLikes as $like) {
                    $likes[] = array(
                        'nome' => utf8_encode($like->nome_aluno),
                        'data' => date("d/m/Y", strtotime($like->data_like)),
                        'titulo' => utf8_encode($like->titulo),
                        'artigo' => $like->id_blog,
                        'professor' => $like->id_professor
                    );
                    $total++;
                }
            } else {
                $likes = false;
            }
            
            $notificacoes = array(
                'avaliacao' => $avaliacoes, 
                'agendamento' => $agendamentos, 
                'comentario' => $comentarios, 
                'like' => $likes, 
                'total' => $total
            );
            
            die(json_encode($notificacoes));
            break;
        }
        
    }
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    
    $acao = strip_tags(trim(filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING)));
    $id_usuario = $_SESSION['id_usuario'];
    
    $pdo = Conection::connect();
    
    switch ($acao) {
    case "veri-agendamento":
        
        $total_not = $pdo->query("SELECT * FROM `agendamento` WHERE `id_professor` = '$id_usuario' AND `status` = 0");
        $total = $total_not->rowCount();
        
        echo $total;
        break;

    case "nivel":

        $getNivel = select("formacao", "nivel", "WHERE id_professor = '$id_usuario'");
        if ($getNivel) {
            foreach ($getNivel as $nivel) {
                echo utf8_encode($nivel->nivel);
            }
        }

        break;
    }
}
