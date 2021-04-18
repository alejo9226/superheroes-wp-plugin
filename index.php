<?php
/**
 * Plugin Name: Superheroes
 * Description: This WordPress plugin allows WordPress editors to use a block or pattern (shortcode) that can be used in any posts/pages with custom parameters to show a specific Superhero Card.
 * Version: 1.0
 * Author: Alejandro Alfaro
 */

if (!function_exists('add_action')) {
  echo "Hi there I'm just a plugin not much I can do when called directly";
  exit;
}

// Setup
define('USERS_DATA_PLUGIN_URL', __FILE__);


 // Includes
include('includes/activate.php');
include('includes/admin-page.php');
include('includes/shortcodes/creator.php');

// Hooks
register_activation_hook( __FILE__, 'sh_activate_plugin' );
add_action( 'admin_menu', 'add_admin_page' );
add_shortcode( 'superhero', 'superhero_card_shortcode' );

