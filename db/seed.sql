SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admins` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `emailist` (
  `userid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `promotional` tinyint(1) DEFAULT NULL,
  `sponsored` tinyint(1) DEFAULT NULL,
  `new_listings` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `listingphotos` (
  `listingid` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
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

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `reports` (
  `listingid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_phone_verified` tinyint(1) DEFAULT NULL,
  `is_email_verified` tinyint(1) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `emailist`
  ADD PRIMARY KEY (`userid`,`email`);

ALTER TABLE `listingphotos`
  ADD KEY `listingid` (`listingid`);

ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `listing_id` (`listing_id`);

ALTER TABLE `reports`
  ADD PRIMARY KEY (`listingid`,`userid`,`timestamp`),
  ADD KEY `userid` (`userid`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `emailist`
  ADD CONSTRAINT `emailist_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

ALTER TABLE `listingphotos`
  ADD CONSTRAINT `listingphotos_ibfk_1` FOREIGN KEY (`listingid`) REFERENCES `listings` (`id`);

ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`);

ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`listingid`) REFERENCES `listings` (`id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
