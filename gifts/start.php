<?php
/**
 * Elgg Gifts plugin
 * Send gifts to you friends
 *
 * @package Gifts
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Christian Heckelmann
 * @copyright Christian Heckelmann
 * @link http://www.heckelmann.info
 *
 * updated for Elgg 1.8 by iionly (iionly@gmx.de)
 */


elgg_register_event_handler('init', 'system', 'gifts_init');


/**
 * Initialize Plugin
 */
function gifts_init() {

    // Set Plugin Version for Update Checks
    elgg_set_plugin_setting('version', '1.8.2', 'gifts');

    // Show in Menu
    if (elgg_is_logged_in()) {
        elgg_register_menu_item('site', array('name' => elgg_echo('gifts:menu'),
                                              'text' => elgg_echo('gifts:menu'),
                                              'href' => "gifts/" . elgg_get_logged_in_user_entity()->username . "/index"));
    }

    elgg_register_admin_menu_item('administer', 'gifts', 'administer_utilities');

    elgg_register_menu_item('page', array('name' => elgg_echo('gifts:yourgifts'),
                                          'text' => elgg_echo('gifts:yourgifts'),
                                          'href' => "gifts/" . elgg_get_logged_in_user_entity()->username . "/index",
                                          'context' => 'gifts',
                                          'section' => 'default'));

    // Show all gifts?
    if (elgg_get_plugin_setting('showallgifts', 'gifts') == 1) {
        elgg_register_menu_item('page', array('name' => elgg_echo('gifts:allgifts'),
                                              'text' => elgg_echo('gifts:allgifts'),
                                              'href' => "gifts/" . elgg_get_logged_in_user_entity()->username . "/all",
                                              'context' => 'gifts',
                                              'section' => 'default'));
    }

    elgg_register_menu_item('page', array('name' => elgg_echo('gifts:sent'),
                                          'text' => elgg_echo('gifts:sent'),
                                          'href' => "gifts/" . elgg_get_logged_in_user_entity()->username . "/sent",
                                          'context' => 'gifts',
                                          'section' => 'default'));
    elgg_register_menu_item('page', array('name' => elgg_echo('gifts:sendgifts'),
                                          'text' => elgg_echo('gifts:sendgifts'),
                                          'href' => "gifts/" . elgg_get_logged_in_user_entity()->username . "/sendgift",
                                          'context' => 'gifts',
                                          'section' => 'default'));

    // Add Widget
    elgg_register_widget_type('gifts', elgg_echo("gifts:widget"), elgg_echo("gifts:widget:description"));
    if (elgg_get_plugin_setting('showallgifts', 'gifts') == 1) {
        elgg_register_widget_type('index_gifts', elgg_echo("gifts:widget"), elgg_echo("gifts:index_widget:description"), "index");
        //register title urls for gifts index widget
        elgg_register_plugin_hook_handler('widget_url', 'widget_manager', "gifts_widget_urls", 499);
    }

    elgg_register_page_handler('gifts', 'gifts_page_handler');
    elgg_register_entity_url_handler('object', 'gifts', 'gifts_url');
    elgg_extend_view('css/elgg','gifts/css');

    // Extend avatar hover menu
    elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'gifts_user_hover_menu');

    // Register actions
    $base_dir = elgg_get_plugins_path() . 'gifts/actions';
    elgg_register_action("gifts/settings", "$base_dir/savesettings.php", 'admin');
    elgg_register_action("gifts/savegifts", "$base_dir/savegifts.php", 'admin');
    elgg_register_action("gifts/sendgift", "$base_dir/send.php", 'logged_in');
    elgg_register_action("gifts/delete", "$base_dir/delete.php", 'logged_in');

    // override permissions for gift objects to allow for deleting them both by sender and receiver
    elgg_register_plugin_hook_handler('permissions_check', 'object', 'gifts_permissions_check');
}

/**
 * Page Handler
 */
function gifts_page_handler($page) {
    if (isset($page[0])) {
        set_input('username',$page[0]);
    } else {
        return false;
    }
    $base = elgg_get_plugins_path() . 'gifts/pages/gifts';
    if (isset($page[1])) {
        switch($page[1]) {
            case "read":
                set_input('guid',$page[2]);
                require "$base/index.php";
                break;
            case "index":
                require "$base/index.php";
                break;
            case "sent":
                require "$base/sent.php";
                break;
            case "sendgift":
                require "$base/sendgift.php";
                break;
            case "singlegift":
                require "$base/singlegift.php";
                break;
            case "all":
                require "$base/all.php";
                break;
            default:
                return false;
        }
    } else {
        require "$base/index.php";
    }

    return true;
}

/**
 * URL Handler
 */
function gifts_url($entity) {
    $title = $entity->title;
    $title = friendly_title($title);
    return "gifts/" . $entity->getOwnerEntity()->username . "/read/".$entity->getGUID();
}

/**
 * Add to the user hover menu
 */
function gifts_user_hover_menu($hook, $type, $return, $params) {
    $user = $params['entity'];

    if (elgg_is_logged_in() && elgg_get_logged_in_user_guid() != $user->guid) {
        $url = "gifts/".elgg_get_logged_in_user_entity()->username."/sendgift?send_to={$user->guid}";
        $item = new ElggMenuItem('gifts', elgg_echo("gifts:send"), $url);
        $item->setSection('action');
        $return[] = $item;
    }

    return $return;
}

function gifts_widget_urls($hook_name, $entity_type, $return_value, $params){
    $result = $return_value;
    $widget = $params["entity"];

    if(empty($result) && ($widget instanceof ElggWidget)) {
        $owner = $widget->getOwnerEntity();
        switch($widget->handler) {
            case "gifts":
                $result = "/gifts/" . elgg_get_logged_in_user_entity()->username . "/all";
                break;
            case "index_gifts":
                $result = "/gifts/" . elgg_get_logged_in_user_entity()->username . "/all";
                break;
        }
    }
    return $result;
}

/**
 * override permissions for gift objects to allow for deleting them both by sender and receiver
 *
 * @param $hook_name
 * @param $entity_type
 * @param $return_value
 * @param $parameters
 * @return unknown_type
 */
function gifts_permissions_check($hook_name, $entity_type, $return_value, $parameters) {

        $gift = $parameters['entity'];
        $user = $parameters['user'];

        $has_access = false;
        if (($gift->getSubtype() == "gift") && (($user->guid == $gift->owner_guid) || ($user->guid == $gift->receiver))) {
            $has_access = true;
        } else {
            return null;
        }
 
        if ($has_access === true) {
                return true;
        } else if ($has_access === false) {
                return false;
        }
 
        return null;
}
