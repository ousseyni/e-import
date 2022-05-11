-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 mai 2022 à 04:13
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


INSERT INTO `affectation_amcs` (`id`, `est_traite`, `idamc`, `iduser`, `comments`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 'Transmission aux agents - étude à effectuer', '2022-05-05 19:53:49', '2022-05-05 19:53:49');

--
-- Déchargement des données de la table `affectation_amms`
--

INSERT INTO `affectation_amms` (`id`, `est_traite`, `idamm`, `iduser`, `comments`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 'Transmission aux agents - étude à effectuer', '2022-05-03 08:10:29', '2022-05-03 08:10:29');

--
-- Déchargement des données de la table `amcs`
--

INSERT INTO `amcs` (`id`, `paysprov`, `modetransport`, `dateembarque`, `lieuembarque`, `datedebarque`, `lieudebarque`, `totalpoids`, `totalfrais`, `totalenr`, `totalpen`, `totalglobal`, `observation`, `valeurcaf_cfa`, `valeurcaf_ext`, `valeurcaf_dev`, `idcontribuable`, `slug`, `etat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fédération de Russie', 'Terrestre', '2022-05-05', 'Cap Town', '2022-05-15', 'Port Owendo', 3500, 466000, 50000, NULL, 516000, NULL, 12300000, 12000, 'EUR', 1, 'amc-o2tvunubytcbo8iuieys4jrzzpcwa9nwpktzrnvk4ygq6unlhe', 2, '2022-05-05 19:52:10', '2022-05-05 19:53:50', NULL);

--
-- Déchargement des données de la table `amms`
--

INSERT INTO `amms` (`id`, `paysprov`, `modetransport`, `dateembarque`, `lieuembarque`, `datedebarque`, `lieudebarque`, `totalpoids`, `totalfrais`, `totalenr`, `totalpen`, `totalglobal`, `observation`, `valeurcaf_cfa`, `valeurcaf_ext`, `valeurcaf_dev`, `idcontribuable`, `slug`, `etat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'France', 'Maritime', '2022-05-03', 'Cap Town', '2022-05-22', 'Port Owendo', 4200, 21000, 50000, NULL, 71000, NULL, 1200000, 1000, 'EUR', 1, 'amm-hh979ckrga6y6fp4wwv5u5akctapgpma0vkynpadgbt9t5ovf8', 2, '2022-05-03 08:06:12', '2022-05-04 19:29:58', NULL);

--
-- Déchargement des données de la table `categorie_produits`
--

--
-- Déchargement des données de la table `conteneur_amms`
--

INSERT INTO `conteneur_amms` (`id`, `nomnavire`, `numvoyage`, `numbietc`, `numconteneur`, `numplomb`, `numconnaissement`, `idamm`, `created_at`, `updated_at`) VALUES
(1, 'Cypress', '#1235', '#TEST', '#AZERTY', '1234', 'DBA010202', 1, '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(2, 'Cypress', '#1235', '#TEST', '#QWERTY', '4321', 'DBA010202', 1, '2022-05-03 08:06:12', '2022-05-03 08:06:12');

--
-- Déchargement des données de la table `document_amcs`
--

INSERT INTO `document_amcs` (`id`, `libelle`, `idamc`, `pj`, `created_at`, `updated_at`) VALUES
(1, 'Facture Fournisseur 1', 1, 'facture_fournisseur_1.pdf', '2022-05-05 19:52:10', '2022-05-05 19:52:10'),
(2, 'Certificat sanitaire', 1, 'certificat_sanitaire.pdf', '2022-05-05 19:52:10', '2022-05-05 19:52:10'),
(3, 'CNT/LTA/LV', 1, 'cnt_lta_lv.pdf', '2022-05-05 19:52:10', '2022-05-05 19:52:10'),
(4, 'Certificat d\'origine', 1, 'certificat_origine.pdf', '2022-05-05 19:52:10', '2022-05-05 19:52:10');

--
-- Déchargement des données de la table `document_amms`
--

INSERT INTO `document_amms` (`id`, `libelle`, `idamm`, `pj`, `created_at`, `updated_at`) VALUES
(1, 'Facture Fournisseur 1', 1, 'facture_fournisseur_1.pdf', '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(2, 'Fiche Sécurité', 1, 'fiche_securite.pdf', '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(3, 'Certificat Conformité', 1, 'certificat_conformite.pdf', '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(4, 'CNT/LTA/LV', 1, 'cnt_lta_lv.pdf', '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(5, 'Certificat d\'origine', 1, 'certificat_origine.pdf', '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(6, 'Quittance de paiement de l\'odre de recette n° 000001', 1, 'pj_quittance.pdf', '2022-05-04 19:29:28', '2022-05-04 19:29:28');

--
-- Déchargement des données de la table `produit_amcs`
--

INSERT INTO `produit_amcs` (`id`, `numfact`, `datefact`, `fournisseur`, `marque`, `paysorig`, `poids`, `total`, `idamc`, `idproduit`, `created_at`, `updated_at`) VALUES
(1, 'F1', '2022-05-05', 'TEST', 'Regab', 'Fédération de Russie', 1200, 6000, 1, 108, '2022-05-05 19:52:10', '2022-05-05 19:52:10'),
(2, 'F2', '2022-04-29', 'Ousseyni', 'Bell', 'Allemagne', 2300, 460000, 1, 139, '2022-05-05 19:52:10', '2022-05-05 19:52:10');

--
-- Déchargement des données de la table `produit_amms`
--

INSERT INTO `produit_amms` (`id`, `numfact`, `datefact`, `fournisseur`, `marque`, `paysorig`, `poids`, `total`, `idamm`, `idproduit`, `created_at`, `updated_at`) VALUES
(1, 'F1', '2022-05-03', 'TEST', 'Bell', 'France', 1200, 6000, 1, 30, '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(2, 'F2', '2022-05-04', 'Ousseyni', 'Regab', 'Argentine', 3000, 15000, 1, 29, '2022-05-03 08:06:12', '2022-05-03 08:06:12');

--
-- Déchargement des données de la table `suivi_amcs`
--

INSERT INTO `suivi_amcs` (`id`, `etat`, `idamc`, `iduser`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Nouvelle demande soumise à la DGCC', '2022-05-05 19:52:10', '2022-05-05 19:52:10'),
(2, 2, 1, 1, 'Transmission aux agents - étude à effectuer', '2022-05-05 19:53:50', '2022-05-05 19:53:50');

--
-- Déchargement des données de la table `suivi_amms`
--

INSERT INTO `suivi_amms` (`id`, `etat`, `idamm`, `iduser`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Nouvelle demande soumise à la DGCC', '2022-05-03 08:06:12', '2022-05-03 08:06:12'),
(2, 2, 1, 1, 'Transmission aux agents - étude à effectuer', '2022-05-03 08:10:29', '2022-05-03 08:10:29');

--
-- Déchargement des données de la table `vehicule_amcs`
--

INSERT INTO `vehicule_amcs` (`id`, `numlvi`, `numvehicule`, `numconteneur`, `numplomb`, `idamc`, `created_at`, `updated_at`) VALUES
(1, '#123456', 'AM288AA', '#AZERTY', '6789', 1, '2022-05-05 19:52:10', '2022-05-05 19:52:10'),
(2, '#78901', 'EA288AA', '#QWERTY', '4567', 1, '2022-05-05 19:52:10', '2022-05-05 19:52:10');
COMMIT;
