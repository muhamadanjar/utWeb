/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : localhost:3306
 Source Schema         : rental

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 30/04/2019 14:35:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
INSERT INTO `cache` VALUES ('laravel8645fb9a2465b3fdf4e89516ec5ae0a4288a8ad9', 'eyJpdiI6Im1BYkdtVUIzdHR3MkQwVVJBZEx5QkE9PSIsInZhbHVlIjoidFBWSldhc0sxYmVYdVFPYWFRRlZIQT09IiwibWFjIjoiNjgzYTBhNTdiNGEyZWNhZmU4MGQ4NzQ5MGE2YWJjNThhYTQ1YTQzNjJiNWZiZjA1YTk3NzMxYTg5ODU0YmIzYyJ9', 1556607109);
INSERT INTO `cache` VALUES ('laravelc50bbefd1cfb096a8953509fa1e4931074d54503', 'eyJpdiI6ImQwSjZCZVZCQXlaRnFaaXpJaFA3bUE9PSIsInZhbHVlIjoiK1lzNjVZSlEySWJhS0xlMmlMVFRldz09IiwibWFjIjoiMmQ5NGZjNDZkOTY0YWYyOTQ5NDU2ZTU4OWQxYzRhNDNhOWRmNWIyNjUzYjE5N2Q0ZTdhNTk4MzcyZDE0OGY0YSJ9', 1556607069);
COMMIT;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `posted_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_author_id_foreign` (`author_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sex` enum('Laki-laki','Perempuan') COLLATE utf8_unicode_ci DEFAULT 'Laki-laki',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers
-- ----------------------------
BEGIN;
INSERT INTO `customers` VALUES (1, 'Laki-laki', 'Muhamad Anjar', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'dfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:05:04', '2018-04-21 15:05:04');
INSERT INTO `customers` VALUES (2, 'Laki-laki', 'apa saja', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'dfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:20:50', '2018-04-21 15:20:50');
INSERT INTO `customers` VALUES (3, 'Laki-laki', '232323', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'sdsd', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:29:02', '2018-04-21 15:29:02');
INSERT INTO `customers` VALUES (4, 'Laki-laki', 'dfdfdf', 'dfdfd@dfsd.vvfasdf', 'dfdfd@dfsd.vvfasdf', 'islam', NULL, 'fdsfsf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:30:40', '2018-04-21 15:30:40');
INSERT INTO `customers` VALUES (5, 'Laki-laki', 'dfdf', 'Adfdfd', 'Adfdfd', 'hindu', NULL, 'dfdfdfd', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:36:23', '2018-04-21 15:36:23');
INSERT INTO `customers` VALUES (6, 'Laki-laki', 'dfdf', 'dfdf', 'dfdf', 'islam', NULL, 'dfdfasdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:38:07', '2018-04-21 15:38:07');
INSERT INTO `customers` VALUES (7, 'Laki-laki', 'DASDFDFADF', 'DFADF@DFD.CSDS', 'DFADF@DFD.CSDS', 'islam', NULL, 'DFSDFDFD', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:43:38', '2018-04-21 15:43:38');
INSERT INTO `customers` VALUES (8, 'Laki-laki', 'Muhamad Anjar', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, '12345tyhjhgvbjjj', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:53:47', '2018-04-21 15:53:47');
INSERT INTO `customers` VALUES (9, 'Laki-laki', 'Muhamad Anjar Pangestu', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'dffdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 15:58:57', '2018-04-21 15:58:57');
INSERT INTO `customers` VALUES (10, 'Laki-laki', 'Bogor', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'dfdfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:01:15', '2018-04-21 16:01:15');
INSERT INTO `customers` VALUES (11, 'Laki-laki', 'Anjar', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, '34343434', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:06:35', '2018-04-21 16:06:35');
INSERT INTO `customers` VALUES (12, 'Laki-laki', 'Muhamd', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'dfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:21:51', '2018-04-21 16:21:51');
INSERT INTO `customers` VALUES (13, 'Laki-laki', '1', '1', '1', 'islam', NULL, '1', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:30:59', '2018-04-21 16:30:59');
INSERT INTO `customers` VALUES (14, 'Laki-laki', 'Muha', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'fdfd', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:34:19', '2018-04-21 16:34:19');
INSERT INTO `customers` VALUES (15, 'Laki-laki', '41231', 'arvanra', 'arvanra', 'islam', NULL, 'fdfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:36:25', '2018-04-21 16:36:25');
INSERT INTO `customers` VALUES (16, 'Laki-laki', 'Anjar P', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'fdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:46:50', '2018-04-21 16:46:50');
INSERT INTO `customers` VALUES (17, 'Laki-laki', '1', '1', '1', 'islam', NULL, 'hh', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 16:55:35', '2018-04-21 16:55:35');
INSERT INTO `customers` VALUES (18, 'Laki-laki', 'adad', 'fdfadfadf', 'fdfadfadf', 'islam', NULL, 'dddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 17:00:18', '2018-04-21 17:00:18');
INSERT INTO `customers` VALUES (19, 'Laki-laki', 'Muhamad a', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'jkkjjj', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-21 17:10:23', '2018-04-21 17:10:23');
INSERT INTO `customers` VALUES (20, 'Laki-laki', 'Anjar', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'Caringin Bogor', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-22 15:13:36', '2018-04-22 15:13:36');
INSERT INTO `customers` VALUES (21, 'Laki-laki', 'Anjar Uwi', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'Caringin ', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-25 09:46:22', '2018-04-25 09:46:22');
INSERT INTO `customers` VALUES (22, 'Laki-laki', 'Anjr', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'Bogor', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-25 13:20:34', '2018-04-25 13:20:34');
INSERT INTO `customers` VALUES (23, 'Laki-laki', 'Muhamad Anjar', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'Caringin', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-26 07:16:29', '2018-04-26 07:16:29');
INSERT INTO `customers` VALUES (24, 'Laki-laki', 'B', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'bxnsjsb', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-26 08:50:05', '2018-04-26 08:50:05');
INSERT INTO `customers` VALUES (25, 'Perempuan', 'Uwi', 'uwiyuli37@gmail.com', 'uwiyuli37@gmail.com', 'islam', NULL, 'bxjznns', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 00:16:01', '2018-04-27 00:16:01');
INSERT INTO `customers` VALUES (26, 'Laki-laki', 'C', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'C', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 01:31:31', '2018-04-27 01:31:31');
INSERT INTO `customers` VALUES (27, 'Perempuan', 'Uwi', 'uwiyuli37@gmail.com', 'uwiyuli37@gmail.com', 'islam', NULL, 'hdn dn', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 01:43:58', '2018-04-27 01:43:58');
INSERT INTO `customers` VALUES (28, 'Laki-laki', 'Muhamad Anjar Pangestu', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'Caringin Bogor', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 03:49:07', '2018-04-27 03:49:07');
INSERT INTO `customers` VALUES (29, 'Laki-laki', 'd', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'ggggg', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 04:06:17', '2018-04-27 04:06:17');
INSERT INTO `customers` VALUES (30, 'Laki-laki', 'Muhamad A', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'awesdfghkjl;utdrfghjk', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 04:30:11', '2018-04-27 04:30:11');
INSERT INTO `customers` VALUES (31, 'Laki-laki', 'V', 'arvanria@gmail.com', '087870427227', 'islam', NULL, 'h', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 04:40:15', '2018-04-27 04:40:15');
INSERT INTO `customers` VALUES (32, 'Laki-laki', 'Q', 'arvanria@gmail.com', '1234567890-', 'islam', NULL, 'dfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 05:28:43', '2018-04-27 05:28:43');
INSERT INTO `customers` VALUES (33, 'Laki-laki', 'VB', 'arvanria@gmail.com', '22222', 'islam', NULL, '34343', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 05:55:00', '2018-04-27 05:55:00');
INSERT INTO `customers` VALUES (34, 'Laki-laki', 'GG', 'arvanria@gmail.com', '5686489', 'islam', NULL, 'bdjdnns', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 09:11:17', '2018-04-27 09:11:17');
INSERT INTO `customers` VALUES (35, 'Laki-laki', 'J', 'arvanria@gmail.com', '34343434', 'islam', NULL, 'dfdfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 09:18:23', '2018-04-27 09:18:23');
INSERT INTO `customers` VALUES (36, 'Laki-laki', 'LKJ', 'arvanria@gmail.com', '12345678', 'islam', NULL, 'fffffff', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 09:50:05', '2018-04-27 09:50:05');
INSERT INTO `customers` VALUES (37, 'Laki-laki', 'ABC', 'arvanria@gmail.com', '1234567890-', 'islam', NULL, 'jdkkdk', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 10:04:29', '2018-04-27 10:04:29');
INSERT INTO `customers` VALUES (38, 'Laki-laki', 'OP', 'arvanria@gmail.com', '234567890-', 'islam', NULL, 'dffdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 10:10:11', '2018-04-27 10:10:11');
INSERT INTO `customers` VALUES (39, 'Laki-laki', 'Muhamad Anjar', 'arvanria@gmail.com', '09080899', 'islam', NULL, 'Jl Raya Bogor', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 10:22:56', '2018-04-27 10:22:56');
INSERT INTO `customers` VALUES (40, 'Laki-laki', 'Pangestu', 'arvanria@gmail.com', '087870427227', 'islam', NULL, 'akakak', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 11:02:03', '2018-04-27 11:02:03');
INSERT INTO `customers` VALUES (41, 'Laki-laki', 'Ihwan', 'Ihwan@futuremediadevelop.com', 'Ihwan@futuremediadevelop.com', 'islam', NULL, 'Alamat apa ini jar', NULL, NULL, NULL, NULL, 0, NULL, '2018-04-27 12:44:42', '2018-04-27 12:44:42');
INSERT INTO `customers` VALUES (42, 'Laki-laki', 'Muhamad Anjar P', 'arvanria@gmail.com', '087870427227', 'islam', NULL, 'Jl. Raya Sukabumi ', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-02 08:40:17', '2018-05-02 08:40:17');
INSERT INTO `customers` VALUES (43, 'Laki-laki', 'Mua', 'arvanria@gmail.com', '087870427227', 'islam', NULL, 'Bbbb', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-02 08:58:38', '2018-05-02 08:58:38');
INSERT INTO `customers` VALUES (44, 'Laki-laki', 'Mua', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'Bbbb', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-02 09:00:11', '2018-05-02 09:00:11');
INSERT INTO `customers` VALUES (45, 'Laki-laki', 'DC', 'arvanria@gmail.com', '123456890', 'islam', NULL, 'dfdfd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-02 11:43:21', '2018-05-02 11:43:21');
INSERT INTO `customers` VALUES (46, 'Laki-laki', 'AB', 'ddd', 'ddd', 'islam', NULL, 'dddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-02 11:49:24', '2018-05-02 11:49:24');
INSERT INTO `customers` VALUES (47, 'Laki-laki', 'M Anjar P', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'dfdfdfd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-03 09:33:56', '2018-05-03 09:33:56');
INSERT INTO `customers` VALUES (48, 'Laki-laki', 'M', 'muhamadanjar37@gmail.com', 'muhamadanjar37@gmail.com', 'islam', NULL, 'fffff', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-03 12:49:51', '2018-05-03 12:49:51');
INSERT INTO `customers` VALUES (49, 'Laki-laki', 'M', 'muhamadanjar37@gmail.com', 'muhamadanjar37@gmail.com', 'islam', NULL, 'fffff', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-03 12:59:01', '2018-05-03 12:59:01');
INSERT INTO `customers` VALUES (50, 'Laki-laki', 'M', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'dfdfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-03 13:00:43', '2018-05-03 13:00:43');
INSERT INTO `customers` VALUES (51, 'Laki-laki', 'A', 'arvanria@gmail.com', '5886555', 'islam', NULL, 'jhkl', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 15:22:11', '2018-05-04 15:22:11');
INSERT INTO `customers` VALUES (52, 'Laki-laki', 'A', 'arvanria@gmail.com', 'arvanria@gmail.com', 'islam', NULL, 'jhkl', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 15:28:04', '2018-05-04 15:28:04');
INSERT INTO `customers` VALUES (53, 'Laki-laki', 'H', 'arvanria@gmail.com', '33333', 'islam', NULL, 'dfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 15:35:05', '2018-05-04 15:35:05');
INSERT INTO `customers` VALUES (54, 'Laki-laki', 'P', 'arvanria@gmail.com', '3333', 'hindu', NULL, 'ddddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 15:55:57', '2018-05-04 15:55:57');
INSERT INTO `customers` VALUES (55, 'Laki-laki', 'P', 'arvanria02@gmail.com', '333333', 'islam', NULL, 'dfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 16:04:16', '2018-05-04 16:04:16');
INSERT INTO `customers` VALUES (56, 'Laki-laki', 'Z', 'Z', 'Z', 'islam', NULL, 'ddddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 16:07:20', '2018-05-04 16:07:20');
INSERT INTO `customers` VALUES (57, 'Laki-laki', 'ddd', 'dddd', '4444', 'islam', NULL, 'dSdddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 16:20:35', '2018-05-04 16:20:35');
INSERT INTO `customers` VALUES (58, 'Laki-laki', 'OP', 'arvanria@gmail.com', '33333', 'islam', NULL, 'dfdfdfd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 16:24:34', '2018-05-04 16:24:34');
INSERT INTO `customers` VALUES (59, 'Laki-laki', 'LK', 'arvanria@gmail.com', '33333', 'islam', NULL, 'dfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 16:27:21', '2018-05-04 16:27:21');
INSERT INTO `customers` VALUES (60, 'Laki-laki', 'CA', 'dfdfdf', '343434', 'islam', NULL, 'dfdfdfdf', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 16:38:24', '2018-05-04 16:38:24');
INSERT INTO `customers` VALUES (61, 'Laki-laki', 'l', 'l', '9080', 'hindu', NULL, 'Wx', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 16:44:42', '2018-05-04 16:44:42');
INSERT INTO `customers` VALUES (62, 'Laki-laki', 'd', 'arvanria@gmail.com', '33333', 'islam', NULL, 'ddddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 17:00:04', '2018-05-04 17:00:04');
INSERT INTO `customers` VALUES (63, 'Laki-laki', 'BV', 'dfd', '3333', 'islam', NULL, 'dddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 17:02:16', '2018-05-04 17:02:16');
INSERT INTO `customers` VALUES (64, 'Laki-laki', 'dd', 'ddd', 'd1125', 'islam', NULL, 'dddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 17:20:41', '2018-05-04 17:20:41');
INSERT INTO `customers` VALUES (65, 'Laki-laki', 'A', 'A', '3333', 'islam', NULL, 'dfdffd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-04 23:13:52', '2018-05-04 23:13:52');
INSERT INTO `customers` VALUES (66, 'Laki-laki', 'ddfdfdf', 'arvanria@gmail.com', '3333', 'islam', NULL, 'dffsdfd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-05 00:32:40', '2018-05-05 00:32:40');
INSERT INTO `customers` VALUES (67, 'Laki-laki', 'BV', 'arvanria@gmail.com', '34343434', 'islam', NULL, 'H', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-05 00:36:47', '2018-05-05 00:36:47');
INSERT INTO `customers` VALUES (68, 'Laki-laki', 'MA', 'arvanria@gmail.com', '3333333', 'islam', NULL, 'ddddd', NULL, NULL, NULL, NULL, 0, NULL, '2018-05-05 04:25:25', '2018-05-05 04:25:25');
INSERT INTO `customers` VALUES (69, 'Laki-laki', 'ddddd', 'dddd@dddd.comd', 'dddd@dddd.comd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-09 06:25:24', '2018-05-09 06:25:24');
INSERT INTO `customers` VALUES (70, 'Laki-laki', '334343', '433434@ffdfd.com', '433434@ffdfd.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-09 06:36:26', '2018-05-09 06:36:26');
INSERT INTO `customers` VALUES (71, 'Laki-laki', 'dddd', 'ddd@dddd.vom', 'ddd@dddd.vom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-09 06:41:36', '2018-05-09 06:41:36');
INSERT INTO `customers` VALUES (72, 'Laki-laki', 'Muhamad Anjar P', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-10 03:33:29', '2018-05-10 03:33:29');
INSERT INTO `customers` VALUES (73, 'Laki-laki', 'ddd', 'df2@dffdf.vghg', 'df2@dffdf.vghg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-10 03:53:20', '2018-05-10 03:53:20');
INSERT INTO `customers` VALUES (74, 'Laki-laki', 'Rajana', 'arvanria@gmail.com', '087870427227', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-10 06:39:49', '2018-05-10 06:39:49');
INSERT INTO `customers` VALUES (75, 'Laki-laki', 'dddd', 'ddd@ddd.ddd', '34343434', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-10 06:42:36', '2018-05-10 06:42:36');
INSERT INTO `customers` VALUES (76, 'Laki-laki', 'fff', 'adfdf@dfdf.com', '343434', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-10 06:45:05', '2018-05-10 06:45:05');
INSERT INTO `customers` VALUES (77, 'Laki-laki', 'Ihwan', 'ihwan.sofian@gmail.com', 'ihwan.sofian@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-10 15:03:01', '2018-05-10 15:03:01');
INSERT INTO `customers` VALUES (78, 'Laki-laki', 'Ihwan', 'ihwan.sofian@gmail.com', 'ihwan.sofian@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-10 15:04:44', '2018-05-10 15:04:44');
INSERT INTO `customers` VALUES (79, 'Laki-laki', 'Ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-18 13:25:20', '2018-05-18 13:25:20');
INSERT INTO `customers` VALUES (80, 'Laki-laki', 'Umar', 'Umur.ui@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-18 13:32:35', '2018-05-18 13:32:35');
INSERT INTO `customers` VALUES (81, 'Laki-laki', 'Wira', 'wira.wira@gmail.com', 'wira.wira@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-18 13:34:52', '2018-05-18 13:34:52');
INSERT INTO `customers` VALUES (82, 'Laki-laki', 'Muhamad Anjar', 'arvanria@gmail.com', '087870427227', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-30 06:42:01', '2018-05-30 06:42:01');
INSERT INTO `customers` VALUES (83, 'Laki-laki', 'Ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-30 11:24:44', '2018-05-30 11:24:44');
INSERT INTO `customers` VALUES (84, 'Laki-laki', 'Ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-30 11:24:44', '2018-05-30 11:24:44');
INSERT INTO `customers` VALUES (85, 'Laki-laki', 'ihwantestrental', 'rental@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-31 09:24:54', '2018-05-31 09:24:54');
INSERT INTO `customers` VALUES (86, 'Laki-laki', 'Ihwantestrent', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-31 09:48:35', '2018-05-31 09:48:35');
INSERT INTO `customers` VALUES (87, 'Laki-laki', 'ihwantest', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-31 12:47:48', '2018-05-31 12:47:48');
INSERT INTO `customers` VALUES (88, 'Laki-laki', 'Ihwan', 'Ihwan.sofian@gmail.com', 'Ihwan.sofian@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-31 14:44:11', '2018-05-31 14:44:11');
INSERT INTO `customers` VALUES (89, 'Perempuan', 'BCC', 'arvanria@gmail.com', '955885', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-01 05:45:01', '2018-06-01 05:45:01');
INSERT INTO `customers` VALUES (90, 'Laki-laki', 'VVV', 'arvanria@gmail.com', '333333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-01 08:48:33', '2018-06-01 08:48:33');
INSERT INTO `customers` VALUES (91, 'Perempuan', 'Suka', 'utamatrans9@gmail.com', 'utamatrans9@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-01 23:45:34', '2018-06-01 23:45:34');
INSERT INTO `customers` VALUES (92, 'Laki-laki', 'Evi', 'utamatrans9@gmail.com', 'utamatrans9@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-02 03:38:21', '2018-06-02 03:38:21');
INSERT INTO `customers` VALUES (93, 'Laki-laki', 'Ok', 'Utamatrans9@gmail.com', 'Utamatrans9@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-04 05:11:53', '2018-06-04 05:11:53');
INSERT INTO `customers` VALUES (94, NULL, 'Muhamad Anjar ', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-09 11:51:45', '2018-06-09 11:51:45');
INSERT INTO `customers` VALUES (95, NULL, 'ihwan', 'ihwan.sofian@gmail.com', 'ihwan.sofian@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-09 12:20:39', '2018-06-09 12:20:39');
INSERT INTO `customers` VALUES (96, NULL, 'Anjar', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-09 14:07:45', '2018-06-09 14:07:45');
INSERT INTO `customers` VALUES (97, NULL, 'bdjd', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-09 14:12:45', '2018-06-09 14:12:45');
INSERT INTO `customers` VALUES (98, NULL, 'erik', 'erik@gmail.com', 'erik@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-09 14:19:29', '2018-06-09 14:19:29');
INSERT INTO `customers` VALUES (99, NULL, 'gdjsn', 'hsjsb@bdndnd.bdjd', 'hsjsb@bdndnd.bdjd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-09 14:23:10', '2018-06-09 14:23:10');
INSERT INTO `customers` VALUES (100, NULL, 'hdksns', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 05:30:45', '2018-06-10 05:30:45');
INSERT INTO `customers` VALUES (101, NULL, 'hdksns', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 05:30:51', '2018-06-10 05:30:51');
INSERT INTO `customers` VALUES (102, NULL, 'hdksns', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 05:30:55', '2018-06-10 05:30:55');
INSERT INTO `customers` VALUES (103, NULL, 'Anjar P', 'arvanria@gmailc.om', 'arvanria@gmailc.om', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 07:49:55', '2018-06-10 07:49:55');
INSERT INTO `customers` VALUES (104, NULL, 'fdfdffd', 'arvanria@gmail.com', 'arvanria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 08:01:14', '2018-06-10 08:01:14');
INSERT INTO `customers` VALUES (105, NULL, 'Ihwan', 'ihwan.sofian@gmail.com', 'ihwan.sofian@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 09:36:35', '2018-06-10 09:36:35');
INSERT INTO `customers` VALUES (106, NULL, 'Ihwan', 'ihwan.sofian@gmail.com', 'ihwan.sofian@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 10:27:38', '2018-06-10 10:27:38');
INSERT INTO `customers` VALUES (107, NULL, 'Ihwan testing', 'Ihwan.sofian@gmail.com', '708890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 15:18:43', '2018-06-10 15:18:43');
INSERT INTO `customers` VALUES (108, NULL, 'Ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-10 15:49:24', '2018-06-10 15:49:24');
INSERT INTO `customers` VALUES (109, NULL, 'Suk', 'utamatrans9@gmail.com', '081221853567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-11 02:06:49', '2018-06-11 02:06:49');
INSERT INTO `customers` VALUES (110, NULL, 'Ihwan.s', 'Ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-11 15:47:02', '2018-06-11 15:47:02');
INSERT INTO `customers` VALUES (111, NULL, 'ndkdm', 'arvanria@gmail.com', '087870427727', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 08:55:28', '2018-06-12 08:55:28');
INSERT INTO `customers` VALUES (112, NULL, 'Anjar Test', 'arvaria@gmail.com', '8789', NULL, NULL, '3434', NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:17:11', '2018-06-12 09:17:11');
INSERT INTO `customers` VALUES (113, NULL, 'Anjar Test', 'arvaria@gmail.com', '8789', NULL, NULL, '3434', NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:22:25', '2018-06-12 09:22:25');
INSERT INTO `customers` VALUES (114, NULL, 'Anjar Test', 'arvaria@gmail.com', '8789', NULL, NULL, '3434', NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:28:06', '2018-06-12 09:28:06');
INSERT INTO `customers` VALUES (115, NULL, 'Anjar Test', 'arvaria@gmail.com', '8789', NULL, NULL, '3434', NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:28:35', '2018-06-12 09:28:35');
INSERT INTO `customers` VALUES (116, NULL, 'Anjar Test', 'arvaria@gmail.com', '8789', NULL, NULL, '3434', NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:29:19', '2018-06-12 09:29:19');
INSERT INTO `customers` VALUES (117, NULL, 'Anjar Test', 'arvaria@gmail.com', '8789', NULL, NULL, '3434', NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:30:19', '2018-06-12 09:30:19');
INSERT INTO `customers` VALUES (118, NULL, 'Suki', 'utamatrans9@gmail.com', '081221853567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:32:11', '2018-06-12 09:32:11');
INSERT INTO `customers` VALUES (119, NULL, 'Suka', 'utamatrans9@gmail.com', '081221853567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:35:03', '2018-06-12 09:35:03');
INSERT INTO `customers` VALUES (120, NULL, 'Ihwan. Ss', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 09:50:30', '2018-06-12 09:50:30');
INSERT INTO `customers` VALUES (121, NULL, 'Ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 13:11:33', '2018-06-12 13:11:33');
INSERT INTO `customers` VALUES (122, NULL, 'anjar test 2', 'arvanria@gmail.com', '087870427227', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 13:37:14', '2018-06-12 13:37:14');
INSERT INTO `customers` VALUES (123, NULL, 'kaka', 'arvanria@gmail.com', '087870427227', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 15:15:14', '2018-06-12 15:15:14');
INSERT INTO `customers` VALUES (124, NULL, 'Anjar P', 'arvanria@gmail.com', '8575555755', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 15:30:27', '2018-06-12 15:30:27');
INSERT INTO `customers` VALUES (125, NULL, 'Samsung test ok', 'Samsung@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 16:22:13', '2018-06-12 16:22:13');
INSERT INTO `customers` VALUES (126, NULL, 'ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-12 17:01:49', '2018-06-12 17:01:49');
INSERT INTO `customers` VALUES (127, NULL, 'ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-24 07:06:09', '2018-06-24 07:06:09');
INSERT INTO `customers` VALUES (128, NULL, 'anjar p', 'arvanria@gmail.com', '087568658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-27 01:59:23', '2018-06-27 01:59:23');
INSERT INTO `customers` VALUES (129, NULL, 'ihwans', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-28 02:33:47', '2018-06-28 02:33:47');
INSERT INTO `customers` VALUES (130, NULL, 'ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-01 03:52:49', '2018-07-01 03:52:49');
INSERT INTO `customers` VALUES (131, NULL, 'ihwan', 'ihwan.sofian@gmail.com', '087787640467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-08 07:35:56', '2018-07-08 07:35:56');
INSERT INTO `customers` VALUES (132, NULL, 'Yenny', 'Yennynemonababan84@gmail.com', '081377713999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-11 11:12:10', '2018-07-11 11:12:10');
INSERT INTO `customers` VALUES (133, NULL, 'Suka', 'Utamatrans9@gmail.com', '081221853567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-11 14:26:20', '2018-07-11 14:26:20');
INSERT INTO `customers` VALUES (134, NULL, 'y', 'gagag@goo.com', '99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-11-03 11:24:30', '2018-11-03 11:24:30');
INSERT INTO `customers` VALUES (135, NULL, 'y', 'gagag@goo.com', '99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-11-03 11:24:30', '2018-11-03 11:24:30');
INSERT INTO `customers` VALUES (136, NULL, 'Ok ', 'Testinh@gmail.com', '081221853567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-11-04 05:03:06', '2018-11-04 05:03:06');
INSERT INTO `customers` VALUES (137, NULL, 'Widodo', 'Putrakleo04246@gmail.com', '081278645279', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-12-31 01:20:58', '2018-12-31 01:20:58');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for fasilitas
-- ----------------------------
DROP TABLE IF EXISTS `fasilitas`;
CREATE TABLE `fasilitas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for fbstatus
-- ----------------------------
DROP TABLE IF EXISTS `fbstatus`;
CREATE TABLE `fbstatus` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_text` text CHARACTER SET latin1,
  `t_status` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fbstatus
-- ----------------------------
BEGIN;
INSERT INTO `fbstatus` VALUES (1, 'dfdfdf', '2018-04-08 05:28:10');
INSERT INTO `fbstatus` VALUES (2, 'apa adanya', '2018-04-08 06:05:30');
INSERT INTO `fbstatus` VALUES (3, 'dffd', '2018-04-10 03:36:47');
INSERT INTO `fbstatus` VALUES (4, 'fgfgfg', '2018-04-10 03:41:58');
INSERT INTO `fbstatus` VALUES (5, 'dfddfdf', '2018-04-10 03:42:14');
INSERT INTO `fbstatus` VALUES (6, 'aaa', '2018-04-10 03:42:33');
INSERT INTO `fbstatus` VALUES (7, 'bbb', '2018-04-10 03:42:54');
INSERT INTO `fbstatus` VALUES (8, 'qwertyuiop', '2018-04-10 03:43:11');
INSERT INTO `fbstatus` VALUES (9, 'abc', '2018-04-10 03:45:06');
INSERT INTO `fbstatus` VALUES (10, 'ple', '2018-04-10 03:48:39');
INSERT INTO `fbstatus` VALUES (11, 'qqqqq', '2018-04-10 03:50:49');
INSERT INTO `fbstatus` VALUES (12, 'lklklk', '2018-04-10 03:53:38');
INSERT INTO `fbstatus` VALUES (13, 'ffgfg', '2018-04-10 03:56:08');
INSERT INTO `fbstatus` VALUES (14, 'rtrtr', '2018-04-10 04:07:33');
INSERT INTO `fbstatus` VALUES (15, 'dfdf', '2018-04-10 04:12:42');
INSERT INTO `fbstatus` VALUES (16, 'l', '2018-04-10 04:13:40');
INSERT INTO `fbstatus` VALUES (17, '123456', '2018-04-10 04:17:34');
INSERT INTO `fbstatus` VALUES (18, 'fdasf', '2018-04-10 05:51:00');
INSERT INTO `fbstatus` VALUES (19, '', '2018-04-10 10:14:55');
INSERT INTO `fbstatus` VALUES (20, '', '2018-04-10 10:15:36');
INSERT INTO `fbstatus` VALUES (21, 'ffgg', '2018-04-10 10:17:27');
INSERT INTO `fbstatus` VALUES (22, 'fsfsafdafd', '2018-04-10 10:17:47');
INSERT INTO `fbstatus` VALUES (23, 'fgfdg', '2018-04-11 05:12:37');
COMMIT;

-- ----------------------------
-- Table structure for hubungi
-- ----------------------------
DROP TABLE IF EXISTS `hubungi`;
CREATE TABLE `hubungi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pesan` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `posted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dibaca` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of hubungi
-- ----------------------------
BEGIN;
INSERT INTO `hubungi` VALUES (1, 'anjar', 'arvanria@gmai.com', 'dfdfadfafddf', '2018-06-09 09:35:39', '0', '2018-06-09 09:35:39', '2018-06-09 09:35:39');
INSERT INTO `hubungi` VALUES (2, 'anjar', 'arvanria@gmai.com', 'dfdfadfafddf', '2018-06-09 09:36:29', '0', '2018-06-09 09:36:29', '2018-06-09 09:36:29');
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for kritiksaran
-- ----------------------------
DROP TABLE IF EXISTS `kritiksaran`;
CREATE TABLE `kritiksaran` (
  `id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `kritik_saran` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for log_activities
-- ----------------------------
DROP TABLE IF EXISTS `log_activities`;
CREATE TABLE `log_activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `subject_type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `predicate` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_id` bigint(20) unsigned DEFAULT NULL,
  `object_type` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_activities_subject_id_subject_type_index` (`subject_id`,`subject_type`),
  KEY `log_activities_predicate_index` (`predicate`),
  KEY `log_activities_object_id_object_type_index` (`object_id`,`object_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for log_revisions
-- ----------------------------
DROP TABLE IF EXISTS `log_revisions`;
CREATE TABLE `log_revisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `revisionable_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8_unicode_ci,
  `new_value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log_revisions
-- ----------------------------
BEGIN;
INSERT INTO `log_revisions` VALUES (1, 'App\\Officer\\Officer', 1, 1, NULL, 'name', NULL, 'Muhamad Anjar P', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (2, 'App\\Officer\\Officer', 1, 1, NULL, 'nip', NULL, ' ', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (3, 'App\\Officer\\Officer', 1, 1, NULL, 'alamat', NULL, 'Caringin', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (4, 'App\\Officer\\Officer', 1, 1, NULL, 'no_telp', NULL, '0000', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (5, 'App\\Officer\\Officer', 1, 1, NULL, 'role', NULL, 'staff/karyawan', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (6, 'App\\Officer\\Officer', 1, 1, NULL, 'name', NULL, 'Muhamad Anjar P', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (7, 'App\\Officer\\Officer', 1, 1, NULL, 'nip', NULL, ' ', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (8, 'App\\Officer\\Officer', 1, 1, NULL, 'alamat', NULL, 'Caringin', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (9, 'App\\Officer\\Officer', 1, 1, NULL, 'no_telp', NULL, '0000', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (10, 'App\\Officer\\Officer', 1, 1, NULL, 'role', NULL, 'staff/karyawan', '2018-03-29 16:50:45', '2018-03-29 16:50:45');
INSERT INTO `log_revisions` VALUES (53, 'App\\Officer\\Officer', 13, 2, NULL, 'name', NULL, 'ihwan', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (54, 'App\\Officer\\Officer', 13, 2, NULL, 'nip', NULL, ' ', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (55, 'App\\Officer\\Officer', 13, 2, NULL, 'alamat', NULL, 'Bogor Jawa barat', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (56, 'App\\Officer\\Officer', 13, 2, NULL, 'no_telp', NULL, '087787640467', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (57, 'App\\Officer\\Officer', 13, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (58, 'App\\Officer\\Officer', 13, 2, NULL, 'user_id', NULL, '30', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (59, 'App\\Officer\\Officer', 13, 2, NULL, 'deposit', NULL, '100000', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (60, 'App\\Officer\\Officer', 13, 2, NULL, 'name', NULL, 'ihwan', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (61, 'App\\Officer\\Officer', 13, 2, NULL, 'nip', NULL, ' ', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (62, 'App\\Officer\\Officer', 13, 2, NULL, 'alamat', NULL, 'Bogor Jawa barat', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (63, 'App\\Officer\\Officer', 13, 2, NULL, 'no_telp', NULL, '087787640467', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (64, 'App\\Officer\\Officer', 13, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (65, 'App\\Officer\\Officer', 13, 2, NULL, 'user_id', NULL, '30', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (66, 'App\\Officer\\Officer', 13, 2, NULL, 'deposit', NULL, '100000', '2018-05-26 14:55:27', '2018-05-26 14:55:27');
INSERT INTO `log_revisions` VALUES (67, 'App\\Officer\\Officer', 14, 1, NULL, 'name', NULL, 'Muhamad Anjar', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (68, 'App\\Officer\\Officer', 14, 1, NULL, 'nip', NULL, '33556', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (69, 'App\\Officer\\Officer', 14, 1, NULL, 'alamat', NULL, 'Caringin Bogor', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (70, 'App\\Officer\\Officer', 14, 1, NULL, 'no_telp', NULL, '087870427227', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (71, 'App\\Officer\\Officer', 14, 1, NULL, 'role', NULL, 'staff/karyawan', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (72, 'App\\Officer\\Officer', 14, 1, NULL, 'user_id', NULL, '31', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (73, 'App\\Officer\\Officer', 14, 1, NULL, 'deposit', NULL, '1500000', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (74, 'App\\Officer\\Officer', 14, 1, NULL, 'name', NULL, 'Muhamad Anjar', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (75, 'App\\Officer\\Officer', 14, 1, NULL, 'nip', NULL, '33556', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (76, 'App\\Officer\\Officer', 14, 1, NULL, 'alamat', NULL, 'Caringin Bogor', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (77, 'App\\Officer\\Officer', 14, 1, NULL, 'no_telp', NULL, '087870427227', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (78, 'App\\Officer\\Officer', 14, 1, NULL, 'role', NULL, 'staff/karyawan', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (79, 'App\\Officer\\Officer', 14, 1, NULL, 'user_id', NULL, '31', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (80, 'App\\Officer\\Officer', 14, 1, NULL, 'deposit', NULL, '1500000', '2018-06-11 07:47:27', '2018-06-11 07:47:27');
INSERT INTO `log_revisions` VALUES (81, 'App\\Officer\\Officer', 15, 2, NULL, 'name', NULL, 'Testing ihwan Driver', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (82, 'App\\Officer\\Officer', 15, 2, NULL, 'nip', NULL, '1223334455677889', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (83, 'App\\Officer\\Officer', 15, 2, NULL, 'alamat', NULL, 'Gadog Jawabarat', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (84, 'App\\Officer\\Officer', 15, 2, NULL, 'no_telp', NULL, '087787640467', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (85, 'App\\Officer\\Officer', 15, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (86, 'App\\Officer\\Officer', 15, 2, NULL, 'user_id', NULL, '34', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (87, 'App\\Officer\\Officer', 15, 2, NULL, 'deposit', NULL, '100000', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (88, 'App\\Officer\\Officer', 15, 2, NULL, 'name', NULL, 'Testing ihwan Driver', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (89, 'App\\Officer\\Officer', 15, 2, NULL, 'nip', NULL, '1223334455677889', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (90, 'App\\Officer\\Officer', 15, 2, NULL, 'alamat', NULL, 'Gadog Jawabarat', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (91, 'App\\Officer\\Officer', 15, 2, NULL, 'no_telp', NULL, '087787640467', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (92, 'App\\Officer\\Officer', 15, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (93, 'App\\Officer\\Officer', 15, 2, NULL, 'user_id', NULL, '34', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (94, 'App\\Officer\\Officer', 15, 2, NULL, 'deposit', NULL, '100000', '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `log_revisions` VALUES (95, 'App\\Officer\\Officer', 15, 1, NULL, 'deposit', '100000', '170000', '2018-06-11 14:16:08', '2018-06-11 14:16:08');
INSERT INTO `log_revisions` VALUES (96, 'App\\Officer\\Officer', 15, 1, NULL, 'deposit', '100000', '170000', '2018-06-11 14:16:08', '2018-06-11 14:16:08');
INSERT INTO `log_revisions` VALUES (97, 'App\\Officer\\Officer', 16, 2, NULL, 'name', NULL, 'Ihwans', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (98, 'App\\Officer\\Officer', 16, 2, NULL, 'nip', NULL, '32331587468881', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (99, 'App\\Officer\\Officer', 16, 2, NULL, 'alamat', NULL, 'Kksnmmdldmdmskms', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (100, 'App\\Officer\\Officer', 16, 2, NULL, 'no_telp', NULL, '85421334555', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (101, 'App\\Officer\\Officer', 16, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (102, 'App\\Officer\\Officer', 16, 2, NULL, 'user_id', NULL, '37', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (103, 'App\\Officer\\Officer', 16, 2, NULL, 'deposit', NULL, '100000', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (104, 'App\\Officer\\Officer', 16, 2, NULL, 'name', NULL, 'Ihwans', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (105, 'App\\Officer\\Officer', 16, 2, NULL, 'nip', NULL, '32331587468881', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (106, 'App\\Officer\\Officer', 16, 2, NULL, 'alamat', NULL, 'Kksnmmdldmdmskms', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (107, 'App\\Officer\\Officer', 16, 2, NULL, 'no_telp', NULL, '85421334555', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (108, 'App\\Officer\\Officer', 16, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (109, 'App\\Officer\\Officer', 16, 2, NULL, 'user_id', NULL, '37', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (110, 'App\\Officer\\Officer', 16, 2, NULL, 'deposit', NULL, '100000', '2018-06-11 15:01:22', '2018-06-11 15:01:22');
INSERT INTO `log_revisions` VALUES (111, 'App\\Officer\\Officer', 15, NULL, NULL, 'deposit', '170000', '162051.2', '2018-06-11 17:43:20', '2018-06-11 17:43:20');
INSERT INTO `log_revisions` VALUES (112, 'App\\Officer\\Officer', 15, NULL, NULL, 'deposit', '170000', '162051.2', '2018-06-11 17:43:20', '2018-06-11 17:43:20');
INSERT INTO `log_revisions` VALUES (113, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '100000', '92719', '2018-06-12 08:11:23', '2018-06-12 08:11:23');
INSERT INTO `log_revisions` VALUES (114, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '100000', '92719', '2018-06-12 08:11:23', '2018-06-12 08:11:23');
INSERT INTO `log_revisions` VALUES (115, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '92719', '62396.8', '2018-06-12 09:54:45', '2018-06-12 09:54:45');
INSERT INTO `log_revisions` VALUES (116, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '92719', '62396.8', '2018-06-12 09:54:45', '2018-06-12 09:54:45');
INSERT INTO `log_revisions` VALUES (117, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '62397', '56397', '2018-06-12 10:17:50', '2018-06-12 10:17:50');
INSERT INTO `log_revisions` VALUES (118, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '62397', '56397', '2018-06-12 10:17:50', '2018-06-12 10:17:50');
INSERT INTO `log_revisions` VALUES (119, 'App\\Officer\\Officer', 16, 2, NULL, 'deposit', '56397', '156397', '2018-06-12 13:13:34', '2018-06-12 13:13:34');
INSERT INTO `log_revisions` VALUES (120, 'App\\Officer\\Officer', 16, 2, NULL, 'deposit', '56397', '156397', '2018-06-12 13:13:34', '2018-06-12 13:13:34');
INSERT INTO `log_revisions` VALUES (121, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '156397', '96397', '2018-06-12 13:17:38', '2018-06-12 13:17:38');
INSERT INTO `log_revisions` VALUES (122, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '156397', '96397', '2018-06-12 13:17:38', '2018-06-12 13:17:38');
INSERT INTO `log_revisions` VALUES (123, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '96397', '6877', '2018-06-12 18:41:43', '2018-06-12 18:41:43');
INSERT INTO `log_revisions` VALUES (124, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '96397', '6877', '2018-06-12 18:41:43', '2018-06-12 18:41:43');
INSERT INTO `log_revisions` VALUES (125, 'App\\Officer\\Officer', 16, 2, NULL, 'no_telp', '85421334555', '087787640467', '2018-06-12 18:47:37', '2018-06-12 18:47:37');
INSERT INTO `log_revisions` VALUES (126, 'App\\Officer\\Officer', 16, 2, NULL, 'deposit', '6877', '306877', '2018-06-12 18:47:37', '2018-06-12 18:47:37');
INSERT INTO `log_revisions` VALUES (127, 'App\\Officer\\Officer', 16, 2, NULL, 'no_telp', '85421334555', '087787640467', '2018-06-12 18:47:37', '2018-06-12 18:47:37');
INSERT INTO `log_revisions` VALUES (128, 'App\\Officer\\Officer', 16, 2, NULL, 'deposit', '6877', '306877', '2018-06-12 18:47:37', '2018-06-12 18:47:37');
INSERT INTO `log_revisions` VALUES (129, 'App\\Officer\\Officer', 17, 2, NULL, 'name', NULL, 'ihwan.ss', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (130, 'App\\Officer\\Officer', 17, 2, NULL, 'nip', NULL, '78169263941629374619', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (131, 'App\\Officer\\Officer', 17, 2, NULL, 'alamat', NULL, 'Bogor City Gadog', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (132, 'App\\Officer\\Officer', 17, 2, NULL, 'no_telp', NULL, '087787640467', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (133, 'App\\Officer\\Officer', 17, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (134, 'App\\Officer\\Officer', 17, 2, NULL, 'user_id', NULL, '39', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (135, 'App\\Officer\\Officer', 17, 2, NULL, 'deposit', NULL, '200000', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (136, 'App\\Officer\\Officer', 17, 2, NULL, 'name', NULL, 'ihwan.ss', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (137, 'App\\Officer\\Officer', 17, 2, NULL, 'nip', NULL, '78169263941629374619', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (138, 'App\\Officer\\Officer', 17, 2, NULL, 'alamat', NULL, 'Bogor City Gadog', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (139, 'App\\Officer\\Officer', 17, 2, NULL, 'no_telp', NULL, '087787640467', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (140, 'App\\Officer\\Officer', 17, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (141, 'App\\Officer\\Officer', 17, 2, NULL, 'user_id', NULL, '39', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (142, 'App\\Officer\\Officer', 17, 2, NULL, 'deposit', NULL, '200000', '2018-06-27 13:43:12', '2018-06-27 13:43:12');
INSERT INTO `log_revisions` VALUES (143, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '306877', '284937', '2018-07-11 13:54:05', '2018-07-11 13:54:05');
INSERT INTO `log_revisions` VALUES (144, 'App\\Officer\\Officer', 16, NULL, NULL, 'deposit', '306877', '284937', '2018-07-11 13:54:05', '2018-07-11 13:54:05');
INSERT INTO `log_revisions` VALUES (145, 'App\\Officer\\Officer', 18, 2, NULL, 'name', NULL, 'ihwana', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (146, 'App\\Officer\\Officer', 18, 2, NULL, 'nip', NULL, '1223344444444', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (147, 'App\\Officer\\Officer', 18, 2, NULL, 'alamat', NULL, 'kp.puncakbogor', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (148, 'App\\Officer\\Officer', 18, 2, NULL, 'no_telp', NULL, '087787640467', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (149, 'App\\Officer\\Officer', 18, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (150, 'App\\Officer\\Officer', 18, 2, NULL, 'user_id', NULL, '44', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (151, 'App\\Officer\\Officer', 18, 2, NULL, 'deposit', NULL, '300000', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (152, 'App\\Officer\\Officer', 18, 2, NULL, 'name', NULL, 'ihwana', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (153, 'App\\Officer\\Officer', 18, 2, NULL, 'nip', NULL, '1223344444444', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (154, 'App\\Officer\\Officer', 18, 2, NULL, 'alamat', NULL, 'kp.puncakbogor', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (155, 'App\\Officer\\Officer', 18, 2, NULL, 'no_telp', NULL, '087787640467', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (156, 'App\\Officer\\Officer', 18, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (157, 'App\\Officer\\Officer', 18, 2, NULL, 'user_id', NULL, '44', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (158, 'App\\Officer\\Officer', 18, 2, NULL, 'deposit', NULL, '300000', '2018-11-03 11:49:11', '2018-11-03 11:49:11');
INSERT INTO `log_revisions` VALUES (159, 'App\\Officer\\Officer', 19, 2, NULL, 'name', NULL, 'ihwantesting', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (160, 'App\\Officer\\Officer', 19, 2, NULL, 'nip', NULL, '1233334443333', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (161, 'App\\Officer\\Officer', 19, 2, NULL, 'alamat', NULL, 'bogor kota', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (162, 'App\\Officer\\Officer', 19, 2, NULL, 'no_telp', NULL, '087787640467', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (163, 'App\\Officer\\Officer', 19, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (164, 'App\\Officer\\Officer', 19, 2, NULL, 'user_id', NULL, '45', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (165, 'App\\Officer\\Officer', 19, 2, NULL, 'deposit', NULL, '300000', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (166, 'App\\Officer\\Officer', 19, 2, NULL, 'name', NULL, 'ihwantesting', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (167, 'App\\Officer\\Officer', 19, 2, NULL, 'nip', NULL, '1233334443333', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (168, 'App\\Officer\\Officer', 19, 2, NULL, 'alamat', NULL, 'bogor kota', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (169, 'App\\Officer\\Officer', 19, 2, NULL, 'no_telp', NULL, '087787640467', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (170, 'App\\Officer\\Officer', 19, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (171, 'App\\Officer\\Officer', 19, 2, NULL, 'user_id', NULL, '45', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (172, 'App\\Officer\\Officer', 19, 2, NULL, 'deposit', NULL, '300000', '2018-11-03 12:36:51', '2018-11-03 12:36:51');
INSERT INTO `log_revisions` VALUES (173, 'App\\Officer\\Officer', 20, 2, NULL, 'name', NULL, 'Rudy', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (174, 'App\\Officer\\Officer', 20, 2, NULL, 'nip', NULL, '122222333322', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (175, 'App\\Officer\\Officer', 20, 2, NULL, 'alamat', NULL, 'jl.beo beo aja deh', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (176, 'App\\Officer\\Officer', 20, 2, NULL, 'no_telp', NULL, '08131234567', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (177, 'App\\Officer\\Officer', 20, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (178, 'App\\Officer\\Officer', 20, 2, NULL, 'user_id', NULL, '46', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (179, 'App\\Officer\\Officer', 20, 2, NULL, 'deposit', NULL, '300000', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (180, 'App\\Officer\\Officer', 20, 2, NULL, 'name', NULL, 'Rudy', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (181, 'App\\Officer\\Officer', 20, 2, NULL, 'nip', NULL, '122222333322', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (182, 'App\\Officer\\Officer', 20, 2, NULL, 'alamat', NULL, 'jl.beo beo aja deh', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (183, 'App\\Officer\\Officer', 20, 2, NULL, 'no_telp', NULL, '08131234567', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (184, 'App\\Officer\\Officer', 20, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (185, 'App\\Officer\\Officer', 20, 2, NULL, 'user_id', NULL, '46', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (186, 'App\\Officer\\Officer', 20, 2, NULL, 'deposit', NULL, '300000', '2018-11-04 04:56:02', '2018-11-04 04:56:02');
INSERT INTO `log_revisions` VALUES (187, 'App\\Officer\\Officer', 20, 2, NULL, 'deposit', '300000', '500000', '2018-11-04 04:59:19', '2018-11-04 04:59:19');
INSERT INTO `log_revisions` VALUES (188, 'App\\Officer\\Officer', 20, 2, NULL, 'deposit', '300000', '500000', '2018-11-04 04:59:19', '2018-11-04 04:59:19');
INSERT INTO `log_revisions` VALUES (189, 'App\\Officer\\Officer', 21, 2, NULL, 'name', NULL, 'ihwan sofian', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (190, 'App\\Officer\\Officer', 21, 2, NULL, 'nip', NULL, '1223344455554', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (191, 'App\\Officer\\Officer', 21, 2, NULL, 'alamat', NULL, 'kp.gadog pandansari rt1 4', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (192, 'App\\Officer\\Officer', 21, 2, NULL, 'no_telp', NULL, '08777877665', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (193, 'App\\Officer\\Officer', 21, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (194, 'App\\Officer\\Officer', 21, 2, NULL, 'user_id', NULL, '47', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (195, 'App\\Officer\\Officer', 21, 2, NULL, 'deposit', NULL, '500000', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (196, 'App\\Officer\\Officer', 21, 2, NULL, 'name', NULL, 'ihwan sofian', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (197, 'App\\Officer\\Officer', 21, 2, NULL, 'nip', NULL, '1223344455554', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (198, 'App\\Officer\\Officer', 21, 2, NULL, 'alamat', NULL, 'kp.gadog pandansari rt1 4', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (199, 'App\\Officer\\Officer', 21, 2, NULL, 'no_telp', NULL, '08777877665', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (200, 'App\\Officer\\Officer', 21, 2, NULL, 'role', NULL, 'staff/karyawan', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (201, 'App\\Officer\\Officer', 21, 2, NULL, 'user_id', NULL, '47', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
INSERT INTO `log_revisions` VALUES (202, 'App\\Officer\\Officer', 21, 2, NULL, 'deposit', NULL, '500000', '2018-11-04 08:38:24', '2018-11-04 08:38:24');
COMMIT;

-- ----------------------------
-- Table structure for log_sewa_status
-- ----------------------------
DROP TABLE IF EXISTS `log_sewa_status`;
CREATE TABLE `log_sewa_status` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sewa_id` bigint(20) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log_sewa_status
-- ----------------------------
BEGIN;
INSERT INTO `log_sewa_status` VALUES (1, 11, '2018-04-05 15:36:56', '0', NULL, NULL);
INSERT INTO `log_sewa_status` VALUES (2, 11, '2018-04-05 15:37:04', '9', NULL, NULL);
INSERT INTO `log_sewa_status` VALUES (3, 11, '2018-04-05 15:44:48', '2', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for lookups
-- ----------------------------
DROP TABLE IF EXISTS `lookups`;
CREATE TABLE `lookups` (
  `id` int(10) unsigned NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `lookups_id_index` (`id`),
  KEY `lookups_type_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lookups
-- ----------------------------
BEGIN;
INSERT INTO `lookups` VALUES (1, 'jabatan', 'Operator', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (2, 'jabatan', 'Pengemudi / Driver', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (11, 'type_sewa', 'Rental', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (12, 'type_sewa', 'Taxi', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (21, 'status_sewa', 'pending', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (22, 'status_sewa', 'cancelled', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (23, 'status_sewa', 'confirmed', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (24, 'status_sewa', 'collected', NULL, NULL, NULL);
INSERT INTO `lookups` VALUES (25, 'status_sewa', 'complete', NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for merk
-- ----------------------------
DROP TABLE IF EXISTS `merk`;
CREATE TABLE `merk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `merk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of merk
-- ----------------------------
BEGIN;
INSERT INTO `merk` VALUES (1, 'Mitsubishi', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48');
INSERT INTO `merk` VALUES (2, 'Toyota', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48');
INSERT INTO `merk` VALUES (3, 'Daihatsu', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48');
INSERT INTO `merk` VALUES (4, 'Suzuki', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48');
COMMIT;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `m_channel` varchar(10) DEFAULT NULL,
  `m_user` int(11) DEFAULT NULL,
  `m_message` varchar(0) DEFAULT NULL,
  `m_created_at` datetime DEFAULT NULL,
  `m_updated_at` datetime DEFAULT NULL,
  `m_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2017_10_20_040704_wilayah_provinsi', 1);
INSERT INTO `migrations` VALUES (4, '2017_10_20_040723_wilayah_kabupaten', 1);
INSERT INTO `migrations` VALUES (5, '2017_10_20_040735_wilayah_kecamatan', 1);
INSERT INTO `migrations` VALUES (6, '2017_10_20_040752_wilayah_desa', 1);
INSERT INTO `migrations` VALUES (7, '2017_10_20_075351_roles', 1);
INSERT INTO `migrations` VALUES (8, '2017_10_20_075403_permission', 1);
INSERT INTO `migrations` VALUES (9, '2017_10_20_075423_permission_role', 1);
INSERT INTO `migrations` VALUES (10, '2017_10_20_075443_role_user', 1);
INSERT INTO `migrations` VALUES (11, '2017_10_20_075752_post', 1);
INSERT INTO `migrations` VALUES (12, '2017_10_20_075753_comments', 1);
INSERT INTO `migrations` VALUES (13, '2017_10_20_075753_newsletter_subcriptions', 1);
INSERT INTO `migrations` VALUES (14, '2017_10_20_081140_settings', 1);
INSERT INTO `migrations` VALUES (15, '2017_10_20_082352_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (16, '2017_10_20_082434_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (17, '2017_10_20_082514_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (18, '2017_10_20_082607_create_cache_table', 1);
INSERT INTO `migrations` VALUES (19, '2017_10_20_082620_create_notifications_table', 1);
INSERT INTO `migrations` VALUES (20, '2017_10_22_125029_officers', 1);
INSERT INTO `migrations` VALUES (21, '2017_10_22_125048_lookups', 1);
INSERT INTO `migrations` VALUES (22, '2017_10_22_125252_log_activity', 1);
INSERT INTO `migrations` VALUES (23, '2017_10_22_125302_log_revisions', 1);
INSERT INTO `migrations` VALUES (24, '2017_11_02_162438_category', 1);
INSERT INTO `migrations` VALUES (25, '2017_11_02_162454_tags', 1);
INSERT INTO `migrations` VALUES (26, '2017_11_04_224448_post_tag', 1);
INSERT INTO `migrations` VALUES (27, '2017_11_21_142217_stasistik', 1);
INSERT INTO `migrations` VALUES (28, '2017_11_21_143101_hubungi', 1);
INSERT INTO `migrations` VALUES (29, '2017_11_24_221009_sekilasinfo', 1);
INSERT INTO `migrations` VALUES (30, '2018_01_19_103759_userverifications', 1);
INSERT INTO `migrations` VALUES (31, '2018_01_25_090027_mobil', 1);
INSERT INTO `migrations` VALUES (32, '2018_01_25_090038_mobil_fasilitas', 1);
INSERT INTO `migrations` VALUES (33, '2018_01_30_025244_sewa', 1);
INSERT INTO `migrations` VALUES (34, '2018_03_19_151137_sewa_detail', 1);
INSERT INTO `migrations` VALUES (35, '2018_03_19_164404_log_sewa_status', 1);
INSERT INTO `migrations` VALUES (36, '2018_03_22_113150_type', 1);
INSERT INTO `migrations` VALUES (37, '2018_03_22_114335_merk', 1);
INSERT INTO `migrations` VALUES (38, '2018_03_22_130610_customer', 1);
INSERT INTO `migrations` VALUES (39, '2016_06_01_000001_create_oauth_auth_codes_table', 2);
INSERT INTO `migrations` VALUES (40, '2016_06_01_000002_create_oauth_access_tokens_table', 2);
INSERT INTO `migrations` VALUES (41, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2);
INSERT INTO `migrations` VALUES (42, '2016_06_01_000004_create_oauth_clients_table', 2);
INSERT INTO `migrations` VALUES (43, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);
COMMIT;

-- ----------------------------
-- Table structure for mobil
-- ----------------------------
DROP TABLE IF EXISTS `mobil`;
CREATE TABLE `mobil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_plat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `merk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warna` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `harga_perjam` int(11) DEFAULT NULL,
  `tahun` int(4) NOT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('tersedia','dipinjam') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mobil_user_id_foreign` (`user_id`),
  CONSTRAINT `mobil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of mobil
-- ----------------------------
BEGIN;
INSERT INTO `mobil` VALUES (1, 'F 9080 GH', 'Alphard', 'Toyota', 'Cumperback', 'Hitam', 5000, 45000, 2016, 'alphard.jpg', 21, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (2, 'F 3774 HJ', 'Fortuner', 'Toyota', 'Luxury', 'Putih', 3000, 40000, 2015, 'fortuner.jpg', 20, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (3, 'BL', 'Agya', 'Toyota', '', 'Hitam', 2000, 36000, 0, 'agya.jpg', 3, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (4, 'BL', 'Innova', 'Toyota', '', 'Putih', 3000, 43000, 0, 'innova.jpg', 22, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (5, 'BL', 'Avanza', 'Toyota', '', 'Putih', 2000, 36000, 0, 'avanza.jpg', 23, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (6, 'BL', 'Proton', 'Proton', '', 'Silver', 2000, 36000, 0, 'proton.jpg', 24, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (7, 'BL', 'Calya', 'Toyota', '', 'Merah', 2000, 36000, 0, 'calya.jpg', 25, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (8, 'BL', 'Terios', 'Daihatsu', '', 'Hitam', 3000, 36000, 0, 'terios.jpg', 26, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (10, 'F 3887 FF', 'Land Cruiser', 'Toyota', NULL, 'SIlver', 0, 0, 2012, 'http://placehold.it/160', 31, 'tersedia', NULL, NULL);
INSERT INTO `mobil` VALUES (11, 'F 1 FMD', 'Pajero sport', 'Jeep', NULL, 'Putih', 0, 0, 2017, 'http://placehold.it/160', 34, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (14, 'f1111dd', 'city', 'honda', NULL, 'biru', 0, 0, 2005, 'http://placehold.it/160', 44, 'tersedia', NULL, NULL);
INSERT INTO `mobil` VALUES (15, 'F5555BBB', 'avanza', 'toyota', NULL, 'silver', 0, 0, 2015, 'http://placehold.it/160', 45, 'tersedia', NULL, NULL);
INSERT INTO `mobil` VALUES (16, 'f123dd', 'avanza', 'toyota', NULL, 'biru', 0, 0, 2016, '1541307553_avanzabiruok.jpg', 46, 'dipinjam', NULL, NULL);
INSERT INTO `mobil` VALUES (17, 'f1111wan', 'pajero sport', 'mitsubishi', NULL, 'hitam', 0, 0, 2018, 'http://placehold.it/160', 47, 'tersedia', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for newsletter_subscriptions
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_subscriptions`;
CREATE TABLE `newsletter_subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `newsletter_subscriptions_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `notifiable_type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` longtext,
  `revoked` varchar(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
BEGIN;
INSERT INTO `oauth_access_tokens` VALUES ('0319390460b583f32319acdca2f47bb4014d487610c0ed2f34749fc09f69e403b9fabff0c5ae57dd', 1, 3, 'MyApp', '[]', '0', '2019-04-17 15:57:11', '2019-04-17 15:57:11', '2020-04-17 15:57:11');
INSERT INTO `oauth_access_tokens` VALUES ('06a58996eafc1c255c08e022b23a51d702ce666b2905496c4a35b5d96820e908ec720b66a15544aa', 1, 3, '1', '[]', '0', '2019-04-19 10:05:46', '2019-04-19 10:05:46', '2020-04-19 10:05:46');
INSERT INTO `oauth_access_tokens` VALUES ('0c172f7f10c2eff2aab29bf3c5fcdb0ddcb4f681bd7bf56bf490376d543fd149a05073d54e4a3931', 49, 3, 'MyApp', '[]', '0', '2019-04-24 15:37:47', '2019-04-24 15:37:47', '2020-04-24 15:37:47');
INSERT INTO `oauth_access_tokens` VALUES ('1006097ee1e494ac23c79ed178160cf950c4f7e718d28fae6577b4e7149923d2c0ce2d3eb9646d35', 1, 1, '1', '[]', 'f', '2018-12-17 15:51:56', '2018-12-17 15:51:56', '2019-12-17 15:51:56');
INSERT INTO `oauth_access_tokens` VALUES ('10c36e32bf4eeac3228eb9e8a5763b7e1a611086be400f3e1f21b32b1ba283b2391bd8044d427f4f', 1, 3, 'MyApp', '[]', '0', '2019-04-17 15:57:52', '2019-04-17 15:57:52', '2020-04-17 15:57:52');
INSERT INTO `oauth_access_tokens` VALUES ('11508371b7145823b7c7a0c5d99d89020d149e98276c1a1a28f857559fd5fa8db087bbece84a80d7', 1, 1, '1', '[]', 'f', '2018-12-26 02:30:42', '2018-12-26 02:30:42', '2019-12-26 02:30:42');
INSERT INTO `oauth_access_tokens` VALUES ('12e19c15ad011a87cfb25ee8975e561135259b3bdda1a342447e54175ee1a7d130d9f15fbbbff634', 1, 3, 'MyApp', '[]', '0', '2019-04-19 16:16:07', '2019-04-19 16:16:07', '2020-04-19 16:16:07');
INSERT INTO `oauth_access_tokens` VALUES ('19f9e841b5b5fded7a18fba82e29f20ebdff74e306ca0a470ef6105689f82314ffb720b9e3f2a8fe', 1, 1, '1', '[]', 'f', '2018-12-21 09:45:41', '2018-12-21 09:45:41', '2019-12-21 09:45:41');
INSERT INTO `oauth_access_tokens` VALUES ('1a5ffcccc328dd814f0c8e26aead1a161dd5ddf3fe67c5d9520200e9c9d9ac1b0bea685bdd2afa44', 1, 3, 'MyApp', '[]', '0', '2019-04-19 14:04:12', '2019-04-19 14:04:12', '2020-04-19 14:04:12');
INSERT INTO `oauth_access_tokens` VALUES ('1e4a5857651d95346ee891c89561d0ce0e6a41eac8844f690ed60d871ac05d191eb688ebd965f0d4', 1, 1, '1', '[]', 'f', '2018-11-30 11:13:27', '2018-11-30 11:13:27', '2019-11-30 11:13:27');
INSERT INTO `oauth_access_tokens` VALUES ('1f1ab01173f54357d4dcdf7f976ddf16cf4ce428ca1180ef52550572969dc1e2f80f141a034ef2ef', 1, 1, '1', '[]', 'f', '2018-12-28 03:55:53', '2018-12-28 03:55:53', '2019-12-28 03:55:53');
INSERT INTO `oauth_access_tokens` VALUES ('245a5cd24da098b63381c0ddb0906e19b0d7e5e40b75fc29b58117769fc6e00d951af7ee90634c16', 1, 1, '1', '[]', 'f', '2018-12-01 00:31:29', '2018-12-01 00:31:29', '2019-12-01 00:31:29');
INSERT INTO `oauth_access_tokens` VALUES ('24b293f4f0e52bfd10aac215976f026527f862ef37b78143f20fdbec27ed3c26a0fca6bdf0bf232a', 1, 1, '1', '[]', 'f', '2019-02-13 14:44:07', '2019-02-13 14:44:07', '2020-02-13 14:44:07');
INSERT INTO `oauth_access_tokens` VALUES ('250c1e5e0793919da19fb048899f3b7a3b713c74b698484f61eaa8d26fdf7636c7f99a64f7a6a4c3', 1, 3, 'MyApp', '[]', '0', '2019-04-19 16:14:06', '2019-04-19 16:14:06', '2020-04-19 16:14:06');
INSERT INTO `oauth_access_tokens` VALUES ('2a407dade479a784a386298b68f0fcca88c41616e05b379f6c4cb556b76078739a08931085f6575e', 1, 1, '1', '[]', 'f', '2018-12-29 08:51:16', '2018-12-29 08:51:16', '2019-12-29 08:51:16');
INSERT INTO `oauth_access_tokens` VALUES ('2abe9257e3cc537815fe72bfb6085fa01cd66a0d31c4ad159c664b27f1527c752564ce882a9c26b0', 1, 3, '1', '[]', '0', '2019-04-17 15:30:29', '2019-04-17 15:30:29', '2020-04-17 15:30:29');
INSERT INTO `oauth_access_tokens` VALUES ('2adb9b03a7fe960f3983ff2e35d0b955188f4217eaa5f1ede6d96006e204568d50085e937dc2e227', 2, 3, 'MyApp', '[]', '0', '2019-04-19 15:45:47', '2019-04-19 15:45:47', '2020-04-19 15:45:47');
INSERT INTO `oauth_access_tokens` VALUES ('2fcee8a01ceb12e04901781ffc93edad96262588dcc33ad3242db50e1aa2f491a4b4c2cd8aa1e212', 1, 1, '1', '[]', 'f', '2018-12-21 15:50:01', '2018-12-21 15:50:01', '2019-12-21 15:50:01');
INSERT INTO `oauth_access_tokens` VALUES ('301c360374c71ab8607aabd69f5468e79860aa7a53f3d3f18d8f71884d6f1da4146789a803f54bfc', 2, 3, 'MyApp', '[]', '0', '2019-04-19 16:02:48', '2019-04-19 16:02:48', '2020-04-19 16:02:48');
INSERT INTO `oauth_access_tokens` VALUES ('354dd49aedf553b2090ae322e05a0de9c18d32d690daeed680be5f8c0b2033d0f13dce993ea5bd57', 1, 3, 'MyApp', '[]', '0', '2019-04-17 15:59:02', '2019-04-17 15:59:02', '2020-04-17 15:59:02');
INSERT INTO `oauth_access_tokens` VALUES ('3b9b235598f5d32fa12706496a17cfb5a50fb87c471e163450bce30f28be0b96624957e4a1e11be8', 1, 1, '1', '[]', 'f', '2019-02-13 09:29:04', '2019-02-13 09:29:04', '2020-02-13 09:29:04');
INSERT INTO `oauth_access_tokens` VALUES ('3e04aaad081534d7e2999f99b138be34e60ccff08b2a28a2ebff12f6df566c13e1a8df6c413de7e4', 1, 1, '1', '[]', 'f', '2018-12-24 13:13:20', '2018-12-24 13:13:20', '2019-12-24 13:13:20');
INSERT INTO `oauth_access_tokens` VALUES ('418bd0d8ea0fd32aca8a3cd1f576a617f96c2e7374c269035c02fad429ee833e5e97deae0f809661', 1, 1, '1', '[]', 'f', '2018-12-01 10:37:47', '2018-12-01 10:37:47', '2019-12-01 10:37:47');
INSERT INTO `oauth_access_tokens` VALUES ('41f7c27adce78f594d78a82754458676b6a844888fcd82614d068aa0c136ee2ec0423c297722d8dc', 1, 1, '1', '[]', 'f', '2018-12-25 03:30:25', '2018-12-25 03:30:25', '2019-12-25 03:30:25');
INSERT INTO `oauth_access_tokens` VALUES ('4334118a1facf6e90e131f27627c7113362515adfab760d49a01f3c35b4d119ff70ea8011540a849', 2, 3, 'MyApp', '[]', '0', '2019-04-19 16:26:20', '2019-04-19 16:26:20', '2020-04-19 16:26:20');
INSERT INTO `oauth_access_tokens` VALUES ('45a8521e05bea09fc11b527a76cde12c15a4d41b34a29df66fd6a9bf4cbca4df59ce871303306c93', 1, 1, '1', '[]', 'f', '2019-01-01 09:55:22', '2019-01-01 09:55:22', '2020-01-01 09:55:22');
INSERT INTO `oauth_access_tokens` VALUES ('48e08ef0d54ffd906880cfa3398123b60eeee70f281dbbd34dc775778ef7cdad6edff1de17de5624', 1, 3, 'MyApp', '[]', '0', '2019-04-21 04:58:11', '2019-04-21 04:58:11', '2020-04-21 04:58:11');
INSERT INTO `oauth_access_tokens` VALUES ('4db6238b0dbdc3d6c5980cca101eef6b76a250cc9f688949dd0eaca90ecf84b9e936b42fe988527f', 1, 1, '1', '[]', 'f', '2018-12-20 13:59:30', '2018-12-20 13:59:30', '2019-12-20 13:59:30');
INSERT INTO `oauth_access_tokens` VALUES ('545de338e7f113a91fa5e6b07e6d96d61f9dd13bde4331225e8000a6a71763481b5c3678f974de23', 1, 1, '1', '[]', 'f', '2018-11-30 11:32:46', '2018-11-30 11:32:46', '2019-11-30 11:32:46');
INSERT INTO `oauth_access_tokens` VALUES ('5554db13cd897f96d9c0938dd9b47fe58a62a3c6ff93a05cfbf8603a9c1ac1fa72ec77908dd2bba6', 1, 1, '1', '[]', 'f', '2018-12-28 02:24:29', '2018-12-28 02:24:29', '2019-12-28 02:24:29');
INSERT INTO `oauth_access_tokens` VALUES ('57376a2f5a6e0f88aca3f9674f4d2c9231be0eca8c9faf718a16bcccaa12b18f5fffcc4fafc79a17', 1, 3, 'MyApp', '[]', '0', '2019-04-19 09:45:23', '2019-04-19 09:45:23', '2020-04-19 09:45:23');
INSERT INTO `oauth_access_tokens` VALUES ('5c9c51e8ec469e8c63c72cd914c17f931ec9a1b4212af9a07da3f5471d7efee3d1559dc204988b64', 1, 3, 'MyApp', '[]', '0', '2019-04-21 04:51:16', '2019-04-21 04:51:16', '2020-04-21 04:51:16');
INSERT INTO `oauth_access_tokens` VALUES ('60bebe677b0979cfa3fb9495d4955da4bcffd4c3ce575205259838150b419b57c269c79f1ab73b54', 1, 1, '1', '[]', 'f', '2019-02-15 06:42:18', '2019-02-15 06:42:18', '2020-02-15 06:42:18');
INSERT INTO `oauth_access_tokens` VALUES ('661626a2f879a1c645b50218a4780a2c925b1300d5e00a0905c44791ea2c8acfb722a4030d9c8c04', 1, 1, '1', '[]', 'f', '2018-12-19 09:15:13', '2018-12-19 09:15:13', '2019-12-19 09:15:13');
INSERT INTO `oauth_access_tokens` VALUES ('67acf0a75d9f43974751621944b0adbb663a4d9bdc386f6fd734853a5be230f6e48fac107485628a', 1, 1, '1', '[]', 'f', '2019-01-17 13:29:30', '2019-01-17 13:29:30', '2020-01-17 13:29:30');
INSERT INTO `oauth_access_tokens` VALUES ('67da274f4b53d1861e184b9a5cd936f93dfc0944c8df2219c46a9915a751be9645c944798286ae5e', 1, 1, '1', '[]', 'f', '2018-12-01 00:31:07', '2018-12-01 00:31:07', '2019-12-01 00:31:07');
INSERT INTO `oauth_access_tokens` VALUES ('6a43d258be609aec6f338f881d688595e8fee39eaf708736a476bf01c1f6eec7e3d756aa49681803', 48, 3, 'MyApp', '[]', '0', '2019-04-17 16:06:17', '2019-04-17 16:06:17', '2020-04-17 16:06:17');
INSERT INTO `oauth_access_tokens` VALUES ('6ae0d552f01f90cd0e7f8453ecc3b1bedcf4cf9e3133858ef31ddf96991d6875b9f6a4607a753a7d', 1, 1, '1', '[]', 'f', '2018-12-21 12:59:22', '2018-12-21 12:59:22', '2019-12-21 12:59:22');
INSERT INTO `oauth_access_tokens` VALUES ('6e97cb47ad2e5a2d598c01545c42421dd1d4d65012822c19b38453d2dc46a5820ec64c88594a1fa6', 2, 1, '2', '[]', 'f', '2018-12-28 03:33:38', '2018-12-28 03:33:38', '2019-12-28 03:33:38');
INSERT INTO `oauth_access_tokens` VALUES ('6eb780dd00388078c5fa72781f8dace1b3ee55f0c82d6a50266fe79e65cc5138ab2341eda2bf227a', 1, 1, '1', '[]', 'f', '2019-01-01 15:56:40', '2019-01-01 15:56:40', '2020-01-01 15:56:40');
INSERT INTO `oauth_access_tokens` VALUES ('731121c48178a3f4ce910e6831252a7fbdc754f98ad7708c129dbe26ba9dcc96e1b54b37c235017c', 1, 1, '1', '[]', 'f', '2018-11-30 11:17:20', '2018-11-30 11:17:20', '2019-11-30 11:17:20');
INSERT INTO `oauth_access_tokens` VALUES ('73a2eead31121904803bb4bd5ab7fd63d25236cc39f85946dd4cc68bd60d2bbc5b970dc5ebd0a799', 1, 3, '1', '[]', '0', '2019-04-18 14:13:22', '2019-04-18 14:13:22', '2020-04-18 14:13:22');
INSERT INTO `oauth_access_tokens` VALUES ('754fea59c92244a3ccfc50a6bfa086fb273b44ebf2584e35d53ddd6a93aa925e700bcbfcaa89e220', 2, 3, 'MyApp', '[]', '0', '2019-04-19 14:00:23', '2019-04-19 14:00:23', '2020-04-19 14:00:23');
INSERT INTO `oauth_access_tokens` VALUES ('7baed19a3176db03f8c6db49bd01d0331c835c25074a584f33178d242f2969ca53b101646cbf0f13', 2, 1, '2', '[]', 'f', '2019-02-14 09:58:26', '2019-02-14 09:58:26', '2020-02-14 09:58:26');
INSERT INTO `oauth_access_tokens` VALUES ('7f3787136f7c913338684715f6ea926550ac8eb9ece28874bc360f10cecd4a09b5b7c92818e7c697', 1, 1, '1', '[]', 'f', '2018-12-19 16:47:06', '2018-12-19 16:47:06', '2019-12-19 16:47:06');
INSERT INTO `oauth_access_tokens` VALUES ('865377900b7577611d95f2e41183afe03a6646533d69466ab247dbbf9e0beb439912f387edd94628', 1, 1, '1', '[]', 'f', '2019-02-13 10:51:27', '2019-02-13 10:51:27', '2020-02-13 10:51:27');
INSERT INTO `oauth_access_tokens` VALUES ('86c48c021ede0e2520a46a79c4de195005f3e8747fb9020d2cfbe88dca3353f28083073544aa00ed', 1, 1, '1', '[]', 'f', '2018-11-24 05:54:13', '2018-11-24 05:54:13', '2019-11-24 05:54:13');
INSERT INTO `oauth_access_tokens` VALUES ('8a36edcd5828ea8920bd9f4cc427db48befb789967d515053b0a2cfb2d458513e6ba079698cb61fe', 1, 3, 'MyApp', '[]', '0', '2019-04-21 04:54:09', '2019-04-21 04:54:09', '2020-04-21 04:54:09');
INSERT INTO `oauth_access_tokens` VALUES ('8b4f296a6633718e9d72254f355bab51d89b0792703ff62c8ce25be64bf47b2c07f42748b6003d67', 2, 1, '2', '[]', 'f', '2019-02-15 02:22:56', '2019-02-15 02:22:56', '2020-02-15 02:22:56');
INSERT INTO `oauth_access_tokens` VALUES ('8b501c29205db6fab7fcbb83d1c5e85f4e96a54090e78879136eddc7be0c05e0b696f6aef4100720', 2, 3, 'MyApp', '[]', '0', '2019-04-19 16:11:31', '2019-04-19 16:11:31', '2020-04-19 16:11:31');
INSERT INTO `oauth_access_tokens` VALUES ('915744a3534d0bfd52f5ac45f335431a9485357c9a7fde2a44b2f4faa5be60245cede4c64783d039', 2, 1, '2', '[]', 'f', '2018-12-29 08:50:06', '2018-12-29 08:50:06', '2019-12-29 08:50:06');
INSERT INTO `oauth_access_tokens` VALUES ('930e57a165881d5ee582b17b2ea8a46f565fa631e915d0fe8e800bbf0a3ccee8cbf163db70c36b0f', 2, 1, '2', '[]', 'f', '2018-11-30 12:19:24', '2018-11-30 12:19:24', '2019-11-30 12:19:24');
INSERT INTO `oauth_access_tokens` VALUES ('943a758c2ee87730b0899427c907dfa83e3fbb4b26927f6f793d78838ac0bde089d51d0265b3219a', 1, 3, 'MyApp', '[]', '0', '2019-04-21 04:56:19', '2019-04-21 04:56:19', '2020-04-21 04:56:19');
INSERT INTO `oauth_access_tokens` VALUES ('972a2360ac229c0b9261996f6f2681087ce85f141b6ad680b9d65b867af7efdcf347742ffd23e532', 1, 1, '1', '[]', 'f', '2018-12-19 01:54:18', '2018-12-19 01:54:18', '2019-12-19 01:54:18');
INSERT INTO `oauth_access_tokens` VALUES ('9e8a7ae140f943fedbf9fe739769e585ebc0b7b89fc8b5f7514de0c3756b51b28d68e186fb243e92', 1, 1, '1', '[]', 'f', '2018-12-02 03:09:19', '2018-12-02 03:09:19', '2019-12-02 03:09:19');
INSERT INTO `oauth_access_tokens` VALUES ('9fa7f6e0f15373b1db6fb5071c234aa33c26649d781cbf1cc6ae4f7d069805a8c37ea36926bcf6ca', 1, 1, '1', '[]', 'f', '2018-12-25 22:23:14', '2018-12-25 22:23:14', '2019-12-25 22:23:14');
INSERT INTO `oauth_access_tokens` VALUES ('a0e97c4026201a32a9e520aad05d60c1b33ddc30c9d117c4bc5aa94e238207c242d4e834a5699956', 1, 3, '1', '[]', '0', '2019-04-20 10:08:24', '2019-04-20 10:08:24', '2020-04-20 10:08:24');
INSERT INTO `oauth_access_tokens` VALUES ('a11cb5645a4b049687ee58e7881b7e22097b78e0af684c73f1e78a7da6818b77bc8b3c60f74ff902', 1, 1, '1', '[]', 'f', '2018-12-02 12:30:32', '2018-12-02 12:30:32', '2019-12-02 12:30:32');
INSERT INTO `oauth_access_tokens` VALUES ('a2f3a71c046f7ee0a711d33f5b8635c28168d20b1f2ea2fb1e3f0e9ff6cc26406f09466e97396466', 1, 1, '1', '[]', 'f', '2018-11-30 11:15:14', '2018-11-30 11:15:14', '2019-11-30 11:15:14');
INSERT INTO `oauth_access_tokens` VALUES ('a376dea250d0fc9a845786814aa9c6d3699359a1ac9ecbb4249c2c6fa32c8b7f96d806b10013eb7b', 1, 1, '1', '[]', 'f', '2018-12-18 02:05:52', '2018-12-18 02:05:52', '2019-12-18 02:05:52');
INSERT INTO `oauth_access_tokens` VALUES ('a4f4bfbfbbd8c84e12cb2e62ff37b9a180b5db457668b8e56c1506b4a8a9bddc81277473c6e70966', 2, 3, '2', '[]', '0', '2019-04-18 13:08:05', '2019-04-18 13:08:05', '2020-04-18 13:08:05');
INSERT INTO `oauth_access_tokens` VALUES ('af5e131823306f9b6178ed7b998a79684e9bdd8418b66dab856b5b467515490d6a8a384c2f644d50', 1, 1, '1', '[]', 'f', '2018-12-28 21:18:32', '2018-12-28 21:18:32', '2019-12-28 21:18:32');
INSERT INTO `oauth_access_tokens` VALUES ('b185d876dd160be4ba5158f9684609dbcdc37a7d684a0982af0f6453b7c0eb9ae0c8a4da1759243d', 1, 1, '1', '[]', 'f', '2018-12-01 04:15:21', '2018-12-01 04:15:21', '2019-12-01 04:15:21');
INSERT INTO `oauth_access_tokens` VALUES ('b5cd4a17401523e03168285a952c3dd90be0520709f9f16662fe26e150aa8bc58f259b0b396bcbfa', 1, 3, 'MyApp', '[]', '0', '2019-04-19 14:05:15', '2019-04-19 14:05:15', '2020-04-19 14:05:15');
INSERT INTO `oauth_access_tokens` VALUES ('b68cafac79964fddeb0bed878eaa5fe197b26702dec6b0170f8dfab24e33dedfd6db36c791125a86', 1, 3, '1', '[]', '0', '2019-04-30 06:10:33', '2019-04-30 06:10:33', '2020-04-30 06:10:33');
INSERT INTO `oauth_access_tokens` VALUES ('bb113010e9e96741c5a720473e8634ce2d57dc7b4b3baaeccf33c1fcdc4e99b8190934a10059eb7e', 1, 1, '1', '[]', 'f', '2019-02-13 22:34:44', '2019-02-13 22:34:44', '2020-02-13 22:34:44');
INSERT INTO `oauth_access_tokens` VALUES ('c5178959aa1f4e6f6448d9fe2c008bcebaacd67c459998aa1edf7b757ee8576f5ec21a0adcb2c654', 1, 1, '1', '[]', 'f', '2019-02-13 13:20:32', '2019-02-13 13:20:32', '2020-02-13 13:20:32');
INSERT INTO `oauth_access_tokens` VALUES ('c99677da37436bbe111a9c30904da575a461a370dde175b21a3223e3584efbe19b8da7a8a34d5d69', 1, 3, '1', '[]', '0', '2019-04-19 12:34:25', '2019-04-19 12:34:25', '2020-04-19 12:34:25');
INSERT INTO `oauth_access_tokens` VALUES ('c9eba6d6a5b6c57d462a49800226dd4202e674f4cd9cdbce1367abe37d1ef2b8de96bdb9db765a19', 1, 1, '1', '[]', 'f', '2018-12-21 02:19:54', '2018-12-21 02:19:54', '2019-12-21 02:19:54');
INSERT INTO `oauth_access_tokens` VALUES ('ce05c3e60dd934a399490791f003d443ea3f7052577140e365c50bbb1ba1ff08d90aeaac3337d6f7', 1, 1, '1', '[]', 'f', '2018-12-28 03:26:21', '2018-12-28 03:26:21', '2019-12-28 03:26:21');
INSERT INTO `oauth_access_tokens` VALUES ('cfe6dc07f96b993e69f91ab096a83bb6cfbf0c2621fbf055be47debce8d498db49748ea36c5aea11', 1, 1, '1', '[]', 'f', '2018-12-21 23:38:23', '2018-12-21 23:38:23', '2019-12-21 23:38:23');
INSERT INTO `oauth_access_tokens` VALUES ('d0139761f1d7405e225edc237c709bff222b214a2da3f772994e103fa71fef222c8b71c2e1bdb72e', 1, 3, 'MyApp', '[]', '0', '2019-04-21 05:03:50', '2019-04-21 05:03:50', '2020-04-21 05:03:50');
INSERT INTO `oauth_access_tokens` VALUES ('d205e0b0872cae46e554530fdb42a4c43996a4bf3b22ef3323bb24a32d69c5605b70cde7602db7ca', 1, 1, '1', '[]', 'f', '2018-11-30 15:00:20', '2018-11-30 15:00:20', '2019-11-30 15:00:20');
INSERT INTO `oauth_access_tokens` VALUES ('d2787155870a2d3df3ec847b825c142f9887fc5db7abc40c4e91882d73a00b6741777f1edaf25f85', 1, 3, 'MyApp', '[]', '0', '2019-04-19 09:43:27', '2019-04-19 09:43:27', '2020-04-19 09:43:27');
INSERT INTO `oauth_access_tokens` VALUES ('d3449cabda7c374b1755ce5a64ab3cc98c8e3ac304e71b13ef42ef5c5b63e39b7e828dba6e9c6907', 1, 1, '1', '[]', 'f', '2018-11-23 14:21:58', '2018-11-23 14:21:58', '2019-11-23 14:21:58');
INSERT INTO `oauth_access_tokens` VALUES ('dc06323327f362929d11327736ab26cc5e37e57260c164f81872e7b69416656c95e49a8c52296dc4', 1, 3, 'MyApp', '[]', '0', '2019-04-19 16:09:04', '2019-04-19 16:09:04', '2020-04-19 16:09:04');
INSERT INTO `oauth_access_tokens` VALUES ('dfbf4bb9f229ae5650044f326e8766345152dc9c0669631e4823c25f4ab6e6fd9622913e8e6e46f0', 1, 1, '1', '[]', 'f', '2018-12-29 03:10:04', '2018-12-29 03:10:04', '2019-12-29 03:10:04');
INSERT INTO `oauth_access_tokens` VALUES ('e1497b7084893c22985fddc4b10c8cd3cdbb5667e7e6fcdd876f29fbf501765d6547fe4466e513a4', 1, 3, '1', '[]', '0', '2019-04-26 03:21:51', '2019-04-26 03:21:51', '2020-04-26 03:21:51');
INSERT INTO `oauth_access_tokens` VALUES ('e3612f0ed5c27858aae24265cf09e3d3f7553bf05d19e2327a9b0c9a586d26ef8bc02544956bb64a', 1, 1, '1', '[]', 'f', '2018-12-30 00:40:42', '2018-12-30 00:40:42', '2019-12-30 00:40:42');
INSERT INTO `oauth_access_tokens` VALUES ('e55cb35627dc414252cfcbbc9385b38beb909bbc28e0adbb517f06a014ebce3c844aaa1f630a2bbd', 1, 1, '1', '[]', 'f', '2018-12-25 05:58:23', '2018-12-25 05:58:23', '2019-12-25 05:58:23');
INSERT INTO `oauth_access_tokens` VALUES ('e78cfc5bda4e47b6c0b2cb101661a7c76cb2ea349fe0fde696eea68b456991992f5cf3408b5f4369', 1, 1, '1', '[]', 'f', '2018-12-26 06:17:04', '2018-12-26 06:17:04', '2019-12-26 06:17:04');
INSERT INTO `oauth_access_tokens` VALUES ('f1ec38a3bb0a17dfe9c947e36d032ae58a71c8ce3c0cfb997e83d4ecc985d4ee5fcf2b64033c363c', 2, 3, 'MyApp', '[]', '0', '2019-04-19 16:17:38', '2019-04-19 16:17:38', '2020-04-19 16:17:38');
INSERT INTO `oauth_access_tokens` VALUES ('f450a0df20f689ef8410cb4f11e9cc4e9693256ef0a971a31bb162ec87d5f1a7864ea7f922cfa460', 1, 1, '1', '[]', 'f', '2019-02-14 00:00:25', '2019-02-14 00:00:25', '2020-02-14 00:00:25');
INSERT INTO `oauth_access_tokens` VALUES ('f6572a17e06bfc6452ef23917ba57caa7d72a9f54c92d34074880e73f34f75b3b47b819fdb3e5bbe', 2, 1, '2', '[]', 'f', '2019-02-14 09:51:12', '2019-02-14 09:51:12', '2020-02-14 09:51:12');
INSERT INTO `oauth_access_tokens` VALUES ('f6e55a1a493f185fe19fcd9b0d6de71426f3bb95fe4ff34e9b6e9bde1f80672f56548936f2128bf6', 1, 1, '1', '[]', 'f', '2019-02-18 05:04:11', '2019-02-18 05:04:11', '2020-02-18 05:04:11');
INSERT INTO `oauth_access_tokens` VALUES ('f9e83a086e5090072090b385ec681d25411fb7a3c0772a74a8e0cc2a93f7749791bd196454527f53', 1, 1, '1', '[]', 'f', '2018-12-26 16:17:43', '2018-12-26 16:17:43', '2019-12-26 16:17:43');
INSERT INTO `oauth_access_tokens` VALUES ('fb2171dce8e0fc5fbff020a4927ce05ce9051289d83273dd93ccaa7199e0bba4b55618220fc77e64', 1, 3, 'MyApp', '[]', '0', '2019-04-17 16:00:21', '2019-04-17 16:00:21', '2020-04-17 16:00:21');
INSERT INTO `oauth_access_tokens` VALUES ('fc9e2fa0fb5edaece5fadea54600b4f404dcf11db282283bc1cb084f722db77a17f0db1905040cae', 1, 1, '1', '[]', 'f', '2018-11-19 10:07:15', '2018-11-19 10:07:15', '2019-11-19 10:07:15');
COMMIT;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` longtext,
  `revoked` varchar(5) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` longtext NOT NULL,
  `personal_access_client` varchar(5) NOT NULL,
  `password_client` varchar(5) NOT NULL,
  `revoked` varchar(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
BEGIN;
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', 'p39HqA7KfICFSqoJz05sxeo04U1gn0gJ6QPDPmYR', 'http://localhost', 't', 'f', 'f', '2018-11-19 09:51:35', '2018-11-19 09:51:35');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', 'emXDcEHRvAFARxmGRLxRPFpoyWCuN0qGo0niPpHH', 'http://localhost', 'f', 't', 'f', '2018-11-19 09:51:35', '2018-11-19 09:51:35');
INSERT INTO `oauth_clients` VALUES (3, NULL, 'Utama Trans Personal Access Client', '4lYXkMf4KxYzcuTjTxjg1SGKkf0JI5ysHx0Xgj6i', 'http://localhost', '1', '0', '0', '2019-04-15 03:18:46', '2019-04-15 03:18:46');
INSERT INTO `oauth_clients` VALUES (4, NULL, 'Utama Trans Password Grant Client', 'cXd1ESmz8XnWvqsdOCec9KupmuypKC6greQCPSXw', 'http://localhost', '0', '1', '0', '2019-04-15 03:18:46', '2019-04-15 03:18:46');
COMMIT;

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
BEGIN;
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2018-11-19 09:51:35', '2018-11-19 09:51:35');
INSERT INTO `oauth_personal_access_clients` VALUES (2, 3, '2019-04-15 03:18:46', '2019-04-15 03:18:46');
COMMIT;

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` varchar(5) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for officers
-- ----------------------------
DROP TABLE IF EXISTS `officers`;
CREATE TABLE `officers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` bigint(20) unsigned NOT NULL,
  `pangkat_id` int(10) unsigned DEFAULT NULL,
  `jabatan_id` int(10) unsigned DEFAULT NULL,
  `role` enum('staff/karyawan','customer') COLLATE utf8_unicode_ci NOT NULL,
  `deposit` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of officers
-- ----------------------------
BEGIN;
INSERT INTO `officers` VALUES (1, 'Muhamad Anjar P', ' ', 'Caringin', 87870427227, 0, 2, 'staff/karyawan', 0, 3, '2018-03-29 16:50:45', '2018-03-29 16:50:45', NULL);
INSERT INTO `officers` VALUES (2, 'Fortuner', '', '', 0, NULL, NULL, 'staff/karyawan', 150000, 20, NULL, NULL, NULL);
INSERT INTO `officers` VALUES (3, 'Alphard', '', '', 0, NULL, NULL, 'staff/karyawan', 200000, 21, NULL, '2018-05-19 13:35:17', NULL);
INSERT INTO `officers` VALUES (4, 'Innova', '', '', 0, NULL, NULL, 'staff/karyawan', 150000, 22, NULL, NULL, NULL);
INSERT INTO `officers` VALUES (5, 'Avanza', '', '', 0, NULL, NULL, 'staff/karyawan', 150000, 23, NULL, NULL, NULL);
INSERT INTO `officers` VALUES (6, '', '', '', 0, NULL, NULL, 'staff/karyawan', 170000, 24, NULL, '2018-06-10 10:29:45', NULL);
INSERT INTO `officers` VALUES (7, '', '', '', 0, NULL, NULL, 'staff/karyawan', 150000, 25, NULL, NULL, NULL);
INSERT INTO `officers` VALUES (8, '', '', '', 0, NULL, NULL, 'staff/karyawan', 150000, 26, NULL, NULL, NULL);
INSERT INTO `officers` VALUES (9, 'Administrator', '', '', 0, NULL, NULL, 'staff/karyawan', 150000, 2, NULL, NULL, NULL);
INSERT INTO `officers` VALUES (13, 'ihwan', ' ', 'Bogor Jawa barat', 87787640467, NULL, NULL, 'staff/karyawan', 100000, 30, '2018-05-26 14:55:27', '2018-05-26 14:55:27', NULL);
INSERT INTO `officers` VALUES (14, 'Muhamad Anjar', '33556', 'Caringin Bogor', 87870427227, NULL, NULL, 'staff/karyawan', 1500000, 31, '2018-06-11 07:47:27', '2018-06-11 07:47:27', NULL);
INSERT INTO `officers` VALUES (15, 'Testing ihwan Driver', '1223334455677889', 'Gadog Jawabarat', 87787640467, NULL, NULL, 'staff/karyawan', 162051, 34, '2018-06-11 08:21:13', '2018-06-11 17:43:20', NULL);
INSERT INTO `officers` VALUES (16, 'Ihwans', '32331587468881', 'Kksnmmdldmdmskms', 87787640467, NULL, NULL, 'staff/karyawan', 284937, 37, '2018-06-11 15:01:22', '2018-07-11 13:54:05', NULL);
INSERT INTO `officers` VALUES (17, 'ihwan.ss', '78169263941629374619', 'Bogor City Gadog', 87787640467, NULL, NULL, 'staff/karyawan', 200000, 39, '2018-06-27 13:43:12', '2018-06-27 13:43:12', NULL);
INSERT INTO `officers` VALUES (18, 'ihwana', '1223344444444', 'kp.puncakbogor', 87787640467, NULL, NULL, 'staff/karyawan', 300000, 44, '2018-11-03 11:49:11', '2018-11-03 11:49:11', NULL);
INSERT INTO `officers` VALUES (19, 'ihwantesting', '1233334443333', 'bogor kota', 87787640467, NULL, NULL, 'staff/karyawan', 300000, 45, '2018-11-03 12:36:51', '2018-11-03 12:36:51', NULL);
INSERT INTO `officers` VALUES (20, 'Rudy', '122222333322', 'jl.beo beo aja deh', 8131234567, NULL, NULL, 'staff/karyawan', 500000, 46, '2018-11-04 04:56:02', '2018-11-04 04:59:19', NULL);
INSERT INTO `officers` VALUES (21, 'ihwan sofian', '1223344455554', 'kp.gadog pandansari rt1 4', 8777877665, NULL, NULL, 'staff/karyawan', 500000, 47, '2018-11-04 08:38:24', '2018-11-04 08:38:24', NULL);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for pengumumam
-- ----------------------------
DROP TABLE IF EXISTS `pengumumam`;
CREATE TABLE `pengumumam` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `author_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` VALUES (1, 1);
INSERT INTO `permission_role` VALUES (2, 1);
INSERT INTO `permission_role` VALUES (3, 1);
INSERT INTO `permission_role` VALUES (4, 1);
INSERT INTO `permission_role` VALUES (14, 1);
INSERT INTO `permission_role` VALUES (15, 1);
INSERT INTO `permission_role` VALUES (16, 1);
INSERT INTO `permission_role` VALUES (1, 2);
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 'access.backend', NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'create.user', NULL, NULL);
INSERT INTO `permissions` VALUES (3, 'edit.user', NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'delete.user', NULL, NULL);
INSERT INTO `permissions` VALUES (5, 'create.article', NULL, NULL);
INSERT INTO `permissions` VALUES (6, 'edit.article', NULL, NULL);
INSERT INTO `permissions` VALUES (7, 'delete.article', NULL, NULL);
INSERT INTO `permissions` VALUES (8, 'create.dokumen', NULL, NULL);
INSERT INTO `permissions` VALUES (9, 'edit.dokumen', NULL, NULL);
INSERT INTO `permissions` VALUES (10, 'delete.dokumen', NULL, NULL);
INSERT INTO `permissions` VALUES (11, 'create.informasi', NULL, NULL);
INSERT INTO `permissions` VALUES (12, 'edit.informasi', NULL, NULL);
INSERT INTO `permissions` VALUES (13, 'delete.informasi', NULL, NULL);
INSERT INTO `permissions` VALUES (14, 'create.mobil', NULL, NULL);
INSERT INTO `permissions` VALUES (15, 'edit.mobil', NULL, NULL);
INSERT INTO `permissions` VALUES (16, 'delete.mobil', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for post_tag
-- ----------------------------
DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `type_post` enum('post','page','kegiatan','lowongan') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('published','draft') COLLATE utf8_unicode_ci NOT NULL,
  `position` enum('main','manual') COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `dibaca` int(11) NOT NULL,
  `sticky` int(11) DEFAULT '0',
  `posted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_author_id_foreign` (`author_id`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for promo
-- ----------------------------
DROP TABLE IF EXISTS `promo`;
CREATE TABLE `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_promo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `discount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `service_type` int(5) DEFAULT NULL,
  `valid` int(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of promo
-- ----------------------------
BEGIN;
INSERT INTO `promo` VALUES (34, 'PROMO23', NULL, 'dfasdfd', 'fgsfgfg', '2019-04-02 00:00:00', '2019-04-24 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:23:32', '2019-04-26 03:23:32');
INSERT INTO `promo` VALUES (35, 'PROMO23', NULL, 'fgfg', 'effd', '2019-04-26 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:24:02', '2019-04-26 03:24:02');
INSERT INTO `promo` VALUES (36, 'PROMO23', NULL, '8938989', 'dfdsfd', '2019-04-26 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:25:34', '2019-04-26 03:25:34');
INSERT INTO `promo` VALUES (37, '3434', NULL, '4343', 'sfdfdf', '2019-04-17 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:27:40', '2019-04-26 03:27:40');
INSERT INTO `promo` VALUES (38, '3434', NULL, '4343', 'sfdfdf', '2019-04-17 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:27:55', '2019-04-26 03:27:55');
INSERT INTO `promo` VALUES (39, '3434', NULL, '4343', 'sfdfdf', '2019-04-17 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:28:14', '2019-04-26 03:28:14');
INSERT INTO `promo` VALUES (40, '3434', NULL, '4343', 'sfdfdf', '2019-04-17 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:28:25', '2019-04-26 03:28:25');
INSERT INTO `promo` VALUES (41, '3434', NULL, '4343', 'sfdfdf', '2019-04-17 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:28:40', '2019-04-26 03:28:40');
INSERT INTO `promo` VALUES (42, '3434', NULL, '4343', 'sfdfdf', '2019-04-17 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:28:44', '2019-04-26 03:28:44');
INSERT INTO `promo` VALUES (43, '3434', NULL, '4343', 'sfdfdf', '2019-04-17 00:00:00', '2019-04-30 00:00:00', NULL, NULL, 1, NULL, NULL, '2019-04-26 03:34:40', '2019-04-26 03:34:40');
COMMIT;

-- ----------------------------
-- Table structure for rent_package
-- ----------------------------
DROP TABLE IF EXISTS `rent_package`;
CREATE TABLE `rent_package` (
  `rp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rp_name` varchar(200) DEFAULT NULL,
  `rp_total_price` int(11) DEFAULT NULL,
  `rp_miles_km` int(11) DEFAULT NULL,
  `rp_hour` int(11) DEFAULT NULL,
  `rp_add_mile_km` int(11) DEFAULT NULL,
  `rp_add_min` int(11) DEFAULT NULL,
  `rp_car_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`rp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `rate` int(5) DEFAULT NULL,
  `description` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `role_id` int(11) unsigned NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`menu_id`),
  KEY `role_menu_menu_id_fk` (`menu_id`),
  CONSTRAINT `role_menu_menu_id_fk` FOREIGN KEY (`menu_id`) REFERENCES `tm_menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `role_menu_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_menu
-- ----------------------------
BEGIN;
INSERT INTO `role_menu` VALUES (1, 1);
INSERT INTO `role_menu` VALUES (1, 10);
INSERT INTO `role_menu` VALUES (1, 11);
INSERT INTO `role_menu` VALUES (1, 12);
INSERT INTO `role_menu` VALUES (1, 21);
COMMIT;

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
BEGIN;
INSERT INTO `role_user` VALUES (1, 1);
INSERT INTO `role_user` VALUES (2, 2);
INSERT INTO `role_user` VALUES (3, 3);
INSERT INTO `role_user` VALUES (3, 20);
INSERT INTO `role_user` VALUES (3, 21);
INSERT INTO `role_user` VALUES (3, 22);
INSERT INTO `role_user` VALUES (3, 23);
INSERT INTO `role_user` VALUES (3, 24);
INSERT INTO `role_user` VALUES (3, 25);
INSERT INTO `role_user` VALUES (3, 26);
INSERT INTO `role_user` VALUES (3, 31);
INSERT INTO `role_user` VALUES (3, 34);
INSERT INTO `role_user` VALUES (3, 44);
INSERT INTO `role_user` VALUES (3, 45);
INSERT INTO `role_user` VALUES (3, 46);
INSERT INTO `role_user` VALUES (3, 47);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'superadmin', NULL, NULL);
INSERT INTO `roles` VALUES (2, 'admin', NULL, NULL);
INSERT INTO `roles` VALUES (3, 'driver', NULL, NULL);
INSERT INTO `roles` VALUES (4, 'customer', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for service_type
-- ----------------------------
DROP TABLE IF EXISTS `service_type`;
CREATE TABLE `service_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` VALUES ('W1gqzEoshtRPyoleCkdu8lJtfarZVMCEAeHOkZE3', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:67.0) Gecko/20100101 Firefox/67.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiSkpPZFRIdTl0WngxNEdxR3Y4ZUVnNjR2YTdNR0dGYWdjR0xBQ2FiRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9iYWNrZW5kL3Byb21vL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxMzoicGFzc3dvcmRfaGFzaCI7czo2MDoiJDJ5JDEwJC9scXJxZXkySjJIR2s4S2w4OENSNy5YTjQ0UWVaMC91b2d4em5FTnZvdzVEUzVKTC5MN3ZHIjtzOjg6Imxpbmtfd2ViIjtzOjk6ImRhc2hib2FyZCI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo0OiJha3NpIjtzOjM6ImFkZCI7fQ==', 1556607056);
COMMIT;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `key` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  KEY `settings_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
BEGIN;
INSERT INTO `settings` VALUES ('_token', '8oVbYBSrN8StufJs3t1HtchX7Guols0jcJ0wD4hq');
INSERT INTO `settings` VALUES ('baseFare', '3750');
INSERT INTO `settings` VALUES ('title', 'Utama Trans');
INSERT INTO `settings` VALUES ('deskripsi', 'utama trans,mobil');
INSERT INTO `settings` VALUES ('author', '');
INSERT INTO `settings` VALUES ('google_map', '');
INSERT INTO `settings` VALUES ('footer_left_pane', '');
INSERT INTO `settings` VALUES ('footer_center_pane', '');
INSERT INTO `settings` VALUES ('footer_right_pane', '');
INSERT INTO `settings` VALUES ('base_url', '');
INSERT INTO `settings` VALUES ('facebook_url', '');
INSERT INTO `settings` VALUES ('twitter_url', '');
INSERT INTO `settings` VALUES ('google_map_api', '');
INSERT INTO `settings` VALUES ('email_one', '');
INSERT INTO `settings` VALUES ('latitude', '');
INSERT INTO `settings` VALUES ('longitude', '');
INSERT INTO `settings` VALUES ('about_us', '                                                                                                \r\n                            \r\n                            \r\n                            ');
INSERT INTO `settings` VALUES ('our_address', '<p>Alamat utama trans</p>\r\n');
INSERT INTO `settings` VALUES ('our_email', '                                                                                                \r\n                            \r\n                            \r\n                            ');
INSERT INTO `settings` VALUES ('our_phone', '');
INSERT INTO `settings` VALUES ('our_support', '');
INSERT INTO `settings` VALUES ('syarat_kebijakan_driver', '<p>Syarat dan Kebijakan Pengemudi</p>\r\n');
COMMIT;

-- ----------------------------
-- Table structure for sewa
-- ----------------------------
DROP TABLE IF EXISTS `sewa`;
CREATE TABLE `sewa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `mobil_id` int(11) NOT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_akhir` datetime DEFAULT NULL,
  `sewa_latitude` decimal(8,5) NOT NULL,
  `sewa_longitude` decimal(8,5) NOT NULL,
  `origin` varchar(255) CHARACTER SET latin1 NOT NULL,
  `origin_latitude` decimal(8,5) NOT NULL,
  `origin_longitude` decimal(8,5) NOT NULL,
  `destination` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `destination_latitude` decimal(8,5) DEFAULT NULL,
  `destination_longitude` decimal(8,5) DEFAULT NULL,
  `total_bayar` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sewa
-- ----------------------------
BEGIN;
INSERT INTO `sewa` VALUES (1, 'RENT0001', 1, 0, NULL, NULL, 37.42200, -122.08400, 'Banda Aceh', 5.54829, 95.32376, 'PLTD Apung', 5.54642, 95.30677, 0, 0, 'confirmed', '2018-04-21 15:05:04', '2018-04-23 09:15:59', NULL);
INSERT INTO `sewa` VALUES (2, 'RENT0002', 16, 2, NULL, NULL, 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Pakuan', -6.63130, 106.82226, 93297, 0, 'complete', '2018-04-21 16:48:14', '2018-04-26 17:19:41', NULL);
INSERT INTO `sewa` VALUES (6, 'RENT0006', 19, 3, NULL, NULL, 37.42200, -122.08400, 'Pakuan', -6.63130, 106.82226, 'Mobil88 Serpong', -6.23399, 106.64287, 2000, 0, 'pending', '2018-04-21 17:10:32', '2018-04-21 17:10:32', NULL);
INSERT INTO `sewa` VALUES (7, 'RENT0007', 20, 1, NULL, NULL, 33.98581, -118.25411, 'Parung', -6.42224, 106.73259, 'Ciawi', -6.71240, 106.89455, 5000, 0, 'pending', '2018-04-22 15:13:49', '2018-04-22 15:13:49', NULL);
INSERT INTO `sewa` VALUES (8, 'RENT0008', 21, 3, NULL, NULL, -6.59311, 106.81817, 'Bogor Botanical Gardens', -6.59763, 106.79957, 'Botani Square Mall', -6.60132, 106.80768, 254, 0, 'pending', '2018-04-25 09:46:49', '2018-04-25 09:46:49', NULL);
INSERT INTO `sewa` VALUES (11, 'RENT0011', 22, 3, NULL, NULL, -6.70686, 106.82186, 'Bogor', -6.55178, 106.62913, 'Caringin', -6.93030, 107.57197, 8164, 0, 'pending', '2018-04-25 13:20:50', '2018-04-25 13:20:50', NULL);
INSERT INTO `sewa` VALUES (12, 'RENT0012', 23, 2, NULL, NULL, -6.59311, 106.81816, 'Studio Realsoft', -6.59422, 106.81701, 'Caringin', -6.93030, 107.57197, 531000, 0, 'cancelled', '2018-04-26 07:16:29', '2018-05-02 09:20:52', NULL);
INSERT INTO `sewa` VALUES (13, 'RENT0013', 24, 2, NULL, NULL, -6.59311, 106.81816, 'Banda Aceh', 5.54829, 95.32376, 'ISKANDAR MUDA OTOMOTIF', 3.57338, 98.66104, 1206000, 0, 'complete', '2018-04-26 08:50:05', '2018-05-02 09:29:06', NULL);
INSERT INTO `sewa` VALUES (14, 'RENT0014', 27, 0, NULL, NULL, -6.70930, 106.82245, 'Caringin', -6.93030, 107.57197, 'Ciawi', -6.71240, 106.89455, 0, 0, 'pending', '2018-04-27 01:43:58', '2018-04-27 01:43:58', NULL);
INSERT INTO `sewa` VALUES (18, 'RENT0018', 31, 4, '2018-04-26 17:00:00', '2018-04-27 17:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Cibinong', -6.49011, 106.83070, 1910, 0, 'complete', '2018-04-27 04:56:06', '2018-05-02 08:06:50', NULL);
INSERT INTO `sewa` VALUES (19, 'RENT0019', 33, 8, '2018-04-26 17:00:00', '2018-04-28 17:00:00', 37.42200, -122.08400, 'Jakarta', -6.17511, 106.86504, 'Subang Regency', -6.34876, 107.76362, 8930, 0, 'completed', '2018-04-27 05:56:45', '2018-04-27 05:56:45', NULL);
INSERT INTO `sewa` VALUES (20, 'RENT0020', 34, 4, '2018-04-26 17:00:00', '2018-04-30 17:00:00', -6.59311, 106.81816, 'Parung', -6.42224, 106.73259, 'Sempur', -6.66732, 107.40115, 9645, 0, 'complete', '2018-04-27 09:11:21', '2018-05-02 08:22:21', NULL);
INSERT INTO `sewa` VALUES (21, 'RENT0021', 35, 4, '2018-04-26 17:00:00', '2018-05-04 17:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Caringin', -6.93030, 107.57197, 12246, 0, 'complete', '2018-04-27 09:18:27', '2018-05-02 08:23:12', NULL);
INSERT INTO `sewa` VALUES (22, 'RENT0022', 36, 6, '2018-04-26 17:00:00', '2018-05-10 17:00:00', 37.42200, -122.08400, 'Caringin', -6.93030, 107.57197, 'Bogor', -6.55178, 106.62913, 7263, 0, 'pending', '2018-04-27 09:50:10', '2018-04-27 09:50:10', NULL);
INSERT INTO `sewa` VALUES (23, 'RENT0023', 38, 8, '2018-04-26 17:00:00', '2018-05-01 17:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'South Jakarta', -6.26149, 106.81060, 6048, 0, 'pending', '2018-04-27 10:10:15', '2018-04-27 10:10:15', NULL);
INSERT INTO `sewa` VALUES (24, 'RENT0024', 39, 6, '2018-04-26 17:00:00', '2018-04-30 17:00:00', 37.42200, -122.08400, 'Caringin', -6.93030, 107.57197, 'Bogor City', -6.59715, 106.80604, 5573, 0, 'pending', '2018-04-27 10:23:00', '2018-04-27 10:23:00', NULL);
INSERT INTO `sewa` VALUES (25, 'RENT0025', 40, 8, '2018-04-27 00:00:00', '2018-04-30 00:00:00', -6.59311, 106.81816, 'ISKANDAR MUDA OTOMOTIF', 3.57338, 98.66104, 'Pharmacies Iskandar Muda', 3.57978, 98.66125, 433, 0, 'pending', '2018-04-27 11:02:07', '2018-04-27 11:02:07', NULL);
INSERT INTO `sewa` VALUES (26, 'RENT0026', 41, 0, NULL, NULL, -6.65361, 106.86928, 'Toyota Pajajaran Bogor', -6.58000, 106.80642, 'Ciawi', -6.71240, 106.89455, 0, 0, 'pending', '2018-04-27 12:44:42', '2018-04-27 12:44:42', NULL);
INSERT INTO `sewa` VALUES (27, 'RENT0027', 44, 0, NULL, NULL, -6.59311, 106.81816, 'Tanah Abang', -6.20236, 106.81194, 'Bogor City', -6.59715, 106.80604, 0, 0, 'pending', '2018-05-02 09:00:11', '2018-05-02 09:00:11', NULL);
INSERT INTO `sewa` VALUES (28, 'RENT0028', 46, 1, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Tanjung Priok', -6.13206, 106.87148, 'Bogor', -6.55178, 106.62913, 91988, 0, 'pending', '2018-05-02 11:55:47', '2018-05-02 11:55:47', NULL);
INSERT INTO `sewa` VALUES (29, 'RENT0029', 46, 1, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Tanjung Priok', -6.13206, 106.87148, 'Bogor', -6.55178, 106.62913, 91988, 0, 'pending', '2018-05-02 11:56:09', '2018-05-02 11:56:09', NULL);
INSERT INTO `sewa` VALUES (30, 'RENT0030', 31, 4, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Cibinong', -6.49011, 106.83070, 1910, 0, 'complete', '2018-05-02 11:56:16', '2018-05-03 09:52:18', NULL);
INSERT INTO `sewa` VALUES (31, 'RENT0031', 31, 4, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Cibinong', -6.49011, 106.83070, 1910, 0, 'complete', '2018-05-02 11:56:30', '2018-05-03 09:52:52', NULL);
INSERT INTO `sewa` VALUES (32, 'RENT0032', 46, 1, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Tanjung Priok', -6.13206, 106.87148, 'Bogor', -6.55178, 106.62913, 91988, 0, 'pending', '2018-05-02 11:56:54', '2018-05-02 11:56:54', NULL);
INSERT INTO `sewa` VALUES (33, 'RENT0033', 46, 4, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Tanjung Priok', -6.13206, 106.87148, 'Bogor', -6.55178, 106.62913, 87900, 0, 'complete', '2018-05-02 11:57:04', '2018-05-03 09:53:22', NULL);
INSERT INTO `sewa` VALUES (34, 'RENT0034', 47, 4, NULL, NULL, 37.42200, -122.08400, 'Jakarta', -6.17511, 106.86504, 'Pakuan', -6.63130, 106.82226, 168000, 0, 'complete', '2018-05-03 09:33:56', '2018-05-03 09:59:19', NULL);
INSERT INTO `sewa` VALUES (35, 'RENT0035', 48, 0, NULL, NULL, 37.42200, -122.08400, 'Jl. Margonda Raya No.A3', -6.39609, 106.82169, 'Depok City', -6.40248, 106.79424, 0, 0, 'pending', '2018-05-03 12:49:51', '2018-05-03 12:49:51', NULL);
INSERT INTO `sewa` VALUES (36, 'RENT0036', 49, 0, NULL, NULL, 37.42200, -122.08400, 'Jl. Margonda Raya No.A3', -6.39609, 106.82169, 'Depok City', -6.40248, 106.79424, 0, 0, 'pending', '2018-05-03 12:59:01', '2018-05-03 12:59:01', NULL);
INSERT INTO `sewa` VALUES (37, 'RENT0037', 50, 0, NULL, NULL, 37.42200, -122.08400, 'Pakuan', -6.63130, 106.82226, 'Pakuan University Bogor', -6.59990, 106.81116, 0, 0, 'pending', '2018-05-03 13:00:43', '2018-05-03 13:00:43', NULL);
INSERT INTO `sewa` VALUES (38, 'RENT0038', 52, 0, NULL, NULL, -6.59340, 106.79637, 'Bogor', -6.59715, 106.80604, 'Pakuan Ratu', -4.43309, 104.72876, 0, 0, 'pending', '2018-05-04 15:28:04', '2018-05-04 15:28:04', NULL);
INSERT INTO `sewa` VALUES (39, 'RENT0039', 31, 4, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Cibinong', -6.49011, 106.83070, 1910, 0, 'complete', '2018-05-05 00:20:49', '2018-05-27 08:14:05', NULL);
INSERT INTO `sewa` VALUES (40, 'RENT0040', 67, 1, '2018-05-05 00:00:00', '2018-05-17 00:00:00', -6.59340, 106.79637, 'Bogor', -6.59715, 106.80604, NULL, NULL, NULL, 5400000, 0, 'pending', '2018-05-05 00:38:03', '2018-05-05 00:38:03', NULL);
INSERT INTO `sewa` VALUES (41, 'RENT0041', 69, 0, NULL, NULL, 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, 'Merdeka Park', 3.59068, 98.67852, 0, 0, 'pending', '2018-05-09 06:25:24', '2018-05-09 06:25:24', NULL);
INSERT INTO `sewa` VALUES (42, 'RENT0042', 70, 0, NULL, NULL, 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, 'Merdeka Park', 3.59068, 98.67852, 0, 0, 'pending', '2018-05-09 06:36:26', '2018-05-09 06:36:26', NULL);
INSERT INTO `sewa` VALUES (43, 'RENT0043', 71, 0, NULL, NULL, 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, 'Medan', 3.59520, 98.67222, 0, 0, 'pending', '2018-05-09 06:41:36', '2018-05-09 06:41:36', NULL);
INSERT INTO `sewa` VALUES (44, 'RENT0044', 72, 0, NULL, NULL, 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, 'Merdeka Park', 3.59068, 98.67852, 0, 0, 'pending', '2018-05-10 03:33:29', '2018-05-10 03:33:29', NULL);
INSERT INTO `sewa` VALUES (45, 'RENT0045', 73, 0, NULL, NULL, 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, 'Merdeka Park', 3.59068, 98.67852, 0, 0, 'pending', '2018-05-10 03:53:20', '2018-05-10 03:53:20', NULL);
INSERT INTO `sewa` VALUES (46, 'RENT0046', 76, 7, '2018-05-10 00:00:00', '2018-05-31 00:00:00', 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, NULL, NULL, NULL, 7560000, 0, 'pending', '2018-05-10 06:46:25', '2018-05-10 06:46:25', NULL);
INSERT INTO `sewa` VALUES (47, 'RENT0047', 31, 4, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Cibinong', -6.49011, 106.83070, 1910, 0, 'complete', '2018-05-10 06:58:51', '2018-06-10 09:46:29', NULL);
INSERT INTO `sewa` VALUES (48, 'RENT0048', 31, 4, '2018-05-02 00:00:00', '2018-05-02 00:00:00', 37.42200, -122.08400, 'Bogor', -6.55178, 106.62913, 'Cibinong', -6.49011, 106.83070, 1910, 0, 'complete', '2018-05-10 07:02:09', '2018-06-10 09:47:15', NULL);
INSERT INTO `sewa` VALUES (49, 'RENT0049', 76, 7, '2018-05-10 00:00:00', '2018-05-31 00:00:00', 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, NULL, NULL, NULL, 7560000, 0, 'pending', '2018-05-10 07:18:09', '2018-05-10 07:18:09', NULL);
INSERT INTO `sewa` VALUES (50, 'RENT0050', 77, 0, NULL, NULL, -6.65687, 106.85895, 'SPBU Gadog Simpang Rawi', -6.65822, 106.85774, 'BOTANI SQUARE XXI', -6.60241, 106.80680, 0, 0, 'pending', '2018-05-10 15:03:01', '2018-05-10 15:03:01', NULL);
INSERT INTO `sewa` VALUES (51, 'RENT0051', 78, 0, NULL, NULL, -6.65714, 106.86043, 'Vimala Hills', -6.65534, 106.86018, 'Pakuan', -6.63130, 106.82226, 0, 0, 'pending', '2018-05-10 15:04:44', '2018-05-10 15:04:44', NULL);
INSERT INTO `sewa` VALUES (52, 'RENT0052', 81, 0, NULL, NULL, -6.65346, 106.86449, 'Pusdiklat Anggaran dan Perbendaharaan', -6.65445, 106.86534, 'Tajur', -6.53904, 106.92701, 0, 0, 'pending', '2018-05-18 13:34:52', '2018-05-18 13:34:52', NULL);
INSERT INTO `sewa` VALUES (53, 'RENT0053', 88, 0, NULL, NULL, -6.67869, 106.85467, 'Warkop Villa Kuda', -6.67853, 106.85460, 'Ciawi', -6.71240, 106.89455, 0, 0, 'pending', '2018-05-31 14:44:11', '2018-05-31 14:44:11', NULL);
INSERT INTO `sewa` VALUES (54, 'RENT0054', 90, 9, '2018-06-01 00:00:00', '2018-06-07 00:00:00', 3.64262, 98.52940, 'Serba Jadi', 3.63704, 98.52267, NULL, NULL, NULL, 300000, 0, 'pending', '2018-06-01 08:48:46', '2018-06-01 08:48:46', NULL);
INSERT INTO `sewa` VALUES (55, 'RENT0055', 91, 0, NULL, NULL, 3.59888, 98.65999, 'Jl. Pabrik Tenun No.50', 3.59861, 98.65991, 'Carrefour - Medan Citra Garden', 3.54750, 98.65884, 0, 0, 'pending', '2018-06-01 23:45:34', '2018-06-01 23:45:34', NULL);
INSERT INTO `sewa` VALUES (56, 'RENT0056', 92, 0, NULL, NULL, 3.59843, 98.65924, 'RS Mata Prima Vision', 3.59855, 98.65936, 'Carrefour - Medan Citra Garden', 3.54750, 98.65884, 0, 0, 'pending', '2018-06-02 03:38:21', '2018-06-02 03:38:21', NULL);
INSERT INTO `sewa` VALUES (57, 'RENT0057', 93, 0, NULL, NULL, 3.59864, 98.65927, 'RS Mata Prima Vision', 3.59855, 98.65936, 'Kualanamu Interchange', 3.59920, 98.84275, 0, 0, 'pending', '2018-06-04 05:11:54', '2018-06-04 05:11:54', NULL);
INSERT INTO `sewa` VALUES (58, 'RENT0058', 94, 0, NULL, NULL, 37.78825, -122.43240, 'Salak Tower Hotel', -6.58868, 106.80422, 'Realsoft Media Labs', -6.59314, 106.81810, 0, 0, 'pending', '2018-06-09 11:51:45', '2018-06-09 11:51:45', NULL);
INSERT INTO `sewa` VALUES (59, 'RENT0059', 95, 0, NULL, NULL, 37.78825, -122.43240, 'Kedai Kita', -6.59016, 106.80287, 'Ciawi', -6.71240, 106.89455, 0, 0, 'pending', '2018-06-09 12:20:39', '2018-06-09 12:20:39', NULL);
INSERT INTO `sewa` VALUES (60, 'RENT0060', 96, 0, NULL, NULL, -6.58807, 106.80364, 'BOTANI SQUARE XXI', -6.60241, 106.80680, 'Ciawi', -6.71240, 106.89455, 0, 0, 'pending', '2018-06-09 14:07:45', '2018-06-09 14:07:45', NULL);
INSERT INTO `sewa` VALUES (61, 'RENT0061', 97, 0, NULL, NULL, -6.58807, 106.80364, 'Salak Tower Hotel', -6.58868, 106.80422, 'BOTANI SQUARE XXI', -6.60241, 106.80680, 0, 0, 'pending', '2018-06-09 14:12:45', '2018-06-09 14:12:45', NULL);
INSERT INTO `sewa` VALUES (62, 'RENT0062', 98, 0, NULL, NULL, -6.58807, 106.80364, 'Salak Tower Hotel', -6.58868, 106.80422, 'BOTANI SQUARE XXI', -6.60241, 106.80680, 0, 0, 'pending', '2018-06-09 14:19:29', '2018-06-09 14:19:29', NULL);
INSERT INTO `sewa` VALUES (63, 'RENT0063', 99, 0, NULL, NULL, 37.78825, -122.43240, 'Salak Tower Hotel', -6.58868, 106.80422, 'Ciawi', -6.71240, 106.89455, 0, 0, 'pending', '2018-06-09 14:23:10', '2018-06-09 14:23:10', NULL);
INSERT INTO `sewa` VALUES (64, 'RENT0064', 105, 0, NULL, NULL, -6.70762, 106.82142, 'Bumi Caringin Hotel', -6.71144, 106.82132, 'Cibedug', -6.70993, 106.89159, 72972, 0, 'pending', '2018-06-10 09:36:35', '2018-06-10 09:36:35', NULL);
INSERT INTO `sewa` VALUES (65, 'TRANS-CAR0065', 106, 0, NULL, NULL, -6.70764, 106.82150, 'Bumi Caringin Hotel', -6.71144, 106.82132, 'Ciawi', -6.71240, 106.89455, 75354, 0, 'pending', '2018-06-10 10:27:38', '2018-06-10 10:27:38', NULL);
INSERT INTO `sewa` VALUES (66, 'TRANS-CAR0066', 107, 6, NULL, NULL, 37.78825, -122.43240, 'Pusdiklat Anggaran dan Perbendaharaan (Jl. Raya Puncak KM 72, Ds. Gadog, Kec. Megamendung, Gadog, Megamendung, Gadog, Megamendung, Bogor, Jawa Barat 16720, Indonesia)', -6.65445, 106.86534, 'MARKET Ciawi KAB BOGOR (Jl. Raya Puncak, Ciawi, Bogor, Jawa Barat 16720, Indonesia)', -6.65650, 106.84741, 17628, 0, 'confirmed', '2018-06-10 15:18:43', '2018-06-11 16:13:18', NULL);
INSERT INTO `sewa` VALUES (67, 'TRANS-CAR0067', 108, 12, NULL, NULL, 37.78825, -122.43240, 'Pusdiklat Anggaran dan Perbendaharaan (Jl. Raya Puncak KM 72, Ds. Gadog, Kec. Megamendung, Gadog, Megamendung, Gadog, Megamendung, Bogor, Jawa Barat 16720, Indonesia)', -6.65445, 106.86534, 'BOTANI SQUARE XXI (Botani Square Lantai 2, Jalan Raya Pajajaran No. 3A, Tegallega, Bogor Tengah, Tegallega, Bogor Tengah, Kota Bogor, Jawa Barat 16127, Indonesia)', -6.60241, 106.80680, 72438, 0, 'complete', '2018-06-10 15:49:24', '2018-06-11 16:15:45', NULL);
INSERT INTO `sewa` VALUES (68, 'TRANS-CAR0068', 109, 11, '2018-06-12 00:42:28', '2018-06-12 00:43:20', 3.59841, 98.65934, 'RS Mata Prima Vision (Jalan Pabrik Tenun No.51 - 53, Sei Putih Tengah, Medan Petisah, Sei Putih Tengah, Medan Petisah, Kota Medan, Sumatera Utara 20114, Indonesia)', 3.59855, 98.65936, 'Amplas (Amplas, Percut Sei Tuan, Kabupaten Deli Serdang, Sumatera Utara, Indonesia)', 3.56226, 98.74536, 79488, 0, 'complete', '2018-06-11 02:06:49', '2018-06-11 17:43:20', NULL);
INSERT INTO `sewa` VALUES (69, 'TRANS-CAR0069', 110, 12, NULL, '2018-06-12 15:11:23', -6.65093, 106.86118, 'Cisarua (Cisarua, Bogor, West Java, Indonesia)', -6.67995, 106.93229, 'MARKET Ciawi KAB BOGOR (Jl. Raya Puncak, Ciawi, Bogor, Jawa Barat 16720, Indonesia)', -6.65650, 106.84741, 72810, 0, 'complete', '2018-06-11 15:47:02', '2018-06-12 08:11:23', NULL);
INSERT INTO `sewa` VALUES (70, 'TRANS-CAR0070', 111, 12, NULL, '2018-06-12 16:54:45', -6.70898, 106.82245, 'Rafting Cisadane: Baskoro Management (Jalan Raya Sukabumi KM.16,5, Cimande Hilir, Caringin, Bogor, Jawa Barat 16730, Indonesia)', -6.70860, 106.82255, 'Bogor (Bogor, West Java, Indonesia)', -6.55178, 106.62913, 303222, 0, 'complete', '2018-06-12 08:55:28', '2018-06-12 09:54:45', NULL);
INSERT INTO `sewa` VALUES (71, 'TRANS-CAR0071', 112, 0, NULL, NULL, 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, 0, 0, 'pending', '2018-06-12 09:17:11', '2018-06-12 09:17:11', NULL);
INSERT INTO `sewa` VALUES (72, 'TRANS-CAR0072', 113, 0, NULL, NULL, 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, 0, 0, 'pending', '2018-06-12 09:22:25', '2018-06-12 09:22:25', NULL);
INSERT INTO `sewa` VALUES (73, 'TRANS-CAR0073', 114, 0, NULL, NULL, 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, 0, 0, 'pending', '2018-06-12 09:28:06', '2018-06-12 09:28:06', NULL);
INSERT INTO `sewa` VALUES (74, 'TRANS-CAR0074', 115, 0, NULL, NULL, 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, 0, 0, 'pending', '2018-06-12 09:28:35', '2018-06-12 09:28:35', NULL);
INSERT INTO `sewa` VALUES (75, 'TRANS-CAR0075', 116, 0, NULL, NULL, 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, 0, 0, 'pending', '2018-06-12 09:29:19', '2018-06-12 09:29:19', NULL);
INSERT INTO `sewa` VALUES (76, 'TRANS-CAR0076', 117, 0, NULL, NULL, 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, '0 (0)', 0.00000, 0.00000, 0, 0, 'pending', '2018-06-12 09:30:19', '2018-06-12 09:30:19', NULL);
INSERT INTO `sewa` VALUES (77, 'TRANS-CAR0077', 118, 0, NULL, NULL, 3.59850, 98.65982, 'RS Mata Prima Vision (Jalan Pabrik Tenun No.51 - 53, Sei Putih Tengah, Medan Petisah, Sei Putih Tengah, Medan Petisah, Kota Medan, Sumatera Utara 20114, Indonesia)', 3.59855, 98.65936, 'A M P L A S (A M P L A S, Medan Amplas, Kota Medan, Sumatera Utara, Indonesia)', 3.54624, 98.71921, 64296, 0, 'pending', '2018-06-12 09:32:11', '2018-06-12 09:32:11', NULL);
INSERT INTO `sewa` VALUES (78, 'TRANS-CAR0078', 119, 0, NULL, NULL, 3.59861, 98.65983, 'RS Mata Prima Vision (Jalan Pabrik Tenun No.51 - 53, Sei Putih Tengah, Medan Petisah, Sei Putih Tengah, Medan Petisah, Kota Medan, Sumatera Utara 20114, Indonesia)', 3.59855, 98.65936, 'A M P L A S (A M P L A S, Medan Amplas, Kota Medan, Sumatera Utara, Indonesia)', 3.54624, 98.71921, 64296, 0, 'pending', '2018-06-12 09:35:03', '2018-06-12 09:35:03', NULL);
INSERT INTO `sewa` VALUES (79, 'TRANS-CAR0079', 120, 12, '2018-06-12 17:17:12', '2018-06-12 17:17:50', -6.65103, 106.86126, 'MARKET Ciawi KAB BOGOR (Jl. Raya Puncak, Ciawi, Bogor, Jawa Barat 16720, Indonesia)', -6.65650, 106.84741, 'Lippo Plaza Bogor Ekalokasari (Jalan Siliwangi No.123, Sukasari, Bogor Tim., Kota Bogor, Jawa Barat 16142, Indonesia)', -6.62193, 106.81762, 60000, 0, 'complete', '2018-06-12 09:50:30', '2018-06-12 10:17:50', NULL);
INSERT INTO `sewa` VALUES (80, 'TRANS-CAR0080', 121, 12, '2018-06-12 20:15:59', '2018-06-12 20:17:38', -6.65108, 106.86125, 'Aqila Kost & Kontrakan (Jalan Cibalok RT 05/RW 03, Desa Pandansari Gadog, Ciawi, Pandansari, Ciawi, Kota Bogor, Jawa Barat 16720, Indonesia)', -6.65130, 106.86176, 'MARKET Ciawi KAB BOGOR (Jl. Raya Puncak, Ciawi, Bogor, Jawa Barat 16720, Indonesia)', -6.65650, 106.84741, 60000, 0, 'complete', '2018-06-12 13:11:33', '2018-06-12 13:17:38', NULL);
INSERT INTO `sewa` VALUES (81, 'TRANS-CAR0081', 122, 11, '2018-06-12 20:50:03', NULL, -6.70898, 106.82245, 'Kinasih Resort & Conference (Jalan Raya Sukabumi KM.17, Caringin, Bogor, Jawa Barat 16730, Indonesia)', -6.71176, 106.82212, 'Bogor (Bogor, West Java, Indonesia)', -6.55178, 106.62913, 305694, 0, 'collected', '2018-06-12 13:37:14', '2018-06-12 13:50:03', NULL);
INSERT INTO `sewa` VALUES (82, 'TRANS-CAR0082', 123, 0, NULL, NULL, -6.70898, 106.82245, 'Kinasih Resort & Conference (Jalan Raya Sukabumi KM.17, Caringin, Bogor, Jawa Barat 16730, Indonesia)', -6.71176, 106.82212, 'Bogor (Bogor, West Java, Indonesia)', -6.55178, 106.62913, 305694, 0, 'pending', '2018-06-12 15:15:14', '2018-06-12 15:15:14', NULL);
INSERT INTO `sewa` VALUES (83, 'TRANS-CAR0083', 124, 0, NULL, NULL, 37.78825, -122.43240, 'Kinasih Resort & Conference (Jalan Raya Sukabumi KM.17, Caringin, Bogor, Jawa Barat 16730, Indonesia)', -6.71176, 106.82212, 'Bogor (Bogor, Kp. Parung Jambu, Bogor City, West Java, Indonesia)', -6.59715, 106.80604, 134148, 0, 'pending', '2018-06-12 15:30:27', '2018-06-12 15:30:27', NULL);
INSERT INTO `sewa` VALUES (84, 'TRANS-CAR0084', 125, 0, NULL, NULL, -6.65082, 106.86105, 'Alfamar Cibogo2 (Jl. Raya Puncak No.49, Cipayung Datar, Megamendung, Bogor, Jawa Barat 16770, Indonesia)', -6.65178, 106.88685, 'Ciawi (Ciawi, Bogor, Jawa Barat, Indonesia)', -6.71240, 106.89455, 71700, 0, 'pending', '2018-06-12 16:22:13', '2018-06-12 16:22:13', NULL);
INSERT INTO `sewa` VALUES (85, 'TRANS-CAR0085', 126, 12, '2018-06-13 01:41:12', '2018-06-13 01:41:43', -6.65173, 106.88970, 'Spbu 34-16701 (Jalan Raya Puncak Cibogo, Cipayung Datar, Megamendung, Cipayung Datar, Megamendung, Bogor, Jawa Barat 16770, Indonesia)', -6.65135, 106.88990, 'BOTANI SQUARE XXI (Botani Square Lantai 2, Jalan Raya Pajajaran No. 3A, Tegallega, Bogor Tengah, Tegallega, Bogor Tengah, Kota Bogor, Jawa Barat 16127, Indonesia)', -6.60241, 106.80680, 89520, 0, 'complete', '2018-06-12 17:01:49', '2018-06-12 18:41:43', NULL);
INSERT INTO `sewa` VALUES (86, 'TRANS-CAR0086', 127, 0, NULL, NULL, 37.78825, -122.43240, 'Salak Tower Hotel (Jalan Salak No.38-40, Babakan, Bogor Tengah, Babakan, Bogor Tengah, Babakan, Bogor Tengah, Kota Bogor, Jawa Barat 16129, Indonesia)', -6.58868, 106.80422, 'Ciawi (Ciawi, Bogor, West Java, Indonesia)', -6.71240, 106.89455, 86460, 0, 'pending', '2018-06-24 07:06:09', '2018-06-24 07:06:09', NULL);
INSERT INTO `sewa` VALUES (87, 'TRANS-CAR0087', 128, 0, NULL, NULL, -6.70772, 106.82144, 'Jl. Raya Sukabumi No.10 (Jl. Raya Sukabumi No.10, Pd. Kaso Landeuh, Parung Kuda, Sukabumi, Jawa Barat 43357, Indonesia)', -6.81969, 106.76526, 'Depok Town Square (Depok Town Square, Jl. Margonda Raya, Kemiri Muka, Beji, Kota Depok, Jawa Barat 16424, Indonesia)', -6.37181, 106.83171, 261652, 0, 'pending', '2018-06-27 01:59:23', '2018-06-27 01:59:23', NULL);
INSERT INTO `sewa` VALUES (88, 'TRANS-CAR0088', 129, 0, NULL, NULL, -6.56735, 106.85390, 'RS EMC Sentul (Jl. MH. Thamrin Kav. 57, Sentul City, Citaringgul, Babakan Madang, Citaringgul, Babakan Madang, Bogor, Jawa Barat 16810, Indonesia)', -6.56724, 106.85357, 'Ciawi (Ciawi, Bogor, West Java, Indonesia)', -6.71240, 106.89455, 96192, 0, 'pending', '2018-06-28 02:33:47', '2018-06-28 02:33:47', NULL);
INSERT INTO `sewa` VALUES (89, 'TRANS-CAR0089', 130, 0, NULL, NULL, -6.65097, 106.86120, 'MARKET Ciawi KAB BOGOR (Jl. Raya Puncak, Ciawi, Bogor, Jawa Barat 16720, Indonesia)', -6.65650, 106.84741, 'Cicurug (Cicurug, Sukabumi, West Java, Indonesia)', -6.76767, 106.78834, 78672, 0, 'pending', '2018-07-01 03:52:49', '2018-07-01 03:52:49', NULL);
INSERT INTO `sewa` VALUES (90, 'TRANS-CAR0090', 131, 0, NULL, NULL, -6.71235, 106.82273, 'Ciawi (Ciawi, Bogor, West Java, Indonesia)', -6.71240, 106.89455, 'Cicurug (Cicurug, Sukabumi, West Java, Indonesia)', -6.76767, 106.78834, 95872, 0, 'pending', '2018-07-08 07:35:56', '2018-07-08 07:35:56', NULL);
INSERT INTO `sewa` VALUES (91, 'TRANS-CAR0091', 132, 12, '2018-07-11 20:53:39', '2018-07-11 20:54:05', 3.59077, 98.65436, 'Brastagi Supermarket (Jl. Gatot Subroto No.288, Sei Putih Tengah, Medan Petisah, Kota Medan, Sumatera Utara 20113, Indonesia)', 3.59084, 98.65490, 'Hotel Sunggal (Jl. Pantai Bar. No.16, Cinta Damai, Medan Helvetia, Kota Medan, Sumatera Utara 20126, Indonesia)', 3.59847, 98.61191, 21940, 0, 'complete', '2018-07-11 11:12:10', '2018-07-11 13:54:05', NULL);
INSERT INTO `sewa` VALUES (92, 'TRANS-CAR0092', 133, 0, NULL, NULL, 3.59885, 98.66012, 'Jl. Pabrik Tenun No.50 (Jl. Pabrik Tenun No.50, Sei Putih Tim. I, Medan Petisah, Kota Medan, Sumatera Utara 20111, Indonesia)', 3.59861, 98.65991, 'Kampung Lalang (Kp. Lalang, Sunggal, Kabupaten Deli Serdang, Sumatera Utara, Indonesia)', 3.62364, 98.61332, 40000, 0, 'pending', '2018-07-11 14:26:20', '2018-07-11 14:26:20', NULL);
INSERT INTO `sewa` VALUES (93, 'TRANS-CAR0093', 134, 0, NULL, NULL, 37.78825, -122.43240, 'Jl. Sangga Buana No.7-8 (Jl. Sangga Buana No.7-8, Babakan, Bogor Tengah, Kota Bogor, Jawa Barat 16129, Indonesia)', -6.58918, 106.80379, 'Bogor (Bogor, West Java, Indonesia)', -6.55178, 106.62913, 114756, 0, 'pending', '2018-11-03 11:24:30', '2018-11-03 11:24:30', NULL);
INSERT INTO `sewa` VALUES (94, 'TRANS-CAR0094', 135, 0, NULL, NULL, 37.78825, -122.43240, 'Jl. Sangga Buana No.7-8 (Jl. Sangga Buana No.7-8, Babakan, Bogor Tengah, Kota Bogor, Jawa Barat 16129, Indonesia)', -6.58918, 106.80379, 'Bogor (Bogor, West Java, Indonesia)', -6.55178, 106.62913, 114756, 0, 'pending', '2018-11-03 11:24:30', '2018-11-03 11:24:30', NULL);
INSERT INTO `sewa` VALUES (95, 'TRANS-CAR0095', 136, 15, NULL, NULL, 37.78825, -122.43240, 'Jl. Danau Tempe Blok E7 No.E7/Nk (Jl. Danau Tempe Blok E7 No.E7/Nk, RT.5/RW.7, Tegallega, Bogor Tengah, Kota Bogor, Jawa Barat 16129, Indonesia)', -6.59688, 106.80957, 'BOTANI SQUARE XXI (Botani Square Lantai 2, Jalan Raya Pajajaran No. 3A, Tegallega, Bogor Tengah, Tegallega, Bogor Tengah, Kota Bogor, Jawa Barat 16127, Indonesia)', -6.60241, 106.80680, 40000, 0, 'complete', '2018-11-04 05:03:06', '2018-11-04 09:38:49', NULL);
INSERT INTO `sewa` VALUES (96, 'TRANS-CAR0096', 137, 0, NULL, NULL, 37.78825, -122.43240, '31132 (Suka Merindu, Lubai, Kabupaten Muara Enim, Sumatera Selatan 31132, Indonesia)', -3.59835, 104.29774, '31132 (Suka Merindu, Lubai, Kabupaten Muara Enim, Sumatera Selatan 31132, Indonesia)', -3.59835, 104.29774, 37500, 0, 'pending', '2018-12-31 01:21:00', '2018-12-31 01:21:00', NULL);
COMMIT;

-- ----------------------------
-- Table structure for sewa_detail
-- ----------------------------
DROP TABLE IF EXISTS `sewa_detail`;
CREATE TABLE `sewa_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sewa_id` bigint(20) NOT NULL,
  `sewa_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sewa_detail
-- ----------------------------
BEGIN;
INSERT INTO `sewa_detail` VALUES (2, 1, 'reguler', 517, 2907, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (3, 2, 'rental', 5264, 31099, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (4, 3, 'rental', 5264, 31099, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (5, 4, 'rental', 5264, 31099, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (6, 5, 'rental', 5264, 31099, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (7, 6, 'rental', 5077, 81510, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (8, 7, 'rental', 5167, 46957, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (9, 8, 'rental', 457, 1763, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (10, 9, 'rental', 457, 1763, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (11, 10, 'rental', 457, 1763, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (12, 11, 'rental', 14695, 200763, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (13, 12, 'reguler', 11482, 177409, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (14, 13, 'reguler', 45416, 603467, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (15, 14, 'reguler', 11313, 189302, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (16, 15, 'rental', 3438, 21106, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (17, 16, 'rental', 3438, 21106, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (18, 17, 'rental', 5145, 39720, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (19, 18, 'rental', 5145, 39720, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (20, 19, 'rental', 10716, 126554, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (21, 20, 'rental', 11574, 135832, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (22, 21, 'rental', 14695, 200762, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (23, 22, 'rental', 13073, 198906, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (24, 23, 'rental', 7257, 72379, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (25, 24, 'rental', 10032, 178540, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (26, 25, 'rental', 519, 2192, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (27, 26, 'reguler', 3085, 23330, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (28, 27, 'reguler', 3817, 59187, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (29, 28, 'rental', 7359, 85050, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (30, 29, 'rental', 7359, 85050, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (31, 30, 'rental', 5145, 39720, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (32, 31, 'rental', 5145, 39720, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (33, 32, 'rental', 7359, 85050, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (34, 33, 'rental', 7359, 85050, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (35, 34, 'reguler', 3684, 56380, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (36, 35, 'reguler', 1225, 6554, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (37, 36, 'reguler', 1225, 6554, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (38, 37, 'reguler', 1044, 5017, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (39, 38, 'reguler', 37951, 453437, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (40, 39, 'rental', 5145, 39720, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (41, 40, 'rental', 432000, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (42, 41, 'reguler', 2883, 26001, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (43, 42, 'reguler', 2883, 26001, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (44, 43, 'reguler', 2623, 24767, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (45, 44, 'reguler', 2883, 26001, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (46, 45, 'reguler', 2883, 26001, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (47, 46, 'rental', 756000, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (48, 47, 'rental', 5145, 39720, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (49, 48, 'rental', 5145, 39720, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (50, 49, 'rental', 756000, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (51, 50, 'reguler', 971, 11627, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (52, 51, 'reguler', 1204, 6984, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (53, 52, 'reguler', 3157, 32461, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (54, 53, 'reguler', 1431, 7119, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (55, 54, 'rental', 216000, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (56, 55, 'reguler', 1415, 7000, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (57, 56, 'reguler', 1424, 7063, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (58, 57, 'reguler', 3188, 22467, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (59, 58, 'reguler', 595, 2924, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (60, 59, 'reguler', 2779, 21473, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (61, 60, 'reguler', 2491, 19824, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (62, 61, 'reguler', 367, 1767, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (63, 62, 'reguler', 367, 1767, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (64, 63, 'reguler', 2783, 21614, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (65, 64, 'reguler', 2150, 12162, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (66, 65, 'reguler', 2205, 12559, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (67, 66, 'reguler', 550, 2938, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (68, 67, 'reguler', 1051, 12073, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (69, 68, 'reguler', 2922, 13248, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (70, 69, 'reguler', 1742, 12135, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (71, 70, 'reguler', 6094, 50537, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (72, 71, 'reguler', 0, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (73, 72, 'reguler', 0, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (74, 73, 'reguler', 0, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (75, 74, 'reguler', 0, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (76, 75, 'reguler', 0, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (77, 76, 'reguler', 0, 0, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (78, 77, 'reguler', 2137, 10716, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (79, 78, 'reguler', 2137, 10716, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (80, 79, 'reguler', 923, 5682, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (81, 80, 'reguler', 775, 3770, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (82, 81, 'reguler', 6188, 50949, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (83, 82, 'reguler', 6188, 50949, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (84, 83, 'reguler', 2921, 22358, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (85, 84, 'reguler', 2054, 11950, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (86, 85, 'reguler', 1378, 14920, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (87, 86, 'reguler', 2783, 21615, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (88, 87, 'reguler', 6478, 65413, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (89, 88, 'reguler', 2811, 24048, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (90, 89, 'reguler', 2959, 19668, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (91, 90, 'reguler', 3906, 23968, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (92, 91, 'reguler', 1035, 5485, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (93, 92, 'reguler', 1609, 8427, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (94, 93, 'reguler', 3934, 28689, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (95, 94, 'reguler', 3934, 28689, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (96, 95, 'reguler', 588, 2787, NULL, NULL);
INSERT INTO `sewa_detail` VALUES (97, 96, 'reguler', 0, 0, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for statistik
-- ----------------------------
DROP TABLE IF EXISTS `statistik`;
CREATE TABLE `statistik` (
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of statistik
-- ----------------------------
BEGIN;
INSERT INTO `statistik` VALUES ('127.0.0.1', '2019-04-15', 17, '1555300627', NULL, NULL);
INSERT INTO `statistik` VALUES ('127.0.0.1', '2019-04-17', 10, '1555517541', NULL, NULL);
INSERT INTO `statistik` VALUES ('127.0.0.1', '2019-04-18', 11, '1555596803', NULL, NULL);
INSERT INTO `statistik` VALUES ('127.0.0.1', '2019-04-19', 1, '1555668347', NULL, NULL);
INSERT INTO `statistik` VALUES ('::1', '2019-04-19', 1, '1555677265', NULL, NULL);
INSERT INTO `statistik` VALUES ('192.168.43.110', '2019-04-20', 2, '1555754922', NULL, NULL);
INSERT INTO `statistik` VALUES ('127.0.0.1', '2019-04-26', 31, '1556252256', NULL, NULL);
INSERT INTO `statistik` VALUES ('127.0.0.1', '2019-04-30', 8, '1556607050', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tm_menu
-- ----------------------------
DROP TABLE IF EXISTS `tm_menu`;
CREATE TABLE `tm_menu` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 NOT NULL,
  `icon` varchar(255) CHARACTER SET latin1 NOT NULL,
  `order` int(11) NOT NULL,
  `isshowed` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '0',
  `isactived` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tm_menu
-- ----------------------------
BEGIN;
INSERT INTO `tm_menu` VALUES (1, 0, 'Manual Booking', 'backend/booking', 'fa fa-order', 10, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (2, 0, 'Trip/Jobs', 'backend/trip_job', 'fa fa-circle-o', 11, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (3, 0, 'Laporan', '#', 'icon-file-media', 3, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (5, 0, 'Peta', 'map', 'fa fa-map', 4, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (9, 0, 'Pengaturan', '#', 'fa fa-cogs', 13, '0', '1', '2018-11-24 01:24:54', '2018-11-24 01:24:54');
INSERT INTO `tm_menu` VALUES (10, 9, 'Menu', 'setting/menu', 'fa fa-arrows-alt', 2, '0', '1', '2018-11-24 05:39:14', '2018-11-24 05:39:14');
INSERT INTO `tm_menu` VALUES (11, 9, 'User', 'setting/user', 'fa fa-users', 3, '0', '1', '2018-11-24 05:56:59', '2018-11-24 05:56:59');
INSERT INTO `tm_menu` VALUES (12, 9, 'Umum', 'setting/index', 'fa fa-bars', 0, '0', '1', '2018-11-24 06:07:23', '2018-11-24 06:07:23');
INSERT INTO `tm_menu` VALUES (18, 9, 'Hak Akses Menu', 'setting/permissions-menu', 'fa fa-circle-o', 5, '0', '1', '2018-12-02 13:00:57', '2018-12-29 04:27:40');
INSERT INTO `tm_menu` VALUES (21, 0, 'Dashboard', 'backend/dashboard/index', 'fa fa-circle-o', 1, '0', '1', '2018-12-28 04:33:06', '2018-12-28 04:33:06');
INSERT INTO `tm_menu` VALUES (22, 0, 'Upload', 'backend/dokumen', 'fa fa-file', 2, '0', '0', '2018-12-28 21:20:07', '2018-12-28 21:21:10');
INSERT INTO `tm_menu` VALUES (23, 9, 'Profil', 'setting/profile', 'fa fa-user', 1, '0', '1', '2018-12-29 03:11:37', '2018-12-29 03:11:37');
INSERT INTO `tm_menu` VALUES (24, 9, 'Log', 'backend/log', 'fa fa-history', 6, '0', '1', '2018-12-29 03:21:06', '2018-12-29 03:21:06');
INSERT INTO `tm_menu` VALUES (25, 3, 'Laporan Pembayaran', 'backend/laporan_pembayaran', 'fa fa-money', 0, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (26, 3, 'User Wallet', 'backend', 'fa fa-wallet', 1, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (27, 3, 'Driver Log', 'backend', 'fa fa-users', 2, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (28, 3, 'Cancelled Trip', 'backend', 'fa fa-road', 3, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (29, 3, 'Trip Time Variance', 'backend', 'fa fa-time', 4, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (30, 0, 'Sites Statistic', 'backend/statistic', 'fa fa-chart', 2, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (31, 0, 'Provider / Driver', 'backend/driver', 'fa fa-users', 13, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (32, 0, 'Promo', 'backend/promo', 'fa fa-document-o', 5, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (33, 0, 'Reviews', 'backend/reviews', 'fa fa-reviews', 6, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (34, 0, 'Cancelled / Decline Alert', 'backend/candec', 'fa', 7, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (35, 0, 'Manage Locations', 'backend/manage_locations', 'fa', 8, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (36, 0, 'Utility', 'backend', 'fa', 12, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (37, 9, 'Email Template', 'backend', 'fa ', 0, '0', '1', NULL, NULL);
INSERT INTO `tm_menu` VALUES (38, 0, 'Customer', 'backend/customer', 'fa', 9, '0', '1', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for trip
-- ----------------------------
DROP TABLE IF EXISTS `trip`;
CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_code` varchar(20) DEFAULT NULL,
  `trip_job` varchar(10) DEFAULT NULL,
  `trip_bookby` int(11) DEFAULT NULL,
  `trip_address_origin` varchar(255) DEFAULT NULL,
  `trip_address_destination` varchar(255) DEFAULT NULL,
  `trip_date` datetime DEFAULT NULL,
  `trip_driver` int(11) DEFAULT NULL,
  `trip_type` int(11) DEFAULT NULL,
  `trip_status` int(11) DEFAULT NULL,
  `trip_total` double DEFAULT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trip
-- ----------------------------
BEGIN;
INSERT INTO `trip` VALUES (8, '5980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `trip` VALUES (9, '6', NULL, NULL, NULL, NULL, '2019-04-24 00:00:00', NULL, 1, 0, NULL);
INSERT INTO `trip` VALUES (10, 'MTA=', NULL, NULL, NULL, NULL, '2019-04-24 00:00:00', NULL, 1, 0, NULL);
INSERT INTO `trip` VALUES (11, 'NDI3MzM1OTk2', NULL, NULL, NULL, NULL, '2019-04-24 00:00:00', NULL, 1, 0, NULL);
INSERT INTO `trip` VALUES (16, 'NDUxMjU3ODgz', NULL, NULL, NULL, NULL, '2019-04-24 00:00:00', NULL, 1, 0, NULL);
COMMIT;

-- ----------------------------
-- Table structure for trip_detail
-- ----------------------------
DROP TABLE IF EXISTS `trip_detail`;
CREATE TABLE `trip_detail` (
  `trip_id` int(11) NOT NULL,
  `trip_or_latitude` double DEFAULT NULL,
  `trip_or_longitude` double DEFAULT NULL,
  `trip_des_latitude` double DEFAULT NULL,
  `trip_des_longitude` double DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `distance` int(11) DEFAULT NULL,
  `data` text,
  `trip_promo` varchar(100) DEFAULT NULL,
  `trip_discount` float DEFAULT NULL,
  `trip_rent` int(11) DEFAULT NULL,
  `trip_creas` text,
  `trip_cby` int(11) DEFAULT NULL,
  `trip_rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trip_detail
-- ----------------------------
BEGIN;
INSERT INTO `trip_detail` VALUES (16, NULL, NULL, NULL, NULL, 5145, 39720, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `per_min` int(11) DEFAULT NULL,
  `per_miles` int(11) DEFAULT NULL,
  `person_capacity` int(5) DEFAULT NULL,
  `com` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of type
-- ----------------------------
BEGIN;
INSERT INTO `type` VALUES (1, 'Basic', NULL, 1, 1, 1, 3, 10, '2018-03-29 05:26:21', '2018-03-29 05:26:21');
INSERT INTO `type` VALUES (2, 'Luxurious', NULL, 1, 4, 4, 10, 20, '2018-03-29 05:26:21', '2018-03-29 05:26:21');
INSERT INTO `type` VALUES (3, 'Pool', NULL, 1, 1, 1, 5, 6, '2018-03-29 05:26:21', '2018-03-29 05:26:21');
COMMIT;

-- ----------------------------
-- Table structure for user_dokumen
-- ----------------------------
DROP TABLE IF EXISTS `user_dokumen`;
CREATE TABLE `user_dokumen` (
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_location
-- ----------------------------
DROP TABLE IF EXISTS `user_location`;
CREATE TABLE `user_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `latitude` decimal(8,5) NOT NULL,
  `longitude` decimal(8,5) NOT NULL,
  `latest_update` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_location
-- ----------------------------
BEGIN;
INSERT INTO `user_location` VALUES (1, 23, 3.64262, 98.52940, '2018-05-07 14:16:05', '2018-05-07 07:15:27', '2018-05-07 07:16:05', NULL);
INSERT INTO `user_location` VALUES (2, 22, -6.71240, 106.82294, '2018-07-08 16:31:34', '2018-05-07 07:17:03', '2018-07-08 09:31:34', NULL);
INSERT INTO `user_location` VALUES (3, 24, 3.64262, 98.52940, '2018-05-07 16:34:29', '2018-05-07 09:34:29', '2018-05-07 09:34:29', NULL);
INSERT INTO `user_location` VALUES (4, 2, -6.65152, 106.86094, '2018-06-11 22:22:53', '2018-06-11 15:15:46', '2018-06-11 15:22:53', NULL);
INSERT INTO `user_location` VALUES (5, 37, -6.65582, 106.84866, '2018-07-11 20:54:18', '2018-06-11 15:23:25', '2018-07-11 13:54:18', NULL);
INSERT INTO `user_location` VALUES (6, 34, -6.70904, 106.82226, '2018-06-13 10:55:05', '2018-06-11 17:41:54', '2018-06-13 03:55:05', NULL);
INSERT INTO `user_location` VALUES (7, 39, -6.65100, 106.86125, '2018-06-27 21:44:01', '2018-06-27 14:43:41', '2018-06-27 14:44:01', NULL);
INSERT INTO `user_location` VALUES (8, 44, -6.58924, 106.80351, '2018-11-03 18:54:49', '2018-11-03 11:54:11', '2018-11-03 11:54:49', NULL);
COMMIT;

-- ----------------------------
-- Table structure for user_profile
-- ----------------------------
DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `user_id` int(11) DEFAULT NULL,
  `wallet` double(15,8) DEFAULT NULL,
  `services` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for user_verifications
-- ----------------------------
DROP TABLE IF EXISTS `user_verifications`;
CREATE TABLE `user_verifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_verifications_user_id_foreign` (`user_id`),
  CONSTRAINT `user_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isactived` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isverified` tinyint(1) NOT NULL DEFAULT '0',
  `latestlogin` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8_unicode_ci,
  `uuid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Super Admin', 'superadmin', 'superadmin@example.com', '$2y$10$/lqrqey2J2HGk8Kl88CR7.XN44QeZ0/uogxznENvow5DS5JL.L7vG', '1', 1, '2019-04-30 06:10:33', 'http://placehold.it/160', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImI2OGNhZmFjNzk5NjRmZGRlYjBiZWQ4NzhlYWE1ZmUxOTdiMjY3MDJkZWM2YjAxNzBmOGRmYWIyNGUzM2RlZGZkNmRiMzZjNzkxMTI1YTg2In0.eyJhdWQiOiIzIiwianRpIjoiYjY4Y2FmYWM3OTk2NGZkZGViMGJlZDg3OGVhYTVmZTE5N2IyNjcwMmRlYzZiMDE3MGY4ZGZhYjI0ZTMzZGVkZmQ2ZGIzNmM3OTExMjVhODYiLCJpYXQiOjE1NTY2MDQ2MzMsIm5iZiI6MTU1NjYwNDYzMywiZXhwIjoxNTg4MjI3MDMzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TwuzkOz3c_Y9PdWt7uuUF1XY2dFJwkPu1NLUvm8PtsxB_bgERdyBd4YcC2PwD4SZyVIcixeYnYKZxWopYYTXgipYK55QZYvinbS9qPyHijTRdxPNKID0hVJBiEDG6eWSzw3bVayqei4brB9piBZhyFNgQwXcc9DSz6oLH4kBf1KJr2IwuuPnrrM7EPriEEvjylipv_oJojQr7_o9EKeg2jDch82qBSk-uHCUFDajRiuSB-GXCDoWHiGm8CxH4OmJmv7m2rtUeoGrZqHN0xckeqh1k3TFTKpVMi82_a8y1J1TtZqyjTSscZAsxvUiOOpm_c4cTG6s4qMMGJtZNQYAF4jmMHTEXP7NSCGbKmCkTiLtlYfh8A2RyMowPKdvSB4QJVl3y8VkpHeLTyIragyfCvLOfsRjgXj2iEOMZdLtHPIdrDCqm7DpVSev4SYTiRP-3IS7e4Bv5aTVNGf4rbuMucDfVkFBY2mmn1ND_Lg6MGyJwBRfHL4o6bG3r4457y4O2f3qVo9tTb8v4KTPRWIHNDAmvg7cYmwd5KvT0eqXJ0wWHShtmrpUalAleFVG-_YsYLXqiRD5MsMF9K6oHbdPxYSm9Lvf5QA_km0jxUsfppms-lQneR1ZpacvYDpr5VWhQQxG7kjaya1SYKg7oQh9wRf07uoDPJWbySYCFT5NdDc', NULL, 'sP8FXL2aeTvVUGHOiIJmIBgarlDAWL79vNzh099c0vMsJENoUSINiib6jXF4', '2018-03-29 05:21:42', '2019-04-30 06:10:33');
INSERT INTO `users` VALUES (2, 'Administrator', 'admin', 'admin@example.com', '$2y$10$aHmu28SCD7XM5T7CJ.WFlupteumZTgVnan8ajTjj.L.bZ.CiUXTUC', '1', 1, '2019-04-19 16:26:20', 'http://placehold.it/160', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQzMzQxMThhMWZhY2Y2ZTkwZTEzMWYyNzYyN2M3MTEzMzYyNTE1YWRmYWI3NjBkNDlhMDFmM2MzNWI0ZDExOWZmNzBlYTgwMTE1NDBhODQ5In0.eyJhdWQiOiIzIiwianRpIjoiNDMzNDExOGExZmFjZjZlOTBlMTMxZjI3NjI3YzcxMTMzNjI1MTVhZGZhYjc2MGQ0OWEwMWYzYzM1YjRkMTE5ZmY3MGVhODAxMTU0MGE4NDkiLCJpYXQiOjE1NTU2OTExODAsIm5iZiI6MTU1NTY5MTE4MCwiZXhwIjoxNTg3MzEzNTgwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.Pq_VJefOw5E6qt9_urIY4DXy7zNtRzGb3HYn7OLbPGLfUQl8Qb_on06Rh17lm-H8EhaIdIz5IEI2obk3RXOa3zlQO4t-zXZ1eo-Gu5jSK6ODdEslkWwLqZwJ42c9IY6JKoP7f9CJLKiPfci9kM7Sm0CYAWFmt85slaX_k7Lb9o6jMLi7d-YPM0klUW7M8ucZWDYhPhNNF9Pk-wx3--raoZAXhDpf_wpXQjwK0_7p0PbS5iKZ9UkTmAFbpHRVAQTaHJmoFDKRkFI_rJXZRdajBC_EYu1--Dbe34IuhwWw7Ydi7IgkdczaEgiIwW0qFSQxpkkDRSF0m9QtiYHlB3ezhyyTcE6F88D6v4vOlNmP-PBdaa8kD1BGC67snlEecTi8MIamlLvott92esEaD419GIRitxVEIeGom_K3XUsiZHEvgy_bTdRCETAfWqD4CDPYYYgmHOfI6K0rFivBeh_1ikEXaHGwD7LWdBJWyvl7VtORjfYVwUmkhtQtjB7TAULFOqnDeVoUpV4YVqG8NI7yhgNvageKpnEByCdQhfYXbY-mB-uTLWGjKIC2RAaVpp5c22MZIjmV63m1xvc4BY44ZMvJ3k0u9cZdKzSmhEzguxs6mjYVwdN9P7IzQu04G2ixGpeto0Oe6TAwqsq4Si878ZtCXXg71lmBtwE6NUGErcU', NULL, 'QDT0qqzfgtPdz0PqLaRchqs0hjumg0lPsfUIjhQxXumRMJQ2FjzzmVEAF7xK', '2018-03-29 05:21:42', '2019-04-19 16:26:20');
INSERT INTO `users` VALUES (3, 'Driver Agya', 'agya', 'agya@gmail.com', '$2y$10$387EOdztbyj13gMitZWIjeF9KqY/zX8UKzhk7XmSWvsDmp2dLPAmS', '1', 1, NULL, 'https://cdn.thestage.co.uk/wp-content/uploads/2015/05/Benedict-Cumberbatch-photo-credit-Victoria-Erdelevskaya-NT.jpg', NULL, NULL, 'ySoIoesfeJOHNg44hAzznfvoZoWloR0uyAwnrIYJuEAReNczNHMaEqrK0Yrl', '2018-03-29 16:50:45', '2018-04-05 04:49:08');
INSERT INTO `users` VALUES (20, 'Driver Fortuner', 'fortuner', 'fortuner@gmail.com', '$2y$10$52lSCh4LzyjxGUHWPlybKOA02K6vvn5Kjmc/PpE.4nxmuyfRz.vDi', '1', 1, NULL, 'http://placehold.it/160', NULL, NULL, NULL, '2018-04-18 04:15:20', '2018-04-18 04:15:20');
INSERT INTO `users` VALUES (21, 'Driver Alphard', 'alphard', 'alphard@gmail.com', '$2y$10$52lSCh4LzyjxGUHWPlybKOA02K6vvn5Kjmc/PpE.4nxmuyfRz.vDi', '1', 1, NULL, 'http://placehold.it/160', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (22, 'Driver Innova', 'innova', 'innova@gmail.com', '$2y$10$aHmu28SCD7XM5T7CJ.WFlupteumZTgVnan8ajTjj.L.bZ.CiUXTUC', '1', 1, NULL, 'http://placehold.it/160', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (23, 'Avanza', 'avanza', 'avanza@gmail.com', '$2y$10$aHmu28SCD7XM5T7CJ.WFlupteumZTgVnan8ajTjj.L.bZ.CiUXTUC', '1', 1, NULL, 'http://placehold.it/160', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (24, 'Proton', 'proton', 'proton@gmail.com', '$2y$10$Lbca/tI0H.AG4LY.JR9ej.4mEApR4RcE96OhAdUacY2xXA4NtBGpO', '1', 1, NULL, 'http://placehold.it/160', NULL, NULL, NULL, NULL, '2018-11-03 06:30:39');
INSERT INTO `users` VALUES (25, 'Calya', 'calya', 'calya@gmail.com', '$2y$10$aHmu28SCD7XM5T7CJ.WFlupteumZTgVnan8ajTjj.L.bZ.CiUXTUC', '1', 1, NULL, 'http://placehold.it/160', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (26, 'Terios', 'terios', 'terios@gmail.com', '$10$52lSCh4LzyjxGUHWPlybKOA02K6vvn5Kjmc/PpE.4nxmuyfRz.vDi', '1', 1, NULL, 'http://placehold.it/160', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (31, 'Muhamad Anjar', 'anjar37', 'muhamadanjar37@gmail.com', '$2y$10$UusxpKwLfSWtcF.Y2MNCK.hcz3skEXv2LoV7uhP/1Khb2sRqY.Voq', '1', 0, NULL, NULL, NULL, NULL, NULL, '2018-06-11 07:47:27', '2018-11-03 11:36:43');
INSERT INTO `users` VALUES (34, 'Testing ihwan Driver', 'driverihwan', 'Ihwan@futuremediadevelop.com', '$2y$10$aHmu28SCD7XM5T7CJ.WFlupteumZTgVnan8ajTjj.L.bZ.CiUXTUC', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-06-11 08:21:13', '2018-06-11 08:21:13');
INSERT INTO `users` VALUES (44, 'ihwana', 'sopiana', 'ihwana.sopiana@gmail.com', '$2y$10$e8gvhVdPh/XIOjtALJJ8A.DzOR8KEjqzTjXL3o5CW38cugO/FttzW', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-11-03 11:49:11', '2018-11-03 11:53:15');
INSERT INTO `users` VALUES (45, 'ihwantesting', 'ihwanusername', 'ihwanemail@gmail.com', '$2y$10$ySBeNkdaEpTXAg616e7z9OBh5SwplqLBcztEh5ZWx87u2tYLBEgTG', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-11-03 12:36:51', '2018-11-03 12:38:13');
INSERT INTO `users` VALUES (46, 'Rudy', 'rudy', 'rudy@gmail.com', '$2y$10$bKROtVs6DqbH8Inf2C0BYuxV12B5bOqk94KMB3pttngHY.LxDqNpi', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-11-04 04:56:02', '2018-11-04 09:53:12');
INSERT INTO `users` VALUES (47, 'ihwan sofian', 'ihwan123', 'ihwan123@gmail.com', '$2y$10$yyd9/qbyhlh94Mry0ZXaG.k3O3lil9tTG2AMdunFfq2J7w6ZF0mAa', '1', 1, NULL, '1541321413_fotoktp.jpg', NULL, NULL, NULL, '2018-11-04 08:38:24', '2018-11-04 08:50:20');
INSERT INTO `users` VALUES (48, 'Muhamad Anjar', 'mulutbusuk', 'anjar@password.com', '$2y$10$dpHqLul3GXdGk0KgP9cFz.LIZIWyN5KFr/NwDYCzGxlY83d7kCdnW', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2019-04-17 16:06:17', '2019-04-17 16:06:17');
INSERT INTO `users` VALUES (49, 'Testing user', 'testing', 'testing@example.com', '$2y$10$2v/ipbdN/WAPCP7or3mDTuKAn0FQN6GZ9.SV9AM32oqspAsyu8Wm.', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2019-04-24 15:37:47', '2019-04-24 15:37:47');
COMMIT;

-- ----------------------------
-- Table structure for wilayah_desa
-- ----------------------------
DROP TABLE IF EXISTS `wilayah_desa`;
CREATE TABLE `wilayah_desa` (
  `kode_desa` bigint(20) NOT NULL,
  `nama_desa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_kec` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_desa`),
  UNIQUE KEY `wilayah_desa_kode_desa_unique` (`kode_desa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wilayah_kabupaten
-- ----------------------------
DROP TABLE IF EXISTS `wilayah_kabupaten`;
CREATE TABLE `wilayah_kabupaten` (
  `kode_kab` bigint(20) NOT NULL,
  `nama_kabupaten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_prov` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_kab`),
  UNIQUE KEY `wilayah_kabupaten_kode_kab_unique` (`kode_kab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wilayah_kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `wilayah_kecamatan`;
CREATE TABLE `wilayah_kecamatan` (
  `kode_kec` bigint(20) NOT NULL,
  `nama_kecamatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_kab` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_kec`),
  UNIQUE KEY `wilayah_kecamatan_kode_kec_unique` (`kode_kec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wilayah_provinsi
-- ----------------------------
DROP TABLE IF EXISTS `wilayah_provinsi`;
CREATE TABLE `wilayah_provinsi` (
  `kode_prov` bigint(20) NOT NULL,
  `nama_provinsi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_prov`),
  UNIQUE KEY `wilayah_provinsi_kode_prov_unique` (`kode_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- View structure for driverrental
-- ----------------------------
DROP VIEW IF EXISTS `driverrental`;
CREATE ALGORITHM=UNDEFINED DEFINER=`u9196801`@`localhost` SQL SECURITY DEFINER VIEW `driverrental` AS select `users`.`id` AS `userID`,`users`.`name` AS `userNamaLengkap`,`users`.`username` AS `username`,`users`.`email` AS `userEmail`,`users`.`password` AS `password`,`users`.`isactived` AS `isactived`,`users`.`latestlogin` AS `latestlogin`,`users`.`foto` AS `driverFoto`,`users`.`uuid` AS `uuid`,`users`.`remember_token` AS `remember_token`,`users`.`isverified` AS `isverified`,`officers`.`nip` AS `nip`,`officers`.`alamat` AS `alamat`,`officers`.`no_telp` AS `driverTelp`,`officers`.`role` AS `role`,`officers`.`deposit` AS `deposit`,`mobil`.`id` AS `mobilID`,`mobil`.`no_plat` AS `no_plat`,`mobil`.`name` AS `namaMobil`,`mobil`.`merk` AS `merk`,`mobil`.`type` AS `type`,`mobil`.`warna` AS `warna`,`mobil`.`harga` AS `harga`,`mobil`.`harga_perjam` AS `harga_perjam`,`mobil`.`tahun` AS `tahun`,`mobil`.`foto` AS `fotoMobil`,`mobil`.`status` AS `statusMobil`,`officers`.`pangkat_id` AS `pangkat_id`,`officers`.`jabatan_id` AS `jabatan_id`,`officers`.`name` AS `officerName` from ((`mobil` join `users` on((`mobil`.`user_id` = `users`.`id`))) join `officers` on((`officers`.`user_id` = `users`.`id`)));

-- ----------------------------
-- View structure for sewamobil
-- ----------------------------
DROP VIEW IF EXISTS `sewamobil`;
CREATE ALGORITHM=UNDEFINED DEFINER=`u9196801`@`localhost` SQL SECURITY DEFINER VIEW `sewamobil` AS select `sewa`.`id` AS `id`,`sewa`.`no_transaksi` AS `no_transaksi`,`sewa`.`customer_id` AS `customer_id`,`sewa`.`mobil_id` AS `mobil_id`,`sewa`.`tgl_mulai` AS `tgl_mulai`,`sewa`.`tgl_akhir` AS `tgl_akhir`,`sewa`.`sewa_latitude` AS `sewa_latitude`,`sewa`.`sewa_longitude` AS `sewa_longitude`,`sewa`.`origin` AS `origin`,`sewa`.`origin_latitude` AS `origin_latitude`,`sewa`.`origin_longitude` AS `origin_longitude`,`sewa`.`destination` AS `destination`,`sewa`.`destination_latitude` AS `destination_latitude`,`sewa`.`destination_longitude` AS `destination_longitude`,`sewa`.`total_bayar` AS `total_bayar`,`sewa`.`denda` AS `denda`,`sewa`.`status` AS `sewaStatus`,`sewa`.`created_at` AS `created_at`,`sewa`.`updated_at` AS `updated_at`,`sewa`.`delete_at` AS `delete_at`,`sewa_detail`.`sewa_type` AS `sewa_type`,`sewa_detail`.`duration` AS `duration`,`sewa_detail`.`distance` AS `distance`,`customers`.`sex` AS `sex`,`customers`.`name` AS `customerName`,`customers`.`email` AS `customerEmail`,`customers`.`no_telp` AS `customerTelp`,`customers`.`religion` AS `religion`,`customers`.`tgl_lahir` AS `tgl_lahir`,`customers`.`address` AS `address`,`customers`.`city_id` AS `city_id`,`customers`.`job` AS `job`,`customers`.`nationality` AS `nationality`,`customers`.`education` AS `education`,`customers`.`status` AS `customerStatus` from ((`sewa` join `sewa_detail` on((`sewa`.`id` = `sewa_detail`.`sewa_id`))) join `customers` on((`sewa`.`customer_id` = `customers`.`id`)));

SET FOREIGN_KEY_CHECKS = 1;
