<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Zgłoszenie https://redmine.parp.gov.pl/issues/68572
 */
class Version20190531153340 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slownik_program (id INT NOT NULL, kolejnosc INT NOT NULL, nazwa VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_6D6A0E4B6017FD2E (nazwa), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        
        $this->addSql('INSERT INTO slownik_program(id, kolejnosc, nazwa)
            VALUES
            (31, 1, \'Fundusz zalążkowy POIG 3.1\'),
            (121, 2, \'Fundusz pożyczkowy SPO WKP 1.2.1\'),
            (122, 3, \'Fundusz poręczeniowy SPO WKP 1.2.2\')
        ');
        
        $this->addSql('ALTER TABLE sfz_uzytkownik ADD aktywny_program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sfz_uzytkownik ADD CONSTRAINT FK_B1E2DA8D26B4F225 FOREIGN KEY (aktywny_program_id) REFERENCES slownik_program (id)');
        $this->addSql('CREATE INDEX IDX_B1E2DA8D26B4F225 ON sfz_uzytkownik (aktywny_program_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_uzytkownik DROP FOREIGN KEY FK_B1E2DA8D26B4F225');
        $this->addSql('DROP INDEX IDX_B1E2DA8D26B4F225 ON sfz_uzytkownik');
        $this->addSql('ALTER TABLE sfz_uzytkownik DROP aktywny_program_id');

        $this->addSql('DROP TABLE slownik_program');
    }
}
