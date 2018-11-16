/**
 * Module: TYPO3/CMS/Cal/RecurUI
 *
 * JavaScript to handle data import
 * @exports TYPO3/CMS/Cal/RecurUI
 */
define(['jquery'], function ($) {
    'use strict';

    /**
     * @exports TYPO3/CMS/Cal/RecurUI
     */
    function RecurUI(containerID, storageID, rowClass, rowHTML) {
        this.containerID = containerID;
        this.storageID = storageID;
        this.rowClass = rowClass;
        this.rowHTML = rowHTML;
    }

    RecurUI.prototype = {

        addRecurrence: function (defaultValues) {
            var container = $("#" + escapeRegExp(this.containerID));

            container.append(this.rowHTML);

            if (defaultValues) {
                $.each(defaultValues, function (index, pair) {
                    var element = container.find('select.' + index).last();
                    element.val(pair);
                });
            }

            this.save();
        },

        setCheckboxes: function (defaultValues) {
            var container = $("#" + escapeRegExp(this.containerID));
            var rowSelector = '.' + this.rowClass;
            if (defaultValues) {
                $.each(defaultValues, function (index, pair) {
                    container.find(rowSelector + ' input[value="' + pair + '"]').each(function (index, input) {
                        input.checked = "true";
                    });
                });
            }
        },

        removeRecurrence: function (icon) {
            $(icon).parent().remove();
            this.save();
        },

        save: function () {
            var storage = $("#" + escapeRegExp(this.storageID));
            storage.val('');

            //@todo  Figure out how to differentiate selector based forms from element based forms
            var container = $("#" + escapeRegExp(this.containerID));
            container.find('div.' + this.rowClass).each(function (index, div) {
                var rowValue = '';

                $(div).find("select").each(function (index, select) {
                    rowValue += $(select).val();
                });

                $(div).find('input[type="checkbox"]:checked').each(function (index, input) {
                    if ($(input).val()) {
                        rowValue += $(input).val();
                    }
                });

                if (rowValue && rowValue.trim().length > 0) {

                    if (storage.val()) {
                        storage.val(storage.val() + ',');
                    }
                    storage.val(storage.val() + rowValue);
                }
            });
        },

        load: function () {
            var initialValue = $("#" + escapeRegExp(this.storageID)).val();
            var recurArray = initialValue.split(",");
            var obj = this;

            $.each(recurArray, function (index, recur) {
                var hash = obj.storageToHash(recur);
                if (obj.rowHTML) {
                    obj.addRecurrence(hash);
                } else {
                    obj.setCheckboxes(hash);
                }

            });
        }
    };

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }


    return RecurUI;
});
