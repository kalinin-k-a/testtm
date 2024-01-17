<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117155802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->executeQuery("
            CREATE TABLE tests (
                id SERIAL PRIMARY KEY, 
                caption varchar(512) NOT NULL, 
                description varchar (4096) NOT NULL
            )   
        ");

        $this->connection->executeQuery("
            CREATE TABLE tests_questions (
                id SERIAL PRIMARY KEY, 
                caption varchar(512) NOT NULL, 
                test_id integer NOT NULL REFERENCES tests ON DELETE CASCADE 
            )   
        ");

        $this->connection->executeQuery("
            CREATE TABLE tests_questions_answers (
                id SERIAL PRIMARY KEY, 
                caption varchar(512) NOT NULL, 
                question_id integer NOT NULL REFERENCES tests_questions ON DELETE CASCADE,
                is_correct BOOL not null
            )   
        ");

        $this->connection->executeQuery("
            CREATE TABLE tests_sessions (
                id SERIAL PRIMARY KEY
            )   
        ");

        $this->connection->executeQuery("
            CREATE TABLE sessions_answers (
                id SERIAL PRIMARY KEY,
                question_id integer NOT NULL REFERENCES tests_questions ON DELETE CASCADE,
                is_correct BOOL,
                snapshot text
            )   
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
