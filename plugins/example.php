<?php

/*
Plugin Name: Udemy Plus Emailer
*/

add_action('recipe_rated', function ($data) {
    $post = get_post($data['postID']);
    $authorEmail = get_the_author_meta('user_email', $post->post_author);
    $subject = 'Your recipe has recieved a new ratinng';
    $message = "Your recipe {$post->post_title} has recieved a new rating of {$data['rating']}.";

    wp_mail($authorEmail, $subject, $message);
});