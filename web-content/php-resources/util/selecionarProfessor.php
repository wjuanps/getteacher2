<?php

require_once '../factory/conexao.php';
require_once '../dao/selecionar.php';

    define("ITENS_POR_PAGINA", 5);
    
    $pagina = (isset($_GET['pagina'])) ? intval($_GET['pagina']) : 1;
    $inicio = ($pagina * ITENS_POR_PAGINA) - ITENS_POR_PAGINA;

    $query = utf8_decode(strip_tags(trim(filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING))));
    $area = strip_tags(trim(filter_input(INPUT_GET, 'area', FILTER_SANITIZE_STRING)));
    $area2 = utf8_decode($area);

    $materia = utf8_decode(strip_tags(filter_input(INPUT_GET, 'materia', FILTER_SANITIZE_STRING)));
    $tipo = utf8_decode(strip_tags(filter_input(INPUT_GET, 'tipo-aula', FILTER_SANITIZE_STRING)));
    
    $genero = strip_tags(filter_input(INPUT_GET, 'genero-professor', FILTER_SANITIZE_STRING));
    $order = null;

    if (!empty(strip_tags(trim(filter_input(INPUT_GET, 'hora', FILTER_SANITIZE_STRING))))) {
        if ($_REQUEST['hora'] == "maior") {
            $order = "ORDER BY `hora_aula` DESC";
        } else if ($_REQUEST['hora'] == "menor") {
            $order = "ORDER BY `hora_aula` ASC";
        } else if ($_REQUEST['hora'] == "avaliacao") {
            $order = "ORDER BY `avaliacao` DESC";
        }
    }

if (!empty($area)) {

    if (!empty($materia) && $materia != $area && !empty($tipo) && $tipo != "Presencial ou Online" && !empty($genero) && $genero != "Sem Preferência") {
        
        $resultado = select("professor", "*", "WHERE area = '$area2' AND `categoria` = '$materia' AND `tipo_aula` LIKE '%$tipo%' AND `genero` = '$genero'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' AND categoria = '$materia' AND tipo_aula LIKE '%$tipo%' AND genero = '$genero'")->rowCount();
        
    } else if (!empty($materia) && $materia != $area && !empty($tipo) && $tipo != "Presencial ou Online") {
        
        $resultado = select("professor", "*", "WHERE area = '$area2' AND `categoria` = '$materia' AND `tipo_aula` LIKE '%$tipo%'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' AND categoria = '$materia' AND tipo_aula LIKE '%$tipo%'")->rowCount();
        
    } else if (!empty($materia) && $materia != $area && !empty($genero) && $genero != "Sem Preferência") {
        
        $resultado = select("professor", "*", "WHERE area = '$area2' AND `genero` = '$genero'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' AND genero = '$genero'")->rowCount();
        
    } else if (!empty($tipo) && $tipo != "Presencial ou Online" && !empty($genero) && $genero != "Sem Preferência") {
        
        $resultado = select("professor", "*", "WHERE area = '$area2' AND `tipo_aula` LIKE '%$tipo%' AND `genero` = '$genero'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' AND tipo_aula LIKE '%$tipo%' AND genero = '$genero'")->rowCount();
        
    } else if (!empty($materia) && $materia != $area) {
        
        $resultado = select("professor", "*", "WHERE `area` = '$area2' AND `categoria` = '$materia'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' AND categoria = '$materia'")->rowCount();
        
    } else if (!empty($tipo) && $tipo != "Presencial ou Online") {
        
        $resultado = select("professor", "*", "WHERE area = '$area2' AND `tipo_aula` LIKE '%$tipo%'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' AND tipo_aula LIKE '%$tipo%'")->rowCount();
        
    } else if (!empty($genero) && $genero != "Sem Preferência") {
        
        $resultado = select("professor", "*", "WHERE area = '$area2' AND `genero` = '$genero'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' AND genero = '$genero'")->rowCount();
                 
    } else if ($order != null) {
        
        $resultado = select("professor", "*", "WHERE area = '$area2'", $order, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2' $order")->rowCount();
        
    } else {
        
        $resultado = select("professor", "*", "WHERE area = '$area2'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
        $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE area = '$area2'")->rowCount();
        
    } 
}  else if (!empty ($query) && $order != null) {
        
    $resultado = select("professor", "*", "WHERE `nome_professor` LIKE '%$query%' OR `cidade` LIKE '%$query%' OR `bairro` LIKE '%$query%' OR `estado` LIKE '%$query%' OR `area` LIKE '%$query%' OR `categoria` LIKE '%$query%' OR `tipo_aula` LIKE '%$query%' OR `especialidade` LIKE '%$query%' OR `sobre` LIKE '%$query%'", $order, "LIMIT $inicio, ".ITENS_POR_PAGINA);
    $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE `nome_professor` LIKE '%$query%' OR `cidade` LIKE '%$query%' OR `bairro` LIKE '%$query%' OR `estado` LIKE '%$query%' OR `tipo_aula` LIKE '%$query%' OR `area` LIKE '%$query%' OR `categoria` LIKE '%$query%' OR `especialidade` LIKE '%$query%' OR `sobre` LIKE '%$query%'")->rowCount();

} else if(!empty ($query)) {
    
    $resultado = select("professor", "*", "WHERE `nome_professor` LIKE '%$query%' OR `cidade` LIKE '%$query%' OR `bairro` LIKE '%$query%' OR `estado` LIKE '%$query%' OR `area` LIKE '%$query%' OR `tipo_aula` LIKE '%$query%' OR `categoria` LIKE '%$query%' OR `especialidade` LIKE '%$query%' OR `sobre` LIKE '%$query%'", null, "LIMIT $inicio, ".ITENS_POR_PAGINA);
    $total_resultados = Conection::connect()->query("SELECT * FROM professor WHERE `nome_professor` LIKE '%$query%' OR `cidade` LIKE '%$query%' OR `tipo_aula` LIKE '%$query%' OR `tipo_aula` LIKE '%$query%' OR `bairro` LIKE '%$query%' OR `estado` LIKE '%$query%' OR `area` LIKE '%$query%' OR `categoria` LIKE '%$query%' OR `especialidade` LIKE '%$query%' OR `sobre` LIKE '%$query%'")->rowCount();
    
} else {
    $resultado = false;
}

$total_resultados = (isset($total_resultados)) ? $total_resultados : 0;

$num_paginas = ceil($total_resultados/ITENS_POR_PAGINA);