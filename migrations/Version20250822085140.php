<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250822085140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(50) NOT NULL, CHANGE color_hex color_hex VARCHAR(7) NOT NULL');
        $this->addSql('ALTER TABLE tool CHANGE description text LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE usage_log ADD usage_minutes INT NOT NULL, ADD actions_count INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP action, DROP details, CHANGE timestamp session_date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tool CHANGE text description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL, CHANGE color_hex color_hex VARCHAR(70) NOT NULL');
        $this->addSql('ALTER TABLE usage_log ADD action VARCHAR(255) NOT NULL, ADD details LONGTEXT DEFAULT NULL, DROP usage_minutes, DROP actions_count, DROP created_at, CHANGE session_date timestamp DATE NOT NULL');
    }
}
