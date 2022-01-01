-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2022 at 02:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newtripplin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `nic`, `phone`, `email`, `password`, `last_login`, `is_deleted`) VALUES
(1, 'MudithaT', 'Muditha Tharuka Batuwangala', '912345754V', '0761234127', 'admin@gmail.com', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', '2022-01-01 17:09:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booked_vehicles`
--

CREATE TABLE `booked_vehicles` (
  `post_id` int(11) NOT NULL,
  `rented_post_id` int(11) NOT NULL,
  `rented_user_id` int(11) NOT NULL,
  `booked_user_id` int(11) NOT NULL,
  `booked_first_name` varchar(100) NOT NULL,
  `booked_last_name` varchar(100) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `booked_time` datetime NOT NULL DEFAULT current_timestamp(),
  `picking_date` date NOT NULL DEFAULT current_timestamp(),
  `returning_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(15) NOT NULL,
  `seen` varchar(3) NOT NULL,
  `is_deleted_by_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booked_vehicles`
--

INSERT INTO `booked_vehicles` (`post_id`, `rented_post_id`, `rented_user_id`, `booked_user_id`, `booked_first_name`, `booked_last_name`, `brand_name`, `vehicle_name`, `price`, `profit`, `booked_time`, `picking_date`, `returning_date`, `status`, `seen`, `is_deleted_by_user`) VALUES
(1, 7, 3, 4, 'Chathura', 'Jayawardhana', 'Nissan', 'Nissan Caravan', 13000, 3250, '2021-07-17 12:56:52', '2021-07-18', '2021-07-22', 'confirmed', 'no', 0),
(2, 4, 4, 1, 'Muditha', 'Batuwangala', 'Honda', 'Honda Fit', 8000, 2000, '2021-04-25 20:46:49', '2021-05-01', '2021-05-15', 'confirmed', 'yes', 1),
(3, 2, 2, 3, 'Kalhari', 'Ramasinghe', 'Toyota', 'Toyota Premio', 6000, 1500, '2021-04-25 20:49:28', '2021-04-30', '2021-05-14', 'returned', 'yes', 0),
(4, 8, 4, 2, 'Hasitha', 'Dharmawardhana', 'Toyota', 'Toyota Hilux', 11000, 2750, '2021-06-19 15:35:02', '2021-06-19', '2021-07-02', 'pending', 'yes', 1),
(5, 3, 3, 2, 'Hasitha', 'p', 'Toyota', 'Land Cruiser', 10000, 2500, '2021-07-19 23:09:36', '2021-07-21', '2021-07-23', 'deleted', 'no', 0),
(8, 8, 4, 5, 'Muditha', 'Tharuka', 'Toyota', 'Toyota Hilux', 11000, 2750, '2021-07-20 13:50:42', '2021-07-21', '2021-07-22', 'returned', 'yes', 1),
(10, 8, 4, 5, 'Muditha', 'Tharuka', 'Toyota', 'Toyota Hilux', 11000, 2750, '2021-07-20 17:04:29', '2021-07-21', '2021-07-24', 'returned', 'yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rented_vehicles`
--

CREATE TABLE `rented_vehicles` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `province` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `vehical_name` varchar(200) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `kind_of_vehicle` varchar(100) NOT NULL,
  `type_of_vehicle` varchar(50) NOT NULL,
  `mnf_year` int(4) NOT NULL,
  `vehicle_condition` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `phone_code` int(4) NOT NULL,
  `contact_no` int(15) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `front_side_img` varchar(200) NOT NULL,
  `rear_side_img` varchar(200) NOT NULL,
  `side_view_img` varchar(200) NOT NULL,
  `f_compartment_img` varchar(200) NOT NULL,
  `r_compartment_img` varchar(200) NOT NULL,
  `d_compartment_img` varchar(200) NOT NULL,
  `e_compartment_img` varchar(200) NOT NULL,
  `extra_wheel_img` varchar(200) NOT NULL,
  `tab` varchar(200) NOT NULL,
  `price` varchar(10) NOT NULL,
  `profit` varchar(10) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rented_vehicles`
--

INSERT INTO `rented_vehicles` (`post_id`, `user_id`, `full_name`, `province`, `district`, `vehical_name`, `brand_name`, `kind_of_vehicle`, `type_of_vehicle`, `mnf_year`, `vehicle_condition`, `description`, `phone_code`, `contact_no`, `nic`, `email`, `front_side_img`, `rear_side_img`, `side_view_img`, `f_compartment_img`, `r_compartment_img`, `d_compartment_img`, `e_compartment_img`, `extra_wheel_img`, `tab`, `price`, `profit`, `is_deleted`) VALUES
(1, 1, 'Muditha Tharuka Batuwangala', 'Western', 'Gampaha', 'Toyota Allion', 'Toyota', 'Sedan', 'Luxery', 2018, 'Good condition', 'Good condition. Full option. Offers are available in this summer', 91, 761234127, '912345754V', 'workmine70@gmail.com', 'Super-white-2.jpg', '2.jpg', 'spec_b5230693-2a8c-4a1b-8792-4c9f9fa66a00_640_0.jfif', 'p1000496.jpg', '2013-Toyota-Allion-9.jpg', 'unnamed.jpg', 'sam_6610.jpg', 'tyre-sealant-1024x638.jpg', 'rented_cars', '5000', '1250', 0),
(2, 2, 'Hasitha Prabath Dharmawardhana', 'North Western', 'Kurunegala', 'Toyota Premio', 'Toyota', 'Sedan', 'Luxery', 2020, 'Luxery condition', 'Good condition. Reverce cam, DVD player, Head Up display, Seat heat option, Lane departure warning and many more options available. ', 94, 761234128, '912345755V', 'hasip@gmail.com', '01-scaled.jpeg', 'download.jfif', 'car_9fe61b0c-d60f-4cec-a5df-08e363609d38_640_0.jfif', '80496-18.jpg', 'giant_88780.jpg', '2011-Toyota-Allion-Boot.jpg', 'sam_6610.jpg', '12_15817480335e478f419b24a.jpeg', 'rented_cars', '6000', '1500', 0),
(3, 3, 'Kalhari Madhushika Ramasinghe', 'Southern', 'Hambantota', 'Land Cruiser', 'Toyota', 'SUV', 'Luxery', 2020, 'Luxery condition', 'Good condition. First owner. All are functionable. Reverce cam, DVD player, Head Up display, Seat heat option, Driver access, Lane departure warning and many more options available. ', 94, 761234129, '912345756V', 'kalharir@gmail.com', 'ogi-2020-toyota-land-cruiser-001.webp', 'Toyota_Land_Cruiser_Prado_Rear.jfif', '2022-toyota-land-cruiser-300-won-t-be-sold-stateside-triumphant-return-mooted_2.jpg', 'toyota-land-cruiser-38693a41-500x375.jpg', 'b5b1450df813198cf160cdedbbe9b78c.jpg', '2021-toyota-land-cruiser-front.jpg', 'Whats-the-best-Toyota-engine-for-my-classic-Land-Cruiser-build.jpg', 'Toyota-tyre-repair-kit-1.jpg', 'rented_off_roads', '10000', '2500', 0),
(4, 4, 'Chathura Madhuranga Jayawardhana', 'Western', 'Colombo', 'Honda Fit', 'Honda', 'Hatchback', 'Luxery', 2017, 'Good condition', 'Good condition. First owner. All are functionable. Reverce cam, DVD player, Head Up display, Seat heat option, Driver access, Lane departure warning and many more options available. ', 94, 761234130, '912345757V', 'chathuraj@gmail.com', '440px-Honda_Fit_Shuttle_Hybrid.jpg', '236779-4.jpg', 'Honda_Fit_Shuttle_Hybrid_rear.jpg', 'IMG_8094_50.jpg', '20190226-VinsAuto-Cars-ShuttleHybrid-0091_WEB-min.jpg', '563_k.jpeg', 'honda_fit_aria_a1252919413b3026951_9_orig.jpg', 'img_20190811_161435009_171e8f081fb8ded1b82000f69d6ebd05f506b851.jpg', 'rented_cars', '8000', '2000', 0),
(5, 1, 'Muditha Tharuka Batuwangala', 'Western', 'Gampaha', 'Mitsubishi Fuso', 'Mitsubishi', 'Bus', 'Luxery', 2020, 'Luxery condition', 'Good condition. Full option. Offers are available in this summer', 91, 761234127, '912345754V', 'workmine70@gmail.com', '1_15713677645da92b548af8f.jpeg', '6_15713677645da92b54dc85e.jpeg', '3_15713677645da92b54ad536.jpeg', '7_15713677655da92b555b18d.jpeg', '9_15713677655da92b5581bf4.jpeg', '10_15713677655da92b5590ab5.jpeg', '8_15713677655da92b556e6a8.jpeg', 'Toyota-tyre-repair-kit-1.jpg', 'rented_busses', '12000', '3000', 0),
(6, 2, 'Hasitha Prabath Dharmawardhana', 'North Western', 'Kurunegala', 'Mini Cooper', 'Moris', 'Hatchback', 'Antique', 1980, 'Good condition', 'Good condition. Reverce cam, DVD player, Head Up display, Seat heat option, Lane departure warning and many more options available. ', 94, 761234128, '912345755V', 'hasip@gmail.com', '60022344f261c0cacb84e7bfc5b8c543.jpg', 'f2cc5a8be616e0b9652fe8c6efbc008a.jpg', 'maxresdefault.jpg', 'david-brown-automoti_1600x0.webp', 'maxresdefault (1).jpg', 'Mini-Cooper-7.jpg', '2a32d4ad8480da57187b6f62d19831cd.jpg', '2012-05-31_08-35-52_395.jpg', 'rented_cars', '9000', '2250', 0),
(7, 3, 'Kalhari Madhushika Ramasinghe', 'Southern', 'Hambantota', 'Nissan Caravan', 'Nissan', 'Van', 'Luxery', 2020, 'Luxery condition', 'Good condition. Full option. Offers are available in this summer', 94, 761234129, '912345756V', 'kalharir@gmail.com', 'Nissan_NV350_CARAVAN_Microbus_GX_(E26)_front.jfif', 'Nissan_NV350_CARAVAN_Microbus_GX_(E26)_rear.jfif', '23FClsky50IL1UcFDpBYVZzamJUh1bxo29iknDVtmW.jpg', '2009_NISSAN_CARAVAN_interior.jpg', 'preview-768x432.jpg', '2008-toyota-hiace-van-super-long-high-roof-commuter-adh-kdh223b-kdh223b-kdh-223-15-seater-for-sale-in-japan-49k-3.png', 'urvan-premium-2017-7-6c39.jpg', '116353_IMG_7808.jpg', 'rented_vans', '13000', '3250', 0),
(8, 4, 'Chathura Madhuranga Jayawardhana', 'Western', 'Colombo', 'Toyota Hilux', 'Toyota', 'Pickup', 'Luxery', 2020, 'Luxery condition', 'Good condition. First owner. All are functionable. Reverce cam, DVD player, Head Up display, Seat heat option, Driver access, Lane departure warning and many more options available. ', 94, 761234130, '912345757V', 'chathuraj@gmail.com', 'Toyota Hilux UK 2020.jpg', 'Toyota Hilux UK 2020-2.jpg', 'Toyota Hilux UK 2020-20.jpg', '234018_TIobv4oVglgo1lwZLyiDjt.jpg', '2020-Toyota-Hilux-Media-Drive_Media-18-1024x768.jpg', 'toyota_hilux_invincible_double_cab_201.jpg', '2014-Toyota-Hilux-Vigo-3000cc-Auto-4WD-engine2.jpg', 'tyre-sealant-1024x638.jpg', 'rented_off_roads', '11000', '2750', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `ad_line1` varchar(100) NOT NULL,
  `ad_line2` varchar(100) NOT NULL,
  `ad_line3` varchar(100) NOT NULL,
  `phone_code` varchar(5) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `re_password` varchar(40) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `ad_line1`, `ad_line2`, `ad_line3`, `phone_code`, `phone_number`, `nic`, `email`, `gender`, `password`, `re_password`, `last_login`, `is_deleted`) VALUES
(1, 'Muditha', 'Batuwangala', 'MudithaT', 'No : 364/D, ', ' Samadana mawatha,', 'Makola.', '+91', 761234127, '912345754V', 'workmine70@gmail.com', 'Male', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', '2021-04-25 23:06:21', 0),
(2, 'Hasitha', 'Prabath', 'Hasip', 'No: 224/3, Alakolamada,', 'Dodangaslanda,', 'Kurunegala', '+94', 761234128, '912345755V', 'hasip@gmail.com', 'Male', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', '2021-07-20 00:12:39', 0),
(3, 'Kalhari', 'Ramasinghe', 'KalhariR', 'No: 670/2, Welagathwela', 'Agunukolapalessa,', 'Tangalle', '+94', 761234129, '912345756V', 'kalharir@gmail.com', 'Female', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', '2021-04-25 20:47:24', 0),
(4, 'Chathura', 'Jayawardhana', 'ChathuraJ', 'No: 665, Athurugiriya,', 'Colombo 5', '', '+94', 761234130, '912345757V', 'chathuraj@gmail.com', 'Male', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', '2021-07-20 17:06:08', 0),
(5, 'prabhath', 'Gamage', 'prabhath', '224/3', 'Rideegama', 'Kurunegala', '+91', 767788268, '971441089V', 'kdhprabhath@gmail.com', 'Male', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', '2021-07-20 17:02:16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_vehicles`
--
ALTER TABLE `booked_vehicles`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `rented_user_id` (`rented_user_id`),
  ADD KEY `booked_user_id` (`booked_user_id`),
  ADD KEY `rented_post_id` (`rented_post_id`);

--
-- Indexes for table `rented_vehicles`
--
ALTER TABLE `rented_vehicles`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id_fkey` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booked_vehicles`
--
ALTER TABLE `booked_vehicles`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rented_vehicles`
--
ALTER TABLE `rented_vehicles`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked_vehicles`
--
ALTER TABLE `booked_vehicles`
  ADD CONSTRAINT `booked_vehicles_ibfk_1` FOREIGN KEY (`rented_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booked_vehicles_ibfk_2` FOREIGN KEY (`booked_user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `rented_vehicles`
--
ALTER TABLE `rented_vehicles`
  ADD CONSTRAINT `rented_vehicles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
