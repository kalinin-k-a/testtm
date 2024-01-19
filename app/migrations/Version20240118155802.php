<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118155802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS  tests (
                id SERIAL PRIMARY KEY, 
                caption varchar(512) NOT NULL, 
                description varchar (4096) NOT NULL
            )   
        ");

        $this->addSql("
            CREATE TABLE IF NOT EXISTS  tests_questions (
                id SERIAL PRIMARY KEY, 
                caption varchar(512) NOT NULL, 
                test_id integer NOT NULL REFERENCES tests ON DELETE CASCADE 
            )   
        ");

        $this->addSql("
            CREATE TABLE IF NOT EXISTS tests_questions_answers (
                id SERIAL PRIMARY KEY, 
                caption varchar(512) NOT NULL, 
                question_id integer NOT NULL REFERENCES tests_questions ON DELETE CASCADE,
                is_correct BOOL not null
            )   
        ");

        $this->addSql("
            CREATE TABLE IF NOT EXISTS  tests_sessions (
                id SERIAL PRIMARY KEY,
                test_id integer NOT NULL REFERENCES tests ON DELETE CASCADE,
                is_completed BOOL NOT NULL
            )   
        ");

        $this->addSql("
            CREATE TABLE IF NOT EXISTS tests_sessions_answers (
                id SERIAL PRIMARY KEY,
                question_id integer NOT NULL REFERENCES tests_questions ON DELETE CASCADE,
                session_id integer NOT NULL REFERENCES tests_sessions ON DELETE CASCADE,
                is_correct BOOL,
                snapshot text
            )   
        ");

        $this->addSql("
            ALTER TABLE  tests_sessions_answers 
            ADD CONSTRAINT answer_unq UNIQUE(session_id, question_id)
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
