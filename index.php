<!DOCTYPE HTML>
<?php
session_start();
    
    $_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];

    date_default_timezone_set("America/Belem");

    require_once 'web-content/php-resources/factory/conexao.php';
    require_once 'web-content/php-resources/dao/selecionar.php';
    require_once './web-content/php-resources/util/selecionarUsuario.php';

    include './web-content/php-resources/util/contador.php';

    if (isset($_SESSION['usuario'], $_SESSION['id_usuario'])) {
        if ($_SESSION['tipo_usuario'] == "Professor") {
            header("location: web-content/php-resources/area-restrita/professor/");
        } else if ($_SESSION['tipo_usuario'] == "Aluno") {
            header("location: web-content/php-resources/area-restrita/aluno/");
        } else {
            header("location: web-content/php-resources/area-restrita/admin/");
        }
    }

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Bem Vindo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Html5TemplatesDreamweaver.com">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!-- Remove this Robots Meta Tag, to allow indexing of site -->
        
        <link rel="shortcut icon" href="icone.bmp" />
        
        <link href="web-content/resources/templates/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="web-content/resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <!-- Icons -->
        <link href="web-content/resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
        <link href="web-content/resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
    
        <link rel="stylesheet" href="web-content/resources/scripts/fontawesome/css/font-awesome.min.css">
     
        <link href="web-content/resources/scripts/carousel/style.css" rel="stylesheet" type="text/css" />
        <link href="web-content/resources/scripts/camera/css/camera.css" rel="stylesheet" type="text/css" />
        <link href="web-content/php-resources/area-restrita/" />

        <link href="styles/custom.css" rel="stylesheet" type="text/css" />
    </head>
    <body id="pageBody">

        <div id="divBoxed" class="container">

            <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

            <div class="divPanel notop nobottom">
                <div class="row-fluid">
                    <div class="span12">

                        <div id="divLogo" class="pull-left">
                            <a href="" id="divSiteTitle">GetTeacher</a><br />
                            <a href="" id="divTagLine">Seu Professor Online</a>
                        </div>

                        <div id="divMenuRight" class="pull-right">
                            <div class="navbar">
                                <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                                    Menu <span class="icon-chevron-down icon-white"></span>
                                </button>
                                <div class="nav-collapse collapse">
                                    <ul class="nav nav-pills ddmenu">
                                        <li class="active"><a href="">Home</a></li>
                                        <li><a href="web-content/pages/sobre.php">Sobre</a></li>
                                        <li class="dropdown">
                                            <a href="" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Idiomas">Idiomas</a></li>
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Exatas">Exatas</a></li>
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Humanas">Humanas</a></li>
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Artes">Artes</a></li>
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Música">Música</a></li>
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Linguagens">Linguagens</a></li>
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Biológicas">Biológicas</a></li>
                                                <li><a href="web-content/php-resources/domain/listar-professores.php?area=Meio Ambiente">Meio Ambiente</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="web-content/php-resources/domain/blog-dos-professores.php">Blog</a></li>
                                        <li><a href="web-content/pages/contato.php">Contatos</a></li>
                                        <?php if (isset($_SESSION['usuario'])): ?>
                                            <li class="dropdown">
                                                <a href="" dropdown-toggle><?= selecionarUsuario(); ?><b class="caret"></b></a>
                                                <?php if ($_SESSION['tipo_usuario'] != "Admin"): ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="web-content/php-resources/area-restrita/chat/conversas.php">Mensagens</a></li>
                                                        <li><a href="web-content/php-resources/area-restrita/app/aulas.php">Aulas</a></li>
                                                        <li><a href="web-content/php-resources/area-restrita/app/editarPerfil.php">Editar perfil</a></li>
                                                        <li><a href="web-content/php-resources/area-restrita/app/logOut.php">Sair</a></li>
                                                    </ul>
                                                <?php else: ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="web-content/php-resources/area-restrita/admin/pages/mailbox/mailbox.php">Caixa de Entrada</a></li>
                                                        <li><a href=".web-content/php-resources/area-restrita/admin/pages/tables/dados.php">Cadastros</a></li>
                                                        <li><a href="web-content/php-resources/area-restrita/app/logOut.php">Sair</a></li>
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
                                <form class="form-inline" action="web-content/php-resources/area-restrita/app/login.php" method="post">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-user"></i></span>
                                        <input type="text" name="acessarUsuario" id="acessarUsuario" class="input-large" required placeholder="Email ou nome de usuário" />
                                    </div>
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-key"></i></span>
                                        <input type="password" name="senhaUsuario" id="senhaUsuario" class="input-medium span10" required placeholder="Senha" />
                                    </div>
                                    <input class="btn btn-primary span3" type="submit" value="Acessar o Sistema" />
                                    <br />
                                    <br />
                                    <a href="web-content/pages/cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;</a>
                                    <a href="">Esqueceu sua senha?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">

                        <div id="headerSeparator"></div>
                        
                        <div class="camera_full_width">
                            <div id="camera_wrap">
                                <div data-src="slider-images/RELACIONAMENTO-ENTRE-PROFESSORES-E-ALUNOS1.jpg" ><div class="camera_caption cap1">...</div></div>
                                <div data-src="slider-images/imagem2.png"><div class="camera_caption cap2">...</div></div>
                                <div data-src="slider-images/2.jpg" ></div>
                            </div>
                            <br style="clear:both"/><div style="margin-bottom:40px"></div>
                        </div>               

                        <div id="headerSeparator2"></div>

                    </div>
                </div>
            </div>

            <div>
                <div class="divPanel notop page-content">         
                    <div class="row-fluid">
                    
                        <!--Edit Main Content Area here-->
                        <div class="span12" id="divMain">
                            <h1>Bem Vindo</h1>                    				
                            <h5>
                                <strong>
                                    O GetTeacher é formado por pessoas que acreditam na educação como instrumento de emancipação e 
                                    realização pessoal e profissional
                                </strong>. Por isso, nós conectamos os melhores professores particulares a 
                                alunos que pretendem aprender desde os conceitos fundamentais de matemática, 
                                física, química e português até aqueles que desejam conhecer um novo idioma 
                                ou adquirir uma nova habilidade, como dançar ou tocar violão.
                            </h5>
                            <br /><br />                 
                            <h3>Nossas áreas</h3>	
                            <br /><br />  
                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-globe"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Idiomas">Idiomas</a></h4> <hr/>
                                        <p style="text-align:justify;">
                                            Um idioma é uma língua que é dado um estatuto legal em um determinado país, estado ou jurisdição.
                                            Normalmente o idioma de um país refere-se à linguagem utilizada dentro do seu governo - tribunais,
                                            parlamento, administração - para executar suas operações e conduzir seus negócios. Muitos países
                                            reconhecem mais de um idioma.
                                        </p>
                                    </div>
                                </div> 

                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-bar-chart"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Exatas">Exatas</a></h4> <hr/>
                                        <p style="text-align:justify;">
                                            A Matemática é a ciência que estuda diversos tópicos, de forma abstrata, como espaço, 
                                            quantidade, arranjos, formas e estruturas. É comum ouvir que a matemática está em toda parte, 
                                            pois ela é a base para diversas ciências, como economia, engenharia, fisica, química, biologia, 
                                            arquitetura e muitas outras.
                                        </p>
                                    </div>
                                </div> 

                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-group"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Humanas">Humanas</a></h4> <hr/>
                                        <p style="text-align: justify;">
                                            As Ciências Humanas têm um caráter múltiplo: ao mesmo tempo 
                                            em que englobam características teóricas em ramos como Linguística, Gramática e Filosofia, apresentam 
                                            características práticas através do Jornalismo, Comunicação Social e Direito. Envolvem também características 
                                            subjetivas, como acontece no campo da Arte.
                                        </p>
                                    </div>
                                </div> 

                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-camera"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Artes">Artes</a></h4> <hr/>
                                        <p style="text-align:justify;">
                                            A Arte, de forma geral, é o conjunto de atividades com o objetivo de causar emoções e idéias no 
                                            ser humano. Ela geralmente acontece por meio de obras que destacam a beleza de formas, de versos, 
                                            emoções e idéias. A arte pode se manifestar de diversas formas e em diversos meios.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-music"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Música">Música</a></h4> <hr/>
                                        <p style="text-align:justify;">
                                            A música é uma das formas de arte mais antigas da humanidade. Por ser uma criação fortemente ligada
                                            à cultura, sua definição pode variar. Independente da definição, alguns elementos são intrínsecos da
                                            música: melodia, harmonia, ritmo, tempo e timbre.
                                        </p>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-pencil"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Linguagens">Linguagens</a></h4> <hr/>
                                        <p style="text-align:justify;">
                                            A linguagem é a capacidade humana para a aquisição e utilização de sistemas complexos de comunicação,
                                            e uma língua é qualquer exemplo específico de tal sistema.
                                        </p>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-beaker"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Biológicas">Biológicas</a></h4> <hr/>
                                        <p style="text-align:justify;">
                                            Biologia, como diz o nome (Bio - vida, Logus - estudo), é a ciência responsável pelo estudo da vida.
                                            Nascimento, crescimento, constituição, evolução e convívio são algumas das fases de um ser vivo
                                            estudadas pela biologia.
                                        </p>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="box">
                                        <i class="icon-refresh"></i>
                                        <h4><a href="web-content/php-resources/domain/listar-professores.php?area=Meio Ambiente">Meio Ambiente</a></h4> <hr/>
                                        <p style="text-align:justify;">
                                            Meio ambiente envolve todas as coisas vivas e não-vivas que ocorrem na Terra, ou em alguma região dela, 
                                            que afetam os ecossistemas e a vida dos humanos. O meio ambiente pode ter diversos conceitos, que são 
                                            identificados por seus componentes.
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--End Main Content-->
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
                                <li><a href="web-content/pages/termos-de-uso.php" title="Terms of Use">Termos de uso</a></li>
                                <li><a href="web-content/pages/politicas-privacidade.php" title="Privacy Policy">Políticas de privacidade</a></li>
                                <li><a href="web-content/pages/faq.php" title="FAQ">FAQ</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea2">

                            <h3>Alunos</h3>
                            <ul>
                                <li><a href="web-content/php-resources/domain/forum.php">Tira Dúvidas</a></li>
                                <li><a href="web-content/pages/central-de-ajuda.php">Central de Ajuda</a></li>
                                <li><a href="web-content/pages/cadastro-aluno.php">Cadastre-se</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea3">

                            <h3>Professores</h3>
                            <ul>
                                <li><a href="web-content/pages/cadastro-professor.php">Torne-se um Professor</a></li>
                                <li><a href="web-content/pages/central-de-ajuda.php">Central de Ajuda</a></li>
                                <li><a href="web-content/php-resources/domain/blog-dos-professores.php">Blog dos Professores</a></li>
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
                                    <a href="" title="Email">contato@getteacher.com</a>
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
                                <a href=""><i class="social foundicon-facebook"></i> Facebook</a>
                                <a href=""><i class="social foundicon-twitter"></i> Twitter</a>
                                <a href=""><i class="social foundicon-pinterest"></i> Pinterest</a>
                                <a href=""><i class="social foundicon-rss"></i> Rss</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br /><br /><br />

        <script src="web-content/resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script> 
        <script src="web-content/resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="web-content/resources/scripts/default.js" type="text/javascript"></script>
        <script src="web-content/resources/scripts-custom/selecionarCategoriaProfessor.js"></script>

        <script src="web-content/resources/scripts/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('#list_photos').carouFredSel({responsive: true, width: '100%', scroll: 2, items: {width: 320, visible: {min: 2, max: 6}}});
        </script>
        <script src="web-content/resources/scripts/camera/scripts/camera.min.js" type="text/javascript"></script>
        <script src="web-content/resources/scripts/easing/jquery.easing.1.3.js" type="text/javascript"></script>
        <script type="text/javascript">
            function startCamera() {
                $('#camera_wrap').camera({
                    fx: 'scrollLeft',
                    time: 2000,
                    loader: 'none',
                    playPause: false,
                    navigation: true,
                    height: '35%',
                    pagination: true
                });
            }
            $(function () {
                startCamera();
            });
        </script>
    </body>
</html>