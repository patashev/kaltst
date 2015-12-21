<?php
add_action('kaltst_connection_setings', 'kaltst_connection_setings');
function kaltst_connection_setings()
{
  global $wpdb;
  $kaltura_settings_table = $wpdb->prefix . 'kaltura_config_settings';
      $query_settings = $wpdb->get_results( "SELECT * FROM $kaltura_settings_table");
          foreach($query_settings as $row);
              define("KALTST_SERVICE_URL", $row->kaltura_service_url);
              define("KALTST_PARTNER_ID", $row->kaltura_partner_id);
              define("KALTST_PARTNER_SECRET", $row->kaltura_partner_service_secret);
              define("KALTST_PLAYER_UI_CONFIG", $row->kaltura_player_ui_config);
                if ($row->kaltura_connection_type == 'USER') { $type = KalturaSessionType::USER; }
                elseif ($row->kaltura_connection_type == 'ADMIN') { $type = KalturaSessionType::ADMIN; }
}


add_action('kaltura_settings', 'kaltura_settings');
function kaltura_settings(){ do_action('kaltst_integration_settings');}


add_action('kaltst_integration_settings', 'kaltst_integration_settings');
function kaltst_integration_settings() {
    global $wpdb;
    $kaltura_settings_table = $wpdb->prefix . 'kaltura_config_settings'; //Good practice
    $query_settings = $wpdb->get_results( "SELECT * FROM $kaltura_settings_table");
    foreach($query_settings as $row);
  ?>
    <script>$(document).ready(function(){formDropDown()});</script>
  <div class="container frm_table wrap">
  <div class="row row_btn_frm_sbm">
    <tr>
      <td><label for="btn_form_sumbmit"><h3>Kaltura Integration Settings</h3></label></td>
      <td><button type="button" class="btn btn-default btn_form_sumbmit">Show the form</button></td>
    </tr>
  </div>
  <div class="clear-fix"></div>
<hr>
  <div class="row">
  <form method = "post" action = "">
    <table class="table table-striped table-hover tbl_form_sbm">
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="service_url">SERVICE URL</label></td>
        <td><input type="text" class="frm_sbumit_right" name="service_url" id="service_url" value="<?php echo $row->kaltura_service_url; ?>" size="55"/></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="partner_id">PARTNER ID</label></td>
        <td><input type="text" class="frm_sbumit_right" name="partner_id" id="partner_id" value="<?php echo $row->kaltura_partner_id; ?>" size="55"/></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="partner_secret">PARTNER SECRET</label></td>
        <td><input type="text" class="frm_sbumit_right" name="partner_secret" id="partner_secret" value="<?php echo $row->kaltura_partner_service_secret; ?>" size="55"/></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="admin_secret">ADMIN SECRET</label></td>
        <td><input type="text" class="frm_sbumit_right" name="admin_secret" id="admin_secret" value="<?php echo $row->kaltura_admin_service_secret; ?>" size="55"/></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="wiz">WIZ</label></td>
        <td><input type="text" class="frm_sbumit_right" name="wiz" id="wiz" value="<?php echo $row->kaltura_wp_admin_wiz; ?>" size="55"/></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="uiconf">PLAYER UI_CONFIG</label></td>
        <td><input type="text" class="frm_sbumit_right" name="uiconf" id="uiconf" value="<?php echo $row->kaltura_player_ui_config; ?>" size="55"/></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="partneruser">USER NAME</label></td>
        <td><input type="text" class="frm_sbumit_right" name="partneruser" id="partneruser" value="<?php echo $row->kaltura_partner_user; ?>" size="55"/></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="connectiontype">CONNECTION TYPE</label></td>
        <td><input type="text" class="frm_sbumit_right" name="connectiontype" id="connectiontype" value="<?php echo $row->kaltura_connection_type; ?>" size="55" /></td>
      </tr>
      <tr class="frm_sbumit_top">
        <td><label class="frm_sbumit_left" for="kaltura_settings_submit"></label></td>
        <td><button type="button" class="btn btn-default frm_sbumit_right" name="kaltura_settings_submit">Submit / Update Settings</button></td>
      </tr>
    </table>
</form>
</div>
</div>
  <?php
}

add_action('kaltst_update_settings', 'kaltst_update_settings');
function kaltst_update_settings() {
  global $wpdb;
$table_name = $wpdb->prefix . 'kaltura_config_settings';
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
  global $wpdb;
  $table_name = $wpdb->prefix . "kaltura_config_settings";
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
                            '%s'));
  }
if( isset($_POST['kaltura_settings_submit']) || $_POST['service_url'] == null ){ kaltura_insert_settings(); }else { kaltst_update_settings();}
?>
