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

$sender = get_entity($vars['item']->subject_guid);
$gift = get_entity($vars['item']->object_guid);
$receiver = get_entity($gift->receiver);

$sender_link = "<a href=\"{$sender->getURL()}\">{$sender->name}</a>";
$receiver_link = "<a href=\"{$receiver->getURL()}\">{$receiver->name}</a>";

$gifttext = elgg_get_plugin_setting('gift_'.$gift->gift_id, 'gifts');
$imagefile = "gift_".$gift->gift_id."_medium.jpg";
$imgfile = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))."/images/".$imagefile;
if (file_exists($imgfile)) {
    $attachment = '<img src="'.elgg_get_site_url().'mod/gifts/images/'.$imagefile.'" /><br/>';
} else {
    $attachment = null;
}
$gift_link = "<a href=\"" .elgg_get_site_url()."gifts/" . $receiver->username . "/singlegift?guid={$gift->guid}\">".$gifttext."</a>";

$string = elgg_echo("gifts:river_new", array($receiver_link, $gift_link, $sender_link));

echo elgg_view('river/elements/layout', array(
        'item' => $vars['item'],
        'message' => $string,
        'attachments' => $attachment
));
