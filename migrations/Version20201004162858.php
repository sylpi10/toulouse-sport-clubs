<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201004162858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_club ADD category VARCHAR(255) DEFAULT NULL, ADD weblink VARCHAR(255) DEFAULT NULL, ADD complex VARCHAR(255) DEFAULT NULL, ADD adults TINYINT(1) DEFAULT NULL, ADD seniors BIGINT DEFAULT NULL, ADD j16_20 TINYINT(1) DEFAULT NULL, ADD j12_15 TINYINT(1) DEFAULT NULL, ADD j6_12 TINYINT(1) DEFAULT NULL, ADD j3_6 TINYINT(1) DEFAULT NULL, ADD corpo TINYINT(1) DEFAULT NULL, ADD handicap TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_club DROP category, DROP weblink, DROP complex, DROP adults, DROP seniors, DROP j16_20, DROP j12_15, DROP j6_12, DROP j3_6, DROP corpo, DROP handicap');
    }
}
