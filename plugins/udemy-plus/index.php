<?php

/**
 * Plugin Name:       Udemy Plus
 * Plugin URI:        https://udemy.com
 * Description:       A plugin for adding blocks to a theme.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Lewis Rotchell
 * Author URI:        https://udemy.com
 * Text Domain:       udemy-plus
 * Domain Path:       /languages
 */

//Below stops someone from accessing the file directly
if (!function_exists('add_action')) {
    exit;
}

//Setup
define('UP_PLUGIN_DIR', plugin_dir_path(__FILE__));

//Includes
//glob is a function that returns an array of files
$rootFiles = glob(UP_PLUGIN_DIR . 'includes/*.php');
$subDirectoryFiles = glob(UP_PLUGIN_DIR . 'includes/**/*.php');
$allFiles = array_merge($rootFiles, $subDirectoryFiles);

foreach ($allFiles as $file) {
    include_once($file);
}


//Hooks
register_activation_hook(__FILE__, 'up_activate_plugin');
add_action('init', 'up_register_blocks');
add_action('rest_api_init', 'up_rest_api_init');
add_action('wp_enqueue_scripts', 'up_enqueue_scripts');
add_action('init', 'up_recipe_post_type');
add_action('cuisine_add_form_fields', 'up_cuisine_add_form_fields');
add_action('create_cuisine', 'up_save_cuisine_meta');

add_action('cuisine_edit_form_fields', 'up_cuisine_edit_form_fields');
add_action('edited_cuisine', 'up_save_cuisine_meta');
add_action('save_post_recipe', 'up_save_post_recipe');

//Add new image sizes, remember that plugins are loaded before themes so we wait until the theme is loaded to add the image sizes
add_action('after_setup_theme', 'up_setup_theme');
add_filter('image_size_names_choose', 'up_custom_image_sizes');