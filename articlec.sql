/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : articlec

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-07-06 17:16:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hd_article`
-- ----------------------------
DROP TABLE IF EXISTS `hd_article`;
CREATE TABLE `hd_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cid` tinyint(8) unsigned NOT NULL,
  `title` char(20) NOT NULL DEFAULT '',
  `type` enum('1','2') DEFAULT NULL COMMENT '类型',
  `thumb` varchar(70) NOT NULL DEFAULT '' COMMENT '缩略图',
  `abstract` text NOT NULL COMMENT '摘要',
  `content` text NOT NULL COMMENT '内容',
  `pubdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表时间',
  `is_delete` enum('0','1') DEFAULT '0' COMMENT '0未删除，1删除',
  `author` varchar(32) NOT NULL,
  `hits` mediumint(8) NOT NULL COMMENT '点击量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_article
-- ----------------------------
INSERT INTO `hd_article` VALUES ('1', '2', '你棒出大电影了，快卖肾来凑你棒出大电影了', '2', '14676228699713_thumb.jpg', 'Bigbang要出电影了。\r\n嗯，并不是五位歌手已经全部演技精进到movie star的地步（TOP不服），而是一部纪录片形式的大电影，告诉观众2015到2016年MADE巡演过程中最真实的BIGBANG。\r\n', '<p>Bigbang不失章法的RAP，没有束缚的穿着，街头舞蹈，随意的台风，还有调动性强烈的歌词。宣传主V.I.P，没有新人的羞涩，歌词中不断重复出现的V.I.P.霸气地宣扬自己。衣服、项链上面都印着闪耀的BIGBANG，张扬得一塌糊涂</p>', '1467622869', '0', 'shisanyi', '50');
INSERT INTO `hd_article` VALUES ('2', '1', ' 关注！今天下午河南将公布2016年高考', '2', '', '天下午河南将公布2016年高考分数线', '6月24日，大河网记者从河南省招生办公室获悉，今天下午3时30分，省招办将召开新闻发布会，公布2016年河南省普通高校招生录取控制分数线，请广大考生和家长关注大河网（www.dahe.cn），前方记者将及时发回报道', '0', '0', '', '5');
INSERT INTO `hd_article` VALUES ('3', '3', '噩耗!骑士夺冠游行后发生枪击 两名女子被', '1', '', '　新浪体育讯　　北京时间6月23日，据《克里夫兰老实人报》报道，骑士队今天在克里夫兰举行了盛大的夺冠游行，但是在这场游行结束之后，克里夫兰市中心发生了一起枪击事件，有两名女子在这起事件中遭到枪击。', '　　据悉，枪击事件发生在当地时间下午5点以后，当时骑士队的夺冠游行已经结束。\r\n\r\n　　克里夫兰警方表示，两名女子遭到枪击，而开枪的男子已经被逮捕。这两名女子的伤势程度还不得而知。\r\n\r\n　　据了解，这起枪击事件发生在克里夫兰的塔城中心，当时大批量的骑士球迷正在离开游行现场。\r\n\r\n　　今天是克里夫兰这座城市历史上最重要的时刻之一，骑士队为克城带来了52年来的首个职业体育冠军，数百万球迷加入了这场盛大的夺冠游行，然而骑士夺冠游行后发生的这起枪击案却打破了原本的美好和平静。', '0', '0', '', '37');
INSERT INTO `hd_article` VALUES ('7', '3', '骑士终于夺冠了 邓肯:我没骗人吧', '1', '', '吐槽不停，欢乐不止！新浪NBA神吐槽栏目继续登场！骑士夺冠 ，网友吐槽：邓肯当年说的对！', '　　呵呵呵哈哈哈42：本以为勇士能拿下骑士卫冕总冠军的，哎，果然我还是太天真了，勇士输球了，白天要上班到也没什么，可一到晚上，一个人躺在床上，就再也抑制不了内心的感情，一个人蒙在被子里偷偷地笑了起来', '1466750207', '0', '', '0');
INSERT INTO `hd_article` VALUES ('8', '12', 'Si Seulement', '1', '', 'Lynnsha', '<p xss=removed><span id=\"_baidu_bookmark_start_5\" xss=removed>‍</span><span id=\"_baidu_bookmark_start_7\" xss=removed>‍</span><span id=\"_baidu_bookmark_start_9\" xss=removed>‍</span><span id=\"_baidu_bookmark_start_11\" xss=removed>‍</span><strong>S&#39;il y a des mots que je ne dis jamais<span id=\"_baidu_bookmark_end_8\" xss=removed>‍</span><span xss=removed><span id=\"_baidu_bookmark_end_6\" xss=removed>‍</span></span><span id=\"_baidu_bookmark_end_12\" xss=removed>‍</span><span id=\"_baidu_bookmark_end_10\" xss=removed>‍</span><span id=\"_baidu_bookmark_end_10\" xss=removed></span></strong></p><p><br xss=removed></p><p xss=removed>如果有我从不曾说出的话</p><p><br xss=removed></p><p xss=removed>C&#39;est qu&#39;n m&#39;a trop souvent mal aimée</p><p><br xss=removed></p><p xss=removed>那就是我总为情所伤</p><p><br></p>', '1466755845', '0', '', '0');
INSERT INTO `hd_article` VALUES ('9', '16', '刚果河（英文名：Congo River）', '1', '', '刚果河（英文名：Congo River）也称为扎伊尔河（方言意思是\"大河\"），位于位于非洲中西部。全长约4370千米，流域面积约370万平方千米，为非洲第二长河。[', '<p>由于流经赤道两侧，获得南北半球丰富降水的交替补给，具有水量大及年内变化小的水情特征，河口年平均流量为每秒41000立方米，最大流量达每秒80000立方米。</p><p>如果按流量来划分，刚果河的流量仅次于亚马孙河，是世界第二大河。</p><p>河口成较深溺谷，河槽向大西洋底延伸150公里，在河口外形成广阔的淡水洋面。</p><p>干支流多险滩、瀑布和急流，以中游博约马瀑布群和下游利文斯通瀑布群最为著名。<sup>[3]</sup><a name=\"ref_[3]_5920\"></a> </p><p>刚果河流域包括了<a target=\"_blank\" href=\"http://baike.baidu.com/view/50512.htm\">刚果民主共和国</a>几乎全部的领土，刚果和<a target=\"_blank\" href=\"http://baike.baidu.com/view/21990.htm\">中非共和国</a>大部、<a target=\"_blank\" href=\"http://baike.baidu.com/view/21958.htm\">赞比亚</a>东部、<a target=\"_blank\" href=\"http://baike.baidu.com/view/21163.htm\">安哥拉</a>北部以及<a target=\"_blank\" href=\"http://baike.baidu.com/view/8636.htm\">喀麦隆</a>和<a target=\"_blank\" href=\"http://baike.baidu.com/view/2506.htm\">坦桑尼亚</a>的一部分领土。</p><p>在这片广阔的流域，密集的支流、副支流和小河分成许多河汊，构成一个扇形河道网。</p><p>这些河流从周围海拔270-460米的一片会聚的斜坡上流入一个中央<a target=\"_blank\" href=\"http://baike.baidu.com/view/281922.htm\">洼地</a>，这个洼地就是地球上最大的盆地—<a target=\"_blank\" href=\"http://baike.baidu.com/view/20044.htm\">刚果盆地</a>。</p><p><br></p>', '1467342165', '0', '', '0');
INSERT INTO `hd_article` VALUES ('10', '1', '拒不承认是真的', '1', '14676154242209_thumb.jpg', 'what？\r\n', '<p>                Quoi？123132<br></p>', '1467615424', '0', '', '0');
INSERT INTO `hd_article` VALUES ('11', '1', '123123', '1', '', '123123', '<p>123123<br></p>', '1467343116', '0', '', '0');
INSERT INTO `hd_article` VALUES ('12', '16', '世界第二大河流', '1', '', '中非地带，人烟稀少', '<p>呵呵哒<br></p>', '1467595134', '0', '', '0');
INSERT INTO `hd_article` VALUES ('13', '9', '这是什么鬼', '1', '', '三星 还是其他的呢', '<p>话说三星还是很经济的<br></p><br><p><br></p>', '1467596974', '0', '', '0');
INSERT INTO `hd_article` VALUES ('14', '12', 'C\'est une ville mani', '1', '', 'J l\'adore toujour', 'Tu peut me attandre?<br><p><br></p>', '1467597683', '0', '', '0');
INSERT INTO `hd_article` VALUES ('15', '11', '定一战告捷', '1', '14676021107230.jpg', '这个妹子可以约 鉴定完毕', '霉霉抖森送你狗粮<p><br></p>', '1467602110', '0', '', '0');
INSERT INTO `hd_article` VALUES ('16', '11', '最后一站打响', '1', '14676027839015_thumb.jpg', '笑死我了', '真的<p><br></p>', '1467602783', '0', '', '0');
INSERT INTO `hd_article` VALUES ('17', '11', '缓存技术又长一步', '1', '14676109007199_thumb.jpg', '还开心啊', '<p>    真的真的</p><p><br></p>', '1467610900', '0', '', '0');
INSERT INTO `hd_article` VALUES ('18', '11', '无敌是多么', '1', '14676122768402_thumb.jpg', '无敌是多么多么的悲伤', '什么鬼<p><br></p>', '1467612276', '0', '', '0');
INSERT INTO `hd_article` VALUES ('19', '1', '无敌是多么qqqq', '1', '14676125974239_thumb.jpg', '多美的忧伤', '多么的忧伤<p><br></p>', '1467612597', '0', '', '0');
INSERT INTO `hd_article` VALUES ('20', '9', 'A boobs', '1', '14676137334056_thumb.jpg', 'that is NO A', '<p>Not a or an<br></p><br><p><br></p>', '1467613733', '0', '', '0');
INSERT INTO `hd_article` VALUES ('21', '1', '11111', '1', '14676872483273_thumb.jpg', '1', '<p>1<br></p>', '1467687249', '0', '', '0');
INSERT INTO `hd_article` VALUES ('22', '18', 'Life goes', '1', '14676967524334_thumb.jpg', 'prettttttty hard', '<p>It needs time to collaps<br></p>', '1467696752', '0', 'shisan', '0');

-- ----------------------------
-- Table structure for `hd_category`
-- ----------------------------
DROP TABLE IF EXISTS `hd_category`;
CREATE TABLE `hd_category` (
  `cid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_category
-- ----------------------------
INSERT INTO `hd_category` VALUES ('1', '教育');
INSERT INTO `hd_category` VALUES ('2', 'BINGBANG!!!');
INSERT INTO `hd_category` VALUES ('3', 'LeBron');
INSERT INTO `hd_category` VALUES ('4', 'Julien');
INSERT INTO `hd_category` VALUES ('5', '手机');
INSERT INTO `hd_category` VALUES ('6', '历史');
INSERT INTO `hd_category` VALUES ('7', '宗教');
INSERT INTO `hd_category` VALUES ('8', '电影');
INSERT INTO `hd_category` VALUES ('9', '生活家');
INSERT INTO `hd_category` VALUES ('10', '山在那里');
INSERT INTO `hd_category` VALUES ('11', '大笑');
INSERT INTO `hd_category` VALUES ('12', 'Paris');
INSERT INTO `hd_category` VALUES ('13', 'NINJA');
INSERT INTO `hd_category` VALUES ('15', '犹太人');
INSERT INTO `hd_category` VALUES ('16', '刚果河');
INSERT INTO `hd_category` VALUES ('17', 'Celavland');
INSERT INTO `hd_category` VALUES ('18', '南山南');

-- ----------------------------
-- Table structure for `hd_comment`
-- ----------------------------
DROP TABLE IF EXISTS `hd_comment`;
CREATE TABLE `hd_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(8) unsigned NOT NULL COMMENT '文章ID',
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户ID',
  `content` text COMMENT '评论内容',
  `pubdate` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `hd_member`
-- ----------------------------
DROP TABLE IF EXISTS `hd_member`;
CREATE TABLE `hd_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(32) NOT NULL COMMENT '昵称',
  `profile` varchar(70) NOT NULL DEFAULT '' COMMENT '用户头像',
  `address` varchar(70) DEFAULT NULL COMMENT '地址',
  `phone` char(11) NOT NULL DEFAULT '',
  `pwd` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_member
-- ----------------------------
INSERT INTO `hd_member` VALUES ('1', '', '', null, '13123456789', 'd41d8cd98f00b204e9800998ecf8427e');
INSERT INTO `hd_member` VALUES ('5', '', '', null, '13112341234', 'd41d8cd98f00b204e9800998ecf8427e');

-- ----------------------------
-- Table structure for `hd_user`
-- ----------------------------
DROP TABLE IF EXISTS `hd_user`;
CREATE TABLE `hd_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user` char(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `loginTime` int(10) unsigned NOT NULL COMMENT '登录时间',
  `loginIp` varchar(32) NOT NULL COMMENT '上次登录的IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_user
-- ----------------------------
INSERT INTO `hd_user` VALUES ('1', 'shisan', '96e79218965eb72c92a549dd5a330112', '1467696592', '2130706433');
