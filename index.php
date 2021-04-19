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
define('SUPERHEROES_PLUGIN_URL', __FILE__);


 // Includes
include('includes/activate.php');
include('includes/admin-page.php');
include('includes/shortcodes/creator.php');
include('includes/enqueue.php');
include('includes/ajax.php');

// Hooks
register_activation_hook( __FILE__, 'sh_activate_plugin' );
add_action( 'admin_menu', 'add_admin_page' );
add_action('wp_enqueue_scripts', 'superhero_files');
add_action('admin_enqueue_scripts', 'superhero_admin_scripts');
add_action( 'wp_ajax_store_sh_data', 'store_sh_data' );
add_shortcode( 'superhero', 'superhero_card_shortcode' );
add_action('wp_head','miplugin_ajaxurl');
function miplugin_ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}
