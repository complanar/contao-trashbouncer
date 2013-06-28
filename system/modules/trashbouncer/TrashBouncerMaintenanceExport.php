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
 * Class TrashBouncerMaintenanceExport
 *
 * Maintenance module "export".
 * @copyright  Holger Teichert 2005-2013
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 */
class TrashBouncerMaintenanceExport extends TrashBouncerMaintenanceHelper implements executable
{

	/**
	 * Return true if the module is active
	 * @return boolean
	 */
	public function isActive()
	{
		return (
		  $this->Input->post('FORM_SUBMIT') == 'tl_trashbouncer_maintenance_export'
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
		$objTemplate = new BackendTemplate('be_trashbouncer_export');
		$objTemplate->isActive = $this->isActive();

    $success = false;
    if ($this->isActive()) {
      $arrInputLangs = $this->Input->post('languages_export');
      if (is_array($arrInputLangs) && !empty($arrInputLangs)) {
        if ($this->Input->post('exportType') == 'file') {
          $strFile = $GLOBALS['TL_CONFIG']['uploadPath'].'/trashbouncer_export_'.date('Y-m-d_H-i-s').'.tb';
        } else {
          $strFile = 'system/tmp/trashbouncer_export_'.date('Y-m-d_H-i-s').'.tb';
        }
        $success = $this->tb->exportTraining(TL_ROOT.'/'.$strFile, 'Contao TrashBouncer Module Export', TRUE, $arrInputLangs);
        if ($this->Input->post('exportType') == 'download') {
          $GLOBALS['TL_CONFIG']['allowedDownload'] .= ',tb';
          $this->sendFileToBrowser($strFile);
          $GLOBALS['TL_CONFIG']['allowedDownload'] = substr($GLOBALS['TL_CONFIG']['allowedDownload'], 0, -3);
          $f = new File($strFile);
          $f->delete();
          exit;
        } else {
          if($success) {
            $objTemplate->success = true;
            $objTemplate->msg = sprintf('<p class="tl_confirm">%s %s</p>', $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['exportSuccessful'][0], sprintf($GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['exportSuccessful'][1], $strFile));
          } else {
            $objTemplate->msg = sprintf('<p class="tl_error">%s</p>', implode(' ', $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['exportError']));
          } 
        }
      }
    }
    
		$objTemplate->action = ampersand($this->Environment->request);
    $objTemplate->title = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['export'][0];
		$objTemplate->export = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['export'][1];
		$objTemplate->languages = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['availableLanguages'];
    $objTemplate->submit = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['doExport'];
    $objTemplate->back = $GLOBALS['TL_LANG']['MSC']['backBT'];
    
		$arrLangs = $this->getAllLanguages();
    $arrLangDetails = $this->getLanguageDetails($arrLangs);
    
    $objTemplate->langWidget = $this->getLanguageWidget($arrLangDetails, 'export', $this->Input->post('languages_export'));
    $objTemplate->exportTypeWidget = $this->getExportTypeWidget($this->Input->post('exportType'));
    
		return $objTemplate->parse();
	}
   
  /**
   * Send a file to the browser so the "save as" dialogue opens
   * @param string
   */
  protected function sendFileToBrowser($strFile)
  {
    // Make sure there are no attempts to hack the file system
    if (preg_match('@^\.+@i', $strFile) || preg_match('@\.+/@i', $strFile) || preg_match('@(://)+@i', $strFile))
    {
      header('HTTP/1.1 404 Not Found');
      die('Invalid file name');
    }

    // Check whether the file exists
    if (!file_exists(TL_ROOT . '/' . $strFile))
    {
      header('HTTP/1.1 404 Not Found');
      die('File not found');
    }

    $objFile = new File($strFile);
    $arrAllowedTypes = trimsplit(',', strtolower($GLOBALS['TL_CONFIG']['allowedDownload']));

    if (!in_array($objFile->extension, $arrAllowedTypes))
    {
      header('HTTP/1.1 403 Forbidden');
      die(sprintf('File type "%s" is not allowed', $objFile->extension));
    }

    // Make sure no output buffer is active
    // @see http://ch2.php.net/manual/en/function.fpassthru.php#74080
    while (@ob_end_clean());

    // Prevent session locking (see #2804)
    session_write_close();

    // Open the "save as …" dialogue
    header('Content-Type: ' . $objFile->mime);
    header('Content-Transfer-Encoding: binary');
    header('Content-Disposition: attachment; filename="' . $objFile->basename . '"');
    header('Content-Length: ' . $objFile->filesize);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Expires: 0');
    header('Connection: close');

    $resFile = fopen(TL_ROOT . '/' . $strFile, 'rb');
    fpassthru($resFile);
    fclose($resFile);
  }

  /**
   * Return the language widget as object
   * @param mixed
   * @return Widget
   */
  public function getExportTypeWidget ($value) {
    $widget = new SelectMenu();
    
    $widget->id = 'exportType';
    $widget->name = 'exportType';
    $widget->label = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['chooseExportOptions'][0];
    
    if ($GLOBALS['TL_CONFIG']['showHelp'] && $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['chooseExportOptions'][1] != '')
    {
      $widget->help = sprintf($GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['chooseExportOptions'][1], $GLOBALS['TL_CONFIG']['uploadPath']);
    }
    
    $options = array();
    foreach (array('file', 'download') as $type) {
      $options[$type] = array('value'=>$type, 'label'=>$GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['exportOptions'][$type], 'selected'=>($value==$type)? true : false);
    }
    $widget->options = $options;
    
    // Valiate input
    if ($this->Input->post('FORM_SUBMIT') == 'tl_trashbouncer_maintenance_export' && $this->Input->post('goBack') == '')
    {
      $widget->validate();
    }
    
    return $widget;
  }
}

?>