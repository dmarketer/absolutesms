-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2015 at 07:06 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `absolutesms`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_key`
--

DROP TABLE IF EXISTS `api_key`;
CREATE TABLE IF NOT EXISTS `api_key` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL,
  `user_id` int(10) NOT NULL,
  `allowed_ip` text,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `country_phonecode` varchar(20) NOT NULL,
  `mcc` varchar(20) NOT NULL,
  `mnc` varchar(20) NOT NULL,
  `network_name` varchar(200) NOT NULL,
  `economy_credits` float NOT NULL,
  `standard_credits` float NOT NULL,
  `premium_credits` float NOT NULL,
  `country_name` varchar(200) NOT NULL,
  `country_code` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1242 ;

-- --------------------------------------------------------

--
-- Table structure for table `error_codes`
--

DROP TABLE IF EXISTS `error_codes`;
CREATE TABLE IF NOT EXISTS `error_codes` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `error_code` varchar(11) NOT NULL,
  `error_message` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `from`
--

DROP TABLE IF EXISTS `from`;
CREATE TABLE IF NOT EXISTS `from` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sender_id` varchar(10) DEFAULT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `gateway_error_mapping`
--

DROP TABLE IF EXISTS `gateway_error_mapping`;
CREATE TABLE IF NOT EXISTS `gateway_error_mapping` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `gateway_id` int(9) NOT NULL,
  `error_code_id` varchar(100) NOT NULL,
  `gateway_error_code` varchar(100) NOT NULL,
  `gateway_error_message` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `http_gateway_dlr`
--

DROP TABLE IF EXISTS `http_gateway_dlr`;
CREATE TABLE IF NOT EXISTS `http_gateway_dlr` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `gateway_id` int(9) NOT NULL,
  `delivery_base_url` varchar(200) DEFAULT NULL,
  `uid` varchar(100) DEFAULT NULL,
  `message_id` varchar(100) DEFAULT NULL,
  `delivery_api_required` tinyint(1) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `http_gateway_push`
--

DROP TABLE IF EXISTS `http_gateway_push`;
CREATE TABLE IF NOT EXISTS `http_gateway_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_email` varchar(100) DEFAULT NULL,
  `company_mobile` text,
  `method` varchar(10) DEFAULT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `mobile` text,
  `gateway_credits` int(10) NOT NULL,
  `sender` varchar(10) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `api_key` varchar(200) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `additional_params` varchar(200) DEFAULT NULL,
  `api_required` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

DROP TABLE IF EXISTS `otp`;
CREATE TABLE IF NOT EXISTS `otp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) NOT NULL,
  `sent_date` datetime NOT NULL,
  `verified_date` datetime DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `otp_code` varchar(20) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox1`
--

DROP TABLE IF EXISTS `outbox1`;
CREATE TABLE IF NOT EXISTS `outbox1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `mobile_numbers` text,
  `message` text,
  `gateway_id` int(11) DEFAULT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `dlr_status` varchar(60) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `source` enum('API','WEB','XML') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox2`
--

DROP TABLE IF EXISTS `outbox2`;
CREATE TABLE IF NOT EXISTS `outbox2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `mobile_numbers` text,
  `message` text,
  `gateway_id` int(11) DEFAULT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `dlr_status` varchar(60) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `source` enum('API','WEB','XML') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox3`
--

DROP TABLE IF EXISTS `outbox3`;
CREATE TABLE IF NOT EXISTS `outbox3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `mobile_numbers` text,
  `message` text,
  `gateway_id` int(11) DEFAULT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `dlr_status` varchar(60) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `source` enum('API','WEB','XML') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `sent`
--

DROP TABLE IF EXISTS `sent`;
CREATE TABLE IF NOT EXISTS `sent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mobile_number` text,
  `message` text,
  `gateway_id` int(11) DEFAULT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `dlr_status` varchar(60) DEFAULT NULL,
  `outbox_id` varchar(60) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `source` enum('API','WEB','XML') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `contact_person` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `otp_id` int(10) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `country_code` int(10) DEFAULT NULL,
  `address` text,
  `reference` text,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  `created_at` date NOT NULL,
  `activated_at` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(30) DEFAULT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
