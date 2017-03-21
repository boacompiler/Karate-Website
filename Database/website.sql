-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2017 at 09:12 PM
-- Server version: 5.5.54-0+deb8u1
-- PHP Version: 5.6.29-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `classid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`classid` int(11) NOT NULL,
  `discipline` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  `timeslot` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `discipline`, `name`, `description`, `timeslot`, `teacher`, `price`) VALUES
(1, 1, 'Yoga Class', 'Enjoy yoga with Ruth. Relax and find inner peace as she guides you in the mystic Hindu art of the yogi.', 1, 66, 10),
(2, 2, 'Pilates Class', 'Get fit with Ruth in this rigorous workout. Improve your balance and alleviate lower back pain using the 20th century''s preeminent exercise regime. ', 2, 66, 15),
(3, 3, 'Tae Kwon Do Class', 'Master Chris Madeline guides you on a journey through Korean theories of power.\r\nLearn ITF style, ideal for self defence, children and confidence building.', 3, 68, 15),
(4, 4, 'Dance with David', 'Multi Discipline freeform dance class with David. A little bit of everything, as David introduces the class to all styles of modern dance. focusing on rhythm, choreography and fun, dances introduced are appropriate for all ages and abilities.', 4, 67, 10),
(5, 3, 'Late Night Karate', 'Focusing on self defence and self discipline, late night karate is an adult oriented Karate class. Multi award winning Chris Madeline helms the course, delivering the best possible value for money.', 5, 68, 20);

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE IF NOT EXISTS `discipline` (
`disciplineid` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`disciplineid`, `name`, `description`) VALUES
(1, 'Yoga', 'yoga description'),
(2, 'Pilates', 'Pilates description'),
(3, 'Martial Arts', 'Martial Arts desu'),
(4, 'Dance', 'Dance des');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
`roomid` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `name`) VALUES
(1, 'Gym'),
(2, 'Hall');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE IF NOT EXISTS `timeslot` (
`timeslotid` int(11) NOT NULL,
  `timebegin` time NOT NULL,
  `timeend` time NOT NULL,
  `room` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeslotid`, `timebegin`, `timeend`, `room`) VALUES
(1, '19:15:00', '20:15:00', 1),
(2, '20:30:00', '21:30:00', 1),
(3, '17:00:00', '19:00:00', 1),
(4, '19:15:00', '20:15:00', 2),
(5, '20:30:00', '21:30:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userid` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `namefirst` varchar(32) NOT NULL,
  `namesecond` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `dateofbirth` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `admin`, `namefirst`, `namesecond`, `email`, `password`, `dateofbirth`) VALUES
(64, 0, 'Bobby', 'Tables', 'test@fake.com', 'KYVdODyE7VfF6', '2013-08-27'),
(65, 0, 'Bruce', 'Wayne', 'batman@gotham.com', 'KYVdODyE7VfF6', '2013-05-15'),
(66, 1, 'Ruth', 'Thompson', 'rthompson@ypmd.com', 'KYVdODyE7VfF6', '1980-04-10'),
(67, 1, 'David', 'Thompson', 'dthompson@ypmd.com', 'KYVdODyE7VfF6', '1978-03-08'),
(68, 1, 'Chris', 'Madeline', 'cmadeline@ypmd.com', 'KYVdODyE7VfF6', '1979-08-16'),
(69, 1, 'admin', 'istrator', 'admin@ypmd.com', 'KY39fQpkb1qr.', '2017-03-21'),
(70, 0, 'Fidelma', 'Stephens', 'gengar@cheesy.com', 'KYJvHW0W9Gtuc', '2006-02-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
 ADD PRIMARY KEY (`userid`,`classid`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
 ADD PRIMARY KEY (`disciplineid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
 ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
 ADD PRIMARY KEY (`timeslotid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userid`), ADD UNIQUE KEY `userid` (`userid`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
MODIFY `disciplineid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
MODIFY `roomid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
MODIFY `timeslotid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
