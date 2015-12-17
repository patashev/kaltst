<?php
require_once(plugin_dir_path( __FILE__ ).'lib/KalturaClient.php');
require_once(plugin_dir_path( __FILE__ ).'lib/settings.php');
require_once(plugin_dir_path( __FILE__ ).'sessionkaltura.php');


function uploadphrase(){}

add_action('kalturaup_hoock', 'kaltstupload');
function kaltstupload(){
    if(isset($_POST['submit'])){

    $path_array = wp_upload_dir();
    $location = str_replace('\\', '/', $path_array['path']);
    if(isset($_FILES["file"]))
    {
        //You can validate the file type, size here. I left the code for you
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Error: " . $_FILES["file"]["error"];
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], $path_array.$_FILES["file"]["name"]);
            echo "Uploaded File :".$_FILES["file"]["name"];
        }
    }
    }
}



add_action('kalturauploader_hoock', 'kaltst_init');
function kaltst_init(){
?>
    <div class="container" style="float: left;">
        <div class="row">
            <table class="table table-striped table-hover table-bordered">
                <form action="<?=do_action('kalturaup_hoock');?>">
                <tr>
                    <td><label for="name"><h3>Title:</h3></label><textarea rows="2" name = "namevid" id = "namevid" ></textarea></td>
                </tr>
                <tr>
                    <td><label for="content"><h3>Content:</h3></label><?php// wp_editor( $content, $editor_id, $settings ); ?></td>
                </tr>
                <tr>
                    <td><input type="file" id="file" multiple="true"></td>
                </tr>
                <tr>
                    <td ><div class="upload-progress"></div></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit" id="submit" name="submit">
                    </td>
                </tr>
                </form>
            </table>
            <br/>
        </div>
    </div>
<?php
}
