<?php
/**
 * Gifts widget for index page edit view
 */

$count = sanitise_int($vars["entity"]->gifts_count, false);
if(empty($count)){
	$count = 10;
}

?>
<div>
	<?php echo elgg_echo("gifts:widget:num_display"); ?><br />
	<?php echo elgg_view("input/text", array("name" => "params[gifts_count]", "value" => $count, "size" => "4", "maxlength" => "4")); ?>
</div>
