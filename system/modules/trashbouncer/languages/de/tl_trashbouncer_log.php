<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Trashbouncer
 * Copyright (C) 2011-2013 Holger Teichert
 *
 * Extension for:
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @copyright  Holger Teichert 2013
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 * @license    LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['id'] = &$GLOBALS['TL_LANG']['MSC']['id'];
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['info'] = array('Ursprung', 'Kurzinfo zum Ursprung des Eintrags');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['text'] = array('Text', 'Protokollierter Text');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['cat'] = array('Kategorie', 'Aktueller Status des Eintrages (Ham/Spam)');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['cat_reference'] = array('-1'=>'Spam', '0'=>'Neutral', '1'=>'Ham');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['lang'] = array('Sprache', 'Sprache des Eintrages');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['ip'] = array('IP-Adresse', 'IP-Adresse des Benutzers');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['tstamp'] = array('Datum', 'Datum und Uhrzeit des Eintrages');


/**
 * Reference
 */
//$GLOBALS['TL_LANG']['tl_trashbouncer_log'][''] = '';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['edit'] = array('Bearbeiten', 'Eintrag ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['show'] = array('Anzeigen', 'Eintrag ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['delete']   = array('Löschen', 'Eintrag ID %s löschen');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsSpam'] = array('Spam', 'Eintrag ID %s als Spam markieren');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsHam'] = array('Ham', 'Eintrag ID %s als Ham markieren');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsUnknown'] = array('Neutral', 'Eintrag ID %s als neutral markieren');

/**
 * Pseudo fields
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['classification'] = 'Spamfilter-Einstufung';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['isSpam'] = 'Spamvermutung';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['probability'] = 'Spamwahrscheinlichkeit';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['stopwordscount'] = 'Stopwörter';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['stopwords'] = 'Stopwörter';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['ignorewordscount'] = 'Ignorierte Wörter';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['ignorewords'] = 'Ignorierte Wörter';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['tokens'] = 'Wortliste';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['mostoftentokens'] = 'Häufigste Wörter';

$GLOBALS['TL_LANG']['tl_trashbouncer_log']['relevanttokens'] = 'Bewertete Wörter<br> (%s Stück/Relevanz &gt; %s)';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['tokenscount'] = 'Wörter gesamt';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['smalltokenscount'] = 'Kurze Wörter';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['largetokenscount'] = 'Lange Wörter';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['fataltokenscount'] = 'Extrem lange Wörter';

$GLOBALS['TL_LANG']['tl_trashbouncer_log']['found'] = 'Gefunden';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['allowed'] = 'Erlaubt';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['pivotPoint'] = 'Grenzwert';


/**
 * Labels
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['count'] = 'Anz.';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['relevance'] = 'Relev.';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['singleProbability'] = 'Einzel-Wkt.';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['token'] = 'Wort';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['actions'] = '';

/**
 * Actions
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['addstopword'] = array('Als Stopwort hinzufügen', 'Das Wort „%s“ zur Stopwortliste hinzufügen.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['delstopword'] = array('Aus Stopwörtern löschen', 'Das Wort „%s“ aus der Stopwortliste löschen.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['addignoreword'] = array('Als ignoriertes Wort hinzufügen', 'Das Wort „%s“ zur Liste der ignorierten Wörter hinzufügen.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['delignoreword'] = array('Aus ignorierten Wörtern löschen', 'Das Wort „%s“ aus der Liste der ignorierten Wörter löschen.');
?>