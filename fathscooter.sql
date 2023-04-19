/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : fathscooter

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 19/04/2023 15:32:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category_prod
-- ----------------------------
INSERT INTO `category_prod` VALUES (1, 'Engine', 'Parts of Engine', '2022-11-18 13:48:17', NULL, NULL);
INSERT INTO `category_prod` VALUES (3, 'Body', 'Parts of Body', '2022-11-18 13:49:21', NULL, NULL);
INSERT INTO `category_prod` VALUES (4, 'Electrical', 'Parts of Electic', '2022-11-18 13:49:45', '2023-01-06 13:22:43', '2023-04-08 17:32:56');
INSERT INTO `category_prod` VALUES (5, 'Accessories', 'Acc', '2022-11-18 13:49:56', NULL, NULL);

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
  `detail_orders` int NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
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
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (3, 'Cover Engine Vespa 3v Iget (1 Set)', 3, 4, 'A1231F/A1231B', 125000, 175000, '100', 'Active', NULL, NULL, '2022-12-10 03:58:44', '2023-01-08 07:09:36', NULL, 'rafifathur', 'rafifathur');
INSERT INTO `product` VALUES (4, 'Brake Cable Vespa 3v', 1, 4, 'A00001', 120000, 165000, '57', 'Active', NULL, '1672071720__93032919_aksisweepingfpiduaafp.jpg', '2022-12-10 21:56:32', '2023-01-08 07:10:33', NULL, 'rafifathur', 'rafifathur');
INSERT INTO `product` VALUES (5, 'Spakbor front List Bumper Lx Lxv S 125', 5, 1, 'B00001', 75000, 120000, '56', 'Active', NULL, NULL, '2023-01-08 05:54:18', '2023-01-08 07:08:29', NULL, 'rafifathur', 'rafifathur');
INSERT INTO `product` VALUES (6, 'SEAL SIL KRUK AS VESPA BESAR BAGIAN KANAN MAGNET', 1, 1, 'A00002', 90000, 130000, '43', 'Active', NULL, NULL, '2023-01-08 06:10:29', '2023-01-08 07:12:26', NULL, 'rafifathur', 'rafifathur');
INSERT INTO `product` VALUES (7, 'KARBU KARBURATOR VESPA SPACO DELLORTO 20 20 NOS', 1, 1, 'A00003', 350000, 800000, '37', 'Active', NULL, NULL, '2023-01-08 06:56:41', '2023-04-08 10:28:27', '2023-04-08 10:28:27', 'rafifathur', 'rafifathur');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `users` VALUES (2, 'Fadhil MDA', 'fadhilmda@gmail.com', NULL, '$2y$10$D0Mmqps/8VnFPWG1G135beMs9w0K91boneN94zRE.c1EME2StjE2S', NULL, 'fadhilmda', '08123434555', 2, 'Condet', '2022-12-11 02:47:34', '2022-12-28 15:36:18', NULL);
INSERT INTO `users` VALUES (5, 'Umar', 'umarabd@gmail.com', NULL, '$2y$10$n75UDUDIBLb5vjEGrRhodOxqEDvPYSKA6djJk.l.UQmgiej4X4.xa', NULL, 'umarabd', '081364243280', 2, 'Selangor. Malaysia', '2022-12-28 15:45:39', NULL, NULL);

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
