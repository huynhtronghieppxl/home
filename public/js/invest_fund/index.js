$(function () {
    loadDataPeriod();
    loadData();
    $(document).on('input paste', '#real-amount-update-invest-fund', function () {
        let total_in = removeformatNumber($('#in-amount-update-invest-fund').text()),
            real_amount = removeformatNumber($('#real-amount-update-invest-fund').val()),
            profit = real_amount - total_in,
            rate_profit = (profit / total_in) * 100;
        let css = (rate_profit > 0) ? 'fa fa-arrow-up text-success' : 'fa fa-arrow-down text-danger';
        $('#profit-update-invest-fund .justify-content-center').html(`${formatNumber(profit)}<i class="fa fa-exclamation-triangle text-success pl-1 mb-1 ${css}">${parseFloat(rate_profit).toFixed(2)}</i>`);
    })
    $(document).on('input paste', '#real-amount-confirm-invest-fund', function () {
        let total_in = removeformatNumber($('#in-amount-confirm-invest-fund').text()),
            real_amount = removeformatNumber($('#real-amount-confirm-invest-fund').val()),
            profit = real_amount - total_in,
            rate_profit = (profit / total_in) * 100;
        let css = (rate_profit > 0) ? 'fa fa-arrow-up text-success' : 'fa fa-arrow-down text-danger';
        $('#profit-confirm-invest-fund .justify-content-center').html(`${formatNumber(profit)}<i class="fa fa-exclamation-triangle text-success pl-1 mb-1 ${css}">${parseFloat(rate_profit).toFixed(2)}</i>`);
    })
})

async function loadDataPeriod() {
    let method = "get",
        url = "invest-fund.period",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTablePeriod(res.data[0].original.data);
}

async function dataTablePeriod(data) {
    let id = $("#table-period"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "time", name: "time", className: "text-center"},
            {data: "begin", name: "begin", className: "text-right"},
            {data: "amount", name: "amount", className: "text-right"},
            {data: "total_in", name: "total_in", className: "text-right"},
            {data: "real_amount", name: "real_amount", className: "text-right"},
            {data: "profit", name: "profit", className: "text-center"},
            {data: "status", name: "status", className: "text-center"},
            {data: "action", name: "action", className: "text-center", width: "10%"},
        ],
        option = [];
    DatatableTemplate(id, data, columns, heightScrollDatatable, fixed_left, fixed_right, option);
}


async function loadData() {
    let method = "get",
        url = "invest-fund.data",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTable(res.data[0].original.data);
}

async function dataTable(data) {
    let id = $("#table-data"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "time", name: "time", className: "text-center"},
            {data: "amount", name: "amount", className: "text-right"},
            {data: "description", name: "description", className: "text-left"},
        ],
        option = [];
    DatatableTemplate(id, data, columns, heightScrollDatatable, fixed_left, fixed_right, option);
}

let checkSaveUpdateRealAmount = 0;

async function updateRealAmount(r) {
    if (checkSaveUpdateRealAmount === 1) return false;
    let title = "Cập nhật số dư thực tế",
        text = "Vui lòng cập nhật số dư hiện tại !",
        icon = "question",
        html = `<form class="c-form text-left">
        <div class="p-0 m-0">
            <div class="form-input-crm">
                <label style="display:inline;">Tổng tiền đầu tư: </label>
                <div id="in-amount-update-invest-fund" style="display: inline-block">${r.parents('tr').find('td:eq(4)').text()}</div>
            </div>
            <div class="form-input-crm">
                <label>Số dư hiện tại</label>
                <input id="real-amount-update-invest-fund" class="format-number-setting" data-type="currency-edit" data-max="999999999" value="${r.parents('tr').find('td:eq(5)').text()}">
                <p class="error-message-crm"></p>
            </div>
            <div class="form-input-crm">
                <label style="display:inline;">Tỷ suất lợi nhuận: </label>
                <div id="profit-update-invest-fund" style="display: inline-block">${r.parents('tr').find('td:eq(6)').html()}</div>
            </div>
        </div>
    </form>`;
    sweetAlertComponent(title, text, icon, html).then(async (result) => {
        if (result.value) {
            checkSaveUpdateRealAmount = 1;
            let method = "post",
                url = "invest-fund-period.update",
                params = null,
                data = {
                    id: r.data("id"),
                    real_amount: removeformatNumber($('#real-amount-update-invest-fund').val()),
                };
            let res = await axiosTemplate(method, url, params, data, [$("#body")]);
            checkSaveUpdateRealAmount = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify()
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
    });
}

let checkSaveConfirm = 0;

async function confirm(r) {
    if (checkSaveConfirm === 1) return false;
    let title = "Chốt kỳ đầu tư " + r.parents('tr').find('td:eq(1)').text() + ' ?',
        text = "",
        icon = "question",
        html = `<form class="c-form text-left">
        <div class="p-0 m-0">
            <div class="form-input-crm">
                <label style="display:inline;">Tổng tiền đầu tư: </label>
                <div id="in-amount-confirm-invest-fund" style="display: inline-block">${r.parents('tr').find('td:eq(4)').text()}</div>
            </div>
            <div class="form-input-crm">
                <label>Số dư hiện tại</label>
                <input id="real-amount-confirm-invest-fund" class="format-number-setting" data-type="currency-edit" data-max="999999999" value="${r.parents('tr').find('td:eq(5)').text()}">
                <p class="error-message-crm"></p>
            </div>
            <div class="form-input-crm">
                <label style="display:inline;">Tỷ suất lợi nhuận: </label>
                <div id="profit-confirm-invest-fund" style="display: inline-block">${r.parents('tr').find('td:eq(6)').html()}</div>
            </div>
        </div>
    </form>`;
    sweetAlertComponent(title, text, icon, html).then(async (result) => {
        if (result.value) {
            checkSaveConfirm = 1;
            let method = "post",
                url = "invest-fund-period.confirm",
                params = null,
                data = {
                    id: r.data("id"),
                    real_amount: removeformatNumber($('#real-amount-confirm-invest-fund').val()),
                };
            let res = await axiosTemplate(method, url, params, data, [$("#body")]);
            checkSaveConfirm = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify()
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
    });
}

