<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja Version20190719175239.
 */
class Version20190719175239 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_pozyczek DROP INDEX IDX_5C2DA7269BFE310C, ADD UNIQUE INDEX UNIQ_5C2DA7269BFE310C (sprawozdanie_id)');
        $this->addSql('ALTER TABLE sfz_dane_poreczen DROP INDEX IDX_6504AB479BFE310C, ADD UNIQUE INDEX UNIQ_6504AB479BFE310C (sprawozdanie_id)');
        $this->addSql('CREATE INDEX IDX_BC763D629BFE310C ON sfz_przeplyw_finansowy (sprawozdanie_id)');
        $this->addSql('ALTER TABLE sfz_przeplyw_finansowy ADD CONSTRAINT FK_BC763D629BFE310C FOREIGN KEY (sprawozdanie_id) REFERENCES sfz_sprawozdanie (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP czy_dane_sa_prawidlowe');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP czy_dane_sa_prawidlowe');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_poreczen DROP INDEX UNIQ_6504AB479BFE310C, ADD INDEX IDX_6504AB479BFE310C (sprawozdanie_id)');
        $this->addSql('ALTER TABLE sfz_dane_pozyczek DROP INDEX UNIQ_5C2DA7269BFE310C, ADD INDEX IDX_5C2DA7269BFE310C (sprawozdanie_id)');
        $this->addSql('ALTER TABLE sfz_przeplyw_finansowy DROP FOREIGN KEY FK_BC763D629BFE310C');
        $this->addSql('DROP INDEX IDX_BC763D629BFE310C ON sfz_przeplyw_finansowy');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD czy_dane_sa_prawidlowe TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD czy_dane_sa_prawidlowe TINYINT(1) DEFAULT \'0\' NOT NULL');
        */
    }
}
