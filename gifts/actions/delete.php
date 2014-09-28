<?php

// Get input data
$guid = (int) get_input('guid');

// Make sure we actually have permission to delete
$gift = get_entity($guid);
if (($gift->getSubtype() == "gift")  && ($gift->canEdit())) {
	// Delete it!
	$gift->delete();
	// Success message
	system_message(elgg_echo("gift:delete:success"));
	forward(REFERER);
}
