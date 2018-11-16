<?php
declare(strict_types=1);

namespace TYPO3\CMS\Cal\Backend\Form\RenderType;

class ElementHelper {

	public static function getGarbageIcon() { return '<span class="t3-icon fa t3-icon fa fa-trash"> </span>'; }

	public static function getNewIcon() { return '<span title="'.$GLOBALS['LANG']->getLL('tx_cal_event.add_recurrence').'" class="t3-icon fa t3-icon fa fa-plus-square"> </span>'; }

	public static function getEveryMonthText() { return $GLOBALS['LANG']->getLL('tx_cal_event.recurs_every_month'); }

	public static function getSelectedMonthText() { return $GLOBALS['LANG']->getLL('tx_cal_event.recurs_selected_months'); }

	public static function getWeekStartDay($pageID) {
		$tsConfig = \TYPO3\CMS\Backend\Utility\BackendUtility::getModTSconfig($pageID, 'options.tx_cal_controller.weekStartDay');
		$weekStartDay = strtolower($tsConfig ['value']);

		switch ($weekStartDay) {
			case 'sunday' :
				$startDay = 'su';
				break;
			/* If there's any value other than sunday, assume we want Monday */
			default :
				$startDay = 'mo';
				break;
		}

		return $startDay;
	}

	public static function getCountsArray() {
		self::init();

		return Array(
			'1'  => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_first'),
			'2'  => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_second'),
			'3'  => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_third'),
			'4'  => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_fourth'),
			'5'  => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_fifth'),
			'-3' => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_thirdtolast'),
			'-2' => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_secondtolast'),
			'-1' => $GLOBALS['LANG']->getLL('tx_cal_event.byday_count_last')
		);
	}

	public static function getWeekdaysArray($startDay) {
		self::init();

		$weekdays = Array();

		if ($startDay == 'su') {
			$weekdays ['su'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_sunday');
		}

		$weekdays ['mo'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_monday');
		$weekdays ['tu'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_tuesday');
		$weekdays ['we'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_wednesday');
		$weekdays ['th'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_thursday');
		$weekdays ['fr'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_friday');
		$weekdays ['sa'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_saturday');

		if ($startDay != 'su') {
			$weekdays ['su'] = $GLOBALS['LANG']->getLL('tx_cal_event.byday_sunday');
		}

		return $weekdays;
	}

	public static function getMonthsArray() {
		self::init();

		return Array(
			"1"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_january'),
			"2"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_february'),
			"3"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_march'),
			"4"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_april'),
			"5"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_may'),
			"6"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_june'),
			"7"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_july'),
			"8"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_august'),
			"9"  => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_september'),
			"10" => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_october'),
			"11" => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_november'),
			"12" => $GLOBALS['LANG']->getLL('tx_cal_event.bymonth_december')
		);
	}

	public static function removeNewlines($input) {
		return str_replace(["\r\n", "\n", "\r", "\t"], '', $input);
	}

	public static function init() {
		$GLOBALS['LANG']->includeLLFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('cal').'Resources/Private/Language/locallang_db.xml');

	}
}
