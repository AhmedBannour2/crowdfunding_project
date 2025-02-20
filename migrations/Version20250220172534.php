<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220172534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation CHANGE project_id project_id INT NOT NULL, CHANGE donator_id donator_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD1761FE3BDAF ON person (pseudonyme)');
        $this->addSql('ALTER TABLE project CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation CHANGE project_id project_id INT DEFAULT NULL, CHANGE donator_id donator_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_34DCD1761FE3BDAF ON person');
        $this->addSql('ALTER TABLE project CHANGE description description VARCHAR(255) NOT NULL');
    }
}
