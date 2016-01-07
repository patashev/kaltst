<?php
require_once(plugin_dir_path( __FILE__ )."sessionkaltura.php");
require_once(plugin_dir_path( __FILE__ )."lib/KalturaMetadataClientPlugin.php");
$mypenguin = KalturaSessionPlugin::Instance();
var_dump($mypenguin->getClientconf());

 // /echo $mypenguin->the_session();

add_action('kaltura_meta_profile', 'kaltura_meta_profile');
function kaltura_meta_profile(){




  $metadataPlugin = KalturaMetadataClientPlugin::get($mypenguin->getClientconf());
  $result = $metadataPlugin->metadataprofile->listAction();
  ?>
  <form method = "post" action = "">
    <table>
      <tr>
        <td><label for="row">zaglavie</label></td>
        <td><input type="text" id="row"></td>
      </tr>
    </table>
    <?php var_dump($result);?>
  </form>
  <?php
}
?>
