<?php  

function add_admin_page () {
    // Generates a AR Settings page inside the dashboard backend
    add_menu_page( 'Nivel ICS', 'User Information', 'manage_options', 'ni_userinfo', 'ni_userinfo_page_create', 'dashicons-businessperson', 110 );
    // Generates a AR Settings subpage inside the dashboard backend

    add_action( 'admin_init', 'ni_custom_settings' );
}

function ni_custom_settings () {
  register_setting( 'ni-settings-group', 'first_name' );
  add_settings_section( 'sidebar-options', 'Sidebar Options', 'sidebar_options', 'ni_settings' );
}

function ni_userinfo_page_create () {

  global $wpdb;
  $table_name = $wpdb->prefix . 'user_info';
  $response = '';
  $id = get_current_user_id(  );
  
  $row = $wpdb->get_row( "SELECT * FROM $table_name WHERE userid = $id");

  if(!empty($row)) {
    $dataform = "<h1 class='wp-heading-inline'>Información de Usuario</h1>
    <form method='post' action='" . get_the_permalink() . "' style='display:flex;flex-direction: column;width:95%;'>
      <label for='name'>Nombre</label>
      <input id='name' value='" . $row->name . "' name='name' type='text' >  
      <label for='lastname'>Apellido</label>
      <input id='lastname' value='" . $row->lastname . "' name='lastname' type='text' >  
      <label for='phone'>Teléfono</label>
      <input id='phone' value='" . $row->phone . "' name='phone' type='text' >  
      <label for='email'>Email</label>
      <input id='email' value='" . $row->email ."' name='email' type='text' >  
      <input style='width:90px;margin-top: 20px;' name='send' type='submit' value='Actualizar'>  
    </form><br>" . $response . "";
    echo $dataform;

  } else {
    $dataform = "<h1 class='wp-heading-inline'>Información de Usuario</h1>
    <form method='post' action='" . get_the_permalink() . "' style='display:flex;flex-direction: column;width:95%;'>
      <label for='name'>Nombre</label>
      <input id='name' value='' name='name' type='text' >  
      <label for='lastname'>Apellido</label>
      <input id='lastname' value='' name='lastname' type='text' >  
      <label for='phone'>Teléfono</label>
      <input id='phone' value='' name='phone' type='text' >  
      <label for='email'>Email</label>
      <input id='email' value='' name='email' type='text' >  
      <input style='width:90px;margin-top: 20px;' name='send' type='submit' value='Guardar'>  
    </form><br>" . $response . "";
    echo $dataform;
  }

  if (isset($_POST['send']) && !empty($row)) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $default = array(
    'userid' => $id,
    'name' => $name,
    'lastname' => $lastname,
    'phone' => $phone,
    'email' => $email,
    );
    $item = shortcode_atts( $default, $_REQUEST );

    $wpdb->update( $table_name, $default, array('userid' => $id) );

  } elseif (isset($_POST['send']) && empty($row)) {

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $default = array(
    'userid' => $id,
    'name' => $name,
    'lastname' => $lastname,
    'phone' => $phone,
    'email' => $email,
    );
    $item = shortcode_atts( $default, $_REQUEST );

    $wpdb->insert( $table_name, $item );
  }
    
  

  
}