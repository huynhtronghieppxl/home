let checkSaveUpdate = 0, idUpdate;

function openModalUpdate(r) {
    idUpdate = r.data('id');
    dateTimePickerDayMonthYear($("#time-update-reserve-fund"));
    $('#description-update-reserve-fund').val(r.parents('tr').find('td:eq(3)').text());
    $('#amount-update-reserve-fund').val(r.parents('tr').find('td:eq(2)').text());
    $('#time-update-reserve-fund').val(r.parents('tr').find('td:eq(1)').text()).trigger('dp.change');
    $('#modal-update-reserve-fund').addClass('active');
}

async function saveModalUpdate() {
    if (checkSaveUpdate === 1) return false;
    checkSaveUpdate = 1;
    let method = 'post',
        url = 'reserve-fund.update',
        params = {},
        data = {
            id: idUpdate,
            description: $('#description-update-reserve-fund').val(),
            amount: removeformatNumber($('#amount-update-reserve-fund').val()),
            time: moment($('#time-update-reserve-fund').val(), 'DD/MM/YYYY').format('MM/DD/YYYY'),
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveUpdate = 0
    switch (res.data.status) {
        case 200:
            SuccessNotify()
            closeModalUpdate();
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

function closeModalUpdate() {
    $('#modal-update-reserve-fund').removeClass('active');
    $('#description-update-reserve-fund').val('');
    $('#amount-update-reserve-fund').val('0');
    $('#time-update-reserve-fund').val(moment().format('DD/MM/YYYY')).trigger('dp.change');
}
