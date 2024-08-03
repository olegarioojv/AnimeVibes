-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 03/08/2024 às 01:49
-- Versão do servidor: 8.0.37
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `moviestar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `movies`
--

CREATE TABLE `movies` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailer` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `length` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `users_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image`, `trailer`, `category`, `length`, `users_id`) VALUES
(8, 'Solo Leveling', 'Há mais de uma década, surgiu uma misteriosa passagem chamada \"portal\", que conecta este mundo a uma dimensão diferente, o que fez com que pessoas despertassem poderes únicos… e essas pessoas são chamadas de \"caçadores\". Os caçadores usam seus poderes sobre-humanos para conquistar masmorras dentro dos portais e assim ganhar a vida. Sung Jinwoo, um caçador de nível baixo, é considerado o caçador mais fraco de toda a humanidade. Certo dia, ele se depara com uma \"masmorra dupla\", que tem uma masmorra de nível alto escondida dentro de uma masmorra de nível baixo. Diante de um Jinwoo gravemente ferido, surge uma misteriosa missão! À beira da morte, Jinwoo decide aceitar essa missão, tornando-se assim a única pessoa capaz de subir de nível!', '958640d082e2489825eaa202c3976c2990e50c5ee3ed710e322724d2e22cc4536c287ee807be19e1ef7590f22c195582d4097cb37343a0b360500486.jpg', 'https://www.youtube.com/embed/ujv2fLp3lU8?si=rtqAXR6tWUykXvst', 'Ação', '23m', 8),
(9, 'Naruto Shippuden', 'Uzumaki Naruto quer ser o melhor ninja de todos. Ele está indo muito bem, mas com o perigo iminente imposto pela misteriosa Akatsuki, Naruto percebe que ele deve treinar mais que nunca e deixa sua Vila para um intenso treinamento que o pressiona contra seus limites.', 'd8c5d8d31c5e7156e528026a754388be47bf8f7e205d1b425c790ac75fbdfbd2be36a59c357370c9a29ed931e3a43a9aed574315b1ae5eaa978ffe14.jpg', 'https://www.youtube.com/embed/22R0j8UKRzY?si=AdqYXG8ubWWRuKtE', 'Ação', '23m', 8),
(10, 'One Piece', 'Houve um homem que conquistou tudo aquilo que o mundo tinha a oferecer, o lendário Rei dos Piratas, Gold Roger. Capturado e condenado à execução pelo Governo Mundial, suas últimas palavras lançaram legiões aos mares. \"Meu tesouro? Se quiserem, podem pegá-lo. Procurem-no! Ele contém tudo que este mundo pode oferecer!\".\r\n\r\nFoi a revelação do maior tesouro, o One Piece, cobiçado por homens de todo o mundo, sonhando com fama e riqueza imensuráveis... Assim começou a Grande Era dos Piratas!', '05d93c9674612ff9aa36b01f0cc77898b3f3f04d31d30cb56e4ef3b009e1c421c2637df14b52828af07eb8a202e9734a99b608437be0d436c3d94b5d.jpg', 'https://www.youtube.com/embed/_sJWa73bpP8?si=izWCs-e_3TYEC9tg\" title=\"YouTube video player', 'Aventura', '', 9),
(11, 'Berserk', 'Com uma história profunda, personagens fascinantes, uma arte arrebatadora e intrincada e um tino criativo sem igual, Berserk marcou as vidas e os corações dos leitores. Uma história fantástica que fascinou os fãs do Japão e do mundo todo, e é considerado uma das melhores séries de todos os tempos. Em um mundo onde espadas, magias e monstros estão por toda parte, ela retrata a magnífica vida do protagonista Guts. Lotado de ação de primeira, romance, cenas espetaculares e drama, Berserk cartamente vai conquistar a audiência!', '45e600cfbc7a9d26a0fcb56546430a39cf9e3efc61eeaff4a5c0fef2aabacd87da99cfc8f4b35fe4225b55dfa6813ee83c6ffc505634cce47c513c8b.jpg', 'https://www.youtube.com/embed/fJsOf8JTKXM?si=Xbwbqnyy3TGsRd71\" title=\"YouTube video player', 'Aventura', '24m', 9),
(14, 'JUJUTSU KAISEN', 'JUJUTSU KAISEN é um mangá escrito e ilustrado por Gege Akutami, serializado na Weekly Shonen Jump. Uma adaptação para anime foi lançada logo depois, com animação pelo estúdio MAPPA. Atualmente, já possui algumas temporadas, com a 1ª temporada (24 episódios) sendo seguida pelo aclamado filme prequel JUJUTSU KAISEN 0 e, em seguida, a 2ª temporada sendo lançada em julho de 2023. A série está disponível em versão legendada e dublada.\r\nAcompanhe o jovem Yuji Itadori nesta história de ação sombria e sobrenatural, enquanto ele treina as perigosas artes dos Feiticeiros Jujutsu e explora o violento mundo das maldições!\r\nYuji Itadori come um dedo amaldiçoado para salvar um colega de turma e agora Ryomen Sukuna, um terrível e poderoso feiticeiro conhecido como o Rei das Maldições, habita na alma de Itadori. As maldições são terrores sobrenaturais criados a partir das emoções humanas negativas. Esta energia amaldiçoada pode ser usada como fonte de energia, tanto pelos Feiticeiros Jujutsu como pelos espíritos amaldiçoados.\r\nGuiado pelos Feiticeiros Jujutsu, Yuji Itadori junta-se à Escola Jujutsu de Tóquio, uma organização que enfrenta as maldições. Sob a liderança do professor Satoru Gojo, Itadori faz amizade com Megumi Fushiguro e Nobara Kugisaki, ambos alunos do primeiro ano.', 'e1f8b719f4059b7f2ce0ecc22da04fc5fd4434c19a9446b82bcc88b9eae519a2b74a95a34ff57eadf3bf5e31cdad64a9c67f6c5771b05530d1b82758.jpg', 'https://www.youtube.com/embed/ynr6gnyu9NE?si=ftNSh0OpQ8SG1zDT', 'Ação', '23m', 10),
(15, 'Tokyo Revengers', 'Takemichi Hanagaki é um desempregado que sobrevive de bicos e está na fossa. Ele descobriu que Hinata Tachibana, sua primeira e última namorada, com quem namorou no fundamental, foi morta pela impiedosa Gangue Manji de Tóquio. No dia seguinte à notícia, ele está na beira da plataforma do trem e é empurrado pela multidão. Ele fecha os olhos se preparando para morrer, mas ao abrir, ele voltou no tempo para quando tinha 12 anos de idade. Agora que ele está na melhor época de sua vida, Takemichi decide se vingar de sua vida, salvando sua namorada e parando de fugir de si mesmo.', 'd743d472758d827a7aed77100d0c212d55a422472ee23359cc1e0cd35722dc02c27af217d4da99b26bc9c4e4388b2ef08de914f96893adec2074e4ee.jpg', 'https://www.youtube.com/embed/idlLFNNpZiI?si=BeEX-keSTA0V_JF4\" title=\"YouTube video player', 'Drama', '23m', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reviews`
--

CREATE TABLE `reviews` (
  `id` int UNSIGNED NOT NULL,
  `rating` int DEFAULT NULL,
  `review` text COLLATE utf8mb4_general_ci,
  `users_id` int UNSIGNED DEFAULT NULL,
  `movies_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `review`, `users_id`, `movies_id`) VALUES
(2, 10, 'Muitooo fodaaa!', 8, 11),
(3, 10, 'Animação Incrivel', 8, 10),
(4, 5, 'Pouca briga ', 8, 15),
(5, 10, 'Time do Satoru Gojo', 9, 14),
(6, 9, 'Muitoo chatoo', 9, 9),
(7, 10, 'Melhor lançamento de 2024', 9, 8),
(8, 5, 'Não gosteii', 10, 9),
(9, 10, 'Muitoo bom', 10, 8),
(10, 5, 'Bom', 8, 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `image`, `token`, `bio`) VALUES
(8, 'João', 'Victor', 'olegarioo.jv@gmail.com', '$2y$10$sWOMnoe1//OHl79XTsx18uiJPFYitpniGfa2K44kbwOKLET/299p6', '4c7bb02727fc5ae4554f42ee2337e62e836b7a516021cfb140f1426f5b6ddbd4e451b34acb0ac02eb6e9a86135e25adc492f9ae746380ac986e262a3.jpg', '2663b89ca5524b9eadbcdca9287bc5e4e639843be147624f72d7f77eb94a820a536f8e29bcc02f5c07ca96923303079dfffd', ''),
(9, 'Nicolas', 'Linare', 'nicolas@gmail.com', '$2y$10$yuWULLe.a.xesNIj7VovqeQ9XDcI8QOoNePPVj1SUmtFD/RQpTzc2', NULL, '51d5421b50bdd2c887445318b9f8ad45e35998fe3ba3def8383def89069d87fb690b527889c1822b18e8ced999a8edf929f9', NULL),
(10, 'Thiago', 'Martins', 'thigo@gmail.com', '$2y$10$pJeZVXBhbIdE/a999WzLNu9G.Vkc.soL1dFhbtj/17RzDvfJTVc2O', NULL, '9453e2b7ff454e5c2bed152098dad929784c8d8ef5757ee480ca6353ec3f05f846203bff0111e2783dbb7e836471e5d58958', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices de tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `movies_id` (`movies_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movies_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
