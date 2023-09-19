let checkSaveConfirm = 0;

$(function () {
    loadData();
})

async function loadData() {
    let method = "get",
        url = "fund-period.data",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTable(res.data[0].original.data);
}

async function dataTable(data) {
    let id = $("#table-fund-period"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "time", name: "time", className: "text-center"},
            {data: "begin", name: "begin", className: "text-right"},
            {data: "receipt", name: "receipt", className: "text-right"},
            {data: "payment", name: "payment", className: "text-right"},
            {data: "ending_balance", name: "ending_balance", className: "text-right"},
            {data: "begin", name: "begin", className: "text-right"},
            {data: "reserve_fund", name: "reserve_fund", className: "text-right"},
            {data: "invest_fund", name: "invest_fund", className: "text-right"},
            {data: "surplus", name: "surplus", className: "text-right"},
            {data: "status", name: "status", className: "text-center"},
            {data: "action", name: "action", className: "text-center", width: "10%"},
        ],
        option = [];
    DatatableTemplate(id, data, columns, heightScrollDatatable, fixed_left, fixed_right, option);
}

async function confirm(r) {
    if (checkSaveConfirm === 1) return false;
    let title = "Xác nhận chốt kỳ " + r.parents('tr').find('td:eq(1)').text() + ' ?',
        text = "Số dư còn: " + r.parents('tr').find('td:eq(9)').text() + ' sẽ được chuyển vào quỹ chi tiêu !',
        icon = "question";
    sweetAlertComponent(title, text, icon).then(async (result) => {
        if (result.value) {
            checkSaveConfirm = 1;
            let method = "post",
                url = "fund-period.confirm",
                params = null,
                data = {
                    id: r.data("id"),
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
