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
 * Class TrashBouncerAdminContao
 *
 * @copyright  Holger Teichert 2011
 * @author     Holger Teichert <post@complanar.de>
 * @package    Controller
 */
class TrashBouncerAdminContao extends Backend {
  
  /**
   * Database object
   * @var object 
   */
  protected $Database;
  
  /**
   * TrashBouncer object
   * @var object
   */
  protected $tb;
  
  /**
   * Path to this module
   * @var string
   */
  protected $do;
  
  /**
   * Module for handling special things (log details, maintenance etc.)
   * @var object
   */
  protected $tbModule;
  
  /**
   * Constructor
   *
   */
  public function __construct() {
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
   * Link to the log table
   *
   * @access public
   * @return void
   */
  public function linkToLog($dc, $strTable, $arrModule) {
    $this->redirect($this->do, 301);
  }
  
  /**
   * Get buttons for categorizing links
   * 
   * @access public
   * @param array $row
   * @param string $href
   * @param string $label
   * @param string $icon
   * @param string $attributes
   * @return string
   */
  public function getCategorizeButtons($row, $href, $label, $title, $icon, $attributes) {
    
    $linkTemplate = '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="%s"%s>%s</a>';
    $categories = array(
      'spam'    => TrashBouncer::SPAM,
      'ham'     => TrashBouncer::HAM,
      'unknown' => TrashBouncer::UNKNOWN
    );
    
    $key = str_replace('key=markAs', '', $href);
    if ($row['cat'] == $categories[strtolower($key)]) {
      //$attributes = str_replace('class="tb-icon-standalone', 'class="tb-icon-standalone disabled', $attributes);
      //return sprintf('<span%s>%s</span>', $attributes, $label).' ';
      return '';
    } else {
      return sprintf($linkTemplate, specialchars($title), $attributes, $label).' ';
    }
  }
  
  /**
   * Categorizes an spamlog entry as spam and learns it's data
   * 
   * @access public
   * @return void 
   */
  public function categorizeAsSpam($dc, $strTable, $arrModule) {
    $this->_categorizeEntry($dc->id, TrashBouncer::SPAM);
  }
  
  /**
   * Categorizes an spamlog entry as ham and learns it's data
   * 
   * @access public
   * @return void 
   */
  public function categorizeAsHam($dc, $strTable, $arrModule) {
    $this->_categorizeEntry($dc->id, TrashBouncer::HAM);
  }
  
  /**
   * Categorizes an spamlog entry as unknown and learns it's data
   * 
   * @access public
   * @return void 
   */
  public function categorizeAsUnknown($dc, $strTable, $arrModule) {
    $this->_categorizeEntry($dc->id, TrashBouncer::UNKNOWN);
  }
  
  /**
   * Categorize a spamlogentry
   * @access protected
   * @param mixed $id integer or array
   * @param integer $category
   * @return bool
   */
  protected function _categorizeEntry($id, $category) {
    $this->tb->learnLogEntry($id, $category);
    $this->redirect($this->Environment->httpReferer);
  }
  
  /**
   * Add a new Stopword
   * @access public
   * @param DataContainer
   * @param string
   * @param BackendModule
   * @return void
   */
  public function addStopword(DataContainer $dc, $strTable, $arrModule) {
    $token = $this->Input->get('token');
    $lang = $this->Input->get('lang');
    if (!$this->tb->isStopword($token, $lang)) {
      $this->tb->addStopword($token, $lang);
    }
    $this->redirect($this->Environment->httpReferer);
  }
  
  /**
   * Add a new Ignoreword
   * @access public
   * @param DataContainer
   * @param string
   * @param BackendModule
   * @return void
   */
  public function addIgnoreword($dc, $strTable, $arrModule) {
    $token = $this->Input->get('token');
    $lang = $this->Input->get('lang');
    if (!$this->tb->isIgnoreword($token, $lang)) {
      $this->tb->addIgnoreword($token, $lang);
    }
    $this->redirect($this->Environment->httpReferer);
  }
  
  /**
   * Delete Stopword
   * @access public
   * @param DataContainer
   * @param string
   * @param BackendModule
   * @return void
   */
  public function deleteStopword($dc, $strTable, $arrModule) {
    $token = $this->Input->get('token');
    $lang = $this->Input->get('lang');
    $this->tb->delStopword($token, $lang);
    $this->redirect($this->Environment->httpReferer);
  }
  
  /**
   * Delete Ignoreword
   * @access public
   * @param DataContainer
   * @param string
   * @param BackendModule
   * @return void
   */
  public function deleteIgnoreword($dc, $strTable, $arrModule) {
    $token = $this->Input->get('token');
    $lang = $this->Input->get('lang');
    $this->tb->delIgnoreword($token, $lang);
    $this->redirect($this->Environment->httpReferer);
  }
  
  /**
   * Link to the specialtokens table
   *
   * @access public
   * @return void
   */
  public function linkToSpecialtokens($dc, $strTable, $arrModule) {
    $this->redirect($this->do.'&amp;table=tl_trashbouncer_specialtokens', 301);
  }
  
  /**
   * Link to the specialtokens table
   *
   * @access public
   * @return void
   */
  public function linkToMaintenance($dc, $strTable, $arrModule) {
    $this->redirect($this->do.'&amp;key=maintenance', 301);
  }
  
  /**
   * Load edit module for log entries
   */
  public function edit($dc, $strTable, $arrModule) {
    $this->import('ModuleTrashBouncerLog');
    return $this->ModuleTrashBouncerLog->generate();
  }
  
  /**
   * Load training module
   */
  public function maintenance($dc, $strTable, $arrModule) {
    $this->import('ModuleTrashBouncerMaintenance');
    return $this->ModuleTrashBouncerMaintenance->generate();
  }

}

?>
