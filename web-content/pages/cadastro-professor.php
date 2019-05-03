<!DOCTYPE HTML>
<?php
session_start();

    if (isset($_SESSION['usuario'])) {
        header("Location: ../../");
    }

    date_default_timezone_set("America/Belem");
    
    include_once '../php-resources/factory/conexao.php';
    require_once '../php-resources/dao/selecionar.php';
    $nomes = select("dados");
    
    $_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];
    
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Cadastro Professor</title>
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

        <link href="../../resources/scripts/carousel/style.css" rel="stylesheet" type="text/css" />
        <link href="../../resources/scripts/camera/css/camera.css" rel="stylesheet" type="text/css" />

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

        <link href="../resources/scripts/wookmark/css/style.css" rel="stylesheet" type="text/css" />	
        <link href="../resources/scripts/yoxview/yoxview.css" rel="stylesheet" type="text/css" />

        <link href="../../styles/custom.css" rel="stylesheet" type="text/css" />
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
                                <button type="button" class="btn btn-navbar-highlight btn-large btn-primary"
                                        data-toggle="collapse" data-target=".nav-collapse">
                                    Menu <span class="icon-chevron-down icon-white"></span>
                                </button>
                                <div class="nav-collapse collapse">
                                    <ul class="nav nav-pills ddmenu">
                                        <li><a href="../../">Home</a></li>
                                        <li><a href="sobre.php">Sobre</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Idiomas">Idiomas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Exatas">Exatas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Humanas">Humanas</a> </li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Artes">Artes</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Música&">Música</a></li>
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
                                    <a href="web-content/pages/cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;</a>
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
                        <a href="../../">Home</a> &nbsp;/&nbsp; <span>Cadastro Professor</span>
                    </div>

                    <div class="row-fluid">
                        <div class="span10 offset1">

                            <h1 class="text-info">Cadastro de Professor</h1>
                            <?php if (isset($_REQUEST['mensagem']) && $_REQUEST['mensagem'] != ""): ?>
                                <div class="alert-error" style="padding: 3px 13px; border-radius: 5px;">
                                    <button type="button" class="close" data-dismiss="alert"><?php echo @$_REQUEST['x']; ?></button>
                                    <h4><strong>Atenção</strong></h4>&nbsp;<?php echo @$_REQUEST['mensagem']; ?>
                                </div>
                            <?php endif; ?>
                            <hr>
                            <!--Start Contact form -->		                                                
                            <form name="casdastro-professor" method="post" action="../php-resources/util/confirmarCadastroProfessor.php" enctype="multipart/form-data">
                                <div  class="sidebox">
                                    <span class="alert-info" style="float: right; padding: 5px; border-radius: 5px;">
                                        Fique tranquilo! Seu CPF, email e data <br />
                                        de nascimento são armazenados de maneira <br />
                                        segura e não serão divulgados publicamente.
                                    </span>

                                    <h3 class="text-success"><i class="icon-user"></i>&nbsp; Dados Pessoais</h3>                                    
                                    <datalist id="nomes">
                                        <?php foreach ($nomes as $nome): ?>
                                            <option value="<?php echo $nome->nomes; ?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <label for="name">Nome<span class="text-error">*</span></label></td>
                                            <input type="text" name="name" id="name" pattern="^[A-ZÁÀÃÂÉÈÊÍÌÎÓÒÔÕÚÙÛÇa-záàãâéèêóòõôíìîúùûç\s]+$" class="span12" list="nomes" required placeholder="Nome" />
                                        </div>
                                        <div class="span3">
                                            <label for="sNome">Sobrenome<span class="text-error">*</span></label></td>
                                            <input type="text" name="sNome" id="sNome" pattern="^[A-ZÁÀÃÂÉÈÊÍÌÎÓÒÔÕÚÙÛÇa-záàãâéèêóòõôíìîúùûç\s]+$" class="span12" list="sobrenomes" required placeholder="Sobrenome" />
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <label for="email">Email<span class="text-error">*</span></label>
                                        <input type="text" name="email" id="email" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" class="span6" required placeholder="Email" />
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <label>Senha<span class="text-error">*</span></label>
                                            <input type="password" name="senha" id="senha" class="span12" required placeholder="Sua Senha" />
                                        </div>
                                        <div class="span3">
                                            <label>Repetir Senha<span class="text-error">*</span></label> 
                                            <input type="password" name="rSenha" id="rSenha" class="span12" required placeholder="Repetir Senha" />
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <label>CPF<span class="text-error">*</span></label>
                                            <input type="text" name="cpf" id="cpf" class="span12" required placeholder="Somente números">
                                        </div>
                                        <div class="span3">
                                            <label>Genero<span class="text-error">*</span></label>
                                            <select class="span12" name="genero" id="genero">
                                                <option>---------</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Feminino">Feminino</option>
                                            </select>
                                        </div>
                                        <div class="span3">
                                            <label>Data de Nascimento<span class="text-error">*</span></label>
                                            <input type="date" name="nascimento" id="nascimento" class="span12" />
                                        </div>
                                    </div>   
                                    <h4 class="text-success"><i class="icon-phone-sign"></i>&nbsp; Telefones</h4>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <label>DDD<span class="text-error">*</span></label>
                                            <input type="number" name="ddd" id="ddd" class="span12" min="0" max="999" required placeholder="Somente números" />
                                        </div>
                                        <div class="span3">
                                            <label>Número<span class="text-error">*</span></label>
                                            <input type="text" name="telefone" id="telefone" class="span12" required placeholder="Somente números" /></td>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebox" style="margin-top: 10px;">

                                    <label class="sidebox-title"><h3 class="text-success"><i class="icon-file-alt"></i>&nbsp;Arquivos</h3></label>
                                    <div class="sidebox">
                                        <span class="alert-danger" style="float: right; position: relative; padding: 5px; border-radius: 5px; font-size: 12px;">ATENÇÃO! Use apenas arquivos no formato PDF</span>
                                        <label for="diploma"><h3 class="text-info">Diploma<span class="text-error">*</span></h3></label>
                                        <input type="file" required name="diploma" id="diploma" />
                                    </div>  
                                    <div class="sidebox">          
                                        <span class="alert-danger" style="float: right; position: relative; padding: 5px; border-radius: 5px; font-size: 12px;">ATENÇÃO! Use apenas arquivos no formato JPG</span>
                                        <label for="foto"><h3 class="text-info">Foto<span class="text-error">*</span></h3></label>
                                        <input type="file" required name="foto" id="foto" />
                                    </div>                                                                              
                                </div>
                                <div class="sidebox">
                                    <h3 class="text-success"><i class="icon-book"></i>&nbsp; Sobre as aulas oferecidas</h3>
                                    <label>Preço médio por hora aula<span class="text-error">*</span></label>
                                    <div class="input-prepend input-append">
                                        <span class="add-on">R$</span>
                                        <input type="number" name="hora-aula" id="hora-aula" class="span3" title="Somente Números" placeholder="Somente números" required />
                                        <span class="add-on">.00</span>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <label>Área<span class="text-error">*</span></label>
                                            <select class="span12" id="area" name="area">
                                                <option>Área...</option>
                                                <option value="Idiomas">Idiomas</option>
                                                <option value="Exatas">Exatas</option>
                                                <option value="Humanas">Humanas</option>
                                                <option value="Biológicas">Biológicas</option>
                                                <option value="Linguagens">Linguagens</option>
                                                <option value="Artes">Artes</option>
                                                <option value="Música">Música</option>
                                                <option value="Meio Ambiente">Meio Ambiente</option>
                                            </select>
                                        </div>
                                        <div class="span4">
                                            <label>Categoria<span class="text-error">*</span></label>
                                            <select class="span12" id="categoria" name="categoria"></select>
                                        </div>
                                        <div class="span3">
                                            <label>Especialidade<span class="text-error">*</span></label>
                                            <input type="text" class="span12" pattern="^[A-ZÁÀÃÂÉÈÊÍÌÎÓÒÔÕÚÙÛÇa-záàãâéèêóòõôíìîúùûç\s]+$" name="especialidade" id="especialidade" required placeholder="" />
                                        </div>
                                    </div>
                                    <label>Tipo de Aula<span class="text-error">*</span></label>
                                    <select class="input-large" required name="tipo" id="tipo">
                                        <option>--------------</option>
                                        <option value="Presencial ou Online">Presencial ou Online</option>
                                        <option value="Online">Online</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="sidebox">
                                    <h3 class="text-success"><i class="icon-home"></i>&nbsp; Endereço Residencial</h3>
                                    <div class="row-fluid">
                                        <label for="cep">CEP<span class="text-error">*</span></label>
                                        <input type="text" class="span3" id="cep" name="cep" pattern="^([0-9]{5})-([0-9]{3})$" placeholder="Ex: 12345-678" required title="Ex: XXXXX-XXX" />
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <label for="estado">Estado<span class="text-error">*</span></label>
                                            <select name="estado" id="estado" class="span12" required></select>
                                        </div>
                                        <div class="span3">
                                            <label for="cidade">Cidade<span class="text-error">*</span></label>
                                            <input type="text" name="cidade" id="cidade" pattern="^[A-ZÁÀÃÂÉÈÊÍÌÎÓÒÔÕÚÙÛÇa-záàãâéèêóòõôíìîúùûç0-9\s]+$" placeholder="Informe sua cidade" class="span12" required />
                                        </div>
                                        <div class="span3">
                                            <label for="bairro">Bairro<span class="text-error">*</span></label>
                                            <input type="text" name="bairro" id="bairro" pattern="^[A-ZÁÀÃÂÉÈÊÍÌÎÓÒÔÕÚÙÛÇa-záàãâéèêóòõôíìîúùûç0-9\s]+$" placeholder="Informe seu bairro" class="span12" required />
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <label for="logradouro">Logradouro<span class="text-error">*</span></label>
                                            <input type="text" name="logradouro" id="logradouro" pattern="^[A-ZÁÀÃÂÉÈÊÍÌÎÓÒÔÕÚÙÛÇa-záàãâéèêóòõôíìîúùûç0-9\s]+$" placeholder="Rua, Avenida, Travessa..." class="span12" required />
                                        </div>
                                        <div class="span3">
                                            <label for="numero">Número<span class="text-error">*</span></label>
                                            <input type="number" name="numero" id="numero" class="span12" min="0" placeholder="Somente números" required />
                                        </div>
                                        <div class="span3">
                                            <label for="complemento">Complemento</label>
                                            <input type="text" name="complemento" pattern="^[A-ZÁÀÃÂÉÈÊÍÌÎÓÒÔÕÚÙÛÇa-záàãâéèêóòõôíìîúùûç0-9\s]+$" placeholder="Informe um complemento" id="complemento" class="span12" />
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div id="contentInnerSeparator"></div>
                                        </div>
                                    </div>
                                    <span class="alert-info" style="padding: 5px; border-radius: 5px; font-size: 13px;">
                                        Esse endereço não será divulgado publicamente e é de uso exclusivo do GetTeacher,
                                        para efeitos de cobrança.
                                    </span>
                                </div>
                                <div class="sidebox">
                                    <span class="alert-info" style="float: right; padding: 5px; border-radius: 5px;">
                                        Escolha um nome fácil de lembrar.<br /><br />
                                        Fique atento, você só poderá usar letras, números<br />
                                        ponto(.), traço(-) e sublinhado(_).<br />
                                        Você não poderá trocar esse nome no futuro.
                                    </span>
                                    <h3 class="text-success"><i class="icon-user"></i>&nbsp; Nome de Usuário</h3>
                                    <label for="nomeUsuario">Nome de Usuário<span class="text-error">*</span></label>
                                    <input type="text" name="nomeUsuario" id="nomeUsuario" class="span4" required placeholder="" />
                                </div>
                                <div class="sidebox">
                                    <h3 class="text-success"><i class="icon-comments-alt"></i>&nbsp; Sobre Mim</h3>
                                    <label>Sobre Mim<span class="text-error">*</span></label>
                                    <textarea class="span7 areaTexto" rows="9" cols="20" name="sobre" id="sobre" required placeholder="Máximo de 500 caracteres"></textarea><br />
                                    <span><i class="icon-share-alt"></i>&nbsp;Caracteres Restantes:&nbsp;<span class="text-info contagem">500</span>/500<br /><br /></span>
                                    <span class="alert-info" style="padding: 5px; border-radius: 5px; font-size: 15px;">
                                        Você poderia falar dos seus interesses,
                                        os conhecimentos/habilidades que domina,
                                        qual(is) pretende adquirir, etc.
                                    </span>
                                </div>
                                <div class="sidebox">
                                    <h4 style="font-size: 20px;"><i class="icon-edit"></i>&nbsp; Principais pontos do termo de adesão e funcionamento do GetTeacher</h4>
                                    <p style="text-indent: 32px; font-size: 13px;">&checkmark;&nbsp;Todo <strong>agendamento</strong> e contratação deverá acontecer através do GetTeacher.</p>
                                    <p style="text-indent: 32px; font-size: 13px;">&checkmark;&nbsp;Todo <strong>reagendamento</strong> de aulas deverá acontecer através do GetTeacher.</p>
                                    <p style="text-indent: 32px; font-size: 13px;">&checkmark;&nbsp;Somente alunos com aulas agendadas pelo GetTeacher podem avaliar o professor.</p>
                                    <p style="text-indent: 32px; font-size: 13px;">&checkmark;&nbsp;As aulas realizadas e as avaliações são os principais fatores para aumento do ranking do professor.</p>
                                    <p style="text-indent: 32px; font-size: 13px;">&checkmark;&nbsp;O professor deverá manter seus dados cadastrais atualizados e completos.</p><br />
                                    <p style="text-indent: 32px; font-size: 16px;">&nbsp;Leia o <a href="termos-de-uso.php">termo de adesão na íntegra</a></p>
                                </div>
                                <div class="sidebox"  style="margin-bottom: 20px;">
                                    <table>
                                        <tr>
                                            <td><input type="checkbox" name="termo" id="termo" value="termoDeAdesao" required /></td>
                                            <td><label for="termo" style="margin-top: 11px;">&nbsp;&nbsp;Confirmo que li e aceito todos os termos de adesão.</label></td>
                                        </tr>                                    
                                    </table>
                                </div>
                                <input type="submit" name="btnCadastrarProfessor" id="btnCadastrarProfessor" value="Confirmar Cadastro" class="btn btn-info" />
                                <input type="reset" name="clean-form" id="clean-form" value="Limpar Formulário" class="btn btn-info" />
                            </form>  				 
                            <!--End Contact form -->											 
                        </div>
                    </div>
                </div>
                <!--/End Sidebar Content-->
            </div>			
            <div id="footerInnerSeparator"></div>


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
                                <li><a href="">Torne-se um Professor</a></li>
                                <li><a href="#">Central de Ajuda</a></li>
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
    </div>
    <br /><br /><br />

    <script src="../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script> 
    <script src="../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../resources/scripts/default.js" type="text/javascript"></script>

    <script src="../resources/scripts-custom/selecionarCategoriaProfessor.js"></script>
    <script type="text/javascript" src="../resources/scripts-custom/validation-form.js"></script>
</body>
</html>