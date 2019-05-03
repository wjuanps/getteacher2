<!DOCTYPE HTML>
<?php
session_start();

$_SESSION['pagina_atual'] = $_SERVER['REQUEST_URI'];

require_once '../php-resources/factory/conexao.php';
require_once '../php-resources/dao/selecionar.php';
require_once '../php-resources/util/selecionarUsuario.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>GetTeacher - Central de Ajuda</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Html5TemplatesDreamweaver.com">

        <link rel="shortcut icon" href="../../icone.bmp" />

        <link href="../resources/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../resources/templates/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <!-- Icons -->
        <link href="../resources/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
        <link href="../resources/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" href="../resources/scripts/fontawesome/css/font-awesome.min.css">

        <link href="../../styles/custom.css" rel="stylesheet" type="text/css" />
        <link href="../resources/css/styles-custom.css" rel="stylesheet" type="text/css">
    </head>
    <body id="pageBody">

        <div id="divBoxed" class="container">

            <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

            <div class="divPanel notop nobottom">
                <div class="row-fluid">
                    <div class="span12">

                        <div id="divLogo" class="pull-left">
                            <a href="../../" id="divSiteTitle">GetTeacher</a><br />
                            <a href="../../" id="divTagLine">Seu Professor Online</a>
                        </div>

                        <div id="divMenuRight" class="pull-right">
                            <div class="navbar">
                                <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                                    Menu <span class="icon-chevron-down icon-white"></span>
                                </button>
                                <div class="nav-collapse collapse">
                                    <ul class="nav nav-pills ddmenu">
                                        <li class=""><a href="../../">Home</a></li>
                                        <li><a href="sobre.php">Sobre</a></li>
                                        <li class="dropdown">
                                            <a href="" class="dropdown-toggle">Nossas Áreas<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Idiomas">Idiomas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Exatas">Exatas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Humanas">Humanas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Artes">Artes</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Música">Música</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Linguagens">Linguagens</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Biológicas">Biológicas</a></li>
                                                <li><a href="../php-resources/domain/listar-professores.php?area=Meio Ambiente">Meio Ambiente</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../php-resources/domain/blog-dos-professores.php">Blog</a></li>
                                        <li><a href="contato.php">Contatos</a></li>
                                        <?php if (isset($_SESSION['usuario'])): ?>
                                            <li class="dropdown">
                                                <a href="" dropdown-toggle><?php echo selecionarUsuario(); ?><b class="caret"></b></a>
                                                <?php if ($_SESSION['tipo_usuario'] != "Admin"): ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../php-resources/area-restrita/chat/conversas.php">Mensagens</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/aulas.php">Aulas</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/editarPerfil.php">Editar perfil</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/logOut.php">Sair</a></li>
                                                    </ul>
                                                <?php else: ?>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../php-resources/area-restrita/admin/pages/mailbox/mailbox.php">Caixa de Entrada</a></li>
                                                        <li><a href="../php-resources/area-restrita/admin/pages/tables/dados.php">Cadastros</a></li>
                                                        <li><a href="../php-resources/area-restrita/app/logOut.php">Sair</a></li>
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
                                <form class="form-inline" action="../php-resources/area-restrita/app/login.php" method="post">
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
                                    <a href="cadastro-aluno.php">Criar uma conta GetTeacher?&nbsp;/&nbsp;</a>
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

                <div class="divPanel notop page-content">

                    <div class="breadcrumbs">
                        <a href="../../">Home</a> &nbsp;/&nbsp; <span>Central de Ajuda</span>
                    </div>

                    <div class="row-fluid">

                        <!--Edit Sidebar Content here-->
                        <div class="span3 sidebox">                    
                            <h3>Como funciona o GetTeacher</h3>
                            <p style="text-align: justify;">
                                No GetTeacher você encontra <strong>aulas particulares</strong> de qualquer matéria, contando 
                                com milhares de <strong>professores particulares.</strong>
                            </p>

                            <img src="../../images/aulas-particulares.jpg" class="img-polaroid" alt=""><br /><br /><br /> 
                            <center><span class="btn btn-large">Saiba Mais</span></center>
                        </div>
                        <!--/End Sidebar Content -->                        

                        <!--Edit Main Content Area here-->
                        <div class="span8" id="divMain">
                            <div class="termo-politica">
                                <h1 class="text-info">Central de Ajuda</h1>
                                <hr>    
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_1">
                                            Como faço para avaliar o professor?
                                        </a>
                                    </div>
                                    <div id="duv_1" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Você poderá avaliar um professor após realizar pelo menos uma aula com o ele. O agendamento dessa aula deve ser feita pela plataforma.
                                            Para realizar a avaliação, você precisa preencher um formulário, escrevendo um comentário e dando uma nota (em estrelas) para três critérios: Didática, Conhecimento e Simpatia.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_2">
                                            Agendei um pacote de aulas mas não gostei do professor, o que fazer?
                                        </a>
                                    </div>
                                    <div id="duv_2" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Você pode cancelar as demais aulas na sua página de Aulas. Não esqueça de avisar ao professor sobre a sua decisão.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_3">
                                            Quero trocar a data/hora de uma aula, como proceder?
                                        </a>
                                    </div>
                                    <div id="duv_3" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Recomendamos que você comunique qualquer alteração previamente ao seu Professor. 
                                            Após comunicado, você pode trocar informações relacionado a aula diretamente na página Aulas.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_4">
                                            Quero cancelar uma aula, como proceder?
                                        </a>
                                    </div>
                                    <div id="duv_4" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Recomendamos que você comunique qualquer alteração previamente ao 
                                            seu Professor. Após comunicado, você pode cancelar, adiar e editar suas aulas na página Aulas.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_5">
                                            O que faço se não gostar da aula?
                                        </a>
                                    </div>
                                    <div id="duv_5" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Se o professor não aparecer, aparecer atrasado ou não demonstrar domínio sobre o 
                                            conteúdo divulgado, você pode <a href="contato.php">entrar em contato conosco</a> imediatamente (até 7 dias após a aula).
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_6">
                                            Onde encontro as informações das minhas aulas agendadas?
                                        </a>
                                    </div>
                                    <div id="duv_6" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            O professor é o responsável pelo agendamento da aula. Quando a aula for agendada, 
                                            você será notificado pela plataforma. Além disso, essa informação 
                                            também fica registrada na página Aulas. Basta acessar e procurar a aula com o professor em questão.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_7">
                                            Para que serve o blog do GetTeacher?
                                        </a>
                                    </div>
                                    <div id="duv_7" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            O Blog do GetTeacher é mais uma ferramenta para a troca de conhecimento entre professores 
                                            e alunos no GetTeacher. Cada professor cadastrado é encorajado a criar seu blog na plataforma 
                                            e inserir conteúdo relevante a sua área. Assim você tem a oportunidade de conhecer a 
                                            didática do professor antes da contratação.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_8">
                                            De quem é o conteúdo publicado no blog?
                                        </a>
                                    </div>
                                    <div id="duv_8" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Cada professor tem a opção de criar seu próprio blog dentro do 
                                            GetTeacher. Dessa forma, o conteúdo de cada Blog é responsabilidade do professor que o publicou.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_9">
                                            Posso usar o conteúdo publicado no blog?
                                        </a>
                                    </div>
                                    <div id="duv_9" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            O Blog do GetTeacher é mais uma ferramenta para a troca de conhecimento entre 
                                            professores e alunos no GetTeacher. Cada professor cadastrado é encorajado a 
                                            criar seu blog na plataforma e inserir conteúdo relevante a sua área. 
                                            Assim você tem a oportunidade de conhecer a didática do professor antes 
                                            da contratação. utilizar esse conteúdo, você deve entrar em contato 
                                            com o professor que o produziu.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_10">
                                            Como entrar em contato com o professor que escreveu um artigo no blog?
                                        </a>
                                    </div>
                                    <div id="duv_10" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Para entrar em contato com um professor que escreveu determinado 
                                            artigo, basta clicar no seu nome na assinatura da publicação, 
                                            ou no botão "Ver perfil do Professor", que fica na direta da página 
                                            do blog, e clicar em "solicitar orçamento" na página de perfil do mesmo.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_11">
                                            Um professor pode me encontrar?
                                        </a>
                                    </div>
                                    <div id="duv_11" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Quando você cria uma Solicitação Pública de orçamento, 
                                            deixamos a sua solicitação aberta para que professores 
                                            com o perfil que você procura também te envie orçamento.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_12">
                                            Mandei uma mensagem ou criei uma solicitação para o professor mas ele ainda não me respondeu. O que devo fazer?
                                        </a>
                                    </div>
                                    <div id="duv_12" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Assim que você envia uma mensagem para um professor, o site notifica-o através da 
                                            conta dele na plataforma. Pode ser que o professor tenha visto a
                                            mensagem e que tenha decidido responder mais tarde. Neste caso, você deve aguardar 
                                            a resposta do professor ou entrar em contato com outro. Caso você tenha enviado 
                                            uma solicitação de orçamento e ele ainda não tenha respondido, além de aguardar, 
                                            você pode tornar a solicitação pública. Assim, outros professores poderão se 
                                            candidatar para lhe ajudar. Você pode fazer isso na sua página de Solicitação de Orçamento.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_13">
                                            Estou conversando com um professor pela página de conversa, como agendar uma aula com ele?
                                        </a>
                                    </div>
                                    <div id="duv_13" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Quem agenda a aula é o professor. Se você gostou da proposta e deseja agendar 
                                            uma aula com ele, você deve informa-lo sobre a sua escolha e negociar dia, frequência 
                                            (uma vez por semana, por exemplo), horário, valor, tipo de aula e forma de pagamento,
                                            em seguida enviar uma solicitação de aula.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_14">
                                            Porquê as minhas respostas da minha solicitação chegam na minha conversa?
                                        </a>
                                    </div>
                                    <div id="duv_14" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Enviamos as mensagens para a sua página de conversa 
                                            porque acreditamos que na página de conversa é muito mais fácil para você negociar com o Professor.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_15">
                                            Como solicitar orçamento para professor do GetTeacher?
                                        </a>
                                    </div>
                                    <div id="duv_15" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Existem duas formas de você solicitar orçamento para os professores do GetTeacher: 
                                            enviar diretamente para um professor do seu interesse ou para um conjunto de professores.
                                            No primeiro caso, você encontra um botão "solicitar orçamento" do lado direito do perfil 
                                            do professor selecionado. Basta clicar no botão e preencher o formulário da solicitação.
                                            No segundo caso, você faz uma Solicitação Pública, nesse caso basta você preencher a 
                                            solicitação, e escolher para quais professores deseja enviar a solicitação. Quanto mais 
                                            professores você contatar, mais opções você terá para fazer a sua escolha.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_16">
                                            Posso alterar meu email de login?
                                        </a>
                                    </div>
                                    <div id="duv_16" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Sim. Para alterar seu e-mail, basta acessar o menu de Edição de Perfil, 
                                            em seguida escolha a aba 'Configurações' e depois clique em ‘Alterar e-mail’. 
                                            Informe o seu novo e-mail e clique em ‘Enviar’.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_17">
                                            Como alterar minha senha?
                                        </a>
                                    </div>
                                    <div id="duv_17" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Para alterar sua senha, basta acessar a opção 'Editar perfil' 
                                            (no topo direito da página), clicar na aba ‘Configurações' e em 
                                            seguida em 'Mudar senha'. Digite uma 
                                            senha nova, confirme e clique em ‘Mudar senha’.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_18">
                                            Como trocar minha imagem de perfil?
                                        </a>
                                    </div>
                                    <div id="duv_18" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Para trocar sua imagem de perfil você deve passar o mouse sobre a 
                                            sua foto de perfil, que fica do lado direito no topo do Profes e 
                                            clicar na opção editar Perfil. Nessa página você pode editar todas 
                                            as informações do seu perfil, bem como trocar sua imagem.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_19">
                                            Como excluir meu perfil?
                                        </a>
                                    </div>
                                    <div id="duv_19" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Estamos tristes em vê-lo partir, gostaria de nos informar o que te 
                                            motivou a querer excluir seu perfil no GetTeacher? <a href="contato.php">Entre em contato</a>, 
                                            talvez possamos te ajudar.
                                            Seu feedback será usado para melhorar o nosso serviço.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_20">
                                            Quero me tornar um professor, como faço?
                                        </a>
                                    </div>
                                    <div id="duv_20" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Para se tornar um professor cadastrado no GetTeacher é muito fácil, 
                                            basta acessar a página de <a href="cadastro-professor.php">cadastro de professores</a>.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_21">
                                            Para que serve a avaliação do professor?
                                        </a>
                                    </div>
                                    <div id="duv_21" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Avaliando um professor, você auxilia na tomada de decisão de outros alunos 
                                            (por contratar ou não aquele professor). Além disso, os professores ganham pontos 
                                            quando você o avalia positivamente, o que melhora seu posicionamento no ranking do Profes.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_22">
                                            O forum é de graça?
                                        </a>
                                    </div>
                                    <div id="duv_22" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            A ferramenta é gratuita e pode ser utilizada por todos os alunos cadastrados, ilimitadamente.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_23">
                                            Posso responder as dúvidas que eu sei?
                                        </a>
                                    </div>
                                    <div id="duv_23" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Apenas professores cadastrados no GetTeacher podem responder às perguntas cadastradas pelos alunos.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_24">
                                            Como contratar um professor que me tirou uma dúvida?
                                        </a>
                                    </div>
                                    <div id="duv_24" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Clicando no nome do professor, você será redirecionado ao perfil dele. 
                                            Nesse momento, basta você clicar no botão "Solicitar Orçamento".
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_25">
                                            Para que serve o forum?
                                        </a>
                                    </div>
                                    <div id="duv_25" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            O fórum serve para o aluno tirar pequenas dúvidas e conhecer os Professores do GetTeacher.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_26">
                                            Posso excluir uma avaliação de aluno?
                                        </a>
                                    </div>
                                    <div id="duv_26" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Não é permitido excluir avaliação feita por aluno. Caso o conteúdo 
                                            seja ofensivo ou inverossímil, entre em <a href="contato.php">contato conosco</a>.
                                        </div>
                                    </div>
                                </div>
                                                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_28">
                                            Onde fica meu blog?
                                        </a>
                                    </div>
                                    <div id="duv_28" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Os alunos chegam à lista de publicações a partir do seu perfil, 
                                            que terá um link para o blog assim que a primeira postagem for feita.
                                            De maneira alternativa, os alunos podem acessar seus artigos a partir da 
                                            página do <a href="../php-resources/domain/blog-dos-professores.php">Blog dos Professores</a>, 
                                            onde constam todos os artigos enviados pelos professores do Profes.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_29">
                                            O que fazer quando o aluno deseja me contratar?
                                        </a>
                                    </div>
                                    <div id="duv_29" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Quando você recebe uma solicitação de orçamento na sua página de conversa, 
                                            deve apresentar sua forma de trabalho e responder ao aluno com um orçamento. 
                                            Se o aluno escolher te contratar, você deve agendar a aula no GetTeacher.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_30">
                                            Onde eu configuro o valor médio das minhas aulas no GetTeacher?
                                        </a>
                                    </div>
                                    <div id="duv_30" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Você configura essa e outras informações na sua página de edição de Perfil.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#duv_31">
                                            O que eu ganho respondendo as dúvidas dos alunos?
                                        </a>
                                    </div>
                                    <div id="duv_31" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Respondendo as dúvidas dos alunos você ganha Pontos GetTeacher. Quanto maior a sua pontuação,
                                            melhor é o seu posicionamento no resultado de busca do GetTeacher.
                                        </div>
                                    </div>
                                </div>
                                
                            </div>   
                        </div>

                        <!--/End Main Content Area here-->        
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
                                <li><a href="termos-de-uso.php" title="Terms of Use">Termos de uso</a></li>
                                <li><a href="politicas-privacidade.php" title="Privacy Policy">Políticas de privacidade</a></li>
                                <li><a href="faq.php" title="FAQ">FAQ</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea2">

                            <h3>Alunos</h3>
                            <ul>
                                <li><a href="../php-resources/domain/forum.php">Tira Dúvidas</a></li>
                                <li><a href="">Central de Ajuda</a></li>
                                <li><a href="cadastro-aluno.php">Cadastre-se</a></li>
                            </ul>

                        </div>
                        <div class="span3" id="footerArea3">

                            <h3>Professores</h3>
                            <ul>
                                <li><a href="../pages/cadastro-professor.php">Torne-se um Professor</a></li>
                                <li><a href="">Central de Ajuda</a></li>
                                <li><a href="../php-resources/domain/blog-dos-professores.php">Blog dos Professores</a></li>
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
        <br /><br /><br />

        <script src="../resources/scripts/jQuery-2.1.4.min.js" type="text/javascript"></script> 
        <script src="../resources/templates/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../resources/scripts/default.js" type="text/javascript"></script>
        <script src="../resources/scripts-custom/selecionarCategoriaProfessor.js" type="text/javascript"></script>

        <script src="../resources/scripts/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
        <script src="../scripts/camera/scripts/camera.min.js" type="text/javascript"></script>
        <script src="../resources/scripts/easing/jquery.easing.1.3.js" type="text/javascript"></script>

    </body>
</html>