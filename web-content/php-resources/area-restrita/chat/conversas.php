<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';
require_once '../../util/tipoUsuario.php';

$pdo = Conection::connect();

$id = '';
if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {
    $user = $_SESSION['usuario'];
    $id = $_SESSION['id_usuario'];

    if ($_SESSION['tipo_usuario'] == "Professor") {
        $pegaUsuario = select("professor", "nome_professor AS nome_usuario, foto_perfil", "WHERE `id_professor` = '$id'");
        $conversa = select("mensagens m, professor p, aluno a, usuarios u", "DISTINCT m.id_aluno AS id_conversa, COUNT(m.id_mensagem) AS total, a.nome_aluno AS nome_usuario, a.foto_perfil", "WHERE u.id_professor = p.id_professor AND m.id_aluno = a.id_aluno AND p.id_professor = m.id_professor AND m.id_professor = '$id' GROUP BY id_conversa", "ORDER BY m.data DESC");
    } else {
        $pegaUsuario = select("aluno", "nome_aluno AS nome_usuario, foto_perfil", "WHERE `id_aluno` = $id");
        $conversa = select("mensagens m, professor p, aluno a, usuarios u", "DISTINCT m.id_professor AS id_conversa, COUNT(m.id_mensagem) AS total, p.nome_professor AS nome_usuario, p.foto_perfil", "WHERE u.id_aluno = a.id_aluno AND m.id_professor = p.id_professor AND a.id_aluno = m.id_aluno AND m.id_aluno = $id GROUP BY id_conversa", "ORDER BY m.data DESC");
    }
} else {
    header("location: ../../../../");
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
    <body class="hold-transition skin-blue sidebar-mini">
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
                                    <li class="active"><a href="conversas.php">Mensagens</a></li>
                                    <li class=""><a href="../app/editarPerfil.php">Editar Perfil</a></li>
                                </ul>
                                <ul class="nav pull-right" style="margin-right: 8%;">
                                    <li class="dropdown not-mensagens noti">
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
                                    <?php foreach ($pegaUsuario as $usuario): ?>
                                        <li class="divider-vertical"></li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo utf8_encode($usuario->nome_usuario); ?><b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li class="span3 user alert-info">
                                                    <div class="row-fluid">
                                                        <div class="span10" style="margin: 15px;">
                                                            <img src="<?php echo $_SESSION['pagina']. "/imagens/perfil/". $usuario->foto_perfil; ?>" class="foto-perfil img-bordered-sm"/>
                                                        </div>
                                                        <div class="span12">
                                                            <?php if ($_SESSION['tipo_usuario'] == "Professor"): ?>
                                                                <a href="../professor/perfil.php" class="btn btn-success btn-small span5 p">Perfil Completo</a>
                                                            <?php else: ?>
                                                                <a href="../app/aulas.php" class="btn btn-success btn-small span5 p">Minhas Aulas</a>
                                                            <?php endif; ?>
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
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fim do menu de navegação--> 

            <!-- Inicio Conteúdo Principal -->
            <div class="contentArea">
                <div class="divPanel notop nobottom">
                    <div class="breadcrumbs">
                        <a href="<?php echo $_SESSION['pagina']; ?>">Home</a> &nbsp;/&nbsp; <span>Conversas</span>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="span6 offset1">
                                <div class="box box-warning direct-chat direct-chat-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title conversa_com">Conversa com</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-toggle="tooltip" data-widget="collapse" title="Minimizar"><i class="icon-minus" style="font-size: 10pt;"></i></button>
                                            <button class="btn btn-box-tool limpar" data-toggle="tooltip" title="Limpar conversa" data-widget="chat-pane-toggle"><i class="icon-undo" style="font-size: 10pt;"></i></button>
                                            <button class="btn btn-box-tool" data-toggle="tooltip" title="Fechar Janela" data-widget="remove"><i class="icon-remove" style="font-size: 10pt;"></i></button>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <!-- Conversations are loaded here -->
                                        <div class="chat direct-chat-messages">   
                                        </div><!--/.direct-chat-messages-->

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <form action="#" class="form-inline" method="post">
                                            <div class="input-group">
                                                <textarea class="span8 msg"  rows="1" id="txt_" placeholder="Pressione Enter para enviar"></textarea>
                                                <!-- <span class="btn btn-info"><i class="icon-paper-clip" style="font-size: 12pt;"></i>Anexar Arquivos</span> -->

                                                <div class="form-inline pull-right">
                                                    <div class="btn btn-info btn-file">
                                                        <i class="fa icon-paper-clip" style="font-size: 12pt; color: white;"></i> &nbsp;&nbsp;Anexar Arquivo
                                                        <input type="file" name="anexar-arquivo">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div><!-- /.box-footer-->
                                </div><!--/.direct-chat -->
                            </div>
                            <div class="span4 pull-right">
                                <div class="col-md-3">
                                    <div class="box box-warning box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Conversas</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-toggle="tooltip" title="Minimizar" data-widget="collapse"><i class="icon-minus" style="font-size: 10pt;"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <?php if ($conversa): ?>
                                            <div class="box-body conversas" style="height: 500px; overflow: auto;">
                                                <?php foreach ($conversa as $mensagem): ?>
                                                <div class="row-fluid con_<?php echo $mensagem->id_conversa; ?>">
                                                        <div class="col-md-3 col-sm-3 col-xs-8">
                                                            <div class="info-box">
                                                                <?php 
                                                                    $foto = "Juan";
                                                                    if (tipoUsuario($_SESSION['id_usuario']) == "Professor") {
                                                                        $foto = "../aluno/imagens/perfil/".$mensagem->foto_perfil;
                                                                    } else if (tipoUsuario($_SESSION['id_usuario']) == "Aluno") {
                                                                        $foto = "../professor/imagens/perfil/".$mensagem->foto_perfil;
                                                                    }
                                                                ?>
                                                                <img src="<?php echo $foto; ?>" style="height: 100px; width: 80px; margin-left: 2%;" class="pull-left img-rounded img-push" />
                                                                <div class="info-box-content">
                                                                    <button class="btn btn-box-tool pull-right" id="<?php echo $mensagem->id_conversa; ?>" name="excluir-conversa" data-toggle="tooltip" title="Excluir conversa"><i class="icon-remove" style="font-size: 10pt; color: #ccc;"></i></button>
                                                                    <span id="<?= "conversaCom_".$mensagem->id_conversa; ?>"><?= utf8_encode($mensagem->nome_usuario); ?></span><br />
                                                                    <span id="totMen_<?= $mensagem->id_conversa; ?>"><?= $mensagem->total; echo ($mensagem->total == 1) ? " Mensagem<br />" : " Mensagens";?> </span>
                                                                    <span data-toggle="tooltip" id="men_<?php echo $mensagem->id_conversa; ?>" class="badge bg-yellow"></span>
                                                                    <div class="row-fluid">
                                                                        <span class="btn btn-info btn-medium carregar-conversa span8 offset2" id="<?= $mensagem->id_conversa; ?>" style="margin-top: 10%;">Ver mensagens</span>
                                                                    </div>
                                                                </div><!-- /.info-box-content -->
                                                            </div><!-- /.info-box -->
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div><!-- /.box-body -->
                                        <?php 
                                            else: 
                                                echo "<h2 class='text-info'>Você ainda não tem nenhuma conversa</h2>";     
                                            endif; 
                                        ?>
                                    </div><!-- /.box -->
                                </div><!-- /.col -->
                            </div>
                        </div>
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
    <script src="../../../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>
    <script src="../js/chat-ajax.js" type="text/javascript"></script>
    <script src="../js/notificacoes.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/app.min.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/dashboard2.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/demo.js" type="text/javascript"></script>

    <script src="../../../resources/scripts/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
    <script src="../../../../scripts/camera/scripts/camera.min.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/easing/jquery.easing.1.3.js" type="text/javascript"></script>

</html>

<?php
    $id_conversa = (int) strip_tags(trim(filter_input(INPUT_GET, 'conversa', FILTER_SANITIZE_NUMBER_INT)));

    if ($id_conversa == $_SESSION['id_usuario']) {
        header("Location: ./conversas.php");
    } else {

        if (!empty($id_conversa)) {
            if ($_SESSION['tipo_usuario'] == "Professor") {
                $getNome = select("aluno", "nome_aluno AS nome_usuario", "WHERE id_aluno = '$id_conversa'");
            } else {
                $getNome = select("professor", "nome_professor AS nome_usuario", "WHERE id_professor = '$id_conversa'");
            }

            $nome = '';
            if ($getNome) {
                foreach ($getNome as $nome_usuario) {
                    $nome = $nome_usuario->nome_usuario;
                }
            }

            echo
                "<script type='text/javascript'>"
                . "$('h3.conversa_com').text('Conversa com {$nome}');"
                . "historicoConversa(" . $id_conversa . ", " . $_SESSION['id_usuario'] . ");"
                . "$.get('../chat/request.php?acao=up&id_conversa={$id_conversa}');"
                . "$('textarea.msg').removeAttr('id').attr('id', 'txt_{$id_conversa}').focus();"
                . "</script>";
        }

    }