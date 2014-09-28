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

// Select Receiver and Sender
$sender = get_entity($vars['entity']->owner_guid);
$receiver = get_entity($vars['entity']->receiver);
$message = $vars['entity']->description;

if (elgg_instanceof($sender, 'user')) {
	$sender_link = "<a href=\"{$sender->getURL()}\">{$sender->name}</a>";
} else {
	$sender_link = elgg_echo('gifts:sender_fallback');
}

if (elgg_instanceof($receiver, 'user')) {
	$receiver_link = "<a href=\"{$receiver->getURL()}\">{$receiver->name}</a>";
} else {
	$receiver_link = elgg_echo('gifts:receiver_fallback');
}

$gifttext = elgg_get_plugin_setting('gift_'.$vars['entity']->gift_id, 'gifts');
$imagefile = "gift_".$vars['entity']->gift_id."_default.jpg";
$imgfile = dirname(dirname(dirname(dirname(__FILE__))))."/images/".$imagefile;

echo elgg_view_title($gifttext);

if (elgg_is_admin_logged_in() || (elgg_get_logged_in_user_guid() == $vars['entity']->owner_guid) || (elgg_get_logged_in_user_guid() == $vars['entity']->receiver)) {
	echo "<div style='float:right;'>";
	echo $delete_button = elgg_view("output/confirmlink",array(
		'href' => elgg_get_site_url() . "action/gifts/delete?guid=" . $vars['entity']->guid,
		'confirm' => elgg_echo('gifts:deleteconfirm'),
		'class' => 'elgg-icon elgg-icon-delete'
	));
	echo "</div>";
}
?>

<div>

<p>
<?php
	if (file_exists($imgfile)) {
		echo '<img src="'.elgg_get_site_url().'mod/gifts/images/'.$imagefile.'" /><br/>';
	}
	echo elgg_echo("gifts:object", array($receiver_link, $gifttext, $sender_link));
?>

</p>
<?php
	if($message) {
?>
	<p>
		<label><?php echo elgg_echo('gifts:message'); ?><br/></label>
		<?php echo $message; ?>
	</p>
<?php
	}
?>
</div>
