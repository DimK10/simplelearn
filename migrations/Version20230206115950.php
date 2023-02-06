<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206115950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exam_answer (exam_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_11EE1CAF578D5E91 (exam_id), INDEX IDX_11EE1CAFAA334807 (answer_id), PRIMARY KEY(exam_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exam_answer ADD CONSTRAINT FK_11EE1CAF578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_answer ADD CONSTRAINT FK_11EE1CAFAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_taken_answer DROP FOREIGN KEY FK_FECFED1A5285D3D7');
        $this->addSql('ALTER TABLE exam_taken_answer DROP FOREIGN KEY FK_FECFED1AAA334807');
        $this->addSql('ALTER TABLE exam_taken DROP FOREIGN KEY FK_ED0DD0B8578D5E91');
        $this->addSql('ALTER TABLE exam_taken DROP FOREIGN KEY FK_ED0DD0B8CB944F1A');
        $this->addSql('ALTER TABLE exam_question DROP FOREIGN KEY FK_F593067D1E27F6BF');
        $this->addSql('ALTER TABLE exam_question DROP FOREIGN KEY FK_F593067D578D5E91');
        $this->addSql('DROP TABLE exam_taken_answer');
        $this->addSql('DROP TABLE exam_taken');
        $this->addSql('DROP TABLE exam_question');
        $this->addSql('ALTER TABLE exam ADD student_id INT NOT NULL, ADD time_started DATETIME NOT NULL, ADD time_ended DATETIME NOT NULL');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C6CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_38BBA6C6CB944F1A ON exam (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exam_taken_answer (exam_taken_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_FECFED1A5285D3D7 (exam_taken_id), INDEX IDX_FECFED1AAA334807 (answer_id), PRIMARY KEY(exam_taken_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exam_taken (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, exam_id INT NOT NULL, time_started DATETIME NOT NULL, time_ended DATETIME NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_ED0DD0B8CB944F1A (student_id), INDEX IDX_ED0DD0B8578D5E91 (exam_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exam_question (exam_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_F593067D578D5E91 (exam_id), INDEX IDX_F593067D1E27F6BF (question_id), PRIMARY KEY(exam_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exam_taken_answer ADD CONSTRAINT FK_FECFED1A5285D3D7 FOREIGN KEY (exam_taken_id) REFERENCES exam_taken (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_taken_answer ADD CONSTRAINT FK_FECFED1AAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_taken ADD CONSTRAINT FK_ED0DD0B8578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE exam_taken ADD CONSTRAINT FK_ED0DD0B8CB944F1A FOREIGN KEY (student_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE exam_question ADD CONSTRAINT FK_F593067D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE exam_question ADD CONSTRAINT FK_F593067D578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE exam_answer DROP FOREIGN KEY FK_11EE1CAF578D5E91');
        $this->addSql('ALTER TABLE exam_answer DROP FOREIGN KEY FK_11EE1CAFAA334807');
        $this->addSql('DROP TABLE exam_answer');
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C6CB944F1A');
        $this->addSql('DROP INDEX IDX_38BBA6C6CB944F1A ON exam');
        $this->addSql('ALTER TABLE exam DROP student_id, DROP time_started, DROP time_ended');
    }
}
