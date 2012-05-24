<?php

/**
 * Gifts profile widget - this displays a users gifts on their profile
 **/

//the number of gifts to display
$number = (int) $vars['entity']->num_display;
if (!$number)
    $number = 4;

//the page owner
$owner = $vars['entity']->owner_guid;

$ogifts = elgg_get_entities(array('type' => 'object', 'subtype' => 'gift', 'limit' => 999));

$i=0;
foreach($ogifts as $gift) {
    if($gift->receiver == $owner) {
        // Select Receiver and Sender
        $sender = get_entity($gift->owner_guid);
        $receiver = get_entity($gift->receiver);

        $gifttext = elgg_get_plugin_setting('gift_'.$gift->gift_id, 'gifts');
        $imagefile = "gift_".$gift->gift_id."_tiny.jpg";
        $imgfile =  dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/images/".$imagefile;

        $Url = $gift->getURL();

        echo "<div class=\"gifts_widget_wrapper\">";
        echo "<a href=\"{$vars['url']}gifts/" . $receiver->username . "/singlegift?guid={$gift->guid}\">";
        if (file_exists($imgfile)) {
            echo "<div class=\"gifts_widget_icon\"><img src=\"".$vars['url'].'mod/gifts/images/'.$imagefile."\" /></div>";
        } else {
            echo "<div class=\"gifts_widget_icon\"><img src=\"".$vars['url']."mod/gifts/images/noimage.jpg\" /></div>";
        }
        echo "</a>";
        echo "<div class=\"gifts_widget_content\">";
        echo sprintf(elgg_echo("gifts:object"), $receiver->name, $gifttext, $sender->name);
        echo "</div>";
        echo "</div>";
        $i++;
        if($i == $number) break;
    }
}
