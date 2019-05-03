<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set("America/Belem");

require_once './historico.php';

$pdo = Conection::connect();

if (isset($_POST['acao'])) {

    $user = (int) strip_tags(trim(filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT)));
    $timestamp = ($_POST['timestamp'] == 0) ? time() : $_POST['timestamp'];
    $lastid = (isset($_POST['lastid']) && !empty($_POST['lastid'])) ? $_POST['lastid'] : 0;

    if (empty($timestamp)) {
        die(json_encode(array('status' => 'erro')));
    }

    $tempo = 0;
    $sqlLastId = '';

    if (!empty($lastid)) {
        $sqlLastId = " AND m.id_mensagem > " . $lastid;
    }


    $sql1 = '';
    $sql2 = '';
    if (tipoUsuario($user) == "Professor") {
        $sql1 = "SELECT m.mensagem, m.id_mensagem, m.remetente, m.destinatario, m.data, p.foto_perfil AS foto_professor, a.foto_perfil AS foto_aluno, a.id_aluno AS id_usuario, a.nome_aluno AS nome FROM mensagens m, professor p, aluno a WHERE m.status = 0 AND $user IN (m.destinatario, m.remetente) AND p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno ORDER BY m.id_mensagem DESC";
        $sql2 = "SELECT m.mensagem, m.id_mensagem, m.remetente, m.destinatario, m.data, p.foto_perfil AS foto_professor, a.foto_perfil AS foto_aluno, a.id_aluno AS id_usuario, a.nome_aluno AS nome FROM mensagens m, professor p, aluno a WHERE m.time >= $timestamp" . $sqlLastId . " AND m.status = 0 AND $user IN (m.destinatario, m.remetente) AND p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno ORDER BY id_mensagem DESC";
    } else if (tipoUsuario($user) == "Aluno") {
        $sql1 = "SELECT m.mensagem, m.id_mensagem, m.remetente, m.destinatario, m.data, a.foto_perfil AS foto_aluno, p.foto_perfil AS foto_professor, p.id_professor AS id_usuario, p.nome_professor AS nome FROM mensagens m, professor p, aluno a WHERE m.status = 0 AND $user IN (m.destinatario, m.remetente) AND p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno ORDER BY m.id_mensagem DESC";
        $sql2 = "SELECT m.mensagem, m.id_mensagem, m.remetente, m.destinatario, m.data, a.foto_perfil AS foto_aluno, p.foto_perfil AS foto_professor, p.id_professor AS id_usuario, p.nome_professor AS nome FROM mensagens m, professor p, aluno a WHERE m.time >= $timestamp" . $sqlLastId . " AND m.status = 0 AND $user IN (m.destinatario, m.remetente) AND p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno ORDER BY id_mensagem DESC";
    }

    if ($_POST['timestamp'] == 0) {
        $pegaMensagens = $pdo->prepare($sql1);
    } else {
        $pegaMensagens = $pdo->prepare($sql2);
    }

    $pegaMensagens->execute();
    $res = $pegaMensagens->rowCount();

    if ($res <= 0) {
        while ($res <= 0) {
            if ($res <= 0) {
                if ($tempo >= 30) {
                    die(json_encode(array('status' => 'vazio', 'lastid' => 0, 'timestamp' => time())));
                    exit();
                }

                sleep(1);
                $pegaMensagens = $pdo->prepare($sql2);
                $pegaMensagens->execute();
                $res = $pegaMensagens->rowCount();
                $tempo += 1;
            }
        }
    }

    $mensagens = array();

    if ($res >= 1) {
        while ($row = $pegaMensagens->fetch()) {
            $foto = '';
            if ($row['remetente'] == $user) {
                if (tipoUsuario($row['remetente']) == "Aluno") {
                    $foto = "../aluno/imagens/perfil/".$row['foto_aluno'];
                } else {
                    $foto = "../professor/imagens/perfil/".$row['foto_professor'];
                }
            } else if ($row['destinatario'] == $user) {
                if (tipoUsuario($row['destinatario']) == "Aluno") {
                    $foto = "../professor/imagens/perfil/".$row['foto_professor'];
                } else {
                    $foto = "../aluno/imagens/perfil/".$row['foto_aluno'];
                } 
            }
            $mensagens[] = array(
                'id' => $row['id_mensagem'],
                'conversa' => $row['id_usuario'],
                'mensagem' => utf8_encode($row['mensagem']),
                'remetente' => $row['remetente'],
                'destinatario' => $row['destinatario'],
                'data' => date("d/m/Y H:i", strtotime($row['data'])),
                'nome' => $row['nome'],
                'foto_perfil' => $foto,
            );
        }

        $ultmimaMsg = end($mensagens);
        $ultimoId = $ultmimaMsg['id'];
        die(json_encode(array('status' => 'resultados', 'timestamp' => time(), 'lastid' => $ultimoId, 'dados' => $mensagens)));
    }
    exit();
} 