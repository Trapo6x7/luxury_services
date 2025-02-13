<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250213143837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_candidate (job_id INT NOT NULL, candidate_id INT NOT NULL, INDEX IDX_F026155BE04EA9 (job_id), INDEX IDX_F02615591BD8781 (candidate_id), PRIMARY KEY(job_id, candidate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_candidate ADD CONSTRAINT FK_F026155BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_candidate ADD CONSTRAINT FK_F02615591BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_candidate DROP FOREIGN KEY FK_F026155BE04EA9');
        $this->addSql('ALTER TABLE job_candidate DROP FOREIGN KEY FK_F02615591BD8781');
        $this->addSql('DROP TABLE job_candidate');
    }
}
