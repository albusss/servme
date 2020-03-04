<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20200304190428 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX name ON categories (name)');
        $this->addSql('ALTER TABLE todos ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE todos ADD CONSTRAINT FK_CD826255A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_CD826255A76ED395 ON todos (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX name ON categories');
        $this->addSql('ALTER TABLE todos DROP FOREIGN KEY FK_CD826255A76ED395');
        $this->addSql('DROP INDEX IDX_CD826255A76ED395 ON todos');
        $this->addSql('ALTER TABLE todos DROP user_id');
    }
}
