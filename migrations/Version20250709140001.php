<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250709140001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities ADD professor_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE5F841BCC1 FOREIGN KEY (professor_user_id) REFERENCES professor_user (id)');
        $this->addSql('CREATE INDEX IDX_B5F1AFE5F841BCC1 ON activities (professor_user_id)');
        $this->addSql('ALTER TABLE evaluation ADD professor_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F841BCC1 FOREIGN KEY (professor_user_id) REFERENCES professor_user (id)');
        $this->addSql('CREATE INDEX IDX_1323A575F841BCC1 ON evaluation (professor_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE5F841BCC1');
        $this->addSql('DROP INDEX IDX_B5F1AFE5F841BCC1 ON activities');
        $this->addSql('ALTER TABLE activities DROP professor_user_id');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F841BCC1');
        $this->addSql('DROP INDEX IDX_1323A575F841BCC1 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP professor_user_id');
    }
}
