
(function ($, undefined) {
    $.fn.czMore = function (options) {

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
            var i = obj.children(".recordsetParent").size();
            var divPlus = '<div id="btnPlus" />';

            var count = '<input id="' + this.id + '_czMore_txtCount" name="czMore_txtCount_' + this.id + '" type="hidden" value="0" size="5" />';

            obj.before(count);
            var recordset = obj.children("#first");
            obj.after(divPlus);
            var set = recordset.children(".recordsetParent").children().first();
            var btnPlus = obj.siblings("#btnPlus");

            btnPlus.css({
                'cursor': 'pointer'
            });
            btnPlus.html("<i class='fa fa-plus-circle' aria-hidden='true'></i>");
           
            var iParnt = '';
            if (recordset.length) {
                obj.siblings("#btnPlus").click(function () {
                    iParnt = $('.recordsetParent').length - 1;
                    var i = obj.children(".recordsetParent").size() + iParnt;

                    var item = recordset.clone().html();
                    i++;

                    item = item.replace(/\[([0-9]\d{0})\]/g, "[" + i + "]");
                    item = item.replace(/\_([0-9]\d{0})\_/g, "_" + i + "_");
                    //$(element).html(item);
                    //item = $(item).children().first();
                    //item = $(item).parent();

                    obj.append(item);
					
					/*$('#disciplines_'+i+'_level').multiselect({
						nonSelectedText: 'Select Type',
						enableFiltering: true,
						multiselect:false,
						enableCaseInsensitiveFiltering: true,
						buttonWidth: '100%'
					});
					$('#certificates_'+i+'_categorie').multiselect({
						nonSelectedText: 'Select Specialism',
						enableFiltering: true,
						multiselect:false,
						enableCaseInsensitiveFiltering: true,
						buttonWidth: '100%'
					});
					$('#certificates_'+i+'_level').multiselect({
						nonSelectedText: 'Select Level',
						enableFiltering: true,
						multiselect:false,
						enableCaseInsensitiveFiltering: true,
						buttonWidth: '100%'
					});*/
                    loadMinus(obj.children().last());
                    minusClick(obj.children().last());
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", i);
                    }

                    obj.siblings("input[name$='czMore_txtCount']").val(i);
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
                 $(obj).children(".recordsetParent").each(function (index, element) {
                     $(element).find('input:text, input:password, input:file, select, textarea').each(function () {
                         old_name = this.name;
                         new_name = old_name.replace(/\_([0-9]\d{0})\_/g, "_" + (index + 1) + "_");
                         this.id = this.name = new_name;
            
                    });
                   index++
            
                    minusClick(element);
            });
            }

            function loadMinus(recordset) {
                var divMinus = '<div class="bunPare" id="btnMinus" />';
                $(recordset).children().first().before(divMinus);
                var btnMinus = $(recordset).children("#btnMinus");
                btnMinus.css({
                    'cursor': 'poitnter'
                });
                btnMinus.html("<i class='fa fa-trash-o' aria-hidden='true'></i>");
           
            }

            function minusClick(recordsetParent) {
                $(recordsetParent).children("#btnMinus").click(function () {

                    var i = obj.children(".recordsetParent").size();

                    var id = $(recordset).attr("data-id");
                    $(recordsetParent).remove();
					resetNumbering();
                    
                    obj.siblings("input[name$='czMore_txtCount']").val(obj.children(".recordsetParent").size());
                    i--;
                    if (options.onDelete != null) {
                        if (id != null)
                            obj.trigger("onDelete", id);
                    }
                });
				ResetFieldsIndexCertificate();
            }
        });
    };
})(jQuery);

$(".bunPare").click(function () {
    $("#" + $(this).attr("id")).remove();
    ResetFieldsIndexCertificate();
});

function ResetFieldsIndexCertificate() {
	//alert('working here');
	$('.certificates_categorie').find(".length").each(function (index) {
		$(this).attr("name", "certificates_categorie[" + index + "]");
        $(this).attr("id", "certificates_"+index+"_categorie");
		$(this).parent('.certificates_categorie').attr("id","category_"+index+"_select");
		
					$('#certificates_'+index+'_categorie').multiselect({
						nonSelectedText: 'Select Specialism',
						enableFiltering: true,
						multiselect:false,
						enableCaseInsensitiveFiltering: true,
						buttonWidth: '100%'
					});
					
    });

    $('.certificates_level').find(".length").each(function (index) {
        $(this).attr("name", "certificates_level[" + index + "]");
        $(this).attr("id", "certificates_"+index+"_level");
		$('#certificates_'+index+'_level').multiselect({
						nonSelectedText: 'Select Level',
						enableFiltering: true,
						multiselect:false,
						enableCaseInsensitiveFiltering: true,
						buttonWidth: '100%'
					});
    });
	$('.certificates_rate').find(".length").each(function (index) {        $(this).attr("name", "certificates_rate[" + index + "]");        $(this).attr("id", "certificates_"+index+"_rate");    });	$('.certificates_valid').find(".length").each(function (index) {        $(this).attr("name", "certificates_valid[" + index + "]");        $(this).attr("id", "certificates_"+index+"_valid");    });
	$('.certificates_teaching').find(".length").each(function (index) {
        $(this).attr("name", "certificates_teaching[" + index + "]");
        $(this).attr("id", "certificates_"+index+"_teaching");
    });
	$('.disciplines_level').find(".length").each(function (index) {
        $(this).attr("name", "disciplines_level[" + index + "]");
        $(this).attr("id", "disciplines_"+index+"_level");
		$('#disciplines_'+index+'_level').multiselect({
						nonSelectedText: 'Select Type',
						enableFiltering: true,
						multiselect:false,
						enableCaseInsensitiveFiltering: true,
						buttonWidth: '100%'
					});
    });
}

