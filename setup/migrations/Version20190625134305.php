<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja 20190625134305
 */
class Version20190625134305 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sfz_dane_poreczen (
            id INT AUTO_INCREMENT NOT NULL,
            sprawozdanie_id INT NOT NULL,
            liczba_por_do_50000_pln_mikro_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń do 50.000zł dla mikro przedsiębiorstw.\',
            liczba_por_od_50000_do_100000_pln_mikro_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.\',
            liczba_por_od_100001_do_500000_pln_mikro_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń do 100.001zł do 500.000zł dla mikro przedsiębiorstw.\',
            liczba_por_od_500001_pln_mikro_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.\',
            liczba_por_do_50000_pln_malych_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń do 50.000zł dla małych przedsiębiorstw.\',
            liczba_por_od_50000_do_100000_pln_malych_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.\',
            liczba_por_od_100001_do_500000_pln_malych_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń do 100.001zł do 500.000zł dla małych przedsiębiorstw.\',
            liczba_por_od_500001_pln_malych_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń powyżej 500.000zł dla małych przedsiębiorstw.\',
            liczba_por_do_50000_pln_srednich_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń do 50.000zł dla średnich przedsiębiorstw.\',
            liczba_por_od_50000_do_100000_pln_srednich_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.\',
            liczba_por_od_100001_do_500000_pln_srednich_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń do 100.001zł do 500.000zł dla średnich przedsiębiorstw.\',
            liczba_por_od_500001_pln_srednich_przedsiebiorstwa INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.\',
            liczba_por_na_kredyt_obrotowy_do_50000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt obrotowy do 50.000zł.\',
            liczba_por_na_kredyt_obrotowy_od_50001_do_100000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.\',
            liczba_por_na_kredyt_obrotowy_od_100001_do_500000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.\',
            liczba_por_na_kredyt_obrotowy_od_500001_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt obrotowy powyżej 500.000zł.\',
            liczba_por_na_kredyt_inwestycyjny_do_50000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt inwestycyjny do 50.000zł.\',
            liczba_por_na_kredyt_inwestycyjny_od_50001_do_100000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.\',
            liczba_por_na_kredyt_inwestycyjny_od_100001_do_500000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.\',
            liczba_por_na_kredyt_inwestycyjny_od_500001_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na kredyt inwestycyjny powyżej 500.000zł.\',
            liczba_por_na_pozyczke_obrotowa_do_50000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pożyczkę obrotową do 50.000zł.\',
            liczba_por_na_pozyczke_obrotowa_od_50001_do_100000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pożyczkę obrotową od 50.001zł do 100.000zł.\',
            liczba_por_na_pozyczke_obrotowa_od_100001_do_500000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pożyczkę obrotową od 100.001zł do 500.000zł.\',
            liczba_por_na_pozyczke_obrotowa_od_500001_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pożyczkę obrotową powyżej 500.000zł.\',
            liczba_por_na_pozyczke_inwestycyjna_do_50000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pozyczkę inwestycyjną do 50.000zł.\',
            liczba_por_na_pozyczke_inwestycyjna_od_50001_do_100000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.\',
            liczba_por_na_pozyczke_inwestycyjna_od_100001_do_500000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.\',
            liczba_por_na_pozyczke_inwestycyjna_od_500001_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.\',
            liczba_por_pozostalych_do_50000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba pozostałych poręczeń do 50.000zł.\',
            liczba_por_pozostalych_od_50001_do_100000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba pozostałych poręczeń od 50.001zł do 100.000zł.\',
            liczba_por_pozostalych_od_100001_do_500000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba pozostałych poręczeń od 100.001zł do 500.000zł.\',
            liczba_por_pozostalych_od_500001_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba pozostałych poręczeń powyżej 500.000zł.\',
            liczba_wadiow_por_pozostalych_do_50000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba wadiów w pozostałych poręczeniach do 50.000zł.\',
            liczba_wadiow_por_pozostalych_od_50001_do_100000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.\',
            liczba_wadiow_por_pozostalych_od_100001_do_500000_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.\',
            liczba_wadiow_por_pozostalych_od_500001_pln INT DEFAULT 0 NOT NULL COMMENT \'Liczba wadiów w pozostałych poręczeniach powyżej 500.000zł.\',
            liczba_por_do_50000_pln_dzial_produkcyjne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania produkcyjne do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dzial_produkcyjne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania produkcyjne od 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dzial_produkcyjne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania produkcyjne od 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dzial_produkcyjne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania produkcyjne powyżej 500.000zł.\',
            liczba_por_do_50000_pln_dzial_handlowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania handlowe do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dzial_handlowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania handlowe od 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dzial_handlowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania handlowe od 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dzial_handlowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania handlowe powyżej 500.000zł.\',
            liczba_por_do_50000_pln_dzial_uslugowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania usługowe do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dzial_uslugowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania usługowe od 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dzial_uslugowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania usługowe od 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dzial_uslugowe INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania usługowe powyżej 500.000zł.\',
            liczba_por_do_50000_pln_dzial_budownicze INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania budowniczedo do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dzial_budownicze INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania budowniczeod 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dzial_budownicze INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania budowniczeod 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dzial_budownicze INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania budowniczepowyżej 500.000zł.\',
            liczba_por_do_50000_pln_dzial_inne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania inne do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dzial_inne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania inne od 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dzial_inne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania inne od 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dzial_inne INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń na działania inne powyżej 500.000zł.\',
            liczba_por_do_50000_pln_dla_bankow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla banków do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dla_bankow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla banków od 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dla_bankow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla banków od 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dla_bankow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla banków powyżej 500.000zł.\',
            liczba_por_do_50000_pln_dla_fund_pozyczkowych INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla funduszy pożyczkowych do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dla_fund_pozyczkowych INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dla_fund_pozyczkowych INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dla_fund_pozyczkowych INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla funduszy pożyczkowych powyżej 500.000zł.\',
            liczba_por_do_50000_pln_dla_innych_podmiotow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla innych podmiotów do 50.000zł.\',
            liczba_por_od_50001_do_100000_pln_dla_innych_podmiotow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla innych podmiotów od 50.001zł do 100.000zł.\',
            liczba_por_od_100001_do_500000_pln_dla_innych_podmiotow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla innych podmiotów od 100.001zł do 500.000zł.\',
            liczba_por_od_500001_pln_dla_innych_podmiotow INT DEFAULT 0 NOT NULL COMMENT \'Liczba poręczeń dla innych podmiotów powyżej 500.000zł.\',
            liczba_wspolpracujacych_bankow INT DEFAULT 0 NOT NULL COMMENT \'Liczba współpracujących banków.\',
            liczba_wspolpracujacych_funduszy_pozyczkowych INT DEFAULT 0 NOT NULL COMMENT \'Liczba współpracujących funduszy pożyczkowych.\',
            liczba_innych_podmiotow_wspolpracujacych INT DEFAULT 0 NOT NULL COMMENT \'Liczba innych podmiotów współpracujących.\',
            INDEX IDX_6504AB479BFE310C (sprawozdanie_id),
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE sfz_dane_poreczen ADD CONSTRAINT FK_6504AB479BFE310C FOREIGN KEY (sprawozdanie_id) REFERENCES sfz_sprawozdanie_poreczeniowe (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sfz_dane_poreczen');
        */
    }
}
