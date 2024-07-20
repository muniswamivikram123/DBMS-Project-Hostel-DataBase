SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryid` varchar(30) NOT NULL,
  `categoryname` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryid`, `categoryname`) VALUES
('sddsfc', 'fsfdv'),
('hek123', 'hello'),
('rg44', 'rtgre');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customerid` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contactnumber` int DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`customerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `name`, `contactnumber`, `email`) VALUES
('c01', 'vikramm', 21978673, 'vikrammithun@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employeeid` varchar(30) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `position` varchar(10) DEFAULT NULL,
  `contactnumber` int DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`employeeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeid`, `firstname`, `lastname`, `position`, `contactnumber`, `email`) VALUES
('h01', 'rakshi', 'd', 'senior', 78676528, 'student@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jewelry`
--

DROP TABLE IF EXISTS `jewelry`;
CREATE TABLE IF NOT EXISTS `jewelry` (
  `jewelryid` varchar(30) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `material` varchar(30) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `categoryid` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`jewelryid`),
  CONSTRAINT `fk_categoryid` FOREIGN KEY (`categoryid`) REFERENCES `categories`(`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jewelry`
--

INSERT INTO `jewelry` (`jewelryid`, `name`, `material`, `weight`, `price`, `categoryid`) VALUES
('j01', 'necklece', 'gold', '250g', 30000, 'sddsfc'),
('j02', 'ring', 'silver', '20g', 5000, 'hek123'),
('j03', 'earrings', 'diamond', '10g', 10000, 'rg44'),
('j04', 'bracelet', 'platinum', '30g', 15000, 'sddsfc'),
('j05', 'pendant', 'gold', '15g', 7000, 'hek123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` varchar(50) NOT NULL,
  `customerid` varchar(30) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `totalamount` int DEFAULT NULL,
  `employeeid` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`orderid`),
  CONSTRAINT `fk_customerid` FOREIGN KEY (`customerid`) REFERENCES `customers`(`customerid`),
  CONSTRAINT `fk_employeeid` FOREIGN KEY (`employeeid`) REFERENCES `employees`(`employeeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customerid`, `date`, `totalamount`, `employeeid`) VALUES
('o01', 'c01', '2024-03-06', 45645, 'h01'),
('o02', 'c01', '2024-03-07', 50000, 'h01'),
('o03', 'c01', '2024-03-08', 30000, 'h01'),
('o04', 'c01', '2024-03-09', 25000, 'h01'),
('o05', 'c01', '2024-03-10', 35000, 'h01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` varchar(50) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `phone` int DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `phone`, `email`, `usertype`, `password`) VALUES
('3', 'admin', 2098787678, 'admin@gmail.com', 'admin', '123456'),
('1', 'customer', 1457755665, 'customer@gmail.com', 'customer', '123456');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
