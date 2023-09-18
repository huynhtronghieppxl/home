let checkSaveCreate = 0;

function openModalCreate() {
    $('#modal-create-receipt').addClass('active');
}

async function saveModalCreate() {
    if (checkSaveCreate === 1) return false;
    checkSaveCreate = 1;
    let method = 'post',
        url = 'receipt.create',
        params = {},
        data = {
            description: $('#description-create-receipt').val(),
            addition_fee_type_id: $('#type-create-receipt').val(),
            amount: removeformatNumber($('#amount-create-receipt').val()),
            time: moment($('#time-create-receipt').val(), 'DD/MM/YYYY').format('MM/DD/YYYY'),
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
    $('#modal-create-receipt').removeClass('active');
    $('#description-create-receipt').val('');
    $('#type-create-receipt').val('0').trigger("chosen:updated");
    $('#amount-create-receipt').val('0');
    $('#time-create-receipt').val(moment().format('DD/MM/YYYY')).trigger('dp.change');
}
