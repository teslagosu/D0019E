-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Värd: localhost
-- Tid vid skapande: 17 maj 2020 kl 22:15
-- Serverversion: 5.6.37
-- PHP-version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `Blogg`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `Image`
--

CREATE TABLE IF NOT EXISTS `Image` (
  `image_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `image_name` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `Image`
--

INSERT INTO `Image` (`image_id`, `post_id`, `image_name`) VALUES
(1, 15, 'Screenshot_5.jpg'),
(2, 17, 'hej.jpg'),
(3, 18, 'lab6 CMD getmapRequest.jpg'),
(4, 19, 'lab7OSM.jpg'),
(5, 20, 'lab7OSM.jpg'),
(6, 27, 'kallemera8-1.jpg'),
(7, 28, 'FridaPosition4.jpg'),
(17, 54, 'Screenshot_10.jpg'),
(18, 56, 'pizza.jpg'),
(19, 59, 'zoo-bear-35435.jpg'),
(20, 60, 'brown-bear-plush-toy-708774.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `post_id` int(11) NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `post_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `post_content` text CHARACTER SET latin1 NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `Post`
--

INSERT INTO `Post` (`post_id`, `post_user_id`, `post_title`, `post_content`, `post_date`) VALUES
(1, 1, 'test titel', 'test content', '2020-05-07'),
(7, 1, 'asdadadasdadadada', 'dasdadadasdsadada', '2020-05-08'),
(8, 2, 'Presentation av min blogg', 'Hej så här är det tänkt att min blogg ska se ut och handla om', '2020-05-08'),
(9, 61, 'Kan det ha varit den varmaste dagen någonsin?', 'Idag var det varmt som fan', '2020-05-16'),
(10, 61, 'Kalle köpte glass', 'Kalle var iväg och köpte en glass på torget i kiruna', '2020-05-16'),
(11, 61, 'Kom på en sak..', 'Det var ingenting hejdå', '2020-05-16'),
(12, 61, 'kalle', 'sdadadadsada', '2020-05-16'),
(13, 61, 'Brännvin och programmering', 'Det är en dålig kombo ska ni veta', '2020-05-16'),
(14, 61, 'test', 'vad händer nu?', '2020-05-16'),
(15, 61, 'testar om bild laddas upp', 'kalle', '2020-05-16'),
(17, 61, 'nelson', 'nelson', '2020-05-16'),
(18, 5, 'johanåsna', 'vafan händer', '2020-05-16'),
(19, 5, 'En kall öl om dagen', 'Det hade varit någonting att se fram emot', '2020-05-16'),
(20, 5, 'Långa dagar', 'Ibland kan man bara undra hur folk tänker', '2020-05-16'),
(26, 62, '4324324', '43242342', '2020-05-16'),
(27, 5, 'testar om det går att uppdatera bild', 'hej jag är knäpp', '2020-05-16'),
(28, 63, 'tennis', 'jag suger på tenniis', '2020-05-16'),
(54, 7, '#1 utan bild men nu med en bild', '#1 med en text', '2020-05-17'),
(55, 7, 'Hej mamma mia', 'Oj vad detta blev konstigt', '2020-05-17'),
(56, 64, 'Pizzeria irna', 'Hej vill bara ge er info om att nu går det bra att beställa våra pizzor igen. Väntetiden är ungefär 15minuter en kvart.', '2020-05-17'),
(57, 65, 'dsadada', 'dsadadas', '2020-05-17'),
(58, 65, 'åäöåäöasd', 'åäöåäöåäöåäöåödsadadadasda', '2020-05-17'),
(59, 102, 'Gröna ängar är det finaste jag vet', 'Idag var jag ute och gick en runda i skogen och jag såg att en björn stod väldigt nära en ekorre. det gjorde mig väldigt rädd. Hur som helst så gick det bra.', '2020-05-17'),
(60, 102, 'Kan man vara annat än rädd', 'Jag är sjukt nojjig över att den här sidan inte kommer fungera när jag laddar upp den till skolans server', '2020-05-17');

-- --------------------------------------------------------

--
-- Tabellstruktur `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `user_presentation` text CHARACTER SET latin1
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `User`
--

INSERT INTO `User` (`user_id`, `user_name`, `user_password`, `user_image`, `user_presentation`) VALUES
(1, 'test', 'test', 'test.jpg', 'corona'),
(2, 'kalle', '123', NULL, 'Den här bloggen handlar om lite grejer'),
(3, 'Haxx0rsizten1337', '123', 'anon_user.jpg', 'En blogg om hur man går upp tidigt och tränar haxx för att bli den bästa'),
(4, 'nelson', '123', 'user.png', 'nelson är en katt'),
(5, 'f0rest', '$2y$10$c.mhADCG0nF9V/cjw0RmTe6520pfd9h9qgmzPpvsCaCozq1EQZ4ee', 'teslagosubw.jpg', 'En katt som är svårflörtad'),
(6, 'pirat', '$2y$10$peCRtTmySYowOgbtMZht1.Ke9n9Lq5S08MgK0U.x1OcmCYjvZolHW', 'user.png', 'dsadadasda'),
(7, 'alex', '$2y$10$vmjPqQr7AtnmHzzj1QzIBeAdQ/9QQ1H1/kReNfMayWzZv5OHKyCAi', 'insäne_laugh.jpg', 'Någonting om katter och öl och annat smått och gott'),
(8, 'Frida', '$2y$10$njlZdq5Z1S/FLBKrKiZ7W.qpWLgSUnp31OQj/PejUd5CJTXkMzvbq', 'Screenshot_9.jpg', 'katten nelson'),
(9, 'Harald', '$2y$10$LXg1gS.yC/LkR5B6jJHaxOzB24A8Izw.uvcQtMBr2BZ.fxW4jkLAa', 'vinkelpåRacket.jpg', 'Den handlar om nelson när han var en liten kattunge och han var bara odyddi'),
(10, 'kalle123', '$2y$10$XeicnVeC2QZe3C93LqKch.F9Iikb9yeFfYVcRL3xHXcjdSLJcdggC', 'teslagosubw.jpg', 'hejhejhejhejhejhejhejhejhejhejhejhejhejhej'),
(27, 'HaldoR', '$2y$10$2y8hK67tbqJezLGIAMXTmux.f9HkEkhNDjGI2lsbl2DKexR9K8jEO', '', 'Programmering'),
(36, 'roger2', '$2y$10$zpgs3HWPQHKgWZckdckJcueopYRXO/HabIf1Fr9zWe97Sz/HqrbWC', 'anon_user.jpg', 'dasdadsadadada'),
(37, 'roger', '$2y$10$dShZgxDRIQZFcCFpEu2Co.DlBzVMLusdQyySgBKky8kSRtkpTBxZe', 'anon_user.jpg', 'sdasdasdasdasda'),
(38, 'kalle555', '$2y$10$6w5FZlVd/aMgtovEf.x..u0qOieHPlii/6VIj52SvhEl.y0RuiCou', '1', 'sadadasdada'),
(48, 'anna', '$2y$10$tVeiinU2zi5KOINkn.FwxOSOaO2QBYAxnW9O4l/4naJh4JMxd5pRi', '', '123'),
(49, 'ann1', '$2y$10$.FvGSUnVgBQkdYPF2xW5Eucb36NOn7eJNnwm8hnsZ37qAzBMxjHOW', 'Burning stepps route.jpg', '123123'),
(50, 'ann2', '$2y$10$9vKvqm/zizZxXoWq8RLOKeF6uu7KRlKYSxQ2JP0wDm5JsYug9QfDC', 'anon_user.jpg', '12313131'),
(51, '123131', '$2y$10$/3aBalV4GJq7WO.UYn8IpOGDcc7skMC8YRKzTAmvjLgCV/oIgKg3i', '', '3213131'),
(52, 'gfdgd', '$2y$10$dGzdsZkTsbzoHpvffvzsYOf55t6uiUVuS3KseJCtnqZhxV5Afr7Au', '', 'gfdgd'),
(53, 'hgfhgfhf', '$2y$10$tnVsBiQRAfUYHf7vDuHUs.2i6MOCfjIlPY7tanH/RPWKGyNzUBVQG', 'anon_user.jpg', 'hgfhfhfg'),
(54, 'kjhkjhkhj', '$2y$10$jNk7/tD7LgwbLhDtEqrrN.yq321EDRP.8zxe.MvTI98vfjy4vGrfS', '', 'khjkhjkjh'),
(55, 'iyuiyuiyu', '$2y$10$vTjq.ByudZRMarVeX7kNdu2YtMTmb3uQLooVrF4LvuBR7WxPACtUi', 'anon_user.jpg', 'iuyiyuiuy'),
(56, 'fdsfdsfs', '$2y$10$/MQrGVcI/d8ludMmx7wVFuhvNnzwC4uPi.JHf4aAXwCfo89IKGBEa', 'anon_user.jpg', 'fsdfsfsd'),
(57, 'nelchon', '$2y$10$euvJa6zxJnGOuJ8lkbb/wukcAlAKKDCONTsWM4UVG4HvRl48yZ7/.', 'ui.jpg', 'katter'),
(58, 'forest', '$2y$10$jIds14EPMzoIJKVPm72hvubt38Z/NHmV.L7Lwjx6otWIlRaXMiSRu', 'davve konfa.jpg', 'nelson'),
(59, 'nelson12', '$2y$10$7QDH6Gy4OkbAdmUy8cvoVeIRKr8ncFa0HLNLTyYBmyYqbbooj6dve', 'Screenshot_11.jpg', 'hej'),
(60, 'gfdggfdgdgd', '$2y$10$ECVdutq/oWgBLE3kmiFFou0smX6N4WUA91azjYDp8A7m5FW/CIrtG', 'anon_user.jpg', 'gfdgdgd'),
(61, 'berra', '$2y$10$oyZsvvMmmA0BS6p3OuAGr.6K6f.j17cakr3r1IzaE5qYkaerze.na', 'anon_user.jpg', '123'),
(62, 'knark', '$2y$10$omNMt4FcuMUclAedHTeEY.T8/KDJwSAIAmTsZGjQQM0H5x8w55sl2', 'anon_user.jpg', 'knark och sånt'),
(63, 'fridaelvelin', '$2y$10$YWaOK7XVIc/5EqvKzLax4eRvNKDT2OrTNPpYE4dXSd0YdvTyvVgDa', 'Screenshot_7.jpg', 'katter'),
(64, 'irna', '$2y$10$QA8fOj4z2TcbzHDe/3VtMufVm4cygj.HzbvZKp/Wrr47PnERxIHFS', 'anon_user.jpg', 'Pizza och mat'),
(65, 'johnny', '$2y$10$eKnR9iQKoSRN39gMr04BpumsPtGW7/mexxf3pU2KI5URHzBlL822i', 'anon_user.jpg', '123'),
(101, 'björn', '$2y$10$EQMwgzPieOMIuiuP/Wad1Olo58.POPgDIgobqedQDss5plrII8mY.', 'anon_user.jpg', '123'),
(102, 'linus', '$2y$10$KfUDdfnEWyVW8o/qvK5ZrOPAcNWzU73f35pXdKBGufP0C/LKJuGBu', 'anon_user.jpg', 'Friluftsliv och diverse annat');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`image_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Index för tabell `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_user_id` (`post_user_id`);

--
-- Index för tabell `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Image`
--
ALTER TABLE `Image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT för tabell `Post`
--
ALTER TABLE `Post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT för tabell `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `Image`
--
ALTER TABLE `Image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
