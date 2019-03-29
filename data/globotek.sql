/*
 Navicat MySQL Data Transfer

 Source Server         : GloboTek Local
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : 192.168.1.155:3306
 Source Schema         : globotek

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 29/03/2019 09:41:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for gtek_commentmeta
-- ----------------------------
DROP TABLE IF EXISTS `gtek_commentmeta`;
CREATE TABLE `gtek_commentmeta`  (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL,
  PRIMARY KEY (`meta_id`) USING BTREE,
  INDEX `comment_id`(`comment_id`) USING BTREE,
  INDEX `meta_key`(`meta_key`(191)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for gtek_comments
-- ----------------------------
DROP TABLE IF EXISTS `gtek_comments`;
CREATE TABLE `gtek_comments`  (
  `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime(0) NOT NULL,
  `comment_date_gmt` datetime(0) NOT NULL,
  `comment_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`comment_ID`) USING BTREE,
  INDEX `comment_post_ID`(`comment_post_ID`) USING BTREE,
  INDEX `comment_approved_date_gmt`(`comment_approved`, `comment_date_gmt`) USING BTREE,
  INDEX `comment_date_gmt`(`comment_date_gmt`) USING BTREE,
  INDEX `comment_parent`(`comment_parent`) USING BTREE,
  INDEX `comment_author_email`(`comment_author_email`(10)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_comments
-- ----------------------------
INSERT INTO `gtek_comments` VALUES (1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2019-01-25 00:46:29', '2019-01-25 00:46:29', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com\">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- ----------------------------
-- Table structure for gtek_links
-- ----------------------------
DROP TABLE IF EXISTS `gtek_links`;
CREATE TABLE `gtek_links`  (
  `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime(0) NOT NULL,
  `link_rel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`) USING BTREE,
  INDEX `link_visible`(`link_visible`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for gtek_options
-- ----------------------------
DROP TABLE IF EXISTS `gtek_options`;
CREATE TABLE `gtek_options`  (
  `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`) USING BTREE,
  UNIQUE INDEX `option_name`(`option_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 282 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_options
-- ----------------------------
INSERT INTO `gtek_options` VALUES (1, 'siteurl', 'http://globotek.local', 'yes');
INSERT INTO `gtek_options` VALUES (2, 'home', 'http://globotek.local', 'yes');
INSERT INTO `gtek_options` VALUES (3, 'blogname', 'GloboTek', 'yes');
INSERT INTO `gtek_options` VALUES (4, 'blogdescription', 'Just another WordPress site', 'yes');
INSERT INTO `gtek_options` VALUES (5, 'users_can_register', '0', 'yes');
INSERT INTO `gtek_options` VALUES (6, 'admin_email', 'matthew@globotek.net', 'yes');
INSERT INTO `gtek_options` VALUES (7, 'start_of_week', '1', 'yes');
INSERT INTO `gtek_options` VALUES (8, 'use_balanceTags', '0', 'yes');
INSERT INTO `gtek_options` VALUES (9, 'use_smilies', '1', 'yes');
INSERT INTO `gtek_options` VALUES (10, 'require_name_email', '1', 'yes');
INSERT INTO `gtek_options` VALUES (11, 'comments_notify', '1', 'yes');
INSERT INTO `gtek_options` VALUES (12, 'posts_per_rss', '10', 'yes');
INSERT INTO `gtek_options` VALUES (13, 'rss_use_excerpt', '0', 'yes');
INSERT INTO `gtek_options` VALUES (14, 'mailserver_url', 'mail.example.com', 'yes');
INSERT INTO `gtek_options` VALUES (15, 'mailserver_login', 'login@example.com', 'yes');
INSERT INTO `gtek_options` VALUES (16, 'mailserver_pass', 'password', 'yes');
INSERT INTO `gtek_options` VALUES (17, 'mailserver_port', '110', 'yes');
INSERT INTO `gtek_options` VALUES (18, 'default_category', '1', 'yes');
INSERT INTO `gtek_options` VALUES (19, 'default_comment_status', 'open', 'yes');
INSERT INTO `gtek_options` VALUES (20, 'default_ping_status', 'open', 'yes');
INSERT INTO `gtek_options` VALUES (21, 'default_pingback_flag', '0', 'yes');
INSERT INTO `gtek_options` VALUES (22, 'posts_per_page', '10', 'yes');
INSERT INTO `gtek_options` VALUES (23, 'date_format', 'jS F Y', 'yes');
INSERT INTO `gtek_options` VALUES (24, 'time_format', 'g:i a', 'yes');
INSERT INTO `gtek_options` VALUES (25, 'links_updated_date_format', 'jS F Y g:i a', 'yes');
INSERT INTO `gtek_options` VALUES (26, 'comment_moderation', '0', 'yes');
INSERT INTO `gtek_options` VALUES (27, 'moderation_notify', '1', 'yes');
INSERT INTO `gtek_options` VALUES (28, 'permalink_structure', '/%postname%/', 'yes');
INSERT INTO `gtek_options` VALUES (29, 'rewrite_rules', 'a:115:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:12:\"portfolio/?$\";s:29:\"index.php?post_type=portfolio\";s:42:\"portfolio/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?post_type=portfolio&feed=$matches[1]\";s:37:\"portfolio/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?post_type=portfolio&feed=$matches[1]\";s:29:\"portfolio/page/([0-9]{1,})/?$\";s:47:\"index.php?post_type=portfolio&paged=$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:37:\"portfolio/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:47:\"portfolio/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:67:\"portfolio/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"portfolio/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"portfolio/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:43:\"portfolio/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:26:\"portfolio/([^/]+)/embed/?$\";s:42:\"index.php?portfolio=$matches[1]&embed=true\";s:30:\"portfolio/([^/]+)/trackback/?$\";s:36:\"index.php?portfolio=$matches[1]&tb=1\";s:50:\"portfolio/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:48:\"index.php?portfolio=$matches[1]&feed=$matches[2]\";s:45:\"portfolio/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:48:\"index.php?portfolio=$matches[1]&feed=$matches[2]\";s:38:\"portfolio/([^/]+)/page/?([0-9]{1,})/?$\";s:49:\"index.php?portfolio=$matches[1]&paged=$matches[2]\";s:45:\"portfolio/([^/]+)/comment-page-([0-9]{1,})/?$\";s:49:\"index.php?portfolio=$matches[1]&cpage=$matches[2]\";s:34:\"portfolio/([^/]+)(?:/([0-9]+))?/?$\";s:48:\"index.php?portfolio=$matches[1]&page=$matches[2]\";s:26:\"portfolio/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:36:\"portfolio/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:56:\"portfolio/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:51:\"portfolio/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:51:\"portfolio/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:32:\"portfolio/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:49:\"services/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?services=$matches[1]&feed=$matches[2]\";s:44:\"services/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?services=$matches[1]&feed=$matches[2]\";s:25:\"services/([^/]+)/embed/?$\";s:41:\"index.php?services=$matches[1]&embed=true\";s:37:\"services/([^/]+)/page/?([0-9]{1,})/?$\";s:48:\"index.php?services=$matches[1]&paged=$matches[2]\";s:19:\"services/([^/]+)/?$\";s:30:\"index.php?services=$matches[1]\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes');
INSERT INTO `gtek_options` VALUES (30, 'hack_file', '0', 'yes');
INSERT INTO `gtek_options` VALUES (31, 'blog_charset', 'UTF-8', 'yes');
INSERT INTO `gtek_options` VALUES (32, 'moderation_keys', '', 'no');
INSERT INTO `gtek_options` VALUES (33, 'active_plugins', 'a:2:{i:0;s:34:\"advanced-custom-fields-pro/acf.php\";i:2;s:38:\"globotek-theme-functionality/index.php\";}', 'yes');
INSERT INTO `gtek_options` VALUES (34, 'category_base', '', 'yes');
INSERT INTO `gtek_options` VALUES (35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes');
INSERT INTO `gtek_options` VALUES (36, 'comment_max_links', '2', 'yes');
INSERT INTO `gtek_options` VALUES (37, 'gmt_offset', '', 'yes');
INSERT INTO `gtek_options` VALUES (38, 'default_email_category', '1', 'yes');
INSERT INTO `gtek_options` VALUES (39, 'recently_edited', '', 'no');
INSERT INTO `gtek_options` VALUES (40, 'template', 'globotek', 'yes');
INSERT INTO `gtek_options` VALUES (41, 'stylesheet', 'globotek', 'yes');
INSERT INTO `gtek_options` VALUES (42, 'comment_whitelist', '1', 'yes');
INSERT INTO `gtek_options` VALUES (43, 'blacklist_keys', '', 'no');
INSERT INTO `gtek_options` VALUES (44, 'comment_registration', '0', 'yes');
INSERT INTO `gtek_options` VALUES (45, 'html_type', 'text/html', 'yes');
INSERT INTO `gtek_options` VALUES (46, 'use_trackback', '0', 'yes');
INSERT INTO `gtek_options` VALUES (47, 'default_role', 'subscriber', 'yes');
INSERT INTO `gtek_options` VALUES (48, 'db_version', '44719', 'yes');
INSERT INTO `gtek_options` VALUES (49, 'uploads_use_yearmonth_folders', '1', 'yes');
INSERT INTO `gtek_options` VALUES (50, 'upload_path', '', 'yes');
INSERT INTO `gtek_options` VALUES (51, 'blog_public', '0', 'yes');
INSERT INTO `gtek_options` VALUES (52, 'default_link_category', '2', 'yes');
INSERT INTO `gtek_options` VALUES (53, 'show_on_front', 'posts', 'yes');
INSERT INTO `gtek_options` VALUES (54, 'tag_base', '', 'yes');
INSERT INTO `gtek_options` VALUES (55, 'show_avatars', '1', 'yes');
INSERT INTO `gtek_options` VALUES (56, 'avatar_rating', 'G', 'yes');
INSERT INTO `gtek_options` VALUES (57, 'upload_url_path', '', 'yes');
INSERT INTO `gtek_options` VALUES (58, 'thumbnail_size_w', '150', 'yes');
INSERT INTO `gtek_options` VALUES (59, 'thumbnail_size_h', '150', 'yes');
INSERT INTO `gtek_options` VALUES (60, 'thumbnail_crop', '1', 'yes');
INSERT INTO `gtek_options` VALUES (61, 'medium_size_w', '300', 'yes');
INSERT INTO `gtek_options` VALUES (62, 'medium_size_h', '300', 'yes');
INSERT INTO `gtek_options` VALUES (63, 'avatar_default', 'mystery', 'yes');
INSERT INTO `gtek_options` VALUES (64, 'large_size_w', '1024', 'yes');
INSERT INTO `gtek_options` VALUES (65, 'large_size_h', '1024', 'yes');
INSERT INTO `gtek_options` VALUES (66, 'image_default_link_type', 'none', 'yes');
INSERT INTO `gtek_options` VALUES (67, 'image_default_size', '', 'yes');
INSERT INTO `gtek_options` VALUES (68, 'image_default_align', '', 'yes');
INSERT INTO `gtek_options` VALUES (69, 'close_comments_for_old_posts', '0', 'yes');
INSERT INTO `gtek_options` VALUES (70, 'close_comments_days_old', '14', 'yes');
INSERT INTO `gtek_options` VALUES (71, 'thread_comments', '1', 'yes');
INSERT INTO `gtek_options` VALUES (72, 'thread_comments_depth', '5', 'yes');
INSERT INTO `gtek_options` VALUES (73, 'page_comments', '0', 'yes');
INSERT INTO `gtek_options` VALUES (74, 'comments_per_page', '50', 'yes');
INSERT INTO `gtek_options` VALUES (75, 'default_comments_page', 'newest', 'yes');
INSERT INTO `gtek_options` VALUES (76, 'comment_order', 'asc', 'yes');
INSERT INTO `gtek_options` VALUES (77, 'sticky_posts', 'a:0:{}', 'yes');
INSERT INTO `gtek_options` VALUES (78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (79, 'widget_text', 'a:0:{}', 'yes');
INSERT INTO `gtek_options` VALUES (80, 'widget_rss', 'a:0:{}', 'yes');
INSERT INTO `gtek_options` VALUES (81, 'uninstall_plugins', 'a:0:{}', 'no');
INSERT INTO `gtek_options` VALUES (82, 'timezone_string', 'Europe/London', 'yes');
INSERT INTO `gtek_options` VALUES (83, 'page_for_posts', '0', 'yes');
INSERT INTO `gtek_options` VALUES (84, 'page_on_front', '0', 'yes');
INSERT INTO `gtek_options` VALUES (85, 'default_post_format', '0', 'yes');
INSERT INTO `gtek_options` VALUES (86, 'link_manager_enabled', '0', 'yes');
INSERT INTO `gtek_options` VALUES (87, 'finished_splitting_shared_terms', '1', 'yes');
INSERT INTO `gtek_options` VALUES (88, 'site_icon', '0', 'yes');
INSERT INTO `gtek_options` VALUES (89, 'medium_large_size_w', '768', 'yes');
INSERT INTO `gtek_options` VALUES (90, 'medium_large_size_h', '0', 'yes');
INSERT INTO `gtek_options` VALUES (91, 'wp_page_for_privacy_policy', '3', 'yes');
INSERT INTO `gtek_options` VALUES (92, 'show_comments_cookies_opt_in', '0', 'yes');
INSERT INTO `gtek_options` VALUES (93, 'initial_db_version', '43764', 'yes');
INSERT INTO `gtek_options` VALUES (94, 'gtek_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes');
INSERT INTO `gtek_options` VALUES (95, 'fresh_site', '0', 'yes');
INSERT INTO `gtek_options` VALUES (96, 'WPLANG', 'en_GB', 'yes');
INSERT INTO `gtek_options` VALUES (97, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (98, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (99, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (100, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (101, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (102, 'sidebars_widgets', 'a:2:{s:19:\"wp_inactive_widgets\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:13:\"array_version\";i:3;}', 'yes');
INSERT INTO `gtek_options` VALUES (103, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (104, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (105, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (106, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (107, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (108, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (109, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (110, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (111, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `gtek_options` VALUES (112, 'cron', 'a:6:{i:1548377196;a:4:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1548377205;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1549126996;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1550098529;a:1:{s:8:\"do_pings\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:2:{s:8:\"schedule\";b:0;s:4:\"args\";a:0:{}}}}i:1550934404;a:1:{s:26:\"upgrader_scheduled_cleanup\";a:1:{s:32:\"06af60c6e0901957ae8f96f8dfd25e60\";a:2:{s:8:\"schedule\";b:0;s:4:\"args\";a:1:{i:0;i:32;}}}}s:7:\"version\";i:2;}', 'yes');
INSERT INTO `gtek_options` VALUES (134, 'theme_mods_twentynineteen', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1548444282;s:4:\"data\";a:2:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}}}}', 'yes');
INSERT INTO `gtek_options` VALUES (149, 'current_theme', 'GTEK Base Theme', 'yes');
INSERT INTO `gtek_options` VALUES (150, 'theme_mods_globotek', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}', 'yes');
INSERT INTO `gtek_options` VALUES (151, 'theme_switched', '', 'yes');
INSERT INTO `gtek_options` VALUES (154, 'new_admin_email', 'matthew@globotek.net', 'yes');
INSERT INTO `gtek_options` VALUES (203, 'recently_activated', 'a:1:{s:17:\"chumly/chumly.php\";i:1550928900;}', 'yes');
INSERT INTO `gtek_options` VALUES (246, 'acf_version', '5.7.12', 'yes');
INSERT INTO `gtek_options` VALUES (249, 'acf_pro_license', 'YToyOntzOjM6ImtleSI7czo3MjoiYjNKa1pYSmZhV1E5TlRVeU1ESjhkSGx3WlQxa1pYWmxiRzl3WlhKOFpHRjBaVDB5TURFMUxUQTBMVE13SURFeE9qTTBPak0wIjtzOjM6InVybCI7czoyMToiaHR0cDovL2dsb2JvdGVrLmxvY2FsIjt9', 'yes');
INSERT INTO `gtek_options` VALUES (258, 'db_upgraded', '', 'yes');
INSERT INTO `gtek_options` VALUES (262, 'can_compress_scripts', '0', 'no');
INSERT INTO `gtek_options` VALUES (281, '_transient_doing_cron', '1553852292.9388139247894287109375', 'yes');

-- ----------------------------
-- Table structure for gtek_postmeta
-- ----------------------------
DROP TABLE IF EXISTS `gtek_postmeta`;
CREATE TABLE `gtek_postmeta`  (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL,
  PRIMARY KEY (`meta_id`) USING BTREE,
  INDEX `post_id`(`post_id`) USING BTREE,
  INDEX `meta_key`(`meta_key`(191)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_postmeta
-- ----------------------------
INSERT INTO `gtek_postmeta` VALUES (1, 2, '_wp_page_template', 'default');
INSERT INTO `gtek_postmeta` VALUES (2, 3, '_wp_page_template', 'default');
INSERT INTO `gtek_postmeta` VALUES (3, 3, '_edit_lock', '1548377121:1');
INSERT INTO `gtek_postmeta` VALUES (4, 1, '_edit_lock', '1548454030:1');
INSERT INTO `gtek_postmeta` VALUES (5, 2, '_edit_lock', '1548462980:1');
INSERT INTO `gtek_postmeta` VALUES (6, 6, '_edit_lock', '1549126872:1');
INSERT INTO `gtek_postmeta` VALUES (7, 8, '_edit_lock', '1550099160:1');
INSERT INTO `gtek_postmeta` VALUES (8, 8, '_encloseme', '1');
INSERT INTO `gtek_postmeta` VALUES (9, 23, '_edit_last', '1');
INSERT INTO `gtek_postmeta` VALUES (10, 23, '_edit_lock', '1551531288:1');
INSERT INTO `gtek_postmeta` VALUES (11, 24, '_edit_last', '1');
INSERT INTO `gtek_postmeta` VALUES (12, 24, '_edit_lock', '1550574280:1');
INSERT INTO `gtek_postmeta` VALUES (13, 25, '_edit_last', '1');
INSERT INTO `gtek_postmeta` VALUES (14, 25, '_edit_lock', '1550521908:1');
INSERT INTO `gtek_postmeta` VALUES (15, 26, '_edit_lock', '1550518955:1');
INSERT INTO `gtek_postmeta` VALUES (16, 26, '_wp_page_template', 'archive-portfolio.php');
INSERT INTO `gtek_postmeta` VALUES (17, 28, '_wp_attached_file', '2019/02/poweryoga-banner-min.png');
INSERT INTO `gtek_postmeta` VALUES (18, 28, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1360;s:6:\"height\";i:487;s:4:\"file\";s:32:\"2019/02/poweryoga-banner-min.png\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:32:\"poweryoga-banner-min-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:32:\"poweryoga-banner-min-300x107.png\";s:5:\"width\";i:300;s:6:\"height\";i:107;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:32:\"poweryoga-banner-min-768x275.png\";s:5:\"width\";i:768;s:6:\"height\";i:275;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:33:\"poweryoga-banner-min-1024x367.png\";s:5:\"width\";i:1024;s:6:\"height\";i:367;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}');
INSERT INTO `gtek_postmeta` VALUES (19, 23, '_thumbnail_id', '28');
INSERT INTO `gtek_postmeta` VALUES (23, 30, '_wp_attached_file', '2019/02/roomiematch-banner-min.png');
INSERT INTO `gtek_postmeta` VALUES (24, 30, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1359;s:6:\"height\";i:485;s:4:\"file\";s:34:\"2019/02/roomiematch-banner-min.png\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:34:\"roomiematch-banner-min-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:34:\"roomiematch-banner-min-300x107.png\";s:5:\"width\";i:300;s:6:\"height\";i:107;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:34:\"roomiematch-banner-min-768x274.png\";s:5:\"width\";i:768;s:6:\"height\";i:274;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:35:\"roomiematch-banner-min-1024x365.png\";s:5:\"width\";i:1024;s:6:\"height\";i:365;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}');
INSERT INTO `gtek_postmeta` VALUES (25, 25, '_thumbnail_id', '30');
INSERT INTO `gtek_postmeta` VALUES (26, 31, '_wp_attached_file', '2019/02/scraptastic-banner-min.png');
INSERT INTO `gtek_postmeta` VALUES (27, 31, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1360;s:6:\"height\";i:487;s:4:\"file\";s:34:\"2019/02/scraptastic-banner-min.png\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:34:\"scraptastic-banner-min-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:34:\"scraptastic-banner-min-300x107.png\";s:5:\"width\";i:300;s:6:\"height\";i:107;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:34:\"scraptastic-banner-min-768x275.png\";s:5:\"width\";i:768;s:6:\"height\";i:275;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:35:\"scraptastic-banner-min-1024x367.png\";s:5:\"width\";i:1024;s:6:\"height\";i:367;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}');
INSERT INTO `gtek_postmeta` VALUES (28, 24, '_thumbnail_id', '31');
INSERT INTO `gtek_postmeta` VALUES (31, 33, '_edit_last', '1');
INSERT INTO `gtek_postmeta` VALUES (32, 33, '_edit_lock', '1551531461:1');
INSERT INTO `gtek_postmeta` VALUES (33, 23, 'provided_services_content_0_service_image', '28');
INSERT INTO `gtek_postmeta` VALUES (34, 23, '_provided_services_content_0_service_image', 'field_5c714712d3b79');
INSERT INTO `gtek_postmeta` VALUES (35, 23, 'provided_services_content_0_service', 'a:1:{i:0;s:1:\"2\";}');
INSERT INTO `gtek_postmeta` VALUES (36, 23, '_provided_services_content_0_service', 'field_5c71459a23499');
INSERT INTO `gtek_postmeta` VALUES (37, 23, 'provided_services_content_0_service_content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum \r\npharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ');
INSERT INTO `gtek_postmeta` VALUES (38, 23, '_provided_services_content_0_service_content', 'field_5c71472ed3b7a');
INSERT INTO `gtek_postmeta` VALUES (39, 23, 'provided_services_content_1_service_image', '28');
INSERT INTO `gtek_postmeta` VALUES (40, 23, '_provided_services_content_1_service_image', 'field_5c714712d3b79');
INSERT INTO `gtek_postmeta` VALUES (41, 23, 'provided_services_content_1_service', 'a:1:{i:0;s:1:\"3\";}');
INSERT INTO `gtek_postmeta` VALUES (42, 23, '_provided_services_content_1_service', 'field_5c71459a23499');
INSERT INTO `gtek_postmeta` VALUES (43, 23, 'provided_services_content_1_service_content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum \r\npharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ');
INSERT INTO `gtek_postmeta` VALUES (44, 23, '_provided_services_content_1_service_content', 'field_5c71472ed3b7a');
INSERT INTO `gtek_postmeta` VALUES (45, 23, 'provided_services_content_2_service_image', '28');
INSERT INTO `gtek_postmeta` VALUES (46, 23, '_provided_services_content_2_service_image', 'field_5c714712d3b79');
INSERT INTO `gtek_postmeta` VALUES (47, 23, 'provided_services_content_2_service', 'a:1:{i:0;s:1:\"4\";}');
INSERT INTO `gtek_postmeta` VALUES (48, 23, '_provided_services_content_2_service', 'field_5c71459a23499');
INSERT INTO `gtek_postmeta` VALUES (49, 23, 'provided_services_content_2_service_content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum \r\npharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ');
INSERT INTO `gtek_postmeta` VALUES (50, 23, '_provided_services_content_2_service_content', 'field_5c71472ed3b7a');
INSERT INTO `gtek_postmeta` VALUES (51, 23, 'provided_services_content', '3');
INSERT INTO `gtek_postmeta` VALUES (52, 23, '_provided_services_content', 'field_5c71458c23498');

-- ----------------------------
-- Table structure for gtek_posts
-- ----------------------------
DROP TABLE IF EXISTS `gtek_posts`;
CREATE TABLE `gtek_posts`  (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime(0) NOT NULL,
  `post_date_gmt` datetime(0) NOT NULL,
  `post_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime(0) NOT NULL,
  `post_modified_gmt` datetime(0) NOT NULL,
  `post_content_filtered` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `post_name`(`post_name`(191)) USING BTREE,
  INDEX `type_status_date`(`post_type`, `post_status`, `post_date`, `ID`) USING BTREE,
  INDEX `post_parent`(`post_parent`) USING BTREE,
  INDEX `post_author`(`post_author`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_posts
-- ----------------------------
INSERT INTO `gtek_posts` VALUES (1, 1, '2019-01-25 00:46:29', '2019-01-25 00:46:29', '<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2019-01-25 00:46:29', '2019-01-25 00:46:29', '', 0, 'https://globotek.local/?p=1', 0, 'post', '', 1);
INSERT INTO `gtek_posts` VALUES (2, 1, '2019-01-25 00:46:29', '2019-01-25 00:46:29', '<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like piña coladas. (And gettin\' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"https://globotek.local/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->', 'Home', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2019-01-25 22:11:02', '2019-01-25 22:11:02', '', 0, 'https://globotek.local/?page_id=2', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (3, 1, '2019-01-25 00:46:29', '2019-01-25 00:46:29', '<!-- wp:heading --><h2>Who we are</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Our website address is: https://globotek.local.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What personal data we collect and why we collect it</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Comments</h3><!-- /wp:heading --><!-- wp:paragraph --><p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>An anonymised string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Media</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Contact forms</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Cookies</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you have an account and you log in to this site, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Embedded content from other websites</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Analytics</h3><!-- /wp:heading --><!-- wp:heading --><h2>Who we share your data with</h2><!-- /wp:heading --><!-- wp:heading --><h2>How long we retain your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognise and approve any follow-up comments automatically instead of holding them in a moderation queue.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What rights you have over your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Where we send your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Visitor comments may be checked through an automated spam detection service.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Your contact information</h2><!-- /wp:heading --><!-- wp:heading --><h2>Additional information</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>How we protect your data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What data breach procedures we have in place</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What third parties we receive data from</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What automated decision making and/or profiling we do with user data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Industry regulatory disclosure requirements</h3><!-- /wp:heading -->', 'Privacy Policy', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2019-01-25 00:46:29', '2019-01-25 00:46:29', '', 0, 'https://globotek.local/?page_id=3', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (4, 1, '2019-01-25 00:46:48', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2019-01-25 00:46:48', '0000-00-00 00:00:00', '', 0, 'https://globotek.local/?p=4', 0, 'post', '', 0);
INSERT INTO `gtek_posts` VALUES (5, 1, '2019-01-25 22:11:02', '2019-01-25 22:11:02', '<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like piña coladas. (And gettin\' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"https://globotek.local/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->', 'Home', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2019-01-25 22:11:02', '2019-01-25 22:11:02', '', 2, 'http://globotek.local/2-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `gtek_posts` VALUES (6, 1, '2019-02-02 17:03:34', '2019-02-02 17:03:34', '', 'Page', '', 'publish', 'closed', 'closed', '', 'page', '', '', '2019-02-02 17:03:34', '2019-02-02 17:03:34', '', 0, 'http://globotek.local/?page_id=6', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (7, 1, '2019-02-02 17:03:34', '2019-02-02 17:03:34', '', 'Page', '', 'inherit', 'closed', 'closed', '', '6-revision-v1', '', '', '2019-02-02 17:03:34', '2019-02-02 17:03:34', '', 6, 'http://globotek.local/6-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `gtek_posts` VALUES (8, 1, '2019-02-13 22:55:28', '2019-02-13 22:55:28', '', 'Sales Anxiety - Don\'t panic!', '', 'publish', 'open', 'open', '', 'sales-anxiety-dont-panic', '', '', '2019-02-13 22:55:28', '2019-02-13 22:55:28', '', 0, 'http://globotek.local/?p=8', 0, 'post', '', 0);
INSERT INTO `gtek_posts` VALUES (9, 1, '2019-02-13 22:55:28', '2019-02-13 22:55:28', '', 'Sales Anxiety - Don\'t panic!', '', 'inherit', 'closed', 'closed', '', '8-revision-v1', '', '', '2019-02-13 22:55:28', '2019-02-13 22:55:28', '', 8, 'http://globotek.local/8-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `gtek_posts` VALUES (10, 1, '2019-02-13 23:43:46', '2019-02-13 23:43:46', '[chumly_registration]', 'Register', '', 'publish', 'closed', 'closed', '', 'register', '', '', '2019-02-13 23:43:46', '2019-02-13 23:43:46', '', 0, 'http://globotek.local/register/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (11, 1, '2019-02-13 23:43:46', '2019-02-13 23:43:46', '[chumly_login]', 'Login', '', 'publish', 'closed', 'closed', '', 'login', '', '', '2019-02-13 23:43:46', '2019-02-13 23:43:46', '', 0, 'http://globotek.local/login/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (12, 1, '2019-02-13 23:43:46', '2019-02-13 23:43:46', '[chumly_members]', 'Members', '', 'publish', 'closed', 'closed', '', 'members', '', '', '2019-02-13 23:43:46', '2019-02-13 23:43:46', '', 0, 'http://globotek.local/members/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (13, 1, '2019-02-13 23:43:47', '2019-02-13 23:43:47', '[chumly_user_profile]', 'Profile', '', 'publish', 'closed', 'closed', '', 'profile', '', '', '2019-02-13 23:43:47', '2019-02-13 23:43:47', '', 0, 'http://globotek.local/profile/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (14, 1, '2019-02-13 23:43:47', '2019-02-13 23:43:47', '[chumly_edit_profile]', 'Edit Profile', '', 'publish', 'closed', 'closed', '', 'edit', '', '', '2019-02-13 23:43:47', '2019-02-13 23:43:47', '', 13, 'http://globotek.local/profile/edit/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (15, 1, '2019-02-13 23:43:47', '2019-02-13 23:43:47', '[chumly_groups]', 'Groups', '', 'publish', 'closed', 'closed', '', 'groups', '', '', '2019-02-13 23:43:47', '2019-02-13 23:43:47', '', 0, 'http://globotek.local/groups/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (16, 1, '2019-02-13 23:43:47', '2019-02-13 23:43:47', '[chumly_group_profile]', 'Group', '', 'publish', 'closed', 'closed', '', 'group', '', '', '2019-02-13 23:43:47', '2019-02-13 23:43:47', '', 0, 'http://globotek.local/group/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (17, 1, '2019-02-13 23:43:47', '2019-02-13 23:43:47', '[chumly_create_group]', 'Create Group', '', 'publish', 'closed', 'closed', '', 'create-group', '', '', '2019-02-13 23:43:47', '2019-02-13 23:43:47', '', 16, 'http://globotek.local/group/create-group/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (18, 1, '2019-02-13 23:43:47', '2019-02-13 23:43:47', '[chumly_edit_group]', 'Edit Group', '', 'publish', 'closed', 'closed', '', 'edit', '', '', '2019-02-13 23:43:47', '2019-02-13 23:43:47', '', 16, 'http://globotek.local/group/edit/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (19, 1, '2019-02-13 23:43:48', '2019-02-13 23:43:48', '[chumly_messaging]', 'Messaging', '', 'publish', 'closed', 'closed', '', 'messaging', '', '', '2019-02-13 23:43:48', '2019-02-13 23:43:48', '', 0, 'http://globotek.local/messaging/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (20, 1, '2019-02-13 23:43:48', '2019-02-13 23:43:48', '[chumly_notifications]', 'Notifications', '', 'publish', 'closed', 'closed', '', 'notifications', '', '', '2019-02-13 23:43:48', '2019-02-13 23:43:48', '', 0, 'http://globotek.local/notifications/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (21, 1, '2019-02-13 23:43:48', '2019-02-13 23:43:48', '[chumly_dashboard]', 'Newsfeed', '', 'publish', 'closed', 'closed', '', 'newsfeed', '', '', '2019-02-13 23:43:48', '2019-02-13 23:43:48', '', 0, 'http://globotek.local/newsfeed/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (22, 1, '2019-02-13 23:43:48', '2019-02-13 23:43:48', '', 'User Preferences', '', 'publish', 'closed', 'closed', '', 'user-preferences', '', '', '2019-02-13 23:43:48', '2019-02-13 23:43:48', '', 0, 'http://globotek.local/user-preferences/', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (23, 1, '2019-02-18 19:46:39', '2019-02-18 19:46:39', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Power Yoga', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. \r\nCurabitur et vestibulum arcu. ', 'publish', 'closed', 'closed', '', 'power-yoga', '', '', '2019-02-23 13:18:13', '2019-02-23 13:18:13', '', 0, 'http://globotek.local/?post_type=portfolio&#038;p=23', 0, 'portfolio', '', 0);
INSERT INTO `gtek_posts` VALUES (24, 1, '2019-02-18 19:46:38', '2019-02-18 19:46:38', '', 'Scraptastic Club', '', 'publish', 'closed', 'closed', '', 'scraptastic-club', '', '', '2019-02-18 20:34:28', '2019-02-18 20:34:28', '', 0, 'http://globotek.local/?post_type=portfolio&#038;p=24', 0, 'portfolio', '', 0);
INSERT INTO `gtek_posts` VALUES (25, 1, '2019-02-18 19:46:26', '2019-02-18 19:46:26', '', 'Roomiematch', '', 'publish', 'closed', 'closed', '', 'roomiematch', '', '', '2019-02-18 20:32:53', '2019-02-18 20:32:53', '', 0, 'http://globotek.local/?post_type=portfolio&#038;p=25', 0, 'portfolio', '', 0);
INSERT INTO `gtek_posts` VALUES (26, 1, '2019-02-18 19:44:39', '2019-02-18 19:44:39', '', 'Our Work', '', 'publish', 'closed', 'closed', '', 'portfolio', '', '', '2019-02-18 19:44:57', '2019-02-18 19:44:57', '', 0, 'http://globotek.local/?page_id=26', 0, 'page', '', 0);
INSERT INTO `gtek_posts` VALUES (27, 1, '2019-02-18 19:44:39', '2019-02-18 19:44:39', '', 'Our Work', '', 'inherit', 'closed', 'closed', '', '26-revision-v1', '', '', '2019-02-18 19:44:39', '2019-02-18 19:44:39', '', 26, 'http://globotek.local/26-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `gtek_posts` VALUES (28, 1, '2019-02-18 19:52:28', '2019-02-18 19:52:28', '', 'poweryoga-banner-min', '', 'inherit', 'open', 'closed', '', 'poweryoga-banner-min', '', '', '2019-02-18 19:52:28', '2019-02-18 19:52:28', '', 23, 'http://globotek.local/wp-content/uploads/2019/02/poweryoga-banner-min.png', 0, 'attachment', 'image/png', 0);
INSERT INTO `gtek_posts` VALUES (30, 1, '2019-02-18 20:32:48', '2019-02-18 20:32:48', '', 'roomiematch-banner-min', '', 'inherit', 'open', 'closed', '', 'roomiematch-banner-min', '', '', '2019-02-18 20:32:48', '2019-02-18 20:32:48', '', 25, 'http://globotek.local/wp-content/uploads/2019/02/roomiematch-banner-min.png', 0, 'attachment', 'image/png', 0);
INSERT INTO `gtek_posts` VALUES (31, 1, '2019-02-18 20:34:23', '2019-02-18 20:34:23', '', 'scraptastic-banner-min', '', 'inherit', 'open', 'closed', '', 'scraptastic-banner-min', '', '', '2019-02-18 20:34:23', '2019-02-18 20:34:23', '', 24, 'http://globotek.local/wp-content/uploads/2019/02/scraptastic-banner-min.png', 0, 'attachment', 'image/png', 0);
INSERT INTO `gtek_posts` VALUES (33, 1, '2019-02-23 13:10:54', '2019-02-23 13:10:54', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:9:\"portfolio\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Portfolio Item', 'portfolio-item', 'publish', 'closed', 'closed', '', 'group_5c71458647a6c', '', '', '2019-03-02 12:57:40', '2019-03-02 12:57:40', '', 0, 'http://globotek.local/?post_type=acf-field-group&#038;p=33', 0, 'acf-field-group', '', 0);
INSERT INTO `gtek_posts` VALUES (34, 1, '2019-02-23 13:10:54', '2019-02-23 13:10:54', 'a:10:{s:4:\"type\";s:8:\"repeater\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:9:\"collapsed\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:6:\"layout\";s:5:\"table\";s:12:\"button_label\";s:0:\"\";}', 'Provided Services Content', 'provided_services_content', 'publish', 'closed', 'closed', '', 'field_5c71458c23498', '', '', '2019-03-02 12:57:40', '2019-03-02 12:57:40', '', 33, 'http://globotek.local/?post_type=acf-field&#038;p=34', 0, 'acf-field', '', 0);
INSERT INTO `gtek_posts` VALUES (35, 1, '2019-02-23 13:10:55', '2019-02-23 13:10:55', 'a:13:{s:4:\"type\";s:8:\"taxonomy\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:8:\"taxonomy\";s:8:\"services\";s:10:\"field_type\";s:8:\"checkbox\";s:8:\"add_term\";i:1;s:10:\"save_terms\";i:1;s:10:\"load_terms\";i:0;s:13:\"return_format\";s:6:\"object\";s:8:\"multiple\";i:0;s:10:\"allow_null\";i:0;}', 'Service', 'service', 'publish', 'closed', 'closed', '', 'field_5c71459a23499', '', '', '2019-03-02 12:57:40', '2019-03-02 12:57:40', '', 34, 'http://globotek.local/?post_type=acf-field&#038;p=35', 1, 'acf-field', '', 0);
INSERT INTO `gtek_posts` VALUES (36, 1, '2019-02-23 13:14:44', '2019-02-23 13:14:44', 'a:15:{s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"return_format\";s:5:\"array\";s:12:\"preview_size\";s:9:\"thumbnail\";s:7:\"library\";s:3:\"all\";s:9:\"min_width\";s:0:\"\";s:10:\"min_height\";s:0:\"\";s:8:\"min_size\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:10:\"max_height\";s:0:\"\";s:8:\"max_size\";s:0:\"\";s:10:\"mime_types\";s:0:\"\";}', 'Service Image', 'service_image', 'publish', 'closed', 'closed', '', 'field_5c714712d3b79', '', '', '2019-02-23 13:16:33', '2019-02-23 13:16:33', '', 34, 'http://globotek.local/?post_type=acf-field&#038;p=36', 0, 'acf-field', '', 0);
INSERT INTO `gtek_posts` VALUES (37, 1, '2019-02-23 13:14:45', '2019-02-23 13:14:45', 'a:10:{s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"new_lines\";s:7:\"wpautop\";}', 'Logo Design', 'service_content', 'publish', 'closed', 'closed', '', 'field_5c71472ed3b7a', '', '', '2019-02-23 13:17:49', '2019-02-23 13:17:49', '', 34, 'http://globotek.local/?post_type=acf-field&#038;p=37', 2, 'acf-field', '', 0);

-- ----------------------------
-- Table structure for gtek_term_relationships
-- ----------------------------
DROP TABLE IF EXISTS `gtek_term_relationships`;
CREATE TABLE `gtek_term_relationships`  (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`object_id`, `term_taxonomy_id`) USING BTREE,
  INDEX `term_taxonomy_id`(`term_taxonomy_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_term_relationships
-- ----------------------------
INSERT INTO `gtek_term_relationships` VALUES (1, 1, 0);
INSERT INTO `gtek_term_relationships` VALUES (8, 1, 0);
INSERT INTO `gtek_term_relationships` VALUES (23, 2, 0);
INSERT INTO `gtek_term_relationships` VALUES (23, 3, 0);
INSERT INTO `gtek_term_relationships` VALUES (23, 4, 0);

-- ----------------------------
-- Table structure for gtek_term_taxonomy
-- ----------------------------
DROP TABLE IF EXISTS `gtek_term_taxonomy`;
CREATE TABLE `gtek_term_taxonomy`  (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_taxonomy_id`) USING BTREE,
  UNIQUE INDEX `term_id_taxonomy`(`term_id`, `taxonomy`) USING BTREE,
  INDEX `taxonomy`(`taxonomy`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_term_taxonomy
-- ----------------------------
INSERT INTO `gtek_term_taxonomy` VALUES (1, 1, 'category', '', 0, 2);
INSERT INTO `gtek_term_taxonomy` VALUES (2, 2, 'services', '', 0, 1);
INSERT INTO `gtek_term_taxonomy` VALUES (3, 3, 'services', '', 0, 1);
INSERT INTO `gtek_term_taxonomy` VALUES (4, 4, 'services', '', 0, 1);

-- ----------------------------
-- Table structure for gtek_termmeta
-- ----------------------------
DROP TABLE IF EXISTS `gtek_termmeta`;
CREATE TABLE `gtek_termmeta`  (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL,
  PRIMARY KEY (`meta_id`) USING BTREE,
  INDEX `term_id`(`term_id`) USING BTREE,
  INDEX `meta_key`(`meta_key`(191)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for gtek_terms
-- ----------------------------
DROP TABLE IF EXISTS `gtek_terms`;
CREATE TABLE `gtek_terms`  (
  `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`) USING BTREE,
  INDEX `slug`(`slug`(191)) USING BTREE,
  INDEX `name`(`name`(191)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_terms
-- ----------------------------
INSERT INTO `gtek_terms` VALUES (1, 'Uncategorised', 'uncategorised', 0);
INSERT INTO `gtek_terms` VALUES (2, 'Logo Design', 'logo-design', 0);
INSERT INTO `gtek_terms` VALUES (3, 'Web Design', 'web-design', 0);
INSERT INTO `gtek_terms` VALUES (4, 'Branding', 'branding', 0);

-- ----------------------------
-- Table structure for gtek_usermeta
-- ----------------------------
DROP TABLE IF EXISTS `gtek_usermeta`;
CREATE TABLE `gtek_usermeta`  (
  `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL,
  PRIMARY KEY (`umeta_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `meta_key`(`meta_key`(191)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_usermeta
-- ----------------------------
INSERT INTO `gtek_usermeta` VALUES (1, 1, 'nickname', 'matthew');
INSERT INTO `gtek_usermeta` VALUES (2, 1, 'first_name', '');
INSERT INTO `gtek_usermeta` VALUES (3, 1, 'last_name', '');
INSERT INTO `gtek_usermeta` VALUES (4, 1, 'description', '');
INSERT INTO `gtek_usermeta` VALUES (5, 1, 'rich_editing', 'true');
INSERT INTO `gtek_usermeta` VALUES (6, 1, 'syntax_highlighting', 'true');
INSERT INTO `gtek_usermeta` VALUES (7, 1, 'comment_shortcuts', 'false');
INSERT INTO `gtek_usermeta` VALUES (8, 1, 'admin_color', 'fresh');
INSERT INTO `gtek_usermeta` VALUES (9, 1, 'use_ssl', '0');
INSERT INTO `gtek_usermeta` VALUES (10, 1, 'show_admin_bar_front', 'true');
INSERT INTO `gtek_usermeta` VALUES (11, 1, 'locale', '');
INSERT INTO `gtek_usermeta` VALUES (12, 1, 'gtek_capabilities', 'a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `gtek_usermeta` VALUES (13, 1, 'gtek_user_level', '10');
INSERT INTO `gtek_usermeta` VALUES (14, 1, 'dismissed_wp_pointers', 'wp496_privacy');
INSERT INTO `gtek_usermeta` VALUES (15, 1, 'show_welcome_panel', '1');
INSERT INTO `gtek_usermeta` VALUES (17, 1, 'gtek_dashboard_quick_press_last_post_id', '4');
INSERT INTO `gtek_usermeta` VALUES (18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:11:\"192.168.1.0\";}');
INSERT INTO `gtek_usermeta` VALUES (19, 1, '_chumly_user_role', 'default');
INSERT INTO `gtek_usermeta` VALUES (20, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}');
INSERT INTO `gtek_usermeta` VALUES (21, 1, 'metaboxhidden_nav-menus', 'a:14:{i:0;s:15:\"chumly_nav_menu\";i:1;s:23:\"add-post-type-portfolio\";i:2;s:31:\"add-post-type-chumly_user_media\";i:3;s:27:\"add-post-type-chumly_groups\";i:4;s:32:\"add-post-type-chumly_status_post\";i:5;s:34:\"add-post-type-chumly_group_message\";i:6;s:27:\"add-post-type-chumly_shared\";i:7;s:12:\"add-post_tag\";i:8;s:15:\"add-post_format\";i:9;s:31:\"add-chumly_media_classification\";i:10;s:22:\"add-chumly_post_target\";i:11;s:17:\"add-chumly_linked\";i:12;s:23:\"add-chumly_target_group\";i:13;s:22:\"add-chumly_post_format\";}');
INSERT INTO `gtek_usermeta` VALUES (22, 1, 'gtek_user-settings', 'libraryContent=browse');
INSERT INTO `gtek_usermeta` VALUES (23, 1, 'gtek_user-settings-time', '1550519552');
INSERT INTO `gtek_usermeta` VALUES (24, 1, 'session_tokens', 'a:1:{s:64:\"b90c29f20d888aff2622ec0b789c5070be3258d4a90d29043087e35fe3e7ccae\";a:4:{s:10:\"expiration\";i:1551704067;s:2:\"ip\";s:12:\"192.168.1.83\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36\";s:5:\"login\";i:1551531267;}}');

-- ----------------------------
-- Table structure for gtek_users
-- ----------------------------
DROP TABLE IF EXISTS `gtek_users`;
CREATE TABLE `gtek_users`  (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime(0) NOT NULL,
  `user_activation_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `user_login_key`(`user_login`) USING BTREE,
  INDEX `user_nicename`(`user_nicename`) USING BTREE,
  INDEX `user_email`(`user_email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gtek_users
-- ----------------------------
INSERT INTO `gtek_users` VALUES (1, 'matthew', '$P$BUURbCmMvEararwNBEZx3iijGVpU.H.', 'matthew', 'matthew@globotek.net', '', '2019-01-25 00:46:27', '', 0, 'matthew');

SET FOREIGN_KEY_CHECKS = 1;
