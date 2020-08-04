-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2020 at 03:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender_username` varchar(30) NOT NULL,
  `receiver_username` varchar(30) NOT NULL,
  `msg_content` varchar(1000) NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender_username`, `receiver_username`, `msg_content`, `msg_date`) VALUES
(366, 'nvalek3@vk.com', 'jeff@foo.onmicrosoft.com', 'hi', '2020-06-21 10:19:18'),
(367, 'nvalek3@vk.com', 'jeff@foo.onmicrosoft.com', 'hello', '2020-06-21 10:19:34'),
(368, 'nvalek3@vk.com', 'jeff@foo.onmicrosoft.com', 'ho ho ho ho', '2020-06-21 10:19:50'),
(376, 'nvalek3@vk.com', 'jeff@foo.onmicrosoft.com', 'hi hi hi hi', '2020-06-21 10:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_profile` varchar(50) NOT NULL,
  `user_fname` varchar(15) NOT NULL,
  `user_lname` varchar(15) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_birthday` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_pswd` varchar(100) NOT NULL,
  `user_question` varchar(100) NOT NULL,
  `user_answer` varchar(100) NOT NULL,
  `user_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_profile`, `user_fname`, `user_lname`, `user_gender`, `user_birthday`, `user_email`, `user_phone`, `user_pswd`, `user_question`, `user_answer`, `user_status`) VALUES
(42, '../assets/images/4m.png', 'Beth', 'Jeff', 'male', '01-04-1887', 'jeff@foo.onmicrosoft.com', '9874563012', '$2y$10$zLgi8eHYiBxgZaoB6kmsyuvoQKayOkdSkrNJC/jniysV92B6R7MgG', 'what was the name of your childhood friend ?', 'ben', 'Offline'),
(43, '../assets/images/1m.png', 'John', 'Fabrikam', 'male', '12-07-1988', 'john@fabrikam.com', '8874563214', '$2y$10$dPM0tgfXpxNCjUH5YBLUd.IkiM8IUuFvSg21i.rKO.2OYyKrzGbvK', 'what was your first phone number ?', '1234567891', 'Offline'),
(44, '../assets/images/2m.png', 'Bob', 'Doe', 'male', '25-05-1985', 'bobdoe@outlook.com', '9774563214', '$2y$10$XapqL.xlQmzI4Gzl1rndxevFrYiEAuPNuIG9O8RoUSTkpBUjkCD8q', 'what was the name of your first school ?', 'xavier', 'Offline'),
(45, '../assets/images/5m.png', 'racks', 'jacson', 'male', '14-12-1974', 'racks.jacson@learningcontainer.com', '9874500214', '$2y$10$5vYF0btQkKq8Ua3/kA.IB.BtrDg0Puvz9UdQx64voUywjidzKbFTy', 'what was your first phone number ?', '1234567891', 'Offline'),
(46, '../assets/images/6m.png', 'denial', 'roast', 'other', '25-03-1982', 'denial.roast@outlook.com', '9874500233', '$2y$10$cAkcxHB8kvd/j6rgEkduyuCbuZT1sFDSN0NHUZ1wDbiV/Hw10ff3a', 'what was your first phone number ?', '1234567891', 'Offline'),
(47, '../assets/images/7m.png', 'devid', 'neo', 'male', '07-10-1997', 'devid.neo@gmail.com', '9874500212', '$2y$10$GQbId8D5xbC/KODXPb0AdekpZ8Om7Y5CoO1iweycttsdb.mcgw/Tq', 'what was your first phone number ?', '1234567891', ''),
(48, '../assets/images/9m.png', 'jone', 'mac', 'male', '13-06-1999', 'jone.mac@yahoo.com', '9834500212', '$2y$10$Ke/.9fN5tMEoxbRwkJFIZ.2U2Jw3B9OzPmvEo3vVY.LmXpcG3nJBO', 'what was the name of your childhood friend ?', 'joy', ''),
(49, '../assets/images/3m.png', 'Devid', 'Rome', 'other', '08-11-1996', 'devid.rome@learningcontainer.com', '8674563214', '$2y$10$JpeYigP7BBBeS7k3dvnOueJN4vD5PeKO8.doSzfGo9gfce0WYwobm', 'what was the name of your childhood friend ?', 'lisa', ''),
(50, '../assets/images/8m.png', 'krish', 'lee', 'male', '23-08-1982', 'krish.lee@gmail.com', '9874500210', '$2y$10$BziENPYf5yMYtBThhZcxdOP4vtPDh0TrlyO8nq0cGBjCfugF2Fcx.', 'what was the name of your first school ?', 'horizon', ''),
(51, '../assets/images/10m.png', 'tin', 'jonson', 'male', '20-09-1997', 'tin.jonson@outlook.com', '8574500212', '$2y$10$fkWmLgRv.LLrN5gIW/Peku0xhwJoN6e3zL9l/hFSFLVSHy6YY/mom', 'what was the name of your childhood friend ?', 'ben', ''),
(52, '../assets/images/1f.png', 'nara', 'simha', 'female', '04-12-1983', 'narasimha@yahoo.com', '8544500212', '$2y$10$Yz3nDa2Xx7YTpR2diqsSLOS2TvH1mvtr2FXDHfnz8wcGfsipoP8Zm', 'what was the name of your childhood friend ?', 'jimmy', 'Offline'),
(53, '../assets/images/2f.png', 'anna', 'doe', 'female', '17-02-1992', 'annadoe01@gmail.com', '9874563212', '$2y$10$MR6r4EW7kIkXKlUH7Re5ROjpzrdvKpsWI6bVGEm7EFdd7ikfpahuW', 'what was your first phone number ?', '1234567891', ''),
(54, '../assets/images/3f.png', 'Jeanette', 'roast', 'female', '01-06-2001', 'jroast01@census.gov', '8544500203', '$2y$10$Pn1uc.GcY8LNG69f8Ml2D.ZkkLzEzmDCKUuk2EAtrJAAZrlTR8tiu', 'what was the name of your childhood friend ?', 'roy', ''),
(55, '../assets/images/4f.png', 'Noell', 'doe', 'female', '19-01-2002', 'ndoe01@imageshack.us', '8544500218', '$2y$10$9iv66R405Gdrgnmd1f1tseITt1ufJxIR.DXrqCc6m1.M8h9cehUO.', 'what was your first phone number ?', '1234567891', 'Offline'),
(56, '../assets/images/5f.png', 'nara', 'valek', 'female', '30-05-2000', 'nvalek3@vk.com', '7544500212', '$2y$10$iitWR4sJw6h4XSXxWyKqD.MwXSQyruVRoH/UCC3UcV2FJjF/y6QFi', 'what was the name of your first school ?', 'horizon', 'Offline'),
(57, '../assets/images/6f.png', 'Noell', 'bea', 'female', '04-09-1999', 'nbea2@imageshack.us', '7544500858', '$2y$10$6P8HyWU1efQDd9YiKO/0puW0Jqk/x53tn5U0/whySWp3pfHru/yge', 'what was the name of your childhood friend ?', 'bob', ''),
(58, '../assets/images/7f.png', 'Logan', 'Keller', 'female', '29-02-2000', 'logankeller@artiq.com', '8544500212', '$2y$10$S9l5VHkROYLutKCyEQDMfO9luWvfFHZzD8Cu9DXwtM1IE5F.GsaoC', 'what was your first phone number ?', '1234567891', 'Offline'),
(59, '../assets/images/8f.png', 'Martina', 'jonson', 'female', '06-11-2000', 'mjonson@outlook.com', '7544500212', '$2y$10$lUDPe9QI/3lrG8HwHuDk8u4WoJQ0YqvYnjyIbbRjGKq3Li9xZzQKG', 'what was your first phone number ?', '1234567891', ''),
(60, '../assets/images/9f.png', 'Giavani', 'bea', 'other', '03-12-1976', 'gbea02@imageshack.us', '9874563214', '$2y$10$r2UeKf1CWz212x7u7C8YB.OE9zrPpvaDga385A9.uJcm91SdDC8ja', 'what was the name of your childhood friend ?', 'anna', 'Offline'),
(61, '../assets/images/10f.png', 'Jeanette', 'Penddreth', 'other', '04-05-1999', 'jpenddreth0@census.gov', '9874568845', '$2y$10$pTLUUepxqY6gpHaon30IkO9hZgi4TYb.KaYFtUKBAyxIOqW9SoMdK', 'what was your first phone number ?', '1234567891', ''),
(62, '../assets/images/3f.png', 'abc', 'lmn', 'other', '01-02-1789', 'abclmn@gmail.com', '9874563214', '$2y$10$rAbA0JZNd8Iyu3kznuHwNO3qrj4UN9qNNuxLQOmVTOkGksFJMMZnW', 'what is your dream job ?', 'programmer', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=395;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
