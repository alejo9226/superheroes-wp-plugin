<?php 

function store_sh_data () {


	global $wpdb; // this is how you get access to the database

	$whatever = $_POST['name'];
  //var_dump($whatever);
	//$whatever = intval( $_POST['nombre'] );

	//$whatever += 10;

        echo $whatever;

	wp_die(); // this is required to terminate immediately and return a proper response
}