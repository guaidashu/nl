create database `nl`;

-- qq邮箱授权码  qhopldqekufabcdc
-- 用户表
CREATE TABLE `nl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `access` int(1) NOT NULL DEFAULT '1' COMMENT '管理员权限',
  `phone` varchar(11) NOT NULL COMMENT '电话号码',
  `qq_openid` varchar(255) NOT NULL COMMENT 'qq的openid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



-- 用来存储好逗网的名字和连接
CREATE TABLE `nl_url_data` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- 用来存储薄荷网站的单个食物详细信息
create table `nl_bh_food_data`(
`id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键此表是存储来自薄荷的数据',
`name` varchar(255) NOT NULL COMMENT '食物名字',
`url` varchar(255) NOT NULL COMMENT '食物连接',
`imgurl` varchar(255) NOT NULL COMMENT '食物图片链接',
`tmpurl` varchar(255) NOT NULL COMMENT '本站所需url',
`rl` varchar(255) NOT NULL COMMENT '储存热量(大卡)',
`tshhw` varchar(255) NOT NULL COMMENT '碳水化合物',
`zf` varchar(255) NOT NULL COMMENT '脂肪',
`dbz` varchar(255) NOT NULL COMMENT '蛋白质',
`xws` varchar(255) NOT NULL COMMENT '纤维素',
`wssa` varchar(255) NOT NULL COMMENT '维生素A',
`wssc` varchar(255) NOT NULL COMMENT '维生素C',
`wsse` varchar(255) NOT NULL COMMENT '维生素E',
`hlbs` varchar(255) NOT NULL COMMENT '胡萝卜素',
`las` varchar(255) NOT NULL COMMENT '硫胺素',
`hhs` varchar(255) NOT NULL COMMENT '核黄素',
`ys` varchar(255) NOT NULL COMMENT '烟酸',
`dgc` varchar(255) NOT NULL COMMENT '胆固醇',
`mei` varchar(255) NOT NULL COMMENT '镁',
`gai` varchar(255) NOT NULL COMMENT '钙',
`tie` varchar(255) NOT NULL COMMENT '铁',
`xin` varchar(255) NOT NULL COMMENT '锌',
`tong` varchar(255) NOT NULL COMMENT '铜',
`meng` varchar(255) NOT NULL COMMENT '锰',
`jia` varchar(255) NOT NULL COMMENT '钾',
`lin` varchar(255) NOT NULL COMMENT '磷',
`na` varchar(255) NOT NULL COMMENT '钠',
`xi` varchar(255) NOT NULL COMMENT '硒',
`bm` varchar(255) NOT NULL COMMENT '别名',
`pj` varchar(255) NOT NULL COMMENT '对应的评价或者类型(比如炒)',
`pj_content` text NOT NULL COMMENT '对应的评价内容',
`fl` varchar(255) NOT NULL COMMENT '分类',
`rldetail` varchar(255) NOT NULL COMMENT '热量详细(单独页面用)',
`flurl` varchar(255) NOT NULL COMMENT '分类的连接',
`looknum` bigint(20) NOT NULL DEFAULT 1 COMMENT '访问次数',
PRIMARY KEY(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 用来存储好逗网的单个菜品信息
create table `nl_menu_data`(
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `url` varchar(255) NOT NULL COMMENT '菜品连接',
  `imgurl` varchar(255) NOT NULL COMMENT '菜品图片连接',
  `name` varchar(255) NOT NULL COMMENT '菜品名',
  `menu_describe` varchar(255) NOT NULL COMMENT '菜品描述(标签)',
  `looknum` bigint(20) NOT NULL DEFAULT 1 COMMENT '浏览次数',
  PRIMARY KEY(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;