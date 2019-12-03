-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 02 déc. 2019 à 17:08
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `u532250745_expozart`
--

-- --------------------------------------------------------

--
-- Structure de la table `ex_allowedext`
--

CREATE TABLE `ex_allowedext` (
  `ID` int(11) NOT NULL,
  `allowext` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les extensions de fichiers reconnues';

--
-- Déchargement des données de la table `ex_allowedext`
--

INSERT INTO `ex_allowedext` (`ID`, `allowext`) VALUES
(9, 'acc'),
(13, 'avi'),
(14, 'flv'),
(3, 'gif'),
(5, 'jpe'),
(1, 'jpeg'),
(4, 'jpg'),
(8, 'm4a'),
(15, 'mkv'),
(16, 'mov'),
(7, 'mp3'),
(11, 'mp4'),
(10, 'ogg'),
(2, 'png'),
(6, 'wav'),
(12, 'webm');

-- --------------------------------------------------------

--
-- Structure de la table `ex_arts`
--

CREATE TABLE `ex_arts` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `tID` int(11) NOT NULL,
  `artcontent` longtext NOT NULL,
  `arthash` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les articles des utilisateurs';

--
-- Déchargement des données de la table `ex_arts`
--

INSERT INTO `ex_arts` (`ID`, `uID`, `cID`, `tID`, `artcontent`, `arthash`, `created`) VALUES
(1, 3, 4, 4, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. ', 1344, '2019-07-03 00:00:00'),
(2, 15, 1, 1, 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).', 21511, '2019-08-20 10:06:33'),
(3, 201, 8, 3, 'Contrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s\'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d\'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du \"De Finibus Bonorum et Malorum\" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l\'éthique. Les premières lignes du Lorem Ipsum, \"Lorem ipsum dolor sit amet...\", proviennent de la section 1.10.32.', 320183, '2019-08-21 14:13:03'),
(4, 98, 15, 2, 'Plusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d\'entre elles a été altérée par l\'addition d\'humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez être sûr qu\'il n\'y a rien d\'embarrassant caché dans le texte. Tous les générateurs de Lorem Ipsum sur Internet tendent à reproduire le même extrait sans fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches d\'humour.', 498152, '2019-08-21 12:47:14'),
(5, 105, 1, 18, 'L\'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du \"De Finibus Bonorum et Malorum\" de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).', 5105118, '2019-11-03 00:00:00'),
(6, 7, 18, 54, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris purus risus, venenatis in congue et, lacinia nec mi. Maecenas mattis posuere libero, eget accumsan turpis vestibulum nec. Nam ornare suscipit felis, vitae sodales quam dapibus quis. Aliquam placerat sed sem sit amet vestibulum. Sed sagittis fringilla euismod', 671854, '2019-07-03 00:00:00'),
(7, 1, 3, 75, 'Donec varius risus at vulputate maximus. Vestibulum a purus ipsum. Donec sit amet tempor lorem, ultricies semper mi. Morbi varius tincidunt nisl, aliquet fringilla turpis ullamcorper vitae. Praesent at neque eu ipsum faucibus eleifend in ut lacus. Nam congue ligula diam.', 71375, '0000-00-00 00:00:00'),
(8, 7, 18, 18, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris purus risus, venenatis in congue et, lacinia nec mi. Maecenas mattis posuere libero, eget accumsan turpis vestibulum nec. Nam ornare suscipit felis, vitae sodales quam dapibus quis. Aliquam placerat sed sem sit amet vestibulum. Sed sagittis fringilla euismod', 871818, '2019-07-03 00:00:00'),
(9, 1, 3, 100, 'Donec varius risus at vulputate maximus. Vestibulum a purus ipsum. Donec sit amet tempor lorem, ultricies semper mi. Morbi varius tincidunt nisl, aliquet fringilla turpis ullamcorper vitae. Praesent at neque eu ipsum faucibus eleifend in ut lacus. Nam congue ligula diam.', 913100, '2019-10-13 00:00:00'),
(10, 532, 12, 117, 'Nunc euismod iaculis viverra. Vivamus sapien ipsum, aliquam at mattis nec, consectetur sit amet leo. Duis cursus dui a est malesuada congue. Aliquam euismod sodales ipsum, tempus sagittis metus fermentum in. Morbi ornare risus eu leo maximus scelerisque. Integer ut purus a purus euismod commodo. Morbi tincidunt nunc ipsum. Aliquam hendrerit erat et dolor sollicitudin, a egestas lectus tincidunt. Ut sagittis condimentum urna. Curabitur laoreet est ut ornare dictum. Integer fermentum augue nec pellentesque eleifend. Maecenas tincidunt odio quis nisl vehicula finibus.', 1053212117, '2019-06-20 00:00:00'),
(11, 963, 4, 94, 'Nam porta nec leo ornare posuere. Donec purus eros, aliquet eu sollicitudin sed, porttitor at urna. Nullam rutrum sapien eu nisi commodo, et ultrices purus hendrerit. Donec lacinia iaculis eros, id interdum nibh maximus eu. Fusce eu augue finibus sapien tempor suscipit ac vel quam. Integer rutrum eros quis ante scelerisque pulvinar. Fusce non ullamcorper magna.', 11963494, '2019-08-20 14:25:46'),
(12, 1, 5, 5, 'Morbi in mattis sem. Donec mi mauris, tincidunt quis ultricies vel, pulvinar arisus. Sed in nunc felis.', 12155, '2019-09-13 14:52:00'),
(13, 27, 11, 65, 'Nam tincidunt feugiat ligula, malesuada molestie nunc fermentum at. Vivamus urna felis, gravida laoreet totor.', 13271165, '2019-11-17 00:00:00'),
(14, 13, 16, 42, 'Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 14131642, '2019-03-18 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `ex_authtokens`
--

CREATE TABLE `ex_authtokens` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `selector` varchar(225) NOT NULL,
  `token` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les tokens pour les sessions utilisateurs';

-- --------------------------------------------------------

--
-- Structure de la table `ex_categories`
--

CREATE TABLE `ex_categories` (
  `ID` int(11) NOT NULL,
  `categoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les différentes catégories pour les topics et les arts';

--
-- Déchargement des données de la table `ex_categories`
--

INSERT INTO `ex_categories` (`ID`, `categoryname`) VALUES
(1, 'Architecture'),
(14, 'Bande dessinée'),
(10, 'Cinéma'),
(15, 'Comics'),
(9, 'Danse'),
(4, 'Dessin'),
(18, 'Histoire de l\'art'),
(17, 'Jeux-vidéo'),
(6, 'Littérature'),
(16, 'Mangas'),
(5, 'Musique'),
(3, 'Peinture'),
(13, 'Photographie'),
(7, 'Poésie'),
(12, 'Radio'),
(2, 'Sculpture'),
(11, 'Télévision'),
(8, 'Théâtre');

-- --------------------------------------------------------

--
-- Structure de la table `ex_comments`
--

CREATE TABLE `ex_comments` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `aID` int(11) NOT NULL,
  `cTYPE` enum('1','2') NOT NULL COMMENT '1 => artwork critics; 2 => critics comment',
  `commentbody` longtext NOT NULL,
  `criticID` int(11) NOT NULL COMMENT 'ID de la critique commenter',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les commentaires des utilisateurs';

--
-- Déchargement des données de la table `ex_comments`
--

INSERT INTO `ex_comments` (`ID`, `uID`, `aID`, `cTYPE`, `commentbody`, `criticID`, `created`) VALUES
(1, 1, 13, '1', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression', 0, '2019-11-23 17:35:42'),
(28, 2, 12, '1', 'goo jobs', 0, '2019-11-27 01:07:03'),
(29, 1, 12, '1', 'merci!', 0, '2019-11-27 01:08:16'),
(30, 2, 12, '1', 'De rien frÃ¨re, j\'adore ton taf!', 0, '2019-11-27 01:08:49'),
(31, 1, 12, '1', 'Cool', 0, '2019-11-27 01:09:01'),
(32, 2, 12, '1', 'Chui content que tu sois sur expozart', 0, '2019-11-27 01:09:30'),
(33, 1, 12, '1', 'Moi aussi', 0, '2019-11-27 01:09:44'),
(34, 1, 12, '1', 'C\'est une trÃ¨s bonne plateforme qui met en valeur nos traveaux.', 0, '2019-11-27 01:11:01'),
(35, 2, 12, '1', 'Oui, en tout cas, c\'est du bon', 0, '2019-11-27 01:11:23'),
(36, 1, 12, '1', 'ok cool', 0, '2019-11-27 01:11:36'),
(37, 1, 12, '1', 'Wep, bon Ã  plus', 0, '2019-11-27 01:11:50');

-- --------------------------------------------------------

--
-- Structure de la table `ex_contry`
--

CREATE TABLE `ex_contry` (
  `ID` int(11) NOT NULL,
  `contryname` varchar(100) NOT NULL,
  `contrycode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock la liste des pays';

-- --------------------------------------------------------

--
-- Structure de la table `ex_languages`
--

CREATE TABLE `ex_languages` (
  `ID` int(11) NOT NULL,
  `language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les différets langues disponibles';

--
-- Déchargement des données de la table `ex_languages`
--

INSERT INTO `ex_languages` (`ID`, `language`) VALUES
(1, 'Français');

-- --------------------------------------------------------

--
-- Structure de la table `ex_likes`
--

CREATE TABLE `ex_likes` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `aID` int(11) NOT NULL,
  `lTYPE` enum('1','2') NOT NULL COMMENT '1 => artwork like; 2 => comment like',
  `criticID` int(11) NOT NULL COMMENT 'ID de la critique liker',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les likes des utilisateur sur les articles';

--
-- Déchargement des données de la table `ex_likes`
--

INSERT INTO `ex_likes` (`ID`, `uID`, `aID`, `lTYPE`, `criticID`, `created`) VALUES
(153, 1, 13, '1', 0, '2019-11-27 00:05:21'),
(155, 2, 13, '1', 0, '2019-11-27 01:04:03'),
(156, 2, 12, '1', 0, '2019-11-27 01:04:15');

-- --------------------------------------------------------

--
-- Structure de la table `ex_media`
--

CREATE TABLE `ex_media` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `filename` varchar(225) NOT NULL,
  `file_ext` int(11) NOT NULL,
  `fileroad` varchar(225) NOT NULL,
  `fileroad_sm` varchar(225) NOT NULL,
  `salt` int(11) NOT NULL,
  `filehash` varchar(225) NOT NULL,
  `fileusability` enum('0','1','2') NOT NULL COMMENT '0 => avatar; 1 => artwork cover; 2 => categories cover'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les medias attachés';

--
-- Déchargement des données de la table `ex_media`
--

INSERT INTO `ex_media` (`ID`, `uID`, `filename`, `file_ext`, `fileroad`, `fileroad_sm`, `salt`, `filehash`, `fileusability`) VALUES
(1, 1, 'architecture.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/architecture.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201901.jpg', 1, '201901', '2'),
(2, 1, 'sculpture.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/sculpture.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201902.jpg', 2, '201902', '2'),
(3, 1, 'peinture.jpeg', 1, 'http://localhost/www.expozart.com/resources/public/media/categories/peinture.jpeg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201903.jpeg', 3, '201903', '2'),
(4, 1, 'dessin.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/dessin.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201904.jpg', 4, '201904', '2'),
(5, 1, 'musique.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/musique.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201905.jpg', 5, '201905', '2'),
(6, 1, 'litterature.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/litterature.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201906.jpg', 6, '201906', '2'),
(7, 1, 'pesie.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/pesie.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201907.jpg', 7, '201907', '2'),
(8, 1, 'theatre.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/theatre.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201908.jpg', 8, '201908', '2'),
(9, 1, 'danse.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/danse.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201909.jpg', 9, '201909', '2'),
(10, 1, 'cinema.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/cinema.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201910.jpg', 10, '201910', '2'),
(11, 1, 'television.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/television.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201911.jpg', 11, '201911', '2'),
(12, 1, 'radio.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/radio.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201912.jpg', 12, '201912', '2'),
(13, 1, 'photographie.png', 2, 'http://localhost/www.expozart.com/resources/public/media/categories/photographie.png', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201913.png', 13, '201913', '2'),
(14, 1, 'bd.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/bd.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201914.jpg', 14, '201914', '2'),
(15, 1, 'comics.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/comics.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201915.jpg', 15, '201915', '2'),
(16, 1, 'mangas.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/mangas.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201916.jpg', 16, '201916', '2'),
(17, 1, 'jeuxvideos.jpg', 4, 'http://localhost/www.expozart.com/resources/public/media/categories/jeuxvideos.jpg', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201917.jpg', 17, '201917', '2'),
(18, 1, 'ha.png', 2, 'http://localhost/www.expozart.com/resources/public/media/categories/ha.png', 'http://localhost/www.expozart.com/resources/public/media/categories/min/201918.png', 18, '201918', '2'),
(19, 1, 'hipster.jpg', 4, 'http://localhost:8000/resources/public/media/uploads/arts/1/hipster.jpg', 'http://localhost:8000/resources/public/media/uploads/arts/min/1/2019130312.jpg', 12, '2019130312', '1'),
(20, 27, 'next_gen-land.png', 2, 'http://localhost:8000/resources/public/media/uploads/arts/27/next_gen-land.png', 'http://localhost:8000/resources/public/media/uploads/arts/min/27/13271165.png', 13, '13271165', '1');

-- --------------------------------------------------------

--
-- Structure de la table `ex_topics`
--

CREATE TABLE `ex_topics` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `topicname` varchar(100) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les thèmes des utilisateurs par catégories';

--
-- Déchargement des données de la table `ex_topics`
--

INSERT INTO `ex_topics` (`ID`, `uID`, `cID`, `topicname`, `updated`, `created`) VALUES
(1, 1, 1, 'Architecture', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(2, 1, 2, 'Sculpture', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(3, 1, 3, 'Peinture', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(4, 1, 4, 'Dessin', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(5, 1, 5, 'Musique', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(6, 1, 6, 'Littérature', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(7, 1, 7, 'Poésie', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(8, 1, 8, 'Théâtre', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(9, 1, 9, 'Danse', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(10, 1, 10, 'Cinéma', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(11, 1, 11, 'Télévision', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(12, 1, 12, 'Radio', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(13, 1, 13, 'Photographie', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(14, 1, 14, 'Bande dessinée', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(15, 1, 15, 'Comics', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(16, 1, 16, 'Mangas', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(17, 1, 17, 'Jeux-vidéo', '2019-11-09 21:13:00', '2019-11-09 21:13:00'),
(18, 1, 18, 'Histoire de l\'art', '2019-11-09 21:13:00', '2019-11-09 21:13:00');

-- --------------------------------------------------------

--
-- Structure de la table `ex_useragregation`
--

CREATE TABLE `ex_useragregation` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `token` varchar(225) NOT NULL,
  `agregation` enum('0','1') NOT NULL,
  `sendstate` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les agrégations utilisateurs';

--
-- Déchargement des données de la table `ex_useragregation`
--

INSERT INTO `ex_useragregation` (`ID`, `uID`, `token`, `agregation`, `sendstate`) VALUES
(1, 1, '968d02f56c1bbe3b66845e481de16a632876b44a', '1', '1'),
(2, 2, 'b0f6eb22c27ddc353d9e405936e2979cd05e6974', '1', '1');

-- --------------------------------------------------------

--
-- Structure de la table `ex_usercategories`
--

CREATE TABLE `ex_usercategories` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `cID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les affiliations entre utilisateurs et catégories';

--
-- Déchargement des données de la table `ex_usercategories`
--

INSERT INTO `ex_usercategories` (`ID`, `uID`, `cID`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 16),
(4, 1, 5),
(5, 1, 11),
(6, 2, 10),
(7, 2, 9),
(8, 2, 17),
(9, 2, 5),
(10, 2, 13),
(12, 2, 2),
(14, 2, 11);

-- --------------------------------------------------------

--
-- Structure de la table `ex_userfollowing`
--

CREATE TABLE `ex_userfollowing` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `rID` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les relations existentes entre les utilisateurs';

-- --------------------------------------------------------

--
-- Structure de la table `ex_userinfos`
--

CREATE TABLE `ex_userinfos` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` enum('1','0','6') NOT NULL COMMENT '1 => Male\n0 => Female\n6 => Undefined',
  `birthday` date NOT NULL,
  `phone` int(11) NOT NULL,
  `2ndphone` int(11) NOT NULL,
  `2ndmail` int(11) NOT NULL,
  `about` longtext NOT NULL,
  `weblink` varchar(225) NOT NULL,
  `localisation` longtext NOT NULL,
  `contry` int(11) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les informations des utilisateurs';

-- --------------------------------------------------------

--
-- Structure de la table `ex_userlastactivity`
--

CREATE TABLE `ex_userlastactivity` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `lastactivity` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock la dernière activité en date des utilisateurs';

--
-- Déchargement des données de la table `ex_userlastactivity`
--

INSERT INTO `ex_userlastactivity` (`ID`, `uID`, `lastactivity`) VALUES
(1, 1, '2019-11-25'),
(2, 2, '2019-11-25');

-- --------------------------------------------------------

--
-- Structure de la table `ex_userprefs`
--

CREATE TABLE `ex_userprefs` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `lID` int(11) NOT NULL COMMENT 'Langue ID',
  `style` enum('1','0') NOT NULL COMMENT '1 => Normal\n0 => Dark',
  `session` enum('0','1') NOT NULL COMMENT '0 => Not saved\n1 => Saved '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les préférences des utilisateurs';

--
-- Déchargement des données de la table `ex_userprefs`
--

INSERT INTO `ex_userprefs` (`ID`, `uID`, `lID`, `style`, `session`) VALUES
(2, 1, 0, '1', '0'),
(3, 2, 0, '1', '0');

-- --------------------------------------------------------

--
-- Structure de la table `ex_users`
--

CREATE TABLE `ex_users` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `usermail` varchar(100) NOT NULL,
  `userpass` varchar(225) NOT NULL,
  `uTYPE` int(11) NOT NULL,
  `uSTATE` int(11) NOT NULL,
  `hashedID` varchar(225) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les informations d''authentification des utilisateurs';

--
-- Déchargement des données de la table `ex_users`
--

INSERT INTO `ex_users` (`ID`, `username`, `usermail`, `userpass`, `uTYPE`, `uSTATE`, `hashedID`, `updated`, `created`) VALUES
(1, 'Yeezy', 'yitzak01@gmail.com', '$2y$10$HwZh6T9aCUjiVmJmvm9U1.8zazONAMYu9W71cdm1YzWTRosz3OvN.', 2, 1, '4OnCTj~w9XbEGMhwD8g35M-x~B0xEgRv2&dJUWqH', '2019-11-08 17:48:45', '2019-11-08 15:14:12'),
(2, 'johndoe', 'johndoe@gmail.com', '$2y$10$EHMuQMbPWYMuc9kgE5tzUOdE/ROrun1bVeYCOHY6b4ZH2RZR1pwIq', 2, 1, 'n2bnq-CSLq&8r4_3i&vz6gWhIa0kiL%zfSPc4iwC', '2019-11-25 07:08:27', '2019-11-19 02:22:01');

-- --------------------------------------------------------

--
-- Structure de la table `ex_userstate`
--

CREATE TABLE `ex_userstate` (
  `ID` int(11) NOT NULL,
  `statename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les différent etat d''un compte';

--
-- Déchargement des données de la table `ex_userstate`
--

INSERT INTO `ex_userstate` (`ID`, `statename`) VALUES
(1, 'offline'),
(2, 'online');

-- --------------------------------------------------------

--
-- Structure de la table `ex_usertopics`
--

CREATE TABLE `ex_usertopics` (
  `ID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `tID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les affiliations entre les utilisateurs et les thèmes';

--
-- Déchargement des données de la table `ex_usertopics`
--

INSERT INTO `ex_usertopics` (`ID`, `uID`, `cID`, `tID`) VALUES
(1, 1, 1, 1),
(2, 1, 4, 4),
(3, 1, 16, 16),
(4, 1, 5, 5),
(5, 1, 11, 11),
(6, 2, 10, 10),
(7, 2, 9, 9),
(8, 2, 17, 17),
(9, 2, 5, 5),
(10, 2, 13, 13),
(12, 2, 2, 2),
(14, 2, 11, 11);

-- --------------------------------------------------------

--
-- Structure de la table `ex_usertypes`
--

CREATE TABLE `ex_usertypes` (
  `ID` int(11) NOT NULL,
  `typename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock les types d''utilisateurs acceptés';

--
-- Déchargement des données de la table `ex_usertypes`
--

INSERT INTO `ex_usertypes` (`ID`, `typename`) VALUES
(1, 'admin'),
(2, 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ex_allowedext`
--
ALTER TABLE `ex_allowedext`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `allowext_UNIQUE` (`allowext`);

--
-- Index pour la table `ex_arts`
--
ALTER TABLE `ex_arts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`),
  ADD KEY `cID_idx` (`cID`),
  ADD KEY `tID_idx` (`tID`);

--
-- Index pour la table `ex_authtokens`
--
ALTER TABLE `ex_authtokens`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`);

--
-- Index pour la table `ex_categories`
--
ALTER TABLE `ex_categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `categoryname_UNIQUE` (`categoryname`);

--
-- Index pour la table `ex_comments`
--
ALTER TABLE `ex_comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`),
  ADD KEY `hID_idx` (`aID`);

--
-- Index pour la table `ex_contry`
--
ALTER TABLE `ex_contry`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `contryname_UNIQUE` (`contryname`);

--
-- Index pour la table `ex_languages`
--
ALTER TABLE `ex_languages`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ex_likes`
--
ALTER TABLE `ex_likes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`),
  ADD KEY `aID_idx` (`aID`);

--
-- Index pour la table `ex_media`
--
ALTER TABLE `ex_media`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `filehash_UNIQUE` (`filehash`),
  ADD KEY `uID_idx` (`uID`),
  ADD KEY `file_ext_idx` (`file_ext`),
  ADD KEY `salt_idx` (`salt`);

--
-- Index pour la table `ex_topics`
--
ALTER TABLE `ex_topics`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`),
  ADD KEY `cID_idx` (`cID`);

--
-- Index pour la table `ex_useragregation`
--
ALTER TABLE `ex_useragregation`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `uID_UNIQUE` (`uID`);

--
-- Index pour la table `ex_usercategories`
--
ALTER TABLE `ex_usercategories`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`),
  ADD KEY `cID_idx` (`cID`);

--
-- Index pour la table `ex_userfollowing`
--
ALTER TABLE `ex_userfollowing`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `sID_idx` (`uID`),
  ADD KEY `rID_idx` (`rID`);

--
-- Index pour la table `ex_userinfos`
--
ALTER TABLE `ex_userinfos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ex_userinfoscol_UNIQUE` (`uID`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`),
  ADD KEY `contry_idx` (`contry`);

--
-- Index pour la table `ex_userlastactivity`
--
ALTER TABLE `ex_userlastactivity`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`);

--
-- Index pour la table `ex_userprefs`
--
ALTER TABLE `ex_userprefs`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `uID_UNIQUE` (`uID`),
  ADD KEY `lID_idx` (`lID`);

--
-- Index pour la table `ex_users`
--
ALTER TABLE `ex_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `usermail_UNIQUE` (`usermail`),
  ADD UNIQUE KEY `hashedID_UNIQUE` (`hashedID`),
  ADD KEY `uTYPE_idx` (`uTYPE`),
  ADD KEY `uSTATE_idx` (`uSTATE`);

--
-- Index pour la table `ex_userstate`
--
ALTER TABLE `ex_userstate`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ex_usertopics`
--
ALTER TABLE `ex_usertopics`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID_idx` (`uID`),
  ADD KEY `tID_idx` (`tID`),
  ADD KEY `cID_idx` (`cID`) USING BTREE;

--
-- Index pour la table `ex_usertypes`
--
ALTER TABLE `ex_usertypes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ex_allowedext`
--
ALTER TABLE `ex_allowedext`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `ex_arts`
--
ALTER TABLE `ex_arts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `ex_authtokens`
--
ALTER TABLE `ex_authtokens`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ex_categories`
--
ALTER TABLE `ex_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `ex_comments`
--
ALTER TABLE `ex_comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `ex_contry`
--
ALTER TABLE `ex_contry`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ex_languages`
--
ALTER TABLE `ex_languages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ex_likes`
--
ALTER TABLE `ex_likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT pour la table `ex_media`
--
ALTER TABLE `ex_media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `ex_topics`
--
ALTER TABLE `ex_topics`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `ex_useragregation`
--
ALTER TABLE `ex_useragregation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ex_usercategories`
--
ALTER TABLE `ex_usercategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `ex_userfollowing`
--
ALTER TABLE `ex_userfollowing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ex_userinfos`
--
ALTER TABLE `ex_userinfos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ex_userlastactivity`
--
ALTER TABLE `ex_userlastactivity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ex_userprefs`
--
ALTER TABLE `ex_userprefs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ex_users`
--
ALTER TABLE `ex_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ex_userstate`
--
ALTER TABLE `ex_userstate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ex_usertopics`
--
ALTER TABLE `ex_usertopics`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `ex_usertypes`
--
ALTER TABLE `ex_usertypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ex_authtokens`
--
ALTER TABLE `ex_authtokens`
  ADD CONSTRAINT `uID_authtokens` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_comments`
--
ALTER TABLE `ex_comments`
  ADD CONSTRAINT `ex_comments_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`);

--
-- Contraintes pour la table `ex_likes`
--
ALTER TABLE `ex_likes`
  ADD CONSTRAINT `uID_likes` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_useragregation`
--
ALTER TABLE `ex_useragregation`
  ADD CONSTRAINT `uID_useragregation` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_usercategories`
--
ALTER TABLE `ex_usercategories`
  ADD CONSTRAINT `uID_usercategories` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_userfollowing`
--
ALTER TABLE `ex_userfollowing`
  ADD CONSTRAINT `rID_userfollowing` FOREIGN KEY (`rID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `uID_userfollowing` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_userinfos`
--
ALTER TABLE `ex_userinfos`
  ADD CONSTRAINT `contry_userinfos` FOREIGN KEY (`contry`) REFERENCES `ex_contry` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `uID_userinfos` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_userlastactivity`
--
ALTER TABLE `ex_userlastactivity`
  ADD CONSTRAINT `uID_userlastactivity` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_userprefs`
--
ALTER TABLE `ex_userprefs`
  ADD CONSTRAINT `uID_userprefs` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ex_usertopics`
--
ALTER TABLE `ex_usertopics`
  ADD CONSTRAINT `uID_usertopics` FOREIGN KEY (`uID`) REFERENCES `ex_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
