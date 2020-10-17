-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 27-Ago-2019 às 04:34
-- Versão do servidor: 10.1.38-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avaliacao_de_desempenho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anos`
--

CREATE TABLE `anos` (
  `id_ano` int(125) NOT NULL,
  `ano` int(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `anos`
--

INSERT INTO `anos` (`id_ano`, `ano`) VALUES
(1, 2019);

-- --------------------------------------------------------

--
-- Estrutura da tabela `meses`
--

CREATE TABLE `meses` (
  `id_mes` int(125) NOT NULL,
  `mes` varchar(125) NOT NULL,
  `dias` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `meses`
--

INSERT INTO `meses` (`id_mes`, `mes`, `dias`) VALUES
(1, 'Janeiro', 0),
(2, 'Fevereiro', 0),
(3, 'Março', 0),
(4, 'Abril', 0),
(5, 'Maio', 0),
(6, 'Junho', 0),
(7, 'Julho', 0),
(8, 'Agosto', 0),
(9, 'Setembro', 0),
(10, 'Outubro', 0),
(11, 'Novembro', 0),
(12, 'Dezembro', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_av_usuarios`
--

CREATE TABLE `tb_av_usuarios` (
  `id` int(125) NOT NULL,
  `av_ano` int(11) NOT NULL,
  `av_mes` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `av_competencia_profissional` int(11) NOT NULL DEFAULT '0',
  `av_dinamismo_iniciativa` int(11) NOT NULL DEFAULT '0',
  `av_cumprimento_tarefa` int(11) NOT NULL DEFAULT '0',
  `av_rel_hum_trab` int(11) NOT NULL DEFAULT '0',
  `av_adpt_func` int(11) NOT NULL DEFAULT '0',
  `av_disciplina` int(11) NOT NULL DEFAULT '0',
  `av_uso_correcto_equip` int(11) NOT NULL DEFAULT '0',
  `av_apresentacao_compostura` int(11) NOT NULL DEFAULT '0',
  `av_reuniao_mat` int(11) NOT NULL DEFAULT '0',
  `av_reuniao_op` int(11) NOT NULL DEFAULT '0',
  `av_assiduidade` int(11) NOT NULL DEFAULT '0',
  `av_pontualidade` int(11) NOT NULL DEFAULT '0',
  `faltas_injustificadas` int(11) NOT NULL DEFAULT '0',
  `faltas_justificadas` int(11) NOT NULL DEFAULT '0',
  `media_total` int(11) NOT NULL DEFAULT '0',
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_av_usuarios`
--

INSERT INTO `tb_av_usuarios` (`id`, `av_ano`, `av_mes`, `usuario_id`, `av_competencia_profissional`, `av_dinamismo_iniciativa`, `av_cumprimento_tarefa`, `av_rel_hum_trab`, `av_adpt_func`, `av_disciplina`, `av_uso_correcto_equip`, `av_apresentacao_compostura`, `av_reuniao_mat`, `av_reuniao_op`, `av_assiduidade`, `av_pontualidade`, `faltas_injustificadas`, `faltas_justificadas`, `media_total`, `obs`) VALUES
(21, 2019, 8, 7, 8, 12, 8, 15, 12, 9, 12, 7, 7, 7, 7, 3, 2, 3, 10, 'Excelente colaborador'),
(22, 2019, 8, 5, 8, 6, 8, 6, 8, 9, 9, 3, 3, 3, 7, 3, 2, 3, 6, 'Entrega total nas suas tarefas.'),
(23, 2019, 8, 18, 12, 6, 17, 6, 8, 15, 17, 10, 7, 7, 7, 3, 2, 3, 11, 'Durante este mês não houve nenhum problema'),
(24, 2019, 8, 19, 12, 6, 12, 15, 16, 12, 9, 3, 3, 7, 0, 0, 0, 0, 10, 'Bom trabalhador'),
(25, 2019, 8, 17, 17, 15, 17, 15, 16, 15, 17, 10, 10, 10, 0, 0, 0, 0, 14, 'foi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_departamentos`
--

CREATE TABLE `tb_departamentos` (
  `dpto_id` int(11) NOT NULL,
  `dpto_sigla` varchar(125) NOT NULL,
  `dpto_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_departamentos`
--

INSERT INTO `tb_departamentos` (`dpto_id`, `dpto_sigla`, `dpto_nome`) VALUES
(1, 'DACA', ''),
(2, 'DEC', ''),
(3, 'DEGER', ''),
(4, 'DFM', ''),
(5, 'DAFSG', ''),
(6, 'DRHTI', ''),
(7, 'DRMSU', ''),
(8, 'DEETI', ''),
(9, 'DFMCR', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario_id` int(125) NOT NULL,
  `usuario_nome` varchar(125) NOT NULL,
  `usuario_sobrenome` varchar(125) NOT NULL,
  `usuario_login` varchar(255) NOT NULL,
  `usuario_email` varchar(125) NOT NULL,
  `usuario_contacto` int(10) NOT NULL DEFAULT '0',
  `usuario_senha` varchar(125) NOT NULL,
  `usuario_foto` varchar(255) NOT NULL,
  `usuario_tipo` enum('admin','chefe','tecnico','') NOT NULL DEFAULT 'tecnico',
  `usuario_departamento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario_id`, `usuario_nome`, `usuario_sobrenome`, `usuario_login`, `usuario_email`, `usuario_contacto`, `usuario_senha`, `usuario_foto`, `usuario_tipo`, `usuario_departamento`) VALUES
(1, 'Eugenia', 'Bravo', 'eugenia.bravo', 'eugenia.bravo@inacom.gov.ao', 1101, 'deeti123', 'default', 'chefe', 'DEETI'),
(2, 'Benedito', 'Calulo', 'benedito.calulo', 'benedito.calulo@inacom.gov.ao', 1108, 'deeti@2019', 'default', 'tecnico', 'DEETI'),
(3, 'Erica', 'Santos', 'erica.santos', 'erica.santos@inacom.gov.ao', 1112, 'deeti@2019', 'default', 'tecnico', 'DEETI'),
(4, 'Sandra', 'Afonso', 'sandra.afonso', 'sandra.afonso@inacom.gov.ao', 1204, 'drhti123', 'default', 'chefe', 'DRHTI'),
(5, 'Maria', 'Rodrigues', 'maria.rodrigues', 'maria.rodrigues@inacom.gov.ao', 1212, 'drhti@2019', 'default', 'tecnico', 'DRHTI'),
(6, 'Maria', 'Bamba', 'maria.bamba', 'maria.pereira@inacom.gov.ao', 1224, 'drhti@2019', 'default', 'tecnico', 'DRHTI'),
(7, 'Manuel', 'Domingos', 'manuel.domingos', 'manuel.domingos@inacom.gov.ao', 1124, 'deeti@2019', 'default', 'tecnico', 'DEETI'),
(10, 'Joaquim', 'Muhongo', 'joaquim.muhongo', 'joaquim.muhungo@inacom.gov.ao', 1104, 'drmsu123', 'default', 'chefe', 'DRMSU'),
(11, 'Zenaide', 'Cruz', 'zenaide.cruz', 'zenaide.cruz@inacom.gov.ao', 1117, 'drsmu@2019', 'default', 'tecnico', 'DRMSU'),
(12, 'Aguinaldo', 'Agostinho', 'aguinaldo.agostinho', 'aguinaldo.agostinho@inacom.gov.ao', 1106, 'drmsu@2019', 'default', 'tecnico', 'DRMSU'),
(13, 'Diogenes', 'Ferreira', 'diogenes.ferreira', 'diogenes.ferreira@inacom.gov.so', 1105, 'drsmu@2019', 'default', 'tecnico', 'DRMSU'),
(14, 'Luis', 'Paulo', 'luis.paulo', 'luis.paulo@inacom.gov.ao', 1107, 'drmsu@2019', 'default', 'tecnico', 'DRMSU'),
(15, 'Dores', 'Amaral', 'dores.amaral', 'dores.amaral@inacom.gov.ao', 1102, 'drmsu@2019', 'default', 'tecnico', 'DRMSU'),
(16, 'Isabel', 'Jorge', 'isabel.jorge', 'isabel.jorge@inacom.gov.ao', 1111, 'deeti@2019', 'default', 'tecnico', 'DEETI'),
(17, 'Tolavio', 'Silva', 'tolavio.silva', 'tolavio.silva@inacom.gov.ao', 1114, 'deeti@2019', 'default', 'tecnico', 'DEETI'),
(18, 'Dorivaldo', 'Isaac', 'dorivaldo.isaac', 'dorivaldo.isaac@inacom.gov.ao', 1126, 'deeti@2019', '', 'tecnico', 'DEETI'),
(19, 'Josemar', 'Rosa', 'josemar.rosa', 'josemar.rosa@inacom.gov.ao', 1125, 'deeti@2019', '', 'tecnico', 'DEETI'),
(20, 'Merciana', 'Benge', 'merciana.benge', 'merciana.benge@inacom.gov.ao', 1105, 'drmsu@2019', '', 'tecnico', 'DRMSU'),
(21, 'Octávio', 'Machado', 'octavio.machado', 'octavio.machado@inacom.gov.ao', 1304, 'deger123', 'default', 'chefe', 'DEGER'),
(22, 'Eglantina', 'Luís', 'eglantina.luis', 'eglantina.luis@inacom.gov.ao', 1314, 'deger@2019', 'default', 'tecnico', 'DEGER'),
(23, 'Josefa', 'Júlio', 'josefa.julio', 'josefa.julio@inacom.gov.ao', 1317, 'deger@2019', 'default', 'tecnico', 'DEGER'),
(25, 'Indira', 'Almeida', 'indira.almeida', 'indira.almeida@inacom.gov.ao', 1319, 'deger@2019', 'default', 'tecnico', 'DEGER'),
(26, 'Pedro', 'Guimarães', 'pedro.guimaraes', 'pedro.guimaraes@inacom.gov.ao', 1326, 'deger@2019', 'default', 'tecnico', 'DEGER'),
(27, 'Odmar', 'Sousa', 'odmar.sousa', 'odmar.sousa@inacom.gov.ao', 1303, 'deger@2019', 'default', 'tecnico', 'DEGER'),
(28, 'Stela', 'Cândida', 'stela.candida', 'stela.candida@inacom.gov.ao', 1201, 'dafsg123', 'default', 'chefe', 'DAFSG'),
(29, 'Erikson', 'Brazão', 'erikson.brazao', 'erikson.brazao@inacom.gov.ao', 1211, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(30, 'Israel', 'Santos', 'israel.santos', 'israel.santos@inacom.gov.ao', 1202, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(31, 'Cecília', 'Queta', 'cecilia.queta', 'cecila.queta@inacom.gov.ao', 1209, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(32, 'Sermão', 'Biri', 'sermao.biri', 'sermao.biri@inacom.gov.ao', 1215, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(33, 'António', 'Simão', 'antonio.simao', 'antonio.simao@inacom.gov.ao', 1216, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(34, 'Joaquim', 'Gaspar', 'joaquim.gaspar', 'joaquim.gaspar@inacom.gov.ao', 1208, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(35, 'Tânia', 'Inácio', 'tania.inacio', 'tania.inacio@inacom.gov.ao', 1214, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(36, 'Daniel', 'Jamba', 'daniel.jamba', 'daniel.jamba@inacom.gov.ao', 1221, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(37, 'Garcia', 'Cuaba', 'garcia.cuaba', 'garcia.cuaba@inacom.gov.ao', 1220, 'dafsg@02019', 'default', 'tecnico', 'DAFSG'),
(38, 'Manuel', 'Chimoneca', 'manuel.chimoneca', 'manuel.chimoneca@inacom.gov.ao', 1217, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(39, 'João', 'Lucas', 'joao.lucas', 'joao.oliveira@inacom.gov.ao', 1301, 'dfm123', 'default', 'chefe', 'DFM'),
(40, 'Adilson', 'Santos', 'adilson.santos', 'adilson.santos@inacom.gov.ao', 1324, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(41, 'Luís', 'Laplaine', 'luis.laplaine', 'luis.laplaine@inacom.gov.ao', 1313, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(42, 'Manuel', 'Nganga', 'manuel.nganga', 'manuel.nganga@inacom.gov.ao', 1327, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(43, 'Osvaldo', 'Graça', 'osvaldo.graca', 'osvaldo.graca@inacom.gov.ao', 1110, 'drm@2019', 'default', 'tecnico', 'DFM'),
(44, 'Etelvino', 'Morais', 'etelvino.morais', 'etelvino.morais', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(45, 'Maximiano', 'Kilamba', 'maximiano.kilamba', 'maximiano.kilamba@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(46, 'Francsisco', 'Pereira', 'francisco.pereira', 'francisco.pereira@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(47, 'António', 'Catumbila', 'antonio.catumbila', 'antonio.catumbila@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(48, 'Bruno', 'Martins', 'bruno.martins', 'bruno.martins@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(49, 'Diogo', 'Bentinho', 'diogo.bentinho', 'diogo.bentinho@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(50, 'Manuel', 'Baltazar', 'manuel.baltazar', 'manuel.baltazar@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(51, 'Vicente', 'Velasco', 'vicente.velasco', 'vicente.velasco@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(52, 'Mankenda ', 'Lourenço', 'mankenda.lourenco', 'mankenda.lourenco@inacom.gov.ao', 0, 'dfm@2019', 'default', 'tecnico', 'DFM'),
(53, 'Américo', 'Nambalo', 'americo.nambalo', 'americo.nambalo@inacom.gov.ao', 1121, 'dfmcr@2019', 'default', 'tecnico', 'DFMCR'),
(54, 'Celso', 'Tomas', 'celso.tomas', 'celso.tomas@inacom.gov.ao', 1106, 'dfmcr@2019', 'default', 'tecnico', 'DFMCR'),
(55, 'Jofeth', 'Prata', 'jofeth.prata', 'jofeth.prata@inacom.gov.ao', 1118, 'dfmcr@2019', 'default', 'tecnico', 'DFMCR'),
(56, 'Patricia', 'Africano', 'patricia.africano', 'patricia.africano@inacom.gov.ao', 0, 'dfmcr@219', 'default', 'tecnico', 'DFMCR'),
(57, 'Gabriel', 'Panzo', 'gabriel.panzo', 'gabriel.panzo@inacom.gov.ao', 0, 'dfmcr@2019', 'default', 'tecnico', 'DFMCR'),
(58, 'Manuel', 'Calenga', 'manuel.calenga', 'manuel.calenga@inacom.gov.ao', 1508, 'dfmcr@2019', 'defautl', 'tecnico', 'DFMCR'),
(59, 'Cruz', 'Júlio', 'cruz.julio', 'cruz.lourenco@inacom.gov.ao', 1421, 'daca@2019', 'default', 'tecnico', 'DACA'),
(60, 'Jaqueline', 'Luzolo', 'jaqueline.luzolo', 'jaqueline.luzolo@inacom.gov.ao', 1405, 'dec@2019', 'default', 'chefe', 'DEC'),
(61, 'Rosalina', 'Canjila', 'rosalina.canjila', 'rosalina.canjila@inacom.gov.ao', 1409, 'dec@2019', 'default', 'tecnico', 'DEC'),
(62, 'Djanira', 'Faria', 'djanira.faria', 'djanira.faria@inacom.gov.ao', 1406, 'dec@2019', 'default', 'tecnico', 'DEC'),
(63, 'Elieser', 'Almeida', 'elieser.almeida', 'elieser.almeida@inacom.gov.ao', 1426, 'dec@2019', 'default', 'tecnico', 'DEC'),
(64, 'Samuel', 'Murça', 'samuel.murca', '', 0, 'dec@2019', 'default', 'tecnico', 'DEC'),
(65, 'Wiltom', 'Costa', 'wiltom.costa', '', 0, 'dec@2019', 'default', 'tecnico', 'DEC'),
(66, 'Manuel', 'Purificação', 'manuel.purificacao', 'manuel.purificacao@inacom.gov.ao', 1422, 'daca123', 'default', 'chefe', 'DACA'),
(67, 'Fátima', 'Yala', 'fatima.yala', 'fatima.yala@inacom.gov.ao', 1502, 'daca@2019', 'default', 'tecnico', 'DACA'),
(68, 'Neusa', 'Agostinho', 'neusa.agostinho', 'neusa.agostinho@inacom.gov.ao', 1503, 'daca@2019', 'default', 'tecnico', 'DACA'),
(69, 'Estanisla', 'Cadete', 'estanisla', 'cadete', 1504, 'daca@2019', 'default', 'tecnico', 'DACA'),
(70, 'Joaquim', 'Kalala', 'joaquim.kalala', 'joaquim.kalala@inacom.gov.ao', 1410, 'daca@2019', 'default', 'tecnico', 'DACA'),
(71, 'João', 'Tavares', 'joao.tavares', 'joao.tavares@inacom.gov.ao', 1411, 'daca@2019', 'default', 'tecnico', 'DACA'),
(72, 'Kumba', 'Kianvu', 'kumba.kianvu', 'kumba.kianvu@inacom.gov.ao', 1412, 'daca@2019', 'default', 'tecnico', 'DACA'),
(73, 'Costa', 'António', 'costa.antonio', 'costa.antonio@inacom.gov.ao', 1419, 'daca@2019', 'default', 'tecnico', 'DACA'),
(74, 'Arménio', 'Sebastião', 'armaneio.sebastiao', 'armaneio.sebastiao@inacom.gov.ao', 1417, 'daca@2019', 'default', 'tecnico', 'DACA'),
(75, 'Pedro', 'Sozinho', 'pedro.sozinho', 'pedro.sozinho@inacom.gov.ao', 1416, 'daca@2019', 'default', 'tecnico', 'DACA'),
(76, 'Victor', 'Fernandes', 'victor.fernandes', 'victor.fernandes@inacom.gov.ao', 1408, 'daca@2019', 'default', 'tecnico', 'DACA'),
(77, 'Venância', 'Sanhangala', 'venancia.sanhangala', 'venancia.sanhangala@inacom.gov.ao', 1418, 'daca@2019', 'default', 'tecnico', 'DACA'),
(78, 'Vanilde', 'Martins', 'vanilde.martins', 'vanilde.martins@inacom.gov.ao', 1413, 'daca@2019', 'default', 'tecnico', 'DACA'),
(79, 'Marquinhas', 'Narciso', 'marquinhas.narciso', 'marquinhas.narciso@inacom.gov.ao', 0, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(80, 'Carla', 'Chaves', 'carla.chaves', 'carla.chaves@inacom.gov.ao', 1003, 'daca@2019', 'default', 'tecnico', 'DAFSG'),
(81, 'Imaculada', 'Bartolomeu', 'imaculada.bartolomeu', 'imaculada.bartolomeu@inacom.gov.ao', 0, 'dfmg@2019', 'default', 'tecnico', 'DFM'),
(82, 'Elsa', 'Afonso', 'elsa.afonso', 'elsa.afonso@inacom.gov.ao', 1122, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(83, 'António', 'Francisco', 'antonio.francisco', 'antonio.francisco@inacom.gov.ao', 1010, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(84, 'Conceição', 'Gonfulo', 'conceicao.gonfulo', 'conceicao.gonfulo@inacom.gov.ao', 1227, 'drhti@2019', 'default', 'tecnico', 'DRHTI'),
(85, 'Ambrósio', 'Manuel', 'ambrosio.manuel', 'ambrosio.manuel@inacom.gov.ao', 1113, 'drmsu@2019', 'default', 'tecnico', 'DRMSU'),
(86, 'Maria', 'Sousa', 'maria.sousa', 'maria.sousa', 0, 'daca@2019', 'default', 'tecnico', 'DACA'),
(87, 'Silvio', 'Silva', 'silvio.silva', 'silvio.silva', 0, 'dfm@2019', 'default', 'tecnico', 'DFMCR'),
(88, 'Benvinda', 'Retrato', 'benvinda.retrato', 'benvinda.retrato@inacom.gov.ao', 0, 'daca@2019', 'default', 'tecnico', 'DACA'),
(89, 'Nelson', 'Nunes', 'nelson.nunes', 'nelson.nunes@inacom.gov.ao', 1010, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(90, 'Nelson', 'Simosa', 'nelson.simosa', 'nelson.simosa@inacom.gov.ao', 1010, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(91, 'Gerelson', 'Luís', 'gerelson.luis', 'gerelson.luis@inacom.gov.ao', 0, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(92, 'Lucas', 'Domingos', 'lucas.domingos', 'lucas.domingos@inacom.gov.ao', 0, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(93, 'Adriano', 'Chipongue', 'adriano.chipongue', 'adriano.chipongue@inacom.gov.ao', 0, 'dafsg@2019', 'default', 'tecnico', 'DAFSG'),
(94, 'Álvaro', 'Santos', 'alvaro.santos', 'alvaro.santos@inacom.gov.ao', 0, 'dfmcr123', 'default', 'chefe', 'DFMCR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anos`
--
ALTER TABLE `anos`
  ADD PRIMARY KEY (`id_ano`);

--
-- Indexes for table `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `tb_av_usuarios`
--
ALTER TABLE `tb_av_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_departamentos`
--
ALTER TABLE `tb_departamentos`
  ADD PRIMARY KEY (`dpto_id`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anos`
--
ALTER TABLE `anos`
  MODIFY `id_ano` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meses`
--
ALTER TABLE `meses`
  MODIFY `id_mes` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_av_usuarios`
--
ALTER TABLE `tb_av_usuarios`
  MODIFY `id` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tb_departamentos`
--
ALTER TABLE `tb_departamentos`
  MODIFY `dpto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `usuario_id` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
