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
 * Class TrashBouncerMaintenanceHelper
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Holger Teichert 2005-2013
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 */

class TrashBouncerMaintenanceHelper extends Backend {
  
  /**
   * 
   */
  public function __construct()
  {
    parent::__construct();
    require_once(TB_PATH.'/TrashBouncerAdmin.php');
    require_once(dirname(__FILE__).'/TrashBouncerSettings.php');
    $tbSettings = new TrashBouncerSettings();
    $settings = $tbSettings->getActualSettings();
    if (is_array($settings['config'])) {
      $config = $settings['config'];
    } else {
      $config = NULL;
    }
    if (is_array($settings['prefs'])) {
      $prefs = $settings['prefs'];
    } else {
      $prefs = NULL;
    }
    $this->import('Database');
    $db = &$this->Database;
    $this->tb = new TrashBouncerAdmin($config, $prefs, $this->Database);
    $this->do = $this->Environment->script.'?do=trashbouncer';
  }
  
  /**
   * Generate the module
   * @return string
   */
  public function run()
  {
    if($this->Input->post('goBack') != '') $this->redirect($this->Environment->request);
  }
  
  /**
   * Get all trained Languages
   * 
   * @access public
   * @return array
   */
  public function getAllLanguages () {
    $langs = $this->Database->execute(sprintf("SELECT `lang` FROM %s", $GLOBALS['TB_CONFIG_DEFAULT']['config']['table_categories']))->fetchAllAssoc();
    $arrTmp = array();
    foreach ($langs as $l) {
      $arrTmp[] = $l['lang'];
    }
    return $arrTmp;
  }

  /**
   * Get Language Details
   * 
   */
  public function getLanguageDetails($lang) {
    require(TL_ROOT.'/system/config/languages.php');
    if (!is_array($lang)) {
      $lang = array($lang);
    }
    $arrTmp = array();
    foreach ($lang as $l) {
      $arrTmp[$l] = array('code'=>$l);
      if (isset($languages[$l])) {
        $arrTmp[$l]['english'] = $languages[$l];
      }
      if (isset($langsNative[$l])) {
        $arrTmp[$l]['native'] = $langsNative[$l];
      }
    }
    return $arrTmp;
  }
  
  /**
   * Return the language widget as object
   * @param mixed
   * @return Widget
   */
  public function getLanguageWidget ($langs, $type, $value) {
  
    $widget = new CheckBox();

    $widget->id = 'languages_'.$type;
    $widget->name = 'languages_'.$type;
    $widget->multiple = TRUE;
    $widget->mandatory = TRUE;
    $widget->label = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['availableLanguages'][0];
    
    $arrOptions = array();
    foreach ($langs as $k=>$v) {
      $arrOptions[] = array('value'=>$v['code'], 'name'=>$v['code'], 'label'=>sprintf('<strong>%s</strong> (%s)',$v['native'], $v['english']));
    }
    $widget->options = $arrOptions;

    if ($GLOBALS['TL_CONFIG']['showHelp'] && $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['availableLanguages'][1] != '')
    {
      $widget->help = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['availableLanguages'][1];
    }
    
    // Valiate input
    if ($this->Input->post('FORM_SUBMIT') == 'tl_trashbouncer_maintenance_'.$type && $this->Input->post('goBack') == '')
    {
      $widget->validate();
    }

    return $widget;
  }
  
  /**
   * Return the language widget as object
   * @param mixed
   * @return Widget
   */
  public function getBackupWidget ($type, $checked) {
    $widget = new CheckBox();
    
    $widget->id = 'backup_'.$type;
    $widget->name = 'backup_'.$type;
    $widget->label = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['backup'][0];
    if ($GLOBALS['TL_CONFIG']['showHelp'] && $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['backup'][1] != '')
    {
      $widget->help = sprintf($GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['backup'][1], $GLOBALS['TL_CONFIG']['uploadPath']);
    }
    
    $widget->options = array(array('value'=>'1', 'name'=>'backup', 'label'=>$GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['createBackup'], 'checked'=>($checked=='1')? true : false));
    
    // Valiate input
    if ($this->Input->post('FORM_SUBMIT') == 'tl_trashbouncer_maintenance_'.$type && $this->Input->post('goBack') == '')
    {
      $widget->validate();
    }
    
    return $widget;
  }
}