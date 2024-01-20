<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118161832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            insert into tests (id, caption, description) values (1, 'math test', 'chose one or more answers each time. You dont have to chose all the correct answers, but yo must not chose any incorrect answer. Good luck ')
        ");

        $this->addSql("insert into tests_questions (id, caption, test_id) values(1, '1+1=', 1)");
        $this->addSql("insert into tests_questions (id, caption, test_id) values(2, '2+2=', 1)");
        $this->addSql("insert into tests_questions (id, caption, test_id) values(3, '3+3=', 1)");
        $this->addSql("insert into tests_questions (id, caption, test_id) values(4, '4+4=', 1)");
        $this->addSql("insert into tests_questions (id, caption, test_id) values(5, 'Make an offer?', 1)");

        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('3', 1, false)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('2', 1, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('0', 1, false)");

        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('4', 2, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('3+1', 2, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('10', 2, false)");

        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('1+5', 3, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('1', 3, false)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('6', 3, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('2+4', 3, true)");

        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('8', 4, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('4', 4, false)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('0', 4, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('0+8', 4, true)");

        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('Yes', 5, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('Of course', 5, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('Certanly', 5, true)");
        $this->addSql("insert into tests_questions_answers(caption, question_id, is_correct) values ('Definitely', 5, true)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
