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

elgg_push_breadcrumb(elgg_echo('gifts:menu'), 'gifts/' . elgg_get_logged_in_user_entity()->username. '/index');
$title = elgg_echo('gifts:yourgifts');
elgg_push_breadcrumb($title);

$user_guid = elgg_get_logged_in_user_guid();

$access = elgg_set_ignore_access(true);

$result = elgg_list_entities_from_metadata(array('type' => 'object', 'subtype' => 'gift', 'metadata_name_value_pair' => array('name' => 'receiver', 'value' => $user_guid, 'operand' => '=')));

if (!empty($result)) {
	$area2 = $result;
} else {
	$area2 = elgg_echo('gifts:nogifts');
}

elgg_set_context('gifts');

// Format page
$body = elgg_view_layout('content', array('content' => $area2, 'filter' => '', 'title' => $title));

// Draw it
echo elgg_view_page($title, $body);

elgg_set_ignore_access($access);