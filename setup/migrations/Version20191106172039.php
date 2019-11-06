<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191106172039 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(
            <<< SQL
ALTER TABLE `sprawozdawczosc`.`sfz_sprawozdanie_poreczeniowe` CHANGE COLUMN `kwota_dotacja_umowa_dofinansowanie`
`kwota_dotacji_z_umowy_o_dofinansowanie` DECIMAL(15,2) NULL DEFAULT NULL, CHANGE
COLUMN `kwota_dotacja_koniec_okresu_sprawozdawczego` `kwota_dotacji_na_koniec_okresu_sprawozdawczego`
DECIMAL(15,2) NULL DEFAULT NULL; ALTER TABLE `sprawozdawczosc`.`sfz_sprawozdanie_pozyczkowe` 
CHANGE COLUMN `kwota_dotacja_umowa_dofinansowanie` `kwota_dotacji_z_umowy_o_dofinansowanie` DECIMAL(15,2)
NULL DEFAULT NULL, CHANGE COLUMN `kwota_dotacja_koniec_okresu_sprawozdawczego`
`kwota_dotacji_na_koniec_okresu_sprawozdawczego` DECIMAL(15,2) NULL DEFAULT NULL ;
SQL
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');
    }
}
