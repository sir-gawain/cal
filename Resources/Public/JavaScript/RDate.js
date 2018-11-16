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
    function RDate(jsDate, table, uid, rdateType, rDateCount) {
        this.jsDate = jsDate;
        this.table = table;
        this.uid = uid;
        this.rdateCount = rDateCount;
        this.rdateType = rdateType;
    }

    RDate.prototype = {

        rdateChanged: function () {
            var rdate = document.getElementById("data[" + this.table + "][" + this.uid + "][rdate]");
            rdate.value = "";
            for (var i = 0; i < this.rdateCount; i++) {
                var dateFormated = "";
                if (this.rdateType === 'date_time' || this.rdateType === 'period') {
                    dateFormated = document.getElementById("tceforms-datetimefield-data_" + this.table + "_" + this.uid + "_rdate" + i + "_hr").value;
                } else {
                    dateFormated = document.getElementById("tceforms-datefield-data_" + this.table + "_" + this.uid + "_rdate" + i + "_hr").value;
                }
                if (dateFormated !== "") {
                    var splittedDateTime = dateFormated.split(" ");
                    var splittedTime = splittedDateTime[0].split(":");
                    var splittedDate = splittedDateTime[0].split("-");
                    if (splittedDateTime.length === 2) {
                        splittedDate = splittedDateTime[1].split("-");
                    } else if (splittedDateTime.length === 1 && splittedDate.length === 2) {
                        var d = new Date();
                        splittedDate[2] = d.getFullYear();
                    }
                    if (this.jsDate === "%d-%m-%Y") {
                        dateFormated = splittedDate[2] + (parseInt(splittedDate[1], 10) < 10 ? "0" : "") +
                            parseInt(splittedDate[1], 10) + (parseInt(splittedDate[0], 10) < 10 ? "0" : "") +
                            parseInt(splittedDate[0], 10);
                    } else {
                        dateFormated = splittedDate[2] + (parseInt(splittedDate[0], 10) < 10 ? "0" : "") +
                            parseInt(splittedDate[0], 10) + (parseInt(splittedDate[1], 10) < 10 ? "0" : "") +
                            parseInt(splittedDate[1], 10);
                    }
                    if (this.rdateType === 'date_time') {
                        dateFormated += "T" + (parseInt(splittedTime[0], 10) < 10 ? "0" : "") +
                            parseInt(splittedTime[0], 10) + (parseInt(splittedTime[1], 10) < 10 ? "0" : "") +
                            parseInt(splittedTime[1], 10) + "00Z";
                    } else {
                        if (this.rdateType === 'period') {
                            dateFormated += "T" + (parseInt(splittedTime[0], 10) < 10 ? "0" : "") +
                                parseInt(splittedTime[0], 10) + (parseInt(splittedTime[1], 10) < 10 ? "0" : "") +
                                parseInt(splittedTime[1], 10) + "00Z/P";

                            var rdateYear = parseInt(document.getElementById("rdateYear" + i).value, 10);
                            var rdateMonth = parseInt(document.getElementById("rdateMonth" + i).value, 10);
                            var rdateWeek = parseInt(document.getElementById("rdateWeek" + i).value, 10);
                            var rdateDay = parseInt(document.getElementById("rdateDay" + i).value, 10);
                            var rdateHour = parseInt(document.getElementById("rdateHour" + i).value, 10);
                            var rdateMinute = parseInt(document.getElementById("rdateMinute" + i).value, 10);

                            dateFormated += rdateYear > 0 ? rdateYear + "Y" : "";
                            dateFormated += rdateMonth > 0 ? rdateMonth + "M" : "";
                            dateFormated += rdateWeek > 0 ? rdateWeek + "W" : "";
                            dateFormated += rdateDay > 0 ? rdateDay + "D" : "";
                            dateFormated += "T";
                            dateFormated += rdateHour > 0 ? rdateHour + "H" : "";
                            dateFormated += rdateMinute > 0 ? rdateMinute + "M" : "";
                        }
                    }
                    rdate.value += dateFormated + ",";

                }
            }
            rdate.value = rdate.value.substr(0, rdate.value.length - 1);
        }
    };

    return RDate;
});
