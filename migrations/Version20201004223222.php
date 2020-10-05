<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201004223222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sport_club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, discipline VARCHAR(255) NOT NULL, postal_code INT DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, weblink VARCHAR(255) DEFAULT NULL, complex VARCHAR(255) DEFAULT NULL, adults TINYINT(1) DEFAULT NULL, seniors TINYINT(1) DEFAULT NULL, j16_20 TINYINT(1) DEFAULT NULL, j12_15 TINYINT(1) DEFAULT NULL, j6_12 TINYINT(1) DEFAULT NULL, j3_6 TINYINT(1) DEFAULT NULL, corpo TINYINT(1) DEFAULT NULL, handicap TINYINT(1) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sport_club');
    }
}
