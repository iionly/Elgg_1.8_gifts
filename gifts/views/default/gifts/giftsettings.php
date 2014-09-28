<?php

//Load Plugin Settings
$plugin = elgg_get_plugin_from_id('gifts');

$showallgifts = $plugin->showallgifts;
$useuserpoints = $plugin->useuserpoints;
$giftcount = $plugin->giftcount;

$form = "<input type=\"hidden\" name=\"giftcount\" value=\"$giftcount\" />";
$gift_count = $giftcount;
for ($i=1;$i<=$gift_count;$i++) {
	$form .= "<h2>".elgg_echo('gifts:settings:title')." #$i</h2>";
	$form .= elgg_view('input/text',array('name'=>'params[gift_'.$i.']','value'=>elgg_get_plugin_setting('gift_'.$i, 'gifts')));

	if ($useuserpoints == 1 && elgg_is_active_plugin('elggx_userpoints')) {
		$form .= elgg_echo('gifts:settings:userpoints')." #$i";
		$form .= elgg_view('input/text',array('name'=>'params[giftpoints_'.$i.']','value'=>elgg_get_plugin_setting('giftpoints_'.$i, 'gifts')));
	}

	$form .= elgg_echo('gifts:settings:image')." #$i<br/>";
	$form .= elgg_view('input/file',array('name'=>'giftimage_'.$i));

	// Show Image if already uploaded
	$imgfile = dirname(dirname(dirname(dirname(__FILE__))))."/images/gift_".$i.".jpg";
	if (file_exists($imgfile)) {
		$form .= '<img src="'.elgg_get_site_url().'mod/gifts/images/gift_'.$i.'_medium.jpg" /><br/>';
	}
}

$form .= "<br><br>".elgg_view('input/submit', array('value' => elgg_echo("save")));
$form .= "</p>";
echo elgg_view('input/form', array('action' => elgg_get_site_url() . 'action/gifts/savegifts', 'enctype'=>"multipart/form-data" ,'body' => $form));
