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

// Start engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

$area2 = elgg_view_title(elgg_echo('gifts:yourgifts'));

$user_guid = elgg_get_logged_in_user_guid();

$ogifts = elgg_get_entities(array('type' => 'object', 'subtype' => 'gift', 'limit' => 999));

foreach($ogifts as $gift) {
    if($gift->receiver == $user_guid) {
        $area2 .= elgg_view_entity($gift);
    }
}

elgg_set_context('gifts');

// Format page
$body = elgg_view('page/layouts/one_sidebar', array('content' => $area2));

// Draw it
echo elgg_view_page(elgg_echo('gifts:yourgifts'), $body);
