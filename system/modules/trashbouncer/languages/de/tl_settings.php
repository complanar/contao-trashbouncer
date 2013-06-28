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
 * Fields
 */
array_insert($GLOBALS['TL_LANG']['tl_settings'], count($GLOBALS['TL_LANG']['tl_settings']), array(
  'trashbouncer_legend' => 'TrashBouncer Spamfilter',
  'trashbouncer_enabled' => array('Spamfilter aktivieren', 'Hier können Sie den gesamten Spamfilter deaktivieren. Beachten Sie, dass in diesem Fall Ihre Formulare möglicherweise nicht mehr geschützt sind.'),
  'trashbouncer_prefs_pivotPoint' => array('Kritische Wahrscheinlichkeit', 'Geben Sie an, welche Spamwahrscheinlichkeit Texte erreichen müssen, damit sie als Spam eingestuft werden. Je niedriger Sie diesen Wert wählen, desto eher werden harmlose Texte blockiert, je höher dieser Wert ist, desto mehr unerwünschte Texte können den Filter passieren.'),
  'trashbouncer_prefs_logEnabled' => array('Protokoll aktivieren', 'Stellen Sie ein, ob überprüfte Texte protokolliert werden sollen. Protokollierte Texte können dann zum Training des Filters verwendet werden und somit die Treffsicherheit stark verbessern.'),
  'trashbouncer_prefs_autolearnEnabled' => array('Automatisches Lernen aktivieren', 'Wenn dieses Häkchen gesetzt ist, kann der Filter selbst bewertete Texte automatisch zum eigenen Lernen verwenden. Diese Option erleichtert das Training des Filters. Sie sollten in diesem Fall das Protokoll ebenfalls aktivieren, um fehlerhaft eingestufte Texte korrigieren zu können. Wenn sie mit der Treffsicherheit des Filters zufrieden sind, dann deaktivieren Sie diese Option, weil sie auf Dauer den Speicherbedarf der Datenbank stark anwachsen lässt.'),
  'trashbouncer_prefs_autolearnOnSpam' => array('Als unerwünscht erkannte Texte automatisch erlernen', 'Sie müssen in den beiden nächsten Feldern Grenzen angeben zwischen denen die Spamwahrscheinlichkeit liegen muss, damit der bewertete Text auch erlernt wird.'),
  'trashbouncer_prefs_autolearnOnHam' => array('Als harmlos erkannte Texte automatisch erlernen', 'Sie müssen in den beiden nächsten Feldern Grenzen angeben zwischen denen die Spamwahrscheinlichkeit liegen muss, damit der bewertete Text auch erlernt wird.'),
  'trashbouncer_prefs_autolearnOnStopwords' => array('Wegen Stopwortkriterium blockierte Texte automatisch erlernen', 'Wenn diese Option aktiviert ist, werden Texte, die wegen des Stopwortkriteriums als unerwünscht eingestuft wurden, Texte automatisch gelernt.'),
  'trashbouncer_prefs_autolearnMinSpamProbability' => array('Mindestwahrscheinlichkeit (Spam)', 'Vermutlich unerwünschte Texte mit einer Spamwahrscheinlichkeit höher als der angegebene Wert werden automatisch vom Filter gelernt.'),
  'trashbouncer_prefs_autolearnMaxSpamProbability' => array('Höchstwahrscheinlichkeit (Spam)', 'Vermutlich unerwünschte Texte mit einer Spamwahrscheinlichkeit niedriger als der angegebene Wert werden automatisch vom Filter gelernt. Sie sollten diesen Wert etwas niedriger als 1 wählen. Sollte die Spamwahrscheinlichkeit genau 1 oder sogar mehr betragen, liegt mit Sicherheit eine Fehleinschätzung vor, die nicht gelernt werden sollte.'),
  'trashbouncer_prefs_autolearnMinHamProbability' => array('Mindestwahrscheinlichkeit (Ham)', 'Vermutlich erwünschte Texte mit einer Spamwahrscheinlichkeit höher als der angegebene Wert werden automatisch vom Filter gelernt. Sie sollten diesen Wert etwas höher als 0 wählen. Sollte die Spamwahrscheinlichkeit genau 0 oder sogar weniger betragen, liegt mit Sicherheit eine Fehleinschätzung vor, die nicht gelernt werden sollte.'),
  'trashbouncer_prefs_autolearnMaxHamProbability' => array('Höchstwahrscheinlichkeit (Ham)', 'Vermutlich erwünschte Texte mit einer Spamwahrscheinlichkeit niedriger als der angegebene Wert werden automatisch vom Filter gelernt.'),
  'trashbouncer_prefs_stopwordsEnabled' => array('Stopwortkriterium aktivieren', 'Aktivieren Sie hier die Suche nach unerwünschten Wörtern.'),
  'trashbouncer_prefs_stopwordsMax' => array('Maximal erlaubte Anzahl von Stopwörtern', 'Geben Sie hier die Anzahl der maximal erlaubten unerwünschten Wörter in einem Text an.'),
  'trashbouncer_prefs_ignorewordsEnabled' => array('Wörter Ignorieren aktivieren.', 'Hier können Sie das Ignorieren bestimmter Wörter aktivieren.'),
  'trashbouncer_config_advanced' => array('Erweiterte Einstellungen anzeigen', 'Achtung! Diese Einstellung ändern auf essentielle Weise den Bewertungsalgorithmus des Spamfilters. Bitte ändern Sie die folgenden Einstellungen nur dann, wenn Sie genau wissen was, Sie tun. Lesen Sie gegebenfalls zuvor den Quelltext des Filters um sich über die Funktionsweise des Filters zu informieren.'),
  'trashbouncer_config_lexer' => array('Lexer', 'Der Lexer spaltet den Text in einzelne Wortfragmente auf, die dann jeweils für sich nach Spamwahrscheinlichkeit bewertet werden und in der Summe die Gesamtwahrscheinlichkeit des Textes bilden.'),
  'trashbouncer_config_degenerator' => array('Degenerator', 'Der Degenerator versucht alternative/verwandte Formen von nicht bekannten Wörtern in der Datenbank zu finden.'),
  'trashbouncer_config_useRelevant' => array('Anzahl relevanter Fragmente', 'Je mehr Fragmente zur Bewertung verwendet werden, desto größer ist die Genauigkeit des Ergebnisses. Aber: Ist die Anzahl der verwendeten Fragmente zu groß, kann es zu Rundungsfehlern auf Grund des diskreten Computer-Zahlenraumes kommen, da die Einzelwahrscheinlichkeiten dann sehr nahe bei Null liegen und möglicherweise genau auf Null gerundet werden, was das Ergebnis sehr durcheinander bringt.'),
  'trashbouncer_config_minRelevance' => array('Minimale Relevanz', 'Geben Sie hier die minimale Relevanz an, die ein in der Datenbank gefundenes Wort besitzen muss, damit es zur Berechnung überhaupt herangezogen wird. Wörter mit niedrigerer Relevanz werden einfach übersprungen. Es sind Werte zwischen 0 und 0.5 erlaubt.'),
  'trashbouncer_config_robS' => array('S-Konstante', 'Mr. Gary Robinsons S-Konstante. Dieser Wert ist im Prinzip die Wahrscheinlichkeit, dass die vorangenommene Wahrscheinlichkeit für unbegannte Tokens in etwa korrekt ist. Es sind Werte zwischen 0 und 0.5 möglich.'),
  'trashbouncer_config_probUnknown' => array('Wahrscheinlichkeit für unbekannte Wörter', 'Geben Sie an, welche Wahrscheinlichkeit unbekannte Wörter zugewiesen bekommen sollen. Sollten Sie feststellen, dass in Ihrer Datenbank der Durschschnitt der Spamwahrscheinlichkeiten bei 0.65 liegt, so ist dieser Wert eine gute Zahl. Für den Anfang sollte 0.5 als neutraler Ausgangspunkt eine gute Wahl sein.'),
));

?>