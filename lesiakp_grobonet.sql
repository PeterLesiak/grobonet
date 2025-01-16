-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2024 at 01:59 PM
-- Wersja serwera: 8.0.40-0ubuntu0.24.04.1
-- Wersja PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lesiakp_grobonet`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Cemeteries`
--

CREATE TABLE `Cemeteries` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Cemeteries`
--

INSERT INTO `Cemeteries` (`id`, `name`, `city`, `street`) VALUES
(1, 'Cmentarz Centralny', 'Warszawa', 'Aleje Jerozolimskie'),
(2, 'Cmentarz Rakowicki', 'Kraków', 'Rakowicka'),
(3, 'Cmentarz Łostowicki', 'Gdańsk', 'Kartuska'),
(4, 'Cmentarz Grabiszyński', 'Wrocław', 'Grabiszyńska'),
(5, 'Cmentarz Bródnowski', 'Warszawa', 'Św. Wincentego'),
(6, 'Cmentarz Górczyński', 'Poznań', 'Ściegiennego'),
(7, 'Cmentarz Północny', 'Warszawa', 'Wólczyńska'),
(8, 'Cmentarz Junikowski', 'Poznań', 'Grunwaldzka'),
(9, 'Cmentarz Komunalny', 'Łódź', 'Zgierska'),
(10, 'Cmentarz Świętej Rodziny', 'Katowice', 'Sienkiewicza'),
(11, 'Cmentarz Parafialny', 'Lublin', 'Lipowa'),
(12, 'Cmentarz Garnizonowy', 'Gdańsk', 'Generała Bora-Komorowskiego'),
(13, 'Cmentarz Podgórski', 'Kraków', 'Wapienna'),
(14, 'Cmentarz Zabłocie', 'Rzeszów', 'Zabłocie'),
(15, 'Cmentarz Świętej Trójcy', 'Opole', 'Trójcy Świętej'),
(16, 'Cmentarz Komunalny', 'Szczecin', 'Ku Słońcu'),
(17, 'Cmentarz Parafialny', 'Bydgoszcz', 'Cmentarna'),
(18, 'Cmentarz Wojskowy', 'Warszawa', 'Powązkowska'),
(19, 'Cmentarz Katedralny', 'Tarnów', 'Tuchowska'),
(20, 'Cmentarz Komunalny', 'Białystok', 'Wysockiego');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int NOT NULL,
  `PESEL` char(11) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `dateOfDeath` date NOT NULL,
  `cemetery` int NOT NULL,
  `image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `PESEL`, `password`, `name`, `surname`, `dateOfBirth`, `dateOfDeath`, `cemetery`, `image`) VALUES
(1, '55069009731', 'rxfsuz234', 'Adolf', 'Hitler', '1939-09-01', '1945-09-02', 18, '1.jpg'),
(2, '82977267990', 'bcdefg', 'Jan', 'Kowalski', '1976-05-11', '2013-12-31', 2, '2.jpg'),
(3, '51318336325', '9f91c9a4e9720e7e9e6ead393d', 'Dombromir', 'Browar', '1934-03-24', '1998-08-12', 1, NULL),
(4, '65080830142', 'c8b0600e3a2c229b0a707a7d3d', 'Katarzyna', 'Jarzyna', '1969-06-09', '1996-09-06', 10, '4.jpg'),
(5, '20871490445', '691d1dfb8c28f158bcf1996dc5', 'Maksymilian', 'Wiercipała', '1978-06-07', '2021-07-06', 9, NULL),
(6, '12536981620', '7b5fec312532158bd1a2f4eba3', 'Julia', 'Kamińska', '1950-12-03', '2020-06-15', 12, NULL),
(7, '39428447409', '7c79fe39395e47843e9effe804', 'Barbara', 'Szymańska', '1957-08-09', '2021-01-17', 15, NULL),
(8, '15777448858', '56d9c7aa02cb44784111236adc', 'Jan', 'Kowalski', '1950-03-12', '2020-06-15', 1, '8.jpg'),
(9, '97627988455', '2296d8a1dd8286b062d3d689a3', 'Maria', 'Nowak', '1945-07-25', '2018-02-10', 1, '9.jpg'),
(10, '84248117063', '4f989e1db20ebe4a70f48b3deb', 'Piotr', 'Wiśniewski', '1962-11-08', '2015-08-22', 2, '10.jpg'),
(11, '03893836591', '4814276bd8f9eea7806c7e33d4', 'Anna', 'Wójcik', '1970-01-03', '2021-12-17', 2, '11.jpg'),
(12, '36807926405', '887497bd3d0278856ea5fe37cd', 'Tomasz', 'Zieliński', '1938-09-15', '2000-04-05', 3, '12.jpg'),
(13, '39500684327', '8e0e1306ab220405dd6dfdb907', 'Katarzyna', 'Kamińska', '1985-02-20', '2020-11-30', 3, '13.jpg'),
(14, '66240893086', '90e13a7d2adfd59d3967d6aae5', 'Andrzej', 'Lewandowski', '1949-05-14', '2010-01-01', 4, '14.jpg'),
(15, '32753129892', '7c6d34027996a8b1bd22ca8485', 'Barbara', 'Szymańska', '1957-08-30', '2019-07-12', 4, '15.jpg'),
(16, '31746437895', '2a2b5d01c926e43c5d0e79ff07', 'Michał', 'Dąbrowski', '1980-06-11', '2022-03-18', 5, '16.jpg'),
(17, '55380684375', '6cf9bb321a6e0dd10e2f12e71a', 'Zofia', 'Majewska', '1925-04-19', '1995-09-25', 5, '17.jpg'),
(18, '73301086643', '071bc2be22e8fb15c51ba58e7b', 'Adam', 'Kaczmarek', '1960-12-10', '2017-07-14', 6, '18.jpg'),
(19, '68808613129', '7b3dac19ec3d9a21902cde3199', 'Ewa', 'Michalska', '1952-03-24', '2013-09-01', 6, '19.jpg'),
(20, '25559870829', '06074b3edd34c6d5676d7890e5', 'Jacek', 'Jankowski', '1978-05-09', '2021-11-20', 7, '20.jpg'),
(21, '86957271664', '4ef0d7bf82d0ebc66d93b0a0c4', 'Grażyna', 'Zawadzka', '1947-08-22', '2016-06-10', 7, '21.jpg'),
(22, '66465380570', '137318af582697275263894a17', 'Paweł', 'Borkowski', '1987-01-14', '2022-05-12', 8, '22.jpg'),
(23, '69384270505', '5362e080afa077693e084ffeab', 'Irena', 'Sobczak', '1939-07-03', '2010-02-27', 8, '23.jpg'),
(24, '56176524847', '7439b77e40c5304c12389b6822', 'Rafał', 'Król', '1954-10-17', '2014-08-30', 9, '24.jpg'),
(25, '20746844001', 'd96e1d93e8bb70f5db4a8ac90c', 'Elżbieta', 'Górska', '1968-06-29', '2019-03-21', 9, '25.jpg'),
(26, '42981509066', '6e577ada0b249a811b3cd92e8a', 'Krzysztof', 'Lis', '1975-09-12', '2020-12-05', 10, '26.jpg'),
(27, '78356097059', '7369e71e8f84f28ad114c298c8', 'Monika', 'Adamczyk', '1983-04-23', '2021-08-18', 10, '27.jpg'),
(28, '07987179800', '2ca09839ef54994d4ee5c79fba', 'Wojciech', 'Pawlak', '1943-01-16', '2009-10-08', 11, '28.jpg'),
(29, '23359923272', 'a16266de398f67e3b6214aed14', 'Dorota', 'Szulc', '1959-11-02', '2017-01-22', 11, '29.png'),
(30, '53140167010', '8569ab766d0b7b77e82066f722', 'Marek', 'Cieślak', '1964-07-07', '2018-05-19', 12, '30.jpg'),
(31, '20495592263', 'c543573c1919451713c5af47a9', 'Agnieszka', 'Makowska', '1973-12-20', '2020-04-14', 12, '31.jpg'),
(32, '04863031585', '03b79911b25b060820da781e9e', 'Tadeusz', 'Chmielewski', '1928-03-11', '1999-02-03', 13, '32.jpg'),
(33, '35661695558', 'e1ba806c40cff7206592e4297f', 'Urszula', 'Gajewska', '1940-08-05', '2012-06-25', 13, '33.jpg'),
(34, '21633951665', '153bb85363770d5323ddfad259', 'Zbigniew', 'Janik', '1965-02-28', '2019-09-09', 14, '34.jpg'),
(35, '67850512981', '26c87ffa3f33bc08ef9b6213f6', 'Helena', 'Ostrowska', '1950-10-10', '2016-07-30', 14, '35.jpg'),
(36, '43924503348', '7a0b7100361c43afbf61a1b76f', 'Jerzy', 'Kot', '1970-05-18', '2021-02-19', 15, '36.jpg'),
(37, '81996577216', '8c457d9b8e7245fef92b4f2a1d', 'Joanna', 'Urban', '1988-09-26', '2023-01-11', 15, '37.jpg'),
(38, '73764746704', '5e0e286197961d1433cba81d43', 'Ryszard', 'Piotrowski', '1956-04-07', '2015-08-08', 16, '38.jpg'),
(39, '87272311362', 'dbd7d62e0132ae7248190f5c80', 'Danuta', 'Wilk', '1961-06-13', '2020-10-23', 16, '39.jpg'),
(40, '90136907799', 'd170137c8a0f0860f97c6dc598', 'Grzegorz', 'Kozłowski', '1977-03-15', '2022-07-29', 17, '40.jpg'),
(41, '54600376966', '21efd317775606cd56da508a97', 'Lucyna', 'Wasilewska', '1981-02-11', '2021-03-06', 17, '41.jpg'),
(42, '34333806516', '717704a27e19ca735f24151739', 'Kazimierz', 'Rutkowski', '1948-09-01', '2013-11-12', 18, '42.jpg'),
(43, '72494503085', '53a2dc437e43cbc659199c9b40', 'Alicja', 'Michalak', '1953-12-19', '2018-02-01', 18, '43.jpg'),
(44, '72547630660', '4df91d04d3c9d64b8b3029e0a1', 'Sebastian', 'Baran', '1967-07-23', '2020-11-15', 19, '44.jpg'),
(45, '46459029378', '09a20293c01b9065127c9290aa', 'Renata', 'Czarnecka', '1974-08-16', '2021-06-28', 19, '45.jpg'),
(46, '57936482278', 'fe5f38d8804c66e98fe11e9b7d', 'Janusz', 'Głowacki', '1936-10-30', '1995-04-20', 20, '46.jpg'),
(47, '80524948873', 'ddd5dc8be3dfacefb85d04de18', 'Aneta', 'Cichocka', '1946-05-02', '2010-09-04', 20, '47.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Cemeteries`
--
ALTER TABLE `Cemeteries`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cemeteries`
--
ALTER TABLE `Cemeteries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
