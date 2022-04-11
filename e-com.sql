-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Már 31. 20:52
-- Kiszolgáló verziója: 10.4.18-MariaDB
-- PHP verzió: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `e-com`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allow`
--

CREATE TABLE `allow` (
  `Id` int(11) NOT NULL,
  `Allow` int(11) NOT NULL,
  `Text` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `allow`
--

INSERT INTO `allow` (`Id`, `Allow`, `Text`) VALUES
(1, 0, 'Engedélyezve'),
(2, 1, 'Blokkolva');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `authentication`
--

CREATE TABLE `authentication` (
  `Id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserPass` varchar(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FPass` varchar(255) NOT NULL,
  `Allow` tinyint(4) NOT NULL,
  `Token` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `authentication`
--

INSERT INTO `authentication` (`Id`, `Email`, `UserName`, `UserPass`, `Date`, `FPass`, `Allow`, `Token`) VALUES
(30, 'mate.barath123@gmail.com', 'Pokemon2000', '$2y$10$UsYZg5e9erG1cnsClEo3g.Xq0wOStILHZe6NqCylxhvP1f5V5Xur6', '2022-03-31 17:59:30', '$2y$10$yelGsJ2MixKNmtdGHmund.kDTaWFZ0YBei1TZ2wQVQxcQZgVK6fdC', 0, ''),
(34, 'szit@gmail.com', 'szitponthu', '$2y$10$w7YGPXBQG8zcgiJ6IPvTWOQXF/MGg7V3qY9f2CQZe4WqprzhEYT72', '2022-03-31 18:49:18', '', 1, ''),
(35, 'szitooo@gmail.com', 'qwertzuiop', '$2y$10$trSqPDpbnuaUHzAy0LYJkePobVVrAFMd8YTloffBzRrXy5anQ285W', '2022-03-31 18:49:34', '', 0, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `conditions`
--

CREATE TABLE `conditions` (
  `Id` int(11) NOT NULL,
  `Conditions` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `conditions`
--

INSERT INTO `conditions` (`Id`, `Conditions`) VALUES
(1, 'új,garanciás'),
(2, 'új'),
(3, 'megkímélt'),
(4, 'használt'),
(5, 'rossz');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `districts`
--

CREATE TABLE `districts` (
  `Id` int(11) NOT NULL,
  `District` varchar(25) NOT NULL,
  `Map` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `districts`
--

INSERT INTO `districts` (`Id`, `District`, `Map`) VALUES
(1, 'I. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21565.152210961784!2d19.019930412277205!3d47.496847662483354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc3c8591f34d%3A0x500c4290c1ed540!2sBudapest%2C%20I.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071489737!5m2!1shu!2shu'),
(2, 'II. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43092.912238224744!2d18.949775121073124!3d47.542353110471794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741d8da37648a2d%3A0x500c4290c1ed550!2sBudapest%2C%20II.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071519879!5m2!1shu!2shu'),
(3, 'III. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43071.375295729216!2d18.99174507129518!3d47.56854808194992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741d9a614c7b6f1%3A0x500c4290c1ed560!2sBudapest%2C%20III.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071677823!5m2!1shu!2shu'),
(4, 'IV. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43063.757803120745!2d19.060497971373707!3d47.577810471862925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741da16d34ed611%3A0x500c4290c1ed570!2sBudapest%2C%20IV.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071702808!5m2!1shu!2shu'),
(5, 'V. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21563.750664907184!2d19.03452291228438!3d47.50026011061278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc154c687d4d%3A0x500c4290c1ed580!2sBudapest%2C%20V.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071730611!5m2!1shu!2shu'),
(6, 'VI. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21560.53239912784!2d19.050263462300883!3d47.508095156317616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc71ba0e300b%3A0xfc696597fc7dbdc7!2sBudapest%2C%20VI.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071751571!5m2!1shu!2shu'),
(7, 'VII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10781.364993682717!2d19.06462123793881!3d47.50274511273268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc64571d2f19%3A0x500c4290c1ed5a0!2sBudapest%2C%20VII.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071772782!5m2!1shu!2shu'),
(8, 'VIII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21568.231671753154!2d19.06639886226147!3d47.48934921659338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dcf3c3e0ae53%3A0x8913eb19db45353b!2zQnVkYXBlc3QsIErDs3pzZWZ2w6Fyb3M!5e0!3m2!1shu!2shu!4v1639071802674!5m2!1shu!2shu'),
(9, 'IX. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43156.47032094859!2d19.05660502041791!3d47.46498464466812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dd23b15f80d1%3A0x500c4290c1ed5c0!2sBudapest%2C%20IX.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071825332!5m2!1shu!2shu'),
(10, 'X. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43142.23230719945!2d19.125063470564694!3d47.48232472580357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c36aead9dba1%3A0x500c4290c1ed5d0!2sBudapest%2C%20X.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071866078!5m2!1shu!2shu'),
(11, 'XI. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43161.8651686504!2d18.983705470362317!3d47.458413151816465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741ddec6463400b%3A0x500c4290c1ed5e0!2sBudapest%2C%20XI.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071562516!5m2!1shu!2shu'),
(12, 'XII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43123.91141750228!2d18.94350012075354!3d47.5046301515322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dee5baf97335%3A0x500c4290c1ed5f0!2sBudapest%2C%20XII.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071888814!5m2!1shu!2shu'),
(13, 'XIII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43097.18316159089!2d19.034372071029086!3d47.53715716612839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dbc20f646df1%3A0x8011f3c6e6165e72!2sBudapest%2C%20XIII.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071914804!5m2!1shu!2shu'),
(14, 'XIV. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43109.216973960145!2d19.07967447090503!3d47.52251468206737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741db6e6f817863%3A0x500c4290c1ed610!2sBudapest%2C%20XIV.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071938398!5m2!1shu!2shu'),
(15, 'XV. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10769.824402215167!2d19.11054523796826!3d47.55891359727376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741da582bed0571%3A0xbe9911e482a0de8c!2sBudapest%2C%20Budapest%20XV.%20ker%C3%BClete%2C%201152!5e0!3m2!1shu!2shu!4v1639071964192!5m2!1shu!2shu'),
(16, 'XVI. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43111.95006709602!2d19.169164970876864!3d47.51918863568756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c4f1799506fb%3A0x500c4290c1ed630!2sBudapest%2C%20XVI.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639071982822!5m2!1shu!2shu'),
(17, 'XVII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10785.970959538074!2d19.25794533792708!3d47.48031361890283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c14ced5363d9%3A0x952cc27ec40f364d!2sBudapest%2C%20Budapest%20XVII.%20ker%C3%BClete%2C%201173!5e0!3m2!1shu!2shu!4v1639072018884!5m2!1shu!2shu'),
(18, 'XVIII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43188.34430645334!2d19.174857620089387!3d47.426148736906136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c1f68f465649%3A0x500c4290c1ed650!2sBudapest%2C%20XVIII.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639072038797!5m2!1shu!2shu'),
(19, 'XIX. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21586.125900793697!2d19.125501962169828!3d47.44575919047787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c2ec5a927e11%3A0x500c4290c1ed660!2sBudapest%2C%20XIX.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639072063727!5m2!1shu!2shu'),
(20, 'XX. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43182.43984268434!2d19.08830602015024!3d47.43334467908108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c2a2cfe2d4ad%3A0x500c4290c1ed670!2sBudapest%2C%20XX.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639072085278!5m2!1shu!2shu'),
(21, 'XXI. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43190.61702279621!2d19.031123170065964!3d47.423378689918216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741e7ee650b9249%3A0x500c4290c1ed680!2sBudapest%2C%20XXI.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639072118699!5m2!1shu!2shu'),
(22, 'XXII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10797.318906644186!2d19.022912237898137!3d47.425013634105326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741e79e6a97ce95%3A0xfcfbb1c858b18cc1!2sBudapest%2C%20Budapest%20XXII.%20ker%C3%BClete%2C%201222!5e0!3m2!1shu!2shu!4v1639072136852!5m2!1shu!2shu'),
(23, 'XXIII. Kerület', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43218.3424606474!2d19.110241569780204!3d47.38957627666697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741e9a4bf7f2d5f%3A0x500c4290c1ed6a0!2sBudapest%2C%20XXIII.%20ker%C3%BClet!5e0!3m2!1shu!2shu!4v1639072159510!5m2!1shu!2shu');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `imgs`
--

CREATE TABLE `imgs` (
  `Id` int(11) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `ItemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `imgs`
--

INSERT INTO `imgs` (`Id`, `Img`, `ItemId`) VALUES
(83, 'image/yrMEPyGA/pexels-cottonbro-5914907.jpg', 42),
(84, 'image/yrMEPyGA/pexels-cottonbro-5911698.jpg', 42),
(85, 'image/yrMEPyGA/pexels-bayram-er-9651659.jpg', 42),
(86, 'image/yrMEPyGA/pexels-leandro-boogalu-1149601.jpg', 42),
(87, 'image/yrMEPyGA/pexels-pixabay-276517.jpg', 42),
(93, 'image/VLDF2RpM/pexels-philipp-m-100582 (1).jpg', 44),
(94, 'image/VLDF2RpM/pexels-cottonbro-5914907.jpg', 44),
(95, 'image/VLDF2RpM/pexels-cottonbro-5911698.jpg', 44),
(96, 'image/VLDF2RpM/pexels-bayram-er-9651659.jpg', 44),
(97, 'image/VLDF2RpM/pexels-leandro-boogalu-1149601.jpg', 44),
(118, 'image/jv2CgAXo/pexels-vadim-b-127016.jpg', 47),
(119, 'image/jv2CgAXo/pexels-bayram-er-9651659.jpg', 47),
(120, 'image/jv2CgAXo/pexels-timea-kadar-2130611.jpg', 47),
(121, 'image/jv2CgAXo/pexels-leandro-boogalu-1149601.jpg', 47),
(124, 'image/ND0xq76n/pexels-philipp-m-100582 (1).jpg', 43),
(125, 'image/ND0xq76n/pexels-vadim-b-127016.jpg', 43),
(126, 'image/ND0xq76n/pexels-cottonbro-5914907.jpg', 43),
(127, 'image/ND0xq76n/pexels-dominika-roseclay-4318198.jpg', 43),
(128, 'image/ND0xq76n/pexels-timea-kadar-2130611.jpg', 43),
(129, 'image/ND0xq76n/pexels-leandro-boogalu-1149601.jpg', 43),
(130, 'image/jhwmzEkm/pexels-cottonbro-5911698.jpg', 46),
(131, 'image/jhwmzEkm/pexels-bayram-er-9651659.jpg', 46),
(132, 'image/jhwmzEkm/pexels-dominika-roseclay-4318198.jpg', 46),
(133, 'image/jhwmzEkm/pexels-timea-kadar-2130611.jpg', 46),
(134, 'image/jhwmzEkm/pexels-leandro-boogalu-1149601.jpg', 46),
(135, 'image/jhwmzEkm/pexels-pixabay-276517.jpg', 46),
(136, 'image/jhwmzEkm/pexels-philipp-m-100582.jpg', 46);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `items`
--

CREATE TABLE `items` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `CreateDate` datetime(6) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `Description` text NOT NULL,
  `TypeId` int(11) NOT NULL,
  `SizeId` int(11) NOT NULL,
  `FolderName` varchar(255) NOT NULL,
  `SellerId` int(11) NOT NULL,
  `DistrictId` int(11) NOT NULL,
  `ConId` int(11) NOT NULL,
  `Brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `items`
--

INSERT INTO `items` (`Id`, `Title`, `CreateDate`, `Img`, `Price`, `Description`, `TypeId`, `SizeId`, `FolderName`, `SellerId`, `DistrictId`, `ConId`, `Brand`) VALUES
(42, 'Kerékpár1', '2022-02-22 14:04:04.000000', 'image/yrMEPyGA/pexels-cottonbro-5914907.jpg', 125000, 'has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishin', 4, 8, 'yrMEPyGA', 30, 15, 1, 'NoName'),
(43, 'Kerékpár2', '2022-02-22 15:04:22.000000', 'image/ND0xq76n/pexels-philipp-m-100582 (1).jpg', 89000, ' is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed', 10, 10, 'ND0xq76n', 30, 16, 2, 'Suzzy'),
(44, 'Kerékpár 3', '2022-02-22 14:07:24.000000', 'image/VLDF2RpM/pexels-cottonbro-5911698.jpg', 156000, ' is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed', 4, 10, 'VLDF2RpM', 30, 23, 3, 'Márka'),
(46, 'teszt', '2022-02-22 15:12:57.000000', 'image/jhwmzEkm/pexels-dominika-roseclay-4318198.jpg', 225000, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, 2, 'jhwmzEkm', 30, 14, 1, 'NoName'),
(47, 'Bico', '2022-02-22 14:29:05.000000', 'image/jv2CgAXo/pexels-vadim-b-127016.jpg', 52000, 'Just to give some validation to this answer, this was my problem. My table had ', 7, 9, 'jv2CgAXo', 34, 16, 4, 'ASD');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kenorby`
--

CREATE TABLE `kenorby` (
  `Id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Token` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `kenorby`
--

INSERT INTO `kenorby` (`Id`, `userName`, `Password`, `Token`) VALUES
(1, '123456789', '$2y$10$OZOb/jcd0TFp2kpDHQRO1uPzU57Bhgo5QoAzRuRgPxTUMxwmKC.oK', '7783137564'),
(3, 'Admin2021', '$2y$10$qOZ6ZSe7r5QYiP22mhSxdeUAKFfxfbRVaTthc/BTPFhzW/Tg9K6B.', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `messages`
--

CREATE TABLE `messages` (
  `Id` int(11) NOT NULL,
  `Incoming` int(11) NOT NULL,
  `Outgoing` int(11) NOT NULL,
  `Msg` text NOT NULL,
  `ItemId` int(11) NOT NULL,
  `inc` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `messages`
--

INSERT INTO `messages` (`Id`, `Incoming`, `Outgoing`, `Msg`, `ItemId`, `inc`) VALUES
(94, 34, 30, 'hali', 42, '42_34'),
(98, 30, 34, 'hali', 42, '42_34'),
(99, 34, 30, 'mukodik', 42, '42_34'),
(100, 34, 30, 'ja', 42, '42_34'),
(101, 30, 34, 'minden oke', 42, '42_34'),
(102, 34, 30, 'oké', 43, '43_34'),
(103, 30, 34, 'igen', 43, '43_34'),
(104, 34, 30, 'oké', 43, '43_34'),
(105, 34, 30, 'végre', 42, '42_34');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mobil`
--

CREATE TABLE `mobil` (
  `Mid` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `mobil`
--

INSERT INTO `mobil` (`Mid`, `UserId`, `Counter`) VALUES
(1, 30, 0),
(2, 34, 46),
(3, 35, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `settings`
--

CREATE TABLE `settings` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PhoneNumber` varchar(11) NOT NULL,
  `City` varchar(255) NOT NULL,
  `ZipCode` int(4) NOT NULL,
  `Street` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `settings`
--

INSERT INTO `settings` (`Id`, `UserId`, `PhoneNumber`, `City`, `ZipCode`, `Street`) VALUES
(18, 30, '06304589641', 'Pokemon', 4566, 'Pokemon 2000'),
(19, 34, '', '', 0, ''),
(20, 35, '', '', 0, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sizes`
--

CREATE TABLE `sizes` (
  `Id` int(11) NOT NULL,
  `Size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `sizes`
--

INSERT INTO `sizes` (`Id`, `Size`) VALUES
(1, 150),
(2, 155),
(3, 160),
(4, 165),
(5, 170),
(6, 175),
(7, 180),
(8, 185),
(9, 190),
(10, 195),
(11, 200);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `types`
--

CREATE TABLE `types` (
  `Id` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `types`
--

INSERT INTO `types` (`Id`, `Type`) VALUES
(1, 'Mountain Bike'),
(2, 'Down-Hill '),
(3, 'Trekking '),
(4, 'Országúti'),
(5, 'City Bike'),
(6, 'Dirt'),
(7, 'Triál '),
(8, 'BMX '),
(9, 'Cross'),
(10, 'Fitness '),
(11, 'Gravel ');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allow`
--
ALTER TABLE `allow`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `imgs`
--
ALTER TABLE `imgs`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `TypeId` (`TypeId`,`SizeId`,`SellerId`,`DistrictId`,`ConId`);

--
-- A tábla indexei `kenorby`
--
ALTER TABLE `kenorby`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`Mid`),
  ADD UNIQUE KEY `UserId` (`UserId`);

--
-- A tábla indexei `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserId` (`UserId`);

--
-- A tábla indexei `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`Id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allow`
--
ALTER TABLE `allow`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `authentication`
--
ALTER TABLE `authentication`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT a táblához `conditions`
--
ALTER TABLE `conditions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `districts`
--
ALTER TABLE `districts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `imgs`
--
ALTER TABLE `imgs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT a táblához `items`
--
ALTER TABLE `items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT a táblához `kenorby`
--
ALTER TABLE `kenorby`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `messages`
--
ALTER TABLE `messages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT a táblához `mobil`
--
ALTER TABLE `mobil`
  MODIFY `Mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `settings`
--
ALTER TABLE `settings`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `sizes`
--
ALTER TABLE `sizes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `types`
--
ALTER TABLE `types`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
