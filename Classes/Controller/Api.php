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
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * API for calendar base (cal)
 *
 * @author Mario Matzulla <mario@matzullas.de>
 * @package TYPO3
 * @subpackage cal
 */
class Api {
	/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer */
	var $cObj;
	/** @var \TYPO3\CMS\Cal\Service\RightsService */
	var $rightsObj;
	/** @var \TYPO3\CMS\Cal\Controller\ModelController */
	var $modelObj;
	/** @var \TYPO3\CMS\Cal\Controller\ViewController */
	var $viewObj;
	/** @var \TYPO3\CMS\Cal\Controller\Controller */
	var $controller;
	/** @var array */
	var $conf;
	/** @var string */
	var $prefixId = 'tx_cal_controller';
	/** @var bool */
	var $unsetTSFEOnDestruct = false;
	/** @var ConnectionPool $connectionPool */
	var $connectionPool;

	public function __construct() {
		$this->connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
	}

	/**
	 * Example:
	 * require_once ('class.tx_cal_api.php');
	 * $calAPI = new Api($this->cObj, &$conf);
	 * $event = $calAPI->findEvent('2','tx_cal_phpicalendar');
	 */
	public function tx_cal_api_with(&$cObj, &$conf) {
		$this->cObj = &$cObj;
		$this->conf = &$conf;
		if (!$GLOBALS ['TCA']) {
			$GLOBALS ['TSFE']->includeTCA();
		}

		$this->conf ['useInternalCaching'] = 1;
		$this->conf ['cachingEngine'] = 'cachingFramework';
		$this->conf ['writeCachingInfoToDevlog'] = 0;

		$GLOBALS ['TSFE']->settingLocale();


		$this->controller = GeneralUtility::makeInstance(\TYPO3\CMS\Cal\Controller\Controller::class);
		$this->controller->cObj = &$this->cObj;
		$this->controller->conf = &$this->conf;

		$this->controller->setWeekStartDay();

		$this->controller->cleanPiVarParam($this->piVars);
		$this->controller->clearPiVarParams();
		$this->controller->getParamsFromSession();
		$this->controller->initCaching();
		$this->controller->initConfigs();

		\TYPO3\CMS\Cal\Utility\Registry::init($this->controller);
		$this->rightsObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry('basic', 'rightscontroller');
		$this->rightsObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstanceService('cal_rights_model', 'rights');
		$this->rightsObj->setDefaultSaveToPage();

		$this->modelObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry('basic', 'modelcontroller');
		$this->modelObj = new \TYPO3\CMS\Cal\Controller\ModelController();

		$this->viewObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry('basic', 'viewcontroller');
		$this->viewObj = GeneralUtility::makeInstance(\TYPO3\CMS\Cal\Controller\ViewController::class);

		/*
		 * $this->rightsObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry('basic','rightscontroller');
		 * $this->modelObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry('basic','modelcontroller');
		 * $this->viewObj = &\TYPO3\CMS\Cal\Utility\Registry::Registry('basic','viewcontroller');
		 */
		return $this;
	}

	public function tx_cal_api_without($pid, $feUserObj = '') {
		$cObj = new \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer();

		$GLOBALS ['TT'] = new \TYPO3\CMS\Core\TimeTracker\TimeTracker ();

		// ***********************************
		// Creating a fake $TSFE object
		// ***********************************
		$this->unsetTSFEOnDestruct = true;

		$GLOBALS ['TSFE'] = GeneralUtility::makeInstance(\TYPO3\CMS\Cal\Controller\Tsfe::class,
			$GLOBALS ['TYPO3_CONF_VARS'], $pid, '0', 1, '', '', '', '');
		$GLOBALS ['TSFE']->connectToDB();
		if ($feUserObj == '') {
			$GLOBALS ['TSFE']->initFEuser();
		} else {
			$GLOBALS ['TSFE']->fe_user = &$feUserObj;
		}

		$GLOBALS ['TSFE']->fetch_the_id();
		$GLOBALS ['TSFE']->getPageAndRootline();
		$GLOBALS ['TSFE']->initTemplate();
		$GLOBALS ['TSFE']->tmpl->getFileName_backPath = PATH_site;
		$GLOBALS ['TSFE']->forceTemplateParsing = 1;
		$GLOBALS ['TSFE']->getConfigArray();
		$GLOBALS ['TSFE']->settingLocale();

		// we need to get the plugin setup to create correct source URLs
		$template = new \TYPO3\CMS\Core\TypoScript\ExtendedTemplateService(); // Defined global here!
		$template->tt_track = 0;
		// Do not log time-performance information
		$template->init();
		$sys_page = new \TYPO3\CMS\Frontend\Page\PageRepository();
		$rootLine = $sys_page->getRootLine($pid);
		$template->runThroughTemplates($rootLine); // This generates the constants/config + hierarchy info for the template.
		$template->generateConfig(); //
		$conf = $template->setup ['plugin.'] ['tx_cal_controller.'];

		// get the calendar plugin record where starting pages value is the same
		// as the pid
		$where = [
			'tt_content.list_type' => 'cal_controller',
			'tt_content.deleted'   => 0,
			'tt_content.pid'       => $pid
		];

		$connection = $this->connectionPool->getConnectionForTable('tt_content');
		$tt_content_row = $connection->select(['*'], 'tt_content', $where)
			->fetch(FetchMode::ASSOCIATIVE);

		// if starting point didn't return any records, look for general records
		// storage page.
		if (!$tt_content_row) {
			$builder = $this->connectionPool->getQueryBuilderForTable('tt_content');
			$builder->select('*')->from('tt_content')
				->join('tt_content', 'pages', 'P', 'tt_content.pid = P.uid');

			foreach ($where as $identifier => $value) {
				$builder->andWhere($builder->expr()->eq($identifier, $builder->createNamedParameter($value)));
			}

			$tt_content_row = $builder->execute()->fetch(FetchMode::ASSOCIATIVE);
		}

		if ($tt_content_row ['pages']) {
			// $conf['pages'] = $tt_content_row['pages'];
			$cObj->data = $tt_content_row;
		}

		return $this->tx_cal_api_with($cObj, $conf);
	}

	/**
	 * Destructor to clean up when we're done with the API object.
	 *
	 * @return void
	 */
	public function __destruct() {
		// If we created our own TSFE object earlier, get rid of it so that we don't interfere with other scripts.
		if ($this->unsetTSFEOnDestruct) {
			unset ($GLOBALS ['TSFE']);
		}
	}

	public function findEvent($uid, $type, $pidList = '') {
		return $this->modelObj->findEvent($uid, $type, $pidList);
	}

	public function saveEvent($uid, $type, $pidList = '') {
		return $this->modelObj->saveEvent($uid, $type, $pidList);
	}

	public function removeEvent($uid, $type) {
		return $this->modelObj->removeEvent($uid, $type);
	}

	public function saveExceptionEvent($uid, $type, $pidList = '') {
		return $this->modelObj->saveExceptionEvent($uid, $type, $pidList);
	}

	public function findLocation($uid, $type, $pidList = '') {
		return $this->modelObj->findLocation($uid, $type, $pidList);
	}

	public function findAllLocations($type = '', $pidList = '') {
		return $this->modelObj->findAllLocations($type, $pidList);
	}

	public function saveLocation($uid, $type, $pidList = '') {
		return $this->modelObj->saveLocation($uid, $type, $pidList);
	}

	public function removeLocation($uid, $type) {
		return $this->modelObj->removeLocation($uid, $type);
	}

	public function findOrganizer($uid, $type, $pidList = '') {
		return $this->modelObj->findOrganizer($uid, $type, $pidList);
	}

	public function findCalendar($uid, $type, $pidList = '') {
		return $this->modelObj->findCalendar($uid, $type, $pidList);
	}

	public function findAllCalendar($type = '', $pidList = '') {
		return $this->modelObj->findAllCalendar($type, $pidList);
	}

	public function findAllOrganizer($type = '', $pidList = '') {
		return $this->modelObj->findAllOrganizer($type, $pidList);
	}

	public function saveOrganizer($uid, $type, $pidList = '') {
		return $this->modelObj->saveOrganizer($uid, $type, $pidList);
	}

	public function removeOrganizer($uid, $type) {
		return $this->modelObj->removeOrganizer($uid, $type);
	}

	public function saveCalendar($uid, $type, $pidList = '') {
		return $this->modelObj->saveCalendar($uid, $type, $pidList);
	}

	public function removeCalendar($uid, $type) {
		return $this->modelObj->removeCalendar($uid, $type);
	}

	public function saveCategory($uid, $type, $pidList = '') {
		return $this->modelObj->saveCategory($uid, $type, $pidList);
	}

	public function removeCategory($uid, $type) {
		return $this->modelObj->removeCategory($uid, $type);
	}

	public function findEventsWithin($startTimestamp, $endTimestamp, $type = '', $pidList = '') {
		return $this->modelObj->findAllWithin('cal_event_model', $startTimestamp, $endTimestamp, $type, 'event', $pidList);
	}

	public function findEventsForDay($timestamp, $type = '', $pidList = '') {
		return $this->modelObj->findEventsForDay($timestamp, $type, $pidList);
	}

	public function findEventsForWeek($timestamp, $type = '', $pidList = '') {
		return $this->modelObj->findEventsForWeek($timestamp, $type, $pidList);
	}

	public function findEventsForMonth($timestamp, $type = '', $pidList = '') {
		return $this->modelObj->findEventsForMonth($timestamp, $type, $pidList);
	}

	public function findEventsForYear($timestamp, $type = '', $pidList = '') {
		return $this->modelObj->findEventsForYear($timestamp, $type, $pidList);
	}

	public function findEventsForList($timestamp, $type = '', $pidList = '') {
		return $this->modelObj->findEventsForList($timestamp, $type, $pidList);
	}

	public function findCategoriesForList($type = '', $pidList = '') {
		return $this->modelObj->findCategoriesForList($type, $pidList);
	}

	public function findEventsForIcs($timestamp, $type, $pidList) {
		return $this->modelObj->findEventsForIcs($timestamp, $type, $pidList);
	}

	public function searchEvents($type = '', $pidList = '') {
		return $this->modelObj->searchEvents($type, $pidList);
	}

	public function searchLocation($type = '', $pidList = '') {
		return $this->modelObj->searchLocation($type, $pidList);
	}

	public function searchOrganizer($type = '', $pidList = '') {
		return $this->modelObj->searchOrganizer($type, $pidList);
	}

	public function drawIcs($master_array, $getdate, $sendHeaders = true) {
		return $this->viewObj->drawIcs($master_array, $getdate, $sendHeaders);
	}

	/**
	 * process the Typoscript array to final output
	 * Note: Part of the code is taken from tsobj written by Jean-David Gadina (macmade@gadlab.net)
	 *
	 * @param string The Typoscrypt Object to process
	 * @param string The content between the tags to be merged with the TS Objected
	 * @return string Processed ooutput of the TS
	 * TODO: remove me!
	 */
	private function __processTSObject($tsObjPath, $tag_content) {
		// Check for a non empty value
		if ($tsObjPath) {

			// Get complete TS template
			$tsObj = &$this->__TSTemplate->setup;

			// Get TS object hierarchy in template
			$tmplPath = explode('.', $tsObjPath);
			// Process TS object hierarchy
			$error = 0;
			for ($i = 0; $i < count($tmplPath); $i++) {

				// Try to get content type
				$cType = $tsObj [$tmplPath [$i]];

				// Try to get TS object configuration array
				$tsNewObj = $tsObj [$tmplPath [$i].'.'];

				// Merge Configuration found in the tags with typoscript config
				if (count($tag_content)) {
					$tsNewObj = $this->array_merge_recursive2($tsNewObj, $tag_content [$tsObjPath.'.']);
				}

				// Check object
				if (!$cType && !$tsNewObj) {
					// Object doesn't exist
					$error = 1;
					break;
				}
			}

			// DEBUG ONLY - Show TS object
			// \TYPO3\CMS\Core\Utility\GeneralUtility::debug($cType, 'CONTENT TYPE');
			// \TYPO3\CMS\Core\Utility\GeneralUtility::debug($tsObj, 'TS CONFIGURATION');

			// Check object and content type
			if ($error) {

				// Object not found
				return '<strong>Not Found</strong> ('.$tsObjPath.')';
			} elseif ($this->cTypes [$cType]) {
				// Render Object
				$code = $this->__local_cObj->cObjGetSingle($cType, $tsNewObj);
			} else {

				// Invalid content type
				return '<strong>errors.invalid</strong> ('.$cType.')';
			}

			// Return object
			return $code;
		}
	}

	/**
	 * Returns current PageRenderer
	 *
	 * @return PageRenderer
	 */
	protected function getPageRenderer() {
		return GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
	}
}

?>