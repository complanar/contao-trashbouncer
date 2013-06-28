<?php 
if (!defined('TL_ROOT'))
  die('You can not access this file directly!');
  
/**
 * TrashBouncer Spamfilter
 * Copyright (C) 2011 Holger Teichert
 *
 * Extension for:
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
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
 * @copyright  Holger Teichert 2011
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 * @license    GNU/LGPL
 */
 
/**
 * Class TrashBouncerContao
 *
 * @copyright  Holger Teichert 2011
 * @author     Holger Teichert <post@complanar.de>
 * @package    Controller
 */
class TrashBouncerContao extends Controller {
  
  public function __construct() {
    parent::__construct();
    require_once(TB_PATH.'/TrashBouncer.php');
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
    $this->tb = new TrashBouncer($config, $prefs, $db);
  }
  
  public function isThisSpam($strRegexp, $varValue, Widget $objWidget) {
    if ($strRegexp == 'spamfilter' && $GLOBALS['TL_CONFIG']['trashbouncer_enabled'] === true) {
      $classification = $this->tb->check($varValue, $GLOBALS['TL_LANGUAGE'], $objWidget->Environment->__get('request'));
      if ($classification['result']['isSpam']) {
        $errormsg = sprintf(
          $GLOBALS['TL_LANG']['MSC']['trashbouncer']['spamDetected'], 
          $objWidget->label,
          $classification['result']['probability'] * 100
        );
        $objWidget->addError($errormsg);
        return TRUE;
      }
      return TRUE;
    }
    return FALSE;
  } 
}

?>
