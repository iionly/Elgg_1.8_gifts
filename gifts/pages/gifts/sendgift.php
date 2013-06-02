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

gatekeeper();

$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
  $page_owner = elgg_get_logged_in_user_entity();
  elgg_set_page_owner_guid($page_owner->getGUID());
}
$prefix = elgg_get_config('dbprefix');
$friends = elgg_get_entities_from_relationship(array('relationship' => 'friend',
                                                     'relationship_guid' => elgg_get_logged_in_user_guid(),
                                                     'type' => 'user',
                                                     'limit' => false,
                                                     'joins' => array("JOIN " . $prefix . "users_entity u ON e.guid=u.guid"),
                                                     'order_by' => "u.name asc",
                                                     ));

// set the title
$title = elgg_echo('gifts:sendgifts');

// start building the main column of the page
$area2 = elgg_view_title($title);

// Add the form to this section
$area2 .= elgg_view("gifts/form",array('friends' => $friends));

// Format page
$body = elgg_view('page/layouts/one_sidebar', array('content' => $area2));

// Draw it
echo elgg_view_page($title, $body);
