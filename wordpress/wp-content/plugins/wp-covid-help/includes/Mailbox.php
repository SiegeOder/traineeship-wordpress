<?php

namespace Covid;

class Mailbox
{
    public static function send_mail(string $to, string $subject, string $text)
    {
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Covid Help <help@covidhelp.com>',
        ];
        wp_mail($to, $subject, $text, $headers);
    }
}
