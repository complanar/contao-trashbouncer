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
$GLOBALS['TL_LANG']['MSC']['trashbouncer'] = array(
  'specialtokens'         => array('Stopwörter/Ignorierte Wörter', 'Stopwörter und ignorierte Wörter verwalten.'),
  'maintenance'           => array('Wartung', 'Trainigsdaten verwalten.'),
  'log'                   => array('Protokoll', 'Protokoll des Spamfilters verwalten.'),
  'markAsSpamConfirm'     => 'Soll der Eintrag ID %s wirklich als Spam kategorisiert werden?',
  'markAsHamConfirm'      => 'Soll der Eintrag ID %s wirklich als Ham kategorisiert werden?',
  'markAsUnknownConfirm'  => 'Soll der Eintrag ID %s wirklich als neutral kategorisiert werden?',
  'spamDetected'          => 'Der von Ihnen in das Feld „%s“ eingegebene Text wurde mit einer Wahrscheinlichkeit von %.2f%% als Spam eingestuft. Bitte ändern Sie Ihre Eingaben und versuchen Sie es noch einmal.',
  'spam'                  => 'Spam',
  'ham'                   => 'Ham',
  '-1'                    => 'Spam',
  '0'                     => 'Neutral',
  '1'                     => 'Ham',
);

?>