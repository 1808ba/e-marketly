-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2023 at 09:51 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `quantity`) VALUES
(25, 3, 68, 1),
(61, 4, 50, 12),
(62, 4, 49, 2),
(63, 4, 55, 1),
(64, 4, 54, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category`) VALUES
('Accessorie'),
('Bags'),
('Beauty'),
('Clothes'),
('Electronics'),
('Home & Garden'),
('Parfume'),
('Shoses');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 0, 'najoua', 'najoua11@gmail.com', '0615252585', 'najoua test');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_products` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` date NOT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 2, 'maryam id', '06', 'maryam@gmail.com', 'cash on delivery', 'flat no. tanger, maoc, tanger, tanger, Maroc - 0000', 'parfum (300 x 4) - ', 1200, '2023-01-26', 'completed'),
(2, 3, 'najoua', '0289545214', 'najoua11@gmail.com', '', 'flat no. test, test, test, test, test - 258257', 'Highlighter (399 x 1) - PC-LENOVO (9599 x 1) - ', 9998, '2023-01-28', 'pending'),
(3, 4, 'test', '060609', 'aymanidou@gmail.com', 'credit card', 'flat no. morocco 123, nn, Rabat, 258, Morocco - 2103', 'Watch (299 x 1) - IPhone 14 Pro (19590 x 1) - ', 19889, '2023-01-30', 'pending'),
(4, 4, 'test', '2514', 'aymanidou@gmail.com', 'cash on delivery', 'flat no. qsd, ddz, sdf, sdqf, dg - 512', 'Necklace  (999 x 1) - Watch (299 x 1) - ', 1298, '2023-01-30', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `details` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image_01` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_02` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_03` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `category`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(49, 'Watch', 'Combining classic shapes, the Nibosi watches for Her are always in harmony with the season and are inspired by the most current styles of jet-setters.  For him, nibosi watches are at the cutting edge of functionality, combining performance, luxury and elegance.', 'Accessorie', 299, 'images8.jpg', 'images7.jpg', 'images9.jpg'),
(50, 'Necklace ', 'Elegant 4-piece set, gift for ladies Fashionable appearance: This watch is simple, elegant and fashionable, bring it to show your elegance.  Quartz Movement: This watch has high quality design and high quality material quartz movement,', 'Accessorie', 999, 'images4.jpg', 'images6.jpg', 'images5.jpg'),
(54, 'Mon Paris', 'Embrace your real identity with Signature Perfume for her.  This timeless yet modern fragrance creates an elegant Signature impression that lasts.  Sparkling Pink Pepper brings a sparkling facet to this beautifully feminine scent, while Lavender Flower blossoms with woody floral undertones.  A new modern classic destined to become the next tradition over the years - so you can always shine.  Presented in a premium wooden frame, to preserve your treasured memories for years to come.', 'Parfume', 199, 'mon paris (1).jpg', 'mon paris (3).jpg', 'mon paris (2).jpg'),
(55, 'Dress', 'Women&#39;s 100% cotton sleeveless dress with round neck. Fitted cut. Slight stretch.', 'Clothes', 299, 'dress2.jpg', 'dress3.jpg', 'dress1.jpg'),
(56, 'Mirror', 'Rough-hewn aluminum frames oversized round mirror in organic style. Adds natural elegance to the living room or entry. Mounting hardware is included. CB2 exclusive.', 'Home & Garden', 1499, 'm3.jpg', 'm2.jpg', 'm1.jpg'),
(57, 'Adidas', 'Opt for a relaxed casual look.  This shoe has 3 stripes stitched on the outside of the foot.  It is decorated with 3 perforated bands on the inside.  ADIDAS MEN&#39;S SNEAKERS', 'Shoses', 299, 'add2.jpg', 'ad5.jpg', 'ad1.jpg'),
(58, 'PC-LENOVO', 'Le PC portable Lenovo ThinkPad X1 Nano Gen 1 offre d&#39;excellentes performances grâce à son processeur Intel Core i7-1160G7 Turbo 4.4Ghz, ses 16 Go de mémoire, son SSD M. 2 PCIe de 1 To, son Clavier espagnole rétroéclairer, son lecteur d&#39;empreinte digitale et sa Licence Windows 10 Pro.', 'Electronics', 9599, 'h3.jpg', 'h1.jpg', 'h2.jpg'),
(59, 'Highlighter', 'For this winter 2023, marketly offers its first powder highlighter, the &#39;Positive Light Silky Touch Highlighter&#39;. A highlighter available in 4 shades that gives skin a glass-like glow with a natural finish.', 'Beauty', 399, 'bot4.jpg', 'bot1.jpg', 'bot2.jpg'),
(60, 'Square bag', 'gof_orunique Bag description\r\n\r\nLength -17 cm\r\n\r\nBreadth-24 cm\r\n\r\nPrice -499/- free shipping\r\n\r\nDelivered in 7-8 days\r\n\r\nLimited stock available order now 2 colors black and white with belt attachment', 'Bags', 499, '3 (3).jpeg', '3 (2).jpeg', '3 (1).jpeg'),
(61, 'Man watch ', 'bellarose_botiquee Men&#39;s Cortlandt Black Leather Strap Watch 44mm\r\n\r\npositive reviews is 90% Original from U.S.', 'Accessorie', 399, '8 (3).jpeg', '8 (1).jpeg', '8 (2).jpeg'),
(62, 'IPhone 14 Pro', 'The iPhone 14 Pro screen has rounded corners that follow the sleek line of the device and fit into a standard rectangle.  If we measure this rectangle, the screen displays a diagonal of 6.12 inches (the actual display area is less).', 'Electronics', 19590, 'ih9.jpg', 'hu9.jpg', 'gh.jpg'),
(63, 'Robe', 'This dress is suitable for any occasion, perfect for indoor wear, outdoor wear, photography, gifts, etc.  Provide the best comfort experience for little princess daily wear.', 'Clothes', 249, '88.jpg', '55.jpg', '99.jpg'),
(64, 'Sauvage ', 'Go higher with the new revisited version of the famous Eau de Toilette Glacier Rock.  This fresh and invigorating fragrance is perfect for a sporty and free man.  The refreshing notes of Lemon fuse with Cucumber and mineral Amber to inspire you to excel.', 'Parfume', 699, 'pp.jpg', 'uu.jpg', 'rr.jpg'),
(65, 'Leather square bags', '_.kins_Women&#39;s Bag Cute Candy Color Ladies Shoulder Bag Pattern Creativity PU\r\n\r\nLeather Square Bag\r\n\r\n~Product Description.\r\n\r\nFabric PU Leather.\r\n\r\nColors - 4\r\n\r\nLength - 8&#34; / 6&#34;\r\n\r\nHigh Quality.', 'Bags', 279, '5 (2).jpeg', '5 (3).jpeg', '5 (1).jpeg'),
(66, 'T-Shirt', 'Black T-Shirt Long Sleeve Turtleneck Long Sleeve Blouse', 'Clothes', 249, 'yu.jpg', 'iu.jpg', 'hy.jpg'),
(67, 'Nike', 'Nike Venture Runner (400) Midnight Navy/White/Midnight Navy Sports Casual Shoes (CK2944400) (400) Midnight Navy/Why 24.5.\r\n\r\n Heel type: flat\r\n Closure: lace up\r\n Fabric - Synthetic Fiber', 'Shoses', 399, 'images10.jpg', 'images12.jpg', 'images11.jpg'),
(68, 'Shoerack bag', 'Designed with modern women in mind, our tweed shoulder bag is the bag to invest in for those looking to introduce some texture to their wardrobes. Combine the asymmetrical silhouette with the elegant cream-white finish and you have a winning design that will transform your new-season wardrobe in an instant. Pair them with flared jeans, a white off-shoulder top and statement jewellery.', 'Bags', 449, '4 (2).jpeg', '4 (1).jpeg', '4 (3).jpeg'),
(69, 'LENOVO Tab', 'Lenovo Tab M8 MediaTek Helio A22 Tab Quad-Core 2.0 GHz processor, Android™ 9 Pie™ operating system, 20.32 cm (8″) IPS HD (1280 x 800) LCD 350 nits 10-point touch screen, Memory  2 GB RAM, 32 GB ROM, Compatible microSD card up to 2 TB exFAT or 128 GB FAT32, Autonomy 5020 mAh (typical), Up to 18 hours of web browsing, Side speaker powered by Dolby Audio™,  5MP rear camera with autofocus, Front camera: 2MP fixed focus, 802.11a/b/g/n/ac WiFi connectivity;  2.4/5GHz Bluetooth® 4.2', 'Electronics', 2599, '87.jpg', 'oi.jpg', 'hj.jpg'),
(70, 'Eye shadows', '48 eye shadows, 12 glitter top coats, 4 eye shadow bases, 4 blushes, 4 highlighters, 3 eye shadows, 3 eyebrow pencils, 2 lip glosses, 2 sheer lip glosses, 2 lip oils  , 2 Bronzers, 1 Eyebrow Wax, 1 Cheek Brush, 1 Eye Shadow Brush, 1 Eyebrow Brush', 'Beauty', 149, 'ttt.jpg', 'hhh.jpg', 'pop.jpg'),
(71, 'Lamp', 'Table lamp with a sturdy ceramic base, a copper-coloured socket and a lampshade with visible textile fibres.  All in a classic shape that matches most decors and is suitable for any room in the house.', 'Home & Garden', 479, 'rry.jpg', 'iii.jpg', 'oo.jpg'),
(72, 'Redmi Note 10 Pro', 'Bleu glacier, Gradient Bronze, Gris Onyx, Processeur, Qualcomm® Snapdragon™ 732GTechnologie de traitement 8nmQualcomm® Adreno™ 618 GPU', 'Electronics', 3199, 'WhatsApp 8.jpg', 'WhatsApp1.jpg', 'WhatsApp.jpg'),
(73, 'Capuche', 'Excellent product, suitable for everyone, warm and sporty, with resistant and durable seams, available in many colors', 'Clothes', 249, '987.jpg', '87887.jpg', '89858.jpg'),
(74, 'Corner bag', 'ornot_corner Chain Shoulder Bag\r\n\r\n crossed\r\n\r\n On sale: 750 Tk\r\n\r\n Regular: 1250 Tk\r\n\r\n Color: White, black and blue\r\n\r\n Item Description:\r\n\r\n Bottom length: 23.5cm,\r\n\r\n Height: 11cm,\r\n\r\n Width: 6.5cm\r\n\r\n -Premium quality -PU foam\r\n\r\n WRITE US TO ORDER', 'Bags', 349, '2 (1).jpeg', '2 (2).jpeg', '2 (3).jpeg'),
(75, 'Flaky lips', 'A must have for all dry, flaky lips!  ~ This delicately scented lip sleeping mask sloughs off dead skin cells while infusing lips with hydrating extracts, antioxidants and hyaluronic acid to keep lips feeling supple and smooth overnight', 'Beauty', 199, '89889.jpg', '985858.jpg', '92525.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'maryam', 'maryam@gmail.com', '3458e1c69536aacc7e0e015a8085484b5c95d2ad'),
(3, 'najoua', 'najoua11@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(4, 'aymenidou', 'aymanidou@gmail.com', '1239d64048b23ac807b6e7813784e883b64d2e18');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`) VALUES
(14, 3, 60),
(15, 3, 65),
(17, 3, 49),
(29, 4, 70),
(30, 4, 59);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
