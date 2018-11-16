/**
 * Module: TYPO3/CMS/Cal/RecurUI/ByMonthDayUI
 *
 * JavaScript to handle data import
 * @exports TYPO3/CMS/Cal/RecurUI/ByMonthDayUI
 */
define(['jquery', 'TYPO3/CMS/Cal/RecurUI/RecurUI'], function ($, RecurUI) {
    'use strict';

    /**
     * @exports TYPO3/CMS/Cal/RecurUI/ByMonthDayUI
     */
    function ByMonthDayUI(containerID, storageID, rowClass, rowHTML) {
        RecurUI.call(this, containerID, storageID, rowClass, rowHTML);
    }

    ByMonthDayUI.prototype = Object.create(RecurUI.prototype, {
        storageToHash: {
            value: function (recur) {
                var dayValue = recur;
                return {day: dayValue};
            }
        }
    });

    return ByMonthDayUI;
});
