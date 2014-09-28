<?php

/**
 * Gifts index page widget
 **/

// get widget settings
$limit = sanitise_int($vars["entity"]->gifts_count, false);
if(empty($limit)){
	$limit = 10;
}

$gifts = elgg_get_entities(array('type' => 'object', 'subtype' => 'gift', 'limit' => $limit));

if ($gifts) {
	foreach($gifts as $gift) {
		// Select Receiver and Sender
		$sender = get_entity($gift->owner_guid);
		$receiver = get_entity($gift->receiver);

		if ((elgg_instanceof($sender, 'user')) && (elgg_instanceof($receiver, 'user'))) {

			$gifttext = elgg_get_plugin_setting('gift_'.$gift->gift_id, 'gifts');
			$imagefile = "gift_".$gift->gift_id."_tiny.jpg";
			$imgfile =  dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/images/".$imagefile;

			$receiver_link = "<a href=\"{$receiver->getURL()}\">{$receiver->name}</a>";
			$sender_link = "<a href=\"{$sender->getURL()}\">{$sender->name}</a>";
			$gift_link = "<a href=\"" .elgg_get_site_url()."gifts/" . $receiver->username . "/singlegift?guid={$gift->guid}\">".$gifttext."</a>";

			$Url = $gift->getURL();

			echo "<div class=\"gifts_widget_wrapper\">";
			echo "<a href=\"" .elgg_get_site_url()."gifts/" . $receiver->username . "/singlegift?guid={$gift->guid}\">";
			if (file_exists($imgfile)) {
				echo "<div class=\"gifts_widget_icon\"><img src=\"".elgg_get_site_url().'mod/gifts/images/'.$imagefile."\" /></div>";
			} else {
				echo "<div class=\"gifts_widget_icon\"><img src=\"".elgg_get_site_url()."mod/gifts/images/noimage.jpg\" /></div>";
			}
			echo "</a>";
			echo "<div class=\"gifts_widget_content\">";
			echo elgg_echo("gifts:object", array($receiver_link, $gift_link, $sender_link));
			echo "</div>";
			echo "</div>";
		}
	}
} else {
	echo elgg_echo('gifts:nogifts');
}
