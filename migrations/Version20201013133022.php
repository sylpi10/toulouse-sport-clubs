<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013133022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sport_club ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sport_club ADD CONSTRAINT FK_CF31168EDD795681 FOREIGN KEY (postal_codes_id) REFERENCES postal_code (id)');
        $this->addSql('ALTER TABLE sport_club ADD CONSTRAINT FK_CF31168EA21214B7 FOREIGN KEY (categories_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_CF31168EA21214B7 ON sport_club (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_club DROP FOREIGN KEY FK_CF31168EA21214B7');
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE sport_club DROP FOREIGN KEY FK_CF31168EDD795681');
        $this->addSql('DROP INDEX IDX_CF31168EA21214B7 ON sport_club');
        $this->addSql('ALTER TABLE sport_club DROP categories_id');
    }
}
