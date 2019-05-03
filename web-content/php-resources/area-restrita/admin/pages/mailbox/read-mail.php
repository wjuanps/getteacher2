<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['usuario'])) {
    require_once '../../../../factory/conexao.php';
    require_once '../../../../dao/selecionar.php';
    require_once '../../../../dao/atualizar.php';
    
    $totalMensagens = Conection::connect()->query("SELECT * FROM `sugestoes` WHERE `status` = '0'");
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $mensagem = (int) (strip_tags(trim(filter_input(INPUT_GET, 'mensagem', FILTER_SANITIZE_NUMBER_INT))));
        
        $getMensagem = select("sugestoes", "*", "WHERE id_sugestao = '$mensagem'");

        /** @var TYPE_NAME $getMensagem */
        if ($getMensagem) {
            foreach ($getMensagem as $m) {
                if ($m->status == 0) {
                    update("status", "1", "sugestoes", "WHERE id_sugestao = $m->id_sugestao");
                }
            }
        }
        
    }
    
} else {
    header("Location: ../../../../../../");
}
    
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GetTeacher | Ler Mensagem</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <link rel="shortcut icon" href="../../../../../../icone.bmp" />
        
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../../../../resources/scripts/fontawesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../../plugins/ionicons-2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../../../../resources/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../../../../../resources/css/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../../plugins/iCheck/flat/blue.css">

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="../../" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>G</b>T</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>GET</b>TEACHER</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Menu de navegação</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../../../aluno/imagens/perfil/avatar.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Juan Soares</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../../../aluno/imagens/perfil/avatar.png" class="img-circle" alt="User Image">
                                        <p>
                                            Juan Soares - Web Developer
                                            <small>Membro desde Fev. 2016</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="../../../app/logout.php" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="ion ion-ios-cog-outline"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../../../aluno/imagens/perfil/avatar.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Juan Soares</p>
                            <a href=""><i class="fa icon-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="ion ion-ios-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">NAVEGAÇÃO PRINCIPAL</li>
                        <li class="active treeview">
                            <a href="../../">
                                <i class="ion ion-ios-speedometer-outline"></i> <span>Home</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="../tables/dados.php">
                                <i class="ion ion-ios-paper-outline"></i> <span>Cadastros</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailbox.php">
                                <i class="ion ion-ios-email-outline"></i> <span>Email</span>
                                <small class="label pull-right bg-yellow"><?php echo $totalMensagens->rowCount(); ?></small>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="mailbox.php">Caixa de Entrada <span class="label label-primary pull-right"><?php echo $totalMensagens->rowCount(); ?></span></a></li>
                                <li><a href="compose.php">Escrever</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Visualizar Mensagem
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Caixa de mensagens</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Escrever</a>
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Pastas</h3>
                                    <div class="box-tools">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa icon-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="mailbox.php"><i class="fa icon-inbox"></i> Caixa de Entrada <span class="label label-primary pull-right"><?php echo $totalMensagens->rowCount(); ?></span></a></li>
                                        <li><a href="#"><i class="fa icon-envelope"></i> Enviadas</a></li>
                                        <li><a href="#"><i class="fa icon-file"></i> Drafts</a></li>
                                        <li><a href="#"><i class="fa icon-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li>
                                        <li><a href="#"><i class="fa icon-trash"></i> Lixeira</a></li>
                                    </ul>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
                        </div><!-- /.col -->
                        
                        <?php
                            if ($getMensagem):
                                
                                $proximo = $anterior = $mensagem;
                                
                                do {
                                    $anterior--;
                                    $getAnterior = select("sugestoes", "id_sugestao AS id_anterior", "WHERE id_sugestao = '$anterior'");
                                } while(!$getAnterior && $anterior > 0);
                                
                                $getMaior = select("sugestoes", "MAX(id_sugestao) AS maior");
                                if ($getMaior) {
                                    foreach ($getMaior as $m) {
                                        $maior = (int) $m->maior;
                                    }
                                }
                                
                                do {
                                    $proximo++;
                                    $getProximo = select("sugestoes", "*", "WHERE id_sugestao = $proximo");
                                } while(!$getProximo && $proximo <= $maior);
                                
                                
                                foreach ($getMensagem as $mensagem):
                                
                                    if ($mensagem->id_usuario == 0) {
                                        $email = $mensagem->email;
                                    } else {
                                        if ($mensagem->tipo_usuario == "Professor") {
                                            $get = select("professor p INNER JOIN usuarios u", "u.email AS email", "WHERE u.id_professor = p.id_professor AND p.id_professor = $mensagem->id_usuario");
                                        } else if ($mensagem->tipo_usuario == "Aluno") {
                                            $get = select("aluno", "email AS email", "WHERE id_aluno = $mensagem->id_usuario");
                                        }
                                        if ($get) {
                                            foreach ($get as $e) {
                                                $email = $e->email;
                                            }
                                        }
                                    }
                                    
                                    $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
                                    $data = explode("/", date("d/m/Y", strtotime($mensagem->data)));
                                    $hora = date("h:i", strtotime($mensagem->data));
                                    
                                    $am_pm = (date("H", strtotime($mensagem->data)) <= 12) ? "AM" : "PM"; 
                                
                                    ?>

                                    <div class="col-md-9">
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Visualizar Mensagem</h3>
                                                <div class="box-tools pull-right">
                                                    <a href="read-mail.php?mensagem=<?php echo $anterior; ?>" class="btn btn-box-tool <?php echo ($anterior > 0) ? "" : "disabled"; ?>" data-toggle="tooltip" title="Anterior"><i class="fa icon-chevron-left"></i></a>
                                                    <a href="read-mail.php?mensagem=<?php echo $proximo; ?>" class="btn btn-box-tool <?php echo ($proximo <= $maior) ? "" : "disabled"; ?>" data-toggle="tooltip" title="Próxima"><i class="fa icon-chevron-right"></i></a>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body no-padding">
                                                <div class="mailbox-read-info">
                                                    <h3><?php echo utf8_encode($mensagem->assunto); ?></h3>
                                                    <h5>De: <?php echo $email; ?> <span class="mailbox-read-time pull-right"><?php echo $data[0]." ".$meses[(int)$data[1]-1].". ".$data[2]." ".$hora." ".$am_pm; ?></span></h5>
                                                </div><!-- /.mailbox-read-info -->
                                                <div class="mailbox-controls with-border text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-default btn-sm" name="apagar" id="btn_<?php echo $mensagem->id_sugestao; ?>" data-toggle="tooltip" title="Apagar"><i class="fa icon-trash"></i></button>
                                                        <a href="read-mail.php?mensagem=<?php echo $anterior; ?>" class="btn btn-default btn-sm <?php echo ($anterior > 0) ? "" : "disabled"; ?>" data-toggle="tooltip" title="Anterior"><i class="fa icon-reply"></i></a>
                                                        <a href="read-mail.php?mensagem=<?php echo $proximo; ?>" class="btn btn-default btn-sm <?php echo ($proximo <= $maior) ? "" : "disabled"; ?>" data-toggle="tooltip" title="Próximo"><i class="fa icon-share-alt"></i></a>
                                                    </div><!-- /.btn-group -->
                                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Imprimir"><i class="fa icon-print"></i></button>
                                                </div><!-- /.mailbox-controls -->
                                                <div class="mailbox-read-message">
                                                    <p style="border: none; background-color: #fff; font-family: sans-serif; white-space: pre-line;">
                                                        <?php echo utf8_encode($mensagem->mensagem); ?>
                                                    </p>
                                                </div><!-- /.mailbox-read-message -->
                                            </div><!-- /.box-body -->
                                            <div class="box-footer">
                                                <div class="pull-right">
                                                    <a href="read-mail.php?mensagem=<?php echo $anterior; ?>" class="btn btn-default <?php echo ($anterior > 0) ? "" : "disabled"; ?>"><i class="fa icon-reply"></i> Anterior</a>
                                                    <a href="read-mail.php?mensagem=<?php echo $proximo; ?>" class="btn btn-default <?php echo ($proximo <= $maior) ? "" : "disabled"; ?>"><i class="fa icon-share-alt"></i> Próximo</a>
                                                </div>
                                                <button class="btn btn-default" name="apagar" id="btn_<?php echo $mensagem->id_sugestao; ?>"><i class="fa icon-trash"></i> Apagar</button>
                                                <button class="btn btn-default"><i class="fa icon-print"></i> Imprimir</button>
                                            </div><!-- /.box-footer -->
                                        </div><!-- /. box -->
                                    </div><!-- /.col -->
                        
                                    <?php
                                endforeach;
                            endif;
                        ?>
                        
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.0
                </div>
                <strong>Copyright &copy; 2016-2017 <a href="../../">GetTeacher</a>.</strong> Todos os direitos reservados.
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                    </div><!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>
                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Some information about this general settings option
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Other sets of options are available
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div><!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div><!-- /.form-group -->
                        </form>
                    </div><!-- /.tab-pane -->
                </div>
            </aside><!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="../../../../../resources/scripts/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../../plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../../../../resources/scripts/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../../../../resources/scripts/demo.js"></script>
        
        <script src="../../js/email.js"></script>
    </body>
</html>
