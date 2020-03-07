<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200304160355 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE todos DROP FOREIGN KEY FK_CD82625512469DE2');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE todos');
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, api_key VARCHAR(64) DEFAULT NULL, birthday DATE DEFAULT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(20) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, last_name VARCHAR(20) DEFAULT NULL, mobile_number VARCHAR(255) NOT NULL, password VARCHAR(60) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todos (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, date_time DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, name VARCHAR(60) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_CD82625512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todos ADD CONSTRAINT FK_CD82625512469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
    }
}
