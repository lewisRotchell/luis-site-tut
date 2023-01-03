<?php

function u_setup_theme()
{
    add_theme_support('editor-styles');

    add_editor_style([
        'https://fonts.googleapis.com/css?family=Rubik:400,500,700|Pacifico&display=swap',
        'assets/bootstrap-icons/bootstrap-icons.css',
        'assets/public/index.css',
        'assets/editor.css'
    ]);
}