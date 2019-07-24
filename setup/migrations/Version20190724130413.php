<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja Version20190724130413.
 */
class Version20190724130413 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slownik_tak_nie
            CHANGE wartosc wartosc VARCHAR(25) NOT NULL,
            CHANGE kod kod VARCHAR(25) NOT NULL'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4674CD8366FF8A ON slownik_tak_nie (wartosc)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4674CD13792FFA ON slownik_tak_nie (kod)');
        $this->addSql('DROP INDEX uniq_6d6a0e4b6017fd2e ON slownik_programow');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_99E857AB6017FD2E ON slownik_programow (nazwa)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DCEF7CCE6017FD2E ON slownik_form_prawnych (nazwa)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8ACC84316017FD2E ON sfz_wojewodztwo (nazwa)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_65A35506017FD2E ON slownik_skladnikow (nazwa)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slownik_tak_nie
            CHANGE wartosc wartosc LONGTEXT NOT NULL COLLATE utf8_unicode_ci,
            CHANGE kod kod LONGTEXT NOT NULL COLLATE utf8_unicode_ci'
        );
        $this->addSql('DROP INDEX UNIQ_B1E2DA8DE7927C74 ON sfz_uzytkownik');
        $this->addSql('DROP INDEX UNIQ_8ACC84316017FD2E ON sfz_wojewodztwo');
        $this->addSql('DROP INDEX UNIQ_DCEF7CCE6017FD2E ON slownik_form_prawnych');
        $this->addSql('DROP INDEX uniq_99e857ab6017fd2e ON slownik_programow');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D6A0E4B6017FD2E ON slownik_programow (nazwa)');
        $this->addSql('DROP INDEX UNIQ_65A35506017FD2E ON slownik_skladnikow');
        $this->addSql('DROP INDEX UNIQ_F4674CD8366FF8A ON slownik_tak_nie');
        $this->addSql('DROP INDEX UNIQ_F4674CD13792FFA ON slownik_tak_nie');
        */
    }
}
