<?php
// Get the required points for an gift
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

$GiftID = get_input('id');

$points = elgg_get_plugin_setting('giftpoints_'.$GiftID, 'gifts');

if($points == "") {
	echo 0;
} else {
	echo $points;
}
