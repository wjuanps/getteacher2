<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['usuario'])) {
    require_once '../../factory/conexao.php';
    require_once '../../dao/selecionar.php';
    
    $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
    
    $totalMensagens = Conection::connect()->query("SELECT * FROM `sugestoes` WHERE `status` = '0'");
    $totalUsuarios = Conection::connect()->query("SELECT * FROM `usuarios`");
    $totalArtigos = Conection::connect()->query("SELECT * FROM `blog`");
    $totalPerguntas = Conection::connect()->query("SELECT * FROM `forum`");
    $totalAulas = Conection::connect()->query("SELECT * FROM `agendamento`");
    $totalAvaliacoes = Conection::connect()->query("SELECT * FROM `avaliacoes`");
    
    $totalNovosProfessores = Conection::connect()->query("SELECT * FROM professor WHERE CURRENT_DATE = DATE(professor.data_cadastro)");
    $totalNovosAlunos = Conection::connect()->query("SELECT * FROM aluno WHERE CURRENT_DATE = DATE(aluno.data_cadastro)");
    
    $totalNovosUsuarios = ($totalNovosProfessores->rowCount() + $totalNovosAlunos->rowCount());
    
    $getProfessor = select("professor", "*", NULL, "ORDER BY data_cadastro DESC", "LIMIT 4");
    $getAluno = select("aluno", "*", "WHERE id_aluno != 0", "ORDER BY data_cadastro DESC", "LIMIT 4");
} else {
  header("Location:../../../../");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GetTeacher | Admin</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="shortcut icon" href="../../../../icone.bmp" />

        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../../resources/scripts/fontawesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="plugins/ionicons-2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../../resources/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../../../resources/css/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
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
                                    <img src="../aluno/imagens/perfil/avatar.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Juan Soares</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../aluno/imagens/perfil/avatar.png" class="img-circle" alt="User Image">
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
                                            <a href="../app/logout.php" class="btn btn-default btn-flat">Sair</a>
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
                            <img src="../aluno/imagens/perfil/avatar.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Juan Soares</p>
                            <a href="#"><i class="fa icon-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
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
                            <a href="">
                                <i class="fa icon-dashboard"></i> <span>Home</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="pages/tables/dados.php">
                              <i class="ion ion-ios-paper-outline"></i> <span>Cadastros</span>
                            </a>
                        </li>
                        <li>
                            <a href="pages/mailbox/mailbox.php">
                                <i class="ion ion-ios-email-outline"></i> <span>Email</span>
                                <small class="label pull-right bg-yellow"><?php echo $totalMensagens->rowCount(); ?></small>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="pages/mailbox/mailbox.php">Caixa de Entrada <span class="label label-primary pull-right"><?php echo $totalMensagens->rowCount(); ?></span></a></li>
                                <li><a href="pages/mailbox/compose.php">Escrever</a></li>
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
                        Dashboard
                        <small>Painel de Controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="ion-ios-speedometer"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?php echo $totalNovosUsuarios; ?></h3>
                                    <p>Novos Usuários</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo $totalMensagens->rowCount(); ?><sup style="font-size: 20px"></sup></h3>
                                    <p>Novas Mensagens</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-email-outline"></i>
                                </div>
                                <a href="pages/mailbox/mailbox.php" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?php echo $totalUsuarios->rowCount(); ?></h3>
                                    <p>Usuários Registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-stalker"></i>
                                </div>
                                <a href="#" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3><?php include_once '../../../../cont.txt'; ?></h3>
                                    <p>Visitantes</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3><?php echo $totalArtigos->rowCount(); ?></h3>
                                    <p>Artigos publicados</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-compose"></i>
                                </div>
                                <a href="pages/tables/dados.php#artigos" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo $totalPerguntas->rowCount(); ?></h3>
                                    <p>Perguntas</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-chat"></i>
                                </div>
                                <a href="pages/tables/dados.php#forum" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo $totalAulas->rowCount(); ?></h3>
                                    <p>Aulas Marcadas</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-university"></i>
                                </div>
                                <a href="pages/tables/dados.php#aulas" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo $totalAvaliacoes->rowCount(); ?></h3>
                                    <p>Avaliações</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clipboard"></i>
                                </div>
                                <a href="#" class="small-box-footer">Mais Informações <i class="ion ion-arrow-right-c"></i></a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Últimos Professores</h3>
                                    <div class="box-tools pull-right">
                                        <span class="label label-primary"><?php echo count($getProfessor); ?> Novos Membros</span>
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa icon-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa icon-remove"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">

                                        <?php 
                                            if ($getProfessor):
                                                foreach ($getProfessor as $professor):
                                                    $data = explode("/", date("d/m", strtotime($professor->data_cadastro)));
                                                    ?>
                                                    <li>
                                                        <img src="../professor/imagens/perfil/<?php echo $professor->foto_perfil; ?>" alt="User Image" style="width: 100px; height: 100px;">
                                                        <a class="users-list-name" href="../../domain/perfil-professor.php?professor=<?php echo $professor->id_professor; ?>#banner"><?php echo utf8_encode($professor->nome_professor); ?></a>
                                                        <span class="users-list-date"><?php echo $data[0]." ".$meses[(int)$data[1]-1]; ?></span>
                                                    </li>
                                                    <?php
                                                endforeach;
                                            endif;
                                        ?>
                                                    
                                    </ul><!-- /.users-list -->
                                </div><!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="pages/tables/dados.php#professor" class="uppercase">Ver todos os professores</a>
                                </div><!-- /.box-footer -->
                            </div><!--/.box -->
                        </div><!-- /.col -->

                        <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Últimos Alunos</h3>
                                    <div class="box-tools pull-right">
                                        <span class="label label-primary"><?php echo count($getAluno); ?> Novos Membros</span>
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa icon-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa icon-remove"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        
                                        <?php  
                                            if ($getAluno):
                                                foreach ($getAluno as $aluno):
                                                    $data = explode("/", date("d/m", strtotime($aluno->data_cadastro)));
                                                    ?>
                                                    <li>
                                                        <img src="../aluno/imagens/perfil/<?php echo $aluno->foto_perfil; ?>" alt="User Image" style="width: 100px; height: 100px;">
                                                        <a class="users-list-name" href="#"><?php echo utf8_encode($aluno->nome_aluno); ?></a>
                                                        <span class="users-list-date"><?php echo $data[0]." ".$meses[(int)$data[1]-1] ?></span>
                                                    </li>
                                                    <?php
                                                endforeach;
                                            endif;
                                        ?>
                                        
                                    </ul><!-- /.users-list -->
                                </div><!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="pages/tables/dados.php#aluno" class="uppercase">Ver todos os alunos</a>
                                </div><!-- /.box-footer -->
                            </div><!--/.box -->
                        </div><!-- /.col -->
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.0
                </div>
                <strong>Copyright &copy; 2016-2017 <a href="">GETTEACHER</a>.</strong> Todos os direitos reservados.
            </footer>


            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="../../../resources/scripts/jQuery-2.1.4.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
      
        <!-- AdminLTE App -->
        <script src="../../../resources/scripts/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../../../resources/scripts/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../../resources/scripts/demo.js"></script>
    </body>
</html>
