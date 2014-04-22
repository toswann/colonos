-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 22 Avril 2014 à 13:41
-- Version du serveur: 5.5.29
-- Version de PHP: 5.3.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `colonos`
--

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `code` text NOT NULL,
  `used_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` text NOT NULL,
  `flatname` text NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `city` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `zone` int(11) DEFAULT NULL,
  `phone` text NOT NULL,
  `mail` text NOT NULL,
  `website` text NOT NULL,
  `image` text NOT NULL,
  `galery` text NOT NULL,
  `price` text NOT NULL,
  `description` text NOT NULL,
  `nbvoters` int(11) DEFAULT NULL,
  `averagegrade` decimal(10,2) DEFAULT NULL,
  `certifications` text NOT NULL,
  `species` text NOT NULL,
  `difficulty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`id`, `id_admin`, `state`, `category`, `type`, `name`, `flatname`, `latitude`, `longitude`, `city`, `address`, `zone`, `phone`, `mail`, `website`, `image`, `galery`, `price`, `description`, `nbvoters`, `averagegrade`, `certifications`, `species`, `difficulty`) VALUES
(1, 1, 1, 6, 30, 'Puppen SPA', 'puppen-spa', -41.110570, -72.996570, 12, 'Km 3,7 camino a Los Bajos', 9, '', 'astridnasler@gmail.com', '', '', '', '', 'Regale a su hija un cumpleaños diferente, transformándola en una princesa. Una experiencia que no olvidara!', NULL, NULL, '', '', NULL),
(2, 1, 1, 7, 31, 'Loteo Fundo Los Laureles', 'loteo-fundo-los-laureles', -41.113300, -72.994930, 12, 'Km 3,7 camino a Los Bajos', 9, '8-6291168', 'germanstrauch@gmail.com', '', '', '', '', 'Una parcelación a orillas del camino Frutillar - Los Bajos, a 3,5 Kms de Frutillar, con electricidad aérea y agua. ULTIMOS LOTES!!', NULL, NULL, '', '', NULL),
(3, 1, 1, 1, 3, 'Laguneclub', 'laguneclub', -41.117340, -73.002470, 12, 'Km 3 camino a Los Bajos', 9, '65-2330033', 'mbertin@laguneclub.com', '', '', '', '$40.000', 'Un lugar de ensueño, a 2 Kms de Frutillar Bajo, ambiente campestre, atendido por la familia Strauch - Bertin. Podrá disfrutas de la playa de acceso privado, la piscina, el quincho, los prados y la insuperable vista del Lago Llanquihue, los 4 volcanes y el pueblo de Frutillar. Descuento de IVA a los extranjeros, tarjetas.', NULL, NULL, '', '', NULL),
(4, 1, 1, 7, 31, 'Condominio Laguneclub', 'condominio-laguneclub', -41.117480, -73.004560, 12, 'Km 3 camino a Los Bajos', 9, '65-2330033', 'rstrauch@laguneclub.com', '', '', '', '48.000.000', 'Exclusivo condominio turistico a 1 minuto de Frutillar, lotes en plano, en ladera, en altura. Reglamento interno proteje su inversión. \r\nVista a los 4 volcanes, vista a la bahia y vista al pueblo de Frutillar.\r\nUNICO CONDOMINIO EN FRUTILLAR CON:\r\n1) PLAYA\r\n\r\n2) RED AGUA  10 LTS/SEGUNDO INSCRITOS LEGALMENTE, (NO REQUIERE CONSTRUIR POZO PROFUNDO)\r\n\r\n3) ELECTRICIDAD SUBTERRANEA', NULL, NULL, '', '', NULL),
(5, 1, 1, 2, 9, 'Rancho Espantapajaros', 'rancho-espantapajaros', -41.003760, -72.937620, 22, 'Quilanto, Km 6 desde Pto. Octay a Frutillar', 22, '65-2330049', 'contacto@espantapajaros.cl', '', '', '', '', 'A las manifestaciones propias de esta particular cultura culinaria, nuestro buffet ha ido incorporando nuevas creaciones, cuyo valor agregado esta en la permanente búsqueda de formas de vida mas sustentables. Para lograrlo utilizamos ingredientes locales, distintos en cada epoca del año, poniendo especial enfasis en conceptos como produccion organica. Los sabores, aromas, colores y texturas de nuestra cocina ayudan a despertar los sentidos de manera responsable, al tiempo que rememoran recetas de antaño.', NULL, NULL, '', '', NULL),
(6, 1, 1, 1, 3, 'Cabañas Bosque Patagonico', 'cabaas-bosque-patagonico', -41.127510, -73.028790, 12, 'Caupolican 117, Frutillar Bajo', 9, '65-2421317', 'lguzzma@hotmail.com', '', '', '', '$40.000', 'Cabañas para 6 personas, equipadas, con vista al lago. Inmersa en el bosque nativo de la Reserva Forestal Edmundo Winkler, pero con todas las ventajas de estar en el pueblo y a 2 cuadras de la playa de Frutillar. Atendida por su dueño, en un ambiente familiar que le garantiza una experiencia inolvidable.', NULL, NULL, '', '', NULL),
(7, 1, 1, 8, 37, 'Cervecera Plagemann Ltda.', 'cervecera-plagemann-ltda', -41.207870, -72.538490, 23, 'Km. 43 – La Ensenada', 7, '65-2212070 ; 9-65998400', 'cervezaplagemann@gmail.com', '', '', '', '', 'Disfrute una exquisita cerveza artesanal con tradicional receta alemana. Atendida por sus dueños.', NULL, NULL, '', '', NULL),
(8, 1, 1, 1, 6, 'Hospedaje y Cabañas Etienne', 'hospedaje-y-cabaas-etienne', -41.255040, -73.004570, 15, 'Salomon Negrin, 794, Llanquihue', 12, '65-2243262', 'etiennehospe@hotmail.com', '', '', '', '', ' El 01 de marzo de 1875  arriba en Puerto Montt el velero francés "Etienne" directamente desde Hamburgo con colonos alemanes. Estas personas dejaron un gran legado de costumbres de repostería que aun viven en esta zona, como kuchenes y tortas (recetas alemanas).\r\nEs por esta razón que se bautizó  hace 16 años atrás el Hospedaje  y Cabañas "Etienne", en honor  al velero  y sus tripulantes que lograron sobrevivir por muchos meses de viaje.', NULL, NULL, '', '', NULL),
(9, 1, 1, 1, 3, 'Antea Cabanas y Spa', 'antea-cabanas-y-spa', -41.252590, -73.001910, 15, 'Manuel Montt N° 92, Sector el Cisne, Llanquihue', 12, '65-2242498', 'contacto@antea.cl', '', '', '', '', 'Cabañas familiares nuevas totalmente equipadas, con sistema de agua caliente ecológico, amplio estacionamiento, y a 2 cuadras de la playa. Centro de SPA con masajes de piedras calientes y sauna. Centro de eventos para 60 personas equipado para cumpleaños, matrimonios y toda clase de eventos.', NULL, NULL, '', '', NULL),
(10, 1, 1, 1, 1, 'Hotel Frutillar Ltda.', 'hotel-frutillar-ltda', -41.135540, -73.028850, 12, 'Vicente Pérez Rosales 673', 9, '(56-65)2421649 Cel.(09)8-2398812', 'frutillar@chilhotel.cl', '', '', '', '39000', 'Ofrecemos un ambiente familiar para brindarle toda la comodidad que necesite durante su viaje de negocios o placer. Estacionamiento amplio y con la comodidad de estar a 2 cuadras de la playa, en pleno centro de Frutillar.', NULL, NULL, '', '', NULL),
(11, 1, 1, 1, 6, 'Cabaña Mi Casita', 'cabaa-mi-casita', -41.131390, -73.027960, 12, '', 9, '7-4957570', 'canwie@hotmail.com', '', '', '', '', 'Cabañas equipadas capacidad hasta 6 personas, televisión con tvcable, Wifi, estacionamiento, amplio patio, a 20 mts del Lago Llanquihue. Atendida por su dueña en un ambiente familiar.', NULL, NULL, '', '', NULL),
(12, 1, 1, 1, 6, 'Turismo Llanquihue', 'turismo-llanquihue', -41.256240, -73.017100, 15, 'Blanco 713 – Sector Playa Los Cisnes', 12, '(56)65–243250 / 85859533 / 90724411 ', 'reservas@turismollanquihue.cl', 'WWW.TURISMOLLANQUIHUE.CL', '', '', '', '2 CABAÑAS:  PARA 4 Y 6 PERSONAS A 50 METROS DEL LAGO LLANQUIHUE. Equipadas con wi-fi, tv. cable, lavandería, parrilla para asados, bicicleta. Disponibilidad todo el año.\r\n1 CASA  PARA 6 PERSONAS EN PARCELA PRIVADA:  DENTRO DE LA CIUDAD, CON VISTAS PRIVILEGIADAS AL LAGO LLANQUIHUE Y VOLCANES. Incluye equipamiento completo, lavadora en el segundo baño, habitación matrimonial en suite, wi-fi, t.v. cable, parrilla para asados.\r\nSERVICIO DE TRANSFER &TOURS, experiencia en rutas turísticas y de la zona, servicios típicos y tours especiales a pedido de los intereses de los clientes. ', NULL, NULL, '', '', NULL),
(13, 1, 1, 2, 9, 'Se cocina', 'se-cocina', -41.157800, -73.017900, 12, 'Quebrada Honda km 2, Fundo Sta. Clara', 9, '8-9728195', 'reservasfrutillar@secocina.cl', 'http://www.secocinachile.com/', '', '', '', 'Restaurante que combina comida tradicional chilena con las mejores recetas de la tradición alemana del sur de Chile. En un ambiente campestre y rodeado por añosos arboles y una hermosa vista, tendrá una experiencia que no olvidará.', NULL, NULL, '', '', NULL),
(14, 1, 1, 1, 3, 'Cabañas Yayi', 'cabaas-yayi', -41.134390, -73.028510, 12, 'Vicente Perez Rosales 570', 9, '8-9054596', 'turismoyayi@hotmail.com', '', '', '', '', 'Cada cabaña constan de tres habitaciones, dos baños, living comedor cocina americana, calefacción a leña (combustión lenta), totalmente equipadas, sistema de alarma, wifi, tv.cable, estacionamiento privado techado. Atendido por su dueña.', NULL, NULL, '', '', NULL),
(15, 1, 1, 1, 1, 'Hotel Salzburg', 'hotel-salzburg', -41.123370, -73.021520, 12, 'Camino a Los Bajos Km 1', 9, '', '', '', '', '', '', 'Hotel en casa de diseño tradicional alemán, rodeado de naturaleza, con una completa vista al lago Llanquihue, restaurante, Pub y SPA con piscina temperada, sauna y masajes.', NULL, NULL, '', '', NULL),
(16, 1, 1, 2, 9, 'Restaurante Broceliande', 'restaurante-broceliande', -41.142280, -73.026720, 12, 'Hermanos Carrera 3', 9, '65-2420073', '', '', '', '', '', 'Restaurante de comida francesa, construido con maderas nativas, con estacionamiento propio. Cocinan y atienden sus dueños, en un ambiente de refinado único en Frutillar. Le garantiza una experiencia de calidad.', NULL, NULL, '', '', NULL),
(17, 1, 1, 8, 35, 'Ecopura', 'ecopura', -41.316961, -72.984519, 23, 'San Francisco #333, 3° piso, oficina 2', 23, '7-7687935', 'contacto@ecopura.cl', 'www.ecopura.cl', '', '', '', 'Tejidos de alta calidad, con diseños propios y materias primas certificadas. Atendido por sus dueños.', NULL, NULL, '', '', NULL),
(18, 1, 1, 1, 3, 'Cabañas Rucamalén', 'cabaas-rucamaln', -41.224040, -72.607720, 23, 'Km 37 Camino a La Ensenada', 7, '65-2335347', 'reservas@rucamalen.cl', 'www.rucamalen.cl', '', '', '', 'Cabañas totalmente equipadas en zona campestre, a 10 metros de la orilla del lago Llanquihue. Ubicación inmejorable para visitar las principales bellezas naturales de la zona: Volcán Osorno, saltos del río Petrohué, laguna Verde y muchos otros. ', NULL, NULL, '', '', NULL),
(19, 1, 1, 1, 4, 'Zapato Amarillo', 'zapato-amarillo', -40.951100, -72.884230, 22, 'PO Box 87, P.Octay, Puerto Octay', 22, '64-2210787', 'info@zapatoamarillo.cl', '', '', '', '', 'Cabañas con servicio de alojamiento ubicada en el campo, a 100 mts de carretera Pto. Octay -  Osorno. Cocina para preparar su propia comida.\r\n', NULL, NULL, '', '', NULL),
(20, 1, 1, 1, 2, 'Hostal Los Guindos', 'hostal-los-guindos', -40.965450, -72.814770, 22, 'Fundo Los Guindos, Puerto Fonck', 4, '64-2210735', 'losguindosfonck@hotmail.com', 'www.fundolosguindos.cl', '', '', '', 'Imponente casa alemana construida en el 1900 de mas de 1000 m2 construidos totalmente reacondicionada. Uds se sentirá como en casa. Atendida por su propia dueña. ', NULL, NULL, '', '', NULL),
(21, 1, 1, 1, 6, 'La Posada del Colono', 'la-posada-del-colono', -41.099960, -72.628070, 22, 'Fundo Huillin Km. 71 a 30,5 Km. de Puerto Octay camino a Las Cascadas', 4, '9 6657786', 'laposadadelcolono@hotmail.com', '', '', '', '', '', NULL, NULL, '', '', NULL),
(22, 1, 1, 1, 6, 'Hosteria La Baja', 'hosteria-la-baja', -40.995270, -72.875400, 22, 'Peninsula Centinela, a3 Km. de Puerto Octay y a orillas del lago', 22, '9-82186897', 'contacto@hosterialabaja.cl ', '', '', '', '', 'Tenemos mas de 50 años de historia, atendida por su propia dueña, de un ambiente familiar y en un lugar privilegiado, de hermosos parajes, con zonas', NULL, NULL, '', '', NULL),
(23, 1, 1, 1, 3, 'Cabañas Kahler', 'cabaas-kahler', -40.994170, -72.878740, 22, 'Centinela Km. 3 Puerto Octay', 7, '064-2391340', 'carmenortiz37@hotmail.com', '', '', '', '', 'Cabañas equipadas para 6 personas, a metros de la playa, acceso directo a camino asfaltado, muelle para lanchas.', NULL, NULL, '', '', NULL),
(24, 1, 1, 5, 25, 'Aibandu', 'aibandu', -41.100390, -72.627940, 22, '30 Km. de Puerto Octay camino a Las Cascadas', 22, '9-5193956', 'aibandu@yahoo.com', 'www.aibandu.cl', '', '', '', 'Experimenta una nueva realidad, donde encontrarás la luz de tu interior. Actividades de permacultura y  enseñanzas místicas en un ambiente de naturaleza que te ayuda a salir de la agitación de la vida cotidiana.', NULL, NULL, '', '', NULL),
(25, 1, 1, 8, 35, 'Telar Octay', 'telar-octay', -40.975140, -72.883140, 22, 'Pedro Montt 3xx, Puerto Octay', 22, '7-6322312', 'j.honorato@gmail.com', '', '', '', '', 'Venta de tejidos en base a lana de la zona, teñida en forma natural. Local de venta con atención directa a la calle atendido por su dueña.', NULL, NULL, '', '', NULL),
(26, 1, 1, 1, 2, 'Agroturismo La Laguna Ltda', 'agroturismo-la-laguna-ltda', -41.120555, -72.611666, 22, 'Faldeo del Volcan Osornos, a 60 Km de Puerto Varas', 4, '9-8250460', 'contacto@canopychile.cl', '', '', '', '', 'En las faldas del Volcán Osorno, frente al Lago Llanquihue se encuentra Canopy Chile, nuestro centro turístico de más 500 hectáreas, inmerso en bosques nativos, con la más bella flora y fauna chilena.', NULL, NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `newsletter` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `state` int(11) NOT NULL,
  `grade_cleanliness` int(11) NOT NULL,
  `grade_confort` int(11) NOT NULL,
  `grade_location` int(11) NOT NULL,
  `grade_services` int(11) NOT NULL,
  `grade_personal` int(11) NOT NULL,
  `grade_pqratio` int(11) NOT NULL,
  `grade_average` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '0',
  `id_admin` int(11) NOT NULL DEFAULT '0',
  `zone` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `type`, `state`, `id_admin`, `zone`) VALUES
(1, 'rstrauch@laguneclub.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'Ricardo Strauch', 3, 0, 0, 0),
(3, 'user@colonos.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'USER_NAME', 0, 0, 0, 0),
(4, 'admz1@colonos.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'ADMZ1_NAME', 2, 0, 0, 1),
(5, 'mod1@colonos.com', 'b84b4726518964c6c7a1084817e84de8a62d63a8', 'MOD1_NAME', 1, 0, 4, 0);
