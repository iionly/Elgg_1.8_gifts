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

$area2 = elgg_view_title(elgg_echo('gifts:yourgifts'));

$user_guid = elgg_get_logged_in_user_guid();

$access = elgg_set_ignore_access(true);

$area2 .= elgg_list_entities_from_metadata(array('type' => 'object', 'subtype' => 'gift', 'metadata_name_value_pair' => array('name' => 'receiver', 'value' => $user_guid, 'operand' => '=')));

elgg_set_context('gifts');

// Format page
$body = elgg_view('page/layouts/one_sidebar', array('content' => $area2));

// Draw it
echo elgg_view_page(elgg_echo('gifts:yourgifts'), $body);

elgg_set_ignore_access($access);