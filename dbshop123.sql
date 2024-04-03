-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 09:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbshop123`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `name`, `firstname`, `lastname`, `company`, `address`, `postal`, `city`, `country`, `phone`) VALUES
(1, 1, 'Home', 'Harry', 'Kien', NULL, '21 Thao Dien Thu Duc District', '700000', 'Ho Chi Minh City', 'VN', '0909766521'),
(2, 2, 'Apartment', 'Jennie', 'Kim', NULL, '9 rue Ut qui voluptas nobi', '15554', 'Hanoi', 'VN', '0961589988'),
(3, 3, 'Home', 'Kim', 'Jisoo', NULL, '49A Phan Dang Luu, Ward 7, Phu Nhuan Dist.', '70000', 'Ho Chi Minh City', 'VN', '0973843282'),
(4, 1, 'Apartment', 'Bukayo', 'Saka', NULL, '11 Le Duan, Cua Nam Ward, Hoan Kiem Dist.,', '111000', 'Hanoi', 'VN', '0961581909');

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `description`, `price`) VALUES
(1, 'Viettel Post', 'Estimated time: 1-3 days. Shipping insurance included', 400),
(2, 'Vietnam Post', 'Estimated time: 2-4 days. Shipping insurance included', 190);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'iPhone'),
(2, 'iPad'),
(3, 'Watch'),
(4, 'Mac'),
(5, 'AirPods'),
(6, 'TV & Home'),
(7, 'Accessories'),
(8, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220216090224', '2022-02-16 09:02:53', 195),
('DoctrineMigrations\\Version20220216094827', '2022-02-16 09:48:41', 54),
('DoctrineMigrations\\Version20220218171218', '2022-02-18 17:12:29', 198),
('DoctrineMigrations\\Version20220219105301', '2022-02-19 10:53:16', 221),
('DoctrineMigrations\\Version20220220215719', '2022-02-20 21:57:28', 237),
('DoctrineMigrations\\Version20220222211707', '2022-02-22 21:17:36', 172),
('DoctrineMigrations\\Version20220226160703', '2022-02-26 16:07:11', 356),
('DoctrineMigrations\\Version20220227163839', '2022-02-27 16:38:48', 677),
('DoctrineMigrations\\Version20220227195406', '2022-03-06 19:10:19', 59),
('DoctrineMigrations\\Version20220320164349', '2022-03-20 17:43:57', 34),
('DoctrineMigrations\\Version20220321141846', '2022-03-21 15:18:54', 55),
('DoctrineMigrations\\Version20220329100058', '2022-03-29 12:01:11', 128),
('DoctrineMigrations\\Version20220401085112', '2022-04-01 10:51:23', 128),
('DoctrineMigrations\\Version20220401092032', '2022-04-01 11:20:39', 28),
('DoctrineMigrations\\Version20240310163316', '2024-03-10 17:35:56', 46),
('DoctrineMigrations\\Version20240310163550', '2024-03-10 17:35:56', 2);

-- --------------------------------------------------------

--
-- Table structure for table `headers`
--

CREATE TABLE `headers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `btn_title` varchar(255) NOT NULL,
  `btn_url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `headers`
--

INSERT INTO `headers` (`id`, `title`, `content`, `btn_title`, `btn_url`, `image`) VALUES
(1, 'Macbook Air', 'If you can dream it,\r\nMac can do it.', 'Buy now', '/products/macbook-air-13-m2-midnight-16gb-256gb', '5d40374c2df8261c5a7ef606861b1f489a7d1a12.png'),
(2, 'Mix. Match. MagSafe.', 'Snap on a case, wallet, or wireless charger.', 'Buy now', '/products/iphone-15-pro-max-silicone-case-with-magsafe-orange', '08c9078ef82788739ca0ac2f8e741d4662856d65.png'),
(3, 'iPhone 15 Pro Max', 'Titanium. So strong. So light. So Pro', 'Buy now', '/products/iphone-15-pro-max-white-256gb', '387830b7e038875e0fc073646e22b46c7b272af4.png');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `carrier_name` varchar(255) NOT NULL,
  `carrier_price` varchar(255) NOT NULL,
  `delivery` longtext NOT NULL,
  `reference` varchar(255) NOT NULL,
  `stripe_session` varchar(255) DEFAULT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `created_at`, `carrier_name`, `carrier_price`, `delivery`, `reference`, `stripe_session`, `state`) VALUES
(1, 1, '2024-03-22 22:14:44', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240322221444-65fdf4c4d7cc1', NULL, 4),
(2, 1, '2024-03-22 22:15:40', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240322221540-65fdf4fca3153', NULL, 4),
(3, 1, '2024-03-23 12:02:43', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240323120243-65feb6d3f34bf', NULL, 4),
(4, 1, '2024-03-23 12:40:29', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240323124029-65febfad046a0', NULL, 2),
(5, 1, '2024-03-24 17:09:05', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240324170905-660050216c810', 'cs_test_b1WfJNPu5z9YGzOlF94uxgRcTIT61Qi8BEYZnhcVZs8ymqjahheCYirDQ9', 1),
(6, 3, '2024-03-29 02:35:10', 'Viettel Post', '400', 'Kim Jisoo<br>0973843282<br>49A Phan Dang Luu, Ward 7, Phu Nhuan Dist.<br>70000<br>Ho Chi Minh City, VN<br>', '20240329023510-66061acec9b7e', 'cs_test_b1efbtZrrYJYHhmxvKtCMd2CyDR5uLJhrbDhjWHJaMvAYJB3MeWYP76LIs', 1),
(7, 1, '2024-03-29 04:31:32', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240329043132-6606361460c0f', NULL, 0),
(8, 1, '2024-03-29 04:32:50', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240329043250-66063662ac2b1', NULL, 0),
(9, 1, '2024-03-29 04:44:16', 'Viettel Post', '400', 'Harry Kien<br>0909766521<br>21 Thao Dien Thu Duc District<br>700000<br>Ho Chi Minh City, VN<br>', '20240329044416-66063910efb11', 'cs_test_b1nhSlq95YxZRzFQSUDnTIuqUiZkBxj8DyaG2rKZho4SeEoMKFSUh3oxbV', 0),
(10, 1, '2024-04-01 20:25:22', 'Viettel Post', '400', 'Bukayo Saka<br>0961581909<br>11 Le Duan, Cua Nam Ward, Hoan Kiem Dist.,<br>111000<br>Hanoi, VN<br>', '20240401202522-660afc12cbf3a', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `binded_order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `binded_order_id`, `quantity`, `price`, `total`, `product_id`) VALUES
(1, 1, 1, 24900, 24900, 2),
(2, 2, 1, 24900, 24900, 2),
(3, 3, 1, 119900, 119900, 1),
(4, 4, 2, 89900, 179800, 5),
(5, 5, 1, 119900, 119900, 9),
(6, 6, 1, 4900, 4900, 7),
(7, 6, 1, 119900, 119900, 1),
(8, 7, 1, 119900, 119900, 9),
(9, 8, 1, 119900, 119900, 9),
(10, 9, 1, 32900, 32900, 3),
(11, 10, 1, 12900, 12900, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL,
  `is_in_home` tinyint(1) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `slug`, `image`, `subtitle`, `description`, `price`, `is_in_home`, `stock`) VALUES
(1, 1, 'iPhone 15 Pro Max', 'iphone-15-pro-max-white-256gb', '26952c883904b3623cb81d981fee3ef4901768e6.jpg', 'White/256GB', 'The iPhone 15 Pro Max is Apple’s flagship smartphone, featuring the powerful A17 Pro Chip, a sleek titanium design, an impressive 48MP camera system, and an all-day battery life. With features like spatial video capture, USB-C connectivity, and privacy-focused design, it’s a true Pro experience.', 119900, 1, 8),
(2, 5, 'AirPods Pro Gen 2', 'airpods-pro-gen-2-magsafe-charge-usb-c', '0358e907e58e9f54b02744879846942d52440df6.jpg', 'MagSafe Charge (USB-C)', 'Elevate your audio experience with these cutting-edge wireless earbuds. Powered by the Apple-designed H2 chip, they deliver crisp, high-definition sound and boast up to 2x more Active Noise Cancellation. Whether you’re immersed in music or need to stay aware of your surroundings, the Adaptive Audio seamlessly blends noise control modes. With Spatial Audio, movies and games come alive in a remarkably personal way. Plus, enjoy 6 hours of battery life on a single charge.', 24900, 0, 19),
(3, 2, 'iPad Gen 9', 'ipad-gen-9-silver-64gb-wifi', '9cd1eaaf6d7ed0fd48282ff26d40769f25ce8f26.jpg', 'Silver/64GB/Wifi', 'Introducing the iPad 10.2-inch (9th generation): Discover the most affordable iPad with a large Multi-Touch display, powered by the A13 Bionic chip. Whether you’re working, playing, creating, or learning, this versatile tablet has you covered. With support for Apple Pencil and the Smart Keyboard, it’s perfect for productivity and creativity. Explore a million apps on the App Store, and enjoy enhanced privacy features.', 32900, 1, 25),
(4, 1, 'iPhone 15 Pro', 'iphone-15-pro-blue-128gb', '483d43fb4c7068a4c2b30323bae9fdb558340533.webp', 'Blue/128GB', 'Introducing the iPhone 15 Pro in Blue Titanium: Elevate your mobile experience with this ultimate powerhouse. Featuring a 6.1-inch Super Retina XDR display and the A17 Pro chip, it delivers lightning-fast performance. Capture stunning photos with the 48MP triple-camera system, including ultra-wide and telephoto lenses. Enjoy up to 29 hours of video playback and stay connected with Emergency SOS via satellite. The sleek blue titanium finish exudes sophistication.', 99900, 0, 20),
(5, 1, 'iPhone 15 Plus', 'iphone-15-plus-green-128gb', 'ce34fae5b9d5396c308827c08e1a61f8b5b20a5d.webp', 'Green/128GB', 'Elevate your mobile experience with this ultimate powerhouse. Featuring a 6.7-inch Super Retina XDR display, the iPhone 15 Plus boasts the A17 Pro chip with a 6-core GPU for lightning-fast performance. Capture stunning photos with the 48MP triple-camera system, including ultra-wide and telephoto lenses. Enjoy up to 29 hours of video playback and stay connected with Emergency SOS via satellite. The sleek green design adds a touch of sophistication.', 89900, 1, 8),
(6, 3, 'Apple Watch Series 9', 'apple-watch-series-9-aluminium', 'be2b34f63d906a9ada60f8585e907b954b749dee.jpg', 'Aluminium/Pink/41mm/GPS/Sport Band', 'Introducing the Apple Watch Series 9 GPS (41mm) in Pink Aluminum with a Light Pink Sport Band. This sleek smartwatch combines style and functionality. With built-in GPS, it’s perfect for tracking your workouts, monitoring your health, and staying connected. The Sport Band ensures a comfortable fit, while the aluminum case keeps it lightweight. Elevate your wrist game with the Apple Watch Series 9!', 39900, 1, 15),
(7, 7, 'iPhone 15 Pro Max Silicone Case with MagSafe', 'iphone-15-pro-max-silicone-case-with-magsafe-orange', '29c0c6963ced6038ee9d921fedb5f47f0dcb96a8.jpg', 'Orange', 'Designed by Apple to complement iPhone 15 Pro Max, the Silicone Case with MagSafe is a delightful way to protect your iPhone. The silky, soft-touch finish of the silicone exterior feels great in your hand. And on the inside, there’s a soft microfiber lining for even more protection. \r\n\r\nWith built-in magnets that align perfectly with iPhone 15 Pro Max, this case offers a magical attach experience and faster wireless charging, every time. When it’s time to charge, just leave the case on your iPhone and snap on your MagSafe charger, or set it on your Qi-certified charger. Like every Apple-designed case, it undergoes thousands of hours of testing throughout the design and manufacturing process. So not only does it look great, it’s built to protect your iPhone from scratches and drops.', 4900, 0, 19),
(8, 7, 'Apple Pencil', 'apple-pencil-gen2', 'a125a751a7726b699e4e5f2c4180f74f7bf23da6.jpg', '2nd Generation', 'Apple Pencil (2nd generation) delivers pixel-perfect precision and industry-leading low latency, making it great for drawing, sketching, coloring, taking notes, marking up PDFs, and more. And it’s as easy and natural to use as a pencil.\r\n\r\nApple Pencil (2nd generation) also allows you to change tools without setting it down, thanks to its intuitive touch surface that supports double-tapping.\r\n\r\nApple Pencil (2nd generation) supports Apple Pencil hover when used with iPad Pro 12.9-inch (6th generation) and iPad Pro 11-inch (4th generation).\r\n\r\nDesigned for iPad Pro, iPad Air, and iPad mini, it features a flat edge that magnetically attaches for automatic charging and pairing.', 12900, 0, 9),
(9, 4, 'MacBook Air 13', 'macbook-air-13-m2-midnight-16gb-256gb', '9c97650ae4dffa25a6ebabdc6e9a78dd7ff2a187.jpg', 'Midnight/M2/16GB/256GB', 'Apple M2 chip with 8‑core CPU, 10‑core GPU, 16‑core Neural Engine\r\n16GB unified memory\r\n256GB SSD storage\r\n13.6-inch Liquid Retina display with True Tone²\r\n1080p FaceTime HD camera\r\nMagSafe 3 charging port\r\nTwo Thunderbolt / USB 4 ports\r\n30W USB-C Power Adapter\r\nBacklit Magic Keyboard with Touch ID - US English', 119900, 1, 9),
(10, 1, 'iPhone 15', 'iphone-15-pink-128gb', '344d736dc7eb5affaf874308052cbd7091217ede.webp', 'Pink/128GB', 'The iPhone 15, unveiled by Apple, is a remarkable blend of cutting-edge technology and sleek design. With its 48MP main camera, you can capture breathtaking photos that evoke smiles. The phone boasts a durable color-infused glass and aluminum design, ensuring both style and sturdiness. Charging is a breeze thanks to the USB-C compatibility, and the display shines even in bright sunlight. Whether you’re a photography enthusiast, a multitasker, or simply seeking an all-around powerhouse, the iPhone 15 delivers. Explore its features, including Dynamic Island, and get ready to experience the future of mobile technology.', 79900, 0, 15),
(11, 1, 'iPhone 11', 'iphone-11-mint-64gb', '46a97e964e2fc7b8f694077cb3c7976fd0d57ce3.webp', 'Mint/64GB', 'The iPhone 11, part of Apple’s thirteenth generation of iPhones, was unveiled in September 2019. With its large 6.1-inch Liquid Retina IPS LCD display, the iPhone 11 combines advanced technology and vibrant design. Powered by the Apple A13 Bionic chip, it delivers impressive performance. The dual-camera system, featuring a 12 MP wide lens and an ultrawide lens, captures stunning photos and videos. Available in an array of colors, the iPhone 11 remains a top choice for users seeking a balance of features and affordability.', 24900, 0, 20),
(12, 1, 'iPhone 12', 'iphone-12-mint-64gb', 'c528848869dd894ac001f3684b0c21fa628335e4.webp', 'Mint/64GB', 'The iPhone 12, available in a mint with 64GB of storage, is a remarkable blend of style and functionality. Its 6.1-inch Super Retina XDR display offers vivid visuals, while the Ceramic Shield ensures durability. Powered by the A14 Bionic chip, it delivers impressive performance. The advanced dual-camera system captures stunning photos and videos, and the 5G capability ensures superfast downloads and high-quality streaming. With MagSafe accessory support and IP68 water resistance, the iPhone 12 is a versatile companion for your daily adventures.', 32900, 0, 10),
(13, 1, 'iPhone 14 Pro Max', 'iphone-14-pro-max-purple-128gb', 'fa583091367789c2c524c59dee251ec3d7c3b0e4.webp', 'Purple/128GB', 'The iPhone 14 Pro Max in Deep Purple with 128GB of storage is a captivating blend of style and functionality. Its 6.7-inch Super Retina XDR display delivers vivid visuals, while the 48MP Main camera captures stunning photos and videos. With features like Dynamic Island and Always-On display, interacting with the iPhone 14 Pro Max becomes magical. It boasts an A16 Bionic chip, ensuring superfast performance. Safety features include Emergency SOS via satellite and Crash Detection. Plus, enjoy all-day battery life and up to 29 hours of video playback. The iPhone 14 Pro Max is a true powerhouse with industry-leading durability, water resistance, and the convenience of MagSafe charging.', 74700, 0, 15),
(14, 1, 'iPhone 13', 'iphone-13-red-128gb', '56f540a3d1a6adeb09afcc1009fdc2c02635d1d5.webp', 'Red/128GB', 'The iPhone 13, available in the striking (PRODUCT)RED color with 128GB of storage, boasts an advanced dual-camera system that allows you to click mesmerizing pictures with immaculate clarity. Furthermore, the lightning-fast A15 Bionic chip allows for seamless multitasking, elevating your performance to a new dimension.', 59900, 0, 20),
(15, 1, 'iPhone 13 Pro', 'iphone-13-pro-blue-128gb', '1e032119d678666adced3e4828ca05053818061c.webp', 'Blue/128GB', 'The iPhone 13 Pro in Sierra Blue with 128GB of storage is a captivating blend of style and functionality. Its 6.1-inch Super Retina XDR display delivers vivid visuals, while the Ceramic Shield ensures durability. Powered by the A15 Bionic chip, it delivers impressive performance. The advanced dual-camera system captures stunning photos and videos, and the 5G capability ensures superfast downloads and high-quality streaming. With MagSafe accessory support and IP68 water resistance, the iPhone 13 Pro is a versatile companion for your daily adventures.', 68900, 0, 10),
(16, 2, 'iPad Gen 10', 'ipad-gen-10-blue-64gb-wifi', '5f037383ffe743a62a5f21ac6e9ad100ec04e966.webp', 'Blue/64GB/Wifi', 'The Apple iPad 10.9-inch (10th Generation), available in a captivating blue color with 64GB of storage, seamlessly blends style and functionality. Its striking 10.9-inch Liquid Retina display with True Tone ensures vivid visuals, while the A14 Bionic chip powers impressive performance. Capture memories with the 12MP Wide back camera or engage in video calls using the 12MP Ultra Wide front camera with Center Stage. The Touch ID feature ensures secure authentication and convenient Apple Pay transactions. With ultrafast Wi-Fi 6 connectivity and a USB-C connector, this iPad is ready for productivity, creativity, and entertainment. Whether you’re using an Apple Pencil (USB-C), the 1st generation Apple Pencil, or the Magic Keyboard Folio, the iPadOS 17 enhances your experience with powerful features. It’s a versatile companion for work, play, and everything in between.', 44900, 0, 15),
(17, 2, 'iPad Mini 6', 'ipad-mini-6-purple-64gb-wifi', '691d42f6b349654659ecef5375e3619b1a1e4c3b.webp', 'Purple/64GB/Wifi', 'The Apple iPad Mini 6, available in a captivating purple color with 64GB of storage, seamlessly blends style and functionality. Its striking 10.9-inch Liquid Retina display with True Tone ensures vivid visuals, while the A14 Bionic chip powers impressive performance. Capture memories with the 12MP Wide back camera or engage in video calls using the 12MP Ultra Wide front camera with Center Stage. The Touch ID feature ensures secure authentication and convenient Apple Pay transactions. With ultrafast Wi-Fi 6 connectivity and a USB-C connector, this iPad is ready for productivity, creativity, and entertainment. Whether you’re using an Apple Pencil (USB-C), the 1st generation Apple Pencil, or the Magic Keyboard Folio, the iPadOS 17 enhances your experience with powerful features.', 47900, 1, 20),
(18, 3, 'Apple Watch Series 8', 'apple-watch-series-8-gps-cellular-gold-41mm', '296c265d1c75afb3416bcd7b7d4dbf0065eee093.webp', 'Aluminium/Gold/41mm/GPS+Cellular/Sport Band', 'The Apple Watch Series 8 GPS + Cellular 41mm in Gold Stainless Steel Case with a Starlight Sport Band (size: S/M) is a harmonious blend of style and functionality. Its advanced health sensors allow you to take an ECG, measure heart rate, and track blood oxygen levels. With features like Crash Detection, sleep stages tracking, and advanced workout metrics, it ensures your well-being. The large Always-On display, all-day battery life, and fast charging enhance convenience. Whether you’re streaming music, making secure payments with Apple Pay, or exploring the redesigned Compass app, this watch keeps you connected, active, and safe.', 39900, 0, 0),
(19, 8, 'Apple Magic Keyboard', 'apple-magic-keyboard', '6f386439cde50e80dc8d52a249ec97052a05d4bf.jpg', 'White', 'The Apple Magic Keyboard (Model MK2A3) is a wireless and rechargeable keyboard designed for use with Mac computers and Apple Vision Pro. Its slim profile, automatic pairing, multimedia keys, and USB-C to Lightning Cable make it a seamless and stylish addition to your Mac setup.', 12900, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$BvGaVWSsSsxCI.KOEXpf7uLCTLy2CY7qKrlDLQ44HMcSh8vlM8qKC', 'Admin', 'Nguyen'),
(2, 'mod@gmail.com', '[\"ROLE_MOD\"]', '$2y$13$BvGaVWSsSsxCI.KOEXpf7uLCTLy2CY7qKrlDLQ44HMcSh8vlM8qKC', 'Mod', 'Phan'),
(3, 'user@gmail.com', '[]', '$2y$13$8CCPuAf1lVmJ5TuNGNtam.W/969y8038BJNPByqDYOcJ5usYZolZy', 'Kim', 'Jisoo'),
(4, 'mrbean@gmail.com', '[\"ROLE_USER\",\"ROLE_MOD\"]', '$2y$13$BvGaVWSsSsxCI.KOEXpf7uLCTLy2CY7qKrlDLQ44HMcSh8vlM8qKC', 'Lucas', 'Dang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D4E6F81A76ED395` (`user_id`);

--
-- Indexes for table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `headers`
--
ALTER TABLE `headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_845CA2C17C78A4E3` (`binded_order_id`),
  ADD KEY `IDX_845CA2C14584665A` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `headers`
--
ALTER TABLE `headers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_D4E6F81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_845CA2C14584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_845CA2C17C78A4E3` FOREIGN KEY (`binded_order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
