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
 * Class ModuleTrashBouncerLog
 * Handle TrashBouncer log entries
 *  
 * @package trashbouncer
 */

class ModuleTrashBouncerLog extends BackendModule {
  /**
   * Template
   * @var string
   */
  protected $strTemplate = 'be_trashbouncer_edit_log';
  
  /**
   * Constructor
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
   * Compile the module
   * @access public
   * @return void
   */
  public function compile()
  {
    
    $this->Template->goBack = $GLOBALS['TL_LANG']['MSC']['backBT'];
    $this->Template->goBackHref = $this->do;
    
    $objLogEntry = $this->getLogEntry($this->Input->get('id'));
    
    // Headline
    $this->Template->headline = sprintf(
      $GLOBALS['TL_LANG']['MSC']['showRecord'],
      $GLOBALS['TL_LANG']['MSC']['id'][0] . ' ' . $objLogEntry->id);
    
    // Database Info
    foreach ( array('id', 'info', 'text', 'cat', 'lang', 'ip', 'tstamp') as $k ) {
      $thk = "th" . ucfirst($k);
      $this->Template->$k = $objLogEntry->$k;
      $this->Template->$thk = $GLOBALS['TL_LANG']['tl_trashbouncer_log'][$k][0];
    }
    $this->Template->cat = $GLOBALS['TL_LANG']['tl_trashbouncer_log']['cat_reference'][$objLogEntry->cat];
    $this->Template->tstamp = date($GLOBALS['TL_CONFIG']['datimFormat'], $objLogEntry->tstamp);
    
    // Spamfilter Classification Info
    $this->Template->thClassification = $GLOBALS['TL_LANG']['tl_trashbouncer_log']['classification'];
    $class = $this->tb->classify($objLogEntry->text, $objLogEntry->lang);
    foreach ($class as $k=>$v) {
      $thk = "th" . ucfirst($k);
      $this->Template->$k = $v;
      $this->Template->$thk = $GLOBALS['TL_LANG']['tl_trashbouncer_log'][$k];
    }
    if ($class['isSpam']) {
      $this->Template->isSpam = $GLOBALS['TL_LANG']['MSC']['trashbouncer']['-1'];
    } else {
      $this->Template->isSpam = $GLOBALS['TL_LANG']['MSC']['trashbouncer']['1'];
    } 
    $this->Template->probability = sprintf('%.2f%%', $class['probability'] * 100);
    
    $this->Template->thPivotPoint = $GLOBALS['TL_LANG']['tl_trashbouncer_log']['pivotPoint'];
    $this->Template->pivotPoint = sprintf('%.2f%%', $this->tb->prefs['pivotPoint'] * 100);
    $this->Template->thFound = $GLOBALS['TL_LANG']['tl_trashbouncer_log']['found'];
    $this->Template->thAllowed = $GLOBALS['TL_LANG']['tl_trashbouncer_log']['allowed'];
    $this->Template->stopwordsMax = $this->tb->prefs['stopwordsMax'];
    
    foreach (array('count', 'relevance', 'singleProbability', 'token', 'actions') as $k) {
      $this->Template->$k = $GLOBALS['TL_LANG']['tl_trashbouncer_log'][$k];
    }
    
    // Most often Tokens
    arsort($class['tokens']);
    $this->Template->thMostoftentokens = $GLOBALS['TL_LANG']['tl_trashbouncer_log']['mostoftentokens'];
    $mostoftentokens = array_slice($class['tokens'], 0, 20, TRUE);
    $this->Template->mostoftentokens = $this->getMostOftenTokenActions($mostoftentokens, $objLogEntry, $class);
    
    // Most relevant Tokens
    $this->Template->thRelevanttokens = sprintf($GLOBALS['TL_LANG']['tl_trashbouncer_log']['relevanttokens'], count($class['relevanttokens']), sprintf('%.2f%%', $this->tb->config['minRelevance'] * 100));
    $this->Template->relevanttokens = $this->getRelevantTokenActions($class['relevanttokens'], $objLogEntry, $class);
    
    // Log entry actions
    $logActions = array();
    $categories = array(
      'spam'    => TrashBouncer::SPAM,
      'ham'     => TrashBouncer::HAM,
      'unknown' => TrashBouncer::UNKNOWN
    );
    foreach ($categories as $k=>$v) {
      if ($objLogEntry->cat != $v) {
        $logActions[$k] = array(
          'href'  => $this->do.'&amp;key=markAs'.ucfirst($k).'&amp;id='.$objLogEntry->id,
          'title' => sprintf($GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAs'.ucfirst($k)][1], $objLogEntry->id),
          'attributes' => ' onclick="if (!confirm(\''.sprintf($GLOBALS['TL_LANG']['MSC']['trashbouncer']['markAs'.ucfirst($k).'Confirm'], $objLogEntry->id).'\')) return false;"',
          'label'  => $GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAs'.ucfirst($k)][0]
        );
      }
    }
    $logActions['delete'] = array(
      'href'  => $this->do.'&amp;act=delete&amp;id='.$objLogEntry->id,
      'title' => sprintf($GLOBALS['TL_LANG']['trashbouncer_log']['delete'][1], $objLogEntry->id),
      'attributes' => ' onclick="if (!confirm(\''.sprintf($GLOBALS['TL_LANG']['MSC']['deleteConfirm'], $objLogEntry->id).'\')) return false;"',
      'label'  => $GLOBALS['TL_LANG']['tl_trashbouncer_log']['delete'][0]
    );
    
    $this->Template->logActions = $logActions;

    $this->Template->request = ampersand($this->Environment->request, true);
  }
  
  protected function getMostOftenTokenActions ($arrTokens, $objLogEntry, $classification) {
    $arrResult = array();
    foreach ($arrTokens as $token=>$num) {
      $arrActions = $this->getTokenActions($arrTokens, $objLogEntry, $classification);
      
      $arrResult[$token] = array(
        'num' => $num,
        'actions' => $arrActions[$token]
      );
      
    }
    return $arrResult;
  }
  
  
  
  protected function getRelevantTokenActions ($arrTokens, $objLogEntry, $classification) {
    $arrResult = array();
    foreach ($arrTokens as $token=>$num) {
      $arrActions = $this->getTokenActions($arrTokens, $objLogEntry, $classification);
      
      $arrResult[$token] = array(
        'num' => $num['relevance'],
        'probability' => $num['probability'],
        'actions' => $arrActions[$token]
      );
      
    }
    return $arrResult;
  }
  
  
  
  protected function getTokenActions ($arrTokens, $objLogEntry, $classification) {
    $actions = array();
    foreach ($arrTokens as $token => $value) {
      $stopwordsAction = (in_array($token, $classification['stopwords']))? 'del' : 'add';
      $ignorewordsAction = (in_array($token, $classification['ignorewords']))? 'del' : 'add';
      $actions[$token] = array(
        'stopword' => array(
          'action' => $stopwordsAction,
          'href'  => ampersand($this->Environment->script . '?do=trashbouncer&key='.$stopwordsAction.'stopword&token='.$token.'&lang='.$objLogEntry->lang),
          'title' => sprintf($GLOBALS['TL_LANG']['tl_trashbouncer_log'][$stopwordsAction.'stopword'][1], $token),
          'text' => $GLOBALS['TL_LANG']['tl_trashbouncer_log'][$stopwordsAction.'stopword'][0],
        ),
        'ignoreword' => array(
          'action' => $ignorewordsAction,
          'href'  => ampersand($this->Environment->script . '?do=trashbouncer&key='.$ignorewordsAction.'ignoreword&token='.$token.'&lang='.$objLogEntry->lang),
          'title' => sprintf($GLOBALS['TL_LANG']['tl_trashbouncer_log'][$ignorewordsAction.'ignoreword'][1], $token),
          'text' => $GLOBALS['TL_LANG']['tl_trashbouncer_log'][$ignorewordsAction.'ignoreword'][0],
        ),
      );
    }
    return $actions;
  }
  
  
  /**
   * Get the selected log entry
   */
  protected function getLogEntry($id) 
  {
    $objLogEntry = $this->Database->prepare('SELECT * FROM tl_trashbouncer_log WHERE id=? LIMIT 1')->execute($id); 
    if ($objLogEntry->numRows < 1)
    {
      return null;
    }
    
    return $objLogEntry;
  }
}