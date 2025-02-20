-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 fév. 2025 à 08:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `regulationbdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`nom`) VALUES
('ADENOR Patrick'),
('Aimé'),
('AJORQUE Luçay'),
('AMOUNY Guy'),
('ATIAMA J.J.'),
('AVRIL Joel'),
('BALAYA Eric'),
('BALAYA Gérald'),
('BAROUTY ( AH NIAVE )'),
('BASSONVILLE Daniel'),
('BATAILLE François'),
('BLANCARD Fabrice'),
('BOULANGER Maryline'),
('BOYER Jean François'),
('BUFFA Berteaud'),
('CARABIN Pascal'),
('CELESTE Bertrand'),
('CELESTE Yoland'),
('CLAIN Pascal'),
('DIJOUX Daniel'),
('DIJOUX Daniel BCE'),
('ESTHER Grégory'),
('ETHEVE Eddy'),
('EUGENE Jean Luc'),
('FONTAINE Daniel'),
('GAI Yannick'),
('GAMARUS Johhny'),
('GASTRIN Martinel'),
('GILEROT Gertal'),
('GONNEAU Mayke'),
('GRANULANT Hugues'),
('HOARAU Cédric'),
('HOARAU Florent'),
('HOARAU Laurent'),
('HOAREAU Jeannick'),
('K BIDY Rémy'),
('KBIDY Rémi'),
('LALLEMAND Franck'),
('LALLEMAND Mathilde'),
('LEBRETON Jean Marie'),
('LOMBARDO Eric'),
('MAILLOT Philippe'),
('MARDAYE Armand'),
('MAURER NADIA'),
('Michel HILARIC'),
('MULITSI Jim'),
('PAJANIAYE Jonhy'),
('PATON Jean Claude'),
('PAYET Sébastien'),
('Personnel assermenté'),
('PETIT Benjamin'),
('PONIN Vydia'),
('RANGAYEN Aimé'),
('RAVENNE Luciano'),
('REGULATEUR'),
('RENE Cédric'),
('RIVIERE Guillaume'),
('ROBERT Aimé'),
('ROBERT Stéphanie'),
('ROBERT Yannick'),
('ROUANIA François'),
('SALVAN David'),
('SIOCHE Samuel'),
('TRULES Philippe Eric'),
('TURPIN Isabelle'),
('TURPIN Mathieu'),
('VAITILINGOM Martial'),
('VALMY Jim');

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`nom`) VALUES
('armature'),
('aviron'),
('cilaos'),
('cilaos armature'),
('etang sale'),
('mobineo'),
('petite ile'),
('saint louis'),
('saint pierre');

-- --------------------------------------------------------

--
-- Structure de la table `emails`
--

CREATE TABLE `emails` (
  `email` varchar(255) NOT NULL,
  `societeID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

CREATE TABLE `ligne` (
  `num` varchar(255) NOT NULL,
  `reseau` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ligne`
--

INSERT INTO `ligne` (`num`, `reseau`) VALUES
('1', 1),
('10', 1),
('11', 1),
('12', 1),
('13', 1),
('14', 1),
('15', 1),
('2', 1),
('21', 1),
('22', 1),
('23', 1),
('24', 1),
('25', 1),
('26', 1),
('27', 1),
('28', 1),
('29', 1),
('3', 1),
('30', 1),
('32', 1),
('33', 1),
('4', 1),
('41', 1),
('42', 1),
('43', 1),
('44', 1),
('45', 1),
('5', 1),
('51', 1),
('52', 1),
('53', 1),
('54', 1),
('55', 1),
('57', 1),
('58', 1),
('6', 1),
('60', 1),
('61', 1),
('62', 1),
('63', 1),
('7', 1),
('8', 1),
('85', 1),
('86', 1),
('87', 1),
('88', 1),
('9', 1),
('AUTRES', 1),
('ETANG SALE', 1),
('karlavil 1', 1),
('karlavil 2', 1),
('ligne 89', 1),
('LITTORAL', 1),
('Littoral 1', 1),
('Littoral 2L', 1),
('Noctambus', 1),
('RESERVE', 1),
('38', 2),
('38bis/37', 2),
('39', 2),
('71/75BIS/81', 2),
('71/76/81', 2),
('71/nav', 2),
('72', 2),
('73', 2),
('74', 2),
('75', 2),
('75/79', 2),
('76', 2),
('77', 2),
('78', 2),
('78B/79', 2),
('78BIS/79', 2),
('79', 2),
('79/71', 2),
('81', 2),
('83', 2),
('84', 2),
('FLORIANA', 2),
('FLORIBUS', 2),
('GECKO 1 boucle Est', 2),
('GECKO 4 boucle Ouest', 2),
('GECKOBUS', 2),
('GERANIUM', 2),
('I1', 2),
('I2', 2),
('I3', 2),
('I4', 2),
('MAGMABUS', 2),
('STC', 2),
('STC1', 2),
('STC2', 2),
('STD', 2),
('STD 01 Dim', 2),
('STE', 2),
('T01', 2),
('T02', 2),
('T03', 2),
('T04', 2),
('T05', 2),
('T05B', 2),
('T06', 2),
('T07', 2),
('T08', 2),
('T09', 2),
('T09B', 2),
('T10', 2),
('T11', 2),
('T12', 2),
('T12B', 2),
('T12B1', 2),
('T14', 2);

-- --------------------------------------------------------

--
-- Structure de la table `nature`
--

CREATE TABLE `nature` (
  `id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nature`
--

INSERT INTO `nature` (`id`, `type`) VALUES
(1, 'absence'),
(2, 'accident'),
(3, 'accrochage'),
(4, 'agression'),
(5, 'annulation reservation'),
(6, 'anomalie'),
(9, 'capacite insuffisante'),
(10, 'changement de vehicule'),
(11, 'charte'),
(12, 'comportement du conducteur'),
(13, 'depart non effectue'),
(14, 'deviation'),
(15, 'divers'),
(16, 'entrave a la circulation'),
(17, 'etat proprete'),
(18, 'etat voirie'),
(19, 'horaire non respecte'),
(20, 'incident a bord'),
(21, 'incivilite'),
(22, 'infrastructure'),
(23, 'intemperies'),
(24, 'interventions mecaniques en lignes'),
(25, 'malade a bord'),
(26, 'manifestation'),
(27, 'modification du service'),
(28, 'modification itineraire'),
(29, 'panne'),
(30, 'parc vehicule'),
(31, 'petite mecanique'),
(32, 'porte velo'),
(33, 'rapport de controle'),
(34, 'renfort'),
(35, 'reservation'),
(36, 'retard'),
(37, 'service pas effectue'),
(38, 'stationnement genant'),
(39, 'surcharge'),
(40, 'travaux'),
(45, 'aaaa');

-- --------------------------------------------------------

--
-- Structure de la table `parc`
--

CREATE TABLE `parc` (
  `num` int(255) NOT NULL,
  `societeID` int(255) NOT NULL,
  `immatriculation` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parc`
--

INSERT INTO `parc` (`num`, `societeID`, `immatriculation`) VALUES
(1, 14, 'AA 111 FF'),
(6, 17, 'AD 006 RL'),
(4, 20, 'AD 070 RL'),
(8, 20, 'AD 105 RP'),
(5, 14, 'AD 714 RQ'),
(7, 20, 'AD 865 RK'),
(14, 18, 'BD 075 RC'),
(15, 18, 'BD 077 RC'),
(12, 20, 'BE 250 ZJ'),
(13, 20, 'BE 412 ZN'),
(11, 14, 'BE 459 ZL'),
(51, 17, 'CA 142 RK'),
(40, 20, 'CA 150 JE'),
(37, 17, 'CA 161 JE'),
(38, 20, 'CA 172 JE'),
(36, 20, 'CA 181 JE'),
(39, 18, 'CA 190 JE'),
(41, 20, 'CA 197 JE'),
(25, 14, 'CA 197 JJ'),
(44, 20, 'CA 203 JJ'),
(31, 20, 'CA 206 JE'),
(42, 20, 'CA 209 JJ'),
(34, 20, 'CA 214 JE'),
(32, 20, 'CA 220 JJ'),
(35, 20, 'CA 222 JE'),
(46, 18, 'CA 227 JJ'),
(33, 17, 'CA 239 JJ'),
(45, 20, 'CA 244 JJ'),
(48, 19, 'CA 657 JF'),
(30, 19, 'CA 667 JF'),
(27, 18, 'CA 680 JF'),
(26, 18, 'CA 687 JF'),
(47, 18, 'CA 694 JF'),
(28, 18, 'CA 703 JF'),
(24, 17, 'CA 782 ZA'),
(58, 18, 'CB 383 TR'),
(59, 18, 'CB 390 TR'),
(62, 18, 'CB 763 XR'),
(60, 18, 'CB 770 XR'),
(64, 18, 'CB 779 XR'),
(61, 18, 'CB 784 XR'),
(65, 18, 'CB 802 XR'),
(71, 20, 'CG 544 JS'),
(77, 17, 'CP 147 EZ'),
(78, 18, 'CP 151 EZ'),
(79, 20, 'CW 962 WP'),
(80, 19, 'CW 975 WP'),
(81, 20, 'CX 337 FD'),
(82, 20, 'CZ 461 YR'),
(90, 20, 'DB 042 KX'),
(92, 20, 'DB 270 KX'),
(85, 18, 'DB 276 KX'),
(93, 20, 'DB 280 KX'),
(83, 20, 'DB 284 KX'),
(84, 20, 'DB 289 KX'),
(91, 20, 'DB 296 KX'),
(86, 18, 'DB 348 KZ'),
(88, 18, 'DB 350 KZ'),
(87, 18, 'DB 351 KZ'),
(89, 18, 'DB 354 KZ'),
(99, 18, 'DB 366 MQ'),
(98, 18, 'DB 377 MQ'),
(94, 18, 'DB 411 MQ'),
(95, 17, 'DB 564 MQ'),
(102, 20, 'DH 584 VL'),
(103, 18, 'DL 408 CD'),
(105, 19, 'DL 817 CS'),
(104, 18, 'DL 818 CS'),
(110, 20, 'DM 739 AV'),
(108, 20, 'DM 743 AV'),
(107, 20, 'DM 753 AV'),
(109, 20, 'DM 754 AV'),
(111, 18, 'DN 587 JJ'),
(118, 20, 'DX 561 AA'),
(113, 18, 'DX 563 AA'),
(116, 20, 'DX 565 AA'),
(119, 20, 'DX 566 AA'),
(117, 20, 'DX 570 AA'),
(114, 20, 'DX 572 AA'),
(115, 20, 'DX 573 AA'),
(112, 20, 'DX 575 AA'),
(121, 20, 'DY 649 YS'),
(120, 20, 'DY 657 YS'),
(123, 18, 'EJ 456 YB'),
(124, 18, 'EJ 458 YB'),
(125, 18, 'EJ 461 YB'),
(126, 20, 'EJ 467 YB'),
(122, 18, 'EJ 470 YB'),
(132, 19, 'ES 771 SJ'),
(129, 18, 'ES 772 SJ'),
(130, 18, 'ES 774 SJ'),
(128, 18, 'ES 775 SJ'),
(134, 19, 'ES 809 TY'),
(133, 19, 'ES 820 TY'),
(127, 17, 'ES 828 TY'),
(135, 20, 'ES 839 TY'),
(131, 18, 'ES 847 TY'),
(136, 20, 'ES 856 TY'),
(148, 17, 'EZ 098 GW'),
(146, 18, 'EZ 100 GW'),
(147, 17, 'EZ 102 GW'),
(144, 18, 'EZ 106 HA'),
(143, 18, 'EZ 262 HA'),
(145, 17, 'EZ 952 GZ'),
(149, 18, 'FB 348 BZ'),
(150, 19, 'FB 442 BZ'),
(151, 22, 'FB-932-FA'),
(152, 18, 'FB-933-FA'),
(153, 20, 'FC 545 NJ'),
(162, 20, 'FE 898 NV'),
(161, 17, 'FE 913 NV'),
(160, 17, 'FE 928 NV'),
(159, 20, 'FE 939 NV'),
(158, 17, 'FE 950 NV'),
(154, 20, 'FE 958 GZ'),
(157, 14, 'FE 959 NV'),
(156, 14, 'FE 968 NV'),
(155, 17, 'FE 975 NV'),
(163, 20, 'FF 362 CS'),
(168, 18, 'FF 457 ZC'),
(169, 18, 'FF 497 ZC'),
(170, 18, 'FG 021 KP'),
(171, 18, 'FG 115 KN'),
(164, 20, 'FG 133 AE'),
(167, 20, 'FG 140 AE'),
(166, 20, 'FG 196 AE'),
(165, 22, 'FG 200 AE'),
(172, 17, 'FG 426 KN'),
(173, 18, 'FG 531 KN'),
(174, 17, 'FG 665 KN'),
(175, 18, 'FG 897 KN'),
(177, 20, 'GE 024 GF'),
(178, 20, 'GE 260 GF'),
(179, 20, 'GE 369 GF'),
(180, 20, 'GE 573 GF'),
(176, 20, 'GE 700 GE'),
(181, 20, 'GE 765 GF'),
(182, 20, 'GW 713 QB');

-- --------------------------------------------------------

--
-- Structure de la table `reseau`
--

CREATE TABLE `reseau` (
  `id` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reseau`
--

INSERT INTO `reseau` (`id`, `nom`) VALUES
(1, 'alterneo'),
(2, 'carsud');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(255) NOT NULL,
  `num` varchar(255) NOT NULL,
  `ligne` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `num`, `ligne`) VALUES
(1, '6301MS', '63'),
(2, '1001S', '10'),
(3, '1002M', '10'),
(4, '1002S', '10'),
(5, '1071M', '10'),
(6, '1071S', '10'),
(7, '1201M', '12'),
(8, '120S', '12'),
(9, '1501M', '15'),
(10, '1501S', '15'),
(11, '501M', '5'),
(12, '501S', '5'),
(13, '571M', '5'),
(14, '571S', '5'),
(15, '6271M', '62'),
(16, '6271S', '62'),
(17, '6301M', '63'),
(18, '6301S', '63'),
(19, '6371M', '63'),
(20, '6371S', '63'),
(21, 'Lito3M', 'LITTORAL'),
(22, 'Lito3S', 'LITTORAL'),
(23, 'Lito6M', 'LITTORAL'),
(24, 'Lito6S', 'LITTORAL'),
(25, 'Lito72M', 'LITTORAL'),
(26, 'Lito72S', 'LITTORAL'),
(27, '1001M', '10'),
(28, '2101M', '21'),
(29, '2101S', '21'),
(30, '2102M', '21'),
(31, '2102S', '21'),
(32, '2103Matin', '21'),
(33, '2103Soir', '21'),
(34, '2104Matin', '21'),
(35, '2104Soir', '21'),
(36, '2105Matin', '21'),
(37, '2105Midi', '21'),
(38, '2106Matin', '21'),
(39, '2106Midi', '21'),
(40, '2106Soir', '21'),
(41, '2171M', '21'),
(42, '2171S', '21'),
(43, '2201M', '22'),
(44, '2201S', '22'),
(45, '2271M', '22'),
(46, '2271S', '23'),
(47, '2301M', '23'),
(48, '2301S', '23'),
(49, '2401M', '24'),
(50, '2401S', '24'),
(51, '2402M', '23'),
(52, '2402S', '24'),
(53, '2403M', '23'),
(54, '2403S', '24'),
(55, '2471M', '24'),
(56, '2471S', '24'),
(57, '2501M', '25'),
(58, '2501S', '25'),
(59, '2601M', '26'),
(60, '2601S', '26'),
(61, '2602M', '26'),
(62, '2602S', '26'),
(63, '2603M', '26'),
(64, '2603S', '26'),
(65, '2672M', '26'),
(66, '2672S', '26'),
(67, '2702M', '27'),
(68, '2702S', '27'),
(69, '2801M', '28'),
(70, '2801M', '28'),
(71, '2801S', '28'),
(72, '2801S', '28'),
(73, '2802M', '28'),
(74, '2802S', '28'),
(75, '2871M', '28'),
(76, '2871S', '28'),
(77, '2901M', '29'),
(78, '2901S', '29'),
(79, '3001M', '30'),
(80, '3001S', '30'),
(81, '3201M', '32'),
(82, '3201S', '32'),
(83, '3271M', '32'),
(84, '3271S', '32'),
(85, '3301M', '33'),
(86, '3301S', '33'),
(87, '5101M', '51'),
(88, '5101S', '51'),
(89, '5201M', '52'),
(90, '5201S', '52'),
(91, '5301M', '53'),
(92, '5301S', '53'),
(93, '5401M', '54'),
(94, '5401S', '54'),
(95, '5501M', '55'),
(96, '5501S', '55'),
(97, '5701M', '57'),
(98, '5701S', '57'),
(99, '5801M', '58'),
(100, '5801S', '58'),
(101, '6001M', '60'),
(102, '6001M', '60'),
(103, '6001S', '60'),
(104, '6002 M', '60'),
(105, '6002S', '60'),
(106, '6003M', '60'),
(107, '6003S', '60'),
(108, '6071M', '60'),
(109, '6071S', '60'),
(110, '6072M', '60'),
(111, '6072S', '60'),
(112, '6101M', '61'),
(113, '6101S', '61'),
(114, '6171M', '61'),
(115, '6171S', '61'),
(116, '8501M', '85'),
(117, '8501S', '85'),
(118, '8571M', '85'),
(119, '8571S', '85'),
(120, '8701M', '87'),
(121, '8701S', '87'),
(122, '8771M', '87'),
(123, '8771S', '87'),
(124, '8801M', '88'),
(125, '8801S', '88'),
(126, 'RESERVE', 'RESERVE'),
(127, 'RESERVE', 'RESERVE'),
(128, 'RESERVE', 'RESERVE'),
(129, 'RESERVE', 'RESERVE'),
(130, 'RESERVE', 'RESERVE'),
(131, 'RESERVE', 'RESERVE'),
(132, 'RESERVE', 'RESERVE'),
(133, 'RESERVE', 'RESERVE'),
(134, '', 'KSL'),
(135, '4101M', '41'),
(136, '4101S', '41'),
(137, '4171M', '41'),
(138, '4171S', '41'),
(139, '4201M', '42'),
(140, '4201S', '42'),
(141, '4301M', '43'),
(142, '4301S', '43'),
(143, '4371M', '43'),
(144, '4371S', '43'),
(145, '4401M', '44'),
(146, '4401S', '44'),
(147, '4501M', '45'),
(148, '4501S', '45'),
(149, '4571M', '45'),
(150, '4571S', '45'),
(151, '8601M', '86'),
(152, '8601S', '86'),
(153, '8671M', '86'),
(154, '8671S', '86'),
(155, 'RESERVE', 'ETANG SALE'),
(156, '101M', '1'),
(157, '101S', '1'),
(158, '102M', '1'),
(159, '102S', '1'),
(160, '103Matin', '1'),
(161, '103Midi', '1'),
(162, '103Soir', '1'),
(163, '104Matin', '1'),
(164, '104Midi', '1'),
(165, '104Soir', '1'),
(166, '105Matin', '1'),
(167, '105Midi', '1'),
(168, '105Soir', '1'),
(169, '106Matin', '1'),
(170, '106Midi', '1'),
(171, '106Soir', '1'),
(172, '1101M', '11'),
(173, '1101S', '11'),
(174, '1102M', '11'),
(175, '1102S', '11'),
(176, '1103M', '11'),
(177, '1103S', '11'),
(178, '1301M', '13'),
(179, '1301S', '13'),
(180, '1302Midi', '13'),
(181, '1311-2', '13a'),
(182, '1311 1', '13A'),
(183, '1311 2', '13A'),
(184, '1371M', '13'),
(185, '1371S', '13'),
(186, '1401 1', '14'),
(187, '1401 2', '14'),
(188, '171M', '1'),
(189, '171S', '1'),
(190, '201M', '2'),
(191, '201S', '2'),
(192, '202M', '2'),
(193, '202S', '2'),
(194, '203M', '2'),
(195, '203S', '2'),
(196, '204M', '2'),
(197, '204S', '2'),
(198, '205Matin', '2'),
(199, '205MIDI', 'Ligne 2'),
(200, '205Soir', '2'),
(201, '206Matin', '2'),
(202, '206Soir', '2'),
(203, '271M', '2'),
(204, '271S', '2'),
(205, '301M', '3'),
(206, '301S', '3'),
(207, '302M', '3'),
(208, '302S', '3'),
(209, '303M', '3'),
(210, '303S', '3'),
(211, '304Matin', '3'),
(212, '304Midi', '3'),
(213, '304Soir', '3'),
(214, '305M', '3'),
(215, '305Midi', '3'),
(216, '305Soir', '3'),
(217, '306Matin', '3'),
(218, '306Midi', '3'),
(219, '306Soir', '3'),
(220, '307Matin', '3'),
(221, '307S', '3'),
(222, '371M', '3'),
(223, '371S', '3'),
(224, '401M', '4'),
(225, '401S', '4'),
(226, '402M', '4'),
(227, '402S', '4'),
(228, '403M', '4'),
(229, '403S', '4'),
(230, '404M', '4'),
(231, '404S', '4'),
(232, '405M', '4'),
(233, '405midi', '4'),
(234, '405S', '4'),
(235, '406Matin', '4'),
(236, '471M', '4'),
(237, '471S', '4'),
(238, '601M', '6'),
(239, '601S', '6'),
(240, '701M', '7'),
(241, '701S', '7'),
(242, '801M', '8'),
(243, '801S', '8'),
(244, '901M', '9'),
(245, '901S', '9'),
(246, 'AUTRES', 'AUTRES'),
(247, 'Kar 102M', 'karlavil 1'),
(248, 'Kar 102S', 'karlavil 1'),
(249, 'Kar 103M', 'karlavil 1'),
(250, 'Kar 103S', 'karlavil 1'),
(251, 'Kar 201M', 'karlavil 2'),
(252, 'Kar 201S', 'karlavil 2'),
(253, 'Kar 202M', 'karlavil 2'),
(254, 'Kar 202S', 'karlavil 2'),
(255, 'Kar101M', 'karlavil 1'),
(256, 'Kar101S', 'karlavil 1'),
(257, 'Lito8M', 'LITTORAL'),
(258, 'Lito8S', 'LITTORAL'),
(259, 'Lito9M', 'LITTORAL'),
(260, 'Lito9S', 'LITTORAL'),
(261, 'RESERVE', 'RESERVE'),
(262, 'RESERVE', 'RESERVE'),
(263, 'RESERVE', 'RESERVE'),
(264, 'RESERVE', 'RESERVE'),
(265, 'RESERVE', 'RESERVE'),
(266, 'RESERVE', 'RESERVE'),
(267, 'RESERVE', 'RESERVE'),
(268, 'RESERVE', 'RESERVE'),
(269, 'RESERVE', 'RESERVE'),
(270, 'RESERVE', 'RESERVE'),
(271, 'RESERVE', 'RESERVE'),
(272, 'Noctambus 1', 'Noctambus'),
(273, 'Noctambus 2', 'Noctambus'),
(274, '2701', 'Ligne 27'),
(275, '901MS', 'Littoral 1'),
(276, '903MS', 'Littoral 1'),
(277, '908MS', 'Littoral 2L'),
(278, 'Lito1M', 'LITTORAL'),
(279, 'Lito1S', 'LITTORAL'),
(280, 'Lito5M', 'LITTORAL'),
(281, 'Lito5S', 'LITTORAL'),
(282, 'Lito7M', 'LITTORAL'),
(283, 'Lito7S', 'LITTORAL'),
(284, 'LITTO 71M', 'LITTORAL'),
(285, 'LITTO 71S', 'LITTORAL'),
(286, '8901M', '89'),
(287, '8901S', '89'),
(288, '8971M', '89'),
(289, '8971S', '89'),
(290, '71', 'I4'),
(291, '71', 'I4'),
(292, '71-75BIS-81-74', ''),
(293, '71-75BIS-81-74', ''),
(294, '71/75BIS/71BIS/76/76BIS/77BIS/81 LIANES', '71/nav'),
(295, '71/75BIS/71BIS/76/76/77BIS LIANES', '71/nav'),
(296, '71/75BIS/71BIS/76/76/77BIS LIANES', '71/nav'),
(297, '76 BIS - 71 - 81 -77', '77'),
(298, '76 BIS - 71 - 81 -77', '77'),
(299, '76bis', 'I1'),
(300, '76bis', 'I1'),
(301, '77', '77'),
(302, '77', '77'),
(303, '77BIS', 'I3'),
(304, '77BIS', 'I3'),
(305, '78', '78'),
(306, '78', '78'),
(307, '79-71-76BIS-75BIS', ''),
(308, '79-71-76BIS-75BIS', ''),
(309, '79-71-76BIS-75BIS', ''),
(310, '79-71-76BIS-75BIS', ''),
(311, '79-71-76BIS-75BIS', ''),
(312, '79-71-76BIS-75BIS', ''),
(313, '79-71-76BIS-75BIS', ''),
(314, '79-71-76BIS-75BIS', ''),
(315, '79-71-76BIS-75BIS', ''),
(316, '79-71-76BIS-75BIS', ''),
(317, '81', 'I2'),
(318, '81', 'I2'),
(319, '83', '83'),
(320, 'A', '38'),
(321, 'A', '38'),
(322, 'A', 'T01'),
(323, 'A', 'T01'),
(324, 'AC', 'T12'),
(325, 'AC', 'T12'),
(326, 'AC', 'T12'),
(327, 'b', 'T01'),
(328, 'b', 'T01'),
(329, 'Entre-deux', '38'),
(330, 'MAGMABUS', ''),
(331, 'MAGMABUS', ''),
(332, 'MAGMABUS', ''),
(333, 'MAGMABUS', ''),
(334, 'NAV1', 'FLORIBUS'),
(335, 'NAV1', 'FLORIBUS'),
(336, 'NAV3', 'FLORIBUS'),
(337, 'NAV3', 'FLORIBUS'),
(338, 'NAV4', 'FLORIBUS'),
(339, 'NAV4', 'FLORIBUS'),
(340, 'R', 'T09'),
(341, 'R', 'T09'),
(342, 'RESERVE', 'RESERVE'),
(343, 'RESERVE', 'RESERVE'),
(344, 'RESERVE', 'RESERVE'),
(345, 'RESERVE', 'RESERVE'),
(346, 'RESERVE', 'FLORIBUS'),
(347, 'RESERVE', 'RESERVE'),
(348, 'RESERVE', 'RESERVE'),
(349, 'RESERVE', 'RESERVE'),
(350, 'RESERVE', 'RESERVE'),
(351, 'RESERVE', 'RESERVE'),
(352, 'RESERVE', 'RESERVE'),
(353, 'RESERVE', 'RESERVE'),
(354, 'RESERVE', 'RESERVE'),
(355, 'RESERVE', 'FLORIBUS'),
(356, 'S', 'T09'),
(357, 'SJS06', '68465'),
(358, 'SJS09', '83'),
(359, 'STE', 'STE'),
(360, 'STE', 'STE'),
(361, 'U', 'T10'),
(362, 'U', 'T10'),
(363, 'y', 'T12'),
(364, 'y', 'T12'),
(365, '', ''),
(366, '/76BIS/77BIS/71 LIANES', ''),
(367, 'SJD07', '79'),
(368, 'SJS11', '71/76 BIS/77BIS/81'),
(369, 'SJS12', '79'),
(370, 'SJS12', '78BIS/79'),
(371, 'SJS12', '78B/79'),
(372, 'SJS12', '78BIS'),
(373, 'SJS12', '79'),
(374, 'SJS12', '78BIS'),
(375, 'SJS13', '79/71'),
(376, 'SJS14', '71/75BIS/81'),
(377, '7201', '72'),
(378, '7202', '72'),
(379, '7501', '75'),
(380, '7502', '75'),
(381, '7503', '75/79'),
(382, '7601', '76'),
(383, '7601', '76'),
(384, '8401', '84'),
(385, 'AE', 'T14'),
(386, 'C', 'T02'),
(387, 'D', 'T02'),
(388, 'Entre-deux', '39'),
(389, 'F', 'T03'),
(390, 'H', 'T03'),
(391, 'J', 'T05'),
(392, 'K', 'T05'),
(393, 'M', 'T06'),
(394, 'M', 'T06'),
(395, 'NAV2', 'FLORIBUS'),
(396, 'NAV2', 'FLORIBUS'),
(397, 'NAV5', 'FLORIBUS'),
(398, 'NAV5', 'FLORIBUS'),
(399, 'NAV6', 'FLORIBUS'),
(400, 'NAV6', 'FLORIBUS'),
(401, 'P', 'T08'),
(402, 'Q', 'T08'),
(403, 'RESERVE', 'RESERVE'),
(404, 'RESERVE', 'RESERVE'),
(405, 'RESERVE', 'RESERVE'),
(406, 'RESERVE', 'RESERVE'),
(407, 'RESERVE', 'RESERVE'),
(408, 'RESERVE', 'RESERVE'),
(409, 'RESERVE', 'FLORIBUS'),
(410, 'RESERVE', 'RESERVE'),
(411, 'RESERVE', 'RESERVE'),
(412, 'RESERVE', 'FLORIBUS'),
(413, 'STC', 'STC1'),
(414, 'STC', 'STC2'),
(415, 'STC2', 'STC'),
(416, 'X', 'T11'),
(417, 'Y', 'T12'),
(418, 'Y', 'T12'),
(419, '0', '8'),
(420, 'AB', 'T13'),
(421, 'AD', 'T13'),
(422, 'AD', 'T13'),
(423, 'Entre-deux', 'RESERVE'),
(424, 'G', 'T03'),
(425, 'J', 'T05'),
(426, 'J', 'T05'),
(427, 'RESERVE', 'RESERVE'),
(428, 'RESERVE', 'RESERVE'),
(429, 'RESERVE', 'RESERVE'),
(430, 'RESERVE', 'RESERVE'),
(431, 'RESERVE', 'RESERVE'),
(432, 'RESERVE', 'RESERVE'),
(433, 'RESERVE', 'RESERVE'),
(434, 'RESERVE', 'RESERVE'),
(435, 'RESERVE', 'RESERVE'),
(436, 'RESERVE', 'STA'),
(437, 'RESERVE', 'RESERVE'),
(438, 'RESERVE', 'RESERVE'),
(439, 'RESERVE', 'RESERVE'),
(440, 'RESERVE', 'RESERVE'),
(441, 'RESERVE', 'RESERVE'),
(442, 'RESERVE', 'RESERVE'),
(443, 'STA', 'STA'),
(444, 'V', 'T11'),
(445, 'V', 'T11'),
(446, 'V', 'T11'),
(447, 'W', 'T11'),
(448, 'W', 'T11'),
(449, 'X', 'T11'),
(450, 'Z', 'T11'),
(451, 'Z', 'T11'),
(452, 'RESERVE', 'GERANIUM'),
(453, '0', 'GERANIUM'),
(454, 'Magma Bus', 'Magma Bus'),
(455, 'MAGMABUS', 'MAGMABUS'),
(456, 'RESERVE', 'RESERVE'),
(457, 'RESERVE', 'RESERVE'),
(458, 'RESERVE', 'RESERVE'),
(459, 'RESERVE', 'RESERVE'),
(460, 'RESERVE', 'RESERVE'),
(461, 'RESERVE', 'RESERVE'),
(462, 'RESERVE', 'RESERVE'),
(463, 'RESERVE', 'RESERVE'),
(464, 'RESERVE', 'RESERVE'),
(465, 'RESERVE', 'RESERVE'),
(466, 'RESERVE', 'RESERVE'),
(467, 'RESERVE', 'RESERVE'),
(468, 'RESERVE', 'RESERVE'),
(469, 'RESERVE', 'RESERVE'),
(470, 'RESERVE', 'RESERVE'),
(471, 'RESERVE', 'RESERVE'),
(472, 'VOYAGE', '71'),
(473, 'VOYAGE', '71'),
(474, 'Entre-deux', '38bis/37'),
(475, '7301', '73'),
(476, '7302', '73'),
(477, '74', '74'),
(478, '74', '74'),
(479, '7701', '77'),
(480, '7801', '78'),
(481, '7802', '78'),
(482, '8101', '81'),
(483, '8102', '81'),
(484, '8301', '83'),
(485, '8301 Dim', '83'),
(486, 'GECKOBUS', 'GECKO 4 boucle Ouest'),
(487, 'GECKOBUS', 'GECKO 1 boucle Est'),
(488, 'GECKOBUS', 'GECKO 4 boucle Ouest'),
(489, 'GECKOBUS', ''),
(490, 'GECKOBUS 2', 'GECKOBUS'),
(491, 'GECKOBUS 4', 'GECKO 1 boucle Est'),
(492, 'STD01', 'STD'),
(493, 'STD02', 'STD'),
(494, '0', 'STD 01 Dim'),
(495, '1', 'FLORIANA'),
(496, '2', 'FLORIANA'),
(497, '2', 'FLORIANA'),
(498, '3', 'FLORIANA'),
(499, '3', 'FLORIANA'),
(500, 'AA', 'T12B'),
(501, 'AA', 'T12B1'),
(502, 'AA', 'T12B1'),
(503, 'AA', 'T12B1'),
(504, 'B', 'T01'),
(505, 'I', 'T04'),
(506, 'I', 'T04'),
(507, 'L', 'T05B'),
(508, 'L', 'T05B'),
(509, 'L', 'T05B'),
(510, 'N', 'T07'),
(511, 'N', 'T07'),
(512, 'N', 'T07'),
(513, 'O', 'T07'),
(514, 'O', 'T07'),
(515, 'O', 'T07'),
(516, 'RESERVE', 'RESERVE'),
(517, 'RESERVE', 'RESERVE'),
(518, 'RESERVE', 'RESERVE'),
(519, 'RESERVE', 'RESERVE'),
(520, 'RESERVE', 'RESERVE'),
(521, 'RESERVE', 'RESERVE'),
(522, 'RESERVE', 'RESERVE'),
(523, 'RESERVE', 'RESERVE'),
(524, 'RESERVE', 'RESERVE'),
(525, 'RESERVE', 'RESERVE'),
(526, 'RESERVE', 'RESERVE'),
(527, 'RESERVE', 'RESERVE'),
(528, 'RESERVE', 'RESERVE'),
(529, 'RESERVE', 'RESERVE'),
(530, 'RESERVE', 'RESERVE'),
(531, 'RESERVE', 'RESERVE'),
(532, 'RESERVE', 'RESERVE'),
(533, 'RESERVE', 'RESERVE'),
(534, 'RESERVE', 'RESERVE'),
(535, 'RESERVE', 'RESERVE'),
(536, 'T', 'T09B'),
(537, 'AF', 'T14'),
(538, 'RESERVE', 'RESERVE'),
(539, 'num', 'ligne');

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `id` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `nom`) VALUES
(14, 'ah niave'),
(15, 'balaya freres'),
(16, 'bci'),
(17, 'charles express'),
(18, 'mooland'),
(19, 'papangue 2000'),
(20, 'semittel'),
(21, 'std'),
(22, 'taxi dijoux (sst)'),
(23, 'taxi cilaos (sst)'),
(24, 'taxiteur'),
(25, 'tbf'),
(26, 'AUTRE');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `idticket` int(255) NOT NULL,
  `datecreationticket` datetime NOT NULL,
  `dateEvent` date NOT NULL,
  `heure` time NOT NULL,
  `serviceagent` varchar(255) NOT NULL,
  `reseau` varchar(255) NOT NULL,
  `ligne` varchar(255) NOT NULL,
  `servicevehi` varchar(255) NOT NULL,
  `commune` varchar(255) NOT NULL,
  `sensvehic` varchar(20) NOT NULL,
  `societevehic` varchar(255) NOT NULL,
  `immatriculationvehic` varchar(9) NOT NULL,
  `parc` varchar(255) NOT NULL,
  `nature` varchar(255) NOT NULL,
  `conducteur` varchar(255) NOT NULL,
  `details` varchar(300) NOT NULL,
  `traitement` varchar(300) NOT NULL,
  `diffusion` varchar(3) DEFAULT NULL,
  `userID` varchar(255) NOT NULL,
  `autreparc` varchar(255) NOT NULL,
  `nomAgent` varchar(255) NOT NULL,
  `mail` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`idticket`, `datecreationticket`, `dateEvent`, `heure`, `serviceagent`, `reseau`, `ligne`, `servicevehi`, `commune`, `sensvehic`, `societevehic`, `immatriculationvehic`, `parc`, `nature`, `conducteur`, `details`, `traitement`, `diffusion`, `userID`, `autreparc`, `nomAgent`, `mail`) VALUES
(30, '2025-02-18 09:11:00', '1010-10-10', '10:10:00', 'semittel', '', '', '', '', '', '', '', '', 'etat voirie', 'XXXX', '', '', 'non', 'admin', '', '', ''),
(31, '2025-02-18 09:12:00', '1010-10-10', '10:10:00', 'semittel', '', '', 'XXXX', '', '', '', '', '', 'etat voirie', 'XXXX', '', '', 'non', 'admin', '', '', ''),
(33, '2025-02-18 09:14:00', '4422-02-04', '04:24:00', 'semittel', '', '', '', '', '', '', '', '', 'etat voirie', 'test3', '', '', 'non', 'admin', '', '', ''),
(35, '2025-02-19 10:47:00', '1010-10-10', '10:10:00', 'semittel', '', '', '', '', '', '', '', '', 'accident', '', '', '', 'non', 'admin', '', '', 'ethanielg450@gmail.com'),
(36, '2025-02-19 10:56:00', '1010-10-10', '10:10:00', 'semittel', '', '', '', '', '', '', '', '', 'accrochage', '', 'test', '', 'non', 'admin', '', '', 'ethanielg450@gmail.com'),
(37, '2025-02-19 11:08:00', '1010-10-10', '10:10:00', 'semittel', '', '', '', '', '', '', '', '', 'etat proprete', '', 'test', '', 'non', 'admin', '', '', 'ethanielg450@gmail.com'),
(38, '2025-02-19 11:41:00', '1010-10-10', '10:10:00', 'semittel', '', '', '', '', '', '', '', '', 'accrochage', '', '', '', 'non', 'admin', '', '', 'ethanielg450@gmail.com'),
(39, '2025-02-19 11:42:00', '1010-10-10', '10:10:00', 'semittel', '', '', '', '', '', '', '', '', 'accrochage', '', 'test', '', 'non', 'admin', '', '', 'ethanielg450@gmail.com'),
(40, '2025-02-20 09:03:00', '2025-02-12', '11:05:00', 'semittel', '', '', '', '', '', '', '', '', 'divers', '', '', '', 'oui', 'admin', '', '', ''),
(41, '2025-02-20 09:15:00', '1010-10-10', '10:10:00', 'semittel', '', '', '', '', '', '', '', '', 'accident', '', '', '', 'non', 'admin', '', '', 'fred.millet@semittel.re');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `societe` int(255) NOT NULL,
  `role` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `password`, `societe`, `role`) VALUES
('admin', '$2y$10$S.LYVjKU.GNk.X2jCLzDkevJJMtZzE0NPH6ijE2YVhwmsaD6feKGW', 20, '2'),
('config', '$2y$10$cXz0/OnTl/3pU60AlXGDueZAfz5Ck5T20JkbI/lIQUPQYJp50BL96', 26, '0'),
('sioche.samuel', '$2y$10$zmn2ValUoSXUmPSg/SSbTeMwsl5H7EPq6B5MoZD2bmtXIcYpvTDaa', 20, '2'),
('user', '$2y$10$BO.GMTvoosCYrO8tI4nHT.O6Qv7vVVC6LMSAZzw3IXxKIp6K1RDwm', 26, '0');

-- --------------------------------------------------------

--
-- Structure de la table `usersociete`
--

CREATE TABLE `usersociete` (
  `userID` varchar(255) NOT NULL,
  `societeID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `usersociete`
--

INSERT INTO `usersociete` (`userID`, `societeID`) VALUES
('admin', 20),
('sioche.samuel', 20),
('user', 26);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email`,`societeID`);

--
-- Index pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_ligne_reseau` (`reseau`);

--
-- Index pour la table `nature`
--
ALTER TABLE `nature`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parc`
--
ALTER TABLE `parc`
  ADD PRIMARY KEY (`immatriculation`),
  ADD UNIQUE KEY `num` (`num`),
  ADD KEY `FK_societe` (`societeID`);

--
-- Index pour la table `reseau`
--
ALTER TABLE `reseau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idticket`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_societeuser` (`societe`);

--
-- Index pour la table `usersociete`
--
ALTER TABLE `usersociete`
  ADD PRIMARY KEY (`userID`,`societeID`),
  ADD KEY `FK_usersociete_societeID` (`societeID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `nature`
--
ALTER TABLE `nature`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `reseau`
--
ALTER TABLE `reseau`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=549;

--
-- AUTO_INCREMENT pour la table `societe`
--
ALTER TABLE `societe`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idticket` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `FK_ligne_reseau` FOREIGN KEY (`reseau`) REFERENCES `reseau` (`id`);

--
-- Contraintes pour la table `parc`
--
ALTER TABLE `parc`
  ADD CONSTRAINT `FK_societe` FOREIGN KEY (`societeID`) REFERENCES `societe` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_societeuser` FOREIGN KEY (`societe`) REFERENCES `societe` (`id`);

--
-- Contraintes pour la table `usersociete`
--
ALTER TABLE `usersociete`
  ADD CONSTRAINT `FK_usersociete_societeID` FOREIGN KEY (`societeID`) REFERENCES `societe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
