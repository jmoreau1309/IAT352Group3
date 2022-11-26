-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 05:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iat352_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `artpieces`
--

CREATE TABLE `artpieces` (
  `art_id` int(11) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `yearRangeStart` int(4) NOT NULL,
  `yearRangeEnd` int(4) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `genre` varchar(32) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `filename` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artpieces`
--

INSERT INTO `artpieces` (`art_id`, `artist`, `yearRangeStart`, `yearRangeEnd`, `title`, `genre`, `description`, `filename`) VALUES
(1, 'Arthur Dove', 1911, 1912, 'Based on Leaf Forms and Spaces, pastel on unidentified support.', 'abstract', 'Now lost.', 'abstract_1.jpg'),
(2, 'Francis Picabia', 1912, NULL, 'Tarentelle', 'abstract', 'Oil on canvas, 73.6 x 92.1 cm, Museum of Modern Art, New York. Reproduced in Du \"Cubisme\".', 'abstract_2.jpg'),
(3, 'Wassily Kandinsky', 1912, NULL, 'Improvisation 27 (Garden of Love II)', 'abstract', 'Oil on canvas, 120.3 × 140.3 cm, The Metropolitan Museum of Art, New York. Exhibited at the 1913 Armory Show.\r\n', 'abstract_3.jpg'),
(4, 'Hilma of Klint', 1914, 1915, 'Svanen (The Swan), No. 17, Group 9, Series SUW', 'abstract', 'This abstract work was never exhibited during Klint\'s lifetime.', 'abstract_4.jpg'),
(5, 'Fernand Léger', 1919, NULL, 'The Railway Crossing', 'abstract', 'Oil on canvas, 53.8 × 64.8 cm, The Art Institute of Chicago.', 'abstract_5.jpg'),
(6, 'Pablo Picasso', 1913, 1914, 'Head (Tête)', 'abstract', 'Cut and pasted colored paper, gouache and charcoal on paperboard, 43.5 × 33 cm, Scottish National Gallery of Modern Art, Edinburgh.', 'abstract_6.jpg'),
(7, 'Theo van Doesburg', 1917, NULL, 'Composition VII (The Three Graces)', 'abstract', 'Neo-Plasticism.', 'abstract_7.jpg'),
(8, 'Piet Mondrian', 1939, 1942, 'Composition No. 10.', 'abstract', 'Oil on canvas painting. Responding to it, fellow De Stijl artist Theo van Doesburg suggested a link between non-representational works of art and ideals of peace and spirituality.', 'abstract_8.jpg'),
(9, 'Paul Klee', 1929, NULL, 'Fire In The Evening', 'abstract', NULL, 'abstract_9.jpg'),
(10, 'Barnett Newman', 1948, NULL, 'Onement 1', 'abstract', 'Museum of Modern Art, New York.', 'abstract_10.jpg'),
(11, 'František Kupka', 1912, NULL, 'Amorpha, Fugue en deux couleurs (Fugue in Two Colors)', 'abstract', 'Oil on canvas, 210 x 200 cm, Narodni Galerie, Prague. Published in Au Salon d\'Automne \"Les Indépendants\" 1912, Exhibited at the 1912 Salon d\'Automne, Paris.', 'abstract_11.jpg'),
(12, 'Albert Gleizes', 1910, 1912, 'Les Arbres (The Trees)', 'Abstract', 'Oil on canvas, 41 × 27 cm. Reproduced in Du \"Cubisme\", 1912.', 'abstract_12.jpg'),
(13, 'Roy Lichtenstein', 1963, NULL, 'Drowning Girl.', 'pop_art', 'On display at the Museum of Modern Art, New York.', 'popart_1.jpg'),
(14, 'Andy Warhol', 1964, NULL, 'Campbell\'s Tomato Juice Box', 'pop_art', 'Synthetic polymer paint and silkscreen ink on wood, 10 inches × 19 inches × 9½ inches (25.4 × 48.3 × 24.1 cm), Museum of Modern Art, New York City.\r\n', 'popart_2.jpg'),
(15, 'Charles Demuth', 1928, NULL, 'I Saw the Figure 5 in Gold', 'pop_art', 'Collection of the Metropolitan Museum of Art, New York City.', 'popart_3.jpg'),
(16, 'Dmitri Vrubel', 1990, NULL, 'My God, Help Me to Survive This Deadly Love', 'pop_art', NULL, 'popart_4.jpg'),
(17, 'Richard Hamilton', 1956, NULL, 'Just what is it that makes today\'s homes so different, so appealing?', 'pop_art', 'One of the earliest works to be considered \"pop art\".', 'popart_5.jpg'),
(18, 'Andy Warhol', 1962, NULL, 'Cheddar Cheese Canvas from Campbell\'s Soup Cans', 'pop_art', NULL, 'popart_6.jpg'),
(19, 'Eduardo Paolozzi', 1947, NULL, 'I was a Rich Man\'s Plaything', 'pop_art', 'Part of his Bunk! series, this is considered the initial bearer of \"pop art\" and the first to display the word \"pop\".', 'popart_7.jpg'),
(20, 'Franz Marc', 1913, NULL, 'The Fate of the Animals', 'modernism', 'Oil on canvas. The work was displayed at the exhibition of \"Entartete Kunst\" (\"degenerate art\") in Munich, Nazi Germany, 1937.\r\n', 'modernism_1.jpg'),
(21, 'Samuel Beckett', 1978, NULL, 'En Attendant Godot (Waiting for Godot)', 'modernism', 'Festival d\'Avignon, 1978', 'modernism_3.jpg'),
(22, 'Pablo Picasso', 1907, NULL, 'Les Demoiselles d\'Avignon', 'modernism', 'This proto-cubist work is considered a seminal influence on subsequent trends in modernist painting.\r\n', 'modernism_3.jpg'),
(23, 'Jackson Pollock', 1952, NULL, 'Blue Poles', 'modernism', 'National Gallery of Australia.', 'modernism_4.jpg'),
(24, 'Brice Marden', 1992, 1993, 'Vine', 'modernism', 'Oil on linen, 240 by 260 cm (8 by 8+1⁄2 ft), Museum of Modern Art, New York.', 'modernism_5.jpg'),
(25, 'Edward Johnston', 1916, NULL, 'London Underground Logo', '', 'This is the modern version (with minor modifications) of one that was first used in 1916.', 'modernism_6.jpg'),
(26, 'Henri Matisse', 1905, 1906, 'Le bonheur de vivre', 'modernism', 'Barnes Foundation, Merion, PA. An early Fauvist masterpiece.', 'modernism_7.jpg'),
(27, 'Pablo Picasso', 1910, NULL, 'Portrait of Daniel-Henry Kahnweiler', 'modernism', 'Art Institute of Chicago.', 'modernism_8.jpg'),
(28, 'Georges Seurat', 1884, NULL, 'Bathers at Asnières', 'pointillism', 'Oil on canvas, 201 × 301 cm, National Gallery, London.', 'pointillism_1.jpg'),
(29, 'Georges Seurat', 1884, 1886, 'A Sunday Afternoon on the Island of La Grande Jatte', 'pointillism', 'Oil on canvas, 207.6 x 308 cm, Art Institute of Chicago.', 'pointillism_2.jpg'),
(30, 'Théo van Rysselberghe', 1887, NULL, 'Sailboats and Estuary', 'pointillism', 'Oil on canvas, 50.2 x 61 cm, Musée d\'Orsay.', 'pointillism_3.jpg'),
(31, 'Camille Pissarro', 1888, NULL, 'La récolte des pommes à Éragny', 'pointillism', 'Oil on canvas, 61 x 74 cm, Dallas Museum of Art.', 'pointillism_4.jpg'),
(32, 'Jan Toorop', 1889, NULL, 'Bridge in London', 'pointillism', 'Kröller-Müller Museum.', 'pointillism_5.jpg'),
(33, 'Georges Seurat', 1889, 1890, 'Young Woman Powdering Herself', 'pointillism', 'Courtauld Gallery.', 'pointillism_6.jpg'),
(34, 'Georges Lemmen', 1891, 1892, 'The Beach at Heist', 'pointillism', 'Musée d\'Orsay Paris.', 'pointillism_7.jpg'),
(35, 'Théo van Rysselberghe', 1894, NULL, 'Portrait of Irma Sèthe', 'pointillism', NULL, 'pointillism_8.jpg'),
(36, 'Jean Metzinger', 1906, NULL, 'Femme au Chapeau (Woman with a Hat)', 'pointillism', 'Oil on canvas, 44.8 x 36.8 cm, Korban Art Foundation.', 'pointillism_9.jpg'),
(37, 'Hippolyte Petitjean', 1919, NULL, 'Femmes au bain', 'pointillism', 'Oil on canvas, 61.1 X 46 cm, private collection.', 'pointillism_10.jpg'),
(38, 'Robert Delaunay', 1906, NULL, 'Portrait de Metzinger', 'pointillism', 'Oil on canvas, 55 x 43 cm.', 'pointillism_11.jpg'),
(39, 'Franz Marc', 1914, NULL, 'Fighting Forms', 'expressionism', NULL, 'expressionism_1.jpg'),
(40, 'Alvar Cawén', 1922, NULL, 'Sokea soittoniekka (Blind Musician)', 'expressionism', NULL, 'expressionism_2.jpg'),
(41, 'Rolf Nesch', 1932, NULL, 'Elbe Bridge I', 'expressionism', NULL, 'expressionism_3.jpg'),
(42, 'El Greco', 1596, 1600, 'View of Toledo', 'expressionism', 'A Mannerist precursor of 20th-century expressionism.', 'expressionism_4.jpg'),
(43, 'Franz Marc', 1911, NULL, 'Die großen blauen Pferde (The Large Blue Horses)', 'expressionism', NULL, 'expressionism_5.jpg'),
(44, 'Wassily Kandinsky', 1903, NULL, 'The Blue Rider (Der Blaue Reiter)', 'expressionism', 'Oil on canvas, 52.1 x 54.6 cm, Private Collection, before Collection Emil Bührle, Zurich.', 'expressionism_6.jpg'),
(45, 'Franz Marc', 1914, NULL, 'Rehe im Walde (Deer in Woods)', 'expressionism', NULL, 'expressionism_7.jpg'),
(46, 'Ernst Ludwig Kirchner', 1915, NULL, 'Self-Portrait as a Soldier', 'expressionism', NULL, 'expressionism_8.jpg'),
(47, 'August Macke', 1913, NULL, 'Lady in a Green Jacket', 'expressionism', 'Oil on canvas, 44,5 cm × 43,5 cm (175 in × 171 in), Museum Ludwig, Cologne.', 'expressionism_9.jpg'),
(48, 'Edvard Munch', 1893, NULL, 'The Scream', 'expressionism', 'Oil, tempera and pastel on cardboard, 91 x 73 cm, National Gallery of Norway. Inspired 20th-century Expressionists.', 'expressionism_10.jpg'),
(49, 'Fasim', 2018, NULL, 'Guerrilla art', 'street_art', 'a humanist mural by Fasim in Alcoi, Valencia, Spain.', 'streetart_1.jpg'),
(50, 'Artur Bordalo (Bordalo II)', 2018, NULL, '\"Unicorn Made of Waste\"', 'street_art', 'Unicorn made of waste by Portuguese street artist Artur Bordalo (BordaloII) at NuArt Festival Aberdeen (2018).', 'streetart_2.jpg'),
(51, 'Os Gêmeos', 2011, NULL, '\"Work of Brazilian artists Os Gêmeos\"', 'streetart', 'In Lisbon, Portugal.', 'streetart_3.jpg'),
(52, 'STIK', 2014, NULL, 'Big Mother', 'street_art', 'A mother and child look forlornly from their condemned council building across the expanse of private luxury apartments being built around them.', 'streetart_4.jpg'),
(53, 'Nevercrew', 2017, NULL, 'Propagating Machine\r\n', 'street_art', '\"Propagating machine\" - Mural painting realized in Mannheim (Germany) for Stadt.Wand.Kunst, 2017.\r\n49°30\'22.5\"N 8°29\'28.6\"E', 'streetart_5.jpg'),
(54, 'Bambi (female street artist)', 2017, NULL, 'Lie Lie Land', 'street_art', 'In Islington, London.', 'streetart_6.jpg'),
(55, 'Jacopo de\' Barbari', 1495, 1500, 'Portrait of Luca Pacioli', 'renaissance', 'Portrait of Luca Pacioli, father of accounting, painted by Jacopo de\' Barbari, (Museo di Capodimonte). \r\n\r\nTempera on panel, 99 cm × 120 cm (39 in × 47 in), Capodimonte Museum, Naples.\r\n', 'renaissance_1.jpg'),
(56, 'Giulio Clovio', 1546, NULL, 'Adoration of the Magi and Solomon adored by the Queen of Sheba from the Farnese Hours', 'renaissance', '\r\n', 'renaissance_2.jpg'),
(57, 'Pieter Bruegel the Elder', 1562, NULL, 'The Triumph of Death', 'renaissance', 'Oil on panel, 117 cm × 162 cm. Museo del Prado, Madrid.', 'renaissance_3.jpg'),
(58, 'Grão Vasco', 1529, NULL, 'São Pedro Papa', 'renaissance', 'Oil on panel. Subject - Peter the Apostle.\r\n215 cm × 233.3 cm. Grão Vasco National Museum, Viseu', 'renaissance_4.jpg'),
(59, 'Giorgio Vasari', 1534, NULL, 'Portrait of Lorenzo the Magnificent', 'renaissance', 'Oil on wood. 90 cm × 72 cm (35 in × 28 in). Uffizi, Florence.', 'renaissance_5.jpg'),
(60, 'Sandro Botticelli', 1480, 1485, 'Portrait of a Young Woman (Botticelli, Frankfurt)', 'renaissance', 'Tempera on wood. 82 cm × 54 cm (32 in × 21 in). Städel Museum.', 'renaissance_6.jpg'),
(61, 'Albrecht Dürer', 1519, NULL, 'Portrait of Emperor Maximilian I', 'renaissance', 'Oil on linden wood. 74 cm × 62 cm (29 in × 24 in). Kunsthistorisches Museum, Vienna.', 'renaissance_7.jpg'),
(62, 'Raphael', 1509, 1511, 'The School of Athens', 'renaissance', 'Fresco. 500 cm × 770 cm (200 in × 300 in). Apostolic Palace, Vatican City.', 'renaissance_8.jpg'),
(63, 'René Magritte', 1929, NULL, 'The Treachery of Images', 'surrealism', 'Oil on canvas. 60.33 cm × 81.12 cm (23.75 in × 31.94 in). Los Angeles County Museum of Art.', 'surrealism_1.jpg'),
(64, 'André Masson', 1922, NULL, 'Pedestal Table in the Studio', 'surrealism', NULL, 'surrealism_2.jpg'),
(65, 'Max Ernst', 1937, NULL, 'L\'Ange du Foyer (The Angel of Hearth and Home)', 'surrealism', 'One of two versions. Oil on canvas, 112.5 x 144 cm., private collection.', 'surrealism_3.jpg'),
(66, 'Yves Tanguy', 1942, NULL, 'Indefinite Divisibility', 'surrealism', 'Albright Knox Art Gallery, Buffalo, New York.', 'surrealism_4.jpg'),
(67, 'André Masson', 1924, NULL, 'Automatic drawing', 'surrealism', 'Ink on paper, 23.5 × 20.6 cm. Museum of Modern Art, New York.', 'surrealism_5.jpg'),
(68, 'Max Ernst', 1921, NULL, 'The Elephant Celebes', 'surrealism', 'Oil on canvas. 125.4 cm × 107.9 cm (49.4 in × 42.5 in). Tate Modern, London.', 'surrealism_6.jpg'),
(69, 'Robert Delaunay', 1924, NULL, 'Illustration on cover of Yvan Goll\'s Surréalisme, Manifeste du surréalisme', 'surrealism', 'Volume 1, Number 1, October 1, 1924.', 'surrealism_7.jpg'),
(70, 'Alberto Giacometti', 1932, NULL, 'Woman with Her Throat Cut', 'surrealism', 'Cast 1949. Museum of Modern Art, New York City.\r\n', 'surrealism_8.jpg'),
(71, 'Annibale Carracci', 1597, NULL, 'The Triumph of Bacchus and Ariadne', 'baroque', 'Part of the ceiling fresco cycle The Loves of the Gods in the Farnese Gallery of the Palazzo Farnese in Rome.', 'baroque_1.jpg'),
(72, 'Claude Lorrain', 1648, NULL, 'Seaport with the Embarkation of the Queen of Sheba', 'baroque', 'Oil on canvas. 149.1 cm × 196.7 cm (58.7 in × 77.4 in). National Gallery, London.', 'baroque_2.jpg'),
(73, 'Caravaggio', 1599, 1600, 'The Calling of St Matthew', 'baroque', 'Oil on canvas. 322 cm × 340 cm (127 in × 130 in). San Luigi dei Francesi, Rome', 'baroque_3.jpg'),
(74, 'Rembrandt van Rijn', 1642, NULL, 'The Night Watch', 'baroque', 'Dutch Golden Age painting. 363 cm × 437 cm (142.9 in × 172.0 in). Amsterdam Museum on permanent loan to the Rijksmuseum, Amsterdam.', 'baroque_4.jpg'),
(75, 'Peter Paul Rubens', 1609, 1610, 'Rubens and Isabella Brandt, the Honeysuckle Bower', 'baroque', 'Oil on canvas; 1.78 x 1.37 m; Alte Pinakothek (Munich, Germany).', 'baroque_5.jpg'),
(76, 'Peter Paul Rubens', 1635, NULL, 'Venus and Adonis', 'baroque', NULL, 'baroque_6.jpg'),
(77, 'Giovanni Battista Gaulli', 1661, 1679, 'Triumph of the Name of Jesus', 'baroque', 'Ceiling Fresco. Il Gesù, Rome.', 'baroque_7.jpg'),
(78, 'Michaelina Wautier', 1650, NULL, 'Triumph of Bacchus (Wautier)', 'baroque', '270.5 cm (106.5 in) × 354 cm (139 in). Kunsthistorisches Museum.', 'baroque_8.jpg'),
(79, 'Maria van Oosterwijck', 1668, NULL, 'Vanitas - Still Life', 'baroque', 'Oil on canvas; 73 x 88.5 cm; Kunsthistorisches Museum.', 'baroque_9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blogposts`
--

CREATE TABLE `blogposts` (
  `blog_id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `contributor_id` int(11) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `artpieces`
--
ALTER TABLE `artpieces`
  ADD PRIMARY KEY (`art_id`);

--
-- Indexes for table `blogposts`
--
ALTER TABLE `blogposts`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `contributor` (`contributor_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artpieces`
--
ALTER TABLE `artpieces`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `blogposts`
--
ALTER TABLE `blogposts`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `blogposts`
--
ALTER TABLE `blogposts`
  ADD CONSTRAINT `contributor` FOREIGN KEY (`contributor_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blogposts` (`blog_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
