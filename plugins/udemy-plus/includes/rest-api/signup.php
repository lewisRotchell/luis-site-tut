<?php

function up_rest_api_signup_handler($request)
{
    $response = [
        'status' => 1,
    ];

    $params = $request->get_json_params();

    if (
        !isset($params['username'], $params['email'], $params['password']) ||
        empty($params['username']) ||
        empty($params['email']) ||
        empty($params['password'])
    ) {
        return $response;
    }

    $email = sanitize_email($params['email']);
    $username = sanitize_text_field($params['username']);
    $password = sanitize_text_field($params['password']);

    if (
        !is_email($email) ||
        username_exists($username) ||
        email_exists($email)
    ) {
        return $response;
    }

    $user_id = wp_insert_user([
        'user_login' => $username,
        'user_email' => $email,
        'user_pass' => $password,
    ]);

    if (is_wp_error($user_id)) {
        return $response;
    }

    wp_new_user_notification($user_id, null, 'user');
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);

    $user = get_user_by('id', $user_id);

    do_action('wp_login', $user->user_login, $user);


    $response = [
        'status' => 2,

    ];

    return $response;
}