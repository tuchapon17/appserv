<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Calendar Class
 *
 * This class enables the creation of calendars
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/calendar.html
 */
class MY_Calendar extends CI_Calendar {

	/**
	 * Generate the calendar
	 *
	 * @access	public
	 * @param	integer	the year
	 * @param	integer	the month
	 * @param	array	the data to be shown in the calendar cells
	 * @return	string
	 */
	function generate($year = '', $month = '', $data = array())
	{
		// Set and validate the supplied month/year
		if ($year == '')
			$year  = date("Y", $this->local_time);

		if ($month == '')
			$month = date("m", $this->local_time);

		if (strlen($year) == 1)
			$year = '200'.$year;

		if (strlen($year) == 2)
			$year = '20'.$year;

		if (strlen($month) == 1)
			$month = '0'.$month;

		$adjusted_date = $this->adjust_date($month, $year);

		$month	= $adjusted_date['month'];
		$year	= $adjusted_date['year'];

		// Determine the total days in the month
		$total_days = $this->get_total_days($month, $year);

		// Set the starting day of the week
		$start_days	= array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
		$start_day = ( ! isset($start_days[$this->start_day])) ? 0 : $start_days[$this->start_day];

		// Set the starting day number
		$local_date = mktime(12, 0, 0, $month, 1, $year);
		$date = getdate($local_date);
		$day  = $start_day + 1 - $date["wday"];

		while ($day > 1)
		{
			$day -= 7;
		}

		// Set the current month/year/day
		// We use this to determine the "today" date
		$cur_year	= date("Y", $this->local_time);
		$cur_month	= date("m", $this->local_time);
		$cur_day	= date("j", $this->local_time);

		$is_current_month = ($cur_year == $year AND $cur_month == $month) ? TRUE : FALSE;

		// Generate the template data array
		$this->parse_template();

		// Begin building the calendar output
		$out = $this->temp['table_open'];
		$out .= "\n";

		$out .= "\n";
		$out .= $this->temp['heading_row_start'];
		$out .= "\n";

		//reserve id , room id
		$param='';
		if(isset($_GET['resid']))$param.='&resid='.$_GET['resid'];
		if(isset($_GET['rmid']))$param.='&rmid='.$_GET['rmid'];
		// "previous" month link
		if ($this->show_next_prev == TRUE)
		{
			// Add a trailing slash to the  URL if needed
			//$this->next_prev_url = preg_replace("/(.+?)\/*$/", "\\1/",  $this->next_prev_url);

			$adjusted_date = $this->adjust_date($month - 1, $year);
			//$out .= str_replace('{previous_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->temp['heading_previous_cell']);
			
			$out .= str_replace('{previous_url}', $this->next_prev_url.'&year='.$adjusted_date['year'].'&month='.$adjusted_date['month'].$param, $this->temp['heading_previous_cell']);
			//else
			//$out .= str_replace('{previous_url}', $this->next_prev_url.'&year='.$adjusted_date['year'].'&month='.$adjusted_date['month'], $this->temp['heading_previous_cell']);
			$out .= "\n";
		}

		// Heading containing the month/year
		$colspan = ($this->show_next_prev == TRUE) ? 5 : 7;

		$this->temp['heading_title_cell'] = str_replace('{colspan}', $colspan, $this->temp['heading_title_cell']);
		$this->temp['heading_title_cell'] = str_replace('{heading}', $this->get_month_name($month)."&nbsp;".$year, $this->temp['heading_title_cell']);

		$out .= $this->temp['heading_title_cell'];
		$out .= "\n";

		// "next" month link
		if ($this->show_next_prev == TRUE)
		{
			$adjusted_date = $this->adjust_date($month + 1, $year);
			//$out .= str_replace('{next_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->temp['heading_next_cell']);
			//if(isset($_GET['resid']))
			$out .= str_replace('{next_url}', $this->next_prev_url.'&year='.$adjusted_date['year'].'&month='.$adjusted_date['month'].$param, $this->temp['heading_next_cell']);
			//else
			//$out .= str_replace('{next_url}', $this->next_prev_url.'&year='.$adjusted_date['year'].'&month='.$adjusted_date['month'], $this->temp['heading_next_cell']);
		}

		$out .= "\n";
		$out .= $this->temp['heading_row_end'];
		$out .= "\n";

		// Write the cells containing the days of the week
		$out .= "\n";
		$out .= $this->temp['week_row_start'];
		$out .= "\n";

		$day_names = $this->get_day_names();

		for ($i = 0; $i < 7; $i ++)
		{
			$out .= str_replace('{week_day}', $day_names[($start_day + $i) %7], $this->temp['week_day_cell']);
		}

		$out .= "\n";
		$out .= $this->temp['week_row_end'];
		$out .= "\n";

		// Build the main body of the calendar
		while ($day <= $total_days)
		{
			$out .= "\n";
			$out .= $this->temp['cal_row_start'];
			$out .= "\n";

			for ($i = 0; $i < 7; $i++)
			{
				$out .= ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_start_today'] : $this->temp['cal_cell_start'];

				if ($day > 0 AND $day <= $total_days)
				{
					if(strlen($day)==1)$day2="0".$day;
					else $day2=$day;
					$reserve_id=(isset($_GET['resid'])) ? $_GET['resid'] : null;
					$room_id=(isset($_GET['rmid'])) ? $_GET['rmid'] : null;
					if (isset($data[$day]))
					{
						// Cells with content
						//+ rmid get
						$day2="<a href='".base_url()."?c=calendar&m=bydate&cdate=".$year."-".$month."-".$day2."&resid=".$reserve_id."&rmid=".$room_id."'>".$day."</a>";
						$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_content_today'] : $this->temp['cal_cell_content'];
						$out .= str_replace('{day}', $day2, str_replace('{content}', $data[$day], $temp));
					}
					else
					{
						// Cells with no content
						//if(strlen($day)==1)$day2="0".$day;
						//else $day2=$day;
						//$day2="<a href='".base_url()."?c=calendar&m=bydate&cdate=".$year."-".$month."-".$day2."'>".$day."</a>";
						$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_no_content_today'] : $this->temp['cal_cell_no_content'];
						$out .= str_replace('{day}', $day, $temp);
					}
				}
				else
				{
					// Blank cells
					$out .= $this->temp['cal_cell_blank'];
				}

				$out .= ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_end_today'] : $this->temp['cal_cell_end'];					
				$day++;
			}

			$out .= "\n";
			$out .= $this->temp['cal_row_end'];
			$out .= "\n";
		}

		$out .= "\n";
		$out .= $this->temp['table_close'];

		return $out;
	}

	
	// --------------------------------------------------------------------
	
	/**
	 * Get Month Name
	 *
	 * Generates a textual month name based on the numeric
	 * month provided.
	 *
	 * @access	public
	 * @param	integer	the month
	 * @return	string
	 */
	function get_month_name($month)
	{
		if ($this->month_type == 'short')
		{
			$month_names = array('01' => 'cal_ม.ค.', '02' => 'cal_ก.พ.', '03' => 'cal_มี.ค.', '04' => 'cal_เม.ย.', '05' => 'cal_พ.ค.', '06' => 'cal_มิ.ย.', '07' => 'cal_ก.ค.', '08' => 'cal_ส.ค.', '09' => 'cal_ก.ย.', '10' => 'cal_ต.ค.', '11' => 'cal_พ.ย.', '12' => 'cal_ธ.ค.');
		}
		else
		{
			$month_names = array('01' => 'cal_มกราคม', '02' => 'cal_กุมภาพันธ์', '03' => 'cal_มีนาคม', '04' => 'cal_เมษายน', '05' => 'cal_พฤษภาคม', '06' => 'cal_มิถุนายน', '07' => 'cal_กรกฎาคม', '08' => 'cal_สิงหาคม', '09' => 'cal_กันยายน', '10' => 'cal_ตุลาคม', '11' => 'cal_พฤศจิกายน', '12' => 'cal_ธันวาคม');
		}
	
		$month = $month_names[$month];
	
		if ($this->CI->lang->line($month) === FALSE)
		{
			return ucfirst(str_replace('cal_', '', $month));
		}
	
		return $this->CI->lang->line($month);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get Day Names
	 *
	 * Returns an array of day names (Sunday, Monday, etc.) based
	 * on the type.  Options: long, short, abrev
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	function get_day_names($day_type = '')
	{
		if ($day_type != '')
			$this->day_type = $day_type;
	
		if ($this->day_type == 'long')
		{
			$day_names = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		}
		elseif ($this->day_type == 'short')
		{
			$day_names = array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์');
		}
		else
		{
			$day_names = array('อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส');
		}
	
		$days = array();
		foreach ($day_names as $val)
		{
			$days[] = ($this->CI->lang->line('cal_'.$val) === FALSE) ? ucfirst($val) : $this->CI->lang->line('cal_'.$val);
		}
	
		return $days;
	}
	
	// --------------------------------------------------------------------

}

// END CI_Calendar class

/* End of file Calendar.php */
/* Location: ./system/libraries/Calendar.php */