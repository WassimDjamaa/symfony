<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413100924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers DROP id_answer');
        $this->addSql('ALTER TABLE questions DROP id_question');
        $this->addSql('ALTER TABLE result DROP id_results');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers ADD id_answer INT NOT NULL');
        $this->addSql('ALTER TABLE questions ADD id_question INT NOT NULL');
        $this->addSql('ALTER TABLE result ADD id_results INT NOT NULL');
    }
}
