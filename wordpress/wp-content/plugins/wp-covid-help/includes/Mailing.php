<?php

namespace Covid;

require_once 'Table.php';
require_once 'ITable.php';

class Mailing extends Table implements ITable
{
    public function create_table()
    {
        $this->database->query(
            'CREATE TABLE mailing(
                id INT NOT NULL AUTO_INCREMENT,
                subject VARCHAR(64) NOT NULL,
                text VARCHAR(512) NOT NULL,
                PRIMARY KEY (id));'
        );
        $this->database->query('INSERT INTO mailing(subject, text) VALUES (\'Mornin\', \'HUHA!\');');
    }

    public function drop_table()
    {
        $this->database->query(
            'DROP TABLE mailing;'
        );
    }

    public function update(string $subject, string $text)
    {
        $this->database->query(
            $this->database->prepare(
                'UPDATE mailing SET subject = %s, text = %s WHERE id = 1;',
                $subject,
                $text
            )
        );
    }

    public function get_subject()
    {
        return $this->get_data()->subject;
    }

    public function get_text()
    {
        return $this->get_data()->text;
    }

    private function get_data()
    {
        return $this->database->get_row('SELECT * FROM mailing WHERE id = 1');
    }
}
