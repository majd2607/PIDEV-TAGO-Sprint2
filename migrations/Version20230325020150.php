<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230325020150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maintenances ADD id_vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE maintenances ADD CONSTRAINT FK_C2F7112F5258F8E6 FOREIGN KEY (id_vehicule_id) REFERENCES vehicules (id)');
        $this->addSql('CREATE INDEX IDX_C2F7112F5258F8E6 ON maintenances (id_vehicule_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maintenances DROP FOREIGN KEY FK_C2F7112F5258F8E6');
        $this->addSql('DROP INDEX IDX_C2F7112F5258F8E6 ON maintenances');
        $this->addSql('ALTER TABLE maintenances DROP id_vehicule_id');
    }
}
