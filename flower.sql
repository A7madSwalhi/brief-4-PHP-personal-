-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 06:15 PM
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
-- Database: `flower`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `created_at`) VALUES
(1, 'Tulip', 'A diverse group of flowering plants known for their beautiful, colorful blooms', '2024-07-31 07:41:28'),
(2, 'Sunflower', 'Bright and sunny flowers known for their large, yellow blooms.', '2024-07-31 07:41:28'),
(3, 'Rose', 'Popular flowers known for their fragrant, multi-layered petals.', '2024-07-31 07:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 1, 1, 'zaid', '2024-08-01 08:46:51'),
(2, 2, 2, 'zaid', '2024-08-01 08:52:18'),
(3, 2, 2, 'hello', '2024-08-01 08:53:10'),
(4, 17, 2, 'iugolgouligoilkhn', '2024-08-01 09:09:39'),
(5, 17, 2, 'u8uj', '2024-08-01 09:13:04'),
(6, 17, 2, 'u8uj', '2024-08-01 09:18:13'),
(7, 17, 2, 'u8uj', '2024-08-01 09:19:42'),
(8, 1, 2, 'xfhfghfgh\r\n', '2024-08-01 09:27:19'),
(9, 1, 2, 'xfhfghfgh\r\n', '2024-08-01 09:32:10'),
(10, 1, 2, 'xfhfghfgh\r\n', '2024-08-01 09:32:22'),
(11, 1, 2, 'xfhfghfgh\r\n', '2024-08-01 09:33:59'),
(15, 10, 2, 'hello fgfhgjh', '2024-08-01 09:41:19'),
(19, 10, 2, 'hello', '2024-08-01 09:51:22'),
(20, 10, 2, 'hello', '2024-08-01 09:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `status`, `created_at`) VALUES
(1, 1, 8.00, 'completed', '2024-08-01 06:35:35'),
(2, 1, 28.00, 'pending', '2024-08-01 06:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 3, 1, 8.00),
(2, 2, 3, 2, 8.00),
(3, 2, 2, 1, 12.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `path` varchar(255) DEFAULT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `created_at`, `path`, `discount`) VALUES
(1, 1, 'Abelia', 'A flowering shrub with aromatic, trumpet-shaped flowers.', 10.00, 100, '2024-07-31 07:41:28', 'abelia.webp', 10),
(2, 1, 'Azalea', 'Flowering shrub with bright, colorful blooms.', 12.00, 80, '2024-07-31 07:41:28', 'azalea.webp', 0),
(3, 1, 'Alyssa', 'A small flower with vibrant colors.', 8.00, 150, '2024-07-31 07:41:28', 'alyssa.webp', 0),
(4, 1, 'Amaryllis', 'Large, trumpet-shaped flowers that bloom in various colors.', 15.00, 60, '2024-07-31 07:41:28', 'amaryllis.webp', 5),
(5, 1, 'Blossom', 'A general term for flowering plants with bright, cheerful flowers.', 9.00, 120, '2024-07-31 07:41:28', 'blossom.webp', 0),
(6, 1, 'Calla', 'Elegant flowers with a distinct shape, often used in bouquets.', 14.00, 70, '2024-07-31 07:41:28', 'calla.webp', 0),
(7, 2, 'Daisy', 'A simple and charming flower with white petals and a yellow center.', 7.00, 200, '2024-07-31 07:41:28', 'daisy.webp', 0),
(8, 2, 'Aster', 'Flower known for its vibrant colors and star-shaped blooms.', 11.00, 90, '2024-07-31 07:41:28', 'aster.webp', 0),
(9, 2, 'Dahlia', 'Flower with a large, bushy bloom in a variety of colors.', 13.00, 50, '2024-07-31 07:41:28', 'dahlia.webp', 7),
(10, 2, 'Camellia', 'Beautiful flowers with delicate, layered petals.', 16.00, 40, '2024-07-31 07:41:28', 'camellia.webp', 0),
(11, 2, 'Clover', 'Small, sweet-smelling flower often associated with luck.', 6.00, 250, '2024-07-31 07:41:28', 'clover.webp', 0),
(12, 2, 'Flora', 'General term for flowers, often used in arrangements.', 9.00, 180, '2024-07-31 07:41:28', 'flora.webp', 6),
(13, 3, 'Iris', 'Flower with intricate, delicate petals and rich colors.', 18.00, 30, '2024-07-31 07:41:28', 'iris.webp', 0),
(14, 3, 'Jasmine', 'Fragrant flower known for its sweet scent and white petals.', 14.00, 40, '2024-07-31 07:41:28', 'jasmine.webp', 0),
(15, 3, 'Poppy', 'Bright and bold flower with distinctive red petals.', 12.00, 60, '2024-07-31 07:41:28', 'poppy.webp', 0),
(16, 3, 'Lily', 'Elegant flower with a strong fragrance and large petals.', 20.00, 25, '2024-07-31 07:41:28', 'lily.webp', 0),
(17, 3, 'Marigold', 'Flower known for its vibrant orange and yellow colors.', 8.00, 100, '2024-07-31 07:41:28', 'marigold.webp', 0),
(18, 3, 'Lotus', 'Symbolic flower with large, serene blooms and a unique shape.', 22.00, 20, '2024-07-31 07:41:28', 'lotus.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(50) NOT NULL DEFAULT 'user',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`, `user_type`, `image`) VALUES
(1, 'zaid', 'zayd_qatar@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', '2024-07-31 11:34:07', 'user', 'amaryllis.webp'),
(3, 'zaidd', 'ssss@yahho.com', '$2y$10$mo6JqKScWVULO3EPFz8ysO7VJFJKUXPpIvizigExoFoPTHT43l3Oe', '2024-08-01 09:31:41', 'admin', NULL),
(4, 'ahmed', 'zaid.aqrabawi002@gmail.com', '$2y$10$sW1FmtU1Hi82qpo1pvYGW.Mgxf18aossAWoM9r5heki17UWlKoB4e', '2024-08-01 11:37:48', 'user', NULL),
(5, 'asa', 'abd_akrabawi@yahoo.com', '$2y$10$TNg41ubCweXoFwahCGInNOLuOQFcu2MIk9tK2.zLsOIPo8TSBFMAu', '2024-08-01 11:40:13', 'user', NULL),
(6, 'ahmad123', 'aalswalhe@yahoo.com', '$2y$10$UMrMFvvlX6WtF7TKaDH/n.ojfyuQs0BvOqBFeooOUaCsqH2TSJuXa', '2024-08-02 13:36:05', 'admin', NULL),
(7, 'asdasd2102', 'ahmad.mrx1032001@gmail.com', '$2y$10$JIlV/1ftdX...U5x/A6cWuyPsQ5Km/RvTIreEbpsoN38g4h7pQTL2', '2024-08-02 13:37:53', 'user', 'swal.jpg'),
(10, 'ahmad1', 'ahm019110er0@ju.edu.jo', '$2y$10$nuQKh9/JVLU1o5A6Pj6S/uO9J7fGTMcKRmdnV6sQ//MOmrXoOs/Pe', '2024-08-02 14:56:33', 'user', NULL),
(11, 'asdasd2102a', 'ahmad.alsawalhi10@gmail.com', '$2y$10$mydDzLo9pjHvwmavJefZ3eyL3sf91LqtfAnYNw3mxcnIDg3Y/UR9G', '2024-08-02 18:35:22', 'user', '20882536_1892722674278134_7232277841752053587_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `comments_ibfk_2` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
