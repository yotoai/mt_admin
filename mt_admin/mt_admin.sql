-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.53 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 mtadmin 的数据库结构
CREATE DATABASE IF NOT EXISTS `mtadmin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mtadmin`;

-- 导出  表 mtadmin.dmt_auth_group 结构
CREATE TABLE IF NOT EXISTS `dmt_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `rules` char(255) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id',
  `des` varchar(100) DEFAULT NULL COMMENT '备注',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户组表';

-- 正在导出表  mtadmin.dmt_auth_group 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `dmt_auth_group` DISABLE KEYS */;
INSERT INTO `dmt_auth_group` (`id`, `title`, `status`, `rules`, `des`, `addtime`) VALUES
	(1, '超级管理员', 1, '1,2,3,4,5,6,7,8,9,10,11,12,33,34,35,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64', '无', 1504877885),
	(2, '管理员', 1, '1,2,3,4,5,6,7,8,9,10,11,12,33,34,35,13,14,15,16,17,18,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64', '无', 1504877907);
/*!40000 ALTER TABLE `dmt_auth_group` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_auth_group_access 结构
CREATE TABLE IF NOT EXISTS `dmt_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户组明细表';

-- 正在导出表  mtadmin.dmt_auth_group_access 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `dmt_auth_group_access` DISABLE KEYS */;
INSERT INTO `dmt_auth_group_access` (`uid`, `group_id`) VALUES
	(1, 2),
	(2, 1);
/*!40000 ALTER TABLE `dmt_auth_group_access` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_auth_rule 结构
CREATE TABLE IF NOT EXISTS `dmt_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '认证方式，1为实时认证；2为登录认证。',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `des` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `iconfont` char(50) NOT NULL COMMENT '图标编码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='规则表';

-- 正在导出表  mtadmin.dmt_auth_rule 的数据：~49 rows (大约)
/*!40000 ALTER TABLE `dmt_auth_rule` DISABLE KEYS */;
INSERT INTO `dmt_auth_rule` (`id`, `pid`, `name`, `title`, `type`, `status`, `condition`, `des`, `addtime`, `iconfont`) VALUES
	(1, 0, 'News/news', '资讯管理', 1, 1, '', '资讯管理目录', 1504841989, '&#xe616;'),
	(2, 1, 'News/index', '资讯管理', 1, 1, '', '资讯管理页面', 1504842042, ''),
	(3, 2, 'News/addNews', '添加资讯', 1, 1, '', '添加资讯的按钮', 1504842630, ''),
	(4, 2, 'News/delNews', '删除资讯', 1, 1, '', '删除/批量删除的按钮', 1504842677, ''),
	(5, 2, 'News/editNews', '编辑资讯', 1, 1, '', '编辑资讯的按钮', 1504842729, ''),
	(6, 2, 'News/changeStatusUp', '资讯发布', 1, 1, '', '资讯发布/批量发布的按钮', 1504842942, ''),
	(7, 2, 'News/changeStatusOff', '资讯下架', 1, 1, '', '资讯下架/批量下架的按钮', 1504842982, ''),
	(8, 1, 'News/cate', '分类目录', 1, 1, '', '分类目录页面', 1504843191, ''),
	(9, 8, 'News/addCate', '添加分类', 1, 1, '', '添加分类的按钮', 1504843238, ''),
	(10, 8, 'News/delCate', '删除分类', 1, 1, '', '删除分类的删除按钮', 1504843294, ''),
	(11, 8, 'News/editCate', '编辑分类', 1, 1, '', '编辑分类的编辑按钮', 1504843336, ''),
	(12, 8, 'News/upCateStatus', '操作分类', 1, 1, '', '操作分类上下架的按钮', 1504843406, ''),
	(13, 0, 'Picture/pic', '图片管理', 1, 1, '', '图片管理目录', 1504843532, '&#xe613;'),
	(14, 13, 'Picture/picList', '图片管理', 1, 1, '', '图片管理页面', 1504843630, '&#xe612;'),
	(15, 14, 'Picture/addPic', '添加图片', 1, 1, '', '添加图片的按钮', 1504843665, ''),
	(16, 14, 'Picture/delPic', '删除图片', 1, 1, '', '删除图片的按钮', 1504843729, ''),
	(17, 14, 'Picture/editPic', '编辑图片', 1, 1, '', '编辑图片的编辑按钮', 1504843773, ''),
	(18, 14, 'Picture/upStatus', '操作图片', 1, 1, '', '操作图片上下架的按钮', 1504843811, ''),
	(19, 0, 'Admin/admin', '管理员管理', 1, 1, '', '管理员管理目录', 1504843887, '&#xe62d;'),
	(20, 19, 'Admin/index', '管理员列表', 1, 1, '', '管理员列表的页面', 1504843911, ''),
	(21, 20, 'Admin/addAdmin', '添加管理员', 1, 1, '', '添加管理员的按钮', 1504844477, ''),
	(22, 20, 'Admin/delAdmin', '删除管理员', 1, 1, '', '删除管理员的删除按钮', 1504844519, ''),
	(23, 20, 'Admin/editAdmin', '编辑管理员', 1, 1, '', '编辑管理员的编辑按钮', 1504844561, ''),
	(24, 20, 'Admin/upStatus', '操作管理员', 1, 1, '', '操作管理员禁用启用的按钮', 1504845804, ''),
	(25, 19, 'Role/rolelist', '角色管理', 1, 1, '', '角色管理页面', 1504855287, ''),
	(26, 25, 'Role/addrole', '添加角色', 1, 1, '', '添加角色的按钮', 1504855332, ''),
	(27, 25, 'Role/editrole', '编辑角色', 1, 1, '', '编辑角色的按钮', 1504855379, ''),
	(28, 25, 'Role/delrole', '删除角色', 1, 1, '', '删除角色的按钮', 1504855538, ''),
	(29, 19, 'Role/rulelist', '权限管理', 1, 1, '', '权限管理页面', 1504855601, ''),
	(30, 29, 'Role/addrule', '添加权限', 1, 1, '', '添加权限的按钮', 1504855638, ''),
	(31, 29, 'Role/editrule', '编辑权限', 1, 1, '', '编辑权限的按钮', 1504855668, ''),
	(32, 29, 'Role/delrule', '删除权限', 1, 1, '', '删除权限的按钮', 1504855723, ''),
	(33, 1, 'News/draftList', '草稿箱', 1, 1, '', '草稿箱页面', 1504856869, ''),
	(34, 1, 'News/recycleBin', '回收站', 1, 1, '', '回收站页面', 1504856957, ''),
	(35, 34, 'News/restoreNews', '还原', 1, 1, '', '还原/批量还原的按钮', 1504857081, ''),
	(36, 0, 'Goods/goods', '产品管理', 1, 1, '', '产品管理的目录', 1504857400, '&#xe620;'),
	(37, 36, 'Goods/index', '产品管理', 1, 1, '', '产品管理的页面', 1504857614, ''),
	(38, 37, 'Goods/addGoods', '添加产品', 1, 1, '', '添加产品的按钮', 1504857766, ''),
	(39, 37, 'Goods/editGoods', '编辑产品', 1, 1, '', '编辑产品的编辑按钮', 1504858061, ''),
	(40, 37, 'Goods/upGoodsStatus', '上架产品', 1, 1, '', '上架/批量上架产品的上架按钮', 1504858206, ''),
	(41, 37, 'Goods/offGoodsStatus', '下架产品', 1, 1, '', '下架/批量下架产品的按钮', 1504858372, ''),
	(42, 37, 'Goods/delGoods', '删除产品', 1, 1, '', '删除/批量删除产品的按钮', 1504858448, ''),
	(43, 36, 'Goods/category', '分类管理', 1, 1, '', '分类管理的页面', 1504858495, ''),
	(44, 43, 'Goods/addCategory', '添加分类', 1, 1, '', '添加分类的按钮', 1504858559, ''),
	(45, 43, 'Goods/editCate', '编辑分类', 1, 1, '', '编辑分类的编辑按钮', 1504861924, ''),
	(46, 43, 'Goods/delCate', '删除分类', 1, 1, '', '分类管理的删除按钮', 1504861988, ''),
	(47, 43, 'Goods/upGoodsCateStatus', '操作分类', 1, 1, '', '分类管理的上下架按钮', 1504862108, ''),
	(48, 0, 'Orders/orders', '订单管理', 1, 1, '', '订单管理的目录', 1504862273, '&#xe687;'),
	(49, 48, 'Orders/ordersList', '订单管理', 1, 1, '', '订单管理的页面', 1504862398, ''),
	(50, 49, 'Orders/ordersDetail', '订单详情', 1, 1, '', '订单详情的按钮', 1504862604, ''),
	(51, 49, 'Orders/delOrders', '删除订单', 1, 1, '', '订单管理的删除按钮', 1504862682, ''),
	(52, 0, 'Members/members', '会员管理', 1, 1, '', '会员管理的目录', 1504862913, '&#xe6cc;'),
	(53, 52, 'Members/membersList', '会员管理', 1, 1, '', '会员管理的页面', 1504862951, ''),
	(54, 52, 'Members/deletedMembers', '已删会员', 1, 1, '', '已删会员的页面', 1504863141, ''),
	(55, 0, 'Flinks/flinks', '链接管理', 1, 1, '', '链接管理的目录', 1504863241, '&#xe6f1;'),
	(56, 55, 'Flinks/flinksList', '友情链接', 1, 1, '', '友情链接的页面', 1504863328, ''),
	(57, 0, 'Jobs/jobs', '招聘管理', 1, 1, '', '招聘管理的目录', 1504863389, '&#xe637;'),
	(58, 57, 'Jobs/index', '招聘信息', 1, 1, '', '招聘信息的页面', 1504863428, ''),
	(59, 0, 'System/sys', '系统管理', 1, 1, '', '系统管理的目录', 1504863660, '&#xe62e;'),
	(60, 59, 'System/systembase', '网站基本设置', 1, 1, '', '网站基本设置的页面', 1504863900, ''),
	(61, 59, 'System/changepwd', '用户密码修改', 1, 1, '', '用户密码修改的页面', 1504863941, ''),
	(62, 59, 'System/setcontact', '联系栏设置', 1, 1, '', '联系栏设置的页面', 1504864006, ''),
	(63, 59, 'System/setqq', '联系QQ管理', 1, 1, '', '联系QQ管理的页面', 1504864046, ''),
	(64, 59, 'System/logList', '登录日志', 1, 1, '', '登录日志的页面', 1504864088, '');
/*!40000 ALTER TABLE `dmt_auth_rule` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_buyeraddress 结构
CREATE TABLE IF NOT EXISTS `dmt_buyeraddress` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `receiver_name` varchar(50) NOT NULL COMMENT '收货人',
  `receiver_phonenum` varchar(32) NOT NULL COMMENT '手机号码',
  `receiver_address` varchar(255) NOT NULL COMMENT '详细地址',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/10\n买家地址表';

-- 正在导出表  mtadmin.dmt_buyeraddress 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_buyeraddress` DISABLE KEYS */;
INSERT INTO `dmt_buyeraddress` (`auto_id`, `receiver_name`, `receiver_phonenum`, `receiver_address`) VALUES
	(1, '陈', '18279409347', '国际企业中心');
/*!40000 ALTER TABLE `dmt_buyeraddress` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_category 结构
CREATE TABLE IF NOT EXISTS `dmt_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `imgpath` varchar(255) DEFAULT NULL,
  `imgname` varchar(255) DEFAULT NULL,
  `catename` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `status` enum('-1','1') NOT NULL DEFAULT '-1',
  `addtime` int(11) NOT NULL,
  `refreshtime` int(11) NOT NULL,
  `pid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=gbk;

-- 正在导出表  mtadmin.dmt_category 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `dmt_category` DISABLE KEYS */;
INSERT INTO `dmt_category` (`id`, `imgpath`, `imgname`, `catename`, `des`, `status`, `addtime`, `refreshtime`, `pid`) VALUES
	(17, '/Uploads/cate_img/20161227/58623a794d64b.jpg', '永不关上的门', '新闻动态', '永不关上的门永不关上的门永不关上的门', '1', 1482830330, 0, 0),
	(18, '/Uploads/cate_img/20161227/58623e2846616.jpg', '父爱如山', '时事新闻', '父爱如山父爱如山父爱如山', '1', 1482833448, 0, 17),
	(20, '/Uploads/cate_img/20161228/586362672b7e2.jpg', '农村电商合作', '商业合作', '农村电商合作农村电商合作农村电商合作', '1', 1482908263, 0, 18);
/*!40000 ALTER TABLE `dmt_category` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_contacttype 结构
CREATE TABLE IF NOT EXISTS `dmt_contacttype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `callnum` varchar(255) DEFAULT NULL COMMENT '固定电话',
  `phonenum` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='create by chenpy 2016-12-8\n联系方法表';

-- 正在导出表  mtadmin.dmt_contacttype 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `dmt_contacttype` DISABLE KEYS */;
/*!40000 ALTER TABLE `dmt_contacttype` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_flink 结构
CREATE TABLE IF NOT EXISTS `dmt_flink` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `comname` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- 正在导出表  mtadmin.dmt_flink 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_flink` DISABLE KEYS */;
INSERT INTO `dmt_flink` (`id`, `comname`, `url`, `logo`, `status`, `addtime`) VALUES
	(2, '百度', 'http://www.baidu.com', '', 1, 1482912178);
/*!40000 ALTER TABLE `dmt_flink` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_goods 结构
CREATE TABLE IF NOT EXISTS `dmt_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `goodsname` varchar(100) NOT NULL COMMENT '商品名称',
  `goodsimg` varchar(100) DEFAULT NULL COMMENT '商品图片',
  `goodscateid` int(11) NOT NULL COMMENT '商品分类ID',
  `goodscatename` varchar(100) NOT NULL,
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

-- 正在导出表  mtadmin.dmt_goods 的数据：~10 rows (大约)
/*!40000 ALTER TABLE `dmt_goods` DISABLE KEYS */;
INSERT INTO `dmt_goods` (`id`, `goodsname`, `goodsimg`, `goodscateid`, `goodscatename`, `goodsabstract`, `goodscontent`, `goodsorig`, `goodsprice`, `goodsstatus`, `ismail`, `mailprice`, `refreshtime`, `addtime`, `res1`, `res2`, `sendpoints`, `madein`) VALUES
	(16, '卡片', '/Uploads/goodsImg/20170621/5949d6552b913.png', 1, '', '很好玩的卡片，适合儿童的智力发育', '&lt;p&gt;很好玩的卡片，适合儿童的智力发育&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好玩的卡片，适合儿童的智力发育&lt;/p&gt;', 28.00, 20.00, -99, 0, 0.99, 1498219444, 1498011221, NULL, NULL, 2, '赣州'),
	(17, '被子', '/Uploads/goodsImg/20170621/5949d6ef38841.png', 1, '', '保暖的被子，柔软有弹性', '&lt;p&gt;保暖的被子，柔软有弹性&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;保暖的被子，柔软有弹性&lt;/p&gt;', 3200.00, 2800.00, -99, 0, 0.99, 1498218970, 1498011375, NULL, NULL, 28, '赣州'),
	(18, '测试', '/Uploads/goodsImg/20170623/594d214589f8b.jpg', 3, '电饭煲', '测试测试测试测试测试测试测试测试测试测试测试测试', '&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;', 9999.99, 1500.00, -1, 1, 0.00, 1498267277, 1498012482, NULL, NULL, 10, '赣州'),
	(19, '测试', '/Uploads/goodsImg/20170623/594d2138c7a8f.jpg', 3, '电饭煲', '测试测试测试测试测试测试测试测试测试测试测试测试', '&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;', 10000.00, 1500.00, 1, 1, 0.00, 1498268277, 1498012484, NULL, NULL, 200, '赣州'),
	(20, '测试', '/Uploads/goodsImg/20170621/5949db4493e53.jpg', 1, '', '测试测试测试测试测试测试测试测试测试测试测试测试', '&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;', 9999.99, 1500.00, -99, 0, 0.99, 1498218970, 1498012484, NULL, NULL, 100, '赣州'),
	(21, '测试', '/Uploads/goodsImg/20170621/5949db44f36a8.jpg', 1, '', '测试测试测试测试测试测试测试测试测试测试测试测试', '&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试&lt;/p&gt;', 9999.99, 1500.00, -99, 0, 0.99, 1498218891, 1498012485, NULL, NULL, 100, '赣州'),
	(22, '这是个测试', '/Uploads/goodsImg/20170621/5949dc01cfd0b.jpg', 1, '', '大神大神我的期望打算的撒', '&lt;p&gt;的请问大神大神的前雾灯请问的前雾灯阿萨德气温达是气温达as&lt;br/&gt;&lt;/p&gt;', 1600.00, 1500.00, -99, 1, 0.00, 1498218872, 1498012673, NULL, NULL, 12, '赣州'),
	(23, '', '/Uploads/goodsImg/20170621/594a4524d600f.png', 0, '', '', '&lt;p&gt;很好用的手机，推荐给大家&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好用的手机，推荐给大家&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好用的手机，推荐给大家&lt;/p&gt;', 6400.00, 5600.00, -99, 0, 10.00, 1498216038, 1498039588, NULL, NULL, 56, '赣州'),
	(24, '钱包', '/Uploads/goodsImg/20170623/594d212c5f746.jpg', 3, '电饭煲', '很好用的钱包很好用的钱包很好用的钱包', '&lt;p&gt;很好用的钱包&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很好用的钱包&lt;/p&gt;', 200.00, 100.00, 1, 1, 0.00, 1498268277, 1498222603, NULL, NULL, 2, '赣州'),
	(25, '鼠标', '/Uploads/goodsImg/20170623/594d20d858fdd.png', 3, '电饭煲', '很好用的鼠标噢噢噢噢', '&lt;p&gt;很好用的鼠标噢噢噢噢很好用的鼠很好用的鼠标噢噢噢噢标噢噢噢噢&lt;/p&gt;', 78.00, 60.00, -1, 1, 0.00, 1498267277, 1498222991, NULL, NULL, 60, '赣州');
/*!40000 ALTER TABLE `dmt_goods` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_goodscate 结构
CREATE TABLE IF NOT EXISTS `dmt_goodscate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `classify` varchar(50) NOT NULL COMMENT '分类名称',
  `cateimg` varchar(200) NOT NULL COMMENT '图片路径',
  `catedes` varchar(255) DEFAULT '' COMMENT '类简介',
  `catestatus` enum('1','-1') NOT NULL DEFAULT '-1' COMMENT '类状态',
  `cateaddtime` varchar(32) NOT NULL COMMENT '类添加时间',
  `res1` varchar(255) DEFAULT NULL COMMENT '备注',
  `res2` varchar(255) DEFAULT NULL COMMENT '备注2',
  `pid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 正在导出表  mtadmin.dmt_goodscate 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `dmt_goodscate` DISABLE KEYS */;
INSERT INTO `dmt_goodscate` (`id`, `classify`, `cateimg`, `catedes`, `catestatus`, `cateaddtime`, `res1`, `res2`, `pid`) VALUES
	(1, '电器', '/Uploads/classifyImg/20170208/589a8152e8704.png', '00', '1', '1486462038', NULL, NULL, 0),
	(2, '家用电器', '/img/default.jpg', '', '1', '1504458061', NULL, NULL, 1),
	(3, '电饭煲', '/img/default.jpg', '', '1', '1504458077', NULL, NULL, 2);
/*!40000 ALTER TABLE `dmt_goodscate` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_grade 结构
CREATE TABLE IF NOT EXISTS `dmt_grade` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `grade` varchar(50) NOT NULL DEFAULT '0' COMMENT '等级名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='create by chenpy 2016-12-21\r\n等级表';

-- 正在导出表  mtadmin.dmt_grade 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_grade` DISABLE KEYS */;
INSERT INTO `dmt_grade` (`id`, `grade`) VALUES
	(1, '超级管理员');
/*!40000 ALTER TABLE `dmt_grade` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_jobs 结构
CREATE TABLE IF NOT EXISTS `dmt_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `job` varchar(50) NOT NULL COMMENT '职位名称',
  `des` mediumtext NOT NULL COMMENT '内容',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` enum('-1','1') NOT NULL DEFAULT '-1' COMMENT '状态',
  `views` int(10) NOT NULL DEFAULT '0' COMMENT '浏览量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='create by chenpy 2016-12-22\r\n招聘职位表';

-- 正在导出表  mtadmin.dmt_jobs 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_jobs` DISABLE KEYS */;
INSERT INTO `dmt_jobs` (`id`, `job`, `des`, `addtime`, `status`, `views`) VALUES
	(1, 'PHP程序员', '&lt;p&gt;event.params.data.fAutoID&lt;/p&gt;', 1482912331, '1', 0);
/*!40000 ALTER TABLE `dmt_jobs` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_log 结构
CREATE TABLE IF NOT EXISTS `dmt_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visitor` varchar(100) NOT NULL,
  `content` varchar(200) NOT NULL COMMENT '登录内容',
  `ip` varchar(50) NOT NULL COMMENT 'ip地址',
  `logintime` int(10) NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='日志表';

-- 正在导出表  mtadmin.dmt_log 的数据：~98 rows (大约)
/*!40000 ALTER TABLE `dmt_log` DISABLE KEYS */;
INSERT INTO `dmt_log` (`id`, `visitor`, `content`, `ip`, `logintime`) VALUES
	(3, 'admin', '登陆成功', '115.148.65.162', 1482227911),
	(4, 'admin', '登陆成功', '115.148.65.162', 1482229466),
	(5, 'admin', '登陆成功', '115.148.65.162', 1482230168),
	(6, 'admin', '登陆成功', '111.79.236.178', 1482311549),
	(7, 'admin', '登陆成功', '111.79.236.178', 1482368252),
	(8, 'admin', '登陆成功', '111.79.236.178', 1482385177),
	(9, 'admin', '登陆成功', '111.79.236.178', 1482453791),
	(10, 'admin', '登陆成功', '111.79.236.178', 1482454901),
	(11, 'admin', '登陆成功', '106.6.137.45', 1482541959),
	(12, 'admin', '登陆成功', '106.6.137.45', 1482548600),
	(13, 'admin', '登陆成功', '111.79.236.26', 1482739737),
	(14, 'admin', '登陆成功', '39.158.232.142', 1483252161),
	(15, 'admin', '登陆成功', '39.158.233.242', 1483497547),
	(16, 'admin', '登陆成功', '106.6.137.1', 1483534227),
	(17, 'admin', '登陆成功', '220.177.110.251', 1483671303),
	(18, 'admin', '登陆成功', '220.177.110.251', 1483671374),
	(19, 'admin', '登陆成功', '111.75.236.155, 183.61.52.70', 1483687762),
	(20, 'admin', '登陆成功', '::1', 1483712715),
	(21, 'admin', '登陆成功', '111.75.236.155', 1483756485),
	(22, 'admin', '登陆成功', '111.75.236.155', 1483756519),
	(23, 'admin', '登陆成功', '220.177.110.251', 1483785834),
	(24, 'admin', '登陆成功', '111.75.236.155', 1483965664),
	(25, 'admin', '登陆成功', '115.148.107.9', 1483966081),
	(26, 'admin', '登陆成功', '111.75.236.155', 1483967864),
	(27, 'admin', '登陆成功', '115.148.107.9', 1484048578),
	(28, 'admin', '登陆成功', '115.148.64.117', 1484122718),
	(29, 'admin', '登陆成功', '182.111.200.50', 1484309725),
	(30, 'admin', '登陆成功', '111.75.236.155', 1484358500),
	(31, 'admin', '登陆成功', '106.6.136.241', 1484530889),
	(32, 'admin', '登陆成功', '39.158.233.153', 1485689663),
	(33, 'admin', '登陆成功', '117.44.47.237', 1486460068),
	(34, 'admin', '登陆成功', '117.44.47.237', 1486520127),
	(35, 'admin', '登陆成功', '182.108.147.183', 1486695515),
	(36, 'admin', '登陆成功', '182.108.147.183', 1486728457),
	(37, 'admin', '登陆成功', '182.111.189.214', 1486867857),
	(38, 'admin', '登陆成功', '182.110.185.179', 1487129143),
	(39, 'admin', '登陆成功', '182.110.185.179', 1487147600),
	(40, 'admin', '登陆成功', '182.110.185.179', 1487214468),
	(41, 'admin', '登陆成功', '182.105.236.160', 1487313440),
	(42, 'admin', '登陆成功', '182.105.236.160', 1487316546),
	(43, 'admin', '登陆成功', '182.105.236.160', 1487318060),
	(44, 'admin', '登陆成功', '182.105.236.160', 1487321994),
	(45, 'admin', '登陆成功', '182.111.188.116', 1487381426),
	(46, 'admin', '登陆成功', '182.111.188.116', 1487381469),
	(47, 'admin', '登陆成功', '182.99.132.216', 1487917691),
	(48, 'admin', '登陆成功', '182.99.132.216', 1487926510),
	(49, 'admin', '登陆成功', '59.55.32.5', 1489197745),
	(50, 'admin', '登陆成功', '182.99.132.223', 1489649153),
	(51, 'admin', '登陆成功', '59.55.47.235', 1490088612),
	(52, 'admin', '登陆成功', '59.55.47.235', 1490235271),
	(53, 'admin', '登陆成功', '106.6.137.149', 1490874775),
	(54, 'admin', '登陆成功', '182.86.62.35', 1491470400),
	(55, 'admin', '登陆成功', '182.110.185.211', 1492257224),
	(56, 'admin', '登陆成功', '106.226.118.229', 1492504736),
	(57, 'admin', '登陆成功', '106.6.136.14', 1496458349),
	(58, 'admin', '登陆成功', '::1', 1496462335),
	(59, 'admin', '登陆成功', '::1', 1496477735),
	(60, 'admin', '登陆成功', '::1', 1497962548),
	(61, 'admin', '登陆成功', '::1', 1498006871),
	(62, 'admin', '登陆成功', '::1', 1498033921),
	(63, 'admin', '登陆成功', '::1', 1498203495),
	(64, 'admin', '登陆成功', '182.111.188.131', 1500296519),
	(65, 'admin', '登陆成功', '::1', 1504445102),
	(66, 'admin', '登陆成功', '::1', 1504447201),
	(67, 'admin', '登陆成功', '::1', 1504457836),
	(68, 'admin', '登陆成功', '::1', 1504490024),
	(69, 'admin', '登陆成功', '0.0.0.0', 1504498238),
	(70, 'admin', '登陆成功', '0.0.0.0', 1504498284),
	(71, 'admin', '登陆成功', '0.0.0.0', 1504498916),
	(72, 'admin', '登陆成功', '0.0.0.0', 1504499740),
	(73, 'admin', '登陆成功', '0.0.0.0', 1504499785),
	(74, 'admin', '登陆成功', '0.0.0.0', 1504499830),
	(75, 'admin', '登陆成功', '0.0.0.0', 1504499877),
	(76, 'admin', '登陆成功', '0.0.0.0', 1504500197),
	(77, 'admin', '登陆成功', '0.0.0.0', 1504500682),
	(78, 'admin', '登陆成功', '0.0.0.0', 1504501275),
	(79, 'admin', '登陆成功', '0.0.0.0', 1504506007),
	(80, 'admin', '登陆成功', '0.0.0.0', 1504575017),
	(81, 'admin', '登陆成功', '0.0.0.0', 1504660776),
	(82, 'admin', '登陆成功', '0.0.0.0', 1504750493),
	(83, 'admin', '登陆成功', '0.0.0.0', 1504784841),
	(84, 'admin', '登陆成功', '0.0.0.0', 1504837061),
	(85, 'admin', '登陆成功', '0.0.0.0', 1504838380),
	(86, 'admin', '登陆成功', '0.0.0.0', 1504838410),
	(87, 'admin', '登陆成功', '0.0.0.0', 1504838514),
	(88, 'admin', '登陆成功', '0.0.0.0', 1504841605),
	(89, 'admin', '登陆成功', '0.0.0.0', 1504871991),
	(90, 'administrator', '登陆成功', '0.0.0.0', 1504873853),
	(91, 'administrator', '登陆成功', '0.0.0.0', 1504874406),
	(92, 'administrator', '登陆成功', '0.0.0.0', 1504874452),
	(93, 'admin', '登陆成功', '0.0.0.0', 1504874955),
	(94, 'admin', '登陆成功', '0.0.0.0', 1504877789),
	(95, 'admin', '登陆成功', '0.0.0.0', 1504878694),
	(96, 'admin', '登陆成功', '0.0.0.0', 1504879015),
	(97, 'administrator', '登陆成功', '0.0.0.0', 1504879571),
	(98, 'admin', '登陆成功', '0.0.0.0', 1504880527),
	(99, 'administrator', '登陆成功', '0.0.0.0', 1504880944),
	(100, 'administrator', '登陆成功', '0.0.0.0', 1504884985),
	(101, 'administrator', '登陆成功', '0.0.0.0', 1504919198),
	(102, 'admin', '登陆成功', '0.0.0.0', 1504919305),
	(103, 'administrator', '登陆成功', '0.0.0.0', 1504919520);
/*!40000 ALTER TABLE `dmt_log` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_members 结构
CREATE TABLE IF NOT EXISTS `dmt_members` (
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

-- 正在导出表  mtadmin.dmt_members 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_members` DISABLE KEYS */;
INSERT INTO `dmt_members` (`auto_id`, `wx_nickname`, `wx_headimgurl`, `wx_city`, `wx_openid`, `subscribe_time`, `wx_sex`, `members_status`, `recent_time`, `delete_time`, `restore_time`, `res1`, `res2`) VALUES
	(4, '程序猿豆腐', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEJlz556iafUPOyDM7ia9aSpcT8arFCjv9S1tyuicz5b3pmzgvpLC1vMRcB5DrurfqRdwMzTanDldhVLQ/0', '江西 赣州', 'ovkkfxFjMIbALZ3_ZBRobvYboEI4', '1484040473', '1', -1, '1487384275', 1491481347, 1491481354, NULL, NULL);
/*!40000 ALTER TABLE `dmt_members` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_members_sex 结构
CREATE TABLE IF NOT EXISTS `dmt_members_sex` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sex_code` int(2) NOT NULL,
  `sex_name` varchar(32) NOT NULL,
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/16\n会员性别表';

-- 正在导出表  mtadmin.dmt_members_sex 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `dmt_members_sex` DISABLE KEYS */;
INSERT INTO `dmt_members_sex` (`auto_id`, `sex_code`, `sex_name`) VALUES
	(1, 1, '男'),
	(2, 2, '女'),
	(3, 0, '未知');
/*!40000 ALTER TABLE `dmt_members_sex` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_members_status 结构
CREATE TABLE IF NOT EXISTS `dmt_members_status` (
  `auto_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `status_code` int(5) NOT NULL,
  `status_name` varchar(32) NOT NULL,
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/17';

-- 正在导出表  mtadmin.dmt_members_status 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `dmt_members_status` DISABLE KEYS */;
INSERT INTO `dmt_members_status` (`auto_id`, `status_code`, `status_name`) VALUES
	(1, 1, '正常'),
	(2, -1, '拉黑'),
	(3, -99, '已删除');
/*!40000 ALTER TABLE `dmt_members_status` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_msg 结构
CREATE TABLE IF NOT EXISTS `dmt_msg` (
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

-- 正在导出表  mtadmin.dmt_msg 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `dmt_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `dmt_msg` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_news 结构
CREATE TABLE IF NOT EXISTS `dmt_news` (
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
  `refreshtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=gbk;

-- 正在导出表  mtadmin.dmt_news 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `dmt_news` DISABLE KEYS */;
INSERT INTO `dmt_news` (`id`, `title`, `icon`, `iconname`, `author`, `type`, `abstract`, `tags`, `status`, `views`, `addtime`, `refreshtime`) VALUES
	(26, '测试文章1', '/Uploads/news_icon/20161227/586210303901a.jpg', '无动为大去', 'df', 20, '测试用的111111111111111111111', '', 1, 0, 1482759208, 0),
	(27, '公司简介', '', '', '', -1, '', '', 2, 0, 1482761621, 0);
/*!40000 ALTER TABLE `dmt_news` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_newscontent 结构
CREATE TABLE IF NOT EXISTS `dmt_newscontent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `newsid` int(10) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `describe` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=gbk;

-- 正在导出表  mtadmin.dmt_newscontent 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `dmt_newscontent` DISABLE KEYS */;
INSERT INTO `dmt_newscontent` (`id`, `newsid`, `keywords`, `describe`, `content`) VALUES
	(32, 26, '测试1,测试2,测试3', '我觉得哦啊收到哦啊啥都弄', '&lt;p&gt;大大神发发发沙发我去打饭&lt;/p&gt;'),
	(33, 27, '', '', '');
/*!40000 ALTER TABLE `dmt_newscontent` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_orderinfo 结构
CREATE TABLE IF NOT EXISTS `dmt_orderinfo` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_numbers` varchar(50) NOT NULL COMMENT '订单号',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `goods_img` varchar(50) NOT NULL COMMENT '商品图片',
  `buy_count` int(5) unsigned NOT NULL COMMENT '购买数量',
  `goods_price` float(5,2) unsigned NOT NULL COMMENT '商品单价',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017/2/10';

-- 正在导出表  mtadmin.dmt_orderinfo 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_orderinfo` DISABLE KEYS */;
INSERT INTO `dmt_orderinfo` (`auto_id`, `order_numbers`, `goods_name`, `goods_img`, `buy_count`, `goods_price`) VALUES
	(1, '20170210123456 ', '竹子', '', 2, 125.00);
/*!40000 ALTER TABLE `dmt_orderinfo` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_orders 结构
CREATE TABLE IF NOT EXISTS `dmt_orders` (
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

-- 正在导出表  mtadmin.dmt_orders 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_orders` DISABLE KEYS */;
INSERT INTO `dmt_orders` (`auto_id`, `order_numbers`, `goods_quantity`, `order_createtime`, `order_status`, `order_total`, `buyer_openid`, `address_id`, `order_paytime`, `buyer_msg`) VALUES
	(1, '20170210123456', 3, '1354795563', 100, 253.01, 'ovkkfxFjMIbALZ3_ZBRobvYboEI4', 1, 1365989566, '原图');
/*!40000 ALTER TABLE `dmt_orders` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_orderstatus 结构
CREATE TABLE IF NOT EXISTS `dmt_orderstatus` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `status_code` int(11) NOT NULL COMMENT '状态码',
  `status_name` varchar(50) NOT NULL COMMENT '状态名称',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='create by cpy 2017-2-10\n订单状态表 ';

-- 正在导出表  mtadmin.dmt_orderstatus 的数据：~5 rows (大约)
/*!40000 ALTER TABLE `dmt_orderstatus` DISABLE KEYS */;
INSERT INTO `dmt_orderstatus` (`auto_id`, `status_code`, `status_name`) VALUES
	(1, -1, '已取消'),
	(2, 1, '待付款'),
	(3, 50, '已付款'),
	(4, 100, '已发货'),
	(5, 200, '已收货，订单完成');
/*!40000 ALTER TABLE `dmt_orderstatus` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_picture 结构
CREATE TABLE IF NOT EXISTS `dmt_picture` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) NOT NULL,
  `picname` varchar(255) NOT NULL,
  `picpath` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` enum('-1','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- 正在导出表  mtadmin.dmt_picture 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_picture` DISABLE KEYS */;
INSERT INTO `dmt_picture` (`id`, `type`, `picname`, `picpath`, `des`, `addtime`, `status`) VALUES
	(5, 1, '永不关上的门', '/Uploads/uploadPic/20161231/58671c6eb5687.jpg', '永不关上的门永不关上的门', 1483152497, '1');
/*!40000 ALTER TABLE `dmt_picture` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_picturetype 结构
CREATE TABLE IF NOT EXISTS `dmt_picturetype` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `typename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- 正在导出表  mtadmin.dmt_picturetype 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_picturetype` DISABLE KEYS */;
INSERT INTO `dmt_picturetype` (`id`, `typename`) VALUES
	(1, '首页轮播');
/*!40000 ALTER TABLE `dmt_picturetype` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_qqcontact 结构
CREATE TABLE IF NOT EXISTS `dmt_qqcontact` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `qqnum` varchar(50) NOT NULL DEFAULT '0' COMMENT 'QQ号',
  `qqtitle` varchar(80) NOT NULL DEFAULT '0' COMMENT 'QQ标题',
  `status` enum('-1','1') NOT NULL DEFAULT '-1' COMMENT '启用状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='create by chenpy 2016-12-21\r\n资讯QQ 表';

-- 正在导出表  mtadmin.dmt_qqcontact 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_qqcontact` DISABLE KEYS */;
INSERT INTO `dmt_qqcontact` (`id`, `qqnum`, `qqtitle`, `status`) VALUES
	(1, '473203432', '客服一', '1');
/*!40000 ALTER TABLE `dmt_qqcontact` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_user 结构
CREATE TABLE IF NOT EXISTS `dmt_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '用户密码',
  `telephone` varchar(30) NOT NULL COMMENT '电话',
  `email` varchar(80) NOT NULL COMMENT 'email',
  `role` tinyint(5) NOT NULL COMMENT '角色id',
  `rolename` varchar(50) NOT NULL COMMENT '角色名称',
  `status` enum('-99','1') NOT NULL COMMENT '状态',
  `online` enum('-1','1') NOT NULL COMMENT '是否在线',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `des` varchar(200) NOT NULL COMMENT '描述',
  `loginnum` int(11) NOT NULL DEFAULT '1' COMMENT '登录次数',
  `recentlylogintime` int(11) NOT NULL DEFAULT '0' COMMENT '最近登录时间',
  `lastlogintime` int(11) NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `lastipaddr` varchar(50) NOT NULL DEFAULT '0.0.0.0' COMMENT '上次登录的ip',
  `recentlyipaddr` varchar(50) NOT NULL DEFAULT '0.0.0.0' COMMENT '最近登录的ip',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='create by chenpy 2016-12-20';

-- 正在导出表  mtadmin.dmt_user 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `dmt_user` DISABLE KEYS */;
INSERT INTO `dmt_user` (`id`, `username`, `password`, `telephone`, `email`, `role`, `rolename`, `status`, `online`, `addtime`, `des`, `loginnum`, `recentlylogintime`, `lastlogintime`, `lastipaddr`, `recentlyipaddr`) VALUES
	(1, 'admin', '5edbdd6c82567e78db403fe0a8eb9f49', '18279409347', '473203432@qq.com', 2, '管理员', '1', '-1', 1504877109, '无', 6, 1504919305, 1504880527, '0.0.0.0', '0.0.0.0'),
	(2, 'administrator', '3cd41089a01472c96089e8ae7eeaf5d9', '18279409347', '473203432@qq.com', 1, '超级管理员', '1', '-1', 1504878109, '无', 6, 1504919520, 1504919198, '0.0.0.0', '0.0.0.0');
/*!40000 ALTER TABLE `dmt_user` ENABLE KEYS */;

-- 导出  表 mtadmin.dmt_webbase 结构
CREATE TABLE IF NOT EXISTS `dmt_webbase` (
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

-- 正在导出表  mtadmin.dmt_webbase 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `dmt_webbase` DISABLE KEYS */;
INSERT INTO `dmt_webbase` (`id`, `webtitle`, `keyword`, `description`, `copyright`, `icp`, `countcode`, `contactemail`, `contacthotline`, `address`, `hotline`) VALUES
	(2, '', '', '', '', '', '', '', '', '', '');
/*!40000 ALTER TABLE `dmt_webbase` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
