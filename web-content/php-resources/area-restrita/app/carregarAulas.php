<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ($_SESSION['tipo_usuario'] == "Professor") {
    $pegaUsuario = select("professor", "`nome_professor` AS nome_usuario, `foto_perfil`", "WHERE `id_professor` = '$id'");
    $pegaConversas = select("mensagens m, professor p, aluno a", "DISTINCT a.id_aluno, a.nome_aluno", "WHERE p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno AND p.id_professor = '$id' GROUP BY a.id_aluno");
    $aulas = select("agendamento au, aluno a, professor p", "au.id_agendamento, au.data, p.id_professor, p.cidade, p.estado, a.id_aluno, a.nome_aluno AS nome", "WHERE au.id_aluno = a.id_aluno AND p.id_professor = au.id_professor AND p.id_professor = '$id' AND au.status IN (1,4)");
} else if ($_SESSION['tipo_usuario'] == "Aluno") {
    $pegaUsuario = select("aluno", "`nome_aluno` AS nome_usuario, foto_perfil", "WHERE `id_aluno` = $id");
    $pegaConversas = select("mensagens m, professor p, aluno a", "DISTINCT p.id_professor, p.nome_professor, COUNT(m.id_professor) AS total_mensagens", "WHERE p.id_professor = m.id_professor AND a.id_aluno = m.id_aluno AND a.id_aluno = $id GROUP BY p.id_professor");
    $aulas = select("agendamento au, aluno a, professor p", "au.id_agendamento, au.data, p.id_professor, p.cidade, p.estado, a.id_aluno, p.nome_professor AS nome", "WHERE au.id_aluno = a.id_aluno AND p.id_professor = au.id_professor AND a.id_aluno = $id AND au.status IN (1,4)");
}