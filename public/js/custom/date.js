function dateTimePickerMonthYear(element) {
    element.datetimepicker({
        format: 'MM/YYYY',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element.on("dp.change", function () {
        if ($(this).val() === '') {
            $(this).val(moment().format('MM/YYYY'));
        }
    });
}

function dateTimePickerDayMonthYear(element) {
    element.datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        },
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('MM/YYYY'));
        }
    });
}
