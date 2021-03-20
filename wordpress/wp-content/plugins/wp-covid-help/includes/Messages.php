<?php

namespace Covid;

require_once 'Table.php';
require_once 'ITable.php';

class Messages extends Table implements ITable
{
    public function create_table()
    {
        $this->database->query(
            'CREATE TABLE covid_messages(
                id INT NOT NULL AUTO_INCREMENT,
                email VARCHAR(64) NOT NULL,
                message VARCHAR(512) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id));'
        );
    }

    public function drop_table()
    {
        $this->database->query(
            'DROP TABLE covid_messages;'
        );
    }

    public function insert(string $email, string $text)
    {
        $this->database->query(
            $this->database->prepare(
                'INSERT INTO covid_messages (email, message) VALUES (%s, %s);',
                $email,
                $text
            )
        );
    }

    public function rows_count(): int
    {
        return $this->database->get_var('SELECT COUNT(*) FROM covid_messages');
    }
}
