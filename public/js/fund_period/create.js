let checkSaveCreate = 0;

function openModalCreate() {
    $('#modal-create-payment').addClass('active');
}

async function saveModalCreate() {
    if (checkSaveCreate === 1) return false;
    checkSaveCreate = 1;
    let method = 'post',
        url = 'payment.create',
        params = {},
        data = {
            description: $('#description-create-payment').val(),
            addition_fee_type_id: $('#type-create-payment').val(),
            amount: removeformatNumber($('#amount-create-payment').val()),
            time: moment($('#time-create-payment').val(), 'DD/MM/YYYY').format('MM/DD/YYYY'),
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
    $('#modal-create-payment').removeClass('active');
    $('#description-create-payment').val('');
    $('#type-create-payment').val('0').trigger("chosen:updated");
    $('#amount-create-payment').val('0');
    $('#time-create-payment').val(moment().format('DD/MM/YYYY')).trigger('dp.change');
}
