<?php
/**
*
* @copyright (c) 2015 Kirk http://reyno41.bplaced.net/phpbb
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace threedi\online_since\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\request\request */
	protected $request;

	/* @var \phpbb\user */
	protected $user;

	/* @var \phpbb\path_helper */
	protected $helper;


	/**
		* Constructor
		*
		* @param \phpbb\auth\auth			auth			Authentication object
		* @param \phpbb\config\config		$config			Config Object
		* @param \phpbb\template\template	$template		Template object
		* @param \phpbb\request\request		$request		Request object
		* @param \phpbb\user				$user			User Object
		* @param \phpbb\path_helper			$path_helper	Controller helper object
		* @access public
		*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user)
	{
			$this->auth = $auth;
			$this->config = $config;
			$this->template = $template;
			$this->user = $user;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'		=> 'load_language_on_setup',
			'core.page_footer'		=> 'display_online_since',
		);
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'threedi/online_since',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function display_online_since($event)
	{
		$year = date("Y", time());
		$days_of_month = array(   
			array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31
			),
			array(0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31
			)
		);

		$start_date = @gmdate('Y-m-d', $this->config['board_startdate'] + (3600 *  $this->config['board_timezone']));
		$today_date = @gmdate('Y-m-d', time() + (3600 *  $this->config['board_timezone']));

		list($year1, $month1, $day1) = split('-', $start_date);
		list($year2, $month2, $day2) = split('-', $today_date);
      
		$diff_year = $year2 - $year1;
		$diff_month = $month2 - $month1;
		$diff_day = $day2 - $day1;
   
		$is_leap = ((($year2)%4 == 0 && ($year2)%100 != 0 || ($year2)%400 == 0) ? 1 : 0);
      
		/* Do obvious corrections (days before months!)
		*
		* This is a loop in case the previous month is
		* February, and days < -28.
		*/

		$prev_month_days = $days_of_month[$is_leap][$month2 - 1];

		while ($diff_day < 0)
		{
			/* Borrow from the previous month */
			if ($prev_month_days == 0)
			{
				$prev_month_days = 31;
			}
			--$diff_month;
			$diff_day += $prev_month_days;
		}
   
		if ($diff_month < 0)
		{
			/* Borrow from the previous year */
			--$diff_year;
			$diff_month += 12;
		}

			// tertiary operators for single/multiples lang output
			$lang_year = ($diff_year == 1) ? $this->user->lang['ONLINE_YEAR'] : $this->user->lang['ONLINE_YEARS'];
			$lang_month = ($diff_month == 1) ? $this->user->lang['ONLINE_MONTH'] : $this->user->lang['ONLINE_MONTHS'];
			$lang_day = ($diff_day == 1) ? $this->user->lang['ONLINE_DAY'] : $this->user->lang['ONLINE_DAYS'];

			$online_for = "<b>$diff_year</b> $lang_year <b>$diff_month</b> $lang_month <b>$diff_day</b> $lang_day";
			$start_date = $this->user->format_date($this->config['board_startdate'], 'Y m d');

			$this->template->assign_vars(array(
			'L_ONLINE_SINCE'			=> $this->user->lang['ONLINE_SINCE'],
			'L_ONLINE_START'			=> $this->user->lang['ONLINE_START'],
			'L_BOARD_STARTS'			=> $start_date,
			'L_ONLINE_FOR'				=> $online_for,
		));
	}
}
