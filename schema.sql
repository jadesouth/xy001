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

-- Table: `user` 用户表
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `login_email` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '名字',
  `post_name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '邮寄姓名',
  `post_phone` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '邮寄电话',
  `post_addr` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '邮寄地址',
  `password` CHAR(32) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` CHAR(6) NOT NULL DEFAULT '' COMMENT '盐',
  `status` TINYINT(4) NOT NULL DEFAULT 0 COMMENT '状态[0:正常,1:禁用]',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_login_email` (`login_email`),
  KEY `deleted_at` (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '用户表';

-- Table: `theme`
CREATE TABLE IF NOT EXISTS `theme` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` VARCHAR(255) NOT NULL DEFAULT '' '主题名称',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='盒子主题表';

-- Table: `box`
CREATE TABLE IF NOT EXISTS `box` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `theme_id` INT(10) UNSIGNED DEFAULT NULL COMMENT '主题id(FK:box_subject id)',
  `theme_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '主题名称',
  `year` INT(10) UNSIGNED NOT NULL COMMENT '年',
  `month` INT(10) UNSIGNED NOT NULL COMMENT '月',
  `monthly_price` DECIMAL(10,2) NOT NULL COMMENT '1月价格',
  `quarterly_price` DECIMAL(10,2) NOT NULL COMMENT '3月价格',
  `semiannually_price` DECIMAL(10,2) NOT NULL COMMENT '6月价格',
  `annually_price` DECIMAL(10,2) NOT NULL COMMENT '12月价格',
  `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '盒子名称',
  `tag` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '标签',
  `cover_title` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '封面标题(筛选)',
  `cover_subtitle` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '封面副标题(筛选)',
  `cover_image` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '封面图(正方形)(筛选)',
  `introduction_title` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '介绍(筛选)',
  `introduction_image` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '介绍图片(筛选)',
  `gift_introduction` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '礼物封面介绍(他人订购)',
  `gift_image` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '礼物封面(他人订购)',
  `banner_image1` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图1(详情)',
  `banner_image2` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图2(详情)',
  `banner_image3` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图3(详情)',
  `banner_image4` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图4(详情)',
  `banner_title1` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题1(详情)',
  `banner_title2` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题2(详情)',
  `banner_title3` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题3(详情)',
  `banner_title4` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '轮播图标题4(详情)',
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
  KEY `theme_id` (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='盒子信息表';

-- Table: `order`
CREATE TABLE IF NOT EXISTS `order` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `order_number` CHAR(18) NOT NULL DEFAULT '' COMMENT '订单编号',
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id(FK:user id)',
  `box_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '盒子id(FK:box id)',
  `coupon_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠券id(FK:coupon id)',
  `box_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '盒子名称',
  `coupon_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '优惠券面值',
  `plan_number` TINYINT NOT NULL DEFAULT 1 COMMENT '订购盒子几期',
  `shirt_sex` TINYINT NOT NULL DEFAULT 1 COMMENT '衬衫性别[1:男,2:女]',
  `shirt_size` ENUM('S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL') NOT NULL DEFAULT 'S' COMMENT '衬衫尺寸',
  `post_name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '邮寄姓名',
  `post_phone` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '邮寄电话',
  `post_addr` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '邮寄地址',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '状态[0:未付款,1:已付款]',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- Table: `order_plan`
CREATE TABLE IF NOT EXISTS `order_plan` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `order_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id(FK:order id)',
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id(FK:user id)',
  `box_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '盒子id(FK:box id)',
  `plan_year` MEDIUMINT NOT NULL DEFAULT 0 COMMENT '计划年份',
  `plan_month` TINYINT NOT NULL DEFAULT 0 COMMENT '计划月份',
  `plan_date` DATE NOT NULL DEFAULT '0000-00-00' COMMENT '计划日期',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '状态[0:正常邮寄,1:暂停邮寄]',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `fk_order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单计划表';

-- Table: `menu`
CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `list_order` tinyint(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态[0:正常,1:禁用]',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- Table: `coupon`
CREATE TABLE `coupon` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id(FK:user id)',
  `value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '面值',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态[0:已使用,1:未使用,2:已废弃]',
  `use_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '使用时间',
  `expiration_time` DATETIME NOT NULL DEFAULT '2199-12-31 23:59:59' COMMENT '过期时间',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY `pk_id` (`id`),
  KEY `k_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠券';