<!DOCTYPE HTML>
<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';
$pdo = Conection::connect();
$id = '';
if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {
    $user = $_SESSION['usuario'];
    $id = $_SESSION['id_usuario'];

    if ($_SESSION['tipo_usuario'] == "Professor") {
        $sql = $pdo->prepare("SELECT * FROM professor p, usuarios u WHERE p.id_professor = u.id_professor AND p.id_professor = ?");

        $pegaTelefone = select("telefone", "*", "WHERE id_professor = '$id'");
        $pegaFormacao = select("formacao", "*", "WHERE id_professor = '$id'");
    } else {
        $sql = $pdo->prepare("SELECT a.nome_aluno AS nome_professor, a.foto_perfil, u.email FROM aluno a, usuarios u WHERE a.id_aluno = u.id_aluno AND u.id_aluno = ?");
    }
    
    $sql->execute(array($id));
    $usuario = $sql->fetch(PDO::FETCH_OBJ);

} else {
    header("location: ../../../../");
    exit();
}
?>

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
                                    <li class=""><a href="aulas.php">Aulas</a></li>
                                    <li class=""><a href="../chat/conversas.php">Mensagens</a></li>
                                    <li class="active"><a href="">Editar Perfil</a></li>
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
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo utf8_encode($usuario->nome_professor); ?><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="span3 user alert-info">
                                                <div class="row-fluid">
                                                    <div class="span10" style="margin: 15px;">
                                                        
                                                        <?php $src = ($_SESSION['tipo_usuario'] == "Professor") ? "../professor/" : "../aluno/"; ?>
                                                        
                                                        <img src="<?php echo $src.'imagens/perfil/'.$usuario->foto_perfil; ?>" class="foto-perfil img-bordered-sm"/>
                                                    
                                                    </div>
                                                    <div class="span12">
                                                        <?php if ($_SESSION['tipo_usuario'] == "Professor"): ?>
                                                            <a href="../professor/perfil.php" class="btn btn-success btn-small span5 p">Perfil Completo</a>
                                                        <?php else: ?>
                                                            <a href="aulas.php" class="btn btn-success btn-small span5 p">Minhas Aulas</a>
                                                        <?php endif; ?>
                                                        <a href="" class="btn btn-success btn-small span5 p">Editar Perfil</a>
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
                                                        <a href="logOut.php"><h3><i class="icon-signout text-info"></i></h3>
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
                    <div class="breadcrumbs">
                        <a href="<?php echo $_SESSION['pagina']; ?>">Home</a> &nbsp;/&nbsp; <span>Editar Perfil</span>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="sidebox span10 offset1">
                                <?php if ($_SESSION['tipo_usuario'] == "Professor"): ?>
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#perfil" data-toggle="tab"><i class="icon-user"></i>&nbsp;&nbsp;&nbsp;Perfil</a></li>
                                        <li><a href="#fotos" data-toggle="tab"><i class="icon-picture"></i>&nbsp;&nbsp;&nbsp;Fotos</a></li>
                                        <li class="endereco"><a href="#endereco" data-toggle="tab"><i class="icon-home"></i>&nbsp;&nbsp;&nbsp;Endereço</a></li>
                                        <li><a href="#telefones" data-toggle="tab"><i class="icon-phone"></i>&nbsp;&nbsp;&nbsp;Telefones</a></li>
                                        <li class="formacao"><a href="#formacao" data-toggle="tab"><i class="icon-book"></i>&nbsp;&nbsp;&nbsp;Formação</a></li>
                                        <li class="aulas"><a href="#aulas" data-toggle="tab"><i class="icon-pencil"></i>&nbsp;&nbsp;&nbsp;Aulas</a></li>
                                        <li><a href="#configuracoes" data-toggle="tab"><i class="icon-cogs"></i>&nbsp;&nbsp;&nbsp;Configurações</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="perfil">
                                            <?php
                                                $nome_completo = explode(" ", utf8_encode($usuario->nome_professor));
                                                $data = explode("-", $usuario->data_nascimento);
                                            ?> 
                                            <form action="../../util/atualizarCadastroProfessor.php" method="POST">
                                                <div class="row-fluid">
                                                    <div class="span4">
                                                        <label for="nome">Nome<span class="text-error">*</span></label>
                                                        <input type="text" name="nome" id="nome" class="span12" value="<?php echo $nome_completo[0]; ?>" required />
                                                    </div>
                                                    <div class="span4">
                                                        <label for="sobrenome">Sobrenome<span class="text-error">*</span></label>
                                                        <input type="text" name="sobrenome" id="sobrenome" class="span12" value="<?php echo $nome_completo[1]; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span4">
                                                        <label for="nascimento">Data Nascimento<span class="text-error">*</span></label>
                                                        <input type="text" name="nascimento" id="nascimento" class="span12" value="<?php echo $data[2] . '/' . $data[1] . '/' . $data[0]; ?>" required />
                                                    </div>
                                                    <div class="span4">
                                                        <label for="genero">Gênero<span class="text-error">*</span></label>
                                                        <select name="genero" id="genero" class="span12 genero">
                                                            <option>------------</option>
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Feminino">Feminino</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span8">
                                                        <label for="mim">Sobre Mim<span class="text-error">*</span></label>
                                                        <textarea name="mim" id="mim" class="span12" rows="8" required ><?php echo $usuario->sobre; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span8">
                                                        <input type="submit" name="aPerfil" id="aPerfil" class="btn btn-info pull-right" value="Atualizar Perfil" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="fotos">
                                            <div class="row-fluid">
                                                <div class="span3">
                                                    <img class="img-rounded" src="../professor/imagens/perfil/<?php echo $usuario->foto_perfil; ?>" style='height: 200px;' />
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span8 pull-right">
                                                    <form action="../../util/atualizarCadastroProfessor.php" method="POST" enctype="multipart/form-data">
                                                        <input type="file" required class="input-xxlarge span7" name="foto" id="foto" name="foto" />
                                                        <input type="submit" name="aFoto" class="btn btn-info span3" value="Alterar Foto" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="endereco">
                                            <form action="../../util/atualizarCadastroProfessor.php" method="POST">
                                                <div class="row-fluid">
                                                    <label for="cep">CEP<span class="text-error">*</span></label>
                                                    <input type="text" id="cep" name="cep" pattern="^([0-9]{5})-([0-9]{3})$" required value="<?php echo $usuario->cep; ?>" title="Ex: XXXXX-XXX" />
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span3">
                                                        <label for="estado">Estado<span class="text-error">*</span></label>
                                                        <select name="estado" id="estado" class="span12" required></select>
                                                    </div>
                                                    <div class="span3">
                                                        <label for="cidade">Cidade<span class="text-error">*</span></label>
                                                        <input type="text" name="cidade" id="cidade" class="span12" required value="<?php echo utf8_encode($usuario->cidade); ?>" />
                                                    </div>
                                                    <div class="span3">
                                                        <label for="bairro">Bairro<span class="text-error">*</span></label>
                                                        <input type="text" name="bairro" id="bairro" class="span12" required value="<?php echo utf8_encode($usuario->bairro); ?>" />
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span3">
                                                        <label for="logradouro">Logradouro<span class="text-error">*</span></label>
                                                        <input type="text" name="logradouro" id="logradouro" class="span12" required value="<?php echo utf8_encode($usuario->logradouro); ?>" />
                                                    </div>
                                                    <div class="span3">
                                                        <label for="numero">Número<span class="text-error">*</span></label>
                                                        <input type="number" name="numero" id="numero" class="span12" min="0" required value="<?php echo $usuario->numero; ?>" />
                                                    </div>
                                                    <div class="span3">
                                                        <label for="complemento">Complemento</label>
                                                        <input type="text" name="complemento" id="complemento" class="span12" value="<?php echo utf8_encode($usuario->complemento); ?>" />
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <input type="submit" name="aEndereco" class="btn btn-info" value="Salvar Alterações" />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="telefones">
                                            <form class="fTel" action="../../util/atualizarCadastroProfessor.php" method="POST">
                                                <div class="addTel">
                                                    <?php foreach ($pegaTelefone as $telefone): ?>
                                                        <?php $tel = explode(" ", $telefone->telefone); ?>
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <div class="span1">
                                                                    <label for="ddd">DDD<span class="text-error">*</span></label>
                                                                    <input type="text" name="ddd" id="ddd" required class="span12" value="<?php echo $tel[0]; ?>" />
                                                                </div>
                                                                <div class="span4">
                                                                    <label for="tel">Telefone<span class="text-error">*</span></label>
                                                                    <input type="text" name="tel" id="tel" required class="input-large" value="<?php echo $tel[1]." ".$tel[2]; ?>"  />
                                                                    <input type="hidden" id="tel_<?php echo $telefone->id_telefone; ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span3">
                                                        <span class="text-success" title="Mais telefones"><i class="icon-plus-sign-alt mais"></i><span>&nbsp;&nbsp;Mais telefones</span></span>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div id="contentInnerSeparator"></div>
                                                    </div>
                                                </div>
                                                <input type="button" name="aTelefones" class="btn btn-success" value="Atualizar Telefones" />
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="formacao">
                                            <div class="row-fluid">
                                                <form class="span12" action="../../util/atualizarCadastroProfessor.php" method="POST">
                                                    <?php foreach ($pegaFormacao as $formacao): ?>
                                                        <div class="row-fluid">
                                                            <div class="span3">
                                                                <label for="nivel">Nível<span class="text-error">*</span></label>
                                                                <select name="nivel" id="nivel" class="span12" required>
                                                                    <option>----------------</option>
                                                                    <option value="Curso Livre">Curso Livre</option>
                                                                    <option value="Ensino Fundamental">Ensino Fundamental</option>
                                                                    <option value="Ensino Médio">Ensino Médio</option>
                                                                    <option value="Curso Técnico">Curso Técnico</option>
                                                                    <option value="Graduação">Graduação</option>
                                                                    <option value="Especialização">Especialização</option>
                                                                    <option value="MBA">MBA</option>
                                                                    <option value="Mestrado">Mestrado</option>
                                                                    <option value="Doutorado">Doutorado</option>
                                                                    <option value="Pós Doutorado">Pós Doutorado</option>
                                                                </select>
                                                            </div>
                                                            <div class="span4">
                                                                <label for="curso">Curso<span class="text-error">*</span></label>
                                                                <input type="text" id="curso" name="curso" class="span12" required value="<?php echo utf8_encode($formacao->curso); ?>" />
                                                            </div>
                                                            <div class="span4">
                                                                <label for="instituicao">Instituição<span class="text-error">*</span></label>
                                                                <input type="text" id="instituicao" name="instituicao" class="span12" required value="<?php echo utf8_encode($formacao->instituicao); ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <div id="contentInnerSeparator"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span3">
                                                                <label for="ano-inicio">Ano de Início<span class="text-error">*</span></label>
                                                                <input type="number" id="ano-inicio" name="ano-inicio" class="span12" min="1970" max="2050" required value="<?php echo $formacao->ano_inicio; ?>" />
                                                            </div>
                                                            <div class="span3">
                                                                <label for="ano-termino">Ano de Término<span class="text-error">*</span></label>
                                                                <input type="number" id="ano-termino" name="ano-termino" class="span12" min="1970" max="2050" required value="<?php echo $formacao->ano_termino; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <div id="contentInnerSeparator"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <input type="submit" name="aFormacao" class="btn btn-info" value="Salvar Alterações" />
                                                        </div>
                                                    <?php endforeach; ?>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="aulas">
                                            <div class="row-fluid">
                                                <form action="../../util/atualizarCadastroProfessor.php" method="POST" class="span10">
                                                    <div class="row-fluid">
                                                        <div class="span3">
                                                            <label for="area">Área<span class="text-error">*</span></label>
                                                            <select name="area" id="area" class="areaP span12">
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
                                                            <label for="categoria">Categoria<span class="text-error">*</span></label>
                                                            <select id="categoria" name="categoria" class="span12"></select>
                                                        </div>
                                                        <div class="span4">
                                                            <label for="spec">Especialidade<span class="text-error">*</span></label>
                                                            <input type="text" id="spec" name="spec" class="input-large" value="<?php echo utf8_encode($usuario->especialidade); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div id="contentInnerSeparator"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span4">
                                                            <label for="tipo-aula">Tipo Aula<span class="text-error">*</span></label>
                                                            <select id="tipo-aula" name="tipo-aula" class="tipo-aula">
                                                                <option value="Presencial ou Online">Presencial ou Online</option>
                                                                <option value="Presencial">Apenas Presencial</option>
                                                                <option value="Online">Apenas Online</option>
                                                            </select>
                                                        </div>
                                                        <div class="span3">
                                                            <label for="preco">Preco por hora aula<span class="text-error">*</span></label>
                                                            <div class="input-prepend input-append">
                                                                <span class="add-on">R$</span>
                                                                <input type="number" name="preco" id="preco" class="input-medium" value="<?php echo $usuario->hora_aula; ?>" />
                                                                <span class="add-on">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div id="contentInnerSeparator"></div>
                                                        </div>
                                                    </div>
                                                    <input type="submit" name="aAulas" class="btn btn-info" value="Atualizar Aulas" />
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="configuracoes">
                                            
                                            <form action="../../util/atualizarCadastroProfessor.php" method="post">
                                                
                                                <div class="row-fluid">
                                                    <p>Email cadastrado: <strong><?php echo $usuario->email; ?></strong> (<a href="" class="text-info" id="alterarEmail">Alterar</a>)</p>
                                                    <input type="text" name="email" class="span6" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" placeholder="Informe aqui seu novo email" style="display: none;" />
                                                </div>
                                                <br />
                                                <div class="row-fluid">
                                                    <p><a href="" class="text-info" id="alterarSenha">Mudar senha</a></p>
                                                    <input type="password" name="senha" class="span6" placeholder="Informe aqui sua nova senha" style="display: none;"  />
                                                </div>
                                                <br />
                                                <div class="row-fluid">
                                                    <input type="submit" name="aConfiguracoes" class="btn btn-info" value="Confirmar Alterações" />
                                                </div>
                                                
                                            </form>
                                            
                                        </div>
                                    </div>
                                <?php else: ?>
                                
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#perfil" data-toggle="tab"><i class="icon-user"></i>&nbsp;&nbsp;&nbsp;Perfil</a></li>
                                        <li><a href="#fotos" data-toggle="tab"><i class="icon-picture"></i>&nbsp;&nbsp;&nbsp;Fotos</a></li>
                                        <li><a href="#configuracoes" data-toggle="tab"><i class="icon-cogs"></i>&nbsp;&nbsp;&nbsp;Configurações</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="perfil">
                                            
                                            <?php $nome_completo = explode(" ", utf8_encode($usuario->nome_professor)); ?> 
                                            
                                            <form action="../../util/atualizarCadastroAluno.php" method="POST">
                                                <div class="row-fluid">
                                                    <div class="span4">
                                                        <label for="nome">Nome<span class="text-error">*</span></label>
                                                        <input type="text" name="nome" id="nome" class="span12" value="<?php echo $nome_completo[0]; ?>" required />
                                                    </div>
                                                    <div class="span4">
                                                        <label for="sobrenome">Sobrenome<span class="text-error">*</span></label>
                                                        <input type="text" name="sobrenome" id="sobrenome" class="span12" value="<?php echo $nome_completo[1]; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span8">
                                                        <input type="submit" name="aPerfil" id="aPerfil" class="btn btn-info pull-right" value="Atualizar Perfil" />
                                                    </div>
                                                </div>
                                            </form>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="fotos">
                                            
                                            <div class="row-fluid">
                                                <div class="span3">
                                                    <img class="img-rounded" src="../aluno/imagens/perfil/<?php echo $usuario->foto_perfil; ?>" style='height: 200px;' />
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span8 pull-right">
                                                    <form action="../../util/atualizarCadastroAluno.php" method="POST" enctype="multipart/form-data">
                                                        <input type="file" required class="input-xxlarge span7" name="foto" id="foto" name="foto" />
                                                        <input type="submit" name="aFoto" class="btn btn-info span3" value="Alterar Foto" />
                                                    </form>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="configuracoes">
                                            
                                            <form action="../../util/atualizarCadastroAluno.php" method="post">
                                                
                                                <div class="row-fluid">
                                                    <p>Email cadastrado: <strong><?php echo $usuario->email; ?></strong> (<a href="" class="text-info" id="alterarEmail">Alterar</a>)</p>
                                                    <input type="text" name="email" class="span6" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" placeholder="Informe aqui seu novo email" style="display: none;"  />
                                                </div>
                                                <br />
                                                <div class="row-fluid">
                                                    <p><a href="" class="text-info" id="alterarSenha">Mudar senha</a></p>
                                                    <input type="password" name="senha" class="span6" placeholder="Informe aqui sua nova senha" style="display: none;"  />
                                                </div>
                                                <br />
                                                <div class="row-fluid">
                                                    <input type="submit" name="aConfiguracoes" class="btn btn-info" value="Confirmar Alterações" />
                                                </div>
                                                
                                            </form>
                                            
                                        </div>
                                    </div>
                                
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim Conteúdo principal -->

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
    <script src="../../../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>    
    <script src="../js/editarPerfil.js" type="text/javascript"></script>
    <script src="../js/chat-ajax.js" type="text/javascript"></script>
    <script src="../js/notificacoes.js" type="text/javascript"></script>

</html>

