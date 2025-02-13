<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250213085858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_job_category DROP FOREIGN KEY FK_6E682995712A86AB');
        $this->addSql('ALTER TABLE job_job_category DROP FOREIGN KEY FK_6E682995BE04EA9');
        $this->addSql('ALTER TABLE job_contract DROP FOREIGN KEY FK_8EC88D222576E0FD');
        $this->addSql('ALTER TABLE job_contract DROP FOREIGN KEY FK_8EC88D22BE04EA9');
        $this->addSql('DROP TABLE job_job_category');
        $this->addSql('DROP TABLE job_contract');
        $this->addSql('ALTER TABLE job ADD contract_id INT DEFAULT NULL, ADD job_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F82576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F82576E0FD ON job (contract_id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8712A86AB ON job (job_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_job_category (job_id INT NOT NULL, job_category_id INT NOT NULL, INDEX IDX_6E682995712A86AB (job_category_id), INDEX IDX_6E682995BE04EA9 (job_id), PRIMARY KEY(job_id, job_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE job_contract (job_id INT NOT NULL, contract_id INT NOT NULL, INDEX IDX_8EC88D222576E0FD (contract_id), INDEX IDX_8EC88D22BE04EA9 (job_id), PRIMARY KEY(job_id, contract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE job_job_category ADD CONSTRAINT FK_6E682995712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_job_category ADD CONSTRAINT FK_6E682995BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_contract ADD CONSTRAINT FK_8EC88D222576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_contract ADD CONSTRAINT FK_8EC88D22BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F82576E0FD');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8712A86AB');
        $this->addSql('DROP INDEX IDX_FBD8E0F82576E0FD ON job');
        $this->addSql('DROP INDEX IDX_FBD8E0F8712A86AB ON job');
        $this->addSql('ALTER TABLE job DROP contract_id, DROP job_category_id');
    }
}
