<?php

/**
 *
 * @wordpress-plugin
 * Plugin name: Covid Help
 * Description: Covid help plugin
 */

namespace Covid;

require_once 'includes/Messages.php';
require_once 'includes/Mailing.php';
require_once 'includes/Menu.php';
require_once 'includes/Ajax.php';
require_once 'includes/Mailbox.php';

class CovidHelp
{
    private Messages $messages;
    private Mailing $mailing;
    private array $tables;
    private array $mailing_hooks = [];

    public function __construct()
    {
        $this->messages = new Messages();
        $this->mailing = new Mailing();
        $this->tables = [$this->messages, $this->mailing];
    }

    public function register()
    {
        register_activation_hook(__FILE__, [$this, 'activate_plugin']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate_plugin']);
        Menu::register();
        Ajax::register_user_hooks($this, [
            'request_help',
        ]);
        Ajax::register_admin_hooks($this, [
            'update_mail',
            'request_help',
        ]);
    }

    public function activate_plugin()
    {
        foreach ($this->tables as $table) {
            $table->create_table();
        }
    }

    public function deactivate_plugin()
    {
        foreach ($this->tables as $table) {
            $table->drop_table();
        }
        foreach ($this->mailing_hooks as $hook) {
            wp_clear_scheduled_hook($hook);
        }
    }

    public function request_help()  // ajax hook handler
    {
        $email = $_POST['email'];
        $text = $_POST['text'];
        $this->messages->insert($email, $text);
        $subject = $this->mailing->get_subject();
        $text = $this->mailing->get_text();
        $id = $this->messages->rows_count();
        Mailbox::send_mail($email, $subject, $text);
        wp_schedule_event(time(), 'daily', "send_mail_$id", $email);
        add_action("send_mail_$id", function ($email) {
            Mailbox::send_mail($email, $this->mailing->get_subject(), $this->mailing->get_text());
        });
    }

    public function update_mail()  // ajax hook handler
    {
        $subject = $_POST['subject'];
        $text = $_POST['text'];
        $this->mailing->update($subject, $text);
    }
}

function run_plugin()
{
    $plugin = new CovidHelp();
    $plugin->register();
}

run_plugin();
