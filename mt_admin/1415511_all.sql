CREATE DATABASE `mtadmin`;
USE `mtadmin`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS  `mt_auth_group`;
CREATE TABLE `mt_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS  `mt_auth_group_access`;
CREATE TABLE `mt_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS  `mt_auth_rule`;
CREATE TABLE `mt_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS  `mt_buyeraddress`;
CREATE TABLE `mt_buyeraddress` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `receiver_name` varchar(50) NOT NULL COMMENT '收货人',
  `receiver_phonenum` varchar(32) NOT NULL COMMENT '手机号码',
  `receiver_address` varchar(255) NOT NULL COMMENT '详细地址',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/10\n买家地址表';

insert into `mt_buyeraddress`(`auto_id`,`receiver_name`,`receiver_phonenum`,`receiver_address`) values
('1','陈','18279409347','国际企业中心');
DROP TABLE IF EXISTS  `mt_category`;
CREATE TABLE `mt_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `imgpath` varchar(255) DEFAULT NULL,
  `imgname` varchar(255) DEFAULT NULL,
  `catename` varchar(255) NOT NULL,
  `prevcate` int(5) NOT NULL,
  `des` varchar(255) NOT NULL,
  `status` enum('-1','1') NOT NULL DEFAULT '-1',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prevcate` (`prevcate`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=gbk;

insert into `mt_category`(`id`,`imgpath`,`imgname`,`catename`,`prevcate`,`des`,`status`,`addtime`) values
('17','/Uploads/cate_img/20161227/58623a794d64b.jpg','永不关上的门','新闻动态','0','永不关上的门永不关上的门永不关上的门','1','1482830330'),
('18','/Uploads/cate_img/20161227/58623e2846616.jpg','父爱如山','时事新闻','17','父爱如山父爱如山父爱如山','1','1482833448'),
('20','/Uploads/cate_img/20161228/586362672b7e2.jpg','农村电商合作','商业合作','18','农村电商合作农村电商合作农村电商合作','1','1482908263');
DROP TABLE IF EXISTS  `mt_contacttype`;
CREATE TABLE `mt_contacttype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `callnum` varchar(255) DEFAULT NULL COMMENT '固定电话',
  `phonenum` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='create by chenpy 2016-12-8\n联系方法表';

DROP TABLE IF EXISTS  `mt_flink`;
CREATE TABLE `mt_flink` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `comname` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

insert into `mt_flink`(`id`,`comname`,`url`,`logo`,`status`,`addtime`) values
('2','百度','http://www.baidu.com','','1','1482912178');
DROP TABLE IF EXISTS  `mt_goods`;
CREATE TABLE `mt_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `goodsname` varchar(100) NOT NULL COMMENT '商品名称',
  `goodsimg` varchar(100) DEFAULT NULL COMMENT '商品图片',
  `goodscateid` int(11) NOT NULL COMMENT '商品分类ID',
  `goodsabstract` varchar(255) DEFAULT NULL COMMENT '商品简介',
  `goodscontent` text COMMENT '商品介绍',
  `goodsorig` float(10,2) unsigned DEFAULT '0.00' COMMENT '商品原价',
  `goodsprice` float(10,2) unsigned DEFAULT NULL COMMENT '商品价格',
  `goodsstatus` tinyint(2) NOT NULL DEFAULT '0' COMMENT '商品状态',
  `ismail` tinyint(1) NOT NULL COMMENT '是否包邮',
  `mailprice` float(6,2) DEFAULT '0.00' COMMENT '快递费用',
  `refreshtime` int(11) NOT NULL COMMENT '更新时间',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `res1` varchar(255) DEFAULT NULL COMMENT '备注',
  `res2` varchar(255) DEFAULT NULL COMMENT '备注2',
  `sendpoints` int(10) DEFAULT NULL COMMENT '赠送积分',
  `madein` varchar(100) DEFAULT NULL COMMENT '产地',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017-2-7\n商品表';

insert into `mt_goods`(`id`,`goodsname`,`goodsimg`,`goodscateid`,`goodsabstract`,`goodscontent`,`goodsorig`,`goodsprice`,`goodsstatus`,`ismail`,`mailprice`,`refreshtime`,`addtime`,`res1`,`res2`,`sendpoints`,`madein`) values
('16','卡片','/Uploads/goodsImg/20170621/5949d6552b913.png','1','很好玩的卡片，适合儿童的智力发育','&lt;p&gt;很好玩的卡片，适合儿童的智力发育&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好玩的卡片，适合儿童的智力发育&lt;/p&gt;','28','20','-99','0',0.99,'1498219444','1498011221',null,null,'2','赣州'),
('17','被子','/Uploads/goodsImg/20170621/5949d6ef38841.png','1','保暖的被子，柔软有弹性','&lt;p&gt;保暖的被子，柔软有弹性&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;保暖的被子，柔软有弹性&lt;/p&gt;','3200','2800','-99','0',0.99,'1498218970','1498011375',null,null,'28','赣州'),
('18','测试','/Uploads/goodsImg/20170623/594d214589f8b.jpg','1','测试测试测试测试测试测试测试测试测试测试测试测试','&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;',9999.99,'1500','-1','1','0','1498267277','1498012482',null,null,'10','赣州'),
('19','测试','/Uploads/goodsImg/20170623/594d2138c7a8f.jpg','1','测试测试测试测试测试测试测试测试测试测试测试测试','&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;','10000','1500','1','1','0','1498268277','1498012484',null,null,'200','赣州'),
('20','测试','/Uploads/goodsImg/20170621/5949db4493e53.jpg','1','测试测试测试测试测试测试测试测试测试测试测试测试','&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;',9999.99,'1500','-99','0',0.99,'1498218970','1498012484',null,null,'100','赣州'),
('21','测试','/Uploads/goodsImg/20170621/5949db44f36a8.jpg','1','测试测试测试测试测试测试测试测试测试测试测试测试','&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;',9999.99,'1500','-99','0',0.99,'1498218891','1498012485',null,null,'100','赣州'),
('22','这是个测试','/Uploads/goodsImg/20170621/5949dc01cfd0b.jpg','1','大神大神我的期望打算的撒','&lt;p&gt;的请问大神大神的前雾灯请问的前雾灯阿萨德气温达是气温达as&lt;br/&gt;&lt;/p&gt;','1600','1500','-99','1','0','1498218872','1498012673',null,null,'12','赣州'),
('23','','/Uploads/goodsImg/20170621/594a4524d600f.png','0','','&lt;p&gt;很好用的手机，推荐给大家&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好用的手机，推荐给大家&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好用的手机，推荐给大家&lt;/p&gt;','6400','5600','-99','0','10','1498216038','1498039588',null,null,'56','赣州'),
('24','钱包','/Uploads/goodsImg/20170623/594d212c5f746.jpg','1','很好用的钱包很好用的钱包很好用的钱包','&lt;p&gt;很好用的钱包&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好用的钱包&lt;/p&gt;','200','100','1','1','0','1498268277','1498222603',null,null,'2','赣州'),
('25','鼠标','/Uploads/goodsImg/20170623/594d20d858fdd.png','1','很好用的鼠标噢噢噢噢','&lt;p&gt;很好用的鼠标噢噢噢噢很好用的鼠很好用的鼠标噢噢噢噢标噢噢噢噢&lt;/p&gt;','78','60','-1','1','0','1498267277','1498222991',null,null,'60','赣州');
DROP TABLE IF EXISTS  `mt_goodscate`;
CREATE TABLE `mt_goodscate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `classify` varchar(50) NOT NULL COMMENT '分类名称',
  `cateimg` varchar(200) NOT NULL COMMENT '图片路径',
  `catedes` varchar(255) DEFAULT '' COMMENT '类简介',
  `catestatus` enum('1','-1') NOT NULL DEFAULT '-1' COMMENT '类状态',
  `cateaddtime` varchar(32) NOT NULL COMMENT '类添加时间',
  `res1` varchar(255) DEFAULT NULL COMMENT '备注',
  `res2` varchar(255) DEFAULT NULL COMMENT '备注2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

insert into `mt_goodscate`(`id`,`classify`,`cateimg`,`catedes`,`catestatus`,`cateaddtime`,`res1`,`res2`) values
('1','竹子','/Uploads/classifyImg/20170208/589a8152e8704.png','00','1','1486462038',null,null);
DROP TABLE IF EXISTS  `mt_grade`;
CREATE TABLE `mt_grade` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `grade` varchar(50) NOT NULL DEFAULT '0' COMMENT '等级名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='create by chenpy 2016-12-21\r\n等级表';

insert into `mt_grade`(`id`,`grade`) values
('1','超级管理员');
DROP TABLE IF EXISTS  `mt_jobs`;
CREATE TABLE `mt_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `job` varchar(50) NOT NULL COMMENT '职位名称',
  `des` mediumtext NOT NULL COMMENT '内容',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` enum('-1','1') NOT NULL DEFAULT '-1' COMMENT '状态',
  `views` int(10) NOT NULL DEFAULT '0' COMMENT '浏览量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='create by chenpy 2016-12-22\r\n招聘职位表';

insert into `mt_jobs`(`id`,`job`,`des`,`addtime`,`status`,`views`) values
('1','PHP程序员','&lt;p&gt;event.params.data.fAutoID&lt;/p&gt;','1482912331','1','0');
DROP TABLE IF EXISTS  `mt_log`;
CREATE TABLE `mt_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visitor` varchar(100) NOT NULL,
  `content` varchar(200) NOT NULL COMMENT '登录内容',
  `ip` varchar(50) NOT NULL COMMENT 'ip地址',
  `logintime` int(10) NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='日志表';

insert into `mt_log`(`id`,`visitor`,`content`,`ip`,`logintime`) values
('3','admin','登陆成功','115.148.65.162','1482227911'),
('4','admin','登陆成功','115.148.65.162','1482229466'),
('5','admin','登陆成功','115.148.65.162','1482230168'),
('6','admin','登陆成功','111.79.236.178','1482311549'),
('7','admin','登陆成功','111.79.236.178','1482368252'),
('8','admin','登陆成功','111.79.236.178','1482385177'),
('9','admin','登陆成功','111.79.236.178','1482453791'),
('10','admin','登陆成功','111.79.236.178','1482454901'),
('11','admin','登陆成功','106.6.137.45','1482541959'),
('12','admin','登陆成功','106.6.137.45','1482548600'),
('13','admin','登陆成功','111.79.236.26','1482739737'),
('14','admin','登陆成功','39.158.232.142','1483252161'),
('15','admin','登陆成功','39.158.233.242','1483497547'),
('16','admin','登陆成功','106.6.137.1','1483534227'),
('17','admin','登陆成功','220.177.110.251','1483671303'),
('18','admin','登陆成功','220.177.110.251','1483671374'),
('19','admin','登陆成功','111.75.236.155, 183.61.52.70','1483687762'),
('20','admin','登陆成功','::1','1483712715'),
('21','admin','登陆成功','111.75.236.155','1483756485'),
('22','admin','登陆成功','111.75.236.155','1483756519'),
('23','admin','登陆成功','220.177.110.251','1483785834'),
('24','admin','登陆成功','111.75.236.155','1483965664'),
('25','admin','登陆成功','115.148.107.9','1483966081'),
('26','admin','登陆成功','111.75.236.155','1483967864'),
('27','admin','登陆成功','115.148.107.9','1484048578'),
('28','admin','登陆成功','115.148.64.117','1484122718'),
('29','admin','登陆成功','182.111.200.50','1484309725'),
('30','admin','登陆成功','111.75.236.155','1484358500'),
('31','admin','登陆成功','106.6.136.241','1484530889'),
('32','admin','登陆成功','39.158.233.153','1485689663'),
('33','admin','登陆成功','117.44.47.237','1486460068'),
('34','admin','登陆成功','117.44.47.237','1486520127'),
('35','admin','登陆成功','182.108.147.183','1486695515'),
('36','admin','登陆成功','182.108.147.183','1486728457'),
('37','admin','登陆成功','182.111.189.214','1486867857'),
('38','admin','登陆成功','182.110.185.179','1487129143'),
('39','admin','登陆成功','182.110.185.179','1487147600'),
('40','admin','登陆成功','182.110.185.179','1487214468'),
('41','admin','登陆成功','182.105.236.160','1487313440'),
('42','admin','登陆成功','182.105.236.160','1487316546'),
('43','admin','登陆成功','182.105.236.160','1487318060'),
('44','admin','登陆成功','182.105.236.160','1487321994'),
('45','admin','登陆成功','182.111.188.116','1487381426'),
('46','admin','登陆成功','182.111.188.116','1487381469'),
('47','admin','登陆成功','182.99.132.216','1487917691'),
('48','admin','登陆成功','182.99.132.216','1487926510'),
('49','admin','登陆成功','59.55.32.5','1489197745'),
('50','admin','登陆成功','182.99.132.223','1489649153'),
('51','admin','登陆成功','59.55.47.235','1490088612'),
('52','admin','登陆成功','59.55.47.235','1490235271'),
('53','admin','登陆成功','106.6.137.149','1490874775'),
('54','admin','登陆成功','182.86.62.35','1491470400'),
('55','admin','登陆成功','182.110.185.211','1492257224'),
('56','admin','登陆成功','106.226.118.229','1492504736'),
('57','admin','登陆成功','106.6.136.14','1496458349'),
('58','admin','登陆成功','::1','1496462335'),
('59','admin','登陆成功','::1','1496477735'),
('60','admin','登陆成功','::1','1497962548'),
('61','admin','登陆成功','::1','1498006871'),
('62','admin','登陆成功','::1','1498033921'),
('63','admin','登陆成功','::1','1498203495'),
('64','admin','登陆成功','182.111.188.131','1500296519');
DROP TABLE IF EXISTS  `mt_members`;
CREATE TABLE `mt_members` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ＩＤ',
  `wx_nickname` varchar(50) NOT NULL COMMENT '用户昵称',
  `wx_headimgurl` varchar(200) NOT NULL COMMENT '用户头像',
  `wx_city` varchar(50) NOT NULL COMMENT '用户所在城市',
  `wx_openid` varchar(50) NOT NULL COMMENT '用户OpenID',
  `subscribe_time` varchar(30) NOT NULL COMMENT '关注时间',
  `wx_sex` enum('1','2','0') NOT NULL,
  `members_status` int(5) DEFAULT NULL COMMENT '用户状态',
  `recent_time` varchar(30) NOT NULL COMMENT '用户最近访问时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `restore_time` int(11) DEFAULT NULL COMMENT '还原时间',
  `res1` varchar(100) DEFAULT NULL COMMENT '备注',
  `res2` varchar(100) DEFAULT NULL COMMENT '备注2',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='竹乡联萌会员表';

insert into `mt_members`(`auto_id`,`wx_nickname`,`wx_headimgurl`,`wx_city`,`wx_openid`,`subscribe_time`,`wx_sex`,`members_status`,`recent_time`,`delete_time`,`restore_time`,`res1`,`res2`) values
('4','程序猿豆腐','http://wx.qlogo.cn/mmopen/PiajxSqBRaEJlz556iafUPOyDM7ia9aSpcT8arFCjv9S1tyuicz5b3pmzgvpLC1vMRcB5DrurfqRdwMzTanDldhVLQ/0','江西 赣州','ovkkfxFjMIbALZ3_ZBRobvYboEI4','1484040473','1','-1','1487384275','1491481347','1491481354',null,null);
DROP TABLE IF EXISTS  `mt_members_sex`;
CREATE TABLE `mt_members_sex` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sex_code` int(2) NOT NULL,
  `sex_name` varchar(32) NOT NULL,
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/16\n会员性别表';

insert into `mt_members_sex`(`auto_id`,`sex_code`,`sex_name`) values
('1','1','男'),
('2','2','女'),
('3','0','未知');
DROP TABLE IF EXISTS  `mt_members_status`;
CREATE TABLE `mt_members_status` (
  `auto_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `status_code` int(5) NOT NULL,
  `status_name` varchar(32) NOT NULL,
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/17';

insert into `mt_members_status`(`auto_id`,`status_code`,`status_name`) values
('1','1','正常'),
('2','-1','拉黑'),
('3','-99','已删除');
DROP TABLE IF EXISTS  `mt_msg`;
CREATE TABLE `mt_msg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `require` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS  `mt_news`;
CREATE TABLE `mt_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `iconname` varchar(100) NOT NULL,
  `author` varchar(20) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `abstract` text NOT NULL,
  `tags` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0',
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=gbk;

insert into `mt_news`(`id`,`title`,`icon`,`iconname`,`author`,`type`,`abstract`,`tags`,`status`,`views`,`addtime`) values
('26','测试文章1','/Uploads/news_icon/20161227/586210303901a.jpg','无动为大去','df','20','测试用的111111111111111111111','','1','0','1482759208'),
('27','公司简介','','','','-1','','','2','0','1482761621');
DROP TABLE IF EXISTS  `mt_newscontent`;
CREATE TABLE `mt_newscontent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `newsid` int(10) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `describe` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=gbk;

insert into `mt_newscontent`(`id`,`newsid`,`keywords`,`describe`,`content`) values
('32','26','测试1,测试2,测试3','我觉得哦啊收到哦啊啥都弄','&lt;p&gt;大大神发发发沙发我去打饭&lt;/p&gt;'),
('33','27','','','');
DROP TABLE IF EXISTS  `mt_orderinfo`;
CREATE TABLE `mt_orderinfo` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_numbers` varchar(50) NOT NULL COMMENT '订单号',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `goods_img` varchar(50) NOT NULL COMMENT '商品图片',
  `buy_count` int(5) unsigned NOT NULL COMMENT '购买数量',
  `goods_price` float(5,2) unsigned NOT NULL COMMENT '商品单价',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/10';

insert into `mt_orderinfo`(`auto_id`,`order_numbers`,`goods_name`,`goods_img`,`buy_count`,`goods_price`) values
('1','20170210123456 ','竹子','','2','125');
DROP TABLE IF EXISTS  `mt_orders`;
CREATE TABLE `mt_orders` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_numbers` varchar(50) NOT NULL COMMENT '订单号',
  `goods_quantity` tinyint(5) NOT NULL COMMENT '商品数量',
  `order_createtime` varchar(32) NOT NULL COMMENT '订单创建时间',
  `order_status` int(5) NOT NULL COMMENT '订单状态码',
  `order_total` float(8,2) unsigned NOT NULL COMMENT '订单总额',
  `buyer_openid` varchar(100) NOT NULL COMMENT '买家OpenID\n',
  `address_id` int(11) NOT NULL COMMENT '地址ID',
  `order_paytime` int(11) NOT NULL COMMENT '买家付款时间',
  `buyer_msg` varchar(255) NOT NULL COMMENT '买家留言',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017-2-10';

insert into `mt_orders`(`auto_id`,`order_numbers`,`goods_quantity`,`order_createtime`,`order_status`,`order_total`,`buyer_openid`,`address_id`,`order_paytime`,`buyer_msg`) values
('1','20170210123456','3','1354795563','100',253.01,'ovkkfxFjMIbALZ3_ZBRobvYboEI4','1','1365989566','原图');
DROP TABLE IF EXISTS  `mt_orderstatus`;
CREATE TABLE `mt_orderstatus` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `status_code` int(11) NOT NULL COMMENT '状态码',
  `status_name` varchar(50) NOT NULL COMMENT '状态名称',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017-2-10\n订单状态表 ';

insert into `mt_orderstatus`(`auto_id`,`status_code`,`status_name`) values
('1','-1','已取消'),
('2','1','待付款'),
('3','50','已付款'),
('4','100','已发货'),
('5','200','已收货，订单完成');
DROP TABLE IF EXISTS  `mt_picture`;
CREATE TABLE `mt_picture` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) NOT NULL,
  `picname` varchar(255) NOT NULL,
  `picpath` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` enum('-1','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

insert into `mt_picture`(`id`,`type`,`picname`,`picpath`,`des`,`addtime`,`status`) values
('5','1','永不关上的门','/Uploads/uploadPic/20161231/58671c6eb5687.jpg','永不关上的门永不关上的门','1483152497','1');
DROP TABLE IF EXISTS  `mt_picturetype`;
CREATE TABLE `mt_picturetype` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `typename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

insert into `mt_picturetype`(`id`,`typename`) values
('1','首页轮播');
DROP TABLE IF EXISTS  `mt_qqcontact`;
CREATE TABLE `mt_qqcontact` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `qqnum` varchar(50) NOT NULL DEFAULT '0' COMMENT 'QQ号',
  `qqtitle` varchar(80) NOT NULL DEFAULT '0' COMMENT 'QQ标题',
  `status` enum('-1','1') NOT NULL DEFAULT '-1' COMMENT '启用状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='create by chenpy 2016-12-21\r\n资讯QQ 表';

insert into `mt_qqcontact`(`id`,`qqnum`,`qqtitle`,`status`) values
('1','473203432','客服一','1');
DROP TABLE IF EXISTS  `mt_user`;
CREATE TABLE `mt_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '用户密码',
  `telephone` varchar(30) NOT NULL COMMENT '电话',
  `email` varchar(80) NOT NULL COMMENT 'email',
  `grade` tinyint(5) NOT NULL COMMENT '等级',
  `status` enum('-99','1') NOT NULL COMMENT '状态',
  `online` enum('-1','1') NOT NULL COMMENT '是否在线',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `des` varchar(200) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='create by chenpy 2016-12-20';

insert into `mt_user`(`id`,`username`,`password`,`telephone`,`email`,`grade`,`status`,`online`,`addtime`,`des`) values
('1','admin','e10adc3949ba59abbe56e057f20f883e','18279409347','8249963272@qq.com','1','1','-1','1482224781','超级管理员'),
('3','test','c33367701511b4f6020ec61ded352059','18279409347','473203432@qq.com','1','1','-1','1482546424','测试用户');
DROP TABLE IF EXISTS  `mt_webbase`;
CREATE TABLE `mt_webbase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `webtitle` varchar(255) DEFAULT NULL COMMENT '网站名称',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` varchar(300) DEFAULT NULL COMMENT '描述',
  `copyright` varchar(50) DEFAULT NULL COMMENT '版权信息',
  `icp` varchar(50) DEFAULT NULL COMMENT '备案号',
  `countcode` mediumtext COMMENT '统计代码',
  `contactemail` varchar(255) DEFAULT NULL COMMENT 'email',
  `contacthotline` varchar(255) DEFAULT NULL COMMENT '联系热线',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `hotline` varchar(45) DEFAULT NULL COMMENT '投诉热线',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='create by chenpy 2016-12-8\n网站基本信息表';

insert into `mt_webbase`(`id`,`webtitle`,`keyword`,`description`,`copyright`,`icp`,`countcode`,`contactemail`,`contacthotline`,`address`,`hotline`) values
('2','','','','','','','','','','');
SET FOREIGN_KEY_CHECKS = 1;

