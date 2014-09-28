<?php

/**
 * Gifts profile widget - this displays a users gifts on their profile
 **/

//the number of gifts to display
$number = (int) $vars['entity']->num_display;
if (!$number) {
	$number = 4;
}

//the page owner
$owner = elgg_get_page_owner_guid();

if (elgg_get_logged_in_user_guid() == $owner) {

	$access = elgg_set_ignore_access(true);

	$gifts = elgg_get_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => 'gift',
		'limit' => $number,
		'metadata_name_value_pair' => array('name' => 'receiver', 'value' => $owner, 'operand' => '=')
	));

	if ($gifts) {
		foreach($gifts as $gift) {
			$sender = get_entity($gift->owner_guid);
			$receiver = get_entity($gift->receiver);

			if ((elgg_instanceof($sender, 'user')) && (elgg_instanceof($receiver, 'user'))) {

				$gifttext = elgg_get_plugin_setting('gift_'.$gift->gift_id, 'gifts');
				$imagefile = "gift_".$gift->gift_id."_tiny.jpg";
				$imgfile =  dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/images/".$imagefile;

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
				echo elgg_echo("gifts:object", array($receiver->name, $gift_link, $sender_link));
				if (elgg_is_admin_logged_in() || (elgg_get_logged_in_user_guid() == $gift->owner_guid) || (elgg_get_logged_in_user_guid() == $gift->receiver)) {
					echo "<div style='float:right;'>";
					echo $delete_button = elgg_view("output/confirmlink",array(
						'href' => elgg_get_site_url() . "action/gifts/delete?guid=" . $gift->guid,
						'confirm' => elgg_echo('gifts:deleteconfirm'),
						'class' => 'elgg-icon elgg-icon-delete'
					));
					echo "</div>";
				}
				echo "</div>";
				echo "</div>";
			}
		}
	} else {
		echo elgg_echo('gifts:nogifts');
	}

	elgg_set_ignore_access($access);

} else {

	$gifts = elgg_get_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => 'gift',
		'limit' => $number,
		'metadata_name_value_pair' => array('name' => 'receiver', 'value' => $owner, 'operand' => '=')
	));

	if ($gifts) {
		foreach($gifts as $gift) {
			$sender = get_entity($gift->owner_guid);
			$receiver = get_entity($gift->receiver);

			if ((elgg_instanceof($sender, 'user')) && (elgg_instanceof($receiver, 'user'))) {

				$gifttext = elgg_get_plugin_setting('gift_'.$gift->gift_id, 'gifts');
				$imagefile = "gift_".$gift->gift_id."_tiny.jpg";
				$imgfile =  dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/images/".$imagefile;

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
				echo elgg_echo("gifts:object", array($receiver->name, $gift_link, $sender_link));
				if (elgg_is_admin_logged_in() || (elgg_get_logged_in_user_guid() == $gift->owner_guid) || (elgg_get_logged_in_user_guid() == $gift->receiver)) {
					echo "<div style='float:right;'>";
					echo $delete_button = elgg_view("output/confirmlink",array(
						'href' => elgg_get_site_url() . "action/gifts/delete?guid=" . $gift->guid,
						'confirm' => elgg_echo('gifts:deleteconfirm'),
						'class' => 'elgg-icon elgg-icon-delete'
					));
					echo "</div>";
				}
				echo "</div>";
				echo "</div>";
			}
		}
	} else {
		echo elgg_echo('gifts:nogifts');
	}
}
