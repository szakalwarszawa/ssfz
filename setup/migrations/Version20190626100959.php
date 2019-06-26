<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja 20190626100959.
 */
class Version20190626100959 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_dane_poreczen
            ADD kwota_por_do_50000_pln_mikro_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 50.000zł dla mikro przedsiębiorstw.\',
            ADD kwota_por_od_50000_do_100000_pln_mikro_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.\',
            ADD kwota_por_od_100001_do_500000_pln_mikro_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 100.001zł do 500.000zł dla mikro przedsiębiorstw.\',
            ADD kwota_por_od_500001_pln_mikro_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.\',
            ADD kwota_por_do_50000_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 50.000zł dla małych przedsiębiorstw.\',
            ADD kwota_por_od_50000_do_100000_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.\',
            ADD kwota_por_od_100001_do_500000_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 100.001zł do 500.000zł dla małych przedsiębiorstw.\',
            ADD kwota_por_od_500001_pln_malych_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń powyżej 500.000zł dla małych przedsiębiorstw.\',
            ADD kwota_por_do_50000_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 50.000zł dla średnich przedsiębiorstw.\',
            ADD kwota_por_od_50000_do_100000_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.\',
            ADD kwota_por_od_100001_do_500000_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń do 100.001zł do 500.000zł dla średnich przedsiębiorstw.\',
            ADD kwota_por_od_500001_pln_srednich_przedsiebiorstwa NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.\',
            ADD kwota_por_na_kredyt_obrotowy_do_50000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt obrotowy do 50.000zł.\',
            ADD kwota_por_na_kredyt_obrotowy_od_50001_do_100000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.\',
            ADD kwota_por_na_kredyt_obrotowy_od_100001_do_500000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.\',
            ADD kwota_por_na_kredyt_obrotowy_od_500001_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt obrotowy powyżej 500.000zł.\',
            ADD kwota_por_na_kredyt_inwestycyjny_do_50000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt inwestycyjny do 50.000zł.\',
            ADD kwota_por_na_kredyt_inwestycyjny_od_50001_do_100000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.\',
            ADD kwota_por_na_kredyt_inwestycyjny_od_100001_do_500000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.\',
            ADD kwota_por_na_kredyt_inwestycyjny_od_500001_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na kredyt inwestycyjny powyżej 500.000zł.\',
            ADD kwota_por_na_pozyczke_obrotowa_do_50000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pożyczkę obrotową do 50.000zł.\',
            ADD kwota_por_na_pozyczke_obrotowa_od_50001_do_100000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pożyczkę obrotową od 50.001zł do 100.000zł.\',
            ADD kwota_por_na_pozyczke_obrotowa_od_100001_do_500000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pożyczkę obrotową od 100.001zł do 500.000zł.\',
            ADD kwota_por_na_pozyczke_obrotowa_od_500001_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pożyczkę obrotową powyżej 500.000zł.\',
            ADD kwota_por_na_pozyczke_inwestycyjna_do_50000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pozyczkę inwestycyjną do 50.000zł.\',
            ADD kwota_por_na_pozyczke_inwestycyjna_od_50001_do_100000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.\',
            ADD kwota_por_na_pozyczke_inwestycyjna_od_100001_do_500000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.\',
            ADD kwota_por_na_pozyczke_inwestycyjna_od_500001_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.\',
            ADD kwota_por_pozostalych_do_50000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pozostałych poręczeń do 50.000zł.\',
            ADD kwota_por_pozostalych_od_50001_do_100000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pozostałych poręczeń od 50.001zł do 100.000zł.\',
            ADD kwota_por_pozostalych_od_100001_do_500000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pozostałych poręczeń od 100.001zł do 500.000zł.\',
            ADD kwota_por_pozostalych_od_500001_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota pozostałych poręczeń powyżej 500.000zł.\',
            ADD kwota_wadiow_por_pozostalych_do_50000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota wadiów w pozostałych poręczeniach do 50.000zł.\',
            ADD kwota_wadiow_por_pozostalych_od_50001_do_100000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.\',
            ADD kwota_wadiow_por_pozostalych_od_100001_do_500000_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.\',
            ADD kwota_wadiow_por_pozostalych_od_500001_pln NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota wadiów w pozostałych poręczeniach powyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dzial_produkcyjne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania produkcyjne do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dzial_produkcyjne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania produkcyjne od 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dzial_produkcyjne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania produkcyjne od 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dzial_produkcyjne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania produkcyjne powyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dzial_handlowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania handlowe do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dzial_handlowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania handlowe od 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dzial_handlowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania handlowe od 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dzial_handlowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania handlowe powyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dzial_uslugowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania usługowe do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dzial_uslugowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania usługowe od 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dzial_uslugowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania usługowe od 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dzial_uslugowe NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania usługowe powyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dzial_budownicze NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania budowniczedo do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dzial_budownicze NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania budowniczeod 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dzial_budownicze NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania budowniczeod 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dzial_budownicze NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania budowniczepowyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dzial_inne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania inne do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dzial_inne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania inne od 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dzial_inne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania inne od 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dzial_inne NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń na działania inne powyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dla_bankow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla banków do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dla_bankow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla banków od 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dla_bankow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla banków od 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dla_bankow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla banków powyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dla_fund_pozyczkowych NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla funduszy pożyczkowych powyżej 500.000zł.\',
            ADD kwota_por_do_50000_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów do 50.000zł.\',
            ADD kwota_por_od_50001_do_100000_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów od 50.001zł do 100.000zł.\',
            ADD kwota_por_od_100001_do_500000_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów od 100.001zł do 500.000zł.\',
            ADD kwota_por_od_500001_pln_dla_innych_podmiotow NUMERIC(11, 2) DEFAULT \'0\' NOT NULL COMMENT \'Kwota poręczeń dla innych podmiotów powyżej 500.000zł.\'');
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
            DROP kwota_por_do_50000_pln_mikro_przedsiebiorstwa,
            DROP kwota_por_od_50000_do_100000_pln_mikro_przedsiebiorstwa,
            DROP kwota_por_od_100001_do_500000_pln_mikro_przedsiebiorstwa,
            DROP kwota_por_od_500001_pln_mikro_przedsiebiorstwa,
            DROP kwota_por_do_50000_pln_malych_przedsiebiorstwa,
            DROP kwota_por_od_50000_do_100000_pln_malych_przedsiebiorstwa,
            DROP kwota_por_od_100001_do_500000_pln_malych_przedsiebiorstwa,
            DROP kwota_por_od_500001_pln_malych_przedsiebiorstwa,
            DROP kwota_por_do_50000_pln_srednich_przedsiebiorstwa,
            DROP kwota_por_od_50000_do_100000_pln_srednich_przedsiebiorstwa,
            DROP kwota_por_od_100001_do_500000_pln_srednich_przedsiebiorstwa,
            DROP kwota_por_od_500001_pln_srednich_przedsiebiorstwa,
            DROP kwota_por_na_kredyt_obrotowy_do_50000_pln,
            DROP kwota_por_na_kredyt_obrotowy_od_50001_do_100000_pln,
            DROP kwota_por_na_kredyt_obrotowy_od_100001_do_500000_pln,
            DROP kwota_por_na_kredyt_obrotowy_od_500001_pln,
            DROP kwota_por_na_kredyt_inwestycyjny_do_50000_pln,
            DROP kwota_por_na_kredyt_inwestycyjny_od_50001_do_100000_pln,
            DROP kwota_por_na_kredyt_inwestycyjny_od_100001_do_500000_pln,
            DROP kwota_por_na_kredyt_inwestycyjny_od_500001_pln,
            DROP kwota_por_na_pozyczke_obrotowa_do_50000_pln,
            DROP kwota_por_na_pozyczke_obrotowa_od_50001_do_100000_pln,
            DROP kwota_por_na_pozyczke_obrotowa_od_100001_do_500000_pln,
            DROP kwota_por_na_pozyczke_obrotowa_od_500001_pln,
            DROP kwota_por_na_pozyczke_inwestycyjna_do_50000_pln,
            DROP kwota_por_na_pozyczke_inwestycyjna_od_50001_do_100000_pln,
            DROP kwota_por_na_pozyczke_inwestycyjna_od_100001_do_500000_pln,
            DROP kwota_por_na_pozyczke_inwestycyjna_od_500001_pln,
            DROP kwota_por_pozostalych_do_50000_pln,
            DROP kwota_por_pozostalych_od_50001_do_100000_pln,
            DROP kwota_por_pozostalych_od_100001_do_500000_pln,
            DROP kwota_por_pozostalych_od_500001_pln,
            DROP kwota_wadiow_por_pozostalych_do_50000_pln,
            DROP kwota_wadiow_por_pozostalych_od_50001_do_100000_pln,
            DROP kwota_wadiow_por_pozostalych_od_100001_do_500000_pln,
            DROP kwota_wadiow_por_pozostalych_od_500001_pln,
            DROP kwota_por_do_50000_pln_dzial_produkcyjne,
            DROP kwota_por_od_50001_do_100000_pln_dzial_produkcyjne,
            DROP kwota_por_od_100001_do_500000_pln_dzial_produkcyjne,
            DROP kwota_por_od_500001_pln_dzial_produkcyjne,
            DROP kwota_por_do_50000_pln_dzial_handlowe,
            DROP kwota_por_od_50001_do_100000_pln_dzial_handlowe,
            DROP kwota_por_od_100001_do_500000_pln_dzial_handlowe,
            DROP kwota_por_od_500001_pln_dzial_handlowe,
            DROP kwota_por_do_50000_pln_dzial_uslugowe,
            DROP kwota_por_od_50001_do_100000_pln_dzial_uslugowe,
            DROP kwota_por_od_100001_do_500000_pln_dzial_uslugowe,
            DROP kwota_por_od_500001_pln_dzial_uslugowe,
            DROP kwota_por_do_50000_pln_dzial_budownicze,
            DROP kwota_por_od_50001_do_100000_pln_dzial_budownicze,
            DROP kwota_por_od_100001_do_500000_pln_dzial_budownicze,
            DROP kwota_por_od_500001_pln_dzial_budownicze,
            DROP kwota_por_do_50000_pln_dzial_inne,
            DROP kwota_por_od_50001_do_100000_pln_dzial_inne,
            DROP kwota_por_od_100001_do_500000_pln_dzial_inne,
            DROP kwota_por_od_500001_pln_dzial_inne,
            DROP kwota_por_do_50000_pln_dla_bankow,
            DROP kwota_por_od_50001_do_100000_pln_dla_bankow,
            DROP kwota_por_od_100001_do_500000_pln_dla_bankow,
            DROP kwota_por_od_500001_pln_dla_bankow,
            DROP kwota_por_do_50000_pln_dla_fund_pozyczkowych,
            DROP kwota_por_od_50001_do_100000_pln_dla_fund_pozyczkowych,
            DROP kwota_por_od_100001_do_500000_pln_dla_fund_pozyczkowych,
            DROP kwota_por_od_500001_pln_dla_fund_pozyczkowych,
            DROP kwota_por_do_50000_pln_dla_innych_podmiotow,
            DROP kwota_por_od_50001_do_100000_pln_dla_innych_podmiotow,
            DROP kwota_por_od_100001_do_500000_pln_dla_innych_podmiotow,
            DROP kwota_por_od_500001_pln_dla_innych_podmiotow');
            */
    }
}
