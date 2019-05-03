<?php
session_start();

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';
require_once '../app/avaliacoes.php';
require_once '../../util/limitadorDeCaracteres.php';

$pdo = Conection::connect();

if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {
    $user = $_SESSION['usuario'];
    $id = $_SESSION['id_usuario'];

    $pegaProfessor = select("professor", "*", "WHERE `id_professor` = $id");
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
    <?php foreach ($pegaProfessor as $professor): ?>
        <body id="pageBody">
            <input type="hidden" id="id_usuario" value="<?php echo $id; ?>" />
            <div class="container" id="divBoxed">
                <div class="transparent-bg" style="position: absolute;top: -2%;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>
                <!-- Menu de Navegação -->
                <div class="divPanel notop nobottom">
                    <div class="navbar navbar-inverse navbar-fixed-top">
                        <div class="navbar-inner">
                            <div class="container-fluid" style="margin-left: 8%;">
                                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><b class="caret"></b></a>
                                <a href="index.php" class="brand">GETTEACHER</a>
                                <div class="nav-collapse collapse">
                                    <ul class="nav">
                                        <li class=""><a href="../professor/">Home</a></li>
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
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo utf8_encode($professor->nome_professor); ?><b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li class="span3 user alert-info">
                                                    <div class="row-fluid">
                                                        <div class="span10" style="margin: 15px;">
                                                            <img src="../professor/imagens/perfil/<?php echo $professor->foto_perfil; ?>" class="foto-perfil img-bordered-sm"/>
                                                        </div>
                                                        <div class="span12">
                                                            <a href="perfil.php" class="btn btn-success btn-small span5 p">Perfil Completo</a>
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

                <!-- Inicio Conteúdo Principal -->
                <div class="contentArea">
                    <div class="divPanel notop nobottom">
                        <div class="row-fluid">
                            <div class="span12" id="divMain">
                                <div style="margin-top: -5%;">
                                    <span id="banner"></span>
                                    <img src="../../../../images/500px-33918005.jpg" />
                                    <div class="span7">
                                        <figcaption style="position: relative; margin-top: -20%;" class="span3">
                                            <img src="imagens/perfil/<?php echo $professor->foto_perfil; ?>" class="img-polaroid" alt="" style="height: 160px; width: 140px;" />
                                        </figcaption>

                                        <h3 class="span8" style="position: relative; margin-top: -10%; color: #fff;" >
                                            <?php
                                            echo ($professor->genero == "Masculino") ? "Professor " : "Professora ";
                                            echo utf8_encode($professor->nome_professor);
                                            ?>
                                        </h3>
                                        <span class="span4" style="margin-top: 2%;">
                                            <?php foreach (mediaTotal($id) as $avaliacao): ?>
                                                <?php if ($avaliacao->total == 0): ?>
                                                    <i class="icon-star text-info"></i>
                                                <?php else: ?>
                                                    <?php for ($i = 0; $i < $avaliacao->total; $i++) { echo '<i class="icon-star text-info"></i>'; } ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            / <strong><?php echo utf8_encode($professor->cidade . '-' . $professor->estado); ?></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div id="contentInnerSeparator"></div>
                                    </div>
                                </div>
                                <div class="row-fluid span12">
                                    <div class="pull-right span4" style="margin-right: 2.5%;">
                                        <div class="img-polaroid" id="hora-aula">
                                            <span id="preco">
                                                <h4>
                                                    Preço médio:&nbsp;&nbsp;&nbsp;
                                                    <span style="font-size: 25px; color: #0044cc;">
                                                        R$<?php echo $professor->hora_aula; ?>
                                                    </span>
                                                    /Hora aula
                                                </h4>
                                            </span>
                                            <div class="row-fluid">
                                                <div class="span7">
                                                    <div id="contentInnerSeparator"></div>
                                                </div>
                                            </div>
                                            <span class="span12 text-info"><i class="icon-edit"></i> Aula <?php echo $professor->tipo_aula; ?> no GetTeacher</span>
                                            <hr />
                                        </div>
                                        <div class="span12 pull-right sidebox">
                                            
                                            <h4 class="usuario text-info">Meus Artigos</h4>
                                            <hr />
                                            <?php $getPosts = select("blog", "*", "WHERE id_professor = $professor->id_professor", "ORDER BY id_blog DESC", "LIMIT 2"); ?>
                                            <?php if ($getPosts): ?>
                                                <?php foreach ($getPosts as $post): ?>
                                                    <?php $getComents = select("comentario_blog", "COUNT(comentario) AS total", "WHERE id_blog = $post->id_blog"); ?>
                                                    <a href="<?php echo ($post->status == 1) ? '../../../php-resources/domain/artigo-professor.php?id_post='.$post->id_blog.'&amp;id_professor='.$post->id_professor : ''; ?>" class="titulo"><h5><?php echo utf8_encode($post->titulo); ?></h5></a>
                                                    <div class="row-fluid">
                                                        <a href="<?php echo ($post->status == 1) ? '../../../php-resources/domain/artigo-professor.php?id_post='.$post->id_blog.'&amp;id_professor='.$post->id_professor : ''; ?>"><img class="span12" src="../portifolio/<?php echo $post->imagem; ?>" /></a>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <p class="span12" style="text-align: justify;">
                                                            <?php echo utf8_encode(limitarCaracteres($post->texto, 90)); echo ($post->status == 1) ? "...<a href='../../../php-resources/domain/artigo-professor.php?id_post=<?php echo $post->id_blog; ?>&amp;id_professor=<?php echo $post->id_professor; ?>' class='titulo'>Ler mais</a>" : "<h5 class='text-info'>O seu artigo ainda não foi aprovado pelos administradores</h5>"; 
                                                        ?>
                                                        </p>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <span class="text-muted pull-right">
                                                            <?php $total_likes = $pdo->query("SELECT * FROM like_blog WHERE id_post = $post->id_blog"); ?>
                                                            <?php echo $total_likes->rowCount(); ?>&nbsp;Likes&nbsp;
                                                            <?php 
                                                            foreach ($getComents as $total) {
                                                              echo $total->total;  
                                                            }
                                                            ?>&nbsp;Comentários
                                                        </span>    
                                                    </div>
                                                    <hr />
                                                <?php endforeach; ?>
                                                <?php 
                                                    $getPosts = select("blog", "COUNT(id_blog) AS total", "WHERE id_professor = $id"); 
                                                    foreach ($getPosts as $total) {
                                                        $tot_comentarios = $total->total;
                                                    }
                                                ?>
                                                    <a href="../../domain/artigos-do-professor.php?professor=<?php echo $id; ?>" class="btn btn-info">Ver todos (<?php echo $tot_comentarios; ?>)</a>
                                            <?php else: ?>
                                                <h4 class="text-error">Você ainda não tem nenhum artigo</h4>  
                                                <a href="../blogs/criar-blog.php" class="btn btn-info">Publique o seu primeiro</a>
                                            <?php endif; ?>
                                                
                                        </div>
                                    </div>

                                    <div class="span7">
                                        <div class="span3">
                                            <h4 style="text-align: right;">AULAS OFERECIDAS</h4>
                                        </div>
                                        <div class="span7 offset1">
                                            <div class="span4">
                                                <p><i class="icon-check"></i>&nbsp;&nbsp;&nbsp;<?php echo utf8_encode($professor->area); ?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                            </div>
                                            <div class="span6">
                                                <p><?php echo utf8_encode($professor->categoria . "/" . $professor->especialidade); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span7">
                                        <div class="span3">
                                            <h4 style="text-align: right;">SOBRE</h4>
                                        </div>
                                        <div class="span8 offset1">
                                            <pre style="border: none; font-family: sans-serif; background-color: white;"><?php echo utf8_encode($professor->sobre); ?></pre>
                                        </div>
                                    </div>
                                    <div class="span7">
                                        <?php $getFormacao = select("formacao f INNER JOIN professor p", "*", "WHERE p.id_professor = f.id_professor AND f.id_professor = $id"); ?>

                                            <?php foreach ($getFormacao as $formacao): ?>

                                                <div class="span3">
                                                    <h4 style="text-align: right;">FORMAÇÃO</h4>
                                                </div>

                                                <?php if ($formacao->curso != ""): ?>

                                                    <div class="span8 offset1">
                                                        <div class="span4">
                                                            <?php echo utf8_encode($formacao->nivel); ?>
                                                        </div>
                                                        <div class="span8">
                                                            <?php echo utf8_encode($formacao->curso); ?> <br />
                                                            <?php echo utf8_encode($formacao->instituicao); ?> <br />
                                                            (<?php echo $formacao->ano_inicio."-".$formacao->ano_termino; ?>)
                                                        </div>
                                                    </div>

                                                <?php else: ?>
                                                    <div class="span8 offset1">
                                                        <p>Você ainda não informou sua formação.</p>
                                                    </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        
                                    </div>
                                    
                                    <div class="span7">
                                        <div id="contentInnerSeparator"></div>
                                    </div>
                                    
                                    <div class="span7 sidebox">
                                        <?php if (avaliacoes($_SESSION['id_usuario'])): ?>
                                            <?php foreach (media($_SESSION['id_usuario']) as $avaliacao): ?>
                                                <h6><strong>AVALIAÇÕES</strong>(<?php echo $avaliacao->total; ?>)</h6>
                                                <div>
                                                    <span class="span3">
                                                        Didática <?php for ($i = 0; $i < $avaliacao->didatica; $i++) {echo "<i class='icon-star text-info'></i>";} ?> 
                                                    </span>
                                                    <span class="span4">
                                                        Conhecimento <?php for ($i = 0; $i < $avaliacao->conhecimento; $i++) {echo "<i class='icon-star text-info'></i>";} ?>
                                                    </span>
                                                    <span class="span4"> 
                                                        Simpatia <?php for ($i = 0; $i < $avaliacao->simpatia; $i++) {echo "<i class='icon-star text-info'></i>";} ?>
                                                    </span>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="row-fluid">
                                                <div class="span7">
                                                    <div id="contentInnerSeparator"></div>
                                                </div>
                                            </div>
                                            <div class="span10">
                                                <?php foreach (avaliacoes($_SESSION['id_usuario']) as $avaliacao): ?>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <img src="../aluno/imagens/perfil/<?php echo $avaliacao->foto_perfil; ?>" class="img-rounded img-aval" />
                                                        </div>
                                                        <div class="span10">
                                                            <span><a href="" class="text-info"><?php echo $avaliacao->nome_aluno; ?></a>&nbsp;&nbsp;avaliou&nbsp;&nbsp;<a href="" class="text-info"><?php echo $avaliacao->nome_professor; ?></a>&nbsp;&nbsp;em&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($avaliacao->data)); ?></span>
                                                        </div>
                                                        <div class="span10">
                                                            <span class="span3" style="font-size: 8pt;">
                                                                Didática <?php for ($i = 0; $i < $avaliacao->didatica; $i++) {echo "<i class='icon-star text-info'></i>";} ?> 
                                                            </span>
                                                            <span class="span4" style="font-size: 8pt;">
                                                                Conhecimento <?php for ($i = 0; $i < $avaliacao->conhecimento; $i++) {echo "<i class='icon-star text-info'></i>";} ?>
                                                            </span>
                                                            <span class="span4" style="font-size: 8pt;"> 
                                                                Simpatia <?php for ($i = 0; $i < $avaliacao->simpatia; $i++) {echo "<i class='icon-star text-info'></i>";} ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span7">
                                                            <div id="contentInnerSeparator"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span10">
                                                            <p style="text-indent: 15px;"><?php echo utf8_encode($avaliacao->comentario); ?></p>
                                                            <hr />
                                                        </div>                                                
                                                    </div>
                                                <?php endforeach; ?>
                                                <?php if (totalAvaliacoes($id) > 3): ?>
                                                    <a href="" class="btn btn-info">Ver todas as avaliacoes (+<?php echo totalAvaliacoes($id)-3; ?>)</a>
                                                <?php endif; ?>
                                            </div> 
                                        <?php else: ?>
                                            <h6><strong>AVALIAÇÕES</strong> (0)</h6>
                                            <h1 class="text-error">Você ainda não foi avaliado(a)</h1>
                                        <?php endif; ?>   
                                    </div>
                                    
                                </div>
                            </div>
                            <!--/End Main Content Area here-->

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
                                    <li><a href="../../domain/forum.php">Central de Ajuda</a></li>
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
    <?php endforeach; ?>

    <script src="../../../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script> 
    <script src="../../../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/default.js" type="text/javascript"></script>
    <script src="../../../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>
    <script src="../js/notificacoes.js" type="text/javascript"></script>
    <script src="../js/chat-ajax.js" type="text/javascript"></script>

</html>
