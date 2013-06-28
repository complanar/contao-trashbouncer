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
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_trashbouncer_maintenance'] = array(
  'availableLanguages'  => array('Verfügbare Sprachen', 'Bitte wählen Sie aus den vorhandenen Sprachen aus!'),
  'export'      => array('Trainingsdaten exportieren', 'Exportieren Sie Trainingsdaten in eine Datei oder als Download.'),
  'import'      => array('Trainingsdaten importieren', 'Bitte laden Sie eine Datei mit Trainingsdaten hoch oder wählen Sie aus den auf dem Server bereitgestellten Dateien aus.'),
  'reset'       => array('Trainierte Sprache zurücksetzen', 'Trainingsdaten für die gewählten Sprachen zurücksetzen (Stop- und ignorierte Wörter sowie Protokolleinträge bleiben erhalten). Sie können dabei eine Datensicherung anlegen lassen.'),
  'delete'      => array('Trainierte Sprache löschen', 'Es werden alle gespeicherten Daten (Training, Stop/ignorierte Wörter, Protokoll) gelöscht. Sie können dabei eine Datensicherung anlegen lassen.'),
  'fileinfo'            => 'Dateiinformationen',
  'chooseImportOptions' => 'Bitte wählen Sie die gewünschten Importoptionen aus.',
  'importOptions'       => array('overwrite' => 'Überschreiben', 'add' => 'Hinzufügen'),
  'importSuccessful'    => array('Import erfolgreich.', 'Es wurden %s Einträge hinzugefügt, %s aktualisiert und %s nicht geändert.'),
  'importError'         => array('Import fehlgeschlagen', 'Dateiformat ist nicht lesbar'),
  'exportSuccessful'    => array('Export erfolgreich.', 'Die gewünschten Trainingsdaten wurden erfolgreich exportiert.'),
  'exportError'         => array('Export fehlgeschlagen', 'Bitte überprüfen Sie die Dateiberechtigungen.'),
  'resetSuccessful'     => array('Zurücksetzen erfolgreich.', 'Die gewählten Sprachen wurden zurückgesetzt.'),
  'resetError'          => array('Zurücksetzen fehlgeschlagen', 'Die gewählten Sprachen konnten nicht ordnungsgemäß zurückgesetzt werden.'),
  'deleteSuccessful'     => array('Bereinigen erfolgreich.', 'Die gewählten Sprachen wurden gelöscht.'),
  'deleteError'          => array('Löschen fehlgeschlagen', 'Die gewählten Sprachen konnten nicht gelöscht werden.'),
);

?>