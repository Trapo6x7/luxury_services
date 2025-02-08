<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208221302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD experience_id INT DEFAULT NULL, ADD job_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64946E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64946E90E27 ON user (experience_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649712A86AB ON user (job_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649712A86AB');
        $this->addSql('DROP TABLE job_category');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64946E90E27');
        $this->addSql('DROP INDEX UNIQ_8D93D64946E90E27 ON `user`');
        $this->addSql('DROP INDEX UNIQ_8D93D649712A86AB ON `user`');
        $this->addSql('ALTER TABLE `user` DROP experience_id, DROP job_category_id');
    }
}
