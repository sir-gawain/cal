/**
 * Module: TYPO3/CMS/Cal/RecurUI/ByMonthUI
 *
 * JavaScript to handle data import
 * @exports TYPO3/CMS/Cal/RecurUI/ByMonthUI
 */
define(['jquery', 'TYPO3/CMS/Cal/RecurUI/RecurUI'], function ($, RecurUI) {
    'use strict';

    /**
     * @exports TYPO3/CMS/Cal/RecurUI/ByMonthUI
     */
    function ByMonthUI(containerID, storageID, rowClass, rowHTML) {
        RecurUI.call(this, containerID, storageID, rowClass, rowHTML);
    }

    ByMonthUI.prototype = Object.create(RecurUI.prototype, {
        storageToHash: {
            value: function (recur) {
                var monthValue = recur;
                return {month: monthValue};
            }
        }
    });

    return ByMonthUI;
});
