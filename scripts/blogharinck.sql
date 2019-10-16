-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 16 Octobre 2019 à 23:21
-- Version du serveur :  5.7.26-0ubuntu0.16.04.1
-- Version de PHP :  7.0.33-8+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blogharinck`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'TECH'),
(2, 'MOBILE'),
(3, 'SMARTPHONES'),
(5, 'OBJETS CONNECTES'),
(6, 'APPLICATIONS'),
(7, 'GAMING'),
(8, 'STARTUPS');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `content` text,
  `date` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_user`, `id_post`, `content`, `date`) VALUES
(5, 1, 37, 'Hello Word !', '1570652175'),
(7, 2, 32, 'Je teste les commentaires, et c\'est gÃ©nial.', '1570653563'),
(8, 1, 40, 'Pas mal le website en vrai lol', '1571077635'),
(9, 1, 40, 'Enoooooooorme', '1571077646'),
(10, 1, 37, 'Salut Arthur', '1571208505'),
(15, 1, 39, 'Je teste les commentaires, EN ORIENTÃ‰ OBJET !', '1571259734'),
(16, 1, 83, 'super mdrrr', '1571259796'),
(17, 22, 84, 'super !!!', '1571260773');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `image` text,
  `title` text,
  `content` text,
  `categorie` int(11) DEFAULT NULL,
  `date` text,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `image`, `title`, `content`, `categorie`, `date`, `views`) VALUES
(32, 1, 'https://www.presse-citron.net/wordpress_prod/wp-content/uploads/2019/10/Chargeur-iPhone11-Pro.jpg', 'Sur iOS 13, une solution radicale pour dire adieu aux dÃ©marcheurs tÃ©lÃ©phoniques', 'Les spams tÃ©lÃ©phoniques sont une plaie qui nâ€™Ã©pargne personne. True Caller, une application qui permet aux utilisateurs de smartphones dâ€™identifier et de bloquer ces appels indÃ©sirables, indique avoir aidÃ© ses utilisateurs Ã  bloquer plus de 17,7 milliards de spams, rien quâ€™en 2018.<br />\r\n<br />\r\nFace Ã  ce problÃ¨me, Google et Apple songent aussi Ã  des solutions directement intÃ©grÃ©es aux systÃ¨mes dâ€™exploitation mobiles pour que leurs utilisateurs ne soient plus dÃ©rangÃ©s par ces appels.<br />\r\n<br />\r\nGoogle, par exemple, dÃ©veloppe une fonctionnalitÃ© (basÃ©e sur son intelligence artificielle) baptisÃ©e Call Screen pour Android contre ce phÃ©nomÃ¨ne.<br />\r\n<br />\r\nQuant Ã  Apple, sur iOS 13, il propose dÃ©jÃ  une fonctionnalitÃ© qui permet de ne plus recevoir les appels des personnes qui ne sont pas dans votre liste de contacts. Câ€™est radical, mais efficace.', 5, '1570646158', 267),
(33, 2, 'https://www.presse-citron.net/wordpress_prod/wp-content/uploads/2019/04/cellphone-cellular-telephone-close-up-1279365.jpg', 'Enfin une bonne raison dâ€™avoir plusieurs Google Home dans la maison', 'Si vous nâ€™avez encore quâ€™une enceinte connectÃ©e chez vous, cette nouvelle fonctionnalitÃ© de Google Assistant va peut-Ãªtre vous inciter Ã  en acheter dâ€™autres, afin que la technologie soit disponible dans toutes les piÃ¨ces de votre maison.<br />\r\n<br />\r\nGoogle vient de prÃ©senter une nouvelle fonctionnalitÃ© de son assistant baptisÃ©e Â« stream transfer Â». GrÃ¢ce Ã  celle-ci, la musique que vous Ã©coutez pourra vous suivre de piÃ¨ce en piÃ¨ce, Ã  condition dâ€™avoir plusieurs enceintes.<br />\r\n<br />\r\nÂ« Maintenant que des millions dâ€™utilisateurs disposent de plusieurs tÃ©lÃ©viseurs, haut-parleurs intelligents et Ã©crans intelligents (dans chaque piÃ¨ce !), nous voulions permettre aux utilisateurs de contrÃ´ler facilement leurs mÃ©dias lorsquâ€™ils se dÃ©placent de piÃ¨ce en piÃ¨ce Â», explique Chris Chan, product manager chez Google Nest.<br />\r\n<br />\r\n', 5, '1570646185', 6),
(34, 1, 'https://www.presse-citron.net/wordpress_prod/wp-content/uploads/2018/10/micro-edito-400x240.jpg', 'Tablettes, smartphonesâ€¦ Et si les vraies innovations venaient de chez Microsoft ?', 'Depuis quelque temps, et plus particuliÃ¨rement depuis lâ€™arrivÃ©e de Satya Nadella Ã  la tÃªte de lâ€™empire, il est de bon ton dâ€™affirmer que Microsoft est (re)devenu cool. Si le passage Ã  Windows 10 ne sâ€™est quand mÃªme pas fait sans douleur pour de nombreux utilisateurs, la plÃ©thore de services dÃ©veloppÃ©s ces derniÃ¨res annÃ©es et lâ€™ouverture de la firme de Redmond Ã  ceux de la concurrence (y compris Linux !) a remis le gÃ©ant au cÅ“ur du jeu et les critiques sont beaucoup moins vives quâ€™Ã  une certaine Ã©poque.<br />\r\n<br />\r\nMais on a parfois un peu tendance Ã  oublier que Microsoft, câ€™est aussi beaucoup de Recherche et DÃ©veloppement dans le hardware et une gamme de produits qui sâ€™Ã©largit Ã  un rythme rÃ©gulier. Alors que Xbox et Hololens sont les stars de la marque, et que Microsoft nâ€™a pas laissÃ© un souvenir inoubliable avec Windows Phone, dâ€™autres produits Ã©mergent, et ceux prÃ©sentÃ©s la semaine derniÃ¨re semblent avoir particuliÃ¨rement retenu lâ€™attention des observateurs, des plus geeks aux plus Â« corporate Â».<br />\r\n<br />\r\n', 2, '1570646227', 15),
(35, 2, 'https://www.presse-citron.net/wordpress_prod/wp-content/uploads/2019/10/adobe-maduro.jpg', 'Pourquoi Adobe va dÃ©sactiver plusieurs milliers de comptes utilisateurs', 'Adobe, lâ€™entreprise informatique qui Ã©dite, entre autres, les cÃ©lÃ¨bres logiciels graphiques InDesign, Photoshop, et Illustrator, vient dâ€™annoncer que des milliers de comptes seraient dÃ©sactivÃ©s trÃ¨s prochainement. Pas de panique, cette annonce concerne uniquement le VÃ©nÃ©zuÃ©la. En effet, les relations ont fini de se dÃ©grader cet Ã©tÃ© entre Donald Trump et le prÃ©sident vÃ©nÃ©zuÃ©lien Nicolas Maduro, si bien que plusieurs sanctions Ã  lâ€™encontre de ce pays dâ€™AmÃ©rique du Sud ont Ã©tÃ© imposÃ©es par les Ã‰tats-Unis.<br />\r\n<br />\r\nAfin de se conformer aux sanctions imposÃ©es, Adobe se doit de dÃ©sactiver tous les comptes vÃ©nÃ©zuÃ©liens, et empÃªchera les abonnements. La sociÃ©tÃ© amÃ©ricaine a donnÃ© Ã  ses utilisateurs vÃ©nÃ©zuÃ©liens une deadline fixÃ©e au 28 octobre pour tÃ©lÃ©charger tous les fichiers stockÃ©s dans ses services. Adobe envoie actuellement aux utilisateurs concernÃ©s des e-mails contenant des instructions dÃ©taillÃ©es concernant cette dÃ©cision.<br />\r\n<br />\r\n', 1, '1570646259', 14),
(36, 1, 'https://www.presse-citron.net/wordpress_prod/wp-content/uploads/2019/10/dark-mode-instagram.jpeg', 'Comment activer et dÃ©sactiver le dark mode sur Instagram ?', 'Ã‡a y est. Facebook initie le mode sombre sur lâ€™Ã©cosystÃ¨me de ses applications, alors que Google et Apple proposent depuis cette rentrÃ©e des interfaces adÃ©quates sur leur systÃ¨me dâ€™exploitation. Que ce soit sur iOS ou Android, les derniÃ¨res mises Ã  jour ont effectivement permis de voir apparaÃ®tre de faÃ§on native le fameux Â« dark mode Â», et la plupart des applications systÃ¨mes sont synchronisÃ©es dans leur affichage.<br />\r\n<br />\r\nMais les applications telles que Facebook, Messenger, WhatsApp ou encore Instagram ne proposait toujours pas leur version Ã  lâ€™arriÃ¨re-plan foncÃ©. Le rÃ©seau social de partage de photo initie le thÃ¨me.', 6, '1570646284', 9),
(37, 2, 'https://www.presse-citron.net/wordpress_prod/wp-content/uploads/2019/10/PS-Now-Test-ADSL.jpg', 'On a testÃ© le PS Now sur une ligne ADSL, en pleine campagneâ€¦ Ca fonctionne ?', 'LancÃ© il y a deux ans maintenant en France, le PS Now est une plateforme de jeux en streaming, qui permet Ã  lâ€™abonnÃ© de jouer en illimitÃ© Ã  des jeux PS2, PS3 et PS4, et cela, sur une PS4 ou un PC. Une offre dont le prix a rÃ©cemment Ã©tÃ© revu Ã  la baisse (le mois ayant Ã©tÃ© ramenÃ© Ã  9,99 euros) afin de rester compÃ©titif face aux (nombreuses) autres plateformes similaires qui arrivent sur le marchÃ©. <br />\r\n<br />\r\nSi le PS Now (comme Google Stadia pour ne citer que lui) sont taillÃ©s pour offrir un rendu optimal sur une connexion web de type Fibre, quâ€™en est-il du joueur rÃ©sidant en province et/ou Ã  la campagne, ayant accÃ¨s uniquement Ã  une bonne vieille ligne ADSL standard ?', 7, '1570646557', 98),
(39, 1, 'https://www.presse-citron.net/wordpress_prod/wp-content/uploads/2019/07/monday.com-startup.jpg', 'Avis monday.com : test de lâ€™outil idÃ©al pour les startups et entrepreneurs', 'En guise de prÃ©ambule je vais vous raconter ma vie. Je travaille dans le web depuis plus de 10 ans, et jâ€™ai eu lâ€™occasion de tester et me faire un avis sur des dizaines dâ€™outils pour des besoins diverses (to-do list, suivi de planning, suivi SEO, dÃ©veloppement, etc.). Jâ€™ai toujours eu du mal Ã  trouver un outil qui rÃ©pond Ã  lâ€™intÃ©gralitÃ© de mes besoins, jusquâ€™Ã  essayer Monday. Aussi simple que Trello, mais aussi riche quâ€™Asana, dÃ©couvrez mon avis sur monday.com, le logiciel SAAS ultime.<br />\r\n<br />\r\nUne fois votre essai gratuit de 14 jours activÃ©, les tutos de Monday vous aident trÃ¨s rapidement Ã  comprendre lâ€™outil, que vous pouvez commencer Ã  mettre en oeuvre immÃ©diatement. Mais la vraie richesse de Monday, câ€™est en allant plus loin que vous allez la dÃ©couvrir. Chez Presse-citron, nous articulons notre gestion autour de Feedly et Trello pour la production Ã©ditoriale (câ€™est le duo parfait), mais nous nâ€™avons pas trouvÃ© de solution miracle, jusquâ€™Ã  Monday, pour tout le reste de lâ€™activitÃ© (dÃ©veloppement, suivi client, gestion dâ€™Ã©vÃ©nements, etc.).<br />\r\n<br />\r\n', 8, '1570650041', 80);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` text,
  `mail` text,
  `password` text,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mail`, `password`, `image`) VALUES
(1, 'Noah', 'noah.chtl@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'https://vignette.wikia.nocookie.net/nintendo/images/7/75/Mario.png/revision/latest?cb=20150913114044&path-prefix=tr'),
(2, 'Sebastien', 'sebastien.harinck@domaine.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'https://pm1.narvii.com/6389/9b012614c18a59e417725b65a9c3704ebfe6ad65_hq.jpg'),
(22, 'testPseudo', 'test@test.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'https://forums.mfgg.net/uploads/avatars/avatar_239.png?dateline=1516570676');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
