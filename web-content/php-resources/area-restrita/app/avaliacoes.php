<?php

function media($id) {

    $pegaAvaliacoes = select("avaliacoes", "ROUND(AVG(didatica)) AS didatica, ROUND(AVG(conhecimento)) AS conhecimento, ROUND(AVG(simpatia)) AS simpatia, COUNT(id_avaliacao) AS total", "WHERE id_professor = '" . $id."'");

    if ($pegaAvaliacoes) {
        return $pegaAvaliacoes;
    }

    return false;
}

function mediaTotal($id) {

    $pegaAvaliacoes = select("avaliacoes", "ROUND((AVG(didatica) + AVG(conhecimento) + AVG(simpatia)) / 3) AS total", "WHERE id_professor = '" . $id."'");

    if ($pegaAvaliacoes) {
        return $pegaAvaliacoes;
    }

    return false;
}

function avaliacoes($id) {

    $pegaAvaliacoes = select("avaliacoes av, professor p, aluno a", "*", "WHERE p.id_professor = av.id_professor AND a.id_aluno = av.id_aluno AND p.id_professor = '" . $id."'", "ORDER BY av.id_avaliacao DESC", "LIMIT 3");

    if ($pegaAvaliacoes) {
        return $pegaAvaliacoes;
    }

    return false;
}

function totalAvaliacoes($id) {
    
    $pegaAvaliacoes = select("avaliacoes", "COUNT(id_avaliacao) AS total", "WHERE id_professor = '$id'");
    
    if ($pegaAvaliacoes) {
        foreach ($pegaAvaliacoes as $avaliacao) {
            $total = $avaliacao->total;
        }
        return $total;
    }
    return false;
}

function avaliacoesFeitas($id) {

    $pegaAvaliacoes = select("avaliacoes av, aluno a, professor p", "*", "WHERE p.id_professor = av.id_professor AND a.id_aluno = av.id_aluno AND a.id_aluno = '" . $id."'", "ORDER BY av.id_avaliacao DESC");

    if ($pegaAvaliacoes) {
            return $pegaAvaliacoes;
    }

    return false;
}

function totalAvaliacoesFeitas($id) {

    $pegaAvaliacoes = select("avaliacoes", "COUNT(id_avaliacao) AS total", "WHERE id_aluno = '". $id."'");

    if ($pegaAvaliacoes) {
        foreach ($pegaAvaliacoes as $total) {
            $totalAvaliacoes = $total->total;
        }
        return $totalAvaliacoes;
    }

    return false;

}

function mediaAvaliacoesFeitas($id) {

    $pegaAvaliacoes = select("avaliacoes", "ROUND((AVG(didatica) + AVG(conhecimento) + AVG(simpatia)) / 3) AS total", "WHERE id_aluno = '" . $id."'");

    if ($pegaAvaliacoes) {
        foreach ($pegaAvaliacoes as $total) {
            $totalAvaliacoes = $total->total;
        }
        return $totalAvaliacoes;
    }

    return false;

}