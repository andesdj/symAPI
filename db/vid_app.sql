-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.34-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5282
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para videos_app
CREATE DATABASE IF NOT EXISTS `videos_app` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `videos_app`;

-- Volcando estructura para tabla videos_app.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_video` (`video_id`),
  KEY `fk_comments_user` (`user_id`),
  CONSTRAINT `FK_5F9E962A29C1004E` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla videos_app.comments: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT IGNORE INTO `comments` (`id`, `video_id`, `user_id`, `body`, `created_at`) VALUES
	(1, 1, 1, 'Comentario para el Video 1', '2018-07-31 04:14:56'),
	(2, 3, 1, 'ID 2 es el Comentario para el Video 3', '2018-07-31 04:15:01'),
	(3, 1, 1, 'Comentario para el Video 1', '2018-07-31 04:15:05');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Volcando estructura para tabla videos_app.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla videos_app.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `roles`, `name`, `surname`, `email`, `password`, `image`, `created_at`) VALUES
	(1, 'user', 'Andres', 'Montealegre ', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1533002980.jpeg', '2018-07-31 04:08:52');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla videos_app.videos
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_videos_users` (`user_id`),
  CONSTRAINT `FK_29AA6432A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla videos_app.videos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT IGNORE INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Video 1 ', 'description Video 1 ', NULL, NULL, '1533003230.mp4', '2018-07-31 04:10:53', '2018-07-31 04:10:53'),
	(2, 1, 'Video 2 ', 'description Video 2 ', NULL, NULL, NULL, '2018-07-31 04:11:05', '2018-07-31 04:11:05'),
	(3, 1, 'Video 3 ', 'description Video 3 ', NULL, NULL, NULL, '2018-07-31 04:11:11', '2018-07-31 04:11:11');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
