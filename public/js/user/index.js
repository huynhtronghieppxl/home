$(function () {
    loadData()
})

async function loadData() {
    let method = "get",
        url = "user.data",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTableUser(res.data[0].original.data);
}

async function dataTableUser(data) {
    let id = $("#table-employee-manage"),
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "avatar", name: "avatar", className: "text-center"},
            {data: "name", name: "name", className: "text-center"},
            {data: "phone", name: "phone", className: "text-center"},
            {data: "birthday", name: "birthday", className: "text-center"},
            {data: "last_activity", name: "last_activity", className: "text-center"},
            {data: "action", name: "action", className: "text-center", width: "10%"},
        ],
        option = [];
    DatatableTemplate(id, data, columns, heightScrollDatatable, fixed_left, fixed_right, option);
}
