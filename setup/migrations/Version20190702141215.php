<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja 20190702141215
 */
class Version20190702141215 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_poreczen
            CHANGE kwota_por_do_50000_pln_malych_przedsiebiorstwa kwota_por_do_50000_pln_malych_przeds NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 50.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_od_50000_do_100000_pln_malych_przedsiebiorstwa kwota_por_od_50000_do_100000_pln_male_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_od_100001_do_500000_pln_malych_przedsiebiorstwa kwota_por_od_100001_do_500000_pln_male_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 100.001zł do 500.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_od_500001_pln_malych_przedsiebiorstwa kwota_por_od_500001_pln_male_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń powyżej 500.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_do_50000_pln_srednich_przedsiebiorstwa kwota_por_do_50000_pln_srednie_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 50.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_od_50000_do_100000_pln_srednich_przedsiebiorstwa kwota_por_od_50000_do_100000_pln_srednie_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_od_100001_do_500000_pln_srednich_przedsiebiorstwa kwota_por_od_100001_do_500000_pln_srednie_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 100.001zł do 500.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_od_500001_pln_srednich_przedsiebiorstwa kwota_por_od_500001_pln_srednie_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_do_50000_pln_dla_fund_pozyczkowych kwota_por_do_50000_pln_dla_fund_pozyczk NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych do 50.000zł.\',
            CHANGE kwota_por_od_50001_do_100000_pln_dla_fund_pozyczkowych kwota_por_od_50001_do_100000_pln_dla_fund_pozyczk NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.\',
            CHANGE kwota_por_od_100001_do_500000_pln_dla_fund_pozyczkowych kwota_por_od_100001_do_500000_pln_dla_fund_pozyczk NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.\',
            CHANGE kwota_por_od_500001_pln_dla_fund_pozyczkowych kwota_por_od_500001_pln_dla_fund_pozyczk NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych powyżej 500.000zł.\',
            CHANGE kwota_por_do_50000_pln_dla_innych_podmiotow kwota_por_do_50000_pln_dla_innych_podm NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów do 50.000zł.\',
            CHANGE kwota_por_od_50001_do_100000_pln_dla_innych_podmiotow kwota_por_od_50001_do_100000_pln_dla_innych_podm NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów od 50.001zł do 100.000zł.\',
            CHANGE kwota_por_od_100001_do_500000_pln_dla_innych_podmiotow kwota_por_od_100001_do_500000_pln_dla_innych_podm NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów od 100.001zł do 500.000zł.\',
            CHANGE kwota_por_od_500001_pln_dla_innych_podmiotow kwota_por_od_500001_pln_dla_innych_podm NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów powyżej 500.000zł.\',
            CHANGE liczba_wspolpracujacych_funduszy_pozyczkowych liczba_wspolpracujacych_funduszy_pozyczk INT DEFAULT 0 NOT NULL COMMENT \'Liczba współpracujących funduszy pożyczkowych.\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_poreczen
            CHANGE liczba_wspolpracujacych_funduszy_pozyczk liczba_wspolpracujacych_funduszy_pozyczkowych INT DEFAULT 0 NOT NULL COMMENT \'Liczba współpracujących funduszy pożyczkowych.\',
            CHANGE kwota_por_do_50000_pln_malych_przeds kwota_por_do_50000_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń do 50.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_od_50000_do_100000_pln_male_przedsiebiorstwa kwota_por_od_50000_do_100000_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_od_100001_do_500000_pln_male_przedsiebiorstwa kwota_por_od_100001_do_500000_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń do 100.001zł do 500.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_od_500001_pln_male_przedsiebiorstwa kwota_por_od_500001_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń powyżej 500.000zł dla małych przedsiębiorstw.\',
            CHANGE kwota_por_do_50000_pln_srednie_przedsiebiorstwa kwota_por_do_50000_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń do 50.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_od_50000_do_100000_pln_srednie_przedsiebiorstwa kwota_por_od_50000_do_100000_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_od_100001_do_500000_pln_srednie_przedsiebiorstwa kwota_por_od_100001_do_500000_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń do 100.001zł do 500.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_od_500001_pln_srednie_przedsiebiorstwa kwota_por_od_500001_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.\',
            CHANGE kwota_por_do_50000_pln_dla_fund_pozyczk kwota_por_do_50000_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych do 50.000zł.\',
            CHANGE kwota_por_od_50001_do_100000_pln_dla_fund_pozyczk kwota_por_od_50001_do_100000_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.\',
            CHANGE kwota_por_od_100001_do_500000_pln_dla_fund_pozyczk kwota_por_od_100001_do_500000_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.\',
            CHANGE kwota_por_od_500001_pln_dla_fund_pozyczk kwota_por_od_500001_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych powyżej 500.000zł.\',
            CHANGE kwota_por_do_50000_pln_dla_innych_podm kwota_por_do_50000_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów do 50.000zł.\',
            CHANGE kwota_por_od_50001_do_100000_pln_dla_innych_podm kwota_por_od_50001_do_100000_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów od 50.001zł do 100.000zł.\',
            CHANGE kwota_por_od_100001_do_500000_pln_dla_innych_podm kwota_por_od_100001_do_500000_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów od 100.001zł do 500.000zł.\',
            CHANGE kwota_por_od_500001_pln_dla_innych_podm kwota_por_od_500001_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów powyżej 500.000zł.\'');
        */
    }
}
