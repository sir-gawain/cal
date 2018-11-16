<?php
declare(strict_types=1);

namespace TYPO3\CMS\Cal\Backend\Form\RenderType;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;

class ByMonthDayElement extends AbstractFormElement {

	public function render() {
		ElementHelper::init();

		$result = $this->initializeResultArray();

		$table = $this->data['tableName'];
		$row = $this->data['databaseRow'];

		$uid = $row['uid'];

		switch ($row['freq'][0]) {
			case 'week' :
				$dayRow = $this->getByMonthDayRow(ElementHelper::getEveryMonthText());
				$html = $this->byMonthDay_select();
				break;
			case 'month' :
				$dayRow = $this->getByMonthDayRow(ElementHelper::getEveryMonthText());
				$html = $this->byMonthDay_select();
				break;
			case 'year' :
				$dayRow = $this->getByMonthDayRow(ElementHelper::getSelectedMonthText());
				$html = $this->byMonthDay_select();
				break;
		}

		$out = [];

		$out [] = $html;
		$out [] = '<input type="hidden" name="data['.$table.']['.$uid.'][bymonthday]" id="data['.$table.']['.$uid.'][bymonthday]" value="'.$row ['bymonthday'].'" />';

		$callback = <<< EOJ
function(ByMonthDayUI) {
	window.byMonthDay = new ByMonthDayUI('bymonthday-container', 'data[$table][$uid][bymonthday]', 'cal-row', '$dayRow');
	$(function() { byMonthDay.load(); });
}
EOJ;

		$result['html'] = implode("\n", $out);
		$result['requireJsModules'][] = ['TYPO3/CMS/Cal/RecurUI/ByMonthDayUI' => $callback];

		return $result;
	}

	public function byMonthDay_select() {
		$out = array();

		$out [] = '<div id="bymonthday-container"></div>';
		$out [] = '<div style="padding: 5px 0"><a href="javascript:byMonthDay.addRecurrence();">'.ElementHelper::getNewIcon().
			$GLOBALS['LANG']->getLL('tx_cal_event.add_recurrence').'</a></div>';

		return implode(chr(10), $out);
	}


	public function getByMonthDayRow($endString) {
		$html = '<div class="cal-row">';

		$html .= $GLOBALS['LANG']->getLL('tx_cal_event.recurs_day').' ';
		$html .= '<select class="day" onchange="byMonthDay.save()">';
		$html .= '<option value=""></option>';
		for ($i = 1; $i < 32; $i++) {
			$html .= '<option value="'.$i.'">'.$i.'</option>';
		}
		$html .= '</select>';

		$html .= ' '.$endString;
		$html .= '<a id="garbage" href="#" onclick="byMonthDay.removeRecurrence(this);">'.ElementHelper::getGarbageIcon().'</a>';
		$html .= '</div>';

		return ElementHelper::removeNewLines($html);
	}
}
