<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200304070322 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE todos DROP FOREIGN KEY FK_CD82625512469DE2');
        $this->addSql('DROP TABLE todos');
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE todos (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, date_time DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, name VARCHAR(60) NOT NULL, status INT NOT NULL, INDEX IDX_CD82625512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todos ADD CONSTRAINT FK_CD82625512469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
    }
}
