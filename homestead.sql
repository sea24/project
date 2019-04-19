/*
 Navicat Premium Data Transfer

 Source Server         : 底层数据库
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : 192.168.0.108:3306
 Source Schema         : homestead

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 10/03/2019 22:12:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (1, 0, 1, 'Index', 'fa-bar-chart', '/', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_operation_log_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 370 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_operation_log
-- ----------------------------
INSERT INTO `admin_operation_log` VALUES (1, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-02-27 08:09:28', '2019-02-27 08:09:28');
INSERT INTO `admin_operation_log` VALUES (2, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 08:17:29', '2019-02-27 08:17:29');
INSERT INTO `admin_operation_log` VALUES (3, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 08:17:43', '2019-02-27 08:17:43');
INSERT INTO `admin_operation_log` VALUES (4, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 08:20:01', '2019-02-27 08:20:01');
INSERT INTO `admin_operation_log` VALUES (5, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_sort\":{\"column\":\"id\",\"type\":\"desc\"},\"_pjax\":\"#pjax-container\"}', '2019-02-27 08:20:05', '2019-02-27 08:20:05');
INSERT INTO `admin_operation_log` VALUES (6, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_sort\":{\"column\":\"id\",\"type\":\"desc\"},\"_pjax\":\"#pjax-container\"}', '2019-02-27 08:20:05', '2019-02-27 08:20:05');
INSERT INTO `admin_operation_log` VALUES (7, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_sort\":{\"column\":\"id\",\"type\":\"desc\"}}', '2019-02-27 08:20:24', '2019-02-27 08:20:24');
INSERT INTO `admin_operation_log` VALUES (8, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_sort\":{\"column\":\"id\",\"type\":\"desc\"}}', '2019-02-27 08:20:45', '2019-02-27 08:20:45');
INSERT INTO `admin_operation_log` VALUES (9, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_sort\":{\"column\":\"id\",\"type\":\"desc\"}}', '2019-02-27 08:21:57', '2019-02-27 08:21:57');
INSERT INTO `admin_operation_log` VALUES (10, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_sort\":{\"column\":\"id\",\"type\":\"desc\"}}', '2019-02-27 08:24:39', '2019-02-27 08:24:39');
INSERT INTO `admin_operation_log` VALUES (11, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_sort\":{\"column\":\"id\",\"type\":\"desc\"}}', '2019-02-27 16:25:14', '2019-02-27 16:25:14');
INSERT INTO `admin_operation_log` VALUES (12, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 16:25:21', '2019-02-27 16:25:21');
INSERT INTO `admin_operation_log` VALUES (13, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:25:47', '2019-02-27 16:25:47');
INSERT INTO `admin_operation_log` VALUES (14, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:25:55', '2019-02-27 16:25:55');
INSERT INTO `admin_operation_log` VALUES (15, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:26:04', '2019-02-27 16:26:04');
INSERT INTO `admin_operation_log` VALUES (16, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:26:17', '2019-02-27 16:26:17');
INSERT INTO `admin_operation_log` VALUES (17, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:27:22', '2019-02-27 16:27:22');
INSERT INTO `admin_operation_log` VALUES (18, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:28:09', '2019-02-27 16:28:09');
INSERT INTO `admin_operation_log` VALUES (19, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:28:34', '2019-02-27 16:28:34');
INSERT INTO `admin_operation_log` VALUES (20, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:30:10', '2019-02-27 16:30:10');
INSERT INTO `admin_operation_log` VALUES (21, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:31:58', '2019-02-27 16:31:58');
INSERT INTO `admin_operation_log` VALUES (22, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:32:05', '2019-02-27 16:32:05');
INSERT INTO `admin_operation_log` VALUES (23, 1, 'admin/product', 'POST', '192.168.1.9', '{\"name\":null,\"title\":null,\"_token\":\"23UReCENJdz8mg0CqCIVHWigxjwqotKCGo0HWp9v\"}', '2019-02-27 16:34:00', '2019-02-27 16:34:00');
INSERT INTO `admin_operation_log` VALUES (24, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:34:03', '2019-02-27 16:34:03');
INSERT INTO `admin_operation_log` VALUES (25, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:34:57', '2019-02-27 16:34:57');
INSERT INTO `admin_operation_log` VALUES (26, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:35:38', '2019-02-27 16:35:38');
INSERT INTO `admin_operation_log` VALUES (27, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:35:41', '2019-02-27 16:35:41');
INSERT INTO `admin_operation_log` VALUES (28, 1, 'admin/product', 'POST', '192.168.1.9', '{\"name\":\"1231\",\"title\":\"23123\",\"price\":\"10.00\",\"type\":\"3\",\"_token\":\"23UReCENJdz8mg0CqCIVHWigxjwqotKCGo0HWp9v\"}', '2019-02-27 16:35:55', '2019-02-27 16:35:55');
INSERT INTO `admin_operation_log` VALUES (29, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:35:57', '2019-02-27 16:35:57');
INSERT INTO `admin_operation_log` VALUES (30, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-02-27 16:36:59', '2019-02-27 16:36:59');
INSERT INTO `admin_operation_log` VALUES (31, 1, 'admin/product', 'POST', '192.168.1.9', '{\"name\":\"202\",\"title\":\"21231\",\"price\":\"20.00\",\"type\":\"1\",\"_token\":\"23UReCENJdz8mg0CqCIVHWigxjwqotKCGo0HWp9v\"}', '2019-02-27 16:37:08', '2019-02-27 16:37:08');
INSERT INTO `admin_operation_log` VALUES (32, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:37:09', '2019-02-27 16:37:09');
INSERT INTO `admin_operation_log` VALUES (33, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:39:23', '2019-02-27 16:39:23');
INSERT INTO `admin_operation_log` VALUES (34, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:40:28', '2019-02-27 16:40:28');
INSERT INTO `admin_operation_log` VALUES (35, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:41:36', '2019-02-27 16:41:36');
INSERT INTO `admin_operation_log` VALUES (36, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:42:09', '2019-02-27 16:42:09');
INSERT INTO `admin_operation_log` VALUES (37, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:43:43', '2019-02-27 16:43:43');
INSERT INTO `admin_operation_log` VALUES (38, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:44:49', '2019-02-27 16:44:49');
INSERT INTO `admin_operation_log` VALUES (39, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:45:18', '2019-02-27 16:45:18');
INSERT INTO `admin_operation_log` VALUES (40, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:45:26', '2019-02-27 16:45:26');
INSERT INTO `admin_operation_log` VALUES (41, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 16:46:00', '2019-02-27 16:46:00');
INSERT INTO `admin_operation_log` VALUES (42, 1, 'admin/product/1/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 16:47:09', '2019-02-27 16:47:09');
INSERT INTO `admin_operation_log` VALUES (43, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 16:47:16', '2019-02-27 16:47:16');
INSERT INTO `admin_operation_log` VALUES (44, 1, 'admin/product/1/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 16:47:18', '2019-02-27 16:47:18');
INSERT INTO `admin_operation_log` VALUES (45, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 16:47:20', '2019-02-27 16:47:20');
INSERT INTO `admin_operation_log` VALUES (46, 1, 'admin/product/1', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 16:47:27', '2019-02-27 16:47:27');
INSERT INTO `admin_operation_log` VALUES (47, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:47:28', '2019-02-27 16:47:28');
INSERT INTO `admin_operation_log` VALUES (48, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:48:03', '2019-02-27 16:48:03');
INSERT INTO `admin_operation_log` VALUES (49, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:48:48', '2019-02-27 16:48:48');
INSERT INTO `admin_operation_log` VALUES (50, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:48:55', '2019-02-27 16:48:55');
INSERT INTO `admin_operation_log` VALUES (51, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:49:58', '2019-02-27 16:49:58');
INSERT INTO `admin_operation_log` VALUES (52, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:50:21', '2019-02-27 16:50:21');
INSERT INTO `admin_operation_log` VALUES (53, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:50:31', '2019-02-27 16:50:31');
INSERT INTO `admin_operation_log` VALUES (54, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:52:09', '2019-02-27 16:52:09');
INSERT INTO `admin_operation_log` VALUES (55, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:54:14', '2019-02-27 16:54:14');
INSERT INTO `admin_operation_log` VALUES (56, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:54:17', '2019-02-27 16:54:17');
INSERT INTO `admin_operation_log` VALUES (57, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:54:23', '2019-02-27 16:54:23');
INSERT INTO `admin_operation_log` VALUES (58, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:54:48', '2019-02-27 16:54:48');
INSERT INTO `admin_operation_log` VALUES (59, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:55:52', '2019-02-27 16:55:52');
INSERT INTO `admin_operation_log` VALUES (60, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:56:01', '2019-02-27 16:56:01');
INSERT INTO `admin_operation_log` VALUES (61, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 16:59:47', '2019-02-27 16:59:47');
INSERT INTO `admin_operation_log` VALUES (62, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:00:12', '2019-02-27 17:00:12');
INSERT INTO `admin_operation_log` VALUES (63, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:01:23', '2019-02-27 17:01:23');
INSERT INTO `admin_operation_log` VALUES (64, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:01:30', '2019-02-27 17:01:30');
INSERT INTO `admin_operation_log` VALUES (65, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:01:46', '2019-02-27 17:01:46');
INSERT INTO `admin_operation_log` VALUES (66, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:02:10', '2019-02-27 17:02:10');
INSERT INTO `admin_operation_log` VALUES (67, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:02:21', '2019-02-27 17:02:21');
INSERT INTO `admin_operation_log` VALUES (68, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:02:21', '2019-02-27 17:02:21');
INSERT INTO `admin_operation_log` VALUES (69, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:04:19', '2019-02-27 17:04:19');
INSERT INTO `admin_operation_log` VALUES (70, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:04:47', '2019-02-27 17:04:47');
INSERT INTO `admin_operation_log` VALUES (71, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:05:07', '2019-02-27 17:05:07');
INSERT INTO `admin_operation_log` VALUES (72, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:05:32', '2019-02-27 17:05:32');
INSERT INTO `admin_operation_log` VALUES (73, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:06:06', '2019-02-27 17:06:06');
INSERT INTO `admin_operation_log` VALUES (74, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:06:13', '2019-02-27 17:06:13');
INSERT INTO `admin_operation_log` VALUES (75, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:06:18', '2019-02-27 17:06:18');
INSERT INTO `admin_operation_log` VALUES (76, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:07:05', '2019-02-27 17:07:05');
INSERT INTO `admin_operation_log` VALUES (77, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:07:20', '2019-02-27 17:07:20');
INSERT INTO `admin_operation_log` VALUES (78, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:07:44', '2019-02-27 17:07:44');
INSERT INTO `admin_operation_log` VALUES (79, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:08:52', '2019-02-27 17:08:52');
INSERT INTO `admin_operation_log` VALUES (80, 1, 'admin/product/1', 'GET', '192.168.1.9', '[]', '2019-02-27 17:08:58', '2019-02-27 17:08:58');
INSERT INTO `admin_operation_log` VALUES (81, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-27 17:12:17', '2019-02-27 17:12:17');
INSERT INTO `admin_operation_log` VALUES (82, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 17:23:03', '2019-02-27 17:23:03');
INSERT INTO `admin_operation_log` VALUES (83, 1, 'admin/product/1', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 17:23:11', '2019-02-27 17:23:11');
INSERT INTO `admin_operation_log` VALUES (84, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 17:23:14', '2019-02-27 17:23:14');
INSERT INTO `admin_operation_log` VALUES (85, 1, 'admin', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 17:23:28', '2019-02-27 17:23:28');
INSERT INTO `admin_operation_log` VALUES (86, 1, 'admin/auth/users', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 17:24:14', '2019-02-27 17:24:14');
INSERT INTO `admin_operation_log` VALUES (87, 1, 'admin', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 17:34:17', '2019-02-27 17:34:17');
INSERT INTO `admin_operation_log` VALUES (88, 1, 'admin/auth/users', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-27 17:34:19', '2019-02-27 17:34:19');
INSERT INTO `admin_operation_log` VALUES (89, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-02-28 08:57:42', '2019-02-28 08:57:42');
INSERT INTO `admin_operation_log` VALUES (90, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-28 09:08:30', '2019-02-28 09:08:30');
INSERT INTO `admin_operation_log` VALUES (91, 1, 'admin/product/1/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 09:09:41', '2019-02-28 09:09:41');
INSERT INTO `admin_operation_log` VALUES (92, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 09:09:50', '2019-02-28 09:09:50');
INSERT INTO `admin_operation_log` VALUES (93, 1, 'admin/product/1', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 09:10:07', '2019-02-28 09:10:07');
INSERT INTO `admin_operation_log` VALUES (94, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 09:10:10', '2019-02-28 09:10:10');
INSERT INTO `admin_operation_log` VALUES (95, 1, 'admin', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 10:11:33', '2019-02-28 10:11:33');
INSERT INTO `admin_operation_log` VALUES (96, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-02-28 10:11:40', '2019-02-28 10:11:40');
INSERT INTO `admin_operation_log` VALUES (97, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:34:31', '2019-02-28 10:34:31');
INSERT INTO `admin_operation_log` VALUES (98, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:35:18', '2019-02-28 10:35:18');
INSERT INTO `admin_operation_log` VALUES (99, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:35:58', '2019-02-28 10:35:58');
INSERT INTO `admin_operation_log` VALUES (100, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:36:06', '2019-02-28 10:36:06');
INSERT INTO `admin_operation_log` VALUES (101, 1, 'admin/banner/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 10:36:12', '2019-02-28 10:36:12');
INSERT INTO `admin_operation_log` VALUES (102, 1, 'admin/banner', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 10:36:20', '2019-02-28 10:36:20');
INSERT INTO `admin_operation_log` VALUES (103, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:37:49', '2019-02-28 10:37:49');
INSERT INTO `admin_operation_log` VALUES (104, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:38:18', '2019-02-28 10:38:18');
INSERT INTO `admin_operation_log` VALUES (105, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:39:00', '2019-02-28 10:39:00');
INSERT INTO `admin_operation_log` VALUES (106, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:39:12', '2019-02-28 10:39:12');
INSERT INTO `admin_operation_log` VALUES (107, 1, 'admin/banner/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 10:39:14', '2019-02-28 10:39:14');
INSERT INTO `admin_operation_log` VALUES (108, 1, 'admin/banner/create', 'GET', '192.168.1.9', '[]', '2019-02-28 10:39:50', '2019-02-28 10:39:50');
INSERT INTO `admin_operation_log` VALUES (109, 1, 'admin/banner/create', 'GET', '192.168.1.9', '[]', '2019-02-28 10:42:29', '2019-02-28 10:42:29');
INSERT INTO `admin_operation_log` VALUES (110, 1, 'admin/banner/create', 'GET', '192.168.1.9', '[]', '2019-02-28 10:43:15', '2019-02-28 10:43:15');
INSERT INTO `admin_operation_log` VALUES (111, 1, 'admin/banner', 'POST', '192.168.1.9', '{\"url\":\"http:\\/\\/www.baidu.com\",\"order\":\"1\",\"_token\":\"FHtWumvmaURYhBGFfRNePjHqdyiGcLdc9mid7Mxv\"}', '2019-02-28 10:43:39', '2019-02-28 10:43:39');
INSERT INTO `admin_operation_log` VALUES (112, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:43:40', '2019-02-28 10:43:40');
INSERT INTO `admin_operation_log` VALUES (113, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:57:16', '2019-02-28 10:57:16');
INSERT INTO `admin_operation_log` VALUES (114, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 10:57:39', '2019-02-28 10:57:39');
INSERT INTO `admin_operation_log` VALUES (115, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-02-28 14:00:41', '2019-02-28 14:00:41');
INSERT INTO `admin_operation_log` VALUES (116, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-02-28 14:00:48', '2019-02-28 14:00:48');
INSERT INTO `admin_operation_log` VALUES (117, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 14:00:54', '2019-02-28 14:00:54');
INSERT INTO `admin_operation_log` VALUES (118, 1, 'admin/banner/1', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\"}', '2019-02-28 14:08:42', '2019-02-28 14:08:42');
INSERT INTO `admin_operation_log` VALUES (119, 1, 'admin/banner', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:08:43', '2019-02-28 14:08:43');
INSERT INTO `admin_operation_log` VALUES (120, 1, 'admin/banner/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:08:46', '2019-02-28 14:08:46');
INSERT INTO `admin_operation_log` VALUES (121, 1, 'admin/banner', 'POST', '192.168.1.9', '{\"url\":\"https:\\/\\/www.baidu.com\\/\",\"order\":\"1\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/banner\"}', '2019-02-28 14:09:08', '2019-02-28 14:09:08');
INSERT INTO `admin_operation_log` VALUES (122, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 14:09:08', '2019-02-28 14:09:08');
INSERT INTO `admin_operation_log` VALUES (123, 1, 'admin/banner/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:09:10', '2019-02-28 14:09:10');
INSERT INTO `admin_operation_log` VALUES (124, 1, 'admin/banner', 'POST', '192.168.1.9', '{\"url\":\"https:\\/\\/www.baidu.com\\/\",\"order\":\"2\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/banner\"}', '2019-02-28 14:09:16', '2019-02-28 14:09:16');
INSERT INTO `admin_operation_log` VALUES (125, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 14:09:17', '2019-02-28 14:09:17');
INSERT INTO `admin_operation_log` VALUES (126, 1, 'admin/banner/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:09:18', '2019-02-28 14:09:18');
INSERT INTO `admin_operation_log` VALUES (127, 1, 'admin/banner', 'POST', '192.168.1.9', '{\"url\":\"https:\\/\\/www.baidu.com\\/\",\"order\":\"3\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/banner\"}', '2019-02-28 14:09:27', '2019-02-28 14:09:27');
INSERT INTO `admin_operation_log` VALUES (128, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 14:09:28', '2019-02-28 14:09:28');
INSERT INTO `admin_operation_log` VALUES (129, 1, 'admin/banner/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:09:31', '2019-02-28 14:09:31');
INSERT INTO `admin_operation_log` VALUES (130, 1, 'admin/banner', 'POST', '192.168.1.9', '{\"url\":\"https:\\/\\/www.baidu.com\\/\",\"order\":\"4\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/banner\"}', '2019-02-28 14:09:37', '2019-02-28 14:09:37');
INSERT INTO `admin_operation_log` VALUES (131, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-02-28 14:09:38', '2019-02-28 14:09:38');
INSERT INTO `admin_operation_log` VALUES (132, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:30:24', '2019-02-28 14:30:24');
INSERT INTO `admin_operation_log` VALUES (133, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:30:48', '2019-02-28 14:30:48');
INSERT INTO `admin_operation_log` VALUES (134, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:31:35', '2019-02-28 14:31:35');
INSERT INTO `admin_operation_log` VALUES (135, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-02-28 14:33:15', '2019-02-28 14:33:15');
INSERT INTO `admin_operation_log` VALUES (136, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-02-28 14:37:31', '2019-02-28 14:37:31');
INSERT INTO `admin_operation_log` VALUES (137, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-02-28 14:40:49', '2019-02-28 14:40:49');
INSERT INTO `admin_operation_log` VALUES (138, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-02-28 14:41:02', '2019-02-28 14:41:02');
INSERT INTO `admin_operation_log` VALUES (139, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:41:05', '2019-02-28 14:41:05');
INSERT INTO `admin_operation_log` VALUES (140, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:41:08', '2019-02-28 14:41:08');
INSERT INTO `admin_operation_log` VALUES (141, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-02-28 14:41:45', '2019-02-28 14:41:45');
INSERT INTO `admin_operation_log` VALUES (142, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-02-28 14:42:23', '2019-02-28 14:42:23');
INSERT INTO `admin_operation_log` VALUES (143, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-02-28 14:43:06', '2019-02-28 14:43:06');
INSERT INTO `admin_operation_log` VALUES (144, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"1\",\"name\":null,\"order\":\"1\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\"}', '2019-02-28 14:43:22', '2019-02-28 14:43:22');
INSERT INTO `admin_operation_log` VALUES (145, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-02-28 14:43:24', '2019-02-28 14:43:24');
INSERT INTO `admin_operation_log` VALUES (146, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"1\",\"name\":\"\\u84dd\\u6d77\\u7535\\u5b50\",\"order\":\"1\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\"}', '2019-02-28 14:43:52', '2019-02-28 14:43:52');
INSERT INTO `admin_operation_log` VALUES (147, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:43:53', '2019-02-28 14:43:53');
INSERT INTO `admin_operation_log` VALUES (148, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:44:21', '2019-02-28 14:44:21');
INSERT INTO `admin_operation_log` VALUES (149, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:44:21', '2019-02-28 14:44:21');
INSERT INTO `admin_operation_log` VALUES (150, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:44:34', '2019-02-28 14:44:34');
INSERT INTO `admin_operation_log` VALUES (151, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:45:12', '2019-02-28 14:45:12');
INSERT INTO `admin_operation_log` VALUES (152, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 14:46:31', '2019-02-28 14:46:31');
INSERT INTO `admin_operation_log` VALUES (153, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 14:55:09', '2019-02-28 14:55:09');
INSERT INTO `admin_operation_log` VALUES (154, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 16:17:21', '2019-02-28 16:17:21');
INSERT INTO `admin_operation_log` VALUES (155, 1, 'admin/category/1/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 16:19:53', '2019-02-28 16:19:53');
INSERT INTO `admin_operation_log` VALUES (156, 1, 'admin/category/1', 'PUT', '192.168.1.9', '{\"pid\":null,\"name\":\"asd\",\"order\":\"1\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-02-28 16:19:59', '2019-02-28 16:19:59');
INSERT INTO `admin_operation_log` VALUES (157, 1, 'admin/category/1/edit', 'GET', '192.168.1.9', '[]', '2019-02-28 16:20:01', '2019-02-28 16:20:01');
INSERT INTO `admin_operation_log` VALUES (158, 1, 'admin/category/1/edit', 'GET', '192.168.1.9', '[]', '2019-02-28 16:21:19', '2019-02-28 16:21:19');
INSERT INTO `admin_operation_log` VALUES (159, 1, 'admin/category/1/edit', 'GET', '192.168.1.9', '[]', '2019-02-28 16:23:03', '2019-02-28 16:23:03');
INSERT INTO `admin_operation_log` VALUES (160, 1, 'admin/category/1/edit', 'GET', '192.168.1.9', '[]', '2019-02-28 16:28:56', '2019-02-28 16:28:56');
INSERT INTO `admin_operation_log` VALUES (161, 1, 'admin/category/1', 'PUT', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"asd\",\"order\":\"1\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\",\"_method\":\"PUT\"}', '2019-02-28 16:29:06', '2019-02-28 16:29:06');
INSERT INTO `admin_operation_log` VALUES (162, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-02-28 16:29:07', '2019-02-28 16:29:07');
INSERT INTO `admin_operation_log` VALUES (163, 1, 'admin/category/2/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 16:29:10', '2019-02-28 16:29:10');
INSERT INTO `admin_operation_log` VALUES (164, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 16:29:12', '2019-02-28 16:29:12');
INSERT INTO `admin_operation_log` VALUES (165, 1, 'admin/bulletin', 'GET', '192.168.1.9', '[]', '2019-02-28 16:56:02', '2019-02-28 16:56:02');
INSERT INTO `admin_operation_log` VALUES (166, 1, 'admin/bulletin', 'GET', '192.168.1.9', '[]', '2019-02-28 16:58:39', '2019-02-28 16:58:39');
INSERT INTO `admin_operation_log` VALUES (167, 1, 'admin/bulletin/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 16:58:42', '2019-02-28 16:58:42');
INSERT INTO `admin_operation_log` VALUES (168, 1, 'admin/bulletin/create', 'GET', '192.168.1.9', '[]', '2019-02-28 17:04:31', '2019-02-28 17:04:31');
INSERT INTO `admin_operation_log` VALUES (169, 1, 'admin/bulletin/create', 'GET', '192.168.1.9', '[]', '2019-02-28 17:04:42', '2019-02-28 17:04:42');
INSERT INTO `admin_operation_log` VALUES (170, 1, 'admin/bulletin/create', 'GET', '192.168.1.9', '[]', '2019-02-28 17:04:48', '2019-02-28 17:04:48');
INSERT INTO `admin_operation_log` VALUES (171, 1, 'admin/bulletin', 'POST', '192.168.1.9', '{\"title\":\"\\u606d\\u559c\\u738b\\u603b\\u559c\\u63d0\\u5927\\u5954\",\"status\":\"on\",\"_token\":\"esoGxoTddkESncbn2rBEU58HgHCs4FCHLxegkYE7\"}', '2019-02-28 17:05:07', '2019-02-28 17:05:07');
INSERT INTO `admin_operation_log` VALUES (172, 1, 'admin/bulletin', 'GET', '192.168.1.9', '[]', '2019-02-28 17:05:08', '2019-02-28 17:05:08');
INSERT INTO `admin_operation_log` VALUES (173, 1, 'admin/auth/users', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 17:11:21', '2019-02-28 17:11:21');
INSERT INTO `admin_operation_log` VALUES (174, 1, 'admin', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-02-28 17:11:38', '2019-02-28 17:11:38');
INSERT INTO `admin_operation_log` VALUES (175, 1, 'admin/bulletin', 'GET', '192.168.1.9', '[]', '2019-02-28 17:15:44', '2019-02-28 17:15:44');
INSERT INTO `admin_operation_log` VALUES (176, 1, 'admin/bulletin', 'GET', '192.168.1.9', '[]', '2019-02-28 17:17:08', '2019-02-28 17:17:08');
INSERT INTO `admin_operation_log` VALUES (177, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-03-01 09:06:23', '2019-03-01 09:06:23');
INSERT INTO `admin_operation_log` VALUES (178, 1, 'admin/banner', 'GET', '192.168.1.9', '[]', '2019-03-01 09:07:26', '2019-03-01 09:07:26');
INSERT INTO `admin_operation_log` VALUES (179, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-01 09:26:12', '2019-03-01 09:26:12');
INSERT INTO `admin_operation_log` VALUES (180, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:26:19', '2019-03-01 09:26:19');
INSERT INTO `admin_operation_log` VALUES (181, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"\\u84dd\\u6d77\\u7535\\u5b502\",\"order\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-01 09:26:36', '2019-03-01 09:26:36');
INSERT INTO `admin_operation_log` VALUES (182, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-01 09:26:37', '2019-03-01 09:26:37');
INSERT INTO `admin_operation_log` VALUES (183, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:26:40', '2019-03-01 09:26:40');
INSERT INTO `admin_operation_log` VALUES (184, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"123\",\"order\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-01 09:26:48', '2019-03-01 09:26:48');
INSERT INTO `admin_operation_log` VALUES (185, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-01 09:26:48', '2019-03-01 09:26:48');
INSERT INTO `admin_operation_log` VALUES (186, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:26:52', '2019-03-01 09:26:52');
INSERT INTO `admin_operation_log` VALUES (187, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"1\",\"order\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-01 09:27:00', '2019-03-01 09:27:00');
INSERT INTO `admin_operation_log` VALUES (188, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-01 09:27:01', '2019-03-01 09:27:01');
INSERT INTO `admin_operation_log` VALUES (189, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:27:03', '2019-03-01 09:27:03');
INSERT INTO `admin_operation_log` VALUES (190, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"erg\",\"order\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-01 09:27:12', '2019-03-01 09:27:12');
INSERT INTO `admin_operation_log` VALUES (191, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-01 09:27:13', '2019-03-01 09:27:13');
INSERT INTO `admin_operation_log` VALUES (192, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-01 09:27:24', '2019-03-01 09:27:24');
INSERT INTO `admin_operation_log` VALUES (193, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-01 09:42:08', '2019-03-01 09:42:08');
INSERT INTO `admin_operation_log` VALUES (194, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:42:20', '2019-03-01 09:42:20');
INSERT INTO `admin_operation_log` VALUES (195, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:42:23', '2019-03-01 09:42:23');
INSERT INTO `admin_operation_log` VALUES (196, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:45:11', '2019-03-01 09:45:11');
INSERT INTO `admin_operation_log` VALUES (197, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:45:14', '2019-03-01 09:45:14');
INSERT INTO `admin_operation_log` VALUES (198, 1, 'admin/product/1/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:49:42', '2019-03-01 09:49:42');
INSERT INTO `admin_operation_log` VALUES (199, 1, 'admin/product/1', 'PUT', '192.168.1.9', '{\"name\":\"202\",\"title\":\"21231\",\"price\":\"20.00\",\"type\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/product\"}', '2019-03-01 09:52:18', '2019-03-01 09:52:18');
INSERT INTO `admin_operation_log` VALUES (200, 1, 'admin/product/1/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 09:52:20', '2019-03-01 09:52:20');
INSERT INTO `admin_operation_log` VALUES (201, 1, 'admin/product/1', 'PUT', '192.168.1.9', '{\"name\":\"202\",\"title\":\"21231\",\"price\":\"20.00\",\"type\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 09:53:09', '2019-03-01 09:53:09');
INSERT INTO `admin_operation_log` VALUES (202, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-01 09:53:09', '2019-03-01 09:53:09');
INSERT INTO `admin_operation_log` VALUES (203, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-01 09:53:14', '2019-03-01 09:53:14');
INSERT INTO `admin_operation_log` VALUES (204, 1, 'admin/product/1/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:53:24', '2019-03-01 09:53:24');
INSERT INTO `admin_operation_log` VALUES (205, 1, 'admin/product/1', 'PUT', '192.168.1.9', '{\"key\":null,\"groupimg\":\"_file_del_\",\"_file_del_\":null,\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 09:53:28', '2019-03-01 09:53:28');
INSERT INTO `admin_operation_log` VALUES (206, 1, 'admin/product/1', 'PUT', '192.168.1.9', '{\"key\":null,\"groupimg\":\"_file_del_\",\"_file_del_\":null,\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 09:53:28', '2019-03-01 09:53:28');
INSERT INTO `admin_operation_log` VALUES (207, 1, 'admin/product/1/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 09:53:33', '2019-03-01 09:53:33');
INSERT INTO `admin_operation_log` VALUES (208, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:53:35', '2019-03-01 09:53:35');
INSERT INTO `admin_operation_log` VALUES (209, 1, 'admin/product/1', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\"}', '2019-03-01 09:53:38', '2019-03-01 09:53:38');
INSERT INTO `admin_operation_log` VALUES (210, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:53:39', '2019-03-01 09:53:39');
INSERT INTO `admin_operation_log` VALUES (211, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:53:41', '2019-03-01 09:53:41');
INSERT INTO `admin_operation_log` VALUES (212, 1, 'admin/product', 'POST', '192.168.1.9', '{\"name\":\"\\u6d77\\u8d3c\\u738b\",\"title\":\"\\u6d77\\u8d3c\\u738b\",\"price\":\"20.00\",\"type\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/product\"}', '2019-03-01 09:53:59', '2019-03-01 09:53:59');
INSERT INTO `admin_operation_log` VALUES (213, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-03-01 09:54:01', '2019-03-01 09:54:01');
INSERT INTO `admin_operation_log` VALUES (214, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:54:14', '2019-03-01 09:54:14');
INSERT INTO `admin_operation_log` VALUES (215, 1, 'admin/product', 'POST', '192.168.1.9', '{\"name\":\"\\u6d77\\u8d3c\\u738b\",\"title\":\"\\u6d77\\u8d3c\\u738b\",\"price\":\"99999.00\",\"type\":\"1\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\"}', '2019-03-01 09:54:58', '2019-03-01 09:54:58');
INSERT INTO `admin_operation_log` VALUES (216, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-01 09:54:58', '2019-03-01 09:54:58');
INSERT INTO `admin_operation_log` VALUES (217, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-01 09:55:32', '2019-03-01 09:55:32');
INSERT INTO `admin_operation_log` VALUES (218, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 09:55:36', '2019-03-01 09:55:36');
INSERT INTO `admin_operation_log` VALUES (219, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 09:56:08', '2019-03-01 09:56:08');
INSERT INTO `admin_operation_log` VALUES (220, 1, 'admin/product/2', 'PUT', '192.168.1.9', '{\"key\":null,\"groupimg\":\"_file_del_\",\"_file_del_\":null,\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 09:56:16', '2019-03-01 09:56:16');
INSERT INTO `admin_operation_log` VALUES (221, 1, 'admin/product/2', 'PUT', '192.168.1.9', '{\"key\":null,\"groupimg\":\"_file_del_\",\"_file_del_\":null,\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 09:57:04', '2019-03-01 09:57:04');
INSERT INTO `admin_operation_log` VALUES (222, 1, 'admin/product/2', 'PUT', '192.168.1.9', '{\"key\":null,\"groupimg\":\"_file_del_\",\"_file_del_\":null,\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 09:58:00', '2019-03-01 09:58:00');
INSERT INTO `admin_operation_log` VALUES (223, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:03:22', '2019-03-01 10:03:22');
INSERT INTO `admin_operation_log` VALUES (224, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:05:48', '2019-03-01 10:05:48');
INSERT INTO `admin_operation_log` VALUES (225, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:05:55', '2019-03-01 10:05:55');
INSERT INTO `admin_operation_log` VALUES (226, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:05:55', '2019-03-01 10:05:55');
INSERT INTO `admin_operation_log` VALUES (227, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:05:55', '2019-03-01 10:05:55');
INSERT INTO `admin_operation_log` VALUES (228, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:11:22', '2019-03-01 10:11:22');
INSERT INTO `admin_operation_log` VALUES (229, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:11:37', '2019-03-01 10:11:37');
INSERT INTO `admin_operation_log` VALUES (230, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:15:05', '2019-03-01 10:15:05');
INSERT INTO `admin_operation_log` VALUES (231, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:16:00', '2019-03-01 10:16:00');
INSERT INTO `admin_operation_log` VALUES (232, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:17:48', '2019-03-01 10:17:48');
INSERT INTO `admin_operation_log` VALUES (233, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:18:09', '2019-03-01 10:18:09');
INSERT INTO `admin_operation_log` VALUES (234, 1, 'admin/product/2', 'PUT', '192.168.1.9', '{\"name\":\"\\u6d77\\u8d3c\\u738b\",\"title\":\"\\u6d77\\u8d3c\\u738b\",\"price\":\"99999.00\",\"type\":\"1\",\"content\":\"<p><\\/p><h1><span style=\\\"color: rgb(199, 37, 78); font-family: Menlo, Monaco, Consolas, &quot;Courier New&quot;, monospace; font-size: 12.6px; background-color: rgb(241, 241, 241);\\\">dfsagfdagdaf sadfsadfsa<\\/span><\\/h1>\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 10:18:27', '2019-03-01 10:18:27');
INSERT INTO `admin_operation_log` VALUES (235, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-01 10:18:28', '2019-03-01 10:18:28');
INSERT INTO `admin_operation_log` VALUES (236, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 10:18:31', '2019-03-01 10:18:31');
INSERT INTO `admin_operation_log` VALUES (237, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:18:38', '2019-03-01 10:18:38');
INSERT INTO `admin_operation_log` VALUES (238, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:19:05', '2019-03-01 10:19:05');
INSERT INTO `admin_operation_log` VALUES (239, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:19:28', '2019-03-01 10:19:28');
INSERT INTO `admin_operation_log` VALUES (240, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:22:28', '2019-03-01 10:22:28');
INSERT INTO `admin_operation_log` VALUES (241, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:22:38', '2019-03-01 10:22:38');
INSERT INTO `admin_operation_log` VALUES (242, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:33:24', '2019-03-01 10:33:24');
INSERT INTO `admin_operation_log` VALUES (243, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:36:23', '2019-03-01 10:36:23');
INSERT INTO `admin_operation_log` VALUES (244, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:38:58', '2019-03-01 10:38:58');
INSERT INTO `admin_operation_log` VALUES (245, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:40:07', '2019-03-01 10:40:07');
INSERT INTO `admin_operation_log` VALUES (246, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:42:42', '2019-03-01 10:42:42');
INSERT INTO `admin_operation_log` VALUES (247, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-01 10:43:37', '2019-03-01 10:43:37');
INSERT INTO `admin_operation_log` VALUES (248, 1, 'admin/product/2', 'PUT', '192.168.1.9', '{\"name\":\"\\u6d77\\u8d3c\\u738b\",\"title\":\"\\u6d77\\u8d3c\\u738b\",\"price\":\"99999.00\",\"type\":\"1\",\"content\":\"<p><\\/p><p><\\/p><h1><span style=\\\"color: rgb(199, 37, 78); font-family: Menlo, Monaco, Consolas, &quot;Courier New&quot;, monospace; font-size: 12.6px; background-color: rgb(241, 241, 241);\\\">dfsagfdagdaf sadfsadfsa<\\/span><\\/h1><p><\\/p><p><img src=\\\"http:\\/\\/www.bottomlayer.com\\/storage\\/da05bd21f4a821b049690503d9f0f380-5c789e060e0d5.jpg\\\" style=\\\"max-width:100%;\\\"><br><\\/p>\",\"_token\":\"dvK11AkbfEabaxB6vwKTVQRACqgGSnTQL6zTJtb3\",\"_method\":\"PUT\"}', '2019-03-01 10:50:48', '2019-03-01 10:50:48');
INSERT INTO `admin_operation_log` VALUES (249, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-01 10:50:49', '2019-03-01 10:50:49');
INSERT INTO `admin_operation_log` VALUES (250, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-03-01 15:45:24', '2019-03-01 15:45:24');
INSERT INTO `admin_operation_log` VALUES (251, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 15:45:39', '2019-03-01 15:45:39');
INSERT INTO `admin_operation_log` VALUES (252, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 15:45:55', '2019-03-01 15:45:55');
INSERT INTO `admin_operation_log` VALUES (253, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 15:46:26', '2019-03-01 15:46:26');
INSERT INTO `admin_operation_log` VALUES (254, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '[]', '2019-03-01 15:46:43', '2019-03-01 15:46:43');
INSERT INTO `admin_operation_log` VALUES (255, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '[]', '2019-03-01 15:47:20', '2019-03-01 15:47:20');
INSERT INTO `admin_operation_log` VALUES (256, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '[]', '2019-03-01 15:47:20', '2019-03-01 15:47:20');
INSERT INTO `admin_operation_log` VALUES (257, 1, 'admin/advertising', 'POST', '192.168.1.9', '{\"url\":\"https:\\/\\/www.baidu.com\\/\",\"status\":\"on\",\"_token\":\"ilO2Eqc3Sxlx8r3gYBWoEdCLpR4K82BUZbbqofiz\"}', '2019-03-01 15:47:30', '2019-03-01 15:47:30');
INSERT INTO `admin_operation_log` VALUES (258, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 15:47:31', '2019-03-01 15:47:31');
INSERT INTO `admin_operation_log` VALUES (259, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 15:48:48', '2019-03-01 15:48:48');
INSERT INTO `admin_operation_log` VALUES (260, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 15:48:56', '2019-03-01 15:48:56');
INSERT INTO `admin_operation_log` VALUES (261, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 15:49:00', '2019-03-01 15:49:00');
INSERT INTO `admin_operation_log` VALUES (262, 1, 'admin/advertising', 'POST', '192.168.1.9', '{\"url\":\"1\",\"status\":\"on\",\"_token\":\"ilO2Eqc3Sxlx8r3gYBWoEdCLpR4K82BUZbbqofiz\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/advertising\"}', '2019-03-01 15:49:09', '2019-03-01 15:49:09');
INSERT INTO `admin_operation_log` VALUES (263, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 15:49:10', '2019-03-01 15:49:10');
INSERT INTO `admin_operation_log` VALUES (264, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 15:50:36', '2019-03-01 15:50:36');
INSERT INTO `admin_operation_log` VALUES (265, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-01 16:08:11', '2019-03-01 16:08:11');
INSERT INTO `admin_operation_log` VALUES (266, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 16:08:15', '2019-03-01 16:08:15');
INSERT INTO `admin_operation_log` VALUES (267, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '[]', '2019-03-01 16:08:48', '2019-03-01 16:08:48');
INSERT INTO `admin_operation_log` VALUES (268, 1, 'admin/auth/logout', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-01 17:33:06', '2019-03-01 17:33:06');
INSERT INTO `admin_operation_log` VALUES (269, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-03-04 09:30:40', '2019-03-04 09:30:40');
INSERT INTO `admin_operation_log` VALUES (270, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-03-04 09:30:47', '2019-03-04 09:30:47');
INSERT INTO `admin_operation_log` VALUES (271, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-04 09:31:13', '2019-03-04 09:31:13');
INSERT INTO `admin_operation_log` VALUES (272, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-04 09:33:41', '2019-03-04 09:33:41');
INSERT INTO `admin_operation_log` VALUES (273, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 09:33:44', '2019-03-04 09:33:44');
INSERT INTO `admin_operation_log` VALUES (274, 1, 'admin/advertising', 'POST', '192.168.1.9', '{\"url\":\"www.baidu.com\",\"type\":\"1\",\"status\":\"on\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/advertising\"}', '2019-03-04 09:33:59', '2019-03-04 09:33:59');
INSERT INTO `admin_operation_log` VALUES (275, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-04 09:33:59', '2019-03-04 09:33:59');
INSERT INTO `admin_operation_log` VALUES (276, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 09:34:01', '2019-03-04 09:34:01');
INSERT INTO `admin_operation_log` VALUES (277, 1, 'admin/advertising', 'POST', '192.168.1.9', '{\"url\":\"www.baidu.com\",\"type\":\"2\",\"status\":\"on\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/advertising\"}', '2019-03-04 09:34:10', '2019-03-04 09:34:10');
INSERT INTO `admin_operation_log` VALUES (278, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-04 09:34:10', '2019-03-04 09:34:10');
INSERT INTO `admin_operation_log` VALUES (279, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 09:34:12', '2019-03-04 09:34:12');
INSERT INTO `admin_operation_log` VALUES (280, 1, 'admin/advertising', 'POST', '192.168.1.9', '{\"url\":\"www.baidu.com\",\"type\":\"3\",\"status\":\"on\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/advertising\"}', '2019-03-04 09:34:20', '2019-03-04 09:34:20');
INSERT INTO `admin_operation_log` VALUES (281, 1, 'admin/advertising', 'GET', '192.168.1.9', '[]', '2019-03-04 09:34:21', '2019-03-04 09:34:21');
INSERT INTO `admin_operation_log` VALUES (282, 1, 'admin/advertising/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 09:34:56', '2019-03-04 09:34:56');
INSERT INTO `admin_operation_log` VALUES (283, 1, 'admin/advertising', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 09:35:08', '2019-03-04 09:35:08');
INSERT INTO `admin_operation_log` VALUES (284, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-04 09:48:00', '2019-03-04 09:48:00');
INSERT INTO `admin_operation_log` VALUES (285, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 09:48:09', '2019-03-04 09:48:09');
INSERT INTO `admin_operation_log` VALUES (286, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:02:23', '2019-03-04 10:02:23');
INSERT INTO `admin_operation_log` VALUES (287, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:02:25', '2019-03-04 10:02:25');
INSERT INTO `admin_operation_log` VALUES (288, 1, 'admin/category/1', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:02:47', '2019-03-04 10:02:47');
INSERT INTO `admin_operation_log` VALUES (289, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:02:48', '2019-03-04 10:02:48');
INSERT INTO `admin_operation_log` VALUES (290, 1, 'admin/category/2', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:02:51', '2019-03-04 10:02:51');
INSERT INTO `admin_operation_log` VALUES (291, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:02:51', '2019-03-04 10:02:51');
INSERT INTO `admin_operation_log` VALUES (292, 1, 'admin/category/3', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:02:53', '2019-03-04 10:02:53');
INSERT INTO `admin_operation_log` VALUES (293, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:02:54', '2019-03-04 10:02:54');
INSERT INTO `admin_operation_log` VALUES (294, 1, 'admin/category/4', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:02:56', '2019-03-04 10:02:56');
INSERT INTO `admin_operation_log` VALUES (295, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:02:57', '2019-03-04 10:02:57');
INSERT INTO `admin_operation_log` VALUES (296, 1, 'admin/category/5', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:02:59', '2019-03-04 10:02:59');
INSERT INTO `admin_operation_log` VALUES (297, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:02:59', '2019-03-04 10:02:59');
INSERT INTO `admin_operation_log` VALUES (298, 1, 'admin/category/6', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:03:01', '2019-03-04 10:03:01');
INSERT INTO `admin_operation_log` VALUES (299, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:03:02', '2019-03-04 10:03:02');
INSERT INTO `admin_operation_log` VALUES (300, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:03:03', '2019-03-04 10:03:03');
INSERT INTO `admin_operation_log` VALUES (301, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"\\u52a8\\u6f2b\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:03:33', '2019-03-04 10:03:33');
INSERT INTO `admin_operation_log` VALUES (302, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:03:33', '2019-03-04 10:03:33');
INSERT INTO `admin_operation_log` VALUES (303, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:03:36', '2019-03-04 10:03:36');
INSERT INTO `admin_operation_log` VALUES (304, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"\\u6e38\\u620f\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:03:50', '2019-03-04 10:03:50');
INSERT INTO `admin_operation_log` VALUES (305, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:03:50', '2019-03-04 10:03:50');
INSERT INTO `admin_operation_log` VALUES (306, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:03:53', '2019-03-04 10:03:53');
INSERT INTO `admin_operation_log` VALUES (307, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":null,\"name\":\"\\u7535\\u5668\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:04:16', '2019-03-04 10:04:16');
INSERT INTO `admin_operation_log` VALUES (308, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-03-04 10:04:18', '2019-03-04 10:04:18');
INSERT INTO `admin_operation_log` VALUES (309, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:04:22', '2019-03-04 10:04:22');
INSERT INTO `admin_operation_log` VALUES (310, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":null,\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:04:29', '2019-03-04 10:04:29');
INSERT INTO `admin_operation_log` VALUES (311, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-03-04 10:04:31', '2019-03-04 10:04:31');
INSERT INTO `admin_operation_log` VALUES (312, 1, 'admin/category/create', 'GET', '192.168.1.9', '[]', '2019-03-04 10:05:41', '2019-03-04 10:05:41');
INSERT INTO `admin_operation_log` VALUES (313, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:05:45', '2019-03-04 10:05:45');
INSERT INTO `admin_operation_log` VALUES (314, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"0\",\"name\":\"\\u7535\\u5668\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:06:57', '2019-03-04 10:06:57');
INSERT INTO `admin_operation_log` VALUES (315, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:06:58', '2019-03-04 10:06:58');
INSERT INTO `admin_operation_log` VALUES (316, 1, 'admin/category/7/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:07:04', '2019-03-04 10:07:04');
INSERT INTO `admin_operation_log` VALUES (317, 1, 'admin/category', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:07:07', '2019-03-04 10:07:07');
INSERT INTO `admin_operation_log` VALUES (318, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:07:09', '2019-03-04 10:07:09');
INSERT INTO `admin_operation_log` VALUES (319, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"7\",\"name\":\"\\u6d77\\u8d3c\\u738b\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:07:22', '2019-03-04 10:07:22');
INSERT INTO `admin_operation_log` VALUES (320, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:07:23', '2019-03-04 10:07:23');
INSERT INTO `admin_operation_log` VALUES (321, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:07:27', '2019-03-04 10:07:27');
INSERT INTO `admin_operation_log` VALUES (322, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"10\",\"name\":\"\\u8def\\u98de\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:07:46', '2019-03-04 10:07:46');
INSERT INTO `admin_operation_log` VALUES (323, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:07:46', '2019-03-04 10:07:46');
INSERT INTO `admin_operation_log` VALUES (324, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:08:03', '2019-03-04 10:08:03');
INSERT INTO `admin_operation_log` VALUES (325, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"8\",\"name\":\"\\u82f1\\u96c4\\u8054\\u76df\",\"order\":\"1\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:08:22', '2019-03-04 10:08:22');
INSERT INTO `admin_operation_log` VALUES (326, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:08:23', '2019-03-04 10:08:23');
INSERT INTO `admin_operation_log` VALUES (327, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:08:27', '2019-03-04 10:08:27');
INSERT INTO `admin_operation_log` VALUES (328, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"12\",\"name\":\"\\u5fb7\\u83b1\\u6587\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:08:47', '2019-03-04 10:08:47');
INSERT INTO `admin_operation_log` VALUES (329, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:08:47', '2019-03-04 10:08:47');
INSERT INTO `admin_operation_log` VALUES (330, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:08:51', '2019-03-04 10:08:51');
INSERT INTO `admin_operation_log` VALUES (331, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"9\",\"name\":\"\\u5916\\u8bbe\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:09:06', '2019-03-04 10:09:06');
INSERT INTO `admin_operation_log` VALUES (332, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:09:07', '2019-03-04 10:09:07');
INSERT INTO `admin_operation_log` VALUES (333, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:09:10', '2019-03-04 10:09:10');
INSERT INTO `admin_operation_log` VALUES (334, 1, 'admin/category', 'POST', '192.168.1.9', '{\"pid\":\"14\",\"name\":\"\\u952e\\u76d8\",\"order\":\"0\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/category\"}', '2019-03-04 10:09:20', '2019-03-04 10:09:20');
INSERT INTO `admin_operation_log` VALUES (335, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:09:21', '2019-03-04 10:09:21');
INSERT INTO `admin_operation_log` VALUES (336, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 10:15:52', '2019-03-04 10:15:52');
INSERT INTO `admin_operation_log` VALUES (337, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-04 10:17:44', '2019-03-04 10:17:44');
INSERT INTO `admin_operation_log` VALUES (338, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:17:47', '2019-03-04 10:17:47');
INSERT INTO `admin_operation_log` VALUES (339, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-04 10:23:25', '2019-03-04 10:23:25');
INSERT INTO `admin_operation_log` VALUES (340, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-04 10:25:28', '2019-03-04 10:25:28');
INSERT INTO `admin_operation_log` VALUES (341, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-04 10:25:34', '2019-03-04 10:25:34');
INSERT INTO `admin_operation_log` VALUES (342, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-04 10:25:49', '2019-03-04 10:25:49');
INSERT INTO `admin_operation_log` VALUES (343, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-04 10:26:00', '2019-03-04 10:26:00');
INSERT INTO `admin_operation_log` VALUES (344, 1, 'admin/product/2/edit', 'GET', '192.168.1.9', '[]', '2019-03-04 10:26:27', '2019-03-04 10:26:27');
INSERT INTO `admin_operation_log` VALUES (345, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:27:02', '2019-03-04 10:27:02');
INSERT INTO `admin_operation_log` VALUES (346, 1, 'admin/product/2', 'DELETE', '192.168.1.9', '{\"_method\":\"delete\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\"}', '2019-03-04 10:27:06', '2019-03-04 10:27:06');
INSERT INTO `admin_operation_log` VALUES (347, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:27:07', '2019-03-04 10:27:07');
INSERT INTO `admin_operation_log` VALUES (348, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-04 10:27:09', '2019-03-04 10:27:09');
INSERT INTO `admin_operation_log` VALUES (349, 1, 'admin/product', 'POST', '192.168.1.9', '{\"name\":\"\\u6d77\\u8d3c\\u738b\",\"title\":\"\\u6d77\\u8d3c\\u738b2\",\"category_id\":\"11\",\"price\":\"200.00\",\"type\":\"1\",\"content\":\"<p><\\/p><p>\\u8fd9TM\\u5c31\\u662f\\u5546\\u57ce<\\/p>\",\"_token\":\"qOXzh2TFSBeIo1No0xPOtqAbXdIZ7urbUXqmdcTM\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/product\"}', '2019-03-04 10:28:12', '2019-03-04 10:28:12');
INSERT INTO `admin_operation_log` VALUES (350, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-04 10:28:12', '2019-03-04 10:28:12');
INSERT INTO `admin_operation_log` VALUES (351, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-04 14:49:15', '2019-03-04 14:49:15');
INSERT INTO `admin_operation_log` VALUES (352, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-03-06 15:11:28', '2019-03-06 15:11:28');
INSERT INTO `admin_operation_log` VALUES (353, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-06 15:11:38', '2019-03-06 15:11:38');
INSERT INTO `admin_operation_log` VALUES (354, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-06 15:11:41', '2019-03-06 15:11:41');
INSERT INTO `admin_operation_log` VALUES (355, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-06 15:12:27', '2019-03-06 15:12:27');
INSERT INTO `admin_operation_log` VALUES (356, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-06 15:12:29', '2019-03-06 15:12:29');
INSERT INTO `admin_operation_log` VALUES (357, 1, 'admin/product/create', 'GET', '192.168.1.9', '[]', '2019-03-06 15:13:26', '2019-03-06 15:13:26');
INSERT INTO `admin_operation_log` VALUES (358, 1, 'admin/category', 'GET', '192.168.1.9', '[]', '2019-03-06 15:13:50', '2019-03-06 15:13:50');
INSERT INTO `admin_operation_log` VALUES (359, 1, 'admin/category/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-06 15:13:53', '2019-03-06 15:13:53');
INSERT INTO `admin_operation_log` VALUES (360, 1, 'admin', 'GET', '192.168.1.9', '[]', '2019-03-07 11:49:49', '2019-03-07 11:49:49');
INSERT INTO `admin_operation_log` VALUES (361, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-07 11:49:58', '2019-03-07 11:49:58');
INSERT INTO `admin_operation_log` VALUES (362, 1, 'admin/product/create', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-07 11:50:00', '2019-03-07 11:50:00');
INSERT INTO `admin_operation_log` VALUES (363, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-07 11:50:03', '2019-03-07 11:50:03');
INSERT INTO `admin_operation_log` VALUES (364, 1, 'admin/product/3/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-07 11:50:04', '2019-03-07 11:50:04');
INSERT INTO `admin_operation_log` VALUES (365, 1, 'admin/product/3', 'PUT', '192.168.1.9', '{\"name\":\"\\u6d77\\u8d3c\\u738b\",\"title\":\"\\u6d77\\u8d3c\\u738b2\",\"category_id\":\"11\",\"price\":\"200.00\",\"type\":\"1\",\"content\":\"<p><\\/p><p><\\/p><p>\\u8fd9TM\\u5c31\\u662f\\u5546\\u57ce<\\/p><p><img src=\\\"http:\\/\\/www.bottomlayer.com\\/storage\\/39c01900426dd2e1f6529fc24a8517a4-5c8094f690561.jpg\\\" style=\\\"max-width:100%;\\\"><br><\\/p><p><img src=\\\"http:\\/\\/www.bottomlayer.com\\/storage\\/e1a75821dcd2ffef12cc31eee69fadad-5c8094fc65bee.jpg\\\" style=\\\"max-width:100%;\\\"><br><\\/p>\",\"_token\":\"cHr3OlEcst3yUHQSU0s1qpLu2gHHFuXLjLDL8MFv\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/www.bottomlayer.com\\/admin\\/product\"}', '2019-03-07 11:50:21', '2019-03-07 11:50:21');
INSERT INTO `admin_operation_log` VALUES (366, 1, 'admin/product', 'GET', '192.168.1.9', '[]', '2019-03-07 11:50:22', '2019-03-07 11:50:22');
INSERT INTO `admin_operation_log` VALUES (367, 1, 'admin/product/3', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-07 11:50:24', '2019-03-07 11:50:24');
INSERT INTO `admin_operation_log` VALUES (368, 1, 'admin/product', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-07 11:50:27', '2019-03-07 11:50:27');
INSERT INTO `admin_operation_log` VALUES (369, 1, 'admin/product/3/edit', 'GET', '192.168.1.9', '{\"_pjax\":\"#pjax-container\"}', '2019-03-07 11:50:29', '2019-03-07 11:50:29');

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_menu_role_id_menu_id_index`(`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (1, 2, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions`  (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_permissions_role_id_permission_id_index`(`role_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users`  (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_users_role_id_user_id_index`(`role_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES (1, 'Administrator', 'administrator', '2019-02-27 08:09:14', '2019-02-27 08:09:14');

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions`  (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_user_permissions_user_id_permission_id_index`(`user_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '$2y$10$FKlHNJroFLa33i8YN1rouunR1wzAbgSiKKxZUlJpx5VIVo/lQmNfi', 'Administrator', NULL, NULL, '2019-02-27 08:09:14', '2019-02-27 08:09:14');

-- ----------------------------
-- Table structure for advertising
-- ----------------------------
DROP TABLE IF EXISTS `advertising`;
CREATE TABLE `advertising`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告图片',
  `status` int(11) NOT NULL COMMENT '广告状态',
  `type` int(11) NOT NULL COMMENT '广告分类',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告跳转链接',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of advertising
-- ----------------------------
INSERT INTO `advertising` VALUES (1, 'images/13f767f6c2ff8907b871dc5e00cf9c57.jpg', 1, 1, 'www.baidu.com', '2019-03-04 09:33:59', '2019-03-04 09:33:59');
INSERT INTO `advertising` VALUES (2, 'images/50d8bbfd845423b8bda5318f40bb81d9.jpg', 1, 2, 'www.baidu.com', '2019-03-04 09:34:10', '2019-03-04 09:34:10');
INSERT INTO `advertising` VALUES (3, 'images/907fee40baae153e1ad54b97c3e08d78.jpg', 1, 3, 'www.baidu.com', '2019-03-04 09:34:20', '2019-03-04 09:34:20');

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'banner地址',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'banner跳转地址',
  `order` int(11) NOT NULL COMMENT 'banner排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES (2, 'images/timg (1).jpg', 'https://www.baidu.com/', 1, '2019-02-28 14:09:08', '2019-02-28 14:09:08');
INSERT INTO `banner` VALUES (3, 'images/timg (2).jpg', 'https://www.baidu.com/', 2, '2019-02-28 14:09:16', '2019-02-28 14:09:16');
INSERT INTO `banner` VALUES (4, 'images/timg (3).jpg', 'https://www.baidu.com/', 3, '2019-02-28 14:09:27', '2019-02-28 14:09:27');
INSERT INTO `banner` VALUES (5, 'images/timg.jpg', 'https://www.baidu.com/', 4, '2019-02-28 14:09:37', '2019-02-28 14:09:37');

-- ----------------------------
-- Table structure for bulletin
-- ----------------------------
DROP TABLE IF EXISTS `bulletin`;
CREATE TABLE `bulletin`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '公告标题',
  `status` int(11) NOT NULL COMMENT '公告状态',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bulletin
-- ----------------------------
INSERT INTO `bulletin` VALUES (1, '恭喜王总喜提大奔', 1, '2019-02-28 17:05:08', '2019-02-28 17:05:08');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `ioc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类图标',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '父级分类ID',
  `order` int(11) NOT NULL COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (7, '动漫', 'images/66261aa31b35b7a35c2b927734fc8eb4.jpg', 0, 0, '2019-03-04 10:03:33', '2019-03-04 10:03:33');
INSERT INTO `category` VALUES (8, '游戏', 'images/16aa991f6d86599e6dfa4ce784208450.jpg', 0, 0, '2019-03-04 10:03:50', '2019-03-04 10:03:50');
INSERT INTO `category` VALUES (9, '电器', 'images/7a0bc22d226115f472c35129c0cb943a.jpg', 0, 0, '2019-03-04 10:06:57', '2019-03-04 10:06:57');
INSERT INTO `category` VALUES (10, '海贼王', 'images/a87f5dbd81402eaf45f2ed51da1b5f1e.jpg', 7, 0, '2019-03-04 10:07:22', '2019-03-04 10:07:22');
INSERT INTO `category` VALUES (11, '路飞', 'images/9cb69b9e20cd493fc2e6a20ec1e4ee18.jpg', 10, 0, '2019-03-04 10:07:46', '2019-03-04 10:07:46');
INSERT INTO `category` VALUES (12, '英雄联盟', 'images/d10c628308cfcb5265241d2b32063a99.jpg', 8, 1, '2019-03-04 10:08:22', '2019-03-04 10:08:22');
INSERT INTO `category` VALUES (13, '德莱文', 'images/5839d19cf6a6fd62c11e90e1e84b2c01.jpg', 12, 0, '2019-03-04 10:08:47', '2019-03-04 10:08:47');
INSERT INTO `category` VALUES (14, '外设', 'images/321ceaa0adb5e4d2f355daa165bca7ad.jpg', 9, 0, '2019-03-04 10:09:07', '2019-03-04 10:09:07');
INSERT INTO `category` VALUES (15, '键盘', 'images/6437bd0694491826da1bb3e8620348fa.jpg', 14, 0, '2019-03-04 10:09:20', '2019-03-04 10:09:20');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_01_04_173148_create_admin_tables', 1);
INSERT INTO `migrations` VALUES (4, '2019_02_27_081009_create_product_table', 2);
INSERT INTO `migrations` VALUES (6, '2019_02_28_102958_create__banner_table', 3);
INSERT INTO `migrations` VALUES (7, '2019_02_28_141551_create_category_table', 4);
INSERT INTO `migrations` VALUES (8, '2019_02_28_164132_create_bulletin_table', 5);
INSERT INTO `migrations` VALUES (10, '2019_03_01_154034_create_advertising_table', 6);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品标题',
  `category_id` int(11) NULL DEFAULT NULL,
  `groupimg` json NOT NULL COMMENT '商品组图',
  `price` decimal(11, 2) NOT NULL COMMENT '商品价格',
  `type` int(11) NOT NULL COMMENT '商品类型',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (3, '海贼王', '海贼王2', 11, '[\"images/fc2ac8b751f08cbdb9ddf38be9cd985b.jpg\"]', 200.00, 1, '<p></p><p></p><p>这TM就是商城</p><p><img src=\"http://www.bottomlayer.com/storage/39c01900426dd2e1f6529fc24a8517a4-5c8094f690561.jpg\" style=\"max-width:100%;\"><br></p><p><img src=\"http://www.bottomlayer.com/storage/e1a75821dcd2ffef12cc31eee69fadad-5c8094fc65bee.jpg\" style=\"max-width:100%;\"><br></p>', '2019-03-04 10:28:12', '2019-03-07 11:50:22');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
