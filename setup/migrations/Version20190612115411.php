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
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
        
        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE slownik_statusow_sprawozdan');
        */
    }
}
