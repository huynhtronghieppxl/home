/* VALIDATE EMPTY  */
$(function(){
    /** Spectial character **/
    $(document).on('input paste keyup', 'input[data-spec]', function (){
        $(this).val($(this).val().replace(/[`~!@#$%^&*()|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''));
    });

    /** Emoji **/
    $(document).on('input paste keyup', 'input[data-emoji]', function () {
        let value = $(this).val();
        let newValue = value.replace(/[\u{1f300}-\u{1f5ff}\u{1f900}-\u{1f9ff}\u{1f600}-\u{1f64f}\u{1f680}-\u{1f6ff}\u{2600}-\u{26ff}\u{2700}-\u{27bf}\u{1f1e6}-\u{1f1ff}\u{1f191}-\u{1f251}\u{1f004}\u{1f0cf}\u{1f170}-\u{1f171}\u{1f17e}-\u{1f17f}\u{1f18e}\u{3030}\u{2b50}\u{2b55}\u{2934}-\u{2935}\u{2b05}-\u{2b07}\u{2b1b}-\u{2b1c}\u{3297}\u{3299}\u{303d}\u{00a9}\u{00ae}\u{2122}\u{23f3}\u{24c2}\u{23e9}-\u{23ef}\u{25b6}\u{23f8}-\u{23fa}\u{200d}]*/ug, '');
        $(this).val(newValue);
    });

    $(document).on('input paste keyup', 'textarea[data-emoji]', function () {
        let value = $(this).val();
        let newValue = value.replace(/[\u{1f300}-\u{1f5ff}\u{1f900}-\u{1f9ff}\u{1f600}-\u{1f64f}\u{1f680}-\u{1f6ff}\u{2600}-\u{26ff}\u{2700}-\u{27bf}\u{1f1e6}-\u{1f1ff}\u{1f191}-\u{1f251}\u{1f004}\u{1f0cf}\u{1f170}-\u{1f171}\u{1f17e}-\u{1f17f}\u{1f18e}\u{3030}\u{2b50}\u{2b55}\u{2934}-\u{2935}\u{2b05}-\u{2b07}\u{2b1b}-\u{2b1c}\u{3297}\u{3299}\u{303d}\u{00a9}\u{00ae}\u{2122}\u{23f3}\u{24c2}\u{23e9}-\u{23ef}\u{25b6}\u{23f8}-\u{23fa}\u{200d}]*/ug, '');
        $(this).val(newValue);
    });

    /** Empty **/
    $(document).on('input change onkeypress', 'input[data-empty]', function () {
        $(this).removeClass('validate-error-border');
        $(this).parent().find('.error-message-crm').text("");
    });

    $(document).on('input change onkeypress', 'textarea[data-empty]', function () {
        $(this).removeClass('validate-error-border');
        $(this).parent().find('.error-message-textarea-crm').text("");
    });

    /** Mail **/
    $(document).on('input', 'input[data-mail]', function (e) {
        $(this).removeClass('validate-error-border');
        $(this).parent().find('.error-message-textarea-crm').text("");
        $(this).val(removeVietnameseStringLowerCase($(this).val()));
    });

    /** Only text **/
    $(document).on('input', 'input[data-only-text]', function () {
        $(this).val($(this).val().replace(/[^\p{L}\p{N}\p{P}\p{Z}^$\n]/gu, ''));
        if (/^\d+$/.test($(this).val().substr($(this).val().length - 1))) {
            $(this).val($(this).val().slice(0, -1));
        }
        if (/[^0-9]/g.test($(this).val()) === false && $(this).val() != '') {
            addWarningInput($(this), 'Chỉ được nhập chữ');
        }
    });

    /** Select **/
    $(document).on('change', 'select[data-select]', function () {
       $(this).parent().find('.chosen-container .chosen-single').removeClass('validate-error-border');
       $(this).parent().find('.chosen-container .chosen-choices').removeClass('validate-error-border');
    });

    /** Money **/
    $(document).on('input paste', 'input[data-money]', function (e) {
        $(this).removeClass('validate-error-border');
        $(this).parent().find('.error-message-crm').text("");
        if ($(this).val() === undefined || $(this).val() === '' || /[^0-9]/g.test(removeformatNumber($(this).val()))) {
            if ($(this).val() == '') {
                $(this).val('0');
            } else {
                $(this).val(checkDecimal($(this).val()).toFixed(0));
            }
        }
        if (!/[^0-9]/g.test(removeformatNumber($(this).val()))) {
            if (removeformatNumber($(this).val()) < 999999999999) {
                if ($(this).val() < 0) {
                    $(this).val('0');
                }
                $(this).val(formatNumber(parseInt(removeformatNumber($(this).val()))));
            } else {
                $(this).val(formatNumber(999999999999));
            }
        }
    });

    /** Number + Text **/
    $(document).on('input paste', 'input[data-number-text]', function () {
        removeErrorInput($(this));
        if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test($(this).val())) {
            $(this).val($(this).val().slice(0, -1));
        }
    });

    /** Number **/
    $(document).on('input paste', 'input[data-number]', function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    /** IP **/
    $(document).on('input onkeypress paste', 'input[data-ip]', function () {
        let regex = /[^0-9.]/g;
        $(this).val($(this).val().replace(regex, ''));
    })

    /** Max value **/
    $(document).on('input', 'input[data-max]', function () {
        $(this).val(formatNumber(parseInt(removeformatNumber($(this).val()))));
        if (removeformatNumber($(this).val()) > Number($(this).attr('data-max'))) {
            $(this).val(formatNumber(Number($(this).attr('data-max'))));
        }
    });

    /** Min value **/
    $(document).on('input', 'input[data-min]', function () {
        $(this).val(formatNumber(parseInt(removeformatNumber($(this).val()))));
        if (removeformatNumber($(this).val()) < Number($(this).attr('data-min'))) {
            $(this).val(formatNumber(Number($(this).attr('data-min'))));
        }
    });
});

function checkValidateSave(el) {
    let flag = 0;
    el.find("input:not(:checkbox)").each(function () {
        if ($(this).attr("type") != "file") {
            $(this).val($(this).val().trim());
            if ($(this).parents(".d-none").length === 0 && !$(this).hasClass("disabled")) {
                if ($(this).attr("data-empty")) {
                    if ($(this).val() === "") {
                        $(this).addClass("validate-error-border");
                        $(this).parent().find('.error-message-crm').text("Không được để trống");
                        flag = 1;
                    }
                }
                $(this).val($(this).val().trim());

                /** Maxlength **/
                if ($(this).attr('data-max-length')) {
                    if ($(this).val().length > $(this).attr('data-max-length')) {
                        $(this).addClass("validate-error-border");
                        $(this).parent().find('.error-message-crm').text(`Độ dài tối đa ${$(this).attr('data-max-length')} ký tự`);
                        flag = 1;
                    }
                    $(this).val($(this).val().trim());
                }

                /** Minlength **/
                if ($(this).attr('data-min-length')) {
                    if ($(this).val().length < $(this).attr('data-min-length')) {
                        $(this).addClass("validate-error-border");
                        $(this).parent().find('.error-message-crm').text(`Độ dài tối thiểu ${$(this).attr('data-min-length')} ký tự`);
                        flag = 1;
                    }
                    $(this).val($(this).val().trim());
                }

                /** Money **/
                if ($(this).attr('data-money')) {
                    if ($(this).val() < 100 && $(this).val() != 0) {
                        $(this).addClass('validate-error-border');
                        $(this).parent().find('.error-message-crm').text('Số tiền lớn hơn hoặc bằng 100');
                        flag = 1;
                    }
                }

                /** Mail **/
                if ($(this).attr('data-mail')) {
                    // let reMail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                    let reMail =  /^[a-zA-Z0-9._%+-]{2,}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    let input_email = $(this).val();
                    if (input_email !== '') {
                        if (!input_email.match(reMail)) {
                            $(this).addClass('validate-error-border');
                            $(this).parent().find('.error-message-crm').text('Mail không đúng định dạng (VD: ab@aloapp.vn)');
                            flag = 1;
                        }
                    }
                }

                /** Phone **/
                if ($(this).attr("data-phone")) {
                    let rePhone = /^(0|0|0|0|0).*$/;
                    $(this).val(
                        $(this).val().replace(/([^0-9\\])[\/]/g, "")
                    );
                    if ($(this).val().length <= 10 && $(this).val() != "") {
                        if (!($(this).val().length < 2 || ($(this).val().length >= 1 && $(this).val().substring(0, 1).match(rePhone)))) {
                            $(this).addClass("validate-error-border");
                            $(this).parent().find(".error-message-crm").text("Đầu SĐT không đúng định dạng");
                            flag = 1;
                        } else {
                            if ($(this).val().length === 10 && $(this).val().substring(0, 1).match(rePhone)) {
                                $(this).attr("data-check", 0);
                            } else {
                                $(this).parent().addClass("border-danger");
                                $(this).addClass("validate-error-border");
                                $(this).parent().find(".error-message-crm").text("Số điện thoại chưa đúng 10 số");
                                flag = 1;
                            }
                        }
                    } else {
                        $(this).addClass("validate-error-border");
                        $(this).parent().find(".error-message-crm").text("Số điện thoại chưa đủ 10 số");
                        flag = 1;
                    }
                }
            }
        }
    });

    /** Select **/
    el.find('select[data-select]').each(function () {
        if ($(this).parents('.d-none').length === 0 && !$(this).hasClass('disabled')) {
            if ($(this).val() == '-2' || $(this).val() == null || $(this).val() == '') {
                    $(this).parent().find('.chosen-container .chosen-single').addClass('validate-error-border');
                    $(this).parent().find('.chosen-container .chosen-choices').addClass('validate-error-border');
                flag = 1;
            } else {
                $(this).parent().find('.chosen-container .chosen-single').removeClass('validate-error-border');
                $(this).parent().find('.chosen-container .chosen-choices').removeClass('validate-error-border');
            }
        }
    });

    /** Textarea **/
    el.find("textarea").each(function () {
        if($(this).attr("data-empty")) {
            if($(this).val() === "") {
                $(this).addClass("validate-error-border");
                $(this).parent().find('.error-message-textarea-crm').text("Không đuợc để trống");
                flag = 1;
            }
        }
        /** Max length **/
        if ($(this).attr('data-max-length')) {
            if ($(this).val().length > $(this).attr('data-max-length')) {
                $(this).addClass("validate-error-border");
                $(this).parent().find('.error-message-textarea-crm').text(`Độ dài tối đa ${$(this).attr('data-max-length')} ký tự`);
                flag = 1;
            }
            $(this).val($(this).val().trim());
        }
    });
    return flag;
}

/** Validate Date **/
function validateDateTemplate(from, to, text, type) {
    switch (parseInt(type)){
        case 1:
            if (moment(from.val(), 'DD/MM/YYYY').clone().format('x') > moment(to.val(), 'DD/MM/YYYY').clone().format('x')) {
                WarningNotify(text);
                return 1;
            }
            break;
        case 2:
            if (moment(from.val(), 'HH:mm').clone().format('x') >= moment(to.val(), 'HH:mm').clone().format('x')) {
                WarningNotify(text);
                return 1;
            }
            break;
        default:
            console.log('Error validate date');
            return 1;
    }
}

function validateHourTemplate(from, to) {
    if(moment(from.val(), 'HH:mm').isSameOrAfter(moment(to.val(), 'HH:mm'))) {
        WarningNotify('Giờ bắt đầu phải nhỏ hơn giờ kết thúc');
        return 1;
    }
}

function removeAllValidate() {
    $('.validate-error-border').removeClass('validate-error-border');
    $('.error-message-crm').text('');
    $('.error-message-textarea-crm').text('');
}

