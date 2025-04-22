-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 07:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IngredientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `UserID`, `IngredientID`) VALUES
(48, 3, 93),
(52, 4, 99),
(53, 3, 117),
(54, 3, 118);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `CommentText` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `CommentText`) VALUES
(1, 'Aewsome Recipe'),
(2, 'It would be great to add parsley to it'),
(3, 'aewsome'),
(11, 'ttttttt'),
(12, 'wetwerw'),
(13, 'ewrwer'),
(14, 'werwe'),
(15, 'werwer');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `IngredientID` int(11) NOT NULL,
  `Ingredient` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`IngredientID`, `Ingredient`) VALUES
(1, 'Pizza dough'),
(2, 'Pizza sauce'),
(3, 'Shredded mozzarella cheese'),
(4, 'Grated parmesan cheese'),
(5, 'Dried oregano'),
(6, 'Dried Basil'),
(7, 'Olive oil'),
(8, 'Flour'),
(9, 'Baking Powder'),
(10, 'Sugar'),
(11, 'Milk'),
(21, 'maybe something'),
(22, 'anything else'),
(27, 'werwer'),
(28, 'werwer'),
(29, 'rwerwrwr'),
(30, 'dfgsdfgsdfgg'),
(31, 'Pizza dough'),
(32, 'Pizza sauce'),
(33, 'Shredded mozzarella cheese'),
(34, 'Grated parmesan cheese'),
(35, 'Dried oregano'),
(36, 'Dried Basil'),
(37, 'Pizza dough'),
(38, 'Pizza sauce'),
(39, 'Shredded mozzarella cheese'),
(40, 'Grated parmesan cheese'),
(41, 'Dried oregano'),
(42, 'Dried Basil'),
(43, 'Olive Oil'),
(44, 'Pizza dough'),
(45, 'Pizza sauce'),
(46, 'Shredded mozzarella cheese'),
(47, 'Grated parmesan cheese'),
(48, 'Dried oregano'),
(49, 'Dried Basil'),
(50, 'Olive Oil'),
(51, 'asdsfasdff'),
(52, 'asdffasdf'),
(53, 'werwerw'),
(54, 'werwer'),
(55, 'Pizza dough'),
(56, 'Pizza sauce'),
(57, 'Shredded mozzarella cheese'),
(58, 'Grated parmesan cheese'),
(59, 'Dried oregano'),
(60, 'Dried Basil'),
(61, 'Olive Oil'),
(62, 'cotton'),
(63, 'color'),
(64, 'blue color'),
(65, 'cotton'),
(66, 'Pizza dough'),
(67, 'tomato sauce'),
(68, 'cheese'),
(69, 'olive oil'),
(70, 'spinach'),
(71, 'qqqq'),
(72, 'wwwww'),
(73, 'rrrr'),
(74, 'tttt'),
(75, 'qqqq'),
(76, 'aaaa'),
(77, 'qq'),
(78, 'zz'),
(79, 'qq'),
(80, 'as'),
(81, 'lime'),
(82, 'Rice'),
(83, 'Romaine'),
(84, 'Black Beans'),
(85, 'Bread'),
(86, 'Cheese'),
(87, 'Tomatoes'),
(88, 'Butter'),
(89, 'Wheat Flour'),
(90, 'Egg'),
(91, 'Sugar'),
(92, 'Baking Powder'),
(93, 'wheat dough'),
(94, 'Water'),
(95, 'tomato sauce'),
(96, 'milk'),
(97, 'yeast'),
(98, 'potatoes'),
(99, 'oil'),
(100, 'cumin seeds'),
(101, 'turmeric powder'),
(102, 'red chilli powder'),
(103, 'Tomatoes'),
(104, 'cucumber'),
(105, 'Salt'),
(106, 'Black Pepper'),
(107, 'Lemon Juice'),
(108, 'Bread'),
(109, 'Butter'),
(110, 'Garlic'),
(111, 'Salt'),
(112, 'Rice'),
(113, 'Yougurt'),
(114, 'Salt'),
(115, 'Mustart Seeds'),
(116, 'Oil'),
(117, 'Yougurt'),
(118, 'Cucumber'),
(119, 'Salt'),
(120, 'Cumin Powder');

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
(60, ' If you’re using a pizza stone, carefully transfer the pizza from the peel to the preheated stone in the '),
(61, 'make tshirt'),
(62, 'safsdf'),
(63, 'asdfasdf'),
(64, 'make the dough'),
(65, 'round the dough'),
(66, 'apply tomato base'),
(67, 'apply olive oil'),
(68, 'add cheese'),
(69, 'add spinach'),
(70, 'asdfa'),
(71, 'asdfasdff'),
(72, 'asdsf'),
(73, 'asdfa'),
(74, 'wrw'),
(75, 'cook rice'),
(76, 'cook beans'),
(77, 'Food ready'),
(78, 'spread butter on bread'),
(79, 'put tomatoes on one side of bread'),
(80, 'roast on both sides of bread'),
(81, 'Mix dough with eggs'),
(82, 'add baking powder'),
(83, 'bake'),
(84, 'mix everything'),
(85, 'iuwoieurowiueroiwer'),
(86, 'boil the milk'),
(87, 'Heat oil in a pan and add cumin seeds'),
(88, 'add cubed potatoes, turmeric, chili powder, and salt in the pan'),
(89, 'stir well and cook on low heat until potatoes are crispy'),
(90, 'server hot with roti or rice'),
(91, 'Mix all ingredients in a bowl'),
(92, 'Toss well and server fresh'),
(93, 'Heat butter in a pan and add minced garlic'),
(94, 'Toast bread slices until golden'),
(95, 'Sprinkle salt and server warm'),
(96, 'Mix cooked rice with yougurt and Salt'),
(97, 'Heat oil, add mustard seeds, and pour over rice'),
(98, 'Mix well and server chilled or at room temperature'),
(99, 'Mix all ingredients in a bowl'),
(100, 'Server chilled as a side dish');

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
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `isPublic` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`RecipeID`, `Title`, `Description`, `RecipeImagePath`, `RecipeImageName`, `DateCreated`, `isPublic`) VALUES
(3, 'Healthy Salad', 'nice salad', 'assets/img/recpie-1.jpg', 'recpie-1.jpg', '2024-12-06 13:01:23', 0),
(4, 'Cake', 'nice cake', 'assets/img/recpie-5.jpg', 'recpie-5.jpg', '2024-12-06 13:08:45', 0),
(5, 'Salad Bowl', 'asdf', 'assets/img/recpie-1.jpg', 'recpie-1.jpg', '2024-12-06 13:13:34', 0),
(6, 'fdfsdfs', 'fsdfsdf', 'assets/img/57989f2a2e186e38bf93429aa395120c.jpg', '57989f2a2e186e38bf93429aa395120c.jpg', '2024-12-06 13:15:41', 0),
(8, 'New recipe', 'i dont know', 'assets/img/57989f2a2e186e38bf93429aa395120c.jpg', '57989f2a2e186e38bf93429aa395120c.jpg', '2024-12-06 13:20:55', 0),
(23, 'Salad Bowl', 'anything', 'assets/img/brooke-lark-jUPOXXRNdcA-unsplash.jpg', 'brooke-lark-jUPOXXRNdcA-unsplash.jpg', '2025-02-17 20:52:28', 0),
(24, 'Sandwhich', 'Cheesy delicious sandwhich', 'assets/img/recpie-6.jpg', 'recpie-6.jpg', '2025-02-20 15:28:20', 0),
(25, 'Cake', 'Delicious Cake', 'assets/img/recpie-5.jpg', 'recpie-5.jpg', '2025-02-20 15:58:22', 0),
(26, 'Bread', 'asdf', 'assets/img/kate-remmer-RZn4_FzNUCY-unsplash.jpg', 'kate-remmer-RZn4_FzNUCY-unsplash.jpg', '2025-03-10 12:43:01', 1),
(27, 'Italian Pizza', 'delicious', 'assets/img/photo-1529312266912-b33cfce2eefd.jpg', 'photo-1529312266912-b33cfce2eefd.jpg', '2025-03-11 12:24:42', 1),
(28, 'Italian Cheese', 'made from pure milk', 'assets/img/photo-1683314573422-649a3c6ad784.jpg', 'photo-1683314573422-649a3c6ad784.jpg', '2025-03-11 12:27:00', 1),
(29, 'Aloo Fry', 'Tasty fried potato with spices', 'assets/img/1. aloo fry.jpeg', '1. aloo fry.jpeg', '2025-03-25 15:19:13', 1),
(30, 'Tomato Cucumber Salad', 'Healthy and tasty salad', 'assets/img/2. tomato salad.jpeg', '2. tomato salad.jpeg', '2025-03-25 15:22:00', 1),
(31, 'Garlic Toast', 'Cripsy garlicy bread', 'assets/img/3. garlic toast.jpeg', '3. garlic toast.jpeg', '2025-03-25 15:23:45', 1),
(32, 'Yogurt Rice', 'Sweet and sour rice with yougurt', 'assets/img/4. Yogurt Rice.jpeg', '4. Yogurt Rice.jpeg', '2025-03-25 15:25:47', 1),
(33, 'Cucumber Raita', 'Tasty delicious raita', 'assets/img/14. cucmber Raita.jpeg', '14. cucmber Raita.jpeg', '2025-03-25 15:35:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_comment`
--

CREATE TABLE `recipe_comment` (
  `Recipe_Comment_ID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_comment`
--

INSERT INTO `recipe_comment` (`Recipe_Comment_ID`, `RecipeID`, `CommentID`, `UserID`) VALUES
(7, 31, 15, 4);

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
(21, 8, 21),
(22, 8, 22),
(81, 23, 81),
(82, 23, 82),
(83, 23, 83),
(84, 23, 84),
(85, 24, 85),
(86, 24, 86),
(87, 24, 87),
(88, 24, 88),
(89, 25, 89),
(90, 25, 90),
(91, 25, 91),
(92, 25, 92),
(93, 26, 93),
(94, 26, 94),
(95, 27, 95),
(96, 28, 96),
(97, 28, 97),
(98, 29, 98),
(99, 29, 99),
(100, 29, 100),
(101, 29, 101),
(102, 29, 102),
(103, 30, 103),
(104, 30, 104),
(105, 30, 105),
(106, 30, 106),
(107, 30, 107),
(108, 31, 108),
(109, 31, 109),
(110, 31, 110),
(111, 31, 111),
(112, 32, 112),
(113, 32, 113),
(114, 32, 114),
(115, 32, 115),
(116, 32, 116),
(117, 33, 117),
(118, 33, 118),
(119, 33, 119),
(120, 33, 120);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients_units`
--

CREATE TABLE `recipe_ingredients_units` (
  `Recipe_Ingredient_Unit_ID` int(11) NOT NULL,
  `IngredientID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_ingredients_units`
--

INSERT INTO `recipe_ingredients_units` (`Recipe_Ingredient_Unit_ID`, `IngredientID`, `UnitID`, `RecipeID`, `Quantity`) VALUES
(10, 81, 4, 23, 10),
(11, 82, 4, 23, 400),
(12, 83, 4, 23, 200),
(13, 84, 4, 23, 300),
(14, 85, 4, 24, 500),
(15, 86, 4, 24, 400),
(16, 87, 4, 24, 200),
(17, 88, 4, 24, 100),
(18, 89, 4, 25, 400),
(19, 90, 4, 25, 400),
(20, 91, 4, 25, 100),
(21, 92, 4, 25, 50),
(22, 93, 4, 26, 500),
(23, 94, 3, 26, 200),
(24, 95, 4, 27, 200),
(25, 96, 3, 28, 1000),
(26, 97, 4, 28, 50),
(27, 98, 4, 29, 500),
(28, 99, 3, 29, 10),
(29, 100, 4, 29, 5),
(30, 101, 4, 29, 5),
(31, 102, 4, 29, 5),
(32, 103, 4, 30, 600),
(33, 104, 4, 30, 300),
(34, 105, 4, 30, 3),
(35, 106, 4, 30, 3),
(36, 107, 3, 30, 5),
(37, 108, 4, 31, 800),
(38, 109, 4, 31, 100),
(39, 110, 4, 31, 50),
(40, 111, 4, 31, 5),
(41, 112, 4, 32, 400),
(42, 113, 4, 32, 200),
(43, 114, 4, 32, 5),
(44, 115, 4, 32, 5),
(45, 116, 3, 32, 10),
(46, 117, 4, 33, 500),
(47, 118, 4, 33, 200),
(48, 119, 4, 33, 5),
(49, 120, 4, 33, 10);

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
(66, 23, 75),
(67, 23, 76),
(68, 23, 77),
(69, 24, 78),
(70, 24, 79),
(71, 24, 80),
(72, 25, 81),
(73, 25, 82),
(74, 25, 83),
(75, 26, 84),
(76, 27, 85),
(77, 28, 86),
(78, 29, 87),
(79, 29, 88),
(80, 29, 89),
(81, 29, 90),
(82, 30, 91),
(83, 30, 92),
(84, 31, 93),
(85, 31, 94),
(86, 31, 95),
(87, 32, 96),
(88, 32, 97),
(89, 32, 98),
(90, 33, 99),
(91, 33, 100);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_likes`
--

CREATE TABLE `recipe_likes` (
  `Recipe_Likes_ID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_likes`
--

INSERT INTO `recipe_likes` (`Recipe_Likes_ID`, `RecipeID`, `UserID`) VALUES
(132, 27, 4),
(124, 31, 3),
(131, 31, 4);

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
(19, 23, 4),
(20, 24, 3),
(21, 25, 3),
(22, 26, 3),
(23, 27, 4),
(24, 28, 4),
(25, 29, 3),
(26, 30, 3),
(27, 31, 3),
(28, 32, 3),
(29, 33, 4);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `UnitID` int(11) NOT NULL,
  `Unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`UnitID`, `Unit`) VALUES
(2, 'lb'),
(3, 'ml'),
(4, 'gm'),
(5, 'oz');

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `cart_ingredients` (`IngredientID`),
  ADD KEY `cart_user` (`UserID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`);

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
-- Indexes for table `recipe_comment`
--
ALTER TABLE `recipe_comment`
  ADD PRIMARY KEY (`Recipe_Comment_ID`),
  ADD KEY `Recipe_Comment_Recipe` (`RecipeID`),
  ADD KEY `Recipe_Comment_Comment` (`CommentID`),
  ADD KEY `Recipe_Comment_Users` (`UserID`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`Recipe_Ingredients_ID`),
  ADD KEY `RecipeID` (`RecipeID`),
  ADD KEY `IngredientID` (`IngredientID`);

--
-- Indexes for table `recipe_ingredients_units`
--
ALTER TABLE `recipe_ingredients_units`
  ADD PRIMARY KEY (`Recipe_Ingredient_Unit_ID`),
  ADD KEY `Recipe_Ingredients_Units_Recipe` (`RecipeID`),
  ADD KEY `Recipe_Ingredients_Units_Ingredients` (`IngredientID`),
  ADD KEY `Recipe_Ingredients_Units_Units` (`UnitID`);

--
-- Indexes for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  ADD PRIMARY KEY (`Recipe_Instructions_ID`),
  ADD KEY `RecipeID` (`RecipeID`),
  ADD KEY `InstructionsID` (`InstructionsID`);

--
-- Indexes for table `recipe_likes`
--
ALTER TABLE `recipe_likes`
  ADD PRIMARY KEY (`Recipe_Likes_ID`),
  ADD KEY `Recipe_Likes_User` (`UserID`),
  ADD KEY `RecipeID` (`RecipeID`,`UserID`) USING BTREE;

--
-- Indexes for table `recipe_users`
--
ALTER TABLE `recipe_users`
  ADD PRIMARY KEY (`Recipe_Users_ID`),
  ADD KEY `RecipeID` (`RecipeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`UnitID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `IngredientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `InstructionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `RecipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `recipe_comment`
--
ALTER TABLE `recipe_comment`
  MODIFY `Recipe_Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `Recipe_Ingredients_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `recipe_ingredients_units`
--
ALTER TABLE `recipe_ingredients_units`
  MODIFY `Recipe_Ingredient_Unit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  MODIFY `Recipe_Instructions_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `recipe_likes`
--
ALTER TABLE `recipe_likes`
  MODIFY `Recipe_Likes_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `recipe_users`
--
ALTER TABLE `recipe_users`
  MODIFY `Recipe_Users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ingredients` FOREIGN KEY (`IngredientID`) REFERENCES `ingredients` (`IngredientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_user` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_comment`
--
ALTER TABLE `recipe_comment`
  ADD CONSTRAINT `Recipe_Comment_Comment` FOREIGN KEY (`CommentID`) REFERENCES `comment` (`CommentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Comment_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Comment_Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `Recipe_Ingredients_Ingredients` FOREIGN KEY (`IngredientID`) REFERENCES `ingredients` (`IngredientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Ingredients_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_ingredients_units`
--
ALTER TABLE `recipe_ingredients_units`
  ADD CONSTRAINT `Recipe_Ingredients_Units_Ingredients` FOREIGN KEY (`IngredientID`) REFERENCES `ingredients` (`IngredientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Ingredients_Units_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Ingredients_Units_Units` FOREIGN KEY (`UnitID`) REFERENCES `units` (`UnitID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  ADD CONSTRAINT `Recipe_Instructions_Instructions` FOREIGN KEY (`InstructionsID`) REFERENCES `instructions` (`InstructionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Instructions_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_likes`
--
ALTER TABLE `recipe_likes`
  ADD CONSTRAINT `Recipe_Likes_Recipe` FOREIGN KEY (`RecipeID`) REFERENCES `recipe` (`RecipeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_Likes_User` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
