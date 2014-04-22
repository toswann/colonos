--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `type`, `state`, `id_admin`, `zone`) VALUES
(1, 'rstrauch@laguneclub.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'Ricardo Strauch', 3, 0, 0, 0),
(3, 'user@colonos.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'USER_NAME', 0, 0, 0, 0),
(4, 'admz1@colonos.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'ADMZ1_NAME', 2, 0, 0, 1),
(5, 'mod1@colonos.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'MOD1_NAME', 1, 0, 4, 0);
