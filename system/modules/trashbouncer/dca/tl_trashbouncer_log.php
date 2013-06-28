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
 * Table tl_trashbouncer_log
 */
$GLOBALS['TL_DCA']['tl_trashbouncer_log'] = array(

  // Config 
  'config' => array(
    'dataContainer' => 'Table',
    'closed'        => TRUE,
    'notEditable'   => FALSE
  ),
        
  
  // List 
  'list' => array(
    'sorting' => array(
      'mode'        => 2,
      'fields'      => array('tstamp DESC'),
      'flag'        => 6,
      'panelLayout' => 'filter;sort,search,limit'
    ),
    'label' => array(
      'fields'         => array('tstamp', 'text'),
      'format'         => '[%s] %s',
      'maxCharacters'  => 96,
      'label_callback' => array('tl_trashbouncer_log', 'colorize')
    ),
    'global_operations'=>array(
      'specialtokens' => array(
        'label'      => &$GLOBALS['TL_LANG']['MSC']['trashbouncer']['specialtokens'],
        'href'       => 'table=tl_trashbouncer_specialtokens',
        'class'      => 'tb-icon tb-specialtokens',
        'attributes' => 'onclick="Backend.getScrollOffset();"'
      ),
      'maintenance' => array(
        'label'      => &$GLOBALS['TL_LANG']['MSC']['trashbouncer']['maintenance'],
        'href'       => 'key=maintenance',
        'class'      => 'tb-icon tb-maintenance',
      ),
      'all' => array(
        'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
        'href'       => 'act=select',
        'class'      => 'header_edit_all',
        'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
      ),
    ),
    'operations' => array(
      'markAsSpam' => array(
        'label'           => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsSpam'],
        'href'            =>'key=markAsSpam',
        'icon'            =>'system/modules/trashbouncer/html/icons/actions/mail-mark-junk.png',
        'attributes'      => 'class="tb-icon-standalone tb-mark-as-spam" onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['MSC']['trashbouncer']['markAsSpamConfirm'].'\')) return false; Backend.getScrollOffset();"',
        'button_callback' => array('TrashBouncerAdminContao', 'getCategorizeButtons')
      ),
      'markAsHam' => array(
        'label'           => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsHam'],
        'href'            => 'key=markAsHam',
        'icon'            => 'system/modules/trashbouncer/html/icons/actions/mail-mark-not-junk.png',
        'attributes'      => 'class="tb-icon-standalone tb-mark-as-ham" onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['MSC']['trashbouncer']['markAsHamConfirm'].'\')) return false; Backend.getScrollOffset();"',
        'button_callback' => array('TrashBouncerAdminContao', 'getCategorizeButtons')
      ),
      'markAsUnknown' => array(
        'label'           => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['markAsUnknown'],
        'href'            => 'key=markAsUnknown',
        'icon'            => 'system/modules/trashbouncer/html/icons/actions/mail-mark-unsure-junk.png',
        'attributes'      => 'class="tb-icon-standalone tb-mark-as-unknown" onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['MSC']['trashbouncer']['markAsUnknownConfirm'].'\')) return false; Backend.getScrollOffset();"',
        'button_callback' => array('TrashBouncerAdminContao', 'getCategorizeButtons')
      ),
      'edit' => array(
        'label' => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['edit'],
        'href'  => 'key=edit',
        'icon'  => 'edit.gif',
      ),
      'delete' => array(
        'label'      => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['delete'],
        'href'       => 'act=delete',
        'icon'       => 'delete.gif',
        'attributes' => 'onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['MSC']['deleteConfirm'].'\')) return false; Backend.getScrollOffset();"'
      ),
      'show' => array(
        'label' => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['show'],
        'href'  => 'act=show',
        'icon'  => 'show.gif',
      ),
      /**
       * @todo Detailanzeige/Auswertung des Eintrags: 
       * - Kategorisierungs-/Löschmöglichkeit
       * - Übernahme von Stop/Ignoretokens
       * - Anzeige der Klassifizierungsergebnisse
       */
    )
  ),
        
  
  // Palettes 
  'palettes' => array(
    'default' => 'cat,lang'
  ),  
  
  // Fields 
  /**
   * @todo References zur Anzeige der Feldinhalte
   */
  'fields' => array(
    'info' => array(
      'label'   => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['info'],
      'filter'  => TRUE,
      'search'  => TRUE
    ),
    'text' => array(
      'label'   => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['text'],
      'search'  => TRUE
    ),
    'cat' => array(
      'label'   => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['cat'],
      'reference' => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['cat_reference'],
      'sorting' => TRUE,
      'filter'  => TRUE,
    ),
    'lang' => array(
      'label'   => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['lang'],
      'sorting' => TRUE,
      'filter'  => TRUE,
    ),
    'ip' => array(
      'label'   => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['ip'],
      'sorting' => TRUE,
      'filter'  => TRUE,
      'search'  => TRUE
    ),
    'tstamp' => array(
      'label'   => &$GLOBALS['TL_LANG']['tl_trashbouncer_log']['tstamp'],
      'filter'  => TRUE,
      'sorting' => TRUE,
      'flag'    => 6
    )
  )
);

/**
 * Class tl_trashbouncer_log
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2010
 * @author     Leo Feyer <http://www.contao.org>
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 */
class tl_trashbouncer_log {

  /**
   * Colorize the log entries depending on their category
   * @param array
   * @param string
   * @return string
   */
  
  public function colorize($row, $label) {
    require_once (TL_ROOT.'/plugins/TrashBouncer/TrashBouncer.php');
    switch ($row['cat']) {
      case TrashBouncer::UNKNOWN: 
        $label = preg_replace('@^(.*\] )(.*)$@s', '$1 <span class="tl_neutral">$2</span>',
          $label);
        break;
      
      case TrashBouncer::HAM: 
        $label = preg_replace('@^(.*\] )(.*)$@s', '$1 <span class="tl_green">$2</span>',
          $label);
        break;
      
      case TrashBouncer::SPAM: 
        $label = preg_replace('@^(.*\] )(.*)$@s', '$1 <span class="tl_red">$2</span>',
          $label);
        break;
    }
    
    return $label;
  } 
}


?>
