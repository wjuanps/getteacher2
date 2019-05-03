<?php
session_start();

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';
require_once '../app/avaliacoes.php';
include_once '../../util/limitadorDeCaracteres.php';

$id = '';
if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {
    $user = $_SESSION['usuario'];
    $id   = $_SESSION['id_usuario'];
    
    $pegaProfessor = select("professor", "*", "WHERE `id_professor` = '$id'");
    $conversa      = select(
                        "mensagens m, aluno a", 
                        "DISTINCT m.id_aluno, a.nome_aluno, COUNT(m.id_aluno) AS total_mensagens", 
                        "WHERE m.id_aluno = a.id_aluno AND m.id_professor = $id GROUP BY m.id_aluno"
                    );
    
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
                            <a href="" class="brand">GETTEACHER</a>
                            <div class="nav-collapse collapse">
                                <ul class="nav">
                                    <li class="active"><a href="">Home</a></li>
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
                                    <?php foreach ($pegaProfessor as $professor): ?>
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
                                    <?php endforeach; ?>
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
                        <div class="span12">
                            <div style="margin-top: -5%;">

                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div id="contentInnerSeparator"></div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div id="contentInnerSeparator"></div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div id="contentInnerSeparator"></div>
                                </div>
                            </div>
                            <div id="myCarousel" class="carousel slide span12" style="margin-left: .5%;">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="span2">
                                            <h2 class="offset5">Blog</h2>
                                            <h1><i class="icon-laptop offset6"></i></h1>
                                        </div>
                                        
                                        <div class="span7">
                                            <h5 class="text-info">Últimas Postagens</h5>
                                            
                                            <?php $getPost = select("blog", "*", "WHERE status = 1", "ORDER BY RAND()", "LIMIT 1"); ?>
                                            
                                            <?php 
                                                if ($getPost):
                                                    foreach ($getPost as $post): 
                                                        ?>
                                                        <div class="row-fluid">
                                                            <a href="../../../php-resources/domain/artigo-professor.php?id_post=<?php echo $post->id_blog; ?>&amp;id_professor=<?php echo $post->id_professor; ?>"><img src="../portifolio/<?php echo $post->imagem; ?>" class="span4" style="margin-right: 1.5%;" /></a>
                                                            <p><a href="../../../php-resources/domain/artigo-professor.php?id_post=<?php echo $post->id_blog; ?>&amp;id_professor=<?php echo $post->id_professor; ?>"><?php echo utf8_encode($post->titulo); ?></a></p>
                                                            <p style="text-align: justify;">
                                                                <?php echo utf8_encode(limitarCaracteres($post->texto, 350))."...<a href='../../../php-resources/domain/artigo-professor.php?id_post=$post->id_blog&amp;id_professor=$post->id_professor'>Ler mais</a>"; ?>
                                                            </p>
                                                        </div>
                                                        <?php 
                                                    endforeach;
                                                else:
                                                    echo '<h3 class="text-gray">Ops! Não foi possível carregar os artigos.</h3>';
                                                endif;
                                            ?>
                                            
                                        </div>
                                        
                                        <div class="span3">
                                            <h4>Crie o seu</h4>
                                            <div class="offset2">
                                                <a href="../blogs/criar-blog.php" class="btn btn-success">Postar conteúdo</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        
                                    </div>

                                    <div class="item">
                                        
                                    </div>
                                </div>

                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div id="contentInnerSeparator"></div>
                                </div>
                            </div>
                            <div class="row-fluid span12">
                                <div class="pull-right span4" style="margin-right: 2.5%;">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div id="contentInnerSeparator"></div>
                                        </div>
                                    </div>
                                    <div class="span12 pull-right sidebox">
                                        <legend><h3 class="usuario text-info">Meus Artigos</h3></legend>
                                        
                                        <?php $getPosts = select("blog", "*", "WHERE id_professor = $id", "ORDER BY id_blog DESC", "LIMIT 2"); ?>
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
                                                    
                                                    <?php 
                                                        $total_comentario = Conection::connect()->query("SELECT * FROM comentario_blog WHERE id_blog = $post->id_blog"); 
                                                        $total_likes = Conection::connect()->query("SELECT * FROM like_blog WHERE id_post = $post->id_blog");
                                                    ?>
                                                    
                                                    <span class='pull-right text-muted'>
                                                        <span class="likes_<?php echo $post->id_blog; ?>"><?php echo $total_likes->rowCount(); ?></span> <?php echo ($total_likes->rowCount() > 1) ? "likes" : "like"; ?> - 
                                                        <span class="coment_<?php echo $post->id_blog; ?>"><?php echo $total_comentario->rowCount(); ?></span> <?php echo ($total_comentario->rowCount() > 1) ? "comentários" : "comentário"; ?>
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
                                                <a href="../../domain/artigos-do-professor.php?professor=<?php echo $_SESSION['id_usuario']; ?>" class="btn btn-info">Ver todos (<?php echo $tot_comentarios; ?>)</a>
                                        <?php else: ?>
                                            <h4 class="text-error">Você ainda não tem nenhum artigo</h4>  
                                            <a href="../blogs/criar-blog.php" class="btn btn-info">Publique o seu primeiro</a>
                                        <?php endif; ?>
                                        
                                    </div>
                                    
                                </div>

                                <div class="span7">
                                    <div id="contentInnerSeparator"></div>
                                </div>
                                
                                <?php if (isset($_GET['mensagem'])): ?>
                                    <span class="alert alert-info span7" style="margin-bottom: -2%;">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <h4><strong><?php echo $_GET['mensagem']; ?></strong></h4>
                                    </span>
                                <?php endif; ?>
                                
                                <div class="sidebox span7" >  
                                    
                                    <!--Edit Tabs here-->
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#aulas" data-toggle="tab"><i class="icon-pencil"></i> Próximas Aulas</a></li>
                                        <li id="li"><a href="#mensagens" data-toggle="tab"><i class="icon-comments"></i> Conversas</a><span class="alert-error tot-men men-tot"></span></li>
                                        <li><a href="#encontrar" data-toggle="tab"><i class="icon-pushpin"></i> Encontre Alunos</a></li>
                                        <li><a href="#solicitacoes" data-toggle="tab"><i class="icon-globe"></i> Notificações</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="aulas">
                                            <a href="#" class="pull-right span2 text-info"><i class="icon-calendar">&nbsp;&nbsp;Calendário</i></a>
                                            <a href="../app/aulas.php" class="pull-right span2 text-info"><i class="icon-pencil">&nbsp;&nbsp;Aulas</i></a>
                                            <p>Você ainda não tem nenhuma aula marcada!</p>
                                        </div>

                                        <div class="tab-pane fade" id="mensagens">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <?php if ($conversa): ?>
                                                        <?php foreach ($conversa as $mensagem): ?>
                                                            <div class="accordion" id="accordion1">
                                                                <div class="accordion-group">
                                                                    <div class="accordion-heading">
                                                                        <span class="alert-error notificao no" id="men_<?php echo $mensagem->id_aluno; ?>"></span>
                                                                        <a class="accordion-toggle collapsed not-mensagens" data-toggle="collapse" data-parent="" id="<?php echo $mensagem->id_aluno; ?>" href="#janela_<?php echo $mensagem->id_aluno; ?>">
                                                                            <?php echo utf8_encode($mensagem->nome_aluno); ?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="accordion-body collapse" style="height: 0px;" id="janela_<?php echo $mensagem->id_aluno; ?>">
                                                                        <div class="accordion-inner span12">
                                                                            <div class="men"></div>
                                                                            <h4 class="text-info">Total de <?php echo $mensagem->total_mensagens; ?> mensagens.</h4>
                                                                            <a href="../chat/conversas.php?conversa=<?php echo $mensagem->id_aluno; ?>"><span class="btn btn-info btn-small"><i class="icon-comment-alt"></i>&nbsp;&nbsp;&nbsp;Visualizar Todas</span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <h3 class="text-info">Você ainda não tem nenhuma mensagem.</h3>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="encontrar">
                                            
                                        </div>
                                        <div class="tab-pane fade" id="solicitacoes">
                                            <div class="row-fluid">
                                                
                                                <div class="span12">
                                                    <div class="accordion" id="accordion1">
                                                        <div class="accordion-group">
                                                            <div class="accordion-heading">
                                                                <span class="alert-error notificao no" id="agendamento"></span>
                                                                <a class="accordion-toggle collapsed not-mensagens agendamentos text-info" data-toggle="collapse" data-parent="" id="" href="#agendamentos">
                                                                    Agendamentos
                                                                </a>
                                                            </div>
                                                            <div class="accordion-body collapse" style="height: 0px;" id="agendamentos">
                                                                <div class="accordion-inner span12" style="background-color: rgba(0,0,0,.1);">
                                                                    <div class="agendamentos"></div>
                                                                    <a href="" class="btn btn-medium btn-info"><i class="icon-tags"></i> Ver todos</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="accordion" id="accordion3">
                                                        <div class="accordion-group">
                                                            <div class="accordion-heading">
                                                                <!-- <span class="alert-error notificao no" id="men_<?php //echo $mensagem->id_aluno; ?>"></span> -->
                                                                <a class="accordion-toggle collapsed not-mensagens blog text-info" data-toggle="collapse" data-parent="" id="" href="#blog">
                                                                    Blog
                                                                </a>
                                                            </div>
                                                            <div class="accordion-body collapse" style="height: 0px;" id="blog">
                                                                <div class="accordion-inner span12" style="background-color: rgba(0,0,0,.1);">
                                                                    <hr style='margin-top: -2%;' />
                                                                    <div class="blog"></div>
                                                                    <a href="" class="btn btn-medium btn-info"><i class="icon-laptop"></i> Ver todos</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="accordion" id="accordion4">
                                                        <div class="accordion-group">
                                                            <div class="accordion-heading">
                                                                <!-- <span class="alert-error notificao no" id="men_<?php //echo $mensagem->id_aluno; ?>"></span> -->
                                                                <a class="accordion-toggle collapsed not-mensagens cancelamentos text-info" data-toggle="collapse" data-parent="" id="" href="#cancelamentos">
                                                                    Cancelamentos
                                                                </a>
                                                            </div>
                                                            <div class="accordion-body collapse" style="height: 0px;" id="cancelamentos">
                                                                <div class="accordion-inner span12" style="background-color: rgba(0,0,0,.1);">
                                                                    <div class="cancelamentos"></div>
                                                                    <a href="" class="btn btn-medium btn-info"><i class="icon-remove-circle"></i> Ver todos</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Tabs here-->
                                    
                                </div>
                                
                                <div class="span7 sidebox">
                                    <div id="aval"></div>
                                    <?php if (avaliacoes($_SESSION['id_usuario'])): ?>
                                        <?php foreach (media($_SESSION['id_usuario']) as $avaliacao): ?>
                                            <h6><strong>AVALIAÇÕES</strong> (<?php echo $avaliacao->total; ?>)</h6>
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
                                                        <span><a href="" class="text-info"><?php echo utf8_encode($avaliacao->nome_aluno); ?></a>&nbsp;&nbsp;avaliou&nbsp;&nbsp;<a href="perfil.php" class="text-info"><?php echo utf8_encode($avaliacao->nome_professor); ?></a>&nbsp;&nbsp;em&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($avaliacao->data)); ?></span>
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
                                                        <p style="text-indent: 15px; text-align: justify;"><?php echo utf8_encode($avaliacao->comentario); ?></p>
                                                        <hr />
                                                    </div>                                                
                                                </div>
                                            <?php endforeach; ?>
                                        </div> 
                                    <?php else: ?>
                                        <h6><strong>AVALIAÇÕES</strong> (0)</h6>
                                        <h1 class="text-error">Você ainda não foi avaliado(a)</h1>
                                    <?php endif; ?>
                                </div>
                                <div class="row-fluid">
                                    <div class="span7">
                                        <div id="contentInnerSeparator"></div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span7">
                                        <div id="contentInnerSeparator"></div>
                                    </div>
                                </div>
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

