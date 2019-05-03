<!DOCTYPE HTML>
<?php
session_start();
    
    $_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];

    date_default_timezone_set("America/Belem");

    require_once '../factory/conexao.php';
    require_once '../dao/selecionar.php';
    include_once '../util/limitadorDeCaracteres.php';
    require_once '../util/selecionarUsuario.php';
    require_once '../area-restrita/app/avaliacoes.php';
    
    $pdo = Conection::connect();
    $id_professor = utf8_decode(strip_tags(trim(filter_input(INPUT_GET, 'professor'))));
    
    if (!empty($id_professor)) {
        $getPosts = select("blog AS blog INNER JOIN professor p", "*", "WHERE blog.id_professor = p.id_professor AND blog.id_professor = '$id_professor' AND status = 1", "ORDER BY blog.id_blog DESC");
    } else {
        $getPosts = select("blog b INNER JOIN professor p", "*", "WHERE p.id_professor = b.id_professor AND status = 1", "ORDER BY blog.id_blog DESC");        
    }
    

?>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Blog</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Html5TemplatesDreamweaver.com">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!-- Remove this Robots Meta Tag, to allow indexing of site -->
        
        <link rel="shortcut icon" href="../../../icone.bmp" />
        
        <link href="../../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

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
        <span id="id_usr" style="display: none;"><?php echo (isset($_SESSION['id_usuario'])) ? $_SESSION['id_usuario'] : "0"; ?></span>
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
                                        <li class="active"><a href="blog-dos-professores.php">Blog</a></li>
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
                <section class="content">

                    <div class="divPanel notop page-content">
                        
                        <?php 
                            $getProfessor = select("professor", "genero, nome_professor", "WHERE id_professor = '$id_professor'"); 
                            $nome = ''; $genero = '';
                            
                            if ($getProfessor) {
                                foreach ($getProfessor as $professor) {
                                    $nome = $professor->nome_professor;
                                    $genero = $professor->genero;
                                }
                            }
                        ?>
                        
                        <div class="row-fluid">
                            <div class="breadcrumbs span12">
                                <a href="../../../">Home</a> &nbsp;/&nbsp; <span class="username">Blog <?php echo ($genero != '') ? ($genero == "Masculino") ? "do professor " : "da professora " : ""; echo $nome; ?></span>

                                <div class="pull-right span4">
                                    <form action="blog-dos-professores.php" method="get" class="form-search">
                                       <input type="search" name="q" id="procurar-professor" class="search-query span12" placeholder="Procure por um professor ou um artigo" />
                                   </form>
                               </div>
                            </div>
                        </div>

                        <h2 class="text-info">
                            Blog 
                            <?php 
                                echo ($genero != '') ? ($genero == "Masculino") ? "do professor " : "da professora " : "";  
                                echo "<a href='perfil-professor.php?professor=".$id_professor."#banner' id='usuario'>".$nome."</a>"; 
                            ?>
                        </h2>
                        
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="contentInnerSeparator"></div>
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            
                            <div class="pull-right span4" style="padding: 2%;">
                                <div class="span12" style="border: 1px solid rgba(0,0,0,.1); border-radius: 5px; padding: 15px; background-color: rgba(0,0,0,.03);">
                                    <div class="span7">
                                        <?php
                                            $getProfe = select("professor", "foto_perfil, nome_professor, genero", "WHERE id_professor = '$id_professor'"); 
                                            foreach ($getProfe as $profe) {
                                                $foto = $profe->foto_perfil;
                                                $nome = $profe->nome_professor;
                                                $genero = $profe->genero;
                                            }
                                        ?>
                                        <div class="offset4 span12" style="border-radius: 2px;" >
                                            
                                            <img src="../area-restrita/professor/imagens/perfil/<?php echo $foto; ?>" alt="" style="margin-bottom: 8px; width: 180px; height: 170px;"/>
                                            <?php if (mediaTotal($id_professor)): ?>
                                                <?php foreach (mediaTotal($id_professor) as $total) {
                                                    $mediaTotal = $total->total;
                                                } ?>
                                                <?php if ($mediaTotal != null): ?>
                                                    <center>
                                                        <?php for ($i = 0; $i < $mediaTotal; $i++) { echo "<i style='font-size: 15pt;' class='icon-star text-info'></i>"; } ?>
                                                        <span style="font-size: 15pt;">(<?php echo $mediaTotal; ?>)</span>
                                                    </center>
                                                <?php else: ?>
                                                    <center>
                                                        <i class="icon-star text-info" style="font-size: 15pt;"></i>
                                                        <span style="font-size: 15pt;">(0)</span>
                                                    </center>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <center>
                                                    <i class="icon-star text-info" style="font-size: 15pt;"></i>
                                                    <span style="font-size: 15pt;">(0)</span>
                                                </center>
                                            <?php endif; ?>
                                            <center><?php echo $nome; ?></center><br />
                                        </div>
                                    </div>
                                    <center><span class="span12"><?php echo explode(" ", $nome)[0]; ?> é <?php echo ($genero == "Masculino") ? "professor cadastrado " : "professora cadastrada "; ?> no <strong>GetTeacher.</strong></span></center>
                                    <center><a href="perfil-professor.php?professor=<?php echo $id_professor; ?>#banner" class="btn btn-medium btn-info" style="margin-top: 15px;">Ver perfil completo de <?php echo explode(" ", $nome)[0]; ?></a></center>
                                </div>
                                
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div id="contentInnerSeparator"></div>
                                    </div>
                                </div>
                                
                                <div class="row-fluid">
                                    <div class="span12"  style="border: 1px solid rgba(0,0,0,.1); border-radius: 5px; padding: 15px; background-color: rgba(0,0,0,.03);" >
                                        <h4 class="text-info"><i class="icon-pencil"></i> Aulas oferecidas</h4>
                                        <?php 
                                            $getCategoria = select("professor", "categoria", "WHERE id_professor = '$id_professor'"); 
                                            foreach ($getCategoria as $categoria) {
                                                $cat = $categoria->categoria;
                                            }
                                        ?>
                                        <p class="text-muted"><i class="icon-book"></i> <?php echo utf8_encode($cat); ?></p>
                                    </div>
                                </div>
                                
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div id="contentInnerSeparator"></div>
                                    </div>
                                </div>
                                
                                <h6 style="color: #666;">VOCÊ BUSCA ARTIGO DE QUE MATÉRIA?</h6>
                                <div class="materia">
                                    <select class="span12" id="buscar-categoria">
                                        <option>Escolha a matéria</option>
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
                            </div>
                        
                            <?php if ($getPosts): ?>                          
                                <?php foreach ($getPosts as $post): ?>
                                    <div class="row-fluid">
                                        <div class="span8">
                                            <div class="box box-widget">
                                                <div class='box-header with-border' style="text-align: left;">
                                                    <div class='user-block'>
                                                        <div class="row-fluid">
                                                            <div class="span2">
                                                                <img class='usr' src='../area-restrita/professor/imagens/perfil/<?php echo $post->foto_perfil; ?>' alt='user image'>
                                                            </div>
                                                            <div class="span10" style="margin-left: -10%;">
                                                                <span class='username'><a class="text-light-blue" href="perfil-professor.php?professor=<?php echo $post->id_professor; ?>#banner"><?php echo utf8_encode($post->nome_professor); ?></a></span>
                                                                <span class='description'>Publicado em <?php echo "<a href='blog-dos-professores.php?categoria=".utf8_encode($post->categoria)."'>".utf8_encode($post->categoria)."</a> em "; echo date("d/m/Y H:i", strtotime($post->data)); ?></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.user-block -->
                                                </div><!-- /.box-header -->
                                                <div style="text-align: left;" class='box-body'>
                                                    
                                                    <a href="artigo-professor.php?id_post=<?php echo $post->id_blog; ?>&amp;id_professor=<?php echo $id_professor; ?>"><img class="img-responsive" style="width: 800px; height: 300px;" src="../area-restrita/portifolio/<?php echo $post->imagem; ?>" alt="Photo"></a>
                                                    <h4><a href="artigo-professor.php?id_post=<?php echo $post->id_blog; ?>&amp;id_professor=<?php echo $id_professor; ?>" class="titulo"><strong><?php echo $post->titulo; ?></strong></a></h4>
                                                    <p style="text-align: justify;">
                                                        <?php 
                                                            echo utf8_encode(limitarCaracteres($post->texto, 200))."<a href='artigo-professor.php?id_post=$post->id_blog&amp;id_professor=$id_professor' id='usuario'>...Leia mais</a>"; 
                                                        ?>
                                                    </p>
                                                    <span href="" class='btn btn-mini btn-info'> Compartilhar</span>
                                                    
                                                    <?php $curtiu = select("like_blog", "*", "WHERE id_post = $post->id_blog AND id_usuario = ". (isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : "-1")); ?>
                                                    
                                                    <span class='btn btn-mini btn-info curtir' id="curtir_<?php echo $post->id_blog; ?>"> <?php echo ($curtiu ? "Curtiu" : "Curtir"); ?> </span>
                                                    
                                                    <?php 
                                                        $total_comentario = $pdo->query("SELECT * FROM comentario_blog WHERE id_blog = $post->id_blog"); 
                                                        $total_likes = $pdo->query("SELECT * FROM like_blog WHERE id_post = $post->id_blog");
                                                    ?>
                                                    
                                                    <span class='pull-right text-muted'>
                                                        <span class="likes_<?php echo $post->id_blog; ?>"><?php echo $total_likes->rowCount(); ?></span> <?php echo ($total_likes->rowCount() > 1) ? "likes" : "like"; ?> - 
                                                        <span class="coment_<?php echo $post->id_blog; ?>"><?php echo $total_comentario->rowCount(); ?></span> <?php echo ($total_comentario->rowCount() > 1) ? "comentários" : "comentário"; ?>
                                                    </span>
                                                    
                                                </div><!-- /.box-body -->

                                                <div class="comentarios_<?php echo $post->id_blog; ?>">
                                                    <?php include_once '../util/comentario-blog.php'; ?>
                                                </div>
                                                            
                                                <div class="box-footer">
                                                    <div class="row-fluid">
                                                        <form action="#" method="post">
                                                            <div class='row-fluid comment'>
                                                                <?php if (isset($_SESSION['usuario'])): ?>
                                                                    <?php 
                                                                        if ($_SESSION['tipo_usuario'] == "Professor") {
                                                                            $src = "../area-restrita/professor/";
                                                                            $getUsuario = select("professor", "*", "WHERE id_professor = '".$_SESSION['id_usuario']."'");
                                                                        } else if ($_SESSION['tipo_usuario'] == "Aluno") {
                                                                            $src = "../area-restrita/aluno/";
                                                                            $getUsuario = select("aluno", "*", "WHERE id_aluno = ".$_SESSION['id_usuario']);
                                                                        } else {
                                                                            $src = "../area-restrita/aluno/";
                                                                            $getUsuario = select("usuarios", "*", "WHERE id_usuario = ".$_SESSION['id_usuario']);
                                                                        }
                                                                    ?>
                                                                    <?php foreach ($getUsuario as $usuario): ?>
                                                                        <div class='span2' style="margin-top: 1%; margin-left: -2.7%;">
                                                                            <img class="usr2" src="<?php echo $src."imagens/perfil/"; echo ($_SESSION['tipo_usuario'] != "Admin") ? $usuario->foto_perfil : "default.jpg"; ?>" alt="alt text">
                                                                        </div>
                                                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                                                        <div class="span10" style="margin-left: -2%; margin-top: 2.3%;">
                                                                            <textarea type="text" class="span12 msg" id="id_<?php echo $post->id_blog; ?>" rows="1" placeholder="Pressione 'Enter' para enviar"></textarea>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <div class='span2' style="margin-top: 1%; margin-left: -2.7%;">
                                                                        <img class="usr2" src="../area-restrita/aluno/imagens/perfil/default.jpg" alt="alt text">
                                                                    </div>
                                                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                                                    <div class="span10" style="margin-left: -2%; margin-top: 2.3%;">
                                                                        <input type="text" class="span12" readonly placeholder="Você precisa estar logado para comentar">
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.box-footer -->
                                            </div><!-- /.box -->
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h1 class="text-error">Não existem resultados para sua pesquisa</h1>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </section>
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
                                    <li><a href="forum.php">Tira Dúvidas</a></li>
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

    </body>
</html>