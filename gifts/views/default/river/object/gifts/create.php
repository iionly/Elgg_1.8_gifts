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

// THANK YOU DDFUSION
// Added Fix from DDFusion

$performed_by = get_entity($vars['item']->subject_guid);
$performed_on = get_entity($vars['item']->object_guid);
$object = get_entity($vars['item']->object_guid);

$person_link = "<a href=\"{$performed_by->getURL()}\">{$performed_by->name}</a>";
$object_link = "<a href=\"{$performed_on->getURL()}\">{$performed_on->name}</a>";
$gift = "<a href=\"{$vars['url']}gifts/{$_SESSION['user']->username}/index\">".elgg_echo("gifts:gift")."</a>";

$string = sprintf(elgg_echo("gifts:river"), $object_link, $gift)  . " <a href=\"{$performed_by->getURL()}\">" . $performed_by->name . "</a> ";

echo elgg_view('river/elements/layout', array(
        'item' => $vars['item'],
        'message' => $string,
));
