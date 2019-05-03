<?php
session_start();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';
require_once '../../dao/atualizar.php';
require_once '../../dao/excluir.php';

$acao = strip_tags(trim(filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING)));
$id_usuario = $_SESSION['id_usuario'];

$pdo = Conection::connect();

if (!empty($acao)) {
    switch ($acao) {
    case "verificar":
        
        $status = $pdo->query("SELECT * FROM `mensagens` WHERE `status` = '0' AND `destinatario` = '$id_usuario'");
        $total = $status->rowCount();
        echo $total;
        break;
    
    case "up":

        $id_conversa = (int) strip_tags(trim(filter_input(INPUT_GET, 'id_conversa', FILTER_SANITIZE_NUMBER_INT)));
        
        $atualizar = update("status", "1", "mensagens", "WHERE '$id_usuario' IN (id_aluno, id_professor)");
        if ($atualizar) {
            echo $id_conversa;
        } else {
            echo 'Falha';
        }
        break;

    case "verificar-men":
                
        $id_conversa = select("mensagens", "DISTINCT `remetente`", "WHERE  `destinatario` = '$id_usuario'");        
        
        $id = array();
        foreach ($id_conversa as $row) {
            $tot_men = $pdo->prepare("SELECT COUNT(mensagem) AS total FROM `mensagens` WHERE ".$row->remetente." IN (`id_professor`, `id_aluno`) AND `destinatario` = '$id_usuario' AND `status` = 0");
            $tot_men->execute();
            $total = $tot_men->fetch();
            $id[] = array('total' => $total['total'], 'id_conversa' => $row->remetente);
        }
        die(json_encode($id));
        break;
        
    case "excluir-conversa":
        
        $id_conversa = (int) strip_tags(trim(filter_input(INPUT_GET, 'id-conversa', FILTER_SANITIZE_NUMBER_INT)));
        $id_usuario = $_SESSION['id_usuario'];
        
        if (delete("mensagens", "WHERE remetente IN ($id_conversa, $id_usuario) AND destinatario IN ($id_conversa, $id_usuario)")) {
            echo "excluiu";
        } else {
            echo "Falha ao excluir conversa";
        }
        
        break;
        
    case "area":
        
        $getArea = select("professor", "area, categoria, tipo_aula", "WHERE id_professor = '$id_usuario'");
        
        foreach ($getArea as $area) {
            $retorno = array('area' => utf8_encode($area->area), 'categoria' => utf8_encode($area->categoria), 'tipo_aula' => $area->tipo_aula);
        }
        
        die(json_encode($retorno));
        break;
    
    case "genero":
        $getGenero = select("professor", "genero", "WHERE id_professor = '$id_usuario'");
        foreach ($getGenero as $genero) {
            echo $genero->genero;            
        }
        break;
    
    case "estado":
        $getEstado = select("professor", "estado", "WHERE `id_professor` = '$id_usuario'");
        foreach ($getEstado as $estado) {
            echo $estado->estado;
        }
        break;
    default:
        echo 'erro';
        break;
    }
}