<?php

//Load Plugin Settings
$plugin = elgg_get_plugin_from_id('gifts');

$showallgifts = $plugin->showallgifts;
$useuserpoints = $plugin->useuserpoints;
$giftcount = $plugin->giftcount;

$form = "<p>".elgg_echo('gifts:settings:showallgifts');
$form .= '<br/><select name="params[showallgifts]">';
$form .=  "<option value=1";

if ($showallgifts == 1) {
	$form .= " selected=\"yes\" ";
}

$form .= ">".elgg_echo('gifts:settings:showallyes')."</option>";
$form .=  "<option value=0";

if ($showallgifts == 0) {
	$form .= " selected=\"no\" ";
}

$form .= ">".elgg_echo('gifts:settings:showallno')."</option>";
$form .= "</select><br/>\n\r";

// Userpoints
// Check if Userpoint Api is enabled
if (elgg_is_active_plugin('elggx_userpoints')) {
	$form .= elgg_echo('gifts:settings:useuserpoints');
	$form .= '<br/><select name="params[useuserpoints]">';
	$form .=  "<option value=1";

	if ($useuserpoints == 1) {
		$form .= " selected=\"yes\" ";
	}

	$form .= ">".elgg_echo('gifts:settings:showallyes')."</option>";
	$form .=  "<option value=0";

	if ($useuserpoints == 0) {
		$form .= " selected=\"no\" ";
	}

	$form .= ">".elgg_echo('gifts:settings:showallno')."</option>";
	$form .= "</select><br/>\n\r";
}

$form .= elgg_echo('gifts:settings:number');
$form .= "<br/><select name=\"params[giftcount]\">";
for ($i=0;$i<99;$i++) {
	$form .= "<option value=\"".$i."\"";
	if($giftcount == $i) {
		$form .= " selected=\"yes\" ";
	}
	$form .= ">".$i."</option>\n\r";
}
$form .= "</select>";
$form .= "<br><br>".elgg_view('input/submit', array('value' => elgg_echo("save")));
$form .= "</p>";

echo elgg_view('input/form', array('action' => elgg_get_site_url() . 'action/gifts/settings', 'body' => $form));
