<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191105163857 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql(
            <<< SQL
ALTER TABLE sfz_sprawozdanie_pozyczkowe ADD kwota_dotacja_umowa_dofinansowanie NUMERIC(15, 2) DEFAULT NULL,
ADD kwota_dotacja_koniec_okresu_sprawozdawczego NUMERIC(15, 2) DEFAULT NULL;
ALTER TABLE sfz_sprawozdanie_poreczeniowe ADD kwota_dotacja_umowa_dofinansowanie NUMERIC(15, 2) DEFAULT NULL,
ADD kwota_dotacja_koniec_okresu_sprawozdawczego NUMERIC(15, 2) DEFAULT NULL;
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
