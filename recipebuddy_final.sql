-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 02:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipebuddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `IngredientID` int(11) NOT NULL,
  `Ingredient` varchar(50) NOT NULL,
  `Quantity` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`IngredientID`, `Ingredient`, `Quantity`) VALUES
(1, 'Pizza dough', 1.00),
(2, 'Pizza sauce', 1.00),
(3, 'Shredded mozzarella cheese', 3.00),
(4, 'Grated parmesan cheese', 1.00),
(5, 'Dried oregano', 1.50),
(6, 'Dried Basil', 2.50),
(7, 'Olive oil', 1.00),
(8, 'Flour', 1.00),
(9, 'Baking Powder', 0.50),
(10, 'Sugar', 0.20),
(11, 'Milk', 0.80),
(21, 'maybe something', 1.00),
(22, 'anything else', 2.00),
(27, 'werwer', 1.00),
(28, 'werwer', 1.00),
(29, 'rwerwrwr', 1.00),
(30, 'dfgsdfgsdfgg', 4.00),
(31, 'Pizza dough', 1.00),
(32, 'Pizza sauce', 1.00),
(33, 'Shredded mozzarella cheese', 3.00),
(34, 'Grated parmesan cheese', 1.00),
(35, 'Dried oregano', 1.50),
(36, 'Dried Basil', 2.50),
(37, 'Pizza dough', 1.00),
(38, 'Pizza sauce', 1.00),
(39, 'Shredded mozzarella cheese', 3.00),
(40, 'Grated parmesan cheese', 1.00),
(41, 'Dried oregano', 1.50),
(42, 'Dried Basil', 2.50),
(43, 'Olive Oil', 1.20),
(44, 'Pizza dough', 1.00),
(45, 'Pizza sauce', 1.00),
(46, 'Shredded mozzarella cheese', 3.00),
(47, 'Grated parmesan cheese', 1.00),
(48, 'Dried oregano', 1.50),
(49, 'Dried Basil', 2.50),
(50, 'Olive Oil', 1.20),
(51, 'asdsfasdff', 1.20),
(52, 'asdffasdf', 1.00),
(53, 'werwerw', 1.20),
(54, 'werwer', 1.00),
(55, 'Pizza dough', 1.00),
(56, 'Pizza sauce', 1.00),
(57, 'Shredded mozzarella cheese', 3.00),
(58, 'Grated parmesan cheese', 1.00),
(59, 'Dried oregano', 1.50),
(60, 'Dried Basil', 2.50),
(61, 'Olive Oil', 1.20);

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `InstructionID` int(11) NOT NULL,
  `Instruction` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`InstructionID`, `Instruction`) VALUES
(1, 'Preheat your oven to 475°F (245°C). If you have a pizza stone, place it in the oven while it preheats.'),
(2, 'Roll out your pizza dough on a floured surface to your desired thickness. If you’re using store-bought '),
(3, 'Once your dough is rolled out, transfer it to a pizza peel'),
(4, 'Spread the pizza sauce evenly over the dough, leaving a small border around the edges for the crust.'),
(5, 'Add the grated Parmesan cheese on top of the mozzarella.'),
(6, ' If you’re using a pizza stone, carefully transfer the pizza from the peel to the preheated stone in the '),
(7, 'Bake the pizza for 12-15 minutes, or until the cheese is melted and bubbly and the crust is golden '),
(8, 'Sift the dry ingredients together.'),
(9, 'Make a well, then add the wet ingredients. Stir to combine.'),
(10, 'Scoop the batter onto a hot griddle or pan.'),
(11, 'Cook for two to three minutes, then flip.'),
(12, 'Continue cooking until brown on both sides. '),
(22, 'just cook it '),
(23, 'eat it'),
(29, 'werwer'),
(30, 'werwerwerw'),
(31, 'qwerqwer'),
(32, 'werwerwerw'),
(33, 'rwerwerwerwer'),
(34, 'Preheat your oven to 475°F (245°C). If you have a pizza stone, place it in the oven while it preheats.'),
(35, 'Roll out your pizza dough on a floured surface to your desired thickness. If you’re using store-bought '),
(36, 'Once your dough is rolled out, transfer it to a pizza peel'),
(37, 'Spread the pizza sauce evenly over the dough, leaving a small border around the edges for the crust.'),
(38, 'Add the grated Parmesan cheese on top of the mozzarella.'),
(39, ' If you’re using a pizza stone, carefully transfer the pizza from the peel to the preheated stone in the '),
(40, 'Preheat your oven to 475°F (245°C). If you have a pizza stone, place it in the oven while it preheats.'),
(41, 'Roll out your pizza dough on a floured surface to your desired thickness. If you’re using store-bought '),
(42, 'Once your dough is rolled out, transfer it to a pizza peel'),
(43, 'Spread the pizza sauce evenly over the dough, leaving a small border around the edges for the crust.'),
(44, 'Add the grated Parmesan cheese on top of the mozzarella.'),
(45, ' If you’re using a pizza stone, carefully transfer the pizza from the peel to the preheated stone in the '),
(46, 'Preheat your oven to 475°F (245°C). If you have a pizza stone, place it in the oven while it preheats.'),
(47, 'Roll out your pizza dough on a floured surface to your desired thickness. If you’re using store-bought '),
(48, 'Once your dough is rolled out, transfer it to a pizza peel'),
(49, 'Spread the pizza sauce evenly over the dough, leaving a small border around the edges for the crust.'),
(50, 'Add the grated Parmesan cheese on top of the mozzarella.'),
(51, ' If you’re using a pizza stone, carefully transfer the pizza from the peel to the preheated stone in the '),
(52, 'wewerw'),
(53, 'werwerwer'),
(54, 'asdfasdf'),
(55, 'Preheat your oven to 475°F (245°C). If you have a pizza stone, place it in the oven while it preheats.'),
(56, 'Roll out your pizza dough on a floured surface to your desired thickness. If you’re using store-bought '),
(57, 'Once your dough is rolled out, transfer it to a pizza peel'),
(58, 'Spread the pizza sauce evenly over the dough, leaving a small border around the edges for the crust.'),
(59, 'Add the grated Parmesan cheese on top of the mozzarella.'),
(60, ' If you’re using a pizza stone, carefully transfer the pizza from the peel to the preheated stone in the ');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `RecipeID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(400) DEFAULT NULL,
  `RecipeImagePath` varchar(500) NOT NULL,
  `RecipeImageName` varchar(500) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`RecipeID`, `Title`, `Description`, `RecipeImagePath`, `RecipeImageName`, `DateCreated`) VALUES
(1, 'Cheesy Pizza', 'Delicious pizza that melts in your mouth\r\n                                                                                                                                            ', 'assets/img/recpie-3.jpg', 'recpie-3.jpg', '2024-12-05 13:19:22'),
(2, 'Pancakes', 'Fluffy pancakes', 'assets\\img\\recpie-2.jpg', 'recpie-2.jpg', '2024-12-05 14:37:16'),
(3, 'Healthy Salad', 'nice salad', 'assets/img/recpie-1.jpg', 'recpie-1.jpg', '2024-12-06 13:01:23'),
(4, 'Cake', 'nice cake', 'assets/img/recpie-5.jpg', 'recpie-5.jpg', '2024-12-06 13:08:45'),
(5, 'Salad Bowl', 'asdf', 'assets/img/recpie-1.jpg', 'recpie-1.jpg', '2024-12-06 13:13:34'),
(6, 'fdfsdfs', 'fsdfsdf', 'assets/img/57989f2a2e186e38bf93429aa395120c.jpg', '57989f2a2e186e38bf93429aa395120c.jpg', '2024-12-06 13:15:41'),
(8, 'New recipe', 'i dont know', 'assets/img/57989f2a2e186e38bf93429aa395120c.jpg', '57989f2a2e186e38bf93429aa395120c.jpg', '2024-12-06 13:20:55'),
(13, 'asdfasdf', 'sdaerqdf', 'assets/img/57989f2a2e186e38bf93429aa395120c.jpg', '57989f2a2e186e38bf93429aa395120c.jpg', '2024-12-06 19:22:02');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `Recipe_Ingredients_ID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `IngredientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`Recipe_Ingredients_ID`, `RecipeID`, `IngredientID`) VALUES
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(21, 8, 21),
(22, 8, 22),
(51, 13, 51),
(52, 13, 52),
(55, 1, 55),
(56, 1, 56),
(57, 1, 57),
(58, 1, 58),
(59, 1, 59),
(60, 1, 60),
(61, 1, 61);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_instructions`
--

CREATE TABLE `recipe_instructions` (
  `Recipe_Instructions_ID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `InstructionsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_instructions`
--

INSERT INTO `recipe_instructions` (`Recipe_Instructions_ID`, `RecipeID`, `InstructionsID`) VALUES
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(43, 13, 52),
(44, 13, 53),
(46, 1, 55),
(47, 1, 56),
(48, 1, 57),
(49, 1, 58),
(50, 1, 59),
(51, 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_users`
--

CREATE TABLE `recipe_users` (
  `Recipe_Users_ID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_users`
--

INSERT INTO `recipe_users` (`Recipe_Users_ID`, `RecipeID`, `UserID`) VALUES
(3, 1, 3),
(4, 2, 4),
(9, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserImagePath` varchar(500) NOT NULL,
  `UserImageName` varchar(500) NOT NULL,
  `Contact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `UserImagePath`, `UserImageName`, `Contact`) VALUES
(3, 'admin', 'admin', 'assets\\img\\face-1.jpg', 'face-1.jpg', NULL),
(4, 'sankalp', 'admin', 'assets\\img\\face-4.jpg', 'face-4.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`IngredientID`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`InstructionID`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`RecipeID`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`Recipe_Ingredients_ID`),
  ADD KEY `RecipeID` (`RecipeID`),
  ADD KEY `IngredientID` (`IngredientID`);

--
-- Indexes for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  ADD PRIMARY KEY (`Recipe_Instructions_ID`),
  ADD KEY `RecipeID` (`RecipeID`),
  ADD KEY `InstructionsID` (`InstructionsID`);

--
-- Indexes for table `recipe_users`
--
ALTER TABLE `recipe_users`
  ADD PRIMARY KEY (`Recipe_Users_ID`),
  ADD KEY `RecipeID` (`RecipeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `IngredientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `InstructionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `RecipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `Recipe_Ingredients_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  MODIFY `Recipe_Instructions_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `recipe_users`
--
ALTER TABLE `recipe_users`
  MODIFY `Recipe_Users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `Recipe_Ingredients_Ingredients` FOREIGN KEY (`IngredientID`) REFERENCES `ingredients` (`IngredientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Ingredients_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  ADD CONSTRAINT `Recipe_Instructions_Instructions` FOREIGN KEY (`InstructionsID`) REFERENCES `instructions` (`InstructionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Instructions_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_users`
--
ALTER TABLE `recipe_users`
  ADD CONSTRAINT `Recipe_Users_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Users_Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
