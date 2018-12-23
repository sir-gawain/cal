<?php
namespace TYPO3\CMS\Cal\Model;
/**
 * This file is part of the TYPO3 extension Calendar Base (cal).
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 extension Calendar Base (cal) project - inspiring people to share!
 */

use TYPO3\CMS\Cal\Model\Pear\Date\Calc;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Base model for the calendar.
 * Provides basic model functionality that other
 * models can use or override by extending the class.
 *
 * @author Jeff Segars <jeff@webempoweredchurch.org>
 * @package TYPO3
 * @subpackage cal
 */
class Model extends \TYPO3\CMS\Cal\Model\BaseModel {
	var $isClone = false;
	var $tstamp;
	var $sequence = 1;
	var $title;
	var $organizer;
	var $location;
	var $content;
	var $start;
	var $end;
	var $allday = 0;
	var $timezone;
	var $calnumber = 1;
	var $calname;
	var $calendarUid;
	var $url;
	var $alarmdescription;
	var $summary;
	var $description;
	var $overlap = 1;
	var $_class;
	var $until;
	var $freq = '';
	var $reccuring_end;
	var $cnt;
	var $bysecond = Array ();
	var $byminute = Array ();
	var $byhour = Array ();
	var $byday = Array ();
	var $byweekno = Array ();
	var $bymonth = Array ();
	var $byyearday = Array ();
	var $bymonthday = Array ();
	var $byweekday = Array ();
	var $bysetpos = 0;
	var $wkst = '';
	var $rdateType = '';
	var $rdate = '';
	var $rdateValues = Array ();
	var $displayend;
	var $spansday;
	var $categories = Array ();
	var $categoriesAsString;
	var $categoryUidsAsArray;
	var $location_id = 0;
	var $organizer_id = 0;
	var $locationLink;
	var $organizerLink;
	var $locationPage;
	var $organizerPage;
	var $organizerObject;
	var $locationObject;
	var $exception_single_ids = Array ();
	var $notifyUserIds = Array ();
	var $exceptionGroupIds = Array ();
	var $notifyGroupIds = Array ();
	var $creatorUserIds = Array ();
	var $creatorGroupIds = Array ();
	var $exceptionEvents = Array ();
	var $editable = false;
	var $headerstyle = 'default_catheader'; // '#557CA3';//'#0000ff';
	var $bodystyle = 'default_catbody'; // ''#6699CC';//'#ccffcc';
	var $crdate = 0;
	var $deviationDates;

	/* new */
	var $event_type;
	var $page;
	var $ext_url;
	/* new */
	var $externalPlugin = 0;
	var $eventOwner;
	var $attendees = Array ();
	var $status = 0;
	var $priority = 0;
	var $completetd = 0;
	const EVENT_TYPE_DEFAULT = 0;
	const EVENT_TYPE_SHORTCUT = 1;
	const EVENT_TYPE_EXTERNAL = 2;
	const EVENT_TYPE_MEETING = 3;
	const EVENT_TYPE_TODO = 4;

	/**
	 * Constructor.
	 *
	 * @param $serviceKey string    serviceKey for this model
	 */
	public function __construct($serviceKey) {
		$this->setObjectType ('event');
		parent::__construct ($serviceKey);
	}

	/**
	 * Returns the timestamp value.
	 *
	 * @return int
	 */
	function getTstamp() {
		return $this->tstamp;
	}

	/**
	 * Sets the timestamp value.
	 *
	 * @param int $timestamp
	 */
	function setTstamp($timestamp) {
		$this->tstamp = $timestamp;
	}

	/**
	 * Returns the sequence value.
	 *
	 * @return int
	 */
	function getSequence() {
		return $this->sequence;
	}

	/**
	 * Sets the sequence value.
	 *
	 * @param $sequence int
	 */
	function setSequence($sequence) {
		$this->sequence = $sequence;
	}

	/**
	 * Sets the event organizer.
	 *
	 * @param string $organizer     organizer of the event.
	 */
	function setOrganizer($organizer) {
		$this->organizer = $organizer;
	}

	/**
	 * Returns the event organizer.
	 *
	 * @return string
	 */
	function getOrganizer() {
		return $this->organizer;
	}

	/**
	 * Sets the event title.
	 *
	 * @param string $title     title of the event.
	 */
	function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the event title.
	 *
	 * @return string
	 */
	function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the event creation time.
	 *
	 * @param int $timestamp    the event creation time
	 */
	function setCreationDate($timestamp) {
		$this->crdate = $timestamp;
	}

	/**
	 * Returns timestamp of the event creation.
	 *
	 * @return int
	 */
	function getCreationDate() {
		return $this->crdate;
	}

	/**
	 * Returns the rendered event.
	 *
	 * @return string
	 */
	function renderEvent() {
		$cObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry ('basic', 'cobj');
		$d = nl2br ($cObj->parseFunc ($this->getDescription (), $this->conf ['parseFunc.']));
		$eventStart = $this->getStart ();
		$eventEnd = $this->getEnd ();
		return '<h3>' . $this->getTitle () . '</h3><font color="#000000"><ul>' .
			'<li>Start: ' . $eventStart->format ('%H:%M') . '</li>' .
			'<li>End: ' . $eventEnd->format ('%H:%M') . '</li>' .
			'<li>Organizer: ' . $this->getOrganizer () . '</li>' .
			'<li>Location: ' . $this->getLocation () . '</li>' .
			'<li>Description: ' . $d . '</li></ul></font>';
	}

	/**
	 * Returns the rendered event for allday.
	 * default: event title.
	 *
	 * @return string
	 */
	function renderEventForAllDay() {
		return $this->getTitle ();
	}

	/**
	 * Returns the rendered event for day.
	 * default: event title.
	 *
	 * @return string
	 */
	function renderEventForDay() {
		return $this->title;
	}

	/**
	 * Returns the rendered event for week.
	 * default: event title.
	 *
	 * @return string
	 */
	function renderEventForWeek() {
		return $this->title;
	}

	/**
	 * Returns the rendered event month day.
	 * default: event title.
	 *
	 * @return string
	 */
	function renderEventForMonth() {
		return $this->title;
	}

	/**
	 * Returns the rendered event month day for a mini month view.
	 * default: event title.
	 *
	 * @return string
	 */
	function renderEventForMiniMonth() {
		return $this->title;
	}

	/**
	 * Returns the rendered event for year.
	 * default: event title.
	 *
	 * @return string
	 */
	function renderEventForYear() {
		return $this->title;
	}

	/**
	 * Returns the location value.
	 *
	 * @return string
	 */
	function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the event location value.
	 *
	 * @param string $location
	 */
	function setLocation($location) {
		$this->location = $location;
	}

	/**
	 * Returns the location link value.
	 *
	 * @return string
	 */
	function getLocationLinkUrl() {
		return $this->locationLink;
	}

	/**
	 * Sets the event location link value.
	 *
	 * @param string $locationLink
	 */
	function setLocationLinkUrl($locationLink) {
		$this->locationLink = $locationLink;
	}

	/**
	 * Sets the event location page value.
	 *
	 * @param int $page
	 */
	function setLocationPage($page) {
		$this->locationPage = $page;
	}

	/**
	 * Returns the uid of locationPage.
	 *
	 * @return int
	 */
	function getLocationPage() {
		return $this->locationPage;
	}

	/**
	 * Returns the start date object.
	 *
	 * @return CalDate
	 */
	function getStart() {
		return $this->start;
	}

	/**
	 * Returns the enddate object.
	 *
	 * @return CalDate
	 */
	function getEnd() {
		if (! $this->end) {
			$this->setEnd ($this->getStart ());
			$this->end->addSeconds ($this->conf ['view.'] ['event.'] ['event.'] ['defaultEventLength']);
		}
		return $this->end;
	}

	/**
	 * Sets the event start.
	 *
	 * @param CalDate $start
	 */
	function setStart($start) {
		$this->start = new CalDate ();
		$this->start->copy ($start);
		$this->row ['start_date'] = $start->format ('%Y%m%d');
		$this->row ['start_time'] = $start->getHour () * 3600 + $start->getMinute () * 60;
	}

	/**
	 * Sets the event end.
	 *
	 * @param CalDate $end
	 */
	function setEnd($end) {
		$this->end = new CalDate ();
		$this->end->copy ($end);
		$this->row ['end_date'] = $end->format ('%Y%m%d');
		$this->row ['end_time'] = $end->getHour () * 3600 + $end->getMinute () * 60;
	}

	/**
	 * Returns the startdate as unix timestamp.
	 *
	 * @return int
	 */
	function getStartAsTimestamp() {
		$start = $this->getStart ();
		return $start->getDate (DATE_FORMAT_UNIXTIME);
	}

	/**
	 * Returns the enddate as unix timestamp.
	 *
	 * @return int
	 */
	function getEndAsTimestamp() {
		$end = $this->getEnd ();
		return $end->getDate (DATE_FORMAT_UNIXTIME);
	}

	/**
	 * Returns the ? value.
	 *
	 * @return bool
	 * @deprecated field is missing
	 */
	function getConfirmed() {
		return false;
	}

	/**
	 * Returns the cal recu value.
	 *
	 * @return array ? - empty array
	 * @deprecated What is that for?
	 */
	function getCalRecu() {
		return array ();
	}

	/**
	 * Returns the cal number value.
	 *
	 * @return int
	 */
	function getCalNumber() {
		return $this->calnumber;
	}

	/**
	 * Sets the calnumber.
	 *
	 * @param int $calnumber
	 */
	function setCalNumber($calnumber) {
		$this->calnumber = $calnumber;
	}

	/**
	 * Returns the calendar uid.
	 *
	 * @return int
	 */
	function getCalendarUid() {
		return $this->calendarUid;
	}

	/**
	 * Sets the calendar uid.
	 *
	 * @param int $uid
	 */
	function setCalendarUid($uid) {
		$this->calendarUid = $uid;
	}

	/**
	 * Returns the calendar object
	 *
	 * @return CalendarModel calendar object
	 */
	function getCalendarObject() {
		if (! $this->calendarObject) {
			$modelObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry ('basic', 'modelcontroller');
			$this->calendarObject = $modelObj->findCalendar ($this->getCalendarUid ());
		}

		return $this->calendarObject;
	}

	/**
	 * Returns the calendar name.
	 *
	 * @return string
	 */
	function getCalName() {
		return $this->calname;
	}

	/**
	 * Sets the calendar name.
	 *
	 * @param string $calname
	 */
	function setCalName($calname) {
		$this->calname = $calname;
	}

	/**
	 * @return int
	 */
	function getOverlap() {
		return $this->overlap;
	}

	/**
	 * @param $overlap
	 */
	function setOverlap($overlap) {
		$this->overlap = $overlap;
	}

	/**
	 * @return string
	 */
	function getTimezone() {
		return $this->timezone;
	}

	/**
	 * @param string $timezone
	 */
	function setTimezone($timezone) {
		$this->timezone = $timezone;
	}

	/**
	 * @return int
	 */
	function getDuration() {
		return $this->end->getTime () - $this->start->getTime ();
	}

	/**
	 * @param int $duration
	 * @return string
	 */
	function getFormatedDurationString($duration) {
		$durationString = '';
		if ($duration < 0) {
			$durationString .= '-';
		}
		$duration = abs ($duration);
		$durationString .= 'P';
		$rest = $duration % (60 * 60 * 24);
		$days = ($duration - $rest) / (60 * 60 * 24);
		if ($days > 0) {
			$durationString .= $days . 'D';
		}
		$durationString .= 'T';
		$rest2 = $rest % (60 * 60);
		$hours = ($rest - $rest2) / (60 * 60);
		if ($hours > 0) {
			$durationString .= $hours . 'H';
		}

		$rest3 = $rest2 % (60);
		$minutes = ($rest2 - $rest3) / (60);
		if ($minutes > 0) {
			$durationString .= $minutes . 'M';
		}

		if ($rest3 > 0) {
			$durationString .= $rest3 . 'M';
		}
		return $durationString;
	}

	/**
	 * @return bool
	 */
	function isAllday() {
		return $this->allday;
	}

	/**
	 * @return bool
	 */
	function getAllday() {
		return $this->allday;
	}

	/**
	 * @param bool $boolean
	 */
	function setAllday($boolean) {
		$this->allday = $boolean;
	}

	/**
	 * @return array
	 */
	function getRecurringRule() {
		if ($this->freq != 'none' && $this->freq != '') {
			$return = [];
			$return ['FREQ'] = $this->freq;
			$return ['INTERVAL'] = $this->interval;
			return $return;
		}
		return null;
	}

	/**
	 * @param array $recur
	 * @deprecated unimplemented
	 */
	function setRecur($recur = array()) {
	}

	/**
	 * @return string
	 */
	function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	function getVAlarmDescription() {
		return $this->alarmdescription;
	}

	/**
	 * @param string $alarmdescription
	 */
	function setVAlarmDescription($alarmdescription) {
		$this->alarmdescription = $alarmdescription;
	}

	/**
	 * @return bool
	 */
	function isClone() {
		return $this->isClone;
	}

	/**
	 * @param bool $boolean
	 */
	function setIsClone($boolean) {
		$this->isClone = $boolean;
	}

	/**
	 * @return array
	 */
	function getRecurrance() {
		$a = Array ();
		$a ['tzid'] = $this->getTimezone ();
		$a ['date'] = $this->startdate;
		$a ['time'] = $this->starthour;
		return $a;
	}

	/**
	 * @return array
	 */
	function getByMonth() {
		return $this->bymonth;
	}

	/**
	 * @param string $byMonth
	 */
	function setByMonth($byMonth) {
		if ($byMonth != '') {
			$this->bymonth = explode (',', $byMonth);
		}
		if (strtoupper ($byMonth) == 'ALL' || in_array ('all', $this->bymonth)) {
			$this->bymonth = array (
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					11,
					12
			);
		}
	}

	/**
	 * @return array
	 */
	function getByDay() {
		return $this->byday;
	}

	/**
	 * @param string $byDay
	 */
	function setByDay($byDay) {
		$byDay = strtoupper ($byDay);
		if ($byDay != '') {
			$this->byday = explode (',', $byDay);
		}

		if (strtoupper ($byDay) == 'ALL' || in_array ('all', $this->byday)) {
			$this->byday = array (
					'MO',
					'TU',
					'WE',
					'TH',
					'FR',
					'SA',
					'SU'
			);
		}
	}

	/**
	 * @return array
	 */
	function getByMonthDay() {
		return $this->bymonthday;
	}

	/**
	 * @param string $byMonthday
	 */
	function setByMonthday($byMonthday) {
		if ($byMonthday != '') {
			$this->bymonthday = GeneralUtility::trimExplode (',', $byMonthday, 1);
		}
		if (strtoupper ($byMonthday) == 'ALL' || in_array ('all', $this->bymonthday)) {
			$this->bymonthday = array (
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					11,
					12,
					13,
					14,
					15,
					16,
					17,
					18,
					19,
					20,
					21,
					22,
					23,
					24,
					25,
					26,
					27,
					28,
					29,
					30,
					31
			);
		}
	}

	/**
	 * @return array
	 */
	function getByWeekDay() {
		return $this->byweekday;
	}

	/**
	 * @param string $byWeekDay
	 */
	function setByWeekDay($byWeekDay) {
		$this->byweekday = explode (',', $byWeekDay);
	}

	/**
	 * @return array
	 */
	function getByWeekNo() {
		return $this->byweekno;
	}

	/**
	 * @param string $byWeekNo
	 */
	function setByWeekNo($byWeekNo) {
		$this->byweekno = explode (',', $byWeekNo);
	}

	/**
	 * @return array
	 */
	function getByMinute() {
		return $this->byminute;
	}

	/**
	 * @param string $byMinute
	 */
	function setByMinute($byMinute) {
		$this->byminute = explode (',', $byMinute);
	}

	/**
	 * @return array
	 */
	function getByHour() {
		return $this->byhour;
	}

	/**
	 * @param string $byHour
	 */
	function setByHour($byHour) {
		$this->byhour = explode (',', $byHour);
	}

	/**
	 * @return array
	 */
	function getBySecond() {
		return $this->bysecond;
	}

	/**
	 * @param string $bySecond
	 */
	function setBySecond($bySecond) {
		$this->bysecond = explode (',', $bySecond);
	}

	/**
	 * @return array
	 */
	function getByYearDay() {
		return $this->byyearday;
	}

	/**
	 * @param string $byYearDay
	 */
	function setByYearDay($byYearDay) {
		$this->byyearday = explode (',', $byYearDay);
	}

	/**
	 * @return int
	 */
	function getBySetPos() {
		return $this->bysetpos;
	}

	/**
	 * @param int $bysetpos
	 */
	function setBySetPos($bysetpos) {
		$this->bysetpos = $bysetpos;
	}

	/**
	 * @return string
	 */
	function getWkst() {
		return $this->wkst;
	}

	/**
	 * @param string $wkst
	 */
	function setWkst($wkst) {
		$this->wkst = $wkst;
	}

	/**
	 * @return int
	 */
	function getInterval() {
		return $this->interval;
	}

	/**
	 * @param int $interval
	 */
	function setInterval($interval) {
		$this->interval = $interval;
	}

	/**
	 * @return string
	 */
	function getSummary() {
		return $this->summary;
	}

	/**
	 * @param string $summary
	 */
	function setSummary($summary) {
		$this->summary = $summary;
	}

	/**
	 * @return string
	 */
	function getClass() {
		return $this->_class;
	}

	/**
	 * @param string $class
	 */
	function setClass($class) {
		$this->_class = $class;
	}

	/**
	 * @return string
	 */
	function getDisplayEnd() {
		return $this->displayend;
	}

	/**
	 * @param string $displayend
	 */
	function setDisplayEnd($displayend) {
		$this->displayend = $displayend;
	}

	/**
	 * @return string
	 */
	function getContent() {
		return $this->content;
	}

	/**
	 * @param string $t
	 */
	function setContent($t) {
		$this->content = $t;
	}

	/**
	 * Returns the description of this event.
	 *
	 * @return string
	 */
	function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description attribute
	 *
	 * @param string $description
	 */
	function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the until date object
	 *
	 * @return CalDate
	 */
	function getUntil() {
		return $this->until;
	}

	/**
	 * Sets the until object.
	 *
	 * @param CalDate $until
	 */
	function setUntil($until) {
		$this->until = $until;
	}

	/**
	 * @return string
	 */
	function getFreq() {
		return $this->freq;
	}

	/**
	 * Sets the recurring frequency
	 *
	 * @param string $freq
	 */
	function setFreq($freq) {
		$this->freq = $freq;
	}

	/**
	 * Returns how often a recurring event is supposed to recurr as max
	 *
	 * @return int
	 */
	function getCount() {
		return $this->cnt;
	}

	/**
	 * Sets how often a recurring event is supposed to recurr as max
	 *
	 * @param int $count
	 */
	function setCount($count) {
		$this->cnt = $count;
	}

	/**
	 * Returns the rdate value.
	 *
	 * @return string
	 */
	function getRdate() {
		return $this->rdate;
	}

	/**
	 * Sets the rdate value.
	 *
	 * @param string $rdate
	 */
	function setRdate($rdate) {
		$this->rdate = strtoupper ($rdate);
	}

	/**
	 * Returns the rdate value as array split by comma.
	 *
	 * @return array
	 */
	function getRdateValues() {
		return GeneralUtility::trimExplode (',', $this->rdate, 1);
	}

	/**
	 * Sets the rdate value.
	 *
	 * @param string[] $rdateArray
	 */
	function setRdateValues($rdateArray) {
		$this->rdate = implode (',', $rdateArray);
	}

	/**
	 * Returns the rdate type value.
	 *
	 * @return string
	 */
	function getRdateType() {
		return $this->rdateType;
	}

	/**
	 * Sets the rdate type value.
	 *
	 * @param string $rdateType
	 */
	function setRdateType($rdateType) {
		$this->rdateType = $rdateType;
	}

	/**
	 * Returns TRUE if the events lasts the whole day
	 *
	 * @return bool
	 */
	function getSpansDay() {
		return $this->spansday;
	}

	/**
	 * Sets the spansday attribute
	 *
	 * @param bool $spansday    true, if event lasts the whole day
	 */
	function setSpansDay($spansday) {
		$this->spansday = $spansday;
	}

	/**
	 * Returns the categories (array)
	 *
	 * @return array
	 */
	function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param array $categories
	 */
	function setCategories($categories) {
		if (is_array ($categories)) {
			$this->categories = $categories;
		}
	}

	/**
	 * Adds an event to the exceptionEvents array
	 *
	 * @param Model $ex_event
	 */
	function addExceptionEvent($ex_event) {
		array_push ($this->exceptionEvents, $ex_event);
	}

	/**
	 * Sets the exceptionEvents
	 *
	 * @param array $ex_events
	 */
	function setExceptionEvents($ex_events) {
		$this->exceptionEvents = $ex_events;
	}

	/**
	 * Returns the exceptionEvents array
	 *
	 * @return array
	 */
	function getExceptionEvents() {
		return $this->exceptionEvents;
	}

	/**
	 * Sets the editable value
	 *
	 * @param bool $editable    true, if the event should be editable
	 */
	function setEditable($editable) {
		$this->editable = $editable;
	}

	/**
	 * Returns TRUE if this event is editable
	 *
	 * @return bool
	 */
	function getEditable() {
		return $this->editable;
	}

	/**
	 * Sets the organizer_id
	 *
	 * @param int $id
	 */
	function setOrganizerId($id) {
		$this->organizer_id = $id;
	}

	/**
	 * Returns the organizer_id
	 *
	 * @return int
	 */
	function getOrganizerId() {
		return $this->organizer_id;
	}

	/**
	 * Returns the organizer object.
	 *
	 * @return Organizer
	 */
	function getOrganizerObject() {
		if (! $this->organizerObject) {
			$confArr = unserialize ($GLOBALS ['TYPO3_CONF_VARS'] ['EXT'] ['extConf'] ['cal']);
			$useOrganizerStructure = ($confArr ['useOrganizerStructure'] ? $confArr ['useOrganizerStructure'] : 'tx_cal_organizer');
			$modelObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry ('basic', 'modelcontroller');
			$this->organizerObject = $modelObj->findOrganizer ($this->getOrganizerId (), $useOrganizerStructure, $this->conf ['pidList']);
		}

		return $this->organizerObject;
	}

	/**
	 * Sets the organizerLink
	 *
	 * @param $link string
	 */
	function setOrganizerLinkUrl($link) {
		$this->organizerLink = $link;
	}

	/**
	 * Return the organizerLink.
	 * A html link to an organizer
	 *
	 * @return string
	 */
	function getOrganizerLinkUrl() {
		return $this->organizerLink;
	}

	/**
	 * Return the organizerpage.
	 * The pid to link the organizer to
	 *
	 * @return int
	 */
	function getOrganizerPage() {
		return $this->organizerPage;
	}

	/**
	 * Sets the organizerPage
	 *
	 * @param int $pid
	 */
	function setOrganizerPage($pid) {
		$this->organizerPage = $pid;
	}

	/**
	 * Sets the location_id
	 *
	 * @param int $id
	 */
	function setLocationId($id) {
		$this->location_id = $id;
	}

	/**
	 * Returns the location_id
	 *
	 * @return int
	 */
	function getLocationId() {
		return $this->location_id;
	}

	/**
	 * Returns the location object.
	 *
	 * @return Location
	 */
	public function getLocationObject() {
		if (! $this->locationObject) {
			$confArr = unserialize ($GLOBALS ['TYPO3_CONF_VARS'] ['EXT'] ['extConf'] ['cal']);
			$useLocationStructure = ($confArr ['useLocationStructure'] ? $confArr ['useLocationStructure'] : 'tx_cal_location');
			$modelObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry ('basic', 'modelcontroller');
			$this->locationObject = $modelObj->findLocation ($this->getLocationId (), $useLocationStructure, $this->conf ['pidList']);
		}
		return $this->locationObject;
	}

	/**
	 * Adds an id to the exception_single_ids array
	 *
	 * @param int $id
	 */
	function addExceptionSingleId($id) {
		$this->exception_single_ids [] = $id;
	}

	/**
	 * Returns the exception_single_ids array
	 *
	 * @return int[]
	 */
	function getExceptionSingleIds() {
		return $this->exception_single_ids;
	}

	/**
	 * Sets the exception_single_ids array
	 *
	 * @param int[] $idArray    array of exception single ids
	 */
	function setExceptionSingleIds($idArray) {
		$this->exception_single_ids = $idArray;
	}

	/**
	 * Adds an id to the notifyUserIds array
	 *
	 * @param int $id
	 */
	function addNotifyUser($id) {
		$this->notifyUserIds [] = $id;
	}

	/**
	 * Adds an category object to the category array
	 *
	 * @param CategoryModel $category
	 */
	function addCategory($category) {
		$this->categories [] = $category;
	}

	/**
	 * Returns the notifyUserIds array
	 *
	 * @return int[]
	 */
	function getNotifyUserIds() {
		return $this->notifyUserIds;
	}

	/**
	 * Adds an id to the exceptionGroupIds array
	 *
	 * @param int $id
	 */
	function addExceptionGroupId($id) {
		if ($id > 0) {
			$this->exceptionGroupIds [] = $id;
		}
	}

	/**
	 * Returns the exceptionGroupIds array
	 *
	 * @return int[]
	 */
	function getExceptionGroupIds() {
		return $this->exceptionGroupIds;
	}

	/**
	 * Sets the exceptionGroupIds array
	 *
	 * @param int[] $idArray    array of exception group ids
	 */
	function setExceptionGroupIds($idArray) {
		$this->exceptionGroupIds = $idArray;
	}

	/**
	 * Adds an id to the notifyGroupIds array
	 *
	 * @param int $id
	 */
	function addNotifyGroup($id) {
		if ($id > 0) {
			$this->notifyGroupIds [] = $id;
		}
	}

	/**
	 * Returns the notifyGroupIds array
	 *
	 * @return int[]
	 */
	function getNotifyGroupIds() {
		return $this->notifyGroupIds;
	}

	/**
	 * Adds an id to the creatorUserIds array
	 *
	 * @param int $id
	 */
	function addCreatorUserId($id) {
		array_push ($this->creatorUserIds, $id);
	}

	/**
	 * Returns the creatorUserIds array
	 *
	 * @return int[]
	 */
	function getCreatorUserIds() {
		return $this->creatorUserIds;
	}

	/**
	 * Adds an id to the creatorGroupIds array
	 *
	 * @param int $id
	 */
	function addCreatorGroupId($id) {
		$this->creatorGroupIds [] = $id;
	}

	/**
	 * Returns the creatorGroupIds array
	 *
	 * @return int[]
	 */
	function getCreatorGroupIds() {
		return $this->creatorGroupIds;
	}

	/**
	 * Sets the headerstyle
	 *
	 * @param string $style     style name
	 */
	function setHeaderStyle($style) {
		if ($style != '') {
			$this->headerstyle = $style;
		}
	}

	/**
	 * Returns the headerstyle name
	 *
	 * @return string
	 */
	function getHeaderStyle() {
		return $this->headerstyle;
	}

	/**
	 * Sets the bodystyle
	 *
	 * @param string $style     style name
	 */
	function setBodyStyle($style) {
		if ($style != '') {
			$this->bodystyle = $style;
		}
	}

	/**
	 * Returns the bodystyle name
	 *
	 * @return string
	 */
	function getBodyStyle() {
		return $this->bodystyle;
	}

	/**
	 * @param int $uid      page uid
	 */
	function setPage($uid) {
		$this->page = $uid;
	}

	/**
	 * @return int
	 */
	function getPage() {
		return $this->page;
	}

	/**
	 * @param string $extUrl
	 */
	function setExtUrl($extUrl) {
		$this->ext_url = $extUrl;
	}

	/**
	 * @return int
	 */
	function getEventType() {
		return $this->event_type;
	}

	/**
	 * @param int $type
	 */
	function setEventType($type) {
		$this->event_type = $type;
	}

	/**
	 * @param string $pidList
	 */
	function search($pidList = '') {
	}

	/**
	 * @param array $owner
	 */
	function setEventOwner($owner) {
		$this->eventOwner = $owner;
	}

	/**
	 * @return array
	 */
	function getEventOwner() {
		return $this->eventOwner;
	}

	/**
	 * @param int $userId
	 * @param int[] $groupIdArray
	 * @return bool
	 */
	function isEventOwner($userId, $groupIdArray) {
		if (is_array ($this->eventOwner ['fe_users']) && in_array ($userId, $this->eventOwner ['fe_users'])) {
			return true;
		}
		foreach ($groupIdArray as $id) {
			if (is_array ($this->eventOwner ['fe_groups']) && in_array ($id, $this->eventOwner ['fe_groups'])) {
				return true;
			}
		}
		return false;
	}

	/**
	 * @return array
	 */
	function getAdditionalValuesAsArray() {
		$values = Array ();

		$values ['page'] = $this->getPage ();
		$values ['type'] = $this->getEventType ();
		$values ['model_type'] = $this->getType ();
		$values ['intrval'] = $this->getInterval ();
		$values ['cnt'] = $this->getCount ();

		$until = $this->getUntil ();
		if (is_object ($until)) {
			$values ['until'] = $until->format ('%Y%m%d');
		} else {
			$values ['until'] = '00000101';
		}
		$values ['category_headerstyle'] = $this->getHeaderstyle ();
		$values ['category_bodystyle'] = $this->getBodystyle ();
		$start = &$this->getStart ();
		$values ['start_date'] = $start->format ('%Y%m%d');
		$values ['start_time'] = $start->getHour () * 3600 + $start->getMinute () * 60;
		$values ['start'] = $this->getStartAsTimestamp ();
		$end = &$this->getEnd ();
		$values ['end_date'] = $end->format ('%Y%m%d');
		$values ['end_time'] = $end->getHour () * 3600 + $end->getMinute () * 60;
		$values ['end'] = $this->getEndAsTimestamp ();
		$values ['allday'] = $this->isAllday ();
		$values ['calendar_id'] = $this->getCalendarUid ();
		$values ['category_string'] = $this->getCategoriesAsString (false);

		return $values;
	}

	/**
	 * @param bool $asLink
	 * @return string
	 */
	function getCategoriesAsString($asLink = true) {
		/*
		 * if($this->categoriesAsString){ return $this->categoriesAsString; }
		 */
		$this->categoriesAsString = Array ();
		$rememberCats = Array ();
		$objectType = $this->getObjectType ();

		if (count ($this->categories)) {
			foreach ($this->categories as $categoryObject) {
				if (is_object ($categoryObject)) {
					if (in_array ($categoryObject->getUid (), $rememberCats)) {
						continue;
					}

					$rememberCats [] = $categoryObject->getUid ();
					// init object and hand over the data of the category as fake DB values
					$this->initLocalCObject ($categoryObject->getValuesAsArray ());
					$categoryTitle = $this->local_cObj->stdWrap ($categoryObject->getTitle (), $this->conf ['view.'] [$this->conf ['view'] . '.'] [$objectType . '.'] ['categoryLink_stdWrap.']);

					if ($asLink) {
						$headerstyle = $categoryObject->getHeaderStyle ();
						$this->local_cObj->data ['link_ATagParams'] = $headerstyle != '' ? ' class="' . $headerstyle . '"' : '';
						$parameter ['category'] = $categoryObject->getUid ();
						$parameter ['offset'] = null;

						$this->controller->getParametersForTyposcriptLink ($this->local_cObj->data, $parameter, $this->conf ['cache'], $this->conf ['clear_anyway']);
						$this->local_cObj->setCurrentVal ($categoryTitle);
						$this->categoriesAsString [] = $this->local_cObj->cObjGetSingle ($this->conf ['view.'] [$this->conf ['view'] . '.'] [$objectType . '.'] ['categoryLink'], $this->conf ['view.'] [$this->conf ['view'] . '.'] [$objectType . '.'] ['categoryLink.']);
					} else {
						$this->categoriesAsString [] = $categoryTitle;
					}
				}
			}
		}
		// reset the object
		$this->initLocalCObject ();
		return implode ($this->local_cObj->cObjGetSingle ($this->conf ['view.'] [$this->conf ['view'] . '.'] [$objectType . '.'] ['categoryLink_splitChar'], $this->conf ['view.'] [$this->conf ['view'] . '.'] [$objectType . '.'] ['categoryLink_splitChar.']), $this->categoriesAsString);
	}

	/**
	 * @return int[]
	 */
	function getCategoryUidsAsArray() {
		if ($this->categoryUidsAsArray) {
			return $this->categoryUidsAsArray;
		}
		$first = true;
		$this->categoryUidsAsArray = Array ();
		$categories = &$this->getCategories ();
		if (is_array ($categories) && count ($categories)) {
			foreach ($this->getCategories () as $categoryArray) {
				if (is_object ($categoryArray)) {
					if ($first) {
						$this->categoryUidsAsArray [] = $categoryArray->getUid ();
						$first = false;
					} else {
						$this->categoryUidsAsArray [] = $categoryArray->getUid ();
					}
				}
			}
		}
		return $this->categoryUidsAsArray;
	}

	/**
	 * @return Model
	 */
	function cloneEvent() {
		$thisClass = get_class ($this);
		/** @var Model $event */
		$event = new $thisClass( $this->getType ());
		$event->setIsClone (true);
		return $event;
	}

	/**
	 * Calls user function defined in TypoScript
	 *
	 * @param int $mConfKey     if this value is empty the var $mConfKey is not processed
	 * @param mixed $passVar    this var is processed in the user function
	 * @return mixed processed $passVar
	 */
	function userProcess($mConfKey, $passVar) {
		if ($this->conf [$mConfKey]) {
			$funcConf = $this->conf [$mConfKey . '.'];
			$funcConf ['parentObj'] = & $this;
			$passVar = $this->controller->cObj->callUserFunction ($this->conf [$mConfKey], $funcConf, $passVar);
		}
		return $passVar;
	}

	/**
	 * @return bool
	 */
	function isExternalPluginEvent() {
		return $this->externalPlugin;
	}

	/**
	 * @return string
	 */
	function getExternalPluginEventLink() {
		return null;
	}

	/**
	 * @param array $currentParams
	 */
	function addAdditionalSingleViewUrlParams(&$currentParams) {
	}

	/**
	 * @return int
	 */
	function getLengthInSeconds() {
		$eventStart = $this->getStart ();
		$eventEnd = $this->getEnd ();
		$days = Calc::dateDiff ($eventStart->getDay (), $eventStart->getMonth (), $eventStart->getYear (), $eventEnd->getDay (), $eventEnd->getMonth (), $eventEnd->getYear ());
		$hours = $eventEnd->getHour () - $eventStart->getHour ();
		$minutes = $eventEnd->getMinute () - $eventStart->getMinute ();
		return $days * 86400 + $hours * 3600 + $minutes * 60;
	}

	/**
	 * @param AttendeeModel $attendee
	 */
	function addAttendee(&$attendee) {
		$this->attendees [$attendee->getType ()] [] = $attendee;
	}

	/**
	 * @param AttendeeModel[] $attendees
	 */
	function setAttendees(&$attendees) {
		$this->attendees = &$attendees;
	}

	/**
	 * @return int
	 */
	function getStatus() {
		return $this->status;
	}

	/**
	 * @param int $status
	 */
	function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @return int
	 */
	function getPriority() {
		return $this->priority;
	}

	/**
	 * @param int $priority
	 */
	function setPriority($priority) {
		$this->priority = $priority;
	}

	/**
	 * @return int
	 */
	function getCompleted() {
		return $this->completed;
	}

	/**
	 * @param int $completed
	 */
	function setCompleted($completed) {
		$this->completed = $completed;
	}

	/**
	 * @return mixed
	 */
	function getDeviationDates() {
		return $this->deviationDates;
	}

	/**
	 * @param $deviationDates
	 */
	function setDeviationDates($deviationDates) {
		$this->deviationDates = $deviationDates;
	}
}

?>