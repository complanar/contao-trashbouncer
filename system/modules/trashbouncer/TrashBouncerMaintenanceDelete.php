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


/**
 * Class TrashBouncerMaintenanceDelete
 *
 * Maintenance module "delete".
 * @copyright  Holger Teichert 2005-2013
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 */
class TrashBouncerMaintenanceDelete extends TrashBouncerMaintenanceHelper implements executable
{

		/**
   * Return true if the module is active
   * @return boolean
   */
  public function isActive()
  {
    return (
      $this->Input->post('FORM_SUBMIT') == 'tl_trashbouncer_maintenance_delete'
      && $this->Input->post('goBack') == ''
    );
  }


	/**
	 * Generate the module
	 * @return string
	 */
	public function run()
	{
	  parent::run();
    
		$arrCacheTables = array();
		$objTemplate = new BackendTemplate('be_trashbouncer_delete');
		$objTemplate->isActive = $this->isActive();
    
    $objTemplate->action = ampersand($this->Environment->request);
    $objTemplate->title = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['delete'][0];
    $objTemplate->delete = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['delete'][1];
    $objTemplate->languages = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['availableLanguages'];
    $objTemplate->submit = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['doDelete'];
    $objTemplate->back = $GLOBALS['TL_LANG']['MSC']['backBT'];
    $objTemplate->cancel = $GLOBALS['TL_LANG']['MSC']['cancelBT'];
    
    $arrLangs = $this->getAllLanguages();
    $arrLangDetails = $this->getLanguageDetails($arrLangs);
    
    $objTemplate->langWidget = $this->getLanguageWidget($arrLangDetails, 'delete', $this->Input->post('languages_delete'));
    $objTemplate->backupWidget = $this->getBackupWidget('delete', $this->Input->post('backup_delete'));
    
    if ($this->isActive() && !$objTemplate->langWidget->hasErrors()) {
      if (!$this->Input->post('FORM_CONFIRM') == '1') {
        $objTemplate->submitConfirm = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['deleteConfirm'][0];
        $objTemplate->confirm = sprintf('<p class="tl_confirm">%s</p>' . "\n", $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['deleteConfirm'][1]);
        if (is_array($this->Input->post('languages_delete'))) {
          $objTemplate->languages_delete = implode(',',deserialize($this->Input->post('languages_delete')));
        } else {
          $objTemplate->languages_delete = '';
        }
        $objTemplate->backup_delete = $this->Input->post('backup_delete');
      } else {
        $arrInputLangs = explode(',', $this->Input->post('languages_delete'));
        if (is_array($arrInputLangs) && !empty($arrInputLangs)) {
          $blnBackup = ($this->Input->post('backup_delete') != '');
          $strFile = $strFile = TL_ROOT.'/tl_files/trashbouncer_backup_'.date('Y-m-d_H-i-s').'.tb';
          if($this->tb->deleteLang($arrInputLangs, $blnBackup, $strFile)) {
            $objTemplate->success = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['deleteSuccessful'];
          } else {
            $objTemplate->error = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['deleteError'];
          }
        }
      }
    }
    
    return $objTemplate->parse();
	}
}

?>