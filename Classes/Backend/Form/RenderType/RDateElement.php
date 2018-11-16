<?php
declare(strict_types=1);

namespace TYPO3\CMS\Cal\Backend\Form\RenderType;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;

class RDateElement extends AbstractFormElement {

	public function render() {
		ElementHelper::init();

		$result = $this->initializeResultArray();

		$table = $this->data['tableName'];
		$row = $this->data['databaseRow'];

		$uid = $row['uid'];

		$rdateType = $row['rdate_type'][0];
		$rdateValues = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $row['rdate'], 1);

		$out = [];

		$jsDate = $GLOBALS ['TYPO3_CONF_VARS'] ['SYS'] ['USdateFormat'] ? '%m-%d-%Y' : '%d-%m-%Y';

		$key = 0;
		foreach ($rdateValues as $value) {
			$formatedValue = '';
			$splittedPeriod = Array('', '');
			if ($value !== '') {
				$splittedPeriod = explode('/', $value);
				$splittedDateTime = explode('T', $splittedPeriod [0]);
				if ($jsDate == '%d-%m-%Y') {
					$formatedValue = substr($splittedDateTime [0], 6, 2).'-'.
						substr($splittedDateTime [0], 4, 2).'-'.
						substr($splittedDateTime [0], 0, 4);
				} else {
					if ($jsDate == '%m-%d-%Y') {
						$formatedValue = substr($splittedDateTime [0], 4, 2).'-'.
							substr($splittedDateTime [0], 6, 2).'-'.
							substr($splittedDateTime [0], 0, 4);
					} else {
						$formatedValue = 'unknown date format';
					}
				}
				if ($rdateType == 'date_time' || $rdateType == 'period') {
					$formatedValue = count($splittedDateTime) == 2 ?
							substr($splittedDateTime [1], 0, 2).':'.substr($splittedDateTime [1], 2, 2).' '.	$formatedValue :
							'00:00 '.$formatedValue;
				}
			}
			$params = [
				'table' => $table,
				'uid' => $uid,
				'field' => 'rdate'.$key,
				'md5ID' => $table.'_'.$uid.'_'.'rdate'.$key
			];

			if ($rdateType == 'date_time' || $rdateType == 'period') {
				$out [] = '<div class="form-control-wrap" style="max-width: 192px">
					<div class="input-group">
					    <input type="hidden" value="'.$formatedValue.'" id="data_'.$table.'_'.$uid.'_rdate'.$key.'" />
						<div class="form-control-clearable">
					        <input data-date-type="datetime" onblur="rdateChanged();" onchange="rdateChanged();" 
					        	data-formengine-validation-rules="[{&quot;type&quot;:&quot;datetime&quot;,&quot;config&quot;:{&quot;type&quot;:&quot;input&quot;,&quot;size&quot;:&quot;13&quot;,&quot;default&quot;:&quot;0&quot;}}]" data-formengine-input-params="{&quot;field&quot;:&quot;data['.$table.']['.$uid.'][rdate'.$key.'_hr]&quot;,&quot;evalList&quot;:&quot;datetime&quot;,&quot;is_in&quot;:&quot;&quot;}" data-formengine-input-name="data['.$table.']['.$uid.'][rdate'.$key.'_hr]" id="tceforms-datetimefield-data_'.$table.'_'.$uid.'_rdate'.$key.'_hr" value="'.$formatedValue.'" maxlength="20" class="t3js-datetimepicker form-control t3js-clearable hasDefaultValue" type="text">
						</div>
					</div>
				</div>';
			} else {
				$out [] = '<div class="form-control-wrap" style="max-width: 192px">
					<div class="input-group">
					    <input type="hidden" value="'.$formatedValue.'" id="data_'.$table.'_'.$uid.'_rdate'.$key.'" />
						<div class="form-control-clearable">
					        <input data-date-type="date" onblur="rdateChanged();" onchange="rdateChanged();" data-formengine-validation-rules="[{&quot;type&quot;:&quot;date&quot;,&quot;config&quot;:{&quot;type&quot;:&quot;input&quot;,&quot;size&quot;:&quot;12&quot;,&quot;max&quot;:&quot;20&quot;}}]" '.
					'data-formengine-input-params="{&quot;field&quot;:&quot;data['.$table.']['.$uid.'][rdate'.$key.'_hr]&quot;,&quot;evalList&quot;:&quot;date&quot;,&quot;is_in&quot;:&quot;&quot;}" '.
					'data-formengine-input-name="data['.$table.']['.$uid.'][rdate'.$key.'_hr]" id="tceforms-datefield-data_'.$table.'_'.$uid.'_rdate'.$key.'_hr" value="'.$formatedValue.'" maxlength="20" class="t3js-datetimepicker form-control t3js-clearable hasDefaultValue" type="text">
							<button style="display: none;" type="button" class="close" tabindex="-1" aria-hidden="true" onclick="rdateChanged();">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</div>';
			}
			if ($rdateType == 'date') {
				$params ['wConf'] ['evalValue'] = 'date';
			} else {
				if ($rdateType == 'date_time' || $rdateType == 'period') {
					$params ['wConf'] ['evalValue'] = 'datetime';
				}
			}
			if ($rdateType == 'period') {
				$periodArray = array();
				preg_match('/P((\d+)Y)?((\d+)M)?((\d+)W)?((\d+)D)?T((\d+)H)?((\d+)M)?((\d+)S)?/', $splittedPeriod [1], $periodArray);
				$params ['item'] .= '<span style="padding-left:10px;">'.$GLOBALS['LANG']->getLL('l_duration').':</span>'.$GLOBALS['LANG']->getLL('l_year').
					':<input type="text" value="'.intval($periodArray [2]).'" name="rdateYear'.$key.'" id="rdateYear'.$key.'" size="2" onchange="rdateChanged();" />'.$GLOBALS['LANG']->getLL('l_month').
					':<input type="text" value="'.intval($periodArray [4]).'" name="rdateMonth'.$key.'" id="rdateMonth'.$key.'" size="2" onchange="rdateChanged();" />'.$GLOBALS['LANG']->getLL('l_week').
					':<input type="text" value="'.intval($periodArray [6]).'" name="rdateWeek'.$key.'" id="rdateWeek'.$key.'" size="2" onchange="rdateChanged();" />'.$GLOBALS['LANG']->getLL('l_day').
					':<input type="text" value="'.intval($periodArray [8]).'" name="rdateDay'.$key.'" id="rdateDay'.$key.'" size="2" onchange="rdateChanged();" />'.$GLOBALS['LANG']->getLL('l_hour').
					':<input type="text" value="'.intval($periodArray [10]).'" name="rdateHour'.$key.'" id="rdateHour'.$key.'" size="2" onchange="rdateChanged();" />'.$GLOBALS['LANG']->getLL('l_minute').
					':<input type="text" value="'.intval($periodArray [12]).'" name="rdateMinute'.$key.'" id="rdateMinute'.$key.'" size="2" onchange="rdateChanged();" />'.
					'<br/>';
			}
			$out [] = $params ['item'];

			$key++;
		}
print_r($out);
		$out [] = '<input type="hidden" name="data['.$table.']['.$uid.'][rdate]" id="data['.$table.']['.$uid.'][rdate]" value="'.$row ['rdate'].'" />';

		$rDateCount = count($rdateValues);

		$callback = <<< EOJ
function(RDate) {
	window.rDate = new RDate('$jsDate', '$table', $uid, '$rdateType', $rDateCount);
}
EOJ;

		$result['html'] = implode("\n", $out);
		$result['requireJsModules'][] = ['TYPO3/CMS/Cal/RDate' => $callback];

		return $result;
	}

}
