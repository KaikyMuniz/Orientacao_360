-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Dez-2023 às 22:29
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `orientacao_360_bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campo`
--

DROP TABLE IF EXISTS `campo`;
CREATE TABLE IF NOT EXISTS `campo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `imagens` text NOT NULL,
  `quantidadeCampos` int NOT NULL,
  `subtitulo` text NOT NULL,
  `campo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `campo_id` (`campo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `campo`
--

INSERT INTO `campo` (`id`, `titulo`, `imagens`, `quantidadeCampos`, `subtitulo`, `campo_id`) VALUES
(1, '[{\"campo1\": \"A FUVEST é responsável por aplicar o vestibular para ingresso na Universidade de São Paulo (USP), uma das mais prestigiadas universidades do Brasil. Os conteúdos que mais frequentemente aparecem nas provas da FUVEST variam de acordo com o curso e a área de conhecimento, mas, de maneira geral, os cinco conteúdos mais comuns costumam ser:\"}, {\"campo2\": \"Esta seção da prova da FUVEST avalia a capacidade dos candidatos de compreender e interpretar textos de diversos gêneros, desde textos literários a textos informativos. Além disso, os candidatos precisam demonstrar conhecimento em gramática e análise textual. Questões de literatura podem abranger obras clássicas da literatura brasileira, como as de Machado de Assis.\"}, {\"campo3\": \"A prova de matemática na FUVEST é amplamente reconhecida por sua complexidade, abrangendo temas que vão desde álgebra e geometria até cálculo. Os candidatos enfrentam desafios que exigem resolução de problemas intricados e uma demonstração sólida de conhecimento matemático. Esta seção é crucial para avaliar a capacidade dos candidatos em aplicar princípios matemáticos em contextos variados.\"}, {\"campo4\": \"Essa seção é relevante para candidatos interessados em cursos na área de Ciências Exatas e Biológicas. Pode incluir questões de física, química e biologia. Os tópicos cobertos podem variar, mas geralmente incluem mecânica, termodinâmica, química orgânica e inorgânica, ecologia, genética e anatomia. \"}, {\"campo5\": \"A prova de história da FUVEST costuma cobrir uma ampla gama de períodos históricos, desde o Brasil Colônia até o século contemporâneo. Questões podem abranger temas como a colonização, a independência do Brasil, a escravidão, a República Velha, as guerras mundiais, o regime militar e eventos mais recentes.\"}, {\"campo6\": \"Questões de geografia na FUVEST abrangem desde aspectos geográficos do Brasil, como o clima, a vegetação, a economia e a demografia, até tópicos de geopolítica, como as relações internacionais do Brasil e questões ambientais globais. Compreender a dinâmica espacial e os desafios geográficos é crucial para responder a questões nessa seção.\"}]', '[{\"arquivo1\": \"empreendedorismo.jpg\"}, {\"arquivo2\": \"finanças.jpg\"}, {\"arquivo3\": \"historia.jpg\"}]', 6, '[{\"subtitulo1\": \"\"}, {\"subtitulo2\": \"Língua Portuguesa e Literatura\"}, {\"subtitulo3\": \"Matemática\"}, {\"subtitulo4\": \"Ciências da Natureza e Biologia\"}, {\"subtitulo5\": \"História\"}, {\"subtitulo6\": \"Geografia\"}]', 1),
(10, '[{\"campo1\": \"O mercado para jovens profissionais continua desafiador. A concorrência é alta e encontrar oportunidades que correspondam às expectativas e habilidades pode ser complexo. A falta de experiência muitas vezes é uma barreira para a entrada no mercado. O mercado para jovens profissionais continua \\\"desafiador\\\".\"}, {\"campo2\": \"As empresas estão cada vez mais valorizando habilidades digitais. Jovens com conhecimentos em programação, análise de dados e marketing digital têm mais chances de se destacar e conseguir empregos bem remunerados. As empresas estão cada vez mais valorizando habilidades digitais. Jovens com conhecimentos em programação, análise de dados marketing digital têm mais chances de se destacar.\"}, {\"campo3\": \"A pandemia acelerou a necessidade de adaptação. Muitos jovens precisaram se ajustar a ambientes de trabalho remotos. A flexibilidade para lidar com mudanças e a capacidade de se adaptar rapidamente se tornaram habilidades essenciais. A pandemia acelerou a necessidade de adaptação. Muitos jovens precisaram se ajustar a ambientes de trabalho remotos. A flexibilidade para lidar com mudanças e a capac\"}, {\"campo4\": \"Além da formação acadêmica tradicional, os jovens estão buscando aprendizado em plataformas online, cursos especializados e programas de mentoria. Essa busca por conhecimento adicional é crucial para se manter relevante no mercado de trabalho em constante evolução.\"}]', '[{\"arquivo1\": \"caminhos educacionais.jpg\"}, {\"arquivo2\": \"finanças.jpg\"}, {\"arquivo3\": \"historia.jpg\"}]', 4, '[{\"subtitulo1\": \"Desafios persistentes:\"}, {\"subtitulo2\": \"Demanda por habilidades digitais\"}, {\"subtitulo3\": \"Flexibilidade e adaptação\"}, {\"subtitulo4\": \" Educação além da academia\"}]', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudos_cards`
--

DROP TABLE IF EXISTS `conteudos_cards`;
CREATE TABLE IF NOT EXISTS `conteudos_cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `data_publicacao` date NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conteudos_cards`
--

INSERT INTO `conteudos_cards` (`id`, `titulo`, `descricao`, `data_publicacao`, `imagem`, `link`) VALUES
(56, 'Dicas para Currículo Vencedor', 'Aprenda a criar um currículo impressionante e se destacar nas seleções de emprego.', '2023-03-18', '../img/tela Videos/papel.jpg', 'https://www.youtube.com/watch?v=Yu9oe8UJGak'),
(57, 'Cursos Online Gratuitos', 'Descubra plataformas que oferecem cursos online gratuitos para aprimorar suas habilidades', '2023-08-12', '../img/tela Videos/curso online.jpg', 'https://www.youtube.com/watch?v=LmYTURKZRRI'),
(58, 'Entrevista de Emprego Prepare-se', 'Dicas valiosas para se preparar para entrevistas e causar uma boa impressão.', '2023-05-15', '../img/tela Videos/video 6.jpg', 'https://www.youtube.com/watch?v=XvuZAqB_K9I'),
(60, 'Educação Financeira aos Jovens', 'Aprenda a administrar suas finanças desde cedo e conquiste estabilidade.', '2023-07-05', '../img/tela Videos/educação finaceira.jpg', 'https://www.youtube.com/watch?v=mrcLD8Siv8Y'),
(66, 'Estágios: Portas para o Mercado', 'Aproveite oportunidades de estágio e programas de trainee para lançar sua carreira.', '2023-12-18', '../img/tela Videos/documento.jpg', 'https://www.youtube.com/watch?v=iQEXuSBMAgE'),
(67, 'Lidando com o Estresse', 'Estratégias para equilibrar seus estudos e evitar o estresse excessivo.', '2023-12-19', '../img/tela Videos/estresse.jpg', 'https://www.youtube.com/watch?v=OTzb2zFTBlk');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias_cards`
--

DROP TABLE IF EXISTS `noticias_cards`;
CREATE TABLE IF NOT EXISTS `noticias_cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tag1` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tag2` varchar(40) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `data_publicacao` date NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticias_cards`
--

INSERT INTO `noticias_cards` (`id`, `titulo`, `tag1`, `tag2`, `descricao`, `link`, `data_publicacao`, `imagem`) VALUES
(1, '5- Conteúdos que caem na FUVEST', 'Vestibular', 'Desenvolvimento', 'Confira aqui os 5 principais temas que caem na FUVEST e que sem dúvidas estarão presentes no vestibular da FUVEST de 2023', 'https://www.fuvest.br/', '2023-10-26', '../img/tela Card de Notícias/comunicação poder.jpg'),
(10, 'Mercado de Trabalho para Jovens', 'Aprender', 'Trabalho', 'O mercado para jovens profissionais continua desafiador. A concorrência é alta e encontrar oportunidades é difícil.', 'google.com', '2023-12-04', '../img/tela Card de Notícias/estudo.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

DROP TABLE IF EXISTS `pergunta`;
CREATE TABLE IF NOT EXISTS `pergunta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `alternativas` text NOT NULL,
  `correto` text NOT NULL,
  `quantidadePerguntas` int NOT NULL,
  `descricaoFinal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pergunta_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pergunta`
--

INSERT INTO `pergunta` (`id`, `titulo`, `alternativas`, `correto`, `quantidadePerguntas`, `descricaoFinal`, `pergunta_id`) VALUES
(1, '[{\"pergunta1\": \"(Enem/2016) A filosofia grega parece começar com uma ideia absurda, com a proposição: a água é a origem e a matriz de todas as coisas. Será mesmo necessário deter-nos nela e levá-la a sério? Sim, e por três razões: em primeiro lugar, porque essa proposição enuncia algo sobre a origem das coisas; em segundo lugar, porque o faz sem imagem e fabulação; e, enfim, em terceiro lugar, porque nela, embora apenas em estado de crisálida, está contido o pensamento: Tudo é um.<br>O que, de acordo com Nietzsche, caracteriza o surgimento da filosofia entre os gregos?\"}, {\"pergunta2\": \"(Enem/2014) A transferência da corte trouxe para a América portuguesa a família real e o governo da Metrópole. Trouxe também, e sobretudo, boa parte do aparato administrativo português. Personalidades diversas e funcionários régios continuaram embarcando para o Brasil atrás da corte, dos seus empregos e dos seus parentes após o ano de 1808.<br>Os fatos apresentados se relacionam ao processo de independência da América portuguesa por terem\"}, {\"pergunta3\": \"(Enem/2013) Para a identificação de um rapaz vítima de acidente, fragmentos de tecidos foram retirados e submetidos à extração de DNA nuclear, para comparação com o DNA disponível dos possíveis familiares (pai, avô materno, avó materna, filho e filha). Como o teste com o DNA nuclear não foi conclusivo, os peritos optaram por usar também DNA mitocondrial, para dirimir dúvidas.  Para identificar o corpo, os peritos devem verificar se há homologia entre o DNA mitocondrial do rapaz e o DNA mitocondrial do(a)\"}, {\"pergunta4\": \"(Enem/2018) Os países industriais adotaram uma concepção diferente das relações familiares e do lugar da fecundidade na vida familiar e social. A preocupação de garantir uma transmissão integral das vantagens econômicas e sociais adquiridas tem como resultado uma ação voluntária de limitação do número de nascimentos.<br>Em meados do século XX, o fenômeno social descrito contribuiu para o processo europeu de\"}, {\"pergunta5\": \"(Enem/2015) Um carro esportivo e financiado pelo Japão, projetado na Itália e montado em Indiana, México e França, usando os mais avançados componentes eletrônicos, que foram inventados em Nova Jérsei e fabricados na Coreia. A campanha publicitária é desenvolvida na Inglaterra, filmada no Canadá, a edição e as cópias, feitas em Nova York para serem veiculadas no mundo todo. Teias globais disfarçam-se com o uniforme nacional que lhes for mais conveniente.<br>A viabilidade do processo de produção ilustrado pelo texto pressupõe o uso de\"}]', '{\"alternativa 1 da pergunta 1\": \"a) De acordo com Nietzsche, caracteriza o surgimento da filosofia entre os gregos?\", \"alternativa 1 da pergunta 2\": \"a) incentivado o clamor popular por liberdade.\", \"alternativa 1 da pergunta 3\": \"a) pai.\", \"alternativa 1 da pergunta 4\": \"A) estabilização da pirâmide etária.\", \"alternativa 1 da pergunta 5\": \"A) linhas de montagem e formação de estoques.\", \"alternativa 2 da pergunta 1\": \"b) O desejo de explicar, usando metáforas, a origem dos seres e das coisas.\", \"alternativa 2 da pergunta 2\": \"b) enfraquecido o pacto de dominação metropolitana.\", \"alternativa 2 da pergunta 3\": \"b) filho.\", \"alternativa 2 da pergunta 4\": \"B) conclusão da transição demográfica.\", \"alternativa 2 da pergunta 5\": \"B) empresas burocráticas e mão de obra barata.\", \"alternativa 3 da pergunta 1\": \"c) A necessidade de buscar, de forma racional, a causa primeira das coisas existentes.\", \"alternativa 3 da pergunta 2\": \"c) motivado as revoltas escravas contra a elite colonial.\", \"alternativa 3 da pergunta 3\": \"c) filha.\", \"alternativa 3 da pergunta 4\": \"C) contenção da entrada de imigrantes.\", \"alternativa 3 da pergunta 5\": \"C) controle estatal e infraestrutura consolidada.\", \"alternativa 4 da pergunta 1\": \"d) A ambição de expor, de maneira metódica, as diferenças entre as coisas.\", \"alternativa 4 da pergunta 2\": \"d) obtido o apoio do grupo constitucionalista português.\", \"alternativa 4 da pergunta 3\": \"d) avó materna.\", \"alternativa 4 da pergunta 4\": \"D) elevação do crescimento vegetativo.\", \"alternativa 4 da pergunta 5\": \"D) organização em rede e tecnologia de informação.\", \"alternativa 5 da pergunta 1\": \"e) A tentativa de justificar, a partir de elementos empíricos, o que existe no real.\", \"alternativa 5 da pergunta 2\": \"e) provocado os movimentos separatistas das províncias.\", \"alternativa 5 da pergunta 3\": \"e) avô materno.\", \"alternativa 5 da pergunta 4\": \"E) formação de espaços superpovoados.\", \"alternativa 5 da pergunta 5\": \"E) gestão centralizada e protecionismo econômico.\"}', '[{\"correta1\": 4}, {\"correta2\": \"2\"}, {\"correta3\": \"4\"}, {\"correta4\": \"2\"}, {\"correta5\": \"4\"}]', 5, '0 - 2 Acertos: Estude um pouco mais<br>\r\n3 Acertos: Tá na média, mas pode melhorar mais!<br>\r\n4 - 5 Acertos: Perfeito!!', 1),
(2, '[{\"pergunta1\": \"A loja Preço bom está vendendo um conjunto com 5 camisas por um preço promocional. Cada unidade sai por R$ 31,45 e o conjunto das cinco camisas sai pelo preço de quatro. Se optar pelo conjunto, o cliente pode dividir o valor em três vezes sem juros. De quanto será o preço da parcela?\"}, {\"pergunta2\": \"Qual é a raiz quadrada de 144?\"}, {\"pergunta3\": \"Qual é o valor de ? (pi) arredondado para duas casas decimais?\"}, {\"pergunta4\": \"Quanto é 5² (5 elevado a segunda potência)?\"}, {\"pergunta5\": \"Qual é a soma dos ângulos internos de um triângulo?\"}, {\"pergunta6\": \"Qual é o resultado de 3/4 + 1/4?\"}, {\"pergunta7\": \"Qual é o próximo número na sequência: 1, 1, 2, 3, 5, 8, ...?\"}, {\"pergunta8\": \"Com base no que sabe, calcule: 9 x 7 - 5?\"}, {\"pergunta9\": \"Qual é o valor de x na equação 2x + 5 = 15?\"}, {\"pergunta10\": \"Qual é a área de um retângulo com comprimento 8 unidades e largura 6 unidades?\"}, {\"pergunta11\": \"Qual é o número primo mais próximo de 50?\"}, {\"pergunta12\": \"Se um carro viaja a uma velocidade constante de 60 km/h, quantos quilômetros ele percorre em 2 horas?\"}]', '{\"alternativa 1 da pergunta 1\": \"a) R$ 40,59\", \"alternativa 1 da pergunta 2\": \"a) 12\", \"alternativa 1 da pergunta 3\": \"a) 3.14\", \"alternativa 1 da pergunta 4\": \"a) 10\", \"alternativa 1 da pergunta 5\": \"a) 90 graus\", \"alternativa 1 da pergunta 6\": \"a) 1/2\", \"alternativa 1 da pergunta 7\": \"a) 10\", \"alternativa 1 da pergunta 8\": \"a) 54\", \"alternativa 1 da pergunta 9\": \"a) 5\", \"alternativa 2 da pergunta 1\": \"b) R$ 41,25\", \"alternativa 2 da pergunta 2\": \"b) 8\", \"alternativa 2 da pergunta 3\": \"b) 3.141\", \"alternativa 2 da pergunta 4\": \"b) 15\", \"alternativa 2 da pergunta 5\": \"b) 120 graus\", \"alternativa 2 da pergunta 6\": \"b) 3/4\", \"alternativa 2 da pergunta 7\": \"b) 13\", \"alternativa 2 da pergunta 8\": \"b) 58\", \"alternativa 2 da pergunta 9\": \"b) 10\", \"alternativa 3 da pergunta 1\": \"c) R$ 42,10\", \"alternativa 3 da pergunta 2\": \"c) 10\", \"alternativa 3 da pergunta 3\": \"c) 3.1416\", \"alternativa 3 da pergunta 4\": \"c) 20\", \"alternativa 3 da pergunta 5\": \"c) 180 graus\", \"alternativa 3 da pergunta 6\": \"c) 1\", \"alternativa 3 da pergunta 7\": \"c) 16\", \"alternativa 3 da pergunta 8\": \"c) 59\", \"alternativa 3 da pergunta 9\": \"c) 15\", \"alternativa 4 da pergunta 1\": \"d) R$ 41,93\", \"alternativa 4 da pergunta 2\": \"d) 14\", \"alternativa 4 da pergunta 3\": \"d) 3.14159\", \"alternativa 4 da pergunta 4\": \"d) 25\", \"alternativa 4 da pergunta 5\": \"d) 270 graus\", \"alternativa 4 da pergunta 6\": \"d) 1/4\", \"alternativa 4 da pergunta 7\": \"d) 21\", \"alternativa 4 da pergunta 8\": \"d) 60\", \"alternativa 4 da pergunta 9\": \"d) 20\", \"alternativa 5 da pergunta 1\": \"e) R$ 42,47\", \"alternativa 5 da pergunta 2\": \"e) 16\", \"alternativa 5 da pergunta 3\": \"e) 3.141592\", \"alternativa 5 da pergunta 4\": \"e) 30\", \"alternativa 5 da pergunta 5\": \"e) 360 graus\", \"alternativa 5 da pergunta 6\": \"e) 2/3\", \"alternativa 5 da pergunta 7\": \"e) 34\", \"alternativa 5 da pergunta 8\": \"e) 61\", \"alternativa 5 da pergunta 9\": \"e) 25\", \"alternativa 1 da pergunta 10\": \"a) 14 unidades quadradas\", \"alternativa 1 da pergunta 11\": \"a) 45\", \"alternativa 1 da pergunta 12\": \"a) 30 km\", \"alternativa 2 da pergunta 10\": \"b) 42 unidades quadradas\", \"alternativa 2 da pergunta 11\": \"b) 51\", \"alternativa 2 da pergunta 12\": \"b) 60 km\", \"alternativa 3 da pergunta 10\": \"c) 48 unidades quadradas\", \"alternativa 3 da pergunta 11\": \"c) 53\", \"alternativa 3 da pergunta 12\": \"c) 120 km\", \"alternativa 4 da pergunta 10\": \"d) 56 unidades quadradas\", \"alternativa 4 da pergunta 11\": \"d) 55\", \"alternativa 4 da pergunta 12\": \"d) 90 km\", \"alternativa 5 da pergunta 10\": \"e) 64 unidades quadradas\", \"alternativa 5 da pergunta 11\": \"e) 59\", \"alternativa 5 da pergunta 12\": \"e) 45 km\"}', '[{\"correta1\": \"4\"}, {\"correta2\": \"1\"}, {\"correta3\": \"1\"}, {\"correta4\": \"4\"}, {\"correta5\": \"3\"}, {\"correta6\": \"3\"}, {\"correta7\": \"2\"}, {\"correta8\": \"2\"}, {\"correta9\": \"2\"}, {\"correta10\": \"5\"}, {\"correta11\": \"3\"}, {\"correta12\": \"3\"}]', 12, '0 - 2: Dá pra evoluir\r\n<br>3 - 6: Iniciante\r\n<br>7 - 9: Intermediário\r\n<br>10 - 12: Mestre', 2),
(5, '[{\"pergunta1\":\"Você está trabalhando em um projeto de equipe que tem um prazo apertado. Um colega de equipe está sobrecarregado e precisa de ajuda. O que você faz?\"},{\"pergunta2\":\"Durante uma reunião de equipe, um colega de trabalho apresenta uma ideia que você acredita que está errada e pode prejudicar o projeto. O que você faz?\"},{\"pergunta3\":\"Seu chefe atribui a você uma tarefa que você não gosta e não acha que está em sua descrição de cargo. Como você reage?\"},{\"pergunta4\":\"Durante um projeto, um colega de equipe comete um erro que pode afetar negativamente o resultado final. O que você faz?\"},{\"pergunta5\":\"Você está trabalhando em um projeto que exige longas horas de trabalho e dedicação. Um colega de equipe está doente e precisa de alguém para cobrir seu turno durante um fim de semana. O que você faz?\"}]', '{\"alternativa 1 da pergunta 1\":\"a) Deixa o colega se virar, afinal, ele deve aprender a lidar com a pressão.\",\"alternativa 2 da pergunta 1\":\"b) Oferece sua ajuda e apoio ao colega para garantir que o projeto seja concluído a tempo.\",\"alternativa 3 da pergunta 1\":\"c) Reclama com o gerente sobre a carga de trabalho injusta.\",\"alternativa 4 da pergunta 1\":\"d) Tira férias inesperadas e deixa o projeto para trás.\",\"alternativa 5 da pergunta 1\":\"e) Sugerir que o colega peça demissão.\",\"alternativa 1 da pergunta 2\":\"a) Fica quieto e não diz nada para evitar conflitos.\",\"alternativa 2 da pergunta 2\":\"b) Compartilha suas preocupações de maneira construtiva e sugere alternativas.\",\"alternativa 3 da pergunta 2\":\"c) Desqualifica a ideia do colega na frente de todos.\",\"alternativa 4 da pergunta 2\":\"d) Desiste do projeto e abandona a equipe.\",\"alternativa 5 da pergunta 2\":\"e) Fala mal do colega para outros membros da equipe.\",\"alternativa 1 da pergunta 3\":\"a) Recusa a tarefa e diz ao chefe que não é sua responsabilidade.\",\"alternativa 2 da pergunta 3\":\"b) Entra em greve no trabalho.\",\"alternativa 3 da pergunta 3\":\"c) Procura um novo emprego imediatamente.\",\"alternativa 4 da pergunta 3\":\"d) Faz a tarefa de qualquer maneira, sem se importar com a qualidade.\",\"alternativa 5 da pergunta 3\":\"e) Aceita a tarefa e a realiza da melhor maneira possível.\",\"alternativa 1 da pergunta 4\":\"a) Conversa com o colega de equipe sobre o erro e ajuda a encontrar uma solução.\",\"alternativa 2 da pergunta 4\":\"b) Ignora o erro e espera que ninguém perceba.\",\"alternativa 3 da pergunta 4\":\"c) Relata o erro ao gerente e pede para ser removido do projeto.\",\"alternativa 4 da pergunta 4\":\"d) Sabota o colega de equipe para que ele seja demitido.\",\"alternativa 5 da pergunta 4\":\"e) Ri do erro do colega de equipe.\",\"alternativa 1 da pergunta 5\":\"a) Recusa-se a ajudar, pois já tem muito trabalho.\",\"alternativa 2 da pergunta 5\":\"b) Sugere que o colega doente deve lidar com sua própria situação.\",\"alternativa 3 da pergunta 5\":\"c) Oferece-se caso possa, para cobrir o turno do colega e garantir que o projeto prossiga.\",\"alternativa 4 da pergunta 5\":\"d) Abandona o projeto e se recusa a ajudar o colega de equipe.\",\"alternativa 5 da pergunta 5\":\"e) Fala mal para os outros sobre o colega de equipe.\"}', '[{\"correta1\":\"2\"},{\"correta2\":\"2\"},{\"correta3\":\"5\"},{\"correta4\":\"1\"},{\"correta5\":\"3\"}]', 5, '5 acertos: Excelente! Suas habilidades de resolução de problemas e interação com colegas são excepcionais. Continue aprimorando suas competências.\r\n<br>\r\n4 acertos: Você está no caminho certo, demonstrando habilidades sólidas no trabalho. Foque em melhorar a tomada de decisões e colaboração.\r\n<br>\r\n3 acertos: Seu desempenho é bom, mas há espaço para melhorias. Trabalhe na comunicação e resolução de conflitos para resultados melhores.\r\n<br>\r\n1 ou 2 acertos: Há espaço para melhorias em sua abordagem.', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quizzes_cards`
--

DROP TABLE IF EXISTS `quizzes_cards`;
CREATE TABLE IF NOT EXISTS `quizzes_cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tag1` varchar(40) NOT NULL,
  `tag2` varchar(40) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `quizzes_cards`
--

INSERT INTO `quizzes_cards` (`id`, `titulo`, `tag1`, `tag2`, `descricao`, `imagem`) VALUES
(1, 'Se prepare para o ENEM 2023', 'Aprender', 'Corporativo', 'Se prepare para a prova do ENEM com esse simulado que aborda temas diversos que são recorrentes no exame', '../img/tela Card de Quiz/objetivos de carreira.jpg'),
(2, 'Teste de Matemática', 'Aprender', 'Corporativo', 'Teste os seus conhecimentos matemáticos com este quiz! São 12 perguntas de diferentes áreas da matemática', '../img/tela Card de Quiz/estilo de aprendizagem.jpg'),
(5, 'Quiz Vocacional: Escolha a Melhor Abordagem no Trabalho', 'Vocacional', 'Corporativo', 'Este quiz foi projetado para ajudá-lo a entender melhor como você aborda situações comuns no ambiente de trabalho', '../img/tela Card de Quiz/equipe trabalho.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nascimento` date NOT NULL,
  `email_recuperacao` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `avatar` varchar(9) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nome_personagem` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `criacao` varchar(20) NOT NULL,
  `quizzes_feitos` varchar(255) NOT NULL,
  `xp` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `nascimento`, `email_recuperacao`, `senha`, `avatar`, `nome_personagem`, `criacao`, `quizzes_feitos`, `xp`) VALUES
(1, 'Admin@', '2006-03-03', '$2y$10$RiDKwi8gklHktuCm4OSORuuLUJgxLwvnjQAuEFr84J2df7C..LFpO', '$2y$10$FBfMRhxCxeK4bRTDUiT6j.ENUGTxI2bbO2llZtpoquhNZ1p/WjKua', '0.png', 'Admin', '23/08/2023', '', 0),
(2, 'Kaiky', '2006-03-03', '$2y$10$ea/lgpzhVqg0rh3PlNcbP.uf2e9jst6810.8JH.iyh7qbmr7080cu', '$2y$10$w9zWiv69wZRgwgBVWujlsel5.HXQL/TTZPzo1tbyOM2yRmCRBqNVy', '11.png', 'Jamilton', '28/10/2023', '2, ', 500),
(3, 'Helena', '2006-04-22', '$2y$10$0AfiaIZkq.PiVb7wF8eBoeKP1s9/yzehVpBDcUddvjfvnVKrFJb2O', '$2y$10$X.AgSS1Us0OVS3nY7YIb3uYSBWmuAUBHooXljK8KcU74.uxfj4u6K', '2.png', 'Mister X', '29/10/2023', '', 35),
(4, 'Kaiky_Muniz', '2006-03-03', '$2y$10$E2UIph.hKjAEHBjfCmZGBu76YFQaNYt9SOJ9tm562Tr2YQJYqwvpu', '$2y$10$prJBepBiEPum/k1o4kuxIO0QSB2THPBtvXrWx1mg.E8MW6emugpku', '15.png', 'KiwiComQueijo', '01/11/2023', '2, 5, 1, ', 116),
(5, 'KaikyMuniz', '2006-03-03', '$2y$10$OonX9dPmEiN.zBGWWMMHFOUPbfwM6mcl/nQiJVTw2aAvhuHWRi8nO', '$2y$10$kuTmoJxenhJOCbw8YGtyt.n/SDabiV9HvTdZFFDhJ3UE2vNwjAoDy', '0.png', 'Mister X', '04/11/2023', '', 0),
(12, 'Laura', '2005-08-23', '$2y$10$IUdZtIlCvzL8Uzqv5YTGz.a4jnQ62zpuYoNVOwbrvs53rqFMFmSw6', '$2y$10$8oeILf5pSs8X5ua3TwT06.ZltkiR.i91YS7WNO4wutSVeGmi08Ipu', '18.png', 'Laurinha', '01/11/2023', '', 470);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
