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
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['info'] = array('Origin', 'Short information where the log entry comes from.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['text'] = array('Text', 'Logged text.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['cat'] = array('Category', 'Acual state of the entry (Ham/Spam).');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['cat_reference'] = array('-1'=>'Spam', '0'=>'Neutral', '1'=>'Ham');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['lang'] = array('Language', 'Language of the entry.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['ip'] = array('IP-Address', 'IP-Address of the user.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['tstamp'] = array('Date', 'Date and time of the entry.');


/**
 * Reference
 */
//$GLOBALS['TL_LANG']['tl_trashbouncer_log'][''] = '';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['edit'] = array('Edit', 'Edit entry ID %s.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['show'] = array('Show', 'Show entry ID %s.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['delete']   = array('Delete', 'Delete entry ID %s.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsSpam'] = array('Spam', 'Mark entry ID %s as Spam.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsHam'] = array('Ham', 'Mark entry ID %s as Ham.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsUnknown'] = array('Neutral', 'Mark entry ID %s as neutral.');

/**
 * Pseudo fields
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['classification'] = 'Spamfilter classification';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['isSpam'] = 'Spam guess';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['probability'] = 'Spam probability';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['stopwordscount'] = 'Stopwords';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['stopwords'] = 'Stopwords';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['ignorewordscount'] = 'Ignored words';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['ignorewords'] = 'Ignored words';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['tokens'] = 'Token list';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['mostoftentokens'] = 'Most often tokens';

$GLOBALS['TL_LANG']['tl_trashbouncer_log']['relevanttokens'] = 'Classified tokens<br> (%s Count/Relevance &gt; %s)';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['tokenscount'] = 'Token count';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['smalltokenscount'] = 'Short tokens';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['largetokenscount'] = 'Large tokens';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['fataltokenscount'] = 'Extremely large tokens';

$GLOBALS['TL_LANG']['tl_trashbouncer_log']['found'] = 'Found';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['allowed'] = 'Allowed';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['pivotPoint'] = 'Critical Value';


/**
 * Labels
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['count'] = 'Count';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['relevance'] = 'Relev.';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['singleProbability'] = 'Single prob.';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['token'] = 'Token';
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['actions'] = '';

/**
 * Actions
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['addstopword'] = array('Add as stopword', 'Add the word "%s" to the stopword list.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['delstopword'] = array('Delete from stopwords.', 'Remove the word "%s" from the stopword list.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['addignoreword'] = array('Add as ignored word', 'Add the word "%s" to the list of ignored words.');
$GLOBALS['TL_LANG']['tl_trashbouncer_log']['delignoreword'] = array('Delete from ignored words', 'Remove the word "%s" from the list of ignored words.');
?>