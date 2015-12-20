<?php
<<<<<<< HEAD


=======
>>>>>>> 2f540693f44c32271ec0255a25f0c5539bd62282
add_action('kaltst_settings', 'kaltura_settings');
function kaltura_settings() {
    global $wpdb;
    $kaltura_settings_table = $wpdb->prefix . 'kaltura_config_settings'; //Good practice
    $query_settings = $wpdb->get_results( "SELECT * FROM $kaltura_settings_table");
    foreach($query_settings as $row);
  ?>
  <div class="row">
  <h2>Kaltura Integration Settings</h2>
  <form method = "post" action = "">
    <table class="table table-striped table-bordered table-hover">
      <tr>
        <td>SERVICE URL</td>
        <td><input type="text" name="service_url" id="service_url" value="<?php echo $row->kaltura_service_url; ?>" size="55"/></td>
      </tr>
      <tr>
        <td>PARTNER ID</td>
        <td><input type="text" name="partner_id" id="partner_id" value="<?php echo $row->kaltura_partner_id; ?>" size="55"/></td>
      </tr>
      <tr>
        <td>PARTNER SECRET</td>
        <td><input type="text" name="partner_secret" id="partner_secret" value="<?php echo $row->kaltura_partner_service_secret; ?>" size="55"/></td>
      </tr>
      <tr>
        <td>ADMIN SECRET</td>
        <td><input type="text" name="admin_secret" id="admin_secret" value="<?php echo $row->kaltura_admin_service_secret; ?>" size="55"/></td>
      </tr>
      <tr>
        <td>WIZ</td>
        <td><input type="text" name="wiz" id="wiz" value="<?php echo $row->kaltura_wp_admin_wiz; ?>" size="55"/></td>
      </tr>
      <tr>
        <td>PLAYER UI_CONFIG</td>
        <td><input type="text" name="uiconf" id="uiconf" value="<?php echo $row->kaltura_player_ui_config; ?>" size="55"/></td>
      </tr>
      <tr>
        <td>USER NAME</td>
        <td><input type="text" name="partneruser" id="partneruser" value="<?php echo $row->kaltura_partner_user; ?>" size="55"/></td>
      </tr>
      <tr>
        <td>CONNECTION TYPE</td>
        <td><input type="text" name="connectiontype" id="connectiontype" value="<?php echo $row->kaltura_connection_type; ?>" size="55" /></td>
      </tr>
    </table>
      <input type="submit" value="Submit" name="kaltura_settings_submit"/>
</form>
</br>
</div>
  <?php
}

<<<<<<< HEAD
add_action('kaltst_update_settings', 'kaltst_update_settings');
function kaltst_update_settings() {


  global $wpdb;
$table_name = $wpdb->prefix . 'ad_counter';

            $data = array(
                          'kaltura_service_url'    => $_POST['service_url'],
                          'kaltura_partner_id'  => $_POST['partner_id'],
                          'kaltura_partner_service_secret'   => $_POST['partner_secret'],
                          'kaltura_admin_service_secret'   => $_POST['admin_secret'],
                          'kaltura_wp_admin_wiz'   => $_POST['wiz'],
                          'kaltura_player_ui_config'   => $_POST['uiconf'],
                          'kaltura_partner_user'   => $_POST['partneruser'],
                          'kaltura_connection_type' => $_POST['connectiontype']
                          );

$where = array( 'kaltura_settings_id' => 1 );
$format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');
$where_format = array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' );

$wpdb->update( $table_name, $data, $where, $format, $where_format );
}



function kaltura_insert_settings() {
=======
function kaltura_update_settings() {
>>>>>>> 2f540693f44c32271ec0255a25f0c5539bd62282
  global $wpdb;
  $table_name = $wpdb->prefix . "kaltura_config_settings"; //try not using Uppercase letters or blank spaces when naming db tables

  $wpdb->insert($table_name, array(
                            'kaltura_service_url'    => $_POST['service_url'],
                            'kaltura_partner_id'  => $_POST['partner_id'],
                            'kaltura_partner_service_secret'   => $_POST['partner_secret'],
                            'kaltura_admin_service_secret'   => $_POST['admin_secret'],
                            'kaltura_wp_admin_wiz'   => $_POST['wiz'],
                            'kaltura_player_ui_config'   => $_POST['uiconf'],
                            'kaltura_partner_user'   => $_POST['partneruser'],
                            'kaltura_connection_type' => $_POST['connectiontype']
                            ),array(
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s') //replaced %d with %s - I guess that your description field will hold strings not decimals
    );
  }
<<<<<<< HEAD
if( isset($_POST['kaltura_settings_submit']) ) kaltura_insert_settings();

var_dump(kaltst_update_settings());
=======
if( isset($_POST['kaltura_settings_submit']) ) kaltura_update_settings();
>>>>>>> 2f540693f44c32271ec0255a25f0c5539bd62282
?>
