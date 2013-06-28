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
 * Class TrashBouncerMaintenanceReset
 *
 * Maintenance module "reset".
 * @copyright  Holger Teichert 2005-2013
 * @author     Holger Teichert <post@complanar.de>
 * @package    trashbouncer
 */
class TrashBouncerMaintenanceReset extends TrashBouncerMaintenanceHelper implements executable
{

	/**
	 * Return true if the module is active
	 * @return boolean
	 */
	public function isActive()
	{
		return ($this->Input->post('FORM_SUBMIT') == 'tl_trashbouncer_maintenance_reset');
	}


	/**
	 * Generate the module
	 * @return string
	 */
	public function run()
	{
	  parent::run();
    
		$arrCacheTables = array();
		$objTemplate = new BackendTemplate('be_trashbouncer_reset');
		$objTemplate->isActive = $this->isActive();

		// Confirmation message
		if ($_SESSION['CLEAR_CACHE_CONFIRM'] != '')
		{
			$objTemplate->cacheMessage = sprintf('<p class="tl_confirm">%s</p>' . "\n", $_SESSION['CLEAR_CACHE_CONFIRM']);
			$_SESSION['CLEAR_CACHE_CONFIRM'] = '';
		}

		// Add potential error messages
		if (is_array($_SESSION['TL_ERROR']) && !empty($_SESSION['TL_ERROR']))
		{
			foreach ($_SESSION['TL_ERROR'] as $message)
			{
				$objTemplate->cacheMessage .= sprintf('<p class="tl_error">%s</p>' . "\n", $message);
			}

			$_SESSION['TL_ERROR'] = array();
		}

		$objTemplate->action = ampersand($this->Environment->request);
		$objTemplate->selectAll = $GLOBALS['TL_LANG']['MSC']['selectAll'];
		$objTemplate->cacheHtml = $GLOBALS['TL_LANG']['tl_maintenance']['clearHtml'];
		$objTemplate->cacheScripts = $GLOBALS['TL_LANG']['tl_maintenance']['clearScripts'];
		$objTemplate->cacheTmp = $GLOBALS['TL_LANG']['tl_maintenance']['clearTemp'];
		$objTemplate->cacheXml = $GLOBALS['TL_LANG']['tl_maintenance']['clearXml'];
		$objTemplate->cacheCss = $GLOBALS['TL_LANG']['tl_maintenance']['clearCss'];
		$objTemplate->cacheHeadline = $GLOBALS['TL_LANG']['tl_maintenance']['clearCache'];
		$objTemplate->cacheLabel = $GLOBALS['TL_LANG']['tl_maintenance']['cacheTables'][0];
		$objTemplate->htmlEntries = sprintf($GLOBALS['TL_LANG']['MSC']['entries'], (count(scan(TL_ROOT . '/system/html')) - 2));
		$objTemplate->scriptEntries = sprintf($GLOBALS['TL_LANG']['MSC']['entries'], (count(scan(TL_ROOT . '/system/scripts')) - 1));
		$objTemplate->cacheEntries = sprintf($GLOBALS['TL_LANG']['MSC']['entries'], (count(scan(TL_ROOT . '/system/tmp')) - 1));
		$objTemplate->cacheHelp = ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_maintenance']['cacheTables'][1])) ? $GLOBALS['TL_LANG']['tl_maintenance']['cacheTables'][1] : '';
		$objTemplate->cacheSubmit = specialchars($GLOBALS['TL_LANG']['tl_maintenance']['clearCache']);
		$objTemplate->cacheTables = $arrCacheTables;

    $objTemplate->title = $GLOBALS['TL_LANG']['tl_trashbouncer_maintenance']['reset'][0];
		return $objTemplate->parse();
	}
}

?>