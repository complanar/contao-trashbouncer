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
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['token'] = array('Wort', 'Das Spezialwort.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['type'] = array('Typ', 'Legt fest, ob das Spezialwort ein Stopwort oder ignoriertes Wort sein soll.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['lang'] = array('Sprache', 'ISO-Sprachcode des Spezialwortes.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['ignoreword'] = 'Ignoriertes Wort';
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['stopword'] = 'Stopwort';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['new']    = array('Neues Spezialwort', 'Ein neues Stopwort oder ignoriertes Wort erstellen.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['edit']   = array('Bearbeiten', 'Spezialwort ID %s bearbeiten.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['copy']   = array('Kopieren', 'Spezialwort ID %s kopieren.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['delete'] = array('Löschen', 'Spezialwort ID %s löschen.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['show']   = array('Anzeigen', 'Spezialwort ID %s anzeigen.');

?>