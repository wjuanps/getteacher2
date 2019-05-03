<?php
session_start();

if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {
    
    unset($_SESSION['usuario']);
    unset($_SESSION['id_usuario']);
    unset($_SESSION['pagina']);
    unset($_SESSION['tipo_usuario']);
    unset($_SESSION['pagina_atual']);
    session_destroy();
    header("location: ../../../../");
    
} else {
    echo "Falha";
}