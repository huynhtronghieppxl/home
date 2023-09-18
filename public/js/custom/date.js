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

function dateTimePickerDayMonYear(element) {
    // let date_default = moment().format('MM/DD/YYYY');
    let maxDate = new Date('2005-12-31')
    element.datetimepicker({
        defaultDate: maxDate,
        format: 'DD/MM/YYYY',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        },
        maxDate:maxDate
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('MM/YYYY'));
        }
    });
}
