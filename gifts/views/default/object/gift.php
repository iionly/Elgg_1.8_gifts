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

// Select Receiver and Sender
$sender = get_entity($vars['entity']->owner_guid);
$receiver = get_entity($vars['entity']->receiver);
$message = $vars['entity']->description;

$gifttext = elgg_get_plugin_setting('gift_'.$vars['entity']->gift_id, 'gifts');
$imagefile = "gift_".$vars['entity']->gift_id."_default.jpg";
$imgfile = dirname(dirname(dirname(dirname(__FILE__))))."/images/".$imagefile;

echo elgg_view_title($gifttext);
?>

<div>

<p>
<?php
    if (file_exists($imgfile)) {
        echo '<img src="'.$vars['url'].'mod/gifts/images/'.$imagefile.'" /><br/>';
    }
    echo sprintf(elgg_echo("gifts:object"), $receiver->name, $gifttext, $sender->name);
?>

</p>
<?php
    if($message) {
?>
    <p>
        <?php echo elgg_echo('gifts:message'); ?><br/>
        <?php echo $message; ?>
    </p>
<?php
    }
?>
</div>
