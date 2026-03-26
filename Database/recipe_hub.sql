-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 أكتوبر 2024 الساعة 21:23
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_hub`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'trookish', '1234');

-- --------------------------------------------------------

--
-- بنية الجدول `admin_logins`
--

CREATE TABLE `admin_logins` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admin_logins`
--

INSERT INTO `admin_logins` (`id`, `admin_id`, `login_time`) VALUES
(1, 1, '2024-10-12 10:42:54'),
(2, 1, '2024-10-12 10:44:29'),
(3, 1, '2024-10-12 10:45:34'),
(4, 1, '2024-10-12 10:53:23'),
(5, 1, '2024-10-12 10:54:19'),
(6, 1, '2024-10-12 10:58:26'),
(7, 1, '2024-10-12 10:59:36'),
(8, 1, '2024-10-12 11:01:47'),
(9, 1, '2024-10-12 11:08:58'),
(10, 1, '2024-10-12 11:10:27'),
(11, 1, '2024-10-12 11:10:54'),
(12, 1, '2024-10-12 11:33:38'),
(13, 1, '2024-10-12 11:35:35'),
(14, 1, '2024-10-12 18:40:53'),
(15, 1, '2024-10-12 18:41:56');

-- --------------------------------------------------------

--
-- بنية الجدول `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `recipe_id`) VALUES
(9, 1, 5),
(10, 1, 3);

-- --------------------------------------------------------

--
-- بنية الجدول `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `ingredients`, `instructions`, `image`, `category`, `rating`) VALUES
(1, 'Spaghetti Carbonara', 'Classic Italian pasta...', 'Spaghetti, Tomato Sauce, Garlic, Olive Oil, Salt, Parmesan Cheese', '1. Boil spaghetti until al dente. 2. Prepare sauce with garlic and tomatoes in olive oil. 3. Combine spaghetti with sauce and garnish with Parmesan.', 'Images/spaghetti.jpg', 'Main Course', 4.5),
(2, 'Caesar Salad', 'Fresh salad with romaine...', 'Romaine Lettuce, Croutons, Caesar Dressing, Parmesan Cheese', '1. Chop lettuce. 2. Add croutons and Parmesan. 3. Toss with Caesar dressing.', 'Images/caesar.jpg', 'Appetizer', 4.2),
(3, 'Chicken Alfredo', 'A creamy pasta dish with chicken and Alfredo sauce.', 'Fettuccine, Chicken Breast, Heavy Cream, Parmesan Cheese, Garlic', '1. Cook fettuccine until tender. 2. Grill chicken and slice. 3. Prepare sauce with cream, garlic, and Parmesan. 4. Combine with pasta and top with chicken.', 'Images/chicken_alfredo.jpg', 'Main Course', 4.8),
(4, 'Tacos', 'Mexican tacos with beef, lettuce, cheese, and salsa.', 'Taco Shells, Ground Beef, Lettuce, Cheese, Tomato, Taco Seasoning', '1. Cook beef with taco seasoning. 2. Assemble tacos with lettuce, cheese, and tomato.', 'Images/tacos.jpg', 'Main Course', 5.0),
(5, 'Margherita Pizza', 'Classic pizza topped with tomatoes, mozzarella, and basil.', 'Pizza Dough, Tomato Sauce, Mozzarella Cheese, Basil, Olive Oil', '1. Spread tomato sauce on dough. 2. Add mozzarella and basil. 3. Bake at 220°C until crust is golden and cheese melts.', 'Images/margherita_pizza.jpg', 'Appetizer', 3.3),
(6, 'Apple Pie', 'Traditional apple pie with a flaky crust and cinnamon.', 'Apples, Flour, Sugar, Butter, Cinnamon, Nutmeg, Pie Crust', '1. Slice apples and mix with sugar and spices. 2. Place in pie crust and add top layer. 3. Bake at 180°C for 45 minutes or until golden.', 'Images/apple_pie.jpg', 'Dessert', 4.1),
(7, 'Chocolate Cake', 'Rich chocolate cake topped with chocolate ganache.', 'Flour, Cocoa Powder, Sugar, Butter, Eggs, Baking Powder, Chocolate Ganache', '1. Mix dry ingredients. 2. Add wet ingredients and bake at 175°C. 3. Let cool and top with chocolate ganache.', 'Images/chocolate_cake.jpg', 'Dessert', 4.7),
(9, 'Grilled Cheese Sandwich', 'Golden grilled sandwich with melted cheese.', 'Bread, Butter, Cheddar Cheese', '1. Butter one side of each bread slice. 2. Place cheese between slices. 3. Grill until bread is golden and cheese melts.', 'Images/grilled_cheese.jpg', 'Snack', 4.3),
(10, 'Beef Stew', 'Hearty beef stew with carrots, potatoes, and onions.', 'Beef, Potatoes, Carrots, Onions, Beef Broth, Garlic, Salt, Pepper', '1. Sear beef until browned. 2. Add vegetables and broth. 3. Simmer until beef is tender and vegetables are cooked.', 'Images/beef_stew.jpg', 'Main Course', 4.4),
(11, 'Pancakes', 'Fluffy pancakes topped with syrup and butter.', 'Flour, Milk, Eggs, Sugar, Baking Powder, Butter, Syrup', '1. Mix dry ingredients. 2. Add milk and eggs. 3. Cook on griddle until bubbles form. 4. Serve with butter and syrup.', 'Images/pancakes.jpg', 'Breakfast', 4.2),
(12, 'Smoothie Bowl', 'Healthy smoothie bowl with fresh berries and granola.', 'Yogurt, Mixed Berries, Banana, Granola, Honey', '1. Blend yogurt and berries for the base. 2. Top with banana slices, granola, and a drizzle of honey.', 'Images/smoothie_bowl.jpg', 'Breakfast', 4.5),
(20, 'Burger', 'asddasasd', 'sdaasd', 'asd', 'Images/Burger.jpg', NULL, 1.0);

-- --------------------------------------------------------

--
-- بنية الجدول `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `reviews`
--

INSERT INTO `reviews` (`id`, `recipe_id`, `user_name`, `rating`, `comment`, `created_at`) VALUES
(1, 5, 'turki', 5.0, 'its really amazing!', '2024-10-12 09:25:50'),
(2, 5, 'mohammed', 3.0, 'it was meh', '2024-10-12 09:27:31'),
(3, 5, 'annonymus', 1.0, 'pizza hacked >:)', '2024-10-12 09:31:27'),
(4, 5, 'turki', 5.0, 'test', '2024-10-12 09:33:55'),
(5, 5, 'mike', 4.6, 'nice', '2024-10-12 09:34:33'),
(6, 5, 'hello', 1.0, 'bad', '2024-10-12 09:37:30'),
(7, 5, 'testing2', 4.0, 'wow', '2024-10-12 09:38:43'),
(8, 12, 'turki', 5.0, 'Loved it &lt;3', '2024-10-12 09:41:29'),
(9, 12, 'nice', 5.0, 'nice &lt;3\r\n', '2024-10-12 09:41:46'),
(10, 4, 'its amazing', 5.0, 'someone unknown', '2024-10-12 09:43:56'),
(11, 12, 'bad reviewer', 1.0, 'i like to review at bad aka 1', '2024-10-12 09:45:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_logins`
--
ALTER TABLE `admin_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_logins`
--
ALTER TABLE `admin_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `admin_logins`
--
ALTER TABLE `admin_logins`
  ADD CONSTRAINT `admin_logins_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- قيود الجداول `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- قيود الجداول `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
