/**
 * Module: TYPO3/CMS/Cal/RecurUI/ByDayUI
 *
 * JavaScript to handle data import
 * @exports TYPO3/CMS/Cal/RecurUI/ByDayUI
 */
define(['jquery', 'TYPO3/CMS/Cal/RecurUI/RecurUI'], function ($, RecurUI) {
    'use strict';

    /**
     * @exports TYPO3/CMS/Cal/RecurUI/ByDayUI
     */
    function ByDayUI(containerID, storageID, rowClass, rowHTML) {
        RecurUI.call(this, containerID, storageID, rowClass, rowHTML);
    }

    ByDayUI.prototype = Object.create(RecurUI.prototype, {
        storageToHash: {
            value: function (recur) {
                var splitLocation = 0;
                if (recur.length > 2) {
                    for (var i = 1; i < recur.length; i++) {
                        var character = recur.charAt(i);
                        if (((character < "0") || (character > "9")) && (character !== '-')) {
                            splitLocation = i;
                            break;
                        }
                    }
                }

                var countValue = recur.substr(0, splitLocation);
                var dayValue = recur.substr(splitLocation, recur.length);

                return {count: countValue, day: dayValue};
            }
        }

    });

    return ByDayUI;
});
