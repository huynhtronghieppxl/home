let checkSaveUpdate = 0, idUpdate;

function openModalUpdate(r) {
    idUpdate = r.data('id');
    dateTimePickerDayMonthYear($("#time-update-payment"));
    $('#description-update-payment').val(r.parents('tr').find('td:eq(4)').text());
    $('#type-update-payment').val(r.data('type')).trigger("chosen:updated");
    $('#amount-update-payment').val(r.parents('tr').find('td:eq(3)').text());
    $('#time-update-payment').val(r.parents('tr').find('td:eq(1)').text()).trigger('dp.change');
    $('#modal-update-payment').addClass('active');
}

async function saveModalUpdate() {
    if (checkSaveUpdate === 1) return false;
    checkSaveUpdate = 1;
    let method = 'post',
        url = 'payment.update',
        params = {},
        data = {
            id: idUpdate,
            description: $('#description-update-payment').val(),
            addition_fee_type_id: $('#type-update-payment').val(),
            amount: removeformatNumber($('#amount-update-payment').val()),
            time: moment($('#time-update-payment').val(), 'DD/MM/YYYY').format('MM/DD/YYYY'),
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
    $('#modal-update-payment').removeClass('active');
    $('#description-update-payment').val('');
    $('#type-update-payment').val('0').trigger("chosen:updated");
    $('#amount-update-payment').val('0');
    $('#time-update-payment').val(moment().format('DD/MM/YYYY')).trigger('dp.change');
}
