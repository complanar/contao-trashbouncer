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
  'trashbouncer_enabled' => array('Activate spamfilter', 'Here you can disable the whole spamfilter. Please note that your forms may be not longer protected.'),
  'trashbouncer_prefs_pivotPoint' => array('Critical probability', 'Please enter wich spam probability text must reach to be recocnized as spam. The lower you chose this value the more harmless texts may be blocked. The larger this value is the more unwanted texts can pass the filter accidently.'),
  'trashbouncer_prefs_logEnabled' => array('Activate log', 'Decide, wether checked texts shall be logged. Logged text can be used for training the filter and therefore can enforce the reliability of it\'s decicions.'),
  'trashbouncer_prefs_autolearnEnabled' => array('Activate autolearning', 'If this option is checked, the filter can use classified text for automatic training. This option makes training of the filter easier. Activating logging, too, is stronly recommended to correct falsely learned texts. If you are satisfied with the reliability of the filter, you should deactivate this option as it can make the database grow enormously.'),
  'trashbouncer_prefs_autolearnOnSpam' => array('Automatically learn unwanted texts', 'You must enter borders in the next two fields. The spam probability must be in between of these two values to let the classified text be learned.'),
  'trashbouncer_prefs_autolearnOnHam' => array('Automatically learn harmless texts', 'Yout must enter borders in the next two fiels. The spam probability must be in bewtween of these two values to let the classified text be learned.'),
  'trashbouncer_prefs_autolearnOnStopwords' => array('Automatically learn texts blocked because of to much stopwords', 'If this option is active, texts that were blocked because of too much stopwords are learned automatically.'),
  'trashbouncer_prefs_autolearnMinSpamProbability' => array('Minimum probability (Spam)', 'Probably unwanted texts with a spam probability larger than this value are learned automatically.'),
  'trashbouncer_prefs_autolearnMaxSpamProbability' => array('Maximum probability (Spam)', 'Probably unwanted texts with a spam probability lower than this value are learned automatically. You should choose this value a little lower than 1. If the spam probability is exactly 1 or even more there almost surely happened an error. Such texts should not be learned.'),
  'trashbouncer_prefs_autolearnMinHamProbability' => array('Minimum probability (Ham)', 'Probably harmless texts with a spam probability larger than this value are learned automatically. You should choose this value a little larger than 0. If the spam probability is exactly 0 or even less there almost surely happened an error. Such texts should not be learned.'),
  'trashbouncer_prefs_autolearnMaxHamProbability' => array('Maximum probability (Ham)', 'Probably harmless texts with a spam probability larger than this value are learned automatically'),
  'trashbouncer_prefs_stopwordsEnabled' => array('Activate stopwords', 'Activate counting of unwanted words.'),
  'trashbouncer_prefs_stopwordsMax' => array('Maximum allowed stopwords', 'Please enter the maximum count of unwanted stopwords that are tolerated.'),
  'trashbouncer_prefs_ignorewordsEnabled' => array('Activate ignored words', 'You can activate the ignoring of certain words.'),
  'trashbouncer_config_advanced' => array('Show advanced configuration', 'Warning! These settings change the calculating of spam probabilities essentially. Please change this settings only if you know what you are doing. It may be wise to study the source code of the filter to learn how the filter does it\'s calculations.'),
  'trashbouncer_config_lexer' => array('Lexer', 'The lexer splits the text in single fragments, that are classified each singulary. The combination of all token probability leads to the final calculation.'),
  'trashbouncer_config_degenerator' => array('Degenerator', 'The degenerator tries to find alternative versions of unkown tokens in the database.'),
  'trashbouncer_config_useRelevant' => array('Relevant tokens', 'The more tokens are used for calculation the more exact is the final probability. But: If you choose this number to large there can be rounding errors because of the discrete numbers computers use, because the single probabilities are near zero and could be accidently rounded to zero wich confuses the solution.'),
  'trashbouncer_config_minRelevance' => array('Minimum Relevance', 'Please enter the minumum relevance that a token found in the database must reach to be used for calculation. Tokens with lesser relevances are silently ignored. Values between 0 and 0.5 are accepted.'),
  'trashbouncer_config_robS' => array('S-constant', 'Mr. Gary Robinson\'s s-constant. This is essentially the probability that the guessed probability for unkown tokens (next value) ist correct. Values between 0 and 0.5 are accepted.'),
  'trashbouncer_config_probUnknown' => array('Probability for unkown tokens', 'Please enter a value completely unkown tokens get assigned. If you find out that the average spam probability for all tokens is 0.65 this is a good choice. In the beginning 0.5 as a neutral value should be a good choice.'),
));

?>