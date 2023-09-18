let loadingBall = '', vh_of_table;

$(function () {
    $("#check-accept-rules").click(function () {
        if ($('#check-accept-rules').is(":checked")) {
            $('.main-btn').removeClass("disabled")
        } else
            $('.main-btn').addClass("disabled")
    });
    $('a[data-toggle="tab"]').not('.remove-draw-table').on('shown.bs.tab', function (e) {
        let table_id = $($(this).attr('href')).find('.dataTables_scrollBody table').attr('id');
        $.fn.dataTable.tables().forEach(function (dt) {
            if (table_id === dt.id) {
                let table = $('#' + table_id).DataTable();
                table.columns.adjust().draw();
            }
        });
    });

    $(document).on("input", "input[data-type='currency-edit']", function () {
        formatCurrency($(this));
    });
    countTableScrollY();

    $(document).on('change', '#check-accept-rules', function () {
        if ($(this).is(':checked')) {
            $('#layout-rules-crm .main-btn').removeClass('disabled');
            $('#layout-rules-crm .main-btn').removeAttr('disabled');
        } else {
            $('#layout-rules-crm .main-btn').addClass('disabled');
            $('#layout-rules-crm .main-btn').attr('disabled', 'disabled');
        }
    });
});

async function axiosTemplate(method, url, params, data, element = [], classLoading = 'la-3x') {
    let res = await axios({
        method: method, url: url, params: params, data: data
    });
    console.log(res);
    return res;
}

function SuccessNotify() {
    $.toast({
        heading: 'Thành công',
        text: '',
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#fa6342',
        position: 'bottom-right',
        hideAfter: 3000,
    });
}

function ErrorNotify(message) {
    $.toast({
        heading: 'Lỗi rồi',
        text: message,
        showHideTransition: 'fade',
        icon: 'error',
        hideAfter: 7000,
        loaderBg: '#fa6342',
        position: 'bottom-right',
    });
}

function WarningNotify(message) {
    $.toast({
        heading: 'Thông báo',
        text: message,
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: 5000,
        loaderBg: '#fa6342',
        position: 'bottom-right',
    });
}

function sweetAlertComponent(title, text, icon, html = '') {
    let confirm = 'Xác nhận';
    let cancel = 'Đóng';
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-grd-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        }, buttonsStyling: false
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        html: html,
        showCancelButton: true,
        confirmButtonText: confirm,
        cancelButtonText: cancel,
        reverseButtons: true,
        focusConfirm: true,
        allowOutsideClick: false,
    })
}

function sweetAlertNextComponent(title, text, icon) {
    let confirm = "Đăng xuất";
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary btn-sweet-alert',
        }, buttonsStyling: false
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
        confirmButtonText: confirm,
        reverseButtons: true,
        focusConfirm: true
    })
}

function sweetAlertComponentClose(title, text, icon, html = '') {
    let cancel = 'Đóng';
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-grd-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        }, buttonsStyling: false
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        html: html,
        timer: 2000,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: cancel,
        reverseButtons: true,
        focusConfirm: true,
        allowOutsideClick: false,
    })
}

function imageDefaultOnLoadError(r) {
    r.attr('src', '/images/other/default.gif');
    r.off('error');
}

function imageDefaultOnLoadErrorUser(r) {
    r.attr('src', '/images/other/default-avatar.jpeg');
}

function removeFormatNumber(num) {
    num = String(num);
    return Number(num.replace(/[^0-9.-]+/g, ""));
}

async function countTableScrollY() {
    let px_of_table = $(".theme-layout").outerHeight(true) - ($('.topbar').outerHeight(true) + $('.crm-contain-wrapper').outerHeight(true) + 10);
    vh_of_table = (px_of_table - 70) + 'px';
}


function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formatNumberLimit(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function removeformatNumber(num) {
    num = String(num);
    return Number(num.replace(/[^0-9.-]+/g, ""));
}

$(document).on("input", "input[data-type='currency-edit']", function () {
    formatCurrency($(this));
});

function formatNumberCurrency(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
    let input_val = input.val();
    if (input_val === "") {
        return;
    }
    let original_len = input_val.length;
    let caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        let decimal_pos = input_val.indexOf(".");
        let left_side = input_val.substring(0, decimal_pos);
        let right_side = input_val.substring(decimal_pos);
        left_side = formatNumberCurrency(left_side);
        right_side = formatNumberCurrency(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side;
    } else {
        input_val = formatNumberCurrency(input_val);
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    input.val(input_val);
    let updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function formartFloat(input_val) {
    input_val = String(input_val);
    if (input_val.indexOf(".") > 0) {
        let decimal_pos = input_val.indexOf(".");
        let left_side = input_val.substring(0, decimal_pos);
        let right_side = input_val.substring(decimal_pos);
        left_side = formatNumberCurrency(left_side);
        // right_side = formatNumberCurrency(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(1, 3);

        input_val = left_side + "." + right_side;
    } else {
        input_val = formatNumberCurrency(input_val);
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    return input_val;
}

function nFormatter(num) {
    let digits = 1;
    let si = [
        {value: 1, symbol: ""},
        {value: 1E3, symbol: " Nghìn"},
        {value: 1E6, symbol: " Triệu"},
        {value: 1E9, symbol: " Tỷ"},
    ];
    let rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    let i;
    if (num >= 0) {
        for (i = si.length - 1; i > 0; i--) {
            if (num >= si[i].value) {
                break;
            }
        }
    }
    if (num < 0) {
        for (i = si.length - 1; i > 0; i--) {
            if (num <= -(si[i].value)) {
                break;
            }
        }
    }
    return (num / si[i].value).toFixed(digits).replace(rx, "$1") + si[i].symbol;
}


/**
 * save cookie
 * @param key
 * @param value
 */
function saveCookieShared(key, value) {
    document.cookie = key + "=" + value;
}

/**
 * get cookie
 * @param name
 * @returns {string}
 */
function getCookieShared(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body'
    });
    /** Calendar **/
    $(document).on('click', '.fc-day', function () {
        console.log('click')
        $('.fc-day').removeClass('active')
        $(this).addClass('active')
    });

    $(document).on('click', '.fc-day-top', function () {
        console.log('click 2')
        $('.fc-day-top').removeClass('active');
        $(this).addClass('active')
    });

    $(document).on('click', '.fc-event-container', function () {
        console.log('click 3')
        $('.fc-day-top').removeClass('active');
        $(this).addClass('active')
    });
});

function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return rect.bottom > 300 || rect.top < 56;
}

/**
 *
 * @param str
 * @returns {string}
 * Sẽ xoá
 */
function removeVietnameseStringLowerCase(str) {
    if (str) {
        str = str.toLowerCase();
        str = str.replace('/\s+/', '');
        str = str.replace(' ', '');
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/ |\-/g, "");
        str = str.replace(/đ/g, "d");
        return str.toLocaleLowerCase();
    } else {
        return '';
    }
}

/**
 *
 * @param str
 * @returns {string}
 */
function removeVietnameseString(str) {
    if (str) {
        str = str.toLowerCase();
        str = str.replace('/\s+/', '');
        str = str.replace(' ', '');
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/ |\-/g, "");
        str = str.replace(/đ/g, "d");
        return str;
    } else {
        return '';
    }
}

function toLowerCaseNonAccentVietnamese(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // Huyền sắc hỏi ngã nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // Â, Ê, Ă, Ơ, Ư
    return str;
}


function remove_special_char(str) {
    str = str.replace(/-+-/g, "_"); //thay thế 2- thành 1_
    str = str.replace(/^\-+|\-+$/g, "");
    str = str.replace(/!|@|%|\$|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\\|\]|~|$/g, "");
    return str;
}

function sweetAlertComponentSelect(title, text, icon, html, data, placeholder) {
    let confirm = "Xác nhận";
    let cancel = "Đóng";
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-grd-primary btn-sweet-alert",
            cancelButton: "btn btn-grd-disabled btn-sweet-alert",
            input: "input-sweet-alert-custom",
        },
        buttonsStyling: false,
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        html: html,
        input: 'select',
        inputOptions: data,
        inputPlaceholder: placeholder,
        showCancelButton: true,
        confirmButtonText: confirm,
        cancelButtonText: cancel,
        reverseButtons: true,
        focusConfirm: true,
        allowOutsideClick: false,
    });
}

function sweetAlertComponentNotSelect(title, text, icon) {
    let cancel = "Đóng";
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: "btn btn-grd-disabled btn-sweet-alert",
        },
        buttonsStyling: false,
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: cancel,
        reverseButtons: true,
        focusConfirm: true,
        allowOutsideClick: false,
    }).then($('.swal2-textarea').remove());
}

function resetScroll() {
    $('.body-modal-c-form').scrollTop(0);
}

function openModalImageFullSize(r) {
    $('#modal-popup-image-component').show();
    $('#modal-popup-image-component').addClass('show');
    $('#src-popup-image-component').attr('src', r.attr('src'));
}

function closeModalImageFullSize() {
    $('#modal-popup-image-component').hide();
    $('#modal-popup-image-component').removeClass('show');

}
