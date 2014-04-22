-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 22 Avril 2014 à 13:39
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

