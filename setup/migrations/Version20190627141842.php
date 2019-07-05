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

        $this->addSql('CREATE TABLE programy_okresy_sprawozdawcze (
            program_id INT NOT NULL,
            okres_sprawozdawczy_id INT NOT NULL,
            INDEX IDX_6011A9FF3EB8070A (program_id),
            INDEX IDX_6011A9FF28E1197A (okres_sprawozdawczy_id),
            PRIMARY KEY(program_id, okres_sprawozdawczy_id))
            DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE programy_okresy_sprawozdawcze ADD CONSTRAINT FK_6011A9FF3EB8070A FOREIGN KEY (program_id) REFERENCES slownik_programow (id)');
        $this->addSql('ALTER TABLE programy_okresy_sprawozdawcze ADD CONSTRAINT FK_6011A9FF28E1197A FOREIGN KEY (okres_sprawozdawczy_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('INSERT INTO programy_okresy_sprawozdawcze (program_id, okres_sprawozdawczy_id) VALUES (1, 2), (1, 3), (2, 1), (3, 1)');

        // Wcześniej okresy sprawozdawcze były półroczne: styczeń-czerwiec miało statyczne ID = 0, lipiec-grudzień ID = 1.
        // Nowe programy (ze sprawozdaniamia pożyczkowymi i poręczeniowymi) mają okres sprawozdawczy styczeń-grudzień (1 rok).
        // Nowe ID: st-gr 1, st-czer 2, lip-gr 3. 
        $this->addSql('UPDATE sfz_sprawozdanie SET okres_id = 2 WHERE okres_id = 0');
        $this->addSql('UPDATE sfz_sprawozdanie SET okres_id = 3 WHERE okres_id = 1');
        $this->addSql('UPDATE sfz_sprawozdanie_poreczeniowe SET okres_id = 1');
        $this->addSql('UPDATE sfz_sprawozdanie_pozyczkowe SET okres_id = 1');

        $this->addSql('CREATE INDEX IDX_2D75FF5A12EA32C6 ON sfz_sprawozdanie (okres_id)');
        $this->addSql('CREATE INDEX IDX_22FEB1EB12EA32C6 ON sfz_sprawozdanie_poreczeniowe (okres_id)');
        $this->addSql('CREATE INDEX IDX_DD2BEB8912EA32C6 ON sfz_sprawozdanie_pozyczkowe (okres_id)');

        $this->addSql('ALTER TABLE sfz_sprawozdanie ADD CONSTRAINT FK_2D75FF5A12EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD CONSTRAINT FK_22FEB1EB12EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD CONSTRAINT FK_DD2BEB8912EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');

        $this->addSql('ALTER TABLE sfz_sprawozdanie DROP okres');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP okres');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP okres');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        */
    }
}
