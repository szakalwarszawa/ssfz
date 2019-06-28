<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190628090813 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Set container.
     *
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $env = $this->container->get('kernel')->getEnvironment();
        $this->skipIf($env !== 'test', 'Migracja pominięta - ma zastosowanie tylko do środowiska testowego.');

        $this->addSql('ALTER TABLE sfz_uzytkownik DROP KEY UNIQ_B1E2DA8DE7927C74;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $env = $this->container->get('kernel')->getEnvironment();
        $this->skipIf($env !== 'test', 'Migracja pominięta - ma zastosowanie tylko do środowiska testowego.');

        $this->abortIf(true, 'Not supported.');
        /*
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1E2DA8DE7927C74 ON sfz_uzytkownik (email)');
        */
    }
}
