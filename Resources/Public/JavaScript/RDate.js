/**
 * Module: TYPO3/CMS/Cal/RDate
 *
 * JavaScript to handle data import
 * @exports TYPO3/CMS/Cal/RDate
 */
define(['jquery'], function ($) {
    'use strict';

    /**
     * @exports TYPO3/CMS/Cal/RDate
     */
    function RDate(jsDate, rTable, rUid, rdateType, rDateCount) {
        this.jsDate = jsDate;
        this.table = rTable;
        this.uid = rUid;
        this.rdateType = rdateType;
        this.rdateCount = rDateCount;
    }

    RDate.prototype = {

        rdateChanged: function () {
            var rdate = document.getElementById('data_' + this.table + '_' + this.uid + '_rdate');
            rdate.value = '';
            for (var i = 0; i < this.rdateCount; i++) {
                var dateFormated = '';

                dateFormated = document.getElementsByName('data[' + this.table + '][' + this.uid + '][rdate' + i + ']')[0].value;

                if (dateFormated !== '') {
                    dateFormated = dateFormated.replace(/[:-]/g, '');

                    if (this.rdateType === 'date') {
                        dateFormated = dateFormated.split('T')[0];
                    }
                    if (this.rdateType === 'date_time') {
                        // nothing to do, timepicker does it for us
                    }
                    if (this.rdateType === 'period') {
                        dateFormated += '/P';

                        var rdateYear = parseInt(document.getElementById('rdateYear' + i).value, 10);
                        var rdateMonth = parseInt(document.getElementById('rdateMonth' + i).value, 10);
                        var rdateWeek = parseInt(document.getElementById('rdateWeek' + i).value, 10);
                        var rdateDay = parseInt(document.getElementById('rdateDay' + i).value, 10);
                        var rdateHour = parseInt(document.getElementById('rdateHour' + i).value, 10);
                        var rdateMinute = parseInt(document.getElementById('rdateMinute' + i).value, 10);

                        dateFormated += rdateYear > 0 ? rdateYear + 'Y' : '';
                        dateFormated += rdateMonth > 0 ? rdateMonth + 'M' : '';
                        dateFormated += rdateWeek > 0 ? rdateWeek + 'W' : '';
                        dateFormated += rdateDay > 0 ? rdateDay + 'D' : '';
                        dateFormated += 'T';
                        dateFormated += rdateHour > 0 ? rdateHour + 'H' : '';
                        dateFormated += rdateMinute > 0 ? rdateMinute + 'M' : '';
                    }
                    rdate.value += dateFormated + ',';

                }
            }
            rdate.value = rdate.value.substr(0, rdate.value.length - 1);
        }
    };

    return RDate;
});
