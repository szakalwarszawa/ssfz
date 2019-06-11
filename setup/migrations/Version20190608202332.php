<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Zgłoszenie https://redmine.parp.gov.pl/issues/68591
 */
class Version20190608202332 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD czy_dane_sa_prawidlowe TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD czy_dane_sa_prawidlowe TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
        
        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP czy_dane_sa_prawidlowe');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP czy_dane_sa_prawidlowe');
        */
    }
}
