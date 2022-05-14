/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100422
Source Host           : localhost:3306
Source Database       : testtask

Target Server Type    : MYSQL
Target Server Version : 100422
File Encoding         : 65001

Date: 2022-05-14 05:36:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash` double(10,2) NOT NULL DEFAULT 1000.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('1', 'Client 1', '858.00', '2022-05-14 04:44:25', '2022-05-14 01:25:36');
INSERT INTO `clients` VALUES ('2', 'Client 2', '940.00', '2022-05-14 04:44:25', null);
INSERT INTO `clients` VALUES ('3', 'Client 3', '1000.00', '2022-05-14 04:44:25', null);
INSERT INTO `clients` VALUES ('6', 'Client 4', '1000.00', '2022-05-14 01:25:07', '2022-05-14 01:25:07');

-- ----------------------------
-- Table structure for clients_stocks
-- ----------------------------
DROP TABLE IF EXISTS `clients_stocks`;
CREATE TABLE `clients_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `stock_id` bigint(20) unsigned NOT NULL,
  `volume` int(11) NOT NULL,
  `purchase_price` double(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_stocks_client_id_foreign` (`client_id`),
  KEY `clients_stocks_stock_id_foreign` (`stock_id`),
  CONSTRAINT `clients_stocks_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clients_stocks_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clients_stocks
-- ----------------------------
INSERT INTO `clients_stocks` VALUES ('1', '1', '1', '100', '0.50', '2022-05-14 04:44:25', null);
INSERT INTO `clients_stocks` VALUES ('2', '1', '1', '70', '0.50', '2022-05-14 04:44:25', null);
INSERT INTO `clients_stocks` VALUES ('3', '1', '2', '50', '1.00', '2022-05-14 04:44:25', null);
INSERT INTO `clients_stocks` VALUES ('4', '2', '1', '20', '0.50', '2022-05-14 04:44:25', null);
INSERT INTO `clients_stocks` VALUES ('5', '2', '2', '50', '1.00', '2022-05-14 04:44:25', null);
INSERT INTO `clients_stocks` VALUES ('6', '1', '1', '10', '0.70', '2022-05-14 01:25:36', '2022-05-14 01:25:36');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('2', '2022_05_10_222319_create_clients_table', '1');
INSERT INTO `migrations` VALUES ('3', '2022_05_10_222339_create_stocks_table', '1');
INSERT INTO `migrations` VALUES ('4', '2022_05_11_210014_create_clients_stocks_table', '1');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for stocks
-- ----------------------------
DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stocks
-- ----------------------------
INSERT INTO `stocks` VALUES ('1', 'Company 1', '0.70', '2022-05-14 04:44:25', null);
INSERT INTO `stocks` VALUES ('2', 'Company 2', '0.40', '2022-05-14 04:44:25', null);
INSERT INTO `stocks` VALUES ('3', 'Company 3', '2.00', '2022-05-14 04:44:25', null);
SET FOREIGN_KEY_CHECKS=1;
