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
 */

global $CONFIG;

/*
 * Initialize Plugin
 */
function gifts_init() {

    global $CONFIG;

    // Set Plugin Version for Update Checks
    elgg_set_plugin_setting('version', '1.8.0', 'gifts');

    register_translations($CONFIG->pluginspath . "gifts/languages/");

    // Show in Menu
    if (elgg_is_logged_in()) {
        elgg_register_menu_item('site', array('name' => elgg_echo('gifts:menu'),
                                              'text' => elgg_echo('gifts:menu'),
                                              'href' => $CONFIG->wwwroot."gifts/" . $_SESSION['user']->username . "/index"));
    }

    elgg_register_admin_menu_item('administer', 'gifts', 'administer_utilities');

    elgg_register_menu_item('page', array('name' => elgg_echo('gifts:yourgifts'),
                                          'text' => elgg_echo('gifts:yourgifts'),
                                          'href' => $CONFIG->wwwroot."gifts/" . $_SESSION['user']->username . "/index",
                                          'context' => 'gifts',
                                          'section' => 'default'));

    // Show all gifts?
    if(elgg_get_plugin_setting('showallgifts', 'gifts') == 1) {
        elgg_register_menu_item('page', array('name' => elgg_echo('gifts:allgifts'),
                                              'text' => elgg_echo('gifts:allgifts'),
                                              'href' => $CONFIG->wwwroot."gifts/" . $_SESSION['user']->username . "/all",
                                              'context' => 'gifts',
                                              'section' => 'default'));
    }

    elgg_register_menu_item('page', array('name' => elgg_echo('gifts:sent'),
                                          'text' => elgg_echo('gifts:sent'),
                                          'href' => $CONFIG->wwwroot."gifts/" . $_SESSION['user']->username . "/sent",
                                          'context' => 'gifts',
                                          'section' => 'default'));
    elgg_register_menu_item('page', array('name' => elgg_echo('gifts:sendgifts'),
                                          'text' => elgg_echo('gifts:sendgifts'),
                                          'href' => $CONFIG->wwwroot."gifts/" . $_SESSION['user']->username . "/sendgift",
                                          'context' => 'gifts',
                                          'section' => 'default'));

    // Add Widget
    elgg_register_widget_type('gifts', elgg_echo("gifts:widget"), elgg_echo("gifts:widget:description"));

    elgg_register_page_handler('gifts', 'gifts_page_handler');
    elgg_register_entity_url_handler('object', 'gifts', 'gifts_url');
    elgg_extend_view('css/elgg','gifts/css');

    // Extend avatar hover menu
    elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'gifts_user_hover_menu');
}

function gifts() {
    if (!@include_once(dirname(dirname(__FILE__))) . "/gifts/index.php") return false;
    return true;
}

/*
 * Page Handler
 */
function gifts_page_handler($page) {
    if (isset($page[0])) {
        set_input('username',$page[0]);
    }

    if (isset($page[1])) {
        switch($page[1]) {
            case "read":
                set_input('guid',$page[2]);
                @include(dirname(dirname(dirname(__FILE__))) . "/index.php");
                return true;
                break;
            case "index":
                @include(dirname(__FILE__) . "/index.php");
                return true;
                break;
            case "sent":
                @include(dirname(__FILE__) . "/sent.php");
                return true;
                break;
            case "sendgift":
                @include(dirname(__FILE__) . "/sendgift.php");
                return true;
                break;
            case "singlegift":
                @include(dirname(__FILE__) . "/singlegift.php");
                return true;
                break;
            case "all":
                @include(dirname(__FILE__) . "/all.php");
                return true;
                break;
        }
    } else {
        @include(dirname(__FILE__) . "/index.php");
        return true;
    }

    return false;
}

/*
 * URL Handler
 */
function gifts_url($entity) {
    global $CONFIG;
    $title = $entity->title;
    $title = friendly_title($title);
    return $CONFIG->url . "gifts/" . $entity->getOwnerEntity()->username . "/read/".$entity->getGUID();
}

/*
 * Add to the user hover menu
 */
function gifts_user_hover_menu($hook, $type, $return, $params) {
    $user = $params['entity'];

    if (elgg_is_logged_in() && elgg_get_logged_in_user_guid() != $user->guid) {
        $url = "mod/gifts/sendgift.php?send_to={$user->guid}";
        $item = new ElggMenuItem('gifts', elgg_echo("gifts:send"), $url);
        $item->setSection('action');
        $return[] = $item;
    }

    return $return;
}


elgg_register_event_handler('init', 'system', 'gifts_init');
elgg_register_action("gifts/settings", $CONFIG->pluginspath . "gifts/actions/savesettings.php", 'logged_in');
elgg_register_action("gifts/savegifts", $CONFIG->pluginspath . "gifts/actions/savegifts.php", 'logged_in');
elgg_register_action("gifts/sendgift", $CONFIG->pluginspath . "gifts/actions/send.php", 'logged_in');
