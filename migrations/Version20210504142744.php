<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504142744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE result ADD answer_id INT NOT NULL, DROP result_state');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113AA334807 FOREIGN KEY (answer_id) REFERENCES answers (id)');
        $this->addSql('CREATE INDEX IDX_136AC113AA334807 ON result (answer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC113AA334807');
        $this->addSql('DROP INDEX IDX_136AC113AA334807 ON result');
        $this->addSql('ALTER TABLE result ADD result_state TINYINT(1) NOT NULL, DROP answer_id');
    }
}
