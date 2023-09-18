$(function () {
    loadDataPeriod();
    loadData();
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
