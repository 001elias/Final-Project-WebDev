-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3304
-- Generation Time: Nov 06, 2023 at 05:11 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fsd10_yankee`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorId` int(11) NOT NULL,
  `authorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorId`, `authorName`) VALUES
(127, 'Alastair Hamilton'),
(271, 'Amanda Root'),
(310, 'Anderson Cooper'),
(513, 'Anthony Rizcallah Ferris'),
(563, 'Artemis Cooper'),
(612, 'Augustine of Hippo'),
(702, 'Bartholomew Gill'),
(806, 'Bill Johnston'),
(831, 'Birgit Brandau'),
(1370, 'Christopher Fowler'),
(1432, 'Claudia Bishop'),
(1486, 'Constance Ash'),
(1489, 'Cook\'s Illustrated Magazine'),
(1760, 'David Fishman'),
(1901, 'Deane B. Judd'),
(1963, 'Dennis L. Kasper'),
(1991, 'Diana Cooper'),
(1998, 'Diana Pavlac Glyer'),
(2004, 'Diane Dawson Hearn'),
(2006, 'Diane Dillon'),
(2032, 'Diskin Clay'),
(2136, 'Doug McClelland'),
(2201, 'E.F. Watling'),
(2228, 'Eddie Campbell'),
(2347, 'Eli Geffen'),
(2601, 'Evelyn Waugh'),
(2663, 'Frances Liardet'),
(2686, 'Francis Steegmuller'),
(2932, 'George J. Firmage'),
(3188, 'Hanshan'),
(3520, 'Ivan Brunetti'),
(3533, 'J. Daniel Hays'),
(3870, 'Janna Levin'),
(4456, 'John von Neumann'),
(5568, 'Margaret Johnson'),
(5709, 'Mark LeVine'),
(6571, 'Overeaters Anonymous'),
(6700, 'Paul Anthony Cartledge'),
(6718, 'Paul Dinello'),
(6907, 'Peter Salm'),
(6990, 'Phillips Bradley'),
(7092, 'Raeleen D\'Agostino Mautner'),
(7200, 'RenÃ©e Graef'),
(7606, 'Robin Gillespie'),
(7770, 'Russell Davis'),
(8223, 'Stephen Kinzer'),
(8429, 'Sven Regener'),
(8441, 'Sylvia Engdahl'),
(8626, 'Thornton W. Burgess'),
(9163, 'Yosef A.A. Ben-Jochannan');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookId` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` text,
  `catId` int(11) NOT NULL,
  `stockUnit` int(11) NOT NULL,
  `unitPrice` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookId`, `isbn`, `title`, `image`, `description`, `catId`, `stockUnit`, `unitPrice`) VALUES
(1, '8987059752', 'The World\'s First Love: Mary  Mother of God', 'https://m.media-amazon.com/images/I/619PwBsW9PL.jpg', '', 12, 1, 3.35),
(4, '34406054602', 'What Life Was Like in the Jewel in the Crown: British India  AD 1600-1905', 'https://i.imgur.com/KcqM0eJ.jpg', '', 13, 69, 13.02),
(5, '49086007763', 'Cliffs Notes on Aristophanes\' Lysistrata  The Birds  The Clouds  The Frogs', 'https://m.media-amazon.com/images/I/71NRMJ3AGML._AC_UF1000,1000_QL80_.gif', '', 17, 46, 20.87),
(6, '73999140774', 'Life Is a Dream and Other Spanish Classics (Eric Bentley\'s Dramatic Repertoire) - Volume II', 'https://m.media-amazon.com/images/I/61yuUaI5MmL._AC_UF1000,1000_QL80_.jpg', '', 21, 27, 7.07),
(7, '73999254907', 'William Goldman: Four Screenplays', 'https://m.media-amazon.com/images/I/61lKIik-C1L._AC_UF894,1000_QL80_.jpg', '', 15, 45, 19.83),
(8, '73999768442', 'The Season: A Candid Look at Broadway', 'https://m.media-amazon.com/images/I/71nCp-P4FpL._AC_UF1000,1000_QL80_.jpg', '', 3, 65, 15.23),
(12, '635517047547', 'Plants Bite Back! (DK Readers)', 'https://m.media-amazon.com/images/I/81+8bl71EaL._AC_UF350,350_QL50_.jpg', '', 5, 49, 15.35),
(13, '645241001173', 'The Book of Awakening: Having the Life You Want by Being Present to the Life You Have', 'https://m.media-amazon.com/images/I/818igfZwq2L._AC_UF1000,1000_QL80_.jpg', '', 10, 64, 9.43),
(16, '710430023622', 'The Mystery in the Rocky Mountains', 'https://m.media-amazon.com/images/I/71n5AlcyIxL._AC_UF894,1000_QL80_.jpg', '', 19, 47, 17.77),
(17, '710430023639', 'The Mystery on the Mighty Mississippi', 'https://m.media-amazon.com/images/I/716ln5nRFBL._AC_UF1000,1000_QL80_.jpg', '', 23, 72, 18.34),
(20, '752073003227', 'Manhunt Official Strategy Guide', 'https://m.media-amazon.com/images/I/3149ZYQF2QL._AC_UF894,1000_QL80_.jpg', '', 22, 35, 13.66),
(25, '798499100096', 'Healing Therapies for Overcoming Insomnia', 'https://pictures.abebooks.com/isbn/9781565891746-us.jpg', '', 20, 45, 6.55),
(29, '9780002317856', 'Sleeping Murder (Miss Marple  #13)', 'https://upload.wikimedia.org/wikipedia/en/3/36/Sleeping_Murder_First_Edition_Cover_1976.jpg', '', 2, 38, 1.70),
(35, '9780006353287', 'Agatha Christie: An Autobiography', 'https://m.media-amazon.com/images/I/71Aigxj4I2L._AC_UF1000,1000_QL80_.jpg', '', 9, 67, 18.28),
(45, '9780006496922', 'Glamorous Powers (Starbridge  #2)', 'https://m.media-amazon.com/images/I/61w59qiepML.jpg', '', 8, 2, 9.96),
(51, '9780006514640', 'The Wise Woman', 'https://www.philippagregory.com/storage/book-covers/dKK59fsJFXKncXSge3hzgJEKA6DC7NWUoUJKoT16.png', '', 11, 58, 19.68),
(52, '9780006514855', 'Girls\' Night In', 'https://cdn2.penguin.com.au/covers/original/9781760140342.jpg', '', 18, 67, 11.81),
(61, '9780007104840', 'The One Minute Minute Sales Person', 'https://m.media-amazon.com/images/I/51W4AG2XCHL._AC_UF1000,1000_QL80_.jpg', '', 1, 91, 12.22),
(73, '9780007136582', 'The Lord of the Rings (The Lord of the Rings  #1-3)', 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1566425108l/33.jpg', '', 16, 18, 12.23),
(91, '9780007169979', 'Ten Apples Up On Top!', 'https://m.media-amazon.com/images/I/61WwERMuT0L._AC_UF1000,1000_QL80_.jpg', '', 6, 11, 9.82),
(94, '9780007173136', 'I Wish That I Had Duck Feet', 'https://m.media-amazon.com/images/I/81lM5igretL._AC_UF1000,1000_QL80_.jpg', '', 7, 36, 3.98),
(139, '9780060004507', 'An Old-Fashioned Thanksgiving', 'https://m.media-amazon.com/images/I/91If6JaGPhL._AC_UF1000,1000_QL80_.jpg', '', 13, 79, 19.92),
(173, '9780060175641', 'Identity', 'https://www.publishersweekly.com/cover/9780060175641', '', 12, 54, 17.81),
(381, '9780060749910', 'The Known World', 'https://m.media-amazon.com/images/I/512geBx6rpL._AC_UF1000,1000_QL80_.jpg', '', 3, 6, 12.23),
(583, '9780060957902', 'Tales of H.P. Lovecraft', 'https://m.media-amazon.com/images/I/71M3JsysioL._AC_UF894,1000_QL80_.jpg', '', 5, 31, 16.31),
(1133, '9780140364545', 'Tom\'s Midnight Garden', 'https://m.media-amazon.com/images/I/71U0ZVx43ZL._AC_UF1000,1000_QL80_.jpg', '', 8, 63, 18.69),
(1600, '9780143039655', 'Malgudi Days', 'https://upload.wikimedia.org/wikipedia/en/e/ea/DVD_Cover_of_Malgudi_Days.jpeg', '', 9, 30, 19.95),
(2496, '9780316284950', 'White Oleander', 'https://m.media-amazon.com/images/I/91RrwJYYGDL._AC_UF1000,1000_QL80_.jpg', '', 1, 66, 6.87),
(3201, '9780375753732', 'Sons and Lovers', 'https://m.media-amazon.com/images/I/51uTSc1pi5L.jpg', '', 21, 2, 1.61),
(3284, '9780375839566', 'Are We There Yet?', 'https://m.media-amazon.com/images/I/81CjMtaReWS._AC_UF1000,1000_QL80_.jpg', '', 3, 94, 18.50),
(3732, '9780394800271', 'Snow', 'https://m.media-amazon.com/images/I/81ncEys3jfL._AC_UF1000,1000_QL80_.jpg', '', 5, 37, 2.08),
(3953, '9780425199930', 'Break In (Kit Fielding  #1)', 'https://m.media-amazon.com/images/I/515BA5KMQ3L._AC_UF1000,1000_QL80_.jpg', '', 19, 3, 14.24),
(4182, '9780440229407', 'Shattered Mirror', 'https://upload.wikimedia.org/wikipedia/en/d/d3/ShatMirrr.jpg', '', 9, 13, 20.23),
(4190, '9780440237679', 'Teen Angst? Naaah...', 'https://m.media-amazon.com/images/I/81JwRM-TsaL._AC_UF1000,1000_QL80_.jpg', '', 17, 27, 10.81),
(4346, '9780446579674', 'Wild Fire (John Corey  #4)', 'https://cdn1.booknode.com/book_cover/57/john_corey_tome_4_operation_wildfire-56686-264-432.jpg', '', 4, 16, 7.36),
(4573, '9780451201157', 'Murder at the Vicarage (Miss Marple  #1)', 'https://dynamic.indigoimages.ca/v1/books/books/0063213923/1.jpg?width=810&maxHeight=810&quality=85', '', 14, 94, 9.13),
(5269, '9780553270259', 'Lincoln\'s Dreams', 'https://m.media-amazon.com/images/I/71eR1K1wApL._AC_UF894,1000_QL80_.jpg', '', 22, 81, 13.56),
(6593, '9780739342770', 'The Summons / The Brethren', 'https://images.randomhouse.com/cover/9780739342787', '', 1, 39, 4.37),
(7293, '9780767905107', 'Q: The Autobiography of Quincy Jones', 'https://m.media-amazon.com/images/I/51QPNEPfxsL._AC_UF1000,1000_QL80_.jpg', '', 8, 67, 11.25),
(7821, '9780809015566', 'The Weimar Republic: The Crisis of Classical Modernity', 'https://m.media-amazon.com/images/I/81uAI1qRcGL._AC_UF1000,1000_QL80_.jpg', '', 16, 61, 16.15),
(8113, '9780822219750', 'Enchanted April: Acting Edition', 'https://pictures.abebooks.com/isbn/9780822219750-us.jpg', '', 11, 77, 8.14),
(8278, '9780862731588', 'Dr No / Moonraker / Thunderball / From Russia with Love / On Her Majesty\'s Secret Service / Goldfinger', 'https://m.media-amazon.com/images/I/91WRW-W28NL._AC_UF1000,1000_QL80_.jpg', '', 5, 70, 10.49),
(8449, '9780886778576', 'Earth  Air  Fire  Water (Tales from the Eternal Archives  #2)', 'https://m.media-amazon.com/images/I/51G31Q984HL._AC_UF1000,1000_QL80_.jpg', '', 1, 52, 18.19),
(8677, '9781400016082', 'Fodor\'s Amsterdam (Fodor\'s Gold Guides)', 'https://m.media-amazon.com/images/I/91Y1B0xq1iL._AC_UF1000,1000_QL80_.jpg', '', 5, 97, 19.71),
(9659, '9781580051880', 'Homelands: Women’s Journeys Across Race  Place  and Time', 'https://m.media-amazon.com/images/I/51W8D7FHbaL._AC_UF1000,1000_QL80_.jpg', '', 8, 17, 14.73),
(9932, '9781591821540', 'Demon Diary  Volume 01', 'https://m.media-amazon.com/images/I/51NDo-iIltL._AC_UF1000,1000_QL80_.jpg', '', 14, 13, 14.83),
(10514, '9781904859208', 'On Anarchism', 'https://files.libcom.org/files/images/library/chomsky-on-anarchism.jpg', '', 2, 26, 19.06),
(10969, '9788433920867', 'Relatos de lo inesperado', 'https://2.bp.blogspot.com/-4B4PLOdkNts/UEoVFNN7cAI/AAAAAAAACL0/FrnvaijDEBY/s1600/dahl.jpg', '', 22, 51, 3.45);

-- --------------------------------------------------------

--
-- Table structure for table `bookorder`
--

CREATE TABLE `bookorder` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `AdminId` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `orderUnits` int(11) NOT NULL,
  `totalPrice` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `bookId` int(11) NOT NULL,
  `authorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`bookId`, `authorId`) VALUES
(1, 6718),
(3, 6571),
(3, 9163),
(4, 1963),
(5, 2601),
(6, 1370),
(7, 2136),
(8, 2228),
(12, 8626),
(13, 831),
(16, 1991),
(17, 4456),
(20, 806),
(25, 2686),
(29, 1901),
(35, 8223),
(45, 8429),
(51, 7770),
(52, 1489),
(61, 513),
(73, 2006),
(91, 3188),
(94, 2663),
(139, 3533),
(173, 7200),
(381, 7092),
(583, 5568),
(1133, 3520),
(1600, 3870),
(2496, 2032),
(3201, 127),
(3284, 2004),
(3732, 1432),
(3953, 612),
(4182, 1998),
(4190, 702),
(4346, 1486),
(4573, 2347),
(5269, 7606),
(6593, 5709),
(7293, 6990),
(7821, 2201),
(8113, 271),
(8278, 2932),
(8449, 563),
(8677, 6907),
(9659, 8441),
(9932, 1760),
(10514, 6700),
(10969, 310);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `bookId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`) VALUES
(1, 'Adventure stories'),
(2, 'Classics'),
(3, 'Crime'),
(4, 'Fairy tales'),
(5, 'Fantasy'),
(6, 'Historical fiction'),
(7, 'Horror'),
(8, 'Humour and satire'),
(9, 'Literary fiction'),
(10, 'Mystery'),
(11, 'Poetry'),
(12, 'Plays'),
(13, 'Romance'),
(14, 'Science fiction'),
(15, 'Short stories'),
(16, 'Thrillers'),
(17, 'War'),
(18, 'Women\'s fiction'),
(19, 'Young adult'),
(20, 'Autobiography and memoir'),
(21, 'Biography'),
(22, 'Essays'),
(23, 'Non-fiction novel');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `cusPassword` varchar(100) NOT NULL,
  `cusFirstName` varchar(100) NOT NULL,
  `cusLastName` varchar(100) NOT NULL,
  `cusPhone` int(11) DEFAULT NULL,
  `cusEmail` varchar(255) NOT NULL,
  `cusAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `cusPassword`, `cusFirstName`, `cusLastName`, `cusPhone`, `cusEmail`, `cusAddress`) VALUES
(1, '$2y$10$s4szLsxknuZ2xlRasMUioOoLk58sM4p2UuXxUyJQBpfDo9qms9Of2', 'Elias', 'Barrellet', NULL, 'fsd10@gmail.com', NULL),
(2, '$2y$10$aDaKlmt3/FvtuxTenn7aHOnSPeynQNoyH9zPY7GVOTCzZOFtsrLvW', 'Elias', 'Barr', NULL, 'ebarrellet@gmail.com', NULL),
(3, '$2y$10$aOetkes50gqn/xyUTvJl9e4G4DciTcUjv0E0xJvKZQ//UtVa8JOgS', 'Yeat', 'Twizzy', NULL, 'yobarrelle@gmail.com', NULL),
(4, '$2y$10$Z4k0sWQF.JZhBON54GdMQOrMcyB0Gf.xT3Af2cFSFYrLOl1QfIjKG', 'elias', 'bob', NULL, 'ivvyleague@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderId` int(11) NOT NULL,
  `bookid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `selected_books`
--

CREATE TABLE `selected_books` (
  `bookId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `selected_books`
--

INSERT INTO `selected_books` (`bookId`) VALUES
(61),
(29),
(8),
(3),
(12),
(91),
(94),
(45),
(35),
(13),
(51),
(1),
(4),
(2),
(7),
(73),
(5),
(52),
(16),
(25),
(6),
(20),
(17),
(4190),
(5269),
(1600),
(10969),
(8278),
(2496),
(10514),
(8113),
(3953),
(173),
(9932),
(1133),
(381),
(8449),
(7821),
(139),
(3732),
(4346),
(583),
(9659),
(3201),
(4182),
(7293),
(4573),
(3284),
(8677),
(6593);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `adminPass` varchar(100) NOT NULL,
  `adminEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adminId`, `adminName`, `adminPass`, `adminEmail`) VALUES
(1, 'Admin', '$2y$10$fIDBelqqmhNPlD9uduDncOB68tG.1SJwJKm5mWlGINnSCB3713Lu2', 'admin@yankee.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorId`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookId`),
  ADD KEY `book_cat_fk` (`catId`);

--
-- Indexes for table `bookorder`
--
ALTER TABLE `bookorder`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `order_customer_fk` (`customerId`),
  ADD KEY `order_admin_fk` (`AdminId`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`authorId`,`bookId`),
  ADD KEY `book_fk` (`bookId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
