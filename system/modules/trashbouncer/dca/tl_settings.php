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
 * Add to palette
 */
//$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'trashbouncer_enabled';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'trashbouncer_prefs_autolearnEnabled';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'trashbouncer_prefs_autolearnOnSpam';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'trashbouncer_prefs_autolearnOnHam';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'trashbouncer_prefs_stopwordsEnabled';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'trashbouncer_config_advanced';

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= 
  ';{trashbouncer_legend:hide},'.
  'trashbouncer_enabled,'.
  'trashbouncer_prefs_pivotPoint,'.
  'trashbouncer_prefs_logEnabled,'.
  'trashbouncer_prefs_autolearnEnabled,'.
  'trashbouncer_prefs_stopwordsEnabled,'.
  'trashbouncer_prefs_ignorewordsEnabled,'.
  'trashbouncer_config_advanced';

$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['trashbouncer_prefs_autolearnEnabled'] = 
  'trashbouncer_prefs_autolearnOnSpam,'.
  'trashbouncer_prefs_autolearnOnHam,'.
  'trashbouncer_prefs_autolearnOnStopwords';

$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['trashbouncer_prefs_autolearnOnSpam'] =
  'trashbouncer_prefs_autolearnMinSpamProbability,'.
  'trashbouncer_prefs_autolearnMaxSpamProbability';

$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['trashbouncer_prefs_autolearnOnHam'] =
  'trashbouncer_prefs_autolearnMinHamProbability,'.
  'trashbouncer_prefs_autolearnMaxHamProbability';

$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['trashbouncer_prefs_stopwordsEnabled'] =
  'trashbouncer_prefs_stopwordsMax';

$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['trashbouncer_config_advanced'] = 
  'trashbouncer_config_lexer,'.
  'trashbouncer_config_degenerator,'.
  'trashbouncer_config_useRelevant,'.
  'trashbouncer_config_minRelevance,'.
  'trashbouncer_config_robS,'.
  'trashbouncer_config_probUnknown';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_enabled'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_enabled'],
  'inputType' => 'checkbox',
  'eval'    => array('tl_class'=>'long')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_pivotPoint'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_pivotPoint'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'load_callback' => array(array('TrashBouncerSettings', 'loadProbability')),
  'save_callback' => array(array('TrashBouncerSettings', 'saveProbability'))
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_logEnabled'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_logEnabled'],
  'inputType' => 'checkbox',
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval' => array('tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnEnabled'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnEnabled'],
  'inputType' => 'checkbox',
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval'    => array('submitOnChange'=>true, 'tl_class' => 'clr long')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnOnSpam'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnOnSpam'],
  'inputType' => 'checkbox',
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval'    => array('submitOnChange'=>true, 'tl_class' => 'clr m12')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnMinSpamProbability'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnMinSpamProbability'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'save_callback' => array(array('TrashBouncerSettings', 'saveProbability')),
  'load_callback' => array(array('TrashBouncerSettings', 'loadProbability')) 
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnMaxSpamProbability'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnMaxSpamProbability'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'save_callback' => array(array('TrashBouncerSettings', 'saveProbability')),
  'load_callback' => array(array('TrashBouncerSettings', 'loadProbability'))
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnOnHam'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnOnHam'],
  'inputType' => 'checkbox',
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval'    => array('submitOnChange'=>true, 'tl_class' => 'clr m12')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnMinHamProbability'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnMinHamProbability'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50 clr', 'rgxp'=>'digit', 'mandatory'=>true),
  'save_callback' => array(array('TrashBouncerSettings', 'saveProbability')),
  'load_callback' => array(array('TrashBouncerSettings', 'loadProbability')) 
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnMaxHamProbability'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnMaxHamProbability'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'save_callback' => array(array('TrashBouncerSettings', 'saveProbability')),
  'load_callback' => array(array('TrashBouncerSettings', 'loadProbability'))
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_autolearnOnStopwords'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_autolearnOnStopwords'],
  'inputType' => 'checkbox',
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval' => array('tl_class' => 'clr'),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_stopwordsEnabled'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_stopwordsEnabled'],
  'inputType' => 'checkbox',
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval' => array('submitOnChange'=>true, 'tl_class'=>'clr w50 m12')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_stopwordsMax'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_stopwordsMax'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'save_callback' => array(array('TrashBouncerSettings', 'testNaturalNumber')),
  'load_callback' => array(array('TrashBouncerSettings', 'testNaturalNumber')),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_prefs_ignorewordsEnabled'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_prefs_ignorewordsEnabled'],
  'inputType' => 'checkbox',
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval' => array('tl_class'=>'clr w50')
);

// Advanced config
$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_config_advanced'] = array(
  'label'   => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_config_advanced'],
  'inputType' => 'checkbox',
  'eval'    => array('submitOnChange'=>true,'tl_class'=>'clr long')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_config_lexer'] = array(
  'label' => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_config_lexer'],
  'inputType' => 'select',
  'options_callback' => array('TrashBouncerSettings', 'getAvailableLexers'),
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval' => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_config_degenerator'] = array(
  'label' => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_config_degenerator'],
  'inputType' => 'select',
  'options_callback' => array('TrashBouncerSettings', 'getAvailableDegenerators'),
  'load_callback' => array(array('TrashBouncerSettings', 'loadDefaultValueIfUnset')),
  'eval' => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_config_useRelevant'] = array(
  'label' => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_config_useRelevant'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'save_callback' => array(array('TrashBouncerSettings', 'testNaturalNumber')),
  'load_callback' => array(array('TrashBouncerSettings', 'testNaturalNumber')),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_config_minRelevance'] = array(
  'label' => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_config_minRelevance'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'load_callback' => array(array('TrashBouncerSettings', 'loadHalfProbability')),
  'save_callback' => array(array('TrashBouncerSettings', 'saveHalfProbability'))
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_config_robS'] = array(
  'label' => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_config_robS'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'load_callback' => array(array('TrashBouncerSettings', 'loadHalfProbability')),
  'save_callback' => array(array('TrashBouncerSettings', 'saveHalfProbability'))
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['trashbouncer_config_probUnknown'] = array(
  'label' => &$GLOBALS['TL_LANG']['tl_settings']['trashbouncer_config_probUnknown'],
  'inputType' => 'text',
  'eval' => array('tl_class'=>'w50', 'rgxp'=>'digit', 'mandatory'=>true),
  'load_callback' => array(array('TrashBouncerSettings', 'loadProbability')),
  'save_callback' => array(array('TrashBouncerSettings', 'saveProbability'))
);

?>