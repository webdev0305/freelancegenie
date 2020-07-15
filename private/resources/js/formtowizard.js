/*
   Form To Wizard https://github.com/artoodetoo/formToWizard
   Free to use under MIT license.

   Originally created by Janko.
   Featured by iFadey.
   Polishing by artoodetoo.

*/

(function ($) {
    $.fn.formToWizard = function (options, cmdParam1) {
        if (typeof options !== 'string') {
            options = $.extend({
                submitButton: '',
                showProgress: true,
                showStepNo: true,
                validCheck: true,
                validateBeforeNext: true,
                select: null,
                progress: null,
                nextBtnName: 'Next &gt;',
                prevBtnName: '&lt; Back',
                buttonTag: 'a',
                nextBtnClass: 'btn next',
                prevBtnClass: 'btn prev'
            }, options);
        }

        var element = this
            , steps = $(element).find("fieldset")
            , count = steps.size()
            , submmitButtonName = "#" + options.submitButton
            , commands = null;


        if (typeof options !== 'string') {
            //hide submit button initially
            //$(submmitButtonName).hide();
            setTimeout(function () {
                $(submmitButtonName).addClass('next').detach().appendTo("#step" + (steps.length - 1) + "commands");
            }, 500);


            //assign options to current/selected form (element)
            $(element).data('options', options);

            /**************** Validate Options ********************/
            if (typeof(options.validateBeforeNext) !== "function")

                options.validateBeforeNext = function () {
                    return true;
                };

            if (options.showProgress && typeof(options.progress) !== "function") {

                if (options.showStepNo)

                    $(element).before("<ul id='steps' class='steps'></ul>");
                else

                    $(element).before("<ul id='steps' class='steps breadcrumb'></ul>");
            }
            /************** End Validate Options ******************/


            steps.each(function (i) {
                $(this).wrap('<div id="step' + i + '" class="stepDetails"></div>');
                $(this).append('<p id="step' + i + 'commands" class="commands"></p>');

                if (options.showProgress && typeof(options.progress) !== "function") {
                    if (options.showStepNo)
                        $("#steps").append("<li id='stepDesc" + i + "'>Step " + (i + 1) + "<span>" + $(this).find("legend").html() + "</span></li>");
                    else
                        $("#steps").append("<li id='stepDesc" + i + "'>" + $(this).find("legend").html() + "</li>");
                }

                if (i == 0) {
                    createNextButton(i);
                    selectStep(i);
                }
                else if (i == count - 1) {
                    $("#step" + i).hide();
                    createPrevButton(i);
                }
                else {
                    $("#step" + i).hide();
                    createPrevButton(i);
                    createNextButton(i);
                }
            });

        } else if (typeof options === 'string') {
            var cmd = options;

            initCommands();

            if (typeof commands[cmd] === 'function') {
                commands[cmd](cmdParam1);
            } else {
                throw cmd + ' is invalid command!';
            }
        }


        /******************** Command Methods ********************/
        function initCommands() {
            //restore options object from form element
            options = $(element).data('options');

            commands = {
                GotoStep: function (stepNo) {
                    var stepName = "step" + (--stepNo);

                    if ($('#' + stepName)[0] === undefined) {
                        throw 'Step No ' + stepNo + ' not found!';
                    }

                    if ($('#' + stepName).css('display') === 'none') {
                        $(element).find('.stepDetails').hide();
                        $('#' + stepName).show();
                        selectStep(stepNo);
                    }
                },
                NextStep: function () {
                    $('.stepDetails:visible').find('a.next').click();
                },
                PreviousStep: function () {
                    $('.stepDetails:visible').find('a.prev').click();
                }
            };
        }

        /******************** End Command Methods ********************/


        /******************** Private Methods ********************/
        function createPrevButton(i) {
            var stepName = 'step' + i;
            $('#' + stepName + 'commands').append(
                '<' + options.buttonTag + ' href="#" id="' + stepName + 'Prev" class="' + options.prevBtnClass + '">' +
                options.prevBtnName +
                '</' + options.buttonTag + '>'
            );

            $("#" + stepName + "Prev").bind("click", function (e) {
                $("#" + stepName).hide();
                $("#step" + (i - 1)).show();
                selectStep(i - 1);
                return false;
            });
        }

        function createNextButton(i) {
            var stepName = 'step' + i;
            $('#' + stepName + 'commands').append(
                '<' + options.buttonTag + ' href="#" id="' + stepName + 'Next" class="' + options.nextBtnClass + '">' +
                options.nextBtnName +
                '</' + options.buttonTag + '>');

            $("#" + stepName + "Next").bind("click", function (e) {
                if (options.validCheck == '1') {
                    vlidateForms();
                }
                if (options.validCheck == '2') {
                    vlidateFormsTutor();
                }
				if (options.validCheck == '3') {
                    vlidateAssignment();
                }


                if (options.validateBeforeNext(element, $("#" + stepName)) === true) {
                    $("#" + stepName).hide();
                    $("#step" + (i + 1)).show();
                    //if (i + 2 == count)
                    selectStep(i + 1);
                }

                return false;
            });
        }


        $("#sads").click(function () {

            vlidateForms();
        });
		$("#insert").click(function () {
			vlidateAssignment();
        });

        jQuery.validator.addMethod('phoneUK', function (phone_number, element) {
                return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^(\(?(0|\+44)[1-9]{1}\d{1,4}?\)?\s?\d{3,4}\s?\d{3,4})$/);
            }, 'Please specify a valid uk phone number'
        );

        jQuery.validator.addMethod("postcodeUK", function (value, element) {
            return this.optional(element) || /[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i.test(value);
        }, "Please specify a valid Postcode");

        jQuery.validator.addMethod('ProImage', function (phone_number, element) {
                return this.optional(element) || element.files[0].size <= 5000000;
            }, 'Please upload image less then 5 MB'
        );

        function vlidateFormsTutor() {

            var form = $("#employerForm");
            form.validate({
                rules: {

                    first_name: {
                        required: true,
                        minlength: 2,
                        lettersonly: true,
                        maxlength: 32
                    },
                    last_name: {
                        required: true,
                        minlength: 2,
                        lettersonly: true,
                        maxlength: 32

                    },
                    
                    state: {
                        required: false,
                        minlength: 2,
                        maxlength: 32
                    },

                    address: {
                        required: false,
                        minlength: 1,
                        maxlength: 500
                    },
                    zip: {
                        //postcodeUK: true,
                        required: true,
                    },
                    company_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 32
                    },
                    company_address: {
                        required: true,
                        minlength: 1,
                        maxlength: 10
                    },
                    contact_tel: {
                        required: true,
                        phoneUK: true
                    },
                    head_office_address: {
                        required: true,
                        minlength: 2,
                        maxlength: 300
                    },
                   
                    contact_person: {
                        required: true,
                        minlength: 2,
                        maxlength: 32
                    },
                    head_office_contact_person: {
                        required: true,
                        minlength: 2,
                        maxlength: 300
                    },
                    contact_person_second: {
                        required: true,
                        minlength: 2,
                        maxlength: 32
                    },
                    head_office_contact_person_second: {
                        required: true,
                        minlength: 2,
                        maxlength: 300
                    },
                    dept: {
                        required: false,
                        minlength: 2,
                        maxlength: 300
                    },
                    dept_second: {
                        required: false,
                        minlength: 2,
                        maxlength: 300
                    },
                    contact_no: {
                        //required: true,
                        phoneUK: true
                    },
                    contact_no_second: {
                        //required: true,
                        phoneUK: true
                    },
                    email: {
                       // required: true,
                        email: true,
                        minlength: 2,
                        maxlength: 32
                    },
                    email_second: {
                       // required: true,
                        email: true,
                        minlength: 2,
                        maxlength: 32
                    },
                    company_vat_reg_no: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    company_reg_no: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    phone: {
                        required: true,
                        phoneUK: true
                    },
                    company_logo: {
                        required: false,
                        ProImage: true,
                        accept: "image/*",
                    },
                    report_name: {
                        required: false,
                        minlength: 2,
                        maxlength: 32
                    },
                    report_department: {
                        required: false,
                        minlength: 2,
                        maxlength: 32
                    },
                    dept: {
                        required: false,
                        minlength: 2,
                        maxlength: 300
                    },
                    additional_information: {
                        required: false,
                        minlength: 2,
                        maxlength: 500
                    },
                    additional_details: {
                        required: false,
                        minlength: 2,
                        maxlength: 500
                    },
                },
                messages: {
                    first_name: {
                        required: "Please enter first name",
                    },
                    last_name: {
                        required: "Please enter last name",
                    },
                    phone: {
                        required: "Please enter phone",
                    },
                    company_name: {
                        required: "Please enter company name",
                    },
                    company_address: {
                        required: "Please enter company address",
                    },
                    contact_tel: {
                        required: "Please enter company tel",
                    },
                    head_office_address: {
                        required: "Please enter head office address",
                    },
                   
                    contact_person: {
                        required: "Please enter contact person",
                    },
                    head_office_contact_person: {
                        required: "Please enter head office contact person",
                    },
                    contact_person_second: {
                        required: "Please enter contact person",
                    },
                    head_office_contact_person_second: {
                        required: "Please enter head office address",
                    },
                    email: {
                        required: "Please enter email",
                    },
                    email_second: {
                        required: "Please enter email",
                    },
                    company_vat_reg_no: {
                        required: "Please enter company vat reg no",
                    },
                    company_reg_no: {
                        required: "Please enter company vat reg no",
                    },
                    photo: {
                        accept: "Please enter valid extension.(IMAGE)",

                    },
                },
            });

            if (form.valid() === true) {
                return true;
            } else {
                Stop();
            }
        }

        function vlidateForms() {

            jQuery.validator.addMethod('selectCountry', function (value) {
                return (value != '');
            }, "Please select country");
            jQuery.validator.addMethod('selectCategorie', function (value) {
                return (value != '');
            }, "Please select Categorie");



            jQuery.validator.addMethod('ProResume', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );

            jQuery.validator.addMethod('ProCert', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );
            jQuery.validator.addMethod('ProCertificates', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );
            jQuery.validator.addMethod('ProQual', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );
            jQuery.validator.addMethod('ProCert', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );
            jQuery.validator.addMethod('ProPassport', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );
            jQuery.validator.addMethod('ProPermit', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );
            jQuery.validator.addMethod('ProBirth', function (phone_number, element) {
                    return this.optional(element) || element.files[0].size <= 5000000;
                }, 'Please upload resume less then 5 MB'
            );




            var form = $("#msform");
            form.validate({

                rules: {

                    first_name: {
                        required: true,
                        minlength: 2,
                        lettersonly: true,
                        maxlength: 32
                    },
                    last_name: {
                        required: true,
                        minlength: 2,
                        lettersonly: true,
                        maxlength: 32

                    },
                    phone: {
                        required: true,
                        phoneUK: true
                    },
                    city: {
                        required: true,
                       
                    },
                    state: {
                        required: true,
                        minlength: 2,
                        maxlength: 32
                    },
                    country: {
                        selectCountry: true
                    },
                    address: {
                        required: true,
                        minlength: 1,
                        maxlength: 500
                    },
                    about: {
                        required: false,
                        minlength: 2,
                        maxlength: 500
                    },

                    zip: {
                        //postcodeUK: true,
                        required: true,
                    },
                    cv: {
                        required: false,
                        // ProResume: true,
                        accept: "image/*,application/*,pdf"
                    },
                    photo: {
                        required: false,
                        ProImage: true,
                        accept: "image/*",
                    },
                    dbs_cert_upload: {
                        required: false,
                        ProCert: true,
                        accept: "image/*,application/*,pdf"
                    },
                    teaching_qual: {
                        required: false,
                        ProQual: true,
                        accept: "image/*,application/*,pdf"
                    },
                    teaching_cert: {
                        required: false,
                        ProCert: true,
                        accept: "image/*,application/*,pdf"
                    },

                    certificates_upload: {
                        required: false,
                        ProCertificates: true,
                        accept: "image/*,application/*,pdf"
                    },
                    passport: {
                        required: false,
                        ProPassport: true,
                        accept: "image/*,application/*,pdf"
                    },
                    work_permit: {
                        required: false,
                        ProPermit: true,
                        accept: "image/*,application/*,pdf"
                    },
                    birth_certificate: {
                        required: false,
                        ProBirth: true,
                        accept: "image/*,application/*,pdf"
                    },
                    dbs_certificate_no: {
                        required: false,
                        minlength: 2,
                        maxlength: 32
                    },
                    pass_start_date: {
                        required: true,
                    },
                    // pass_expiry_date: {
                    //     required: true,
                    // },
                    passport_no: {
                        required: false,
                        minlength: 2,
                        maxlength: 500
                    },
                    permit_start_date: {
                        required: true,
                    },
                    permit_expiry_date: {
                        required: true,
                    },
                    permit_no: {
                        required: true,
                        minlength: 2,
                        maxlength: 500
                    },
					bank: {
                        required: true,
                        minlength: 2,
                        lettersonly: true,
                        maxlength: 50
                    },
					account_fname: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
					account_no: {
                        required: true,
                        maxlength: 50
                    },
					re_account_no: {
                        required: true,
						maxlength: 50
                    },
					bank_code: {
                        required: true,
                        maxlength: 30
                    },
					re_bank_code: {
                        required: true,
                        maxlength: 30
                    },
                },
                messages: {

                    first_name: {
                        required: "Please enter first name",

                    },
                    last_name: {
                        required: "Please enter last name",
                    },
                    city: {
                        required: "Please Select city",

                    },
                    state: {
                        required: "Please enter state",

                    },
                    address: {
                        required: "Please enter address",

                    },
                    zip: {
                        required: "Please enter zip",

                    },
                    cv: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",

                    },
                    dbs_cert_upload: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",
                    },
                    teaching_qual: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",
                    },
                    teaching_cert: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",
                    },
                    photo: {
                        accept: "Please enter valid extension.(IMAGE)",

                    },
                    certificates_upload: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",
                    },
                    passport: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",
                    },
                    work_permit: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",
                    },
                    birth_certificate: {
                        accept: "Please enter valid extension.(DOC,IMAGE,PDF)",
                    },
					bank: {
                        required: "Please enter bank name",

                    },
					account_fname: {
                        required: "Please enter account holder's name",

                    },
					account_no: {
                        required: "Please enter your account number",

                    },
					re_account_no: {
                        required: "Please re-enter your account number",

                    },
					bank_code: {
                        required: "Please enter bank code",

                    },
					re_bank_code: {
                        required: "Please re-enter bank code",

                    },
                },

            });

            $("[name^=certificates_categorie]").each(function () {
                $(this).rules("add", {
                    selectCategorie: true
                });
            });

            // $("[name^=certificates_level]").each(function () {
            //     $(this).rules("add", {
            //         required: true,
            //         minlength: 2,
            //         maxlength: 500
            //
            //     });
            // });


            $("[name^=company_name]").each(function () {
                $(this).rules("add", {
                    required: true,
                    minlength: 2,
                    maxlength: 500

                });
            });

            $("[name^=organization_registration]").each(function () {
                $(this).rules("add", {
                    required: true,
                    minlength: 2,
                    maxlength: 500

                });
            });


            if (form.valid() === true) {
                return true;
            } else {
                Stop();

            }

        }

        function selectStep(i) {

            if (typeof(options.progress) === "function") {
                options.progress(i, count);
            } else if (options.showProgress) {
                $("#steps li").removeClass("current");
                $("#stepDesc" + i).addClass("current");
            }

            if (options.select) {
                options.select(element, $('#step' + i));
            }
        }
		function vlidateAssignment(e) {
			jQuery.validator.addMethod('selectDesciplines', function (value) {
                return (value != '');
            }, "Please select a tutor type for your assignment");
   var form = $("#insert_form");
            form.validate({

                rules: {

                    title: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    rate: {
                        required: true,
                        maxlength: 11

                    },
					disciplines: {
                        selectDesciplines: true,
					},
					altField: {
                        required: true,
					},
					booking_address: {
                        required: true,
					},
					description: {
                        required: true,
                        maxlength: 200
                    },
					
                    
                },
                messages: {

                    title: {
                        required: "Please enter main heading of assignment",

                    },
                    rate: {
                        required: "Please enter a day rate of assignment",
                    },
                    disciplines: {
                        required: "Please select a tutor type for your assignment",

                    },
                    altField: {
                        required: "Please enter booking date(s) of assignment",
                    },
					booking_address: {
                        required: "This is a required field",

                    },
                    description: {
                        required: "Please enter your assignment description",
                    },
                    
                },

            });



            if (form.valid() === true) {
				alert('Have you considered standardisation? If you have not used this Subcontractor previously then you must include into your booking. If you have used this Subcontractor before then simply, continue.');
                return true;
            } else {
                //Stop();
				e.preventDefault();

            }

        }

        /******************** End Private Methods ********************/

        return $(this);

    }
})(jQuery);
   
		

$(document).ready(function () {
    //Tutor Widget Form js
    $("#msform").formToWizard({
        submitButton: 'submit',
        nextBtnName: 'Next >>',
        prevBtnName: '<< Back',
        nextBtnClass: 'btn btn-primary next',
        prevBtnClass: 'btn btn-default prev',
        buttonTag: 'button',
        validCheck: '1',
        progress: function (i, count) {

            $("#progress-complete").width('' + ((i + 1) / count * 100) + '%');
        }
    })

})

$(document).ready(function () {
    //Tutor Widget Form js
    $("#employerForm").formToWizard({
        submitButton: 'submit',
        nextBtnName: 'Next >>',
        prevBtnName: '<< Back',
        nextBtnClass: 'btn btn-primary next',
        prevBtnClass: 'btn btn-default prev',
        buttonTag: 'button',
        validCheck: '2',
        progress: function (i, count) {

            $("#progress-complete").width('' + ((i + 1) / count * 100) + '%');
        }
    })

})
$(document).ready(function () {
    //Tutor Widget Form js
    $("#insert_form").formToWizard({
        submitButton: 'submit',
        nextBtnName: 'Next >>',
        prevBtnName: '<< Back',
        nextBtnClass: 'btn btn-primary next',
        prevBtnClass: 'btn btn-default prev',
        buttonTag: 'button',
        validCheck: '3',
        progress: function (i, count) {

            $("#progress-complete").width('' + ((i + 1) / count * 100) + '%');
        }
    })

})

$(document).ready(function () {

    $(".passStartDates").datepicker({
        autoclose: true,
    }).on('changeDate', function (selected) {
        var startDate = new Date(selected.date.valueOf());
        $('.passEndDates').datepicker('setStartDate', startDate);
    }).on('clearDate', function (selected) {
        $('.passEndDates').datepicker('setStartDate', null);
    });

    $("#passEndDates").datepicker({
        autoclose: true,
    }).on('changeDate', function (selected) {
        var endDate = new Date(selected.date.valueOf());
        $('.passStartDates').datepicker('setEndDate', endDate);
    }).on('clearDate', function (selected) {
        $('.passStartDates').datepicker('setEndDate', null);
    });

    $(".permitStartDates").datepicker({
        autoclose: true,
    }).on('changeDate', function (selected) {
        var startDate = new Date(selected.date.valueOf());
        $('.permitEndDates').datepicker('setStartDate', startDate);
    }).on('clearDate', function (selected) {
        $('.passEndDates').datepicker('setStartDate', null);
    });

    $("#permitEndDates").datepicker({
        autoclose: true,
    }).on('changeDate', function (selected) {
        var endDate = new Date(selected.date.valueOf());
        $('.permitStartDates').datepicker('setEndDate', endDate);
    }).on('clearDate', function (selected) {
        $('.permitStartDates').datepicker('setEndDate', null);
    });
});
$(document).ready(function () {
    $('#language').multiselect({
        nonSelectedText: 'Select Language',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '500px'
    });

    $('#travel_location').multiselect({
        nonSelectedText: 'Select Country',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '500px'
    });


    $('.education_university').find(".length").each(function (index) {
        $('#level').multiselect({
            nonSelectedText: 'Select level',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });
    });
});

//Employer section
function different_locations() {
    var $radios = $("input[type=radio][name='different_locations']:checked").val();
    if ($radios == 0) {

        $(".disable_different_locations").prop("disabled", true);
    } else {
        $(".disable_different_locations").prop("disabled", false);
    }
}

different_locations();
$('input:radio[name="different_locations"]').change(
    function () {
        different_locations();
    });