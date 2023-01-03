<?php

function u_enqueue()
{
    wp_register_style(
        'u_font_rubik_and_pacifico',
        'https://fonts.googleapis.com/css?family=Rubik:400,500,700|Pacifico&display=swap',
        [],
        null
    );
    wp_register_style(
        'u_bootstrap_icons',
        get_theme_file_uri('assets/bootstrap-icons/bootstrap-icons.css'),
    );
    wp_register_style(
        'u_theme',
        get_theme_file_uri('assets/public/index.css'),
    );
    wp_enqueue_style('u_font_rubik_and_pacifico');
    wp_enqueue_style('u_bootstrap_icons');
    wp_enqueue_style('u_theme');
}