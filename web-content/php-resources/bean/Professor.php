<?php
include_once '../bean/Pessoa.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Professor
 *
 * @author Sophia
 */
class Professor extends Pessoa {
    //put your code here
    private $nomeUsuario;
    private $graduacao;
    private $instituicao;
    private $area;
    private $categoria;
    private $especialidade;
    private $tipoAula;
    private $sobre;
    private $horaAula;
    private $avaliacao;
    private $diploma;

    /**
     * @return mixed
     */
    public function getAvaliacao() {
        return $this->avaliacao;
    }

    /**
     * @param mixed $avaliacao
     */
    public function setAvaliacao($avaliacao) {
        $this->avaliacao = $avaliacao;
    }

    public function getTipoAula() {
        return $this->tipoAula;
    }

    public function setTipoAula($tipoAula) {
        $this->tipoAula = $tipoAula;
    }

    public function getHoraAula() {
        return $this->horaAula;
    }

    public function setHoraAula($horaAula) {
        $this->horaAula = $horaAula;
    }

    public function getSobre() {
        return $this->sobre;
    }

    public function setSobre($sobre) {
        $this->sobre = $sobre;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }
    
    function getGraduacao() {
        return $this->graduacao;
    }

    function getInstituicao() {
        return $this->instituicao;
    }

    function getArea() {
        return $this->area;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getEspecialidade() {
        return $this->especialidade;
    }

    function getDiploma() {
        return $this->diploma;
    }

    function setGraduacao($graduacao) {
        $this->graduacao = $graduacao;
    }

    function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }

    function setArea($area) {
        $this->area = $area;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
    }
    
    function setDiploma($diploma) {
        $this->diploma = $diploma;
    }

}
