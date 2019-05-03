<?php
session_start();

/**
 * Created by PhpStorm.
 * User: Juan
 * Date: 22/02/2016
 * Time: 17:23
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    date_default_timezone_set("America/Belem");

    include_once '../bean/Aluno.php';
    require_once '../factory/conexao.php';
    require_once './validarCadastro.php';
    require_once '../dao/selecionar.php';
    require_once '../dao/cadastrar.php';

    $aluno = new Aluno();

    $nome = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "nome-aluno", FILTER_SANITIZE_STRING))));
    $sobrenome = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "sobrenome-aluno", FILTER_SANITIZE_STRING))));
    $email = strip_tags(trim(filter_input(INPUT_POST, "email-aluno", FILTER_SANITIZE_EMAIL)));
    $senha = strip_tags(trim(filter_input(INPUT_POST, "senha-aluno", FILTER_SANITIZE_STRING)));

    $aluno->setNome(!empty($nome) ? $nome : "NULL");
    $aluno->setEmail(!empty($email) ? $email : "NULL");
    $aluno->setSenha(!empty($senha) ? $senha : "NULL");

    $nome_completo = implode(" ", array($aluno->getNome(), $sobrenome));
    
    if (validarCampo($email, "email", "aluno")) {
        if (isset($_FILES['foto'])) {

            $extensao = strtolower(substr($_FILES['foto']['name'], -4));
            $nomeFoto = md5(time()) . $extensao;

            $diretorio = "../area-restrita/aluno/imagens/perfil";
            $aluno->setFoto($nomeFoto);

            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . "/" . $nomeFoto);
        } else {

            echo "Arquivo inválido";

        }

        $colunas = array(
            "nome_aluno", "email", "senha", "data_cadastro", "foto_perfil"
        );

        $valores = array(
            $nome_completo, $aluno->getEmail(), $aluno->getSenha(), date("Y-m-d H:i:s"), $aluno->getFoto()
        );

        $id = inserir($colunas, $valores, "aluno");    
        if ($id) {
            $id_aluno = $id->lastInsertId();
            $colunaUsuario = array(
                "id_aluno", "email", "tipo_usuario", "senha_usuario"
            );
            $valoresUsuario = array(
                $id_aluno, $aluno->getEmail(), "Aluno", $aluno->getSenha()
            );

            inserir($colunaUsuario, $valoresUsuario, "usuarios");

            $_SESSION['acessarUsuario'] = $aluno->getEmail();
            $_SESSION['senhaUsuario'] = $aluno->getSenha();

            header("Location: wait.php");

        } 
    } else {
        header("Location: ../../pages/cadastro-aluno.php?erro=erro");
    }
}