/*
 Navicat Premium Data Transfer

 Source Server         : computer
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : fathscooter

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 15/07/2023 23:14:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for analysis
-- ----------------------------
DROP TABLE IF EXISTS `analysis`;
CREATE TABLE `analysis`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `year` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of analysis
-- ----------------------------
INSERT INTO `analysis` VALUES (1, '06', 2023, '2023-07-08 22:14:08', '2023-07-09 04:44:12', '2023-07-09 04:44:12', 1, 1);
INSERT INTO `analysis` VALUES (2, '06', 2023, '2023-07-11 05:51:33', '2023-07-15 09:05:03', '2023-07-15 09:05:03', 1, 1);
INSERT INTO `analysis` VALUES (3, '06', 2023, '2023-07-15 17:46:22', '2023-07-15 10:58:12', '2023-07-15 10:58:12', 1, 1);
INSERT INTO `analysis` VALUES (4, '06', 2023, '2023-07-15 18:03:21', '2023-07-15 11:04:40', '2023-07-15 11:04:40', 1, 1);
INSERT INTO `analysis` VALUES (5, '06', 2023, '2023-07-15 18:05:20', '2023-07-15 11:16:18', '2023-07-15 11:16:18', 1, 1);
INSERT INTO `analysis` VALUES (6, '06', 2023, '2023-07-15 18:57:45', NULL, NULL, 1, NULL);

-- ----------------------------
-- Table structure for category_prod
-- ----------------------------
DROP TABLE IF EXISTS `category_prod`;
CREATE TABLE `category_prod`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category_prod
-- ----------------------------
INSERT INTO `category_prod` VALUES (1, 'Engine', 'Parts of Engine', '2022-11-18 13:48:17', NULL, NULL);
INSERT INTO `category_prod` VALUES (3, 'Body', 'Parts of Body', '2022-11-18 13:49:21', NULL, NULL);
INSERT INTO `category_prod` VALUES (4, 'Electrical', 'Parts of Electic', '2022-11-18 13:49:45', '2023-01-06 13:22:43', '2023-04-08 17:32:56');
INSERT INTO `category_prod` VALUES (5, 'Accessories', 'Acc', '2022-11-18 13:49:56', NULL, NULL);
INSERT INTO `category_prod` VALUES (11, 'Brake System', NULL, '2023-04-29 22:53:36', NULL, NULL);

-- ----------------------------
-- Table structure for detail_analysis
-- ----------------------------
DROP TABLE IF EXISTS `detail_analysis`;
CREATE TABLE `detail_analysis`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_analysis` int NULL DEFAULT NULL,
  `id_product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `demand` int NULL DEFAULT NULL,
  `setupcost` int NULL DEFAULT NULL,
  `holdingcost` int NULL DEFAULT NULL,
  `eoq_value` double NULL DEFAULT NULL,
  `avg_sales` int NULL DEFAULT NULL,
  `max_sales` int NULL DEFAULT NULL,
  `avg_lead_time` int NULL DEFAULT NULL,
  `max_lead_time` int NULL DEFAULT NULL,
  `safety_stock` double NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detail_analysis
-- ----------------------------
INSERT INTO `detail_analysis` VALUES (1, 1, '9', 3, 110000, 5000, 11.49, NULL, NULL, NULL, NULL, NULL, '2023-07-08 22:14:08', '2023-07-09 04:44:12', '2023-07-09 04:44:12');
INSERT INTO `detail_analysis` VALUES (2, 1, '8', 5, 145500, 5000, 17.06, NULL, NULL, NULL, NULL, NULL, '2023-07-08 22:14:08', '2023-07-09 04:44:12', '2023-07-09 04:44:12');
INSERT INTO `detail_analysis` VALUES (3, 2, '9', 3, 110000, 20000, 5.74, 2, NULL, NULL, NULL, 60, '2023-07-11 05:51:33', '2023-07-15 09:05:03', '2023-07-15 09:05:03');
INSERT INTO `detail_analysis` VALUES (4, 2, '8', 5, 145500, 10000, 12.06, 1, NULL, NULL, NULL, 30, '2023-07-11 05:51:33', '2023-07-15 09:05:03', '2023-07-15 09:05:03');
INSERT INTO `detail_analysis` VALUES (5, 3, '9', 3, 110000, 10000, 8.12, 2, 2, 1, 1, 0, '2023-07-15 17:46:22', '2023-07-15 10:58:12', '2023-07-15 10:58:12');
INSERT INTO `detail_analysis` VALUES (6, 3, '8', 5, 145500, 10000, 12.06, 1, 2, 1, 1, 1, '2023-07-15 17:46:22', '2023-07-15 10:58:12', '2023-07-15 10:58:12');
INSERT INTO `detail_analysis` VALUES (7, 4, '9', 3, 110000, NULL, NULL, 2, 2, 1, 1, 0, '2023-07-15 18:03:21', '2023-07-15 11:04:40', '2023-07-15 11:04:40');
INSERT INTO `detail_analysis` VALUES (8, 4, '8', 5, 145500, NULL, NULL, 1, 2, 1, 1, 1, '2023-07-15 18:03:21', '2023-07-15 11:04:40', '2023-07-15 11:04:40');
INSERT INTO `detail_analysis` VALUES (9, 5, '9', 3, 110000, 5000, 11.49, 2, 2, 1, 2, 2, '2023-07-15 18:05:20', '2023-07-15 11:16:18', '2023-07-15 11:16:18');
INSERT INTO `detail_analysis` VALUES (10, 5, '8', 5, 145500, 5000, 17.06, 1, 2, 1, 3, 5, '2023-07-15 18:05:20', '2023-07-15 11:16:18', '2023-07-15 11:16:18');
INSERT INTO `detail_analysis` VALUES (11, 6, '9', 7, 110000, 5000, 17.55, 2, 3, 1, 1, 1, '2023-07-15 18:57:45', NULL, NULL);
INSERT INTO `detail_analysis` VALUES (12, 6, '8', 6, 145500, 5000, 18.69, 1, 2, 1, 1, 1, '2023-07-15 18:57:45', NULL, NULL);

-- ----------------------------
-- Table structure for details_order
-- ----------------------------
DROP TABLE IF EXISTS `details_order`;
CREATE TABLE `details_order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_order` int NULL DEFAULT NULL,
  `id_product` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `base_price_save` int NULL DEFAULT NULL,
  `selling_price_save` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of details_order
-- ----------------------------
INSERT INTO `details_order` VALUES (1, 1, 9, 1, 110000, 150000, '2023-06-18 20:28:31', NULL, NULL);
INSERT INTO `details_order` VALUES (2, 1, 8, 2, 145500, 330000, '2023-06-18 20:28:31', NULL, NULL);
INSERT INTO `details_order` VALUES (3, 2, 8, 1, 145500, 165000, '2023-06-18 20:36:56', NULL, NULL);
INSERT INTO `details_order` VALUES (4, 3, 8, 1, 145500, 165000, '2023-06-18 21:30:34', NULL, NULL);
INSERT INTO `details_order` VALUES (5, 4, 8, 1, 145500, 165000, '2023-06-19 06:16:56', NULL, NULL);
INSERT INTO `details_order` VALUES (6, 4, 9, 2, 110000, 300000, '2023-06-19 06:16:56', NULL, NULL);
INSERT INTO `details_order` VALUES (7, 6, 10, 1, 2500000, 3000000, '2023-07-12 07:08:39', NULL, NULL);
INSERT INTO `details_order` VALUES (8, 7, 9, 2, 110000, 150000, '2023-07-12 07:10:34', NULL, NULL);
INSERT INTO `details_order` VALUES (9, 7, 8, 1, 145500, 165000, '2023-07-12 07:10:34', NULL, NULL);
INSERT INTO `details_order` VALUES (10, 8, 9, 3, 110000, 150000, '2023-07-15 18:28:19', NULL, NULL);
INSERT INTO `details_order` VALUES (11, 9, 9, 1, 110000, 150000, '2023-07-15 18:29:42', NULL, NULL);
INSERT INTO `details_order` VALUES (12, 10, 9, 3, 110000, 150000, '2023-07-15 18:30:24', NULL, NULL);
INSERT INTO `details_order` VALUES (13, 10, 8, 1, 145500, 165000, '2023-07-15 18:30:24', NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_order` date NULL DEFAULT NULL,
  `source_id` int NULL DEFAULT NULL,
  `type_buy` int NULL DEFAULT NULL,
  `entry_price` int NULL DEFAULT NULL,
  `total_base_price` int NULL DEFAULT NULL,
  `total_sell_price` int NULL DEFAULT NULL,
  `platform_fee` int NULL DEFAULT NULL,
  `profit` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, '1234DDE', '2023-06-18', 10, 1, 470000, 401000, 480000, 10000, 69000, '2023-06-18 20:28:31', NULL, NULL, '1', NULL);
INSERT INTO `orders` VALUES (2, 'INV/18/06/2023/TOKOPEDIA', '2023-06-18', 9, 1, 160000, 145500, 165000, 5000, 14500, '2023-06-18 20:36:56', NULL, NULL, '1', NULL);
INSERT INTO `orders` VALUES (3, '2324', '2023-06-18', 9, 1, 150000, 145500, 165000, 15000, 4500, '2023-06-18 21:30:34', NULL, NULL, '2', NULL);
INSERT INTO `orders` VALUES (4, '12DSD', '2023-06-19', 9, 1, 450000, 365500, 465000, 15000, 84500, '2023-06-19 06:16:56', NULL, NULL, '1', NULL);
INSERT INTO `orders` VALUES (6, '234234', '2023-07-12', 11, 1, 2900000, 2500000, 3000000, 100000, 400000, '2023-07-12 07:08:39', NULL, NULL, '1', NULL);
INSERT INTO `orders` VALUES (7, '424dff', '2023-07-12', 9, 1, 400000, 365500, 465000, 65000, 34500, '2023-07-12 07:10:34', NULL, NULL, '1', NULL);
INSERT INTO `orders` VALUES (8, '4143DFF', '2023-07-15', 9, 1, 500000, 330000, 450000, 0, 170000, '2023-07-15 18:28:19', NULL, NULL, '1', NULL);
INSERT INTO `orders` VALUES (9, '1221DFFEE', '2023-06-20', 10, 1, 150000, 110000, 150000, 0, 40000, '2023-07-15 18:29:42', NULL, NULL, '1', NULL);
INSERT INTO `orders` VALUES (10, '212AD', '2023-06-22', 9, 1, 643000, 475500, 615000, 0, 167500, '2023-07-15 18:30:24', NULL, NULL, '1', NULL);

-- ----------------------------
-- Table structure for orders_old
-- ----------------------------
DROP TABLE IF EXISTS `orders_old`;
CREATE TABLE `orders_old`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `source_id` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `entry_price` int NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `base_price_product` int NULL DEFAULT NULL,
  `sell_price_product` int NULL DEFAULT NULL,
  `tax` int NULL DEFAULT NULL,
  `profit` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders_old
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `base_price` int NULL DEFAULT NULL,
  `selling_price` int NULL DEFAULT NULL,
  `stock` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `upload` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (8, 'Kabel Rem Vespa Primavera / Sprint Iget', 11, 1, '1C002832', 145500, 165000, '9', 'Active', NULL, NULL, '2023-04-29 22:50:22', '2023-07-15 18:30:24', NULL, '1', '1');
INSERT INTO `product` VALUES (9, 'Kabel Rem Vespa Sprint / Primavera 3v', 11, 1, '1E34324', 110000, 150000, '1', 'Active', NULL, NULL, '2023-06-17 12:40:53', '2023-07-15 22:42:14', NULL, '1', '1');
INSERT INTO `product` VALUES (10, 'Blok Seher Vespa 150 3v Iget', 1, 1, 'ADD4433', 2500000, 3000000, '1', 'Active', NULL, NULL, '2023-07-12 00:16:36', '2023-07-15 22:42:05', NULL, '1', '1');
INSERT INTO `product` VALUES (11, 'ewrwer', 3, 1, 'ewrwer', NULL, NULL, '34', 'Active', NULL, NULL, '2023-07-15 18:17:31', '2023-07-15 11:17:36', '2023-07-15 11:17:36', '1', '1');

-- ----------------------------
-- Table structure for source_payment
-- ----------------------------
DROP TABLE IF EXISTS `source_payment`;
CREATE TABLE `source_payment`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of source_payment
-- ----------------------------
INSERT INTO `source_payment` VALUES (9, 'Tokopedia', 'Online', '2022-11-18 13:17:12', '2022-11-18 13:22:20', NULL);
INSERT INTO `source_payment` VALUES (10, 'Shopee', 'Online', '2022-11-18 13:17:20', '2022-11-18 13:22:15', NULL);
INSERT INTO `source_payment` VALUES (11, 'Cash On Delivery', 'Non Online Store', '2022-11-18 13:17:32', '2023-04-08 10:34:08', NULL);

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'Vespa Orgin', 'Tangerang Selatan', NULL, '2022-11-18 13:27:04', NULL);
INSERT INTO `supplier` VALUES (4, '946 Store', 'Jakarta Selatan', '2022-11-20 11:42:02', '2022-11-20 11:41:29', NULL);
INSERT INTO `supplier` VALUES (5, 'Depok Street', NULL, '2023-04-08 10:30:18', '2022-12-26 15:17:56', '2023-04-08 10:30:18');

-- ----------------------------
-- Table structure for type_buy
-- ----------------------------
DROP TABLE IF EXISTS `type_buy`;
CREATE TABLE `type_buy`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_buy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of type_buy
-- ----------------------------
INSERT INTO `type_buy` VALUES (1, 'Stock', '2023-03-26 16:15:45', '2023-03-26 16:15:49', NULL);
INSERT INTO `type_buy` VALUES (2, 'Dropship', '2023-03-26 16:16:15', '2023-03-26 16:16:19', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `role_id` int NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Rafi Fathur Rahman', 'rafifathur.rahman20@gmail.com', NULL, '$2y$10$WuhaBsABM6rn0TFpTca.1uEsoZuGc0VHWNnAcfr.NLsdYszkDDDt6', NULL, 'rafifathur', '081364243280', 1, 'Depok, Indonesia', '2022-12-02 00:49:19', '2023-02-06 12:38:14', NULL);
INSERT INTO `users` VALUES (2, 'User Store', 'userfathscooter@gmail.com', NULL, '$2y$10$bKFXo2QE4m4v6AwOh2odhOuLffW7YDJR30q2kiwLKgkHW03U0hOyW', NULL, 'fadhilmda', '08123434555', 2, 'Condet', '2022-12-11 02:47:34', '2023-06-18 15:35:57', NULL);
INSERT INTO `users` VALUES (5, 'Umar', 'umarabd@gmail.com', NULL, '$2y$10$n75UDUDIBLb5vjEGrRhodOxqEDvPYSKA6djJk.l.UQmgiej4X4.xa', NULL, 'umarabd', '081364243280', 2, 'Selangor. Malaysia', '2022-12-28 15:45:39', '2023-06-18 08:35:11', '2023-06-18 08:35:11');

-- ----------------------------
-- Table structure for users_role
-- ----------------------------
DROP TABLE IF EXISTS `users_role`;
CREATE TABLE `users_role`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users_role
-- ----------------------------
INSERT INTO `users_role` VALUES (1, 'Admin', 'user for admin role', '2022-11-20 13:09:55', NULL, NULL);
INSERT INTO `users_role` VALUES (2, 'User', NULL, '2022-12-11 02:46:46', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
