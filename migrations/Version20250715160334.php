<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250715160334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mail (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX IDX_B5F1AFE57D2D84D5 ON activities');
        $this->addSql('ALTER TABLE activities DROP professor_id, CHANGE discounted_price discounted_price DOUBLE PRECISION NOT NULL');
        $this->addSql('DROP INDEX IDX_1323A5757D2D84D5 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP professor_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mail');
        $this->addSql('ALTER TABLE activities ADD professor_id INT DEFAULT NULL, CHANGE discounted_price discounted_price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_B5F1AFE57D2D84D5 ON activities (professor_id)');
        $this->addSql('ALTER TABLE evaluation ADD professor_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_1323A5757D2D84D5 ON evaluation (professor_id)');
    }
}
