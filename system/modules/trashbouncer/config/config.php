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

define('TB_PATH', TL_ROOT.'/plugins/TrashBouncer');
require_once(TB_PATH.'/config/config.php');
$GLOBALS['TB_CONFIG_DEFAULT'] = array(
  'config' => array(
    'table_tokens'        =>'tl_trashbouncer_tokens',
    'table_specialtokens' =>'tl_trashbouncer_specialtokens',
    'table_log'           =>'tl_trashbouncer_log',
    'table_categories'    =>'tl_trashbouncer_categories',
    'lexer'               => TRASHBOUNCER_CONFIG_lexer,
    'degenerator'         => TRASHBOUNCER_CONFIG_degenerator,
    'useRelevant'         => TRASHBOUNCER_CONFIG_useRelevant,
    'minRelevance'        => TRASHBOUNCER_CONFIG_minRelevance,
    'robS'                => TRASHBOUNCER_CONFIG_robS,
    'probUnknown'         => TRASHBOUNCER_CONFIG_probUnknown,
  ),
  'prefs' => array(
    'logEnabled'                  => TRASHBOUNCER_PREFS_logEnabled,
    'autolearnEnabled'            => TRASHBOUNCER_PREFS_autolearnEnabled,
    'autolearnOnHam'              => TRASHBOUNCER_PREFS_autolearnOnHam,
    'autolearnOnSpam'             => TRASHBOUNCER_PREFS_autolearnOnSpam,
    'autolearnOnStopwords'        => TRASHBOUNCER_PREFS_autolearnOnStopwords,
    'autolearnMaxSpamProbability' => TRASHBOUNCER_PREFS_autolearnMaxSpamProbability,
    'autolearnMinSpamProbability' => TRASHBOUNCER_PREFS_autolearnMinSpamProbability,
    'autolearnMaxHamProbability'  => TRASHBOUNCER_PREFS_autolearnMaxHamProbability,
    'autolearnMinHamProbability'  => TRASHBOUNCER_PREFS_autolearnMinHamProbability,
    'stopwordsEnabled'            => TRASHBOUNCER_PREFS_stopwordsEnabled,
    'stopwordsMax'                => TRASHBOUNCER_PREFS_stopwordsMax,
    'ignorewordsEnabled'          => TRASHBOUNCER_PREFS_ignorewordsEnabled,
    'pivotPoint'                  => TRASHBOUNCER_PREFS_pivotPoint,
  ),
);

array_insert($GLOBALS['BE_MOD']['system'], 4, array(
  'trashbouncer' => array(
    'tables'            => array('tl_trashbouncer_log', 'tl_trashbouncer_specialtokens'),
    'icon'              => '/plugins/TrashBouncer/icons/16x16/TrashBouncer.png',
    'stylesheet'        => '/system/modules/trashbouncer/html/trashbouncer.css',
    'markAsSpam'        => array('TrashBouncerAdminContao', 'categorizeAsSpam'),
    'markAsHam'         => array('TrashBouncerAdminContao', 'categorizeAsHam'),
    'markAsUnknown'     => array('TrashBouncerAdminContao', 'categorizeAsUnknown'),
    'linktolog'         => array('TrashBouncerAdminContao', 'linkToLog'),
    'linktomaintenance' => array('TrashBouncerAdminContao', 'linkToMaintenance'),
    'maintenance'       => array('TrashBouncerAdminContao', 'maintenance'),
    'edit'              => array('TrashBouncerAdminContao', 'edit'),
    'addstopword'       => array('TrashBouncerAdminContao', 'addStopword'),
    'addignoreword'     => array('TrashBouncerAdminContao', 'addIgnoreword'),
    'delstopword'       => array('TrashBouncerAdminContao', 'deleteStopword'),
    'delignoreword'     => array('TrashBouncerAdminContao', 'deleteIgnoreword'),
  )
));

$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('TrashBouncerContao', 'isThisSpam');
 
?>