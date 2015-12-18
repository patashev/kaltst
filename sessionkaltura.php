<?php 
require_once('lib/KalturaClient.php');
include('lib/settings.php');
class KalturaSessionPlugin {
    private static $_this;
    function __construct() {
        self::$_this = $this;
        add_action( 'the_content', array( $this, 'the_content' ) );
        $serviceUrl = KALTURA_SERVICE_URL;
        $partnerUserID          = KALTURA_PARTNER_USER;
        $config = new KalturaConfiguration();
        $config->serviceUrl = KALTURA_SERVICE_URL;
        $this->client = new KalturaClient($config);
        $secret = KALTURA_PARTNER_SERVICE_SECRET;
        $userId = null;
        $type = KalturaSessionType::USER;
        $partnerId = KALTURA_PARTNER_ID;
        $expiry = null;
        $privileges = null;
        $this->ks = $this->client->session->start($secret, $userId, $type, $partnerId, $expiry, $privileges);
    }

    static function this() {
        return self::$_this;
    }
    function the_session( ) {
        $this->client->setKs($this->ks);
        $ks = $this->ks;
        return $ks;
    }
}
