<?php

function up_enqueue_scripts()
{
    $auth_urls = json_encode([
        'signup' => esc_url_raw(rest_url('up/v1/signup')),
        'signin' => esc_url_raw(rest_url('up/v1/signin')),
    ]);

    wp_add_inline_script(
        'udemy-plus-auth-modal-view-script',
        "const up_auth_rest = {$auth_urls}",
        'before'
    );
}