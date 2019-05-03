<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../factory/conexao.php';
require_once '../dao/atualizar.php';
require_once '../dao/selecionar.php';

if (isset($_SESSION['id_usuario'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $id_usuario = $_SESSION['id_usuario'];
        
        if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aPerfil', FILTER_SANITIZE_STRING))))) {
            
            $nome = strip_tags(trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING)));
            $sobrenome = strip_tags(trim(filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING)));
            
            update("nome_aluno", implode(" ", array($nome, $sobrenome)), "aluno", "WHERE id_aluno = $id_usuario");          
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aFoto', FILTER_SANITIZE_STRING))))) {
            
            if (isset($_FILES['foto'])) {

                $extensao = strtolower(substr($_FILES['foto']['name'], -4));
                $nomeFoto = md5(time()) . $extensao;

                $diretorio = "../area-restrita/aluno/imagens/perfil";
                move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . "/" . $nomeFoto);

                $pegaFoto = select("aluno", "foto_perfil", "WHERE `id_aluno` = $id_usuario");

                if ($pegaFoto != false) {
                    foreach ($pegaFoto as $foto) {
                        $excluirImagem = $foto->foto_perfil;
                    }

                    unlink("../area-restrita/aluno/imagens/perfil/$excluirImagem");
                }

                update("foto_perfil", $nomeFoto, "aluno", "WHERE `id_aluno` = $id_usuario");
            }
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aConfiguracoes', FILTER_SANITIZE_STRING))))) {
            
            $email = strip_tags(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
            $senha = strip_tags(trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)));
            
            if ($email != "") {
                update("email", $email, "usuarios", "WHERE id_aluno = $id_usuario");
            }   
            
            if ($senha != "") {
                update("senha_usuario", $senha, "usuarios", "WHERE id_aluno = $id_usuario");
            }
            
        }
        
        header("location: ../area-restrita/app/editarPerfil.php");
        
    }
}