<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function limitarCaracteres($texto, $length) {
    if (strlen($texto) <= $length) {
        return $texto;
    }
   
    $aux = strpos(substr($texto, 0, $length), ' ') + $length;
    return substr($texto, 0, $aux);
}
