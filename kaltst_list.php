<?php 
require_once(plugin_dir_path( __FILE__ ).'lib/KalturaClient.php');
require_once(plugin_dir_path( __FILE__ ).'lib/settings.php');
require_once(plugin_dir_path( __FILE__ ).'kaltst_table.php');
class KalturaListPlugin {
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

  function the_content( ) {
      global $resultobject;
  		$this->client->setKs($this->ks);
		$entryFilter = new KalturaBaseEntryFilter();
		$entryFilter->statusEqual = KalturaEntryStatus::READY;
		$entryFilter->mediaTypeEqual = KalturaMediaType::VIDEO;
		$entryFilter->orderBy = KalturaBaseEntryOrderBy::CREATED_AT_DESC;
    	$resskaltura = $this->client->baseEntry->listAction($entryFilter);
    	$kEntry = $resskaltura->objects;
    		return $kEntry;
  }
  function the_mediaentry( ) {
        $this->client->setKs($this->ks);
        $entryId = MEDIAENDTRY;
        $version = null;
        $resultobject = $this->client->media->get($entryId, $version);

            return $resultobject;
  }
}
