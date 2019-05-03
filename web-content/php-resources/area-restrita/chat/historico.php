<?php

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';
require_once '../../dao/cadastrar.php';

if (!empty(strip_tags(trim(filter_input(INPUT_POST, "acao", FILTER_SANITIZE_NUMBER_INT))))) {

        $acao = strip_tags(trim(filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING)));

        switch ($acao) {

        case "recuperar-historico":    

            $id_conversa = strip_tags(trim(filter_input(INPUT_POST, "id_conversa", FILTER_SANITIZE_NUMBER_INT)));
            $id_usuarioOnline = strip_tags(trim(filter_input(INPUT_POST, "id_usuario", FILTER_SANITIZE_NUMBER_INT)));

            if (tipoUsuario($id_usuarioOnline) == "Professor") {
                $pegaMensagens = select("mensagens m, aluno a, professor p", "m.remetente, m.destinatario, m.mensagem, m.id_mensagem, m.data, p.foto_perfil AS foto_professor, a.foto_perfil AS foto_aluno, a.nome_aluno AS nome", "WHERE $id_usuarioOnline IN (m.destinatario, m.remetente) AND $id_conversa IN (m.id_professor, m.id_aluno) AND $id_conversa != $id_usuarioOnline AND p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno", "ORDER BY m.id_mensagem DESC");
            } else {                
                $pegaMensagens = select("mensagens m, aluno a, professor p", "m.remetente, m.destinatario, m.mensagem, m.id_mensagem, m.data, p.foto_perfil AS foto_professor, a.foto_perfil AS foto_aluno, p.nome_professor AS nome", "WHERE $id_usuarioOnline IN (m.destinatario, m.remetente) AND $id_conversa IN (m.id_professor, m.id_aluno) AND $id_conversa != $id_usuarioOnline AND p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno", "ORDER BY m.id_mensagem DESC");
            }
            
            $mensagens = array();
            if ($pegaMensagens) {
                foreach ($pegaMensagens as $mensagem) {
                    $foto = '';
                    if ($mensagem->remetente == $id_usuarioOnline) {
                        if (tipoUsuario($mensagem->remetente) == "Aluno") {
                            $foto = "../aluno/imagens/perfil/".$mensagem->foto_aluno;
                        } else {
                            $foto = "../professor/imagens/perfil/".$mensagem->foto_professor;
                        }
                    } else if ($mensagem->destinatario == $id_usuarioOnline) {
                        if (tipoUsuario($mensagem->destinatario) == "Aluno") {
                            $foto = "../professor/imagens/perfil/".$mensagem->foto_professor;
                        } else {
                            $foto = "../aluno/imagens/perfil/".$mensagem->foto_aluno;
                        } 
                    }

                    $mensagens[] = array(
                        'remetente' => $mensagem->remetente,
                        'destinatario' => $mensagem->destinatario,
                        'mensagem' => utf8_encode($mensagem->mensagem),
                        'foto_perfil' => $foto,
                        'id' => $mensagem->id_mensagem,
                        'data' => date("d/m/Y H:i", strtotime($mensagem->data)),
                        'nome' => utf8_encode($mensagem->nome)
                    );
                }
            }
            die(json_encode($mensagens));
            break;

        case "not-mensagens": 

            $id_usuario = strip_tags(trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT)));
            $tipo_usuario = tipoUsuario($id_usuario);
            $nomes = array();

            if ($tipo_usuario) {
                if ($tipo_usuario == "Professor") {
                    $pegaNome = select("professor p, mensagens m, aluno a", "*", "WHERE m.id_professor = $id_usuario AND m.status = 0 AND p.id_professor = m.destinatario AND p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno AND a.id_aluno = m.remetente");
                    if (count($pegaNome > 0)) {
                        foreach ($pegaNome as $nome) {
                            $nomes[] = array('nome' => utf8_encode($nome->nome_aluno), 'id_conversa' => $nome->remetente);
                        }
                    } else {
                        $nomes[] = array('nome' => '');
                    }
                } else if ($tipo_usuario == "Aluno") {
                    $pegaNome = select("professor p, mensagens m, aluno a", "*", "WHERE m.id_aluno = $id_usuario AND m.status = 0 AND a.id_aluno = m.destinatario AND a.id_aluno = m.id_aluno AND p.id_professor = m.id_professor AND p.id_professor = m.remetente");
                    if (count($pegaNome > 0)) {
                        foreach ($pegaNome as $nome) {
                            $nomes[] = array('nome' => utf8_encode($nome->nome_professor), 'id_conversa' => $nome->remetente);
                        }
                    } else {
                        $nomes[] = array('nome' => '');
                    }

                }
            }
            die(json_encode($nomes));
            break;

        case "enviar-mensagem":

            $id_conversa = (int) strip_tags(trim(filter_input(INPUT_POST, 'id_conversa', FILTER_SANITIZE_NUMBER_INT)));
            $id_usuario = (int) strip_tags(trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT)));
            $mensagem = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_STRING))));

            $tipo_usuario = tipoUsuario($id_usuario);
            
            if ($mensagem != "") {

                if ($id_conversa != $id_usuario && !empty($id_conversa)) {

                    $coluna = array();
                    $valor = array();

                    if ($tipo_usuario) {
                        if ($tipo_usuario == "Professor") {
                            $coluna = array("id_aluno", "id_professor", "mensagem", "status", "data", "remetente", "destinatario", "time");
                            $valor = array($id_conversa, $id_usuario, $mensagem, '0', date("Y-m-d H:i:s"), $id_usuario, $id_conversa, time());
                        } else if ($tipo_usuario == "Aluno") {
                            $coluna = array("id_aluno", "id_professor", "mensagem", "status", "data", "remetente", "destinatario", "time");
                            $valor = array($id_usuario, $id_conversa, $mensagem, '0', date("Y-m-d H:i:s"), $id_usuario, $id_conversa, time());
                        }
                    }

                    if (inserir($coluna, $valor, "mensagens")) {
                        echo "Ok";
                    } else {
                        echo "falha";
                    }

                } else {
                    echo "falha";
                }
                
            }            
            break;
        }

    } 

function tipoUsuario($id_usuario) {
    $pegaTipo = select("usuarios", "tipo_usuario", "WHERE {$id_usuario} IN (`id_aluno`, `id_professor`)");
    if ($pegaTipo) {
        foreach ($pegaTipo as $tipo) {
            $tipo_usuario = $tipo->tipo_usuario;
        }
        return $tipo_usuario;
    }
    return false;
}