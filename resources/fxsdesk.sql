/*
 Navicat Premium Data Transfer

 Source Server         : LocalHost
 Source Server Type    : MySQL
 Source Server Version : 50529
 Source Host           : localhost
 Source Database       : fxsdesk

 Target Server Type    : MySQL
 Target Server Version : 50529
 File Encoding         : utf-8

 Date: 08/21/2013 19:02:24 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `contents`
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` text,
  `url_name` text,
  `page_content` text,
  `page_title` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `contents`
-- ----------------------------
BEGIN;
INSERT INTO `contents` VALUES ('3', 'Trading Conditions', 'trading_conditions', '<p>Content awaiting for updates..</p>\r\n', 'Trading Conditions', '2013-07-29 15:36:59', '2013-07-29 15:36:59'), ('4', 'Financial Channel', 'finance_channel', '<div class=\"row-fluid\">\r\n    <div class=\"span6\">\r\n        <div class=\"box box-small box-bordered\">\r\n            <div class=\"box-title\">\r\n                <h3>\r\n                    Bank Transfer\r\n                </h3>\r\n                <div class=\"actions\">\r\n                    &nbsp;\r\n                </div>\r\n            </div>\r\n            <div class=\"box-content\">\r\n                <img src=\"https://live.iktrust.com/img/payment_channel/bt_150x100.png\" alt=\"Bank Transfer\" class=\"pull-left\" style=\'margin-right:10px\'>\r\n                Lorem ipsum velit dolor veniam occaecat do eiusmod velit cillum sit. Lorem ipsum laborum sed Duis in in dolor in exercitation irure. Lorem ipsum ad proident ut in mollit id ullamco Ut. Lorem ipsum magna eiusmod in anim deserunt adipisicing. Lorem ipsum ex dolore sint consectetur eu non mollit Ut dolore aliquip anim. Lorem ipsum labore ad Ut Duis Excepteur consequat non.\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"span6\">\r\n        <div class=\"box box-small box-bordered\">\r\n            <div class=\"box-title\">\r\n                <h3>\r\n                    Credit Card\r\n                </h3>\r\n                <div class=\"actions\">\r\n                    &nbsp;\r\n                </div>\r\n            </div>\r\n            <div class=\"box-content\">\r\n                <img src=\"https://live.iktrust.com/img/payment_channel/cc_150x100.png\" alt=\"Credit Card\" class=\"pull-left\" style=\'margin-right:10px\'>\r\n                Lorem ipsum velit dolor veniam occaecat do eiusmod velit cillum sit. Lorem ipsum laborum sed Duis in in dolor in exercitation irure. Lorem ipsum ad proident ut in mollit id ullamco Ut. Lorem ipsum magna eiusmod in anim deserunt adipisicing. Lorem ipsum ex dolore sint consectetur eu non mollit Ut dolore aliquip anim. Lorem ipsum labore ad Ut Duis Excepteur consequat non.\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<div class=\"row-fluid\">\r\n    <div class=\"span6\">\r\n        <div class=\"box box-small box-bordered\">\r\n            <div class=\"box-title\">\r\n                <h3>\r\n                    Webmoney\r\n                </h3>\r\n                <div class=\"actions\">\r\n                    &nbsp;\r\n                </div>\r\n            </div>\r\n            <div class=\"box-content\">\r\n                <img src=\"https://live.iktrust.com/img/payment_channel/wm_150x100.png\" alt=\"Webmoney\" class=\"pull-left\" style=\'margin-right:10px\'>\r\n                Lorem ipsum velit dolor veniam occaecat do eiusmod velit cillum sit. Lorem ipsum laborum sed Duis in in dolor in exercitation irure. Lorem ipsum ad proident ut in mollit id ullamco Ut. Lorem ipsum magna eiusmod in anim deserunt adipisicing. Lorem ipsum ex dolore sint consectetur eu non mollit Ut dolore aliquip anim. Lorem ipsum labore ad Ut Duis Excepteur consequat non.\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"span6\">\r\n        <div class=\"box box-small box-bordered\">\r\n            <div class=\"box-title\">\r\n                <h3>\r\n                    Perfect Money\r\n                </h3>\r\n                <div class=\"actions\">\r\n                    &nbsp;\r\n                </div>\r\n            </div>\r\n            <div class=\"box-content\">\r\n                <img src=\"https://live.iktrust.com/img/payment_channel/pm_150x100.png\" alt=\"Perfect Money\" class=\"pull-left\" style=\'margin-right:10px\'>\r\n                Lorem ipsum velit dolor veniam occaecat do eiusmod velit cillum sit. Lorem ipsum laborum sed Duis in in dolor in exercitation irure. Lorem ipsum ad proident ut in mollit id ullamco Ut. Lorem ipsum magna eiusmod in anim deserunt adipisicing. Lorem ipsum ex dolore sint consectetur eu non mollit Ut dolore aliquip anim. Lorem ipsum labore ad Ut Duis Excepteur consequat non.\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<div class=\"row-fluid\">\r\n    <div class=\"span6\">\r\n        <div class=\"box box-small box-bordered\">\r\n            <div class=\"box-title\">\r\n                <h3>\r\n                    IK Topup Card\r\n                </h3>\r\n                <div class=\"actions\">\r\n                    &nbsp;\r\n                </div>\r\n            </div>\r\n            <div class=\"box-content\">\r\n                <img src=\"https://live.iktrust.com/img/payment_channel/ik_150x100.png\" alt=\"IK Topup Card\" class=\"pull-left\" style=\'margin-right:10px\'>\r\n                Lorem ipsum velit dolor veniam occaecat do eiusmod velit cillum sit. Lorem ipsum laborum sed Duis in in dolor in exercitation irure. Lorem ipsum ad proident ut in mollit id ullamco Ut. Lorem ipsum magna eiusmod in anim deserunt adipisicing. Lorem ipsum ex dolore sint consectetur eu non mollit Ut dolore aliquip anim. Lorem ipsum labore ad Ut Duis Excepteur consequat non.\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"span6\">\r\n        <div class=\"box box-small box-bordered\">\r\n            <div class=\"box-title\">\r\n                <h3>\r\n                    Payza\r\n                </h3>\r\n                <div class=\"actions\">\r\n                    &nbsp;\r\n                </div>\r\n            </div>\r\n            <div class=\"box-content\">\r\n                <img src=\"https://live.iktrust.com/img/payment_channel/pz_150x100.png\" alt=\"Payza\" class=\"pull-left\" style=\'margin-right:10px\'>\r\n                Lorem ipsum velit dolor veniam occaecat do eiusmod velit cillum sit. Lorem ipsum laborum sed Duis in in dolor in exercitation irure. Lorem ipsum ad proident ut in mollit id ullamco Ut. Lorem ipsum magna eiusmod in anim deserunt adipisicing. Lorem ipsum ex dolore sint consectetur eu non mollit Ut dolore aliquip anim. Lorem ipsum labore ad Ut Duis Excepteur consequat non.\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', 'Financial Channel', '2013-08-05 15:02:04', '2013-08-05 15:35:09'), ('2', 'Trading Platform Downloads', 'downloads', '<p>Content awaiting for updates..</p>\r\n', 'Trading Platform Downloads', '2013-07-29 15:36:10', '2013-07-29 15:36:10');
COMMIT;

-- ----------------------------
--  Table structure for `login_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `login_tokens`;
CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `login_tokens`
-- ----------------------------
BEGIN;
INSERT INTO `login_tokens` VALUES ('8', '1', 'd15c0e3b019db40b3aa5480c507d5836', '2 weeks', '0', '2013-07-23 04:06:44', '2013-08-06 04:06:44');
COMMIT;

-- ----------------------------
--  Table structure for `schema_migrations`
-- ----------------------------
DROP TABLE IF EXISTS `schema_migrations`;
CREATE TABLE `schema_migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `schema_migrations`
-- ----------------------------
BEGIN;
INSERT INTO `schema_migrations` VALUES ('1', 'InitMigrations', 'Migrations', '2013-07-08 11:13:18'), ('2', 'ConvertVersionToClassNames', 'Migrations', '2013-07-08 11:13:18'), ('3', 'IncreaseClassNameLength', 'Migrations', '2013-07-08 11:13:18');
COMMIT;

-- ----------------------------
--  Table structure for `tmp_emails`
-- ----------------------------
DROP TABLE IF EXISTS `tmp_emails`;
CREATE TABLE `tmp_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `user_activities`
-- ----------------------------
DROP TABLE IF EXISTS `user_activities`;
CREATE TABLE `user_activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(256) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `last_action` int(10) DEFAULT NULL,
  `last_url` text,
  `logout_time` int(10) DEFAULT NULL,
  `user_browser` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `logout` int(11) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_activities`
-- ----------------------------
BEGIN;
INSERT INTO `user_activities` VALUES ('37', 'cdce2683e9eac29e8785553d4d1b8e7a', null, '1374571378', '/dashboard', null, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/536.30.1 (KHTML, like Gecko) Paparazzi!/0.6.7 (like Safari)', '127.0.0.1', '0', '0', '0', '2013-07-23 12:18:27', '2013-07-23 13:22:58'), ('6', '37ed60ab6ccc3eaa7fa013f9accd4afd', null, '1373449555', '/', null, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0', '10.60.5.46', '0', '0', '0', '2013-07-09 07:00:05', '2013-07-10 13:45:55'), ('10', 'd09b0d315b91625d225c048b55932504', null, '1373443345', '/', null, 'Mozilla/5.0 (iPad; CPU OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/27.0.1453.10 Mobile/10B329 Safari/8536.25', '172.16.18.33', '0', '0', '0', '2013-07-09 19:47:04', '2013-07-10 12:02:26'), ('14', 'ef9f6d70f1346f081cb9c84ad42a6d03', null, '1373385259', '/', null, 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/27.0.1453.10 Mobile/10B329 Safari/8536.25', '10.60.5.44', '0', '0', '0', '2013-07-09 19:48:46', '2013-07-09 19:54:19'), ('18', '833a9ac5a2970eb73de0e463a4f6c5b8', null, '1373443597', '/', null, 'Mozilla/5.0 (iPad; CPU OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25', '10.60.5.48', '0', '0', '0', '2013-07-10 12:03:29', '2013-07-10 12:06:37'), ('22', '', '0', '0', '/dashboard', null, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:22.0) Gecko/20100101 Firefox/22.0', '', '0', '0', '0', '2013-07-10 14:40:50', '2013-08-06 00:14:12'), ('36', 'cdce2683e9eac29e8785553d4d1b8e7a', null, '1374567507', '/dashboard', null, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/536.30.1 (KHTML, like Gecko) Paparazzi!/0.6.7 (like Safari)', '127.0.0.1', '0', '0', '0', '2013-07-23 12:18:27', '2013-07-23 12:18:27'), ('111', 'd0d3593887e37636471bd6ea6584f0bd', '5', '1376654564', '/Partners/vault', null, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '', '0', '0', '1', '2013-08-16 13:06:03', '2013-08-16 16:02:44'), ('112', '33e9653088ad88d7f21b5f144d628388', '4', '1376654231', '/TraderAccounts/overview/acc:6666', null, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:22.0) Gecko/20100101 Firefox/22.0', '', '0', '0', '1', '2013-08-16 15:42:17', '2013-08-16 15:57:11'), ('158', '521d7aec34e671d1ea480f326602db6d', '1', '1377096881', '/permissionGroupMatrix', null, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '', '0', '0', '1', '2013-08-21 17:12:51', '2013-08-21 18:54:41');
COMMIT;

-- ----------------------------
--  Table structure for `user_contacts`
-- ----------------------------
DROP TABLE IF EXISTS `user_contacts`;
CREATE TABLE `user_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `requirement` text,
  `reply_message` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `user_details`
-- ----------------------------
DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `photo` text,
  `bday` date DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `cellphone` varchar(15) DEFAULT NULL,
  `web_page` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_details`
-- ----------------------------
BEGIN;
INSERT INTO `user_details` VALUES ('1', '1', 'male', '1374558717240214778.png', '1986-01-30', '', 'single', '', '', '2013-07-08 17:19:45', '2013-07-23 13:51:57'), ('6', '6', 'male', null, null, '', null, '0136454002', '', '2013-08-14 14:11:31', '2013-08-20 12:53:33'), ('5', '5', 'male', null, null, '', null, '', '', '2013-08-14 11:36:51', '2013-08-19 14:39:50'), ('4', '4', null, null, null, null, null, null, null, '2013-08-01 16:29:46', '2013-08-01 16:29:46');
COMMIT;

-- ----------------------------
--  Table structure for `user_email_recipients`
-- ----------------------------
DROP TABLE IF EXISTS `user_email_recipients`;
CREATE TABLE `user_email_recipients` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_email_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `email_address` varchar(100) NOT NULL,
  `is_email_sent` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_email_recipients`
-- ----------------------------
BEGIN;
INSERT INTO `user_email_recipients` VALUES ('1', '1', null, 'arifsanchez@gmail.com', '0'), ('2', '2', null, 'arifsanchez@gmail.com', '0'), ('3', '3', '2', 'arifsanchez@gmail.com', '0'), ('4', '4', '2', 'arifsanchez@gmail.com', '1'), ('5', '5', '2', 'arifsanchez@gmail.com', '1');
COMMIT;

-- ----------------------------
--  Table structure for `user_email_signatures`
-- ----------------------------
DROP TABLE IF EXISTS `user_email_signatures`;
CREATE TABLE `user_email_signatures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `signature_name` varchar(100) NOT NULL,
  `signature` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `user_email_templates`
-- ----------------------------
DROP TABLE IF EXISTS `user_email_templates`;
CREATE TABLE `user_email_templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(100) NOT NULL,
  `header` text,
  `footer` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `user_emails`
-- ----------------------------
DROP TABLE IF EXISTS `user_emails`;
CREATE TABLE `user_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `user_group_id` varchar(256) DEFAULT NULL,
  `cc_to` text,
  `from_name` varchar(200) DEFAULT NULL,
  `from_email` varchar(200) DEFAULT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `sent_by` int(10) DEFAULT NULL,
  `is_email_sent` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_emails`
-- ----------------------------
BEGIN;
INSERT INTO `user_emails` VALUES ('1', 'MANUAL', null, '', 'IK Trust', 'support@iktrust.com', 'Testing postmarkapp API', '<p>Transaction as follow :</p>\r\n\r\n<p>Last login: Mon Jul 22 21:21:21 on ttys000<br />\r\nArifMBP-2:fxsdesk me$ cd /Users/me/Sites/<br />\r\nArifMBP-2:Sites me$ cd fxsdesk/<br />\r\nArifMBP-2:fxsdesk me$ git sumodule add https://github.com/maurymmarques/postmark-cakephp.git app/Plugin/Postmark<br />\r\ngit: &#39;sumodule&#39; is not a git command. See &#39;git --help&#39;.</p>\r\n\r\n<p>Did you mean this?<br />\r\n&nbsp;&nbsp; &nbsp;submodule<br />\r\nArifMBP-2:fxsdesk me$ git submodule add https://github.com/maurymmarques/postmark-cakephp.git app/Plugin/Postmark<br />\r\nCloning into &#39;app/Plugin/Postmark&#39;...<br />\r\nremote: Counting objects: 239, done.<br />\r\nremote: Compressing objects: 100% (123/123), done.<br />\r\nremote: Total 239 (delta 52), reused 238 (delta 51)<br />\r\nReceiving objects: 100% (239/239), 52.90 KiB | 64 KiB/s, done.<br />\r\nResolving deltas: 100% (52/52), done.<br />\r\nArifMBP-2:fxsdesk me$</p>\r\n', '1', '0', '2013-07-24 02:34:56', '2013-07-24 02:34:56'), ('2', 'MANUAL', null, '', 'IK Trust', 'support@iktrust.com', 'Testing postmarkapp API', '<p>Transaction as follow :</p>\r\n\r\n<p>Last login: Mon Jul 22 21:21:21 on ttys000<br />\r\nArifMBP-2:fxsdesk me$ cd /Users/me/Sites/<br />\r\nArifMBP-2:Sites me$ cd fxsdesk/<br />\r\nArifMBP-2:fxsdesk me$ git sumodule add https://github.com/maurymmarques/postmark-cakephp.git app/Plugin/Postmark<br />\r\ngit: &#39;sumodule&#39; is not a git command. See &#39;git --help&#39;.</p>\r\n\r\n<p>Did you mean this?<br />\r\n&nbsp;&nbsp; &nbsp;submodule<br />\r\n&nbsp;</p>\r\n', '1', '0', '2013-07-24 02:37:28', '2013-07-24 02:37:28'), ('3', 'USERS', null, '', 'IK Trust', 'support@iktrust.com', 'Testing postmarkapp API', '<p>ini_set(&#39;memory_limit&#39;,&#39;256M&#39;);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;ini_set(&#39;max_execution_time&#39;, 5200);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$confirmRender=false;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;if ($this-&gt;request-&gt;isPost()) {<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$this-&gt;UserEmail-&gt;set($this-&gt;request-&gt;data);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$sendValidate = $this-&gt;UserEmail-&gt;sendValidate();<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;if($this-&gt;RequestHandler-&gt;isAjax()) {<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$this-&gt;layout = &#39;ajax&#39;;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$this-&gt;autoRender = false;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;if ($sendValidate) {<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$response = array(&#39;error&#39; =&gt; 0, &#39;message&#39; =&gt; &#39;Succes&#39;);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;return json_encode($response);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;} else {<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$response = array(&#39;error&#39; =&gt; 1,&#39;message&#39; =&gt; &#39;failure&#39;);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$response[&#39;data&#39;][&#39;UserEmail&#39;]&nbsp; = $this-&gt;UserEmail-&gt;validationErrors;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;return json_encode($response);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;}</p>\r\n', '1', '0', '2013-07-24 02:44:13', '2013-07-24 02:44:13'), ('4', 'USERS', null, '', 'IK Trust', 'support@iktrust.com', 'Testing postmarkapp API', '<p>$userId=$user[&#39;User&#39;][&#39;id&#39;];<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$email = new CakeEmail();<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$email-&gt;config(&#39;default&#39;);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$email-&gt;emailFormat(&#39;both&#39;);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$fromConfig = EMAIL_FROM_ADDRESS;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$fromNameConfig = EMAIL_FROM_NAME;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$email-&gt;from(array( $fromConfig =&gt; $fromNameConfig));<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$email-&gt;sender(array( $fromConfig =&gt; $fromNameConfig));<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$email-&gt;to($user[&#39;User&#39;][&#39;email&#39;]);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$email-&gt;subject(SITE_NAME.&#39;: &#39;.__(&#39;Change Password Confirmation&#39;));<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$datetime = date(&#39;Y M d h:i:s&#39;, time());<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$body= __(&#39;Hey %s,&lt;br/&gt;&lt;br/&gt;You recently changed your password on %s.&lt;br/&gt;&lt;br/&gt;As a security precaution, this notification has been sent to your email addresse associated with your account.&lt;br/&gt;&lt;br/&gt;Thanks,&lt;br/&gt;%s&#39;, $user[&#39;User&#39;][&#39;first_name&#39;], $datetime, SITE_NAME);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;try{<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$result = $email-&gt;send($body);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$this-&gt;log(&#39;Change password mail sent to userid-&#39;.$userId, LOG_DEBUG);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;} catch (Exception $ex){<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;// we could not send the email, ignore it<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$result=&quot;Could not send change password email to userid-&quot;.$userId;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;$this-&gt;log($result, LOG_DEBUG);<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;}</p>\r\n', '1', '1', '2013-07-24 03:17:29', '2013-07-24 03:17:30'), ('5', 'USERS', null, '', 'IK Trust', 'support@iktrust.com', 'PostmarkAPP Send Email Power', '<p>Are you making the most of networks like Facebook, LinkedIn, and Twitter? You should be. These powerful hubs can be competitive game-changers when it comes to boosting candidate quantity and quality.<br />\r\n<br />\r\nIn &ldquo;The Essential Guide to Developing a Social Recruiting Strategy,&rdquo; Jobvite offers a step-by-step process that guides you toward extending your recruiting reach and targeting top-tier candidates through the platforms they connect with daily.</p>\r\n', '1', '1', '2013-07-24 03:22:43', '2013-07-24 03:22:44');
COMMIT;

-- ----------------------------
--  Table structure for `user_group_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `user_group_permissions`;
CREATE TABLE `user_group_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) unsigned NOT NULL,
  `controller` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=310 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_group_permissions`
-- ----------------------------
BEGIN;
INSERT INTO `user_group_permissions` VALUES ('1', '1', 'Pages', 'display', '1'), ('2', '2', 'Pages', 'display', '1'), ('3', '3', 'Pages', 'display', '1'), ('4', '1', 'UserGroupPermissions', 'index', '1'), ('5', '2', 'UserGroupPermissions', 'index', '0'), ('6', '3', 'UserGroupPermissions', 'index', '0'), ('7', '1', 'UserGroups', 'index', '1'), ('8', '2', 'UserGroups', 'index', '0'), ('9', '3', 'UserGroups', 'index', '0'), ('10', '1', 'UserGroups', 'addGroup', '1'), ('11', '2', 'UserGroups', 'addGroup', '0'), ('12', '3', 'UserGroups', 'addGroup', '0'), ('13', '1', 'UserGroups', 'editGroup', '1'), ('14', '2', 'UserGroups', 'editGroup', '0'), ('15', '3', 'UserGroups', 'editGroup', '0'), ('16', '1', 'UserGroups', 'deleteGroup', '1'), ('17', '2', 'UserGroups', 'deleteGroup', '0'), ('18', '3', 'UserGroups', 'deleteGroup', '0'), ('19', '1', 'UserSettings', 'index', '1'), ('20', '2', 'UserSettings', 'index', '0'), ('21', '3', 'UserSettings', 'index', '0'), ('22', '1', 'UserSettings', 'editSetting', '1'), ('23', '2', 'UserSettings', 'editSetting', '0'), ('24', '3', 'UserSettings', 'editSetting', '0'), ('25', '1', 'Users', 'index', '1'), ('26', '2', 'Users', 'index', '0'), ('27', '3', 'Users', 'index', '0'), ('28', '1', 'Users', 'online', '1'), ('29', '2', 'Users', 'online', '0'), ('30', '3', 'Users', 'online', '0'), ('31', '1', 'Users', 'viewUser', '1'), ('32', '2', 'Users', 'viewUser', '0'), ('33', '3', 'Users', 'viewUser', '0'), ('34', '1', 'Users', 'myprofile', '0'), ('35', '2', 'Users', 'myprofile', '1'), ('36', '3', 'Users', 'myprofile', '0'), ('37', '1', 'Users', 'editProfile', '1'), ('38', '2', 'Users', 'editProfile', '1'), ('39', '3', 'Users', 'editProfile', '0'), ('40', '1', 'Users', 'login', '1'), ('41', '2', 'Users', 'login', '1'), ('42', '3', 'Users', 'login', '1'), ('43', '1', 'Users', 'logout', '1'), ('44', '2', 'Users', 'logout', '1'), ('45', '3', 'Users', 'logout', '1'), ('46', '1', 'Users', 'register', '1'), ('47', '2', 'Users', 'register', '1'), ('48', '3', 'Users', 'register', '1'), ('49', '1', 'Users', 'changePassword', '1'), ('50', '2', 'Users', 'changePassword', '1'), ('51', '3', 'Users', 'changePassword', '0'), ('52', '1', 'Users', 'changeUserPassword', '1'), ('53', '2', 'Users', 'changeUserPassword', '0'), ('54', '3', 'Users', 'changeUserPassword', '0'), ('55', '1', 'Users', 'addUser', '1'), ('56', '2', 'Users', 'addUser', '0'), ('57', '3', 'Users', 'addUser', '0'), ('58', '1', 'Users', 'editUser', '1'), ('59', '2', 'Users', 'editUser', '0'), ('60', '3', 'Users', 'editUser', '0'), ('61', '1', 'Users', 'deleteUser', '1'), ('62', '2', 'Users', 'deleteUser', '0'), ('63', '3', 'Users', 'deleteUser', '0'), ('64', '1', 'Users', 'deleteAccount', '0'), ('65', '2', 'Users', 'deleteAccount', '1'), ('66', '3', 'Users', 'deleteAccount', '0'), ('67', '1', 'Users', 'logoutUser', '1'), ('68', '2', 'Users', 'logoutUser', '0'), ('69', '3', 'Users', 'logoutUser', '0'), ('70', '1', 'Users', 'makeInactive', '1'), ('71', '2', 'Users', 'makeInactive', '0'), ('72', '3', 'Users', 'makeInactive', '0'), ('73', '1', 'Users', 'dashboard', '1'), ('74', '2', 'Users', 'dashboard', '1'), ('75', '3', 'Users', 'dashboard', '1'), ('76', '1', 'Users', 'makeActiveInactive', '1'), ('77', '2', 'Users', 'makeActiveInactive', '0'), ('78', '3', 'Users', 'makeActiveInactive', '0'), ('79', '1', 'Users', 'verifyEmail', '1'), ('80', '2', 'Users', 'verifyEmail', '0'), ('81', '3', 'Users', 'verifyEmail', '0'), ('82', '1', 'Users', 'accessDenied', '1'), ('83', '2', 'Users', 'accessDenied', '1'), ('84', '3', 'Users', 'accessDenied', '0'), ('85', '1', 'Users', 'userVerification', '1'), ('86', '2', 'Users', 'userVerification', '1'), ('87', '3', 'Users', 'userVerification', '1'), ('88', '1', 'Users', 'forgotPassword', '1'), ('89', '2', 'Users', 'forgotPassword', '1'), ('90', '3', 'Users', 'forgotPassword', '1'), ('91', '1', 'Users', 'emailVerification', '1'), ('92', '2', 'Users', 'emailVerification', '1'), ('93', '3', 'Users', 'emailVerification', '1'), ('94', '1', 'Users', 'activatePassword', '1'), ('95', '2', 'Users', 'activatePassword', '1'), ('96', '3', 'Users', 'activatePassword', '1'), ('97', '1', 'UserGroupPermissions', 'update', '1'), ('98', '2', 'UserGroupPermissions', 'update', '0'), ('99', '3', 'UserGroupPermissions', 'update', '0'), ('100', '1', 'Users', 'deleteCache', '1'), ('101', '2', 'Users', 'deleteCache', '0'), ('102', '3', 'Users', 'deleteCache', '0'), ('103', '1', 'Autocomplete', 'fetch', '1'), ('104', '2', 'Autocomplete', 'fetch', '1'), ('105', '3', 'Autocomplete', 'fetch', '1'), ('106', '1', 'Users', 'viewUserPermissions', '1'), ('107', '2', 'Users', 'viewUserPermissions', '0'), ('108', '3', 'Users', 'viewUserPermissions', '0'), ('109', '1', 'Contents', 'index', '1'), ('110', '2', 'Contents', 'index', '0'), ('111', '3', 'Contents', 'index', '0'), ('112', '1', 'Contents', 'addPage', '1'), ('113', '2', 'Contents', 'addPage', '0'), ('114', '3', 'Contents', 'addPage', '0'), ('115', '1', 'Contents', 'editPage', '1'), ('116', '2', 'Contents', 'editPage', '0'), ('117', '3', 'Contents', 'editPage', '0'), ('118', '1', 'Contents', 'viewPage', '1'), ('119', '2', 'Contents', 'viewPage', '0'), ('120', '3', 'Contents', 'viewPage', '0'), ('121', '1', 'Contents', 'deletePage', '1'), ('122', '2', 'Contents', 'deletePage', '0'), ('123', '3', 'Contents', 'deletePage', '0'), ('124', '1', 'Contents', 'content', '1'), ('125', '2', 'Contents', 'content', '1'), ('126', '3', 'Contents', 'content', '1'), ('127', '1', 'UserContacts', 'index', '1'), ('128', '2', 'UserContacts', 'index', '0'), ('129', '3', 'UserContacts', 'index', '0'), ('130', '1', 'UserContacts', 'contactUs', '1'), ('131', '2', 'UserContacts', 'contactUs', '1'), ('132', '3', 'UserContacts', 'contactUs', '1'), ('133', '1', 'Users', 'ajaxLoginRedirect', '1'), ('134', '2', 'Users', 'ajaxLoginRedirect', '1'), ('135', '3', 'Users', 'ajaxLoginRedirect', '1'), ('136', '1', 'Users', 'viewProfile', '1'), ('137', '2', 'Users', 'viewProfile', '1'), ('138', '3', 'Users', 'viewProfile', '1'), ('139', '1', 'Users', 'sendMails', '1'), ('140', '2', 'Users', 'sendMails', '0'), ('141', '3', 'Users', 'sendMails', '0'), ('142', '1', 'Users', 'searchEmails', '1'), ('143', '2', 'Users', 'searchEmails', '0'), ('144', '3', 'Users', 'searchEmails', '0'), ('145', '1', 'UserEmails', 'index', '1'), ('146', '1', 'UserEmails', 'send', '1'), ('147', '1', 'UserEmails', 'sendToUser', '1'), ('148', '1', 'UserEmails', 'sendReply', '1'), ('149', '1', 'UserEmails', 'view', '1'), ('150', '1', 'UserGroupPermissions', 'subPermissions', '1'), ('151', '1', 'UserGroupPermissions', 'getPermissions', '1'), ('152', '1', 'UserGroupPermissions', 'permissionGroupMatrix', '1'), ('153', '1', 'UserGroupPermissions', 'permissionSubGroupMatrix', '1'), ('154', '1', 'UserGroupPermissions', 'changePermission', '1'), ('155', '1', 'Users', 'indexSearch', '1'), ('156', '1', 'UserEmailSignatures', 'index', '1'), ('157', '1', 'UserEmailSignatures', 'add', '1'), ('158', '1', 'UserEmailSignatures', 'edit', '1'), ('159', '1', 'UserEmailSignatures', 'delete', '1'), ('160', '1', 'UserEmailTemplates', 'index', '1'), ('161', '1', 'UserEmailTemplates', 'add', '1'), ('162', '1', 'UserEmailTemplates', 'edit', '1'), ('163', '1', 'UserEmailTemplates', 'delete', '1'), ('164', '1', 'Desks', 'signsecure', '0'), ('165', '2', 'Desks', 'signsecure', '0'), ('166', '3', 'Desks', 'signsecure', '1'), ('167', '4', 'Contents', 'content', '1'), ('168', '1', 'TraderAccounts', 'listing', '1'), ('169', '2', 'TraderAccounts', 'listing', '1'), ('170', '3', 'TraderAccounts', 'listing', '0'), ('171', '4', 'TraderAccounts', 'listing', '0'), ('172', '1', 'Mt4Users', 'trader', '1'), ('173', '2', 'Mt4Users', 'trader', '0'), ('174', '3', 'Mt4Users', 'trader', '0'), ('175', '4', 'Mt4Users', 'trader', '0'), ('176', '1', 'Traders', 'notify', '1'), ('177', '2', 'Traders', 'notify', '0'), ('178', '3', 'Traders', 'notify', '0'), ('179', '4', 'Traders', 'notify', '0'), ('180', '1', 'TraderAccounts', 'overview', '1'), ('181', '2', 'TraderAccounts', 'overview', '1'), ('182', '3', 'TraderAccounts', 'overview', '0'), ('183', '4', 'TraderAccounts', 'overview', '0'), ('184', '1', 'Traders', 'myWallet', '1'), ('185', '2', 'Traders', 'myWallet', '1'), ('186', '3', 'Traders', 'myWallet', '0'), ('187', '4', 'Traders', 'myWallet', '0'), ('188', '1', 'Traders', 'sentSupportRequest', '1'), ('189', '2', 'Traders', 'sentSupportRequest', '1'), ('190', '3', 'Traders', 'sentSupportRequest', '0'), ('191', '4', 'Traders', 'sentSupportRequest', '0'), ('192', '1', 'Traders', 'securityInbox', '1'), ('193', '2', 'Traders', 'securityInbox', '1'), ('194', '3', 'Traders', 'securityInbox', '0'), ('195', '4', 'Traders', 'securityInbox', '0'), ('196', '1', 'Traders', 'verifyIdentity', '1'), ('197', '2', 'Traders', 'verifyIdentity', '1'), ('198', '3', 'Traders', 'verifyIdentity', '0'), ('199', '4', 'Traders', 'verifyIdentity', '0'), ('200', '1', 'Traders', 'dashboard', '1'), ('201', '2', 'Traders', 'dashboard', '1'), ('202', '3', 'Traders', 'dashboard', '0'), ('203', '4', 'Traders', 'dashboard', '0'), ('204', '1', 'Vaults', 'manage', '1'), ('205', '2', 'Vaults', 'manage', '1'), ('206', '3', 'Vaults', 'manage', '0'), ('207', '4', 'Vaults', 'manage', '0'), ('208', '1', 'Vaults', 'acc1_balance', '1'), ('209', '2', 'Vaults', 'acc1_balance', '1'), ('210', '3', 'Vaults', 'acc1_balance', '0'), ('211', '4', 'Vaults', 'acc1_balance', '1'), ('212', '1', 'TraderAccounts', 'funding', '1'), ('213', '2', 'TraderAccounts', 'funding', '1'), ('214', '3', 'TraderAccounts', 'funding', '0'), ('215', '4', 'TraderAccounts', 'funding', '0'), ('216', '1', 'TraderAccounts', 'history', '1'), ('217', '2', 'TraderAccounts', 'history', '1'), ('218', '3', 'TraderAccounts', 'history', '0'), ('219', '4', 'TraderAccounts', 'history', '0'), ('220', '1', 'Vaults', 'tradeacc_balance', '1'), ('221', '2', 'Vaults', 'tradeacc_balance', '1'), ('222', '3', 'Vaults', 'tradeacc_balance', '0'), ('223', '4', 'Vaults', 'tradeacc_balance', '0'), ('224', '1', 'Partners', 'dashboard', '1'), ('225', '2', 'Partners', 'dashboard', '0'), ('226', '3', 'Partners', 'dashboard', '0'), ('227', '4', 'Partners', 'dashboard', '1'), ('228', '1', 'Partners', 'cabinet', '1'), ('229', '2', 'Partners', 'cabinet', '0'), ('230', '3', 'Partners', 'cabinet', '0'), ('231', '4', 'Partners', 'cabinet', '1'), ('232', '1', 'Staffs', 'backoffice', '1'), ('233', '2', 'Staffs', 'backoffice', '0'), ('234', '3', 'Staffs', 'backoffice', '0'), ('235', '4', 'Staffs', 'backoffice', '0'), ('236', '4', 'Users', 'dashboard', '1'), ('237', '1', 'Vaults', 'dp_banktransfer', '1'), ('238', '2', 'Vaults', 'dp_banktransfer', '1'), ('239', '3', 'Vaults', 'dp_banktransfer', '0'), ('240', '4', 'Vaults', 'dp_banktransfer', '0'), ('241', '1', 'Vaults', 'dp_payza', '1'), ('242', '2', 'Vaults', 'dp_payza', '1'), ('243', '3', 'Vaults', 'dp_payza', '0'), ('244', '4', 'Vaults', 'dp_payza', '0'), ('245', '1', 'Vaults', 'dp_ikcard', '1'), ('246', '2', 'Vaults', 'dp_ikcard', '1'), ('247', '3', 'Vaults', 'dp_ikcard', '0'), ('248', '4', 'Vaults', 'dp_ikcard', '0'), ('249', '1', 'Vaults', 'dp_webmoney', '1'), ('250', '2', 'Vaults', 'dp_webmoney', '1'), ('251', '3', 'Vaults', 'dp_webmoney', '0'), ('252', '4', 'Vaults', 'dp_webmoney', '0'), ('253', '1', 'Vaults', 'dp_perfectmoney', '1'), ('254', '2', 'Vaults', 'dp_perfectmoney', '1'), ('255', '3', 'Vaults', 'dp_perfectmoney', '0'), ('256', '4', 'Vaults', 'dp_perfectmoney', '0'), ('257', '1', 'Vaults', 'dp_creditcard', '1'), ('258', '2', 'Vaults', 'dp_creditcard', '1'), ('259', '3', 'Vaults', 'dp_creditcard', '0'), ('260', '4', 'Vaults', 'dp_creditcard', '0'), ('261', '4', 'Pages', 'display', '1'), ('262', '1', 'TraderAccounts', 'mynetwork', '1'), ('263', '2', 'TraderAccounts', 'mynetwork', '0'), ('264', '3', 'TraderAccounts', 'mynetwork', '0'), ('265', '4', 'TraderAccounts', 'mynetwork', '1'), ('266', '1', 'Partners', 'vault', '1'), ('267', '2', 'Partners', 'vault', '0'), ('268', '3', 'Partners', 'vault', '0'), ('269', '4', 'Partners', 'vault', '1'), ('270', '4', 'TraderAccounts', 'myclient', '1'), ('271', '4', 'TraderAccounts', 'myagent', '1'), ('272', '1', 'Vaults', 'procdpaccwallet', '1'), ('273', '2', 'Vaults', 'procdpaccwallet', '1'), ('274', '3', 'Vaults', 'procdpaccwallet', '0'), ('275', '4', 'Vaults', 'procdpaccwallet', '1'), ('276', '2', 'Vaults', 'mywallet_history', '1'), ('277', '1', 'Staffs', 'tracc_listing', '1'), ('278', '1', 'Staffs', 'deposit_request', '1'), ('279', '1', 'Staffs', 'withdrawal_request', '1'), ('280', '1', 'Staffs', 'transfer_request', '1'), ('281', '1', 'Partners', 'myagent', '1'), ('282', '2', 'Partners', 'myagent', '0'), ('283', '3', 'Partners', 'myagent', '0'), ('284', '4', 'Partners', 'myagent', '1'), ('285', '1', 'Partners', 'myclient', '1'), ('286', '2', 'Partners', 'myclient', '0'), ('287', '3', 'Partners', 'myclient', '0'), ('288', '4', 'Partners', 'myclient', '1'), ('289', '1', 'Partners', 'mynetwork', '1'), ('290', '2', 'Partners', 'mynetwork', '0'), ('291', '3', 'Partners', 'mynetwork', '0'), ('292', '4', 'Partners', 'mynetwork', '1'), ('293', '1', 'Partners', 'trading_account_overview', '1'), ('294', '2', 'Partners', 'trading_account_overview', '0'), ('295', '3', 'Partners', 'trading_account_overview', '0'), ('296', '4', 'Partners', 'trading_account_overview', '1'), ('297', '1', 'Partners', 'kiraTotalAgent', '1'), ('298', '2', 'Partners', 'kiraTotalAgent', '0'), ('299', '3', 'Partners', 'kiraTotalAgent', '0'), ('300', '4', 'Partners', 'kiraTotalAgent', '1'), ('301', '1', 'Partners', 'kiraTotalDownline', '1'), ('302', '2', 'Partners', 'kiraTotalDownline', '0'), ('303', '3', 'Partners', 'kiraTotalDownline', '0'), ('304', '4', 'Partners', 'kiraTotalDownline', '1'), ('305', '1', 'Partners', 'kiraTotalClient', '1'), ('306', '2', 'Partners', 'kiraTotalClient', '0'), ('307', '3', 'Partners', 'kiraTotalClient', '0'), ('308', '4', 'Partners', 'kiraTotalClient', '1'), ('309', '4', 'Partners', 'kiraAccBawahAff', '1');
COMMIT;

-- ----------------------------
--  Table structure for `user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `alias_name` varchar(100) DEFAULT NULL,
  `description` text,
  `allowRegistration` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_groups`
-- ----------------------------
BEGIN;
INSERT INTO `user_groups` VALUES ('1', '0', 'Admin', 'Admin', null, '0', '2013-07-08 17:19:45', '2013-07-08 17:19:45'), ('2', '0', 'User', 'User', null, '1', '2013-07-08 17:19:45', '2013-07-08 17:19:45'), ('3', '0', 'Guest', 'Guest', null, '0', '2013-07-08 17:19:45', '2013-07-08 17:19:45'), ('4', '0', 'Partner', 'MasterIB', 'Introducing Brokers', '0', '2013-07-15 18:14:29', '2013-07-15 18:14:29');
COMMIT;

-- ----------------------------
--  Table structure for `user_settings`
-- ----------------------------
DROP TABLE IF EXISTS `user_settings`;
CREATE TABLE `user_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `name_public` text,
  `value` varchar(256) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_settings`
-- ----------------------------
BEGIN;
INSERT INTO `user_settings` VALUES ('1', 'defaultTimeZone', 'Enter default time zone identifier', 'Asia/Kuala_Lumpur', 'input'), ('2', 'siteName', 'Enter Your Site Name', 'FXSdesk IK Trust', 'input'), ('3', 'siteRegistration', 'New Registration is allowed or not', '1', 'checkbox'), ('4', 'allowDeleteAccount', 'Allow users to delete account', '0', 'checkbox'), ('5', 'sendRegistrationMail', 'Send Registration Mail After User Registered', '1', 'checkbox'), ('6', 'sendPasswordChangeMail', 'Send Password Change Mail After User changed password', '1', 'checkbox'), ('7', 'emailVerification', 'Want to verify user\'s email address?', '1', 'checkbox'), ('8', 'emailFromAddress', 'Enter email by which emails will be send.', 'support@iktrust.com', 'input'), ('9', 'emailFromName', 'Enter Email From Name', 'IK Trust', 'input'), ('10', 'allowChangeUsername', 'Do you want to allow users to change their username?', '0', 'checkbox'), ('11', 'bannedUsernames', 'Set banned usernames comma separated(no space, no quotes)', 'Administrator, SuperAdmin', 'input'), ('12', 'useRecaptcha', 'Do you want to captcha support on registration form?', '0', 'checkbox'), ('13', 'privateKeyFromRecaptcha', 'Enter private key for Recaptcha from google', '', 'input'), ('14', 'publicKeyFromRecaptcha', 'Enter public key for recaptcha from google', '', 'input'), ('15', 'loginRedirectUrl', 'Enter URL where user will be redirected after login ', '/dashboard', 'input'), ('16', 'logoutRedirectUrl', 'Enter URL where user will be redirected after logout', '/', 'input'), ('17', 'permissions', 'Do you Want to enable permissions for users?', '1', 'checkbox'), ('18', 'adminPermissions', 'Do you want to check permissions for Admin?', '0', 'checkbox'), ('19', 'defaultGroupId', 'Enter default group id for user registration', '2', 'input'), ('20', 'adminGroupId', 'Enter Admin Group Id', '1', 'input'), ('21', 'guestGroupId', 'Enter Guest Group Id', '3', 'input'), ('22', 'useFacebookLogin', 'Want to use Facebook Connect on your site?', '0', 'checkbox'), ('23', 'facebookAppId', 'Facebook Application Id', '', 'input'), ('24', 'facebookSecret', 'Facebook Application Secret Code', '', 'input'), ('25', 'facebookScope', 'Facebook Permissions', 'user_status, publish_stream, email', 'input'), ('26', 'useTwitterLogin', 'Want to use Twitter Connect on your site?', '0', 'checkbox'), ('27', 'twitterConsumerKey', 'Twitter Consumer Key', '', 'input'), ('28', 'twitterConsumerSecret', 'Twitter Consumer Secret', '', 'input'), ('29', 'useGmailLogin', 'Want to use Gmail Connect on your site?', '1', 'checkbox'), ('30', 'useYahooLogin', 'Want to use Yahoo Connect on your site?', '1', 'checkbox'), ('31', 'useLinkedinLogin', 'Want to use Linkedin Connect on your site?', '0', 'checkbox'), ('32', 'linkedinApiKey', 'Linkedin Api Key', '', 'input'), ('33', 'linkedinSecretKey', 'Linkedin Secret Key', '', 'input'), ('34', 'useFoursquareLogin', 'Want to use Foursquare Connect on your site?', '0', 'checkbox'), ('35', 'foursquareClientId', 'Foursquare Client Id', '', 'input'), ('36', 'foursquareClientSecret', 'Foursquare Client Secret', '', 'input'), ('37', 'viewOnlineUserTime', 'You can view online users and guest from last few minutes, set time in minutes ', '30', 'input'), ('38', 'useHttps', 'Do you want to HTTPS for whole site?', '0', 'checkbox'), ('39', 'httpsUrls', 'You can set selected urls for HTTPS (e.g. users/login, users/register)', null, 'input'), ('40', 'imgDir', 'Enter Image directory name where users profile photos will be uploaded. This directory should be in webroot/img directory', 'publics', 'input'), ('41', 'QRDN', 'Increase this number by 1 every time if you made any changes in CSS or JS file', '20091984', 'input'), ('42', 'cookieName', 'Please enter cookie name for your site which is used to login user automatically for remember me functionality', 'FXSdesk-IK-TRUST', 'input'), ('43', 'adminEmailAddress', 'Admin Email address for emails', 'webteam@iktrust.com', 'input');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_id` bigint(100) DEFAULT NULL,
  `fb_access_token` text,
  `twt_id` bigint(100) DEFAULT NULL,
  `twt_access_token` text,
  `twt_access_secret` text,
  `ldn_id` varchar(100) DEFAULT NULL,
  `user_group_id` varchar(256) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `active` varchar(3) DEFAULT '0',
  `email_verified` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `by_admin` int(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(50) DEFAULT NULL,
  `partnertag` int(20) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', null, null, null, null, null, null, '1', 'admin', 'b2aae31278a1f3a911f84497a7182ee0', '6adf262cff5454313b6f65800a6c9859', 'admin@admin.com', 'FXs', 'Admin', '1', '1', '2013-08-21 17:12:51', '0', '127.0.0.1', '0', '2013-07-08 17:19:45', '2013-07-23 13:51:57'), ('5', null, null, null, null, null, null, '4', 'partner1', '6badd0ff52092f2ab90f632b193d0d67', 'b820fc06aaf99dbb77832b8a48c143a4', 'partnership@iktrust.com', 'Partner', 'One', '1', '1', '2013-08-21 17:27:58', '1', null, '880003', '2013-08-14 11:36:51', '2013-08-19 14:39:50'), ('4', null, null, null, null, null, null, '2', 'arifsanchez', '97f3bec2779f4968059604221d5fbb53', 'c7bb5fd79f0eee5175af9c5336b98b0b', 'arifsanchez@gmail.com', 'Arif', 'Sanchez', '1', '1', '2013-08-20 20:42:30', '0', null, '0', '2013-08-01 16:29:46', '2013-08-01 16:29:46'), ('6', null, null, null, null, null, null, '2', 'test', 'ded557b0a811c78a1fec15dc0df1cb7d', '9b66786db9787c1d37bb190a7fa9dcac', 'testing.iktrust@gmail.com', 'Test', 'One', '1', '1', '2013-08-14 15:22:14', '1', null, '0', '2013-08-14 14:11:31', '2013-08-20 12:53:33');
COMMIT;

-- ----------------------------
--  Table structure for `vault_transactions`
-- ----------------------------
DROP TABLE IF EXISTS `vault_transactions`;
CREATE TABLE `vault_transactions` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `vault_id` int(15) NOT NULL,
  `jumlah` float(15,2) NOT NULL,
  `type` int(1) unsigned NOT NULL,
  `status` int(1) unsigned NOT NULL,
  `description` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `vault_transactions`
-- ----------------------------
BEGIN;
INSERT INTO `vault_transactions` VALUES ('1', '8', '9.00', '1', '1', 'TR IK WALLET #32313', '2013-08-19 18:46:05', '2013-08-19 18:46:05'), ('2', '8', '10.00', '1', '2', 'TR IK WALLET #6666', '2013-08-19 23:39:15', '2013-08-19 23:39:15'), ('3', '8', '7.00', '1', '3', 'TR IK WALLET #32313', '2013-08-20 00:08:13', '2013-08-20 00:08:13');
COMMIT;

-- ----------------------------
--  Table structure for `vaults`
-- ----------------------------
DROP TABLE IF EXISTS `vaults`;
CREATE TABLE `vaults` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(15) unsigned NOT NULL,
  `acc_1` float(15,2) NOT NULL DEFAULT '0.00',
  `acc_2` float(15,2) NOT NULL DEFAULT '0.00',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `vaults`
-- ----------------------------
BEGIN;
INSERT INTO `vaults` VALUES ('1', '1', '23912.10', '0.00', '2013-07-30 01:53:12', '2013-07-30 01:53:16'), ('6', '5', '35.60', '0.00', '2013-08-14 14:10:31', '2013-08-14 14:10:31'), ('7', '6', '23.20', '0.00', '2013-08-14 14:11:51', '2013-08-14 14:11:51'), ('8', '4', '10.00', '0.00', '2013-08-15 13:50:51', '2013-08-15 13:50:51');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
