<!DOCTYPE HTML>
<?php
session_start();

$_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];

date_default_timezone_set("America/Belem");

require_once '../factory/conexao.php';
require_once '../dao/selecionar.php';
require_once '../area-restrita/app/avaliacoes.php';
require_once '../util/tipoUsuario.php';
require_once '../util/selecionarUsuario.php';
require_once '../util/limitadorDeCaracteres.php';

$id = strip_tags(trim(filter_input(INPUT_GET, 'professor')));

if (!empty($id)) {
    $pegaProfessor = select("professor", "*", "WHERE `id_professor` = '$id'");

    if ($pegaProfessor) {
        foreach ($pegaProfessor as $professor):
            ?> 
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>GetTeacher - <?php echo utf8_encode($professor->nome_professor); ?></title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="description" content="">
                    <meta name="author" content="Html5TemplatesDreamweaver.com">
                    
                    <link rel="shortcut icon" href="../../../icone.bmp" />
                    
                    <link href="../../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                    <link href="../../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
                    <link href="../../resources/css/datepicker3.css" rel="stylesheet" type="text/css" />

                    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
                    <!--[if lt IE 9]>
                      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                    <![endif]-->

                    <!-- Icons -->
                    <link href="../../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
                    <link href="../../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
                    <!--[if lt IE 8]>
                        <link href="scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
                        <link href="scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
                    <![endif]-->
                    <link rel="stylesheet" href="../../resources/scripts/fontawesome/css/font-awesome.min.css">
                    <!--[if IE 7]>
                        <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome-ie7.min.css">
                    <![endif]-->

                    <link href="../../../styles/custom.css" rel="stylesheet" type="text/css" />
                    <link href="../../resources/css/styles-custom.css" rel="stylesheet" type="text/css" />
                </head>
                <body id="pageBody">

                    <div id="divBoxed" class="container">

                        <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

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
                                                        <a href="" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="../domain/listar-professores.php?area=Idiomas">Idiomas</a></li>
                                                            <li> <a href="../domain/listar-professores.php?area=Exatas">Exatas</a></li>
                                                            <li><a href="../domain/listar-professores.php?area=Humanas">Humanas</a></li>
                                                            <li><a href="../domain/listar-professores.php?area=Artes">Artes</a></li>
                                                            <li><a href="../domain/listar-professores.php?area=Música">Música</a></li>
                                                            <li><a href="../domain/listar-professores.php?area=Linguagens">Linguagens</a></li>
                                                            <li><a href="../domain/listar-professores.php?area=Biológicas">Biológicas</a></li>
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

                        </div>
                        <div class="contentArea">
                            <div class="divPanel notop page-content">
                                <div class="row-fluid">
                                    <!--Edit Main Content Area here-->
                                    <div class="span12" id="divMain">
                                        <figure class="span12">
                                            
                                            <span id="banner"></span>
                                            <img src="../../../images/500px-33918005.jpg" style="margin:5px 0px 15px;" alt="Background" />
                                            <div class="span7">
                                                <figcaption style="position: relative; margin-top: -23%;" class="span3">
                                                    <img src="../area-restrita/professor/imagens/perfil/<?php echo $professor->foto_perfil; ?>" class="img-polaroid" alt="Foto professor" style="height: 160px; width: 140px;" />
                                                </figcaption>

                                                <h3 class="pull-right span9" style="position: relative; margin-top: -12%; color: #fff;" >
                                                    <?php
                                                        echo ($professor->genero == "Masculino") ? "Professor " : "Professora ";
                                                        echo utf8_encode($professor->nome_professor);
                                                    ?>
                                                </h3>
                                                
                                                <span class="span5" style="margin-top: -1%;">
                                                    
                                                    <?php foreach (mediaTotal($id) as $avaliacao): ?>
                                                        <?php if ($avaliacao->total == 0): ?>
                                                            <i class="icon-star text-info"></i>
                                                        <?php else: ?>
                                                            <?php
                                                                for ($i = 0; $i < $avaliacao->total; $i++) {
                                                                    echo '<i class="icon-star text-info"></i>';
                                                                }
                                                            ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?> / 
                                                    <strong><?php echo utf8_encode($professor->cidade) . "-" . $professor->estado; ?></strong>
                                                    
                                                </span>
                                            </div>

                                        </figure>
                                        
                                        <div class="pull-right span4" style="position: relative; margin-top: -10%; border-radius: 5px; padding-left: 15px;">
                                            <div class="span12 img-polaroid" style="border-radius: 5px; padding: 8px;">
                                                <h4>
                                                    <span>
                                                        Preço médio:&nbsp;&nbsp;
                                                        <span style="font-size: 25px; color: #0044cc;">
                                                            R$<?php echo $professor->hora_aula; ?>
                                                        </span>
                                                        /Hora aula
                                                    </span>
                                                </h4>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <span  id="preco" class="span12 text-info"><i class="icon-edit"></i> Aula <?php echo $professor->tipo_aula; ?> no GetTeacher</span>
                                                <hr />

                                                <?php if (isset($_SESSION['tipo_usuario']) AND $_SESSION['tipo_usuario'] == "Aluno"): ?>                                               
                                                    <a href="#preco" id="agendar-aula" class="btn btn-info span9 offset1">AGENDAR UMA AULA</a>
                                                    <br /><br /><h6 class="offset5 text-info">OU</h6>
                                                <?php endif; ?>

                                                <a href="#preco" class="btn span9 offset1" id="solicitar-orcamento">SOLICITAR ORÇAMENTO</a>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <div class="men-erro <?php echo (isset($_GET['msg'])) ? "" : "hidden"; ?>">
                                                    <div class="e <?php echo (isset($_GET['msg'])) ? "alert-info" : ""; ?>" id="mensagem" style="padding: 3px 13px; border-radius: 5px;">
                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                        <h5 class="m"><?php echo (isset($_GET['msg'])) ? $_GET['msg'] : ""; ?></h5>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div id="contentInnerSeparator"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span11" id="div-orcamento" style="display: none;" >                   
                                                    <!--Edit Tabs here-->
                                                    <ul class="nav nav-tabs">
                                                        <li class="active" id="liSobreAula"><a href="#sobre-a-aula" data-toggle="tab"><i class="icon-star"></i> Sobre a aula</a></li>
                                                        <li id="liSobreVoce"><a href="#sobre-voce" data-toggle="tab"><i class="icon-star"></i> Sobre você</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active" id="sobre-a-aula">
                                                            <?php if (!empty($id_usuario) && !empty($usuario)): ?>
                                                                <input type="hidden" name="id_usuario" class="solicitacao" id="id_usuario" value="<?php echo $id_usuario; ?>" />
                                                                <input type="hidden" name="usuario" class="solicitacao" id="usuario" value="<?php echo $usuario; ?>" />
                                                            <?php endif; ?>
                                                            <span id="id_professor" style="display: none;"><?php echo $id; ?></span>
                                                            <label for="especialidade">Especialidade</label>
                                                            <input type="text" name="especialidade" id="especialidade" class="input-block-level solicitacao" required placeholder="" />
                                                            <label for="nivel">Escolaridade</label>
                                                            <select name="nivel" id="nivel" required class="input-block-level">
                                                                <option>----------------</option>
                                                                <option value="Ensino Fundamental">Ensino Fundamental</option>
                                                                <option value="Ensino Médio">Ensino Médio</option>
                                                                <option value="Pré Vestibular">Pré Vestibular</option>
                                                                <option value="Ensino Superior">Ensino Superior</option>
                                                                <option value="Iniciante">Iniciante</option>
                                                                <option value="Intermediário">Intermediário</option>
                                                                <option value="Avançado">Avançado</option>
                                                            </select>
                                                            <label for="tipo-aula">Tipo Aula</label>
                                                            <select name="tipo-aula" id="tipo-aula" required class="input-block-level">
                                                                <option value="Presencial ou Online">Presencial ou Online</option>
                                                                <option value="Presencial">Apenas Presencial</option>
                                                                <option value="Online">Apenas Online</option>
                                                            </select>
                                                            <label for="necessidade">Fale mais sobre sua necessidade</label>
                                                            <textarea name="necessidade" id="necessidade" required class="input-block-level solicitacao" rows="5"></textarea><br />
                                                            <a href="#sobre-voce" data-toggle="tab" type="button" name="prox-passo" id="prox-passo" class="btn btn-primary offset3">Próximo Passo</a>
                                                            <div class="row-fluid">
                                                                <div class="span12">
                                                                    <div id="contentInnerSeparator"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="sobre-voce">
                                                            <?php if (isset($_SESSION['id_usuario']) AND $_SESSION['tipo_usuario'] == "Aluno") { ?>
                                                                <?php $pegaAluno = select("usuarios u, aluno a", "a.nome_aluno, u.email", "WHERE a.id_aluno = u.id_aluno AND a.id_aluno =". $_SESSION['id_usuario']); ?>
                                                                <?php foreach ($pegaAluno as $aluno): ?>
                                                                    <label for="nome-aluno">Seu Nome</label>
                                                                    <input type="text" name="nome-aluno" id="nome-aluno" class="input-block-level solicitacao" value="<?php echo utf8_encode($aluno->nome_aluno); ?>" />
                                                                    <label for="email-aluno">Seu Email</label>
                                                                    <input type="text" name="email-aluno" id="email-aluno" class="input-block-level solicitacao" value="<?php echo $aluno->email; ?>" />
                                                                    <label for="cep-aluno">Seu Cep</label>
                                                                    <input type="text" name="cep-aluno" id="cep-aluno" class="input-block-level solicitacao" />
                                                                    <label for="tel-aluno">Seu Telefone</label>
                                                                    <input type="text" name="tel-aluno" id="tel-aluno" class="input-block-level solicitacao" />
                                                                    <label for="tipo-endereco">Tipo de Endereco</label>
                                                                    <select class="input-block-level" name="tipo-endereco" id="tipo-endereco">
                                                                        <option value="casa">Casa</option>
                                                                        <option value="Escritório">Escritório</option>
                                                                    </select>
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>
                                                                <label for="nome-aluno">Seu Nome</label>
                                                                <input type="text" name="nome-aluno" id="nome-aluno" class="input-block-level solicitacao" />
                                                                <label for="email-aluno">Seu Email</label>
                                                                <input type="text" name="email-aluno" id="email-aluno" class="input-block-level solicitacao" />
                                                                <label for="cep-aluno">Seu Cep</label>
                                                                <input type="text" name="cep-aluno" id="cep-aluno" class="input-block-level solicitacao" />
                                                                <label for="tel-aluno">Seu Telefone</label>
                                                                <input type="text" name="tel-aluno" id="tel-aluno" class="input-block-level solicitacao" />
                                                                <label for="tipo-endereco">Tipo de Endereco</label>
                                                                <select class="input-block-level" name="tipo-endereco" id="tipo-endereco">
                                                                    <option value="casa">Casa</option>
                                                                    <option value="Escritório">Escritório</option>
                                                                </select>
                                                            <?php } ?>
                                                            <div class="row-fluid">
                                                                <div class="span12">
                                                                    <div id="contentInnerSeparator"></div>
                                                                </div>
                                                            </div>
                                                            <a href="#sobre-a-aula" id="voltar" data-toggle="tab" class="offset1">Voltar</a>
                                                            <span class="btn btn-primary offset2" id="enviar-solicitacao" >Enviar Solicitação</span>
                                                            <div class="row-fluid">
                                                                <div class="span12">
                                                                    <div id="contentInnerSeparator"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End Tabs here-->
                                                </div>

                                                <div id="div-agendamento" class="span11" style="display: none;">
                                                    <form action="../area-restrita/app/solicitar-agendamento.php" method="post">
                                                        <label for="date">Data<span class="text-error">*</span></label>
                                                        <input type="text" id="date" name="data" required class="span12" />
                                                        <label for="inicio-aula">Hora de início da aula<span class="text-error">*</span></label>
                                                        <input type="time" id="inicio-aula" name="inicio-aula" required class="span12" />
                                                        <label>Duração da aula<span class="text-error">*</span></label>
                                                        <select id="tempo-aula" name="tempo-aula" class="span12" required>
                                                            <option>Duração da aula</option>
                                                            <option value="0:30">0:30</option>
                                                            <option value="1:00">1:00</option>
                                                            <option value="1:30">1:30</option>
                                                            <option value="2:00">2:00</option>
                                                        </select>
                                                        <label for="aNecessidade">Fale de sua necessidade<span>*</span></label>
                                                        <textarea class="span12" required id="aNecessidade" name="aNecessidade" rows="5"></textarea>
                                                        <input type="hidden" name="id_professor" value="<?php echo $id; ?>" />
                                                        <input type="submit" name="btnAgendar" id="btbAgendar" class="btn btn-info pull-right" value="Agendar Aula" />
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12 sidebox">
                                                    <legend><h4 class="usuario text-info">Artigos <?php echo ($professor->genero == "Masculino") ? "do professor " : "da professora "; echo utf8_encode(explode(" ", $professor->nome_professor)[0]); ?></h4></legend>
                                                    
                                                    <?php $getPosts = select("blog", "*", "WHERE id_professor = $professor->id_professor AND status = 1", "ORDER BY id_blog DESC", "LIMIT 2"); ?>
                                                    <?php if ($getPosts): ?>
                                                        <?php foreach ($getPosts as $post): ?>
                                                            <a href="artigo-professor.php?id_post=<?php echo $post->id_blog; ?>&amp;id_professor=<?php echo $post->id_professor; ?>" class="titulo"><h5><?php echo $post->titulo; ?></h5></a>
                                                            <div class="row-fluid">
                                                                <a href="artigo-professor.php?id_post=<?php echo $post->id_blog; ?>&amp;id_professor=<?php echo $post->id_professor; ?>"><img class="span12" src="../area-restrita/portifolio/<?php echo $post->imagem; ?>" /></a>
                                                            </div>
                                                            <div class="row-fluid">
                                                                <p class="span12" style="text-align: justify;">
                                                                    <?php echo utf8_encode(limitarCaracteres($post->texto, 90))."...<a href='artigo-professor.php?id_post=$post->id_blog&amp;id_professor=$post->id_professor' class='titulo'>Ler mais</a>"; ?>
                                                                </p>
                                                            </div>
                                                            <div class="row-fluid">
                                                                <span class="text-muted pull-right">
                                                                    
                                                                    <?php 
                                                                        $total_comentario = Conection::connect()->query("SELECT * FROM comentario_blog WHERE id_blog = $post->id_blog"); 
                                                                        $total_likes = Conection::connect()->query("SELECT * FROM like_blog WHERE id_post = $post->id_blog");
                                                                    ?>
                                                                    
                                                                    <?php echo $total_likes->rowCount(); ?>&nbsp; <?php echo ($total_likes->rowCount() > 1) ? "Likes" : "Like"; ?>&nbsp;
                                                                    <?php echo $total_comentario->rowCount(); ?>&nbsp; <?php echo ($total_comentario->rowCount() > 1) ? "Comentários" : "Comentário"; ?>
                                                                    
                                                                </span>    
                                                            </div>
                                                            <hr />
                                                        <?php endforeach; ?>
                                                        <?php 
                                                            $getPosts = select("blog", "COUNT(id_blog) AS total", "WHERE id_professor = $id AND status = 1"); 
                                                            foreach ($getPosts as $total) {
                                                                $tot_artigos = $total->total;
                                                            }
                                                        ?>
                                                            <a href="artigos-do-professor.php?professor=<?php echo $id; ?>" class="btn btn-info">Ver todos (<?php echo $tot_artigos; ?>)</a>
                                                    <?php else: ?>
                                                        <h4 class="text-error"><?php echo utf8_encode(explode(" ", $professor->nome_professor)[0]); ?> ainda não publicou nenhum artigo</h4>
                                                    <?php endif; ?>
                                            
                                               </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span8">
                                                <div class="span3">
                                                    <h4 style="text-align: right;">AULAS OFERECIDAS</h4>
                                                </div>
                                                <div class="span8 offset1">
                                                    <div class="span5">
                                                        <p><i class="icon-check"></i>&nbsp;&nbsp;&nbsp;<?php echo utf8_encode($professor->categoria); ?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                    </div>
                                                    <div class="span6">
                                                        <p><?php echo utf8_encode($professor->especialidade); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span7">
                                                <div class="span3">
                                                    <h4 style="text-align: right;">SOBRE</h4>
                                                </div>
                                                <div class="span8 offset1" style="text-align: justify;">
                                                    <pre style="border: none; font-family: sans-serif; background-color: #fff;"><?php echo utf8_encode($professor->sobre); ?></pre>
                                                </div>

                                                <div class="row-fluid">
                                                    <div class="span3">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="span7">

                                                <?php $getFormacao = select("formacao f INNER JOIN professor p", "*", "WHERE p.id_professor = f.id_professor AND f.id_professor = '$id'"); ?>

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
                                                            <p><?php echo explode(" ", utf8_encode($formacao->nome_professor))[0]; ?> ainda não informou sua formação.</p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>

                                            </div>
                                            <div class="span7 sidebox">
                                                <?php if (avaliacoes($id)): ?>
                                                    <?php foreach (media($id) as $avaliacao): ?>
                                                        <h6><strong>AVALIAÇÕES</strong>(<?php echo $avaliacao->total; ?>)</h6>
                                                        <div>
                                                            <span class="span3">
                                                                Didática <?php
                                                                for ($i = 0; $i < $avaliacao->didatica; $i++) {
                                                                    echo "<i class='icon-star text-info'></i>";
                                                                }
                                                                ?> 
                                                            </span>
                                                            <span class="span4">
                                                                Conhecimento <?php
                                                                for ($i = 0; $i < $avaliacao->conhecimento; $i++) {
                                                                    echo "<i class='icon-star text-info'></i>";
                                                                }
                                                                ?>
                                                            </span>
                                                            <span class="span4"> 
                                                                Simpatia <?php
                                                                for ($i = 0; $i < $avaliacao->simpatia; $i++) {
                                                                    echo "<i class='icon-star text-info'></i>";
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="row-fluid">
                                                        <div class="span7">
                                                            <div id="contentInnerSeparator"></div>
                                                        </div>
                                                    </div>
                                                    <div class="span10">
                                                        <?php foreach (avaliacoes($id) as $avaliacao): ?>
                                                            <div class="row-fluid">
                                                                <div class="span2">
                                                                    <img src="../area-restrita/aluno/imagens/perfil/<?php echo $avaliacao->foto_perfil; ?>" class="img-rounded img-aval" />
                                                                </div>
                                                                <div class="span10">
                                                                    <span><a href="" class="text-info"><?php echo utf8_encode($avaliacao->nome_aluno); ?></a>&nbsp;&nbsp;avaliou&nbsp;&nbsp;<a href="" class="text-info"><?php echo utf8_encode($avaliacao->nome_professor); ?></a>&nbsp;&nbsp;em&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($avaliacao->data)); ?></span>
                                                                </div>
                                                                <div class="span10">
                                                                    <span class="span3" style="font-size: 8pt;">
                                                                        Didática <?php
                                                                        for ($i = 0; $i < $avaliacao->didatica; $i++) {
                                                                            echo "<i class='icon-star text-info'></i>";
                                                                        }
                                                                        ?> 
                                                                    </span>
                                                                    <span class="span4" style="font-size: 8pt;">
                                                                        Conhecimento <?php
                                                                        for ($i = 0; $i < $avaliacao->conhecimento; $i++) {
                                                                            echo "<i class='icon-star text-info'></i>";
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                    <span class="span4" style="font-size: 8pt;"> 
                                                                        Simpatia <?php
                                                                        for ($i = 0; $i < $avaliacao->simpatia; $i++) {
                                                                            echo "<i class='icon-star text-info'></i>";
                                                                        }
                                                                        ?>
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
                                                        <?php if (totalAvaliacoes($id) > 3): ?>
                                                            <a href="" class="btn btn-info">Ver todas as avaliacoes (+<?php echo totalAvaliacoes($id)-3; ?>)</a>
                                                        <?php endif; ?>
                                                    </div> 
                                                <?php else: ?>
                                                    <h6><strong>AVALIAÇÕES</strong>(0)</h6>
                                                    <?php if ($professor->genero == "Masculino"): ?>
                                                        <h4 class="text-error"><?php echo utf8_encode(explode(" ", $professor->nome_professor)[0]); ?> ainda não foi avaliado, faça uma aula com ele e seja o primeiro a avaliá-lo.</h4>
                                                    <?php else: ?>
                                                        <h4 class="text-error"><?php echo utf8_encode(explode(" ", $professor->nome_professor)[0]); ?> ainda não foi avaliada, faça uma aula com ela e seja o primeiro a avaliá-la.</h4>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div id="contentInnerSeparator"></div>
                                        </div>
                                    </div>
                                    <div class="span12 tab-content" style="text-align: center;">
                                        <h1 class="muted">Se preferir, faça uma busca</h1>
                                        <h5 class="text-info">CONHEÇA OS PROFESSORES E ENCONTRE O QUE PROCURA</h5>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="contentInnerSeparator"></div>
                                            </div>
                                        </div>
                                        <form class="form-inline" method="get" action="listar-professores.php">
                                            <input type="text" class="input-large" name="area" placeholder="Area(Ex. Exatas)" />
                                            <input type="text" class="input-large" name="materia" placeholder="Assunto(Ex. Matemática)" />
                                            <input type="submit" class="btn btn-secondary" value="BUSCAR" />
                                        </form>
                                    </div>
                                    <!--End Main Content Area-->
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

                    <br /><br /><br />

                    <script src="../../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script> 
                    <script src="../../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                    <script src="../../resources/scripts/default.js" type="text/javascript"></script>
                    <script src="../../resources/scripts-custom/validation-form.js"></script>
                    <script src="../../resources/scripts-custom/selecionarCategoriaProfessor.js"></script>
                    <script src="../../resources/scripts-custom/solicitarOrcamento.js" type="text/javascript"></script>
                    <script src="../../resources/scripts/bootstrap-datepicker.js" type="text/javascript"></script>

                </body>
            </html>
            <?php
        endforeach;
    } else {
        header("location: ../../");
        exit();
    }
} else {
    header("location: ../../");
    exit();
}