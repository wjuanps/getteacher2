<?php

require_once '../../../factory/conexao.php';
require_once '../../../dao/excluir.php';
require_once '../../../dao/atualizar.php';
require_once '../../../dao/selecionar.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $acao = strip_tags(trim(filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING)));
    
    switch ($acao) {
    case "apagar":
        try {
            $id = $_POST['id_mensagem'];
            if (is_array($id)) {
                for ($i = 0; $i < count($id); $i++) {
                    delete("sugestoes", "WHERE id_sugestao = '$id[$i]'");
                }
                die(json_encode(array('res' => 'ok')));
            } else {
                $excluir = delete("sugestoes", "WHERE id_sugestao = '$id'");            
                if ($excluir) {
                    die(json_encode(array('res' => 'ok')));
                }
            }
        } catch (PDOException $e) {
            die(json_encode(array('res' => $e->getMessage())));
        }
        break;
    }
    
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    
    $acao = strip_tags(trim(filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING)));
    
    if (!empty($acao)) {
        switch ($acao) {
        case "aprovar":
            
            $artigo = (int) strip_tags(trim(filter_input(INPUT_GET, 'artigo', FILTER_SANITIZE_NUMBER_INT)));
            
            if (!empty($artigo)) {
                update("status", "1", "blog", "WHERE id_blog = '$artigo'");
            }
            
            header("Location: ../pages/tables/dados.php#artigos");
            
            break;
        case "reprovar":
            $artigo = (int) strip_tags(trim(filter_input(INPUT_GET, 'artigo', FILTER_SANITIZE_NUMBER_INT)));
            
            if (!empty($artigo)) {
                $getStatus = select("blog", "status", "WHERE id_blog = '$artigo'");
                if ($getStatus) {
                    foreach ($getStatus as $s) {
                        $status = $s->status;
                    }
                    if ($status != 2) {
                        update("status", "2", "blog", "WHERE id_blog = '$artigo'");
                    } else {
                        
                        $getImagem = select("blog", "imagem", "WHERE id_blog = '$artigo'");
                        if ($getImagem) {
                            foreach ($getImagem as $imagem) {
                                $excluirImagem = $imagem->imagem;
                            }
                        }
                        
                        if (delete("blog", "WHERE id_blog = '$artigo'")) {
                            unlink("../../portifolio/$artigo");
                        }
                        
                    }
                }
            }
            header("Location: ../pages/tables/dados.php#artigos");
            break;

        case "excluir-professor":

            $id_professor = (int) strip_tags(trim(filter_input(INPUT_GET, 'id_professor', FILTER_SANITIZE_NUMBER_INT)));

            header("refresh: 0; url=../pages/tables/dados.php#professor");

            if (!empty($id_professor)) {

                $getArquivos = select("professor", "foto_perfil, diploma", "WHERE id_professor = '$id_professor'");
                $getImagemBlog = select("blog", "imagem", "WHERE id_professor = '$id_professor'");
                
                if (delete("professor", "WHERE id_professor = '$id_professor'") &&
                        delete("usuarios", "WHERE id_professor = '$id_professor'") &&
                        delete("telefone", "WHERE id_professor = '$id_professor'") &&
                        delete("formacao", "WHERE id_professor = '$id_professor'") &&
                        delete("blog", "WHERE id_professor = '$id_professor'")) {
                    
                    if ($getArquivos) {
                        foreach ($getArquivos as $arquivo) {
                            $excluir_foto = $arquivo->foto_perfil;
                            $excluir_diploma = $arquivo->diploma;
                        }
                        unlink("../../professor/imagens/perfil/$excluir_foto");
                        unlink("../../professor/imagens/diploma/$excluir_diploma");
                    }
                    
                     if ($getImagemBlog) {
                        foreach ($getImagemBlog as $imagem) {
                            $excluir_imagem = $imagem->imagem;
                        }                            
                        unlink("../../portifolio/$excluir_imagem");
                    }

                    echo "<script>alert('Professor excluido com sucesso!');</script>";
                    
                } else {
                    echo "<script>alert('Não foi possível excluir esse professor');</script>";
                }
            } else {
                echo "<script>alert('O indentificador do professor é inválido');</script>";
            }

            break;

        case "excluir-aluno":

            $id_aluno = (int) strip_tags(trim(filter_input(INPUT_GET, 'id-aluno', FILTER_SANITIZE_NUMBER_INT)));
            
            header("refresh: 0; url=../pages/tables/dados.php#aluno");

            if (!empty($id_aluno)) {

                $getFotoPerfil = select("aluno", "foto_perfil", "WHERE id_aluno = '$id_aluno'");

                if (delete("aluno", "WHERE id_aluno = '$id_aluno'") &&
                    delete("forum", "WHERE id_aluno_forum = '$id_aluno'") &&
                    delete("agendamento", "WHERE id_aluno = '$id_aluno'") &&
                    delete("usuarios", "WHERE id_aluno = '$id_aluno'") &&
                    delete("mensagens", "WHERE id_aluno = '$id_aluno'") &&
                    delete("avaliacoes", "WHERE id_aluno = '$id_aluno'")) {

                    if ($getFotoPerfil) {
                        foreach ($getFotoPerfil as $foto_perfil) {
                            $foto = $foto_perfil->foto_perfil;
                        }
                        unlink("../../aluno/imagens/perfil/$foto");
                    }
                    
                }
            }

        }
    }
    
}

