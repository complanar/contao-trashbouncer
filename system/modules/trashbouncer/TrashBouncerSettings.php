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
 * Class TrashBouncerSettings
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Holger Teichert 2005-2013
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 */

class TrashBouncerSettings {
  
  protected $settings;
  
  /**
   * Initialize class
   * @access public
   * @return void
   */
  public function __construct () {
    require_once(TB_PATH.'/config/config.php');
    $this->settings = $GLOBALS['TB_CONFIG_DEFAULT'];
  }
  
  /**
   * Get actual settings
   */
  public function getActualSettings() {
    $localConfigSettings = $this->getSettingsFromLocalConfig();
    $actualSettings = $GLOBALS['TB_CONFIG_DEFAULT'];
    foreach ($localConfigSettings as $key => $value) {
      foreach ($value as $k => $v) {
        if (isset($actualSettings[$key][$k])) {
          $actualSettings[$key][$k] = $v;
        }
      }
    }
    return $actualSettings;
  }
  
  /**
   * Get settings from $GLOBALS['TL_CONFIG']
   * @access public
   */
  public function getSettingsFromLocalConfig() {
    $settings = array();
    foreach ($this->settings as $key=>$value) {
      $settings[$key] = array();
      foreach ($value as $k=>$v) {
        $strKey = 'trashbouncer_'.$key.'_'.$k;
        if(isset($GLOBALS['TL_CONFIG'][$strKey]) && '' !== ($GLOBALS['TL_CONFIG'][$strKey])) {
          $settings[$key][$k] = $GLOBALS['TL_CONFIG'][$strKey];
        }
      }
    }
    return $settings;
  }
  
  /**
   * Load default value from TrashBouncer Configuration
   * @param string
   * @param DataContainer
   * @return string
   */
  protected function loadDefaultValue($value, DataContainer $dc) {
    $tmpArr = explode('_', $dc->field);
    print_r($tmpArr[2]);
    $tmpValue = $this->settings[$tmpArr[1]][$tmpArr[2]];
    return $tmpValue;
  }
  
  /**
   * Loads the default value if a setting is not defined in $GLOBALS['TL_CONFIG]
   * @access public
   * @param string
   * @param DataContainer
   * @return string 
   */
  public function loadDefaultValueIfUnset($value, DataContainer $dc) {
    if(!isset($GLOBALS['TL_CONFIG'][$dc->field])) {
      $objConfig = Config::getInstance();
      $value = $this->loadDefaultValue($value, $dc);
      $GLOBALS['TL_CONFIG'][$dc->field] = $value;
      if (is_writable(TL_ROOT . '/system/tmp') && 
        file_exists(TL_ROOT . '/system/config/localconfig.php')) 
      {
        $objConfig->update("\$GLOBALS['TL_CONFIG']['".$dc->field."']", $value);
      }
    }
    return $value;
  }
  
  /**
   * Load Half Probability
   * @access public
   * @param string
   * @param DataContainer
   * @return string
   */
  public function loadHalfProbability($value, DataContainer $dc) {
    $tmpValue = $this->testHalfProbability((float) $value);
    if ($value == '' || (float) $value != (float) $tmpValue) {
      $tmpValue = $this->loadDefaultValueIfUnset($value, $dc);
    }
    return $tmpValue;
  }
  
  /**
   * Load Probability
   * @access public
   * @param string
   * @param DataContainer
   * @return string
   */
  public function loadProbability($value, DataContainer $dc) {
    $tmpValue = $this->testProbability((float) $value);
    if ($value == '' || (float) $value != (float) $tmpValue) {
      $tmpValue = $this->loadDefaultValueIfUnset($value, $dc);
    }
    return $tmpValue;
  }
  
  /**
   * Test and save half probability
   * @param string
   * @param DataContainer
   * @return string
   */
  public function saveHalfProbability($value, DataContainer $dc) {
    return $this->testHalfProbability($value);
  }
  
  /**
   * Test and save Probability
   * @param string
   * @param DataContainer
   * @return string
   */
  public function saveProbability($value, DataContainer $dc) {
    return $this->testProbability($value);
  }
  
  /**
   * Make sure the number lies between 0 and 1
   * @param string
   * @param DataContainer
   * @return string
   */
  protected function testProbability($value) {
    return (is_numeric($value))? max(min(1,$value),0) : 0;
  }
  
  /**
   * Make sure the number lies between 0 and 0.5
   * @param string
   * @param DataContainer
   * @return string
   */
  protected function testHalfProbability($value) {
    return (is_numeric($value))? max(min(0.5,$value),0) : 0;
  }
  
  /**
   * Make sure the number is an natural number
   * @param string
   * @param DataContainer 
   * @return string
   */
  public function testNaturalNumber($value, DataContainer $dc) {
    $tmpValue = max((int) $value, 0); 
    if ($value == '' || (int) $value !== $tmpValue) {
      $tmpValue = $this->loadDefaultValueIfUnset($value, $dc);
    }
    return $tmpValue;
  }
  
  /**
   * Get available lexers
   * @access public
   * @return array
   */
  public function getAvailableLexers() {
    return $this->getAvailableTools('lexer');
  }
  
  /**
   * Get available lexers
   * @access public
   * @return array
   */
  public function getAvailableDegenerators() {
    return $this->getAvailableTools('degenerator');
  }
  
  /**
   * Get available TrashBouncer tools
   * @access protected
   * @param string
   * @return array
   */
  protected function getAvailableTools($type) {
    $dir = TB_PATH.'/'.$type;
    if (is_dir($dir)) {
      $arrTools = scandir($dir);
      $tmpTools = array();
      foreach ($arrTools as $tool) {
        $basename = basename($tool, '.php');
        if (is_file($dir.'/'.$tool) && $tool != $type.'.php' && $tool != $basename) {
          $tmpTools[$basename] = $basename;
        }
      }
      return $tmpTools;
    }
    return false;
  }
}