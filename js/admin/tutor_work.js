/*
Title: Cozeit More plugin by Yasir Atabani
Documentation: na
Author: Yasir O. Atabani
Website: http://www.cozeit.com
Twitter: @yatabani

MIT License, https://github.com/cozeit/czMore/blob/master/LICENSE.md
*/

(function ($, undefined) {
    $.fn.czMores = function (options) {

        //Set defauls for the control
        var defaults = {
            max: 5,
            min: 0,
            onLoad: false,
            onAdd: false,
            onDelete: false
        };
        //Update unset options with defaults if needed
        var options = $.extend(defaults, options);
        /*$(this).bind("onAdd", function (event, data) { // commented on 30-07-2019
            options.onAdd.call(event, data);
        });
        $(this).bind("onLoad", function (event, data) {
            options.onLoad.call(event, data);
        });
        $(this).bind("onDelete", function (event, data) {
            options.onDelete.call(event, data);
        });*/
        //Executing functionality on all selected elements
        return this.each(function () {
            var obj = $(this);
            var i = obj.children(".recordsetWork").size();
            var divPlus = '<div id="btnPlusWork" />';

            var count = '<input id="' + this.id + '_czMores_txtCount" name="czMores_txtCount_' + this.id + '" type="hidden" value="0" size="5" />';

            obj.before(count);
            var recordset = obj.children("#second");
            obj.after(divPlus);
            var set = recordset.children(".recordsetWork").children().first();
            var btnPlus = obj.siblings("#btnPlusWork");

            btnPlus.css({
                'cursor': 'pointer'
            });
            btnPlus.html("<i class='fa fa-plus-circle' aria-hidden='true'></i>");
           
            var iParnt = '';
            if (recordset.length) {
                obj.siblings("#btnPlusWork").click(function () {
                    iParnt = $('.recordsetWork').length - 1;
                    var i = obj.children(".recordsetWork").size() + iParnt;

                    var item = recordset.clone().html();
                    i++;

                    item = item.replace(/\[([0-9]\d{0})\]/g, "[" + i + "]");
                    item = item.replace(/\_([0-9]\d{0})\_/g, "_" + i + "_");
                    //$(element).html(item);
                    //item = $(item).children().first();
                    //item = $(item).parent();

                    obj.append(item);
                    loadMinus(obj.children().last());
                    minusClick(obj.children().last());
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", i);
                    }

                    obj.siblings("input[name$='czMores_txtCount']").val(i);
                    return false;
                });
                recordset.remove();
                for (var j = 0; j <= i; j++) {

                    loadMinus(obj.children()[j]);
                    minusClick(obj.children()[j]);
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", j);
                    }
                }

                if (options.onLoad != null) {
                    obj.trigger("onLoad", i);
                }
                //obj.bind("onAdd", function (event, data) {
                //If you had passed anything in your trigger function, you can grab it using the second parameter in the callback function.
                //});
            }

            function resetNumbering() {
                $(obj).children(".recordsetWork").each(function (index, element) {
                    $(element).find('input:text, input:password, input:file, select, textarea').each(function () {
                        old_name = this.name;
                        new_name = old_name.replace(/\_([0-9]\d{0})\_/g, "_" + (index + 1) + "_");
                        this.id = this.name = new_name;
                        //alert(this.name);
                    });
                    index++
                    minusClick(element);
                });
            }

            function loadMinus(recordset) {
                var divMinus = '<div id="btnMinusWork" />';
                $(recordset).children().first().before(divMinus);
                var btnMinus = $(recordset).children("#btnMinusWork");
                btnMinus.css({
                    'cursor': 'poitnter'
                });
                btnMinus.html("<i class='fa fa-trash-o' aria-hidden='true'></i>");
           
            }

            function minusClick(recordsetWork) {
                $(recordsetWork).children("#btnMinusWork").click(function () {

                    var i = obj.children(".recordsetWork").size();

                    var id = $(recordsetWork).attr("data-id");
                    $(recordsetWork).remove();
                    resetNumbering();
                    obj.siblings("input[name$='czMore_txtCount']").val(obj.children(".recordsetWork").size());
                    i--;
                    if (options.onDelete != null) {
                        if (id != null)
                            obj.trigger("onDelete", id);
                    }
                });
                 ResetFieldsIndex();
            }
        });
    };

})(jQuery);



$(".bunPareWork").click(function () {
    $("#" + $(this).attr("id")).remove();
    ResetFieldsIndex();
});

function ResetFieldsIndex() {

    $('.company_name').find(".length").each(function (index) {
        $(this).attr("name", "company_name[" + index + "]");
        $(this).attr("id", "company_"+index+"_name");
    });

    $('.organization_registration').find(".length").each(function (index) {
        $(this).attr("name", "organization_registration[" + index + "]");
        $(this).attr("id", "organization_"+index+"_registration");
    });



    //index++;
}
