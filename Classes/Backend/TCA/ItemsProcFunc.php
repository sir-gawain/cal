<?php

namespace TYPO3\CMS\Cal\Backend\TCA;
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
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;


class ItemsProcFunc {

	/**
	 * Gets the items array of all available translations.
	 *
	 * @param  array    The current config array.
	 * @return array
	 *
	 * @todo Localize translation names. Probably not too critical since
	 *       they're mostly English anyway but its easy to do.
	 *
	 */
	public function getDayTimes($config) {
		$interval = 60 * 30;
		$dayLength = 60 * 60 * 24;
		for ($time = 0; $time < $dayLength; $time += $interval) {
			// gmdate is ok, as long as $time just holds information about 24h.
			$label = gmdate($GLOBALS ['TYPO3_CONF_VARS'] ['SYS'] ['hhmm'], $time);
			$value = gmdate('Hi', $time);
			$config ['items'] [] = Array(
				$label,
				$value
			);
		}

		// Add an entry for the end of the day.
		$label = gmdate($GLOBALS ['TYPO3_CONF_VARS'] ['SYS'] ['hhmm'], $dayLength - 1);
		$value = 2400;
		$config ['items'] [] = Array(
			$label,
			$value
		);

		return $config;
	}

	/**
	 * Gets the listing of users and groups.
	 *
	 * @param  array    The current config array.
	 * @return array
	 */
	public function getUsersAndGroups($config) {
		/* Add frontend groups */

		/** @var ConnectionPool $connectionPool */
		$connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);

		$table = 'fe_groups';

		$builder = $connectionPool->getQueryBuilderForTable($table);

		$res = $builder->select('*')->from($table)->orderBy('title')->execute();
		while (($row = $res->fetch(FetchMode::ASSOCIATIVE))) {
			$label = BackendUtility::getRecordTitle($table, $row);
			$value = -1 * intval($row ['uid']);
			$config ['items'] [] = Array(
				$label,
				$value
			);
		}

		/* Add a divider */
		$config ['items'] [] = Array(
			'------',
			'--div--'
		);

		/* Add frontend users */
		$table = 'fe_users';

		$builder = $connectionPool->getQueryBuilderForTable($table);

		$res = $builder->select('*')->from($table)->orderBy('name')->execute();
		while (($row = $res->fetch(FetchMode::ASSOCIATIVE))) {
			$label = BackendUtility::getRecordTitle($table, $row);
			$value = $row ['uid'];
			$config ['items'] [] = Array(
				$label,
				$value
			);
		}
		return $config;
	}

	/**
	 * General purpose function for fetching records from a given table using a combination of backend access control
	 * settings and User TSConfig options.
	 * Records are added to then added to the items array.
	 *
	 * @param   array        Associate array with keys 'items', 'config', 'TSconfig', 'table', 'row', and 'field'.
	 * @return  void
	 */
	public function getRecords(&$params) {
		$table = $params ['config'] ['itemsProcFunc_config'] ['table'];
		$where = $params ['config'] ['itemsProcFunc_config'] ['where'];
		$groupBy = $params ['config'] ['itemsProcFunc_config'] ['groupBy'];
		$orderBy = $params ['config'] ['itemsProcFunc_config'] ['orderBy'];
		$limit = $params ['config'] ['itemsProcFunc_config'] ['limit'];

		/* Get the records, with access restrictions and all that good stuff applied. */
		$res = self::getSQLResource($table, $where, $groupBy, $orderBy, $limit, $params ['row'] ['pid']);

		/* Loop over all records, adding them to the items array */
		while ($row = $res->fetch(FetchMode::ASSOCIATIVE)) {
			$label = BackendUtility::getRecordTitle($table, $row);
			$value = $row ['uid'];
			$params ['items'] [] = Array(
				$label,
				$value
			);
		}
	}

	/**
	 * General purpose function for fetching records from a given table using a combination of backend access control
	 * settings and User TSConfig options.
	 * A SQL resource is returned.
	 * exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='')
	 *
	 * @param  string       Name of the table.
	 * @param  string       Custom WHERE clause.
	 * @param  string       GROUP BY options.
	 * @param  string       ORDER BY options.
	 * @param  string        LIMIT options.
	 * @return object resource.
	 */
	public static function getSQLResource($table, $where = '', $groupBy = '', $orderBy = '', $limit = '', $pid = '') {
		/* Initialize the variables and config options */
		$be_userCategories = Array(
			0
		);
		$be_userCalendars = Array(
			0
		);
		$enableAccessControl = false;

		/** @var ConnectionPool $connectionPool */
		$connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);

		/** @var Connection $connection */
		$builder = $connectionPool->getQueryBuilderForTable($table);

		/* If we're grabbing calendar or category records, check access control settings */
		if ($table == 'tx_cal_calendar' or $table == 'tx_cal_category') {

			/* If we have a non-admin backend user, check access control settings */
			if (is_object($GLOBALS ['BE_USER']) && !$GLOBALS ['BE_USER']->user ['admin']) {

				/* Get access control settings for the user */
				if ($GLOBALS ['BE_USER']->user ['tx_cal_enable_accesscontroll']) {
					$enableAccessControl = true;
					$be_userCategories = GeneralUtility::trimExplode(',', $GLOBALS ['BE_USER']->user ['tx_cal_category'], 1);
					$be_userCalendars = GeneralUtility::trimExplode(',', $GLOBALS ['BE_USER']->user ['tx_cal_calendar'], 1);
				}

				/* Get access control settings for all groups */
				if (is_array($GLOBALS ['BE_USER']->userGroups)) {
					foreach ($GLOBALS ['BE_USER']->userGroups as $gid => $group) {
						if ($group ['tx_cal_enable_accesscontroll']) {
							$enableAccessControl = true;
							if ($group ['tx_cal_category']) {
								$groupCategories = GeneralUtility::trimExplode(',', $group ['tx_cal_category'], 1);
								$be_userCategories = array_merge($be_userCategories, $groupCategories);
							}
							if ($group ['tx_cal_calendar']) {
								$groupCalendars = GeneralUtility::trimExplode(',', $group ['tx_cal_calendar'], 1);
								$be_userCalendars = array_merge($be_userCalendars, $groupCalendars);
							}
						}
					}
				}

				/* If access control was enabled for the user or groups, add a WHERE clause */
				if ($enableAccessControl) {
					$builder->andWhere($builder->expr()->in('tx_cal_calendar.uid', $be_userCalendars));
				}
			}
		}

		// Load cache from BE User data
		$cache = $GLOBALS ['BE_USER']->getSessionData('cal_itemsProcFunc');
		if (!$cache) {
			$cache = Array();
		}

		if (!$GLOBALS ['BE_USER']->user ['admin']) {
			// Check if we can return something from cache
			if (is_array($cache [$GLOBALS ['BE_USER']->user ['uid']]) && $cache [$GLOBALS ['BE_USER']->user ['uid']] ['pidlist']) {
				$pidlist = $cache [$GLOBALS ['BE_USER']->user ['uid']] ['pidlist'];
			} else {
				$mounts = $GLOBALS ['BE_USER']->returnWebmounts();
				$qG = new \TYPO3\CMS\Core\Database\QueryGenerator();
				$pidlist = '';
				foreach ($mounts as $idx => $uid) {
					$list = $qG->getTreeList($uid, 99, 0, $GLOBALS ['BE_USER']->getPagePermsClause(1));
					$pidlist .= ($pidlist == '' ? '' : ',').$list;
				}
				$cache [$GLOBALS ['BE_USER']->user ['uid']] ['pidlist'] = $pidlist;
				$GLOBALS ['BE_USER']->setAndSaveSessionData('cal_itemsProcFunc', $cache);
			}
		}

		// Orders items from the current page first
		if ($pid) {
			$builder->orderBy($table.'.pid', 'DESC');
			if (!empty($orderBy)) {
				$builder->addOrderBy($orderBy);
			}
		}

		if ($pidlist != '') {
			$builder->expr()->in($table.'.pid', $pidlist);
		}

		/* If a languageField is available for the table, use it */
		if (array_key_exists('languageField', (array)$GLOBALS ['TCA'] [$table] ['ctrl'])) {
			$languageField = $GLOBALS ['TCA'] [$table] ['ctrl'] ['languageField'];
			$builder->expr()->in($table.'.'.$languageField, [-1, 0]);
		}

		if (!empty($groupBy)) {
			$builder->groupBy($groupBy);
		}

		if (!empty($limit)) {
			$builder->setMaxResults(intval($limit));
		}

		$builder->select('*')
			->from($table)
			->where('1=1 '.$where);

		return $builder->execute();
	}
}

?>