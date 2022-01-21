<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112124129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création de l\entitée Statue et mise en relation avec les autres entitées';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statue (id INT AUTO_INCREMENT NOT NULL, statue VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film ADD statue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE221E8508FE FOREIGN KEY (statue_id) REFERENCES statue (id)');
        $this->addSql('CREATE INDEX IDX_8244BE221E8508FE ON film (statue_id)');
        $this->addSql('ALTER TABLE tv ADD statue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tv ADD CONSTRAINT FK_1D5EF26F1E8508FE FOREIGN KEY (statue_id) REFERENCES statue (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F1E8508FE ON tv (statue_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE221E8508FE');
        $this->addSql('ALTER TABLE tv DROP FOREIGN KEY FK_1D5EF26F1E8508FE');
        $this->addSql('DROP TABLE statue');
        $this->addSql('DROP INDEX IDX_8244BE221E8508FE ON film');
        $this->addSql('ALTER TABLE film DROP statue_id');
        $this->addSql('DROP INDEX IDX_1D5EF26F1E8508FE ON tv');
        $this->addSql('ALTER TABLE tv DROP statue_id');
    }
}
