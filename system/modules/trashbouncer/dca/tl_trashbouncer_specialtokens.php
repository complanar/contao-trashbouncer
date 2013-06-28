<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
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
 * Table tl_trashbouncer_specialtokens 
 */
$GLOBALS['TL_DCA']['tl_trashbouncer_specialtokens'] = array
(

	// Config
	'config' => array (
		'dataContainer'    => 'Table',
		'enableVersioning' => true
	),

	// List
	'list' => array(
		'sorting' => array(
			'mode'        => 2,
			'fields'      => array('token', 'lang'),
			'flag'        => 1,
      'panelLayout' => 'filter;sort,search,limit'
		),
		'label' => array(
			'fields' => array('token', 'lang'),
			'format' => '%s [%s]',
      'maxCharacters'  => 96,
      'label_callback' => array('tl_trashbouncer_specialtokens', 'colorize')
		),
		'global_operations' => array(
      'linktolog' => array(
        'label'      => &$GLOBALS['TL_LANG']['MSC']['trashbouncer']['log'],
        'href'       => 'key=linktolog',
        'class'      => 'tb-icon tb-log',
      ),
      'linktomaintenance' => array(
        'label'      => &$GLOBALS['TL_LANG']['MSC']['trashbouncer']['maintenance'],
        'href'       => 'key=linktomaintenance',
        'class'      => 'tb-icon tb-maintenance',
      ),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'token,lang,type'
	),

	// Fields
  /**
   * @todo References zur Anzeige der Feldinhalte (type)
   */
	'fields' => array(
		'token' => array(
			'label'     => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['token'],
			'inputType' => 'text',
      'exclude'   => FALSE,
			'eval'      => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
      'flag'      => 1,
      'sorting'   => TRUE,
      'search'    => TRUE
		),
    'lang' => array(
      'label'     => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['lang'],
      'inputType' => 'text',
      'exclude'   => FALSE,
      'eval'      => array('mandatory' => TRUE, 'maxlength' => 3, 'tl_class' => 'w50'),
      'flag'      => 11,
      'sorting'   => TRUE,
      'filter'    => TRUE,
      'search'    => TRUE,
    ),
    'type' => array(
      'label'     => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['type'],
      'inputType' => 'select',
      'exclude'   => FALSE,
      'eval'      => array('mandatory' => TRUE, 'maxlength' => 1, 'tl_class' => 'w50'),
      'flag'      => 11,
      'sorting'   => TRUE,
      'filter'    => TRUE,
      'options'   => array(
                        '1' => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['ignoreword'],
                        '0' => &$GLOBALS['TL_LANG']['tl_trashbouncer_specialtokens']['stopword']
                      )
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
class tl_trashbouncer_specialtokens {

  /**
   * Colorize the specialtokens depending on their type
   * @param array
   * @param string
   * @return string
   */
  
  public function colorize($row, $label) {
    require_once (TL_ROOT.'/plugins/TrashBouncer/TrashBouncer.php');
    switch ($row['type']) {
      case TrashBouncer::STOPWORD: 
        $label = preg_replace('@^(.*)(\ \[.*\])$@s', '<span class="tl_red tb-icon tb-stopword">$1</span> $2',
          $label);
        break;
      case TrashBouncer::IGNOREWORD: 
        $label = preg_replace('@^(.*)(\ \[.*\])$@s', '<span class="tl_green tb-icon tb-ignoreword">$1</span> $2',
          $label);
        break;
    }
    
    return $label;
  } 
}

?>
