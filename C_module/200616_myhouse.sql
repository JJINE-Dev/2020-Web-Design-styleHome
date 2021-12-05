-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-06-16 05:39
-- 서버 버전: 10.4.11-MariaDB
-- PHP 버전: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `200616_myhouse`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `grades`
--

CREATE TABLE `grades` (
  `idx` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `house_idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `houses`
--

CREATE TABLE `houses` (
  `idx` int(11) NOT NULL,
  `before` text NOT NULL,
  `after` text NOT NULL,
  `knowhow` text NOT NULL,
  `user_idx` int(11) NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `houses`
--

INSERT INTO `houses` (`idx`, `before`, `after`, `knowhow`, `user_idx`, `create_at`) VALUES
(3, '1592273434_3123123.PNG', '1592273434_200110_ (1).png', '1', 9, '2020-06-16'),
(4, '1592275071_2.PNG', '1592275071_6.PNG', '책 ', 7, '2020-06-16'),
(5, '1592275097_3333.PNG', '1592275097_3.PNG', '소프트웨어 ', 7, '2020-06-16');

-- --------------------------------------------------------

--
-- 테이블 구조 `req_quotes`
--

CREATE TABLE `req_quotes` (
  `idx` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `req_quotes`
--

INSERT INTO `req_quotes` (`idx`, `content`, `date`, `status`, `user_idx`) VALUES
(5, '1', '2020-06-16', 0, 7),
(6, '1', '2020-06-16', 0, 9);

-- --------------------------------------------------------

--
-- 테이블 구조 `resp_quotes`
--

CREATE TABLE `resp_quotes` (
  `idx` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `req_idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `resp_quotes`
--

INSERT INTO `resp_quotes` (`idx`, `price`, `req_idx`, `user_idx`, `status`) VALUES
(7, 2, 5, 1, 0),
(8, 1, 6, 1, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `reviews`
--

CREATE TABLE `reviews` (
  `idx` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `content` text NOT NULL,
  `grade` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `specia_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `reviews`
--

INSERT INTO `reviews` (`idx`, `price`, `content`, `grade`, `user_idx`, `specia_idx`) VALUES
(1, 1, '1', 1, 7, 1),
(2, 2, '2', 2, 7, 1),
(3, 1, '1', 4, 7, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `idx` int(11) NOT NULL,
  `id` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `specia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`idx`, `id`, `password`, `name`, `img`, `specia`) VALUES
(1, 'specialist1', '1234', '전문가1', 'specialist1.jpg', 1),
(2, 'specialist2', '1234', '전문가2', 'specialist2.jpg', 1),
(3, 'specialist3', '1234', '전문가3', 'specialist3.jpg', 1),
(4, 'specialist4', '1234', '전문가4', 'specialist4.jpg', 1),
(6, '1', '1', '1', '1592272462_houses.php', 0),
(7, '2', '21', '2', '1592272530_specia.php', 0),
(8, '3', '3', '3', '1592272683_index.php', 0),
(9, '4', '4', '4', '1592272789_store.php', 0);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `req_quotes`
--
ALTER TABLE `req_quotes`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `resp_quotes`
--
ALTER TABLE `resp_quotes`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `grades`
--
ALTER TABLE `grades`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `houses`
--
ALTER TABLE `houses`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `req_quotes`
--
ALTER TABLE `req_quotes`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `resp_quotes`
--
ALTER TABLE `resp_quotes`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `reviews`
--
ALTER TABLE `reviews`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
