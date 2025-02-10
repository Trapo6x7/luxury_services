<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210113026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP passport, DROP cv, DROP profile_picture, CHANGE user_id user_id INT DEFAULT NULL, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE currentlocation currentlocation VARCHAR(255) DEFAULT NULL, CHANGE adress adress VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE nationality nationality VARCHAR(255) DEFAULT NULL, CHANGE birthdate birthdate DATETIME DEFAULT NULL, CHANGE birthplace birthplace VARCHAR(255) DEFAULT NULL, CHANGE cv_path cv_path VARCHAR(255) DEFAULT NULL, CHANGE passport_path passport_path VARCHAR(255) DEFAULT NULL, CHANGE profilepicture_path profilepicture_path VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate ADD passport VARCHAR(255) DEFAULT NULL, ADD cv VARCHAR(255) DEFAULT NULL, ADD profile_picture VARCHAR(255) DEFAULT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE currentlocation currentlocation VARCHAR(255) NOT NULL, CHANGE adress adress VARCHAR(255) NOT NULL, CHANGE country country VARCHAR(255) NOT NULL, CHANGE nationality nationality VARCHAR(255) NOT NULL, CHANGE birthdate birthdate DATETIME NOT NULL, CHANGE birthplace birthplace VARCHAR(255) NOT NULL, CHANGE cv_path cv_path VARCHAR(255) NOT NULL, CHANGE passport_path passport_path VARCHAR(255) NOT NULL, CHANGE profilepicture_path profilepicture_path VARCHAR(255) NOT NULL');
    }
}
