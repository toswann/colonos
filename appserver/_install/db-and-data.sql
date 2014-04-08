-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 08 Avril 2014 à 15:06
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `colonos`
--

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
(1, 1, 1, 6, 30, 'Puppen SPA', 'puppen-spa', -41.110570, -72.996570, 1, 'Km 3,7 camino a Los Bajos', 1, '', 'astridnasler@gmail.com', '', '', '0', '', 'Regale a su hija un cumpleaños diferente, transformándola en una princesa. Una experiencia que no olvidara!', NULL, NULL, '', '', NULL),
(2, 1, 1, 7, 31, 'Loteo Fundo Los Laureles', 'loteo-fundo-los-laureles', -41.113300, -72.994930, 1, 'Km 3,7 camino a Los Bajos', 1, '', 'germanstrauch@gmail.com', '', '', '', '', 'Una parcelación a orillas del camino Frutillar - Los Bajos, a 3,5 Kms de Frutillar, con electricidad aérea y agua. ULTIMOS LOTES!!', NULL, NULL, '', '', NULL),
(3, 1, 1, 1, 3, 'Laguneclub', 'lagune-club', -41.117340, -73.002470, 1, 'Km 3 camino a Los Bajos', 1, '65-2330033', 'mbertin@laguneclub.com', '', '1', '4', '30000', 'Un lugar de ensueño, a 2 Kms de Frutillar Bajo, ambiente campestre, atendido por la familia Strauch - Bertin. Podrá disfrutas de la playa de acceso privado, la piscina, el quincho, los prados y la insuperable vista del Lago Llanquihue, los 4 volcanes y el pueblo de Frutillar. Descuento de IVA a los extranjeros, tarjetas.', NULL, NULL, '', '', NULL),
(4, 1, 1, 7, 31, 'Condominio Laguneclub', 'condominio-laguneclub', -41.117480, -73.004560, 1, 'Km 3 camino a Los Bajos', 1, '65-2330033', 'rstrauch@laguneclub.com', '', '', '', '', 'Exclusivo condominio turistico, a orillas del lago, con acceso privado a Playa, agua de vertiente natural, electricidad subterranea, reglamento interno. Vista al lago, los 4 volcanes, la bahia y el pueblo de Frutillar.', NULL, NULL, '', '', NULL),
(5, 1, 1, 2, 9, 'Rancho Espantapajaros', 'rancho-espantapajaros', -41.003760, -72.937620, 4, 'Quilanto, Km 6 desde Pto. Octay a Frutillar', 6, '65-2330049', 'contacto@espantapajaros.cl', '', '', '', '', 'A las manifestaciones propias de esta particular cultura culinaria, nuestro buffet ha ido incorporando nuevas creaciones, cuyo valor agregado esta en la permanente búsqueda de formas de vida mas sustentables. Para lograrlo utilizamos ingredientes locales, distintos en cada epoca del año, poniendo especial enfasis en conceptos como produccion organica. Los sabores, aromas, colores y texturas de nuestra cocina ayudan a despertar los sentidos de manera responsable, al tiempo que rememoran recetas de antaño.', NULL, NULL, '', '', NULL),
(6, 1, 1, 1, 3, 'Cabanas Bosque Patagonico', 'cabanas-bosque-patagonico', -41.127510, -73.028790, 1, 'Caupolican 117, Frutillar Bajo', 1, '65-2421317', 'lguzzma@hotmail.com', '', '', '', '', '', NULL, NULL, '', '', NULL),
(7, 1, 1, 8, 37, 'Cervecera Plagemann Ltda.', 'cervecera-plagemann-ltda ', -41.207870, -72.538490, 3, 'Km. 43 – La Ensenada', 4, '65-2212070 ; 9-65998400', 'cervezaplagemann@gmail.com', '', '', '', '', 'Disfrute una exquisita cerveza artesanal con tradicional receta alemana.', NULL, NULL, '', '', NULL),
(8, 1, 1, 1, 6, 'Hospedaje y Cabanas Etienne', 'hospedaje-y-cabanas-etienne', -41.255040, -73.004570, 2, 'Salomon Negrin, 794, Llanquihue', 2, '65-2243262', 'etiennehospe@hotmail.com', '', '', '', '', ' El 01 de marzo de 1875  arriba en Puerto Montt el velero francés "Etienne" directamente desde Hamburgo con colonos alemanes. Estas personas dejaron un gran legado de costumbres de repostería que aun viven en esta zona, como kuchenes y tortas (recetas alemanas).\nEs por esta razón que se bautizó  hace 16 años atrás el Hospedaje  y Cabañas "Etienne", en honor  al velero  y sus tripulantes que lograron sobrevivir por muchos meses de viaje.', NULL, NULL, '', '', NULL),
(9, 1, 1, 1, 3, 'Antea Cabanas y Spa', 'antea-cabanas-y-spa', -41.252590, -73.001910, 2, 'Manuel Montt N° 92, Sector el Cisne, Llanquihue', 2, '', 'contacto@antea.cl', '', '', '', '', '', NULL, NULL, '', '', NULL),
(10, 1, 1, 1, 1, 'Hotel Frutilla Ltda.', 'hotel-frutilla-tda', -41.135540, -73.028850, 1, 'Vicente Pérez Rosales 673', 1, '8-2398812', 'frutillar@chilhotel.cl', '', '', '', '', 'Ofrecemos un ambiente familiar para brindarle toda la comodidad que necesite durante su viaje de negocios o placer', NULL, NULL, '', '', NULL),
(11, 1, 1, 1, 6, 'Cabana Mi Casita', 'cabana-mi-casita', -41.131390, -73.027960, 1, '', 1, '7-8193325', 'canwie@hotmail.comcanwie@hotmail.com\ncanwie@hotmail.com', '', '', '', '', 'Cabañas equipadas capacidad hasta 6 personas, televisión con TvCable, Wifi, estacionamiento, amplio patio, a 20 mts del Lago Llanquihue', NULL, NULL, '', '', NULL),
(12, 1, 1, 1, 6, 'Turismo Llanquihue', 'turismo-llanquihue', -41.256240, -73.017100, 2, 'Blanco 713 – Sector Playa Los Cisnes', 2, '9-0724411', 'malvarezbarria@hotmail.com', '', '', '', '', 'Casa en parcela en el Lago Llanquihuentt', NULL, NULL, '', '', NULL),
(13, 1, 1, 2, 9, 'Se cocina', 'se-cocina', -41.157800, -73.017900, 1, 'Quebrada Honda km-2 fundo Sta. Clara', 1, '', 'reservasfrutillar@secocina.cl', '', '', '', '', '', NULL, NULL, '', '', NULL),
(14, 1, 1, 1, 3, 'Cabanas Yayi', 'cabanas-yayi', -41.134390, -73.028510, 1, 'Vicente Perez Rosales 570', 1, '8-9054596', 'turismoyayi@hotmail.com', '', '', '', '', 'Cada cabaña constan de tres habitaciones, dos baños, living comedor cocina americana, calefacción a leña (combustión lenta), totalmente equipadas, sistema de alarma, wifi, tv.cable, estacionamiento privado techado', NULL, NULL, '', '', NULL),
(15, 1, 1, 1, 1, 'Hotel Salzburg', 'hotel-salzburg', -41.123370, -73.021520, 1, 'Camino a Los Bajos Km 1', 1, '', '', '', '', '', '', 'Hotel, restaurante y SPA', NULL, NULL, '', '', NULL),
(16, 1, 1, 2, 9, 'Restaurante Broceliande', 'restaurante-broceliande', -41.142280, -73.026720, 1, 'Hermanos Carrera 3', 1, '65-2420073', '', '', '', '', '', 'Comida Francesa', NULL, NULL, '', '', NULL),
(17, 1, 1, 8, 35, 'Ecopura', 'ecopura', -41.316961, -72.984519, 3, 'San Francisco #333, 3° piso, oficina 2', 3, '7-7687935', '', '', '', '', '', 'Comercio justo', NULL, NULL, '', '', NULL),
(18, 1, 1, 1, 3, 'Cabañas Rucamalen', 'cabanas-rucamalen', -41.224600, -72.594100, 3, 'Km 37 Camino a La Ensenada', 4, '65-2335347', 'reservas@rucamalen.cl', '', '', '', '', 'Piscina temperada', NULL, NULL, '', '', NULL),
(19, 1, 1, 1, 4, 'Zapato Amarillo', 'zapato-amarillo', -40.951100, -72.884230, 4, 'PO Box 87, P.Octay, Puerto Octay', 6, '64-2210787', 'info@zapatoamarillo.cl', '', '', '', '', '', NULL, NULL, '', '', NULL),
(20, 1, 1, 1, 2, 'Hostal Los Guindos', 'hostal-los-guindos', -40.965450, -72.814770, 4, 'Fundo Los Guindos, Puerto Fonck', 5, '64-2210735', 'losguindosfonck@hotmail.com', '', '', '', '', '', NULL, NULL, '', '', NULL),
(21, 1, 1, 1, 6, 'La Posada del Colono', 'la-posada-del-colono', -41.099960, -72.628070, 4, 'Fundo Huillin Km. 71 a 30,5 Km. de Puerto Octay camino a Las Cascadas', 5, '9 6657786', 'laposadadelcolono@hotmail.com', '', '', '', '', '', NULL, NULL, '', '', NULL),
(22, 1, 1, 1, 6, 'Hosteria La Baja', 'hosteria-la-baja', -40.995270, -72.875400, 4, 'Peninsula Centinela, a3 Km. de Puerto Octay y a orillas del lago', 6, '9-82186897', 'contacto@hosterialabaja.cl ', '', '', '', '', 'Tenemos mas de 50 años de historia, atendida por su propia dueña, de un ambiente familiar y en un lugar privilegiado, de hermosos parajes, con zonas', NULL, NULL, '', '', NULL),
(23, 1, 1, 1, 3, 'Cabanas Kahler', 'cabanas-kahler', -40.994170, -72.878740, 4, 'Centinela Km. 3 Puerto Octay', 4, '9-5193956', 'aibandu@yahoo.com', '', '', '', '', '', NULL, NULL, '', '', NULL),
(24, 1, 1, 5, 25, 'Aibandu', 'aibandu', -41.100390, -72.627940, 4, '30 Km. de Puerto Octay camino a Las Cascadas', 6, '9-5193956', 'aibandu@yahoo.com', '', '', '', '', '', NULL, NULL, '', '', NULL),
(25, 1, 1, 8, 35, 'Telar Octay', 'telar-octay', -40.974970, -72.883040, 4, 'Pedro Montt 3xx, Puerto Octay', 6, '7-6322312', 'j.honorato@gmail.com', '', '', '', '', '', NULL, NULL, '', '', NULL),
(26, 1, 1, 1, 2, 'Agroturismo La Laguna Ltda', 'agroturismo-la-laguna-ltda', -41.120555, -72.611666, 4, 'Faldeo del Volcan Osornos, a 60 Km de Puerto Varas\n', 5, '9-8250460\n', 'contacto@canopychile.cl', '', '', '', '', 'En las faldas del Volcán Osorno, frente al Lago Llanquihue se encuentra Canopy Chile, nuestro centro turístico de más 500 hectáreas, inmerso en bosques nativos, con la más bella flora y fauna chilena.', NULL, NULL, '', '', NULL);

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
(1, 'admg@colonos.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'ADMG_NAME', 3, 1, 0, 0),
(3, 'user@colonos.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'USER_NAME', 0, 1, 0, 0),
(4, 'admz1@colonos.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'ADMZ1_NAME', 2, 1, 0, 1),
(5, 'mod1@colonos.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'MOD1_NAME', 1, 1, 4, 0);
