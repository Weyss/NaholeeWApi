<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718122441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD country VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tv RENAME INDEX idx_1d5ef26f1e8508fe TO IDX_B3EC7A041E8508FE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP country');
        $this->addSql('ALTER TABLE tv RENAME INDEX idx_b3ec7a041e8508fe TO IDX_1D5EF26F1E8508FE');
    }
}
