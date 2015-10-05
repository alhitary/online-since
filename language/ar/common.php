<?php
/**
*
* Online Since [Arabic]
*
* @copyright (c) 2005-2008-2015 3Di
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Translated By : Bassel Taha Alhitary - www.alhitary.net
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ONLINE_START'		=> 'منذ ',
	'ONLINE_SINCE'		=> ' لـ ',
	'ONLINE_TITLE'		=> 'تاريخ تأسيس المنتدى',
	'ONLINE_YEAR'	=> array(
		1	=> '<b>%d</b> سنة ',
		2	=> '<b>%d</b> سنوات ',
	),
	'ONLINE_MONTH'	=> array(
		1	=> '<b>%d</b> شهر ',
		2	=> '<b>%d</b> شهور ',
	),
	'ONLINE_DAY'	=> array(
		1   => '<b>%d</b> يوم',
		2   => '<b>%d</b> أيام',
	)
));
