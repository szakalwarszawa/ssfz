<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190612144120 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_pozyczek
            DROP liczba_poz_do_10000_pln_inne_przedsiebiorstwa,
            DROP liczba_poz_od_10001_do_30000_pln_inne_przedsiebiorstwa,
            DROP liczba_poz_od_30001_do_50000_pln_inne_przedsiebiorstwa,
            DROP liczba_poz_od_50001_do_120000_pln_inne_przedsiebiorstwa,
            DROP liczba_poz_od_120001_do_300000_pln_inne_przedsiebiorstwa,
            DROP liczba_poz_od_300001_pln_inne_przedsiebiorstwa,
            DROP liczba_poz_do_10000_pln_inst_ekonomii_spol,
            DROP liczba_poz_od_10001_do_30000_pln_inst_ekonomii_spol,
            DROP liczba_poz_od_30001_do_50000_pln_inst_ekonomii_spol,
            DROP liczba_poz_od_50001_do_120000_pln_inst_ekonomii_spol,
            DROP liczba_poz_od_120001_do_300000_pln_inst_ekonomii_spol,
            DROP liczba_poz_od_300001_pln_inst_ekonomii_spol');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
        
        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_pozyczek
            ADD liczba_poz_do_10000_pln_inne_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek do 10.000zł dla innych przedsiębiorstw.\',
            ADD liczba_poz_od_10001_do_30000_pln_inne_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.\',
            ADD liczba_poz_od_30001_do_50000_pln_inne_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 30.001zł do 50.000zł dla innych_przedsiębiorstw.\',
            ADD liczba_poz_od_50001_do_120000_pln_inne_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.\',
            ADD liczba_poz_od_120001_do_300000_pln_inne_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 120.001zł do 300.000zł dla inne przedsiębiorstw.\',
            ADD liczba_poz_od_300001_pln_inne_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 301.000zł dla innych przedsiębiorstw.\',
            ADD liczba_poz_do_10000_pln_inst_ekonomii_spol INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek do 10.000zł dla instytucji ekonomii spolecznej.\',
            ADD liczba_poz_od_10001_do_30000_pln_inst_ekonomii_spol INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.\',
            ADD liczba_poz_od_30001_do_50000_pln_inst_ekonomii_spol INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.\',
            ADD liczba_poz_od_50001_do_120000_pln_inst_ekonomii_spol INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.\',
            ADD liczba_poz_od_120001_do_300000_pln_inst_ekonomii_spol INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.\',
            ADD liczba_poz_od_300001_pln_inst_ekonomii_spol INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek od 301.000zł dla instytucji ekonomii spolecznej.\'');
        */
    }
}
