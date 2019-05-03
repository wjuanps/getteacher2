<!DOCTYPE HTML>
<?php
session_start();

    $_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];

    date_default_timezone_set('America/Belem');
    
    require_once '../php-resources/factory/conexao.php';
    require_once '../php-resources/dao/selecionar.php';
    require_once '../php-resources/util/selecionarUsuario.php';
    require_once '../php-resources/dao/cadastrar.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING))));
        $email = strip_tags(trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING)));
        $mensagem = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "mensagem", FILTER_SANITIZE_STRING))));
        $assunto = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "assunto", FILTER_SANITIZE_STRING)))); 

        if (isset($_SESSION['usuario'], $_SESSION['tipo_usuario'])) {
            $coluna = array(
                "id_usuario", "tipo_usuario", "data", "assunto", "mensagem", "status"
            );
            $valor = array(
                $_SESSION['id_usuario'], $_SESSION['tipo_usuario'], date("Y/m/d H:i:s"), $assunto, $mensagem, "0"
            );
        } else {
            $coluna = array(
                "id_usuario", "tipo_usuario", "data", "assunto", "mensagem", "status", "nome", "email"
            );
            $valor = array(
                "0", "Avulso", date("Y/m/d H:i:s"), $assunto, $mensagem, "0", $nome, $email
            );
        }

        if (inserir($coluna, $valor, "sugestoes")) {
            echo "<script>alert('Mensagem enviada com sucesso!');</script>";
        } else {
            echo "<script>alert('Falha ao enviar mensagem, tente novamente mais tarde!');</script>";
        }

    }

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Contato</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Html5TemplatesDreamweaver.com">

        <link rel="shortcut icon" href="../../icone.bmp" />

        <link href="../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <!-- Icons -->
        <link href="../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
        <link href="../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" href="../resources/scripts/fontawesome/css/font-awesome.min.css">
        
        <link href="../../styles/custom.css" rel="stylesheet" type="text/css" />
        <link href="../resources/css/styles-custom.css" rel="stylesheet" type="text/css">
    </head>
    <body id="pageBody">

        <div id="divBoxed" class="container">

            <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

            <div class="divPanel notop nobottom">
                <div class="row-fluid">
                    <div class="span12">

                        <div id="divLogo" class="pull-left">
                            <a href="../../" id="divSiteTitle">GetTeacher</a><br />
                            <a href="../../" id="divTagLine">Seu Professor Online</a>
                        </div>

                        <div id="divMenuRight" class="pull-right">
                            <div class="navbar">
                                <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                                    Menu <span class="icon-chevron-down icon-white"></span>
                                </button>
                                <div class="nav-collapse collapse">
                                    <ul class="nav nav-pills ddmenu">
                                        <li class=""><a href="../../">Home</a></li>
                                        <li><a href="sobre.php">Sobre</a></li>
                                        <li class="dropdown">
                                            <a href="" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Idiomas">Idiomas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Exatas">Exatas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Humanas">Humanas</a></li>
                                                <li><a href="..web-content/php-resources/domain/listar-professores.php?area=Artes">Artes</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Música">Música</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Linguagens">Linguagens</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Biológicas">Biológicas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Meio Ambiente">Meio Ambiente</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../php-resources/domain/blog-dos-professores.php">Blog</a></li>
                                        <li><a href="">Contatos</a></li>
                                        <?php if (isset($_SESSION['usuario'])): ?>
                                            <li class="dropdown">
                                                <a href="" dropdown-toggle><?php echo selecionarUsuario(); ?><b class="caret"></b></a>
                                                <?php if ($_SESSION['tipo_usuario'] != "Admin"): ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../php-resources/area-restrita/chat/conversas.php">Mensagens</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/aulas.php">Aulas</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/editarPerfil.php">Editar perfil</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/logOut.php">Sair</a></li>
                                                    </ul>
                                                <?php else: ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../php-resources/area-restrita/admin/pages/mailbox/mailbox.php">Caixa de Entrada</a></li>
                                                        <li><a href="../php-resources/area-restrita/admin/pages/tables/dados.php">Cadastros</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/logOut.php">Sair</a></li>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php else: ?>
                                            <li id="entrar"><a style="cursor: pointer;">Entrar</a></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="span12" id="telaLogin" style="display: none; margin-top: 30px;">
                                <form class="form-inline" action="../php-resources/area-restrita/app/login.php" method="post">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-user"></i></span>
                                        <input type="text" name="acessarUsuario" id="acessarUsuario" class="input-large" required placeholder="Email ou nome de usuário" />
                                    </div>
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-key"></i></span>
                                        <input type="password" name="senhaUsuario" id="senhaUsuario" class="input-medium span10" required placeholder="Senha"/>
                                    </div>
                                    <input class="btn btn-primary span3" type="submit" value="Acessar o Sistema" />
                                    <br />
                                    <br />
                                    <a href="../pages/cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;</a>
                                    <a href="">Esqueceu sua senha?</a>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span12">
                        <div id="contentInnerSeparator"></div>
                    </div>
                </div>
            </div>

            <div class="contentArea">

                <div class="divPanel notop page-content">

                    <div class="breadcrumbs">
                        <a href="../../">Home</a> &nbsp;/&nbsp; <span>Contato</span>
                    </div>

                    <div class="row-fluid">
                        <div class="span8" id="divMain">

                            <h1 class="text-info">Contate-nos</h1>
                            <h3 style="color:#FF6633;"><?php echo @$_GET['msg']; ?></h3>
                            <hr>
                            <!--Start Contact form -->		                                                
                            <form name="enq" method="post" action="">
                                <fieldset>

                                    <?php 
                                        if (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario'] != "Admin") {
                                            if ($_SESSION['tipo_usuario'] == "Professor") {
                                                $getUsuario = select("professor p, usuarios u", "p.nome_professor AS nome, u.email", "WHERE u.id_professor = p.id_professor AND P.id_professor = ".$_SESSION['id_usuario']);
                                            } else {
                                                $getUsuario = select("aluno", "nome_aluno AS nome, email", "WHERE id_aluno = ".$_SESSION['id_usuario']);
                                            } 
                                            
                                            foreach ($getUsuario as $usuario) {
                                                $nome = $usuario->nome;
                                                $email = $usuario->email;
                                            }
                                        }
                                    ?>

                                    <input type="text" name="nome" id="nome" value="<?php echo (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] != "Admin") ? $nome : ""; ?>"  class="input-block-level" required placeholder="Nome" />
                                    <input type="text" name="email" id="email" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" value="<?php echo (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario'] != "Admin") ? $email : ""; ?>" class="input-block-level" required placeholder="Email" />
                                    <input type="text" required name="assunto" class="input-block-level" placeholder="Assunto" />
                                    <textarea rows="11" name="mensagem" id="mensagem" class="input-block-level" required placeholder="Comentários"></textarea>
                                    <div class="actions">
                                        <input type="submit" value="Envie sua mensagem" name="submit" id="submitButton" class="btn btn-info pull-right" data-toggle="tooltip" title="Clique aqui para enviar sua mensagem!" />
                                    </div>

                                </fieldset>
                            </form>  				 
                            <!--End Contact form -->											 
                        </div>

                        <!--Edit Sidebar Content here-->	
                        <div class="span4 sidebar">

                            <div class="sidebox">
                                <h3 class="sidebox-title">Informações</h3>
                                <p>
                                <address><strong>GetTeacher</strong><br />
                                    Endereço<br />
                                    Castanhal, Pará, 68745-000<br />
                                    <abbr title="Phone">Phone:</abbr> (91) 9 8945-8743</address> 
                                <address>  <strong>Email</strong><br />
                                    <a href="mailto:#">getteacher@gmail.com</a></address>  
                                </p>     

                                <!-- Start Side Categories -->
                                
                                <!-- End Side Categories -->

                            </div>



                        </div>
                        <!--/End Sidebar Content-->


                    </div>			

                    <div id="footerInnerSeparator"></div>
                </div>
            </div>

            <div id="footerOuterSeparator"></div>

            <div id="divFooter" class="footerArea">

                <div class="divPanel">

                    <div class="row-fluid">
                        <div class="span3" id="footerArea1">

                            <h3>Sobre</h3>
                            <ul>
                                <li><a href="termos-de-uso.php" title="Terms of Use">Termos de uso</a></li>
                                <li><a href="politicas-privacidade.php" title="Privacy Policy">Políticas de privacidade</a></li>
                                <li><a href="faq.php" title="FAQ">FAQ</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea2">

                            <h3>Alunos</h3>
                            <ul>
                                <li><a href="../php-resources/domain/forum.php">Tira Dúvidas</a></li>
                                <li><a href="central-de-ajuda.php">Central de Ajuda</a></li>
                                <li><a href="cadastro-aluno.php">Cadastre-se</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea3">

                            <h3>Professores</h3>
                            <ul>
                                <li><a href="../pages/cadastro-professor.php">Torne-se um Professor</a></li>
                                <li><a href="central-de-ajuda.php">Central de Ajuda</a></li>
                                <li><a href="../php-resources/domain/blog-dos-professores.php">Blog dos Professores</a></li>
                            </ul>
                        </div>
                        <div class="span3" id="footerArea4">

                            <h3>Contate-nos</h3>  

                            <ul id="contact-info">
                                <li>                                    
                                    <i class="general foundicon-phone icon"></i>
                                    <span class="field">Phone:</span>
                                    <br />
                                    (91) 9 8945-8743 / 3721-1234                                                                      
                                </li>
                                <li>
                                    <i class="general foundicon-mail icon"></i>
                                    <span class="field">Email:</span>
                                    <br />
                                    <a href="mailto:info@yourdomain.com" title="Email">contato@getteacher.com</a>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <br /><br />
                    <div class="row-fluid">
                        <div class="span12">
                            <p class="copyright">
                                Copyright © 2016 GetTeacher. All Rights Reserved.
                            </p>

                            <p class="social_bookmarks">
                                <a href="#"><i class="social foundicon-facebook"></i> Facebook</a>
                                <a href=""><i class="social foundicon-twitter"></i> Twitter</a>
                                <a href="#"><i class="social foundicon-pinterest"></i> Pinterest</a>
                                <a href="#"><i class="social foundicon-rss"></i> Rss</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br /><br /><br />

        <script src="../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script> 
        <script src="../resources/scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../resources/scripts/default.js" type="text/javascript"></script>
        <script src="../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>

    </body>
</html>