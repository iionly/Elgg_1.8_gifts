<?php

/**
 * Save Gifts settings
 * Thanks for the Userpoint Api where i got this pice of code from
 */

gatekeeper();
action_gatekeeper();

global $CONFIG;

// Params array (text boxes and drop downs)
$params = get_input('params');
$result = false;

foreach ($params as $k => $v) {
    if (!elgg_set_plugin_setting($k, $v, 'gifts')) {
        register_error(sprintf(elgg_echo('gifts:settings:savefail'), 'userpoints'));
        forward($_SERVER['HTTP_REFERER']);
    }
}

system_message(elgg_echo('gifts:settings:saveok'));

forward($_SERVER['HTTP_REFERER']);
