<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja Version20190627141842
 */
class Version20190627141842 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slownik_okresow_sprawozdawczych (
            id INT AUTO_INCREMENT NOT NULL,
            nazwa VARCHAR(64) NOT NULL,
            miesiac_poczatkowy SMALLINT NOT NULL,
            miesiac_koncowy SMALLINT NOT NULL,
            UNIQUE INDEX UNIQ_73EB050B6017FD2E (nazwa),
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('INSERT INTO slownik_okresow_sprawozdawczych(id, nazwa, miesiac_poczatkowy, miesiac_koncowy) VALUES
            (1, \'styczeń - grudzień\', 1, 12),
            (2, \'styczeń - czerwiec\', 1, 6),
            (3, \'lipiec - grudzień\', 7, 12)');

        // to się zmieni - na jeden wiele
        $this->addSql('ALTER TABLE slownik_programow ADD okres_sprawozdawczy_id INT NOT NULL DEFAULT 0');
        $this->addSql('UPDATE slownik_programow SET okres_sprawozdawczy_id = 2 WHERE id = 1');
        $this->addSql('UPDATE slownik_programow SET okres_sprawozdawczy_id = 1 WHERE id > 1');


        // Niesłownikowane ID okresów sprawozdawczych:
        // styczen-czerwiec miało ID 0
        // lipiec-grudzien miało ID 1
        $this->addSql('ALTER TABLE sfz_sprawozdanie DROP okres');
        $this->addSql('UPDATE sfz_sprawozdanie SET okres_id = 2 WHERE okres_id = 0');
        $this->addSql('UPDATE sfz_sprawozdanie SET okres_id = 3 WHERE okres_id = 1');
        $this->addSql('ALTER TABLE sfz_sprawozdanie ADD CONSTRAINT FK_2D75FF5A12EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('CREATE INDEX IDX_2D75FF5A12EA32C6 ON sfz_sprawozdanie (okres_id)');

        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP okres');
        $this->addSql('UPDATE sfz_sprawozdanie_poreczeniowe SET okres_id = 2 WHERE okres_id = 0');
        $this->addSql('UPDATE sfz_sprawozdanie_poreczeniowe SET okres_id = 3 WHERE okres_id = 1');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD CONSTRAINT FK_22FEB1EB12EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('CREATE INDEX IDX_22FEB1EB12EA32C6 ON sfz_sprawozdanie_poreczeniowe (okres_id)');

        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP okres');
        $this->addSql('UPDATE sfz_sprawozdanie_pozyczkowe SET okres_id = 2 WHERE okres_id = 0');
        $this->addSql('UPDATE sfz_sprawozdanie_pozyczkowe SET okres_id = 3 WHERE okres_id = 1');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD CONSTRAINT FK_DD2BEB8912EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('CREATE INDEX IDX_DD2BEB8912EA32C6 ON sfz_sprawozdanie_pozyczkowe (okres_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_sprawozdanie DROP FOREIGN KEY FK_2D75FF5A12EA32C6');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP FOREIGN KEY FK_22FEB1EB12EA32C6');
        $this->addSql('ALTER TABLE slownik_programow DROP FOREIGN KEY FK_99E857AB28E1197A');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP FOREIGN KEY FK_DD2BEB8912EA32C6');
        $this->addSql('DROP TABLE slownik_okresow_sprawozdawczych');
        $this->addSql('DROP INDEX IDX_2D75FF5A12EA32C6 ON sfz_sprawozdanie');
        $this->addSql('ALTER TABLE sfz_sprawozdanie ADD okres VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('DROP INDEX IDX_22FEB1EB12EA32C6 ON sfz_sprawozdanie_poreczeniowe');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD okres VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('DROP INDEX IDX_DD2BEB8912EA32C6 ON sfz_sprawozdanie_pozyczkowe');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD okres VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('DROP INDEX IDX_99E857AB28E1197A ON slownik_programow');
        $this->addSql('ALTER TABLE slownik_programow DROP okres_sprawozdawczy_id, CHANGE id id INT NOT NULL');
        $this->addSql('DROP INDEX uniq_99e857ab6017fd2e ON slownik_programow');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D6A0E4B6017FD2E ON slownik_programow (nazwa)');
        */
    }
}
