-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 24 mai 2022 à 00:23
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_dgcc`
--

--
-- Déchargement des données de la table `affectation_amcs`
--

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
(1, 'France', 'Maritime', '2022-05-03', 'Cap Town', '2022-05-22', 'Port Owendo', 4200, 21000, 50000, NULL, 71000, NULL, 1200000, 1000, 'EUR', 1, 'amm-hh979ckrga6y6fp4wwv5u5akctapgpma0vkynpadgbt9t5ovf8', 10, '2022-05-03 08:06:12', '2022-05-23 23:25:13', NULL);

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
(6, 'Quittance de paiement de l\'odre de recette n° 000001', 1, 'pj_quittance.pdf', '2022-05-04 19:29:28', '2022-05-04 19:29:28'),
(7, 'Quittance de paiement de l\'odre de recette n° 000001', 1, 'pj_quittance.pdf', '2022-05-23 23:24:37', '2022-05-23 23:24:37');

--
-- Déchargement des données de la table `inspection_amms`
--

INSERT INTO `inspection_amms` (`id`, `dateinspection`, `paysprov`, `modetransport`, `conditiontransport`, `poinentree`, `lieuinspection`, `comment_transport`, `natureproduits`, `totalqte`, `idamm`, `conclusion`, `observation`, `iduser`, `idcontribuable`, `created_at`, `updated_at`) VALUES
(1, '2022-05-24 00:43:55', 'France', 'Maritime', 'Ambiante', 'Port Owendo', 'IAI', NULL, 'Matériels de construction', 4200, 1, 1, NULL, 1, 1, '2022-05-23 23:43:55', '2022-05-23 23:43:55');

--
-- Déchargement des données de la table `ligne_inspection_amms`
--

INSERT INTO `ligne_inspection_amms` (`id`, `marque`, `nom`, `numerolot`, `paysorig`, `fournisseur`, `fabricant`, `ingredients`, `qtenet`, `durabilite`, `modeemploi`, `allegation`, `possede2aire`, `observation2aire`, `etat2aire`, `possede1aire`, `observation1aire`, `etat1aire`, `autreobservation`, `idinspectionamm`, `idproduit`, `created_at`, `updated_at`) VALUES
(1, 'Regab', 'Brouette', 'Lot', 'Fédération de Russie', 'Fabricant', 'Fabricant', 'Ingredient', 1000, '2022-05-24', 'Mode emploi', 'Allégation', 0, NULL, 0, 0, NULL, 1, '', 1, 32, '2022-05-23 23:43:55', '2022-05-23 23:43:55');

--
-- Déchargement des données de la table `ligne_inspection_conteneur_amms`
--

INSERT INTO `ligne_inspection_conteneur_amms` (`id`, `conteneurinspecte`, `numeroplomb`, `idinspectionamm`, `created_at`, `updated_at`) VALUES
(1, '#AZERTY', '1234', 1, '2022-05-23 23:43:55', '2022-05-23 23:43:55'),
(2, '#QWERTY', '4321', 1, '2022-05-23 23:43:55', '2022-05-23 23:43:55');

--
-- Déchargement des données de la table `ordre_recettes`
--

INSERT INTO `ordre_recettes` (`id`, `exercice`, `date_emission`, `est_paye`, `date_paye`, `quittance`, `type`, `idamc`, `idamm`, `created_at`, `updated_at`) VALUES
(1, 2022, '2022-05-24', 1, '2022-05-24', '1234567890', 'AMM', NULL, 1, '2022-05-23 23:24:12', '2022-05-23 23:24:37');

--
-- Déchargement des données de la table `prescription_amms`
--

INSERT INTO `prescription_amms` (`id`, `dateprpt`, `value`, `comments`, `iduser`, `idamm`, `idprescription`, `created_at`, `updated_at`) VALUES
(1, '2022-05-24', NULL, 'Visite de la DGCC pour inspection Contacts : 061 000 196 / 061 000 202', 1, 1, 2, '2022-05-23 23:23:41', '2022-05-23 23:23:41'),
(2, '2022-05-24', NULL, 'Visite de la DGCC pour inspection Contacts : 061 000 196 / 061 000 202', 1, 1, 3, '2022-05-23 23:23:41', '2022-05-23 23:23:41');

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
(2, 2, 1, 1, 'Transmission aux agents - étude à effectuer', '2022-05-03 08:10:29', '2022-05-03 08:10:29'),
(3, 3, 1, 1, 'Etude terminée - en attente de validation', '2022-05-23 23:23:41', '2022-05-23 23:23:41'),
(4, 4, 1, 1, 'Validation terminée - en attente de visa', '2022-05-23 23:23:52', '2022-05-23 23:23:52'),
(5, 5, 1, 1, 'Visa terminé - ordre de recette à établir', '2022-05-23 23:24:02', '2022-05-23 23:24:02'),
(6, 6, 1, 1, 'Génération de l\'ordre de recette - en attente de paiement', '2022-05-23 23:24:12', '2022-05-23 23:24:12'),
(7, 7, 1, 2, 'Paiement de l\'ordre de recette n° 000001', '2022-05-23 23:24:37', '2022-05-23 23:24:37'),
(8, 8, 1, 1, 'Paiement confirmé - en attente de signature', '2022-05-23 23:24:49', '2022-05-23 23:24:49'),
(9, 10, 1, 1, 'Signature terminée - documents disponibles', '2022-05-23 23:25:13', '2022-05-23 23:25:13'),
(10, 10, 1, 1, 'Création du rapport d\'inspection', '2022-05-23 23:43:55', '2022-05-23 23:43:55');

--
-- Déchargement des données de la table `vehicule_amcs`
--

INSERT INTO `vehicule_amcs` (`id`, `numlvi`, `numvehicule`, `numconteneur`, `numplomb`, `idamc`, `created_at`, `updated_at`) VALUES
(1, '#123456', 'AM288AA', '#AZERTY', '6789', 1, '2022-05-05 19:52:10', '2022-05-05 19:52:10'),
(2, '#78901', 'EA288AA', '#QWERTY', '4567', 1, '2022-05-05 19:52:10', '2022-05-05 19:52:10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
