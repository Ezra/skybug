-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: sql212.byethost18.com
-- Generation Time: Mar 27, 2009 at 12:59 AM
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
  `Module` enum('Skyrates','Skybug') NOT NULL default 'Skyrates',
  `Kind` char(1) NOT NULL default 'B',
  `Status` enum('Posted','Planned','Working','Finished') NOT NULL default 'Posted',
  `Likes` int(11) NOT NULL,
  `Votes` int(11) NOT NULL,
  `Rate` double NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`ID`, `Name`, `Description`, `DateAdded`, `Module`, `Kind`, `Status`, `Likes`, `Votes`, `Rate`) VALUES
(2, 'Split Profit misbehaves', '[[Topic:6007]]', '2009-03-25 00:03:38', 'Skyrates', 'B', 'Posted', 3, 7, 0.428571428),
(9, 'Hull upgrades', '[[Topic:6423]]', '2009-03-25 01:02:26', 'Skyrates', 'F', 'Posted', 27, 33, 0.818181818),
(8, 'Fix firepower.', '[[Topic:6403]]', '2009-03-25 00:55:55', 'Skyrates', 'F', 'Posted', 9, 15, 0.6),
(11, 'Avatar Customization', 'Custom outfits, please', '2009-03-25 01:11:06', 'Skyrates', 'F', 'Posted', 11, 17, 0.647058823),
(7, 'Extra escape characters', 'Names with apostrophes get an extra \\\\.', '2009-03-25 00:54:36', 'Skyrates', 'B', 'Posted', 2, 7, 0.285714285),
(10, 'Gun Upgrades', 'Gun purchased at Skylands not installed on plane.', '2009-03-25 01:08:55', 'Skyrates', 'B', 'Posted', 13, 21, 0.619047619),
(12, 'Skybug stylesheet', 'Make Skybug pretty', '2009-03-25 01:21:26', 'Skybug', 'F', 'Posted', 5, 13, 0.384615384),
(13, 'Skybug filter on kind', 'See only bugs / See only features', '2009-03-25 01:22:06', 'Skybug', 'F', 'Posted', 6, 8, 0.75),
(49, 'Do Devs see me?', 'Convince me that anything I post here will ever been seen or considered as valuable input to a Dev.', '2009-03-25 17:08:59', 'Skyrates', 'F', 'Posted', 53, 66, 0.803030303),
(17, 'Skybug authentication', 'Limit votes to one per user per issue', '2009-03-25 02:40:16', 'Skybug', 'F', 'Posted', 13, 20, 0.65),
(18, 'Integrate influence game', 'Unlikely: see [[Post:65573]]', '2009-03-25 03:33:56', 'Skyrates', 'F', 'Posted', 6, 14, 0.428571428),
(19, 'Wilson confidence', 'http://www.evanmiller.org/how-not-to-sort-by-average-rating.html', '2009-03-25 07:13:44', 'Skybug', 'F', 'Posted', 11, 14, 0.785714285),
(20, 'Bayesian rating', 'http://www.thebroth.com/blog/118/bayesian-rating', '2009-03-25 07:14:02', 'Skybug', 'F', 'Posted', 9, 12, 0.75),
(22, 'Armor and DR', 'Reconfigure armor and DR so that we can see all our armor.', '2009-03-25 08:46:39', 'Skyrates', 'F', 'Posted', 16, 18, 0.888888888),
(25, 'Bug status column', 'See if anybody''s working on it. (Likely would update slow.)', '2009-03-25 12:08:01', 'Skybug', 'F', 'Posted', 5, 6, 0.833333333),
(51, 'Rebalance Gun Types', 'Make all the \\&#34;good\\&#34; guns more balanced overall, AC useful', '2009-03-26 00:49:17', 'Skyrates', 'F', 'Posted', 4, 6, 0.666666666),
(27, 'Skybug Instructions', 'Might keep people from accidentally screwing everything up.', '2009-03-25 12:13:41', 'Skybug', 'F', 'Posted', 6, 8, 0.75),
(50, 'Inger Combat AI', 'Remove the ADHD subroutine that makes AI ingers start chasing shiny things plz', '2009-03-25 21:55:23', 'Skyrates', 'F', 'Posted', 6, 8, 0.75),
(52, 'Lose the validation button', 'down the bottom there.', '2009-03-26 08:26:26', 'Skybug', 'F', 'Posted', 2, 3, 0.666666666),
(53, 'Remove Mission Resetting', 'Make mission reset dependent on a timer, rather than on a round-trip, so fast planes aren\\&#39;t overpowered.', '2009-03-26 14:59:33', 'Skyrates', 'F', 'Posted', 1, 4, 0.25),
(54, 'Improve Captain Remy\\&#39;s', 'Captain Remy\\&#39;s Craze is losable, and has a much lower Inf/Plane and Money/Plane than the Flawless/Unparalleled/Perfect Record Line', '2009-03-26 17:55:46', 'Skyrates', 'F', 'Posted', 4, 4, 1);

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

