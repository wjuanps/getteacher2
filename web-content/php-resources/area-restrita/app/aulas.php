<?php
session_start();

date_default_timezone_set("America/Belem");

require_once '../../factory/conexao.php';
require_once '../../dao/selecionar.php';

$id = '';
if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {
    $user = $_SESSION['usuario'];
    $id = $_SESSION['id_usuario'];
    
    require_once './carregarAulas.php';
    
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
        <link href="../../../resources/css/datepicker3.css" rel="stylesheet" type="text/css" />
        
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
                            <a href="<?php echo $_SESSION['pagina']; ?>" class="brand">GETTEACHER</a>
                            <div class="nav-collapse collapse">
                                <ul class="nav">
                                    <li class=""><a href="<?php echo $_SESSION['pagina']; ?>">Home</a></li>
                                    <li class="active"><a href="">Aulas</a></li>
                                    <li class=""><a href="../chat/conversas.php">Mensagens</a></li>
                                    <li class=""><a href="editarPerfil.php">Editar Perfil</a></li>
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
                                            <li class="centered_menu text-info">&nbsp;&nbsp;Notificações</li>
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
                                                            <img src="<?php echo $_SESSION['pagina'] ."/imagens/perfil/". $usuario->foto_perfil; ?>" class="foto-perfil img-bordered-sm"/>
                                                        </div>
                                                        <div class="span12">
                                                            <?php if ($_SESSION['tipo_usuario'] == "Professor"): ?>
                                                                <a href="../professor/perfil.php" class="btn btn-success btn-small span5 p">Perfil Completo</a>
                                                            <?php else: ?>
                                                                <a href="" class="btn btn-success btn-small span5 p">Minhas Aulas</a>
                                                            <?php endif; ?>
                                                            <a href="editarPerfil.php" class="btn btn-success btn-small span5 p">Editar Perfil</a>
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
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim do menu de navegação -->

            <!-- Conteúdo Principal -->
            <div class="contentArea">
                <div class="divPanel notop nobottom">
                    <div class="breadcrumbs">
                        <a href="<?php echo $_SESSION['pagina']; ?>">Home</a> &nbsp;/&nbsp; <span>Aulas</span>
                    </div>
                    <div class="row-fluid">
                        <div class="span10 sidebox">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#prox-aulas" data-toggle="tab"><i class="icon-share-alt"></i>&nbsp;&nbsp;&nbsp;Próximas Aulas</a></li>
                                <li id="li"><a href="#por-aluno" data-toggle="tab"><i class="icon-user"></i>&nbsp;&nbsp;&nbsp;<?php echo ($_SESSION['tipo_usuario'] == "Professor") ? "Meus Alunos" : "Meus Profesores"; ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="prox-aulas">
                                    <?php if ($aulas): ?>
                                        <?php foreach ($aulas as $aula): ?>
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="box box-info collapsed-box">
                                                        <div class="box-header with-border">
                                                            
                                                            <?php 
                                                                $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
                                                                $data = explode("/", date("d/m/Y", strtotime($aula->data)));
                                                                $hora = date("h:i", strtotime($aula->data));

                                                                $am_pm = (date("H", strtotime($aula->data)) <= 12) ? "AM" : "PM"; 
                                                            ?>
                                                            
                                                            <h3 class="box-title">
                                                                <?php 
                                                                    echo utf8_encode($aula->nome) . 
                                                                            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='text-info' style='font-size: 10pt;'>" . 
                                                                            $data[0]." ".$meses[(int)$data[1]-1].". ".$data[2]." ".$hora." ".$am_pm . "</span>"; 
                                                                ?>
                                                            </h3>
                                                            <div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="caret"></i></button>
                                                            </div><!-- /.box-tools -->
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="row-fluid">
                                                                <div class="row-fluid">
                                                                    <div class="span6">
                                                                        <p class="aula">Local: <?php echo $aula->cidade . " - " . $aula->estado; ?></p>
                                                                        <p class="aula">Data: <?php echo date("d/m/Y", strtotime($aula->data)); ?></p>
                                                                        <p class="aula">Hora: <?php echo date("H:i", strtotime($aula->data)); ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row-fluid">
                                                                <?php 

                                                                    $id_aula = $aula->id_agendamento;
                                                                    $avaliar_aula = Conection::connect()->query("SELECT * FROM agendamento WHERE id_agendamento = $id_aula AND CURRENT_DATE > DATE(data) AND id_aluno = ".$_SESSION['id_usuario']);

                                                                 ?>
                                                                <div class="pull-right span8">
                                                                    
                                                                    <?php if ($_SESSION['tipo_usuario'] == "Aluno"): ?>
                                                                        <button id="<?php echo $aula->id_agendamento; ?>" class="btn btn-info btn-mini avaliar <?php echo ($avaliar_aula->rowCount() <= 0) ? 'disabled' : 'abled'; ?>">Avaliar</button>
                                                                    <?php endif; ?>
                                                                        
                                                                    <button class="btn btn-info btn-mini" name="remarcar" id="re_<?php echo $aula->id_agendamento; ?>">Remarcar</button>
                                                                    <a href="../../../pages/contato.php" class="btn btn-danger btn-mini" name="cancelar">Denunciar</a>
                                                                    <button class="btn btn-danger btn-mini" id="<?php echo $aula->id_agendamento; ?>" name="cancelar">Cancelar</button>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                        </div><!-- /.box-body -->
                                                    </div><!-- /.box -->
                                                </div>
                                                                                            
                                                <div id="aval_<?php echo $aula->id_agendamento; ?>" class="row-fluid pull-right span5" style="margin-right: 8%; display: none;">

                                                    <form class="form-group-lg" method="post" action="enviarAvaliacao.php">
                                                        <div class="span6">
                                                            <?php $a = array(1 => "Péssimo", 2 => "Ruim", 3 => "Regular", 4 => "Bom", 5 => "Excelente"); ?>
                                                            <label>Didática</label>
                                                            <?php for ($i = 1; $i < 6; $i++): ?> <i data-toggle="tooltip" title="<?php echo $a[$i]; ?>" id="did_<?php echo $i ?>" name="didatica" class="icon-star <?php echo ($i == 1) ? 'text-info' : ''; ?>" style="font-size: 18pt;"></i>&nbsp;&nbsp; <?php endfor; ?>
                                                            <input type="hidden" name="cDid" id="cDid_<?php echo $aula->id_agendamento; ?>" value="1" />
                                                            <label>Conhecimento</label>
                                                            <?php for ($i = 1; $i < 6; $i++): ?> <i data-toggle="tooltip" title="<?php echo $a[$i]; ?>" id="con_<?php echo $i ?>" name="conhecimento" class="icon-star <?php echo ($i == 1) ? 'text-info' : ''; ?>" style="font-size: 18pt;"></i>&nbsp;&nbsp; <?php endfor; ?>
                                                            <input type="hidden" name="cCon" id="cCon_<?php echo $aula->id_agendamento; ?>" value="1" />
                                                            <label>Simpatia</label>
                                                            <?php for ($i = 1; $i < 6; $i++): ?> <i data-toggle="tooltip" title="<?php echo $a[$i]; ?>" id="sim_<?php echo $i ?>" name="simpatia" class="icon-star <?php echo ($i == 1) ? 'text-info' : ''; ?>" style="font-size: 18pt;"></i>&nbsp;&nbsp; <?php endfor; ?>
                                                            <input type="hidden" name="cSim" id="cSim_<?php echo $aula->id_agendamento; ?>" value="1" />
                                                        </div>
                                                        <div class="span5 pull-right" style="margin-right: 4%;">
                                                            <input type="hidden" name="id_professor" value="<?php echo $aula->id_professor; ?>" />
                                                            <label for="cCom_<?php echo $aula->id_agendamento; ?>">Comentário</label>
                                                            <textarea name="cCom" id="cCom_<?php echo $aula->id_agendamento; ?>" required rows="6"></textarea>
                                                            <input type="hidden" name="id_aula" value="<?php echo $aula->id_agendamento; ?>" />
                                                            <input type="submit" value="Enviar Avaliação" name="enviar-avaliacao" class="btn btn-mini btn-info offset10" />
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                                <div class="pull-right span6" id="remarcar_<?php echo $aula->id_agendamento; ?>" style="display: none;">
                                                    <form class="form-control" action="../app/remarcarAula.php" method="post">
                                                        <input type="hidden" name="id_aula" value="<?php echo $aula->id_agendamento; ?>" />
                                                        <div class="pull-right span6">
                                                            <label for="nova-hora">Nova Hora e Duração da aula<span class="text-error">*</span></label>
                                                            <input type="time" name="nova-hora" id="nova-hora" class="span6" required />
                                                            <select class="span6" name="nova-duracao">
                                                                <option>1:00</option>
                                                                <option>1:30</option>
                                                                <option>2:00</option>
                                                                <option>2:30</option>
                                                                <option>3:00</option>
                                                            </select>
                                                        </div>
                                                        <label for="nova-data">Nova data<span class="text-error">*</span></label>
                                                        <input type="text" name="nova-data" id="nova-data" class="span6" required />
                                                        <label for="motivo">Motivo<span class="text-error">*</span></label>
                                                        <textarea class="span12" id="motivo" name="motivo" required rows="3"></textarea>
                                                        <input type="submit" name="remarcar-aula" class="btn btn-info pull-right" value="Remarcar aula" />
                                                    </form>
                                                </div>

                                                <div class="pull-right span6" id="cancelar_<?php echo $aula->id_agendamento; ?>" style="display: none;">
                                                    <form class="form-control" action="../app/cancelarAula.php" method="post">
                                                        <input type="hidden" name="id_aula" value="<?php echo $aula->id_agendamento; ?>" />
                                                        <div class="span11">
                                                            <label for="motivo">Motivo do cancelamento<span class="text-error">*</span></label>
                                                            <textarea name="motivo" id="motivo" class="span12" rows="6" required ></textarea>
                                                            <input type="submit" name="cancelar-aula" class="btn btn-info pull-right" value="Cancelar aula" />
                                                        </div>
                                                    </form>
                                                
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <h3 class="text-error">Você ainda não tem nenhuma aula marcada.</h3>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="tab-pane fade" id="por-aluno">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim conteúdo principal -->

            <!-- Início rodapé -->
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
    <script src="../../../resources/scripts/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>
    <script src="../js/chat-ajax.js" type="text/javascript"></script>
    <script src="../js/notificacoes.js" type="text/javascript"></script>
    <script src="../js/aula.js" type="text/javascript"></script>

    <script src="../../../resources/scripts/app.min.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/dashboard2.js" type="text/javascript"></script>
    <script src="../../../resources/scripts/demo.js" type="text/javascript"></script>

</html>
