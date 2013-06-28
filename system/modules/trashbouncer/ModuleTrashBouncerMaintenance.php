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
 * Class ModuleTrashBouncerMaintenance
 * Handle TrashBouncer training data
 *  
 * @package trashbouncer
 */

class ModuleTrashBouncerMaintenance extends BackendModule {
  /**
   * Template
   * @var string
   */
  protected $strTemplate = 'be_trashbouncer_maintenance';
  
  /**
   * 
   */
  public function __construct()
  {
    parent::__construct();
    $this->do = $this->Environment->script.'?do=trashbouncer';
  }
  
  /**
   * Compile the module
   * @access public
   * @return void
   */
  public function compile()
  {
    $this->loadLanguageFile('default');
    $this->loadLanguageFile('tl_trashbouncer_maintenance');
    
    $this->Template->content = '';
    $this->Template->href = $this->getReferer(true);
    
    $this->Template->specialtokensText = $GLOBALS['TL_LANG']['MSC']['trashbouncer']['specialtokens'][0];
    $this->Template->specialtokensTitle = $GLOBALS['TL_LANG']['MSC']['trashbouncer']['specialtokens'][1];
    $this->Template->specialtokensHref = ampersand($this->do.'&table=tl_trashbouncer_specialtokens');
    
    $this->Template->logText = $GLOBALS['TL_LANG']['MSC']['trashbouncer']['log'][0];
    $this->Template->logTitle = $GLOBALS['TL_LANG']['MSC']['trashbouncer']['log'][1];
    $this->Template->logHref = ampersand($this->do);
    
    $maintenance = array('export', /*'import', 'reset',*/ 'delete');
    foreach ($maintenance as $cmd)
    {
      $callback = 'TrashBouncerMaintenance'.ucfirst($cmd);
      $this->import($callback);

      if (!$this->$callback instanceof executable)
      {
        throw new Exception("$callback is not an executable class");
      }

      $buffer = $this->$callback->run($this->tb);

      if ($this->$callback->isActive())
      {
        $this->Template->content = $buffer;
        break;
      }
      else
      {
        $this->Template->content .= $buffer;
      }
    }
  }
}