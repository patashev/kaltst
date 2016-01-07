<?php
require_once(plugin_dir_path( __FILE__ ).'kaltst.php');
require_once(plugin_dir_path( __FILE__ ).'kaltst_table.php');
function mh_trip_script( $atts ) {
    $serviceUri = KALTST_SERVICE_URL;
    $partnerr   = KALTST_PARTNER_ID;
    $objectinsertt  = "<script src='".$serviceUri."/p/".$partnerr."/sp/".$partnerr."00/embedIframeJs/uiconf_id/".KALTST_PLAYER_UI_CONFIG."/partner_id/".$partnerr."'></script>
    <div id='dummy' style='margin-top: 56.25%;'></div>
<div id='kaltura_player_1437197987' style='position:absolute;top:0;left:0;left: 0;right: 0;bottom:0;' itemprop='video' itemscope itemtype='http://schema.org/VideoObject'>
<span itemprop='name' content='URTHBOY - Hellsong'></span>
<span itemprop='description' content=''></span>
<span itemprop='duration' content='247'></span>
<span itemprop='thumbnail' content='".$serviceUri."/p/".$partnerr."/sp/".$partnerr."00/thumbnail/entry_id/".MEDIAENDTRY."/version/100000/acv/162'></span>
<span itemprop='width' content='560'></span>
<span itemprop='height' content='315'></span>
</div>
<script>
//<![CDATA[
kWidget.thumbEmbed({
  'targetId': 'kaltura_player_1437197987',
  'wid': '_".$partnerr."',
  'uiconf_id': '".KALTST_PLAYER_UI_CONFIG."',
  'flashvars': {
    'streamerType': 'auto'
  },
  'cache_st': '1437197987',
  'entry_id': '".MEDIAENDTRY."'
});
//]]>
</script>";
    return $objectinsertt;
}
add_shortcode( 'mh-tripadvisor', 'mh_trip_script' );
?>
