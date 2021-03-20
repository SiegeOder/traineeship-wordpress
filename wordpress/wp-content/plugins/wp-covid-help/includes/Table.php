<?php

namespace Covid;

use wpdb;

abstract class Table
{
    protected wpdb $database;

    public function __construct()
    {
        global $wpdb;
        $this->database = $wpdb;
    }
}