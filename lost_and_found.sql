-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2024 at 08:04 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findit30`
--

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `claimant_id` int(11) DEFAULT NULL,
  `proof_description` text DEFAULT NULL,
  `proof_photo` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `status` enum('lost','found') DEFAULT 'lost',
  `photo` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `proof_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) -- Menjadikan kolom id sebagai kunci utama
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `name`, `description`, `category`, `location`, `status`, `photo`, `date`, `created_at`, `proof_photo`) VALUES
(14, 6, 'Gold Bracelet', 'A thin gold bracelet with a heart-shaped charm. Engraved with initials \"A.K.\"', 'Other', 'Main Building', 'lost', '../assets/uploads/goldbraclet33.jpg', '2024-11-24', '2024-11-25 16:54:00', NULL),
(15, 6, 'Blue Backpack', 'Navy blue backpack with white stripes. Contains a laptop, charger, and notebooks.', 'Other', 'Library Building (401)', 'lost', '../assets/uploads/blue-bag.jpg', '2024-11-22', '2024-11-25 16:55:05', NULL),
(16, 6, 'Smartphone (Samsung Galaxy S22)', 'White smartphone with a cracked screen. Has a red case with a keychain attached.', 'Phone', 'New Building, 17th Floor', 'found', '../assets/uploads/phone23.jpg', '2024-11-10', '2024-11-25 16:55:54', NULL),
(17, 6, 'Car Keys', 'A set of keys with a Toyota logo keychain. Includes house keys and a gym membership tag.', 'Other', 'Civil Building', 'lost', '../assets/uploads/key.jpg', '2024-11-24', '2024-11-25 16:57:44', NULL),
(18, 5, 'Passport', 'A BD passport in a green leather passport holder. Contains a boarding pass for flight AA345.', 'Other', 'Canteen', 'found', '../assets/uploads/BD_Passport.jpg', '2024-11-24', '2024-11-25 16:58:56', NULL),
(19, 5, 'Prescription Glasses', 'Black rectangular glasses in a brown leather case. Prescription details are labeled inside.', 'Other', 'Mosque', 'found', '../assets/uploads/glass33.jpg', '2024-11-25', '2024-11-25 16:59:25', NULL),
(20, 5, 'Laptop (MacBook Air)', 'Silver MacBook Air with a \"Tech Enthusiast\" sticker on the back. No case.', 'Other', 'Shahid Minar Area', 'lost', '../assets/uploads/macbook-air-m3-07.jpg', '2024-11-25', '2024-11-25 17:00:07', NULL),
(21, 5, 'Umbrella', 'Black collapsible umbrella with a red handle. Brand name \"RainX\" printed on the side.', 'Other', 'Library Building 401', 'lost', '../assets/uploads/Umbrella.jpg', '2024-11-05', '2024-11-25 17:00:33', NULL),
(22, 5, 'Watch (Rolex)', 'Gold wristwatch with a black leather strap. Engraved with \"To James, with love.\"', 'Other', 'Civil Building', 'found', '../assets/uploads/watch-rolex.jpg', '2024-11-25', '2024-11-25 17:02:06', NULL),
(23, 5, 'Water Bottle', 'Blue stainless steel water bottle with a \"Hydro Flask\" logo. Contains a name sticker: \"Emily R.\"', 'Other', 'Canteen', 'found', '../assets/uploads/blue.jpg', '2024-11-18', '2024-11-25 17:02:29', NULL),
(24, 5, 'Notebook', 'A red spiral-bound notebook with handwritten class notes. The name \"John D.\" is written on the first page.', 'Select One', 'New Building, 20th Floor', 'lost', '../assets/uploads/nootbook-printing-services (1).png', '2024-11-25', '2024-11-25 17:07:20', NULL),
(25, 5, 'ID Card', 'University ID card in a transparent plastic holder. Name on the card: \"Sophia R.\"', 'Other', 'Shahid Minar Area', 'found', '../assets/uploads/Blank-Student-ID-Card-Template.jpg', '2024-11-25', '2024-11-25 17:07:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contact_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) -- Menjadikan kolom id sebagai kunci utama
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact_link`, `created_at`) VALUES
(5, 'Abu Talha', 'bpitalha@gmail.com', '$2y$10$7ebjQ9AyEQRoDhUwteSmZOX1EcS0SRca0BAzPBEj1wtXBX8G1V8b2', '01765447539', '2024-11-25 16:28:10'),
(6, 'Md Riaz', 'riazmd582@gmail.com', '$2y$10$ReTy3gxrxdvcX7EdbSGE/OUTtpgPvznF3CBsceopLI1Sn2EVP/VA.', 'facebook.com/mdriazwd', '2024-11-25 16:30:34'),
(7, 'test@gmail.ocm', 'test@gmail.ocm', '$2y$10$UDeaxMBcP3/2Lf7a1PXp9.KdOjL9NBBIYM7jgKMS1i1UlEiHqcrRK', 'dsdsdsd', '2024-11-26 11:05:16'),
(8, 'forupemy', 'zaneh@mailinator.com', '$2y$10$OJMdb0CalDgtWP1YgdvD5eDTWRgMe5vVLKvj30eKxZksO0/OxjV9a', 'Architecto vel laborum quis perspiciatis mollit aut est omnis aut consequatur Dolorem sint', '2024-11-26 11:07:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `claimant_id` (`claimant_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `claims_ibfk_2` FOREIGN KEY (`claimant_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
