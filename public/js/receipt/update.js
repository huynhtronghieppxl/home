let checkSaveUpdate = 0, idUpdate;

function openModalUpdate(r) {
    idUpdate = r.data('id');
    dateTimePickerDayMonthYear($("#time-update-receipt"));
    $('#description-update-receipt').val(r.parents('tr').find('td:eq(4)').text());
    $('#type-update-receipt').val(r.data('type')).trigger("chosen:updated");
    $('#amount-update-receipt').val(r.parents('tr').find('td:eq(3)').text());
    $('#time-update-receipt').val(r.parents('tr').find('td:eq(1)').text()).trigger('dp.change');
    $('#modal-update-receipt').addClass('active');
}

async function saveModalUpdate() {
    if (checkSaveUpdate === 1) return false;
    checkSaveUpdate = 1;
    let method = 'post',
        url = 'receipt.update',
        params = {},
        data = {
            id: idUpdate,
            description: $('#description-update-receipt').val(),
            addition_fee_type_id: $('#type-update-receipt').val(),
            amount: removeformatNumber($('#amount-update-receipt').val()),
            time: moment($('#time-update-receipt').val(), 'DD/MM/YYYY').format('MM/DD/YYYY'),
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
    $('#modal-update-receipt').removeClass('active');
    $('#description-update-receipt').val('');
    $('#type-update-receipt').val('0').trigger("chosen:updated");
    $('#amount-update-receipt').val('0');
    $('#time-update-receipt').val(moment().format('DD/MM/YYYY')).trigger('dp.change');
}
