-- Table: `admin` 管理员表
CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `login_name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` CHAR(32) NOT NULL DEFAULT '' COMMENT '加密后的登录密码',
  `salt` CHAR(6) NOT NULL DEFAULT '' COMMENT '密码加密盐值',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '状态[0:正常,1:禁用]',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `login_name` (`login_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '管理员表';

-- Table: `box_subject`
CREATE TABLE IF NOT EXISTS `box_subject` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` VARCHAR(255) NOT NULL DEFAULT '' '主题名称',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='盒子主题表';

-- Table: `box`
CREATE TABLE IF NOT EXISTS `box` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `subject_id` INT(10) UNSIGNED DEFAULT NULL COMMENT '主题id(FK:box_subject id)',
  `year` INT(10) UNSIGNED NOT NULL COMMENT '年',
  `month` INT(10) UNSIGNED NOT NULL COMMENT '月',
  `monthly_price` DECIMAL(10,2) NOT NULL COMMENT '1月价格',
  `quarterly_price` DECIMAL(10,2) NOT NULL COMMENT '3月价格',
  `semiannually_price` DECIMAL(10,2) NOT NULL COMMENT '6月价格',
  `annually_price` DECIMAL(10,2) NOT NULL COMMENT '12月价格',
  `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '盒子名称',
  `cover_title` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '封面标题(筛选)',
  `cover_subtitle` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '封面副标题(筛选)',
  `cover_image` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '封面图(正方形)(筛选)',
  `introduction_title` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '介绍(筛选)',
  `introduction_image` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '介绍图片(筛选)',
  `gift_introduction` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '礼物封面介绍(他人订购)',
  `gift_image` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '礼物封面(他人订购)',
  `bannber_image1` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图1(详情)',
  `bannber_image2` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图2(详情)',
  `bannber_image3` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图3(详情)',
  `bannber_image4` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图4(详情)',
  `bannber_title1` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题1(详情)',
  `bannber_title2` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题2(详情)',
  `bannber_title3` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题3(详情)',
  `bannber_title4` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题4(详情)',
  `image1` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '物品图1(主页)',
  `image2` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '物品图2(主页)',
  `image3` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '物品图3(主页)',
  `image4` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '物品图4(主页)',
  `characteristic` TEXT NOT NULL DEFAULT '' COMMENT '特征',
  `logistics` TEXT NOT NULL DEFAULT '' COMMENT '送货',
  `about` TEXT NOT NULL DEFAULT '' COMMENT '关于主题',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='盒子信息表';
>>>>>>> haokaiyang_dev
