-- phpMyAdmin SQL Dump
-- version 3.1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2009 at 09:19 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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
  `Module` enum('Skyrates','Skybug','Webskyte','Skydevs') NOT NULL default 'Skyrates',
  `Kind` enum('Bug','Feature') NOT NULL default 'Bug',
  `Status` enum('Posted','Planned','Working','Finished') NOT NULL default 'Posted',
  `Likes` int(11) NOT NULL,
  `Votes` int(11) NOT NULL,
  `Rate` double NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`ID`, `Name`, `Description`, `DateAdded`, `Module`, `Kind`, `Status`, `Likes`, `Votes`, `Rate`) VALUES
(2, 'Split Profit misbehaves', '[[Topic:6007]]', '2009-03-25 00:03:38', 'Skyrates', 'Bug', 'Posted', 10, 15, 0.666666666),
(9, 'Hull upgrades', '[[Topic:6423]]', '2009-03-25 01:02:26', 'Skyrates', 'Feature', 'Posted', 53, 59, 0.898305084),
(8, 'Fix firepower.', '[[Topic:6403]]', '2009-03-25 00:55:55', 'Skyrates', 'Feature', 'Posted', 20, 30, 0.666666666),
(11, 'Avatar Customization', 'Custom outfits, please', '2009-03-25 01:11:06', 'Webskyte', 'Feature', 'Posted', 24, 40, 0.6),
(7, 'Extra escape characters', 'Names with apostrophes get an extra \\\\.', '2009-03-25 00:54:36', 'Webskyte', 'Bug', 'Posted', 7, 18, 0.388888888),
(90, 'Keep sorting', 'Sorting goes away when I vote on an issue. It&#39;d be helpful if it stayed in place don&#39;tcha&#39; think?', '2009-04-08 20:19:54', 'Skybug', 'Bug', 'Posted', 1, 1, 1),
(89, 'Skybug moderation interface', 'So the Devs can clear bugs they&#39;ve finished.', '2009-04-08 12:39:06', 'Skybug', 'Feature', 'Posted', 1, 1, 1),
(70, 'Mission cargo not clearing in queue', '[[Topic:6166]] ', '2009-04-07 11:26:10', 'Skyrates', 'Bug', 'Posted', 8, 9, 0.888888888),
(17, 'Skybug authentication', 'Limit votes to one per user per issue', '2009-03-25 02:40:16', 'Skybug', 'Feature', 'Posted', 202, 210, 0.961904761),
(18, 'Integrate influence game', 'Unlikely: see [[Post:65573]]', '2009-03-25 03:33:56', 'Skyrates', 'Feature', 'Posted', 10, 25, 0.4),
(69, 'Off-center blackout', '[[Topic:5964]]', '2009-04-07 11:24:52', 'Skyrates', 'Bug', 'Posted', 5, 7, 0.714285714),
(65, 'Moving Skylands', 'Skylands that drift across the sky...', '2009-04-06 22:00:57', 'Skyrates', 'Feature', 'Posted', 14, 21, 0.666666666),
(22, 'Armor and DR', 'Reconfigure armor and DR so that we can see all our armor.', '2009-03-25 08:46:39', 'Skyrates', 'Feature', 'Posted', 33, 36, 0.916666666),
(25, 'Bug status column', 'See if anybody''s working on it. (Likely would update slow.)', '2009-03-25 12:08:01', 'Skybug', 'Feature', 'Posted', 8, 13, 0.615384615),
(51, 'Rebalance Gun Types', 'Make all the \\&#34;good\\&#34; guns more balanced overall, AC useful', '2009-03-26 00:49:17', 'Skyrates', 'Feature', 'Posted', 15, 21, 0.714285714),
(58, 'Engine Upgrades', 'Yes the devs have said that hull mods are first, but I want to go faster', '2009-03-30 12:08:26', 'Skyrates', 'Feature', 'Posted', 13, 15, 0.866666666),
(50, 'Inger Combat AI', 'Remove the ADHD subroutine that makes AI ingers start chasing shiny things plz', '2009-03-25 21:55:23', 'Skyrates', 'Feature', 'Posted', 11, 15, 0.733333333),
(52, 'Lose the validation button', 'down the bottom there.', '2009-03-26 08:26:26', 'Skybug', 'Feature', 'Posted', 6, 13, 0.461538461),
(53, 'Remove Mission Resetting', 'Make mission reset dependent on a timer, rather than on a round-trip, so fast planes aren\\&#39;t overpowered.', '2009-03-26 14:59:33', 'Skyrates', 'Feature', 'Posted', 16, 25, 0.64),
(54, 'Improve Captain Remy\\&#39;s', 'Captain Remy\\&#39;s Craze is all-around worse than the Flawless/Unparalleled/Perfect Record Line', '2009-03-26 17:55:46', 'Skyrates', 'Feature', 'Posted', 23, 33, 0.696969696),
(67, 'Invisible arcs', '[[Topic:5679]]', '2009-04-07 11:22:52', 'Skyrates', 'Bug', 'Posted', 5, 5, 1),
(68, ' Shift-key mind control', '[[Topic:5766]]', '2009-04-07 11:23:23', 'Skyrates', 'Bug', 'Posted', 3, 6, 0.5),
(56, 'Add the contest winners', 'Add those planes that won the design contest. I want to fly a Gibraltar, golram it!\r\n[[Topic:4065]]', '2009-03-26 23:59:53', 'Skyrates', 'Feature', 'Posted', 25, 32, 0.78125),
(57, 'Timed Missions based on Levels', 'Have Timed Missions based on levels rather than number of downed planes.', '2009-03-27 12:41:29', 'Skyrates', 'Feature', 'Posted', 12, 19, 0.631578947),
(60, 'Combat Sounds', 'Can we bring back combat sounds?  ', '2009-03-31 15:26:15', 'Skyrates', 'Feature', 'Posted', 6, 11, 0.545454545),
(61, 'Badges', 'Badges? Badges? We need more stinking badges!', '2009-03-31 17:34:38', 'Skyrates', 'Feature', 'Posted', 4, 8, 0.5),
(62, 'New Round', 'Either a round reset or a date we can expect a new round to start', '2009-03-31 19:59:29', 'Skyrates', 'Feature', 'Posted', 7, 15, 0.466666666),
(63, 'Fix the Sky-Economy', 'Borked economy is borked.', '2009-03-31 21:16:20', 'Skyrates', 'Feature', 'Posted', 10, 11, 0.909090909),
(64, 'Hangars, please!', 'Allowing us to hold onto more than one plane would be highly appreciated', '2009-03-31 21:19:27', 'Skyrates', 'Feature', 'Posted', 12, 17, 0.705882352),
(71, 'Better trade insurance', '[[Post:61377]]', '2009-04-07 11:27:06', 'Skyrates', 'Bug', 'Posted', 5, 6, 0.833333333),
(72, 'Remove 150 log cap', '[[Post:39612]]\r\n', '2009-04-07 11:27:58', 'Webskyte', 'Bug', 'Posted', 6, 7, 0.857142857),
(73, 'Special combats ', '[[Post:57413]]', '2009-04-07 11:31:30', 'Skyrates', 'Feature', 'Posted', 4, 6, 0.666666666),
(74, ' Better fuel/divert management', '[[Topic:5701]]', '2009-04-07 11:34:13', 'Skyrates', 'Feature', 'Posted', 7, 8, 0.875),
(75, 'Rebalance Missions', '[[Topic:6522]]', '2009-04-07 11:35:11', 'Skyrates', 'Feature', 'Posted', 9, 10, 0.9),
(76, 'Fix CPU/memory burn', '[[Topic:6646]]', '2009-04-07 11:35:40', 'Skyrates', 'Feature', 'Posted', 11, 12, 0.916666666),
(77, 'Rebalance silhouette', '[[Topic:6220]]', '2009-04-07 11:37:28', 'Skyrates', 'Feature', 'Posted', 5, 7, 0.714285714),
(78, 'Better gun mod management', '[[Topic:6091]] ', '2009-04-07 11:37:50', 'Skyrates', 'Feature', 'Posted', 3, 7, 0.428571428),
(79, 'Fix too-close combat starts', '[[Topic:6106]]', '2009-04-07 11:38:22', 'Skyrates', 'Feature', 'Posted', 6, 10, 0.6),
(80, 'Autoresolver reliability ', '[[Post:40492]]', '2009-04-07 11:38:50', 'Skyrates', 'Bug', 'Posted', 10, 10, 1),
(81, 'Combat infamy scarier ', '[[Topic:5659]]', '2009-04-07 11:39:08', 'Skyrates', 'Feature', 'Posted', 2, 6, 0.333333333),
(82, 'High-level combats more challenging/rewarding', '[[Topic:5925]]', '2009-04-07 11:39:46', 'Skyrates', 'Feature', 'Posted', 4, 6, 0.666666666),
(83, 'Better alert sound system', '[[Post:44432]]', '2009-04-07 11:40:06', 'Skyrates', 'Feature', 'Posted', 5, 7, 0.714285714),
(84, 'Double-click &#34;Get the Works&#34;', '[[Topic:6402]]', '2009-04-07 11:40:24', 'Skyrates', 'Feature', 'Posted', 7, 8, 0.875),
(85, ' Incorporate and accept volunteer help', '[[Topic:4740]]', '2009-04-07 11:40:43', 'Skydevs', 'Feature', 'Posted', 7, 9, 0.777777777),
(86, 'More RP support', '[[Topic:6483]]', '2009-04-07 11:41:04', 'Skydevs', 'Feature', 'Posted', 10, 10, 1),
(87, 'Player moderators', '[[Topic:6455]]', '2009-04-07 11:41:40', 'Skydevs', 'Feature', 'Posted', 7, 10, 0.7),
(88, 'Automated delete/rename request ', '[[Topic:5958]]', '2009-04-07 11:42:16', 'Webskyte', 'Feature', 'Posted', 6, 8, 0.75),
(91, 'Make FS forums more accessable', 'Flight school forums are hidden if you&#39;re not logged in', '2009-04-08 21:27:04', 'Webskyte', 'Feature', 'Posted', 2, 2, 1),
(92, 'Fix patrol levels', 'It&#39;d be nice to have patrols be in line with the combats surrounding a skyland.', '2009-04-09 11:53:59', 'Skyrates', 'Bug', 'Posted', 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `User` char(43) NOT NULL,
  `Bug` int(11) NOT NULL,
  `Vote` enum('up','down') NOT NULL,
  PRIMARY KEY  (`User`,`Bug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--


