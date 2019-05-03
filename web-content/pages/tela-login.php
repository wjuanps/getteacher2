<!DOCTYPE HTML>
<?php
session_start();

$_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];

require_once '../php-resources/factory/conexao.php';
require_once '../php-resources/dao/selecionar.php';
require_once '../php-resources/util/selecionarUsuario.php';

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Cadastro de Aluno</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Html5TemplatesDreamweaver.com">
        
        <link rel="shortcut icon" href="../../icone.bmp" />
        
        <link href="../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Icons -->
        <link href="../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet"
              type="text/css"/>
        <link href="../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet"
              type="text/css"/>
        <!--[if lt IE 8]>
        <link href="../resources/scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen"
              rel="stylesheet" type="text/css"/>
        <link href="../resources/scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet"
              type="text/css"/>
        <![endif]-->
        <link rel="stylesheet" href="../resources/scripts/fontawesome/css/font-awesome.min.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="../resources/scripts/fontawesome/css/font-awesome-ie7.min.css">
        <![endif]-->

        <link href="../../styles/custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="pageBody">

        <div id="divBoxed" class="container">

            <div class="transparent-bg"
                 style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

            <div class="divPanel notop nobottom">
                <div class="row-fluid">
                    <div class="span12">

                        <div id="divLogo" class="pull-left">
                            <a href="../../" id="divSiteTitle">GetTeacher</a><br/>
                            <a href="../../" id="divTagLine">Seu Professor Online</a>
                        </div>

                        <div id="divMenuRight" class="pull-right">
                            <div class="navbar">
                                <button type="button" class="btn btn-navbar-highlight btn-large btn-primary"
                                        data-toggle="collapse" data-target=".nav-collapse">
                                    Menu <span class="icon-chevron-down icon-white"></span>
                                </button>
                                <div class="nav-collapse collapse">
                                    <ul class="nav nav-pills ddmenu">
                                        <li><a href="../../">Home</a></li>
                                        <li><a href="sobre.php">Sobre</a></li>
                                        <li class="dropdown">
                                            <a href="" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Idiomas">Idiomas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Exatas">Exatas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Humanas">Humanas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Artes">Artes</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Música">Música</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Linguagens">Linguagens</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Biológicas">Biológicas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Meio Ambiente">Meio Ambiente</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../php-resources/domain/blog-dos-professores.php">Blog</a></li>
                                        <li><a href="contato.php">Contatos</a></li>
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
                        <a href="../../">Home</a> &nbsp;/&nbsp; <span>Login no Sistema</span>
                    </div>

                    <div class="row-fluid">

                        <!--Edit Sidebar Content here-->

                        <!--/End Sidebar Content -->

                        <!--Edit Main Content Area here-->
                        <div class="span8" id="divMain">

                            <h1 class="text-info">Login no Sistema</h1>
                            <hr>
                            <?php if (isset($_REQUEST['error']) && $_REQUEST['error'] == "error"): ?>
                                <div class="alert-error" id="mensagem" style="padding: 3px 13px; border-radius: 5px;">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <h3>Atenção</h3>
                                    <p>Usuário ou Senha inválidos.</p>
                                </div>
                            <?php endif; ?>
                            <form class="sidebox divPanel" action="../php-resources/area-restrita/app/login.php" method="post">
                                <div class="row-fluid divPanel">
                                    <div class="span8">
                                        <div class="input-prepend">
                                            <label for="acessarUsuario">Email<span class="text-error">*</span></label>
                                            <span class="add-on"><i class="icon-user"></i></span>                                    
                                            <input type="text" name="acessarUsuario" id="acessarUsuario" class="span12" required placeholder="Email ou nome de usuário" />
                                        </div>
                                        <div class="input-prepend">
                                            <label for="senhaUsuario">Senha<span class="text-error">*</span></label>
                                            <span class="add-on"><i class="icon-key"></i></span>                                    
                                            <input type="password" name="senhaUsuario" id="senhaUsuario" class="span12" required placeholder="Senha"/>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="contentInnerSeparator"></div>
                                            </div>
                                        </div>
                                        <div class="span12" style="margin-left: 5%;">
                                            <input class="btn btn-info span6 pull-right" title="Clique aqui para acessar o sistema" type="submit" value="Acessar o Sistema" />
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="contentInnerSeparator"></div>
                                            </div>
                                        </div>
                                        <a href="cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;</a>
                                        <a href="">Esqueceu sua senha?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--Edit Sidebar Content here-->
                        <div class="span4">

                            <!-- Edit Carousel -->
                            <h2 class="text-success">Nossos Professores</h2>
                            <p>Veja abaixo alguns de nossos Professores.</p>

                            <p>São mais de 5000 professores capacitados a lhe ajudar no que você precisar.</p>

                            <div id="myCarousel" class="carousel slide">

                                <div class="carousel-inner">

                                    <div class="item active">

                                        <img src="../../images/HTML5_3D_Effects_512.png" class="img-polaroid" alt="" height="100px">

                                    </div>
                                    <?php 
                                        require_once '../php-resources/factory/conexao.php';
                                        require_once '../php-resources/dao/selecionar.php';

                                        $query = select("professor");

                                     ?>
                                    <?php foreach ($query as $professor): ?>
                                        <div class="item">

                                            <img src="../php-resources/area-restrita/professor/imagens/perfil/<?php echo $professor->foto_perfil; ?>" class="img-polaroid" alt=""><br />
                                            <figcaption>
                                                <span style="font: 20px 'Trebuchet MS';">
                                                    <a href="perfil-professor.php?professor=<?php echo $professor->id_professor; ?>#banner">
                                                        <?php echo $professor->nome_professor; ?>
                                                    </a>
                                                </span>
                                                <span class="text-info">
                                                    <?php echo " - " . utf8_encode($professor->categoria) . "/" . utf8_encode($professor->especialidade); ?>
                                                </span>
                                            </figcaption>

                                        </div>
                                    <?php endforeach; ?>

                                </div>

                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>

                            </div>

                            <!-- /End Carousel -->

                            <hr />
                            <h3 class="offset2">Faça uma Busca</h3>
                            <a href="../php-resources/domain/listar-professores.php"><span class="btn btn-secondary offset2 span8 btn-large">Encontrar Professor</span></a>

                        </div>
                        <!--/End Sidebar Content -->
                        <!--/End Main Content Area here-->


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
                                <li><a href="cadastro-professor.php">Torne-se um Professor</a></li>
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
                                    <br/>
                                    (91) 9 8945-8743 / 3721-1234
                                </li>
                                <li>
                                    <i class="general foundicon-mail icon"></i>
                                    <span class="field">Email:</span>
                                    <br/>
                                    <a href="mailto:info@yourdomain.com" title="Email">contato@getteacher.com</a>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <br/><br/>

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
        <br/><br/><br/>
        <script src="../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../resources/scripts/default.js" type="text/javascript"></script>
    </body>
</html>