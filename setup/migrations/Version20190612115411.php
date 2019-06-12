<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Zgłoszenie https://redmine.parp.gov.pl/issues/68636
 */
class Version20190612115411 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slownik_statusow_sprawozdan (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_59D383A86017FD2E (nazwa), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql(
            'INSERT INTO slownik_statusow_sprawozdan(id, nazwa)
            VALUES
            (1, \'W edycji\'),
            (2, \'Wysłane do PARP\'),
            (3, \'Zaakceptowane\'),
            (4, \'Poprawa\')'
        );

        $this->addSql('ALTER TABLE sfz_sprawozdanie CHANGE status status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sfz_sprawozdanie ADD CONSTRAINT FK_2D75FF5A7B00651C FOREIGN KEY (status) REFERENCES slownik_statusow_sprawozdan (id)');
        $this->addSql('CREATE INDEX IDX_2D75FF5A7B00651C ON sfz_sprawozdanie (status)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe CHANGE status status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD CONSTRAINT FK_22FEB1EB7B00651C FOREIGN KEY (status) REFERENCES slownik_statusow_sprawozdan (id)');
        $this->addSql('CREATE INDEX IDX_22FEB1EB7B00651C ON sfz_sprawozdanie_poreczeniowe (status)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe CHANGE status status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD CONSTRAINT FK_DD2BEB897B00651C FOREIGN KEY (status) REFERENCES slownik_statusow_sprawozdan (id)');
        $this->addSql('CREATE INDEX IDX_DD2BEB897B00651C ON sfz_sprawozdanie_pozyczkowe (status)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
        
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('ALTER TABLE sfz_sprawozdanie CHANGE status status INT NOT NULL');
//        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe CHANGE status status INT NOT NULL');
//        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe CHANGE status status INT NOT NULL');
//        $this->addSql('DROP TABLE slownik_statusow_sprawozdan');
    }
}
