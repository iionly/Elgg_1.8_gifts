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

$english = array(
'admin:administer_utilities:gifts' => "Gifts",
'river:gifts:user:default' => "A new gift was sent!",
'river:gifts:object:default' => "A new gift was sent!",
'gifts:menu' => "Gifts" ,
'gifts:yourgifts' => "My Gifts",
'gifts:allgifts' => "All Gifts",
'gifts:sent' => "Sent Gifts",
'gifts:sendgifts' => "Send a gift",
'gifts:singlegifts' => "Gift Details",
'gifts:friend' => "Friend: ",
'gifts:message' => "Message: ",
'gifts:selectgift' => "Choose your Gift: ",
'gifts:gift' => "Gift",
'gifts:access' => 'The gift should be visible for: ',
'gifts:foureyesaccess' => 'Only for me and receiver',
'gifts:warning_before_saving' => 'Attention: Check your input carefully before sending the gift. There\'s no chance to edit your input once the gift is on its way!',
'gifts:send' => "Send gift",
'gifts:sendok' => "Gift sent successfully.",
'gifts:object' => "%s received %s from %s.",
'gifts:river' => "%s received a %s from ",
'gifts:river_new' => "%s received %s from %s.",
'gifts:blank' => "Please select a friend!",
'gift:delete:success' => "The gift was deleted successfully.",
'gifts:deleteconfirm' => "Are you sure you want to delete this gift? It will be unrecoverable lost both for the donor and the presentee.",

'gifts:sender_fallback' => 'a former member',
'gifts:receiver_fallback' => 'A former member',

'gifts:widget' => "Gifts",
'gifts:widget:num_display' => "Number of gifts",
'gifts:widget:description' => "Show your received gifts.",
'gifts:index_widget:description' => "Show the latest gifts.",

'gifts:pointssum' => "You have %s points left to send gifts.",
'gifts:notenoughpoints' => "You do not have enough Points to send this Gift!",
'gifts:pointscost' => "Price: ",
'gifts:pointscostafter' => " userpoints.",
'gifts:pointfail' => "An error occured within the userpoints api!",
'gifts:pointsuccess' => "Gift paid!",

'item:object:gift' => 'Gifts',
'gifts:settings:number' => "How many gifts do you want to provide?",
'gifts:settings:title' => "Gift",
'gifts:settings:globalsettings' => "Settings",
'gifts:settings:giftsettings' => "Gifts",
'gifts:settings:useuserpoints' => "Use Userpoints?",
'gifts:settings:userpoints' => "Points",
'gifts:settings:image' => "Image",
'gifts:settings:showallyes' => "Yes",
'gifts:settings:showallno' => "No",
'gifts:settings:showallgifts' => "Show All Gifts?",
'gifts:settings:saveok' => "Settings saved successfully.",
'gifts:settings:savefail' => "Could not save settings!",

'gifts:mail:subject' => "You have received a new Gift!",
'gifts:mail:body' => "You have received a new Gift from %s.

To view your Gift click the link below: %s

You cannot reply to this email."
);

add_translation("en",$english);