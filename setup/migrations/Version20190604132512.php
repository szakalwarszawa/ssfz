<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190604132512 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
            CREATE TABLE sessions (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sess_id VARCHAR(128) NOT NULL,
                sess_data BLOB NOT NULL,
                sess_time INTEGER UNSIGNED NOT NULL,
                sess_lifetime INTEGER NOT NULL
            ) COLLATE utf8_bin, ENGINE = InnoDB;
        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
    }
}
