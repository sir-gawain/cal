<?php
declare(strict_types=1);

namespace TYPO3\CMS\Cal\Backend\Form\RenderType;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Backend\Form\NodeFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class RDateElement extends AbstractFormElement {

	public function render() {
		ElementHelper::init();

		$result = $this->initializeResultArray();

		$table = $this->data['tableName'];
		$row = $this->data['databaseRow'];

		$uid = $row['uid'];

		$rdateType = $row['rdate_type'][0];
		$rdateValues = GeneralUtility::trimExplode(',', $row['rdate'], 1);

		// add for new empty line
		$rdateValues[] = '';

		$out = [];

		$jsDate = $GLOBALS ['TYPO3_CONF_VARS'] ['SYS'] ['USdateFormat'] ? '%m-%d-%Y' : '%d-%m-%Y';

		/** @var NodeFactory $nodefactory */
		$nodefactory = GeneralUtility::makeInstance(NodeFactory::class);

		$key = 0;
		foreach ($rdateValues as $value) {
			$formatedValue = '';
			$splittedPeriod = Array('', '');

			if ($value !== '') {
				$splittedPeriod = explode('/', $value);

				$m = array();
				preg_match('/(\d{4})(\d{2})(\d{2})(T(\d{2})(\d{2})(\d{2})Z)?/i', $splittedPeriod[0], $m);
				$formatedValue = sprintf('%02d-%02d-%02dT%02d:%02d:%02dZ', $m[1], $m[2], $m[3], $m[5], $m[6], $m[7]);
			}

			$config = [
				'tableName'      => 'tx_cal_event',
				'fieldName'      => 'rdate'.$key,
				'databaseRow'    => ['uid' => $uid],
				'renderType'     => 'inputDateTime',
				'parameterArray' => [
					'itemFormElValue' => $formatedValue,
					'itemFormElName'  => 'data['.$table.']['.$uid.'][rdate'.$key.']',
					'fieldConf'       => [
						'config' => [
							'eval' => 'XXX'
						]
					]
				]
			];

			if ($rdateType == 'date_time' || $rdateType == 'period') {
				$config['parameterArray']['fieldConf']['config']['eval'] = 'datetime';
				$datefield = $nodefactory->create($config)->render();

				$out [] = $datefield['html'];
			} else {
				$config['parameterArray']['fieldConf']['config']['eval'] = 'date';
				$datefield = $nodefactory->create($config)->render();

				$out [] = $datefield['html'];
			}

			if ($rdateType == 'period') {
				$periodArray = array();
				if(is_string($splittedPeriod [1])) {
					preg_match('/P((\d+)Y)?((\d+)M)?((\d+)W)?((\d+)D)?T((\d+)H)?((\d+)M)?((\d+)S)?/', $splittedPeriod [1], $periodArray);
				}
				$out [] .= '<span style="padding-left:10px;">'.$GLOBALS['LANG']->getLL('l_duration').':</span>'.$GLOBALS['LANG']->getLL('l_year').
					':<input type="text" value="'.intval($periodArray [2]).'" class="rdateChanged" name="rdateYear'.$key.'" id="rdateYear'.$key.'" size="2"/>'.$GLOBALS['LANG']->getLL('l_month').
					':<input type="text" value="'.intval($periodArray [4]).'" class="rdateChanged" name="rdateMonth'.$key.'" id="rdateMonth'.$key.'" size="2"/>'.$GLOBALS['LANG']->getLL('l_week').
					':<input type="text" value="'.intval($periodArray [6]).'" class="rdateChanged" name="rdateWeek'.$key.'" id="rdateWeek'.$key.'" size="2"/>'.$GLOBALS['LANG']->getLL('l_day').
					':<input type="text" value="'.intval($periodArray [8]).'" class="rdateChanged" name="rdateDay'.$key.'" id="rdateDay'.$key.'" size="2"/>'.$GLOBALS['LANG']->getLL('l_hour').
					':<input type="text" value="'.intval($periodArray [10]).'" class="rdateChanged" name="rdateHour'.$key.'" id="rdateHour'.$key.'" size="2"/>'.$GLOBALS['LANG']->getLL('l_minute').
					':<input type="text" value="'.intval($periodArray [12]).'" class="rdateChanged" name="rdateMinute'.$key.'" id="rdateMinute'.$key.'" size="2"/>'.
					'<br/>';
			}

			$key++;
		}

		$out [] = '<input type="hidden" name="data['.$table.']['.$uid.'][rdate]" id="data_'.$table.'_'.$uid.'_rdate" value="'.$row ['rdate'].'" />';

		$rDateCount = count($rdateValues);

		$callback = <<< EOJ
function(RDate) {
	window.rDate = new RDate('$jsDate', '$table', $uid, '$rdateType', $rDateCount);

	$(".rdateChanged").on("change", function() {
		window.rDate.rdateChanged();
	});
	$(document).on("formengine.dp.change", function() {
		window.rDate.rdateChanged();
	});
}
EOJ;

		$result['html'] = implode("\n", $out);
		$result['requireJsModules'][] = ['TYPO3/CMS/Cal/RDate' => $callback];

		return $result;
	}

}
