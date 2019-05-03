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
        <title>GetTeacher - Perguntas Frequentes</title>
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
                        <a href="../../">Home</a> &nbsp;/&nbsp; <span>Perguntas Frequentes</span>
                    </div>

                    <div class="row-fluid">    				

                        <!--Edit Main Content Area here-->
                        <div class="span8 termo-politica" id="divMain">
                            <h1 class="text-info">Perguntas Frequentes</h1>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#faq-aluno" data-toggle="tab"><i class="icon-book"></i>&nbsp;&nbsp;&nbsp;Dúvidas dos Alunos</a>
                                </li>
                                <li>
                                    <a href="#faq-professor" data-toggle="tab"><i class="icon-laptop"></i>&nbsp;&nbsp;&nbsp;Dúvidas dos Professores</a> 
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="faq-aluno">
                                    <p>
                                        <strong>Preciso encontrar um professor para me ajudar com uma matéria ou me ensinar um idioma. O que devo fazer?<br /></strong>
                                        Para encontrar um professor que possa te ajudar, abra uma solicitação de orçamento. Fazendo isso, nós enviaremos 
                                        o seu pedido para os melhores professores próximos de você (ou distantes mesmo, para o caso de aula online) para 
                                        que eles possam se candidatar a lhe ajudar. Com isso, você só precisará escolher aquele que melhor se ajusta 
                                        ao seu propósito e marcar as aulas.
                                    </p>
                                    <p>
                                        Caso você mesmo prefira procurar um professor, basta realizar uma busca com os critérios de seu interesse, como matéria, 
                                        localidade, tipo de aula dentre outros e enviar um pedido de orçamento para um professor de sua escolha.
                                    </p>
                                    <p>
                                        <strong>As aulas presenciais são realizadas na minha casa, na casa do professor ou em outro local?<br /></strong>
                                        O local de realização das aulas presenciais são combinados entre o professor e o aluno. Ao criar uma solicitação,
                                        você poderá escolher o(s) locais onde gostaria de ter aulas. As opções são "casa do aluno", "escritório", "casa do professor" 
                                        ou "local público". Se você responder mais de uma opção, será solicitada a sua alternativa preferida e essa informações será 
                                        enviada ao professor. Ao responder à solicitação, o professor deverá escolher uma ou mais dentre as opções que você preencheu.
                                    </p>
                                    <p>
                                        Em geral, é mais comum que a aula aconteça na casa do próprio aluno e os locais públicos mais frequentes são shoppings, 
                                        galerias, bibliotecas públicas, cafés e centros culturais.
                                    </p>
                                    <p>
                                        <strong>Quais as opções de pagamento por aula?<br /></strong>
                                        A forma mais segura de realizar o pagamento de aulas no GetTeacher é usando cartão de crédito, antes da aula. 
                                        Caso a aula seja presencial, você também pode pagar em dinheiro diretamente ao professor, mas o GetTeacher não 
                                        recomenda esta alternativa pois você não terá direito às políticas de cancelamento nem a intermediação de
                                        disputas, caso seja necessário.
                                    </p>
                                    <p>
                                        <strong>Como aluno, preciso pagar para utilizar o GetTeacher?<br /></strong>
                                        Você pode criar uma solicitação de orçamento para que os professores possam responder ao seu pedido ou 
                                        apenas criar uma conta no site para utilizar outros recursos da plataforma como o tira-dúvidas, biblioteca 
                                        de arquivos, blog ou lista de exercícios. Isso é feito sem nenhum custo.
                                    </p>
                                    <p>Você pagará quando contratar uma ou mais aulas com um professor.</p>
                                    <p>
                                        <strong>Como faço para recomendar um professor?<br /></strong>
                                        Para garantir a credibilidade e veracidade das recomendações, apenas alunos que fizeram aula com o professor 
                                        registradas no GetTeacher podem fazer uma recomendação. Esses alunos visualizarão um formulário para deixar uma 
                                        recomendação quando visitarem o perfil do professor.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="faq-professor">
                                    <p>
                                        <strong>Gostaria de anunciar minhas aulas e fazer parte da equipe de professores. O que devo fazer?<br /></strong>
                                        Para anunciar sua aulas no GetTeacher, leia com atenção as instruções de <a href="">como funciona para o professor</a>. Depois disso,
                                        crie uma conta informando as matérias que leciona, endereço, valores dentre outras informações para aproveitar 
                                        todas as vantagens de participar da comunidade GetTeacher. Aproveite e leia as primeiras <a href="">dicas de como conseguir 
                                            alunos</a> na plataforma
                                    </p>
                                    <p>
                                        <strong>Como recebo os pagamentos pelas minhas aulas?<br /></strong>
                                        Existem duas formas de se receber os pagamentos das aulas: de maneira segura via PayPal ou em dinheiro diretamente do aluno (não-recomendado).
                                    </p>
                                    <p>
                                        No primeiro caso, o aluno paga a aula antecipadamente usando cartão de crédito e o GetTeacher transfere o valor para 
                                        o professor depois da aula, assim que o aluno der uma boa nota para ela. Se o aluno não der uma nota, o valor é 
                                        transferido 5 dias corridos depois do término da aula. Neste caso, o professor terá direito às políticas de 
                                        cancelamento, reagendamento e também a intermediação em caso de disputas. O GetTeacher retira automaticamente o
                                        valor da taxa de prestação do serviço.
                                    </p>
                                    <p>
                                        Você também pode receber do aluno em dinheiro (ou conforme combinarem) antes ou depois da aula. Nesse caso,
                                        cabe ao professor realizar essa cobrança e se certificar de que as aulas estão sendo pagas corretamente. 
                                        O GetTeacher não recomenda este tipo de recebimento e não se responsabiliza por qualquer imprevisto que possa
                                        surgir neste tipo de acordo, incluindo inadimplências, cancelamentos, adiamentos e estornos. Esta opção
                                        está disponível apenas para aulas presenciais.
                                    </p>
                                    <p>
                                        <strong></strong>
                                    </p>
                                    <p>
                                        <strong></strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!--/End Main Content Area here-->	                

                        <!--Edit Sidebar Content here-->
                        <div class="span4 sidebox">                    
                            <h3>Como funciona o GetTeacher</h3>
                            <p style="text-align: justify;">
                                No GetTeacher você encontra <strong>aulas particulares</strong> de qualquer matéria, contando 
                                com milhares de <strong>professores particulares.</strong>
                            </p>

                            <img src="../../images/aulas-particulares.jpg" class="img-polaroid" alt=""><br /><br /><br /> 
                            <center><span class="btn btn-large">Saiba Mais</span></center>
                        </div>
                        <!--/End Sidebar Content -->                            
                        
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
                                <li><a href="" title="FAQ">FAQ</a></li>
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
        <script src="../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../resources/scripts/default.js" type="text/javascript"></script>
        <script src="../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>

    </body>
</html>