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
        <title>GetTeacher - Politicas de Privacidade</title>
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
        <link href="../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
        <link href="../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
        <!--[if lt IE 8]>
            <link href="scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
            <link href="scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
        <![endif]-->
        <link rel="stylesheet" href="../resources/scripts/fontawesome/css/font-awesome.min.css">
        <!--[if IE 7]>
            <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome-ie7.min.css">
        <![endif]-->

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
                        <a href="../../">Home</a> &nbsp;/&nbsp; <span>Politicas de Privacidade</span>
                    </div>

                    <div class="row-fluid">

                        <!--Edit Sidebar Content here-->
                        <div class="span3 sidebox">                    
                            <h3>Como funciona o GetTeacher</h3>
                            <p style="text-align: justify;">
                                No GetTeacher você encontra <strong>aulas particulares</strong> de qualquer matéria, contando 
                                com milhares de <strong>professores particulares.</strong>
                            </p>
                                  
                            <img src="../../images/aulas-particulares.jpg" class="img-polaroid" alt=""><br /><br /><br /> 
                            <center><span class="btn btn-large">Saiba Mais</span></center>
                        </div>
                        <!--/End Sidebar Content -->        				

                        <!--Edit Main Content Area here-->
                        <div class="span9" id="divMain">
                            <div class="termo-politica">
                                <h1 class="text-info">Politicas de Privacidade</h1>
                                <hr>	
                                <p>
                                    A política de privacidade do GETTEACHER assegura e protege a privacidade de todos os indivíduos que acessam 
                                    O Site e que utilizam os serviços, se aplicando, ainda, a todos os dados reunidos no Site. 
                                    Esta Política de Privacidade é parte integrante dos Termos de Uso do GETTEACHER. A utilização do Site implica no 
                                    consentimento do interessado cadastrado no Site (“Usuário”) para coleta, armazenamento e uso das informações
                                    pessoais fornecidas, cadastrais, de acesso e suas atualizações (“Política de Privacidade”).
                                </p>	
                                <p>
                                    Se não concordar com esta Política de Privacidade, então, por favor, não acesse, navegue ou cadastre-se no Site. 
                                    Ainda, se optar por não fornecer informações necessárias no cadastro, não será possível a criação de um perfil 
                                    (conta de usuário), não sendo possível a prestação dos nossos serviços.
                                </p>
                                <h4>Informações coletadas</h4>
                                <p>
                                    Os dados submetidos durante o procedimento de cadastro de um USUÁRIO são as informações mínimas necessárias 
                                    para compor um perfil. Com exceção dos dados de contato (e-mail, telefone e endereço), todas as informações 
                                    providas poderão ser publicadas no site.
                                </p>
                                <p>
                                    As informações fornecidas pelo USUÁRIO podem ser alteradas ou removidas através da sua conta acessível 
                                    com usuário/email e senha pessoal e intransferível.
                                </p>
                                <p>
                                    O USUÁRIO pode optar por não prover informações opcionais, mas poderá, por este motivo, não figurar em algumas buscas com estas especificidades.
                                </p>
                                <p>
                                    Coletamos e armazenamos informações submetidas ao site, tais como fotos, imagens, dados pessoais, cadastrais, 
                                    informações do seu perfil, avaliações, comentários, mensagens, perguntas, respostas, dúvidas, áudio, vídeo, 
                                    artigos, desenhos, produções, ilustrações de sua autoria, para exibição pública.
                                </p>
                                <h4>Conteúdo criado pelo usuário</h4>
                                <p>
                                    Comentários ou outras informações publicadas pelo USUÁRIO em qualquer local do Site projetado para comunicações 
                                    públicas ou comunicação entre os USUÁRIOS, podem ser vistos e baixados por outras pessoas que visitam o site. 
                                    Por esta razão, o USUÁRIO deve usar de bom senso para postar qualquer informação, comentário ou avaliação.
                                </p>
                                <h4>Monitoramento das informações</h4>
                                <p>
                                   O USUÁRIO fica ciente que os textos, informações de perfil, avaliações, comentários, mensagens, perguntas, 
                                   respostas, dúvidas e artigos podem ser moderados e monitorados para o bom funcionamento e respeito aos 
                                   Termos de Uso do GETTEACHER. Salientamos que informações privadas não devem ser publicadas ou trocadas pelos USUÁRIOS.
                                </p>
                                <h4>Segurança das Informações</h4>
                                <p>
                                    Os perfis de USUÁRIO são protegidos por senhas criadas pelo próprio USUÁRIO. Tomamos medidas de segurança 
                                    apropriadas para ajudar a manter suas informações pessoais livre de acesso e uso não autorizados. O USUÁRIO
                                    é o único responsável pela administração de suas senhas de acesso que possua ou venha a adquirir. Logo o 
                                    GETTEACHER não poderá ser responsabilizado por atos decorrentes de acessos não autorizados.
                                </p>
                                <p>
                                    O USUÁRIO tem a opção de fechar a sua conta, mas ainda assim armazenaremos o conteúdo submetido e 
                                    informações com o objetivo de manter a integridade dos dados e gerar estatísticas.
                                </p>
                                <h4>Uso de suas informações pessoais</h4>
                                <p>
                                    O GETTEACHER reúne e utiliza suas informações pessoais ou individuais para o funcionamento do site e 
                                    para oferecer os serviços que você solicita enquanto se inscreve e anuncia no GETTEACHER. Também usamos 
                                    estas informações pessoais para nos comunicarmos com você.
                                </p>
                                <p>
                                    O GETTEACHER não compartilha sua informação pessoal com terceiros sem seu consentimento expresso.
                                </p>
                                <h4>Mudanças na Política de Privacidade</h4>
                                <p>
                                    Mudanças na presente Política podem ser realizadas para se adaptar a mudanças no site. 
                                    Reveja esta política de privacidade com frequência a fim de manter-se atualizado sobre como 
                                    estamos protegendo e utilizando as informações que coletamos. Seu uso continuado do Site 
                                    constitui aceitação tácito e/ou de fato desta versão mais recente desta Política de Privacidade 
                                    e dos Termos de Uso. Todas as mudanças serão notificadas aos USUÁRIOS.
                                </p>
                            </div>	 
                        </div>

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
                                <li><a href="" title="Privacy Policy">Políticas de privacidade</a></li>
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