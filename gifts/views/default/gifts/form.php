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

$useuserpoints  = elgg_get_plugin_setting('useuserpoints', 'gifts');
if($useuserpoints == 1 && function_exists('userpoints_get')) {
    $pTemp = userpoints_get(elgg_get_logged_in_user_guid());
    $points = $pTemp['approved'];
}

$ts = time();
$token = generate_action_token($ts);
$security = "?__elgg_token=$token&__elgg_ts=$ts";
?>

<div>

<script type="text/javascript">
function gifts_previewImage(ImageID) {
    ImageID++;
    var ajaxImage = '<?php echo $vars['url']; ?>mod/gifts/ajaxImage.php?id='+ImageID;

    // Check if Image file is available!!!
    $.ajax({
        url: ajaxImage,
        cache: false,
        success: function(html){
            //$("#results").append(html);
            $('#gift_preview')[0].innerHTML = html;
        }
    });

    // Need here a dynamic function to check userpoints
    <?php
        if($useuserpoints == 1){
            echo "calculateUserpoints(ImageID,$points);";
        }
    ?>
}

function calculateUserpoints(GiftID,Points) {
    // Calculating Userpoints and display send button when point are enough
    // Else display error message

    var ajaxGetPoints = '<?php echo $vars['url']; ?>mod/gifts/ajaxGetPoints.php?id='+GiftID;

    var Cost = $.ajax({
        url: ajaxGetPoints,
        async: false
    }).responseText;

    if(Cost == "") Cost = 0;

    if(Cost <= Points) {
        // Add hidden field with the cost of this gift
        var code='<input type="hidden" name="giftcost" value="'+Cost+'" /><input class="elgg-button-submit" type="submit" value="<?php echo elgg_echo('gifts:send'); ?>"/>';
        $('#gift_cost')[0].innerHTML = '<?php echo elgg_echo('gifts:pointscost'); ?>'+Cost+'<?php echo elgg_echo('gifts:pointscostafter'); ?>';
        $('#sendButton')[0].innerHTML = code;
    } else {
        var code='<label><?php echo elgg_echo('gifts:notenoughpoints');?></label>';
        $('#gift_cost')[0].innerHTML = '<?php echo elgg_echo('gifts:pointscost'); ?>'+Cost+'<?php echo elgg_echo('gifts:pointscostafter'); ?>';
        $('#sendButton')[0].innerHTML = code;
    }
}

$(document).ready(function () {
    gifts_previewImage(0);
});
</script>

<form action="<?php echo $vars['url']; ?>action/gifts/sendgift<?php echo $security; ?>" method="post">

<?php

    if($useuserpoints == 1){
        echo sprintf(elgg_echo("gifts:pointssum"), $points)."<br/>";
    }

    $send_to = get_input('send_to');
    // Already send_to?
    if($send_to){
        //get the user object
        $user = get_user($send_to);

        //draw it
        echo "<label>" . elgg_echo("gifts:friend") . ":</label><br/><div class=\"messages_single_icon\">" . elgg_view_entity_icon($user, 'tiny') . $user->username;
        echo "</div><br class=\"clearfloat\" />";
        //set the hidden input field to the recipients guid
        echo "<input type=\"hidden\" name=\"send_to\" value=\"{$send_to}\" />";
    }else{

?>

<p><label><?php echo elgg_echo('gifts:friend'); ?></label><br />
    <select name='send_to'>
        <?php
            echo "<option value=''></option>";
            foreach($vars['friends'] as $friend){
                echo "<option value='{$friend->guid}'>" . $friend->name . "</option>";
            }

        ?>
    </select></p>

<?php
}
?>

<p><label><?php echo elgg_echo('gifts:selectgift'); ?></label><br />
    <select name='gift_id' onChange="gifts_previewImage(this.selectedIndex);">
        <?php
            $gift_count = elgg_get_plugin_setting('giftcount'.$i, 'gifts');
            for ($i=1;$i<=$gift_count;$i++) {
                echo "<option value='{$i}'>".elgg_get_plugin_setting('gift_'.$i, 'gifts')."</option>";
            }
        ?>
    </select>
</p>

<div id="gift_cost">&nbsp;</div>
<div id="gift_preview">&nbsp;</div>

<div>
        <br /><label><?php echo elgg_echo('gifts:message'); ?></label><br />
        <?php echo elgg_view('input/longtext', array('name' => 'body')); ?>
</div>

<p>
<div id="access">
<?php
    $access = get_default_access();
    $out = '<p><label>'.elgg_echo("access").'<br />';
    $out .= elgg_view("input/access",array('name' => 'access','value'=>$access));
    $out .= '</label></p>';
    echo $out;
?>
</div>
</p>

<p>
<div>
<?php
    if($useuserpoints == 1){
        // Only show send button if you got enough points
        ?>
        <div id="sendButton">&nbsp;</div>
        <?php
    } else {
        echo elgg_view('input/submit', array('value' => elgg_echo('gifts:send')));
    }
?>
</div>
</p>

</form>

</div>
