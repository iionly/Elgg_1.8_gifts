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
 *
 * updated for Elgg 1.8 by iionly (iionly@gmx.de)
 * German translation by iionly
 */

$german = array(
'admin:administer_utilities:gifts' => "Gifts",
'river:gifts:user:default' => "Ein neues Geschenk wurde versendet!",
'river:gifts:object:default' => "Ein neues Geschenk wurde versendet!",
'gifts:menu' => "Geschenke" ,
'gifts:yourgifts' => "Meine Geschenke",
'gifts:allgifts' => "Alle Geschenke",
'gifts:sent' => "Versendete Geschenke",
'gifts:sendgifts' => "Versende ein Geschenk",
'gifts:singlegifts' => "Geschenkdetails",
'gifts:friend' => "Freund(in): ",
'gifts:message' => "Nachricht: ",
'gifts:selectgift' => "Wähle ein Geschenk: ",
'gifts:gift' => "Geschenk",
'gifts:access' => 'Das Geschenk soll sichtbar sein für: ',
'gifts:foureyesaccess' => 'Nur für mich und den Beschenkten',
'gifts:warning_before_saving' => 'Achtung: Prüfe Deine Eingaben vor dem Versenden des Geschenks genau. Danach gibt es keine Möglichkeit mehr, eventuelle Fehler zu korrigieren!',
'gifts:send' => "Geschenk versenden",
'gifts:sendok' => "Das Geschenk wurde zugestellt.",
'gifts:object' => "%s hat %s von %s erhalten.",
'gifts:river' => "%s erhielt ein %s von ",
'gifts:river_new' => "%s erhielt %s von %s.",
'gifts:blank' => "Bitte wähle den Freund / die Freundin aus, die das Geschenk erhalten soll!",
'gift:delete:success' => "Das Geschenk wurde gelöscht.",
'gifts:deleteconfirm' => "Bist Du sicher, dass Du dieses Geschenk löschen willst? Es wird dann sowohl für den Schenker als auch für den Beschenkten unwiederbringlich weg sein.",

'gifts:sender_fallback' => 'einem früheren Mitglied',
'gifts:receiver_fallback' => 'Ein früheres Mitglied',

'gifts:widget' => "Geschenke",
'gifts:widget:num_display' => "Anzahl der anzuzeigenden Geschenke",
'gifts:widget:description' => "Zeige die Geschenke, die Du erhalten hast.",
'gifts:index_widget:description' => "Zeigt die neuesten Geschenke der Seite.",

'gifts:pointssum' => "Du hast noch %s Aktivitätspunkte zum Versenden von Geschenken übrig.",
'gifts:notenoughpoints' => "Du hast nicht genügend Aktivitätspunkte, um dieses Geschenk zu versenden!",
'gifts:pointscost' => "Dieses Geschenk kostet ",
'gifts:pointscostafter' => " Aktivitätspunkte.",
'gifts:pointfail' => "Bei der Verrechnung der Aktivitätspunkte ist ein Fehler aufgetreten!",
'gifts:pointsuccess' => "Die Kosten für das Geschenk wurden von Deinen Aktivitätspunkten abgezogen!",

'item:object:gift' => 'Geschenke',
'gifts:settings:number' => "Anzahl der Geschenke?",
'gifts:settings:title' => "Geschenk",
'gifts:settings:globalsettings' => "Einstellungen",
'gifts:settings:giftsettings' => "Geschenke",
'gifts:settings:useuserpoints' => "Das Elggx-Userpoints-Plugin verwenden?",
'gifts:settings:userpoints' => "Aktivitätspunkte",
'gifts:settings:image' => "Bild",
'gifts:settings:showallyes' => "Ja",
'gifts:settings:showallno' => "Nein",
'gifts:settings:showallgifts' => "Alle Geschenke anzeigen?",
'gifts:settings:saveok' => "Die Einstellungen wurden gespeichert.",
'gifts:settings:savefail' => "Beim Speichern der Einstellungen ist ein Fehler aufgetreten!",

'gifts:mail:subject' => "Du hast ein neues Geschenk erhalten!",
'gifts:mail:body' => "Du hast ein neues Geschenk von %s bekommen.

Um Dein Geschenk anzusehen, folge dem Link: %s

Du kannst auf diese Email NICHT antworten."
);

add_translation("de",$german);