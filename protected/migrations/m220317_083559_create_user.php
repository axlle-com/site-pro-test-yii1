<?php

class m220317_083559_create_user extends CDbMigration
{
	public function up()
	{
        $this->execute('SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0');
        $this->execute('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0');
        $this->execute("SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");

        $this->execute("
                CREATE TABLE IF NOT EXISTS `ax_user` (
                  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                  `name_full` VARCHAR(255) NOT NULL DEFAULT 'Undefined',
                  `name_short` VARCHAR(255) NOT NULL DEFAULT 'Undefined',
                  `name` VARCHAR(255) NOT NULL DEFAULT 'Undefined',
                  `patronymic` VARCHAR(255) NOT NULL DEFAULT 'Undefined',
                  `surname` VARCHAR(255) NOT NULL DEFAULT 'Undefined',
                  `email` VARCHAR(255) NOT NULL,
                  `password_hash` VARCHAR(255) NOT NULL,
                  `status` SMALLINT(6) NOT NULL DEFAULT 0,
                  `remember_token` VARCHAR(500) NULL DEFAULT NULL,
                  `auth_key` VARCHAR(32) NULL DEFAULT NULL,
                  `auth_key_google_2fa` VARCHAR(32) NULL DEFAULT NULL,
                  `password_reset_token` VARCHAR(255) NULL DEFAULT NULL,
                  `verification_token` VARCHAR(255) NULL DEFAULT NULL,
                  `created_at` INT(11) UNSIGNED NULL DEFAULT NULL,
                  `updated_at` INT(11) UNSIGNED NULL DEFAULT NULL,
                  `deleted_at` INT(11) UNSIGNED NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE INDEX `email` (`email` ASC),
                  UNIQUE INDEX `password_reset_token` (`password_reset_token` ASC),
                  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
                ENGINE = InnoDB
                DEFAULT CHARACTER SET = utf8
            ");

        $this->execute('SET SQL_MODE=@OLD_SQL_MODE');
        $this->execute('SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS');
        $this->execute('SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS');
	}

	public function down()
	{
        $this->execute('DROP TABLE IF EXISTS `ax_user`');
	}
}