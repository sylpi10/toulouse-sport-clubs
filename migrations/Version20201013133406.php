<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013133406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE postal_code (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sport_club ADD categories_id INT DEFAULT NULL, ADD j16to20 TINYINT(1) DEFAULT NULL, ADD j12to15 TINYINT(1) DEFAULT NULL, ADD j6to12 TINYINT(1) DEFAULT NULL, ADD j3to6 TINYINT(1) DEFAULT NULL, ADD j0to3 TINYINT(1) DEFAULT NULL, DROP category, DROP j16_20, DROP j12_15, DROP j6_12, DROP j3_6, CHANGE postal_code postal_codes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sport_club ADD CONSTRAINT FK_CF31168EDD795681 FOREIGN KEY (postal_codes_id) REFERENCES postal_code (id)');
        $this->addSql('ALTER TABLE sport_club ADD CONSTRAINT FK_CF31168EA21214B7 FOREIGN KEY (categories_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_CF31168EDD795681 ON sport_club (postal_codes_id)');
        $this->addSql('CREATE INDEX IDX_CF31168EA21214B7 ON sport_club (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_club DROP FOREIGN KEY FK_CF31168EDD795681');
        $this->addSql('DROP TABLE postal_code');
        $this->addSql('ALTER TABLE sport_club DROP FOREIGN KEY FK_CF31168EA21214B7');
        $this->addSql('DROP INDEX IDX_CF31168EDD795681 ON sport_club');
        $this->addSql('DROP INDEX IDX_CF31168EA21214B7 ON sport_club');
        $this->addSql('ALTER TABLE sport_club ADD postal_code INT DEFAULT NULL, ADD category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD j16_20 TINYINT(1) DEFAULT NULL, ADD j12_15 TINYINT(1) DEFAULT NULL, ADD j6_12 TINYINT(1) DEFAULT NULL, ADD j3_6 TINYINT(1) DEFAULT NULL, DROP postal_codes_id, DROP categories_id, DROP j16to20, DROP j12to15, DROP j6to12, DROP j3to6, DROP j0to3');
    }
}
