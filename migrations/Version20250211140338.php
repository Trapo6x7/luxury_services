<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211140338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate ADD passport_file VARCHAR(255) DEFAULT NULL, ADD profile_picture_file VARCHAR(255) DEFAULT NULL, ADD cv_file VARCHAR(255) DEFAULT NULL, ADD profile_picture VARCHAR(255) DEFAULT NULL, ADD passport VARCHAR(255) DEFAULT NULL, ADD cv VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP passport_file, DROP profile_picture_file, DROP cv_file, DROP profile_picture, DROP passport, DROP cv');
    }
}
