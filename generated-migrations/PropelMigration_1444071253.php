<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1444071253.
 * Generated on 2015-10-05 18:54:13 by russellstather
 */
class PropelMigration_1444071253
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP INDEX `emaiIndex` ON `user`;

CREATE UNIQUE INDEX `emaiIndex` ON `user` (`email`(255));

CREATE TABLE `scene`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `image` VARCHAR(64) NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `reward`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `animationName` VARCHAR(64) NOT NULL,
    `level` INTEGER NOT NULL,
    `scene` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `scene`;

DROP TABLE IF EXISTS `reward`;

DROP INDEX `emaiIndex` ON `user`;

CREATE UNIQUE INDEX `emaiIndex` ON `user` (`email`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}