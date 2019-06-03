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

        $this->addSql('CREATE TABLE slownik_programow (id INT NOT NULL, nazwa VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_6D6A0E4B6017FD2E (nazwa), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        
        $this->addSql('INSERT INTO slownik_programow(id, nazwa)
            VALUES
            (1, \'Fundusz zalążkowy POIG 3.1\'),
            (2, \'Fundusz pożyczkowy SPO WKP 1.2.1\'),
            (3, \'Fundusz poręczeniowy SPO WKP 1.2.2\')
        ');
        
        $this->addSql('ALTER TABLE sfz_uzytkownik ADD aktywny_program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sfz_uzytkownik ADD CONSTRAINT FK_B1E2DA8D26B4F225 FOREIGN KEY (aktywny_program_id) REFERENCES slownik_programow (id)');
        $this->addSql('CREATE INDEX IDX_B1E2DA8D26B4F225 ON sfz_uzytkownik (aktywny_program_id)');

        $this->addSql('ALTER TABLE sfz_beneficjent ADD program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sfz_beneficjent ADD CONSTRAINT FK_E6EB7B263EB8070A FOREIGN KEY (program_id) REFERENCES slownik_programow (id)');
        $this->addSql('CREATE INDEX IDX_E6EB7B263EB8070A ON sfz_beneficjent (program_id)');
        $this->addSql('UPDATE sfz_beneficjent SET program_id = 1');

        $this->addSql('ALTER TABLE sfz_beneficjent ADD uzytkownik_id INT NOT NULL');
        
        $this->addSql('UPDATE sfz_uzytkownik u, sfz_beneficjent b
            SET b.uzytkownik_id = u.id
            WHERE u.beneficjent_id = b.id'
        );
        $this->addSql('DELETE FROM sfz_beneficjent WHERE uzytkownik_id = 0 AND nazwa IS NULL AND adr_wojewodztwo IS NULL');
        $this->addSql('ALTER TABLE sfz_beneficjent ADD CONSTRAINT FK_E6EB7B2631D6FDE9 FOREIGN KEY (uzytkownik_id) REFERENCES sfz_uzytkownik (id)');
        $this->addSql('CREATE INDEX IDX_E6EB7B2631D6FDE9 ON sfz_beneficjent (uzytkownik_id)');
        $this->addSql('ALTER TABLE sfz_uzytkownik DROP FOREIGN KEY FK_B1E2DA8D11C95575');
        $this->addSql('DROP INDEX IDX_B1E2DA8D11C95575 ON sfz_uzytkownik');
        $this->addSql('ALTER TABLE sfz_uzytkownik DROP beneficjent_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
        
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
//        $this->addSql('ALTER TABLE sfz_uzytkownik ADD beneficjent_id INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE sfz_uzytkownik ADD CONSTRAINT FK_B1E2DA8D11C95575 FOREIGN KEY (beneficjent_id) REFERENCES sfz_beneficjent (id)');
//        $this->addSql('CREATE INDEX IDX_B1E2DA8D11C95575 ON sfz_uzytkownik (beneficjent_id)');
//        
//        $this->addSql('DELETE FROM sfz_umowa WHERE beneficjent_id IN(SELECT id FROM sfz_beneficjent WHERE program_id <> 1)');
//        $this->addSql('DELETE FROM sfz_osoba_zatrudniona WHERE beneficjent_id IN(SELECT id FROM sfz_beneficjent WHERE program_id <> 1)');
//        $this->addSql('DELETE FROM sfz_beneficjent WHERE program_id <> 1');
//
//        $this->addSql('UPDATE sfz_uzytkownik u, sfz_beneficjent b
//            SET u.beneficjent_id = b.id
//            WHERE b.uzytkownik_id = u.id'
//        );
//
//        $this->addSql('ALTER TABLE sfz_beneficjent DROP FOREIGN KEY FK_E6EB7B2631D6FDE9');
//        $this->addSql('DROP INDEX IDX_E6EB7B2631D6FDE9 ON sfz_beneficjent');
//        $this->addSql('ALTER TABLE sfz_beneficjent DROP uzytkownik_id');
//
//        $this->addSql('ALTER TABLE sfz_beneficjent DROP FOREIGN KEY FK_E6EB7B263EB8070A');
//        $this->addSql('DROP INDEX IDX_E6EB7B263EB8070A ON sfz_beneficjent');
//        $this->addSql('ALTER TABLE sfz_beneficjent DROP program_id');
//
//        $this->addSql('ALTER TABLE sfz_uzytkownik DROP FOREIGN KEY FK_B1E2DA8D26B4F225');
//        $this->addSql('DROP INDEX IDX_B1E2DA8D26B4F225 ON sfz_uzytkownik');
//        $this->addSql('ALTER TABLE sfz_uzytkownik DROP aktywny_program_id');
//
//        $this->addSql('DROP TABLE slownik_programow');
    }
}
