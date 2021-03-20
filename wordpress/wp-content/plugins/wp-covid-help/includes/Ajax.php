<?php

namespace Covid;

class Ajax
{
    public static function register_user_hooks(object $handler, array $actions)
    {
        foreach ($actions as $action) {
            add_action('wp_ajax_nopriv_' . $action, [$handler, $action]);
        }
    }

    public static function register_admin_hooks(object $handler, array $actions)
    {
        foreach ($actions as $action) {
            add_action('wp_ajax_' . $action, [$handler, $action]);
        }
    }
}
