let checkSaveFundAllocation = 0, idFundAllocation;

function openModalFundAllocation(r) {
    if (removeformatNumber(r.parents('tr').find('td:eq(9)').text()) <= 0) {
        WarningNotify('Số dư không đủ để phân bổ: ' + r.parents('tr').find('td:eq(9)').text());
        return false;
    }
    idFundAllocation = r.data('id');
    $('#amount-fund-allocation').text(r.parents('tr').find('td:eq(9)').text());
    $('#modal-fund-allocation').addClass('active');
    let total = removeformatNumber($('#amount-fund-allocation').text());
    $('#reserve-fund-allocation').attr('data-max', total);
    $('#invest-fund-allocation').attr('data-max', total);
    $('#reserve-fund-allocation').on('input paste', function () {
        $('#invest-fund-allocation').val(formatNumber(total - removeformatNumber($(this).val())))
    })
    $('#invest-fund-allocation').on('input paste', function () {
        $('#reserve-fund-allocation').val(formatNumber(total - removeformatNumber($(this).val())))
    })
}

async function saveModalFundAllocation() {
    if (checkSaveFundAllocation === 1) return false;
    checkSaveFundAllocation = 1;
    let method = 'post',
        url = 'fund-period.fund-allocation',
        params = {},
        data = {
            id: idFundAllocation,
            reserve_fund: removeformatNumber($('#reserve-fund-allocation').val()),
            invest_fund: removeformatNumber($('#invest-fund-allocation').val()),
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveFundAllocation = 0
    switch (res.data.status) {
        case 200:
            SuccessNotify()
            closeModalFundAllocation();
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

function closeModalFundAllocation() {
    $('#modal-fund-allocation').removeClass('active');
}
