CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `hash_expire` datetime DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
