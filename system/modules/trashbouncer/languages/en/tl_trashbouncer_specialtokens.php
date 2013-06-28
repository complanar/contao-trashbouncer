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
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['token'] = array('Word', 'The special token');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['type'] = array('Type', 'Select if the token is ignored or blocked.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['lang'] = array('Language', 'ISO language code of the special token');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['ignoreword'] = 'Ignored word';
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['stopword'] = 'Stopword';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['new']    = array('New special token', 'Add a new ignored or blocked token.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['edit']   = array('Edit', 'Edit special token ID %s.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['copy']   = array('Copy', 'Copy speicla token ID %s.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['delete'] = array('Delete', 'Delete special token ID %s.');
$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['show']   = array('Show', 'Show special token ID %s.');

?>