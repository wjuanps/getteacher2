<!DOCTYPE HTML>
<?php
session_start();

    $_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];
    
    require_once '../factory/conexao.php';
    require_once '../dao/selecionar.php';
    require_once '../dao/cadastrar.php';
    require_once '../util/selecionarUsuario.php';
    require_once '../util/selecionarProfessor.php';
    require_once '../area-restrita/app/avaliacoes.php';
    
    if (isset($_REQUEST['AEnviar'], $_SESSION['id_usuario']) && $_SESSION['tipo_usuario'] == "Aluno") {

        $area = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'AArea', FILTER_SANITIZE_STRING))));
        $materia = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'AMateria', FILTER_SANITIZE_STRING))));
        $nivel = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'ANivel', FILTER_SANITIZE_STRING))));
        $necessidade = utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'ANecessidade', FILTER_SANITIZE_STRING))));

        $coluna = array("id_aluno", "area", "categoria", "escolaridade", "necessidade");
        $valor = array($_SESSION['id_usuario'], $area, $materia, $nivel, $necessidade);
        if (inserir($coluna, $valor, "encontrar_aluno")) {
            $a = "ok";
        }

    }
        
?>
<html xmlns="http://www.w3.org/1999/html">
    <head>    
        <meta charset="utf-8">    
        <title>GetTeacher</title>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <meta name="description" content="">    
        <meta name="author" content="Html5TemplatesDreamweaver.com">    
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
        <!-- Remove this Robots Meta Tag, to allow indexing of site -->    
        <link rel="shortcut icon" href="../../../icone.bmp" />        
        <link href="../../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">    
        <link href="../../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">    
        <link href="../../resources/css/styles-custom.css" rel="stylesheet">    
        <link href="../../resources/css/styles-custom.css" rel="stylesheet">    
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->    
        <!--[if lt IE 9]>    
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>    
        <![endif]-->    
        <!-- Icons -->    
        <link href="../../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css"/>    
        <link href="../../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css"/>    
        <!--[if lt IE 8]>    
        <link href="../../resources/scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css"/>    
        <link href="../../resources/scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css"/>    
        <![endif]-->    
        <link rel="stylesheet" href="../../resources/scripts/fontawesome/css/font-awesome.min.css">    
        <!--[if IE 7]>scripts/    
        <link rel="stylesheet" href="../../resources/scripts/fontawesome/css/font-awesome-ie7.min.css">    
        <![endif]-->    
        <link href="../../resources/scripts/carousel/style.css" rel="stylesheet" type="text/css"/>    
        <link href="../../resources/scripts/camera/css/camera.css" rel="stylesheet" type="text/css"/>    
        <link href="../../../styles/custom.css" rel="stylesheet" type="text/css"/>
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
                                <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">                            
                                    Menu <span class="icon-chevron-down icon-white">
                                    </span>                       
                                </button>                        
                                <div class="nav-collapse collapse">                            
                                    <ul class="nav nav-pills ddmenu">                                
                                        <li><a href="../../../">Home</a></li>                                
                                        <li><a href="../../pages/sobre.php">Sobre</a>
                                        </li>                                
                                        <li class="dropdown active">                                    
                                            <a href="" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>                                    
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
                                        <li><a href="../domain/blog-dos-professores.php">Blog</a></li>                                
                                        <li><a href="../../pages/contato.php">Contatos</a></li>                                
                                        <?php if (isset($_SESSION['usuario'])): ?>                                    
                                            <li class="dropdown">                                        
                                                <a href="" dropdown-toggle><?php echo selecionarUsuario(); ?>
                                                    <b class="caret"></b>
                                                </a>                                        
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
                                    <br /><br />                            
                                    <a href="../../pages/cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;
                                    </a>                            
                                    <a href="">Esqueceu sua senha?</a>                        
                                </form>                    
                            </div>                
                        </div>            
                    </div>        
                </div>                
                <div class="row-fluid">            
                    <div class="span12">                
                        <div id="contentInnerSeparator">
                        </div>            
                    </div>        
                </div>    
            </div>    
            <div class="contentArea">        
                <div class="divPanel notop page-content">    
                    
                    <div class="row-fluid">
                        <div class="breadcrumbs span12">                
                            <a href="../../../">Home</a> &nbsp;/&nbsp; <span><?php echo $area; ?></span>    

                            <div class="pull-right span4">
                                <form action="listar-professores.php" method="get" class="form-search">
                                   <input type="search" name="q" id="procurar-professor" class="search-query span12" placeholder="Procure por um professor" />
                               </form>
                            </div>

                        </div>   
                    </div>
                    
                    <div class="row-fluid">                
                        <!--Edit Sidebar Content here-->                
                        <div class="span3">                    
                            <form class="sidebox" action="listar-professores.php" method="get" >                        
                                <h4 class="text-info">REFINE SUA BUSCA</h4>                        
                                <input style="display: none;" id="a" name="area" value="<?php echo $area; ?>" />                        
                                <label for="categoria"><strong>Matéria</strong></label>                        
                                <select id="categoria" name="materia" class="span12">                            
                                    <option></option>                        
                                </select>                        
                                <label for="tipo-aula"><strong>Tipo de Aula</strong></label>                        
                                <select name="tipo-aula" id="tipo-aula" class="span12">                            
                                    <option value="Presencial ou Online">Presencial ou Online</option>                            
                                    <option value="Presencial">Presencial</option>                            
                                    <option value="Online">Online</option>                        
                                </select>                        
                                <label for="genero-professor"><strong>Gênero</strong></label>                        
                                <select name="genero-professor" id="genero-professor" class="span12">                            
                                    <option>Sem Preferência</option>                            
                                    <option value="Masculino">Masculino</option>                            
                                    <option value="Feminino">Feminino</option>                        
                                </select>                        <br />                        
                                <input type="submit" class="btn btn-info span12" value="Refazer Busca" />                    
                            </form>                                        
                            <h4 class="text-success centered_menu">OU</h4>                                        
                            <div class="sidebox">                                                
                                <?php
                                if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "Aluno") {
                                    $pegaAluno = select("aluno a, usuarios u", "a.nome_aluno, u.email", "WHERE a.id_aluno = u.id_aluno AND a.id_aluno = " . $_SESSION['id_usuario']);
                                    foreach ($pegaAluno as $aluno) {
                                        $nome = utf8_encode($aluno->nome_aluno);
                                        $email = $aluno->email;
                                    }
                                }
                                ?>                                                
                                <form action="" method="post">                            
                                    <h5 class="text-info">QUAL SUA NECESSIDADE</h5>                            
                                    <label for="nome"><strong>Seu Nome</strong><span class="text-error">*</span></label>                            
                                    <input type="text" class="span12" required id="nome" name="nome" value="<?php echo (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario'] == "Aluno") ? $nome : ""; ?>" />                            
                                    <label for="email"><strong>Seu Email</strong><span class="text-error">*</span></label>                            
                                    <input type="email" required class="span12" id="email" name="email" value="<?php echo (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario'] == "Aluno") ? $email : ""; ?>" />                            
                                    <label for="area2"><strong>Área</strong><span class="text-error">*</span></label> 

                                    <select class="span12" id="area2" name="AArea">     
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
                                    <label for="categoria2"><strong>Categoria</strong><span class="text-error">*</span></label>   
                                    <select class="span12" id="categoria2" name="AMateria"></select>                  

                                    <label for="nivel"><strong>Escolaridade</strong><span class="text-error">*</span></label>     
                                    <select name="ANivel" id="nivel" required class="input-block-level">                      
                                        <option value="Ensino Fundamental">Ensino Fundamental</option>                    
                                        <option value="Ensino Médio">Ensino Médio</option>                             
                                        <option value="Pré Vestibular">Pré Vestibular</option>                          
                                        <option value="Ensino Superior">Ensino Superior</option>                  
                                        <option value="Iniciante">Iniciante</option>                          
                                        <option value="Intermediário">Intermediário</option>               
                                        <option value="Avançado">Avançado</option>                        
                                    </select>                       
                                    <label for="necessidade"><strong>Conte-nos sua necessidade</strong><span class="text-error">*</span></label> 
                                    <textarea class="span12" rows="5" required id="necessidade" name="ANecessidade"></textarea>    
                                    <?php if (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario'] == "Aluno"): ?>                  
                                        <input type="submit" class="btn btn-info span12" name="AEnviar" />                       
                                    <?php else: ?>                                
                                        <div class="row-fluid">                               
                                            <a data-toggle="modal" href="#myModal" class="btn btn-info span12">Enviar</a> 
                                        </div>                        
                                    <?php endif; ?>          

                                </form>           
                            </div>               
                        </div>                     
                        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 650px;">    

                            <div class="modal-header">    
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>    
                                <h3 id="myModalLabel">Faça o Login ou Cadastre-se</h3>     
                            </div>                    <div class="modal-body">            
                                <div class="span6">                          
                                    <h4>Faça o Login</h4>                       
                                    <form action="../area-restrita/app/login.php" method="post">               
                                        <input type="text" name="acessarUsuario" id="cUsuario" class="span12" required placeholder="Usuario ou Email">  
                                        <input type="password" name="senhaUsuario" id="cSenha" class="span12" required placeholder="Informe sua senha"> 
                                        <span class="text-muted">*Como aluno</span>
                                        <input type="submit" class="btn btn-info pull-right" value="Login">                       
                                    </form>                      
                                </div>               
                                <div class="span6">      
                                    <h4>Cadastre-se</h4>       
                                    <form action="" method="post">     
                                        <input type="text" name="nome-aluno" id="cUsuario" class="span12" required placeholder="Informe seu Nome">   
                                        <input type="text" name="sobrenome-aluno" id="cUsuario" class="span12" required placeholder="Informe seu sobrenome">    
                                        <input type="text" name="email-aluno" id="cUsuario" class="span12" required placeholder="Informe seu Email">    
                                        <input type="password" name="senha-aluno" id="cUsuario" class="span12" required placeholder="Informe sua senha">   
                                        <input type="submit" class="btn btn-info pull-right" value="Cadastrar">      
                                    </form>                  
                                </div>           
                            </div>           
                            <div class="modal-footer">      
                                <button class="btn" data-dismiss="modal">Cancelar</button> 
                            </div>         
                        </div>          
                        <!--/End Sidebar Content -->     
                        <!--Edit Main Content Area here-->     
                        <div class="span9" id="divMain">      
                            <div class="alert alert-info span12">  
                                <div class="span9">                
                                    <?php
                                        if ($resultado) {

                                            if ($total_resultados == 1) {
                                                echo "<h4>" . $total_resultados . " Professor particular</h4>";
                                            } else {
                                                echo "<h4>" . $total_resultados . " Professores particulares</h4>";
                                            }
                                        } else {
                                            echo "<h4>" . 0 . " Professores particulares</h4>";
                                        }
                                    ?>                   
                                </div>                
                                <div class="span3 navbar" style="margin: -65px auto -3px auto">    
                                    <div>                
                                        <ul class="nav nav-pills ddmenu">      
                                            <li class="dropdown active">       
                                                <a href="#" class="dropdown-toggle">Ordenar<b class="caret"></b></a>    
                                                <ul class="dropdown-menu">                            
                                                    <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>&hora=<?php echo 'menor' ?>">Menor Preço</a></li>      
                                                    <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>&hora=<?php echo 'maior' ?>">Maior Preço</a></li>     
                                                    <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>&hora=<?php echo 'avaliacao' ?>">Melhor Avaliado</a></li>    
                                                </ul>                       
                                            </li>                              
                                        </ul>                         
                                    </div>                     
                                </div>                 
                            </div>                
                            <hr>                
                            <!--Edit Portfolio Content Area here-->  
                            <div class="row-fluid">       
                                <div class="span12">     
                                    <div class="yoxview">      
                                        <?php if ($resultado): foreach ($resultado as $professor): ?>   
                                            <div class="row-fluid">              
                                                <ul class="thumbnails">           
                                                    <li class="span12">      
                                                        <div class="thumbnail span12">     
                                                            <div class="pull-right">         
                                                                <span>Preço Médio</span>    
                                                                <span class="alert-info"style="border-radius: 6%; color: #fff; background-color: #006dcc; padding: 15px; box-shadow: 0px 0px 4px rgba(0,0,0,.6);">
                                                                    <span   
                                                                        style="font: 22px 'Trebuchet MS'"><?php echo "R$ " . $professor->hora_aula; ?>/
                                                                    </span>hora
                                                                </span>  
                                                            </div>              
                                                            <div class="span2 foto" style="padding-top: 15px;">      
                                                                <a href="perfil-professor.php?professor=<?php echo $professor->id_professor; ?>#banner">
                                                                    <img style="height: 150px; margin-top: 6.5%;" class="img-rounded" src="../area-restrita/professor/imagens/perfil/<?php echo $professor->foto_perfil; ?>" alt="<?php echo utf8_encode($professor->nome_professor); ?>" title="<?php echo utf8_encode($professor->nome_professor); ?>"/>   
                                                                </a>                                      
                                                                <p>Dá aula <strong><?php echo $professor->tipo_aula; ?></strong></p>     

                                                            </div>                            
                                                            <div class="span8">                              
                                                                <span>                                           
                                                                    <a href="perfil-professor.php?professor=<?php echo $professor->id_professor; ?>#banner" style="color: #003bb3; font-size: 25px;">     
                                                                        <strong><?php echo utf8_encode($professor->nome_professor); ?></strong>          
                                                                    </a><br />                 
                                                                    <?php foreach (mediaTotal($professor->id_professor) as $avaliacao): ?>       
                                                                        <?php if ($avaliacao->total == 0): ?>              
                                                                            <i class="icon-star text-info"></i>          
                                                                        <?php else: ?>                                
                                                                            <?php
                                                                                for ($i = 0; $i < $avaliacao->total; $i++) {
                                                                                    echo '<i class="icon-star text-info"></i>';
                                                                                }
                                                                            ?>                                                           
                                                                        <?php endif; ?>                                                      
                                                                    <?php endforeach; ?>                                 
                                                                    /    
                                                                    <span><?php echo utf8_encode($professor->cidade . '-' . $professor->estado); ?></span>  

                                                                </span>                                                                            
                                                                <div class="row-fluid">
                                                                    <?php include_once '../util/limitadorDeCaracteres.php'; ?>
                                                                    <div class="span12 sobre-prof">
                                                                        <p style="text-align: justify; white-space: pre-line;">
                                                                            <?php echo utf8_encode(limitarCaracteres($professor->sobre, 300)) . "..."; ?>
                                                                        </p>
                                                                    </div><br />  
                                                                    <br /><br />   
                                                                </div>           
                                                            </div>              
                                                        </div>                    
                                                    </li>                        
                                                </ul>  
                                            </div>                                   
                                            <?php
                                        endforeach;
                                    else: if (isset($_REQUEST['area'])) {
                                            echo "<h2 style='text-align: center;' class='text-error'>Nenhum professor de {$area} Encontrado!<h2>";
                                        } else {

                                            echo "<h2 style='text-align: center;' class='text-error'>Nenhum professor Encontrado!<h2>";
                                        } endif;
                                    ?>     
                                        
                                    </div>                      

                                    <div class="pagination pull-right">
                                        <ul>

                                            <li><a href="<?php echo $_SERVER['REQUEST_URI']."&pagina=1"; ?>">&laquo;</a></li>

                                            <?php 
                                                for($i = 1; $i <= $num_paginas; $i++): 
                                                    $estilo = "";
                                                    if ($pagina == $i) {
                                                        $estilo = "class=\"active\"";
                                                    }
                                                    ?>
                                                    <li <?php echo $estilo; ?>><a href="<?php echo $_SERVER['REQUEST_URI']."&pagina=$i"; ?>"><?php echo $i; ?></a>
                                                    <?php
                                                endfor;
                                            ?>

                                            <li><a href="<?php echo $_SERVER['REQUEST_URI']."&pagina=$num_paginas"; ?>">&raquo;</a></li>

                                        </ul>
                                    </div>
                                </div>                     
                                <!--/End Main Content Area here-->         
                            </div>                 
                            <div id="footerInnerSeparator"></div>   
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
    </body>
</html>