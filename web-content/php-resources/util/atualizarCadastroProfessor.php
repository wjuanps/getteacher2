<?php

session_start();

date_default_timezone_set("America/Belem");

require_once './validarCadastro.php';
require_once '../factory/conexao.php';
require_once '../dao/atualizar.php';
require_once '../dao/selecionar.php';
require_once '../dao/cadastrar.php';

if (isset($_SESSION['id_usuario'])) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $id_usuario = $_SESSION['id_usuario'];

        if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aPerfil', FILTER_SANITIZE_STRING))))) {

            $nome = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING))));
            $sobrenome = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING))));
            $nascimento = strip_tags(trim(filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING)));
            $genero = strip_tags(trim(filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING)));
            $sobre = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'mim', FILTER_SANITIZE_STRING))));

            $nome_completo = implode(" ", array($nome, $sobrenome));

            $coluna = array("nome_professor", "data_nascimento", "genero", "sobre");
            $valor = array($nome_completo, date("Y-m-d", strtotime($nascimento)), $genero, $sobre);

            update($coluna, $valor, "professor", "WHERE `id_professor` = $id_usuario");
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aFoto', FILTER_SANITIZE_STRING))))) {

            if (isset($_FILES['foto'])) {

                $extensao = strtolower(substr($_FILES['foto']['name'], -4));
                $nomeFoto = md5(time()) . $extensao;

                $diretorio = "../area-restrita/professor/imagens/perfil";
                move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . "/" . $nomeFoto);

                $pegaFoto = select("professor", "foto_perfil", "WHERE `id_professor` = $id_usuario");

                if ($pegaFoto != false) {
                    foreach ($pegaFoto as $foto) {
                        $excluirImagem = $foto->foto_perfil;
                    }

                    unlink("../area-restrita/professor/imagens/perfil/$excluirImagem");
                }

                update("foto_perfil", $nomeFoto, "professor", "WHERE `id_professor` = $id_usuario");
            }
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aEndereco', FILTER_SANITIZE_STRING))))) {
            
            $cep = strip_tags(trim(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING)));
            $estado = strip_tags(trim(filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING)));
            $cidade = strip_tags(trim(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING)));
            $bairro = strip_tags(trim(filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING)));
            $logradouro = strip_tags(trim(filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_STRING)));
            $numero = (int)strip_tags(trim(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT)));
            $complemento = strip_tags(trim(filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING)));
            
            $colunaE = array("cep", "estado", "cidade", "bairro", "logradouro", "numero", "complemento");
            $valorE = array($cep, $estado, $cidade, $bairro, $logradouro, $numero, $complemento);
            
            update($colunaE, $valorE, "professor", "WHERE `id_professor` = $id_usuario");         
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aTelefones', FILTER_SANITIZE_STRING))))) {

            $tel = isset($_POST['telefones']) ? $_POST['telefones'] : "0";
            $pegaTelefone = select("telefone", "*", "WHERE `id_professor` = $id_usuario");

            $count = 0;
            foreach ($pegaTelefone as $telefone) {
                $id_telefone = $telefone->id_telefone;
                if (!in_array($telefone->telefone, $tel)) {
                    if ($tel[$count] != " ") {
                        update("telefone", $tel[$count], "telefone", "WHERE `id_professor` = $id_usuario AND `id_telefone` = $id_telefone");
                    }
                }
                $count++;
            }
            
            if (count($tel) > count($pegaTelefone)) {
                for ($i = count($pegaTelefone); $i < count($tel); $i++) {
                    if ($tel[$i] != " ") {
                        inserir(array("telefone", "id_professor"), array($tel[$i], $id_usuario), "telefone");                        
                    }
                }
            }
               
            die(json_encode(array('res' => 'Ok')));
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aFormacao', FILTER_SANITIZE_STRING))))) {

            $nivel = strip_tags(trim(filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_STRING)));
            $curso = strip_tags(trim(filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_STRING)));
            $instituicao = strip_tags(trim(filter_input(INPUT_POST, 'instituicao', FILTER_SANITIZE_STRING)));
            $ano_inicio = strip_tags(trim(filter_input(INPUT_POST, 'ano-inicio', FILTER_SANITIZE_STRING)));
            $ano_termino = strip_tags(trim(filter_input(INPUT_POST, 'ano-termino', FILTER_SANITIZE_STRING)));

            $coluna = array("nivel", "curso", "instituicao", "ano_inicio", "ano_termino");
            $valor = array(utf8_decode($nivel), utf8_decode($curso), utf8_decode($instituicao),  $ano_inicio, $ano_termino);

            update($coluna, $valor, "formacao", "WHERE id_professor = $id_usuario");
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aAulas', FILTER_SANITIZE_STRING))))) {

            $area = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'area', FILTER_SANITIZE_STRING))));
            $categoria = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING))));
            $especializacoes = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'spec', FILTER_SANITIZE_STRING))));
            $tipo_aula = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'tipo-aula', FILTER_SANITIZE_STRING))));
            $preco = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING))));

            $coluna = array("area", "categoria", "especialidade", "tipo_aula", "hora_aula");
            $valor = array($area, $categoria, $especializacoes, $tipo_aula, $preco);

            update($coluna, $valor, "professor", "WHERE `id_professor` = $id_usuario");
            
        } else if (!empty(strip_tags(trim(filter_input(INPUT_POST, 'aConfiguracoes', FILTER_SANITIZE_STRING))))) {
            
            $email = strip_tags(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
            $senha = strip_tags(trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)));
            
            if ($email != "") {
                update("email", $email, "usuarios", "WHERE id_professor = $id_usuario");
            }   
            
            if ($senha != "") {
                update("senha_usuario", $senha, "usuarios", "WHERE id_professor = $id_usuario");
            }
            
        }

        header("location: ../area-restrita/app/editarPerfil.php");
    }
}