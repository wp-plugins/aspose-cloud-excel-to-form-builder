<?php
/*
Plugin Name: Aspose Cloud excel to form builder
Plugin URI:
Description: Aspose Cloud excel to form builder is a plugin which extracts cells contents using Aspose.Cells and will build an interactive form using Aspose.Cells.
Version: 1.0
Author: Fahad Adeel
Author URI: http://cloud.aspose.com/

*/

function register_aspose_excel_to_form_menu_page() {
    add_menu_page( 'Aspose Cloud Excel to Form Builder Page', 'APC Excel to Form Builder', 'edit_published_posts', 'aspose-cloud-excel-to-form-builder/excel-to-form-admin.php', 'aspose_cloud_excel_to_form_builder_admin_page', 'dashicons-admin-page', 30 );
    add_options_page('Aspose Cloud Excel to Form Builder Configurations Page', __('Aspose Cloud Excel to Form Builder', 'aspose-cloud-excel-to-form-builder'), 'activate_plugins', 'apc-excel-to-form-settings', 'AsposeExcelToFormAdminContent');
}

function aspose_cloud_excel_to_form_builder_admin_page() {

    $ape_sid = get_option('aspose_cloud_excel_to_form_app_sid');
    $ape_key = get_option('aspose_cloud_excel_to_form_app_key');

    if(empty($ape_sid) || empty($ape_key)) {
        echo '<div><h2 style="color: red">Please enter Aspose SID and Key on plugin settings page.</h2></div>';
     //   return;
    }

    if(isset($_POST['apc_generate_short_code'])) {

        $post_params = $_POST;

        require_once('apc-sdk-calls.php');

    }

    require_once('aspose-cloud-excel-to-form-admin-main.php');
}

add_action( 'admin_menu', 'register_aspose_excel_to_form_menu_page' );

function apc_excel_to_form_builder_enqueue_scripts() {

    // using thickbox for media uploader popup
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    // register plugin script file

  //  wp_register_script( 'apc_excel_to_form_builder_script', plugins_url( 'js/script.js', __FILE__ ), array('jquery') );

  //  wp_enqueue_script( 'apc_excel_to_form_builder_script' );

}

add_action('admin_init', 'apc_excel_to_form_builder_enqueue_scripts');

/**
 * Pluing settings page
 * @param no-param
 * @return no-return
 */
function AsposeExcelToFormAdminContent() {

    // Creating the admin configuration interface
    ?>
    <div class="wrap">
    <h2><?php echo __('Aspose Cloud Excel to Form Builder Options', 'aspose-cloud-excel-to-form-builder');?></h2>
    <br class="clear" />

    <div class="metabox-holder has-right-sidebar" id="poststuff">
    <div class="inner-sidebar" id="side-info-column">
        <div class="meta-box-sortables ui-sortable" id="side-sortables">
            <div id="AsposePostsExporterOptions" class="postbox">
                <div title="Click to toggle" class="handlediv"><br /></div>
                <h3 class="hndle"><?php echo __('Support / Manual', 'aspose-cloud-excel-to-form-builder'); ?></h3>
                <div class="inside">
                    <p style="margin:15px 0px;"><?php echo __('For any suggestion / query / issue / requirement, please feel free to drop an email to', 'aspose-cloud-excel-to-form-builder'); ?> <a href="/cdn-cgi/l/email-protection#87eae6f5ece2f3f7ebe6e4e2c7e6f4f7e8f4e2a9e4e8eab8f4f2e5ede2e4f3bac6f4f7e8f4e2a7c3e8e4a7c2fff7e8f5f3e2f5">marketplace@aspose.com</a>.</p>
                    <p style="margin:15px 0px;"><?php echo __('Get the', 'aspose-cloud-excel-to-form-builder'); ?> <a href="#" target="_blank"><?php echo __('Manual here', 'aspose-cloud-excel-to-form-builder'); ?></a>.</p>

                </div>
            </div>

            <div id="AsposePostsExporterOptions" class="postbox">
                <div title="Click to toggle" class="handlediv"><br /></div>
                <h3 class="hndle"><?php echo __('Review', 'aspose-cloud-excel-to-form-builder'); ?></h3>
                <div class="inside">
                    <p style="margin:15px 0px;">
                        <?php echo __('Please feel free to add your reviews on', 'aspose-cloud-excel-to-form-builder'); ?> <a href="http://wordpress.org/support/view/plugin-reviews/aspose-cloud-excel-to-form-builder" target="_blank"><?php echo __('Wordpress', 'aspose-cloud-excel-to-form-builder');?></a>.</p>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <div id="post-body">
        <div id="post-body-content">
            <div id="WtiLikePostOptions" class="postbox">
                <h3><?php echo __('Configuration / Settings', 'aspose-cloud-excel-to-form-builder'); ?></h3>

                <div class="inside">
                    <form method="post" action="options.php">
                        <?php settings_fields('aspose_posts_exporter_options'); ?>
                        <table class="form-table">



                            <tr valign="top">
                                <td colspan="2">
                                    <p> If you don't have an account with Aspose Cloud, <a target="_blank" href="https://cloud.aspose.com/SignUp?src=total-api"> Click here </a> to Sign Up.</p>
                                </td>

                            </tr>

                            <tr valign="top">
                                <th scope="row"><label><?php _e('App SID', 'aspose-cloud-excel-to-form-builder'); ?></label></th>
                                <td>
                                    <input type="text" size="40" name="aspose_cloud_excel_to_form_app_sid" id="aspose_cloud_excel_to_form_app_sid" value="<?php echo get_option('aspose_cloud_excel_to_form_app_sid'); ?>" />
                                    <span class="description"><?php _e('Aspose for Cloud App sID.', 'aspose-cloud-excel-to-form-builder');?></span>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row"><label><?php _e('App key', 'aspose-cloud-excel-to-form-builder'); ?></label></th>
                                <td>
                                    <input type="text" size="40" name="aspose_cloud_excel_to_form_app_key" id="aspose_cloud_excel_to_form_app_key" value="<?php echo get_option('aspose_cloud_excel_to_form_app_key'); ?>" />
                                    <span class="description"><?php _e('Aspose for Cloud App Key.', 'aspose-cloud-excel-to-form-builder');?></span>
                                </td>
                            </tr>


                            <tr valign="top">
                                <th scope="row"></th>
                                <td>
                                    <input class="button-primary" type="submit" name="Save" value="<?php _e('Save Options', 'aspose-cloud-excel-to-form-builder'); ?>" />
                                    <input class="button-secondary" type="reset" name="Reset" value="<?php _e('Reset', 'aspose-cloud-excel-to-form-builder'); ?>" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

add_filter('plugin_action_links', 'AsposePostsExporterPluginLinks', 10, 2);

/**
 * Create the settings link for this plugin
 * @param $links array
 * @param $file string
 * @return $links array
 */
function AsposePostsExporterPluginLinks($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        $settings_link = '<a href="' . admin_url('options-general.php?page=apc-excel-to-form-settings') . '">' . __('Settings', 'aspose-cloud-excel-to-form-builder') . '</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}


/**
 * For removing options
 * @param no-param
 * @return no-return
 */
function UnsetOptionsAsposePostsExporter() {
    // Deleting the added options on plugin uninstall
    delete_option('aspose_cloud_excel_to_form_app_sid');
    delete_option('aspose_cloud_excel_to_form_app_key');

}

register_uninstall_hook(__FILE__, 'UnsetOptionsAsposePostsExporter');

function AsposePostsExporterAdminRegisterSettings() {
    // Registering the settings

    register_setting('aspose_posts_exporter_options', 'aspose_cloud_excel_to_form_app_sid');
    register_setting('aspose_posts_exporter_options', 'aspose_cloud_excel_to_form_app_key');

}

add_action('admin_init', 'AsposePostsExporterAdminRegisterSettings');


if (check_upload_aspose_excel_context('APC-Select-Excel-File')) {


    add_filter('media_upload_tabs', 'apc_excel_to_form_builder_uploader_tabs', 10, 1);
    add_filter('attachment_fields_to_edit', 'apc_excel_to_form_builder_uploader_action_button', 20, 2);
    add_filter('media_send_to_editor', 'apc_excel_to_form_builder_uploader_file_selected', 10, 3);
//    add_filter('upload_mimes', 'apc_excel_to_form_builder_uploader_upload_mimes', 10, 3);

}

function apc_excel_to_form_builder_uploader_tabs($_default_tabs) {

    unset($_default_tabs['type_url']);
    return($_default_tabs);
}

function apc_excel_to_form_builder_uploader_upload_mimes ( $existing_mimes=array() ) {


    $existing_mimes = array();
    $existing_mimes['doc'] = 'application/msword';
    $existing_mimes['docx'] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';

    return $existing_mimes;
}

function apc_excel_to_form_builder_uploader_action_button($form_fields, $post) {

    $send = "<input type='submit' class='button-primary' name='send[$post->ID]' value='" . esc_attr__( 'Use this File For Form Builder' ) . "' />";

    $form_fields['buttons'] = array('tr' => "\t\t<tr class='submit'><td></td><td class='savesend'>$send</td></tr>\n");
    $form_fields['context'] = array( 'input' => 'hidden', 'value' => 'APC-Select-Excel-File' );
    return $form_fields;
}


function apc_excel_to_form_builder_uploader_file_selected($html, $send_id) {

    $file_url = wp_get_attachment_url($send_id);
    $file_url = basename($file_url);
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var win = window.dialogArguments || opener || parent || top;

        win.jQuery( '#excel_file_name' ).val('<?php echo $file_url;?>');

        win.jQuery('.tb-close-icon').trigger('click');

    </script>
    <?php
    return '';
}

function add_aspose_excel_context_to_url($url, $type) {
    //if ($type != 'image') return $url;
    if (isset($_REQUEST['context'])) {
        $url = add_query_arg('context', $_REQUEST['context'], $url);
    }
    return $url;
}


function check_upload_aspose_excel_context($context) {
    if (isset($_REQUEST['context']) && $_REQUEST['context'] == $context) {
        add_filter('media_upload_form_url', 'add_aspose_excel_context_to_url', 10, 2);
        return TRUE;
    }
    return FALSE;
}