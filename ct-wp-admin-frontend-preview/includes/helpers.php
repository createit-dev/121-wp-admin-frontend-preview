<?php

/**
 * helpers
 */


function ct_admin_template_server_path($file_path, $include = true, $options = array())
{
    $my_plugin_dir = WP_PLUGIN_DIR . "/" . CT_WP_PREVIEW_ADMIN_DIR . "/";

    if ( is_dir( $my_plugin_dir ) ) {

        $path_to_file = $my_plugin_dir . $file_path . '.php';

        if ($include) {
            include $path_to_file;
        }

        return $path_to_file;
    }
}
function ct_admin_url($append = '')
{
    return plugins_url($append, __DIR__);
}

function ct_admin_preview_current_step()
{
    return isset($_GET['step']) ? $_GET['step'] : 'view1';
}

function ct_preview_shortcodes_list(){
    return array(
        0 => 'Select',
        1 => '[audio src="https://download.samplelib.com/mp3/sample-15s.mp3"]',
        2 => '[caption id="attachment_6" align="alignright" width="300"]<img src="https://picsum.photos/seed/picsum/200/200" alt="Lorem" title="Lorem ipsum dolor sit amet" width="300" height="205" class="size-medium wp-image-6" /> Lorem ipsum dolor sit amet[/caption]',
        3 => '[embed width="500"]https://www.youtube.com/watch?v=kJQP7kiw5Fk[/embed]',
        4 => '[gallery columns="2" size="medium"]',
        5 => '[video src="https://www.w3schools.com/html/mov_bbb.mp4"]',
    );
}