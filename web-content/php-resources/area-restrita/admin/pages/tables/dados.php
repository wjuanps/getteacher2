<!DOCTYPE html>
<?php 
session_start();

if (isset($_SESSION['usuario'])) {
    require_once '../../../../factory/conexao.php';
    require_once '../../../../dao/selecionar.php';
    require_once '../../../../util/limitadordeCaracteres.php';
    require_once '../../../app/avaliacoes.php';

    $totalMensagens = Conection::connect()->query("SELECT * FROM `sugestoes` WHERE `status` = '0'");
    $getAluno = select("aluno a INNER JOIN usuarios u", "*", "WHERE u.id_aluno = a.id_aluno AND a.id_aluno != 0");
    $getProfessor = select("professor p INNER JOIN usuarios u", "*", "WHERE p.id_professor = u.id_professor");
    $getArtigos = select("blog b INNER JOIN professor p", "*", "WHERE b.id_professor = p.id_professor");
    $getForum = select("forum f INNER JOIN aluno a", "f.id_duvida, f.id_aluno_forum, f.assunto, f.duvida, f.nome, f.email AS email, f.data, a.nome_aluno, a.email AS email_aluno", "WHERE f.id_aluno_forum = a.id_aluno");
    $getAulas = select("agendamento ag, aluno a, professor p", "ag.id_agendamento, ag.data, ag.status, ag.duracao, a.nome_aluno, p.nome_professor", "WHERE a.id_aluno = ag.id_aluno AND p.id_professor = ag.id_professor");
} else {
    header("Location: ../../../../../../");
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GetTeacher | Cadastros</title>
    
    <link rel="shortcut icon" href="../../../../../../icone.bmp" />

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../../../resources/scripts/fontawesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../plugins/ionicons-2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../../../resources/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../../../resources/css/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                                    <small>Membro desde 2016</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="../../../app/logOut.php" class="btn btn-default btn-flat">Sair</a>
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
                  <li class="treeview">
                      <a href="../../">
                          <i class="ion ion-ios-speedometer-outline"></i> <span>Home</span>
                      </a>
                  </li>
                  <li class="active treeview">
                      <a href="">
                        <i class="ion ion-ios-paper-outline"></i> <span>Cadastros</span>
                      </a>
                  </li>
                  <li>
                      <a href="pages/mailbox/mailbox.php">
                          <i class="ion ion-ios-email-outline"></i> <span>Email</span>
                          <small class="label pull-right bg-yellow"><?php echo $totalMensagens->rowCount(); ?></small>
                      </a>
                      <ul class="treeview-menu">
                          <li class="active"><a href="../mailbox/mailbox.php">Caixa de Entrada <span class="label label-primary pull-right"><?php echo $totalMensagens->rowCount(); ?></span></a></li>
                          <li><a href="../mailbox/compose.php">Escrever</a></li>
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
            Controle de Cadastros
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa icon-dashboard"></i> Home</a></li>
            <li class="active">Cadastros</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box" id="aluno">
                <div class="box-header">
                  <h3 class="box-title"><b>Alunos cadastrados no sistema</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped tabela">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Total de aulas</th>
                        <th>Média das avaliações</th>
                        <th>Perguntas</th>
                        <th>Mensagem / Excluir</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                        if($getAluno):
                          
                          foreach ($getAluno as $aluno):
                            $a = array("Sem avaliações", "Péssimo", "Ruim", "Regular", "Bom", "Excelente"); 
                            $totalAulasAluno = Conection::connect()->query("SELECT * FROM agendamento WHERE id_aluno = '$aluno->id_aluno'");
                            $totalperguntas = Conection::connect()->query("SELECT * FROM forum WHERE id_aluno_forum = '$aluno->id_aluno'");
                            
                            ?>
                            <tr>
                              <td><?= utf8_encode($aluno->nome_aluno); ?></td>
                              <td><?= $aluno->email; ?></td>
                              <td style="text-align: center;"><?= $totalAulasAluno->rowCount(); ?></td>
                              <td style="text-align: center;"><?= $a[(mediaAvaliacoesFeitas($aluno->id_aluno)) ? mediaAvaliacoesFeitas($aluno->id_aluno) : 0]; ?></td>
                              <td style="text-align: center;"><?= $totalperguntas->rowCount(); ?></td>
                              <td>
                                  <a href="../mailbox/compose.php?email=<?= $aluno->email; ?>" data-toggle="tooltip" title="Enviar mensagem para <?= utf8_encode($aluno->nome_aluno); ?>">Mensagem</a> -
                                  <a href="../../util/request.php?acao=excluir-aluno&id-aluno=<?= $aluno->id_aluno; ?>" data-toggle="tooltip" title="Deseja realmente excluir <?= utf8_encode($aluno->nome_aluno); ?>?">
                                      <span class="text-red"><i class="fa icon-remove"></i> Excluir</span>
                                  </a>
                              </td>
                            </tr>
                            <?php 
                          endforeach;
                          
                        endif;
                      ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Total de aulas</th>
                        <th>Média das avaliações</th>
                        <th>Perguntas</th>
                        <th>Mensagem / Excluir</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box" id="professor">
                <div class="box-header">
                  <h3 class="box-title"><b>Professores cadastrados no sistema</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped tabela">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Especialidade</th>
                        <th>Tipo Aula</th>
                        <th>Avaliação</th>
                        <th>Diploma</th>
                        <th>Mensagem - Excluir</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php 
                        if($getProfessor):
                          foreach ($getProfessor as $professor):
                            $a = array("Sem avaliação", "Péssimo", "Ruim", "Regular", "Bom", "Excelente");
                        
                            $totalAvaliacoes = Conection::connect()->query("SELECT * FROM avaliacoes WHERE id_professor = $professor->id_professor")->rowCount();
                            
                            $avaliacao = $a[0];
                            if ($totalAvaliacoes > 0) {
                                $avaliacao = $a[$professor->avaliacao];
                            }
                        
                            ?>
                            <tr>
                                <td><a href="../../../../domain/perfil-professor.php?professor=<?php echo $professor->id_professor; ?>#banner" data-toggle="tooltip" title="Visualizar perfil de <?php echo utf8_encode($professor->nome_professor); ?>"><?php echo utf8_encode($professor->nome_professor); ?></a></td>
                                <td><?= utf8_encode($professor->cidade); ?></td>
                                <td><?= $professor->estado; ?></td>
                                <td><?= utf8_encode($professor->especialidade); ?></td>
                                <td><?= utf8_encode($professor->tipo_aula); ?></td>
                                <td><?= $avaliacao; ?></td>
                                <td style="text-align: center;"><a href="../../../professor/imagens/diploma/<?= $professor->diploma; ?>" target="_blank" data-toggle="tooltip" title="Visualizar diploma de <?= utf8_encode($professor->nome_professor); ?>"><i style="font-size: 20pt;" class="ion ion-share"></i></a></td>
                                <td><a href="../mailbox/compose.php?email=<?= $professor->email; ?>" data-toggle="tooltip" title="Enviar mensagem para <?= utf8_encode($professor->nome_professor); ?>">Mensagem</a> - <a href="../../util/request.php?acao=excluir-professor&id_professor=<?= $professor->id_professor; ?>" data-toggle="tooltip" title="Deseja excluir <?= utf8_encode($professor->nome_professor); ?>?"><span class="text-red"><i class="fa icon-remove"></i> Excluir</span></a></td>
                            </tr>
                            <?php 
                          endforeach;
                        endif;
                      ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Especialidade</th>
                        <th>Tipo Aula</th>
                        <th>Avaliação</th>
                        <th>Diploma</th>
                        <th>Mensagem - Excluir</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box" id="artigos">
                <div class="box-header">
                  <h3 class="box-title"><b>Artigos publicados</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped tabela">
                    <thead>
                      <tr>
                        <th>Professor</th>
                        <th>Título</th>
                        <th>Texto</th>
                        <th>Data</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>A/R</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                        if($getArtigos):
                          foreach ($getArtigos as $artigo):
                            ?>
                            <tr>
                              <td><?= utf8_encode($artigo->nome_professor); ?></td>
                              <td>
                                  <a href="../../../../domain/artigo-professor.php?id_post=<?php echo $artigo->id_blog."&id_professor=".$artigo->id_professor."&a=admin"; ?>"
                                     data-toggle="tooltip" title="Visualizar este artigo">
                                      <?php echo utf8_encode($artigo->titulo); ?>
                                  </a>
                              </td>
                              <td><?= utf8_encode(limitarCaracteres($artigo->texto, 40))."..."; ?></td>
                              <td><?= date("d/m/Y H:i", strtotime($artigo->data)); ?></td>
                              <td><?php echo utf8_encode($artigo->categoria); ?></td>
                              <td>
                                <?php if ($artigo->status == 0) { ?>
                                    <p class="label label-primary" data-toggle="tooltip" title="Aguardando aprovação" style="font-size: 9pt;">Aguardando</p>
                                <?php } else if ($artigo->status == 1) { ?>
                                    <p class="label label-success" data-toggle="tooltip" title="Artigo aprovado" style="font-size: 9pt;">Aprovado</p>
                                <?php } else if ($artigo->status == 2) { ?>
                                    <p class="label label-danger" data-toggle="tooltip" title="Artigo reprovado" style="font-size: 9pt;">Reprovado</p>
                                <?php } ?>
                              </td>
                              <td>
                                <?php if ($artigo->status != 1): ?>
                                    <a class="text-green" href="../../util/request.php?acao=aprovar&artigo=<?php echo $artigo->id_blog; ?>" 
                                       data-toggle="tooltip" title="Aprovar este Artigo?">
                                        <i style="font-size: 15pt;" class="ion ion-checkmark-circled"></i>
                                    </a>/
                                <?php endif; ?>
                                    <a class="text-red" href="../../util/request.php?acao=reprovar&artigo=<?php echo $artigo->id_blog; ?>" 
                                       data-toggle="tooltip" title="<?php echo ($artigo->status != 2) ? "Reprovar" : "Excluir"; ?> este Artigo">
                                        <i style="font-size: 15pt;" class="ion ion-close-circled"></i>
                                    </a>
                              </td>
                            </tr>
                            <?php 
                          endforeach;
                        endif;
                      ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Professor</th>
                        <th>Título</th>
                        <th>Texto</th>
                        <th>Data</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>A/R</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box" id="forum">
                <div class="box-header">
                  <h3 class="box-title"><b>Forum</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped tabela">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Assunto</th>
                        <th>Duvida</th>
                        <th>Data</th>
                        <th>Total respostas</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                        if($getForum):
                          foreach ($getForum as $forum):

                            if ($forum->id_aluno_forum == 0) {
                              $nome = $forum->nome;
                              $email = $forum->email;
                            } else {
                              $nome = $forum->nome_aluno;
                              $email = $forum->email_aluno;
                            }

                            ?>
                            <tr>
                              <td><?= utf8_encode($nome); ?></td>
                              <td><?= $email; ?></td>
                              <td><a href="../../../../domain/forum.php?forum=<?= utf8_encode($forum->assunto); ?>#hr" data-toggle="tooltip" title="Pesquisar sobre <?= utf8_encode($forum->assunto); ?>"><?= utf8_encode($forum->assunto); ?></a></td>
                              <td><a href="../../../../domain/forum.php?forum=<?= utf8_encode($forum->duvida)."#hr".$forum->id_duvida; ?>" data-toggle="tooltip" title="Visualizar esta pergunta"><?= utf8_encode($forum->duvida); ?></a></td>
                              <td><?= date("d/m/Y H:i", strtotime($forum->data)); ?></td>
                              <td>
                                <?php $totlRespostas = Conection::connect()->query("SELECT * FROM resposta_forum WHERE id_duvida = $forum->id_duvida") ?>
                                <?= $totlRespostas->rowCount(); ?>
                              </td>
                            </tr>
                            <?php 
                          endforeach;
                        endif;
                      ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Assunto</th>
                        <th>Duvida</th>
                        <th>Data</th>
                        <th>Total respostas</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box" id="aulas">
                <div class="box-header">
                  <h3 class="box-title"><b>Aulas Marcadas</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped tabela">
                    <thead>
                      <tr>
                        <th>Nome Professor</th>
                        <th>Nome Aluno</th>
                        <th>Data</th>
                        <th>Duração</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                        if($getAulas):
                          foreach ($getAulas as $aula):
                            ?>
                            <tr>
                              <td><?= utf8_encode($aula->nome_professor); ?></td>
                              <td><?= utf8_encode($aula->nome_aluno); ?></td>
                              <td><?= date("d/m/Y H:i", strtotime($aula->data)); ?></td>
                              <td><?= utf8_encode($aula->duracao); ?></td>
                              <td style="text-align: center;">
                                <?php if ($aula->status == 0) { ?>
                                    <span class="label label-primary" data-toggle="tooltip" title="Aguardando aprovação do professor" style="font-size: 8pt;">Aguardando</span>
                                <?php } else if ($aula->status == 1) { ?>    
                                    <span class="label label-success" data-toggle="tooltip" title="Aula agendada para o dia <?= date("d/m/y", strtotime($aula->data)); ?>" style="font-size: 8pt;">Agendada</span>
                                <?php } else if ($aula->status == 2) { ?> 
                                    <span class="label label-danger" data-toggle="tooltip" title="Aula cancelada" style="font-size: 8pt;">Cancelada</span>
                                <?php } else if ($aula->status == 3) { ?> 
                                    <?php 
                                        $a = array(1 => "Péssimo", 2 => "Ruim", 3 => "Regular", 4 => "Bom", 5 => "Excelente"); 
                                        $getAvaliacoes = select("avaliacoes", "ROUND((AVG(didatica) + AVG(conhecimento) + AVG(simpatia)) / 3) AS media", "WHERE id_aula = '$aula->id_agendamento'");
                                        if ($getAvaliacoes) {
                                            foreach ($getAvaliacoes as $media) {
                                                $avaliacao = $media->media;
                                            }
                                        }
                                    ?>
                                    <span class="label bg-gray" data-toggle="tooltip" title="Aula avaliada como: <?= $a[$avaliacao]; ?>" style="font-size: 9pt;">Avaliada</span>
                                <?php } else if ($aula->status == 4) { ?> 
                                    <span class="label bg-blue-gradient" data-toggle="tooltip" title="Aula remarcada para o dia <?= date("d/m/y", strtotime($aula->data)); ?>" style="font-size: 8pt;">Remarcada</span>
                                <?php } ?>
                              </td>
                            </tr>
                            <?php 
                          endforeach;
                        endif;
                      ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nome Professor</th>
                        <th>Nome Aluno</th>
                        <th>Data</th>
                        <th>Duração</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versão</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="../../">GetTeacher</a>.</strong> Todos os direitos reservados.
      </footer>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../../../../resources/scripts/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../../../resources/scripts/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../../../resources/scripts/demo.js"></script>
    <!-- page script -->
    <script >
      $('.tabela').DataTable( {
        "language": {
            "lengthMenu": "Exibir _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "Mostrando página _PAGE_ de _PAGES_ - total de registros _MAX_",
            "infoEmpty": "Não existem dados para essa busca",
            "infoFiltered": "(filtrado a partir de _MAX_ registros totais)",
            "search": "Procurar",
            "next": "Próximo"
        }
      });
    </script>
    
  </body>
</html>
