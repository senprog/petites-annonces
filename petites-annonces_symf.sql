-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 02 Octobre 2017 à 06:30
-- Version du serveur :  5.7.19-0ubuntu0.17.04.1
-- Version de PHP :  7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `petites-annonces_symf`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id` int(11) NOT NULL,
  `titre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `prix` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `googleMap` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreVue` int(11) NOT NULL,
  `type_prix` longtext COLLATE utf8_unicode_ci,
  `categorie_id` int(11) DEFAULT NULL,
  `sous_categorie_id` int(11) DEFAULT NULL,
  `statut_annonce_id` int(11) DEFAULT NULL,
  `type_annonce_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `etat_article_annonce_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_publication` datetime NOT NULL,
  `date_modification` datetime DEFAULT NULL,
  `date_suppression` datetime DEFAULT NULL,
  `anonyme_id` int(11) DEFAULT NULL,
  `photo2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `devise_id` int(11) DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departement` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_objet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `annonce`
--

INSERT INTO `annonce` (`id`, `titre`, `prix`, `description`, `googleMap`, `nombreVue`, `type_prix`, `categorie_id`, `sous_categorie_id`, `statut_annonce_id`, `type_annonce_id`, `package_id`, `etat_article_annonce_id`, `user_id`, `date_publication`, `date_modification`, `date_suppression`, `anonyme_id`, `photo2`, `photo3`, `photo4`, `photo5`, `devise_id`, `pays`, `departement`, `ville`, `photo6`, `adresse_objet`) VALUES
(1, 'Verres', '1 500 000', 'Point your browser to the root directory of this application (app_dev.php). You\'ll see an input field just like expected and you can now upload some images (for example). The files will be stored in web/uploads/gallery every single one with a unique filename. Note that we used some CDNs to serve the JavaScript files needed for this.', NULL, 0, 'Negociable', 1, 1, NULL, 1, NULL, 1, 2, '2017-06-18 14:32:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Brazzaville, Republic of the Congo'),
(2, 'Coustume de france', '1500', 'Chien Allemand de bonne race, très méchant et courtois.', NULL, 0, 'Negociable', 6, 11, NULL, 1, NULL, 2, 2, '2017-06-24 18:18:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 'Berlin, Germany');

-- --------------------------------------------------------

--
-- Structure de la table `anonyme`
--

CREATE TABLE `anonyme` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dateInscription` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `is_active` tinyint(1) NOT NULL,
  `telephone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token_activation` tinytext COLLATE utf8_unicode_ci,
  `date_inscription` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `adresse_ip` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `app_user`
--

INSERT INTO `app_user` (`id`, `username`, `password`, `nom`, `prenom`, `email`, `salt`, `roles`, `is_active`, `telephone`, `pays`, `ville`, `token_activation`, `date_inscription`, `last_login`, `adresse_ip`) VALUES
(2, 'audrybab', '$2y$13$.3lHx/phV1vSf7AHIS3Jl.n7nhmJRrzfVyo15xl2kbC0VrrluEJYG', 'BABELA', 'Audry', 'contact@congo-market.com', '0a24595d6fd15ea8afd6351259ee1ac9', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 1, '055979795', 'CG\r\n', 'Brazzaville', NULL, '2017-03-01 10:20:09', '2017-03-03 09:27:53', NULL),
(6, 'urlene', '$2y$13$D0h6kH09nPTcCaFO7V0LoeeM94yqJkXmU0If.o7epzUHwJckuo1L.', 'MAHINGA', 'Edna', 'hurlene2006@yahoo.fr', '6e2abe9696b7b98f72799302c662874e', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 1, '066070067', 'CD', 'Kinshasa', NULL, '2017-03-02 10:20:20', '2016-01-28 06:07:54', NULL),
(7, 'dane', '$2y$13$pXe18v0D1gb6os64C13nkeQg2qeshWH1PB4v39B8b4OtrJUYNbXnS', 'BABELA', 'Dane', 'dane@senprog.com', '118e11c61ebd6d9aae040510b88ed853', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 0, '+242066070068', 'CG', 'Brazzaville', '916dd13aae871f5cb13de0b4468a0bea', '2017-03-03 06:04:01', '2017-03-03 11:21:56', '::1');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sous_categorie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_annonce`
--

CREATE TABLE `categorie_annonce` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon_mini` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categorie_annonce`
--

INSERT INTO `categorie_annonce` (`id`, `nom`, `class`, `icon`, `icon_mini`) VALUES
(1, 'Véhicules & Motos', NULL, 'images/icon/1.png', 'icofont-police-car-alt-2'),
(2, 'Electronique & Gadgets', NULL, 'images/icon/2.png', 'icofont-laptop-alt'),
(3, 'Maison', NULL, 'images/icon/3.png', 'icofont-ui-home'),
(4, 'Sports & Jeux', NULL, 'images/icon/4.png', 'icofont-hockey'),
(5, 'Mode & Beauté', NULL, 'images/icon/5.png', 'icofont-nurse'),
(6, 'Pets & Animals', NULL, 'images/icon/6.png', 'icofont-animal-dog'),
(7, 'Home Appliances', NULL, 'images/icon/9.png', 'icofont-nursing-home'),
(8, 'Services divers', NULL, 'images/icon/10.png', 'icofont-social-prestashop'),
(9, 'Musiques & Arts', NULL, 'images/icon/11.png', 'icofont-animal-cat-alt-1'),
(10, 'Miscellaneous', NULL, 'images/icon/12.png', 'icofont-abacus'),
(11, 'Emplois', NULL, 'images/icon/7.png', 'icofont-job-search'),
(12, 'Livres & Magazine', NULL, 'images/icon/8.png', 'icofont-book'),
(13, 'Alimentation & Agriculture', NULL, NULL, 'icofont icofont-burger'),
(15, 'Autres', NULL, NULL, 'icofont icofont-abc');

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE `devise` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `symbole` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `devise`
--

INSERT INTO `devise` (`id`, `nom`, `code`, `symbole`) VALUES
(1, 'CFA', 'XAF', 'XAF'),
(2, 'Dollar', '$', '$'),
(3, 'Euro', 'Eur', '€');

-- --------------------------------------------------------

--
-- Structure de la table `etat_article_annonce`
--

CREATE TABLE `etat_article_annonce` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `etat_article_annonce`
--

INSERT INTO `etat_article_annonce` (`id`, `nom`) VALUES
(1, 'Neuf'),
(2, 'Usagé');

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jb_filehistory`
--

CREATE TABLE `jb_filehistory` (
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `nomPackage` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `devise` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombreJours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombrePhotos` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `package`
--

INSERT INTO `package` (`id`, `nomPackage`, `montant`, `devise`, `nombreJours`, `nombrePhotos`) VALUES
(1, 'Gratuit', 0, '$', '30', '5'),
(3, 'Perso', 4, '$', '45', '6'),
(4, 'Pro', 8, '$', '90', '8');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profil_annonceur`
--

CREATE TABLE `profil_annonceur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `profil_annonceur`
--

INSERT INTO `profil_annonceur` (`id`, `nom`) VALUES
(1, 'Particulier'),
(2, 'Profesionnel');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie_annonce`
--

CREATE TABLE `sous_categorie_annonce` (
  `id` int(11) NOT NULL,
  `nomSousCategorie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nom_categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `sous_categorie_annonce`
--

INSERT INTO `sous_categorie_annonce` (`id`, `nomSousCategorie`, `nom_categorie_id`) VALUES
(1, 'Véhicules', 1),
(2, 'Camnions', 1),
(3, 'Motos', 1),
(4, 'Téléphone & Tablette', 2),
(5, 'Ordianteurs & Laptops', 2),
(6, 'Réseaux inforamtique', 2),
(7, 'TV & LCD', 2),
(8, 'Electroménagers', 3),
(9, 'Appareils Domestiques', 2),
(10, 'Chiens', 6),
(11, 'Chats', 6),
(12, 'Oiseaux', 6),
(13, 'Poissons', 6),
(14, 'Local Commercial', 3),
(15, 'Maisons et Bureaux', 3),
(16, 'Ferme', 3),
(17, 'Entretien & Gardiannage', 8),
(18, 'Education', 8),
(19, 'Services Alimentaires', 8);

-- --------------------------------------------------------

--
-- Structure de la table `statut_annonce`
--

CREATE TABLE `statut_annonce` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `statut_annonce`
--

INSERT INTO `statut_annonce` (`id`, `nom`) VALUES
(2, 'Active'),
(4, 'Attente'),
(1, 'Bloquée'),
(3, 'Expirée'),
(5, 'Supprimée\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `type_annonce`
--

CREATE TABLE `type_annonce` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type_annonce`
--

INSERT INTO `type_annonce` (`id`, `nom`) VALUES
(1, 'Je vends'),
(2, 'J\'achete'),
(3, 'Je fais don'),
(4, 'J\'échange');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`id`, `nom`, `pays`) VALUES
(1, 'Brazzaville', 'CG'),
(4, 'Pointe-Noire', 'CG'),
(5, 'Kinshasa', 'CD');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F65593E5BCF5E72D` (`categorie_id`),
  ADD KEY `IDX_F65593E5365BF48` (`sous_categorie_id`),
  ADD KEY `IDX_F65593E5FDCEA626` (`statut_annonce_id`),
  ADD KEY `IDX_F65593E595067D0A` (`type_annonce_id`),
  ADD KEY `IDX_F65593E5F44CABFF` (`package_id`),
  ADD KEY `IDX_F65593E5EAE9BD37` (`etat_article_annonce_id`),
  ADD KEY `IDX_F65593E5A76ED395` (`user_id`),
  ADD KEY `IDX_F65593E5433B2C47` (`anonyme_id`),
  ADD KEY `IDX_F65593E5F4445056` (`devise_id`);

--
-- Index pour la table `anonyme`
--
ALTER TABLE `anonyme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_88BDF3E9F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_88BDF3E9E7927C74` (`email`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_497DD6346C6E55B5` (`nom`);

--
-- Index pour la table `categorie_annonce`
--
ALTER TABLE `categorie_annonce`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A9D63D476C6E55B5` (`nom`);

--
-- Index pour la table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_43EDA4DF6C6E55B5` (`nom`);

--
-- Index pour la table `etat_article_annonce`
--
ALTER TABLE `etat_article_annonce`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jb_filehistory`
--
ALTER TABLE `jb_filehistory`
  ADD PRIMARY KEY (`file_name`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DE686795682926DD` (`nomPackage`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_349F3CAE6C6E55B5` (`nom`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profil_annonceur`
--
ALTER TABLE `profil_annonceur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4FEE8A7E6C6E55B5` (`nom`);

--
-- Index pour la table `sous_categorie_annonce`
--
ALTER TABLE `sous_categorie_annonce`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_68F3E8B089E161A0` (`nomSousCategorie`),
  ADD KEY `IDX_68F3E8B031338A73` (`nom_categorie_id`);

--
-- Index pour la table `statut_annonce`
--
ALTER TABLE `statut_annonce`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9AE489A96C6E55B5` (`nom`);

--
-- Index pour la table `type_annonce`
--
ALTER TABLE `type_annonce`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_43C3D9C36C6E55B5` (`nom`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `anonyme`
--
ALTER TABLE `anonyme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categorie_annonce`
--
ALTER TABLE `categorie_annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `devise`
--
ALTER TABLE `devise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `etat_article_annonce`
--
ALTER TABLE `etat_article_annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `profil_annonceur`
--
ALTER TABLE `profil_annonceur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `sous_categorie_annonce`
--
ALTER TABLE `sous_categorie_annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `statut_annonce`
--
ALTER TABLE `statut_annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `type_annonce`
--
ALTER TABLE `type_annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_F65593E5365BF48` FOREIGN KEY (`sous_categorie_id`) REFERENCES `sous_categorie_annonce` (`id`),
  ADD CONSTRAINT `FK_F65593E5433B2C47` FOREIGN KEY (`anonyme_id`) REFERENCES `anonyme` (`id`),
  ADD CONSTRAINT `FK_F65593E595067D0A` FOREIGN KEY (`type_annonce_id`) REFERENCES `type_annonce` (`id`),
  ADD CONSTRAINT `FK_F65593E5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_F65593E5BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie_annonce` (`id`),
  ADD CONSTRAINT `FK_F65593E5EAE9BD37` FOREIGN KEY (`etat_article_annonce_id`) REFERENCES `etat_article_annonce` (`id`),
  ADD CONSTRAINT `FK_F65593E5F4445056` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`),
  ADD CONSTRAINT `FK_F65593E5F44CABFF` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`),
  ADD CONSTRAINT `FK_F65593E5FDCEA626` FOREIGN KEY (`statut_annonce_id`) REFERENCES `statut_annonce` (`id`);

--
-- Contraintes pour la table `sous_categorie_annonce`
--
ALTER TABLE `sous_categorie_annonce`
  ADD CONSTRAINT `FK_68F3E8B031338A73` FOREIGN KEY (`nom_categorie_id`) REFERENCES `categorie_annonce` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
