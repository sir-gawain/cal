<?php
declare(strict_types=1);

namespace TYPO3\CMS\Cal\Backend\Form\RenderType;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;

class ExtUrlElement extends AbstractFormElement {

	public function render() {
		ElementHelper::init();

		$result = $this->initializeResultArray();

		$table = $this->data['tableName'];
		$row = $this->data['databaseRow'];

		$uid = $row['uid'];

		$out = [];

		$out [] = '<input type="hidden" name="data['.$table.']['.$uid.'][ext_url_notes]" id="data['.$table.']['.$uid.'][ext_url_notes]" value="'.$row['ext_url_notes'].'" />';

		$out [] = '<div id="ext_url-container"></div>';
		$out [] = '<div style="padding: 5px 0"><a href="javascript:extUrl.addUrl();">'.ElementHelper::getNewIcon().
			$GLOBALS['LANG']->getLL('tx_cal_calendar.add_url').'</a></div>';
		$out [] = '<input type="hidden" name="data['.$table.']['.$uid.'][ext_url]" id="data['.$table.']['.$uid.'][ext_url]" value="'.$row['ext_url'].'" />';

		$extRow = $this->getExtUrlRow();

		$callback = <<< EOJ
function(ExtUrlUI) {
	window.extUrl = new ExtUrlUI('ext_url-container', 'data[$table][$uid][ext_url]', 'cal-row', '$extRow');
	$(function() { extUrl.load(); });
}
EOJ;

		$result['html'] = implode("\n", $out);
		$result['requireJsModules'][] = ['TYPO3/CMS/Cal/ExtUrlUI/ExtUrlUI' => $callback];

		return $result;
	}

	public function getExtUrlRow() {
		$html = '<div class="cal-row">';
		$html .= $GLOBALS['LANG']->getLL('tx_cal_calendar.ext_url_note').':<input type="text" class="exturlnote" onchange="extUrl.save()" >';
		$html .= $GLOBALS['LANG']->getLL('tx_cal_calendar.ext_url_url').':<input type="text" class="exturl" onchange="extUrl.save()" >';
		$html .= '<a id="garbage" href="#" onclick="extUrl.removeUrl(this);">'.ElementHelper::getGarbageIcon().'</a>';
		$html .= '</div>';

		return ElementHelper::removeNewLines($html);
	}
}
