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