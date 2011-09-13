<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2005-2007 Mario Matzulla
 * (c) 2005-2007 Foundation for Evangelism
 * All rights reserved
 *
 * This file is part of the Web-Empowered Church (WEC)
 * (http://webempoweredchurch.org) ministry of the Foundation for Evangelism
 * (http://evangelize.org). The WEC is developing TYPO3-based
 * (http://typo3.org) free software for churches around the world. Our desire
 * is to use the Internet to help offer new life through Jesus Christ. Please
 * see http://WebEmpoweredChurch.org/Jesus.
 *
 * You can redistribute this file and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software Foundation;
 * either version 2 of the License, or (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This file is distributed in the hope that it will be useful for ministry,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the file!
 ***************************************************************/

require_once (t3lib_extMgm :: extPath('cal').'view/class.tx_cal_fe_editing_base_view.php');
require_once (t3lib_extMgm :: extPath('cal').'controller/class.tx_cal_calendar.php');
require_once (t3lib_extMgm :: extPath('cal').'controller/class.tx_cal_functions.php');
require_once (t3lib_extMgm :: extPath('cal').'model/class.tx_cal_phpicalendar_model.php');

/**
 * A service which renders a form to confirm the phpicalendar event create/edit.
 *
 * @author Mario Matzulla <mario(at)matzullas.de>
 */
class tx_cal_confirm_event_view extends tx_cal_fe_editing_base_view {
	
	var $confArr = array();
	
	function tx_cal_confirm_event_view(){
		$this->tx_cal_fe_editing_base_view();
	}
	
	/**
	 *  Draws a confirm event form.
	 *  @param      object      The cObject of the mother-class
	 *  @param		object		The rights object.
	 *	@return		string		The HTML output.
	 */
	function drawConfirmEvent() {
		$this->objectString = 'event';
		$this->isConfirm = true;
		unset($this->controller->piVars['formCheck']);
	
		/* @fixme		Temporarily reverted to using piVars rather than conf */
		//unset($this->controller->piVars['category']);
		$page = $this->cObj->fileResource($this->conf['view.']['confirm_event.']['template']);
		if ($page == '') {
			return '<h3>calendar: no confirm event template file found:</h3>'.$this->conf['view.']['confirm_event.']['template'];
		}
		$this->lastPiVars = $this->controller->piVars;
		$this->confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['cal']);

		$this->object = new tx_cal_phpicalendar_model(null, false, '');
		$this->object->updateWithPIVars($this->controller->piVars);
				
		$lastViewParams = $this->controller->shortenLastViewAndGetTargetViewParameters();

		if($lastViewParams['view']=='edit_event'){
			$this->isEditMode = true;
		}

		$rems = array();
		$sims = array();
		$wrapped = array();
		$sims['###UID###'] = $this->conf['uid'];
		$sims['###TYPE###'] = $this->conf['type'];
		$sims['###LASTVIEW###'] = $lastViewParams['lastview'];
		$sims['###OPTION###'] = $this->conf['option'];
		//$sims['###CALENDAR_ID###'] = intval($this->controller->piVars['calendar_id']);
		$sims['###L_CONFIRM_EVENT###'] = $this->controller->pi_getLL('l_confirm_event');
		$sims['###L_SAVE###'] = $this->controller->pi_getLL('l_save');
		$sims['###L_CANCEL###'] = $this->controller->pi_getLL('l_cancel');
		$this->controller->pi_linkTP('|',array('tx_cal_controller[view]'=>'save_event','tx_cal_controller[category]'=>null));
		$sims['###ACTION_URL###'] = $this->cObj->lastTypoLinkUrl;
		
		$this->getTemplateSubpartMarker($page, $sims, $rems, $wrapped);
		$page = $this->cObj->substituteMarkerArrayCached($page, array(), $rems, $wrapped);
		$page = $this->cObj->substituteMarkerArrayCached($page, $sims, array(), array ());
		$sims = array();
		$rems = array();
		$wrapped = array();
		$this->getTemplateSingleMarker($page, $sims, $rems, $wrapped);
		$page = $this->cObj->substituteMarkerArrayCached($page, array(), $rems, $wrapped);;
		$page = $this->cObj->substituteMarkerArrayCached($page, $sims, array(), array ());
		return $this->cObj->substituteMarkerArrayCached($page, $sims, array(), array ());
	}
	
	function getTitleMarker(& $template, & $sims, & $rems) {
		$sims['###TITLE###'] = '';
		if($this->isAllowed('title')) {
			$sims['###TITLE###'] = $this->applyStdWrap($this->object->getTitle(), 'title_stdWrap');
			$sims['###TITLE_VALUE###'] = htmlspecialchars($this->object->getTitle());
		}
	}

	function getCalendarIdMarker(& $template, & $sims, & $rems){
		$sims['###CALENDAR_ID###'] = '';
		if($this->isAllowed('calendar_id')) {			
			$calendar = $this->object->getCalendarObject();
			$sims['###CALENDAR_ID###'] = $this->applyStdWrap($calendar->getTitle(),'calendar_id_stdWrap');
			$sims['###CALENDAR_ID_VALUE###'] = htmlspecialchars($calendar->getUID());
		}
	}
	
	function getCategoryMarker(& $template, & $sims, & $rems){
		$sims['###CATEGORY###'] = '';
		$categoryArray = $this->object->getCategories();
		if($this->isAllowed('category')){
			if(!empty($categoryArray)) {
				$temp = $this->cObj->getSubpart($template, '###FORM_CATEGORY###');
				$catIds = explode(',',$piVarCategory);
				$ids = array();
				$names = array();
				foreach ($categoryArray as $category) {
					$ids[] = $category->getUid();
					$names[] = $category->getTitle();
				}
				$sims['###CATEGORY###'] = $this->applyStdWrap(implode(', ',$names), 'category_stdWrap');
				$sims['###CATEGORY_VALUE###'] = htmlspecialchars(implode(',',$ids));
			}
		}
	}
	
	function getAlldayMarker(& $template, & $sims, & $rems){
		$sims['###ALLDAY###'] = '';
		if($this->isAllowed('allday')){
			$allday = false;
			$label = $this->controller->pi_getLL('l_false');
			if ($this->object->isAllDay() == '1') {
				$allday = 1;
				$label = $this->controller->pi_getLL('l_true');
			}
			$sims['###ALLDAY###'] = $this->applyStdWrap($label, 'allday_stdWrap');
			$sims['###ALLDAY_VALUE###'] = htmlspecialchars($allday ? 1 : 0);
		}
	}
	
	function getStartdateMarker(& $template, & $sims, & $rems){
		$sims['###STARTDATE###'] = '';
		if($this->isAllowed('startdate')){
			$startDate = $this->object->getStart();
			$split = $this->conf['dateConfig.']['splitSymbol'];
			$startDateFormatted = $startDate->format(getFormatStringFromConf($this->conf));
			$dateFormatArray = explode($this->conf['dateConfig.']['splitSymbol'], $startDateFormatted);
			$sims['###STARTDATE###'] = $this->applyStdWrap($startDateFormatted, 'startdate_stdWrap');
			$sims['###STARTDATE_VALUE###'] = htmlspecialchars($dateFormatArray[$this->conf['dateConfig.']['yearPosition']].$dateFormatArray[$this->conf['dateConfig.']['monthPosition']].$dateFormatArray[$this->conf['dateConfig.']['dayPosition']]);
		}
	}
	
	function getEnddateMarker(& $template, & $sims, & $rems){
		$sims['###ENDDATE###'] = '';
		if($this->isAllowed('enddate')){
			$endDate = $this->object->getEnd();
			$split = $this->conf['dateConfig.']['splitSymbol'];
			$endDateFormatted = $endDate->format(getFormatStringFromConf($this->conf));			
			$dateFormatArray = explode($this->conf['dateConfig.']['splitSymbol'], $endDateFormatted);
			$sims['###ENDDATE###'] = $this->applyStdWrap($endDateFormatted, 'enddate_stdWrap');
			$sims['###ENDDATE_VALUE###'] = htmlspecialchars($dateFormatArray[$this->conf['dateConfig.']['yearPosition']].$dateFormatArray[$this->conf['dateConfig.']['monthPosition']].$dateFormatArray[$this->conf['dateConfig.']['dayPosition']]);
		}
	}
	
	function getStarttimeMarker(& $template, & $sims, & $rems){
		$sims['###STARTTIME###'] = '';
		if($this->isAllowed('starttime')){
			$startDate = $this->object->getStart();
			$sims['###STARTTIME###'] = $this->applyStdWrap($startDate->format($this->conf['view.']['event.']['event.']['timeFormat']), 'starttime_stdWrap');
			$sims['###STARTTIME_VALUE###'] = htmlspecialchars($startDate->format("%H%M"));
		}
	}
	
	function getEndtimeMarker(& $template, & $sims, & $rems){
		$sims['###ENDTIME###'] = '';
		if($this->isAllowed('endtime')){
			$endDate = $this->object->getEnd();
			$sims['###ENDTIME###'] = $this->applyStdWrap($endDate->format($this->conf['view.']['event.']['event.']['timeFormat']), 'endtime_stdWrap');
			$sims['###ENDTIME_VALUE###'] = htmlspecialchars($endDate->format("%H%M"));
		}
	}
	
	function getOrganizerMarker(& $template, & $sims, & $rems){
		$sims['###ORGANIZER###'] = '';
		if(!$this->confArr['hideOrganizerTextfield'] && $this->isAllowed('organizer')){
			$sims['###ORGANIZER###'] = $this->applyStdWrap($this->object->getOrganizer(), 'organizer_stdWrap');
			$sims['###ORGANIZER_VALUE###'] = htmlspecialchars($this->object->getOrganizer());
		}
	}
	
	function getCalOrganizerMarker(& $template, & $sims, & $rems){	
		$sims['###CAL_ORGANIZER###'] = '';
		if($this->isAllowed('cal_organizer')){
			if($organizer = $this->object->getOrganizerObject()){
				$sims['###CAL_ORGANIZER###'] = $this->applyStdWrap($organizer->getName(), 'cal_organizer_stdWrap');
				$sims['###CAL_ORGANIZER_VALUE###'] = htmlspecialchars($organizer->getUid());
			}
		}
	}
	
	function getLocationMarker(& $template, & $sims, & $rems){
		$sims['###LOCATION###'] = '';
		if(!$this->confArr['hideLocationTextfield'] && $this->isAllowed('location')){
			$sims['###LOCATION###'] = $this->applyStdWrap($this->object->getLocation(), 'location_stdWrap');
			$sims['###LOCATION_VALUE###'] = htmlspecialchars($this->object->getLocation());
		}
	}
	
	function getCalLocationMarker(& $template, & $sims, & $rems){	
		$sims['###CAL_LOCATION###'] = '';
		if($this->isAllowed('cal_location')){
			if($location = $this->object->getLocationObject()){
				$sims['###CAL_LOCATION###'] = $this->applyStdWrap($location->getName(), 'cal_location_stdWrap');
				$sims['###CAL_LOCATION_VALUE###'] = htmlspecialchars($location->getUid());
			}
		}
	}
	
	function getDescriptionMarker(& $template, & $sims, & $rems){
		$sims['###DESCRIPTION###'] = '';
		if($this->isAllowed('description')) {
			$sims['###DESCRIPTION###'] = $this->applyStdWrap($this->object->getDescription(), 'description_stdWrap');
			$sims['###DESCRIPTION_VALUE###'] = htmlspecialchars($this->object->getDescription());
		}
	}
	
	function getTeaserMarker(& $template, & $sims, & $rems){
		$sims['###TEASER###'] = '';
		
		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['cal']);
		if($confArr['useTeaser'] && $this->isAllowed('teaser')){
			$sims['###TEASER###'] = $this->applyStdWrap($this->object->getTeaser(), 'teaser_stdWrap');
			$sims['###TEASER_VALUE###'] = htmlspecialchars($this->object->getTeaser());
		}
	}
	
	function getFrequencyMarker(& $template, & $sims, & $rems){
		$sims['###FREQUENCY###'] = '';
		if($this->isAllowed('frequency')){
			$sims['###FREQUENCY###'] = $this->applyStdWrap($this->object->getFreq(), 'frequency_stdWrap');
			$sims['###FREQUENCY_VALUE###'] = htmlspecialchars($this->object->getFreq());
		}
	}
	
	function getByDayMarker(& $template, & $sims, & $rems){
		$sims['###BY_DAY###'] = '';
		if($this->isAllowed('recurring')){
			$byDayString = implode(',', $this->object->getByDay());
			$sims['###BY_DAY###'] = $this->applyStdWrap($byDayString, 'byDay_stdWrap');
			$sims['###BY_DAY_VALUE###'] = htmlspecialchars($byDayString);
		}
	}
	
	function getByMonthDayMarker(& $template, & $sims, & $rems){
		$sims['###BY_MONTHDAY###'] = '';
		if($this->isAllowed('recurring')){
			$byMonthDayString = implode(',', $this->object->getByMonthDay());
			$sims['###BY_MONTHDAY###'] = $this->applyStdWrap($byMonthDayString, 'byMonthday_stdWrap');
			$sims['###BY_MONTHDAY_VALUE###'] = htmlspecialchars($byMonthDayString);
		}
	}
	
	function getByMonthMarker(& $template, & $sims, & $rems){
		$sims['###BY_MONTH###'] = '';
		if($this->isAllowed('recurring')){
			$byMonthString = implode(',', $this->object->getByMonth());
			$sims['###BY_MONTH###'] = $this->applyStdWrap($byMonthString, 'byMonth_stdWrap');
			$sims['###BY_MONTH_VALUE###'] = htmlspecialchars($byMonthString);
		}
	}
	
	function getUntilMarker(& $template, & $sims, & $rems){
		$sims['###UNTIL###'] = '';
		if($this->isAllowed('recurring')){
			$untilDate = $this->object->getUntil();
			if(is_object($untilDate)) {
				$untilDateFormatted = '';
				$sims['###UNTIL_VALUE###'] = '';
				if($untilDate->getYear()>0){
					$split = $this->conf['dateConfig.']['splitSymbol'];
					$untilDateFormatted = $untilDate->format(getFormatStringFromConf($this->conf));
					$dateFormatArray = explode($this->conf['dateConfig.']['splitSymbol'], $untilDateFormatted);
					$sims['###UNTIL_VALUE###'] = htmlspecialchars($dateFormatArray[$this->conf['dateConfig.']['yearPosition']].$dateFormatArray[$this->conf['dateConfig.']['monthPosition']].$dateFormatArray[$this->conf['dateConfig.']['dayPosition']]);
				}
				$sims['###UNTIL###'] = $this->applyStdWrap($untilDateFormatted, 'until_stdWrap');
				
			}
		}
	}
	
	function getCountMarker(& $template, & $sims, & $rems){
		$sims['###COUNT###'] = '';
		if($this->isAllowed('recurring')){
			$sims['###COUNT###'] = $this->applyStdWrap($this->object->getCount(), 'count_stdWrap');
			$sims['###COUNT_VALUE###'] = htmlspecialchars($this->object->getCount());
		}
	}
	
	function getIntervalMarker(& $template, & $sims, & $rems){
		$sims['###INTERVAL###'] = '';
		if($this->isAllowed('recurring')){
			$sims['###INTERVAL###'] = $this->applyStdWrap($this->object->getInterval(), 'interval_stdWrap');
			$sims['###INTERVAL_VALUE###'] = htmlspecialchars($this->object->getInterval());
		}
	}
	
	function getNotifyMarker(& $template, & $sims, & $rems){
		$sims['###NOTIFY###'] = '';
		if($this->isAllowed('notify') && is_array($this->controller->piVars['notify'])) {
			$notifydisplaylist = Array();
			$notifyids = Array();
			foreach ($this->controller->piVars['notify'] as $value) {
				preg_match('/(^[a-z])_([0-9]+)_(.*)/', $value, $idname);
				if($idname[1]=='u' || $idname[1]=='g'){
					$notifyids[] = $idname[1].'_'.$idname[2];
					$notifydisplaylist[] = $idname[3];
				}
			}
			$sims['###NOTIFY###'] = $this->applyStdWrap(implode(',', $notifydisplaylist), 'notify_stdWrap');
			$sims['###NOTIFY_VALUE###'] = htmlspecialchars(implode(',',$notifyids));
		}
	}
	
	function getSharedMarker(& $template, & $sims, & $rems){
		$sims['###SHARED###'] = '';
		if($this->isAllowed('shared') && is_array($this->controller->piVars['shared'])) {
			$shareddisplaylist = Array();
			$sharedids = Array();
			foreach ($this->controller->piVars['shared'] as $value) {
				preg_match('/(^[a-z])_([0-9]+)_(.*)/', $value, $idname);
				if($idname[1]=='u' || $idname[1]=='g'){
					$sharedids[] = $idname[1].'_'.$idname[2];
					$shareddisplaylist[] = $idname[3];
				}
			}
			$sims['###SHARED###'] = $this->applyStdWrap(implode(',',$shareddisplaylist), 'shared_stdWrap');
			$sims['###SHARED_VALUE###'] = htmlspecialchars(implode(',',$sharedids));
		}
	}	
	
	function getExceptionMarker(& $template, & $sims, & $rems){
		$sims['###EXCEPTION###'] = '';
		if($this->isAllowed('exception') && is_array($this->controller->piVars['exception_ids'])) {
			$exceptiondisplaylist = Array();
			$exceptionids = Array();
			foreach ($this->controller->piVars['exception_ids'] as $value) {
				preg_match('/(^[a-z])_([0-9]+)_(.*)/', $value, $idname);
				if ($idname[1] == 'u' || $idname[1] == 'g') {
					$exceptionids[] = $idname[1].'_'.$idname[2];
					$exceptiondisplaylist[] = $idname[3];
				}
			}
			$sims['###EXCEPTION###'] = $this->applyStdWrap(implode(',',$exceptiondisplaylist), 'exception_stdWrap');
			$sims['###EXCEPTION_VALUE###'] = htmlspecialchars(implode(',',$exceptionids));
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cal/view/class.tx_cal_confirm_event_view.php']) {
	include_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cal/view/class.tx_cal_confirm_event_view.php']);
}
?>
