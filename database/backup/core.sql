/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : core

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-03-24 16:21:39
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `actions`
-- ----------------------------
DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `actions_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of actions
-- ----------------------------
INSERT INTO actions VALUES ('2', 'Index', 'index', '2016-03-22 08:52:09', '2016-03-22 08:52:09');
INSERT INTO actions VALUES ('3', 'Delete', 'delete', '2016-03-22 08:52:20', '2016-03-22 08:52:20');
INSERT INTO actions VALUES ('4', 'Update', 'update', '2016-03-22 08:52:32', '2016-03-22 08:52:32');
INSERT INTO actions VALUES ('5', 'View', 'view', '2016-03-22 08:52:43', '2016-03-22 08:52:43');
INSERT INTO actions VALUES ('6', 'Create', 'create', '2016-03-22 08:52:49', '2016-03-22 08:52:49');
INSERT INTO actions VALUES ('8', 'Publish UnPublish', 'publish', '2016-03-23 12:43:26', '2016-03-23 12:43:26');

-- ----------------------------
-- Table structure for `cruds`
-- ----------------------------
DROP TABLE IF EXISTS `cruds`;
CREATE TABLE `cruds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('y','n') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cruds
-- ----------------------------

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  KEY `menus_controller_index` (`controller`),
  KEY `menus_slug_index` (`slug`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO menus VALUES ('1', null, 'Dashboard', 'DashboardController', 'dashboard', '1', '', null, null);
INSERT INTO menus VALUES ('2', null, 'Development', '#', 'development', '22', '', null, '2016-03-22 09:48:49');
INSERT INTO menus VALUES ('3', '2', 'Menu', 'MenuController', 'menu', '1', '', null, null);
INSERT INTO menus VALUES ('9', '2', 'Action', 'ActionController', 'action', '2', '', '2016-03-22 07:47:57', '2016-03-22 07:47:57');
INSERT INTO menus VALUES ('10', null, 'User', '#', 'user', '2', '', '2016-03-22 09:48:39', '2016-03-22 09:48:39');
INSERT INTO menus VALUES ('11', '10', 'Role', 'RoleController', 'role', '1', '', '2016-03-22 09:49:40', '2016-03-22 09:49:40');
INSERT INTO menus VALUES ('12', '10', 'Manage User', 'UserController', 'manage-user', '3', '', '2016-03-22 12:10:31', '2016-03-22 12:10:31');
INSERT INTO menus VALUES ('13', '10', 'Profile', 'ProfileController', 'profile', '9', '', '2016-03-23 07:49:10', '2016-03-23 07:49:10');
INSERT INTO menus VALUES ('14', null, 'Media Library', '#', 'media-library', '10', '', '2016-03-23 09:40:57', '2016-03-23 09:40:57');
INSERT INTO menus VALUES ('15', '14', 'Image', 'ImageController', 'image', '1', '', '2016-03-23 09:41:14', '2016-03-23 09:41:14');
INSERT INTO menus VALUES ('16', '2', 'Crud', 'CrudController', 'crud', '7', '', '2016-03-23 10:13:58', '2016-03-23 10:13:58');

-- ----------------------------
-- Table structure for `menu_actions`
-- ----------------------------
DROP TABLE IF EXISTS `menu_actions`;
CREATE TABLE `menu_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `action_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_actions_menu_id_foreign` (`menu_id`),
  KEY `menu_actions_action_id_foreign` (`action_id`),
  CONSTRAINT `menu_actions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_actions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu_actions
-- ----------------------------
INSERT INTO menu_actions VALUES ('12', '9', '2', '2016-03-22 09:46:45', '2016-03-22 09:46:45');
INSERT INTO menu_actions VALUES ('13', '9', '3', '2016-03-22 09:46:45', '2016-03-22 09:46:45');
INSERT INTO menu_actions VALUES ('14', '9', '4', '2016-03-22 09:46:45', '2016-03-22 09:46:45');
INSERT INTO menu_actions VALUES ('15', '9', '6', '2016-03-22 09:46:45', '2016-03-22 09:46:45');
INSERT INTO menu_actions VALUES ('16', '3', '2', '2016-03-22 09:47:20', '2016-03-22 09:47:20');
INSERT INTO menu_actions VALUES ('17', '3', '3', '2016-03-22 09:47:20', '2016-03-22 09:47:20');
INSERT INTO menu_actions VALUES ('18', '3', '4', '2016-03-22 09:47:20', '2016-03-22 09:47:20');
INSERT INTO menu_actions VALUES ('19', '3', '5', '2016-03-22 09:47:20', '2016-03-22 09:47:20');
INSERT INTO menu_actions VALUES ('20', '3', '6', '2016-03-22 09:47:20', '2016-03-22 09:47:20');
INSERT INTO menu_actions VALUES ('27', '11', '2', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('28', '11', '3', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('29', '11', '4', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('30', '11', '5', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('31', '11', '6', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('32', '12', '2', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('33', '12', '3', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('34', '12', '4', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('35', '12', '6', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('36', '13', '2', '2016-03-23 07:49:23', '2016-03-23 07:49:23');
INSERT INTO menu_actions VALUES ('37', '15', '2', '2016-03-23 09:49:42', '2016-03-23 09:49:42');
INSERT INTO menu_actions VALUES ('42', '16', '2', '2016-03-23 12:45:37', '2016-03-23 12:45:37');
INSERT INTO menu_actions VALUES ('43', '16', '3', '2016-03-23 12:45:37', '2016-03-23 12:45:37');
INSERT INTO menu_actions VALUES ('44', '16', '4', '2016-03-23 12:45:37', '2016-03-23 12:45:37');
INSERT INTO menu_actions VALUES ('45', '16', '6', '2016-03-23 12:45:37', '2016-03-23 12:45:37');
INSERT INTO menu_actions VALUES ('46', '16', '8', '2016-03-23 12:45:38', '2016-03-23 12:45:38');


-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `rights`
-- ----------------------------
DROP TABLE IF EXISTS `rights`;
CREATE TABLE `rights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `menu_action_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rights_menu_action_id_foreign` (`menu_action_id`),
  KEY `rights_role_id_foreign` (`role_id`),
  CONSTRAINT `rights_menu_action_id_foreign` FOREIGN KEY (`menu_action_id`) REFERENCES `menu_actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rights_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rights
-- ----------------------------
INSERT INTO rights VALUES ('225', '4', '12', '2016-03-23 09:29:40', '2016-03-23 09:29:40');
INSERT INTO rights VALUES ('270', '1', '27', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('271', '1', '28', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('272', '1', '29', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('273', '1', '30', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('274', '1', '31', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('275', '1', '32', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('276', '1', '33', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('277', '1', '34', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('278', '1', '35', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('279', '1', '36', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('280', '1', '37', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('281', '1', '16', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('282', '1', '17', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('283', '1', '18', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('284', '1', '19', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('285', '1', '20', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('286', '1', '12', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('287', '1', '13', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('288', '1', '14', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('289', '1', '15', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('290', '1', '42', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('291', '1', '43', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('292', '1', '44', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('293', '1', '45', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('294', '1', '46', '2016-03-23 12:46:53', '2016-03-23 12:46:53');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO roles VALUES ('1', 'Superadmin', null, null);
INSERT INTO roles VALUES ('4', 'admin', '2016-03-22 12:52:56', '2016-03-22 12:52:56');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `gender` enum('pria','wanita') COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_username_index` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('6', 'TRINATA', 'reza.wikrama3@gmail.com', '$2y$10$ROTdTDIEwHkCdBLP8X6eH.ydOxr7LKkZ.vGTXU5bPbsoNTn9q/FCC', 'lX0dI5UQXVugD9l0JMFyoStJWGCucKeOu9zQh92jDbhzfpQEovYX57xNuc27', '2016-03-22 13:07:29', '2016-03-24 16:16:08', '1', 'pria', '', '0', 'superadmin');
INSERT INTO users VALUES ('7', 'admin', 'ultramantigar@gmail.com', '$2y$10$gPafGNqLHVtVtPgO7/KqjeqGwLhBr/ZSe1G3YnZWp80Yo8GcpdYRG', 'AsrSmU1PESaINwJGI1pH1KQgrYetdGz0QyQO5y02Ix0rfOGVIIOvh1ugrwgD', '2016-03-22 13:08:00', '2016-03-23 09:51:11', '4', 'pria', '', '0', 'admin');

-- ----------------------------
-- Table structure for `user_activities`
-- ----------------------------
DROP TABLE IF EXISTS `user_activities`;
CREATE TABLE `user_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `action` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_activities_user_id_foreign` (`user_id`),
  CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_activities
-- ----------------------------
