<?php
declare(strict_types=1);

namespace TYPO3\CMS\Cal\Backend\Form\RenderType;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;

class ByMonthElement extends AbstractFormElement {

	public function render() {
		ElementHelper::init();

		$result = $this->initializeResultArray();

		$table = $this->data['tableName'];
		$row = $this->data['databaseRow'];

		$uid = $row['uid'];

		$out = [];

		$out [] = '<div id="bymonth-container" style="margin-bottom: 5px;">';

		foreach (ElementHelper::getMonthsArray() as $value => $label) {
			$name = "bymonth_".$value;

			$out [] = '<div class="cal-row" style="display: inline-block; margin-right: 2em">';
			$out [] = '<input type="checkbox" id="'.$name.'" name="'.$name.'" value="'.$value.'" onchange="byMonth.save();"/>';
			$out [] = '<label style="padding-left: 2px;" for="'.$name.'">'.$label.'</label>';
			$out [] = '</div>';
		}

		$out [] = '</div>';
		$out [] = '<input type="hidden" name="data['.$table.']['.$uid.'][bymonth]" id="data['.$table.']['.$uid.'][bymonth]" value="'.$row['bymonth'].'" />';

		$callback = <<< EOJ
function(ByMonthUI) {
	window.byMonth = new ByMonthUI('bymonth-container', 'data[$table][$uid][bymonth]', 'cal-row');
	$(function() { byMonth.load(); });
}
EOJ;

		$result['html'] = implode("\n", $out);
		$result['requireJsModules'][] = ['TYPO3/CMS/Cal/RecurUI/ByMonthUI' => $callback];

		return $result;
	}

}
