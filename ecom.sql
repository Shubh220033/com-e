-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 04:53 AM
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
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'Nike Shoes', 'Comfortable running shoes for everyday use.', 2999.99, 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/d130fcfa-7169-4172-8955-bf39cc544527/NIKE+VOMERO+18.png', 'Shoes'),
(2, 'Apple Watch', 'Smartwatch with fitness tracking and apps.', 19999.00, 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MXM83ref_FV99_VW_34FR+watch-case-46-aluminum-rosegold-nc-s10_VW_34FR+watch-face-46-aluminum-rosegold-s10_VW_34FR?wid=750&hei=712&trim=1%2C0&fmt=p-jpg&qlt=95&.v=1725645481882', 'Electronics'),
(3, 'Gaming Laptop', 'High performance laptop for gaming and work.', 75999.50, 'https://jarrods.tech/wp-content/uploads/2023/12/asus-rog-zephyrus-m16-2023-gaming-laptop-1024x576.jpg', 'Electronics'),
(4, 'Leather Wallet', 'Genuine leather wallet with multiple compartments.', 1499.00, 'https://imagescdn.vanheusenindia.com/img/app/product/3/39726061-15077966.jpg?auto=format&w=390', 'Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'shubhparmar806@gmail.com', '123456789'),
(2, 'shubhparmar806@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `product` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`name`, `email`, `address`, `product`, `quantity`, `total`, `payment_method`) VALUES
('Shubh Dinesh Parmar', 'shubhparmar806@gmail.com', 'A 33 Ashok Samrat, Daftary Road,\r\nGaushala Lane, Malad East', 'Product B', 10, 2000, NULL),
('Shubh Dinesh Parmar', 'shubhparmar806@gmail.com', 'A 33 Ashok Samrat, Daftary Road,\r\nGaushala Lane, Malad East', 'Product B', 1, 200, NULL),
('Shubh Dinesh Parmar', 'shubhparmar806@gmail.com', 'A 33 Ashok Samrat, Daftary Road,\r\nGaushala Lane, Malad East', 'Product B', 1, 200, NULL),
('Shubh Dinesh Parmar', 'shubhparmar806@gmail.com', 'A 33 Ashok Samrat, Daftary Road,\r\nGaushala Lane, Malad East', 'Product B', 1, 200, NULL),
('Shubh Dinesh Parmar', 'shubhparmar806@gmail.com', 'A 33 Ashok Samrat, Daftary Road,\r\nGaushala Lane, Malad East', 'Product B', 1, 200, NULL),
('Shubh Dinesh Parmar', 'shubhparmar806@gmail.com', 'A 33 Ashok Samrat, Daftary Road,\r\nGaushala Lane, Malad East', 'Product B', 1, 200, NULL),
('Shubh Dinesh Parmar', 'shubhparmar806@gmail.com', 'A 33 Ashok Samrat, Daftary Road,\r\nGaushala Lane, Malad East', 'Product B', 2, 400, NULL),
('Shubh Dinesh Parmar', '', 'Malad', 'Apple Watch, Nike Shoes', 0, 22998.989999999998, NULL),
('Shubh Dinesh Parmar', '', 'Malad', 'Nike Shoes, Nike Shoes', 0, 5999.98, NULL),
('Shubh Dinesh Parmar', '', 'Malad', 'Nike Shoes', 0, 2999.99, 'wallet'),
('Shubh Dinesh Parmar', '', 'Malad', 'Nike Shoes, Nike Shoes, Nike Shoes', 0, 8999.97, 'wallet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
