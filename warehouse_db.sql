-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 03, 2015 at 03:12 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `warehouse_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `electronics`
--

CREATE TABLE `electronics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(60) NOT NULL,
  `category` smallint(10) NOT NULL,
  `year_model` date NOT NULL,
  `sku` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `electronics`
--

INSERT INTO `electronics` (`id`, `product`, `category`, `year_model`, `sku`, `model`, `price`, `image`) VALUES
(1, 'LED 55', 1, '2015-04-02', '8218007', 'UN55HU7250FXZA', 1499.99, 'hdtv.jpeg'),
(2, 'Smartphone', 3, '2015-04-25', '7640099', 'MGAN2LL/A', 299.99, 'smartphone.jpg'),
(4, 'DSLR Camera', 3, '2015-04-17', '8753767', '1549', 2999.99, 'camera.jpeg'),
(5, 'G19s Gaming Keyboard ', 2, '2015-04-09', '8785586', '920-004985', 164.99, 'keyboard.jpeg'),
(6, ' 27"iMac with 5K Retina Display ', 2, '2015-04-26', '9034004', 'MF886LL/A', 2499.99, 'imac.jpeg'),
(7, 'MacBook Pro Retina', 2, '2015-04-26', '1310233898', 'ME294LL/A', 2244.99, 'macbook.jpg'),
(8, 'DSLR Camera', 3, '2015-04-26', '8753767', '1549', 2999.99, 'camera.jpeg'),
(9, 'Nest-Learning Thermostat', 1, '2015-04-28', '6913825', 'T200577', 249.99, 'nest.jpg'),
(23, 'Kevo Bluetooth Deadbolt', 1, '2015-04-22', '2841015', '925 KEVO DB 11P', 219.99, 'kwikset.jpeg'),
(24, 'Harmony Ultimate Home', 1, '2015-04-22', '8203175', '915-000237', 349.99, 'remote.jpg'),
(25, 'Protect Smoke and Carbon Monoxide Alarm', 1, '2015-04-12', '7046053', 'S2001BW', 99.99, 'alarm.jpg'),
(26, 'GoPro - HD Hero3', 3, '2015-04-09', '1308096696', '130-01534-000', 576.49, 'gopro.jpg'),
(27, 'Apple TV', 1, '2015-04-25', '4854433', 'MD199LL/A', 69.99, 'appletv.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `electronic_categories`
--

CREATE TABLE `electronic_categories` (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category` varchar(10) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `electronic_categories`
--

INSERT INTO `electronic_categories` (`category_id`, `category`) VALUES
(1, 'home'),
(2, 'office'),
(3, 'go');

-- --------------------------------------------------------

--
-- Table structure for table `furnitures`
--

CREATE TABLE `furnitures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product` varchar(100) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `material` varchar(200) NOT NULL,
  `category` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `furnitures`
--

INSERT INTO `furnitures` (`id`, `product`, `brand`, `material`, `category`, `price`, `image`) VALUES
(10, 'Leather Office Desk Chair', 'Stock Program', 'Leather', 2, 719.99, 'redchair.jpg'),
(11, 'Bed with Upholstered Headboard', 'Baxton Studio', 'Linen Upholstery', 1, 599.99, 'grybed.jpg'),
(12, 'Executive Desk', 'Sauder Avenue Eight', 'Wind Oak', 2, 589.99, 'blkdesk.jpg'),
(13, ' High-Back Mesh Executive Chair', 'Borgo Xten', 'Back shell material/Die cast aluminum', 2, 2229.99, 'bredchair.jpg'),
(14, 'Brook Street Tufted Sofa', 'Ralph Lauren', 'Leather', 1, 22560.00, 'blkcouch.jpg'),
(15, 'Modern Hollywood Dresser', 'Ralph Lauren', 'Mahogany', 1, 12495.00, 'reddresser.jpg'),
(16, 'Leeward Drawer Chest', 'Bloomingdale''s', 'Gmelina ', 1, 3604.99, 'dresser.jpg'),
(17, 'Fabric Task Chair', 'Mainstays', 'Fabric upholstery', 2, 19.82, 'blkchair.jpg'),
(18, 'Duke Pedestal Dining Table ', 'Ralph Lauren', 'Rosewood', 1, 17984.99, 'redtable.jpg'),
(19, 'Brook Street Desk', 'Ralph Lauren', 'Mahogany', 2, 11924.99, 'blkdesk2.jpg'),
(20, 'Swivel Bar Stool', 'Mainstays ', 'Metal with black finish', 1, 74.99, 'blkstool.jpg'),
(21, 'Wall Bookcase', 'A & E Kamran', 'American hardwood ', 1, 3007.99, 'bookcase.jpg'),
(22, 'Grandover Home Theater', 'Hooker Furniture', 'Golden Madrone Burl, Walnut, Cherry, Maple and Birch', 1, 9659.99, 'center.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `furniture_categories`
--

CREATE TABLE `furniture_categories` (
  `category_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `furniture_categories`
--

INSERT INTO `furniture_categories` (`category_id`, `category`) VALUES
(1, 'home'),
(2, 'office');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturer_id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `hq` varchar(25) NOT NULL,
  `website` varchar(20) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `name`, `hq`, `website`) VALUES
(1, 'Apple inc.', 'Cupertino, CA', 'apple.com'),
(2, 'Nikon', 'Chiydoa, Tokyo', 'nikon.com'),
(3, 'Logitech ', 'Newark, CA', 'logitech.com'),
(4, 'Samsung', 'Seoul, South Korea ', 'samsung.com'),
(5, 'David Golding ', 'Hoboken, New Jersey', 'golding.net');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `role`) VALUES
(1, 'Admin', 'Super', 'admin', 'password', 1),
(2, 'Kevin', 'Smith', 'guest', 'password', 2),
(24, 'Pablo', 'Escobar', 'pesco', 'coco', 2),
(25, 'bob', 'smith', 'bs', 'bs', 2),
(26, 'bob', 'lopez', 'bl', 'bl', 2),
(27, 'Francisco', 'Noriega', 'fnoriega23', 'my pets name was tob', 2),
(28, 'A', 'R', 'alfre', '11220102', 2),
(29, 'vincent', 'medina', 'vrm215', '', 2),
(30, '', '', '', '', 2),
(31, '', 'test', 'tetet', 'etetet', 2),
(32, 'Jack', 'ofalltrades', 'jackof', 'jackof', 2);
