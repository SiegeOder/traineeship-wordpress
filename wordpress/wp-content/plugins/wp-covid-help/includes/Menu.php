<?php

namespace Covid;

require_once 'template_parts/mailing.php';
require_once 'template_parts/messages.php';

use Covid\Templates\Messages;
use Covid\Templates\Mailing;

class Menu
{
    public static function register()
    {
        add_action('admin_menu', [Menu::class, 'activate_plugin_menu']);
    }

    public static function activate_plugin_menu()
    {
        Menu::add_messages_page();
        Menu::add_mailing_page();
    }

    public static function get_covid_messages_page()
    {
        wp_enqueue_style('messages_style', plugins_url('css/messages.css', __FILE__));
        Messages\show_template();
    }

    public static function get_covid_mailing_page()
    {
        wp_enqueue_style('mailing_style', plugins_url('css/mailing.css', __FILE__));
        wp_enqueue_script('mailing_script', plugins_url('js/ajax.js', __FILE__));
        Mailing\show_template();
    }


    private static function add_messages_page()
    {
        add_menu_page(
            'Covid Help',
            'Covid messages',
            'manage_options',
            'wp_covid_help',
            [Menu::class, 'get_covid_messages_page'],
            'dashicons-email'
        );
    }

    private static function add_mailing_page()
    {
        add_submenu_page(
            'wp_covid_help',
            'Covid Help',
            'Mailing',
            'manage_options',
            'wp_covid_mailing',
            [Menu::class, 'get_covid_mailing_page']
        );
    }
}
