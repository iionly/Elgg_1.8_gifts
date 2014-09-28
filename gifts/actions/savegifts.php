<?php

/**
 * Save Gifts settings
 * Thanks for the Userpoint Api where i got this pice of code from
 */

$gift_count = get_input('giftcount');

// Params array (text boxes and drop downs)
$params = get_input('params');
$result = false;

foreach ($params as $k => $v) {
	if (!elgg_set_plugin_setting($k, $v, 'gifts')) {
		register_error(elgg_echo('gifts:settings:savefail', array('userpoints')));
		forward(REFERRER);
	}
}

// Get Amount of Gifts
$sender = elgg_get_logged_in_user_entity();
// File Upload Function
$ImgDir = dirname(dirname(__FILE__))."/images/";

for ($i=1;$i<=$gift_count;$i++) {

	$imageid = 'giftimage_'.$i;

	if ((isset($_FILES[$imageid])) && (substr_count($_FILES[$imageid]['type'],'image/'))) {
		$prefix = "gift_".$i;

		$filehandler = new ElggFile();
		$filehandler->owner_guid = $sender->owner_guid;
		$filehandler->setFilename($prefix . ".jpg");
		$filehandler->open("write");
		$filehandler->write(get_uploaded_file($imageid));
		$tmpfilename = $filehandler->getFilenameOnFilestore();
		$filehandler->close();

		$thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),25,25, true);
		$thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),100,100, true);
		$thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),200,200, false);
		$normal = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),999,999, false);

		if ($thumbtiny) {

			$thumb = new ElggFile();
			$thumb->owner_guid = $sender->owner_guid;
			$thumb->setMimeType('image/jpeg');

			$thumb->setFilename($prefix."tiny.jpg");
			$thumb->open("write");
			$thumb->write($thumbtiny);
			$tTiny = $thumb->getFilenameOnFilestore();
			$thumb->close();

			$thumb->setFilename($prefix."medium.jpg");
			$thumb->open("write");
			$thumb->write($thumbmedium);
			$tMedium = $thumb->getFilenameOnFilestore();
			$thumb->close();

			$thumb->setFilename($prefix."large.jpg");
			$thumb->open("write");
			$thumb->write($thumblarge);
			$tLarge = $thumb->getFilenameOnFilestore();
			$thumb->close();

			$thumb->setFilename($prefix."default.jpg");
			$thumb->open("write");
			$thumb->write($normal);
			$tDefault = $thumb->getFilenameOnFilestore();
			$thumb->close();
		} // File converted

		rename($tmpfilename, $ImgDir.$prefix . ".jpg");
		rename($tTiny, $ImgDir.$prefix . "_tiny.jpg");
		rename($tMedium, $ImgDir.$prefix . "_medium.jpg");
		rename($tLarge, $ImgDir.$prefix . "_large.jpg");
		rename($tDefault, $ImgDir.$prefix . "_default.jpg");
		// Now move the File to our Plugin Filestore

	} // End of File is an Image File
} // End of Image Loop

system_message(elgg_echo('gifts:settings:saveok'));

forward(REFERRER);
