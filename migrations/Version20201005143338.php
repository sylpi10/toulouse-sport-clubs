<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005143338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE postal_code (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport_club (id INT AUTO_INCREMENT NOT NULL, postal_codes_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, discipline VARCHAR(255) NOT NULL, category VARCHAR(255) DEFAULT NULL, weblink VARCHAR(255) DEFAULT NULL, complex VARCHAR(255) DEFAULT NULL, adults TINYINT(1) DEFAULT NULL, seniors TINYINT(1) DEFAULT NULL, j16to20 TINYINT(1) DEFAULT NULL, j12to15 TINYINT(1) DEFAULT NULL, j6to12 TINYINT(1) DEFAULT NULL, j3to6 TINYINT(1) DEFAULT NULL, j0to3 TINYINT(1) DEFAULT NULL, corpo TINYINT(1) DEFAULT NULL, handicap TINYINT(1) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_CF31168EDD795681 (postal_codes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sport_club ADD CONSTRAINT FK_CF31168EDD795681 FOREIGN KEY (postal_codes_id) REFERENCES postal_code (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_club DROP FOREIGN KEY FK_CF31168EDD795681');
        $this->addSql('DROP TABLE postal_code');
        $this->addSql('DROP TABLE sport_club');
    }
}
