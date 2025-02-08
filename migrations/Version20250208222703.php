<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208222703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate ADD gender_id INT DEFAULT NULL, ADD job_category_id INT DEFAULT NULL, ADD experience_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E4446E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C8B28E44708A0E0 ON candidate (gender_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C8B28E44712A86AB ON candidate (job_category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C8B28E4446E90E27 ON candidate (experience_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64946E90E27');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649712A86AB');
        $this->addSql('DROP INDEX UNIQ_8D93D64946E90E27 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649712A86AB ON user');
        $this->addSql('ALTER TABLE user DROP experience_id, DROP job_category_id, DROP gender, DROP firstname, DROP lastname, DROP currentlocation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` ADD experience_id INT DEFAULT NULL, ADD job_category_id INT DEFAULT NULL, ADD gender INT NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD currentlocation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64946E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64946E90E27 ON `user` (experience_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649712A86AB ON `user` (job_category_id)');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44708A0E0');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44712A86AB');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E4446E90E27');
        $this->addSql('DROP INDEX UNIQ_C8B28E44708A0E0 ON candidate');
        $this->addSql('DROP INDEX UNIQ_C8B28E44712A86AB ON candidate');
        $this->addSql('DROP INDEX UNIQ_C8B28E4446E90E27 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP gender_id, DROP job_category_id, DROP experience_id');
    }
}
