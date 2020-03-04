<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200304070321 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE users');
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, api_key VARCHAR(64) DEFAULT NULL, birthday DATE DEFAULT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(20) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, last_name VARCHAR(20) DEFAULT NULL, mobile_number INT NOT NULL, password VARCHAR(60) NOT NULL, UNIQUE INDEX email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }
}
