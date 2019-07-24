<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migracja Version20190724152230.
 */
class Version20190724152230 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('RENAME TABLE sfz_beneficjent_forma_prawna TO slownik_form_prawnych_beneficjentow');
        $this->addSql('RENAME TABLE slownik_form_prawnych TO slownik_form_prawnych_funduszy');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf(true, 'Not supported.');

        /*
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('RENAME TABLE slownik_form_prawnych_beneficjentow TO sfz_beneficjent_forma_prawna');
        $this->addSql('RENAME TABLE slownik_form_prawnych_funduszy TO slownik_form_prawnych');
        */
    }
}
