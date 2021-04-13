<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413094532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, id_question_id INT DEFAULT NULL, id_answer INT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_50D0C6066353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, id_question INT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, is_multiple TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE result (id INT AUTO_INCREMENT NOT NULL, id_questions_id INT DEFAULT NULL, id_users_id INT DEFAULT NULL, id_results INT NOT NULL, result_state TINYINT(1) NOT NULL, adress_ip VARCHAR(255) DEFAULT NULL, INDEX IDX_136AC1139F7041BC (id_questions_id), INDEX IDX_136AC113376858A8 (id_users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6066353B48 FOREIGN KEY (id_question_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC1139F7041BC FOREIGN KEY (id_questions_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113376858A8 FOREIGN KEY (id_users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C6066353B48');
        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC1139F7041BC');
        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC113376858A8');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE result');
        $this->addSql('DROP TABLE user');
    }
}
