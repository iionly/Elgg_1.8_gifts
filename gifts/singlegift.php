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

$gift = get_entity((int)get_input('guid'));

$area2 = elgg_view_title(elgg_echo('gifts:singlegifts'));

$area2 .= elgg_view_entity($gift);

elgg_set_context('gifts');

// Format page
$body = elgg_view('page/layouts/one_sidebar', array('content' => $area2));

// Draw it
echo elgg_view_page(elgg_echo('gifts:singlegifts'), $body);
