<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Zgłoszenie https://redmine.parp.gov.pl/issues/68578
 */
class Version20190605121131 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slownik_form_prawnych (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO slownik_form_prawnych(id, nazwa)
            VALUES
            (1, \'Spółka z ograniczoną odpowiedzialnością\'),
            (2, \'Spółka akcyjna\'),
            (3, \'Stowarzyszenie\'),
            (4, \'Fundacja\'),
            (5, \'Inne\')'
        );

        $this->addSql('CREATE TABLE slownik_skladnikow (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO slownik_skladnikow(id, nazwa)
            VALUES
            (1, \'Regionalny Program Operacyjny\'),
            (2, \'Dotacja SPO WKP\'),
            (3, \'Budżet państwa PARP\'),
            (4, \'TOR#10\'),
            (5, \'Budżet państwa - system wsparcia MSP\'),
            (6, \'Samorząd (wojewódzki, powiatowy, gminny)\'),
            (7, \'Phare\'),
            (8, \'BGK\'),
            (9, \'Inne\')
        ');
        
        $this->addSql('CREATE TABLE sfz_sprawozdanie_poreczeniowe (id INT AUTO_INCREMENT NOT NULL, wojewodztwo_id INT DEFAULT NULL, forma_prawna_id INT DEFAULT NULL, umowa_id INT NOT NULL, czy_posiada_wydzielony_fundusz TINYINT(1) DEFAULT NULL, czy_procent_nie_nizszy_od_stopy TINYINT(1) DEFAULT NULL, czy_za_wynagrodzeniem TINYINT(1) DEFAULT NULL, czy_nie_przekraczaja_80_procent TINYINT(1) DEFAULT NULL, nazwa_funduszu VARCHAR(255) DEFAULT NULL, nip VARCHAR(11) DEFAULT NULL, krs VARCHAR(10) DEFAULT NULL, miejscowosc VARCHAR(100) DEFAULT NULL, ulica VARCHAR(100) DEFAULT NULL, budynek VARCHAR(10) DEFAULT NULL, lokal VARCHAR(10) DEFAULT NULL, kod_pocztowy VARCHAR(6) DEFAULT NULL, poczta VARCHAR(50) DEFAULT NULL, tel_stacjonarny VARCHAR(15) DEFAULT NULL, tel_komorkowy VARCHAR(15) DEFAULT NULL, email VARCHAR(250) DEFAULT NULL, fax VARCHAR(15) DEFAULT NULL, rok_zalozenia VARCHAR(4) DEFAULT NULL, kapital_ogolem NUMERIC(15, 2) DEFAULT NULL, kapital_wydzielony NUMERIC(15, 2) DEFAULT NULL, czy_nie_dziala_dla_zysku TINYINT(1) DEFAULT NULL, czy_udziela_po_analizie_ryzyka TINYINT(1) DEFAULT NULL, data_zatwierdzenia_zasad_gosp DATE DEFAULT NULL, czy_nie_w_trudnej_sytuacji TINYINT(1) DEFAULT NULL, czy_odpowiedni_potencjal_ekonomiczny TINYINT(1) DEFAULT NULL, czy_pracownicy_posiadaja_kwalifikacje TINYINT(1) DEFAULT NULL, inne VARCHAR(255) DEFAULT NULL, creator_id INT NOT NULL, data_rejestracji DATETIME NOT NULL, previous_version_id INT DEFAULT NULL, numer_umowy VARCHAR(26) NOT NULL, okres VARCHAR(255) NOT NULL, okres_id INT NOT NULL, rok VARCHAR(4) NOT NULL, status INT NOT NULL, wersja INT NOT NULL, czy_najnowsza_wersja TINYINT(1) NOT NULL, data_przeslania_do_parp DATETIME DEFAULT NULL, oceniajacy_parp_id INT DEFAULT NULL, data_zatwierdzenia_odeslania DATETIME DEFAULT NULL, id_status VARCHAR(100) DEFAULT NULL, powiadomienie_wyslane TINYINT(1) NOT NULL, INDEX IDX_22FEB1EB3E8EA8F5 (wojewodztwo_id), INDEX IDX_22FEB1EBC1E6F345 (forma_prawna_id), INDEX IDX_22FEB1EBC33960AC (umowa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sfz_sprawozdanie_poreczeniowe_skladnik_ogolem (id INT AUTO_INCREMENT NOT NULL, skladnik INT DEFAULT NULL, wartosc NUMERIC(15, 2) DEFAULT NULL, INDEX IDX_702517FC8D7A2E99 (skladnik), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sfz_sprawozdanie_poreczeniowe_skladnik_wydzielony (id INT AUTO_INCREMENT NOT NULL, skladnik INT DEFAULT NULL, wartosc NUMERIC(15, 2) DEFAULT NULL, INDEX IDX_E21A4FDD8D7A2E99 (skladnik), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sfz_sprawozdanie_pozyczkowe (id INT AUTO_INCREMENT NOT NULL, wojewodztwo_id INT DEFAULT NULL, forma_prawna_id INT DEFAULT NULL, umowa_id INT NOT NULL, minimalne_oprocentowanie NUMERIC(15, 2) DEFAULT NULL, maksymalna_wielkosc_pozyczki NUMERIC(15, 2) DEFAULT NULL, nazwa_funduszu VARCHAR(255) DEFAULT NULL, nip VARCHAR(11) DEFAULT NULL, krs VARCHAR(10) DEFAULT NULL, miejscowosc VARCHAR(100) DEFAULT NULL, ulica VARCHAR(100) DEFAULT NULL, budynek VARCHAR(10) DEFAULT NULL, lokal VARCHAR(10) DEFAULT NULL, kod_pocztowy VARCHAR(6) DEFAULT NULL, poczta VARCHAR(50) DEFAULT NULL, tel_stacjonarny VARCHAR(15) DEFAULT NULL, tel_komorkowy VARCHAR(15) DEFAULT NULL, email VARCHAR(250) DEFAULT NULL, fax VARCHAR(15) DEFAULT NULL, rok_zalozenia VARCHAR(4) DEFAULT NULL, kapital_ogolem NUMERIC(15, 2) DEFAULT NULL, kapital_wydzielony NUMERIC(15, 2) DEFAULT NULL, czy_nie_dziala_dla_zysku TINYINT(1) DEFAULT NULL, czy_udziela_po_analizie_ryzyka TINYINT(1) DEFAULT NULL, data_zatwierdzenia_zasad_gosp DATE DEFAULT NULL, czy_nie_w_trudnej_sytuacji TINYINT(1) DEFAULT NULL, czy_odpowiedni_potencjal_ekonomiczny TINYINT(1) DEFAULT NULL, czy_pracownicy_posiadaja_kwalifikacje TINYINT(1) DEFAULT NULL, inne VARCHAR(255) DEFAULT NULL, creator_id INT NOT NULL, data_rejestracji DATETIME NOT NULL, previous_version_id INT DEFAULT NULL, numer_umowy VARCHAR(26) NOT NULL, okres VARCHAR(255) NOT NULL, okres_id INT NOT NULL, rok VARCHAR(4) NOT NULL, status INT NOT NULL, wersja INT NOT NULL, czy_najnowsza_wersja TINYINT(1) NOT NULL, data_przeslania_do_parp DATETIME DEFAULT NULL, oceniajacy_parp_id INT DEFAULT NULL, data_zatwierdzenia_odeslania DATETIME DEFAULT NULL, id_status VARCHAR(100) DEFAULT NULL, powiadomienie_wyslane TINYINT(1) NOT NULL, INDEX IDX_DD2BEB893E8EA8F5 (wojewodztwo_id), INDEX IDX_DD2BEB89C1E6F345 (forma_prawna_id), INDEX IDX_DD2BEB89C33960AC (umowa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sfz_sprawozdanie_pozyczkowe_skladnik_ogolem (id INT AUTO_INCREMENT NOT NULL, skladnik INT DEFAULT NULL, wartosc NUMERIC(15, 2) DEFAULT NULL, INDEX IDX_3A67E0888D7A2E99 (skladnik), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sfz_sprawozdanie_pozyczkowe_skladnik_wydzielony (id INT AUTO_INCREMENT NOT NULL, skladnik INT DEFAULT NULL, wartosc NUMERIC(15, 2) DEFAULT NULL, INDEX IDX_E28A984A8D7A2E99 (skladnik), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD CONSTRAINT FK_22FEB1EB3E8EA8F5 FOREIGN KEY (wojewodztwo_id) REFERENCES sfz_wojewodztwo (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD CONSTRAINT FK_22FEB1EBC1E6F345 FOREIGN KEY (forma_prawna_id) REFERENCES slownik_form_prawnych (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD CONSTRAINT FK_22FEB1EBC33960AC FOREIGN KEY (umowa_id) REFERENCES sfz_umowa (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe_skladnik_ogolem ADD CONSTRAINT FK_702517FC8D7A2E99 FOREIGN KEY (skladnik) REFERENCES slownik_skladnikow (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe_skladnik_wydzielony ADD CONSTRAINT FK_E21A4FDD8D7A2E99 FOREIGN KEY (skladnik) REFERENCES slownik_skladnikow (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD CONSTRAINT FK_DD2BEB893E8EA8F5 FOREIGN KEY (wojewodztwo_id) REFERENCES sfz_wojewodztwo (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD CONSTRAINT FK_DD2BEB89C1E6F345 FOREIGN KEY (forma_prawna_id) REFERENCES slownik_form_prawnych (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD CONSTRAINT FK_DD2BEB89C33960AC FOREIGN KEY (umowa_id) REFERENCES sfz_umowa (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe_skladnik_ogolem ADD CONSTRAINT FK_3A67E0888D7A2E99 FOREIGN KEY (skladnik) REFERENCES slownik_skladnikow (id)');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe_skladnik_wydzielony ADD CONSTRAINT FK_E28A984A8D7A2E99 FOREIGN KEY (skladnik) REFERENCES slownik_skladnikow (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
//        $this->abortIf(true, 'Not supported.');
        
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe DROP FOREIGN KEY FK_22FEB1EBC1E6F345');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe DROP FOREIGN KEY FK_DD2BEB89C1E6F345');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe_skladnik_ogolem DROP FOREIGN KEY FK_702517FC8D7A2E99');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_poreczeniowe_skladnik_wydzielony DROP FOREIGN KEY FK_E21A4FDD8D7A2E99');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe_skladnik_ogolem DROP FOREIGN KEY FK_3A67E0888D7A2E99');
        $this->addSql('ALTER TABLE sfz_sprawozdanie_pozyczkowe_skladnik_wydzielony DROP FOREIGN KEY FK_E28A984A8D7A2E99');
        $this->addSql('CREATE TABLE sfz_spolka_historia (id INT AUTO_INCREMENT NOT NULL, spolka_id INT DEFAULT NULL, uzytkownik_id INT DEFAULT NULL, data_zmiany DATETIME DEFAULT NULL, umowa_id INT DEFAULT NULL, lp INT DEFAULT NULL, nazwa VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, forma VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, siedziba_miasto VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, siedziba_wojewodztwo VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, branza VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, opis LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, data_powolania DATETIME DEFAULT NULL, krs VARCHAR(15) DEFAULT NULL COLLATE utf8_unicode_ci, nip VARCHAR(15) DEFAULT NULL COLLATE utf8_unicode_ci, kw_inwestycji NUMERIC(15, 2) DEFAULT NULL, kw_wsparcia NUMERIC(15, 2) DEFAULT NULL, kw_pryw NUMERIC(15, 2) DEFAULT NULL, zakonczona TINYINT(1) DEFAULT NULL, data_wyjscia DATETIME DEFAULT NULL, kw_dezinwestycji NUMERIC(15, 2) DEFAULT NULL, zwrot_inwestycji NUMERIC(15, 2) DEFAULT NULL, npv NUMERIC(15, 2) DEFAULT NULL, udzialowcy LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, prezes VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, zarzad_pozostali LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, lp_p INT DEFAULT NULL, nazwa_p VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, forma_p VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, siedziba_miasto_p VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, siedziba_wojewodztwo_p VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, branza_p VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, opis_p LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, data_powolania_p DATETIME DEFAULT NULL, krs_p VARCHAR(15) DEFAULT NULL COLLATE utf8_unicode_ci, nip_p VARCHAR(15) DEFAULT NULL COLLATE utf8_unicode_ci, kw_inwestycji_p NUMERIC(15, 2) DEFAULT NULL, kw_wsparcia_p NUMERIC(15, 2) DEFAULT NULL, kw_pryw_p NUMERIC(15, 2) DEFAULT NULL, zakonczona_p TINYINT(1) DEFAULT NULL, data_wyjscia_p DATETIME DEFAULT NULL, kw_dezinwestycji_p NUMERIC(15, 2) DEFAULT NULL, zwrot_inwestycji_p NUMERIC(15, 2) DEFAULT NULL, npv_p NUMERIC(15, 2) DEFAULT NULL, udzialowcy_p LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, prezes_p VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, zarzad_pozostali_p LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE slownik_form_prawnych');
        $this->addSql('DROP TABLE slownik_skladnikow');
        $this->addSql('DROP TABLE sfz_sprawozdanie_poreczeniowe');
        $this->addSql('DROP TABLE sfz_sprawozdanie_poreczeniowe_skladnik_ogolem');
        $this->addSql('DROP TABLE sfz_sprawozdanie_poreczeniowe_skladnik_wydzielony');
        $this->addSql('DROP TABLE sfz_sprawozdanie_pozyczkowe');
        $this->addSql('DROP TABLE sfz_sprawozdanie_pozyczkowe_skladnik_ogolem');
        $this->addSql('DROP TABLE sfz_sprawozdanie_pozyczkowe_skladnik_wydzielony');
    }
}
