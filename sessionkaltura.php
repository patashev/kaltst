<?php
require_once(plugin_dir_path( __FILE__ ).'lib/KalturaClient.php');
//include(plugin_dir_path( __FILE__ ).'lib/settings.php');
do_action("kaltst_connection_setings");
final class KalturaSessionPlugin {
  private static $_this;
  private $ks;
  private $clientConfig;
  public static function Instance(){
    static $client = NULL;
    if ($client === NULL) {
      $client = new KalturaSessionPlugin();
    }
    return $client;
  }

    private function __construct() {
        self::$_this = $this;
        add_action( 'the_content', array( $this, 'the_content' ) );

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

        $serviceUrl = KALTST_SERVICE_URL;
        $partnerUserID          = KALTST_PARTNER_ID;
        $config = new KalturaConfiguration();
        $config->serviceUrl = $serviceUrl;
        $this->client = new KalturaClient($config);
        $secret = KALTST_PARTNER_SECRET;
        $userId = null;
        $type = KalturaSessionType::USER;
        $partnerId = KALTST_PARTNER_ID;
        $expiry = null;
        $privileges = null;
        $this->ks = $this->client->session->start($secret, $userId, $type, $partnerId, $expiry, $privileges);
        $this->clientConfig = $this->client;
    }

    static function this() {
        return self::$_this;
    }
    public function getClientconf(){
      return $this->clientConfig;
    }
    function the_session( ) {
        $this->client->setKs($this->ks);
        $ks = $this->ks;
        return $ks;
    }
    public function getKs(){
      return $this->ks;
    }
}
