CREATE DATABASE IF NOT EXISTS mytube;
use mytube;


CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firebase_id` text DEFAULT NULL,
  PRIMARY KEY (`user_id`)
);

CREATE TABLE IF NOT EXISTS `Playlists` (
  `playlist_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`playlist_id`),
  FOREIGN KEY (`creator`) REFERENCES User(`user_id`)
);