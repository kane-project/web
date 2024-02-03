SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admins` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `emailist` (
  `userid` varchar(36) NOT NULL,
  `email` varchar(255) NOT NULL,
  `promotional` tinyint(1) DEFAULT NULL,
  `sponsored` tinyint(1) DEFAULT NULL,
  `new_listings` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `listingphotos` (
  `listingid` varchar(36) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `listings` (
  `id` varchar(36) NOT NULL,
  `userid` varchar(36) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rental_type` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `num_beds` int(11) DEFAULT NULL,
  `num_baths` int(11) DEFAULT NULL,
  `is_furnished` tinyint(1) DEFAULT NULL,
  `allows_pets` tinyint(1) DEFAULT NULL,
  `has_parking` tinyint(1) DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `sponsored_tier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `listing_reports` (
  `listingid` varchar(36) NOT NULL,
  `userid` varchar(36) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `messages` (
  `message_id` varchar(36) NOT NULL,
  `sender_id` varchar(36) DEFAULT NULL,
  `receiver_id` varchar(36) DEFAULT NULL,
  `listing_id` varchar(36) DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_email_verified` tinyint(1) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user_reports` (
  `report_id` varchar(36) NOT NULL,
  `reporter_id` varchar(36) DEFAULT NULL,
  `reported_user_id` varchar(36) DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
