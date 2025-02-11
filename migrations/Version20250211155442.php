<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211155442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruiter (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, activity VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, post VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DE8633D8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D8A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE job ADD recruiter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8156BE243 ON job (recruiter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8156BE243');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D8A76ED395');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE recruiter');
        $this->addSql('DROP INDEX IDX_FBD8E0F8156BE243 ON job');
        $this->addSql('ALTER TABLE job DROP recruiter_id');
    }
}
