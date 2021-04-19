<?php

function superhero_files ($args = NULL) {

    wp_register_script('font-awesome', 'https://kit.fontawesome.com/ac00d5fafa.js', [], microtime(), true );
    wp_register_script('superhero-functionality', plugins_url( '/assets/front/js/index.js', SUPERHEROES_PLUGIN_URL ), [], microtime(), true);
    wp_register_style('superhero-styles', plugins_url( '/assets/front/css/sh-style.css', SUPERHEROES_PLUGIN_URL ) );
    
    wp_enqueue_script('font-awesome');
    wp_enqueue_style('superhero-styles');
    wp_enqueue_script('superhero-functionality');
    wp_enqueue_script('jquery');

}
function superhero_admin_scripts ($args = NULL) {

    wp_register_script(
      'superhero-admin-functionality', 
      plugins_url( '/assets/admin/js/index.js', SUPERHEROES_PLUGIN_URL ), 
      ['jquery'], 
      microtime(), 
      true
    );
    
    wp_localize_script( 'superhero-admin-functionality', 'ajax_object',
    array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
    
    wp_enqueue_script('superhero-admin-functionality');

}
?>