<?php

namespace Covid\Templates\Messages;

require_once __DIR__.'/../Messages.php';

function show_template()
{
    global $wpdb;
    $messages = $wpdb->get_results('SELECT * FROM covid_messages ORDER BY id DESC');
    echo '';
    ?>
    <br><div class="wrap">
    <h1>Covid messages</h1>
    <table class="widefat striped fixed">
        <thead>
            <tr>
                <th>id</th>
                <th>email</th>
                <th>message</th>
                <th>date</th>
            </tr>
        </thead>
    <?php
    foreach ($messages as $message)
    {
        echo '<tr>';
        echo "<td>$message->id</td>";
        echo "<td>$message->email</td>";
        echo "<td>$message->message</td>";
        echo "<td>$message->created_at</td>";
        echo '</tr>';
    }
    echo '</table></div>';
}
