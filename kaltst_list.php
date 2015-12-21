<?php
require_once(plugin_dir_path( __FILE__ ).'lib/KalturaClient.php');
require_once(plugin_dir_path( __FILE__ ).'kaltst_table.php');
do_action('kaltst_connection_setings');
class KalturaListPlugin {
  private static $_this;
  function __construct() {
  self::$_this = $this;
    add_action( 'the_content', array( $this, 'the_content' ) );
      $serviceUrl = KALTST_SERVICE_URL;
    	$partnerUserID          = KALTST_PARTNER_ID;
    	$config = new KalturaConfiguration();
    	$config->serviceUrl = $serviceUrl;
    	$this->client = new KalturaClient($config);
    	$secret = KALTST_PARTNER_SECRET;
    	$userId = null;

    	$partnerId = KALTST_PARTNER_ID;
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
