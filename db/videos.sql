-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5168
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla videos_app.comments: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Volcando datos para la tabla videos_app.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `roles`, `name`, `surname`, `email`, `password`, `image`, `created_at`) VALUES
	(7, 'user', 'Andes', 'Montealegre', 'andes@gmail.com', '754eb57a10ffe2148f31f48e7badb4e7744c153a610b767376c46ee6c27530b0', '1498076595.png', '2017-06-17 18:39:27');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando datos para la tabla videos_app.videos: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(1, 7, 'Edicion del video ID 12', NULL, NULL, NULL, NULL, '2017-06-22 15:49:06', '2017-06-22 15:49:06');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(2, 7, 'Video de prueba 2', NULL, NULL, '1498675041.png', '1498675431.mp4', '2017-06-21 21:47:58', '2017-06-21 21:47:58');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(3, 7, 'Video 3', 'Video 3 cargado al Bundle Video List', NULL, NULL, NULL, '2017-07-06 16:08:49', '2017-07-06 16:08:49');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(4, 7, 'Video 4', 'Video 4 cargado al Bundle Video List 4', NULL, NULL, NULL, '2017-07-06 16:08:56', '2017-07-06 16:08:56');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(5, 7, 'Video 5 ', 'Video 5 cargado al Bundle Video List 5', NULL, NULL, NULL, '2017-07-06 16:09:02', '2017-07-06 16:09:02');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(6, 7, 'Video 6 ', 'Video 6 cargado al Bundle Video List 6 Listado', NULL, NULL, NULL, '2017-07-06 16:09:14', '2017-07-06 16:09:14');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(7, 7, 'Video 7 ', 'Video 7 cargado al Bundle Video List 7Listado', NULL, NULL, NULL, '2017-07-06 16:09:46', '2017-07-06 16:09:46');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(8, 7, 'Video 8 ', 'Video 8 cargado al Bundle Video List 8Listado', NULL, NULL, NULL, '2017-07-06 16:11:11', '2017-07-06 16:11:11');
INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `status`, `image`, `video_path`, `created_at`, `updated_at`) VALUES
	(9, 7, 'Video Bogota ', 'Video 11 Bogota cargado al Bundle Video List 8Listado', NULL, NULL, NULL, '2017-07-06 18:37:44', '2017-07-06 18:37:44');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
