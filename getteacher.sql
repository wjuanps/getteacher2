-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2018 at 08:12 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `getteacher`
--
CREATE DATABASE IF NOT EXISTS `getteacher` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `getteacher`;

-- --------------------------------------------------------

--
-- Table structure for table `agendamento`
--

DROP TABLE IF EXISTS `agendamento`;
CREATE TABLE IF NOT EXISTS `agendamento` (
  `id_agendamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `duracao` varchar(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `necessidade` text NOT NULL,
  PRIMARY KEY (`id_agendamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `agendamento`
--

INSERT INTO `agendamento` (`id_agendamento`, `id_aluno`, `id_professor`, `data`, `duracao`, `status`, `necessidade`) VALUES
(1, 2, 85961, '2016-05-02 16:00:00', '2:00', 3, 'Tô esperando a confirmação.'),
(2, 2, 140648, '2016-05-01 21:00:00', '2:00', 3, 'Quero aula.'),
(3, 6, 120966, '2016-05-05 16:00:00', '2:00', 1, 'Estudar'),
(4, 7, 82822, '2016-05-02 15:00:00', '2:00', 1, 'Estudar'),
(5, 4, 140648, '2016-05-02 10:00:00', '2:00', 1, 'Quero aula.'),
(6, 5, 140648, '2016-05-10 10:00:00', '2:00', 2, 'Quero aula.'),
(7, 2, 140648, '2016-05-11 18:00:00', '2:00', 3, 'Quero aula.');

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(30) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome_aluno`, `foto_perfil`, `email`, `senha`, `data_cadastro`) VALUES
(0, NULL, NULL, NULL, NULL, NULL),
(2, 'Sophia Soares', '0b03390be78a4fdfc75db68b790b4872.jpg', 'fifia@fifia.com', '123', '2016-04-29 16:46:07'),
(4, 'Janaina Correa', '3db3726504097ada8af7a80dbc2dd2d9.jpg', 'jana@jana.com', '123', '2016-04-29 16:47:57'),
(5, 'Alex Souza', '38065b97b2785caf9609f43ac9c6b0c5.jpg', 'souza@souza.com', '123', '2016-04-29 16:48:46'),
(6, 'João Paulo', 'e63569c0008405e815d03b6b42cebc8c.jpg', 'paulo@paulo.com', '123', '2016-04-29 17:29:21'),
(7, 'Josias Ferreira', '00017108825b52d5769a9337821e1b48.jpg', 'josias@josias.com', '123', '2016-05-03 16:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `didatica` int(11) DEFAULT NULL,
  `conhecimento` int(11) DEFAULT NULL,
  `simpatia` int(11) DEFAULT NULL,
  `comentario` varchar(100) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_aula` int(11) NOT NULL,
  PRIMARY KEY (`id_avaliacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `avaliacoes`
--

INSERT INTO `avaliacoes` (`id_avaliacao`, `id_professor`, `id_aluno`, `didatica`, `conhecimento`, `simpatia`, `comentario`, `data`, `status`, `id_aula`) VALUES
(1, 140648, 2, 5, 5, 5, 'Excelente professor. Muito boa a aula.', '2016-05-02 14:53:50', 0, 2),
(2, 85961, 2, 1, 5, 2, 'Professora mais ou menos.', '2016-05-14 15:31:20', 0, 1),
(3, 140648, 2, 2, 3, 2, 'Professor legalzinho.', '2016-05-14 15:35:36', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id_blog` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(11) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `texto` text,
  `data` datetime DEFAULT NULL,
  `area` varchar(20) NOT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_blog`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id_blog`, `id_professor`, `imagem`, `titulo`, `texto`, `data`, `area`, `categoria`, `status`) VALUES
(1, 140648, '5140c47a55f184776c21cb0632ef1a47.png', 'Algoritmos', 'Um algoritmo é uma seqüência de instruções finita e ordenada de forma lógica para a\r\nresolução de uma determinada tarefa ou problema. São exemplos de algoritmos instruções de\r\nmontagem, receitas, manuais de uso, etc. Um algoritmo não é a solução do problema, pois, se\r\nassim fosse, cada problema teria um único algoritmo; um algoritmo é um caminho para a\r\nsolução de um problema. Em geral, existem muitos (senão infinitos) caminhos que levam a\r\numa solução satisfatória.\r\nUm algoritmo não computacional é um algoritmo cuja seqüência de passos, a princípio,\r\nnão pode ser executada por um computador. Abaixo é apresentado um algoritmo não\r\ncomputacional cujo objetivo é usar um telefone público. Provavelmente você ?executou? o\r\nalgoritmo deste exemplo diversas vezes. O termo algoritmo está muito ligado à Ciência da\r\nComputação, mas, na realidade, ele pode ser aplicado a qualquer problema cuja solução possa\r\nser decomposta em um grupo de instruções.\r\n\r\nAlgoritmo para fritar um ovo\r\n1. Colocar um ovo na frigideira\r\n2. Esperar o ovo ficar frito\r\n3. Remover o ovo da frigideira\r\nO algoritmo acima, no entanto, poderia ser mais detalhado e completo. Uma versão\r\nmais aceitável seria:\r\n\r\nAlgoritmo para fritar um ovo\r\n1. Retirar um ovo da geladeira\r\n2. Colocar a frigideira no fogo\r\n3. Colocar óleo\r\n4. Esperar até o óleo ficar quente\r\n5. Quebrar o ovo separando a casca\r\n6. Colocar o conteúdo do ovo na frigideira\r\n7. Esperar um minuto\r\n8. Retirar o ovo da frigideira\r\n9. Apagar o fogo\r\nEssa segunda versão é mais completa e detalhada que a anterior. Nela, várias ações\r\nque estavam subentendidas foram explicitadas. No entanto, para que o algoritmo possa ser\r\nútil, é necessário ainda que quem faz uso dele conheça os termos utilizados nas instruções. O\r\nalgoritmo do exemplo só será útil para alguém que seja fluente na língua portuguesa e\r\nconheça o significado dos verbos Retirar, Colocar, Esperar assim como dos substantivos\r\nutilizados no contexto de uma receita culinária. Em outras palavras, é preciso que a linguagem\r\nutilizada no algoritmo seja conhecida tanto por quem o escreveu quanto por quem vai\r\nexecutá-lo.\r\nPara que o algoritmo possa ser executado por uma máquina é importante que as\r\ninstruções sejam corretas e sem ambigüidades. Portanto, a forma especial de linguagem que\r\nutilizaremos é bem mais restrita que o Português e com significados bem definidos para todos\r\nos termos utilizados nas instruções. Essa linguagem é conhecida como Português\r\nEstruturado (às vezes também chamada de Portugol). O português estruturado é, na verdade,\r\numa simplificação extrema do Português, limitada a umas poucas palavras e estruturas que\r\ntêm um significado muito bem definido. Ao conjunto de palavras e regras que definem o\r\nformato das sentenças válidas chamamos sintaxe da linguagem. Durante este texto, a\r\nsintaxe do Português Estruturado será apresentada progressivamente e a utilizaremos em\r\nmuitos exercícios de resolução de problemas.\r\nAprender as palavras e regras que fazem parte dessa sintaxe é fundamental; no\r\nentanto, não é o maior objetivo deste curso. O que realmente exigirá um grande esforço por\r\nparte do estudante é aprender a resolver problemas utilizando a linguagem. Para isso, há\r\nsomente um caminho: resolver muitos problemas. O processo é semelhante ao de tornar-se\r\ncompetente em um jogo qualquer: aprender as regras do jogo (a sintaxe) é só o primeiro\r\npasso, tornar-se um bom jogador (programador) exige tempo, muito exercício e dedicação.\r\nEmbora o Português Estruturado seja uma linguagem bastante simplificada, ela possui\r\ntodos os elementos básicos e uma estrutura semelhante à de uma linguagem típica para\r\nprogramação de computadores. Além disso, resolver problemas com português estruturado,\r\npode ser uma tarefa tão complexa quanto a de escrever um programa em uma linguagem de\r\nprogramação qualquer. Portanto, neste curso, estaremos na verdade procurando desenvolver\r\nas habilidades básicas', '2016-05-01 19:05:54', 'Exatas', 'Computação', 1),
(2, 85961, '5140c47a55f284776c21cb0632ea1a47.png', 'Max Planck e o estudo do Corpo Negro.', '- Corpo negro é um sistema ideal, que absorve 100% da radiação incidente sobre ele, refletindo 0% dela. Uma boa aproximação de um Corpo negro é o interior de um corpo oco.Assim, a radiação que um Corpo negro aquecido emite depende, exclusivamente das características dos àtomos de suas paredes internas (temperatura, níveis de energia dos osciladores etc.). não tendo nenhuma relação com a radiação que ele absorbveu.\r\n\r\nEm 1900, estudos sobre a radiação emitida por um corpo aquecido levaram Max Planck a concluir que a radiação (energia eletromagnética) emitida por um Corpo negro não é emitida de forma contínua, como uma onda (visão clássica) ,e sim, de forma discreta, descontínua, granulada.\r\n\r\nA energia portada pela radiação eletromagnética viaja um feixe de minúsculos pacotes de energia, que Einstein posteriormente chamou de fótons. Eles são o quantum de energia eletromagnética.\r\n\r\n \r\n\r\n \r\n\r\nAssim, como num feixe só é possível viajar um número inteiro de fótons (não existe a metade um fóton), dizemos que a energia (radiação) eletromagnética portada carregada pelo feixe é quantizada.\r\n\r\nVocê deve estar se perguntando o que levou Planck a essa conclusão quando estudou a radiação emitida pelo Corpo negro. A resposta para essa pergunta é complexa.\r\n\r\nPara resumi-la, posso lhe dizer que o problema da radiação do Corpo negro inquietava muitos cientistas da época. Um amplo estudo experimental havia sido feito.Faltava uma base teórica matemática que justificasse os resultados obtidos.\r\n\r\nAs formulações matemáticas propostas por Wien só se encaixavam aos dados experimentais para pequenos comprimentos de onda (altas frequências), ao passo que as formulações de Rayleigh e Jean só tinham sucesso para grandes comprimentos de onda, como mostra o gráfico a seguir.\r\n\r\n \r\n\r\nA verdade é que Planck ajustou uma função matemática até que ela se moldasse aos dados experimentais disponíveis sobre a radiação do corpo negro.Após chegar a uma função matemática perfeita que justificava o comportamento da radiação espectral em toda a faixa de frequências (veja o gráfico a seguir), era preciso dar uma interpretação física para ela \r\n\r\n \r\n\r\n \r\n\r\nEm sua dedução, Planck usou a hipótese de que a radiação emitida ou absorvida pelo corpo negro não ocorria de forma contínua, como uma onda, mas de forma discrea, descontínua, granulada. Essa energia ocorria na forma de pacotes discretos, denominados quanta (quanta é o plural de quantum) cuja energia ra dada por E=hf, onde h ficou conhecida como a constante de Planck.\r\n\r\nNo fundo, o próprio Planck não estava certo se sua introdução de constante H era apenas um artifício matemático ou algo de significado físico mais profundo; se o artifício da discretização da energia eletromagnética era, de fato, correto, ou apenas uma maneira de corrigir matematicamente um desvio entre a teoria e o experimento.\r\n\r\nNuma carta escrito a um amigo, Planck chamou seu postulado de &#34;um ato de desespero&#34;. &#34;Eu sabia&#39; escreveu, &#34;que o problrma da radiação era de fundamental significado para a fisica eu sabia a fórmula que reproduzia a distribuição normal do espectro. Uma interpretação física tinha que ser encontrada a qualquer custo, não interessando quâo alto&#34;\r\n\r\nPor mais de uma década Planck tentou encaixar a idéia quântica dentro da teoria clássica. Em casa tentativa, ele parecia recuar mais da sua ousadia original, mas gerava novas idéias e técnicas que a mecância quântica adotaria mais tarde. No fundo, o próprio Planck não parecia crer nos cálculos quânticos\r\n\r\nA importância fundamental da sua hipótese sobre a quantização de enrgia não foi valorizada até que Einstein aplicou idéias semelhantes para explicar o efeito fotoelétrico e sugeriu que a quantização de energia uma propriedade fundamental da radiação eletromagnética, incluindo a luz.\r\n\r\nO estudo do efeito fotoelétrico a seguir deixará mais claro para o aluno que o conceito de fótons realmente faz sentido e que é indispensável para justificar o comportamento demonstrado experimentalmente pela radiação eletromagnética nesse fenômeno.', '2016-05-03 14:05:30', 'Exatas', 'Fisica', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comentario_blog`
--

DROP TABLE IF EXISTS `comentario_blog`;
CREATE TABLE IF NOT EXISTS `comentario_blog` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `id_blog` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_comentario` datetime DEFAULT NULL,
  `comentario` text,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comentario_blog`
--

INSERT INTO `comentario_blog` (`id_comentario`, `id_blog`, `id_usuario`, `data_comentario`, `comentario`, `status`) VALUES
(1, 1, 2, '2016-05-01 19:22:35', 'Muito esclarecedor, obrigada professor.', 0),
(2, 1, 140648, '2016-05-01 19:27:55', 'Obrigado, Sophia Soares.', 0),
(3, 2, 2, '2016-05-05 15:32:19', 'Muito legal', 0),
(4, 1, 140648, '2017-01-24 11:26:31', 'Muito bom esse artigo!!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dados`
--

DROP TABLE IF EXISTS `dados`;
CREATE TABLE IF NOT EXISTS `dados` (
  `nomes` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dados`
--

INSERT INTO `dados` (`nomes`) VALUES
('Juan'),
('Sophia'),
('Bianca'),
('Ariana'),
('Reanato'),
('Renato'),
('Junior'),
('Amanda'),
('Cleiton'),
('Juan'),
('Sophia'),
('Bianca'),
('Ariana'),
('Reanato'),
('Renato'),
('Junior'),
('Amanda'),
('Cleiton');

-- --------------------------------------------------------

--
-- Table structure for table `encontrar_aluno`
--

DROP TABLE IF EXISTS `encontrar_aluno`;
CREATE TABLE IF NOT EXISTS `encontrar_aluno` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) NOT NULL,
  `area` varchar(20) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `escolaridade` varchar(20) NOT NULL,
  `necessidade` text NOT NULL,
  PRIMARY KEY (`identificador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `encontrar_aluno`
--

INSERT INTO `encontrar_aluno` (`identificador`, `id_aluno`, `area`, `categoria`, `escolaridade`, `necessidade`) VALUES
(1, 2, 'Biológicas', 'Biológicas', 'Intermediário', 'sgbrawg');

-- --------------------------------------------------------

--
-- Table structure for table `formacao`
--

DROP TABLE IF EXISTS `formacao`;
CREATE TABLE IF NOT EXISTS `formacao` (
  `id_professor` int(11) NOT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `curso` varchar(50) DEFAULT NULL,
  `instituicao` varchar(100) DEFAULT NULL,
  `ano_inicio` year(4) DEFAULT NULL,
  `ano_termino` year(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formacao`
--

INSERT INTO `formacao` (`id_professor`, `nivel`, `curso`, `instituicao`, `ano_inicio`, `ano_termino`) VALUES
(140648, 'Doutorado', 'Sistemas de Informação', 'UFPA', 2012, 2015),
(179854, '', '', '', 2016, 2016),
(124313, 'Doutorado', 'Redação', 'UFPA', 2012, 2014),
(95926, '', '', '', 2016, 2016),
(138101, '', '', '', 2016, 2016),
(85961, '', '', '', 2016, 2016),
(132004, '', '', '', 2016, 2016),
(175613, '', '', '', 2016, 2016),
(120966, '', '', '', 2016, 2016),
(160301, '', '', '', 2016, 2016),
(82822, '', '', '', 2016, 2016),
(154824, '', '', '', 2016, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id_duvida` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno_forum` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `duvida` varchar(50) NOT NULL,
  `complemento` varchar(50000) NOT NULL,
  `assunto` varchar(20) NOT NULL,
  `data` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_duvida`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id_duvida`, `id_aluno_forum`, `nome`, `email`, `duvida`, `complemento`, `assunto`, `data`, `status`) VALUES
(1, 2, NULL, NULL, 'Algoritmo para fritar um ovo', 'Estou com dúvida na criação de um algoritmo para fritar um ovo, \r\nserá que alguém pode me ajudar?', 'Computação', '2016-05-01 19:35:44', 1),
(2, 0, 'José Messias', 'messias@messias.com', 'Nietzsche', 'Um dos idolos que Nietzsche aponta como sendo o unico capaz de asseverar uma verdadeira educação que atinja os verdadeiros objetivos é Socrates?', 'Filosofia', '2016-05-03 14:28:05', 1),
(3, 4, NULL, NULL, 'Dúvida na Física', '(UFPE)UM objeto de 2,0 kg descreve uma trajetória retilínea, que obedece a equação horária s=7,0 t^2+3,0 t +5,0 onde s é medido em metros e t em segundos. O módulo da força resultante que está atuando sobre objeto é em N:\r\na)10\r\nb)17\r\nc)19\r\nd)28\r\ne)35\r\n\r\nQual a resposta e a resolução ? Obrigado pela ajuda.', 'Fisica', '2016-05-03 14:32:36', 1),
(4, 0, 'Adriana Venturini', 'drica@drica.com', 'Contabilidade', 'Considerando o valor a receber no Ativo Circulante (R$ 3.028.854,00) e o empréstimo e financiamentos no Passivo Circulante (R$ 988.056,00) do ano de 2014, qual seria a taxa de juros compostos mais adequada para que a empresa tenha um acréscimo de 5% no valor das suas disponibilidades (R$ 20.728.421,00) no Ativo Circulante em um período de 12 meses?', 'Matematica', '2016-05-03 14:49:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `like_blog`
--

DROP TABLE IF EXISTS `like_blog`;
CREATE TABLE IF NOT EXISTS `like_blog` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(100) NOT NULL,
  `data_like` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `like_blog`
--

INSERT INTO `like_blog` (`id_like`, `id_usuario`, `data_like`, `status`, `id_post`) VALUES
(1, 2, '2016-05-01 19:22:11', 0, 1),
(2, 2, '2016-05-05 15:32:12', 0, 2),
(3, 140648, '2016-05-14 15:26:38', 0, 2),
(4, 140648, '2016-05-14 15:28:48', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
CREATE TABLE IF NOT EXISTS `mensagens` (
  `id_mensagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `time` int(21) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `mensagem` text,
  `status` int(11) DEFAULT NULL,
  `remetente` int(11) DEFAULT NULL,
  `destinatario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mensagem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `mensagens`
--

INSERT INTO `mensagens` (`id_mensagem`, `id_professor`, `id_aluno`, `time`, `data`, `mensagem`, `status`, `remetente`, `destinatario`) VALUES
(6, 85961, 2, 1462143148, '2016-05-01 19:52:28', 'Quero passar no enem.', 1, 2, 85961),
(7, 85961, 2, 1462143243, '2016-05-01 19:54:03', 'Posso dia 7 as 7', 1, 85961, 2),
(8, 85961, 2, 1462143287, '2016-05-01 19:54:47', 'Vou agendar então', 1, 2, 85961),
(9, 85961, 2, 1462143403, '2016-05-01 19:56:43', 'Aula confirmada, lhe aguardo.', 1, 85961, 2),
(10, 140648, 2, 1462144266, '2016-05-01 20:11:06', 'Aula marcada.', 1, 140648, 2),
(11, 120966, 6, 1462303783, '2016-05-03 16:29:43', 'Aula marcada', 0, 120966, 6),
(12, 82822, 7, 1462303866, '2016-05-03 16:31:06', 'Aula marcada', 0, 82822, 7),
(14, 140648, 2, 1462304063, '2016-05-03 16:34:23', 'Aula Confirmada.', 1, 140648, 2),
(15, 85961, 2, 1462304105, '2016-05-03 16:35:05', 'Aula remarcada.', 1, 2, 85961),
(16, 140648, 5, 1475630414, '2016-10-04 22:20:14', 'Não dá mais...', 1, 140648, 5),
(17, 140648, 2, 1475631002, '2016-10-04 22:30:02', 'Legal a aula..', 1, 2, 140648),
(18, 140648, 2, 1475631099, '2016-10-04 22:31:39', 'Muito obrigado!!', 1, 140648, 2);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `nome_professor` varchar(45) CHARACTER SET latin1 COLLATE latin1_german2_ci DEFAULT NULL,
  `genero` varchar(15) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `logradouro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cep` varchar(15) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `estado` varchar(5) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  `especialidade` varchar(30) DEFAULT NULL,
  `tipo_aula` varchar(30) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `diploma` varchar(100) NOT NULL,
  `sobre` text,
  `hora_aula` int(11) DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `id_professor` int(11) NOT NULL,
  `cpf` varchar(18) NOT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`nome_professor`, `genero`, `data_nascimento`, `logradouro`, `cidade`, `bairro`, `cep`, `numero`, `complemento`, `estado`, `area`, `categoria`, `especialidade`, `tipo_aula`, `foto_perfil`, `diploma`, `sobre`, `hora_aula`, `avaliacao`, `data_cadastro`, `id_professor`, `cpf`) VALUES
('Priscila Peixoto', 'Feminino', '2016-05-05', 'Avenida', 'Castanhal', 'Ianetama', '12345-678', 123, '', 'PA', 'Artes', 'Pintura', 'Da Vinci', 'Presencial ou Online', 'ea9d36f841611ce05823f114c0b12ca1.jpg', 'ea9d36f841611ce05823f114c0b12ca1.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.', 55, 1, '2016-05-03 16:26:05', 82822, '123.456.789-02'),
('Helena Silva', 'Feminino', '2016-04-20', 'Avenida', 'Castanhal', 'Ianetama', '12345-568', 85, '', 'PA', 'Exatas', 'Fisica', 'Newton', 'Online', '03d866a47a41074239defdcaa7e646b7.jpg', '03d866a47a41074239defdcaa7e646b7.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidu.', 45, 3, '2016-04-29 16:51:33', 85961, '123.654.123-25'),
('Pedro Henrique', 'Masculino', '2016-03-27', 'Avenida', 'Castanhal', 'Ianetama', '12345-568', 5689, '', 'PA', 'Exatas', 'Matematica', 'Probabilidade', 'Presencial ou Online', '1ad120b662fd3f2500448dcff30fe79c.jpg', '1ad120b662fd3f2500448dcff30fe79c.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidu.', 80, 1, '2016-04-29 16:40:57', 95926, '123.789.654-56'),
('Bruna Venturini', 'Feminino', '2016-02-05', 'Avenida', 'Castanhal', 'Ianetama', '12345-678', 123, '', 'PA', 'Humanas', 'Psicologia', 'Freud', 'Presencial ou Online', '8cde69754f3d43180d4d3af3e2003ed2.jpg', '8cde69754f3d43180d4d3af3e2003ed2.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.', 60, 1, '2016-05-03 16:20:47', 120966, '123.456.789-89'),
('Ariana Leal', 'Feminino', '2016-04-17', 'Avenida', 'Castanhal', 'Ianetama', '12345-568', 125, '', 'PA', 'Linguagens', 'Redação', 'Enem', 'Presencial ou Online', '752b5c66b8d490df368488db0f774dd6.jpg', '752b5c66b8d490df368488db0f774dd6.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidu.', 90, 1, '2016-04-29 16:36:57', 124313, '123.456.789-85'),
('Maria Silva', 'Feminino', '2016-04-26', 'Avenida', 'Castanhal', 'Ianetama', '12345-568', 256, '', 'PA', 'Exatas', 'Estatística', 'Probabilidade', 'Presencial', '876c9d39eb654c10222906baf2d2ee4a.jpg', '7bbe79a75ec819d6d3f5c9a1c43c9bb5.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidu.', 65, 1, '2016-04-29 16:53:59', 132004, '456.123.897-85'),
('Alan Moisés', 'Masculino', '2016-03-30', 'Avenida', 'Castanhal', 'Ianetama', '12345-568', 3546, '', 'PA', 'Música', 'Instrumentos', 'Violão', 'Presencial', '2bd6d19e2a93e7f9536d7e6c39521c66.jpg', '2bd6d19e2a93e7f9536d7e6c39521c66.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidu.', 70, 1, '2016-04-29 16:43:21', 138101, '123.654.789-64'),
('Juan Soares', 'Masculino', '1995-10-11', 'Avenida', 'Castanhal', 'Ianetama', '12345-568', 104, '', 'PA', 'Exatas', 'Computação', 'Programação', 'Presencial ou Online', 'c49fa44023516b8c7508147dd30a00f2.png', 'c611fe0c87de018497a200a3daa0ca1e.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidu.', 65, 4, '2016-04-29 16:30:56', 140648, '123.456.789-00'),
('Ailton Noronha', 'Masculino', '2016-05-01', 'Avenida', 'Castanhal', 'Ianetama', '12345-678', 123, '', 'PA', 'Exatas', 'Matemática Financeira', 'Juros composto', 'Presencial ou Online', '145a08b0cff43135dba18cbe339cb5bb.png', '145a08b0cff43135dba18cbe339cb5bb.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.', 70, 1, '2016-05-03 17:14:58', 154824, '123.456.789-61'),
('Adriana Santos', 'Feminino', '2016-05-22', 'Avenida', 'Castanhal', 'Ianetama', '12345-678', 123, '', 'PA', 'Biológicas', 'Zootecnia', 'Animais', 'Online', '18d4705ac40be73c7946c0c223656a54.jpg', '18d4705ac40be73c7946c0c223656a54.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.', 34, 1, '2016-05-03 16:18:51', 160301, '123.456.789-01'),
('osvaldo Nascimnto', 'Masculino', '2016-05-04', 'Avenida', 'Castanhal', 'Ianetama', '12345-678', 123, '', 'PA', 'Exatas', 'Engenharia', 'Cálculo', 'Presencial ou Online', 'f513f6e0f2e892a659901150b256a921.jpg', 'f513f6e0f2e892a659901150b256a921.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.', 78, 1, '2016-05-03 16:23:38', 175613, '123.456.789-59'),
('Bianca Soares', 'Feminino', '2016-04-12', 'Avenida', 'Castanhal', 'Ianetama', '12345-568', 108, '', 'PA', 'Humanas', 'Filosofia', 'Maquiavel', 'Presencial ou Online', 'f6692d73c4218875899d81c6c33a0f2d.jpg', 'f6692d73c4218875899d81c6c33a0f2d.pdf', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidu.', 80, 1, '2016-04-29 16:33:58', 179854, '789.456.123-32');

-- --------------------------------------------------------

--
-- Table structure for table `resposta_forum`
--

DROP TABLE IF EXISTS `resposta_forum`;
CREATE TABLE IF NOT EXISTS `resposta_forum` (
  `id_resposta` int(11) NOT NULL AUTO_INCREMENT,
  `id_duvida` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `resposta` varchar(2000) NOT NULL,
  `data_resposta` datetime NOT NULL,
  PRIMARY KEY (`id_resposta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `resposta_forum`
--

INSERT INTO `resposta_forum` (`id_resposta`, `id_duvida`, `id_professor`, `resposta`, `data_resposta`) VALUES
(2, 1, 140648, '<strong>Algoritmo para fritar um ovo</strong>\n\n1. Retirar um ovo da geladeira\n2. Colocar a frigideira no fogo\n3. Colocar óleo\n4. Esperar até o óleo ficar quente\n5. Quebrar o ovo separando a casca\n6. Colocar o conteúdo do ovo na frigideira\n7. Esperar um minuto\n8. Retirar o ovo da frigideira\n9. Apagar o fogo\n\nEspero ter ajudado.', '2016-05-01 19:37:42'),
(3, 2, 179854, 'Não. Na verdade ele tece uma crítica severa a Sócrates, na medida em que ele, Sócrates, aponta o autocontrole e a reflexão como forma de fazer com que o homem atinja seu pleno desenvolvimento. Para Nietzsche essa postura ao invés de fortalecer o homem o enfraquece, pois é na luta com suas próprias forças opositoras é que residem as condições necessárias para o seu fortalecimento e formação. Assim sendo, apoiar-se em uma filosofia que conduza o homem a impor limites ao seu instinto é transformá-lo em objeto da sua própria fraqueza.', '2016-05-03 14:28:55'),
(4, 3, 85961, 'F = massa x aceleração\n\nComo já conhecemos a massa, basta descobrir a aceleração deste corpo.\n\nS = 7t^2 + 3t + 5\n\nA equacao do movimento é:\nS = a/2t^ + vot + so\n\nLogo: a/2 = 7\na = 14m/s^2\n\nF= 2x14 = 28N', '2016-05-03 14:34:43'),
(5, 4, 140648, 'Não faço a menor ideia', '2016-08-24 22:14:10'),
(6, 4, 140648, 'Continuo sem fazer ideia.', '2017-01-24 11:37:36'),
(7, 4, 140648, '<h1>Essa é bem difícil</h1>', '2017-02-08 14:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `sugestoes`
--

DROP TABLE IF EXISTS `sugestoes`;
CREATE TABLE IF NOT EXISTS `sugestoes` (
  `id_sugestao` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `data` datetime NOT NULL,
  `assunto` varchar(50) NOT NULL,
  `mensagem` varchar(50000) NOT NULL,
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`id_sugestao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sugestoes`
--

INSERT INTO `sugestoes` (`id_sugestao`, `id_usuario`, `nome`, `email`, `tipo_usuario`, `data`, `assunto`, `mensagem`, `status`) VALUES
(1, 2, NULL, NULL, 'Aluno', '2016-05-01 11:58:26', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\natt, \r\n\r\n\r\nSophia Soares', '1'),
(2, 0, 'João Neto', 'joao@joao.com', 'Avulso', '2016-05-01 11:59:04', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\natt,\r\n\r\nJoão', '1'),
(5, 2, NULL, NULL, 'Aluno', '2016-05-03 16:44:26', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.', '1'),
(6, 4, NULL, NULL, 'Aluno', '2016-05-03 16:51:10', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.Lorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.\r\n\r\nLorem ipsum dolor sit amet, consectetueradipiscing elied diam nonummy nibh euisod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor.', '1'),
(7, 140648, NULL, NULL, 'Professor', '2017-01-24 11:29:32', 'Denuncia', 'sgahbaednhdegndgngd dhbagakelnj hughaer hauerhguioa hguawrhg uahrgu ahp\r\n9uigj eoiuwerghjio eguihjugvha su auhguioas hguahguah uharugh awiuorghaurjghuiawr hg\r\nigofiahjiog auohguoiah gupahawr hgpaiurhg rgpuawhp9awrhg.\r\n\r\n\r\nwjogfhw ghuawhgu ahguh fghaw ughwaug hawpugfh pwuagh \r\n ahrguo hawug hapwu hguawrhg puawrhg upawhrg ugh.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE IF NOT EXISTS `telefone` (
  `id_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(100) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `telefone` varchar(30) NOT NULL,
  PRIMARY KEY (`id_telefone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `telefone`
--

INSERT INTO `telefone` (`id_telefone`, `id_professor`, `id_aluno`, `telefone`) VALUES
(1, 140648, NULL, '091 9 8945-8743'),
(2, 179854, NULL, '091 9 9988-7766'),
(3, 124313, NULL, '091 9 5698-5698'),
(4, 95926, NULL, '091 9 7485-9636'),
(5, 138101, NULL, '091 9 6545-2585'),
(6, 85961, NULL, '091 9 6589-3652'),
(7, 132004, NULL, '091 9 2565-3563'),
(11, 160301, NULL, '091 9 8767-8767'),
(12, 120966, NULL, '91 91987654321'),
(13, 175613, NULL, '91 91978234567'),
(14, 82822, NULL, '091 9 8765-4536'),
(15, 154824, NULL, '091 9 8765-6565'),
(16, 140648, NULL, '091 9 8456-5640');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) DEFAULT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `senha_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_professor` (`id_professor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_aluno`, `id_professor`, `email`, `usuario`, `tipo_usuario`, `senha_usuario`) VALUES
(0, NULL, NULL, NULL, 'admin', 'Admin', 'admin'),
(2, NULL, 140648, 'wjuan.ps@gmail.com', 'wjuan', 'Professor', 'juan1234'),
(3, NULL, 179854, 'bibi@bibi.com', 'bibi', 'Professor', '123'),
(4, NULL, 124313, 'leal@leal.com', 'leal', 'Professor', '123'),
(5, NULL, 95926, 'pe@pe.com', 'pedro', 'Professor', '123'),
(6, NULL, 138101, 'alan@alan.com', 'alan', 'Professor', '123'),
(7, 2, NULL, 'fifia@fifia.com', NULL, 'Aluno', '123'),
(9, 4, NULL, 'jana@jana.com', NULL, 'Aluno', '123'),
(10, 5, NULL, 'souza@souza.com', NULL, 'Aluno', '123'),
(11, NULL, 85961, 'helena@helena.com', 'helena', 'Professor', '123'),
(12, NULL, 132004, 'maria@maria.com', 'maria', 'Professor', '123'),
(13, 6, NULL, 'paulo@paulo.com', NULL, 'Aluno', '123'),
(17, 7, NULL, 'josias@josias.com', NULL, 'Aluno', '123'),
(18, NULL, 160301, 'adriana@adriana.com', 'adriana', 'Professor', '123'),
(19, NULL, 120966, 'bruna@bruna.com', 'bruna', 'Professor', '123'),
(20, NULL, 175613, 'osvaldo@osvaldo.com', 'osvaldo', 'Professor', '123'),
(21, NULL, 82822, 'peixoto@peixoto.com', 'priscila', 'Professor', '123'),
(22, NULL, 154824, 'ailton@ailton.com', 'ailton', 'Professor', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
