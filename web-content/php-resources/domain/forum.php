<!DOCTYPE HTML>
<?php
session_start();

    $_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];

    date_default_timezone_set("America/Belem");

    require_once '../factory/conexao.php';
    require_once '../dao/selecionar.php';
    require_once '../util/selecionarUsuario.php';
    require_once '../dao/cadastrar.php';
    require_once '../dao/atualizar.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if (!empty(strip_tags(trim(filter_input(INPUT_POST, "enviar-duvida", FILTER_SANITIZE_STRING))))) {
            
            $assunto = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "assunto", FILTER_SANITIZE_STRING))));
            $duvida = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "duvida", FILTER_SANITIZE_STRING))));
            $complemento = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_STRING))));
            
            if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "Aluno") {
                $coluna = array(
                    "id_aluno_forum", "duvida", "complemento", "assunto", "data", "status"
                );
                $valor = array(
                    $_SESSION['id_usuario'], $duvida, $complemento, $assunto, date("Y/m/d H:i:s"), "0"
                );
            } else {
                $nome = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING))));
                $sobrenome = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, "sobrenome", FILTER_SANITIZE_STRING))));
                $email = strip_tags(trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING)));
                
                $coluna = array(
                    "id_aluno_forum", "nome", "email", "duvida", "complemento", "assunto", "data", "status"
                );
                $valor = array(
                    "0", implode(" ", array($nome, $sobrenome)), $email, $duvida, $complemento, $assunto, date("Y/m/d H:i:s"), "0"
                );
            }
            
            inserir($coluna, $valor, "forum");
            
        }
        
        if (!empty(strip_tags(trim(filter_input(INPUT_POST, "enviar-resposta", FILTER_SANITIZE_STRING))))) {
            $id_professor = $_SESSION['id_usuario'];
            $resposta = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'resposta', FILTER_SANITIZE_STRING))));
            $id_duvida = strip_tags(trim(filter_input(INPUT_POST, 'id_duvida', FILTER_SANITIZE_STRING)));
            
            if ($resposta != "") {
                if (inserir(array("id_duvida", "id_professor", "resposta", "data_resposta"), array($id_duvida, $id_professor, $resposta, date("Y/m/d H:i:s")), "resposta_forum")) {

                    update("status", "1", "forum", "WHERE id_duvida = $id_duvida");

                }
            }
        }
        
    }


    $duvidas = strip_tags(trim(filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_STRING)));
    $categoria = utf8_decode(strip_tags(trim(filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_STRING))));
    $forum = utf8_decode(strip_tags(trim(filter_input(INPUT_GET, 'forum', FILTER_SANITIZE_STRING))));

    if (!empty($duvidas) && $duvidas == "last" && !(empty($categoria)) && $categoria !== "Categoria") {

        $getDuvidas = select("forum f INNER JOIN aluno a", "f.id_duvida, f.id_aluno_forum, f.nome, f.assunto, f.email, f.duvida, f.complemento, f.data, a.nome_aluno, a.foto_perfil", "WHERE f.id_aluno_forum = a.id_aluno AND f.assunto = '$categoria'", "ORDER BY f.id_duvida DESC");

    } else if (!empty($duvidas) && $duvidas == "empty" && !(empty($categoria)) && $categoria !== "Categoria") {

        $getDuvidas = select("forum f INNER JOIN aluno a", "f.id_duvida, f.id_aluno_forum, f.nome, f.assunto, f.email, f.duvida, f.complemento, f.data, a.nome_aluno, a.foto_perfil", "WHERE f.id_aluno_forum = a.id_aluno AND f.status = 0 AND f.assunto = '$categoria'", "ORDER BY f.id_duvida DESC");

    } else if (!empty($duvidas) && $duvidas == "empty") {

        $getDuvidas = select("forum f INNER JOIN aluno a", "f.id_duvida, f.id_aluno_forum, f.nome, f.assunto, f.email, f.duvida, f.complemento, f.data, a.nome_aluno, a.foto_perfil", "WHERE f.id_aluno_forum = a.id_aluno AND f.status = 0", "ORDER BY f.id_duvida DESC");

    } else if (!(empty($categoria)) && $categoria !== "Categoria") {

        $getDuvidas = select("forum f INNER JOIN aluno a", "f.id_duvida, f.id_aluno_forum, f.nome, f.assunto, f.email, f.duvida, f.complemento, f.data, a.nome_aluno, a.foto_perfil", "WHERE f.id_aluno_forum = a.id_aluno AND f.assunto = '$categoria'", "ORDER BY f.id_duvida DESC");

    } else if (!(empty($forum))) {

        $getDuvidas = select("forum f INNER JOIN aluno a", "f.id_duvida, f.id_aluno_forum, f.nome, f.assunto, f.email, f.duvida, f.complemento, f.data, a.nome_aluno, a.foto_perfil", "WHERE (f.id_aluno_forum = a.id_aluno) AND (f.duvida LIKE '%$forum%' OR f.complemento LIKE '%$forum%' OR f.assunto LIKE '%$forum%')", "ORDER BY f.id_duvida DESC");

    } else {

        $getDuvidas = select("forum f INNER JOIN aluno a", "f.id_duvida, f.id_aluno_forum, f.nome, f.assunto, f.email, f.duvida, f.complemento, f.data, a.nome_aluno, a.foto_perfil", "WHERE f.id_aluno_forum = a.id_aluno", "ORDER BY f.id_duvida DESC");

    }

?>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Tira Dúvidas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Html5TemplatesDreamweaver.com">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!-- Remove this Robots Meta Tag, to allow indexing of site -->

        <link rel="shortcut icon" href="../../../icone.bmp" />

        <link href="../../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="../../resources/css/AdminLTE.min.css" rel="stylesheet">
        <link href="../../resources/css/_all-skins.min.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Icons -->
        <link href="../../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet"
              type="text/css"/>
        <link href="../../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen"
              rel="stylesheet" type="text/css"/>
        <!--[if lt IE 8]>
        <link href="../../resources/scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen"
              rel="stylesheet"
              type="text/css"/>
        <link href="../../resources/scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen"
              rel="stylesheet"
              type="text/css"/>
        <![endif]-->
        <link rel="stylesheet" href="../../resources/scripts/fontawesome/css/font-awesome.min.css">
        <!--[if IE 7]>scripts/
        <link rel="stylesheet" href="../../resources/scripts/fontawesome/css/font-awesome-ie7.min.css">
        <![endif]-->

        <link href="../../../styles/custom.css" rel="stylesheet" type="text/css"/>

        <link href="../../resources/css/styles-custom.css" rel="stylesheet">
    </head>
    <body id="pageBody">
        <span id="id_usr" style="display: none;"><?php echo (isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario'] == "Aluno") ? $_SESSION['id_usuario'] : "0"; ?></span>
        <div id="divBoxed" class="container">

            <div class="transparent-bg"
                 style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

            <div class="divPanel notop nobottom">
                <div class="row-fluid">
                    <div class="span12">

                        <div id="divLogo" class="pull-left">
                            <a href="../../../" id="divSiteTitle">getteacher</a><br/>
                            <a href="../../../" id="divTagLine">Seu Professor Online</a>
                        </div>

                        <div id="divMenuRight" class="pull-right">
                            <div class="navbar">
                                <button type="button" class="btn btn-navbar-highlight btn-large btn-primary"
                                        data-toggle="collapse" data-target=".nav-collapse">
                                    Menu <span class="icon-chevron-down icon-white"></span>
                                </button>
                                <div class="nav-collapse collapse">
                                    <ul class="nav nav-pills ddmenu">
                                        <li><a href="../../../">Home</a></li>
                                        <li><a href="../../pages/sobre.php">Sobre</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="listar-professores.php?area=Idiomas">Idiomas</a></li>
                                                <li><a href="listar-professores.php?area=Exatas">Exatas</a></li>
                                                <li><a href="listar-professores.php?area=Humanas">Humanas</a></li>
                                                <li><a href="listar-professores.php?area=Artes">Artes</a></li>
                                                <li><a href="listar-professores.php?area=Música">Música</a></li>
                                                <li><a href="listar-professores.php?area=Linguagens">Linguagens</a></li>
                                                <li><a href="listar-professores.php?area=Biológicas">Biológicas</a></li>
                                                <li><a href="listar-professores.php?area=Meio Ambiente">Meio Ambiente</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog-dos-professores.php">Blog</a></li>
                                        <li><a href="../../pages/contato.php">Contatos</a></li>
                                        <?php if (isset($_SESSION['usuario'])): ?>
                                            <li class="dropdown">
                                                <a href="" dropdown-toggle><?php echo selecionarUsuario(); ?><b class="caret"></b></a>
                                                <?php if ($_SESSION['tipo_usuario'] != "Admin"): ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../area-restrita/chat/conversas.php">Mensagens</a></li>
                                                        <li><a href="../area-restrita/app/aulas.php">Aulas</a></li>
                                                        <li><a href="../area-restrita/app/editarPerfil.php">Editar perfil</a></li>
                                                        <li><a href="../area-restrita/app/logOut.php">Sair</a></li>
                                                    </ul>
                                                <?php else: ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../area-restrita/admin/pages/mailbox/mailbox.php">Caixa de Entrada</a></li>
                                                        <li><a href="../area-restrita/admin/pages/tables/dados.php">Cadastros</a></li>
                                                        <li><a href="../area-restrita/app/logOut.php">Sair</a></li>
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
                                <form class="form-inline" action="../area-restrita/app/login.php" method="post">
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
                                    <a href="../../pages/cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;</a>
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

                    <div class="row-fluid">
                        <div class="breadcrumbs span12">
                            <a href="../../../">Home</a> &nbsp;/&nbsp; <span class="username">Tira dúvidas</span>
                            
                            <div class="pull-right span4">
                                <form action="forum.php#hr" method="get" class="form-search">
                                   <input type="search" name="forum" id="forum" class="search-query span12" placeholder="Qual a sua dúvida?" />
                               </form>
                           </div>
                        </div>
                    </div>

                    <h2 class="text-info">

                    </h2>

                    <div class="row-fluid">
                        <div class="span12">
                            <div id="contentInnerSeparator"></div>
                        </div>
                    </div>


                    <div class="row-fluid">
                        
                        <div class="span9">
                            <h6 class="centered_menu text-info"><img style="height: 70px;" src="../area-restrita/portifolio/duvida.png" /></h6>
                            <h4 class="centered_menu" style="color: #888;">Tira Dúvidas</h4>
                            <p class="centered_menu muted">Dúvida em algum assunto? Pergunte e receba resposta gratuita dos professores cadastrados no GetTeacher!</p>

                            <div class="row-fluid">
                                <div class="span12">
                                    <div id="contentInnerSeparator"></div>
                                </div>
                            </div>

                            <form class="" action="forum.php" method="post">
                                <select class="span12" name="assunto" id="assunto">
                                    <option>Escolha um assunto...</option>
                                    <optgroup label="Idiomas">
                                        <option>Ingles</option>
                                        <option>Frances</option>
                                        <option>Alemão</option>
                                        <option>Mandarin</option>
                                        <option>Japonês</option>
                                        <option>Chinês</option>
                                        <option>Libras</option>
                                        <option>Italiano</option>
                                        <option>Português para Estrangeiros</option>
                                    </optgroup>
                                    <optgroup label="Exatas">
                                        <option>Matematica</option>
                                        <option>Computação</option>
                                        <option>Fisica</option>
                                        <option>Quimica</option>
                                        <option>Cálculo</option>
                                        <option>Estatística</option>
                                        <option>Engenharia</option>
                                        <option>Matemática</option>
                                        <option>Financeira</option>
                                    </optgroup>
                                    <optgroup label="Humanas">
                                        <option>Ciências Sociais</option>
                                        <option>Geografia</option>
                                        <option>História</option>
                                        <option>Filosofia</option>
                                        <option>Sociologia</option>
                                        <option>Psicologia</option>
                                        <option>Direito</option>
                                    </optgroup>
                                    <optgroup label="Biológicas">
                                        <option>Nutrição     </option>
                                        <option>Terapia Ocupacional</option>
                                        <option>Biologia</option>
                                        <option>Zootecnia</option>
                                        <option>Fonoaudiologia</option>
                                        <option>Educação Física</option>
                                    </optgroup>
                                    <optgroup label="Artes">
                                        <option>Arte Digital</option>
                                        <option>Dança</option>
                                        <option>Pintura</option>
                                        <option>Desenho</option>
                                        <option>Fotografia</option>
                                        <option>Teatro</option>
                                        <option>Esportes</option>
                                        <option>Culinária</option>
                                    </optgroup>
                                    <optgroup label="Música">
                                        <option>Aula de Canto</option>
                                        <option>Instrumentos</option>
                                        <option>Música Clássica</option>
                                        <option>Música[Outros]</option>
                                    </optgroup>
                                    <optgroup label="Linguagens">
                                        <option>Português</option>
                                        <option>Redação</option>
                                        <option>Gramática</option>
                                        <option>Literatura</option>
                                        <option>Pedagogia</option>
                                        <option>Linguagens[Outros]</option>
                                    </optgroup>
                                    <optgroup label="Meio Ambiente">
                                        <option>Desenvolvimento e Sustentabilidade</option>
                                        <option>Direito e Legislação Ambiental</option>
                                        <option>Economia de Recursos Naturais</option>
                                        <option>Educação Ambiental</option>
                                        <option>Saúde e Meio Ambiente</option>
                                        <option>Outros</option>
                                    </optgroup>
                                </select>
                                <input type="text" name="duvida" id="duvida" class="span12" required placeholder="Qual é a sua dúvida? Escreva aqui sua pergunta." />
                                <textarea name="complemento" id="complemento" class="span12" placeholder="Quer complementar a sua pergunta? Caso necessário, use esse campo."></textarea>

                                <?php if (!isset($_SESSION['usuario'])): ?>
                                    
                                    <input type="text" name="nome" id="nome" class="span4" required placeholder="Informe seu nome" />
                                    <input type="text" name="sobrenome" id="sobrenome" class="span4" required placeholder="Informe seu sobrenome" />
                                    <input type="text" name="email" id="email" class="span4" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" required placeholder="Informe seu email" />
                                    
                                <?php endif; ?>

                                <div class="row-fluid">
                                    <div class="span12">
                                        <div id="contentInnerSeparator"></div>
                                    </div>
                                </div> 

                                <?php if (!isset($_SESSION['usuario']) || isset($_SESSION['usuario']) && $_SESSION['tipo_usuario'] == "Aluno") { ?>
                                    <input type="submit" name="enviar-duvida" id="enviar" class="span3 btn btn-info offset4" value="Enviar Pergunta" />
                                <?php } else { ?>
                                    <span id="eProf" class="span3 btn btn-info offset4">Enviar Pergunta</span>
                                <?php } ?>

                            </form>

                            <div class="row-fluid">
                                <div class="span12">
                                    <div id="contentInnerSeparator"></div>
                                </div>
                            </div>                          
                            
                            <hr id="hr" />
                            
                            <div class="row-fluid">
                                <div class="alert alert-block bg-blue-gradient">
                                    <div class="pull-right span8" style="margin-top: -.55%;">
                                        <span>Filtrar por?</span>
                                        <select class="span5" id="duvidas" name="duvidas">
                                            <option>Dúvidas</option>
                                            <option value="last">Últimas dúvidas</option>
                                            <option value="empty">Dúvida sem resposta</option>
                                        </select>
                                        <select class="span5" id="categoria" name="categoria">
                                            <option>Categoria</option>
                                            <optgroup label="Idiomas">
                                                <option>Ingles</option>
                                                <option>Frances</option>
                                                <option>Alemão</option>
                                                <option>Mandarin</option>
                                                <option>Japonês</option>
                                                <option>Chinês</option>
                                                <option>Libras</option>
                                                <option>Italiano</option>
                                                <option>Português para Estrangeiros</option>
                                            </optgroup>
                                            <optgroup label="Exatas">
                                                <option>Matematica</option>
                                                <option>Computação</option>
                                                <option>Fisica</option>
                                                <option>Quimica</option>
                                                <option>Cálculo</option>
                                                <option>Estatística</option>
                                                <option>Engenharia</option>
                                                <option>Matemática</option>
                                                <option>Financeira</option>
                                            </optgroup>
                                            <optgroup label="Humanas">
                                                <option>Ciências Sociais</option>
                                                <option>Geografia</option>
                                                <option>História</option>
                                                <option>Filosofia</option>
                                                <option>Sociologia</option>
                                                <option>Psicologia</option>
                                                <option>Direito</option>
                                            </optgroup>
                                            <optgroup label="Biológicas">
                                                <option>Nutrição     </option>
                                                <option>Terapia Ocupacional</option>
                                                <option>Biologia</option>
                                                <option>Zootecnia</option>
                                                <option>Fonoaudiologia</option>
                                                <option>Educação Física</option>
                                            </optgroup>
                                            <optgroup label="Artes">
                                                <option>Arte Digital</option>
                                                <option>Dança</option>
                                                <option>Pintura</option>
                                                <option>Desenho</option>
                                                <option>Fotografia</option>
                                                <option>Teatro</option>
                                                <option>Esportes</option>
                                                <option>Culinária</option>
                                            </optgroup>
                                            <optgroup label="Música">
                                                <option>Aula de Canto</option>
                                                <option>Instrumentos</option>
                                                <option>Música Clássica</option>
                                                <option>Música[Outros]</option>
                                            </optgroup>
                                            <optgroup label="Linguagens">
                                                <option>Português</option>
                                                <option>Redação</option>
                                                <option>Gramática</option>
                                                <option>Literatura</option>
                                                <option>Pedagogia</option>
                                                <option>Linguagens[Outros]</option>
                                            </optgroup>
                                            <optgroup label="Meio Ambiente">
                                                <option>Desenvolvimento e Sustentabilidade</option>
                                                <option>Direito e Legislação Ambiental</option>
                                                <option>Economia de Recursos Naturais</option>
                                                <option>Educação Ambiental</option>
                                                <option>Saúde e Meio Ambiente</option>
                                                <option>Outros</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div>
                                        <span><i class="icon-info-sign"></i>&nbsp;DÚVIDAS</span>                                      
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row-fluid">
                                <div class="span12">

                                <?php 
                                    if ($getDuvidas):
                                        foreach ($getDuvidas as $duvida): ?>

                                            <hr class="divider" id="hr<?php echo $duvida->id_duvida; ?>" />
                                            <div class="box box-widget">
                                                <div class='box-header with-border' style="text-align: left;">
                                                    <div class='user-block'>
                                                        <div class="row-fluid">
                                                            <div class="span2">

                                                                <?php 
                                                                    $foto = ($duvida->id_aluno_forum == 0) ? "default.jpg" : $duvida->foto_perfil; 
                                                                    $nome = ($duvida->id_aluno_forum == 0) ? $duvida->nome : $duvida->nome_aluno;
                                                                ?>

                                                                <img class='usr' src="../area-restrita/aluno/imagens/perfil/<?php echo $foto; ?>" alt='user image'>
                                                            </div>
                                                            <div class="span10" style="margin-left: -10%;">
                                                                <span class='username'><?php echo utf8_encode($nome); ?></span>
                                                                <span class='description'>Dúvida sobre <a class="a" href="forum.php?categoria=<?php echo utf8_encode($duvida->assunto); ?>"><?php echo utf8_encode($duvida->assunto); ?></a> em <?php echo date("d/m/Y H:i", strtotime($duvida->data)); ?></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.user-block -->
                                                </div><!-- /.box-header -->
                                                
                                                <div style="text-align: left;" class='box-body'>
                                                    <h4 class="text-muted" style="font-size: 20pt;"><?php echo utf8_encode($duvida->duvida); ?></h4>
                                                    <pre style="border: none; font-family: sans-serif; text-align: justify;"><?php echo "<pre style='border: none; font-family: sans-serif;'>".utf8_encode($duvida->complemento)."</pre>"; ?></pre>
                                                </div><!-- /.box-body -->
                                                
                                                
                                                <div class="">
                                                    <div style="text-align: left;" class='box-footer'>

                                                        <?php $getRespostas = select("resposta_forum r, forum f, professor p", "*", "WHERE f.id_duvida = r.id_duvida AND r.id_duvida = $duvida->id_duvida AND p.id_professor = r.id_professor", "ORDER BY r.id_resposta DESC"); ?>
                                                        
                                                        <span><img style="height: 20px;" src="../area-restrita/portifolio/img.png">&nbsp;<?php echo (empty($getRespostas)) ? "0" : count($getRespostas); ?> <?php echo (count($getRespostas) > 1) ? "Respostas" : "Resposta" ?></span>
                                                        
                                                        <?php 
                                                            if ($getRespostas):
                                                                foreach ($getRespostas as $resposta): 
                                                                    ?>

                                                                    <div class="row-fluid" style="margin-top: 2%;">
                                                                        
                                                                        <div class='box-comment span12'>
                                                                            
                                                                            <div class="span9 pull-right" style="margin-left: 2%; margin-top: .7%;">
                                                                                <div class='comment-text'>
                                                                                    <span class="username" style="margin-top: 1%;">Prof. <a class="a" href="perfil-professor.php?professor=<?php echo $resposta->id_professor; ?>#banner"><?php echo utf8_encode($resposta->nome_professor); ?></a> respondeu em <?php echo date("d/m/Y H:i", strtotime($resposta->data_resposta)); ?></span><!-- /.username -->
                                                                                    <br />
                                                                                    <?php echo "<pre style='border: none; font-family: sans-serif;'>".utf8_encode($resposta->resposta)."</pre>"; ?>
                                                                                </div><!-- /.comment-text -->
                                                                            </div>
                                                                            
                                                                            <div class="pull-left" style="margin: 5% 2%;">
                                                                                <img class="usr2" src="../area-restrita/professor/imagens/perfil/<?php echo $resposta->foto_perfil; ?>" alt='user image'>
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-share-alt" style="color: #006dcc; font-size: 17pt;"></i>
                                                                            </div>
                                                                                                                                    
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    <?php 
                                                                endforeach; 
                                                            endif;
                                                        ?>
                                                                                                                                                                        
                                                    </div><!-- /.box-footer -->
                                                </div>
                                                
                                                <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "Professor"): ?>
                                                    
                                                    <?php 
                                                        $getFoto = select("professor", "foto_perfil", "WHERE id_professor = ".$_SESSION['id_usuario']); 
                                                        foreach ($getFoto as $foto_perfil) {
                                                            $foto = $foto_perfil->foto_perfil;
                                                        }
                                                    ?>

                                                    <div class="box-footer">
                                                        <div class="row-fluid">
                                                            
                                                            <div class='comment'>
                                                                <div class='span2' style="margin-top: 1%; margin-left: -2.7%;">
                                                                    <img class="usr2" src="../area-restrita/professor/imagens/perfil/<?php echo $foto; ?>" alt="alt text">
                                                                </div>
                                                                <!-- .img-push is used to add margin to elements next to floating images -->
                                                                <div class="span10">
                                                                    <form action="forum.php#hr<?php echo $duvida->id_duvida; ?>" method="post">
                                                                        <textarea type="text" class="span12 msg" name="resposta" rows="3" placeholder="Escreva sua resposta"></textarea>
                                                                        <input type="hidden" name="id_duvida" value="<?php echo $duvida->id_duvida; ?>" />
                                                                        <input type="submit" class="btn btn-success pull-right" name="enviar-resposta" value="Enviar Resposta" />
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div><!-- /.box-footer -->
                                                    
                                                <?php endif; ?>
                                                    
                                            </div><!-- /.box -->

                                            <?php 
                                        endforeach;
                                    endif;
                                 ?>
                                                                      
                                </div>
                            </div>
                            
                        </div>


                        <div class="span3 sidebox pull-right">
                            <h4 class="text-info">Últimas perguntas</h4><hr />
                            <?php $getUltimasPerguntas = select("forum", "*", NULL, "ORDER BY id_duvida DESC", "LIMIT 5"); ?>
                            <?php 
                                if ($getUltimasPerguntas):
                                    foreach ($getUltimasPerguntas as $ultima):
                                        $totalRespostas = Conection::connect()->query("SELECT * FROM resposta_forum WHERE id_duvida = $ultima->id_duvida");
                                        ?>
                                        <div class="row-fluid">
                                            <p><a href="forum.php?forum=<?php echo utf8_encode($ultima->duvida); ?>#hr"><?php echo utf8_encode($ultima->duvida); ?></a></p>
                                            <span class="muted pull-right"><img src="../area-restrita/portifolio/img.png" style="width: 16px;">&nbsp;<?php echo $totalRespostas->rowCount()." Respostas"; ?></span><hr class="span12" />
                                        </div>
                                        <?php 
                                    endforeach;
                                endif;
                            ?>
                        </div>

                    </div>

                    

                </div>

                <div id="footerOuterSeparator"></div>

                <div id="divFooter" class="footerArea">

                    <div class="divPanel">

                        <div class="row-fluid">
                            <div class="span3" id="footerArea1">

                                <h3>Sobre</h3>
                                <ul>
                                    <li><a href="../../pages/termos-de-uso.php" title="Terms of Use">Termos de uso</a></li>
                                    <li><a href="../../pages/politicas-privacidade.php" title="Privacy Policy">Políticas de privacidade</a></li>
                                    <li><a href="../../pages/faq.php" title="FAQ">FAQ</a></li>
                                </ul>

                            </div>
                            <div class="span3" id="footerArea2">

                                <h3>Alunos</h3>
                                <ul>
                                    <li><a href="">Tira Dúvidas</a></li>
                                    <li><a href="../../pages/central-de-ajuda.php">Central de Ajuda</a></li>
                                    <li><a href="../../pages/cadastro-aluno.php">Cadastre-se</a></li>
                                </ul>

                            </div>
                            <div class="span3" id="footerArea3">

                                <h3>Professores</h3>
                                <ul>
                                    <li><a href="../../pages/cadastro-professor.php">Torne-se um Professor</a></li>
                                    <li><a href="../../pages/central-de-ajuda.php">Central de Ajuda</a></li>
                                    <li><a href="blog-dos-professores.php">Blog dos Professores</a></li>
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
        <br/><br/><br/>

        <script src="../../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../resources/scripts/default.js" type="text/javascript"></script>
        <script src="../../resources/scripts-custom/selecionarCategoriaProfessor.js"></script>
        <script src="../../php-resources/area-restrita/js/blog.js"></script>
        
        <script src="../../resources/scripts/app.min.js" type="text/javascript"></script>
        <script src="../../resources/scripts/dashboard2.js" type="text/javascript"></script>
        <script src="../../resources/scripts/demo.js" type="text/javascript"></script>

        <script type="text/javascript">

            document.getElementById("categoria").addEventListener("change", function () {

                var url = location.href.split("&")[0];
                if (url.substring(url.length-9, url.length) === "forum.php") {
                    location = url + "?categoria=" + this.value;
                } else {
                    location = url + "&categoria=" + this.value;
                }

            });

            document.getElementById("duvidas").addEventListener("change", function () {
                location = "forum.php?filter=" + this.value;                
            });

            document.getElementById("eProf").addEventListener("click", function() {
                alert("Professor não envia pergunta, só responde.");
            });

        </script>

    </body>
</html>