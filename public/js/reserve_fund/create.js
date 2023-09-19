let checkSaveCreate = 0;

function openModalCreate() {
    dateTimePickerDayMonthYear($("#time-create-reserve-fund"));
    $('#modal-create-reserve-fund').addClass('active');
}

async function saveModalCreate() {
    if (checkSaveCreate === 1) return false;
    checkSaveCreate = 1;
    let method = 'post',
        url = 'reserve-fund.create',
        params = {},
        data = {
            description: $('#description-create-reserve-fund').val(),
            amount: removeformatNumber($('#amount-create-reserve-fund').val()),
            time: moment($('#time-create-reserve-fund').val(), 'DD/MM/YYYY').format('MM/DD/YYYY'),
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveCreate = 0
    switch (res.data.status) {
        case 200:
            SuccessNotify()
            closeModalCreate();
            loadData();
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
            break;
    }
}

function closeModalCreate() {
    $('#modal-create-reserve-fund').removeClass('active');
    $('#description-create-reserve-fund').val('');
    $('#amount-create-reserve-fund').val('0');
    $('#time-create-reserve-fund').val(moment().format('DD/MM/YYYY')).trigger('dp.change');
}
