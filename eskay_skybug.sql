-- phpMyAdmin SQL Dump
-- version 3.1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2009 at 10:24 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eskay_skybug`
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
  `Kind` enum('Bug','Feature') NOT NULL default 'Bug',
  `Status` enum('Posted','Planned','Working','Finished') NOT NULL default 'Posted',
  `Likes` int(11) NOT NULL,
  `Votes` int(11) NOT NULL,
  `Rate` double NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`ID`, `Name`, `Description`, `DateAdded`, `Module`, `Kind`, `Status`, `Likes`, `Votes`, `Rate`) VALUES
(2, 'Split Profit misbehaves', '[[Topic:6007]]', '2009-03-25 00:03:38', 'Skyrates', 'Bug', 'Posted', 3, 7, 0.428571428),
(9, 'Hull upgrades', '[[Topic:6423]]', '2009-03-25 01:02:26', 'Skyrates', 'Feature', 'Posted', 27, 33, 0.818181818),
(8, 'Fix firepower.', '[[Topic:6403]]', '2009-03-25 00:55:55', 'Skyrates', 'Feature', 'Posted', 10, 16, 0.625),
(11, 'Avatar Customization', 'Custom outfits, please', '2009-03-25 01:11:06', 'Skyrates', 'Feature', 'Posted', 12, 18, 0.666666666),
(7, 'Extra escape characters', 'Names with apostrophes get an extra \\\\.', '2009-03-25 00:54:36', 'Skyrates', 'Bug', 'Posted', 2, 7, 0.285714285),
(10, 'Gun Upgrades', 'Gun purchased at Skylands not installed on plane.', '2009-03-25 01:08:55', 'Skyrates', 'Bug', 'Posted', 13, 21, 0.619047619),
(12, 'Skybug stylesheet', 'Make Skybug pretty', '2009-03-25 01:21:26', 'Skybug', 'Feature', 'Posted', 5, 13, 0.384615384),
(13, 'Skybug filter on kind', 'See only bugs / See only features', '2009-03-25 01:22:06', 'Skybug', 'Feature', 'Posted', 6, 8, 0.75),
(49, 'Do Devs see me?', 'Convince me that anything I post here will ever been seen or considered as valuable input to a Dev.', '2009-03-25 17:08:59', 'Skyrates', 'Feature', 'Posted', 53, 66, 0.803030303),
(17, 'Skybug authentication', 'Limit votes to one per user per issue', '2009-03-25 02:40:16', 'Skybug', 'Feature', 'Posted', 14, 21, 0.666666666),
(18, 'Integrate influence game', 'Unlikely: see [[Post:65573]]', '2009-03-25 03:33:56', 'Skyrates', 'Feature', 'Posted', 6, 14, 0.428571428),
(19, 'Wilson confidence', 'http://www.evanmiller.org/how-not-to-sort-by-average-rating.html', '2009-03-25 07:13:44', 'Skybug', 'Feature', 'Posted', 11, 14, 0.785714285),
(20, 'Bayesian rating', 'http://www.thebroth.com/blog/118/bayesian-rating', '2009-03-25 07:14:02', 'Skybug', 'Feature', 'Posted', 9, 12, 0.75),
(22, 'Armor and DR', 'Reconfigure armor and DR so that we can see all our armor.', '2009-03-25 08:46:39', 'Skyrates', 'Feature', 'Posted', 17, 19, 0.894736842),
(25, 'Bug status column', 'See if anybody''s working on it. (Likely would update slow.)', '2009-03-25 12:08:01', 'Skybug', 'Feature', 'Posted', 5, 6, 0.833333333),
(51, 'Rebalance Gun Types', 'Make all the \\&#34;good\\&#34; guns more balanced overall, AC useful', '2009-03-26 00:49:17', 'Skyrates', 'Feature', 'Posted', 4, 6, 0.666666666),
(27, 'Skybug Instructions', 'Might keep people from accidentally screwing everything up.', '2009-03-25 12:13:41', 'Skybug', 'Feature', 'Posted', 6, 8, 0.75),
(50, 'Inger Combat AI', 'Remove the ADHD subroutine that makes AI ingers start chasing shiny things plz', '2009-03-25 21:55:23', 'Skyrates', 'Feature', 'Posted', 6, 8, 0.75),
(52, 'Lose the validation button', 'down the bottom there.', '2009-03-26 08:26:26', 'Skybug', 'Feature', 'Posted', 3, 4, 0.75),
(53, 'Remove Mission Resetting', 'Make mission reset dependent on a timer, rather than on a round-trip, so fast planes aren\\&#39;t overpowered.', '2009-03-26 14:59:33', 'Skyrates', 'Feature', 'Posted', 1, 5, 0.2),
(54, 'Improve Captain Remy\\&#39;s', 'Captain Remy\\&#39;s Craze is all-around worse than the Flawless/Unparalleled/Perfect Record Line', '2009-03-26 17:55:46', 'Skyrates', 'Feature', 'Posted', 4, 5, 0.8),
(55, 'Mismatched skill levels', 'Sometimes a skill requires a skill with fewer levels.', '2009-03-26 21:19:35', 'Skyrates', 'Bug', 'Posted', 1, 2, 0.5),
(56, 'Add the contest winners', 'Add those planes that won the design contest. I want to fly a Gibraltar, golram it!\r\n[[Topic:4065]]', '2009-03-26 23:59:53', 'Skyrates', 'Feature', 'Posted', 4, 5, 0.8);

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

