<?php

namespace Covid\Templates\Mailing;

function show_template()
{
    global $wpdb;
    $email = $wpdb->get_row('SELECT * FROM mailing WHERE id = 1;');
    ?>
    <br><div class="wrap">
        <div class="form-wrap">
            <h1>Edit email</h1>
            <div class="form-field form-required">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" value="<?= $email->subject ?>">
                <p>The subject of email.</p>
            </div>
            <div class="form-field form-required">
                <label for="text">Text</label>
                <textarea id="text" cols="30" rows="10"><?= $email->text ?></textarea>
                <p>The body of email.</p>
            </div>
            <p class="submit">
                <input id="update" type="submit" value="Update" class="button button-primary">
                <span class="spinner"></span>
            </p>
        </div>
    </div>
    <?php
}
