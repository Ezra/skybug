-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: sql212.byetcluster.com
-- Generation Time: Mar 25, 2009 at 01:44 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6-1+lenny2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b18_3214751_skybug`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `ID` int(11) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `Kind` char(1) NOT NULL default 'B',
  `Status` enum('Posted','Planned','Working','Finished') NOT NULL,
  `Likes` int(11) NOT NULL,
  `Votes` int(11) NOT NULL,
  `Difference` int(11) NOT NULL,
  `Rate` double NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`ID`, `Name`, `Description`, `DateAdded`, `Kind`, `Status`, `Likes`, `Votes`, `Difference`, `Rate`) VALUES
(2, 'Split Profit misbehaves', 'http://skyrates.net/forum/viewtopic.php?t=6007', '2009-03-25 00:03:38', 'B', 'Posted', 1, 2, 0, 0.5),
(9, 'Hull upgrades', 'http://skyrates.net/forum/viewtopic.php?t=6423', '2009-03-25 01:02:26', 'F', 'Posted', 8, 10, 6, 0.8),
(8, 'Fix firepower.', 'http://skyrates.net/forum/viewtopic.php?t=6403', '2009-03-25 00:55:55', 'F', 'Posted', 3, 3, 3, 1),
(11, 'Avatar Customization', 'Custom outfits, please', '2009-03-25 01:11:06', 'F', 'Posted', 1, 3, -1, 0.333333333),
(7, 'Extra escape characters', 'Names with apostrophes get an extra \\\\.', '2009-03-25 00:54:36', 'B', 'Posted', 1, 2, 0, 0.5),
(10, 'Gun Upgrades', 'Gun purchased at Skylands not installed on plane.', '2009-03-25 01:08:55', 'B', 'Posted', 1, 2, 0, 0.5),
(12, 'Skybug stylesheet', 'Make Skybug pretty', '2009-03-25 01:21:26', 'S', 'Posted', 0, 2, -2, 0),
(13, 'Skybug filter on kind', 'See only bugs / See only features', '2009-03-25 01:22:06', 'S', 'Posted', 0, 2, -2, 0),
(14, 'Separate high/low priority votes', 'http://skyrates.net/forum/viewtopic.php?p=65799#65799', '2009-03-25 01:26:21', 'S', 'Posted', 2, 2, 2, 1),
(15, 'Skybug forum links', 'Skybug automatically link to forum posts, threads', '2009-03-25 01:40:15', 'S', 'Posted', 2, 4, 0, 0.5),
(16, 'Skybug Kind color-coding', 'Color-code what kind of report it is.', '2009-03-25 01:46:52', 'S', 'Posted', 1, 2, 0, 0.5),
(17, 'repeat voting on skybug', 'Can vote unlimited number of times in any given period of time.', '2009-03-25 02:40:16', 'S', 'Posted', 1, 3, -1, 0.333333333),
(18, 'Influence affects Skytopia', 'Make influence have some effect on the game besides the little colored flag.', '2009-03-25 03:33:56', 'F', 'Posted', 3, 5, 1, 0.6),
(19, 'Wilson confidence', 'http://www.evanmiller.org/how-not-to-sort-by-average-rating.html', '2009-03-25 07:13:44', 'S', 'Posted', 3, 4, 2, 0.75),
(20, 'Bayesian rating', 'http://www.thebroth.com/blog/118/bayesian-rating', '2009-03-25 07:14:02', 'S', 'Posted', 1, 2, 0, 0.5),
(22, 'Armor Numbers', 'The little plus sign after the armor should be a number.', '2009-03-25 08:46:39', 'F', 'Posted', 3, 3, 3, 1),
(23, 'Skyrates is Addictive', 'I should go play outside', '2009-03-25 09:19:41', 'F', 'Posted', 2, 2, 2, 1),
(24, 'Monster Trucks', 'Vrrroom vrooooommmm!', '2009-03-25 09:39:30', 'F', 'Posted', 2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `User` varchar(32) NOT NULL,
  `Bug` int(11) NOT NULL,
  `Vote` enum('+','-') NOT NULL,
  PRIMARY KEY  (`User`,`Bug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

