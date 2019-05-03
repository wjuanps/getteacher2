<?php
session_start();

require_once '../../factory/conexao.php';

$pdo = Conection::connect();
$buscarUsuario = $pdo->prepare("SELECT * FROM `usuarios` WHERE (BINARY usuario = :usuario AND BINARY senha_usuario = :senha) OR (BINARY email = :email AND BINARY senha_usuario = :senha)");
try {
    if (!isset($_SESSION['usuario'])) {

        if (isset($_SESSION['senhaUsuario'], $_SESSION['acessarUsuario'])) {
            $user = $_SESSION['acessarUsuario'];
            $password = $_SESSION['senhaUsuario'];

            unset($_SESSION['senhaUsuario']);
        }  else {
            $user = strip_tags(trim(filter_input(INPUT_POST, 'acessarUsuario', FILTER_SANITIZE_STRING)));
            $password = strip_tags(trim(filter_input(INPUT_POST, 'senhaUsuario', FILTER_SANITIZE_STRING)));
        }
        
        if (!empty($user) && !empty($password)) {
            $buscarUsuario->bindValue(":usuario", $user);
            $buscarUsuario->bindValue(":email", $user);
            $buscarUsuario->bindValue(":senha", $password);
            $buscarUsuario->execute();

            if ($buscarUsuario->rowCount() > 0) {
                $tupla = $buscarUsuario->fetch(PDO::FETCH_OBJ);
                $_SESSION['usuario'] = $user;
                $_SESSION['tipo_usuario'] = $tupla->tipo_usuario;
                if ($tupla->tipo_usuario == "Professor") {
                    $_SESSION['pagina'] = '../professor/';
                    $_SESSION['id_usuario'] = $tupla->id_professor;
                    
                    if (isset($_SESSION['acessarUsuario']) ||
                            $_SESSION['pagina_atual'] == "/GetTeacher/web-content/pages/tela-login.php?error=error") {
                        header("Location: ../professor/");
                        unset($_SESSION['acessarUsuario']);
                    } else {
                        header("refresh: 1; ".$_SESSION['pagina_atual']);
                    }
                    
                    exit();
                } else if ($tupla->tipo_usuario == "Aluno") {
                    $_SESSION['pagina'] = '../aluno/';
                    $_SESSION['id_usuario'] = $tupla->id_aluno;                    
                    
                    if (isset($_SESSION['acessarUsuario']) || 
                            $_SESSION['pagina_atual'] == "/GetTeacher/web-content/pages/tela-login.php?error=error") {
                        header("Location: ../aluno/");
                        unset($_SESSION['acessarUsuario']);
                    } else {
                        header("refresh: 1; ".$_SESSION['pagina_atual']);
                    }
                    
                    exit();
                } else if ($tupla->tipo_usuario == "Admin") {
                    $_SESSION['pagina'] = '../admin/';
                    $_SESSION['id_usuario'] = $tupla->id_usuario;
                    header("refresh: 1; ".$_SESSION['pagina']);
                    exit();
                }
            } else {
                header("location: ../../../pages/tela-login.php?error=error");
                exit();
            }
        }
    } else {
        $pagina = $_SESSION['pagina'];
        header("location: $pagina");
        exit();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}