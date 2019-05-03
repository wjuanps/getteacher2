<?php
session_start();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set('America/Belem');

require_once '../factory/conexao.php';
include_once '../dao/cadastrar.php';
require_once '../bean/Professor.php';
require_once '../dao/selecionar.php';
require_once 'validarCadastro.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['btnCadastrarProfessor'])) {

        $professor = new Professor();

        /* DADOS PESSOAIS */
        $professor->setNome(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)))));
        $professor->setTelefone(strip_tags(trim(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING))));
        $professor->setCpf(strip_tags(trim(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING))));
        $professor->setGenero(strip_tags(trim(filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING))));
        $professor->setDataNascimento(strip_tags(trim(filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING))));
        $professor->setSobre(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'sobre', FILTER_SANITIZE_STRING)))));
        
        $nomeProfessor = implode(" ", array($professor->getNome(), utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'sNome', FILTER_SANITIZE_STRING))))));
        //FIM DADOS PESSOAIS

        /* ENDEREÇO */
        $professor->setCep(strip_tags(trim(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING))));
        $professor->setEstado(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING)))));
        $professor->setCidade(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING)))));
        $professor->setBairro(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING)))));
        $professor->setLogradouro(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_STRING)))));
        $professor->setNumero(strip_tags(trim(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT))));
        $professor->setComplemento(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING)))));
        //FIM ENDEREÇO

        /* DADOS ACADÊMICOS */
        $professor->setArea(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'area', FILTER_SANITIZE_STRING)))));
        $professor->setCategoria(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING)))));
        $professor->setEspecialidade(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'especialidade', FILTER_SANITIZE_STRING)))));
        $professor->setTipoAula(strip_tags(trim(filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING))));
        $professor->setHoraAula(strip_tags(trim(filter_input(INPUT_POST, 'hora-aula', FILTER_SANITIZE_STRING))));
        $professor->setAvaliacao(1);
        //FIM DADOS ACADÊMICOS

        /* DADOS USUÁRIO */
        $professor->setEmail(strip_tags(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING))));
        $professor->setNomeUsuario(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'nomeUsuario', FILTER_SANITIZE_STRING)))));
        $professor->setSenha(utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)))));
        //FIM DADOS USUÁRIO

        if (empty($professor->getSenha())) {
            header("location:../../pages/cadastro-professor.php?x=x&cuidado=Atenção!&mensagem=Senha Inválida");
        }

        if (isset($_FILES['foto'])) {

            $extensao = strtolower(substr($_FILES['foto']['name'], -4));
            $nomeFoto = md5(time()) . $extensao;

            $diretorio = "../area-restrita/professor/imagens/perfil";
            $professor->setFoto($nomeFoto);

            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . "/" . $nomeFoto);
        } else {
            echo "Arquivo Inválido!";
        }

        if (isset($_FILES['diploma'])) {

            $extensao = strtolower(substr($_FILES['diploma']['name'], -4));
            $nomeDiploma = md5(time()).$extensao;

            $diretorio = "../area-restrita/professor/imagens/diploma";
            $professor->setDiploma($nomeDiploma);

            move_uploaded_file($_FILES['diploma']['tmp_name'], $diretorio."/".$nomeDiploma);
        } else {
            echo "Arquivo Inválido!";
        }

        try {

            if (!validarCampo($professor->getEmail(), "email", "usuarios")) {
                header("location: ../../pages/cadastro-professor.php?x=x&cuidado=Atenção!&mensagem=Email já está cadastrado em nossa base de dados");
            } else if (!validarCpf($professor->getCpf())) {
                header("location:../../pages/cadastro-professor.php?x=x&cuidado=Atenção!&mensagem=CPF já está cadastrado em nossa base de dados");
            } else if (!validarCampo($professor->getNomeUsuario(), "usuario", "usuarios")) {
                header("location:../../pages/cadastro-professor.php?x=x&cuidado=Atenção!&mensagem=Usuario já está cadastrado em nossa base de dados");
            } else {
                                                
                $id_professor = gerarIdProfessor();
                
                $colunas = array(
                    "id_professor","nome_professor", "cpf", "genero", "data_nascimento",
                    "area", "categoria", "especialidade", "foto_perfil", "diploma",
                    "sobre", "hora_aula", "tipo_aula", "avaliacao",
                    "cep", "estado", "cidade", "bairro", "logradouro", 
                    "numero", "complemento", "data_cadastro"
                );

                $valores = array(
                    $id_professor, $nomeProfessor, $professor->getCpf(), $professor->getGenero(),
                    $professor->getDataNascimento(), $professor->getArea(),
                    $professor->getCategoria(), $professor->getEspecialidade(),
                    $professor->getFoto(), $professor->getDiploma(), $professor->getSobre(), 
                    $professor->getHoraAula(), $professor->getTipoAula(), 
                    $professor->getAvaliacao(), $professor->getCep(), $professor->getEstado(), 
                    $professor->getCidade(), $professor->getBairro(), $professor->getLogradouro(), 
                    $professor->getNumero(), $professor->getComplemento(),
                    date("Y/m/d H:i:s")
                );
                
                /* INSERE OS DADOS NO BANCO DE DADOS */
                $id = inserir($colunas, $valores, "professor");
                if ($id) {
                    $colunaUsuario = array(
                        "id_professor", "email", "usuario", "tipo_usuario", "senha_usuario"
                    );
                    
                    $valoresUsuario = array(
                        $id_professor, $professor->getEmail(), $professor->getNomeUsuario(),
                        "Professor", $professor->getSenha()
                    );
                    
                    if (inserir($colunaUsuario, $valoresUsuario, "usuarios")) {

                        $colunaFormacao = array(
                            "id_professor", "nivel", "curso", "instituicao", "ano_inicio", "ano_termino"         
                        );
                        $valorFormacao = array(
                            $id_professor, "", "", "", date("Y"), date("Y")
                        );

                        inserir($colunaFormacao, $valorFormacao, "formacao");

                        $telefone = implode(" ", array(strip_tags(trim(filter_input(INPUT_POST, 'ddd'))), $professor->getTelefone()));
                        inserir(array("telefone", "id_professor"), array($telefone, $id_professor), "telefone");
                    } 
                    
                    $_SESSION['acessarUsuario'] = $professor->getNomeUsuario();
                    $_SESSION['senhaUsuario'] = $professor->getSenha();

                    header("Location: wait.php");
                    
                }
                
            }
            
        } catch (PDOException $e) {
            return false;
        }
    }
}

function gerarIdProfessor() {
    $aux = 0;
    for ($i = 0; $i < rand(7, 10); $i++) {
        $aux += rand();
    }

    $getId = Conection::connect()->query("SELECT id_professor FROM professor WHERE id_professor = '$aux'");

    if ($getId->rowCount() > 0) {
        gerarIdProfessor();
    } else {
        return $aux;
    }
}