<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja 20190619145032.
 */
class Version20190619145032 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('ALTER TABLE sfz_dane_pozyczek DROP FOREIGN KEY FK_5C2DA7269BFE310C');
        $this->addSql('ALTER TABLE sfz_dane_pozyczek
            ADD liczba_poz_aktywnych_ogolem INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek aktywnych ogółem.\',
            ADD liczba_poz_aktywnych_splacanych_terminowo INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek aktywnych spłacanych terminowo.\',
            ADD liczba_poz_aktywnych_wymagajacych_monitorowania INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek aktywnych wymagających monitorowania.\',
            ADD liczba_poz_straconych INT DEFAULT 0 NOT NULL COMMENT \'Liczba pożyczek straconych.\',
            ADD kwota_poz_aktywnych_ogolem NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pożyczek aktywnych ogółem (PLN).\',
            ADD kwota_poz_aktywnych_splacanych_terminowo NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pożyczek aktywnych spłacanych terminowo (PLN).\',
            ADD kwota_poz_aktywnych_wymagajacych_monitorowania NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pożyczek aktywnych wymagających szczególnego monitorowania (PLN).\',
            ADD kwota_poz_straconych NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pożyczek straconych (PLN).\',
            ADD wspolczynnik_strat_w_danym_okresie_wg_liczby_poz NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Współczynnik strat w danym okresie wg liczby pożyczek.\',
            ADD wspolczynnik_strat_w_calym_okresie_wg_liczby_poz NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Współczynnik strat w całym okresie wg liczby pożyczek.\',
            ADD wspolczynnik_strat_w_danym_okresie_wg_kwoty_poz NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Współczynnik strat w danym okresie wg kwoty pożyczek.\',
            ADD wspolczynnik_strat_w_calym_okresie_wg_kwoty_poz NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Współczynnik strat w całym okresie wg kwoty pożyczek.\',
            CHANGE kwota_poz_od_300001_pln_dzial_rinne kwota_poz_od_300001_pln_dzial_inne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pożyczek na działania inne od 301.000zł.\'');
        $this->addSql('ALTER TABLE sfz_dane_pozyczek ADD CONSTRAINT FK_5C2DA7269BFE310C FOREIGN KEY (sprawozdanie_id) REFERENCES sfz_sprawozdanie_pozyczkowe (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_pozyczek DROP FOREIGN KEY FK_5C2DA7269BFE310C');
        $this->addSql('ALTER TABLE sfz_dane_pozyczek DROP liczba_poz_aktywnych_ogolem, DROP liczba_poz_aktywnych_splacanych_terminowo, DROP liczba_poz_aktywnych_wymagajacych_monitorowania, DROP liczba_poz_straconych, DROP kwota_poz_aktywnych_ogolem, DROP kwota_poz_aktywnych_splacanych_terminowo, DROP kwota_poz_aktywnych_wymagajacych_monitorowania, DROP kwota_poz_straconych, DROP wspolczynnik_strat_w_danym_okresie_wg_liczby_poz, DROP wspolczynnik_strat_w_calym_okresie_wg_liczby_poz, DROP wspolczynnik_strat_w_danym_okresie_wg_kwoty_poz, DROP wspolczynnik_strat_w_calym_okresie_wg_kwoty_poz, CHANGE kwota_poz_od_300001_pln_dzial_inne kwota_poz_od_300001_pln_dzial_rinne NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota pożyczek na działania inne od 301.000zł.\'');
        $this->addSql('ALTER TABLE sfz_dane_pozyczek ADD CONSTRAINT FK_5C2DA7269BFE310C FOREIGN KEY (sprawozdanie_id) REFERENCES sfz_sprawozdanie (id)');
        */
    }
}
