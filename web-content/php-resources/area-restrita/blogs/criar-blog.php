<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';
require_once '../../dao/cadastrar.php';

$pdo = Conection::connect();
$id = '';
if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {
    $user = $_SESSION['usuario'];
    $id = $_SESSION['id_usuario'];

    $sql = $pdo->prepare("SELECT * FROM professor WHERE id_professor = ?");
    $sql->execute(array($id));
    $professor = $sql->fetch(PDO::FETCH_OBJ);
    
    if (isset($_POST['criar']) && $_POST['criar'] == "Publicar Artigo") {
        $titulo = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING))));
        $categoria = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING))));
        $area = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'area', FILTER_SANITIZE_STRING))));
        $texto = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING))));
        
        if (isset($_FILES['imagem'])) {
            $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
            $nomeFoto = md5(time()) . $extensao;
            
            $diretorio = "../portifolio/";        

            move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . "/" . $nomeFoto);
        }
        
        $coluna = array(
            "id_professor", "titulo", "texto", "data", "area",
            "categoria", "status", "imagem"
        );
        $valor = array(
            $id, $titulo, $texto, date("Y/m/d H:m:s"), $area,
            $categoria, "0", $nomeFoto
        );
        
        $mensagem = "";
        if (inserir($coluna, $valor, "blog")) {
            $mensagem = "Post publicado com sucesso!";
        } else {
            $mensagem = "Falha ao publicar o post";
        }
        
    }
    
} else {
    header("location: ../../../../");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Bem Vindo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Html5TemplatesDreamweaver.com">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!-- Remove this Robots Meta Tag, to allow indexing of site -->
        
        <link rel="shortcut icon" href="../../../../icone.bmp" />
        
        <link href="../../../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="../../../resources/css/AdminLTE.min.css" rel="stylesheet">
        <link href="../../../resources/css/_all-skins.min.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Icons -->
        <link href="../../../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
        <link href="../../../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
        <!--[if lt IE 8]>
            <link href="scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
            <link href="scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
        <![endif]-->
        <link rel="stylesheet" href="../../../resources/scripts/fontawesome/css/font-awesome.min.css">
        <!--[if IE 7]>scripts/
            <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome-ie7.min.css">
        <![endif]-->

        <link href="../../../resources/scripts/carousel/style.css" rel="stylesheet" type="text/css" />
        <link href="../../../resources/scripts/camera/css/camera.css" rel="stylesheet" type="text/css" />
        <link href="../../../resources/css/styles-custom.css" rel="stylesheet" type="text/css" />

        <link href="../../../../styles/custom.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <input type="hidden" id="id_usuario" value="<?php echo $id; ?>" />
        <div class="container" id="divBoxed">
            <div class="transparent-bg" style="position: absolute;top: -2%;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>
            <!-- Menu de Navegação -->
            <div class="divPanel notop nobottom">
                <div class="navbar navbar-inverse navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid" style="margin-left: 8%;">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><b class="caret"></b></a>
                            <a href="<?php echo $_SESSION['pagina']; ?>" class="brand">GETTEACHER</a>
                            <div class="nav-collapse collapse">
                                <ul class="nav">
                                    <li class=""><a href="<?php echo $_SESSION['pagina']; ?>">Home</a></li>
                                    <li class=""><a href="../app/aulas.php">Aulas</a></li>
                                    <li class=""><a href="../chat/conversas.php">Mensagens</a></li>
                                    <li class=""><a href="../app/editarPerfil.php">Editar Perfil</a></li>
                                </ul>
                                <ul class="nav pull-right" style="margin-right: 8%;">
                                    <li class="dropdown not-mensagens">
                                        <span class="alert-error not-mensagens notificao tot-men"></span>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <span style="font-size: 15pt;">
                                                <i class="icon-comments-alt"></i>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu notis not-mensagens">
                                            <li class="centered_menu text-info">Mensagens</li>
                                            <li class="divider"></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown noti">
                                        <span class="alert-error notificao notis"></span>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <span style="font-size: 15pt;">
                                                <i class="icon-globe"></i>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu notificacoes notis">
                                            <li class="centered_menu text-info">Notificações</li>
                                            <li class="divider"></li>
                                        </ul>
                                    </li>
                                    <li class="divider-vertical"></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $professor->nome_professor; ?><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="span3 user alert-info">
                                                <div class="row-fluid">
                                                    <div class="span10" style="margin: 15px;">
                                                        <img src="../professor/imagens/perfil/<?php echo $professor->foto_perfil; ?>" class="foto-perfil img-bordered-sm"/>
                                                    </div>
                                                    <div class="span12">
                                                        <a href="../professor/perfil.php" class="btn btn-success btn-small span5 p">Perfil Completo</a>
                                                        <a href="../app/editarPerfil.php" class="btn btn-success btn-small span5 p">Editar Perfil</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row-fluid">
                                                    <div class="span6 perfil" style="text-align: center;">
                                                        <a href=""><h3><i class="icon-trophy text-info"></i></h3>
                                                            Pontos</a>
                                                    </div>
                                                    <div class="span6 perfil" style="text-align: center;">
                                                        <a href=""><h3><i class="icon-folder-open text-info"></i></h3>
                                                            Arquivos</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row-fluid">
                                                    <div class="span6 perfil" style="text-align: center;">
                                                        <a href="../../domain/forum.php"><h3><i class="icon-comments text-info"></i></h3>
                                                            Tira Dúvidas</a>
                                                    </div>
                                                    <div class="span6 perfil" style="text-align: center;">
                                                        <a href="../app/logOut.php"><h3><i class="icon-signout text-info"></i></h3>
                                                            Sair</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim do menu de navegação -->
            
            <!-- conteúdo -->
            <!-- Conteúdo Principal -->
            <div class="contentArea">
                <div class="divPanel notop nobottom">
                    <div class="breadcrumbs">
                        <a href="<?php echo $_SESSION['pagina']; ?>">Home</a> &nbsp;/&nbsp; <span>Publicar Artigo</span>
                    </div>
                    <div class="row-fluid">
                        <div class="sidebox span8 offset2">
                            <?php if (isset($_POST['criar']) && $_POST['criar'] == "Publicar Post"): ?>
                                <div class="alert alert-info span12" style="display: block;" >
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <?php echo "<h4>".$mensagem."</h4>"; ?>
                                </div>
                            <?php endif; ?>
                            <div class="row-fluid">
                                <div class="span12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                            <legend class="text-info">Publicar Artigo</legend>
                                            <label for="titulo">Titulo<span class="text-error">*</span></label>
                                            <input type="text" name="titulo" id="titulo" required class="span12" />
                                            <label for="autor">Autor</label>
                                            <input type="text" name="nome" id="nome" readonly class="span12" value="<?php echo $professor->nome_professor; ?>" />
                                            <label for="data">Data</label>
                                            <input type="text" name="data" id="data" readonly class="span12" value="<?php echo date("d/m/Y"); ?>" />
                                            <div class="row-fluid">
                                                <div class="pull-right span6">
                                                    <label for="categoria">Categoria<span class="text-error">*</span></label>
                                                    <select id="categoria" name="categoria" class="span12"></select>
                                                </div>
                                                <label for="area">Área<span class="text-error">*</span></label>
                                                <select name="area" id="area" class="area span6">
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
                                            <label for="imagem">Imagem<span class="text-error">*</span></label>
                                            <div class="btn btn-info btn-file">
                                                <i class="fa icon-picture" style="font-size: 12pt; color: white;"></i> &nbsp;&nbsp;Anexar Imagem
                                                <input type="file" id="imagem" name="imagem" required />
                                            </div>
                                            <br /><br />
                                            <label for="texto">Texto<span class="text-error">*</span></label>
                                            <textarea name="texto" id="texto" required rows="10" class="span12"></textarea>
                                            <input type="submit" name="criar" id="criar" value="Publicar Artigo" class="pull-right btn btn-info span3" />
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Fim conteúdo -->

            
            <!-- Inicio Rodapé -->
            <div id="footerOuterSeparator"></div>

            <div id="divFooter" class="footerArea">

                <div class="divPanel">

                    <div class="row-fluid">
                        <div class="span3" id="footerArea1">

                            <h3>Sobre</h3>
                            <ul>
                                <li><a href="../../../pages/termos-de-uso.php" title="Terms of Use">Termos de uso</a></li>
                                <li><a href="../../../pages/politicas-privacidade.php" title="Privacy Policy">Políticas de privacidade</a></li>
                                <li><a href="../../../pages/faq.php" title="FAQ">FAQ</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea2">

                            <h3>Alunos</h3>
                            <ul>
                                <li><a href="../../domain/forum.php">Tira Dúvidas</a></li>
                                <li><a href="../../../pages/central-de-ajuda.php">Central de Ajuda</a></li>
                                <li><a href="../../../pages/cadastro-aluno.php">Cadastre-se</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea3">

                            <h3>Professores</h3>
                            <ul>
                                <li><a href="../../../pages/cadastro-professor.php">Torne-se um Professor</a></li>
                                <li><a href="../../../pages/central-de-ajuda.php">Central de Ajuda</a></li>
                                <li><a href="../../domain/blog-dos-professores.php">Blog dos Professores</a></li>
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
    </body>

    <script src="../../../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script> 
    <script src="../../../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/default.js" type="text/javascript"></script>
    <script src="../js/editarPerfil.js" type="text/javascript"></script>
    <script src="../js/chat-ajax.js" type="text/javascript"></script>
    <script src="../js/notificacoes.js" type="text/javascript"></script>
    <script src="../../../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>   
    <script src="../js/blog.js" type="text/javascript"></script>

</html>