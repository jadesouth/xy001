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

-- Table: `theme` 盒子主题表
CREATE TABLE IF NOT EXISTS `theme` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` VARCHAR(255) NOT NULL DEFAULT '' '主题名称',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='盒子主题表';

-- Table: `box` 盒子信息表
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

-- Table: `order` 订单表
CREATE TABLE IF NOT EXISTS `order` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `order_number` CHAR(19) NOT NULL DEFAULT '' COMMENT '订单编号',
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id(FK:user id)',
  `box_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '盒子id(FK:box id)',
  `coupon_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠券id(FK:coupon id)',
  `box_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '盒子名称',
  `coupon_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '优惠券面值',
  `upgrade_before_order_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '升级前订单价格',
  `upgrade_order_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '升级订单价格',
  `order_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '订单价格',
  `upgrade_before_pay_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '升级前支付价格',
  `upgrade_pay_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '升级支付价格',
  `pay_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '支付总价格',
  `upgrade_before_plan_number` TINYINT NOT NULL DEFAULT 0 COMMENT '升级前盒子几期',
  `upgrade_plan_number` TINYINT NOT NULL DEFAULT 0 COMMENT '升级了盒子几期',
  `plan_number` TINYINT NOT NULL DEFAULT 0 COMMENT '订购盒子总几期',
  `shirt_sex` TINYINT NOT NULL DEFAULT 1 COMMENT '衬衫性别[1:男,2:女]',
  `shirt_size` ENUM('S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL') NOT NULL DEFAULT 'S' COMMENT '衬衫尺寸',
  `post_name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '邮寄姓名',
  `post_phone` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '邮寄电话',
  `post_addr` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '邮寄地址',
  `is_gift` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否赠送[0:自己购买,1:赠送]',
  `gift_email` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '礼物收件人邮箱',
  `gift_sender_name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '礼物发件人姓名',
  `upgrade_post_name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '升级邮寄姓名',
  `upgrade_post_phone` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '升级邮寄电话',
  `upgrade_post_addr` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '升级邮寄地址',
  `upgrade_status` TINYINT NOT NULL DEFAULT 0 COMMENT '升级状态[0:升级未完成,1:升级已确认,2:升级已完成,3:升级失败]',
  `upgrade_pay_status` TINYINT NOT NULL DEFAULT 0 COMMENT '升级支付状态[0:未支付,1:已支付,2:支付成功,3:取消支付,4:支付失败]',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '状态[0:未支付,1:已支付,2:支付成功,3:取消支付,4:支付失败]',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  UNIQUE KEY `uk_order_number` (`order_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- Table: `order_plan` 订单计划表
CREATE TABLE IF NOT EXISTS `order_plan` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `order_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id(FK:order id)',
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id(FK:user id)',
  `box_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '盒子id(FK:box id)',
  `plan_year` MEDIUMINT NOT NULL DEFAULT 0 COMMENT '计划年份',
  `plan_month` TINYINT NOT NULL DEFAULT 0 COMMENT '计划月份',
  `plan_date` DATE NOT NULL DEFAULT '0000-00-00' COMMENT '计划日期',
  `sign` TINYINT NOT NULL DEFAULT 0 COMMENT '标记[0:未标记,1:已标记]',
  `is_upgrade` TINYINT NOT NULL DEFAULT 0 COMMENT '是否是升级的计划[0:否,1:是]',
  `upgrade_status` TINYINT NOT NULL DEFAULT 0 COMMENT '升级计划状态[0:升级未完成,1:升级已确认,2:升级已完成,3:升级失败]',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '状态[0:正常邮寄,1:暂停邮寄]',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `fk_order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单计划表';

-- Table: `menu` 菜单表
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

-- Table: `show_wall` 展示墙
CREATE TABLE `show_wall` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `image` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型[0:视频,1:图片]',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='展示墙';

-- Table: `coupon` 优惠券
CREATE TABLE `coupon` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id(FK:user id)',
  `value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT '面值',
  `use_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '使用时间',
  `expiration_time` DATE NOT NULL DEFAULT '2199-12-31' COMMENT '过期日期',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态[0:未使用,1:已使用,2:已过期]',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY `pk_id` (`id`),
  KEY `k_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠券';

-- Table: pay_callback_result 支付回调结果表
CREATE TABLE IF NOT EXISTS `pay_callback_result` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'FK: user id',
  `order_number` CHAR(19) NOT NULL DEFAULT '' COMMENT '支付的订单编号,商户网站唯一订单号(末位为0时是首次购买,末位为1是升级购买)',
  `notify_type` TINYINT NOT NULL DEFAULT 0 COMMENT '通知类型[0:支付宝同步通知,1:支付宝异步通知]',
  `pay_type` TINYINT NOT NULL DEFAULT 0 COMMENT '支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付]',
  `http_method` ENUM('UNKNOWN', 'GET', 'POST') NOT NULL DEFAULT 'UNKNOWN' COMMENT '回调请求的方法',
  `content` VARCHAR(8192) NOT NULL DEFAULT '' COMMENT '回调传回的内容,JSON格式',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_order_number_notify_type` (`order_number`, `notify_type`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='支付回调结果表';