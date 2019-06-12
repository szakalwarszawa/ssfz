<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja 20190611114424.
 * Zgloszenie https://redmine.parp.gov.pl/issues/68597
 */
class Version20190611114424 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD uwagi VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD uwagi VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
        
        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP uwagi');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP uwagi');
        */
    }
}
