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
        <title>GetTeacher - Termos de Uso</title>
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
                                    <a href="cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;</a>
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
                        <a href="../../">Home</a> &nbsp;/&nbsp; <span>Termos de Uso</span>
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
                                <h1 class="text-info">Termos de Uso</h1>
                                <hr>	
                                <p>
                                    Bem-vindo ao GETTEACHER. Por favor, leia a Política de Privacidade e os termos de uso (<strong>"Termos de Uso"</strong> ou <strong>“Termo de Uso”</strong>) 
                                    antes de se cadastrar no getteacher ou acessar qualquer parte do site do GETTEACHER, incluindo acesso a qualquer material, 
                                    salas de chat ou outros serviços eletrônicos. Ao utilizar o Site, você aceita, concorda e legalmente se obriga aos
                                    Termos de Uso e a Política de Privacidade, mesmo sem a realização do cadastro no Site. Se você não entende ou não deseja 
                                    se obrigar aos Termos de Uso ou a Política de Privacidade, você não deve acessar o Site.
                                </p>	
                                <p>
                                    GETTEACHER reserva-se o direito de modificar os Termos de Uso a qualquer momento sem aviso prévio. Quaisquer alterações aos 
                                    Termos de Uso entrarão em vigor imediatamente após sua publicação no Site, vigendo por prazo indeterminado. Ao acessar o 
                                    Site, após quaisquer alterações, você automaticamente manifesta sua concordância com as modificações dos Termos de Uso.
                                </p>
                                <h4>DESCRIÇÃO DO GETTEACHER</h4>
                                <p>
                                    O GETTEACHER é uma plataforma virtual que objetiva viabilizar a prestação de serviços educacionais (<strong>“Aula”</strong>) por autônomos 
                                    (<strong>“Autônomos”</strong>), de maneira presencial ou virtual. O GETTEACHER disponibiliza os perfis dos Autônomos em seu Site, conforme 
                                    cadastros preenchidos por estes, para contratação direta e independente pelos interessados.
                                </p>
                                <h4>COMO USAR</h4>
                                <ol class="offset1" style="margin-left: 6%;">
                                    <li>
                                        Para contratar os serviços educacionais divulgados no Site o interessado deve efetuar um cadastro único gratuito, 
                                        criando uma senha pessoal e intransferível.
                                    </li>
                                    <li>
                                        Antes de decidir pela contratação do serviço educacional do Autônomo, o interessado deverá atentar-se:
                                        <br /><br />
                                        <ol type="A">
                                            <li>à capacitação informada pelo Autônomo; </li>
                                            <li>às avaliações do Autônomo publicadas no Site;</li>
                                            <li>ao preço da Aula determinado pelo Autônomo; </li>
                                            <li>ao lapso temporal da Aula; </li>
                                            <li>às formas de pagamento que o Autônomo aceita; e </li>
                                            <li>à disponibilidade de agenda do Autônomo.</li>
                                        </ol>
                                        <br /><br />
                                    </li>
                                    <li>
                                        A contratação dos serviços educacionais do Autônomo é feita diretamente pelo interessado,
                                        de maneira independente, sem qualquer intervenção do GETTEACHER.
                                    </li>
                                    <li>
                                        O GETTEACHER disponibiliza um sistema para que os USUÁRIOS avaliem as Aulas contratadas, respeitando 
                                        a liberdade de expressão de quem opina. A avaliação feita passa a integrar o perfil do Autônomo. 
                                        Estas avaliações não refletem indicação ou opinião do Site. <strong>Somente as Aulas agendadas por 
                                            meio do GETTEACHER poderão receber avaliação dos USUÁRIOS.</strong>
                                    </li>
                                    <li>
                                        Os USUÁRIOS são proibidos de trocar meios de contato como telefone, email, endereço e outras externas de 
                                        comunicação, com qualquer usuário, com o objetivo de realizar a contratação das Aulas por fora da plataforma.
                                    </li>
                                </ol>
                                <h4>SERVIÇOS PRESTADOS PELO SITE</h4>
                                <ol class="offset1" style="margin-left: 6%;">
                                    <li><u>Busca gratuita:</u> serviço online de busca das Aulas oferecidas pelos Autônomos.</li>
                                    <li><u>Publicidade gratuita:</u> serviço online de disponibilização de espaços virtuais para divulgação dos perfis e das Aulas oferecidas pelos Autônomos.</li>
                                    <li>
                                    <u>Publicidade paga:</u> serviço online de disponibilização de espaços virtuais para divulgação 
                                    em destaque dos perfis e Aulas oferecidas pelos Autônomos, ou para anúncios diversos 
                                    (condições regidas por termo específico).
                                    </li>
                                    <li>
                                    <u>Licença de uso de Software:</u> licenciamento de uso de software para Autônomos realizarem a 
                                    gestão de agenda de Aulas, financeira (pagamentos digitais), avaliações e a realização 
                                    de aulas virtuais (condições regidas por termo específico).
                                    </li>
                                </ol>
                                <p>
                                    O <strong>GETTEACHER</strong> (a) <strong>não</strong> é prestador de serviços educacionais; (b) <strong>não</strong> tem qualquer vínculo empregatício 
                                    com os Autônomos cadastrados no Site; (c) <strong>não</strong> tem qualquer responsabilidade pela prestação de serviços 
                                    realizada pelos Autônomos; e (d) <strong>não</strong> tem qualquer responsabilidade pela veracidade das informações 
                                    fornecidas ou cadastradas pelos Autônomos.
                                </p>
                                <p>
                                    O GETTEACHER monitora as ações e pode moderar qualquer conteúdo inserido no Site, sendo que qualquer violação passível de 
                                    bloqueio ou cancelamento da conta do USUÁRIO.
                                </p>
                                <p>
                                    Este sumário é parte integrante dos Termos de Uso, de forma que os termos ora definidos poderão ser utilizados no Termo de Uso,
                                    no plural ou no singular, com o mesmo significado a eles determinados neste sumário
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
                                <li><a href="" title="Terms of Use">Termos de uso</a></li>
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