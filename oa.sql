# Host: 127.0.0.1  (Version 5.6.15-log)
# Date: 2016-12-30 14:10:41
# Generator: MySQL-Front 5.4  (Build 4.26)
# Internet: http://www.mysqlfront.de/

/*!40101 SET NAMES utf8 */;

#
# Structure for table "noah_auth_group"
#

CREATE TABLE `noah_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "noah_auth_group"
#

REPLACE INTO `noah_auth_group` VALUES (1,'超级管理员',1,'1,2,3,6,4,13,14,15,16,17,1,2,3'),(2,'销售',1,'1,23,33,43,34,35,42,52,24,25,37,53,36,59,41,54,55,56,57,58,60,61,62,68,63,64,65,66,67'),(3,'财务',1,'1,24,26,38,30,39,59,45,49,41,54,55,56,57,58,60,61,62,68,63,64,65,66,67'),(4,'总经理',1,'1,23,34,35,42,52,24,25,37,53,26,38,30,39,36,59,45,49,27,28,48,50,41,44,51,46,47,54,55,56,57,58,60,61,62,68,63,64,65,66,67'),(5,'资料管理员',1,'1,44,51,54,55,56,57,58,60,61,62,68,63,64,65,66,67');

#
# Structure for table "noah_auth_group_access"
#

CREATE TABLE `noah_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "noah_auth_group_access"
#

REPLACE INTO `noah_auth_group_access` VALUES (1,1),(2,2),(3,3),(4,2),(5,4),(6,4),(7,4),(8,5);

#
# Structure for table "noah_auth_rule"
#

CREATE TABLE `noah_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

#
# Data for table "noah_auth_rule"
#

REPLACE INTO `noah_auth_rule` VALUES (1,'Admin/Admin/index','后台首页',1,1,''),(2,'Admin/System/menu','菜单管理',1,1,''),(3,'Admin/System/add_menu','添加菜单',1,1,''),(4,'Admin/Card/index','卡片管理',1,1,''),(5,'Admin/System/index','菜单管理',1,1,''),(6,'Admin/Cai/caitype','菜品管理',1,1,''),(7,'Admin/Cai/add_caitype','添加菜品分类',1,1,''),(9,'Admin/Cai/cais','菜品管理',1,1,''),(10,'Admin/Card/add_card','添加卡片',1,1,''),(12,'Admin/Member/index','会员管理',1,1,''),(13,'Admin/Member/add_member','添加会员',1,1,''),(14,'Admin/Member/memberlist','会员列表',1,1,''),(15,'Admin/Recpos/index','首页推荐位管理',1,1,''),(16,'Admin/Order/index','订单管理',1,1,''),(17,'Admin/Order/noorder','未下单用户',1,1,''),(18,'Admin/Order/catalog','订单列表',1,1,''),(19,'Admin/Cai/index','菜品管理',1,1,''),(20,'Admin/Cai/stock','库存管理',1,1,''),(21,'Admin/Print/index','单据管理',1,1,''),(22,'Admin/Print/recovery','采收单打印',1,1,''),(23,'Admin/Project/index','项目管理',1,1,''),(24,'Admin/Finance/index','财务管理',1,1,''),(25,'Admin/Finance/application','费用申请',1,1,''),(26,'Admin/Finance/auditFees','费用审核',1,1,''),(27,'Admin/User/index','管理员管理',1,1,''),(28,'Admin/User/userlist','管理员列表',1,1,''),(29,'Admin/User/role','角色管理',1,1,''),(30,'Admin/Finance/billing','费用结算',1,1,''),(33,'Admin/Project/add','添加项目',1,1,''),(34,'Admin/Project/edit','修改项目',1,1,''),(35,'Admin/Lot/manage','标段管理',1,1,''),(36,'Admin/Finance/reimList','费用报销',1,1,''),(37,'Admin/Finance/apply','新建申请',1,1,''),(38,'Admin/Finance/check','审核申请',1,1,''),(39,'Admin/Finance/details','查看明细',1,1,''),(41,'Admin/Remind/index','今日提醒',1,1,''),(42,'Admin/Project/transfer','项目移交',1,1,''),(43,'Admin/Project/ajaxCheckProjSn','项目编号异步查询接口',1,1,''),(44,'Admin/Compile/index','汇编管理',1,1,''),(45,'Admin/Finance/endCheck','项目完结结算',1,1,''),(46,'Admin/Data/index','数据管理',1,1,''),(47,'Admin/Data/projectGather','项目汇总数据',1,1,''),(48,'Admin/User/add','添加管理员',1,1,''),(49,'Admin/Finance/endDetails','审核',1,1,''),(50,'Admin/User/update','修改管理员',1,1,''),(51,'Admin/Compile/complete','完成汇编',1,1,''),(52,'Admin/Project/delete','删除项目',1,1,''),(53,'Admin/Finance/cancel','取消申请',1,1,''),(54,'Admin/Message/index','消息管理',1,1,''),(55,'Admin/Message/newMsg','新建消息',1,1,''),(56,'Admin/Message/sendbox','发件箱',1,1,''),(57,'Admin/Message/inbox','收件箱',1,1,''),(58,'Admin/Message/detail','查看消息',1,1,''),(59,'Admin/Finance/reimbursement','明细填报',1,1,''),(60,'Admin/Notice/index','通知公告',1,1,''),(61,'Admin/Notice/add','添加通知',1,1,''),(62,'Admin/Notice/edit','修改公告',1,1,''),(63,'Admin/Notice/detail','查看公告',1,1,''),(64,'Admin/Memo/index','备忘管理',1,1,''),(65,'Admin/Memo/add','添加备忘',1,1,''),(66,'Admin/Memo/edit','修改备忘',1,1,''),(67,'Admin/Memo/delete','删除备忘',1,1,''),(68,'Admin/Notice/delete','删除通知',1,1,''),(69,'Admin/Stock/index','办公用品管理',1,1,''),(70,'Admin/Stock/info','查看库存',1,1,''),(71,'Admin/Stock/additem','新增条目',1,1,''),(72,'Admin/Stock/in','入库',1,1,''),(73,'Admin/Stock/out','出库',1,1,'');

#
# Structure for table "noah_cai_inventory"
#

CREATE TABLE `noah_cai_inventory` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `cid` bigint(11) unsigned DEFAULT NULL COMMENT '菜编号',
  `inventory` bigint(20) unsigned DEFAULT NULL COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Data for table "noah_cai_inventory"
#

REPLACE INTO `noah_cai_inventory` VALUES (1,1,0),(2,2,0),(3,3,0),(4,4,0),(5,5,0),(6,6,0),(7,7,0),(8,8,0),(9,9,0),(10,10,0),(11,11,0),(12,12,0),(13,13,0);

#
# Structure for table "noah_cai_sku"
#

CREATE TABLE `noah_cai_sku` (
  `sku_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规格id',
  `cai_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联菜品id',
  `ct_id` int(11) unsigned DEFAULT NULL COMMENT '菜品分类id',
  `sku_name` varchar(255) DEFAULT NULL COMMENT '规格名称',
  `weight` varchar(255) DEFAULT NULL COMMENT '重量',
  `price` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存数量',
  PRIMARY KEY (`sku_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

#
# Data for table "noah_cai_sku"
#

REPLACE INTO `noah_cai_sku` VALUES (1,0,NULL,'5','500',2.00,4),(2,15,7,'5','500',2.00,24),(3,16,7,'5','500',2.00,19),(4,16,7,'6','600',4.00,23),(5,17,7,'1000g','1000',20.00,34),(6,17,7,'2000g','2000',40.00,38),(7,18,6,'500g','500',2.00,19),(8,19,7,'500g','500',20.00,25),(9,20,5,'500g','500',2.00,37),(10,21,6,'500g','500',2.00,28),(11,22,6,'500g','500',20.00,30),(12,23,5,'500g','500',20.00,38),(13,23,5,'1000g','1000',4.00,26),(14,23,5,'2000g','2000',40.00,38),(15,24,7,'500g','500',4.00,33),(16,25,8,'1000g','1000',20.00,20),(17,26,5,'500g','500',40.00,38),(20,26,5,'1000g','1000',80.00,40),(21,26,5,'蓝黄色','101',41.00,41);

#
# Structure for table "noah_cais"
#

CREATE TABLE `noah_cais` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `price` decimal(10,0) DEFAULT NULL COMMENT '价格',
  `imgurl` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `weight` bigint(20) unsigned DEFAULT NULL COMMENT '重量',
  `unit` char(25) DEFAULT NULL COMMENT '单位',
  `remark` text COMMENT '备注',
  `frontsort` bigint(20) unsigned DEFAULT NULL COMMENT '排序',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '后台排序',
  `ctid` int(11) unsigned DEFAULT NULL COMMENT '分类id',
  `details` text COMMENT '简介',
  `is_rec` tinyint(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

#
# Data for table "noah_cais"
#

REPLACE INTO `noah_cais` VALUES (2,'芹菜',12,NULL,12,'单','222222',2,0,5,'222',0),(3,'肌肉',12,NULL,12,'元','2',2,0,7,'2',0),(4,'豆腐',8,NULL,333,'科','3',3,0,6,'3',0),(5,'',0,NULL,0,'','',0,0,7,'',0),(6,'',0,NULL,0,'','',0,0,7,'',0),(7,'',0,NULL,0,'','',0,0,7,'',0),(8,'dd',0,NULL,0,'','',0,0,7,'',0),(9,'',0,NULL,0,'','',0,0,7,'&lt;p&gt;eeeee&lt;/p&gt;\r\n',0),(10,'测试菜品',10,'./Public/Upload/Shop/2015-12-24/567bbef8db318.png',500,'克','备注',10,0,5,'&lt;p&gt;法所得发送颠覆&lt;/p&gt;\r\n',0),(11,'',0,'./Public/Upload/Shop/2015-12-25/567ca347462dc.png',0,'','',0,0,7,'',0),(12,'测试菜品',0,'./Public/Upload/Shop/2015-12-24/567bb6ea812db.png',0,'','',0,0,7,'',0),(13,'',0,'./Public/Upload/Shop/2015-12-25/567ca3707bb63.png',0,'','',0,0,7,'&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;./Public/Upload/Shop/2015-12-25/567cbf6d7b6de.png&quot; style=&quot;height:254px; width:363px&quot; /&gt;&lt;/p&gt;\r\n',0),(14,'guigeceshi',0,'./Public/Upload/Shop/2016-01-04/568a3322abb3d.png',0,'','',0,0,7,'',0),(15,'',0,'./Public/Upload/Shop/2016-01-04/568a33cca7e34.png',0,'','',0,0,7,'',0),(16,'cesh333',0,'./Public/Upload/Shop/2016-01-05/568b6b273174c.png',0,'','',0,0,7,'',1),(17,'cesh4',0,'./Public/Upload/Shop/2016-01-05/568b6ba8d1ac6.png',0,'','',0,0,7,'',1),(18,'dddasd',0,'./Public/Upload/Shop/2016-01-07/568df36439be8.png',0,'克','fasdfasdf',10,0,6,'',1),(19,'测试菜品1',0,'./Public/Upload/2016-01-14/56972518189b9.png',0,'克','sdf',0,0,7,'&lt;p&gt;asdfa asdf a&lt;/p&gt;\r\n',0),(20,'测试菜品2',0,'./Public/Upload/2016-01-14/569726de964ff.png',0,'克','',0,0,5,'&lt;p&gt;阿所得发送颠覆&lt;/p&gt;\r\n',0),(21,'测试菜品3',0,'./Public/Upload/2016-01-14/56972737cc8b5.png',0,'克','',0,0,6,'&lt;p&gt;阿嫂地方&lt;/p&gt;\r\n',0),(22,'测试菜品4',0,'./Public/Upload/2016-01-14/56972770e925a.png',0,'克','',0,0,6,'',0),(23,'测试菜品5',0,'./Public/Upload/2016-01-14/56972d9dbda1d.png',0,'克','',0,0,5,'',0),(24,'测试菜品6',0,'./Public/Upload/2016-01-14/569742b42256e.png',0,'克','',0,0,7,'',0),(25,'测试菜品7',0,'./Public/Upload/2016-01-14/56974611771b2.png',0,'克','',0,0,8,'',0),(26,'测试类别菜',0,'./Public/Upload/2016-01-15/56986d7f54dbe.png',0,'克','',10,0,5,'',0);

#
# Structure for table "noah_caitype"
#

CREATE TABLE `noah_caitype` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `extand` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` bigint(11) DEFAULT NULL COMMENT '排序',
  `is_toll` tinyint(1) unsigned DEFAULT NULL COMMENT '是否收费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "noah_caitype"
#

REPLACE INTO `noah_caitype` VALUES (5,'蔬菜类','免费选取蔬菜，每周2次',1,0),(6,'豆制品','333',333,0),(7,'家禽类','免费选取蔬菜，每周4次',333,0),(8,'福利赠送','',0,1);

#
# Structure for table "noah_card"
#

CREATE TABLE `noah_card` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cardnum` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `cardpassword` varchar(50) DEFAULT NULL,
  `cardname` varchar(50) DEFAULT NULL COMMENT '购卡人姓名',
  `usename` varchar(50) DEFAULT NULL COMMENT '使用人姓名',
  `cardpar` decimal(15,2) DEFAULT NULL COMMENT '卡片原价',
  `cardprice` decimal(15,2) DEFAULT NULL COMMENT '实际售价',
  `money` decimal(15,2) DEFAULT '0.00' COMMENT '总金额',
  `ymoney` decimal(15,2) DEFAULT '0.00' COMMENT '已用金额',
  `symoney` decimal(15,2) DEFAULT '0.00' COMMENT '剩余金额',
  `psnums` int(10) unsigned DEFAULT '0' COMMENT '配送次数',
  `ynums` int(10) unsigned DEFAULT '0' COMMENT '已送次数',
  `synums` int(10) unsigned DEFAULT '0' COMMENT '剩余配送次数',
  `zsnums` int(10) unsigned DEFAULT NULL,
  `cardphone` varchar(20) DEFAULT NULL COMMENT '购卡人电话',
  `memo` varchar(255) DEFAULT NULL,
  `tcontent` text COMMENT '套餐详细内容',
  `addtime` date DEFAULT NULL,
  `taocanid` tinyint(4) unsigned DEFAULT NULL COMMENT '套餐id 与套餐表的关联id',
  `userid` int(10) unsigned DEFAULT NULL COMMENT '用户id与用户表的关联id',
  `kefuid` tinyint(4) unsigned DEFAULT NULL COMMENT '客服id',
  `xiaoshouid` tinyint(4) unsigned DEFAULT NULL,
  `peisongtime` int(10) unsigned DEFAULT NULL,
  `cardtype` tinyint(2) unsigned DEFAULT NULL COMMENT '卡类别1季度2半年3年卡4计次5肉蛋6储值7套餐',
  `cardtype2` char(2) DEFAULT NULL COMMENT '卡类别附加字段',
  `is_free` tinyint(1) unsigned DEFAULT NULL COMMENT '是否免费卡',
  `is_used` tinyint(1) unsigned DEFAULT NULL COMMENT '是否开卡',
  `status` smallint(1) unsigned DEFAULT NULL,
  `starttime` date DEFAULT NULL,
  `endtime` date DEFAULT NULL,
  `deadline` date DEFAULT NULL COMMENT '过期时间',
  `is_del` tinyint(1) unsigned DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3444 DEFAULT CHARSET=utf8 COMMENT='卡片表';

#
# Data for table "noah_card"
#

REPLACE INTO `noah_card` VALUES (3334,'1','1',NULL,'1','1',1.00,1.00,1.00,0.00,0.00,1,0,0,NULL,'1',NULL,'1',NULL,NULL,1,NULL,1,NULL,NULL,NULL,1,1,NULL,'0000-00-00','0000-00-00',NULL,0),(3335,'2','1',NULL,NULL,NULL,NULL,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3336,'3','1',NULL,NULL,NULL,NULL,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3337,'4','4',NULL,'4','4',4.00,4.00,4.00,0.00,0.00,4,0,0,NULL,'4',NULL,'4',NULL,NULL,4,NULL,4,NULL,NULL,NULL,4,4,NULL,'0000-00-00','0000-00-00',NULL,0),(3338,'5','5',NULL,'5','5',5.00,5.00,5.00,0.00,0.00,5,0,0,NULL,'',NULL,'',NULL,NULL,0,NULL,0,NULL,NULL,NULL,5,5,NULL,'0000-00-00','0000-00-00',NULL,0),(3339,'6','66',NULL,'6','6',6.00,6.00,6.00,0.00,0.00,6,0,0,NULL,'6',NULL,'6',NULL,NULL,6,NULL,6,NULL,NULL,NULL,6,6,NULL,'0000-00-00','0000-00-00',NULL,0),(3340,'4','',NULL,'','',0.00,0.00,0.00,0.00,0.00,0,0,0,NULL,'',NULL,'',NULL,NULL,0,NULL,0,NULL,NULL,NULL,0,0,NULL,'0000-00-00','0000-00-00',NULL,0),(3341,'3','',NULL,'','',0.00,0.00,0.00,0.00,0.00,0,0,0,NULL,'',NULL,'',NULL,NULL,0,NULL,0,NULL,NULL,NULL,0,0,NULL,'0000-00-00','0000-00-00',NULL,0),(3342,'3','',NULL,'','',0.00,0.00,0.00,0.00,0.00,0,0,0,NULL,'',NULL,'',NULL,NULL,0,NULL,0,NULL,NULL,NULL,0,0,NULL,'0000-00-00','0000-00-00',NULL,0),(3343,'2000000','9',NULL,'Ray','Leonard',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3344,'2000001','8',NULL,'Jolie','Violet',7.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3345,'2000002','3',NULL,'Mercedes','Kasimir',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3346,'2000003','2',NULL,'Hunter','Joelle',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3347,'2000004','6',NULL,'Tara','Eden',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3348,'2000005','9',NULL,'Nigel','Ariana',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3349,'2000006','4',NULL,'Beck','Mary',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3350,'2000007','6',NULL,'Cheryl','Yardley',7.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3351,'2000008','7',NULL,'Hermione','Kyle',1.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3352,'2000009','6',NULL,'Warren','Zachery',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3353,'2000010','9',NULL,'Lara','Rylee',10.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3354,'2000011','5',NULL,'Judah','Jade',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3355,'2000012','6',NULL,'Jamalia','Jana',1.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3356,'2000013','9',NULL,'Iona','Maggy',1.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3357,'2000014','9',NULL,'Vielka','Allegra',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3358,'2000015','4',NULL,'Mollie','Jenette',1.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3359,'2000016','1',NULL,'Cailin','Genevieve',7.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3360,'2000017','7',NULL,'Morgan','Cruz',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3361,'2000018','10',NULL,'Shaeleigh','Hunter',6.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3362,'2000019','4',NULL,'Dean','Kessie',10.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3363,'2000020','8',NULL,'Aristotle','Zenaida',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3364,'2000021','8',NULL,'Dakota','Fallon',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3365,'2000022','8',NULL,'Cameron','Kiara',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3366,'2000023','6',NULL,'Laura','Ruth',10.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3367,'2000024','5',NULL,'Willa','Jeanette',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3368,'2000025','1',NULL,'Ariel','Caleb',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3369,'2000026','7',NULL,'Dale','Charity',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3370,'2000027','6',NULL,'Ella','Reed',10.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3371,'2000028','9',NULL,'Ahmed','Ali',6.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3372,'2000029','3',NULL,'Riley','Rogan',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3373,'2000030','9',NULL,'Hyatt','Lyle',10.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3374,'2000031','3',NULL,'Gage','Clarke',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3375,'2000032','6',NULL,'Dillon','Tate',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3376,'2000033','5',NULL,'Kay','Darryl',7.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3377,'2000034','10',NULL,'Lacota','Rinah',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3378,'2000035','4',NULL,'Daria','Xantha',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3379,'2000036','1',NULL,'Naomi','Cole',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3380,'2000037','2',NULL,'Aurora','Dean',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3381,'2000038','7',NULL,'Tasha','Nathan',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3382,'2000039','9',NULL,'Sage','Medge',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3383,'2000040','10',NULL,'Bo','Clark',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3384,'2000041','1',NULL,'India','Jesse',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3385,'2000042','1',NULL,'Ashton','Keelie',1.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3386,'2000043','9',NULL,'Zelda','Heather',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3387,'2000044','8',NULL,'Preston','Bethany',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3388,'2000045','9',NULL,'Vanna','Madonna',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3389,'2000046','5',NULL,'Shelley','Hiram',7.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3390,'2000047','10',NULL,'Allegra','Macy',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3391,'2000048','4',NULL,'Elmo','Regina',10.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3392,'2000049','2',NULL,'Graham','Illana',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3393,'2000050','3',NULL,'Ifeoma','Kerry',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3394,'2000051','7',NULL,'David','Armando',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3395,'2000052','2',NULL,'Stacey','Imogene',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3396,'2000053','4',NULL,'Timothy','Palmer',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3397,'2000054','4',NULL,'Jerry','Jemima',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3398,'2000055','5',NULL,'Keane','Gil',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3399,'2000056','3',NULL,'Leo','Jorden',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3400,'2000057','5',NULL,'Leslie','Patience',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3401,'2000058','7',NULL,'Eric','Shaine',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3402,'2000059','6',NULL,'Amela','Jaquelyn',6.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3403,'2000060','5',NULL,'Tyler','Micah',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3404,'2000061','8',NULL,'Kaseem','Florence',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3405,'2000062','8',NULL,'Emerald','Keelie',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3406,'2000063','7',NULL,'Imani','Colt',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3407,'2000064','6',NULL,'Andrew','Abel',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3408,'2000065','10',NULL,'Cleo','Noelle',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3409,'2000066','4',NULL,'Jordan','Alisa',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3410,'2000067','1',NULL,'Moses','Zelda',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3411,'2000068','3',NULL,'Morgan','Danielle',7.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3412,'2000069','4',NULL,'Astra','Nathan',10.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3413,'2000070','9',NULL,'Rinah','Isaac',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3414,'2000071','9',NULL,'Joel','Whoopi',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3415,'2000072','5',NULL,'Jameson','Aurelia',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3416,'2000073','6',NULL,'Amena','Grant',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3417,'2000074','3',NULL,'Glenna','Latifah',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3418,'2000075','8',NULL,'Clementine','Chantale',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3419,'2000076','1',NULL,'Lawrence','Sandra',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3420,'2000077','1',NULL,'Bree','Carson',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3421,'2000078','9',NULL,'Patrick','Jamalia',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3422,'2000079','5',NULL,'Brock','Bert',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3423,'2000080','2',NULL,'Sierra','Zia',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3424,'2000081','6',NULL,'Melanie','Devin',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3425,'2000082','1',NULL,'Porter','Dora',6.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3426,'2000083','5',NULL,'Nerea','Rhea',3.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3427,'2000084','6',NULL,'Fritz','Michael',6.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3428,'2000085','3',NULL,'Ashely','Xenos',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3429,'2000086','2',NULL,'Hall','Tatyana',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3430,'2000087','6',NULL,'Wesley','Dana',1.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3431,'2000088','10',NULL,'Colby','Alexander',4.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3432,'2000089','9',NULL,'Vera','Haviva',6.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3433,'2000090','8',NULL,'Xaviera','Dora',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3434,'2000091','9',NULL,'Perry','Jin',8.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3435,'2000092','4',NULL,'Tana','Whoopi',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3436,'2000093','3',NULL,'Yetta','Aaron',7.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3437,'2000094','7',NULL,'Paloma','Remedios',6.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3438,'2000095','4',NULL,'Nayda','Griffith',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3439,'2000096','4',NULL,'Evelyn','Kirsten',9.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3440,'2000097','6',NULL,'Heidi','Lynn',5.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3441,'2000098','1',NULL,'Eve','Noah',2.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3442,'2000099','5',NULL,'Richard','Baker',1.00,NULL,0.00,0.00,0.00,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3443,'1111111','111',NULL,'11','11',6.00,4.00,1.00,0.00,0.00,1,0,0,NULL,'1',NULL,'1',NULL,NULL,2,NULL,1,NULL,NULL,NULL,0,0,NULL,'2016-01-01','2016-01-02',NULL,0);

#
# Structure for table "noah_fee_application"
#

CREATE TABLE `noah_fee_application` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) unsigned DEFAULT NULL COMMENT '项目id',
  `fee` int(11) unsigned DEFAULT NULL COMMENT '申请金额',
  `remark` text COMMENT '备注',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '申请状态 1，待审核 2，未通过 3，已通过',
  `applicant` int(11) unsigned DEFAULT NULL COMMENT '申请人',
  `addtime` int(11) unsigned DEFAULT NULL COMMENT '申请提交时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Data for table "noah_fee_application"
#

REPLACE INTO `noah_fee_application` VALUES (1,3,50000,'这是一个测试',1,1,1454641015),(2,2,50000,'这是另一个测试11111',3,1,1454641801),(3,3,5000000,'计划',3,1,1454657615),(4,4,50000,'测试',2,1,1455194106),(5,1,5000000,'啊范德萨发达',3,1,1455504184),(6,7,50000,'备注',3,1,1455974334),(7,5,50000,'',3,1,1456538034),(8,9,3000,'发射点法',1,2,1456976036),(9,10,5000,'哦啊就是大家发',3,4,1457143402);

#
# Structure for table "noah_item"
#

CREATE TABLE `noah_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '物品名称',
  `unit` varchar(255) DEFAULT NULL COMMENT '单位',
  `stock` int(11) DEFAULT NULL COMMENT '库存数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用品表';

#
# Data for table "noah_item"
#

REPLACE INTO `noah_item` VALUES (1,'签字笔','盒',18),(2,'橡皮','个',20),(3,'圆珠笔','支',20),(4,'钢笔','支',20),(5,'复印纸','盒',20),(6,'笔记本','本',20);

#
# Structure for table "noah_log"
#

CREATE TABLE `noah_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(5) unsigned DEFAULT NULL COMMENT '用户id',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `url` varchar(255) DEFAULT NULL COMMENT '操作对应的地址',
  `method` varchar(255) DEFAULT NULL COMMENT '请求方式',
  `data` text COMMENT '数据',
  `time` varchar(255) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='系统操作日志';

#
# Data for table "noah_log"
#

REPLACE INTO `noah_log` VALUES (1,1,'admin','Admin/Member/update_member',NULL,'{\"membername\":\"Harper\",\"password\":\"\",\"shouhuoname\":\"\",\"is_sms\":\"1\",\"phone\":\"\",\"phonetwo\":\"\",\"address\":\"\",\"diancaitype\":\"\\u5b63\\u5ea6\",\"regtime\":\"2016-01-27\",\"peisongtime\":\"1,4\",\"peisongweight\":\"0\",\"vehicle\":\"1\",\"packaging\":\"1\",\"card_num\":\"\",\"deliverytimes','1453861890'),(2,1,NULL,'Admin/Card/edit','post','{\"id\":\"3443\",\"cardnum\":\"1111111\",\"password\":\"111\",\"cardname\":\"11\",\"usename\":\"11\",\"cardpar\":\"6.00\",\"cardprice\":\"4.00\",\"money\":\"1.00\",\"psnums\":\"1\",\"cardphone\":\"1\",\"tcontent\":\"1\",\"userid\":\"2\",\"xiaoshouid\":\"1\",\"is_free\":\"\",\"is_used\":\"\",\"starttime\":\"2016-01-01\",\"endtime\":\"2016-01-02\"}','1453862764'),(3,1,'admin','Admin/Card/edit','post','{\"id\":\"3443\",\"cardnum\":\"1111111\",\"password\":\"111\",\"cardname\":\"11\",\"usename\":\"11\",\"cardpar\":\"6.00\",\"cardprice\":\"4.00\",\"money\":\"1.00\",\"psnums\":\"1\",\"cardphone\":\"1\",\"tcontent\":\"1\",\"userid\":\"2\",\"xiaoshouid\":\"1\",\"is_free\":\"\",\"is_used\":\"\",\"starttime\":\"2016-01-01\",\"endtime\":\"2016-01-02\"}','1453863224');

#
# Structure for table "noah_lot"
#

CREATE TABLE `noah_lot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) unsigned DEFAULT NULL COMMENT '项目id',
  `name` varchar(255) DEFAULT NULL COMMENT '标段名称',
  `s_bidder` varchar(255) DEFAULT NULL COMMENT '中标单位',
  `bid_amount` int(11) unsigned DEFAULT NULL COMMENT '中标金额',
  `tender_fee` int(11) unsigned DEFAULT NULL COMMENT '标书费',
  `service_fee` int(11) unsigned DEFAULT NULL COMMENT '服务费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

#
# Data for table "noah_lot"
#

REPLACE INTO `noah_lot` VALUES (1,3,'一标段','测试中标公司',100000000,3000,5000),(2,3,'二标段','测试中标二公司',100000000,3000,5000),(3,2,'一标段','测试中标二公司',110000000,NULL,NULL),(4,2,'二标段','测试中标二公司',1100000000,NULL,NULL),(5,4,'一标段','测试中标公司',100000000,3000,5000),(6,4,'二标段','测试中标二公司',110000000,3000,5000),(7,7,'一标段','测试中标公司',110000000,3000,3000),(8,7,'二标段','测试中标二公司',110000000,3000,3000),(9,8,'一标段','测试中标公司',100000000,3000,5000),(10,8,'二标段','测试中标二公司',100000000,3000,5000),(11,5,'一标段','测试中标公司',100000000,3000,5000),(12,5,'二标段','测试中标二公司',110000000,3000,5000),(13,9,'一标段','中标单位1',40000,200,300),(14,9,'二标段','中标单位2',50000,200,300),(15,9,'三标段','中标单位3',60000,200,300),(16,10,'一标段','中标一公司',7000,300,200),(17,10,'二标段','中标二公司',8000,300,200),(18,10,'三标段','中标三公司',9000,300,200);

#
# Structure for table "noah_memo"
#

CREATE TABLE `noah_memo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `title` varchar(255) DEFAULT NULL COMMENT '备忘录标题',
  `content` text COMMENT '内容',
  `addtime` int(11) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='备忘录';

#
# Data for table "noah_memo"
#

REPLACE INTO `noah_memo` VALUES (1,5,'3月16日招标提醒','&lt;p&gt;啊手动阀手动阀vvv&lt;/p&gt;\r\n',1457936088),(2,5,'3月15日选专家备忘','&lt;p&gt;啊圣诞快乐减肥啦&lt;/p&gt;\r\n',1457936242),(3,5,'5个项目未结算','&lt;p&gt;啊手动阀手动阀阿斯蒂芬而恶趣天给他&lt;/p&gt;\r\n',1457937148),(4,5,'老咔叽独守空房','&lt;p&gt;啊是的看法和第三发&lt;/p&gt;\r\n',1457937157),(5,5,'啊手动阀','&lt;p&gt;哦次iasdnkoifnenkfnadsskfaks &amp;nbsp;爱神的箭flak是的11111111111111111111111111111&lt;/p&gt;\r\n',1457937214);

#
# Structure for table "noah_menu"
#

CREATE TABLE `noah_menu` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) DEFAULT '' COMMENT '菜单名称',
  `url` char(255) DEFAULT '' COMMENT '菜单地址',
  `parent_id` int(11) unsigned DEFAULT NULL COMMENT '父id',
  `rule_id` int(11) unsigned DEFAULT NULL COMMENT '认证规则id',
  `sort` int(5) DEFAULT '0' COMMENT '排序',
  `is_show` tinyint(1) unsigned DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COMMENT='后台菜单';

#
# Data for table "noah_menu"
#

REPLACE INTO `noah_menu` VALUES (1,'后台首页','Admin/Admin/index',0,1,0,1),(2,'菜单管理','Admin/System/index',0,5,0,1),(3,'添加菜单','Admin/System/add_menu',2,3,0,1),(4,'卡片管理','Admin/Card/index',0,4,0,1),(6,'菜单列表','Admin/System/menu',2,2,0,1),(7,'菜品类别管理','Admin/Cai/caitype',20,6,0,1),(10,'菜品管理','Admin/Cai/cais',20,9,0,1),(11,'添加卡片','Admin/Card/add_card',4,10,0,0),(13,'会员管理','Admin/Member/index',0,12,0,1),(14,'添加会员','Admin/Member/add_member',13,13,0,1),(15,'会员列表','Admin/Member/memberlist',13,14,0,1),(16,'首页推荐位管理','Admin/Recpos/index',0,15,0,1),(17,'订单管理','Admin/Order/index',0,16,0,1),(18,'未下单用户','Admin/Order/noorder',17,17,0,1),(19,'订单列表','Admin/Order/catalog',17,18,0,1),(20,'菜品管理','Admin/Cai/index',0,19,0,1),(21,'库存管理','Admin/Cai/stock',20,20,0,1),(22,'单据管理','Admin/Print/index',0,21,0,1),(23,'采收单打印','Admin/Print/recovery',22,22,0,1),(24,'项目管理','Admin/Project/index',0,23,0,1),(25,'财务管理','Admin/Finance/index',0,24,0,1),(26,'费用申请','Admin/Finance/application',25,25,0,1),(27,'费用审核','Admin/Finance/auditFees',25,26,0,1),(28,'管理员管理','Admin/User/index',0,27,0,1),(29,'管理员列表','Admin/User/userlist',28,28,0,1),(30,'角色管理','Admin/User/role',28,29,0,1),(31,'费用结算','Admin/Finance/billing',25,30,0,1),(34,'添加项目','Admin/Project/add',24,33,0,0),(35,'修改项目','Admin/Project/edit',24,34,0,0),(36,'标段管理','Admin/Lot/manage',24,35,0,0),(37,'费用报销','Admin/Finance/reimList',25,36,0,1),(38,'新建申请','Admin/Finance/apply',26,37,0,0),(39,'审核申请','Admin/Finance/check',27,38,0,0),(40,'查看明细','Admin/Finance/details',31,39,0,0),(41,'今日提醒','Admin/Remind/index',0,41,0,1),(42,'项目移交','Admin/Project/transfer',24,42,0,0),(43,'项目编号异步查询接口','Admin/Project/ajaxCheckProjSn',34,43,0,0),(44,'汇编管理','Admin/Compile/index',0,44,0,1),(45,'项目完结结算','Admin/Finance/endCheck',25,45,0,1),(46,'数据管理','Admin/Data/index',0,46,0,1),(47,'项目汇总数据','Admin/Data/projectGather',46,47,0,1),(48,'添加管理员','Admin/User/add',29,48,0,0),(49,'审核','Admin/Finance/endDetails',45,49,0,0),(50,'修改管理员','Admin/User/update',29,50,0,0),(51,'完成汇编','Admin/Compile/complete',44,51,0,0),(52,'删除项目','Admin/Project/delete',24,52,0,0),(53,'取消申请','Admin/Finance/cancel',26,53,0,0),(54,'消息管理','Admin/Message/index',0,54,0,1),(55,'新建消息','Admin/Message/newMsg',54,55,0,1),(56,'发件箱','Admin/Message/sendbox',54,56,0,1),(57,'收件箱','Admin/Message/inbox',54,57,0,1),(58,'查看消息','Admin/Message/detail',54,58,0,0),(59,'明细填报','Admin/Finance/reimbursement',37,59,0,0),(60,'通知公告','Admin/Notice/index',0,60,0,1),(61,'添加通知','Admin/Notice/add',60,61,0,0),(62,'修改公告','Admin/Notice/edit',60,62,0,0),(63,'查看公告','Admin/Notice/detail',0,63,0,0),(64,'备忘管理','Admin/Memo/index',0,64,0,1),(65,'添加备忘','Admin/Memo/add',64,65,0,0),(66,'修改备忘','Admin/Memo/edit',64,66,0,0),(67,'删除备忘','Admin/Memo/delete',64,67,0,0),(68,'删除通知','Admin/Notice/delete',60,68,0,0),(69,'办公用品管理','Admin/Stock/index',0,69,0,1),(70,'查看库存','Admin/Stock/info',69,70,0,1),(71,'新增条目','Admin/Stock/additem',69,71,0,1),(72,'入库','Admin/Stock/in',69,72,0,1),(73,'出库','Admin/Stock/out',69,73,0,1);

#
# Structure for table "noah_message"
#

CREATE TABLE `noah_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) unsigned DEFAULT NULL COMMENT '发信人',
  `to` int(11) unsigned DEFAULT NULL COMMENT '收信人',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `sendtime` int(11) unsigned DEFAULT NULL COMMENT '发送时间',
  `is_read` tinyint(3) unsigned DEFAULT '0' COMMENT '是否阅读',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户私信';

#
# Data for table "noah_message"
#

REPLACE INTO `noah_message` VALUES (1,1,1,'标题','&lt;p&gt;阿发&lt;/p&gt;\r\n',1457423440,1),(2,1,5,'春节通知','&lt;p&gt;根深蒂固方式发给&lt;/p&gt;\r\n',1457423563,1),(3,5,2,'总经理de xiaoxi ','&lt;p&gt;gadfgsdfretwercrct&lt;/p&gt;\r\n',1457577850,1),(4,5,2,'权限提示测试项目费用报销审核未通过','23412341234',1457598056,1),(5,5,2,'权限提示测试项目完结结算未通过','afsdfasdfasdfasdf',1457600826,1),(6,1,5,'关于我们','&lt;p&gt;asdfasdfasdf&lt;/p&gt;\r\n',1457680977,1);

#
# Structure for table "noah_notice"
#

CREATE TABLE `noah_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "noah_notice"
#

REPLACE INTO `noah_notice` VALUES (1,'春节停送通知','&lt;p&gt;ceshiasdfaksdjfi在书店&lt;/p&gt;\r\n',1457666704),(2,'通知公告2','&lt;p&gt;啊；分类；卡里打开&lt;/p&gt;\r\n',1457675862),(3,'通知公告3','&lt;p&gt;啊到底是否履行执行超滤机支持率&lt;/p&gt;\r\n',1457675876),(4,'通知公告4','&lt;p&gt;asdfasdxvkck&lt;/p&gt;\r\n\r\n&lt;p&gt;啊上的裂缝卡死了的饭卡上的&lt;/p&gt;\r\n\r\n&lt;p&gt;啊收到了发生了对方&lt;/p&gt;\r\n\r\n&lt;p&gt;啊&lt;/p&gt;\r\n\r\n&lt;p&gt;士大夫asd&amp;nbsp;&lt;/p&gt;\r\n',1457675897),(5,'通知公告5','&lt;p&gt;发生大幅拉升的法律；lkv&lt;/p&gt;\r\n\r\n&lt;p&gt;asdfaksdjfje阿斯顿发顺丰&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;asdfe&lt;/p&gt;\r\n',1457676096),(6,'通知公告6','&lt;p&gt;阿道夫&lt;/p&gt;\r\n\r\n&lt;p&gt;asdlkf撒点击发送ivirnru【&lt;/p&gt;\r\n\r\n&lt;p&gt;零库存vkjvjiifnifnoandprorvnf&lt;/p&gt;\r\n',1457676475);

#
# Structure for table "noah_order"
#

CREATE TABLE `noah_order` (
  `order_no` int(11) unsigned NOT NULL DEFAULT '0',
  `sku_id` int(11) unsigned DEFAULT NULL,
  `count` int(2) unsigned DEFAULT NULL COMMENT '数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单明细表';

REPLACE INTO `noah_orderinfo` VALUES (1,'备注','配送注意事项:','22','11111111111',2,1,4,0,1452759188,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,0.00,0,0,0),(2,'备注','配送注意事项:','22','11111111111',2,1,4,0,1452759249,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,0.00,0,0,0),(3,'备注','配送注意事项:','22','11111111111',2,1,4,0,1452759340,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,0.00,0,0,0),(4,'备注','配送注意事项:','22','11111111111',2,1,4,0,1452763164,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,0.00,0,0,0),(7,'备注:','配送注意事项:','22','11111111111',2,1,4,0,1452765571,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,0.00,0,0,0),(8,'','','22','',2,1,4,0,1452829106,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,20.00,0,1,0),(9,'ceshi','ceshi','22','',2,1,4,0,1452829401,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,40.00,0,0,0),(10,'','','22','',2,1,4,0,1452836900,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',0.00,0.00,0,1,0),(11,'','','22','',2,1,4,0,1452839283,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',260.00,40.00,9,1,0),(12,'','','22','',2,1,4,0,1452840095,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',260.00,40.00,9,1,0),(13,'','','22','',2,1,4,0,1452840179,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',280.00,20.00,8,1,0),(15,'asdfasdf','aasdfa ','22','',2,1,4,0,2016,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,0.00,95,0,0),(16,'dffdgfghgfh','adsfasdfasdfas','22','',2,1,4,0,1453219200,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,40.00,93,0,0),(17,'','','22','',2,1,4,0,1453219200,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,200.00,93,0,0),(18,'','','22','',2,1,4,0,1453219200,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,40.00,92,1,0),(19,'wbbbggbtbhghtyrffadr','afllylrrtwe','22','',2,1,4,0,1453219200,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',-200.00,200.00,-1,1,0),(20,'','','22','',2,1,4,0,1453824000,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,20.00,99,1,0),(21,'','','22','',2,1,4,0,1453824000,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,0.00,98,1,0),(23,'','','22','',2,1,4,0,1453824000,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,0.00,96,1,0),(25,'','','22','',2,1,4,0,1453824000,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',180.00,0.00,94,1,0),(26,'','','22','',2,1,4,0,1453824000,'北极功阿克苏定界符绿卡三地警方阿所得fiuvruegj ',160.00,20.00,93,1,0);

#
# Structure for table "noah_project"
#

CREATE TABLE `noah_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '项目id',
  `name` varchar(255) NOT NULL COMMENT '项目名称',
  `supervisor` int(5) unsigned DEFAULT NULL COMMENT '负责人id',
  `project_sn` varchar(255) NOT NULL COMMENT '项目编号',
  `publicity_date` int(11) unsigned DEFAULT '0' COMMENT '公示日期',
  `closing_date` int(11) unsigned DEFAULT '0' COMMENT '报名截止日期',
  `extract_date` int(11) unsigned DEFAULT '0' COMMENT '抽专家日期',
  `opening_date` int(11) unsigned DEFAULT '0' COMMENT '开标日期',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '项目状态 0未汇编未报销 1未汇编已报销 2已汇编未报销 3已汇编已报销',
  `leader_check` tinyint(3) unsigned DEFAULT '0' COMMENT '总经理审核状态 0 未审核 1 通过 2 未通过',
  `treasurer_check` tinyint(3) unsigned DEFAULT '0' COMMENT '财务审核状态 0 未审核 1 通过 2 未通过',
  `approver` int(11) unsigned DEFAULT NULL COMMENT '项目审批人',
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_sn` (`project_sn`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "noah_project"
#

REPLACE INTO `noah_project` VALUES (1,'测试项目',1,'HBSJ-2016N3333',0,0,NULL,0,1,0,0,NULL),(2,'测试项目',1,'HBSJ-2016N001',0,0,NULL,0,0,0,0,NULL),(3,'测试项目二',1,'HBSJ-2016N002',1454601600,1455465600,1454688000,1454601600,0,0,0,5),(4,'演示项目',1,'HBSJ-2016N0012',1455120000,1456416000,1455811200,1455724800,0,0,0,NULL),(5,'权限测试项目',2,'hb00001',1455638400,1455638400,1455638400,1455638400,1,0,0,NULL),(7,'演示项目11',1,'HBSJ-2016N002222',1455897600,1456675200,1456243200,1456156800,1,0,0,NULL),(8,'权限提示测试项目',2,'hb0000111',1455897600,1455897600,1455897600,1455897600,3,2,0,6),(9,'项目xxxx',2,'akdfasdf',1457020800,1457971200,1458921600,1459008000,0,0,0,NULL),(10,'20160305测试项目',4,'123123123',0,0,0,0,3,0,1,5);

#
# Structure for table "noah_reimbursement"
#

CREATE TABLE `noah_reimbursement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) unsigned DEFAULT NULL COMMENT '项目id',
  `evaluation_fee` int(11) unsigned DEFAULT NULL COMMENT '评标费',
  `venue_fee` int(11) unsigned DEFAULT NULL COMMENT '场地费',
  `travel_fee` int(11) unsigned DEFAULT NULL COMMENT '出差费',
  `travel_member` varchar(255) DEFAULT NULL COMMENT '出差人员',
  `remark` text COMMENT '备注',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '费用报销明细审核 0未审核 1未通过 2已通过',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='费用报销表';

#
# Data for table "noah_reimbursement"
#

REPLACE INTO `noah_reimbursement` VALUES (1,1,100,3000,500,'张三,李四,王五','this is a remark',0),(2,7,100,3000,500,'张三,李四,王五','阿斯蒂芬大',0),(3,8,100,3000,500,'张三,李四,王五','',1),(4,5,100,3000,500,'张三,李四,王五','',2),(5,10,200,300,300,'张三，李四，王五','阿斯蒂芬',0);

#
# Structure for table "noah_user"
#

CREATE TABLE `noah_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(255) NOT NULL DEFAULT '' COMMENT '用户密码',
  `email` char(255) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

#
# Data for table "noah_user"
#

REPLACE INTO `noah_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','test@test.com'),(2,'张三','4297f44b13955235245b2497399d7a93','zhangsan@test.com'),(3,'李四','4297f44b13955235245b2497399d7a93','lisi@test.com'),(4,'新xs','4297f44b13955235245b2497399d7a93','xinxiaoshou@test.com'),(5,'总经理1','4297f44b13955235245b2497399d7a93','zjl1@test.com'),(6,'总经理2','4297f44b13955235245b2497399d7a93','zjl2@test.com'),(7,'总经理3','4297f44b13955235245b2497399d7a93','zjl3@test.com'),(8,'欧资料','4297f44b13955235245b2497399d7a93','ozl@test.com');
