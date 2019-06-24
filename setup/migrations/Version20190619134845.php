<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Zgłoszenie https://redmine.parp.gov.pl/issues/83775
 */
class Version20190619134845 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slownik_czestotliwosc_sprawozdan (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_787003B86017FD2E (nazwa), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO slownik_czestotliwosc_sprawozdan(id, nazwa) VALUES
            (1, \'Roczna\'),
            (2, \'Co pół roku\')'
        );
        $this->addSql('ALTER TABLE slownik_programow ADD czestotliwosc_sprawozdan_id INT DEFAULT NULL');
        $this->addSql('UPDATE slownik_programow SET czestotliwosc_sprawozdan_id = 2 WHERE id = 1');
        $this->addSql('UPDATE slownik_programow SET czestotliwosc_sprawozdan_id = 1 WHERE id > 1');
        $this->addSql('ALTER TABLE slownik_programow ADD CONSTRAINT FK_99E857AB5C03E44 FOREIGN KEY (czestotliwosc_sprawozdan_id) REFERENCES slownik_czestotliwosc_sprawozdan (id)');
        $this->addSql('CREATE INDEX IDX_99E857AB5C03E44 ON slownik_programow (czestotliwosc_sprawozdan_id)');
        $this->addSql('CREATE TABLE slownik_okresow_sprawozdawczych (id INT AUTO_INCREMENT NOT NULL, czestotliwosc_sprawozdan_id INT NOT NULL, nazwa VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_73EB050B6017FD2E (nazwa), INDEX IDX_73EB050B5C03E44 (czestotliwosc_sprawozdan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO slownik_okresow_sprawozdawczych(id, czestotliwosc_sprawozdan_id, nazwa) VALUES
            (1, 1, \'styczeń - grudzień\'),
            (2, 2, \'styczeń - czerwiec\'),
            (3, 2, \'lipiec - grudzień\')'
        );
        $this->addSql('ALTER TABLE slownik_okresow_sprawozdawczych ADD CONSTRAINT FK_73EB050B5C03E44 FOREIGN KEY (czestotliwosc_sprawozdan_id) REFERENCES slownik_czestotliwosc_sprawozdan (id)');
        
        $this->addSql('ALTER TABLE sfz_sprawozdanie DROP okres');
        $this->addSql('UPDATE sfz_sprawozdanie SET okres_id = okres_id + 2 WHERE okres_id < 2');
        $this->addSql('ALTER TABLE sfz_sprawozdanie ADD CONSTRAINT FK_2D75FF5A12EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('CREATE INDEX IDX_2D75FF5A12EA32C6 ON sfz_sprawozdanie (okres_id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP okres');
        $this->addSql('UPDATE sfz_sprawozdanie_poreczeniowe SET okres_id = okres_id + 2 WHERE okres_id < 2');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD CONSTRAINT FK_22FEB1EB12EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('CREATE INDEX IDX_22FEB1EB12EA32C6 ON sfz_sprawozdanie_poreczeniowe (okres_id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP okres');
        $this->addSql('UPDATE sfz_sprawozdanie_pozyczkowe SET okres_id = okres_id + 2 WHERE okres_id < 2');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD CONSTRAINT FK_DD2BEB8912EA32C6 FOREIGN KEY (okres_id) REFERENCES slownik_okresow_sprawozdawczych (id)');
        $this->addSql('CREATE INDEX IDX_DD2BEB8912EA32C6 ON sfz_sprawozdanie_pozyczkowe (okres_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

//        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('ALTER TABLE slownik_programow DROP FOREIGN KEY FK_99E857AB5C03E44');
//        $this->addSql('ALTER TABLE slownik_programow DROP czestotliwosc_sprawozdan_id');
//        $this->addSql('DROP TABLE slownik_czestotliwosc_sprawozdan');
//        $this->addSql('DROP TABLE slownik_okresow_sprawozdawczych');
    }
}
