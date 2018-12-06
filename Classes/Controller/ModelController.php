<?php

namespace TYPO3\CMS\Cal\Controller;
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

use Doctrine\DBAL\FetchMode;
use TYPO3\CMS\Cal\Model\EventModel;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Back controller for the calendar base.
 * Takes requests from the main
 * controller and starts processing in the appropriate calendar models by
 * utilizing TYPO3 services.
 *
 * @author Jeff Segars <jeff@webempoweredchurch.org>
 * @package TYPO3
 * @subpackage cal
 */
class ModelController extends BaseController {
	/** @var ConnectionPool $connectionPool */
	var $connectionPool;

	private $todoSubtype = 'event';

	public function __construct() {
		parent::__construct();
		$confArr = unserialize($GLOBALS ['TYPO3_CONF_VARS'] ['EXT'] ['extConf'] ['cal']);
		$this->todoSubtype = $confArr ['todoSubtype'];

		$this->connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
	}

	public function findEvent($uid, $type = '', $pidList = '', $showHiddenEvents = false, $showDeletedEvents = false,
		$getAllInstances = false, $disableCalendarSearchString = false, $disableCategorySearchString = false,
		$eventType = '0,1,2,3'
	) {
		if ($uid == '') {
			return null;
		}
		if ($type == '') {
			$type = 'tx_cal_phpicalendar';
		}
		$event = $this->find('cal_event_model', $uid, $type, 'event',
			$pidList, $showHiddenEvents, $showDeletedEvents, $getAllInstances, $disableCalendarSearchString, $disableCategorySearchString, $eventType);
		return $event;
	}

	public function findTodo($uid, $type = 'tx_cal_todo', $pidList = '', $showHiddenEvents = false,
		$showDeletedEvents = false, $getAllInstances = false, $disableCalendarSearchString = false,
		$disableCategorySearchString = false, $eventType = '0,1,2,3'
	) {
		if ($uid == '') {
			return null;
		}
		$event = $this->find('cal_event_model', $uid, $type, $this->todoSubtype,
			$pidList, $showHiddenEvents, $showDeletedEvents, $getAllInstances, $disableCalendarSearchString, $disableCategorySearchString, $eventType);
		return $event;
	}

	public function createEvent($type) {
		$event = $this->create('cal_event_model', $type, 'event');
		return $event;
	}

	public function findAllEventInstances($uid, $type = '', $pidList = '', $showHiddenEvents = false,
		$showDeletedEvents = false, $getAllInstances = false, $disableCalendarSearchString = false,
		$disableCategorySearchString = false, $eventType = '0,1,2,3'
	) {
		if ($uid == '') {
			return null;
		}
		$event_s = $this->find('cal_event_model', $uid, $type, 'event',
			$pidList, $showHiddenEvents, $showDeletedEvents, $getAllInstances, $disableCalendarSearchString, $disableCategorySearchString, $eventType);
		return $event_s;
	}

	public function saveEvent($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_event_model', 'event', $type);
		if (is_numeric($uid) && $uid != 0 && ($uid > 0)) {
			return $service->updateEvent($uid);
		}
		return $service->saveEvent($pid);
	}

	public function removeEvent($uid, $type) {
		$service = $this->getServiceObjByKey('cal_event_model', 'event', $type);

		if (is_numeric($uid) && $uid != 0 && ($uid > 0)) {
			return $service->removeEvent($uid);
		}
		return null;
	}

	public function saveTodo($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_event_model', $this->todoSubtype, $type);
		if (is_numeric($uid) && $uid != 0 && ($uid > 0)) {
			return $service->updateEvent($uid);
		}
		return $service->saveEvent($pid);
	}

	public function removeTodo($uid, $type) {
		$service = $this->getServiceObjByKey('cal_event_model', $this->todoSubtype, $type);

		if (is_numeric($uid) && $uid != 0 && ($uid > 0)) {
			return $service->removeEvent($uid);
		}
		return null;
	}

	public function saveExceptionEvent($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_event_model', 'event', $type);
		if (is_numeric($uid) && $uid != 0 && ($uid > 0)) {
			return $service->updateExceptionEvent($uid);
		}
		return $service->saveExceptionEvent($pid);
	}

	public function findAllTodoInstances($uid, $type = '', $pidList = '', $showHiddenEvents = false,
		$showDeletedEvents = false, $getAllInstances = false, $disableCalendarSearchString = false,
		$disableCategorySearchString = false, $eventType = '4'
	) {
		return $this->find('cal_event_model', $uid, $type, $this->todoSubtype,
			$pidList, $showHiddenEvents, $showDeletedEvents, $getAllInstances, $disableCalendarSearchString, $disableCategorySearchString, $eventType);
	}

	public function findLocation($uid, $type = '', $pidList = '') {
		if ($uid == '') {
			return null;
		}
		if ($type == '') {
			$type = 'tx_cal_location';
		}
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_location_model', 'location', $type);
		/* Look up an event with a specific ID inside the model */
		$location = $service->find($uid, $pidList);

		return $location;
	}

	public function findAllLocations($type = '', $pidList = '') {

		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_location_model', 'location', $type);
		/* Look up an event with a specific ID inside the model */
		$locations = $service->findAll($pidList);

		return $locations;
	}

	public function saveLocation($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_location_model', 'location', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->updateLocation($uid);
		}
		return $service->saveLocation($pid);
	}

	public function removeLocation($uid, $type) {
		$service = $this->getServiceObjByKey('cal_location_model', 'location', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->removeLocation($uid);
		}
		return null;
	}

	public function findOrganizer($uid, $type = '', $pidList = '') {
		if ($uid == '') {
			return null;
		}
		if ($type == '') {
			$type = 'tx_cal_organizer';
		}
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_organizer_model', 'organizer', $type);
		/* Look up an event with a specific ID inside the model */
		$organizer = $service->find($uid, $pidList);
		return $organizer;
	}

	public function findCalendar($uid, $type = 'tx_cal_calendar', $pidList = '') {
		if ($uid == '') {
			return null;
		}
		if ($type == '') {
			$type = 'tx_cal_calendar';
		}
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_calendar_model', 'calendar', $type);
		/* Look up an event with a specific ID inside the model */
		$calendar = $service->find($uid, $pidList);
		return $calendar;
	}

	public function findAllCalendar($type = '', $pidList = '') {
		/* No key provided so return all events */
		$serviceName = 'cal_calendar_model';
		$calendar = array();

		if ($type == '') {

			$serviceChain = '';

			/* Iterate over all classes providing the cal_model service */
			while (is_object($service = &GeneralUtility::makeInstanceService($serviceName, 'calendar', $serviceChain))) {
				$calendar [$service->getServiceKey()] = $service->findAll($pidList);
				$serviceChain .= ','.$service->getServiceKey();
			}
		} else {
			/* Gets the model for the provided service key */
			$service = &$this->getServiceObjByKey($serviceName, 'calendar', $type);
			/* Look up an event with a specific ID inside the model */
			$calendar [$type] = $service->findAll($pidList);
		}

		return $calendar;
	}

	public function findAllOrganizer($type = '', $pidList = '') {

		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_organizer_model', 'organizer', $type);
		/* Look up an event with a specific ID inside the model */
		$organizer = $service->findAll($pidList);

		return $organizer;
	}

	public function saveOrganizer($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_organizer_model', 'organizer', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->updateOrganizer($uid);
		}
		return $service->saveOrganizer($pid);
	}

	public function removeOrganizer($uid, $type) {
		$service = $this->getServiceObjByKey('cal_organizer_model', 'organizer', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->removeOrganizer($uid);
		}
		return null;
	}

	public function saveCalendar($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_calendar_model', 'calendar', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->updateCalendar($uid);
		}
		return $service->saveCalendar($pid);
	}

	public function removeCalendar($uid, $type) {
		$service = $this->getServiceObjByKey('cal_calendar_model', 'calendar', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->removeCalendar($uid);
		}
		return null;
	}

	public function saveCategory($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_category_model', 'category', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->updateCategory($uid);
		}
		return $service->saveCategory($pid);
	}

	public function removeCategory($uid, $type) {
		$service = $this->getServiceObjByKey('cal_category_model', 'category', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->removeCategory($uid);
		}
		return null;
	}

	public function findAttendee($uid, $type = '', $pidList = '') {
		if ($uid == '') {
			return null;
		}
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_attendee_model', 'attendee', $type);
		/* Look up an attendee with a specific ID inside the model */
		$attendee = $service->find($uid, $pidList);

		return $attendee;
	}

	public function findAllAttendees($type = '', $pidList = '') {
		$service = $this->getServiceObjByKey('cal_attendee_model', 'attendee', $type);

		/* Look up an attendee with a specific ID inside the model */
		$attendees = $service->findAllObjects('attendee', $type, $pidList);

		return $attendees;
	}

	public function findEventAttendees($eventUid, $type = '', $pidList = '') {

		/* Gets the model for the provided service key */
		$attendees = $this->findAllObjects('attendee', $type, $pidList, 'findEventAttendees', $eventUid);
		return $attendees;
	}

	public function updateEventAttendees($eventUid, $type = '', $pidList = '') {
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_event_model', 'event', $type);
		/* Look up an attendee with a specific ID inside the model */
		$service->updateAttendees($eventUid);
	}

	public function saveAttendee($uid, $type, $pid = '') {
		$service = $this->getServiceObjByKey('cal_attendee_model', 'attendee', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->updateAttendee($uid);
		}
		return $service->saveAttendee($pid);
	}

	public function removeAttendee($uid, $type) {
		$service = $this->getServiceObjByKey('cal_attendee_model', 'attendee', $type);
		if (is_numeric($uid) && $uid != 0) {
			return $service->removeAttendee($uid);
		}
		return null;
	}

	public function findEventsForDay(&$dateObject, $type = '', $pidList = '', $eventType = '0,1,2,3') {
		$starttime = Calendar::calculateStartDayTime($dateObject);
		$endtime = Calendar::calculateEndDayTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, 'event', $pidList, $eventType);
	}

	public function findEventsForWeek(&$dateObject, $type = '', $pidList = '', $eventType = '0,1,2,3') {
		$starttime = Calendar::calculateStartWeekTime($dateObject);
		$endtime = Calendar::calculateEndWeekTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, 'event', $pidList, $eventType);
	}

	public function findEventsForMonth(&$dateObject, $type = '', $pidList = '', $eventType = '0,1,2,3') {
		$starttime = Calendar::calculateStartMonthTime($dateObject);
		$endtime = Calendar::calculateEndMonthTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, 'event', $pidList, $eventType);
	}

	public function findEventsForYear(&$dateObject, $type = '', $pidList = '', $eventType = '0,1,2,3') {
		$starttime = Calendar::calculateStartYearTime($dateObject);
		$endtime = Calendar::calculateEndYearTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, 'event', $pidList, $eventType);
	}

	public function findEventsForList(&$startDateObject, &$endDateObject, $type = '', $pidList = '',
		$eventType = '0,1,2,3', $additionalWhere = ''
	) {
		return $this->findAllWithin('cal_event_model', $startDateObject, $endDateObject, $type, 'event', $pidList, $eventType, $additionalWhere);
	}

	public function findTodosForDay(&$dateObject, $type = '', $pidList = '', $eventType = '4') {
		$starttime = Calendar::calculateStartDayTime($dateObject);
		$endtime = Calendar::calculateEndDayTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, $this->todoSubtype, $pidList, $eventType);
	}

	public function findTodosForWeek(&$dateObject, $type = '', $pidList = '', $eventType = '4') {
		$starttime = Calendar::calculateStartWeekTime($dateObject);
		$endtime = Calendar::calculateEndWeekTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, $this->todoSubtype, $pidList, $eventType);
	}

	public function findTodosForMonth(&$dateObject, $type = '', $pidList = '', $eventType = '4') {
		$starttime = Calendar::calculateStartMonthTime($dateObject);
		$endtime = Calendar::calculateEndMonthTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, $this->todoSubtype, $pidList, $eventType);
	}

	public function findTodosForYear(&$dateObject, $type = '', $pidList = '', $eventType = '4') {
		$starttime = Calendar::calculateStartYearTime($dateObject);
		$endtime = Calendar::calculateEndYearTime($dateObject);
		return $this->findAllWithin('cal_event_model', $starttime, $endtime, $type, $this->todoSubtype, $pidList, $eventType);
	}

	public function findTodosForList(&$startDateObject, &$endDateObject, $type = '', $pidList = '', $eventType = '4') {
		return $this->findAllWithin('cal_event_model', $startDateObject, $endDateObject, $type, $this->todoSubtype, $pidList, $eventType);
	}

	public function findCurrentTodos($type = '', $pidList = '') {
		/* Gets the model for the provided service key */
		return $this->findAllObjects($this->todoSubtype, $type, $pidList, 'findCurrentTodos');
	}

	public function findCategoriesForList($type = '', $pidList = '') {
		return $this->findAllCategories('cal_category_model', $type, $pidList);
	}

	public function findEventsForIcs($type, $pidList) {
		return $this->findAll('cal_event_model', $type, 'event', $pidList, '0,1,2,3');
	}

	public function findEventsForRss(&$startDateObject, &$endDateObject, $type, $pidList) {
		return $this->findAllWithin('cal_event_model', $startDateObject, $endDateObject, $type, 'event', $pidList, '0,1,2,3');
	}

	public function findTodosForIcs($type, $pidList) {
		return $this->findAll('cal_event_model', $type, 'event', $pidList, '4');
	}

	public function findTodosForRss(&$startDateObject, &$endDateObject, $type, $pidList) {
		return $this->findAllWithin('cal_event_model', $startDateObject, $endDateObject, $type, $this->todoSubtype, $pidList, '4');
	}

	public function searchEvents($type, $pidList, &$startDateObject, &$endDateObject, $searchword, $locationIds,
		$organizerIds
	) {
		return $this->_searchEvents('cal_event_model', $type, $pidList, $startDateObject, $endDateObject, $searchword, $locationIds, $organizerIds, '0,1,2,3');
	}

	public function searchTodos($type, $pidList, &$startDateObject, &$endDateObject, $searchword, $locationIds,
		$organizerIds
	) {
		return $this->_searchEvents('cal_event_model', $type, $pidList, $startDateObject, $endDateObject, $searchword, $locationIds, $organizerIds, '4');
	}

	public function searchLocation($type, $pidList, $searchword) {
		return $this->_searchAddress('cal_location_model', $type, 'location', $pidList, $searchword);
	}

	public function searchOrganizer($type, $pidList, $searchword) {
		return $this->_searchAddress('cal_organizer_model', $type, 'organizer', $pidList, $searchword);
	}

	public function createTranslation($uid, $overlay, $serviceName, $type, $subtype) {
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey($serviceName, $subtype, $type);
		/* Look up an event with a specific ID inside the model */
		$service->createTranslation($uid, $overlay);
	}

	public function findFeUser($uid) {
		$feUser = Array();
		if ($uid == '') {
			return $feUser;
		}

		$connection = $this->connectionPool->getConnectionForTable('fe_users');
		$query = $connection->select(['*'], 'fe_users', ['uid' => intval($uid)]);
		if ($query->rowCount() > 0) {
			$feUser = $query->fetch(FetchMode::ASSOCIATIVE);
		}
		return $feUser;
	}

	/*
	 * Returns events from all calendar models or a specified model.
	 * @param		key		The optional service key to return events for. If no key is given, all events are returned.
	 * @return		array		Array of events.
	 */
	public function findAllWithin($serviceName, &$startDateObject, &$endDateObject, $type = '', $subtype = '',
		$pidList = '', $eventType = '', $additionalWhere = ''
	) {
		/* No key provided so return all events */
		if ($type == '') {
			$serviceChain = '';
			$events = array();
			$eventsFromService = array();

			/* Iterate over all classes providing the cal_model service */
			while (is_object($service = GeneralUtility::makeInstanceService($serviceName, $subtype, $serviceChain))) {
				$serviceChain .= ','.$service->getServiceKey();
				/* Gets all events from the current model as an array */
				$eventsFromService = $service->findAllWithin($startDateObject, $endDateObject, $pidList, $eventType, $additionalWhere);

				if (!empty ($eventsFromService)) {
					if (empty ($events)) {
						$events = $eventsFromService;
					} else {
						foreach ($eventsFromService as $eventdaykey => $eventday) {
							if (array_key_exists($eventdaykey, $events) == 1) {
								foreach ($eventday as $eventtimekey => $eventtime) {
									if (array_key_exists($eventtimekey, $events [$eventdaykey])) {
										$events [$eventdaykey] [$eventtimekey] = $events [$eventdaykey] [$eventtimekey] + $eventtime;
									} else {
										$events [$eventdaykey] [$eventtimekey] = $eventtime;
									}
								}
							} else {
								$events [$eventdaykey] = $eventday;
							}
						}
						$events = $events + $eventsFromService;
					}
				}
				/* Flattens the array returned by the current model into the top level array */
			}
			ksort($events);
			$return = array();
			foreach ($events as $key => $obj) {
				ksort($obj);
				$return [$key] = $obj;
			}
			return $return;
		}        /* Operate on the provided key only */
		else {
			/* Get the model represented by $key */
			$service = $this->getServiceObjByKey($serviceName, $subtype, $type);
			if (!is_object($service)) {
				return $this->findAllWithin($service, $startDateObject, $endDateObject, '', $subtype, $pidList, $eventType, $additionalWhere);
			}
			/* Get all events from the model as an array */
			$events = $service->findAllWithin($startDateObject, $endDateObject, $pidList, $eventType, $additionalWhere);
			ksort($events);
			$return = array();
			foreach ($events as $key => $obj) {
				ksort($obj);
				$return [$key] = $obj;
			}
			return $return;
		}
	}

	/*
	 * Returns events from all calendar models or a specified model.
	 * @param		key		The optional service key to return events for. If no key is given, all events are returned.
	 * @return		array		Array of events.
	 */
	public function findAll($serviceName, $type, $subtype, $pidList, $eventTypes = '0,1,2,3') {
		/* No key provided so return all events */
		if ($type == '') {

			$serviceChain = '';
			$events = array();
			$eventsFromService = array();

			/* Iterate over all classes providing the cal_model service */
			while (is_object($service = GeneralUtility::makeInstanceService($serviceName, $subtype, $serviceChain))) {
				$serviceChain .= ','.$service->getServiceKey();
				/* Gets all events from the current model as an array */
				$eventsFromService = $service->findAll($pidList, $eventTypes);
				if (!empty ($eventsFromService)) {
					if (empty ($events)) {
						$events = $eventsFromService;
					} else {
						foreach ($eventsFromService as $eventdaykey => $eventday) {
							if (array_key_exists($eventdaykey, $events) == 1) {
								foreach ($eventday as $eventtimekey => $eventtime) {
									if (array_key_exists($eventtimekey, $events [$eventdaykey])) {
										$events [$eventdaykey] [$eventtimekey] = $events [$eventdaykey] [$eventtimekey] + $eventtime;
									} else {
										$events [$eventdaykey] [$eventtimekey] = $eventtime;
									}
								}
							} else {
								$events [$eventdaykey] = $eventday;
							}
						}
						$events = $events + $eventsFromService;
					}
				}
			}
			ksort($events);
			$return = array();
			foreach ($events as $key => $obj) {
				ksort($obj);
				$return [$key] = $obj;
			}
			return $return;
		}        /* Operate on the provided key only */
		else {
			/* Get the model represented by $key */
			$service = $this->getServiceObjByKey($serviceName, $subtype, $type);
			/* Get all events from the model as an array */
			$events = $service->findAll($pidList, $eventTypes);
			return $events;
		}
	}

	public function findCategory($uid = '', $type = '', $pidList = '') {
		if ($uid == '') {
			return null;
		}
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey('cal_category_model', 'category', $type);
		/* Look up an event with a specific ID inside the model */
		$category = $service->find($uid, $pidList);
		return $category;
	}

	public function findAllCategories($serviceName, $type, $pidList) {
		/* No key provided so return all events */
		$serviceName = 'cal_category_model';
		$categoryArrayToBeFilled = array();
		$categories = array();

		if ($type == '') {

			$serviceChain = '';

			/* Iterate over all classes providing the cal_model service */
			while (is_object($service = &GeneralUtility::makeInstanceService($serviceName, 'category', $serviceChain))) {
				$service->findAll($pidList, $categoryArrayToBeFilled);
				$categories [$service->getServiceKey()] = $categoryArrayToBeFilled;
				$categoryArrayToBeFilled = array();
				$serviceChain .= ','.$service->getServiceKey();
			}
		} else {
			/* Gets the model for the provided service key */
			$service = &$this->getServiceObjByKey($serviceName, 'category', $type);
			/* Look up an event with a specific ID inside the model */
			$service->findAll($pidList, $categoryArrayToBeFilled);
			$categories [$type] = $categoryArrayToBeFilled;
		}

		return $categories;
	}

	public function _searchEvents($serviceName, $type, $pidList, &$startDateObject, &$endDateObject, $searchword,
		$locationIds = '', $organizerIds = '', $eventType = '0,1,2,3'
	) {

		/* No key provided so return all events */
		if ($type == '') {

			$serviceChain = '';
			$events = array();
			$eventsFromService = array();

			/* Iterate over all classes providing the cal_model service */
			while (is_object($service = GeneralUtility::makeInstanceService($serviceName, 'event', $serviceChain))) {
				$serviceChain .= ','.$service->getServiceKey();
				/* Gets all events from the current model as an array */
				$eventsFromService = $service->search($pidList, $startDateObject, $endDateObject, $searchword, $locationIds, $organizerIds, $eventType);
				if (!empty ($eventsFromService)) {
					if (empty ($events)) {
						$events = $eventsFromService;
					} else {
						foreach ($eventsFromService as $eventdaykey => $eventday) {
							if (array_key_exists($eventdaykey, $events) == 1) {
								foreach ($eventday as $eventtimekey => $eventtime) {
									if (array_key_exists($eventtimekey, $events [$eventdaykey])) {
										$events [$eventdaykey] [$eventtimekey] = $events [$eventdaykey] [$eventtimekey] + $eventtime;
									} else {
										$events [$eventdaykey] [$eventtimekey] = $eventtime;
									}
								}
							} else {
								$events [$eventdaykey] = $eventday;
							}
						}
						$events = $events + $eventsFromService;
					}
				}
			}
			ksort($events);
			$return = array();
			foreach ($events as $key => $obj) {
				ksort($obj);
				$return [$key] = $obj;
			}
			return $return;
		}        /* Operate on the provided key only */
		else {
			/* Get the model represented by $key */
			$service = $this->getServiceObjByKey($serviceName, 'event', $type);
			/* Get all events from the model as an array */
			$events = $service->search($pidList, $startDateObject, $endDateObject, $searchword, $locationIds, $organizerIds, $eventType);
			return $events;
		}
	}

	public function _searchAddress($serviceName, $type, $subtype, $pidList, $searchword) {
		/* No key provided so return all events */
		if ($type == '') {

			$serviceChain = '';
			$addressFromService = array();
			/* Iterate over all classes providing the cal_model service */
			while (is_object($service = GeneralUtility::makeInstanceService($serviceName, $subtype, $serviceChain))) {

				$serviceChain .= ','.$service->getServiceKey();
				/* Gets all events from the current model as an array */
				$addressFromService [] = $service->search($pidList, $searchword);
			}
			return $addressFromService;
		}        /* Operate on the provided key only */
		else {
			/* Get the model represented by $key */
			$service = $this->getServiceObjByKey($serviceName, $subtype, $type);
			/* Get all events from the model as an array */
			$addressFromService = $service->search($pidList, $searchword);
			return $addressFromService;
		}
	}

	/**
	 * Returns a specific event with a given serviceKey and UID.
	 *
	 * @param $serviceName
	 * @param $uid
	 * @param $type
	 * @param $subtype
	 * @param string $pidList
	 * @param bool $showHiddenEvents
	 * @param bool $showDeletedEvents
	 * @param bool $getAllInstances
	 * @param bool $disableCalendarSearchString
	 * @param bool $disableCategorySearchString
	 * @param string $eventType
	 * @return EventModel event object matching the serviceKey and UID.
	 */
	public function find($serviceName, $uid, $type, $subtype, $pidList = '', $showHiddenEvents = false,
		$showDeletedEvents = false, $getAllInstances = false, $disableCalendarSearchString = false,
		$disableCategorySearchString = false, $eventType = '0,1,2,3'
	) {
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey($serviceName, $subtype, $type);
		if (!is_object($service)) {
			return \TYPO3\CMS\Cal\Utility\Functions::createErrorMessage(
				'Missing or wrong parameter. The object you are looking for could not be found.',
				'Please verify your URL parameters: tx_cal_controller[type] and tx_cal_controller[uid].');
		}
		/* Look up an event with a specific ID inside the model */
		$event = $service->find($uid, $pidList, $showHiddenEvents, $showDeletedEvents, $getAllInstances, $disableCalendarSearchString, $disableCategorySearchString, $eventType);
		return $event;
	}

	/**
	 * Returns a specific event with a given serviceKey and UID.
	 *
	 * @param $serviceName
	 * @param $type
	 * @param $subtype
	 * @return EventModel event object matching the serviceKey and UID.
	 */
	public function create($serviceName, $type, $subtype) {
		/* Gets the model for the provided service key */
		$service = $this->getServiceObjByKey($serviceName, $subtype, $type);
		if (!is_object($service)) {
			return \TYPO3\CMS\Cal\Utility\Functions::createErrorMessage(
				'Missing or wrong parameter. The object you are looking for could not be found.',
				'Please verify your URL parameters: tx_cal_controller[type].');
		}
		/* Look up an event with a specific ID inside the model */
		$event = $service->createEvent(null, false);
		return $event;
	}

	/**
	 * Helper function to return a service object with the given type, subtype, and serviceKey
	 *
	 * @param  string    The type of the service.
	 * @param  string    The subtype of the service.
	 * @param  string    The serviceKey.
	 * @return object service object.
	 */
	public function &getServiceObjByKey($type, $subtype, $key) {
		$serviceChain = '';
		/* Loop over all services providign the specified service type and subtype */
		while (is_object($obj = &GeneralUtility::makeInstanceService($type, $subtype, $serviceChain))) {
			$serviceChain .= ','.$obj->getServiceKey();
			/* If the key of the current service matches what we're looking for, return the object */
			if ($key == $obj->getServiceKey()) {
				return $obj;
			}
		}
		return null;
	}

	/**
	 * Helper function to return a service object with the given type, subtype, and serviceKey
	 *
	 * @param  string    The type of the service.
	 * @param  string    The subtype of the service.
	 * @return array     service object.
	 */
	public function getServiceTypes($type, $subtype) {
		$serviceChain = '';
		$returnArray = array();
		/* Loop over all services providign the specified service type and subtype */
		while (is_object($obj = GeneralUtility::makeInstanceService($type, $subtype, $serviceChain))) {
			$serviceChain .= ','.$obj->getServiceKey();
			/* If the key of the current service matches what we're looking for, return the object */
			$returnArray [] = $obj->getServiceKey();
		}
		return $returnArray;
	}

	public function findAllObjects($key, $type, $pidList, $functionTobeCalled = '', $paramsToBePassedOn = '') {
		/* No key provided so return all X */
		$serviceName = 'cal_'.$key.'_model';
		$objects = array();
		if ($type == '') {

			$serviceChain = '';
			/* Iterate over all classes providing the cal_X_model service */
			while (is_object($service = &GeneralUtility::makeInstanceService($serviceName, $key, $serviceChain))) {
				if ($functionTobeCalled) {
					if (method_exists($service, $functionTobeCalled)) {
						$objects [$service->getServiceKey()] = $service->$functionTobeCalled ($paramsToBePassedOn);
					}
				} else {
					$objects [$service->getServiceKey()] = $service->findAll($pidList);
				}
				$serviceChain .= ','.$service->getServiceKey();
			}
		} else {
			/* Gets the model for the provided service key */
			$service = &$this->getServiceObjByKey($serviceName, $key, $type);
			/* Look up a objects with a specific ID inside the model */
			if ($functionTobeCalled) {
				if (method_exists($service, $functionTobeCalled)) {
					$objects [$type] = $service->$functionTobeCalled ($paramsToBePassedOn);
				}
			} else {
				$objects [$type] = $service->findAll($pidList);
			}
		}

		return $objects;
	}
}

?>