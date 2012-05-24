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

global $CONFIG;

$tab = get_input('tab') ? get_input('tab') : 'globalsettings';

$params = array(
        'tabs' => array(
                  array('title' => elgg_echo('gifts:settings:globalsettings'), 'url' => "$url" . '?tab=globalsettings', 'selected' => ($tab == 'globalsettings')),
                  array('title' => elgg_echo('gifts:settings:giftsettings'), 'url' => "$url" . '?tab=giftsettings', 'selected' => ($tab == 'giftsettings')),
        )
);

echo elgg_view('navigation/tabs', $params);

switch($tab) {
    case 'globalsettings':
            echo elgg_view("gifts/globalsettings");
            break;
    case 'giftsettings':
            echo elgg_view("gifts/giftsettings");
            break;
}
