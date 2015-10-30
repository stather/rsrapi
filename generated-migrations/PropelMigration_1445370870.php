<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1445370870.
 * Generated on 2015-10-20 19:54:30 by russellstather
 */
class PropelMigration_1445370870
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

ALTER TABLE `reward`

  ADD `x` DOUBLE AFTER `name`,

  ADD `y` DOUBLE AFTER `x`,

  ADD `scale` DOUBLE AFTER `y`;

DROP INDEX `emaiIndex` ON `user`;

CREATE UNIQUE INDEX `emaiIndex` ON `user` (`email`(255));

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

ALTER TABLE `reward`

  DROP `x`,

  DROP `y`,

  DROP `scale`;

DROP INDEX `emaiIndex` ON `user`;

CREATE UNIQUE INDEX `emaiIndex` ON `user` (`email`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}