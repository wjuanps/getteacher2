<?php
session_start();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    date_default_timezone_set("America/Belem");

    $acao = strip_tags(trim(filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING)));
    $acaoPost = strip_tags(trim(filter_input(INPUT_POST, 'acao_post', FILTER_SANITIZE_STRING)));
    
    require_once '../../factory/conexao.php';
    require_once '../../dao/cadastrar.php';
    require_once '../../dao/selecionar.php';

if (!empty($acao)) {
    
    switch ($acao) {
    case "curtir":
        
        $id_usuario = (int) strip_tags(trim(filter_input(INPUT_GET, 'id_usr', FILTER_SANITIZE_NUMBER_INT)));
        $id_post = (int) strip_tags(trim(filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT)));
        
        $curtiu = select("like_blog", "*", "WHERE id_post = '$id_post' AND id_usuario = '$id_usuario'");
        
        if ($curtiu == false AND $id_usuario != 0) {
            $coluna = array(
                "id_usuario", "id_post", "data_like", "status"
            );
            $valor = array(
                $id_usuario, $id_post, date("Y/m/d H:i:s"), "0"
            );

            $inserir = inserir($coluna, $valor, "like_blog");
            if ($inserir) {
                $getLikes = select("like_blog", "COUNT(id_post) AS likes", "WHERE id_post = $id_post");
                foreach ($getLikes as $like) {
                    $total = $like->likes;
                }
                echo $total;
            }
        } else {
            $getLikes = select("like_blog", "COUNT(id_post) AS likes", "WHERE id_post = $id_post");
            foreach ($getLikes as $like) {
                $total = $like->likes;
            }
            echo $total;
        }
        break;

    default :
        break;
    }
}

if (!empty($acaoPost)) {
       
    $id_post = (int) strip_tags(trim(filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT)));
    $id_usuario = (int) strip_tags(trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT)));
    $mensagem = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING))));

    $coluna = array(
        "id_blog", "id_usuario", "data_comentario", "comentario", "status"
    );
    $valor = array(
        $id_post, $id_usuario, date("Y/m/d H:i:s"), $mensagem, "0"
    );

    $inserir = inserir($coluna, $valor, "comentario_blog");
    $src = '';
    if ($inserir) {
        
        if ($_SESSION['tipo_usuario'] == "Aluno") {
            $getComentario = select("comentario_blog c INNER JOIN aluno a", "a.nome_aluno AS nome, a.foto_perfil AS foto, c.data_comentario, c.comentario", "WHERE a.id_aluno = c.id_usuario AND c.id_usuario = $id_usuario AND c.status = 0", "ORDER BY c.id_comentario DESC", "LIMIT 1");
            $src = "../area-restrita/aluno/imagens/perfil/";
        } else if ($_SESSION['tipo_usuario'] == "Professor") {
            $getComentario = select("comentario_blog c INNER JOIN professor p", "p.nome_professor AS nome, p.foto_perfil AS foto, c.data_comentario, c.comentario", "WHERE p.id_professor = c.id_usuario AND c.id_usuario = $id_usuario AND c.status = 0", "ORDER BY c.id_comentario DESC", "LIMIT 1");
            $src = "../area-restrita/professor/imagens/perfil/";
        } else {
            
        }
        
        if ($getComentario) {
            $comentarios = array();
            foreach ($getComentario as $comentario) {
                $comentarios[] = array(
                    'foto' => $src.$comentario->foto,
                    'nome' => utf8_encode($comentario->nome),
                    'data' => date("d/m/Y H:i", strtotime($comentario->data_comentario)),
                    'comentario' => utf8_encode($comentario->comentario)
                );
            }
            die(json_encode(array('res' => $comentarios)));
        }
    }
    die(json_encode(array('res' => false)));
}
