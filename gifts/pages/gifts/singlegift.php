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

$gift_guid = (int)get_input('guid');

$access = elgg_set_ignore_access(true);

$gift = get_entity($gift_guid);

if ($gift->getSubtype() != 'gift') {
    elgg_set_ignore_access($access);
    forward(REFERER);
} else if (elgg_get_logged_in_user_guid() == $gift->receiver) {

    $area2 = elgg_view_title(elgg_echo('gifts:singlegifts'));

    $area2 .= elgg_view_entity($gift);

    elgg_set_context('gifts');

    // Format page
    $body = elgg_view('page/layouts/one_sidebar', array('content' => $area2));

    // Draw it
    echo elgg_view_page(elgg_echo('gifts:singlegifts'), $body);

    elgg_set_ignore_access($access);

} else {

    elgg_set_ignore_access($access);
    $gift = get_entity($gift_guid);

    $area2 = elgg_view_title(elgg_echo('gifts:singlegifts'));
    if ($gift) {
        $area2 .= elgg_view_entity($gift);
    }

    elgg_set_context('gifts');

    // Format page
    $body = elgg_view('page/layouts/one_sidebar', array('content' => $area2));

    // Draw it
    echo elgg_view_page(elgg_echo('gifts:singlegifts'), $body);
}
